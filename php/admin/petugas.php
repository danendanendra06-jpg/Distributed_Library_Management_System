<?php
require_once __DIR__ . '/../includes/header.php';
if (!isset($_SESSION['user_role']) || ($_SESSION['user_role'] !== 'Petugas' && $_SESSION['user_role'] !== 'admin')) {
    header("Location: ../auth/login.php"); exit;
}
?>
<div class="card">
    <div class="card-header">
        <h2>Manajemen Petugas</h2>
        <button class="btn btn-primary" onclick="openModal()">+ Tambah Petugas</button>
    </div>
    <div class="table-responsive">
        <table class="table" id="table-petugas">
            <thead>
                <tr>
                    <th>ID Petugas</th>
                    <th>Nama</th>
                    <th>User</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<div id="modalForm" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:100; align-items:center; justify-content:center;">
    <div class="card" style="width: 500px; max-height:90vh; overflow-y:auto;">
        <div class="card-header">
            <h3 id="modalTitle">Tambah Petugas</h3>
            <button class="btn btn-outline" onclick="closeModal()">X</button>
        </div>
        <form id="formPetugas">
            <input type="hidden" id="isEdit" value="false">
            <div class="form-group">
                <label>ID Petugas</label>
                <input type="text" id="idPetugas" class="form-control" placeholder="AG..." required>
            </div>
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" id="nama" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Username</label>
                <input type="text" id="user" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" id="pass" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" id="email" class="form-control">
            </div>
             <div class="form-group">
                <label>Telepon</label>
                <input type="text" id="telepon" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%">Simpan</button>
        </form>
    </div>
</div>

<script>
async function loadData() {
    const list = await fetchAPI('/petugas') || [];
    const tbody = document.querySelector('#table-petugas tbody');
    tbody.innerHTML = '';
    list.forEach(p => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>${p.idPetugas}</td>
            <td>${p.nama}</td>
            <td>${p.user}</td>
            <td>${p.email}</td>
            <td>${p.telepon}</td>
            <td>
                <button class="btn btn-secondary btn-sm" onclick='edit(${JSON.stringify(p)})'>Edit</button>
                <button class="btn btn-danger btn-sm" onclick="del('${p.idPetugas}')">Hapus</button>
            </td>
        `;
        tbody.appendChild(tr);
    });
}
    function openModal() {
        document.getElementById('modalForm').style.display = 'flex';
        document.getElementById('formPetugas').reset();
        document.getElementById('idPetugas').value = '';
        document.getElementById('idPetugas').readOnly = false;
        document.getElementById('isEdit').value = 'false';
        document.getElementById('modalTitle').textContent = 'Tambah Petugas';
        document.getElementById('pass').required = true;
        document.getElementById('pass').placeholder = '';
    }
    function closeModal() { document.getElementById('modalForm').style.display = 'none'; }
    window.edit = function(p) {
        openModal();
        document.getElementById('modalTitle').textContent = 'Edit Petugas';
        document.getElementById('isEdit').value = 'true';
        document.getElementById('idPetugas').value = p.idPetugas;
        document.getElementById('idPetugas').readOnly = true;
        document.getElementById('nama').value = p.nama;
        document.getElementById('user').value = p.user;
        // Don't fill password
        document.getElementById('pass').value = '';
        document.getElementById('pass').required = false;
        document.getElementById('pass').placeholder = 'Kosongkan jika tidak ubah';
        document.getElementById('email').value = p.email;
        document.getElementById('telepon').value = p.telepon;
    }
    async function del(id) {
        if(confirm('Hapus petugas?')) {
            await fetchAPI(`/petugas/${id}`, 'DELETE');
            loadData();
        }
    }
    document.getElementById('formPetugas').addEventListener('submit', async (e) => {
        e.preventDefault();
        const isEdit = document.getElementById('isEdit').value === 'true';
        const id = document.getElementById('idPetugas').value;
        const passVal = document.getElementById('pass').value;
        
        const url = isEdit ? `/petugas/${id}` : '/petugas';
        const method = isEdit ? 'PUT' : 'POST';
        
        const data = {
            idPetugas: id,
            nama: document.getElementById('nama').value,
            user: document.getElementById('user').value,
            email: document.getElementById('email').value,
            telepon: document.getElementById('telepon').value,
            // Defaults
            tempatLahir: '-', tglLahir: '-', alamat: '-', tglBergabung: '-', foto: '-'
        };
        // Only send password if not empty
        if (passVal) {
            data.pass = passVal;
        } else if (!isEdit) {
            alert("Password wajib diisi untuk data baru");
            return;
        }

        await fetchAPI(url, method, data);
        closeModal();
        loadData();
    });
    loadData();
    </script>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
