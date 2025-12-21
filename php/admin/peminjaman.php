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
        <h2>Data Peminjaman</h2>
    </div>
    
    <div class="table-responsive">
        <table class="table" id="table-pinjam">
            <thead>
                <tr>
                    <th>ID Pinjam</th>
                    <th>Member</th>
                    <th>Buku</th>
                    <th>Tgl Pinjam</th>
                    <th>Tgl Balik (Due)</th>
                    <th>Tgl Kembali (Real)</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<script>
// Maps
let memberMap = {};
let bukuMap = {};

async function loadData() {
    // Fetch dependencies
    const [members, bukus, loans] = await Promise.all([
        fetchAPI('/member'),
        fetchAPI('/buku'),
        fetchAPI('/pinjam')
    ]);

    members.forEach(m => memberMap[m.idMember] = m.namaLengkap);
    bukus.forEach(b => bukuMap[b.idBuku] = b.judul);

    const tbody = document.querySelector('#table-pinjam tbody');
    tbody.innerHTML = '';

    loans.forEach(p => {
        const tr = document.createElement('tr');
        const isActive = p.status !== 'Dikembalikan';
        
        tr.innerHTML = `
            <td>${p.pinjamId}</td>
            <td>${memberMap[p.idMember] || p.idMember}</td>
            <td>${bukuMap[p.idBuku] || p.idBuku}</td>
            <td>${p.tglPinjam}</td>
            <td>${p.tglBalik}</td>
            <td>${p.tglKembali || '-'}</td>
            <td><span class="btn btn-sm ${isActive ? 'btn-secondary' : 'btn-outline'}">${p.status}</span></td>
            <td>
                ${isActive ? `<button class="btn btn-primary btn-sm" onclick="returnBook(${p.idPinjam}, '${p.pinjamId}', ${p.idMember}, ${p.idBuku}, '${p.tglPinjam}', '${p.tglBalik}', ${p.lamaPinjam})">Kembalikan</button>` : 'Selesai'}
            </td>
        `;
        tbody.appendChild(tr);
    });
}

async function returnBook(id, pinjamId, idMember, idBuku, tglPinjam, tglBalik, lamaPinjam) {
    if(!confirm('Proses pengembalian buku?')) return;
    
    // We update the status and tglKembali
    const today = new Date().toISOString().slice(0, 10);
    
    const data = {
        idPinjam: id,
        pinjamId: pinjamId,
        idMember: idMember,
        idBuku: idBuku,
        status: 'Dikembalikan', // Trigger trigger DB
        tglPinjam: tglPinjam,
        tglBalik: tglBalik,
        tglKembali: today,
        lamaPinjam: lamaPinjam
    };
    
    await fetchAPI(`/pinjam/${id}`, 'PUT', data);
    loadData();
}

loadData();
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
