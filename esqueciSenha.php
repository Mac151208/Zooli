<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->SMTPDebug= 0;
$mail->Host = 'smtp.office365.com'; 
$mail->Port = 587;
$mail->SMTPSecure = 'STARTTLS';
$mail->SMTPAuth = true;

$mail->Username = 'zooli.pets@hotmail.com';
$mail->Password = 'Zooli+pet';
$mail->setFrom('zooli.pets@hotmail.com', 'Zooli');


if(isset($_REQUEST['valor']) and ($_REQUEST['valor'] == 'enviado')) {




// Conectar ao banco de dados MySQL
$conn = mysqli_connect('localhost', 'root', '', 'dbpets');

// Selecionar o endereço de e-mail do destinatário da tabela do banco de dados
$sql = "SELECT EMAIL_CLIENTE FROM tb_cliente WHERE ID_CLIENTE = 1"; // altere "usuarios" para o nome da sua tabela e "id" para o nome do campo que contém o ID do usuário
$resultado = mysqli_query($conn, $sql);
$dados = mysqli_fetch_assoc($resultado);
$destinatario = $dados['EMAIL_CLIENTE'];

$mail->addAddress($destinatario);


// Processar o formulário
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$email = $_POST['emailCliente'];

	// Verificar se o endereço de e-mail está registrado no banco de dados
	$sql = "SELECT * FROM tb_cliente WHERE EMAIL_CLIENTE = '$email'";
	$resultado = mysqli_query($conn, $sql);

	if (mysqli_num_rows($resultado) == 1) {
		// Gerar um token de redefinição de senha
		$token = bin2hex(random_bytes(32));

		// Armazenar o token de redefinição de senha no banco de dados
		$sql = "UPDATE tb_cliente SET TOKEN_CLIENTE = '$token' WHERE EMAIL_CLIENTE = '$email'";
		mysqli_query($conn, $sql);

		// Enviar um e-mail com um link de redefinição de senha
		$mail->Subject = 'Recuperar Senha';
		$link = "https://localhost//zooli_ofc/redefinirSenha.php?email=$email&token=$token";
		$mail->Body    = "Olá, Você solicitou alteração de senha.<br><br>Para continuar o processo de recuperação de sua senha, clique no link abaixo ou cole o endereço no seu navegador: <br><br><a href='" . $link . "'>" . $link . "</a><br><br>Se você não solicitou essa alteração, nenhuma ação é necessária. Sua senha permanecerá a mesma até que você ative este código.<br><br>";
        $mail->AltBody = "Olá, você solicitou alteração de senha.\n\nPara continuar o processo de recuperação de sua senha, clique no link abaixo ou cole o endereço no seu navegador: \n\n" . $link . "\n\nSe você não solicitou essa alteração, nenhuma ação é necessária. Sua senha permanecerá a mesma até que você ative este código.\n\n";

		$mail->send();

		echo "<script>alert('Um link de redefinição de senha foi enviado para o seu endereço de e-mail.);window.location.href='esqueciSenha.php?valor=enviado';</script>";
	} else {
		echo "<script>alert('Endereço de e-mail não registrado, faça o cadastro!'); window.location.href='cadastroCliente.php';</script>";
	}
}
} else {

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/form.css">
    <link rel="icon" type="icon" href="img/fotinho.png"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="js/scripts.js"></script>
	<title>Recuperar Senha</title>
</head>
<body>
<div class="form-box">
    <h2>Recuperar Senha</h2>
    <h3>Preencha o campo de email para recuperar a senha 😉</h3>
	<br>
	<form method="post" action="esqueciSenha.php?valor=enviado">

		<div class="input-group">
            <label>Seu E-mail: </label>
            <input type="email" name="emailCliente" id="emailCliente" placeholder="Digite o seu e-mail" required>
        </div>
		<br>
		<button class="buttonSenha">Recuperar<input type="submit" value="Recuperar" id="Recuperar" name="Recuperar"></button>
	</form>
	<br>
        Lembrou? <a href="login.php">clique aqui</a> para logar!
</body>
</html>
<?php }
?>