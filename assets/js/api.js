/**
 * School Aid Management System
 * api.js — Fetch wrapper with automatic local storage mock database fallback
 */

// Initialize local storage mock database if not exists
const MOCK_DB = {
  init() {
    if (!localStorage.getItem('sams_mock_initialized')) {
      localStorage.clear();
      
      // Seed Departments
      const depts = [
        { id: 1, name: 'Science Department', code: 'SCI', description: 'Biology, Chemistry, Physics, Mathematics', Head: 'Fatima Sani', head_staff_id: 7, is_active: 1 },
        { id: 2, name: 'Arts Department', code: 'ARTS', description: 'Literature, Fine Art, Music, CRK/IRK', Head: 'Amaka Uche', head_staff_id: 2, is_active: 1 },
        { id: 3, name: 'Commercial Department', code: 'COM', description: 'Economics, Accounting, Commerce', Head: 'Elisha Pwol', head_staff_id: 3, is_active: 1 },
        { id: 4, name: 'Primary Department', code: 'PRI', description: 'Primary 1-6 general subjects', Head: 'Grace Longs', head_staff_id: 4, is_active: 1 },
        { id: 5, name: 'Nursery Department', code: 'NUR', description: 'Pre-nursery and Nursery classes', Head: 'Grace Longs', head_staff_id: 4, is_active: 1 },
      ];
      localStorage.setItem('sams_mock_departments', JSON.stringify(depts));

      // Seed Student Registrations (Pending Admissions)
      const studentRegs = [
        { id: 1, full_name: 'Daniel Gyang', email: 'daniel.gyang@email.com', phone: '+234 803 111 2222', date_of_birth: '2012-05-14', class_name: 'JSS 1', department_id: null, department_name: '', status: 'pending', created_at: new Date(Date.now() - 3600000 * 4).toISOString() },
        { id: 2, full_name: 'Hauwa Suleiman', email: 'hauwa.suleiman@email.com', phone: '+234 812 333 4444', date_of_birth: '2011-09-21', class_name: 'JSS 2', department_id: 4, department_name: 'Primary Department', status: 'pending', created_at: new Date(Date.now() - 3600000 * 20).toISOString() },
        { id: 3, full_name: 'John Dakyen', email: 'john.dakyen@email.com', phone: '+234 705 555 6666', date_of_birth: '2019-11-03', class_name: 'Nursery 2', department_id: 5, department_name: 'Nursery Department', status: 'approved', student_id_generated: 'STD-2026-0003', username: 'john.dakyen', approved_at: new Date().toISOString(), created_at: new Date(Date.now() - 3600000 * 48).toISOString() },
        { id: 4, full_name: 'Amina Abdullahi', email: 'amina.abdul@email.com', phone: '+234 902 777 8888', date_of_birth: '2009-02-18', class_name: 'SS 1', department_id: 1, department_name: 'Science Department', status: 'correction_requested', correction_comments: 'Please upload a clearer passport photograph.', created_at: new Date(Date.now() - 3600000 * 72).toISOString() },
      ];
      localStorage.setItem('sams_mock_student_regs', JSON.stringify(studentRegs));

      // Seed Teacher Registrations (Pending Teacher Applications)
      const teacherRegs = [
        { id: 1, full_name: 'Ibrahim Mohammed', email: 'ibrahim.moh@email.com', phone: '+234 806 888 9999', date_of_birth: '1992-04-10', qualification: 'B.Sc Mathematics, PGDE', department_id: 1, department_name: 'Science Department', status: 'pending', created_at: new Date(Date.now() - 3600000 * 6).toISOString() },
        { id: 2, full_name: 'Sarah Longs', email: 'sarah.longs@email.com', phone: '+234 810 555 4444', date_of_birth: '1995-08-22', qualification: 'B.A English', department_id: 2, department_name: 'Arts Department', status: 'pending', created_at: new Date(Date.now() - 3600000 * 18).toISOString() },
      ];
      localStorage.setItem('sams_mock_teacher_regs', JSON.stringify(teacherRegs));

      // Seed Students
      const students = [
        { id: 1, admission_no: 'PAA-2023-0047', student_id_number: 'STD-2023-0047', first_name: 'Aisha', last_name: 'Mohammed', date_of_birth: '2011-06-12', gender: 'Female', email: 'aisha@email.com', username: 'aisha.mohammed', current_class: 'JSS 2', parent_name: 'Mohammed Yusuf', parent_phone: '+234 803 000 0011', parent_email: 'parent.mohammed@email.com', home_address: 'Anglo-Jos, Jos', status: 'active', unit_id: 3, created_at: '2023-09-01T08:00:00Z' },
        { id: 2, admission_no: 'PAA-2024-0112', student_id_number: 'STD-2024-0112', first_name: 'Ibrahim', last_name: 'Hassan', date_of_birth: '2008-10-15', gender: 'Male', email: 'ibrahim@email.com', username: 'ibrahim.hassan', current_class: 'SSS 2', parent_name: 'Hassan Umar', parent_phone: '+234 803 000 0022', parent_email: 'parent.hassan@email.com', home_address: 'Federal Lowcost, Jos', status: 'active', unit_id: 3, created_at: '2024-09-01T08:00:00Z' },
        { id: 3, admission_no: 'PAA-2024-0201', student_id_number: 'STD-2024-0201', first_name: 'Blessing', last_name: 'Musa', date_of_birth: '2012-03-24', gender: 'Female', email: 'blessing@email.com', username: 'blessing.musa', current_class: 'JSS 1', parent_name: 'Musa Dung', parent_phone: '+234 803 000 0033', parent_email: 'parent.musa@email.com', home_address: 'Bukuru, Jos', status: 'active', unit_id: 3, created_at: '2024-09-01T08:00:00Z' },
      ];
      localStorage.setItem('sams_mock_students', JSON.stringify(students));

      // Seed Staff
      const staff = [
        { id: 1, staff_id: 'PAA-ST-001', first_name: 'Samuel', last_name: 'Dung', email: 'samuel.dung@paa.edu.ng', username: 'samuel.dung', phone: '+234 800 000 0001', role: 'principal', unit_id: null, status: 'active', qualification: 'B.Sc Education, M.A Leadership', hire_date: '2005-01-15' },
        { id: 2, staff_id: 'PAA-ST-002', first_name: 'Amaka', last_name: 'Uche', email: 'amaka.uche@paa.edu.ng', username: 'amaka.uche', phone: '+234 800 000 0002', role: 'unit_head', unit_id: 3, status: 'active', qualification: 'B.Sc English, PGDE', hire_date: '2010-09-01' },
        { id: 7, staff_id: 'PAA-ST-007', first_name: 'Fatima', last_name: 'Sani', email: 'fatima.sani@paa.edu.ng', username: 'fatima.sani', phone: '+234 800 000 0007', role: 'teacher', unit_id: 3, status: 'active', qualification: 'B.Sc Biology, PGDE', hire_date: '2018-09-01' },
      ];
      localStorage.setItem('sams_mock_staff', JSON.stringify(staff));

      // Seed Announcements
      const announcements = [
        { id: 1, title: 'Academic Session 2025/2026 Resumption', body: 'The first term of 2025/2026 academic session will commence on Monday 15th September. All students are expected to be present.', target_role: 'all', is_pinned: 1, author: 'Samuel Dung', created_at: new Date(Date.now() - 3600000 * 24).toISOString() },
        { id: 2, title: 'Staff Meeting notice', body: 'All teachers and Unit Heads are required to attend a briefing session this Friday at 10:00 AM in the Principal\'s Office.', target_role: 'teacher', is_pinned: 0, author: 'Samuel Dung', created_at: new Date().toISOString() },
      ];
      localStorage.setItem('sams_mock_announcements', JSON.stringify(announcements));

      // Seed Messages
      const messages = [
        { id: 1, sender_name: 'Amaka Uche', sender_role: 'unit_head', recipient_id: 1, subject: 'Teacher Performance Evaluations', body: 'Good morning Sir, the evaluations for the Secondary Unit are complete. I have uploaded the report for your review.', is_read: 0, created_at: new Date(Date.now() - 3600000 * 2).toISOString() },
        { id: 2, sender_name: 'Fatima Sani', sender_role: 'teacher', recipient_id: 1, subject: 'Biology Syllabus Update', body: 'Dear Principal, we have successfully covered 90% of the SS 2 Biology curriculum this term. We are starting practicals next week.', is_read: 1, created_at: new Date(Date.now() - 3600000 * 12).toISOString() },
      ];
      localStorage.setItem('sams_mock_messages', JSON.stringify(messages));

      // Seed Notifications
      const notifications = [
        { id: 1, title: 'New Student Application', body: 'Daniel Gyang submitted an application for JSS 1 enrollment.', type: 'approval', is_read: 0, link: 'approvals', created_at: new Date().toISOString() },
      ];
      localStorage.setItem('sams_mock_notifications', JSON.stringify(notifications));

      // Seed Audit Logs
      const audit = [
        { id: 1, actor_name: 'System', action: 'STARTUP', description: 'Application initialized and seeded.', ip_address: '127.0.0.1', created_at: new Date().toISOString() },
      ];
      localStorage.setItem('sams_mock_audit', JSON.stringify(audit));

      // Seed School Settings
      const settings = {
        school_name: 'Plan Aid Academy',
        school_email: 'info@paa.edu.ng',
        school_phone: '+234 800 000 0000',
        school_address: 'Jos, Plateau State, Nigeria',
        current_academic_session: '2025/2026',
        current_term: '1st',
        registration_open: '1',
        teacher_registration_open: '1',
        student_registration_open: '1'
      };
      localStorage.setItem('sams_mock_settings', JSON.stringify(settings));

      // Seed Attendance
      const attendance = [
        { student_id: 1, class_id: 1, attendance_date: new Date().toISOString().split('T')[0], status: 'present' },
        { student_id: 2, class_id: 1, attendance_date: new Date().toISOString().split('T')[0], status: 'absent' }
      ];
      localStorage.setItem('sams_mock_attendance', JSON.stringify(attendance));

      // Seed Results
      const results = [
        { id: 1, student_id: 1, subject_id: 1, class_id: 1, academic_session: '2025/2026', term: '1st', continuous_assessment: 12, exam_score: 52, total_score: 64, grade: 'B', remark: 'Good effort', entered_by: 7, entered_at: new Date().toISOString() },
        { id: 2, student_id: 2, subject_id: 1, class_id: 1, academic_session: '2025/2026', term: '1st', continuous_assessment: 13, exam_score: 56, total_score: 69, grade: 'B', remark: 'Good effort', entered_by: 7, entered_at: new Date().toISOString() }
      ];
      localStorage.setItem('sams_mock_results', JSON.stringify(results));

      // Seed Assignments
      const assignments = [
        { id: 1, title: 'Cell Structure Labeling', description: 'Label the plant cell diagram and explain the function of the cell wall.', subject_id: 1, class_id: 1, teacher_id: 7, due_date: new Date(Date.now() + 3600000 * 24 * 5).toISOString().split('T')[0], academic_session: '2025/2026', term: '1st', max_score: 10, created_at: new Date().toISOString() },
        { id: 2, title: 'Photosynthesis Experiment Report', description: 'Write a 2-page report on light intensity vs rate of photosynthesis.', subject_id: 1, class_id: 2, teacher_id: 7, due_date: new Date(Date.now() + 3600000 * 24 * 7).toISOString().split('T')[0], academic_session: '2025/2026', term: '1st', max_score: 20, created_at: new Date().toISOString() }
      ];
      localStorage.setItem('sams_mock_assignments', JSON.stringify(assignments));

      // Seed Submissions
      const submissions = [
        { id: 1, assignment_id: 1, student_id: 1, submission_text: 'The cell wall provides structure and support to the cell.', attachment_path: '', submitted_at: new Date().toISOString(), score: 8, graded_by: 7, graded_at: new Date().toISOString(), feedback: 'Good labels!', status: 'graded' },
        { id: 2, assignment_id: 1, student_id: 2, submission_text: 'Here is my labeling project submission text.', attachment_path: '', submitted_at: new Date().toISOString(), score: null, graded_by: null, graded_at: null, feedback: '', status: 'submitted' }
      ];
      localStorage.setItem('sams_mock_submissions', JSON.stringify(submissions));

      localStorage.setItem('sams_mock_initialized', 'true');
    }
  }
};

