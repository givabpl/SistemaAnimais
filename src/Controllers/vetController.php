<?php   
    namespace SistemaAnimais\Controllers;

    use SistemaAnimais\DAOs\vetDAO;

    use SistemaAnimais\Models\Vet;
    
    class vetController 
    {
        // CADASTRAR NOVO VETERINÁRIO
        public function cadastrar()
        {
            $msg = array("","","","","","","","","","","");

            $accessPassword = 'bhTRWE%@-JSn73ndmJhLQ_VbWLx--WogT7$s';

            session_start();

            if (isset($_SESSION['password_correct'])) {
                unset($_SESSION['password_correct']);
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['access_password'])) {
                if ($_POST['access_password'] === $accessPassword) {
                    $_SESSION['password_correct'] = true;
                } else {
                    $msg[10] = "Senha de acesso incorreta.";
                }
            }

            if (!isset($_SESSION['password_correct']) || $_SESSION['password_correct'] !== true) {
                require_once "Views/vet/form-access-password.php";
                return;
            }

            if($_POST)
            {
                $erro = false;
                if(empty($_POST["nome"]))
                {
                    $msg[0] = "Preencha o nome";
                    $erro = true;
                }
                if(empty($_POST["crmv"]))
                {
                    $msg[1] = "Preencha o crmv";
                    $erro = true;
                }
                if(empty($_POST["email"]))
                {
                    $msg[2] = "Preencha o email";
                    $erro = true;
                }
                if(empty($_POST["senha"]))
                {
                    $msg[3] = "Preencha a senha";
                    $erro = true;
                }
                if(empty($_POST["confirma"]))
                {
                    $msg[4] = "Confirme a senha";
                    $erro = true;
                }
                if(empty($_POST["tipo"]))
                {
                    $msg[5] = "Selecione o tipo";
                    $erro = true;
                }
                if(!empty($_POST["senha"]) && !empty($_POST["confirma"]))
				{
					if($_POST["senha"] != $_POST["confirma"])
					{
						$msg[3] = "Senhas não conferem";
						$erro = true;
					}
				}
                if(!empty($_POST["crmv"]))
				{
					$vet = new Vet(crmv:$_POST["crmv"]);
					$vetDAO = new vetDAO();
					$retorno = $vetDAO->buscar_vet($vet);
					if(is_array($retorno) && count($retorno) > 0)
					{
						$msg[1] = "Crmv já cadastrado";
						$erro = true;
					}
				}
                if(!$erro)
				{
					$vet = new Vet(0, $_POST["nome"], $_POST["crmv"], $_POST["tipo"], $_POST["email"], md5($_POST["senha"]));
					
					$vetDAO = new vetDAO();
					$retorno = $vetDAO->cadastrar($vet);

					if(!isset($_SESSION))
					{
						session_start();
					}
					if($retorno != 0)
					{
                        $msg = "Cadastro efetuado com sucesso. Faça o Login.";
						$_SESSION["id_vet"] = $retorno;
                        $_SESSION["tipo"] = $retorno;
						header("location:index.php?controle=vetController&metodo=login&msg={$msg}");
					}
					else
					{
						$msg[7] = "Problema ao inserir veterinário";
					}
				}
            }
            require_once "Views/vet/form-cadastro.php";
        }

        // LOGIN
        public function login()
        {
            $msg = array("","","");
            $erro = false;
            if($_POST)
            {
                if(empty($_POST["email"]))
                {
                    $msg[0] = "Informe o email";
                    $erro = true;
                }
                if(empty($_POST["senha"]))
                {
                    $msg[1] = "Informe a senha";
                    $erro = true;
                }
                if(!$erro)
                {
                    $vet = new Vet(email:$_POST["email"], senha:md5($_POST["senha"]));
                    $vetDAO = new vetDAO();
                    $retorno = $vetDAO->autenticar($vet);

                    if(count($retorno) > 0)
                    {
                        session_start();
                        $_SESSION["id_vet"] = $retorno[0]->id_vet;
                        $_SESSION["tipo"] = $retorno[0]->tipo;
                        header("location:index.php");
                    }
                    else
                    {
                        echo "<script>alert('Confira suas credenciais')</script>";
                    }
                }
            }
            require_once "Views/vet/form-login.php";
        }

        // LISTAR
        public function listar()
        {
            // VERIFICA SESSAO DO VETERINARIO P/ EXIBIR DADOS PRIVADOS
            session_start();
            if(!isset($_SESSION["id_vet"]))
            {
                header("location:index.php");
            }

            $vetDAO = new vetDAO();
            $retorno = $vetDAO->buscar_vets();

            require_once "Views/vet/listar-vets.php";
        }

        // LOGOUT
        public function logout()
		{
            session_start();
			session_unset();
			session_destroy();
			header("location:index.php");
		}
    }