<?php
require_once __DIR__ . '/../includes/header.php';
if (!isset($_SESSION['user_role']) || ($_SESSION['user_role'] !== 'Petugas' && $_SESSION['user_role'] !== 'admin')) {
    header("Location: ../auth/login.php"); exit;
}
?>

<div class="card">
    <div class="card-header">
        <h2>Manajemen Kategori</h2>
        <button class="btn btn-primary" onclick="openModal()">+ Tambah Kategori</button>
    </div>
    <div class="table-responsive">
        <table class="table" id="table-kategori">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<div id="modalForm" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:100; align-items:center; justify-content:center;">
    <div class="card" style="width: 400px;">
        <div class="card-header">
            <h3 id="modalTitle">Tambah Kategori</h3>
            <button class="btn btn-outline" onclick="closeModal()">X</button>
        </div>
        <form id="formKategori">
            <input type="hidden" id="idKategori">
            <div class="form-group">
                <label>Nama Kategori</label>
                <input type="text" id="namaKategori" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%">Simpan</button>
        </form>
    </div>
</div>

<script>
async function loadData() {
    const list = await fetchAPI('/kategori');
    const tbody = document.querySelector('#table-kategori tbody');
    tbody.innerHTML = '';
    list.forEach(item => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>${item.idKategori}</td>
            <td>${item.namaKategori}</td>
            <td>
                <button class="btn btn-secondary btn-sm" onclick='edit(${JSON.stringify(item)})'>Edit</button>
                <button class="btn btn-danger btn-sm" onclick="del(${item.idKategori})">Hapus</button>
            </td>
        `;
        tbody.appendChild(tr);
    });
}

function openModal() {
    document.getElementById('modalForm').style.display = 'flex';
    document.getElementById('modalTitle').textContent = 'Tambah Kategori';
    document.getElementById('formKategori').reset();
    document.getElementById('idKategori').value = '';
}
function closeModal() {
    document.getElementById('modalForm').style.display = 'none';
}
window.edit = function(item) {
    openModal();
    document.getElementById('modalTitle').textContent = 'Edit Kategori';
    document.getElementById('idKategori').value = item.idKategori;
    document.getElementById('namaKategori').value = item.namaKategori;
}
async function del(id) {
    if(confirm('Hapus kategori?')) {
        await fetchAPI(`/kategori/${id}`, 'DELETE');
        loadData();
    }
}
document.getElementById('formKategori').addEventListener('submit', async (e) => {
    e.preventDefault();
    const id = document.getElementById('idKategori').value;
    const url = id ? `/kategori/${id}` : '/kategori';
    const method = id ? 'PUT' : 'POST';
    const data = { idKategori: id ? parseInt(id) : null, namaKategori: document.getElementById('namaKategori').value };
    await fetchAPI(url, method, data);
    closeModal();
    loadData();
});
loadData();
</script>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
