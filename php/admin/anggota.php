<?php
require_once __DIR__ . '/../includes/header.php';
// Access check
if (!isset($_SESSION['user_role']) || ($_SESSION['user_role'] !== 'Petugas' && $_SESSION['user_role'] !== 'admin')) {
    header("Location: ../auth/login.php");
    exit;
}
?>

<div class="card">
    <div class="card-header">
        <h2>Data Anggota (Member)</h2>
    </div>
    <div class="table-responsive">
        <table class="table" id="table-member">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Telepon</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<script>
async function loadData() {
    const members = await fetchAPI('/member') || [];
    const tbody = document.querySelector('#table-member tbody');
    tbody.innerHTML = '';
    
    members.forEach(m => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>${m.namaLengkap}</td>
            <td>${m.username}</td>
            <td>${m.nomorTelepon}</td>
            <td>${m.alamat}</td>
            <td>
                <button class="btn btn-danger btn-sm" onclick="deleteMember(${m.idMember})">Hapus</button>
            </td>
        `;
        tbody.appendChild(tr);
    });
}

async function deleteMember(id) {
    if(confirm('Hapus anggota ini?')) {
        await fetchAPI(`/member/${id}`, 'DELETE');
        loadData();
    }
}

loadData();
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
