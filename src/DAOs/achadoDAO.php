<?php
    namespace SistemaAnimais\DAOs;

    use SistemaAnimais\Models\Conexao;
    use PDO;
    use PDOException;
    

    class achadoDAO extends Conexao
    {
        public function __construct()
        {
            parent:: __construct();
        }

        // INSERIR ANIMAL
        public function inserir($achado)
        {
            $sql = "INSERT INTO achados (id_animal, imagem, localac, dataac, horaac, descritivo, nome_pessoa, sobrenome, telefone1, telefone2, statusac) VALUES (?,?,?,?,?,?,?,?,?,?,?)";

            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $achado->getAnimal()->getId());
            $stm->bindValue(2, $achado->getImagem());
            $stm->bindValue(3, $achado->getLocalac());
            $stm->bindValue(4, $achado->getDataac());
            $stm->bindValue(5, $achado->getHoraac());
            $stm->bindValue(6, $achado->getDescr());
            $stm->bindValue(7, $achado->getNome());
            $stm->bindValue(8, $achado->getSobrenome());
            $stm->bindValue(9, $achado->getTelefone1());
            $stm->bindValue(10, $achado->getTelefone2());
            $stm->bindValue(11, $achado->getStatus());
            return $stm->execute();
        }


        // BUSCAR ANIMAIS achados
        public function buscar_achados()
        {
            $sql = "SELECT achados.*, 
                    animais.sexo AS sexo,
                    animais.especie AS tipo, 
                    animais.raca AS raca, 
                    animais.pelagem AS pelagem
                    FROM achados 
                    JOIN animais ON achados.id_animal = animais.id_animal";
            $stm = $this->db->prepare($sql);
            $stm->execute();
            $this->db = null;
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }

        // BUSCAR ANIMAIS achadoS PUBLICO
        public function buscar_achados_publico()
        {
            $sql = "SELECT achados.*, 
                    animais.sexo AS sexo,
                    animais.especie AS tipo, 
                    animais.raca AS raca, 
                    animais.pelagem AS pelagem
                    FROM achados 
                    JOIN animais ON achados.id_animal = animais.id_animal";
            $stm = $this->db->prepare($sql);
            $stm->execute();
            $this->db = null;
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }

        // BUSCAR UM ANIMAL achado
        public function buscar_achado($achado)
        {
            $sql = "SELECT achados.*, 
                    DATE_FORMAT(dataac, '%d/%m/%Y') AS data_formatada,
                    DATE_FORMAT(horaac, '%H:%i') AS hora_formatada,
                    animais.sexo AS sexo,
                    animais.especie AS especie, 
                    animais.raca AS raca, 
                    animais.pelagem AS pelagem
                    FROM achados 
                    JOIN animais ON achados.id_animal = animais.id_animal
                    WHERE achados.id_achado = ?";

            try
            {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $achado->getId());
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_OBJ);
            }
            catch(PDOException $e)
            {
                echo "Problema ao buscar animal: " . $e->getMessage();
                return null;
            }
        }

        // BUSCAR UM ANIMAL PUBLICO
        public function buscar_achado_publico($achado)
        {
            $sql = "SELECT achados.*, 
                    DATE_FORMAT(dataac, '%d/%m/%Y') AS data_formatada,
                    DATE_FORMAT(horaac, '%H:%i') AS hora_formatada,
                    animais.sexo AS sexo,
                    animais.especie AS especie, 
                    animais.raca AS raca, 
                    animais.pelagem AS pelagem
                    FROM achados 
                    JOIN animais ON achados.id_animal = animais.id_animal
                    WHERE achados.id_achado = ?";

            try
            {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $achado->getId());
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_OBJ);
            }
            catch(PDOException $e)
            {
                echo "Problema ao buscar animal: " . $e->getMessage();
                return null;
            }
        }

        // EXCLUIR ANIMAL
        public function excluir($achado)
        {
            $sql = "DELETE FROM achados WHERE id_achado = ?";

            try
            {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $achado->getId());
                $stm->execute();
                $this->db = null;
                return "Animal excluído com sucesso";
            }
            catch(PDOException $e)
            {
                $this->db = null;
                if($e->getCode() == "23000")
                {
                    return "Animal contém prontuários. Não pode ser excluído.";
                }
                else
                {
                    return "Problema ao excluir animal";
                }
            }
        }
    }