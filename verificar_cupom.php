<?php
$couponCode = $_POST['coupon_code'];


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbpets";
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se a conexão foi bem sucedida
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Executa a consulta SQL para obter os dados do cupom
$sql = "SELECT VALOR_PROMOCAO FROM tb_promocao WHERE TOKEN_PROMOCAO = '$couponCode' AND STATUS_PROMOCAO = 'disponivel'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $discountValue = $row["VALOR_PROMOCAO"];
    $response = "Cupom aplicado com sucesso! Desconto de R$" . $discountValue . " aplicado.";
} else {
    $response = "Cupom inválido ou não disponível!";
}

echo $response;

?>
