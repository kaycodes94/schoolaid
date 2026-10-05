<?php
/**
 * Auto Login Helper — Instantly authenticates as Principal and lands on Principal Dashboard
 */

require_once __DIR__ . '/config/Database.php';
require_once __DIR__ . '/includes/Helpers.php';

try {
    $db = new Database();
    $staff = $db->fetch("SELECT * FROM staff WHERE staff_id = ? OR role = 'principal' LIMIT 1", ['PAA-ST-001']);

    if (!$staff) {
        die('Principal account not found in database.');
    }

    $token = Utilities::generateToken();
    $sessionData = [
        'staff_id' => $staff['id'],
        'session_token' => $token,
        'ip_address' => $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1',
        'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'AutoLogin'
    ];

    $db->insert('login_sessions', $sessionData);

    $userData = [
        'token' => $token,
        'staff_id' => $staff['staff_id'],
        'name' => $staff['first_name'] . ' ' . $staff['last_name'],
        'email' => $staff['email'],
        'role' => $staff['role'],
        'avatar_initials' => substr($staff['first_name'], 0, 1) . substr($staff['last_name'], 0, 1)
    ];

    $jsonUser = json_encode($userData, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);

} catch (Exception $e) {
    die('Auto login failed: ' . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Logging in to Principal Portal...</title>
  <style>
    body { font-family: system-ui, sans-serif; background: #0f172a; color: #fff; display: flex; align-items: center; justify-content: center; height: 100vh; margin: 0; }
    .loader { text-align: center; }
    .spinner { width: 40px; height: 40px; border: 4px solid rgba(255,255,255,0.1); border-top-color: #38bdf8; border-radius: 50%; animation: spin 1s infinite linear; margin: 0 auto 16px; }
    @keyframes spin { 100% { transform: rotate(360deg); } }
  </style>
</head>
<body>
  <div class="loader">
    <div class="spinner"></div>
    <h2>Authenticating as Principal...</h2>
    <p>Redirecting to Principal Dashboard</p>
  </div>

  <script>
    const token = "<?php echo $token; ?>";
    const user = <?php echo $jsonUser; ?>;

    sessionStorage.setItem('sams_token', token);
    sessionStorage.setItem('sams_user', JSON.stringify(user));
    localStorage.setItem('sams_token', token);
    localStorage.setItem('sams_user', JSON.stringify(user));

    window.location.href = 'dashboard/principal/index.php';
  </script>
</body>
</html>
