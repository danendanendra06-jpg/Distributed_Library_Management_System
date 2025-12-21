<?php
require_once __DIR__ . '/../includes/header.php';
?>

<div class="auth-wrapper">
    <div class="auth-card">
        <h2 class="auth-title">Reset Password</h2>
        <div class="alert alert-info" style="font-size: 0.9rem; color: #666; margin-bottom: 20px;">
            Masukkan username Anda dan password baru. Sistem akan mencari akun dan memperbarui password jika username ditemukan.
        </div>
        
        <form id="resetForm">
            <div class="form-group">
                <label class="form-label">Username</label>
                <input type="text" id="username" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Password Baru</label>
                <input type="password" id="newPassword" class="form-control" required placeholder="Minimal 6 karakter">
            </div>
            
             <div class="form-group">
                <label class="form-label">Konfirmasi Password</label>
                <input type="password" id="confirmPassword" class="form-control" required>
            </div>
            
            <button type="submit" class="btn btn-warning" style="width: 100%; color: white;">Reset Password</button>
        </form>
        
        <div style="margin-top: 1.5rem; text-align: center;">
            <a href="login.php" class="btn btn-outline btn-sm">Kembali ke Login</a>
        </div>
    </div>
</div>

<script>
document.getElementById('resetForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const username = document.getElementById('username').value;
    const newPass = document.getElementById('newPassword').value;
    const confirmPass = document.getElementById('confirmPassword').value;
    
    if (newPass !== confirmPass) {
        showAlert('Password tidak sama!', 'danger');
        return;
    }
    
    // Logic: Try to find Member with this username, then update.
    // If not found, try Petugas.
    
    try {
        let foundType = null;
        let userData = null;
        
        // 1. Check Petugas (Admin) - fetch all and find (inefficient but consistent with current API)
        const petugasList = await fetchAPI('/petugas');
        const petugas = petugasList.find(p => p.user === username);
        
        if (petugas) {
            foundType = 'petugas';
            userData = petugas;
            userData.pass = newPass; // Update password
        } else {
            // 2. Check Member
            const memberList = await fetchAPI('/member'); // Client side filter again
            const member = memberList.find(m => m.username === username);
            if (member) {
                foundType = 'member';
                userData = member;
                userData.password = newPass;
            }
        }
        
        if (foundType && userData) {
            // Perform Update
            // NOTE: Updated from idLogin to idPetugas for Petugas type
            const id = (foundType === 'petugas') ? userData.idPetugas : userData.idMember;
            const endpoint = (foundType === 'petugas') ? `/petugas/${id}` : `/member/${id}`;
            
            const res = await fetchAPI(endpoint, 'PUT', userData);
            if (res) {
                showAlert('Password berhasil direset! Silakan login.', 'success');
                setTimeout(() => window.location.href = 'login.php', 2000);
            }
        } else {
            showAlert('Username tidak ditemukan.', 'danger');
        }
        
    } catch (err) {
        console.error(err);
        showAlert('Terjadi kesalahan.', 'danger');
    }
});
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
