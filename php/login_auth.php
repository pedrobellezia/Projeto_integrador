<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'connect.php';            
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $result = $conn->query("SELECT * FROM usuarios WHERE username = '$username' AND password = '$password'");
    $row = $result->fetch_assoc(); 
    
    if ($row) {		
        $_SESSION['username'] = $row['username'];
        header("Location: /mvp/templates/dashboard.php");
        exit;
    } else {
        header("Location: /mvp/templates/login.php?error=invalid_credentials");
        exit;
    }
}
?>