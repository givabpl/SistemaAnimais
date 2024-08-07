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


        // BUSCA PAGINADA: ANIMAIS PERDIDOS  (LIMITE 15)
        public function buscar_perdidos_paginados($offset, $limite)
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
                    JOIN animais ON perdidos.id_animal = animais.id_animal
                    LIMIT :offset, :limite"; // ou id_perdido

            $stm = $this->db->prepare($sql);
            $stm->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
            $stm->bindValue(':limite', (int) $limite, PDO::PARAM_INT);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }

        // BUSCA PAGINADA: ANIMAIS PERDIDOS PUBLICO (LIMITE 15)
        public function buscar_perdidos_paginados_pub($offset, $limite)
        {
            $sql = "SELECT perdidos.*, 
                           tutores.nome AS nome_tutor, 
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
                    JOIN animais ON perdidos.id_animal = animais.id_animal
                    LIMIT :offset, :limite"; // ou id_perdido
            $stm = $this->db->prepare($sql);
            $stm->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
            $stm->bindValue(':limite', (int) $limite, PDO::PARAM_INT);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }

        // BUSCA PAGINADA: CONTA PERDIDOS
        public function contar_perdidos()
        {
            $sql = "SELECT COUNT(*) AS total FROM perdidos";
            $stm = $this->db->prepare($sql);
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ)->total;
        }

        // ORDENAR ANIMAIS PERDIDOS POR ORDEM ALFABETICA
        public function ordenar_perdidos_alf($offset, $limite)
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
                    JOIN animais ON perdidos.id_animal = animais.id_animal
                    ORDER BY animais.nome
                    LIMIT :offset, :limite";

            $stm = $this->db->prepare($sql);
            $stm->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
            $stm->bindValue(':limite', (int) $limite, PDO::PARAM_INT);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }

        // ORDENAR ANIMAIS PERDIDOS POR ORDEM ALFABETICA PUBLICO
        public function ordenar_perdidos_alf_publico($offset, $limite)
        {
            $sql = "SELECT perdidos.*, 
                           tutores.nome AS nome_tutor, 
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
                    JOIN animais ON perdidos.id_animal = animais.id_animal
                    ORDER BY animais.nome
                    LIMIT :offset, :limite";

            $stm = $this->db->prepare($sql);
            $stm->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
            $stm->bindValue(':limite', (int) $limite, PDO::PARAM_INT);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }

        // ORDENAR ANIMAIS PERDIDOS POR NOME DO TUTOR
        public function ordenar_perdidos_tutor($offset, $limite)
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
                    JOIN animais ON perdidos.id_animal = animais.id_animal
                    ORDER BY tutores.nome
                    LIMIT :offset, :limite";

            $stm = $this->db->prepare($sql);
            $stm->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
            $stm->bindValue(':limite', (int) $limite, PDO::PARAM_INT);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }

        // ORDENAR ANIMAIS PERDIDOS POR NOME DO TUTOR PUBLICO
        public function ordenar_perdidos_tutor_publico($offset, $limite)
        {
            $sql = "SELECT perdidos.*, 
                           tutores.nome AS nome_tutor, 
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
                    JOIN animais ON perdidos.id_animal = animais.id_animal
                    ORDER BY tutores.nome
                    LIMIT :offset, :limite";

            $stm = $this->db->prepare($sql);
            $stm->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
            $stm->bindValue(':limite', (int) $limite, PDO::PARAM_INT);
            $stm->execute();
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

        // REMOVER PERDIDO
        public function remover_perdido($perdido)
        {
            $sql = "DELETE FROM perdidos WHERE id_perdido = ?";

            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $perdido->getId());
            $stm->execute();
            $this->db = null;
            return "Animal excluído com sucesso";

        }

        // EXCLUIR PERDIDO E EXCLUIR ANIMAL
        public function excluir($perdido)
        {
            try {
                $this->db->beginTransaction();

                // Obter ID do animal a partir do registro de perdido
                $sql = "SELECT id_animal FROM perdidos WHERE id_perdido = ?";
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $perdido->getId());
                $stm->execute();
                $id_animal = $stm->fetchColumn();

                if ($id_animal)
                {
                    // Excluir da tabela de perdidos
                    $sql = "DELETE FROM perdidos WHERE id_perdido = ?";
                    $stm = $this->db->prepare($sql);
                    $stm->bindValue(1, $perdido->getId());
                    $stm->execute();

                    // Excluir da tabela de animais
                    $sql = "DELETE FROM animais WHERE id_animal = ?";
                    $stm = $this->db->prepare($sql);
                    $stm->bindValue(1, $id_animal);
                    $stm->execute();

                    $this->db->commit();
                    return "Animal excluído com sucesso";
                } else {
                    $this->db->rollBack();
                    return "Animal não encontrado";
                }
            } catch (PDOException $e) {
                $this->db->rollBack();
                if ($e->getCode() == 23000) {
                    return "Animal contém prontuários. Não pode ser excluído";
                } else {
                    return "Problema ao excluir animal: " . $e->getMessage();
                }
            }
        }
    }