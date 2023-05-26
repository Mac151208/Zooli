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
$sql = "SELECT ID_PROMOCAO,ID_USUARIO_ADM, ID_CATEGORIA,TOKEN_PROMOCAO,VALIDADE_PROMOCAO,VALOR_PROMOCAO,STATUS_PROMOCAO FROM TB_PROMOCAO";
$result = $conn->query($sql);
$cupom = array();

while ($row = $result->fetch_assoc()) {
    $cupom[] = $row;
}

// Fecha a conexão com o banco de dados
$conn->close();
// Converte o array em JSON e retorna
echo json_encode($cupom);
?>