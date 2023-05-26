<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbpets";

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");

// Verifica a conexão
if ($conn->connect_error) {
  die("Falha na conexão: " . $conn->connect_error);
}

// Verifica se o ID da mensagem foi fornecido na solicitação GET
if (isset($_GET['id'])) {
  $id_contato = $_GET['id'];

  // Seleciona os dados da mensagem com base no ID
  $sql = "SELECT ID_AVALIACAO, NOME_AVALIACAO, EMAIL_AVALIACAO, ASSUNTO_AVALIACAO, ESTRELA_AVALIACAO FROM tb_avaliacao WHERE status_avaliacao <>'respondido'" ;
  $result = $conn->query($sql);

  // Verifica se há resultados
  if ($result->num_rows > 0) {
    // Retorna os resultados como JSON
    $row = $result->fetch_assoc();
    echo json_encode($row);
  }
}

// Fecha a conexão
$conn->close();

?>
