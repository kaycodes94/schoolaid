// Plan Aid Academy - Frontend Integration Guide
// This file shows how to connect the HTML frontend to the backend APIs

// ============================================
// 1. API BASE URL CONFIGURATION
// ============================================

const API_BASE_URL = 'http://localhost/aidstudent/api';
let authToken = localStorage.getItem('auth_token') || null;

// ============================================
// 2. API UTILITY FUNCTIONS
// ============================================

/**
 * Make API request
 */
async function apiCall(endpoint, method = 'GET', data = null, headers = {}) {
    const options = {
        method,
        headers: {
            'Content-Type': 'application/json',
            ...headers
        }
    };

    if (authToken) {
        options.headers['Authorization'] = 'Bearer ' + authToken;
    }

    if (data) {
        options.body = JSON.stringify(data);
    }

    try {
        const response = await fetch(`${API_BASE_URL}/${endpoint}`, options);
        const result = await response.json();

        if (!response.ok) {
            throw new Error(result.message || 'API Error');
        }

        return result;
    } catch (error) {
        console.error('API Error:', error);
        throw error;
    }
}

/**
 * Show notification/alert
 */
function showNotification(message, type = 'success') {
    const alertClass = `alert-${type}`;
    const alert = document.createElement('div');
    alert.className = `alert ${alertClass}`;
    alert.innerHTML = `
        <span>${type === 'success' ? '✓' : '✗'} ${message}</span>
        <button onclick="this.parentElement.remove()" style="border: none; background: none; cursor: pointer; font-size: 18px;">×</button>
    `;
    alert.style.cssText = 'position: fixed; top: 20px; right: 20px; z-index: 10000; min-width: 300px; padding: 15px 20px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.2);';
    document.body.appendChild(alert);
    setTimeout(() => alert.remove(), 5000);
}

// ============================================
// 3. ADMISSION FORM INTEGRATION
// ============================================

async function submitAdmission() {
    // Get form values
    const unit = document.getElementById('admUnit').value;
    const surname = document.getElementById('admSurname').value.trim();
    const first = document.getElementById('admFirst').value.trim();
    const dob = document.getElementById('admDob').value;
    const gender = document.getElementById('admGender').value;
    const state = document.getElementById('admState').value.trim();
    const religion = document.getElementById('admReligion').value;
    const parent = document.getElementById('admParent').value.trim();
    const phone = document.getElementById('admPhone').value.trim();
    const address = document.getElementById('admAddress').value.trim();
    const prevSchool = document.getElementById('admPrev').value.trim();
    const prevClass = document.getElementById('admClass').value.trim();

    // Validate
    if (!unit || !surname || !first) {
        showNotification('Please fill in all required fields', 'error');
        return;
    }

    // Prepare data
    const admissionData = {
        unit_applied: unit,
        first_name: first,
        last_name: surname,
        date_of_birth: dob,
        gender: gender,
        state_of_origin: state,
        religion: religion,
        parent_name: parent,
        parent_phone: phone,
        home_address: address,
        previous_school: prevSchool,
        class_last_attended: prevClass
    };

    try {
        // Submit to API
        const response = await apiCall('admissions.php', 'POST', admissionData);

        if (response.status === 'success') {
            // Display admission slip
            displayAdmissionSlip(response.data);
            showNotification('Admission application submitted successfully!', 'success');
        }
    } catch (error) {
        showNotification('Error submitting application: ' + error.message, 'error');
    }
}

function displayAdmissionSlip(data) {
    // Update slip with data
    document.getElementById('slipNo').textContent = data.application_no;
    document.getElementById('slipName').textContent = data.full_name.toUpperCase();
    document.getElementById('slipUnit').textContent = data.unit_applied;
    document.getElementById('slipDate').textContent = new Date(data.application_date).toLocaleDateString('en-NG', {
        day: 'numeric',
        month: 'short',
        year: 'numeric'
    });

    // Show slip, hide form
    document.getElementById('admissionForm').classList.add('hidden');
    document.getElementById('admissionSlip').classList.remove('hidden');
    document.getElementById('admissionSlip').scrollIntoView({ behavior: 'smooth' });
}

function newApplication() {
    document.getElementById('admissionForm').classList.remove('hidden');
    document.getElementById('admissionSlip').classList.add('hidden');
    document.querySelectorAll('#admissionForm input, #admissionForm textarea').forEach(el => el.value = '');
}

// ============================================
// 4. AUTHENTICATION INTEGRATION
// ============================================

