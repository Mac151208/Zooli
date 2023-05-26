
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/editarperfil.css">
    <link rel="stylesheet" href="css/estilo.css">
    <script src="js/cep.js"></script>
    <link rel="icon" type="icon" href="img/fotinho.png"/>
    <title>Editar Perfil</title>

</head>
<body>
<!--  PARTE DA NAVBAR   -->
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
            <li><a href="" class="PerfilCuidador"><img src="img/icones/usuario.png" alt="" width="30" height="30"></a></li>
        
            </ul>
        </nav>
    </div>
</header>
<!--  FINAL PARTE DA NAVBAR   -->

    <div class="form-box">
        <form action="#">
            <h2>Editar Perfil</h2>
            <h3>Preencha os campos que deseje Editar</h3>
            
            <img class = "imagem" id="image" src="img/people/2.jpg" alt="Imagem" />
            <button class="buttonEditar">
                <label for="imagemCliente">📷</label>
                <input type="file" id="imagemCliente" for="imagemCliente" >
            </button>

            <script>
                const imagemCliente = document.getElementById("imagemCliente");
                const image = document.getElementById("image");
            
                imagemCliente.addEventListener("change", (event) => {
                    const arquivo = event.target.files[0];
                    const urlImagem = URL.createObjectURL(arquivo);
                    image.src = urlImagem;
                });
            </script>
           
            <div class="input-group">
                <label for="nome"> Nome Completo </label>
                <input type="text" id="nomeCliente" name="nomeCliente" placeholder="Digite o seu nome completo">
            </div>

            <div class="input-group w50">
                <label for="telefone1">Celular</label>
                <input type="tel"id="telefone1Cliente" name="telefone1Cliente" placeholder="Digite o número do seu novo celular">
            </div>

            <div class="input-group w50">
                <label for="telefone2">Celular Reserva</label>
                <input type="tel" id="telefone2Cliente" name="telefone2Cliente"placeholder="Digite o outro número de celular">
            </div>

            <div class="input-group " >
                <label for="endereco"> Endereço</label>
                <input type="text"id="enderecoCliente" name="enderecoCliente" placeholder="Digite o seu novo endereço" >
            </div>

            <div class="input-group w50">
                <label for="cep"> CEP</label>
                <input type="text" id="cepCliente" name="cepCliente" placeholder="Digite o seu CEP" >
            </div>

            <div class="input-group w50">
                <label for="numeroEnd"> Número </label>
                <input type="text" id="numeroEndCliente" name="numeroEndCliente" placeholder="Digite o número" >
            </div>

            <div class="input-group w50">
                <label for="bairro"> Bairro </label>
                <input type="text" id="bairroCliente" name="bairroCliente" placeholder="Digite o seu bairro" >
            </div>

            <div class="input-group w50">
                <label for="cidade"> Cidade </label>
                <input type="text" id="cidadeCliente" name="cidadeCliente" placeholder="Digite sua cidade" >
            </div>

            <div class="input-group w50">
                <label for="uf"> UF </label>
                <input type="text" id="ufCliente" name="ufCliente" placeholder="Digite a UF" >
            </div>

            <div class="input-group w50">
                <label for="complemento"> Complemento</label>
                <input type="text" id="complementoCliente" name="complementoCliente" placeholder="Digite o complemento (Bloco e Apto.)">
            </div>

            <div class="input-group">
                <label for="email">E-mail </label>
                <input type="email" id="emailCliente" name="emailCliente" placeholder="Digite o seu novo email ">
            </div>

            <h4>Caso tenha esquecido a senha ou queria mudar ela, clique no <a href="esqueciSenha.php">link!</a></h4>
            <br>
            <!----------------------------SE CUIDADOR-------------------------------------------------->
            <input type="checkbox" id="campo_cuidador" onclick="mostrarCamposCuidador()"> Sou<span style="color:rgb(254, 1, 130)"> Cuidador </span> 

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
                <div class="input-group">
                    <label for="descricaoCliente"> Sua Descrição </label>
                    <input type="text" id="descricaoCliente" name="descricaoCliente" placeholder="Digite sua nova descrição" >
                </div>

                <div class="input-group">
                    <label for="valorCliente"> Valor Diário que será Cobrado</label>
                    <input type="number" id="valorCliente" name="valorCliente" placeholder="Digite o novo valor que será cobrado" >
                </div>
            </div>
            <!-------------------------------SE TUTOR------------------------------------------------------------->
            <input type="checkbox" id="campo_tutor" onclick="mostrarCamposTutor()"> Sou<span style="color:rgb(255, 215, 20);"> Tutor </span> 

            <script>
                function mostrarCamposTutor() {
                var camposAdicionais = document.getElementById("campoabrir_tutor");
                if (document.getElementById("campo_tutor").checked) {
                    camposAdicionais.style.display = "block";
                } else {
                    camposAdicionais.style.display = "none";
                }
                }
            </script>
            <br><br>
            
            <div id="campoabrir_tutor" style="display:none;">
            <div class="input-group w50">
                    <label for="nomePet"> Nome do Pet </label>
                    <input type="text" id="nomePet" name="nomePet" placeholder="Digite o nome completo do seu Pet">
                </div>

                <div class="input-group w50">
                    <label for="idadePet"> Idade do Pet </label>
                    <input type="number" id="idadePet"  name="idadePet" placeholder="Digite a idade do seu Pet" min="0" max="300" >
                </div>
                
                <div class="input-group w50">
                    <label for="racaPet"> Raça do Pet </label>
                    <input type="text" id="racaPet" name="racaPet" placeholder="Digite a raça do seu Pet" >
                </div>

                <div class="input-group w50">
                    <label for="pesoPet"> Peso do Pet (kg)</label>
                    <input type="number" id="pesoPet" name="pesoPet" placeholder="Digite o peso do seu Pet"  min="0" max="300" >
                </div>

                <div class="input-group">
                    <label for="descricaoPet"> Descrição do Pet </label>
                    <input type="text" id="descricaoPet" name="descricaoPet" placeholder="Digite a descrição do seu Pet (como doenças, costumes etc)" >
                </div>
            </div>

            <button id="editarPerfilCliente" name="editarPerfilCliente" class="button" >Editar<input type="submit" id="editarPerfilCliente" name="editarPerfilCliente"></button>

        </form>
    </div>
</body>
</html>