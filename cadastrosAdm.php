<?php

if(isset($_REQUEST['valor']) and ($_REQUEST['valor'] == 'enviado')){
    $Botao= $_POST['Botao'];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dbpets";
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica se a conexão foi bem sucedida
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }
        if ($Botao == "Inserir"){
        $descricao = $_POST['descricao'];

        // Recebe os dados do formulário
        $descricao = $_POST['descricao'];

        // Prepara e executa a consulta SQL para inserir os dados no banco de dados
        $sql = "INSERT INTO TB_CATEGORIA (DESCRICAO_CATEGORIA ) VALUES ('$descricao')";

        if ($conn->query($sql) === TRUE) {
            // Move a imagem para o diretório de uploads
            echo "<script>window.alert('Categoria cadastrada com sucesso!');window.location.href='cadastrosAdm.php';</script>";

        } else {

            echo "Erro ao cadastrar produto: " . $conn->error;
        }

    }
    // Fecha a conexão com o banco de dados

    if($Botao=="Cadastrar"){

        $razao = $_POST['razao'];
        $fantasia = $_POST['fantasia'];
        $contato = $_POST['contato'];
        $endereco = $_POST['endereco'];
        $email = $_POST['email'];
        $cnpj=$_POST['cnpj'];
        $status = $_POST['status'];
        
        // Verifica se a conexão foi bem sucedida
        if ($conn->connect_error) {
            die("Conexão falhou: " . $conn->connect_error);
        }
        
        $sql = "INSERT INTO TB_FORNECEDOR (RAZAO_FORNECEDOR,NOME_FANTASIA_FORNECEDOR,CONTATO_FORNECEDOR,ENDERECO_FORNECEDOR,EMAIL_FORNECEDOR,CNPJ_FORNECEDOR, STATUS_FORNECEDOR )
        VALUES ('$razao', '$fantasia', '$contato', '$endereco', '$email', '$cnpj', '$status')";
        
        if ($conn->query($sql) === TRUE) {
            echo "<script>window.alert('Fornecedor cadastrada com sucesso!');window.location.href='cadastrosAdm.php';</script>";

        } else {
            echo "Erro ao cadastrar fornecedor: " . $conn->error;
        }
    }    
    if($Botao=="Cadastrar1"){

        $descricao = $_POST['descricao'];
        $preco = $_POST['preco'];
        $quantidade =$_POST['qntd'];
        $VALOR_PAGO_PRODUTO=$_POST['VALOR_PAGO_PRODUTO'];
        $CODIGO_BARRAS_PRODUTO=$_POST['CODIGO_BARRAS_PRODUTO'];

        $nome = mysqli_real_escape_string($conn, $_POST['nome']);
        $tamanho = $_POST['tamanho'];
        $idCategoria=$_POST['idCategoria'];
        $idfornecedor=$_POST['idfornecedor'];
        $imagem = addslashes(file_get_contents($_FILES['imagem']['tmp_name']));
        // Prepara e executa a consulta SQL para inserir os dados no banco de dados
    $sql = "INSERT INTO tb_prod (NOME_PROD, DESC_PROD, QNT_PROD,VALOR_PROD, TAMANHO_PROD, ID_CATEGORIA,ID_FORNECEDOR ,imagem, VALOR_PAGO_PRODUTO, CODIGO_BARRAS_PRODUTO,STATUS_PRODUTO) VALUES ('$nome', '" . mysqli_real_escape_string($conn, $descricao) . "', '$quantidade', '$preco','$tamanho','$idCategoria','$idfornecedor', '$imagem', '$VALOR_PAGO_PRODUTO','$CODIGO_BARRAS_PRODUTO', 'disponivel')";
    if ($conn->query($sql) === TRUE) {
        // Move a imagem para o diretório de uploads
        echo "<script>window.alert('Produto cadastrado com sucesso!');window.location.href='cadastrosAdm.php';</script>";

    } else {
        echo "Erro ao cadastrar produto: " . $conn->error;
    }}
    if($Botao=="Inserindo"){

        $codadm = $_POST['codadm'];
        $TOKEN = $_POST['TOKEN'];
        $VALIDADE_PROMOCAO =$_POST['VALIDADE_PROMOCAO'];
        $VALOR_PROMOCAO =$_POST['VALOR_PROMOCAO'];
        $idCategoria1 =$_POST['idCategoria1'];

    // Prepara e executa a consulta SQL para inserir os dados no banco de dados
    $sql = "INSERT INTO tb_promocao (ID_USUARIO_ADM, ID_CATEGORIA, TOKEN_PROMOCAO, VALIDADE_PROMOCAO, VALOR_PROMOCAO, STATUS_PROMOCAO) VALUES ('$codadm','$idCategoria1', '$TOKEN', '$VALIDADE_PROMOCAO', '$VALOR_PROMOCAO', '')";

    if ($conn->query($sql) === TRUE) {
        // Move a imagem para o diretório de uploads
        echo "<script>window.alert('Cumpom cadastrado com sucesso!');window.location.href='cadastrosAdm.php';</script>";

        } else {
        echo "Erro ao cadastrar o cupom: " . $conn->error;
        }}

    if($Botao == "atualizando"){

    $uf=$_POST['uf'];
    $valorfrete=$_POST['valorfrete'];
    $dias=$_POST['dias'];

    $sql = "UPDATE tb_frete SET VALOR_FRETE='$valorfrete', TEMPO_ENTREGA_DIAS='$dias' WHERE UF='$uf'";

    if ($conn->query($sql) === TRUE) {
        // Move a imagem para o diretório de uploads
        echo "<script>window.alert('Atualizado com sucesso!');window.location.href='cadastrosAdm.php';</script>";


    } else {
    echo "<script> alert('Estado digitado errado');
   </script> " . $conn->error;
    }
    
}
$conn->close();
}

