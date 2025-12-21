<?php
// admin/dashboard.php
require_once __DIR__ . '/../includes/header.php';

// Access Control
if (!isset($_SESSION['user_role']) || ($_SESSION['user_role'] !== 'Petugas' && $_SESSION['user_role'] !== 'admin')) {
    header("Location: ../auth/login.php");
    exit;
}
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
</div>

<div class="dashboard-grid">
    <div class="card stat-card">
        <div class="stat-value" id="count-buku">0</div>
        <div class="stat-label">Total Buku</div>
    </div>
    <div class="card stat-card" style="border-left-color: var(--secondary-color);">
        <div class="stat-value" id="count-pinjam">0</div>
        <div class="stat-label">Peminjaman Aktif</div>
    </div>
    <div class="card stat-card" style="border-left-color: var(--accent-color);">
        <div class="stat-value" id="count-kategori">0</div>
        <div class="stat-label">Kategori</div>
    </div>
    <div class="card stat-card" style="border-left-color: var(--danger-color);">
        <div class="stat-value" id="count-petugas">0</div>
        <div class="stat-label">Petugas</div>
    </div>
</div>

<div class="row" style="display:flex; gap: 20px;">
    <div class="card" style="flex: 2;">
        <div class="card-header">
            <h4>Statistik Peminjaman</h4>
        </div>
        <canvas id="pinjamChart"></canvas>
    </div>
    <div class="card" style="flex: 1;">
        <div class="card-header">
            <h4>Buku per Kategori</h4>
        </div>
        <canvas id="kategoriChart"></canvas>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', async () => {
    // Load Data
    const [buku, pinjam, kategori, petugas] = await Promise.all([
        fetchAPI('/buku'),
        fetchAPI('/pinjam'),
        fetchAPI('/kategori'),
        fetchAPI('/petugas')
    ]);

    // Update Cards
    document.getElementById('count-buku').innerText = buku.length || 0;
    // Simple filter for active loans
    const activeLoans = pinjam.filter(p => p.status === 'Dipinjam').length;
    document.getElementById('count-pinjam').innerText = activeLoans; 
    document.getElementById('count-kategori').innerText = kategori.length || 0;
    document.getElementById('count-petugas').innerText = petugas.length || 0;

    // Kategori Chart Data
    const katLabels = kategori.map(k => k.namaKategori);
    const katCounts = kategori.map(k => {
        return buku.filter(b => b.idKategori === k.idKategori).length;
    });

    new Chart(document.getElementById('kategoriChart'), {
        type: 'doughnut',
        data: {
            labels: katLabels,
            datasets: [{
                data: katCounts,
                backgroundColor: ['#4F46E5', '#10B981', '#F59E0B', '#EF4444', '#6366F1', '#8B5CF6']
            }]
        }
    });

    // Pinjam Chart (Dummy trend for now)
    new Chart(document.getElementById('pinjamChart'), {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Peminjaman',
                data: [12, 19, 3, 5, 2, 3], // Dummy data
                borderColor: '#4F46E5',
                tension: 0.1
            }]
        }
    }); 
});
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
