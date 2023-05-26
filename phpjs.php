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

// Executa a consulta SQL para obter os dados dos produtos
$sql = "SELECT ID_PROD, NOME_PROD, DESC_PROD, QNT_PROD, VALOR_PROD,TAMANHO_PROD, imagem FROM TB_PROD";
$result = $conn->query($sql);

// Cria um array com os dados dos produtos
$produtos = array();
while ($row = $result->fetch_assoc()) {
    
         // Formata a quantidade com vírgulas para separar os milhares

    $qnt_formatada = number_format($row['QNT_PROD'], 0, ',', '.');
    $row['qntd_prod']=$qnt_formatada;


    // Lê o conteúdo binário da imagem do banco de dados e codifica em base64
    $imagem = base64_encode($row['imagem']);
    
    // Remove a imagem do array $row
    unset($row['imagem']);
    
    // Adiciona a imagem codificada em base64 no array $row
    $row['imagem_base64'] = $imagem;
    
    
    // Adiciona o array $row no array de produtos
    $produtos[] = $row;

   


}

// Fecha a conexão com o banco de dados
$conn->close();

// Converte o array em JSON e retorna
echo json_encode($produtos);
?>
