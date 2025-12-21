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
        <h2>Selamat Datang, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h2>
    </div>
    <div class="card-body">
        <p>Selamat datang di Perpustakaan Digital DTS. Silakan jelajahi katalog buku kami dan lakukan peminjaman secara online.</p>
        <div style="margin-top: 20px;">
            <a href="buku.php" class="btn btn-primary">Lihat Daftar Buku</a>
            <a href="riwayat.php" class="btn btn-outline">Riwayat Peminjaman</a>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
