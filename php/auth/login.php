<?php
// login.php
require_once __DIR__ . '/../includes/header.php';

// If already logged in, redirect
if (isset($_SESSION['user_token'])) {
    if ($_SESSION['user_role'] === 'Petugas' || $_SESSION['user_role'] === 'admin') {
        echo "<script>window.location.href='/Project4_DTS/php/admin/dashboard.php';</script>";
    } else {
        echo "<script>window.location.href='/Project4_DTS/php/member/index.php';</script>";
    }
    exit;
}
?>

<div class="auth-wrapper">
    <div class="auth-card">
        <h2 class="auth-title">Masuk ke Perpustakaan</h2>
        
        <form id="loginForm">
            <div class="form-group">
                <label class="form-label">Username</label>
                <input type="text" id="username" class="form-control" required placeholder="Masukkan username">
            </div>
            
            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" id="password" class="form-control" required placeholder="Masukkan password">
            </div>
            
            <button type="submit" class="btn btn-primary" style="width: 100%;">Masuk</button>
        </form>
        
        <div style="margin-top: 1.5rem; text-align: center; font-size: 0.875rem;">
            <p>Belum punya akun? <a href="register.php" style="color: var(--primary-color); font-weight: 600;">Daftar disini</a></p>
            <p style="margin-top: 0.5rem;"><a href="forgot-password.php" style="color: var(--text-muted);">Lupa password?</a></p>
        </div>
    </div>
</div>

<script>
document.getElementById('loginForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const usernameInput = document.getElementById('username').value;
    const passwordInput = document.getElementById('password').value;
    
    // Call Java API directly
    const result = await fetchAPI('/auth/login', 'POST', {
        username: usernameInput,
        password: passwordInput
    });
    
    if (result && result.status === 'success') {
        // Success: Now set PHP session via a small AJAX helper
        const sessionFormData = new FormData();
        sessionFormData.append('token', result.token);
        sessionFormData.append('role', result.role);
        sessionFormData.append('user_data', JSON.stringify(result.user));
        
        // We create a temporary endpoint to set PHP session
        try {
            const phpSession = await fetch('/Project4_DTS/php/auth/set_session.php', {
                method: 'POST',
                body: sessionFormData
            });
            
            if (phpSession.ok) {
                showAlert('Login berhasil! Mengalihkan...', 'success');
                setTimeout(() => {
                    if (result.role === 'Petugas' || result.role === 'admin') {
                        window.location.href = '/Project4_DTS/php/admin/dashboard.php';
                    } else {
                        window.location.href = '/Project4_DTS/php/member/index.php';
                    }
                }, 1000);
            }
        } catch (err) {
            console.error(err);
        }
    } else {
        showAlert(result.message || 'Login gagal', 'danger');
    }
});
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
