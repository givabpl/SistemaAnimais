<?php
    namespace SistemaAnimais\Models;
    use PDO;
    use PDOException;

    abstract class Conexao
    {
        public function __construct(protected $db = null)
        {
            $parametros = "mysql:host=localhost;dbname=sistema-vet;charset=utf8mb4";
            try
            {
                $this->db = new PDO($parametros, "root", "Awdg075t-oP");
            }
            catch(PDOException $e)
            {
                echo $e->getCode();
				echo $e->getMessage();
				echo "Problema na abertura de conexão com o banco de dados";
            }
        }
    }