async function doLogin() {
    const staffId = document.querySelector('.modal input[placeholder*="PAA"]').value.trim();
    const password = document.querySelector('.modal input[type="password"]').value;

    if (!staffId || !password) {
        showNotification('Please enter staff ID and password', 'error');
        return;
    }

    try {
        const response = await apiCall('auth.php', 'POST', {
            staff_id: staffId,
            password: password
        });

        if (response.status === 'success') {
            // Store token
            authToken = response.data.token;
            localStorage.setItem('auth_token', authToken);
            localStorage.setItem('user_role', response.data.role);
            localStorage.setItem('user_name', response.data.name);

            // Close modal and navigate to dashboard
            closeModal();
            showPage('dashboard');
            updateDashboardForRole(response.data.role, response.data);
            showNotification('Login successful!', 'success');
        }
    } catch (error) {
        showNotification('Login failed: ' + error.message, 'error');
    }
}

function logOut() {
    if (authToken) {
        apiCall('auth.php?action=logout&token=' + authToken, 'GET');
    }
    authToken = null;
    localStorage.removeItem('auth_token');
    localStorage.removeItem('user_role');
    localStorage.removeItem('user_name');
    showPage('home');
    showNotification('Logged out successfully', 'success');
}

function updateDashboardForRole(role, userData) {
    document.getElementById('dashName').textContent = userData.name;
    document.getElementById('dashRole').textContent = role;
    if (userData.avatar_initials) {
        document.getElementById('dashAvatar').textContent = userData.avatar_initials;
    }
}

// ============================================
// 5. RESULTS PORTAL INTEGRATION
// ============================================

async function checkResults() {
    const studentId = document.getElementById('resId').value.trim();
    const session = document.querySelector('[placeholder="2024/2025"]')?.value || '2024/2025';
    const term = document.querySelector('select:nth-of-type(3)')?.value || '1st';

    if (!studentId) {
        showNotification('Please enter your student ID or admission number', 'error');
        return;
    }

    try {
        const response = await apiCall(`results.php?action=get&admission_no=${studentId}&session=${session}&term=${term}`, 'GET');

        if (response.status === 'success') {
            displayResultCard(response.data);
        }
    } catch (error) {
        showNotification('Student results not found', 'error');
    }
}

function displayResultCard(data) {
    // Update result card with data
    const alert = document.querySelector('#resultCard .alert');
    alert.innerHTML = `📄 Showing result for <b>${data.student.name}</b> · ${data.student.class} · ${document.querySelector('select:nth-of-type(3)').value} 2024/2025`;

    // Build results table
    let tableHTML = `
        <thead>
            <tr>
                <th>Subject</th>
                <th>CA (40)</th>
                <th>Exam (60)</th>
                <th>Total</th>
                <th>Grade</th>
                <th>Remark</th>
            </tr>
        </thead>
        <tbody>
    `;

    data.results.forEach(result => {
        tableHTML += `
            <tr>
                <td>${result.subject_name}</td>
                <td>${result.continuous_assessment}</td>
                <td>${result.exam_score}</td>
                <td>${result.total_score}</td>
                <td><span class="badge badge-${getGradeBadgeClass(result.grade)}">${result.grade}</span></td>
                <td>${result.remark}</td>
            </tr>
        `;
    });

    tableHTML += '</tbody>';

    const table = document.querySelector('#resultCard table');
    table.innerHTML = tableHTML;

    document.getElementById('resultCard').classList.remove('hidden');
    document.getElementById('resultCard').scrollIntoView({ behavior: 'smooth' });
}

function getGradeBadgeClass(grade) {
    const gradeMap = {
        'A': 'green',
        'B': 'green',
        'C': 'gold',
        'D': 'gold',
        'E': 'red',
        'F': 'red'
    };
    return gradeMap[grade] || 'gold';
}

// ============================================
// 6. FINANCE DASHBOARD INTEGRATION
// ============================================

async function loadFinanceSummary() {
    try {
        const response = await apiCall('finance.php?action=summary', 'GET');

        if (response.status === 'success') {
            const data = response.data;

            // Update cards
            document.querySelectorAll('.dash-card')[0].innerHTML = `
                <div class="dc-val">₦${(data.total_revenue / 1000000).toFixed(1)}M</div>
                <div class="dc-lbl">Total Revenue ${data.academic_session}</div>
            `;

            // Load payments table
            loadPaymentsTable();
        }
    } catch (error) {
        console.error('Error loading finance summary:', error);
    }
}

