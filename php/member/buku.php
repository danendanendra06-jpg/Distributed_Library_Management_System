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
        <h2>Katalog Buku</h2>
        <input type="text" id="search" class="form-control" style="width: 300px;" placeholder="Cari buku...">
    </div>
    
    <div class="dashboard-grid" id="book-grid" style="grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));">
        <!-- populated by js -->
    </div>
</div>

<!-- Modal Pinjam -->
<div id="modalPinjam" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:100; align-items:center; justify-content:center;">
    <div class="card" style="width: 400px;">
        <div class="card-header">
            <h3>Pinjam Buku</h3>
            <button class="btn btn-outline" onclick="closeModal()">X</button>
        </div>
        <form id="formPinjam">
            <input type="hidden" id="idBuku">
            <div class="form-group">
                <label>Judul Buku</label>
                <input type="text" id="judulBuku" class="form-control" readonly>
            </div>
            <div class="form-group">
                <label>Lama Pinjam (Hari)</label>
                <input type="number" id="lamaPinjam" class="form-control" value="7" min="1" max="14" required>
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%">Konfirmasi Pinjam</button>
        </form>
    </div>
</div>

<script>
let allBooks = [];

async function loadBooks() {
    allBooks = await fetchAPI('/buku');
    renderBooks(allBooks);
}

function renderBooks(books) {
    const grid = document.getElementById('book-grid');
    grid.innerHTML = '';
    
    books.forEach(b => {
        const div = document.createElement('div');
        div.className = 'card';
        div.style.padding = '1rem';
        div.style.marginBottom = '0';
        
        // Use generic image if not set
        const img = (b.gambarBuku && b.gambarBuku !== '-' && b.gambarBuku !== 'null') 
            ? '/Project4_DTS/img/' + b.gambarBuku // Assuming logic for image path
            : 'https://via.placeholder.com/150?text=No+Image';

        div.innerHTML = `
            <div style="height:150px; background:#eee; display:flex; align-items:center; justify-content:center; margin-bottom:10px; border-radius:5px; overflow:hidden;">
                <span style="font-size:2rem; color:#ccc;"><i class="fas fa-book"></i></span>
            </div>
            <h4 style="font-size:1rem; margin-bottom:0.5rem;">${b.judul}</h4>
            <p style="font-size:0.8rem; color:#666;">${b.pengarang}</p>
            <p style="font-size:0.8rem; color:#666; margin-bottom:1rem;">Stok: ${b.jumlah}</p>
            <button class="btn btn-primary btn-sm" style="width:100%" onclick='openPinjam(${JSON.stringify(b)})' ${b.jumlah < 1 ? 'disabled' : ''}>
                ${b.jumlah < 1 ? 'Habis' : 'Pinjam'}
            </button>
        `;
        grid.appendChild(div);
    });
}

// Search
document.getElementById('search').addEventListener('input', (e) => {
    const term = e.target.value.toLowerCase();
    const filtered = allBooks.filter(b => b.judul.toLowerCase().includes(term) || b.pengarang.toLowerCase().includes(term));
    renderBooks(filtered);
});

function openPinjam(book) {
    document.getElementById('modalPinjam').style.display = 'flex';
    document.getElementById('idBuku').value = book.idBuku;
    document.getElementById('judulBuku').value = book.judul;
}

function closeModal() {
    document.getElementById('modalPinjam').style.display = 'none';
}

document.getElementById('formPinjam').addEventListener('submit', async (e) => {
    e.preventDefault();
    const idBuku = document.getElementById('idBuku').value;
    const lama = parseInt(document.getElementById('lamaPinjam').value);
    
    // Calculate dates
    const today = new Date();
    const tglPinjam = today.toISOString().slice(0, 10);
    
    const balikDate = new Date();
    balikDate.setDate(today.getDate() + lama);
    const tglBalik = balikDate.toISOString().slice(0, 10);
    
    // Generate Random Pinjam ID (PJ + Random 3 digits)
    const pid = 'PJ' + Math.floor(Math.random() * 1000).toString().padStart(3, '0');
    
    const data = {
        pinjamId: pid,
        idMember: <?php echo $_SESSION['user_id'] ?? 0; ?>,
        idBuku: parseInt(idBuku),
        status: 'Dipinjam',
        tglPinjam: tglPinjam,
        lamaPinjam: lama,
        tglBalik: tglBalik,
        tglKembali: null // Not returned yet
    };
    
    const res = await fetchAPI('/pinjam', 'POST', data);
    if(res && res.idPinjam) {
        showAlert('Berhasil meminjam buku!', 'success');
        closeModal();
        loadBooks(); // refresh stock logic if implemented, though stock decrement needs backend logic mostly.
    } else {
        showAlert('Gagal meminjam.', 'danger');
    }
});

loadBooks();
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
