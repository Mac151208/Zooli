<?php

session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if(isset($_REQUEST['valor']) and ($_REQUEST['valor'] == 'enviado'))
 {
    $Botao = $_POST["Botao"];
    $messageresposta=$_POST["mensagem"];
    $Nome=$_POST["nome"];
    $id_avaliacao=$_POST["id_avaliacao"];


if ($Botao == "Inserir")
{
    require 'PHPMailer-master/src/PHPMailer.php';
    require 'PHPMailer-master/src/SMTP.php';

    $mail = new PHPMailer(true);

        $name = $_POST['nome'];
        $email = $_POST['email'];
        $message = $_POST['mensagem'];

        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Host = 'smtp.office365.com';
        $mail->Port = 587;
        $mail->SMTPSecure = 'STARTTLS';
        $mail->SMTPAuth = true;

        $mail->Username = 'zooli.pets@hotmail.com';
        $mail->Password = 'Zooli+pet';
        $mail->setFrom('zooli.pets@hotmail.com', 'Zooli');
        $mail->addReplyTo($email, $name);
        $mail->addAddress($email);
        $mail->Subject = 'Resposta a sua Avaliação';
        $mail->Body    = $message;

        if(!$mail->send()) {

          echo "<script>alert('Mensagem não pôde ser enviada.');</script>";
          echo 'Erro do Mailer: ' . $mail->ErrorInfo;

        } else {

          echo "<script>alert('Mensagem enviada com sucesso!'); window.location.href='cadastrosAdm.php';</script>";
          $servername = "localhost";
          $username = "root";
          $password = "";
          $dbname = "dbpets";

          // Cria a conexão
          $conn = new mysqli($servername, $username, $password, $dbname);

          // Verifica a conexão
          if ($conn->connect_error) {

            die("Falha na conexão: " . $conn->connect_error);

          }
          $sql="UPDATE tb_avaliacao SET status_avaliacao='respondido' WHERE ID_AVALIACAO =$id_avaliacao";
          if($conn->query($sql)===True){
            //echo"STATUS mudado";
          }
          else{
            echo "<script>alert('Não foi possivel acessar');</script>";
          }
        }
      }}
else {

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/respondermessage.css">
    <link rel="stylesheet" href="css/form.css">
    <link rel="icon" type="icon" href="img/fotinho.png"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="js/scripts.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Avaliacões</title>
</head>
  <h2>Avaliações a Serem Respondidas:</h2> <br>
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

// Seleciona os dados da tabela "mensagens"
$sql = "SELECT ID_AVALIACAO, NOME_AVALIACAO, EMAIL_AVALIACAO, ASSUNTO_AVALIACAO, ESTRELA_AVALIACAO FROM tb_avaliacao WHERE status_avaliacao <>'respondido'" ;

$result = $conn->query($sql);
$conn->set_charset("utf8");

// Verifica se há resultados

if ($result->num_rows > 0) {

  // Exibe os resultados
  $id_avaliacao1=null;

  while ($row = $result->fetch_assoc()) {

    $id_avaliacao1= $row['ID_AVALIACAO'];
    echo '<div class="mensagem" onclick="exibirFormulario(' . $row['ID_AVALIACAO'] . ')">';
    echo '<h3>' . $row['NOME_AVALIACAO'] . '</h3> : ';
    echo '<p>' . $row['EMAIL_AVALIACAO'] . '</p>, nota: ';
    echo '<p>' . $row['ESTRELA_AVALIACAO'] . '</p>';
    echo '</div>';

  }

  ?>

  <!-- Close the while loop's curly brace here -->

  <div id="formulario-container" style="display:none;">
    
    <form id="formulario" action="respondermessage.php?valor=enviado" method="post">
    <div class="input-group">

      <input type="hidden" name="id_avaliacao" id="id_avaliacao" Readonly  value="">
    </div>
    <div class="input-group">
      <label>Nome do Cliente:</label>
      <input type="text" id="nome" name="nome" Readonly >
    </div>
    <div class="input-group">
      <label> Email do Cliente:</label>
      <input type="email" id="email" name="email"  Readonly >
    </div>
    <div class="input-group">
      <label> Estrela dada pelo Cliente:</label>
      <input type="text" id="estrela" name="estrela"  Readonly >
    </div>
    <div class="input-group">
      <label> Avaliação do Cliente:</label>
      <input type="text" id="assunto" name="assunto"  Readonly >
    </div>
    <div class="input-group">
      <label>Sua mensagem de Resposta:</label>

      <input id="mensagem" name="mensagem" placeholder="Digite sua mensagem" required></input>
    </div>
      <button id="Botao" type="submit" name="Botao" value ="Inserir"class="ButtonADM">Enviar Mensagem</button>  
    </form>

  </div>

  <script>

    function exibirFormulario(ID_AVALIACAO) {

      // Envia uma solicitação AJAX para recuperar os dados da mensagem
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {

        if (this.readyState == 4 && this.status == 200) {

          // Preenche os campos do formulário com os dados da mensagem
          var mensagem = JSON.parse(this.responseText);
          document.getElementById('id_avaliacao').value = mensagem.ID_AVALIACAO;
          document.getElementById('nome').value = mensagem.NOME_AVALIACAO;
          document.getElementById('email').value = mensagem.EMAIL_AVALIACAO;
          document.getElementById('estrela').value = mensagem.ESTRELA_AVALIACAO;
          document.getElementById('assunto').value = mensagem.ASSUNTO_AVALIACAO;
          document.getElementById('mensagem').focus();

          // Exibe o formulário
          document.getElementById('formulario-container').style.display = 'block';

        }

      };

      xhttp.open('GET', 'recuperar_avaliacao.php?id=' + ID_AVALIACAO, true);
      xhttp.send();

    }

  </script>

  <?php

} else {
  echo "<script>alert('Não há mensagens.'); window.location.href='cadastrosAdm.php';</script>";


}

}

?>
