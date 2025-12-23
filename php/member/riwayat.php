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

<!-- Modal Edit Peminjaman -->
<div id="modalEdit" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:100; align-items:center; justify-content:center;">
    <div class="card" style="width: 400px;">
        <div class="card-header">
            <h3>Edit Peminjaman</h3>
            <button class="btn btn-outline" onclick="closeEditModal()">X</button>
        </div>
        <form id="formEdit">
            <input type="hidden" id="editPinjamId">
            <div class="form-group">
                <label>Judul Buku</label>
                <input type="text" id="editJudul" class="form-control" readonly style="background-color: #eee;">
            </div>
            <div class="form-group">
                <label>Lama Pinjam (Hari)</label>
                <input type="number" id="editLama" class="form-control" min="1" max="30" required>
                <small>Ubah durasi peminjaman</small>
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%">Simpan Perubahan</button>
        </form>
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
        // Find denda
        const myDenda = dendas ? dendas.find(d => d.pinjamId === l.pinjamId) : null;
        const dendaText = myDenda ? formatRupiah(myDenda.denda || 0, 'Rp. ') : '-';
        
        const isDipinjam = l.status === 'Dipinjam';
        
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>${l.pinjamId}</td>
            <td>${bukuMap[l.idBuku] || l.idBuku}</td>
            <td>${l.tglPinjam}</td>
            <td>${l.tglBalik} (Lama: ${l.lamaPinjam} hari)</td>
            <td>${l.tglKembali || '-'}</td>
            <td>
                <span class="btn btn-sm ${!isDipinjam ? 'btn-secondary' : 'btn-primary'}">
                    ${l.status}
                </span>
            </td>
            <td style="color: ${myDenda ? 'red' : 'inherit'}">${dendaText}</td>
            <td>
                ${isDipinjam ? `<button class="btn btn-warning btn-sm" onclick='openEditLoan(${JSON.stringify(l)}, "${bukuMap[l.idBuku] || ''}")'>Edit</button>` : ''}
            </td>
        `;
        tbody.appendChild(tr);
    });
}

// Edit Logic
function openEditLoan(loan, judulBuku) {
    document.getElementById('modalEdit').style.display = 'flex';
    document.getElementById('editPinjamId').value = loan.pinjamId;
    document.getElementById('editJudul').value = judulBuku;
    document.getElementById('editLama').value = loan.lamaPinjam;
    // Store original data
    window.currentLoan = loan;
}

function closeEditModal() {
    document.getElementById('modalEdit').style.display = 'none';
}

document.getElementById('formEdit').addEventListener('submit', async (e) => {
    e.preventDefault();
    const pid = document.getElementById('editPinjamId').value;
    const newLama = parseInt(document.getElementById('editLama').value);
    
    // Recalculate Tgl Balik
    const tglPinjam = new Date(window.currentLoan.tglPinjam);
    const balikDate = new Date(tglPinjam);
    balikDate.setDate(tglPinjam.getDate() + newLama);
    const newTglBalik = balikDate.toISOString().slice(0, 10);
    
    // Construct update data (keep other fields same)
    const data = {
        pinjamId: pid,
        idMember: window.currentLoan.idMember,
        idBuku: window.currentLoan.idBuku,
        status: window.currentLoan.status,
        tglPinjam: window.currentLoan.tglPinjam,
        lamaPinjam: newLama,
        tglBalik: newTglBalik,
        tglKembali: window.currentLoan.tglKembali
    };
    
    const res = await fetchAPI(`/pinjam/${pid}`, 'PUT', data);
    if(res) {
        showAlert('Berhasil mengubah durasi peminjaman!', 'success');
        closeEditModal();
        loadData();
    }
});

loadData();
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
