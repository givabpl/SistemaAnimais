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
            $sql = "INSERT INTO achados (especie, raca, pelagem, sexo, imagem, localac, dataac, horaac, descritivo, nome_pessoa, sobrenome, telefone1, telefone2, statusac) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $achado->getEspecie());
            $stm->bindValue(2, $achado->getRaca());
            $stm->bindValue(3, $achado->getPelagem());
            $stm->bindValue(4, $achado->getSexo());
            $stm->bindValue(5, $achado->getImagem());
            $stm->bindValue(6, $achado->getLocalac());
            $stm->bindValue(7, $achado->getDataac());
            $stm->bindValue(8, $achado->getHoraac());
            $stm->bindValue(9, $achado->getDescr());
            $stm->bindValue(10, $achado->getNome());
            $stm->bindValue(11, $achado->getSobrenome());
            $stm->bindValue(12, $achado->getTelefone1());
            $stm->bindValue(13, $achado->getTelefone2());
            $stm->bindValue(14, $achado->getStatus());
            return $stm->execute();
        }


        // BUSCA PAGINADA: ANIMAIS  (LIMITE 15)
        public function buscar_achados_paginados($offset, $limite)
        {
            $sql = "SELECT * FROM achados 
                    LIMIT :limite OFFSET :offset";

            $stm = $this->db->prepare($sql);
            $stm->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
            $stm->bindValue(':limite', (int) $limite, PDO::PARAM_INT);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }

        // BUSCA PAGINADA: ANIMAIS  (LIMITE 15)
        public function buscar_achados_paginados_pub($offset, $limite)
        {
            $sql = "SELECT * FROM achados, 
                    LIMIT :limite OFFSET :offset";

            $stm = $this->db->prepare($sql);
            $stm->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
            $stm->bindValue(':limite', (int) $limite, PDO::PARAM_INT);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }

        // BUSCA PAGINADA: CONTA ACHADOS
        public function contar_achados()
        {
            $sql = "SELECT COUNT(*) AS total FROM achados";
            $stm = $this->db->prepare($sql);
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ)->total;
        }

        // BUSCAR ANIMAIS ACHADOS PUBLICO
        public function buscar_achados_publico()
        {
            $sql = "SELECT * FROM achados";

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
                    FROM achados 
                    WHERE id_achado = ?";
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
                    FROM achados 
                    WHERE id_achado = ?";
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

        // REMOVER ACHADO
        public function remover_achado($achado)
        {
            $sql = "DELETE FROM achados WHERE id_achado = ?";

            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $achado->getId());
            $stm->execute();
            $this->db = null;
            return "Animal excluído com sucesso";

        }
    }