<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['user_token'] = $_POST['token'];
    $_SESSION['user_role'] = $_POST['role'];
    
    $userData = json_decode($_POST['user_data'], true);
    // Determine name field based on role/entity structure
    if (isset($userData['nama'])) {
        $_SESSION['user_name'] = $userData['nama']; // Petugas
        // Updated idLogin to idPetugas
        $_SESSION['user_id'] = $userData['idPetugas'] ?? $userData['idLogin']; 
    } elseif (isset($userData['namaLengkap'])) {
        $_SESSION['user_name'] = $userData['namaLengkap']; // Member
        $_SESSION['user_id'] = $userData['idMember'];
    } else {
        $_SESSION['user_name'] = 'User';
    }
    
    echo "Session set";
}
