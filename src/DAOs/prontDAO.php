<?php
    namespace SistemaAnimais\DAOs;

    use SistemaAnimais\Models\Conexao;
    use PDO;
    use PDOException;

    class prontDAO extends Conexao
    {
        public function __construct()
        {
            parent:: __construct();
        }

        // CRIAR PRONTUARIO
        public function criar($pront)
        {
            $sql = "INSERT INTO prontuarios (titulo, dataa, locala, descritivo, medicacao, medicacao_info, internacao, internacao_info, receita, arquivos, peso, id_animal, id_vet) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";

            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $pront->getTitulo());
            $stm->bindValue(2, $pront->getData());
            $stm->bindValue(3, $pront->getLocal());
            $stm->bindValue(4, $pront->getDescr());
            $stm->bindValue(5, $pront->getMed());
            $stm->bindValue(6, $pront->getMedInfo());
            $stm->bindValue(7, $pront->getInter());
            $stm->bindValue(8, $pront->getIntInfo());
            $stm->bindValue(9, $pront->getReceita());
            $stm->bindValue(10, json_encode($pront->getArquivos()));
            $stm->bindValue(11, $pront->getPeso());
            $stm->bindValue(12, $pront->getAnimal()->getId());
            $stm->bindValue(13, $pront->getVet()->getId());

            return $stm->execute();
        }

        // BUSCAR PRONTUARIOS - ORDENAR POR DATA PADRAO
        public function buscar_pronts()
        {
            $sql = "SELECT prontuarios.*, 
                           DATE_FORMAT(dataa, '%d/%m/%Y') AS data_formatada,
                           animais.nome AS nome_animal, 
                           tutores.nome AS nome_tutor, 
                           tutores.sobrenome, 
                           veterinarios.nome AS nome_vet
                    FROM prontuarios 
                    JOIN animais ON prontuarios.id_animal = animais.id_animal
                    JOIN tutores ON animais.id_tutor = tutores.id_tutor
                    JOIN veterinarios ON prontuarios.id_vet = veterinarios.id_vet
                    ORDER BY dataa DESC";
            $stm = $this->db->prepare($sql);
            $stm->execute();
            $this->db = null;
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }

        // BUSCAR PRONTUARIOS - ORDENAR POR LOCAL
        public function ordenar_pronts_local()
        {
            $sql = "SELECT prontuarios.*, 
                           DATE_FORMAT(dataa, '%d/%m/%Y') AS data_formatada,
                           animais.nome AS nome_animal, 
                           tutores.nome AS nome_tutor, 
                           tutores.sobrenome, 
                           veterinarios.nome AS nome_vet
                    FROM prontuarios 
                    JOIN animais ON prontuarios.id_animal = animais.id_animal
                    JOIN tutores ON animais.id_tutor = tutores.id_tutor
                    JOIN veterinarios ON prontuarios.id_vet = veterinarios.id_vet
                    ORDER BY locala ASC";
            $stm = $this->db->prepare($sql);
            $stm->execute();
            $this->db = null;
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }

        // BUSCAR PRONTUARIOS - ORDENAR POR LOCAL
        public function ordenar_pronts_tutor()
        {
            $sql = "SELECT prontuarios.*, 
                           DATE_FORMAT(dataa, '%d/%m/%Y') AS data_formatada,
                           animais.nome AS nome_animal, 
                           tutores.nome AS nome_tutor, 
                           tutores.sobrenome, 
                           veterinarios.nome AS nome_vet
                    FROM prontuarios 
                    JOIN animais ON prontuarios.id_animal = animais.id_animal
                    JOIN tutores ON animais.id_tutor = tutores.id_tutor
                    JOIN veterinarios ON prontuarios.id_vet = veterinarios.id_vet
                    ORDER BY nome_tutor ASC";
            $stm = $this->db->prepare($sql);
            $stm->execute();
            $this->db = null;
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }

        // BUSCAR PRONTUARIOS - ORDENAR POR LOCAL
        public function ordenar_pronts_vet()
        {
            $sql = "SELECT prontuarios.*, 
                           DATE_FORMAT(dataa, '%d/%m/%Y') AS data_formatada,
                           animais.nome AS nome_animal, 
                           tutores.nome AS nome_tutor, 
                           tutores.sobrenome, 
                           veterinarios.nome AS nome_vet
                    FROM prontuarios 
                    JOIN animais ON prontuarios.id_animal = animais.id_animal
                    JOIN tutores ON animais.id_tutor = tutores.id_tutor
                    JOIN veterinarios ON prontuarios.id_vet = veterinarios.id_vet
                    ORDER BY nome_vet ASC";
            $stm = $this->db->prepare($sql);
            $stm->execute();
            $this->db = null;
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }

        // BUSCAR PRONTUARIOS DE UM ANIMAL
        public function buscar_pronts_animal($animal)
        {
            $sql = "SELECT prontuarios.*, 
                           DATE_FORMAT(dataa, '%d/%m/%Y') AS data_formatada,
                           animais.nome AS nome_animal, 
                           tutores.nome AS nome_tutor, 
                           tutores.sobrenome, 
                           veterinarios.nome AS nome_vet
                    FROM prontuarios 
                    JOIN animais ON prontuarios.id_animal = animais.id_animal
                    JOIN tutores ON animais.id_tutor = tutores.id_tutor
                    JOIN veterinarios ON prontuarios.id_vet = veterinarios.id_vet
                    WHERE prontuarios.id_animal = ?";
            try
            {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $animal->getId());
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_OBJ);
            }
            catch(PDOException $e)
            {
                echo "Problema ao buscar prontuários do animal: " . $e->getMessage();
                return null;
            }    
        }

        // BUSCAR PRONTUARIOS DE UM VETERINARIO
        public function buscar_pronts_vet($vet)
        {
            $sql = "SELECT prontuarios.*, 
                           DATE_FORMAT(dataa, '%d/%m/%Y') AS data_formatada,
                           animais.nome AS nome_animal, 
                           tutores.nome AS nome_tutor, 
                           tutores.sobrenome, 
                           veterinarios.nome AS nome_vet
                    FROM prontuarios 
                    JOIN animais ON prontuarios.id_animal = animais.id_animal
                    JOIN tutores ON animais.id_tutor = tutores.id_tutor
                    JOIN veterinarios ON prontuarios.id_vet = veterinarios.id_vet
                    WHERE prontuarios.id_vet = ?";
            try
            {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $vet->getId());
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_OBJ);
            }
            catch(PDOException $e)
            {
                echo "Problema ao buscar prontuários do veterinario: " . $e->getMessage();
                return null;
            }    
        }


        // BUSCAR UM PRONTUARIO
        public function buscar_pront($pront)
        {
            $sql = "CALL BuscarProntuario(?)";

            try
            {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $pront->getId());
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_OBJ);
            }
            catch(PDOException $e)
            {
                echo "Problema ao buscar prontuário: " . $e->getMessage();
                return null;
            }         
        }

        // EXCLUIR PRONTUARIO
        public function excluir($pront)
        {
            $sql = "DELETE FROM prontuarios WHERE id_pront= ?";

            try
            {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $pront->getId());
                $stm->execute();
                $this->db = null;
                return "Prontuário excluído com sucesso";
            }
            catch(PDOException $e)
            {
                $this->db = null;
                if($e->getCode() == "23000")
                {
                    return "O prontuário Não pôde ser excluído.";
                }
                else
                {
                    return "Problema ao excluir prontuário";
                }
            }
        }
    }