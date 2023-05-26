<script>
const cartString = JSON.parse(localStorage.getItem('cart'));
const cartImages = JSON.parse(localStorage.getItem('cartImages'));
const cartNames = JSON.parse(localStorage.getItem('cartNames'));
const cartTotal = parseFloat(JSON.parse(localStorage.getItem('cartTotal')));
console.log(cartString);

const cartQt = [];
for (var i = 0; i < cartString.length; i++) {
  var qt = cartString[i].qt;
  cartQt.push(qt);
}

const cartid = [];
for (var i = 0; i < cartString.length; i++) {
  var id = cartString[i].id;
  cartid.push(id);
}
const cartPrice =[];
for (var i = 0; i < cartString.length; i++) {
  var price = cartString[i].price;
  cartPrice.push(price);
}





console.log('Total  '+ cartTotal);
console.log("img"+cartImages);
console.log("names"+cartNames);
console.log("quantidade"+cartQt);
console.log("id"+cartid);

/*eliminando elementos iguais
cartNames = cartNames.filter(function(este, i) {
    return cartNames.indexOf(este) === i;
});*/

var cartValuesDiv = document.getElementById("cartValues");

for (var i = 0; i < cartImages.length; i++) {
  //cartValuesDiv.innerHTML += "<br> Nomes: " + cartNames + "<br> Quantidade: " + cartQt + "<br> IDs: " + cartid;
}

for (var i = 0; i < cartNames.length; i++) {
  console.log("Nome: " + cartNames[i]);
  console.log("Quantidade: " + cartQt[i]);
  console.log("Quantidade: " + cartPrice[i]);
 // console.log("total: " + cartTotal[i]);

  console.log("imagem:"+cartImages[i]);
}





</script>


<script>

let cep = '';
let logradouro = '';
let bairro = '';
let cidade = '';
let estado = '';
let uf = '';
let valorfrete=0;
let tempo = 0;
let real =0;


function cepcalcular() {
  jQuery.ajax({
    url: "calculafrete.php",
    dataType: "json",
    success: function(data) {
      if (Array.isArray(data)) {
        const modelsJson = data.map((frete) => ({
          uf: frete.UF,
          valorfrete: frete.VALOR_FRETE,
          Tempo: frete.TEMPO_ENTREGA_DIAS
        }));
        
        const cep = document.getElementById('cep').value;
        const url = "https://brasilapi.com.br/api/cep/v1/" + cep;
        const req = new XMLHttpRequest();
        req.open("GET", url);
        req.onload = function() {
          if (req.status === 200) {
            const endereco = JSON.parse(req.response);
            logradouro = endereco.street;
      bairro = endereco.neighborhood;
      cidade = endereco.city;
      estado = endereco.state;
            
            let estadoEncontrado = false;
          valorfrete, tempo;
            for (let i = 0; i < modelsJson.length; i++) {
              const item = modelsJson[i];
              if (item.uf.includes(estado)) {
                estadoEncontrado = true;
                valorfrete = item.valorfrete;
                tempo = item.Tempo;
                break;
              }
            }
            
            if (estadoEncontrado) {
              console.log(valorfrete +'tempo:'+ tempo);
              let resultado = document.getElementById('resultado');
              resultado.style.margin = "20px auto";
resultado.style.padding = "10px";
resultado.style.backgroundColor = "#f8f8f8";
resultado.style.border = "1px solid #ccc";
resultado.style.borderRadius = "5px";
resultado.style.boxShadow = "0 0 5px rgba(0, 0, 0, 0.1)";
resultado.style.fontFamily = "Arial, sans-serif";
resultado.style.fontSize = "16px";
resultado.style.display = "block";
resultado.style.width = "400px";
resultado.style.textAlign = "center";

resultado.innerHTML = "<i class='fas fa-truck'></i> Valor do frete: " + valorfrete + ", Aproximadamente " + tempo + " dias para entrega. Endereço: " + logradouro + ", " + bairro + ", " + cidade + ", " + estado;
resultado.style.color = "red";
const valor = parseFloat(valorfrete);

let escrito = document.getElementById('total');



 real = valor + cartTotal;
escrito.innerHTML = 'Valor total: R$ ' +  `R$ ${real.toFixed(2).replace(".", ",")}`;


            } else {
              console.log('estado não encontrado');
            }
          } else if (req.status === 400) {
            alert("Cep inválido!");
          } else {
            alert("Erro ao buscar cep!");
          }
        };
        req.send();
      }
    }
  });
}






</script>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/compra.css">
  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<head>
	<title>Pagamento</title>
</head>
<body>
   


  <table>
    <thead>
      <tr>
        <img src="" alt="">
        <th></th>
        <th>  Nome do Produto    </th>
        <th>Quantidade</th>
      
      </tr>
    </thead>
    <tbody id="tabela-corpo">
    </tbody>
  </table>

  <script>
    // Cria uma nova imagem

    

    // Atribui a string base64 recuperada ao atributo "src" da imagem
   // imagem.src = 'data:image/jpeg;base64,' + '';

    // Adiciona a imagem à página
 //   document.body.appendChild(imagem);

    //  dados do carrinho de compras
    const carrinho = cartNames.map((nome, index) => ({
  img: cartImages[index],
  nome,
  quantidade: cartQt[index] ?? 0, // define 0 como valor padrão se a posição for "undefined"
 
}));
//removendo produtos iguais
const produtos = [];

