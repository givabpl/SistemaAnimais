<?php
    namespace SistemaAnimais\DAOs;

    use SistemaAnimais\Models\Conexao;
    use PDO;
    use PDOException;

    class vetDAO extends Conexao
    {
        public function __construct()
        {
            parent:: __construct();
        }

        // CADASTRAR VET
        public function cadastrar($vet)
        {
            $sql = "INSERT INTO veterinarios (nome, crmv, tipo, email, senha) VALUES (:nome, :crmv, :tipo, :email, :senha)";

            $stm = $this->db->prepare($sql);
            $stm->bindValue(':nome', $vet->getNome());
            $stm->bindValue(':crmv', $vet->getCrmv());
            $stm->bindValue(':tipo', $vet->getTipo());
            $stm->bindValue(':email', $vet->getEmail());
            $stm->bindValue(':senha', $vet->getSenha());
            
            $stm->execute();
            return "Veterinário cadastrado com sucesso";
        }


        // AUTENTICAR
        public function autenticar($vet)
        {
            $sql = "SELECT * FROM veterinarios WHERE email = :email AND senha = :senha";
            $stm = $this->db->prepare($sql);
            $stm->bindValue(":email", $vet->getEmail());
            $stm->bindValue(":senha", $vet->getSenha());
            $stm->execute();
            $this->db = null;
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }

        // BUSCAR VETERINARIOS
        public function buscar_vets()
		{
			$sql = "SELECT * FROM veterinarios";
			$stm = $this->db->prepare($sql);
			$stm->execute();
			$this->db = null;
			return $stm->fetchAll(PDO::FETCH_OBJ);
		}

        // BUSCAR UM VET
        public function buscar_vet($vet)
        {
            $sql = "SELECT * FROM veterinarios WHERE id_vet = ?";
			try
            {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $vet->getId());
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_OBJ);
            }
            catch(PDOException $e)
            {
                echo "Problema ao buscar veterinário: " . $e->getMessage();
                return null;
            }
        }
    }