MOCK_DB.init();

const API = {
  /** Core fetch with auth token */
  async request(endpoint, options = {}) {
    const token = Auth.getToken();
    const headers = {
      'Content-Type': 'application/json',
      ...(token ? { Authorization: `Bearer ${token}` } : {}),
      ...(options.headers || {}),
    };

    try {
      const res = await fetch(`${BASE_URL}/${endpoint}`, {
        ...options,
        headers,
      });

      // If 401 => session expired
      if (res.status === 401) {
        Auth.clear();
        window.location.href = BASE_URL + '/login?expired=1';
        return;
      }

      // Check if connection failed/500/404, fall back to mock
      if (!res.ok) {
        return MockAPI.handle(endpoint, options);
      }

      const data = await res.json();
      return data;
    } catch (err) {
      console.warn("API request failed. Falling back to Local Mock Database.", err);
      return MockAPI.handle(endpoint, options);
    }
  },

  async get(endpoint, params = {}) {
    const qs = new URLSearchParams(params).toString();
    return this.request(`${endpoint}${qs ? '?' + qs : ''}`);
  },

  async post(endpoint, body = {}) {
    return this.request(endpoint, { method: 'POST', body: JSON.stringify(body) });
  },

  async postForm(endpoint, formData) {
    // Convert FormData to simple JSON object for mock compatibility
    const bodyObj = {};
    formData.forEach((val, key) => {
      bodyObj[key] = val;
    });
    
    try {
      const token = Auth.getToken();
      const res = await fetch(`${BASE_URL}/${endpoint}`, {
        method: 'POST',
        headers: token ? { Authorization: `Bearer ${token}` } : {},
        body: formData,
      });
      if (res.status === 401) { Auth.clear(); window.location.href = BASE_URL + '/login?expired=1'; return; }
      if (!res.ok) return MockAPI.handle(endpoint, { method: 'POST', bodyObj });
      return res.json();
    } catch (e) {
      console.warn("API request failed. Falling back to Mock Database.", e);
      return MockAPI.handle(endpoint, { method: 'POST', bodyObj });
    }
  },

  // Convenience endpoints
  dashboard: {
    stats: () => API.get('api/dashboard.php'),
  },
  approvals: {
    list: (params) => API.get('api/approvals.php?action=list', params),
    get:  (id, type) => API.get('api/approvals.php?action=get', { id, type }),
    approve: (body) => API.post('api/approvals.php?action=approve', body),
    reject:  (body) => API.post('api/approvals.php?action=reject', body),
    requestCorrection: (body) => API.post('api/approvals.php?action=request_correction', body),
    history: (params) => API.get('api/approvals.php?action=history', params),
  },
  students: {
    list:   (params) => API.get('api/students.php?action=list', params),
    get:    (admNo)  => API.get('api/students.php?action=get', { admission_no: admNo }),
    update: (id, data) => API.post(`api/students.php?id=${id}`, data),
    create: (data) => API.post('api/students.php', data),
  },
  results: {
    get:        (params) => API.get('api/results.php?action=get', params),
    enterResult:(data)   => API.post('api/results.php', data),
    clasResults:(params) => API.get('api/results.php?action=class', params),
  },
  attendance: {
    list: (params)  => API.get('api/attendance.php', params),
    mark: (records) => API.post('api/attendance.php', records),
  },
  announcements: {
    list:   (params) => API.get('api/announcements.php?action=list', params),
    create: (data) => API.post('api/announcements.php?action=create', data),
    delete: (id) => API.post('api/announcements.php?action=delete', { id }),
  },
  messages: {
    inbox:  (params) => API.get('api/messages.php?action=inbox', params),
    send:   (data)   => API.post('api/messages.php?action=send', data),
    read:   (id)     => API.post('api/messages.php?action=read', { id }),
  },
  notifications: {
    list:   () => API.get('api/notifications.php?action=list'),
    markRead:(id) => API.post('api/notifications.php?action=read', { id }),
    markAll: () => API.post('api/notifications.php?action=read_all'),
  },
  audit: {
    list: (params) => API.get('api/audit.php?action=list', params),
  },
  departments: {
    list:   () => API.get('api/departments.php?action=list'),
    create: (data) => API.post('api/departments.php?action=create', data),
    update: (id, data) => API.post(`api/departments.php?action=update&id=${id}`, data),
  },
  assignments: {
    list:   (params) => API.get('api/assignments.php?action=list', params),
    create: (data) => API.post('api/assignments.php?action=create', data),
    grade:  (data) => API.post('api/assignments.php?action=grade', data),
    submissions: (params) => API.get('api/assignments.php?action=submissions', params),
  }
};