else
{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/form.css">
    <link rel="icon" type="icon" href="img/fotinho.png"/>
    <title>Cadastros ADM</title>
</head>
<body>
<div class="form-adm">
    <h2>Selecione o campo que deseja cadastrar: </h2> <br>
    
    <input type="checkbox" id="campo_cuidador" onclick="mostrarCamposCuidador()"><span style="font-size:20px;"> Cadastrar Cuidador </span> 

    <script>
        function mostrarCamposCuidador() {
        var camposAdicionais = document.getElementById("campoabrir_cuidador");
        if (document.getElementById("campo_cuidador").checked) {
            camposAdicionais.style.display = "block";
        } else {
            camposAdicionais.style.display = "none";
        }
        }
    </script>
    <br><br>
    
    <div id="campoabrir_cuidador" style="display:none;">
        <form action="cuidadores.php" method="POST">
            <div class="input-group">
                <label for="imagem">Imagem do Cuidador:</label>
                <input type="file" name="imagemCuidador" id="imagemCuidador" required>
            </div>
            <div class="input-group">
                <label for="nome">Nome do Cuidador:</label>
                <input type="text" name="nomeCuidador" id="nomeCuidador" required >
            </div>
            <div class="input-group">
                <label for="nome">Descrição do Cuidador:</label>
                <input type="text" name="descricaoCuidador" id="descricaoCuidador" required>
            </div>
            <div class="input-group">
                <label for="nome">Valor da Diária:</label>
                <input type="text" name="valorCuidador" id="valorCuidador" required>
            </div>
            
            <button id="Botao" type="submit" name="Botaozinho" class="buttonADM" onclick="Botaozinho">Cadastrar Cuidador</button>
    
        </form>
    </div>

    <!----------------------------------------------------CADASTRAR CATEGORIA------------------------------------------------>

    <input type="checkbox" id="campo_categoria" onclick="mostrarCamposCategoria()"><span style="font-size:20px;"> Cadastrar Categoria </span> 

    <script>
        function mostrarCamposCategoria() {
        var camposAdicionais = document.getElementById("campoabrir_categoria");
        if (document.getElementById("campo_categoria").checked) {
            camposAdicionais.style.display = "block";
        } else {
            camposAdicionais.style.display = "none";
        }
        }
    </script>
    <br><br>
    <div id="campoabrir_categoria" style="display:none;">
        <form action="cadastrosAdm.php?valor=enviado" method="post" enctype="multipart/form-data">
            <div class="input-group">
                <label for="descricao">Descrição do Produto:</label>
                <input name="descricao" id="descricao" required></input>
            </div>  
            <button id="Botao" type="submit" name="Botao"  value ="Inserir" class="buttonADM">Cadastrar Categoria</button>
        </form>
    </div>
<!----------------------------------------------------CADASTRAR FORNECEDOR------------------------------------------------>
    <input type="checkbox" id="campo_fornecedor" onclick="mostrarCamposFornecedor()"><span style="font-size:20px;"> Cadastrar Fornecedor </span> 

    <script>
        function mostrarCamposFornecedor() {
        var camposAdicionais = document.getElementById("campoabrir_fornecedor");
        if (document.getElementById("campo_fornecedor").checked) {
            camposAdicionais.style.display = "block";
        } else {
            camposAdicionais.style.display = "none";
        }
        }
    </script>
    <br><br>
    <div id="campoabrir_fornecedor" style="display:none;">
        <form action="cadastrosAdm.php?valor=enviado" method="post" enctype="multipart/form-data">
            <div class="input-group ">
                <label for="razao">Razão Social:</label>
                <input type="text" id="razao" name="razao" required>
            </div>
            <div class="input-group w50">
                <label for="fantasia">Nome Fantasia:</label>
                <input type="text" id="fantasia" name="fantasia" required>
            </div>
            <div class="input-group w50">
                <label for="contato">Contato:</label>
                <input type="text" id="contato" name="contato" required>
            </div>
            <div class="input-group">
                <label for="endereco">Endereço:</label>
                <input type="text" id="endereco" name="endereco" required>
            </div>
            <div class="input-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-group w50">
                <label for="cnpj">CNPJ:</label>
                <input type="text" id="cnpj" name="cnpj" maxlenght="14" required>
            </div>
            <div class="input-group w50">
                <label for="status">Status:</label>
                <select id="status" name="status">
                    <option value="Ativo">Ativo</option>
                </select>
            </div>
            <button id="Botao" type="submit" name="Botao"  value="Cadastrar" class="buttonADM">Cadastrar Fornecedor</button>
        
        </form>
    </div>
 <!----------------------------------------------------CADASTRAR PRODUTOS------------------------------------------------>
    <input type="checkbox" id="campo_produtos" onclick="mostrarCamposProdutos()"><span style="font-size:20px;"> Cadastrar Produto </span> 

    <script>
        function mostrarCamposProdutos() {
        var camposAdicionais = document.getElementById("campoabrir_produtos");
        if (document.getElementById("campo_produtos").checked) {
            camposAdicionais.style.display = "block";
        } else {
            camposAdicionais.style.display = "none";
        }
        }
    </script>
    <br><br>
    <div id="campoabrir_produtos" style="display:none;">
        <form action="cadastrosAdm.php?valor=enviado" method="post" enctype="multipart/form-data">
            <div class="input-group">
                <label for="nome">Nome do Produto:</label>
                <input type="text" name="nome" id="nome" required>
            </div>
            <div class="input-group">
                <label for="descricao">Descrição do Produto:</label>
                <input name="descricao" id="descricao" required></input>
            </div>
            <div class="input-group">
                <label for="qntd"> Quantidade:</label>
                <input type="number" name="qntd" id="qntd"  step="1" required>
            </div>
            <div class="input-group w50">
                <label for="compras">Valor Pago do Produto(em unidade):</label>
                <input type="number" name="VALOR_PAGO_PRODUTO" id="VALOR_PAGO_PRODUTO" step="0.01" required>
            </div>
            <div class="input-group w50">
                <label for="preco">Preço do Produto:</label>
                <input type="number" name="preco" id="preco"  step="0.01" required>
            </div>
            <div class="input-group">
                <label for="codigodebarras"> Código de Barras:</label>
                <input type="number" name="CODIGO_BARRAS_PRODUTO"id="CODIGO_BARRAS_PRODUTO" required maxlength="128">
            </div>
            <div class="input-group w50">
                <label for="idCategoria">Código da Categoria:</label>
                <input type="number" name="idCategoria" id="idCategoria" onchange="updateCategoriaNome()"  required>
            </div>
            <div class="input-group w50">
                <label for="nomecategoria">Nome da Categoria:</label>
                <input type="text" name="nomecategoria" id="nomecategoria" Readonly  required>
            </div>
            <div class="input-group w50">
                <label for="idfornecedor">Código do Fornecedor:</label>
                <input type="number" name="idfornecedor" id="idfornecedor"  onchange="updateFornecedorNome()" required>
            </div>
            <div class="input-group w50">
                <label for="nomefornecedor">Nome Fornecedor:</label>
                <input type="text" name="nomefornecedor" id="nomefornecedor" Readonly required>
            </div>
            <div class="input-group w50">
                <label for="Tamanho">Tamanho do Produto:</label>
                <input type="text" name="tamanho" id="tamanho"  required>
            </div>
            <div class="input-group w50">
                <label for="imagem">Imagem do Produto:</label>
                <input type="file" name="imagem" id="imagem" accept="image/*" required>
            </div>
            <button id="Botao" type="submit" name="Botao"  value="Cadastrar1" class="buttonADM">Cadastrar Produto</button>
        </form>
    </div>
  <!----------------------------------------------------CADASTRAR CUPONS------------------------------------------------>
    <input type="checkbox" id="campo_cupom" onclick="mostrarCamposCupom()"><span style="font-size:20px;"> Cadastrar Cupom </span> 

    <script>
        function mostrarCamposCupom() {
        var camposAdicionais = document.getElementById("campoabrir_cupom");
        if (document.getElementById("campo_cupom").checked) {
            camposAdicionais.style.display = "block";
        } else {
            camposAdicionais.style.display = "none";
        }
        }
    </script>
    <br><br>
    <div id="campoabrir_cupom" style="display:none;">
        <form action="cadastrosAdm.php?valor=enviado" method="post" enctype="multipart/form-data">
            <div class="input-group">
                <label for="idusuarioadm"> Código do Administrador: </label>
                <input type="number" id="codadm" name="codadm" onchange="updateAdmNome()"> 
            </div>
            <div class="input-group">
                <label for = "Nomefuncionario">E-mail do Funcionário:</label>
                <input type="email" name="nomefuncionario" id="nomefuncionario" Readonly  >
            </div>
            <div class="input-group">
                <label for="TOKEN">Código para o Cupom:</label>
                <input name="TOKEN" id="TOKEN" required ></input>
            </div>
            <div class="input-group w50">
                <label for="VALIDADE_PROMOCAO"> Validade do Cupom:</label>
                <input type="date" name="VALIDADE_PROMOCAO" id="VALIDADE_PROMOCAO"  required>
            </div>
            <div class="input-group w50">
                <label for="preco">Preço do Desconto:</label>
                <input type="number" name="VALOR_PROMOCAO" id="VALOR_PROMOCAO"  step="0.01" required>
            </div>
            <div class="input-group w50">
                <label for="idCategoria">Código da Categoria:</label>
                <input type="number" name="idCategoria1" id="idCategoria1" onchange="updateCategoriaNome1()"  required>
            </div>
            <div class="input-group w50">
                <label for="nomecategoria">Nome da Categoria:</label>
                <input type="text" name="nomecategoria" id="nomecategoria1" Readonly  >
            </div>

                <button id="Botao" type="submit" name="Botao"  value="Inserindo" class="buttonADM">Cadastrar Cupom</button>
        </form>
    </div>
 <!----------------------------------------------------CADASTRAR TRANSPORTADORA------------------------------------------------>
    <input type="checkbox" id="campo_transportadora" onclick="mostrarCamposTransportadora()"><span style="font-size:20px;"> Atualizar Transportadora </span> 

    <script>
        function mostrarCamposTransportadora() {
        var camposAdicionais = document.getElementById("campoabrir_transportadora");
        if (document.getElementById("campo_transportadora").checked) {
            camposAdicionais.style.display = "block";
        } else {
            camposAdicionais.style.display = "none";
        }
        }
    </script>
    <br><br>
    <div id="campoabrir_transportadora" style="display:none;">
        <form action="cadastrosAdm.php?valor=enviado" method="post" enctype="multipart/form-data">
            <div class="input-group w50">
                <label for="uf"> UF do Estado:</label>
                <input type="text" name="uf" id="uf" maxlength="2"required>
            </div>
            <div class="input-group w50">
                <label for="dias">Tempo para Entrega (em dias): </label>
                <input type="number" id="dias" name="dias" required>
            </div>
            <div class="input-group">
                <label for="valorFrete">Valor do Frete: </label>
                <input type="number" id="valorfrete" name="valorfrete" step="0.01" required>
            </div>
            <button id="Botao" type="submit" name="Botao" value="atualizando" class="buttonADM">Atualizar Transportadora</button>
        </form>
    </div>
<!----------------------------------------------RESPONDER MENSSAGENS--------------------------------------->

    <input type="checkbox" id="responderClientes" onclick="window.location.href='respondermessage.php'"> <span style="font-size:20px;"> Responder Clientes </span> 

    <br> <br>
    <input type="checkbox" id="responderClientes" onclick="window.location.href='responderavaliacao.php'"> <span style="font-size:20px;"> Responder Avaliações Clientes </span> 

  
</div>

    <script>
    function updateCategoriaNome() {
        // Obtém o valor do campo "idCategoria"
        var idCategoria = document.getElementById("idCategoria").value;
        
        // Faz uma requisição AJAX para buscar o nome da categoria no servidor
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Atualiza o valor do campo "nomecategoria" com o nome da categoria
            document.getElementById("nomecategoria").value = xhr.responseText;
        }
        };
        xhr.open("GET", "buscar_categoria.php?id=" + idCategoria, true);
        xhr.send();
    }

    function updateCategoriaNome1() {
        // Obtém o valor do campo "idCategoria"
        var idCategoria = document.getElementById("idCategoria1").value;
        
        // Faz uma requisição AJAX para buscar o nome da categoria no servidor
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Atualiza o valor do campo "nomecategoria" com o nome da categoria
            document.getElementById("nomecategoria1").value = xhr.responseText;
        }
        };
        xhr.open("GET", "buscar_categoria.php?id=" + idCategoria, true);
        xhr.send();
    }
    function updateFornecedorNome() {
        // Obtém o valor do campo "idCategoria"
        var idfornecedor = document.getElementById("idfornecedor").value;
        
        // Faz uma requisição AJAX para buscar o nome da categoria no servidor
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Atualiza o valor do campo "nomecategoria" com o nome da categoria
            document.getElementById("nomefornecedor").value = xhr.responseText;
        }
        };
        xhr.open("GET", "buscar_fornecedor.php?id=" + idfornecedor, true);
        xhr.send();
    }
    function updateAdmNome() {
        // Obtém o valor do campo "idCategoria"
        var codadm = document.getElementById("codadm").value;
        
        // Faz uma requisição AJAX para buscar o nome da categoria no servidor
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Atualiza o valor do campo "nomecategoria" com o nome da categoria
            document.getElementById("nomefuncionario").value = xhr.responseText;
        }
        };
        xhr.open("GET", "buscar_adm.php?id=" + codadm, true);
        xhr.send();
    }
    </script>
</div>
</body>
</html>


<?php
}
?>