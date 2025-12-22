<?php
session_start();
// Set default path constants if needed, or rely on relative paths
include_once __DIR__ . '/../config.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Husain</title>
    
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Chart JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- Custom CSS -->
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/Project4_DTS/php/assets/css/style.css">
    
    <!-- Global Helper Scripts (Must be in head to be available for inline scripts) -->
    <script src="/Project4_DTS/php/assets/js/script.js"></script>
</head>
<body>

<nav class="navbar">
    <a href="#" class="brand">
        <i class="fas fa-book-reader"></i> Library Husain
    </a>
    
    <div class="nav-links">
        <?php if(isset($_SESSION['user_role'])): ?>
            <?php if($_SESSION['user_role'] === 'Petugas' || $_SESSION['user_role'] === 'admin'): ?>
                <!-- Menu Admin/Petugas -->
                <a href="/Project4_DTS/php/admin/dashboard.php" class="nav-link">Dashboard</a>
                <a href="/Project4_DTS/php/admin/buku.php" class="nav-link">Buku</a>
                <a href="/Project4_DTS/php/admin/peminjaman.php" class="nav-link">Peminjaman</a>
                <a href="/Project4_DTS/php/admin/anggota.php" class="nav-link">Anggota</a>
                <a href="/Project4_DTS/php/admin/denda.php" class="nav-link">Denda</a>
                <a href="/Project4_DTS/php/admin/kategori.php" class="nav-link">Kategori</a>
                <a href="/Project4_DTS/php/admin/petugas.php" class="nav-link">Petugas</a>
            <?php else: ?>
                <!-- Menu Member -->
                <a href="/Project4_DTS/php/member/index.php" class="nav-link">Home</a>
                <a href="/Project4_DTS/php/member/buku.php" class="nav-link">Katalog</a>
                <a href="/Project4_DTS/php/member/riwayat.php" class="nav-link">Riwayat</a>
            <?php endif; ?>
            
            <a href="/Project4_DTS/php/auth/logout.php" class="btn btn-danger btn-sm">Logout (<?php echo $_SESSION['user_name'] ?? 'User'; ?>)</a>
        <?php else: ?>
            <a href="/Project4_DTS/php/auth/login.php" class="btn btn-primary">Login</a>
            <a href="/Project4_DTS/php/auth/register.php" class="btn btn-outline">Daftar</a>
        <?php endif; ?>
    </div>
</nav>

<div class="container">
