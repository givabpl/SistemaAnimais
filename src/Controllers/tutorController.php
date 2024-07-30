<?php
    namespace SistemaAnimais\Controllers;

    use SistemaAnimais\DAOs\tutorDAO;

    use SistemaAnimais\Models\Tutor;

    class tutorController
    {
        // INSERIR
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

                    header("location:index.php?controle=tutorController&metodo=listar");
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
            // VERIFICA SESSAO DO VETERINARIO P/ EXIBIR DADOS PRIVADOS
            session_start();
            if(!isset($_SESSION["id_vet"]))
            {
                header("location:index.php");
                exit();
            }
            $tutorDAO = new tutorDAO();
            $retorno = $tutorDAO->buscar_tutores();

            require_once "Views/tutor/listar-tutores.php";
            return $retorno;
        }

        // LISTAR EM ORDEM ALFABETICA
        public function listar_alf()
        {
            // VERIFICA SESSAO DO VETERINARIO P/ EXIBIR DADOS PRIVADOS
            session_start();
            if(!isset($_SESSION["id_vet"]))
            {
                header("location:index.php?");
                exit();
            }
            $tutorDAO = new tutorDAO();
            $retorno = $tutorDAO->ordenar_tutores_alf();

            require_once "Views/tutor/listar-tutores.php";
            return $retorno;
        }

        // LISTAR ANIMAIS DE UM TUTOR
        public function listar_animais()
        {
            // VERIFICA SESSAO DO VETERINARIO P/ EXIBIR DADOS PRIVADOS
            session_start();
            if(!isset($_SESSION["id_vet"]))
            {
                header("location:index.php");
                exit();
            }
            
            if(isset($_GET["id"]))
            {
                $tutor = new Tutor($_GET["id"]);
                $tutorDAO = new tutorDAO();
                $retorno = $tutorDAO->buscar_animais_tutor($tutor);

                if(empty($retorno))
                {
                    $tutorDAO = new tutorDAO();
                    $retorno = $tutorDAO->buscar_animal_tutor($tutor);
                }

                require_once "Views/tutor/listar-animais-tutor.php";
                return $retorno;
            }
        }

        // EXCLUIR
        public function excluir(): void
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

    

