<?php
    namespace SistemaAnimais\DAOs;

    use SistemaAnimais\Models\Conexao;
    use PDO;
    use PDOException;
    

    class perdidoDAO extends Conexao
    {
        public function __construct()
        {
            parent:: __construct();
        }

        // INSERIR ANIMAL
        public function inserir($perdido)
        {
            $sql = "INSERT INTO perdidos (id_animal, imagem, locald, datad, horad, descritivo, id_tutor, statusd) VALUES (?,?,?,?,?,?,?,?)";

            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $perdido->getAnimal()->getId());
            $stm->bindValue(2, $perdido->getImagem());
            $stm->bindValue(3, $perdido->getLocal());
            $stm->bindValue(4, $perdido->getData());
            $stm->bindValue(5, $perdido->getHora());
            $stm->bindValue(6, $perdido->getDescr());
            $stm->bindValue(7, $perdido->getTutor()->getId());
            $stm->bindValue(8, $perdido->getStatus());
            return $stm->execute();
        }


        // BUSCAR ANIMAIS PERDIDOS
        public function buscar_perdidos()
        {
            $sql = "SELECT perdidos.*, 
                    tutores.nome AS nome_tutor, 
                    tutores.sobrenome, 
                    tutores.telefone1, 
                    tutores.telefone2, 
                    animais.rga, 
                    animais.chip, 
                    animais.nome AS nome_animal, 
                    animais.sexo,
                    animais.especie, 
                    animais.raca, 
                    animais.pelagem
                    FROM perdidos 
                    JOIN tutores ON perdidos.id_tutor = tutores.id_tutor
                    JOIN animais ON perdidos.id_animal = animais.id_animal"; // ou id_perdido
            $stm = $this->db->prepare($sql);
            $stm->execute();
            $this->db = null;
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }

        // BUSCAR ANIMAIS PERDIDOS PPUBLICO
        public function buscar_perdidos_publico()
        {
            $sql = "SELECT perdidos.*, 
                    tutores.nome AS nome_tutor,  
                    tutores.telefone1, 
                    tutores.telefone2, 
                    animais.rga, 
                    animais.chip, 
                    animais.nome AS nome_animal, 
                    animais.sexo,
                    animais.raca, 
                    animais.pelagem 
                    FROM perdidos 
                    JOIN tutores ON perdidos.id_tutor = tutores.id_tutor
                    JOIN animais ON perdidos.id_animal = animais.id_animal";
            $stm = $this->db->prepare($sql);
            $stm->execute();
            $this->db = null;
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }

        // ORDENAR ANIMAIS PERDIDOS POR ORDEM ALFABETICA
        public function ordenar_perdidos_alf()
        {
            $sql = "SELECT animais.*, tutores.nome AS nome_tutor, tutores.sobrenome
                    FROM animais 
                    JOIN tutores ON animais.id_tutor = tutores.id_tutor
                    ORDER BY nome";
            $stm = $this->db->prepare($sql);
            $stm->execute();
            $this->db = null;
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }

        // ORDENAR ANIMAIS PERDIDOS POR ORDEM ALFABETICA PUBLICO
        public function ordenar_perdidos_alf_publico()
        {
            $sql = "";
            $stm = $this->db->prepare($sql);
            $stm->execute();
            $this->db = null;
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }

        // ORDENAR ANIMAIS PERDIDOS POR NOME DO TUTOR
        public function ordenar_perdidos_tutor()
        {
            $sql = "SELECT animais.*, tutores.nome AS nome_tutor, tutores.sobrenome 
                    FROM animais 
                    JOIN tutores ON animais.id_tutor = tutores.id_tutor
                    ORDER BY nome_tutor";
            $stm = $this->db->prepare($sql);
            $stm->execute();
            $this->db = null;
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }

        // ORDENAR ANIMAIS PERDIDOS POR NOME DO TUTOR PUBLICO
        public function ordenar_perdidos_tutor_publico()
        {
            $sql = "";
            $stm = $this->db->prepare($sql);
            $stm->execute();
            $this->db = null;
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }

        // BUSCAR NOME DO ANIMAL PERDIDO & NOME DO TUTOR
        public function buscar_perdido_tutor($perdido)
        {
            $sql = "SELECT 
                        perdidos.nome AS nome_animal, 
                        tutores.nome AS nome_tutor, 
                        tutores.sobrenome
                    FROM perdidos 
                    JOIN tutores ON perdidos.id_tutor = tutores.id_tutor
                    WHERE perdidos.id_perdido = ?";
            try
            {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $perdido->getId());
                $stm->execute();
                $retorno =  $stm->fetchAll(PDO::FETCH_OBJ);
                return $retorno;

            }
            catch(PDOException $e)
            {
                echo "Problema ao buscar animal: " . $e->getMessage();
                return null;
            }
        }

        // BUSCAR NOME DO ANIMAL PERDIDO PERDIDO & NOME DO TUTOR PUBLICO
        public function buscar_perdido_tutor_publico($perdido)
        {
            $sql = "SELECT perdidos.nome AS nome_animal, tutores.nome AS nome_tutor
                    FROM perdidos 
                    JOIN tutores ON perdidos.id_tutor = tutores.id_tutor
                    WHERE perdidos.id_perdido = ?";
            try
            {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $perdido->getId());
                $stm->execute();
                $retorno =  $stm->fetchAll(PDO::FETCH_OBJ);
                return $retorno;

            }
            catch(PDOException $e)
            {
                echo "Problema ao buscar animal: " . $e->getMessage();
                return null;
            }
        }



        // corrigir join tabelas
        // BUSCAR UM ANIMAL PERDIDO
        public function buscar_perdido($perdido)
        {
            $sql = "SELECT perdidos.*, 
                    DATE_FORMAT(datad, '%d/%m/%Y') AS data_formatada,
                    DATE_FORMAT(horad, '%H:%i') AS hora_formatada,
                    tutores.nome AS nome_tutor, 
                    tutores.sobrenome, 
                    tutores.telefone1,
                    tutores.telefone2
                    animais.nome AS nome_animal,
                    animais.sexo,
                    animais.peso,
                    animais.especie,
                    animais.raca,
                    animais.pelagem,
                    animais.alergias,
                    animais.doencas,
                    DATE_FORMAT(animais.datan, '%d/%m/%Y') AS datan_formatada
                    FROM perdidos 
                    JOIN tutores ON perdidos.id_tutor = tutores.id_tutor
                    JOIN animais ON perdidos.id_animal = animais.id_animal
                    WHERE perdidos.id_perdido = ?";

            try
            {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $perdido->getId());
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
        public function buscar_perdido_publico($perdido)
        {
            $sql = "SELECT perdidos.*, 
                    DATE_FORMAT(datad, '%d/%m/%Y') AS data_formatada,
                    DATE_FORMAT(horad, '%H:%i') AS hora_formatada,
                    tutores.nome AS nome_tutor,
                    tutores.telefone1,
                    tutores.telefone2,
                    animais.nome AS nome_animal,
                    animais.sexo,
                    animais.peso,
                    animais.especie,
                    animais.raca,
                    animais.pelagem,
                    animais.alergias,
                    animais.doencas,
                    DATE_FORMAT(animais.datan, '%d/%m/%Y') AS datan_formatada
                    FROM perdidos 
                    JOIN tutores ON perdidos.id_tutor = tutores.id_tutor
                    JOIN animais ON perdidos.id_animal = animais.id_animal
                    WHERE perdidos.id_perdido = ?";

            try
            {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $perdido->getId());
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_OBJ);
            }
            catch(PDOException $e)
            {
                echo "Problema ao buscar animal: " . $e->getMessage();
                return null;
            }
        }

        
        public function buscar_rga($perdido)
        {
            $sql = "SELECT * FROM perdidos WHERE rga = ?";

            try
            {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $perdido->getRga());
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
        public function excluir($perdido)
        {
            $sql = "DELETE FROM perdidos WHERE id_perdido = ?";

            try
            {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $perdido->getId());
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