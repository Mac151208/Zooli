<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/perguntas.css">
    <link rel="icon" type="icon" href="img/fotinho.png"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/termos.js"></script>
    <script src="js/cep.js"></script>
    <script src="js/senhaCuidador.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title> Faça seu cadastro</title>
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
                <li><a href="index.html">Inicial</a></li>
                <li><a href="cadastro.html">Cuidadores</a></li>
                <li><a href="">Compras</a></li>
                <li><a href="contato.html">Contato</a></li>
                <li><a href="cadastro.html" class="cadastro"> Cadastra-se</a></li>
                
            </ul>
		</nav>
	</div><!-- header-content -->
</header>
<!--  FINAL PARTE DA NAVBAR   -->

    <div class="form-box">
        <h2>Criar Conta</h2>
        <h3>Preencha o formulário para se cadastrar 😉</h3>
        <br>
        <form action="conexao.php" method="post">

            <div class="input-group">
                <label for="nome"> Nome Completo *</label>
                <input type="text" id="nomeCliente" name="nomeCliente" placeholder="Digite o seu nome completo" required>
            </div>
            
            <div class="input-group w50">
                <label for="idadeCliente"> Sua Idade*</label>
                <input type="number" id="idadeCliente" name="idadeCliente" min="18" max="99" required>
            </div>

            <div class="input-group w50">
                <label for="cpf">CPF *</label>
                <input type="text" inputmode="numeric" id="cpfCliente" name="cpfCliente" placeholder="00000000000" maxlength="11" required>
            </div>

            <div class="input-group w50">
                <label for="telefone1">Celular *</label>
                <input type="tel" id="telefoneCliente" name="telefoneCliente" placeholder="Digite o número do seu celular" maxlength="11" required>
            </div>

            <div class="input-group w50">
                <label for="telefone2">Celular Reserva</label>
                <input type="tel" id="telefoneCliente2" name="telefoneCliente2" placeholder="Digite outro número de celular" maxlength="11">
            </div>

            <div class="input-group" >
                <label for="endereco"> Endereço *</label>
                <input type="text" id="enderecoCliente" name="enderecoCliente" placeholder="Digite o seu endereço" required>
            </div>

            <div class="input-group w50">
                <label for="cep"> CEP *</label>
                <input type="text" id="cepCliente" name="cepCliente" placeholder="Digite o seu CEP" required >
            </div>

            <div class="input-group w50">
                <label for="numeroEnd"> Número *</label>
                <input type="text" id="numeroEndCliente" name="numeroEndCliente" placeholder="Digite o número" required>
            </div>

            <div class="input-group w50">
                <label for="bairro"> Bairro *</label>
                <input type="text" id="bairroCliente" name="bairroCliente" placeholder="Digite o seu bairro" required>
            </div>

            <div class="input-group w50">
                <label for="cidade"> Cidade *</label>
                <input type="text" id="cidadeCliente" name="cidadeCliente" placeholder="Digite sua cidade" required>
            </div>

            <div class="input-group w50">
                <label for="uf"> UF *</label>
                <input type="text" id="ufCliente" name="ufCliente" placeholder="Digite a UF" maxlength="2" required>
            </div>

            <div class="input-group w50">
                <label for="complemento"> Complemento</label>
                <input type="text" id="complementoCliente" name="complementoCliente" placeholder="Digite o complemento (Bloco e Apto.)">
            </div>

            <div class="input-group">
                <label for="email">E-mail *</label>
                <input type="email" id="emailCliente" name="emailCliente" placeholder="Digite o seu e-mail" required>
            </div>

            <div class="input-group w50">
                <label for="senha">Senha *</label>
                <input type="password" inputmode="numeric" minlength="4" maxlength="8" size="8" id="senhaCliente" name="senhaCliente" placeholder="Digite sua senha" required>
            </div>

            <div class="input-group w50">
                <label for="Confirmarsenha">Confirmar Senha *</label>
                <input type="password" inputmode="numeric" minlength="4" maxlength="8" size="8" id="ConfirmarsenhaCliente" name="ConfirmarsenhaCliente" placeholder="Confirme sua senha" required>
            </div>
