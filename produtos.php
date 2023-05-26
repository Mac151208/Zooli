<?php
/*if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
     Redirecionar para a página de login
   header('Location: login.php');
    exit;
}*/
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/estilo2.css">
    <link rel="icon" type="icon" href="img/fotinho.png"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="" rel="shortcut icon">
    <script src="js/scripts.js"></script>
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
                            <span class="material-icons">shopping_cart</span>
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
              <h1>Seus Pedidos</h1>
              <div class="cart"></div>
              <div class="cart--details">
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
                  <div class="cart--finalizar" id="Finalizar" name="Finalizar">Finalizar a Compra</div>
              </div>
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
     
      <script  src="js/real.js"></script>
  </body>
  </html>