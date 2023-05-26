<?php
session_start();

if (isset($_REQUEST['valor']) && ($_REQUEST['valor'] == 'enviado')) {
    $Botao = $_POST["Avaliar"];
    $Nome = $_POST["name"];
    $Email = $_POST["email"];
    $Avaliacao = $_POST["star"];
    $Comentario = $_POST["comentario"];
    $Status = "novo";

    if ($Botao == "Avaliar") {
        $Bco = 'dbpets';
        $Usuario = 'root';
        $Senha = '';

        $conexao = new mysqli("localhost", $Usuario, $Senha, $Bco);
        if ($conexao->connect_errno) {
            echo "Erro na conexão" . $conexao->connect_error;
            exit();
        }

        $conexao->set_charset("utf8");

        $Comando = $conexao->prepare("INSERT INTO tb_avaliacao (NOME_AVALIACAO, EMAIL_AVALIACAO, ASSUNTO_AVALIACAO, STATUS_AVALIACAO, ESTRELA_AVALIACAO) VALUES (?, ?, ?, ?, ?)");
        $Comando->bind_param("sssds", $Nome, $Email, $Comentario, $Status, $Avaliacao);

        if ($Comando->execute()) {
            if ($Comando->affected_rows > 0) {
                echo "<script>alert('Avaliação enviada, verifique seu email para ver se foi respondido!'); window.location.href='index.php'</script>";

                $Nome = null;
                $Email = null;
                $Avaliacao = null;
                $Comentario = null;
            } else {
                echo "Erro ao tentar efetivar o contato.";
            }
        } else {
            echo "Erro: Não foi possível executar a declaração sql.";
        }

        $Comando->close();
        $conexao->close();
    }
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/avaliacao.css">
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/form.css">
    <script src="js/avaliacao.js"></script>
    <link rel="icon" type="icon" href="img/fotinho.png"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <title>Avaliação</title>
</head>
<body>
    <div class="responsive-bar">
            <div class="logo">
                <img src="img/ZOOLI.png" alt="LOGO" >
            </div>
            <div class="menu">
                <h1>≡</h1>
            </div>			
        </div>

        <header>
            <div class="header-content clearfix">
                <div class="logo">
                    <img src="img/ZOOLI.png" alt="LOGO" >	
                </div>
                <nav>
                    <ul>
                        <li><a href="index.php">Inicial</a></li>
                        <li><a href="cuidadores.php">Cuidadores</a></li>
                        <li><a href="produtos.php">Compras</a></li>
                        <li><a href="contato.php">Contato</a></li>
                        <li><a href="editarPerfil.php" class="PerfilCuidador"><img src="img/icones/usuario.png" alt="" width="25" height="25"></a></li>
                        <li><a href="sair.php"><img src="img/icones/sair.png" width="23" height="23"></a></li>
                        
                    </ul>
                </nav>
            </div>
        </header>
    </div>
    <h3 class="avaliacao">Deixe sua Avaliação</h3>
    <div class="form-avaliacao">
      <form action="avaliacao.php?valor=enviado" method="post">
    
        <input class="star star-5" id="star-5-2" type="radio" name="star" value="5" onclick="mostraValor()" />
        <label class="star star-5" for="star-5-2"></label>
        <input class="star star-4" id="star-4-2" type="radio" name="star" value="4" onclick="mostraValor()" />
        <label class="star star-4" for="star-4-2"></label>
        <input class="star star-3" id="star-3-2" type="radio" name="star" value="3" onclick="mostraValor()" />
        <label class="star star-3" for="star-3-2"></label>
        <input class="star star-2" id="star-2-2" type="radio" name="star" value="2" onclick="mostraValor()" />
        <label class="star star-2" for="star-2-2"></label>
        <input class="star star-1" id="star-1-2" type="radio" name="star" value="1" onclick="mostraValor()" />
        <label class="star star-1" for="star-1-2"></label>

        <label id="valorAvaliado" for="rating-0"></label>
        <br> <br>
        
        <div class="input-group">
            <label>Nome:</label>
            <input class="nameComment" id="name" type="text" name="name" placeholder="Digite seu Nome" require />
        </div>
        <div class="input-group">
            <label>E-mail:</label>
            <input class="emailComment" id="email" type="email" name="email" placeholder="Digite seu E-mail" require/>
        </div>
        <div class="input-group">
            <label>Comentário:</label>
            <input id="comentario" class="reviewOld" name="comentario" placeholder="Digite seu Comentário"></input>
        </div>
            <button class="btnAvaliar"  id="Avaliar" name="Avaliar" value ="Avaliar"> Avaliar</button>
      </form>
    </div>
</body>
</html>
<?php }
?>