window.API = API;

/** Mock API Handler */
const MockAPI = {
  handle(endpoint, options) {
    const urlParts = endpoint.split('?');
    const path = urlParts[0];
    const qs = urlParts[1] ? new URLSearchParams(urlParts[1]) : new URLSearchParams();
    
    // Parse JSON body if applicable
    let body = {};
    if (options.bodyObj) {
      body = options.bodyObj;
    } else if (options.body) {
      try {
        body = JSON.parse(options.body);
      } catch(_) {}
    }

    // Router
    if (path.includes('api/auth.php')) {
      return this.auth(qs, body);
    } else if (path.includes('api/dashboard.php')) {
      return this.dashboard();
    } else if (path.includes('api/approvals.php')) {
      return this.approvals(qs, body);
    } else if (path.includes('api/students.php')) {
      return this.students(qs, body);
    } else if (path.includes('api/departments.php')) {
      return this.departments(qs, body);
    } else if (path.includes('api/announcements.php')) {
      return this.announcements(qs, body);
    } else if (path.includes('api/messages.php')) {
      return this.messages(qs, body);
    } else if (path.includes('api/notifications.php')) {
      return this.notifications(qs, body);
    } else if (path.includes('api/audit.php')) {
      return this.audit(qs);
    } else if (path.includes('api/register.php')) {
      return this.register(qs, body);
    } else if (path.includes('api/attendance.php')) {
      return this.attendance(qs, body, options);
    } else if (path.includes('api/results.php')) {
      return this.results(qs, body, options);
    } else if (path.includes('api/assignments.php')) {
      return this.assignments(qs, body, options);
    }

    return { status: 'error', message: 'Endpoint not found mock' };
  },

  // Auth mock
  auth(qs, body) {
    const action = qs.get('action') || 'login';
    const staffList = JSON.parse(localStorage.getItem('sams_mock_staff') || '[]');
    const studentList = JSON.parse(localStorage.getItem('sams_mock_students') || '[]');

    if (action === 'login') {
      const id = body.staff_id || '';
      let matched = staffList.find(s => s.staff_id === id || s.email === id);
      
      if (matched) {
        return {
          status: 'success',
          message: 'Login successful',
          data: {
            token: 'mock_token_' + matched.staff_id,
            staff_id: matched.staff_id,
            name: `${matched.first_name} ${matched.last_name}`,
            email: matched.email,
            role: matched.role,
            avatar_initials: matched.first_name[0] + matched.last_name[0]
          }
        };
      }

      // Try student matches
      matched = studentList.find(s => s.student_id_number === id || s.username === id || s.email === id);
      if (matched) {
        return {
          status: 'success',
          message: 'Login successful',
          data: {
            token: 'mock_token_' + matched.student_id_number,
            student_id: matched.student_id_number,
            name: `${matched.first_name} ${matched.last_name}`,
            email: matched.email,
            role: 'student',
            avatar_initials: matched.first_name[0] + matched.last_name[0]
          }
        };
      }

      return { status: 'error', message: 'Invalid credentials (Mock)' };
    }
    
    if (action === 'verify') {
      const token = qs.get('token') || '';
      const user_id = token.replace('mock_token_', '');
      
      let matched = staffList.find(s => s.staff_id === user_id);
      if (matched) {
        return { status: 'success', data: { valid: true, staff_id: matched.staff_id, name: matched.first_name + ' ' + matched.last_name, role: matched.role } };
      }

      matched = studentList.find(s => s.student_id_number === user_id);
      if (matched) {
        return { status: 'success', data: { valid: true, student_id: matched.student_id_number, name: matched.first_name + ' ' + matched.last_name, role: 'student' } };
      }

      return { status: 'error', message: 'Session expired' };
    }

    return { status: 'success', message: 'Mock action executed' };
  },

  // Dashboard Stats
  dashboard() {
    const students = JSON.parse(localStorage.getItem('sams_mock_students') || '[]');
    const staff = JSON.parse(localStorage.getItem('sams_mock_staff') || '[]');
    const studentRegs = JSON.parse(localStorage.getItem('sams_mock_student_regs') || '[]');
    const teacherRegs = JSON.parse(localStorage.getItem('sams_mock_teacher_regs') || '[]');
    const depts = JSON.parse(localStorage.getItem('sams_mock_departments') || '[]');
    const announcements = JSON.parse(localStorage.getItem('sams_mock_announcements') || '[]');
    const settings = JSON.parse(localStorage.getItem('sams_mock_settings') || '{}');
    const attendance = JSON.parse(localStorage.getItem('sams_mock_attendance') || '[]');

    const activeStudents = students.filter(s => s.status === 'active').length;
    const pendingStudents = studentRegs.filter(s => s.status === 'pending').length;
    const teachers = staff.filter(s => s.role === 'teacher');
    
    const today = new Date().toISOString().split('T')[0];
    const todayAttendance = attendance.filter(a => a.attendance_date === today);
    const presentCount = todayAttendance.filter(a => a.status === 'present').length;
    const absentCount = todayAttendance.filter(a => a.status === 'absent').length;

    return {
      status: 'success',
      data: {
        stats: {
          total_students: students.length,
          active_students: activeStudents,
          pending_students: pendingStudents,
          total_teachers: teachers.length,
          departments: depts.length,
          classes: 12,
          present_today: presentCount || 820, // Sample default to look good
          absent_today: absentCount || 34,
        },
        recent_student_registrations: studentRegs.filter(s => s.status === 'pending').slice(0, 5),
        recent_teacher_registrations: teacherRegs.filter(t => t.status === 'pending').slice(0, 5),
        enrollment_trend: [
          { month: '2026-01', count: 12 },
          { month: '2026-02', count: 18 },
          { month: '2026-03', count: 15 },
          { month: '2026-04', count: 22 },
          { month: '2026-05', count: 30 },
          { month: '2026-06', count: pendingStudents + activeStudents }
        ],
        recent_announcements: announcements.slice(0, 5),
        current_session: {
          session: settings.current_academic_session || '2025/2026',
          term: settings.current_term || '1st'
        }
      }
    };
  },

  // Approvals management
  approvals(qs, body) {
    const action = qs.get('action') || '';
    const type = qs.get('type') || body.type || 'student';
    const storageKey = type === 'teacher' ? 'sams_mock_teacher_regs' : 'sams_mock_student_regs';
    let list = JSON.parse(localStorage.getItem(storageKey) || '[]');

    if (action === 'list') {
      const status = qs.get('status') || 'pending';
      const search = qs.get('search') || '';
      let filtered = list;
      
      if (status !== 'all') {
        filtered = filtered.filter(item => item.status === status);
      }
      if (search) {
        filtered = filtered.filter(item => item.full_name.toLowerCase().includes(search.toLowerCase()) || item.email.toLowerCase().includes(search.toLowerCase()));
      }
      
      return {
        status: 'success',
        data: {
          total: filtered.length,
          limit: 10,
          offset: 0,
          data: filtered
        }
      };
    }

    if (action === 'get') {
      const id = parseInt(qs.get('id'));
      const matched = list.find(item => item.id === id);
      if (matched) {
        return { status: 'success', data: matched };
      }
      return { status: 'error', message: 'Application not found' };
    }

    if (action === 'approve') {
      const id = parseInt(body.id);
      const matchedIdx = list.findIndex(item => item.id === id);
      if (matchedIdx !== -1) {
        const item = list[matchedIdx];
        item.status = 'approved';
        item.approved_at = new Date().toISOString();
        
        const year = new Date().getFullYear();
        if (type === 'teacher') {
          const staffList = JSON.parse(localStorage.getItem('sams_mock_staff') || '[]');
          const employee_id = `TEA-${year}-${String(staffList.length + 1).padStart(4, '0')}`;
          item.employee_id = employee_id;
          item.username = item.full_name.toLowerCase().replace(' ', '.');
          
          staffList.push({
            id: staffList.length + 10,
            staff_id: employee_id,
            first_name: item.full_name.split(' ')[0],
            last_name: item.full_name.split(' ').slice(1).join(' ') || '-',
            email: item.email,
            username: item.username,
            phone: item.phone,
            role: 'teacher',
            status: 'active',
            qualification: item.qualification,
            department_id: item.department_id,
            hire_date: new Date().toISOString().split('T')[0]
          });
          localStorage.setItem('sams_mock_staff', JSON.stringify(staffList));
        } else {
          const studentList = JSON.parse(localStorage.getItem('sams_mock_students') || '[]');
          const student_id = `STD-${year}-${String(studentList.length + 1).padStart(4, '0')}`;
          item.student_id_generated = student_id;
          item.username = item.full_name.toLowerCase().replace(' ', '.');
          
          studentList.push({
            id: studentList.length + 10,
            admission_no: 'PAA-' + year + '-' + Math.floor(1000 + Math.random() * 9000),
            student_id_number: student_id,
            first_name: item.full_name.split(' ')[0],
            last_name: item.full_name.split(' ').slice(1).join(' ') || '-',
            date_of_birth: item.date_of_birth,
            gender: 'Male',
            email: item.email,
            username: item.username,
            current_class: item.class_name,
            parent_name: 'Parent Name',
            parent_phone: item.phone,
            status: 'active',
            unit_id: 3
          });
          localStorage.setItem('sams_mock_students', JSON.stringify(studentList));
        }

        list[matchedIdx] = item;
        localStorage.setItem(storageKey, JSON.stringify(list));

        // Create log entry
        this.addAuditLog('APPROVAL', `Approved ${type} application: ${item.full_name}`);
        return { status: 'success', message: 'Approved successfully', data: item };
      }
    }

    if (action === 'reject' || action === 'request_correction') {
      const id = parseInt(body.id);
      const matchedIdx = list.findIndex(item => item.id === id);
      if (matchedIdx !== -1) {
        list[matchedIdx].status = action === 'reject' ? 'rejected' : 'correction_requested';
        if (action === 'reject') list[matchedIdx].rejection_reason = body.reason;
        else list[matchedIdx].correction_comments = body.comments;
        
        localStorage.setItem(storageKey, JSON.stringify(list));
        this.addAuditLog(action.toUpperCase(), `Processed ${type} application ID: ${id}`);
        return { status: 'success', message: 'Processed successfully' };
      }
    }

    return { status: 'error', message: 'Operation not supported' };
  },

  // Students list/detail
  students(qs, body) {
    const action = qs.get('action') || '';
    let students = JSON.parse(localStorage.getItem('sams_mock_students') || '[]');

    if (action === 'list') {
      const search = qs.get('search') || '';
      const unit = qs.get('unit') || '';
      const status = qs.get('status') || 'active';
      
      let filtered = students;
      if (status) filtered = filtered.filter(s => s.status === status);
      if (unit) filtered = filtered.filter(s => String(s.unit_id) === String(unit));
      if (search) {
        filtered = filtered.filter(s => 
          s.admission_no.toLowerCase().includes(search.toLowerCase()) || 
          `${s.first_name} ${s.last_name}`.toLowerCase().includes(search.toLowerCase())
        );
      }

      return {
        status: 'success',
        data: {
          total: filtered.length,
          limit: 10,
          offset: 0,
          students: filtered
        }
      };
    }

    if (action === 'get') {
      const adm = qs.get('admission_no');
      const matched = students.find(s => s.admission_no === adm);
      if (matched) {
        return { status: 'success', data: { student: matched } };
      }
      return { status: 'error', message: 'Student not found' };
    }

    // Create student (POST)
    if (!action && body.first_name) {
      const newAdm = 'PAA-2026-' + Math.floor(1000 + Math.random() * 9000);
      const newStd = {
        id: students.length + 10,
        admission_no: newAdm,
        student_id_number: 'STD-2026-' + String(students.length + 1).padStart(4, '0'),
        first_name: body.first_name,
        last_name: body.last_name,
        date_of_birth: body.date_of_birth,
        gender: body.gender || 'Male',
        email: body.parent_email || '',
        username: `${body.first_name.toLowerCase()}.${body.last_name.toLowerCase()}`,
        current_class: body.current_class,
        parent_name: body.parent_name || '',
        parent_phone: body.parent_phone || '',
        parent_email: body.parent_email || '',
        home_address: body.home_address || '',
        status: 'active',
        unit_id: parseInt(body.unit_id)
      };
      students.push(newStd);
      localStorage.setItem('sams_mock_students', JSON.stringify(students));
      this.addAuditLog('CREATE_STUDENT', `Manually created student: ${newStd.first_name} ${newStd.last_name}`);
      return { status: 'success', data: newStd };
    }

    // Update student
    const updateId = parseInt(qs.get('id'));
    if (updateId) {
      const matchedIdx = students.findIndex(s => s.id === updateId);
      if (matchedIdx !== -1) {
        students[matchedIdx] = { ...students[matchedIdx], ...body };
        localStorage.setItem('sams_mock_students', JSON.stringify(students));
        this.addAuditLog('UPDATE_STUDENT', `Updated student profile ID: ${updateId}`);
        return { status: 'success', message: 'Student profile updated successfully' };
      }
    }

    return { status: 'error', message: 'Method not supported' };
  },

  // Departments List
  departments(qs, body) {
    const action = qs.get('action');
    let depts = JSON.parse(localStorage.getItem('sams_mock_departments') || '[]');

    if (action === 'list') {
      return { status: 'success', data: depts };
    }

    if (action === 'create') {
      const newDept = {
        id: depts.length + 1,
        name: body.name,
        code: body.code.toUpperCase(),
        description: body.description || '',
        Head: body.head || '—',
        is_active: 1
      };
      depts.push(newDept);
      localStorage.setItem('sams_mock_departments', JSON.stringify(depts));
      this.addAuditLog('CREATE_DEPT', `Created department: ${body.name}`);
      return { status: 'success', data: newDept };
    }

    if (action === 'update') {
      const id = parseInt(qs.get('id'));
      const idx = depts.findIndex(d => d.id === id);
      if (idx !== -1) {
        depts[idx] = { ...depts[idx], ...body };
        localStorage.setItem('sams_mock_departments', JSON.stringify(depts));
        this.addAuditLog('UPDATE_DEPT', `Updated department ID: ${id}`);
        return { status: 'success', message: 'Department updated successfully' };
      }
    }

    return { status: 'error', message: 'Action failed' };
  },

  // Announcements List
  announcements(qs, body) {
    const action = qs.get('action');
    let list = JSON.parse(localStorage.getItem('sams_mock_announcements') || '[]');

    if (action === 'list') {
      return { status: 'success', data: list };
    }
    if (action === 'create') {
      const newAnn = {
        id: list.length + 1,
        title: body.title,
        body: body.body,
        target_role: body.target_role || 'all',
        is_pinned: body.is_pinned ? 1 : 0,
        author: 'Principal',
        created_at: new Date().toISOString()
      };
      list.unshift(newAnn);
      localStorage.setItem('sams_mock_announcements', JSON.stringify(list));
      this.addAuditLog('CREATE_ANNOUNCEMENT', `Created announcement: ${body.title}`);
      return { status: 'success', data: newAnn };
    }
    if (action === 'delete') {
      const id = parseInt(body.id);
      list = list.filter(a => a.id !== id);
      localStorage.setItem('sams_mock_announcements', JSON.stringify(list));
      this.addAuditLog('DELETE_ANNOUNCEMENT', `Deleted announcement ID: ${id}`);
      return { status: 'success', message: 'Deleted successfully' };
    }
    return { status: 'error', message: 'Action failed' };
  },

  // Messages List
  messages(qs, body) {
    const action = qs.get('action');
    let list = JSON.parse(localStorage.getItem('sams_mock_messages') || '[]');

    if (action === 'inbox') {
      return { status: 'success', data: list };
    }
    if (action === 'send') {
      const newMsg = {
        id: list.length + 1,
        sender_name: 'Principal',
        sender_role: 'principal',
        recipient_id: parseInt(body.recipient_id) || 2,
        subject: body.subject,
        body: body.body,
        is_read: 0,
        created_at: new Date().toISOString()
      };
      list.unshift(newMsg);
      localStorage.setItem('sams_mock_messages', JSON.stringify(list));
      return { status: 'success', data: newMsg };
    }
    if (action === 'read') {
      const id = parseInt(body.id);
      const idx = list.findIndex(m => m.id === id);
      if (idx !== -1) {
        list[idx].is_read = 1;
        localStorage.setItem('sams_mock_messages', JSON.stringify(list));
      }
      return { status: 'success' };
    }
    return { status: 'error' };
  },

  // Notifications List
  notifications(qs, body) {
    const action = qs.get('action');
    let list = JSON.parse(localStorage.getItem('sams_mock_notifications') || '[]');

    if (action === 'list') {
      return { status: 'success', data: list };
    }
    if (action === 'read') {
      const id = parseInt(body.id);
      const idx = list.findIndex(n => n.id === id);
      if (idx !== -1) {
        list[idx].is_read = 1;
        localStorage.setItem('sams_mock_notifications', JSON.stringify(list));
      }
      return { status: 'success' };
    }
    if (action === 'read_all') {
      list.forEach(n => n.is_read = 1);
      localStorage.setItem('sams_mock_notifications', JSON.stringify(list));
      return { status: 'success' };
    }
    return { status: 'error' };
  },

  // Audit Log
  audit(qs) {
    const list = JSON.parse(localStorage.getItem('sams_mock_audit') || '[]');
    return {
      status: 'success',
      data: {
        total: list.length,
        limit: 50,
        offset: 0,
        data: list
      }
    };
  },

  // Public Registrations
  register(qs, body) {
    const type = qs.get('type') || 'student';
    const storageKey = type === 'teacher' ? 'sams_mock_teacher_regs' : 'sams_mock_student_regs';
    const list = JSON.parse(localStorage.getItem(storageKey) || '[]');
    
    const newReg = {
      id: list.length + 1,
      full_name: body.full_name,
      email: body.email,
      phone: body.phone,
      date_of_birth: body.date_of_birth,
      qualification: body.qualification || '',
      class_name: body.class_name || '',
      department_id: body.department_id ? parseInt(body.department_id) : null,
      department_name: body.department_name || '',
      status: 'pending',
      created_at: new Date().toISOString()
    };
    
    list.unshift(newReg);
    localStorage.setItem(storageKey, JSON.stringify(list));
    
    // Add a notification about it!
    const notifs = JSON.parse(localStorage.getItem('sams_mock_notifications') || '[]');
    notifs.unshift({
      id: notifs.length + 1,
      title: `New ${type === 'teacher' ? 'Teacher' : 'Student'} Application`,
      body: `${newReg.full_name} submitted a new registration application.`,
      type: 'approval',
      is_read: 0,
      link: type === 'teacher' ? 'approvals' : 'approvals',
      created_at: new Date().toISOString()
    });
    localStorage.setItem('sams_mock_notifications', JSON.stringify(notifs));

    return {
      status: 'success',
      message: 'Registration submitted successfully',
      data: { registration_id: newReg.id }
    };
  },

  // Attendance mock
  attendance(qs, body, options) {
    const list = JSON.parse(localStorage.getItem('sams_mock_attendance') || '[]');
    if (options && options.method === 'POST') {
      // Body is list of records
      const today = new Date().toISOString().split('T')[0];
      body.forEach(record => {
        const idx = list.findIndex(a => a.student_id === record.student_id && a.attendance_date === today);
        if (idx !== -1) {
          list[idx].status = record.status;
        } else {
          list.push({ student_id: record.student_id, class_id: record.class_id, attendance_date: today, status: record.status });
        }
      });
      localStorage.setItem('sams_mock_attendance', JSON.stringify(list));
      return { status: 'success', message: 'Attendance marked successfully' };
    }
    return { status: 'success', data: list };
  },

  results(qs, body, options) {
    const action = qs.get('action') || '';
    const list = JSON.parse(localStorage.getItem('sams_mock_results') || '[]');

    if (action === 'get' || action === 'class') {
      const classId = qs.get('class_id') || qs.get('class_name');
      const subjectId = qs.get('subject_id');
      const term = qs.get('term') || '1st';
      
      let filtered = list;
      if (classId) filtered = filtered.filter(r => String(r.class_id) === String(classId) || r.class_name === classId);
      if (subjectId) filtered = filtered.filter(r => String(r.subject_id) === String(subjectId));
      if (term) filtered = filtered.filter(r => r.term === term);

      return { status: 'success', data: filtered };
    }

    // POST score entry
    const records = Array.isArray(body) ? body : [body];
    records.forEach(rec => {
      const idx = list.findIndex(r => 
        String(r.student_id) === String(rec.student_id) && 
        String(r.subject_id) === String(rec.subject_id) && 
        r.term === (rec.term || '1st')
      );
      
      const total = parseFloat(rec.continuous_assessment || 0) + parseFloat(rec.exam_score || 0);
      let grade = 'F';
      if (total >= 70) grade = 'A';
      else if (total >= 60) grade = 'B';
      else if (total >= 50) grade = 'C';
      else if (total >= 40) grade = 'P';

      const entry = {
        id: idx !== -1 ? list[idx].id : list.length + 1,
        student_id: parseInt(rec.student_id),
        subject_id: parseInt(rec.subject_id || 1),
        class_id: parseInt(rec.class_id || 1),
        academic_session: rec.academic_session || '2025/2026',
        term: rec.term || '1st',
        continuous_assessment: parseFloat(rec.continuous_assessment || 0),
        exam_score: parseFloat(rec.exam_score || 0),
        total_score: total,
        grade,
        remark: rec.remark || (grade === 'A' || grade === 'B' ? 'Excellent' : 'Pass'),
        entered_by: 7,
        entered_at: new Date().toISOString()
      };

      if (idx !== -1) {
        list[idx] = entry;
      } else {
        list.push(entry);
      }
    });

    localStorage.setItem('sams_mock_results', JSON.stringify(list));
    return { status: 'success', message: 'Results saved successfully' };
  },

  assignments(qs, body, options) {
    const action = qs.get('action') || '';
    const list = JSON.parse(localStorage.getItem('sams_mock_assignments') || '[]');
    const subs = JSON.parse(localStorage.getItem('sams_mock_submissions') || '[]');

    if (action === 'list') {
      const teacherId = qs.get('teacher_id');
      let filtered = list;
      if (teacherId) filtered = filtered.filter(a => String(a.teacher_id) === String(teacherId));
      return { status: 'success', data: filtered };
    }

    if (action === 'submissions') {
      const assignmentId = qs.get('assignment_id');
      let filtered = subs;
      if (assignmentId) filtered = filtered.filter(s => String(s.assignment_id) === String(assignmentId));
      return { status: 'success', data: filtered };
    }

    if (action === 'create') {
      const newAsgn = {
        id: list.length + 1,
        title: body.title,
        description: body.description,
        subject_id: parseInt(body.subject_id || 1),
        class_id: parseInt(body.class_id || 1),
        teacher_id: 7,
        due_date: body.due_date,
        academic_session: '2025/2026',
        term: '1st',
        max_score: parseFloat(body.max_score || 100),
        created_at: new Date().toISOString()
      };
      list.push(newAsgn);
      localStorage.setItem('sams_mock_assignments', JSON.stringify(list));
      return { status: 'success', data: newAsgn };
    }

    if (action === 'grade') {
      const submissionId = parseInt(body.submission_id);
      const score = parseFloat(body.score);
      const feedback = body.feedback || '';

      const idx = subs.findIndex(s => s.id === submissionId);
      if (idx !== -1) {
        subs[idx].score = score;
        subs[idx].feedback = feedback;
        subs[idx].status = 'graded';
        subs[idx].graded_by = 7;
        subs[idx].graded_at = new Date().toISOString();
        localStorage.setItem('sams_mock_submissions', JSON.stringify(subs));
        return { status: 'success', message: 'Graded successfully' };
      }
      return { status: 'error', message: 'Submission not found' };
    }

    return { status: 'error', message: 'Action not supported' };
  },

  // Helper to append audit logs
  addAuditLog(action, description) {
    const list = JSON.parse(localStorage.getItem('sams_mock_audit') || '[]');
    list.unshift({
      id: list.length + 1,
      actor_name: 'Principal',
      action,
      description,
      ip_address: '127.0.0.1',
      created_at: new Date().toISOString()
    });
    localStorage.setItem('sams_mock_audit', JSON.stringify(list));
  }
};
