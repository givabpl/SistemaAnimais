<?php 
    namespace SistemaAnimais\Controllers;

    use SistemaAnimais\DAOs\animalDAO;
    use SistemaAnimais\DAOs\prontDAO;

    use SistemaAnimais\Models\Animal;
    use SistemaAnimais\Models\Vet;
    use SistemaAnimais\Models\Pront;

    class prontController 
    {
        // CRIAR PRONTUARIO
        public function criar()
        {
            if(isset($_GET["id"]))
            {
                $animal = new Animal($_GET["id"]);
                $animalDAO = new animalDAO();
                $retorno = $animalDAO->buscar_animal($animal);
            }

            $msg = array("","","","","","","","");
            if($_POST)
            {
                $erro = false;
                if(empty($_POST["titulo"]))
                {
                    $msg[0] = "Preencha o título";
                    $erro = true;
                }
                if(empty($_POST["dataa"]))
                {
                    $msg[1] = "Preencha a data";
                    $erro = true;
                }
                if(empty($_POST["locala"]))
                {
                    $msg[2] = "Preencha o local";
                    $erro = true;
                }
                if(empty($_POST["descritivo"]))
                {
                    $msg[3] = "Preencha o descritivo";
                    $erro = true;
                }
                if(empty($_POST["medicacao"]))
                {
                    $msg[4] = "Informe se houve medicação";
                    $erro = true;
                }
                else if($_POST["medicacao"] === "Sim" && empty($_POST["medicacao_info"]))
                {
                    $msg[4] = "Preencha as medicações usadas";
                    $erro = true;
                }
                if(empty($_POST["internacao"]))
                {
                    $msg[5] = "Informe se houve internação";
                    $erro = true;
                }
                else if($_POST["internacao"] === "Sim" && empty($_POST["internacao_info"]))
                {
                    $msg[5] = "Informe os detalhes da internacao";
                    $erro = true;
                }
                if(empty($_POST["peso"]))
                {
                    $msg[6] = "Informe o peso";
                    $erro = true;
                }

                $arquivo = "";
                if(isset($_FILES["arquivo"]) && $_FILES["arquivo"]["error"] == UPLOAD_ERR_OK)
                {
                    $arquivo = $_FILES["arquivo"]["name"];
                    move_uploaded_file($_FILES["arquivo"]["tmp_name"], "uploads/" . $arquivo);
                }
                if(!$erro)
                {
                    $animal = new Animal($_POST["id_animal"]);
                    $vet = new Vet($_POST["vet"]);

                    $pront = new Pront(titulo:$_POST["titulo"], dataa:$_POST["dataa"], locala:$_POST["locala"], descritivo:$_POST["descritivo"], medicacao:$_POST["medicacao"], medicacao_info:$_POST["medicacao_info"], internacao:$_POST["internacao"], internacao_info:$_POST["internacao_info"], receita:$_POST["receita"], arquivo:$arquivo, peso:$_POST["peso"], animal:$animal, vet:$vet);

                    $prontDAO = new prontDAO();
                    $prontDAO->criar($pront);
                    $msg = "Prontuário criado com sucesso";

                    header("location:index.php?controle=prontController&metodo=listar_pronts_animal&id={$_POST['id_animal']}&msg=$msg");
                }
            }
            require_once "Views/pront/form-pront.php";
        }

        // ABRIR/BUSCAR
        public function abrir()
        {
            if(isset($_GET["id"]))
            {
                $pront = new Pront($_GET["id"]);
                $prontDAO = new prontDAO();
                $retorno = $prontDAO->buscar_pront($pront);

                require_once "Views/pront/prontuario.php";
                return $retorno;
            }
        }

        // LISTAR
        public function listar()
        {
            $limite = 15;

            $pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
            $offset = ($pagina_atual - 1) * $limite;

            $prontDAO = new prontDAO();

            $pesquisa = isset($_GET['busca']) ? $_GET['busca'] : '';

            if ($pesquisa)
            {
                $retorno = $prontDAO->buscar_pronts_pesquisa($pesquisa, $limite, $offset);
                $total_registros = $prontDAO->contar_pronts_pesquisa($pesquisa);
            } else {
                $retorno = $prontDAO->buscar_pronts_paginados($offset, $limite);
                $total_registros = $prontDAO->contar_pronts();
            }

            // VERIFICA SESSAO DO VETERINARIO P/ EXIBIR DADOS PRIVADOS
            session_start();
            if(!isset($_SESSION["id_vet"]))
            {
                header("location:index.php");
                exit();
            }

            require_once "Views/pront/listar-pronts.php";
        }

        // LISTAR: ORDENAR POR LOCAL
        public function listar_local()
        {
            $limite = 15;

            $pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
            $offset = ($pagina_atual - 1) * $limite;

            $prontDAO = new prontDAO();
            $retorno = $prontDAO->ordenar_pronts_local($offset, $limite);

            $total_registros = $prontDAO->contar_pronts();

            // VERIFICA SESSAO DO VETERINARIO P/ EXIBIR DADOS PRIVADOS
            session_start();
            if(!isset($_SESSION["id_vet"]))
            {
                header("location:index.php");
                exit();
            }

            require_once "Views/pront/listar-pronts.php";
        }

        // LISTAR: ORDENAR POR TUTOR
        public function listar_tutor()
        {
            $limite = 15;

            $pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
            $offset = ($pagina_atual - 1) * $limite;

            $prontDAO = new prontDAO();
            $retorno = $prontDAO->ordenar_pronts_tutor($offset, $limite);

            $total_registros = $prontDAO->contar_pronts();

            // VERIFICA SESSAO DO VETERINARIO P/ EXIBIR DADOS PRIVADOS
            session_start();
            if(!isset($_SESSION["id_vet"]))
            {
                header("location:index.php");
                exit();
            }

            require_once "Views/pront/listar-pronts.php";
        }

        // LISTAR: ORDENAR POR VETERINARIO
        public function listar_vet()
        {
            $limite = 15;

            $pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
            $offset = ($pagina_atual - 1) * $limite;

            $prontDAO = new prontDAO();
            $retorno = $prontDAO->ordenar_pronts_vet($offset, $limite);

            $total_registros = $prontDAO->contar_pronts();

            // VERIFICA SESSAO DO VETERINARIO P/ EXIBIR DADOS PRIVADOS
            session_start();
            if(!isset($_SESSION["id_vet"]))
            {
                header("location:index.php");
                exit();
            }

            require_once "Views/pront/listar-pronts.php";
        }


        // LISTAR PRONTUARIOS DE UM ANIMAL
        public function listar_pronts_animal()
        {
            $limite = 15;

            $pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
            $offset = ($pagina_atual - 1) * $limite;

            if(isset($_GET["id"])) {
                $animal = new Animal($_GET["id"]);
                $prontDAO = new prontDAO();

                // Buscar dados do animal e tutor
                $dados_animal_tutor = $prontDAO->buscar_dados_animal_tutor($animal);

                $pesquisa = isset($_GET['busca']) ? $_GET['busca'] : '';
                if ($pesquisa) {
                    $retorno = $prontDAO->buscar_pronts_animal_pesquisa($animal, $pesquisa, $limite, $offset);
                    $total_registros = $prontDAO->contar_pronts_animal_pesquisa($animal, $pesquisa);
                } else {
                    $retorno = $prontDAO->buscar_pronts_animal($animal, $offset, $limite);
                    $total_registros = $prontDAO->contar_pronts_animal($animal);
                }

                // VERIFICA SESSAO DO VETERINARIO P/ EXIBIR DADOS PRIVADOS
                session_start();
                if (!isset($_SESSION["id_vet"])) {
                    header("location:index.php");
                    exit();
                }

                require_once "Views/pront/listar-pronts-animal.php";
            }
        }

        // LISTAR PRONTUARIOS DE UM VETERINÁRIO
        public function listar_pronts_vet()
        {
            $limite = 15;

            $pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
            $offset = ($pagina_atual - 1) * $limite;

            if(isset($_GET["id"])) {
                $vet = new Vet($_GET["id"]);
                $prontDAO = new prontDAO();

                // Buscar dados do veterinário
                $dados_vet = $prontDAO->buscar_dados_vet($vet);

                $pesquisa = isset($_GET['busca']) ? $_GET['busca'] : '';
                if ($pesquisa) {
                    $retorno = $prontDAO->buscar_pronts_vet_pesquisa($vet, $pesquisa, $limite, $offset);
                    $total_registros = $prontDAO->contar_pronts_vet_pesquisa($vet, $pesquisa);
                } else {
                    $retorno = $prontDAO->buscar_pronts_vet($vet, $offset, $limite);
                    $total_registros = $prontDAO->contar_pronts_vet($vet);
                }

                // VERIFICA SESSAO DO VETERINARIO P/ EXIBIR DADOS PRIVADOS
                session_start();
                if (!isset($_SESSION["id_vet"])) {
                    header("location:index.php");
                    exit();
                }

                require_once "Views/pront/listar-pronts-vet.php";
            }
        }


        // GERAR PDF
        public function gerar_pdf()
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
                $pront = new Pront($_GET["id"]);
                $prontDAO = new prontDAO();
                $retorno = $prontDAO->buscar_pront($pront);
            }

			require_once "views/pront/pdf-pront.php";
		}

        // GERAR PDF DA RECEITA
        public function gerar_pdf_receita()
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
                $pront = new Pront($_GET["id"]);
                $prontDAO = new prontDAO();
                $retorno = $prontDAO->buscar_pront($pront);
            }

            require_once "views/pront/pdf-receita.php";
        }

        // EXCLUIR PEGAR PAG ANTERIOR
        public function excluir()
		{
			if(isset($_GET["id"]))
			{
				$pront = new Pront($_GET["id"]);
				$prontDAO = new prontDAO();
				$retorno = $prontDAO->excluir($pront);

				$return_url = isset($_GET["return_url"]) ? $_GET["return_url"] : "index.php?controle=prontController&metodo=listar_pronts_animal";
                header("location: $return_url&msg=$retorno");
			}
		}





        //////////////// ESTATÍSTICAS ////////////////

        public function listar_estatisticas()
        {
            $prontDAO = new ProntDAO();

            $dados_por_dia = $prontDAO->buscar_pronts_dia_mes();
            $numero_pronts_hoje = $prontDAO->buscar_pronts_hoje();
            $media_pronts_dia = $prontDAO->media_pronts_dia();

            // VERIFICA SESSAO DO VETERINARIO P/ EXIBIR DADOS PRIVADOS
            session_start();
            if(!isset($_SESSION["id_vet"]))
            {
                header("location:index.php");
                exit();
            }

            require_once "Views/pront/listar-estatisticas-pronts.php";
        }

    }
