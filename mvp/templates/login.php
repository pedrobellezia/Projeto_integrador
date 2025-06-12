<?php
    session_start();
    if(array_key_exists('username', $_SESSION) and $_SESSION['username'] == 'admin'){
        header("Location: /mvp/templates/dashboard");
        exit;
    }
    
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - Dev Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../static/css/login.css">
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        <form action="../php/login_auth" method="POST" autocomplete="off">
            <div>
                <label for="username">Usuário</label>
                <input type="text" id="username" name="username" required autofocus>
            </div>
            <div>
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" required style="margin-left: 18px;">
            </div>
            <button type="submit">Entrar</button>
        </form>
    </div>

    <script>        
        const params = new URLSearchParams(window.location.search);        
        if (params.get("error") === "invalid_credentials") {
            alert("Usuário ou senha inválidos!");
        }
    </script>
</body>
</html>
