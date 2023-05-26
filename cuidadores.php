<?php
session_start();
// Obter o ID do cliente (substitua essa linha pelo código real para obter o ID do cliente)
$idCliente = $_SESSION['idCliente'];

// Resto do código HTML
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuidadores</title>
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/estilo2.css">
    <link rel="icon" type="icon" href="img/fotinho.png"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/models.js"></script>
    <link href="" rel="shortcut icon">
</head>
<body>
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
                    <li><a href="editarPerfil.php" class="PerfilCuidador"><img src="img/icones/usuario.png" alt="" width="30px" height="30px"></a></li>
                    <li><a href="sair.php"><img src="img/icones/sair.png" width="25px" height="25px"></a></li>
                    <li>
                        <div class="menu-openner">
                            <span>0</span>
                            <span class="material-symbols-outlined">pets</span>
                        </div>
                    </li> 
                </ul>
            </nav>
        </div>
    </header>
    <div class="models">
          <div class="models-item">
              <a href="">
                  <div class="models-item--img"><img src="" /></div>
                  <div class="models-item--add">+</div>
              </a>
              <div class="models-item--price">R$ --</div>
              <div class="models-item--name">--</div>
              <div class="models-item--desc">--</div>
          </div>
          <div class="cart--item">
              <img src="" />
              <div class="cart--item-nome">--</div>
              <div class="cart--item--qtarea">
                  <button class="cart--item-qtmenos">-</button>
                  <div class="cart--item--qt">1</div>
                  <button class="cart--item-qtmais">+</button>
              </div>
          </div>
      </div>
      <main>
          <div class="models-area"></div>
      </main>
      
      <aside>
          <div class="cart--area">
              <div class="menu-closer">
                  <span class="material-icons">close</span>
              </div>
              <form action="finalizarCompraCuidadores.php" method="POST">
                <h1>Seus Pedidos</h1>
                <div class="cart"></div>
                <div class="cart--details">
                    <div class="cart--totalitem ">
                        Data de Entrada: <input type="date" id="dataEntrada" name="dataEntrada"></input> <br> 
                        Período de Entrada: <select name="horario inicial" id="">
                            <option value="manha">Manhã</option>
                            <option value="tarde">Tarde</option>
                            <option value="noite">Noite</option>
                        </select> <br> 
                        Data de Saída: <input type="date" id="dataSaida" name="dataSaida"></input> <br>
                        Período de Saída: <select name="horario final" id="">
                            <option value="manha">Manhã</option>
                            <option value="tarde">Tarde</option>
                            <option value="noite">Noite</option>
                        </select>
                        <button onclick="calcularDiferenca()">Calcular</button>
                        <p id="resultadodata" style="color: rgb(254, 1, 130);"></p> 
                        <script>
                            function calcularDiferenca() {
                            var dataEntrada = new Date(document.getElementById("dataEntrada").value);
                            var dataSaida = new Date(document.getElementById("dataSaida").value);

                            var diferenca = dataSaida.getTime() - dataEntrada.getTime();
                            var dias = diferenca / (1000 * 3600 * 24); // Converter milissegundos em dias

                            document.getElementById("resultadodata").innerHTML = "A diferença é de " + dias + " dias.";

                            var total = parseFloat(document.querySelector('.cart--totalitem.total.big span:last-child').textContent.replace('R$ ', ''));
                            var resultadoMultiplicacao = total * dias;

                            document.querySelector('.cart--totalitem.total.big span:last-child').textContent = 'R$ ' + resultadoMultiplicacao.toFixed(2);
                            }
                        </script>
                    </div>
                    <div class="cart--totalitem subtotal">
                        <span>Subtotal</span>
                        <span>R$ --</span>
                    </div>
                    <div class="cart--totalitem desconto">
                    <label for="coupon-code">Código do Cupom:</label>
                            
                    <input type="text" id="cupom" placeholder="Código do cupom">
                    <button type="button"  name="aplicar-cupom-btn" id="aplicar-cupom-btn" >Aplicar</button>  
                    <p id="resultado" names="resultado" style="color: rgb(254, 1, 130);">   Aceitamos só um cupom para cada compra! </p>                
                    <span>Desconto</span>
                        <span>R$ --</span>
                    </div>
                    <div class="cart--totalitem total big">
                        <span>Total</span>
                        <span style="color: rgb(13, 184, 254);">R$ --</span>
                    </div>
                    <input type="hidden" id="idCliente" value="<?php echo $idCliente; ?>">
                    <button type="submit" id="Finalizar" name="Finalizar" class="cart--finalizar">Finalizar a Compra</button>
                </div>
            </form>
          </div>
      </aside>
      <div class="modelsWindowArea">
          <div class="modelsWindowBody">
              <!-- 
                  Este botão é o cancelar do mobile (mostrar com F12) a ação do cancelar
                  da janela modal vai ser igual, logo vamos fazer uma função
              -->
              <div class="modelsInfo--cancelMobileButton">Voltar</div>
              <div class="modelsBig">
                  <img src="" />
              </div>
              <div class="modelsInfo">
                  <h1>--</h1>
                  <div class="modelsInfo--desc">--</div>
                
                  <div class="modelsInfo--pricearea">
                      <div class="modelsInfo--sector">Preço</div>
                      <div class="modelsInfo--price">
                          <div class="modelsInfo--actualPrice">R$ --</div>
                          <div class="modelsInfo--qtarea">
                              <button class="modelsInfo--qtmenos">-</button>
                              <div class="modelsInfo--qt">1</div>
                              <button class="modelsInfo--qtmais">+</button>
                          </div>
                      </div>
                  </div>
                  <div class="modelsInfo--addButton">Adicionar ao Carrinho</div>
                  <div class="modelsInfo--cancelButton">Cancelar</div>
              </div>
          </div>
      </div>
     
    <script  src="js/cuidadores.js"></script>
    
</body>
</html>
