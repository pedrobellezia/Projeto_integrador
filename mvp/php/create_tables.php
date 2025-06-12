<?php
require_once 'connect.php';

$conn->query("
    CREATE TABLE IF NOT EXISTS usuarios (
        id SERIAL PRIMARY KEY,
        username TEXT NOT NULL UNIQUE,
        password TEXT NOT NULL
    );
");

$conn->query("
    CREATE TABLE IF NOT EXISTS templates (
        id SERIAL PRIMARY KEY,
        template_name TEXT NOT NULL UNIQUE,
        template_desc TEXT NOT NULL,
        data TEXT NOT NULL
    );
");

$result = $conn->query("SELECT COUNT(*) FROM usuarios WHERE username = 'admin'");
$count = $result->fetch_row()[0]; 

if ($count == 0) {
    $conn->query("INSERT INTO usuarios (username, password) VALUES ('admin', 'admin123')");
    echo "Usuário admin criado com sucesso.";
} else {
    echo "Usuário admin já existe.";
}
?>