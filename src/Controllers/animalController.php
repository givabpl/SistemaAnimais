<?php
    namespace SistemaAnimais\Controllers;

    use SistemaAnimais\DAOs\animalDAO;
    use SistemaAnimais\DAOs\tutorDAO;
    
    use SistemaAnimais\Models\Animal;
    use SistemaAnimais\Models\Tutor;

    class animalController
    {
        // INSERIR ou CADASTRAR NOVO ANIMAL
        public function inserir()
        {
            $tutorDAO = new tutorDAO();
            $retorno = $tutorDAO->buscar_tutores();
            $msg = array("","","","","","","","","","","","","");
            if($_POST)
            {
                $erro = false;
                if(empty($_POST["rga"]))
                {
                    $msg[0] = "Informe o n° do rga";
                    $erro = true;
                }
                if(empty($_POST["nome"]))
                {
                    $msg[1] = "Preencha o nome";
                    $erro = true;
                }
                if(empty($_POST["datan"]))
                {
                    $msg[2] = "Preencha a data de nascimento";
                    $erro = true;
                }
                if($_POST["sexo"] === "0")
                {
                    $msg[3] = "Selecione o sexo";
                    $erro = true;
                }
                if(empty($_POST["peso"]))
                {
                    $msg[4] = "Informe o peso";
                    $erro = true;
                }
                if(empty($_POST["especie"]))
                {
                    $msg[5] = "Preencha o espécie";
                    $erro = true;
                }
                if(empty($_POST["raca"]))
                {
                    $msg[6] = "Preencha a raça";
                    $erro = true;
                }
                if(empty($_POST["pelagem"]))
                {
                    $msg[7] = "Preencha a pelagem";
                    $erro = true;
                }
                if(empty($_POST["aquisicao"]))
                {
                    $msg[8] = "Selecione a aquisição";
                    $erro = true;
                }
                if(empty($_POST["tutor"]))
                {
                    $msg[9] = "Selecione o tutor";
                    $erro = true;
                }
                if(!empty($_POST["rga"]))
                {
                    $animal = new Animal(rga:$_POST["rga"]);
                    $animalDAO = new animalDAO();
                    $retorno = $animalDAO->buscar_rga($animal);

                    if(is_array($retorno) && count($retorno) > 0)
                    {
                        if (strlen($retorno[0]->rga) <= 4) // Verifica se o RGA tem 4 ou menos caracteres (para o caso de RGAs como '000' ou '---', que são inválidos, mas irão existir no banco de dados para animais que não possuem RGA) - corrigir problema aaa
                        {
                            $erro = false;
                        }
                        else{
                            $msg[0] = "Rga já cadastrado";
                            $erro = true;
                        }
                    }
                }
                if(!$erro)
                {
                    $tutor = new Tutor($_POST["tutor"]);

                    $animal = new Animal(rga:$_POST["rga"], chip:$_POST["chip"], nome:$_POST["nome"], datan:$_POST["datan"], sexo:$_POST["sexo"], alergias:$_POST["alergias"], doencas:$_POST["doencas"], cirurgias:$_POST["cirurgias"], peso:$_POST["peso"], especie:$_POST["especie"], raca:$_POST["raca"], pelagem:$_POST["pelagem"], aquisicao:$_POST["aquisicao"], tutor:$tutor);

                    $animalDAO = new animalDAO();
                    $ret = $animalDAO->inserir($animal);
                    $msg = "Animal cadastrado com sucesso";

                    header("location:index.php?controle=animalController&metodo=listar&msg=$msg");
                }
            }
            require_once "Views/animal/form-animal.php";
        }

        // EDITAR 
        public function editar()
        {
            if(isset($_GET["id"]))
            {
                $animal = new Animal($_GET["id"]);
                $animalDAO = new animalDAO();
                $retorno = $animalDAO->buscar_animal($animal);
            }

            $msg = array("","","","","","","","","","");
            if($_POST)
            {
                $erro = false;
                if(empty($_POST["nome"]))
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
                    $msg[2] = "Selecione o sexo";
                    $erro = true;
                }
                if(empty($_POST["peso"]))
                {
                    $msg[3] = "Informe o peso";
                    $erro = true;
                }
                if(empty($_POST["especie"]))
                {
                    $msg[4] = "Preencha o espécie";
                    $erro = true;
                }
                if(empty($_POST["raca"]))
                {
                    $msg[5] = "Preencha a raça";
                    $erro = true;
                }
                if(empty($_POST["pelagem"]))
                {
                    $msg[6] = "Preencha a pelagem";
                    $erro = true;
                }
                if(empty($_POST["aquisicao"]))
                {
                    $msg[7] = "Selecione a aquisição";
                    $erro = true;
                }
                if(empty($_POST["tutor"]))
                {
                    $msg[8] = "Selecione o tutor";
                    $erro = true;
                }
                
                if(!$erro)
                {
                    $tutor = new Tutor($_POST["tutor"]);

                    $animal = new Animal(id_animal:$_POST["id_animal"], rga:$_POST["rga"], chip:$_POST["chip"], nome:$_POST["nome"], datan:$_POST["datan"], sexo:$_POST["sexo"], alergias:$_POST["alergias"], doencas:$_POST["doencas"], cirurgias:$_POST["cirurgias"], peso:$_POST["peso"], especie:$_POST["especie"], raca:$_POST["raca"], pelagem:$_POST["pelagem"], aquisicao:$_POST["aquisicao"], tutor:$tutor);

                    $animalDAO = new animalDAO();
                    $ret = $animalDAO->editar($animal);
                    $msg = "Animal alterado com sucesso";

                    header("location:index.php?controle=animalController&metodo=listar&msg=$msg");
                }
            }
            require_once "Views/animal/edit-animal.php";
        }

        // BUSCAR
        public function buscar()
        {
            // VERIFICA SESSAO DO VETERINARIO P/ EXIBIR DADOS PRIVADOS
            if(!isset($_SESSION["id_vet"]))
            {
                header("location:index.php");
            }
            $animalDAO = new animalDAO();
            $retorno = $animalDAO->buscar_animais();
            return $retorno;
        }

        // BUSCAR UM ANIMAL (PERFIL)
        public function buscar_animal()
        {
            // VERIFICA SESSAO DO VETERINARIO P/ EXIBIR DADOS PRIVADOS
            session_start();
            if(!isset($_SESSION["id_vet"]))
            {
                header("location:index.php?controle=animalController&metodo=buscar_animal_publico&id=". $_GET['id']);
                exit();
            }

            if(isset($_GET["id"]))
            {
                $animal = new Animal($_GET["id"]);
                $animalDAO = new animalDAO();
                $retorno = $animalDAO->buscar_animal($animal);

                require_once "Views/animal/perfil-animal.php";
                return $retorno;
            }
        }

        // BUSCAR UM ANIMAL PUBLICO (PERFIL)
        public function buscar_animal_publico()
        {
            if(isset($_GET["id"]))
            {
                $animal = new Animal($_GET["id"]);
                $animalDAO = new animalDAO();
                $retorno = $animalDAO->buscar_animal_publico($animal);

                require_once "Views/animal/pub-perfil-animal.php";
                return $retorno;
            }
        }

        // LISTAR
        public function listar()
        {
            $limite = 15;

            $pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
            $offset = ($pagina_atual - 1) * $limite;

            $animalDAO = new animalDAO();

            $pesquisa = isset($_GET['busca']) ? $_GET['busca'] : '';

            if ($pesquisa) {
                $retorno = $animalDAO->buscar_animais_por_nome_rga_chip($pesquisa, $limite, $offset);
                $total_registros = $animalDAO->contar_animais_por_nome_rga_chip($pesquisa);

                echo 'Pesquisa: ' . $pesquisa;
            } else{
                $retorno = $animalDAO->buscar_animais_paginados($offset, $limite);
                $total_registros = $animalDAO->contar_animais();
            }

            // VERIFICA SESSAO DO VETERINARIO P/ EXIBIR DADOS PRIVADOS
            session_start();
            if(!isset($_SESSION["id_vet"]))
            {
                header("location:index.php?controle=animalController&metodo=listar_publico");
                exit();
            }

            require_once "Views/animal/listar-animais.php";
        }

        // LISTAR PUBLICO
        public function listar_publico()
        {
            $limite = 15;

            $pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
            $offset = ($pagina_atual - 1) * $limite;

            $animalDAO = new animalDAO();
            $retorno = $animalDAO->buscar_animais_paginados_pub($offset, $limite);

            $total_registros = $animalDAO->contar_animais();

            require_once "Views/animal/pub-listar-animais.php";
        }

        // LISTAR EM ORDEM ALFABETICA
        public function listar_alf()
        {
            $limite = 15;

            $pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
            $offset = ($pagina_atual - 1) * $limite;

            $animalDAO = new animalDAO();
            $retorno =  $animalDAO->ordenar_animais_alf($offset, $limite);

            $total_registros = $animalDAO->contar_animais();

            // VERIFICA SESSAO DO VETERINARIO P/ EXIBIR DADOS PRIVADOS
            session_start();
            if(!isset($_SESSION["id_vet"]))
            {
                header("location:index.php?controle=animalController&metodo=listar_alf_publico");
                exit();
            }

            require_once "Views/animal/listar-animais.php";
        }

        // LISTAR EM ORDEM ALFABETICA PUBLICO
        public function listar_alf_publico()
        {
            $limite = 15;

            $pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
            $offset = ($pagina_atual - 1) * $limite;

            $animalDAO = new animalDAO();
            $retorno =  $animalDAO->ordenar_animais_alf_publico($offset, $limite);

            $total_registros = $animalDAO->contar_animais();

            require_once "Views/animal/pub-listar-animais.php";
        }

        // LISTAR POR NOME DO TUTOR
        public function listar_tutor()
        {
            $limite = 15;

            $pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
            $offset = ($pagina_atual - 1) * $limite;

            $animalDAO = new animalDAO();
            $retorno = $animalDAO->ordenar_animais_tutor($offset, $limite);

            $total_registros = $animalDAO->contar_animais();

            // VERIFICA SESSAO DO VETERINARIO P/ EXIBIR DADOS PRIVADOS
            session_start();
            if(!isset($_SESSION["id_vet"]))
            {
                header("location:index.php?controle=animalController&metodo=listar_tutor_publico");
                exit();
            }

            require_once "Views/animal/listar-animais.php";
        }

         // LISTAR POR NOME DO TUTOR PUBLICO
         public function listar_tutor_publico()
         {
             $limite = 15;

             $pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
             $offset = ($pagina_atual - 1) * $limite;

             $animalDAO = new animalDAO();
             $retorno = $animalDAO->ordenar_animais_tutor_publico($offset, $limite);

             $total_registros = $animalDAO->contar_animais();

             require_once "Views/animal/pub-listar-animais.php";
         }

        // GERAR PDF DO PERFIL DO ANIMAL
        public function gerar_pdf()
		{
            session_start();
            if(!isset($_SESSION["id_vet"]))
            {
                header("location:index.php");
                exit();
            }

            if(isset($_GET["id"]))
            {
                $animal = new Animal($_GET["id"]);
                $animalDAO = new animalDAO();
                $retorno = $animalDAO->buscar_animal($animal);
            }

			require_once "Views/animal/pdf-animal.php";
		}

        // EXCLUIR
        public function excluir()
		{
			if(isset($_GET["id"]))
			{
				$animal = new Animal($_GET["id"]);
				$animalDAO = new animalDAO();
				$retorno = $animalDAO->excluir($animal);
				header("location:index.php?controle=animalController&metodo=listar&msg=$retorno");
			}
		}
    }

    