<!------------------------------------SE CUIDADOR -------------------------------------------------------->
            <input type="checkbox" id="mostrar-camposCuidador" onclick="mostrarCamposCuidador()"> Caso queira <span style="color: rgb(255, 215, 20);">se tornar</span> um cuidador  

            <script>
                function mostrarCamposCuidador() {
                var camposAdicionais = document.getElementById("campos-adicionaisCuidador");
                if (document.getElementById("mostrar-camposCuidador").checked) {
                    camposAdicionais.style.display = "block";
                } else {
                    camposAdicionais.style.display = "none";
                }
                }
            </script>
            <br><br>
            <div id="campos-adicionaisCuidador" style="display:none;">

                <div class="input-group">
                    <label for="imagemCuidador"> Sua Foto(.png)*</label>
                    <input type="file" id="imagemCuidador" name="imagemCuidador" class="editarFoto" >
                </div>

                <div class="input-group">
                    <label for="descricaoCuidador"> Sua Descrição *</label>
                    <input type="text" id="descricaoCuidador" name="descricaoCuidador" placeholder="Digite sua descrição (isso será visualizado pelo Tutor )" >
                </div>

                <div class="input-group">
                    <label for="valorCuidador"> Valor Diário que será Cobrado *</label>
                    <input type="number" id="valorCuidador" name="valorCuidador" placeholder="Inserir o valor que será cobrado" min="0" max="100" >
                </div>
            </div>
            
<!------------------------------------SE TUTOR-------------------------------------------------------------------------->
            <input type="checkbox" id="mostrar-camposTutor" onclick="mostrarCamposTutor()"> Caso queira <span style="color: rgb(254, 1, 130);">encontrar</span> um Cuidador  

            <script>
                function mostrarCamposTutor() {
                var camposAdicionais = document.getElementById("campos-adicionaisTutor");
                if (document.getElementById("mostrar-camposTutor").checked) {
                    camposAdicionais.style.display = "block";
                } else {
                    camposAdicionais.style.display = "none";
                }
                }
            </script>

            <div id="campos-adicionaisTutor" style="display:none;">
            <br>
                <div class="input-group">
                    <label for="nomePet"> Nome do Pet *</label>
                    <input type="text" id="nomePet" name="nomePet" placeholder="Digite o nome completo do seu Pet">
                </div>

                <div class="input-group w50">
                    <label for="idadePet"> Idade do Pet *</label>
                    <input type="number" id="idadePet"  name="idadePet" placeholder="Digite a idade do seu Pet" min="0" max="300" >
                </div>

                <div class="input-group w50">
                    <label for="imagemPet"> Foto do Pet (.png)*</label>
                    <input type="file" id="imagemPet" name="imagemPet" class="editarFoto" >
                </div>
                
                <div class="input-group w50">
                    <label for="racaPet"> Raça do Pet *</label>
                    <input type="text" id="racaPet" name="racaPet" placeholder="Digite a raça do seu Pet" >
                </div>

                <div class="input-group w50">
                    <label for="pesoPet"> Peso do Pet (kg)*</label>
                    <input type="number" id="pesoPet" name="pesoPet" placeholder="Digite o peso do seu Pet"  min="0" max="300" >
                </div>

                <div class="input-group">
                    <label for="descricaoPet"> Descrição do Pet *</label>
                    <input type="text" id="descricaoPet" name="descricaoPet" placeholder="Digite a descrição do seu Pet (como doenças, costumes etc)" >
                </div>
            </div>
            <br> <br>
<!------------------------------------------------------------------------------------------------------------------------>

            <div class="termos">
            <input type="checkbox" class="checkbox" id="termosCuidador" name="termosCuidador" required> Você concorda com os Termos de Uso *</a>
            </div>
        
            <button id="cadastrarCliente" type="submit" name="cadastrarCliente" class="button">Cadastrar<input type="submit" id="cadastrarCliente" name="cadastrarCliente" ></button>  
    
        </form>
    </div>
</body>
</html>


