<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    define('ROOT_PATH', dirname(__FILE__));

    // Inclui o autoloader do Composer
    require_once __DIR__ . '/vendor/autoload.php';

    use SistemaAnimais\Controllers\inicioController;

    if ($_GET) {
        $controle = $_GET["controle"];
        $metodo = $_GET["metodo"];

        // Corrige o nome da classe, considerando o namespace
        $classe = "SistemaAnimais\\Controllers\\" . $controle;

        // Verifica se a classe e o método existem
        if (class_exists($classe) && method_exists($classe, $metodo)) {
            $obj = new $classe();
            $obj->$metodo();
        } else {
            // Tratamento de erro: classe ou método não encontrados
            echo "Erro: controle ou método não encontrado.";
        }
    } else {
        $obj = new inicioController();
        $obj->inicio();
    }
