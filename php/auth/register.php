<?php
// register.php
require_once __DIR__ . '/../includes/header.php';
?>

<div class="auth-wrapper">
    <div class="auth-card" style="max-width: 500px;">
        <h2 class="auth-title">Pendaftaran Anggota</h2>
        
        <form id="registerForm">
            <div class="form-group">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" id="namaLengkap" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Username</label>
                <input type="text" id="username" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" id="password" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Nomor Telepon</label>
                <input type="text" id="nomorTelepon" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Alamat</label>
                <textarea id="alamat" class="form-control" rows="3"></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary" style="width: 100%;">Daftar Sekarang</button>
        </form>
        
        <div style="margin-top: 1.5rem; text-align: center;">
            <p>Sudah punya akun? <a href="login.php" style="color: var(--primary-color); font-weight: 600;">Masuk</a></p>
        </div>
    </div>
</div>

<script>
document.getElementById('registerForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const data = {
        namaLengkap: document.getElementById('namaLengkap').value,
        username: document.getElementById('username').value,
        password: document.getElementById('password').value,
        nomorTelepon: document.getElementById('nomorTelepon').value,
        alamat: document.getElementById('alamat').value
    };
    
    // Call Java API
    const result = await fetchAPI('/auth/register', 'POST', data);
    
    if (result && result.idMember) {
        showAlert('Pendaftaran Berhasil! Silakan Login.', 'success');
        setTimeout(() => {
            window.location.href = 'login.php';
        }, 2000);
    } else {
        showAlert('Gagal mendaftar. Username mungkin sudah digunakan.', 'danger');
    }
});
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
