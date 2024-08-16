<?php
    namespace SistemaAnimais\Controllers;

    use SistemaAnimais\DAOs\perdidoDAO;
    use SistemaAnimais\DAOs\achadoDAO;

    use SistemaAnimais\Models\Achado;
    use SistemaAnimais\Models\Perdido;

    class achadoController
    {
        // INSERIR ou CADASTRAR NOVO ANIMAL ACHADO
        public function inserir()
        {
            $msg = array("","","","","","","","","","","","");
            if($_POST)
            {
                $tipos = array("image/png","image/jpeg");
                $erro = false;
                if(empty($_POST["especie"]))
                {
                    $msg[0] = "Preencha a espécie";
                    $erro = true;
                }
                if(empty($_POST["raca"]))
                {
                    $msg[1] = "Preencha a raça";
                    $erro = true;
                }
                if(empty($_POST["pelagem"]))
                {
                    $msg[2] = "Informe a pelagem";
                    $erro = true;
                }
                if(empty($_POST["sexo"]))
                {
                    $msg[3] = "Selecione uma opção";
                    $erro = true;
                }
                if(empty($_FILES["imagem"]["name"]))
                {
                    $msg[4] = "Forneça uma imagem ou arquivo";
                    $erro = true;
                }
                if(empty($_POST["localac"]))
                {
                    $msg[5] = "Informe o local que o animal foi encontrado";
                    $erro = true;
                }
                if(empty($_POST["dataac"]))
                {
                    $msg[6] = "Selecione a data em que o animal foi encontrado";
                    $erro = true;
                }
                if(empty($_POST["horaac"]))
                {
                    $msg[7] = "Selecione o horário em que o animal foi encontrado";
                    $erro = true;
                }
                if(empty($_POST["nome_pessoa"]))
                {
                    $msg[8] = "Informe o primeiro nome da pessoa que encontrou o animal";
                    $erro = true;
                }
                if(empty($_POST["telefone1"]))
                {
                    $msg[9] = "Informe ao menos um telefone para contato";
                    $erro = true;
                }
                $imagem = null;
                if(isset($_FILES["imagem"]) && $_FILES["imagem"]["error"] == 0) {
                    $target_dir = "src/achados-img/";
                    $target_file = $target_dir . basename($_FILES["imagem"]["name"]);
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                    $check = getimagesize($_FILES["imagem"]["tmp_name"]);
                    if ($check !== false) {
                        if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $target_file)) {
                            $imagem = $target_file;
                        } else {
                            $msg[4] = "Erro ao enviar arquivo";
                            $erro = true;
                        }
                    } else {
                        $msg[4] = "Arquivo não suportado";
                        $erro = true;
                    }
                }
                if(!$erro)
                {
                    $achado = new Achado(especie:$_POST["especie"], raca:$_POST["raca"], pelagem:$_POST["pelagem"],sexo:$_POST["sexo"], imagem:$imagem, localac:$_POST["localac"], dataac:$_POST["dataac"], horaac:$_POST["horaac"], descritivo:$_POST["descritivo"], nome_pessoa:$_POST["nome_pessoa"], sobrenome:$_POST["sobrenome"], telefone1:$_POST["telefone1"], telefone2:$_POST["telefone2"], status:$_POST["status"]);

                    //  se estiver sem sessão de vet, solicitar (achado vai pra tabela de solicitações)
                    //  se estiver com sessão de vet, cadastrar direto (achado vai pra tabela de achados)

                    $achadoDAO = new achadoDAO();

                    session_start();
                    if(!isset($_SESSION["id_vet"]))
                    {
                        $retorno = $achadoDAO->inserir_solici($achado);
                        $msg = "Sua solicitação de registro foi enviada para aprovação. Verifique também se esse animal se encontra na lista de Desaparecidos!";

                        header("location:index.php?controle=achadoController&metodo=listar_publico&msg=$msg");
                        exit();
                    }
                    else
                    {
                        $retorno = $achadoDAO->inserir($achado);
                        $msg = "Animal Encontrado registrado com sucesso!";

                        header("location:index.php?controle=achadoController&metodo=listar&msg=$msg");
                        exit();
                    }
                }
            }
            require_once "Views/achado/form-animal-achado.php";
        }

        // LISTAR
        public function listar()
        {
            $limite = 15;

            $pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
            $offset = ($pagina_atual - 1) * $limite;

            $achadoDAO = new achadoDAO();
            $retorno = $achadoDAO->buscar_achados_paginados($offset, $limite);

            $total_registros = $achadoDAO->contar_achados();

            // VERIFICA SESSAO DO VETERINARIO P/ EXIBIR DADOS PRIVADOS
            session_start();
            if(!isset($_SESSION["id_vet"]))
            {
                header("location:index.php?controle=achadoController&metodo=listar_publico");
                exit();
            }

            require_once "Views/achado/listar-animais-achados.php";
        }

        // LISTAR PUBLICO
        public function listar_publico()
        {
            $limite = 15;

            $pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
            $offset = ($pagina_atual - 1) * $limite;

            $achadoDAO = new achadoDAO();
            $retorno = $achadoDAO->buscar_achados_paginados_pub($offset, $limite);

            $total_registros = $achadoDAO->contar_achados();

            require_once "Views/achado/pub-listar-animais-achados.php";
        }

        // LISTAR
        public function listar_solicis()
        {
            $limite = 15;

            $pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
            $offset = ($pagina_atual - 1) * $limite;

            $achadoDAO = new achadoDAO();
            $retorno = $achadoDAO->buscar_solicis_paginados($offset, $limite);

            $total_registros = $achadoDAO->contar_solicis();

            // VERIFICA SESSAO DO VETERINARIO P/ EXIBIR DADOS PRIVADOS
            session_start();
            if(!isset($_SESSION["id_vet"]))
            {
                header("location:index.php?controle=achadoController&metodo=listar_publico");
                exit();
            }

            require_once "Views/vet/listar-achados-solicitacoes.php";
        }

        // BUSCAR UMA SOLICITAÇÃO (PERFIL)
        public function buscar_solici()
        {
            // VERIFICA SESSAO DO VETERINARIO P/ EXIBIR DADOS PRIVADOS
            session_start();
            if(!isset($_SESSION["id_vet"]))
            {
                header("location:index.php?controle=achadoController&metodo=buscar_achados_publico");
                exit();
            }

            if(isset($_GET["id"]))
            {
                $achado = new Achado($_GET["id"]);
                $achadoDAO = new achadoDAO();
                $retorno = $achadoDAO->buscar_solici($achado);

                require_once "Views/vet/perfil-achado-solicitacao.php";
            }
        }

        public function aprovar()
        {
            session_start();
            if (!isset($_SESSION["id_vet"]))
            {
                header("location:index.php?controle=achadoController&metodo=listar_publico");
                exit();
            }

            if (isset($_GET["id"]))
            {
                $achadoDAO = new achadoDAO();

                // Mover o registro da tabela 'solici_achados' para 'achados'
                $achadoId = $_GET["id"];
                $achadoDAO->aprovar_solici($achadoId);

                // Redireciona para a mesma página com uma mensagem de sucesso
                $msg = "Solicitação aprovada com sucesso.";
                header("location:index.php?controle=achadoController&metodo=listar_solicis&msg=$msg");
                exit();
            }
        }

        public function remover_solici()
        {
            // metodo que chama metodo DAO que remove solicitacao de achado completamente da tabela solici_achados. Continua na mesma visão.
            session_start();
            if (!isset($_SESSION["id_vet"]))
            {
                header("location:index.php?controle=achadoController&metodo=listar_publico");
                exit();
            }

            if (isset($_GET["id"])) {
                $achadoDAO = new achadoDAO();

                // Remove a solicitação da tabela 'solici_achados'
                $achado = $_GET["id"];
                $achadoDAO->remover_solici($achado);

                // atribuir mensagem vermelha ou de outra cor para alerta de exclusão
                $msg = "Solicitação removida com sucesso.";
                // Redireciona para a mesma página com uma mensagem de sucesso
                header("location:index.php?controle=achadoController&metodo=listar_solicis&msg=$msg");
                exit();
            }
        }


        // BUSCAR UM ANIMAL ACHADO (PERFIL)
        public function buscar_achado()
        {
            // VERIFICA SESSAO DO VETERINARIO P/ EXIBIR DADOS PRIVADOS
            session_start();
            if(!isset($_SESSION["id_vet"]))
            {
                header("location:index.php?controle=achadoController&metodo=buscar_achado_publico&id=". $_GET['id']);
                exit();
            }

            if(isset($_GET["id"]))
            {
                $achado = new Achado($_GET["id"]);
                $achadoDAO = new achadoDAO();
                $retorno = $achadoDAO->buscar_achado($achado);

                require_once "Views/achado/perfil-achado.php";
            }
        }

        // BUSCAR UM ANIMAL ACHADO PUBLICO (PERFIL)
        public function buscar_achado_publico()
        {
            if(isset($_GET["id"]))
            {
                $achado = new Achado($_GET["id"]);
                $achadoDAO = new achadoDAO();
                $retorno = $achadoDAO->buscar_achado_publico($achado);

                require_once "Views/achado/pub-perfil-achado.php";
            }
        }

        // GERAR PDF DO PERFIL DO ACHADO
        public function gerar_pdf()
        {
            session_start();
            if(!isset($_SESSION["id_vet"]))
            {
                header("location:index.php?controle=achadoController&metodo=listar_publico");
                exit();
            }
            if(isset($_GET["id"]))
            {
                $achado = new Achado($_GET["id"]);
                $achadoDAO = new achadoDAO();
                $retorno = $achadoDAO->buscar_achado($achado);
            }
            require_once "Views/achado/pdf-achado.php";
        }

        // REMOVER ACHADO
        public function remover_achado()
        {
            if(isset($_GET["id"]))
            {
                $achado = new Achado($_GET["id"]);
                $achadoDAO = new achadoDAO();
                $retorno = $achadoDAO->remover_achado($achado);
                header("location:index.php?controle=achadoController&metodo=listar&msg=$retorno");
            }
        }
    }

