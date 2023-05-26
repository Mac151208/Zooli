<?php
    
    if($_POST) {
        $senhaCliente          = $_POST['senhaCliente'];
        $ConfirmarsenhaCliente  = $_POST['ConfirmarsenhaCliente'];
        if ($senhaCliente == $ConfirmarsenhaCliente) {
           
            $cpfCliente = $_POST['cpfCliente'];
            // Remove os caracteres não numéricos do CPF
            $cpfCliente = preg_replace('/[^0-9]/is', '', $cpfCliente);

            // Verifica se o CPF possui 11 dígitos
            if (strlen($cpfCliente) != 11) {
                echo "CPF inválido!";
            } else {
                // Verifica se todos os dígitos são iguais
                if (preg_match('/(\d)\1{10}/', $cpfCliente)) {
                    echo "CPF inválido!";
                } else {
                    // Calcula os dígitos verificadores
                    for ($i = 9; $i < 11; $i++) {
                        for ($j = 0, $soma = 0; $j < $i; $j++) {
                            $soma += $cpfCliente[$j] * (($i + 1) - $j);
                        }
                        $resto = $soma % 11;
                        if ($resto < 2) {
                            $dg = 0;
                        } else {
                            $dg = 11 - $resto;
                        }
                        if ($cpfCliente[$i] != $dg) {
                            echo "CPF inválido!";
                            $valido = false;
                            break;
                        } else {
                            $valido = true;
                        }
                    }
                }
            }

            // Executa a programação caso o CPF seja válido
            if ($valido) {
                
                //conexão do banco com o formulario
                $conexao = new MySQLi('localhost', 'root', '', 'dbpets');
            
                
                $nomeCliente= isset($_POST['nomeCliente']) ? $_POST['nomeCliente'] : "";
                $idadeCliente = isset($_POST['idadeCliente']) ? $_POST['idadeCliente'] : "";
                $cpfCliente = isset($_POST['cpfCliente']) ? $_POST['cpfCliente'] : "";
                $telefoneCliente = isset($_POST['telefoneCliente']) ? $_POST['telefoneCliente'] : "";
                $telefoneCliente2 = isset($_POST['telefoneCliente2']) ? $_POST['telefoneCliente2'] : "";
                $emailCliente = isset($_POST['emailCliente']) ? $_POST['emailCliente'] : "";
                $senhaCliente = isset($_POST['senhaCliente']) ? $_POST['senhaCliente'] : "";

                $enderecoCliente = isset($_POST['enderecoCliente']) ? $_POST['enderecoCliente'] : "";
                $cepCliente = isset($_POST['cepCliente']) ? $_POST['cepCliente'] : "";
                $numeroEndCliente = isset($_POST['numeroEndCliente']) ? $_POST['numeroEndCliente'] : "";
                $bairroCliente = isset($_POST['bairroCliente']) ? $_POST['bairroCliente'] : "";
                $cidadeCliente = isset($_POST['cidadeCliente']) ? $_POST['cidadeCliente'] : "";
                $ufCliente = isset($_POST['ufCliente']) ? $_POST['ufCliente'] : "";
                $complementoCliente = isset($_POST['complementoCliente']) ? $_POST['complementoCliente'] : "";
               
                $imagemCuidador = isset($_POST['imagemCuidador']) ? $_POST['imagemCuidador'] : "";
                $descricaoCuidador = isset($_POST['descricaoCuidador']) ? $_POST['descricaoCuidador'] : "";
                $valorCuidador = isset($_POST['valorCuidador']) ? $_POST['valorCuidador'] : "";
                
                $nomePet = isset($_POST['nomePet']) ? $_POST['nomePet'] : "";
                $idadePet = isset($_POST['idadePet']) ? $_POST['idadePet'] : "";
                $imagemPet = isset($_POST['imagemPet']) ? $_POST['imagemPet'] : "";
                $racaPet = isset($_POST['racaPet']) ? $_POST['racaPet'] : "";
                $pesoPet = isset($_POST['pesoPet']) ? $_POST['pesoPet'] : "";
                $descricaoPet = isset($_POST['descricaoPet']) ? $_POST['descricaoPet'] : "";

              


                $sql = "INSERT INTO tb_cliente (NOME_CLIENTE, IDADE_CLIENTE, CPF_CLIENTE, FONE_CLIENTE, FONE_CLIENTE2, EMAIL_CLIENTE, SENHA_CLIENTE)
                                        VALUES ('$nomeCliente', '$idadeCliente', '$cpfCliente', '$telefoneCliente', '$telefoneCliente2', '$emailCliente', '$senhaCliente') ";

                // Executa a consulta SQL e obtém o ID do cliente inserido
                if ($conexao->query($sql) === TRUE) {
                    $id_cliente = $conexao->insert_id;

                    // Insere os dados do endereço com o ID do cliente
                    $sql_endereco = "INSERT INTO tb_endereco_cliente (ID_CLIENTE, RUA_ENDERECO_CLIENTE, CEP_ENDERECO_CLIENTE, NUM_ENDERECO_CLIENTE, BAIRRO_ENDERECO_CLIENTE, CIDADE_ENDERECO_CLIENTE, UF_ENDERECO_CLIENTE,  COMP_ENDERECO_CLIENTE)  
                    VALUES ('$id_cliente', '$enderecoCliente', '$cepCliente', '$numeroEndCliente', '$bairroCliente', '$cidadeCliente', '$ufCliente', '$complementoCliente')";

                    $resultado = $conexao->query($sql_endereco) or trigger_error($conexao->error);

                    // Verifica se o campo oculto foi selecionado = CUIDADOR
                   
                        $mostrarCuidador = "INSERT INTO TB_CUIDADOR (ID_CLIENTE, IMAGEM_CUIDADOR, DESCRICAO_CUIDADOR, VALOR_CUIDADOR) 
                        VALUES ('$id_cliente', '$imagemCuidador', '$descricaoCuidador' , '$valorCuidador')";
                        if($conexao->query($mostrarCuidador)==TRUE){
                            echo "<script>alert('Dados inseridos com sucesso'); window.location.href='provinhaCuidador.php';</script>";
                        }

                     
                    // Verifica se o campo oculto foi selecionado = TUTOR
                 
                        $mostrarTutor = "INSERT INTO TB_TUTOR (ID_CLIENTE, NOME_TUTORPET,  IMAGEM_TUTORPET, IDADE_TUTORPET, RACA_TUTORPET, PESO_TUTORPET, DESCRICAO_TUTORPET) 
                        VALUES ('$id_cliente', '$nomePet',  '$imagemPet', '$idadePet', '$racaPet', '$pesoPet', '$descricaoPet')";
                        $tutor = $conexao->query( $mostrarTutor);

                        echo "<script>alert('Dados inseridos com sucesso'); window.location.href='login.php';</script>";
                    
                        
                    
                } else {
                    echo "<script>alert('Erro ao inserir os dados no db'); window.location.href='cadastroCliente.php';</script>" ;
                }

                $conexao->close();
            
            }
            else if($valido = false){
                echo "o CPF: ". $cpfCliente . " É falso! " ;
            }

        } 
        
        else {
            echo "<script>alert('As senhas não conferem!'); window.location.href='cadastroCliente.php';</script>" ;
        }

    }
?>