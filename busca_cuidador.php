<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbpets";
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se a conexão foi bem sucedida
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Executa a consulta SQL para obter os dados dos cuidadores e o nome do cliente
$sql = "SELECT c.ID_CUIDADOR, c.VALOR_CUIDADOR, c.DESCRICAO_CUIDADOR, c.IMAGEM_CUIDADOR, cl.NOME_CLIENTE 
        FROM tb_cuidador c
        JOIN tb_cliente cl ON c.ID_CLIENTE = cl.ID_CLIENTE";
$result = $conn->query($sql);

// Cria um array com os dados dos cuidadores e o nome do cliente
$cuidadores = array();
while ($row = $result->fetch_assoc()) {

    // Lê o conteúdo binário da imagem do banco de dados e codifica em base64
    $imagem = base64_encode($row['IMAGEM_CUIDADOR']);
    
    // Remove a imagem do array $row
    unset($row['IMAGEM_CUIDADOR']);
    
    // Adiciona a imagem codificada em base64 no array $row
    $row['imagem_base64'] = $imagem;

    // Adiciona o nome do cliente ao array $row
    $row['NOME_CLIENTE'] = $row['NOME_CLIENTE'];

    // Adiciona o array $row no array de cuidadores
    $cuidadores[] = $row;
}

// Fecha a conexão com o banco de dados
$conn->close();

echo json_encode($cuidadores);
?>
