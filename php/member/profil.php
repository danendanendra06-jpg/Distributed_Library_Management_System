<?php
require_once __DIR__ . '/../includes/header.php';
// Access check: Member
if (!isset($_SESSION['user_token'])) {
    header("Location: ../auth/login.php");
    exit;
}
?>

<div class="card">
    <div class="card-header">
        <h2>Profil Saya</h2>
    </div>
    <div class="card-body">
        <form id="profileForm">
            <input type="hidden" id="idMember">
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" id="nama" class="form-control" readonly style="background-color: #f0f0f0;">
            </div>
            <div class="form-group">
                <label>Username</label>
                <input type="text" id="username" class="form-control" readonly style="background-color: #f0f0f0;">
            </div>
             <div class="form-group">
                <label>Email</label>
                <input type="email" id="email" class="form-control" placeholder="Belum diisi">
            </div>
             <div class="form-group">
                <label>Tanggal Lahir</label>
                <input type="date" id="tglLahir" class="form-control">
            </div>
            <div class="form-group">
                <label>Nomor Telepon</label>
                <input type="text" id="telepon" class="form-control">
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <textarea id="alamat" class="form-control" rows="3"></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
</div>

<script>
async function loadProfile() {
    // Get ID from Session via Header or parse token
    // Since session id is stored in PHP session, we can echo it or use "me" endpoint if available.
    // For now, let's assume we can get it from the session stored in window from header logic or just fetch all members and filter (inefficient but works for now as member endpoint is public-ish)
    // BETTER: Use the ID we stored in session.
    const myId = <?php echo $_SESSION['user_id'] ?? 0; ?>;
    
    const member = await fetchAPI(`/member/${myId}`);
    
    if(member) {
        document.getElementById('idMember').value = member.idMember;
        document.getElementById('nama').value = member.namaLengkap;
        document.getElementById('username').value = member.username;
        document.getElementById('email').value = member.email || '';
        document.getElementById('tglLahir').value = member.tglLahir || '';
        document.getElementById('telepon').value = member.nomorTelepon;
        document.getElementById('alamat').value = member.alamat;
    }
}

document.getElementById('profileForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const id = document.getElementById('idMember').value;
    
    // Construct Object matching Java Entity
    const data = {
        idMember: id,
        namaLengkap: document.getElementById('nama').value,
        username: document.getElementById('username').value,
        // Password not updated here, careful to not overwrite with null if backend logic isn't perfect
        // In MemberController/Service, usually it updates all fields. 
        // We need to make sure we don't break password. 
        // Ideally backend logic handles "if null keep old". 
        // Let's assume user doesn't change password here for now.
        email: document.getElementById('email').value,
        tglLahir: document.getElementById('tglLahir').value,
        nomorTelepon: document.getElementById('telepon').value,
        alamat: document.getElementById('alamat').value
    };
    
    // Fetch old data to keep password? Or trust backend.
    // Let's safe fetch first.
    const old = await fetchAPI(`/member/${id}`);
    if(old) {
        data.password = old.password; // Keep old password
    }

    const res = await fetchAPI(`/member/${id}`, 'PUT', data);
    if(res) {
        showAlert('Profil berhasil diperbarui!', 'success');
        loadProfile();
    }
});

loadProfile();
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