async function loadPaymentsTable() {
    try {
        const response = await apiCall('finance.php?action=payments&limit=50', 'GET');

        if (response.status === 'success') {
            // Build table
            let tableHTML = `
                <thead>
                    <tr>
                        <th>Receipt No.</th>
                        <th>Student Name</th>
                        <th>Class</th>
                        <th>Amount (₦)</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
            `;

            response.data.payments.forEach(payment => {
                const badgeClass = payment.status === 'confirmed' ? 'badge-green' : 'badge-gold';
                tableHTML += `
                    <tr>
                        <td>${payment.receipt_no}</td>
                        <td>${payment.first_name} ${payment.last_name}</td>
                        <td>${payment.class_name || '—'}</td>
                        <td>${payment.amount_paid.toLocaleString('en-NG')}</td>
                        <td>${new Date(payment.payment_date).toLocaleDateString('en-NG')}</td>
                        <td><span class="badge ${badgeClass}">${payment.status}</span></td>
                    </tr>
                `;
            });

            tableHTML += '</tbody>';

            const table = document.querySelector('#ds-finance table');
            if (table) {
                table.innerHTML = tableHTML;
            }
        }
    } catch (error) {
        console.error('Error loading payments:', error);
    }
}

// ============================================
// 7. STAFF DASHBOARD INTEGRATION
// ============================================

async function loadStudentsList() {
    try {
        const response = await apiCall('students.php?action=list&limit=50', 'GET');

        if (response.status === 'success') {
            // Build table
            let tableHTML = `
                <thead>
                    <tr>
                        <th>Adm. No.</th>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Unit</th>
                        <th>Gender</th>
                        <th>Fee Status</th>
                    </tr>
                </thead>
                <tbody>
            `;

            response.data.students.forEach(student => {
                tableHTML += `
                    <tr>
                        <td>${student.admission_no}</td>
                        <td>${student.first_name} ${student.last_name}</td>
                        <td>${student.current_class || '—'}</td>
                        <td>${student.unit_id}</td>
                        <td>${student.gender}</td>
                        <td><span class="badge badge-green">—</span></td>
                    </tr>
                `;
            });

            tableHTML += '</tbody>';

            const table = document.querySelector('#ds-students table');
            if (table) {
                table.innerHTML = tableHTML;
            }
        }
    } catch (error) {
        console.error('Error loading students:', error);
    }
}

async function loadPendingAdmissions() {
    try {
        const response = await apiCall('admissions.php?action=pending', 'GET');

        if (response.status === 'success') {
            // Build table
            let tableHTML = `
                <thead>
                    <tr>
                        <th>App. No.</th>
                        <th>Name</th>
                        <th>Unit Applied</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
            `;

            response.data.admissions.forEach(admission => {
                tableHTML += `
                    <tr>
                        <td>${admission.application_no}</td>
                        <td>${admission.first_name} ${admission.last_name}</td>
                        <td>${admission.unit_applied}</td>
                        <td>${new Date(admission.application_date).toLocaleDateString('en-NG')}</td>
                        <td><span class="badge badge-gold">${admission.status}</span></td>
                        <td>
                            <button onclick="approveAdmission('${admission.application_no}')" 
                                style="background:var(--green);color:#fff;border:none;padding:5px 12px;border-radius:5px;font-size:11px;cursor:pointer">
                                Approve
                            </button>
                        </td>
                    </tr>
                `;
            });

            tableHTML += '</tbody>';

            const table = document.querySelector('#ds-admissions table');
            if (table) {
                table.innerHTML = tableHTML;
            }
        }
    } catch (error) {
        console.error('Error loading admissions:', error);
    }
}

async function approveAdmission(applicationNo) {
    try {
        const response = await apiCall('admissions.php', 'POST', {
            application_no: applicationNo,
            status: 'approved',
            staff_id: localStorage.getItem('staff_id')
        });

        if (response.status === 'success') {
            showNotification('Admission approved successfully!', 'success');
            loadPendingAdmissions();
        }
    } catch (error) {
        showNotification('Error approving admission: ' + error.message, 'error');
    }
}

// ============================================
// 8. INITIALIZATION
// ============================================

// Load dashboard data when switching to dashboard
let originalShowDashSection = showDashSection;
showDashSection = function(sec) {
    originalShowDashSection(sec);

    if (authToken) {
        if (sec === 'students') {
            loadStudentsList();
        } else if (sec === 'admissions') {
            loadPendingAdmissions();
        } else if (sec === 'finance') {
            loadFinanceSummary();
        }
    }
};

// Check if user is already logged in
window.addEventListener('load', function() {
    if (authToken) {
        document.getElementById('dashName').textContent = localStorage.getItem('user_name') || 'Staff';
    }
});
