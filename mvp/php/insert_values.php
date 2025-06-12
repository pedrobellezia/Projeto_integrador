<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'connect.php';

    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    $templateName = $data['templateName'];
    $template_desc = $data['templateDesc']; 
    $dados = json_encode($data['data']); 

    $templateName = $conn->real_escape_string($templateName);
    $template_desc = $conn->real_escape_string($template_desc); 
    $dados = $conn->real_escape_string($dados);

    $sql = "INSERT INTO templates (template_name, template_desc, data) VALUES ('$templateName', '$template_desc', '$dados')";

    if ($conn->query($sql)) {
        echo "Registro inserido com sucesso.";
    } else {
        echo "Erro ao inserir registro: " . $conn->error; 
    }

    $conn->close(); 
}
?>