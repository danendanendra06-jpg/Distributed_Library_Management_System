<?php
require_once __DIR__ . '/../includes/header.php';
if (!isset($_SESSION['user_role']) || ($_SESSION['user_role'] !== 'Petugas' && $_SESSION['user_role'] !== 'admin')) {
    header("Location: ../auth/login.php"); exit;
}
?>
<div class="card">
    <div class="card-header">
        <h2>Data Denda</h2>
    </div>
    <div class="table-responsive">
        <table class="table" id="table-denda">
            <thead>
                <tr>
                    <th>ID Pinjam</th>
                    <th>Member</th>
                    <th>Nominal</th>
                    <th>Lama Terlambat (Hari)</th>
                    <th>Tgl Denda</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
<script>
let memberMap = {};
async function loadData() {
    const [dendaListData, loansData, membersData] = await Promise.all([
        fetchAPI('/denda'),
        fetchAPI('/pinjam'),
        fetchAPI('/member')
    ]);
    
    const dendaList = dendaListData || [];
    const loans = loansData || [];
    const members = membersData || [];
    
    // Create optimized map for PINJAM ID -> Member ID
    let loanMemberMap = {};
    loans.forEach(l => loanMemberMap[l.pinjamId] = l.idMember);
    
    // Member Map
    members.forEach(m => memberMap[m.idMember] = m.namaLengkap);

    const tbody = document.querySelector('#table-denda tbody');
    tbody.innerHTML = '';
    
    dendaList.forEach(d => {
        const memId = loanMemberMap[d.pinjamId];
        const memName = memId ? (memberMap[memId] || memId) : 'Unknown';
        
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>${d.pinjamId}</td>
            <td>${memName}</td>
            <td>${formatRupiah(d.denda, 'Rp. ')}</td>
            <td>${d.lamaWaktu}</td>
            <td>${d.tglDenda}</td>
        `;
        tbody.appendChild(tr);
    });
}
loadData();
</script>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
