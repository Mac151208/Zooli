<?php
session_start();

if (isset($_SESSION['logado']) && $_SESSION['logado'] == true) {
    // Redirecionar para a página de login
    echo "<script> alert('Você já está logado!')
    window.location.href = 'home.php'</script>";
} elseif (isset($_POST['logarCliente'])) {
    $emailCliente = $_POST['emailCliente'];
    $senhaCliente = $_POST['senhaCliente'];

    if (!empty($emailCliente) && !empty($senhaCliente)) {
        // Acesso ao banco de dados
        $conexao = new MySQLi('localhost', 'root', '', 'dbpets');
        $emailCliente = $_POST['emailCliente'];
        $senhaCliente = $_POST['senhaCliente'];
        $consulta = "SELECT * FROM tb_cliente WHERE EMAIL_CLIENTE = '$emailCliente' AND SENHA_CLIENTE = '$senhaCliente'";
        $resultado = $conexao->query($consulta) or trigger_error($conexao->error);

        // Verificando
        if (mysqli_num_rows($resultado) < 1) {
            echo "<script>alert('Usuário não encontrado!'); window.location.href = 'login.php';</script>";
        } else {
            $_SESSION['logado'] = true;

            // Obtendo o ID do cliente
            $row = $resultado->fetch_assoc();
            $idCliente = $row['ID_CLIENTE'];
            $_SESSION['idCliente'] = $idCliente;

            echo "<script>alert('Bem-vindo'); window.location.href = 'home.php';</script>";
        }

        $conexao->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="icon" type="icon" href="img/fotinho.png"/>
</head>
<body>
    <div class="overlay">
        <form action="login.php" method="post">
            <div class="con">
                <header class="head-form">
                    <img src="img/ZOOLI.png" alt="zoo" width="30%">
                    <p>Entre utilizando seu Email e sua Senha</p>
                </header>
                <input class="form-input" name="emailCliente" id="emailCliente" type="email" placeholder="📧 Digite seu Email">
                <br>
                <input type="password" inputmode="numeric" minlength="4" maxlength="8" size="8" id="senhaCliente" name="senhaCliente" placeholder="🔒 Digite sua Senha" class="form-input">
                <br>
                <button class="log-in" type="submit" name="logarCliente">Entrar</button>
                <button class="submits frgt-pass"><a href="esqueciSenha.php" rel="esqueci">Esqueci minha Senha</a></button>
                <button class="submits sign"><a href="cadastroCliente.php" rel="Cadastrar-se"> Cadastrar-se</a></button>
            </div>
        </form>
    </div>
</body>
</html>
