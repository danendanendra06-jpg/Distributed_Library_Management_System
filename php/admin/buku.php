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
        <h2>Manajemen Buku</h2>
        <button class="btn btn-primary" onclick="openModal()">+ Tambah Buku</button>
    </div>
    
    <div class="table-responsive">
        <table class="table" id="table-buku">
            <thead>
                <tr>
                    <th>ISBN</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Pengarang</th>
                    <th>Penerbit</th>
                    <th>Tahun</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Populated by JS -->
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div id="modalForm" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:100; align-items:center; justify-content:center;">
    <div class="card" style="width: 500px; max-height: 90vh; overflow-y: auto;">
        <div class="card-header">
            <h3 id="modalTitle">Tambah Buku</h3>
            <button class="btn btn-outline" onclick="closeModal()">X</button>
        </div>
        <form id="formBuku">
            <input type="hidden" id="idBuku">
            <div class="form-group">
                <label class="form-label">ISBN</label>
                <input type="text" id="isbn" class="form-control" required>
            </div>
            <div class="form-group">
                <label class="form-label">Judul</label>
                <input type="text" id="judul" class="form-control" required>
            </div>
            <div class="form-group">
                <label class="form-label">Kategori</label>
                <select id="idKategori" class="form-control" required>
                    <!-- Options -->
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Pengarang</label>
                <input type="text" id="pengarang" class="form-control">
            </div>
            <div class="form-group">
                <label class="form-label">Penerbit</label>
                <input type="text" id="penerbit" class="form-control">
            </div>
            <div class="form-group">
                <label class="form-label">Tahun</label>
                <input type="text" id="tahunBuku" class="form-control">
            </div>
            <div class="form-group">
                <label class="form-label">Jumlah Stok</label>
                <input type="number" id="jumlah" class="form-control" required>
            </div>
            <div class="form-group" style="text-align: right;">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
let categoriesMap = {};

async function loadData() {
    // Fetch Categories first for mapping
    const categories = await fetchAPI('/kategori');
    const select = document.getElementById('idKategori');
    select.innerHTML = '';
    categories.forEach(c => {
        categoriesMap[c.idKategori] = c.namaKategori;
        const opt = document.createElement('option');
        opt.value = c.idKategori;
        opt.textContent = c.namaKategori;
        select.appendChild(opt);
    });

    // Fetch Books
    const books = await fetchAPI('/buku');
    const tbody = document.querySelector('#table-buku tbody');
    tbody.innerHTML = '';
    
    books.forEach(b => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>${b.isbn || '-'}</td>
            <td>${b.judul}</td>
            <td>${categoriesMap[b.idKategori] || b.idKategori}</td>
            <td>${b.pengarang}</td>
            <td>${b.penerbit}</td>
            <td>${b.tahunBuku}</td>
            <td>${b.jumlah}</td>
            <td>
                <button class="btn btn-secondary btn-sm" onclick='editBook(${JSON.stringify(b)})'>Edit</button>
                <button class="btn btn-danger btn-sm" onclick="deleteBook(${b.idBuku})">Hapus</button>
            </td>
        `;
        tbody.appendChild(tr);
    });
}

function openModal() {
    document.getElementById('modalForm').style.display = 'flex';
    document.getElementById('modalTitle').textContent = 'Tambah Buku';
    document.getElementById('formBuku').reset();
    document.getElementById('idBuku').value = '';
}

function closeModal() {
    document.getElementById('modalForm').style.display = 'none';
}

async function deleteBook(id) {
    if(confirm('Yakin hapus buku ini?')) {
        await fetchAPI(`/buku/${id}`, 'DELETE');
        loadData();
    }
}

window.editBook = function(book) {
    openModal();
    document.getElementById('modalTitle').textContent = 'Edit Buku';
    document.getElementById('idBuku').value = book.idBuku;
    document.getElementById('isbn').value = book.isbn || '';
    document.getElementById('judul').value = book.judul;
    document.getElementById('idKategori').value = book.idKategori;
    document.getElementById('pengarang').value = book.pengarang;
    document.getElementById('penerbit').value = book.penerbit;
    document.getElementById('tahunBuku').value = book.tahunBuku;
    document.getElementById('jumlah').value = book.jumlah;
}

document.getElementById('formBuku').addEventListener('submit', async (e) => {
    e.preventDefault();
    const id = document.getElementById('idBuku').value;
    const method = id ? 'PUT' : 'POST';
    const url = id ? `/buku/${id}` : '/buku';
    
    // Auto-fill defaults for required new fields if empty
    const data = {
        idBuku: id ? parseInt(id) : null,
        isbn: document.getElementById('isbn').value,
        judul: document.getElementById('judul').value,
        idKategori: parseInt(document.getElementById('idKategori').value),
        pengarang: document.getElementById('pengarang').value,
        penerbit: document.getElementById('penerbit').value,
        tahunBuku: document.getElementById('tahunBuku').value,
        jumlah: parseInt(document.getElementById('jumlah').value),
        // Defaults for nullable fields
        sampul: '0',
        lampiran: '0',
        isi: '-',
        tglMasuk: new Date().toISOString().slice(0, 10),
        gambarBuku: '-'
    };

    const res = await fetchAPI(url, method, data);
    if(res) {
        closeModal();
        loadData();
    }
});

loadData();
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
