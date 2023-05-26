<?php
// Converte o array em JSON e retorna

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
$sql = "SELECT UF, VALOR_FRETE, EMPRESA_ENTREGA_VENDA, TEMPO_ENTREGA_DIAS
FROM TB_FRETE";
$result = $conn->query($sql);
$frete = array();

while ($row = $result->fetch_assoc()) {
    $frete[] = $row;
}

// Fecha a conexão com o banco de dados
$conn->close();
// Converte o array em JSON e retorna
echo json_encode($frete);
?>