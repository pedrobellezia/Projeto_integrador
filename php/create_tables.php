<?php
require_once 'connect.php';

$conn->query("
    CREATE TABLE IF NOT EXISTS usuarios (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(255) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL
    );
");

$conn->query("
    CREATE TABLE IF NOT EXISTS template (
        id INT AUTO_INCREMENT PRIMARY KEY,
        template_name VARCHAR(255) NOT NULL UNIQUE,
        template_desc TEXT NOT NULL
    );
");

$conn->query("
    CREATE TABLE IF NOT EXISTS inputs (
        id INT AUTO_INCREMENT PRIMARY KEY,
        tipo VARCHAR(100) NOT NULL,
        titulo VARCHAR(255) NOT NULL,
        nome VARCHAR(255) NOT NULL,
        value VARCHAR(255),
        label VARCHAR(255)
    );
");

$conn->query("
    CREATE TABLE IF NOT EXISTS template_gen (
        id INT AUTO_INCREMENT PRIMARY KEY,
        template_id INT NOT NULL,
        input_id INT NOT NULL,
        FOREIGN KEY (template_id) REFERENCES template(id) ON DELETE CASCADE,
        FOREIGN KEY (input_id) REFERENCES inputs(id) ON DELETE CASCADE
    );
");

$conn->query("
    CREATE TABLE IF NOT EXISTS template_response (
        id INT AUTO_INCREMENT PRIMARY KEY,
        template_id INT NOT NULL,
        input_id INT NOT NULL,
        hash VARCHAR(255) NOT NULL,
        response TEXT NOT NULL,
        date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (template_id) REFERENCES template(id) ON DELETE CASCADE,
        FOREIGN KEY (input_id) REFERENCES inputs(id) ON DELETE CASCADE
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