carrinho.forEach(item => {
  const index = produtos.findIndex(prod => prod.nome === item.nome );
  if (index === -1) {
    produtos.push(item);
  } else {
    produtos[index].quantidade += item.quantidade;
  }
});

    const tabelaCorpo = document.getElementById('tabela-corpo');

    produtos.forEach(produto => {
  const row = document.createElement('tr');
  row.innerHTML = `
    <td><img src="${produto.img}" alt="${produto.nome}"></td>
    <td>${produto.nome}</td>
    <td>${produto.quantidade}</td>
    
  `;
  tabelaCorpo.appendChild(row);
});
function compra(){

}

function boleto(){
  // cria um objeto XHR
var xhr = new XMLHttpRequest();

// configura a solicitação HTTP POST
xhr.open('POST', 'cadastrandocompra.php?boleto=confirmado', true);

// define o tipo de dados que estamos enviando
xhr.setRequestHeader('Content-type', 'application/json');

// cria um objeto com os dados que queremos enviar
var tudo = real + valorfrete + cartImages +cartid + cartQt +cartNames;

// converte os dados em formato JSON
var json = JSON.stringify(tudo);

// envia a solicitação HTTP POST com os dados
xhr.send(json);

xhr.addEventListener('load', function() {
  if (xhr.status === 200) {
    console.log('Dados enviados com sucesso');
  } else {
    console.log('Erro ao enviar dados');
  }
});


}


function valor() {
  var parcelas = document.getElementById("parcelar").value;
  var valorParcela = cartTotal / parseInt(parcelas);
  var valorTotal;
  if (parcelas === "a vista") { // verifica se a opção selecionada é "1x"
    valorTotal = real; // exibe o valor sem juros

  } else {
    console.log(real);
    valorTotal = real / parseInt(parcelas) * 1.05; // adiciona 5% de juros ao total
    const valorparcela = real * 1.05;
    
    document.getElementById("valorTotal").innerHTML = 'Valor da Parcela R$'+valorTotal.toFixed(2).replace(".", ",") ; // arredonda para duas casas decimais
    document.getElementById("total").innerHTML = 'Valor total da compra: R$'+ valorparcela.toFixed(2).replace(".", ","); // arredonda para duas casas decimais

  }
}



  </script>




<div id="cartValues"></div>
<br><br>
<h1>Calcule o valor do Frete</h1>
<input type="text" id="cep" name="cep">
<button onclick="cepcalcular()" >Calcular</button>
<div id="resultado"></div>

	<h1>Forma de Pagamento</h1>
	<form id="paymentForm">
		<input type="radio" name="paymentType" value="card" > Cartão de Crédito <br>
		<input type="radio" name="paymentType" value="boleto" > Boleto Bancário <br>
    

	</form>

	<div id="cardDiv"  style="display: none;">
		<h2>Pagamento com Cartão de Crédito</h2>
		<form id="cardForm" >
			<label for="cardNumber">Número do Cartão:</label>
			<input type="text" id="cardNumber" name="cardNumber"><br><br>
			<label for="cardName">Nome do Titular:</label>
			<input type="text" id="cardName" name="cardName"><br><br>
      
			<label for="cardExpireDate">Data de Validade:</label>
      <input type="text" id="cardExpireDate" name="cardExpireDate"><br><br>
      <label for="parcelamento">Parcelamento:</label> 
<select id="parcelar" name="parcelar" onchange="valor()">
  <option value="a vista">1x</option>
  <option value="2x">2x</option>
  <option value="3x">3x</option>
  <option value="4x">4x</option>
  <option value="5x">5x</option>
  <option value="6x">6x</option>
  <option value="7x">7x</option>
  <option value="8x">8x</option>
  <option value="9x">9x</option>
  <option value="10x">10x</option>
  <option value="11x">11x</option>
  <option value="12x">12x</option>
  






</select><br><br>


			
			
			<label for="cardSecurityCode">Código de Segurança:</label>
			<input type="text" id="cardSecurityCode" name="cardSecurityCode"><br>

      <p id="valorTotal"></p>

			<button type="submit" onclick="compra()" >Confirmar Pagamento</button>
		</form>
	</div>

	<div id="boletoDiv" style="display: none;" >
		<h2>Pagamento com Boleto Bancário</h2>
		<button id="submit" onclick="boleto()">Gerar Boleto</button>
	</div>

    <script>
  // obtém referências aos elementos HTML relevantes
  var cardDiv = document.getElementById("cardDiv");
  var boletoDiv = document.getElementById("boletoDiv");
  var cardRadio = document.querySelector('input[value="card"]');
  var boletoRadio = document.querySelector('input[value="boleto"]');

  // adiciona um ouvinte de evento ao elemento HTML que contém os radio buttons
  document.getElementById("paymentForm").addEventListener("change", function(event) {
    // verifica qual radio button foi selecionado
    if (cardRadio.checked) {
      // mostra o div com o formulário de pagamento com cartão de crédito
      cardDiv.style.display = "block";
      boletoDiv.style.display = "none";
    } else if (boletoRadio.checked) {
      // mostra o div com o botão para gerar o boleto bancário
      cardDiv.style.display = "none";
      boletoDiv.style.display = "block";
    }
  });


 

</script>


<p id="total" name="total"></p>
<?php

?>

