<?php
    namespace SistemaAnimais\Controllers;

    use SistemaAnimais\DAOs\tutorDAO;

    use SistemaAnimais\Models\Tutor;

    class tutorController
    {
        // INSERIR NOVO TUTOR
        public function inserir()
        {
            $msg = array("","","","","","","","","");
            if($_POST)
            {
                $erro = false;
                if(empty($_POST["nome"]))
                {
                    $msg[0] = "Preencha o nome";
                    $erro = true;
                }
                if(empty($_POST["sobrenome"]))
                {
                    $msg[1] = "Preencha o sobrenome";
                    $erro = true;
                }
                if(empty($_POST["rg"]))
                {
                    $msg[2] = "Preencha o rg";
                    $erro = true;
                }
                if(empty($_POST["cpf"]))
                {
                    $msg[3] = "Preencha o cpf";
                    $erro = true;
                }
                if(empty($_POST["cep"]))
                {
                    $msg[4] = "Preencha o cep";
                    $erro = true;
                }
                if(empty($_POST["logradouro"]))
                {
                    $msg[5] = "Preencha o logradouro";
                    $erro = true;
                }
                if(empty($_POST["numero"]))
                {
                    $msg[6] = "Preencha o número";
                    $erro = true;
                }
                if(empty($_POST["bairro"]))
                {
                    $msg[7] = "Preencha o bairro";
                    $erro = true;
                }
                if(empty($_POST["telefone1"]))
                {
                    $msg[8] = "Informe ao menos um telefone para contato";
                    $erro = true;
                }
                if(!empty($_POST["rg"]))
                {
                    $tutor = new Tutor(rg:$_POST["rg"]);
                    $tutorDAO = new tutorDAO();
                    $retorno = $tutorDAO->buscar_rg($tutor);
                    if(is_array($retorno) && count($retorno) > 0)
                    {
                        $msg[2] = "Rg já cadastrado";
                        $erro = true;
                    }
                }
                if(!empty($_POST["cpf"]))
                {
                    $tutor = new Tutor(cpf:$_POST["cpf"]);
                    $tutorDAO = new tutorDAO();
                    $retorno = $tutorDAO->buscar_cpf($tutor);
                    if(is_array($retorno) && count($retorno) > 0)
                    {
                        $msg[3] = "Cpf já cadastrado";
                        $erro = true;
                    }
                }
                if(!$erro)
                {
                    $tutor = new Tutor(nome:$_POST["nome"], sobrenome:$_POST["sobrenome"], rg:$_POST["rg"], cpf:$_POST["cpf"], cep:$_POST["cep"], logradouro:$_POST["logradouro"], numero:$_POST["numero"], bairro:$_POST["bairro"], telefone1:$_POST["telefone1"], telefone2:$_POST["telefone2"]);

                    $tutorDAO = new tutorDAO();
                    $retorno = $tutorDAO->inserir($tutor);
                    $msg = "Tutor cadastrado com sucesso";

                    header("location:index.php?controle=tutorController&metodo=listar&msg=$msg");
                }
            }
            require_once "Views/tutor/form-tutor.php";
        }

        // EDITAR
        public function editar()
        {
            if(isset($_GET["id"]))
            {
                $tutor = new Tutor($_GET["id"]);
                $tutorDAO = new tutorDAO();
                $retorno = $tutorDAO->buscar_tutor($tutor);
            }

            $msg = array("","","","","","","","","");

            if($_POST)
            {
                $erro = false;

                if(empty($_POST["nome"]))
                {
                    $msg[0] = "Preencha o nome";
                    $erro = true;
                }
                if(empty($_POST["sobrenome"]))
                {
                    $msg[1] = "Preencha o sobrenome";
                    $erro = true;
                }
                if(empty($_POST["rg"]))
                {
                    $msg[2] = "Preencha o rg";
                    $erro = true;
                }
                if(empty($_POST["cpf"]))
                {
                    $msg[3] = "Preencha o cpf";
                    $erro = true;
                }
                if(empty($_POST["cep"]))
                {
                    $msg[4] = "Preencha o cep";
                    $erro = true;
                }
                if(empty($_POST["logradouro"]))
                {
                    $msg[5] = "Preencha o logradouro";
                    $erro = true;
                }
                if(empty($_POST["numero"]))
                {
                    $msg[6] = "Preencha o número";
                    $erro = true;
                }
                if(empty($_POST["bairro"]))
                {
                    $msg[7] = "Preencha o bairro";
                    $erro = true;
                }
                if(empty($_POST["telefone1"]))
                {
                    $msg[8] = "Informe ao menos um telefone para contato";
                    $erro = true;
                }
                if(!$erro)
                {
                    $tutor = new Tutor(id_tutor:$_POST["id_tutor"], nome:$_POST["nome"], sobrenome:$_POST["sobrenome"], rg:$_POST["rg"], cpf:$_POST["cpf"], cep:$_POST["cep"], logradouro:$_POST["logradouro"], numero:$_POST["numero"], bairro:$_POST["bairro"], telefone1:$_POST["telefone1"], telefone2:$_POST["telefone2"]);

                    $tutorDAO = new tutorDAO();
                    $ret = $tutorDAO->editar($tutor);

                    header("location:index.php?controle=tutorController&metodo=listar&msg=$ret");
                    exit();
                }
            }
            require_once "Views/tutor/edit-tutor.php";
        }

        // BUSCAR
        public function buscar()
        {
            // VERIFICA SESSAO DO VETERINARIO P/ EXIBIR DADOS PRIVADOS
            if(!isset($_SESSION["id_vet"]))
            {
                header("location:index.php");
            }

            $tutorDAO = new tutorDAO();
            $retorno = $tutorDAO->buscar_tutores();
            return $retorno;
        }

        // LISTAR
        public function listar()
        {
            $limite = 15;

            $pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
            $offset = ($pagina_atual - 1) * $limite;

            $tutorDAO = new tutorDAO();

            $pesquisa = isset($_GET['busca']) ? $_GET['busca'] : '';

            if ($pesquisa)
            {
                $retorno = $tutorDAO->buscar_tutores_pesquisa($pesquisa, $limite, $offset);
                $total_registros = $tutorDAO->contar_tutores_pesquisa($pesquisa);
            } else {
                $retorno = $tutorDAO->buscar_tutores_paginados($offset, $limite);
                $total_registros = $tutorDAO->contar_tutores();
            }

            // VERIFICA SESSAO DO VETERINARIO P/ EXIBIR DADOS PRIVADOS
            session_start();
            if(!isset($_SESSION["id_vet"]))
            {
                header("location:index.php");
                exit();
            }

            require_once "Views/tutor/listar-tutores.php";
        }

        // LISTAR EM ORDEM ALFABETICA
        public function listar_alf()
        {
            $limite = 15;

            $pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
            $offset = ($pagina_atual - 1) * $limite;

            $tutorDAO = new tutorDAO();
            $retorno = $tutorDAO->ordenar_tutores_alf($offset, $limite);

            $total_registros = $tutorDAO->contar_tutores();

            // VERIFICA SESSAO DO VETERINARIO P/ EXIBIR DADOS PRIVADOS
            session_start();
            if(!isset($_SESSION["id_vet"]))
            {
                header("location:index.php?");
                exit();
            }

            require_once "Views/tutor/listar-tutores.php";
        }

        // LISTAR ANIMAIS DE UM TUTOR
        public function listar_animais()
        {
            $limite = 15;

            $pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
            $offset = ($pagina_atual - 1) * $limite;

            if(isset($_GET["id"]))
            {
                $tutor = new Tutor($_GET["id"]);
                $tutorDAO = new tutorDAO();

                // Buscar dados do veterinário
                $dados_tutor = $tutorDAO->buscar_dados_tutor($tutor);

                $pesquisa = isset($_GET['busca']) ? $_GET['busca'] : '';
                if ($pesquisa) {
                    $retorno = $tutorDAO->buscar_animais_tutor_pesquisa($tutor, $pesquisa, $limite, $offset);
                    $total_registros = $tutorDAO->contar_animais_tutor_pesquisa($tutor, $pesquisa);
                } else {
                    $retorno = $tutorDAO->buscar_animais_tutor($tutor, $offset, $limite);
                    $total_registros = $tutorDAO->contar_animais_tutor($tutor);
                }

                // VERIFICA SESSAO DO VETERINARIO P/ EXIBIR DADOS PRIVADOS
                session_start();
                if(!isset($_SESSION["id_vet"]))
                {
                    header("location:index.php");
                    exit();
                }

                require_once "Views/tutor/listar-animais-tutor.php";
            }
        }

        // EXCLUIR
        public function excluir()
        {
			if(isset($_GET["id"]))
			{
				$tutor = new Tutor($_GET["id"]);
				$tutorDAO = new tutorDAO();
				$retorno = $tutorDAO->excluir($tutor);
				header("location:index.php?controle=tutorController&metodo=listar&msg=$retorno");
			}
		}
    }

    

