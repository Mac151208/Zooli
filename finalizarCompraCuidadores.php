<?php
session_start(); // Inicie a sessão

// Verifique se o cliente está logado

if (isset($_SESSION['logado']) && $_SESSION['logado'] == true) {
    // Redirecionar para a página de login
    $id_cliente = $_SESSION['idCliente'];

    // Verifique se as datas foram enviadas pelo formulário
    if (isset($_POST['dataEntrada']) && isset($_POST['dataSaida'])) {
        // Obtenha as datas de entrada e saída do formulário
        $dataEntrada = $_POST['dataEntrada'];
        $dataSaida = $_POST['dataSaida'];

        // Converta as datas para o formato adequado antes de inserir no banco de dados
        $dataEntradaFormatada = date('d/m/Y', strtotime($dataEntrada));
        $dataSaidaFormatada = date('d/m/Y', strtotime($dataSaida));

        // Conecte-se ao banco de dados (substitua as informações de acordo com o seu banco de dados)
        $conn = new mysqli('localhost', 'root', '', 'dbpets');

        // Verificar conexão
        if ($conn->connect_error) {
            die("Falha na conexão: " . $conn->connect_error);
        }

        // Inserir as datas no banco de dados, associando ao ID do cliente
        $sql = "INSERT INTO tb_cliente (ID_CLIENTE, ENTRADA_CONTRATO_CUIDADOR, SAIDA_CONTRATO_CUIDADOR) VALUES ('$id_cliente', '$dataEntradaFormatada', '$dataSaidaFormatada')";

        if ($conn->query($sql) === TRUE) {
            echo "Compra finalizada com sucesso!";
        } else {
            echo "Erro ao finalizar a compra: " . $conn->error;
        }

        $conn->close();
    }
}
else {
    header("Location: login.php");
    exit();
}
?>
