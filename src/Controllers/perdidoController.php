<?php
    namespace SistemaAnimais\Controllers;

    use SistemaAnimais\DAOs\perdidoDAO;
    use SistemaAnimais\DAOs\animalDAO;
    use SistemaAnimais\DAOs\tutorDAO;
    
    use SistemaAnimais\Models\Perdido;
    use SistemaAnimais\Models\Animal;
    use SistemaAnimais\Models\Tutor;

    class perdidoController
    {
        // INSERIR ou CADASTRAR NOVO ANIMAL PERDIDO
        public function inserir()
        {
            $msg = array("","","","","","","","","","","","","","","","");
            if($_POST)
            {
                $tipos = array("image/png","image/jpeg");
                $erro = false;
                if(empty($_POST["nome_animal"]))
                {
                    $msg[0] = "Preencha o nome";
                    $erro = true;
                }
                if(empty($_POST["datan"]))
                {
                    $msg[1] = "Preencha a data de nascimento";
                    $erro = true;
                }
                if(empty($_POST["sexo"]))
                {
                    $msg[2] = "Selecione uma opção";
                    $erro = true;
                }
                if(empty($_POST["especie"]))
                {
                    $msg[3] = "Preencha a espécie";
                    $erro = true;
                }
                if(empty($_POST["raca"]))
                {
                    $msg[4] = "Preencha a raça";
                    $erro = true;
                }
                if(empty($_POST["pelagem"]))
                {
                    $msg[5] = "Preencha a pelagem";
                    $erro = true;
                }
                if(empty($_FILES["imagem"]["name"]))
                {
                    $msg[6] = "Forneça uma imagem ou arquivo";
                    $erro = true;
                }
                if(empty($_POST["locald"]))
                {
                    $msg[7] = "Forneça um local de desaparecimento";
                    $erro = true;
                }
                if(empty($_POST["datad"]))
                {
                    $msg[8] = "Selecione uma data";
                    $erro = true;
                }
                if(empty($_POST["horad"]))
                {
                    $msg[9] = "Selecione um horário próximo";
                    $erro = true;
                }
                if(empty($_POST["nome_tutor"]))
                {
                    $msg[10] = "Informe o nome do tutor";
                    $erro = true;
                }
                if(empty($_POST["sobrenome"]))
                {
                    $msg[11] = "Informe o sobrenome do tutor";
                    $erro = true;
                }
                if(empty($_POST["telefone1"]))
                {
                    $msg[12] = "Informe um telefone para contato";
                    $erro = true;
                }
                
                $imagem = null;
                if(isset($_FILES["imagem"]) && $_FILES["imagem"]["error"] == 0)
                {
                    $target_dir = "src/perdidos-img/";
                    $target_file = $target_dir . basename($_FILES["imagem"]["name"]); 
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                    $check = getimagesize($_FILES["imagem"]["tmp_name"]);
                    if($check !== false)
                    {
                        if(move_uploaded_file($_FILES["imagem"]["tmp_name"], $target_file))
                        {
                            $imagem = $target_file;
                        }
                        else
                        {
                            $msg[6] = "Erro ao enviar arquivo";
                            $erro = true;
                        }
                    }
                    else
                    {
                        $msg[6] = "Arquivo não suportado";
                        $erro = true;
                    }
                }
                if(!$erro)
                {
                    $tutor = new Tutor(nome:$_POST["nome_tutor"], sobrenome:$_POST["sobrenome"], rg:"", cpf:"", cep:"", logradouro:"", numero:"", bairro:"", telefone1:$_POST["telefone1"], telefone2:$_POST["telefone2"]);
                    $tutorDAO = new tutorDAO();
                    $tutorId = $tutorDAO->inserir($tutor);
                    $tutor->setId($tutorId);

                    $animal = new Animal(rga:$_POST["rga"], chip:$_POST["chip"], nome:$_POST["nome_animal"], datan:$_POST["datan"], sexo:$_POST["sexo"], alergias:$_POST["alergias"], doencas:$_POST["doencas"], cirurgias:$_POST["cirurgias"], peso:$_POST["peso"], especie:$_POST["especie"], raca:$_POST["raca"], pelagem:$_POST["pelagem"], aquisicao:$_POST["aquisicao"], tutor:$tutor);
                    $animalDAO = new animalDAO();
                    $animalId = $animalDAO->inserir($animal);
                    $animal->setId($animalId);
                    

                    $perdido = new Perdido(animal:$animal, imagem:$imagem, locald:$_POST["locald"], datad:$_POST["datad"], horad:$_POST["horad"], descritivo:$_POST["descritivo"], tutor:$tutor, status:$_POST["status"]);

                    $perdidoDAO = new perdidoDAO();
                    $retorno = $perdidoDAO->inserir($perdido);
                    $msg = "Animal cadastrado com sucesso";

                    header("location:index.php?controle=perdidoController&metodo=listar&msg=$msg");
                }
            }
            require_once "Views/perdido/form-animal-perdido.php";
        }

        // LISTAR
        public function listar()
        {
            $limite = 15;

            $pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
            $offset = ($pagina_atual - 1) * $limite;

            $perdidoDAO = new perdidoDAO();
            $retorno = $perdidoDAO->buscar_perdidos_paginados($offset, $limite);

            $total_registros = $perdidoDAO->contar_perdidos();
            // VERIFICA SESSAO DO VETERINARIO P/ EXIBIR DADOS PRIVADOS
            session_start();
            if(!isset($_SESSION["id_vet"]))
            {
                header("location:index.php?controle=perdidoController&metodo=listar_publico");
                exit();
            }

            require_once "Views/perdido/listar-animais-perdidos.php";
        }

        // LISTAR PUBLICO
        public function listar_publico()
        {
            $limite = 15;

            $pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
            $offset = ($pagina_atual - 1) * $limite;

            $perdidoDAO = new perdidoDAO();
            $retorno = $perdidoDAO->buscar_perdidos_paginados_pub($offset, $limite);

            $total_registros = $perdidoDAO->contar_perdidos();

            require_once "Views/perdido/pub-listar-animais-perdidos.php";
            return $retorno;
        }

        // LISTAR EM ORDEM ALFABETICA
        public function listar_alf()
        {
            $limite = 15;

            $pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
            $offset = ($pagina_atual - 1) * $limite;

            $perdidoDAO = new perdidoDAO();
            $retorno = $perdidoDAO->ordenar_perdidos_alf($offset, $limite);

            $total_registros = $perdidoDAO->contar_perdidos();

            // VERIFICA SESSAO DO VETERINARIO P/ EXIBIR DADOS PRIVADOS
            session_start();
            if(!isset($_SESSION["id_vet"]))
            {
                header("location:index.php?controle=perdidoController&metodo=listar_alf_publico");
                exit();
            }

            require_once "Views/perdido/listar-animais-perdidos.php";
        }

        // LISTAR EM ORDEM ALFABETICA PUBLICO
        public function listar_alf_publico()
        {
            $limite = 15;

            $pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
            $offset = ($pagina_atual - 1) * $limite;

            $perdidoDAO = new perdidoDAO();
            $retorno = $perdidoDAO->ordenar_perdidos_alf_publico($offset, $limite);

            $total_registros = $perdidoDAO->contar_perdidos();

            require_once "Views/perdido/pub-listar-animais-perdidos.php";
            return $retorno;
        }

        // LISTAR POR NOME DO TUTOR
        public function listar_tutor()
        {
            $limite = 15;

            $pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
            $offset = ($pagina_atual - 1) * $limite;

            $perdidoDAO = new perdidoDAO();
            $retorno = $perdidoDAO->ordenar_perdidos_tutor($offset, $limite);

            $total_registros = $perdidoDAO->contar_perdidos();

            // VERIFICA SESSAO DO VETERINARIO P/ EXIBIR DADOS PRIVADOS
            session_start();
            if(!isset($_SESSION["id_vet"]))
            {
                header("location:index.php?controle=perdidoController&metodo=listar_tutor_publico");
                exit();
            }

            require_once "Views/perdido/listar-animais-perdidos.php";
        }

        // LISTAR POR NOME DO TUTOR PUBLICO
        public function listar_tutor_publico()
        {
            $limite = 15;

            $pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
            $offset = ($pagina_atual - 1) * $limite;

            $perdidoDAO = new perdidoDAO();
            $retorno = $perdidoDAO->ordenar_perdidos_tutor_publico($offset, $limite);

            $total_registros = $perdidoDAO->contar_perdidos();

            require_once "Views/perdido/pub-listar-animais-perdidos.php";
        }

        // BUSCAR UM ANIMAL (PERFIL)
        public function buscar_perdido()
        {
            // VERIFICA SESSAO DO VETERINARIO P/ EXIBIR DADOS PRIVADOS
            session_start();
            if(!isset($_SESSION["id_vet"]))
            {
                header("location:index.php?controle=perdidoController&metodo=buscar_perdido_publico&id=". $_GET['id']);
                exit();
            }

            if(isset($_GET["id"]))
            {
                $perdido = new Perdido($_GET["id"]);
                $perdidoDAO = new perdidoDAO();
                $retorno = $perdidoDAO->buscar_perdido($perdido);

                require_once "Views/perdido/perfil-perdido.php";
                return $retorno;
            }
        }

        // BUSCAR UM ANIMAL PUBLICO (PERFIL)
        public function buscar_perdido_publico()
        {
            if(isset($_GET["id"]))
            {
                $perdido = new Perdido($_GET["id"]);
                $perdidoDAO = new perdidoDAO();
                $retorno = $perdidoDAO->buscar_perdido_publico($perdido);

                require_once "Views/perdido/pub-perfil-perdido.php";
                return $retorno;
            }
        }



        // GERAR PDF DO PERFIL DO ANIMAL
        public function gerar_pdf()
		{
            if(isset($_GET["id"]))
            {
                $perdido = new Perdido($_GET["id"]);
                $perdidoDAO = new perdidoDAO();
                $retorno = $perdidoDAO->buscar_perdido_publico($perdido);
            }
			require_once "Views/perdido/pdf-perdido.php";
		}

        // EXCLUIR
        public function excluir()
		{
			if(isset($_GET["id"]))
			{
				$perdido = new Perdido($_GET["id"]);
				$perdidoDAO = new perdidoDAO();
				$retorno = $perdidoDAO->excluir($perdido);
				header("location:index.php?controle=perdidoController&metodo=listar&msg=$retorno");
			}
		}
    }

    

