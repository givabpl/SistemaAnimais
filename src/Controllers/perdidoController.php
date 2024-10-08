<?php
    namespace SistemaAnimais\Controllers;

    use SistemaAnimais\DAOs\perdidoDAO;
    
    use SistemaAnimais\Models\Perdido;
    use SistemaAnimais\Models\SoliciPerdido;

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
                    $perdido = new Perdido(rga:$_POST["rga"], chip:$_POST["chip"], nome:$_POST["nome"], datan:$_POST["datan"], sexo:$_POST["sexo"], alergias:$_POST["alergias"], doencas:$_POST["doencas"], peso:$_POST["peso"], especie:$_POST["especie"], raca:$_POST["raca"], pelagem:$_POST["pelagem"], imagem:$imagem, descritivo:$_POST["descritivo"], locald:$_POST["locald"], datad:$_POST["datad"], horad:$_POST["horad"], nome_tutor:$_POST["nome_tutor"], sobrenome:$_POST["sobrenome"], telefone1:$_POST["telefone1"], telefone2:$_POST["telefone2"]);

                    //  se estiver sem sessão de vet, solicitar (perdido vai pra tabela de solicitações)
                    //  se estiver com sessão de vet, cadastrar direto (perdido vai pra tabela de perdidos)

                    $perdidoDAO = new perdidoDAO();

                    session_start();
                    if(!isset($_SESSION["id_vet"]))
                    {
                        $retorno = $perdidoDAO->inserir_solici($perdido);
                        $msg = "Sua solicitação de registro foi enviada para aprovação. Verifique também se o seu animal se encontra na lista de Encontrados!";

                        header("location:index.php?controle=perdidoController&metodo=listar_publico&msg=$msg");
                        exit();
                    }
                    else
                    {
                        $retorno = $perdidoDAO->inserir($perdido);
                        $msg = "Animal Perdido registrado com sucesso! Verifique também se o seu animal se encontra na lista de Achados!";

                        header("location:index.php?controle=perdidoController&metodo=listar&msg=$msg");
                        exit();
                    }
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


        // LISTAR SOLICITAÇÕES PARA VETERINÁRIOS BARRAREM/APROVAREM
        public function listar_solicis()
        {
            $limite = 15;

            $pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
            $offset = ($pagina_atual - 1) * $limite;

            $perdidoDAO = new perdidoDAO();
            $retorno = $perdidoDAO->buscar_solicis_paginados($offset, $limite);

            $total_registros = $perdidoDAO->contar_solicis();

            // VERIFICA SESSAO DO VETERINARIO P/ EXIBIR DADOS PRIVADOS
            session_start();
            if(!isset($_SESSION["id_vet"]))
            {
                header("location:index.php?controle=perdidoController&metodo=listar_publico");
                exit();
            }

            require_once "Views/vet/listar-perdidos-solicitacoes.php";
        }

        // BUSCAR UMA SOLICITAÇÃO (PERFIL)
        public function buscar_solici()
        {
            // VERIFICA SESSAO DO VETERINARIO P/ EXIBIR DADOS PRIVADOS
            session_start();
            if(!isset($_SESSION["id_vet"]))
            {
                header("location:index.php?controle=perdidoController&metodo=buscar_perdidos_publico");
                exit();
            }

            if(isset($_GET["id"]))
            {
                $perdido = new Perdido($_GET["id"]);
                $perdidoDAO = new perdidoDAO();
                $retorno = $perdidoDAO->buscar_solici($perdido);

                require_once "Views/vet/perfil-perdido-solicitacao.php";
            }
        }

        public function aprovar()
        {
           // metodo onde deve chamar metodo DAO que remova o animal perdido da tabela de solicitacao (solici_perdidos) e mova para a tabela de perdidos. Continua na mesma visão.
            session_start();
            if (!isset($_SESSION["id_vet"]))
            {
                header("location:index.php?controle=perdidoController&metodo=listar_publico");
                exit();
            }

            if (isset($_GET["id"]))
            {
                $perdidoDAO = new perdidoDAO();

                // Mover o registro da tabela 'solici_perdidos' para 'perdidos'
                $perdidoId = $_GET["id"];
                $perdidoDAO->aprovar_solici($perdidoId);

                // Redireciona para a mesma página com uma mensagem de sucesso
                $msg = "Solicitação aprovada com sucesso.";
                header("location:index.php?controle=perdidoController&metodo=listar_solicis&msg=$msg");
                exit();
            }
        }

        public function remover_solici()
        {
            // metodo que chama metodo DAO que remove solicitacao de perdido completamente da tabela solici_perdidos. Continua na mesma visão.
            session_start();
            if (!isset($_SESSION["id_vet"]))
            {
                header("location:index.php?controle=perdidoController&metodo=listar_publico");
                exit();
            }

            if (isset($_GET["id"])) {
                $perdidoDAO = new perdidoDAO();

                // Remove a solicitação da tabela 'solici_perdidos'
                $perdido = $_GET["id"];
                $perdidoDAO->remover_solici($perdido);

                // atribuir mensagem vermelha ou de outra cor para alerta de exclusão
                $msg = "Solicitação removida com sucesso.";
                // Redireciona para a mesma página com uma mensagem de sucesso
                header("location:index.php?controle=perdidoController&metodo=listar_solicis&msg=$msg");
                exit();
            }
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

        // REMOVER PERDIDO
        public function remover_perdido()
		{
			if(isset($_GET["id"]))
			{
				$perdido = new Perdido($_GET["id"]);
				$perdidoDAO = new perdidoDAO();
				$retorno = $perdidoDAO->remover_perdido($perdido);
				header("location:index.php?controle=perdidoController&metodo=listar&msg=$retorno");
			}
		}
    }

    

