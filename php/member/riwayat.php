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
        <h2>Riwayat Peminjaman</h2>
    </div>
    
    <div class="table-responsive">
        <table class="table" id="table-riwayat">
            <thead>
                <tr>
                    <th>ID Pinjam</th>
                    <th>Buku</th>
                    <th>Tgl Pinjam</th>
                    <th>Tgl Balik</th>
                    <th>Tgl Kembali</th>
                    <th>Status</th>
                    <th>Denda</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<script>
async function loadData() {
    const myId = <?php echo $_SESSION['user_id'] ?? 0; ?>;
    
    const [loans, bukus, dendas] = await Promise.all([
        fetchAPI('/pinjam'),
        fetchAPI('/buku'),
        fetchAPI('/denda') // If denda API exists, logic might need checking
    ]);
    
    // Create map for books
    let bukuMap = {};
    bukus.forEach(b => bukuMap[b.idBuku] = b.judul);
    
    // Filter my loans
    const myLoans = loans.filter(l => l.idMember === myId);
    
    const tbody = document.querySelector('#table-riwayat tbody');
    tbody.innerHTML = '';
    
    myLoans.forEach(l => {
        // Find denda if any
        // Logic: tbl_denda has pinjam_id (string)
        const myDenda = dendas ? dendas.find(d => d.pinjamId === l.pinjamId) : null;
        const dendaText = myDenda ? formatRupiah(myDenda.denda || 0, 'Rp. ') : '-';
        
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>${l.pinjamId}</td>
            <td>${bukuMap[l.idBuku] || l.idBuku}</td>
            <td>${l.tglPinjam}</td>
            <td>${l.tglBalik}</td>
            <td>${l.tglKembali || '-'}</td>
            <td>
                <span class="btn btn-sm ${l.status === 'Dikembalikan' ? 'btn-secondary' : 'btn-primary'}">
                    ${l.status}
                </span>
            </td>
            <td style="color: ${myDenda ? 'red' : 'inherit'}">${dendaText}</td>
        `;
        tbody.appendChild(tr);
    });
}

loadData();
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
