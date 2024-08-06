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
            $sql = "INSERT INTO prontuarios (titulo, dataa, locala, descritivo, medicacao, medicacao_info, internacao, internacao_info, receita, arquivo, peso, id_animal, id_vet) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";

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
            $stm->bindValue(10, $pront->getArquivo ());
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

        // BUSCA PAGINADA: CONTAR PRONTS
        public function contar_pronts()
        {
            $sql = "SELECT COUNT(*) AS total FROM prontuarios";
            $stm = $this->db->prepare($sql);
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ)->total;
        }

        // BUSCA PAGINADA: PRONTUARIOS  (LIMITE 15)
        public function buscar_pronts_paginados($offset, $limite)
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
                    ORDER BY dataa DESC
                    LIMIT :offset, :limite";
            $stm = $this->db->prepare($sql);
            $stm->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
            $stm->bindValue(':limite', (int) $limite, PDO::PARAM_INT);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }

        // BUSCAR PRONTUÁRIOS PESQUISA
        public function buscar_pronts_pesquisa($pesquisa, $limite, $offset)
        {
            $pesquisa = '%' . $pesquisa . '%';

            $sql = "SELECT prontuarios.*,
                           DATE_FORMAT(dataa, '%d/%m/%Y') AS data_formatada,
                           animais.nome AS nome_animal,
                           tutores.nome AS nome_tutor,
                           tutores.nome AS nome_tutor,
                           tutores.sobrenome,
                           veterinarios.nome AS nome_vet
                     FROM prontuarios
                     JOIN animais ON prontuarios.id_animal = animais.id_animal
                     JOIN tutores ON animais.id_tutor = tutores.id_tutor
                     JOIN veterinarios ON prontuarios.id_vet = veterinarios.id_vet
                     WHERE prontuarios.titulo LIKE :pesquisa
                        OR DATE_FORMAT(prontuarios.dataa, '%d/%m/%Y') LIKE :pesquisa
                        OR prontuarios.locala LIKE :pesquisa
                        OR animais.nome LIKE :pesquisa
                        OR tutores.nome LIKE :pesquisa
                        OR tutores.sobrenome LIKE :pesquisa
                        OR veterinarios.nome LIKE :pesquisa
                     LIMIT :offset, :limite";

            $stm = $this->db->prepare($sql);
            $stm->bindValue(':pesquisa', $pesquisa, PDO::PARAM_STR);
            $stm->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
            $stm->bindValue(':limite', (int) $limite, PDO::PARAM_INT);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }

        // CONTAR PRONTUÁRIOS PESQUISA
        public function contar_pronts_pesquisa($pesquisa)
        {
            $sql = "SELECT COUNT(*) AS total
                    FROM prontuarios
                    JOIN animais ON prontuarios.id_animal = animais.id_animal
                    JOIN tutores ON animais.id_tutor = tutores.id_tutor
                    JOIN veterinarios ON prontuarios.id_vet = veterinarios.id_vet 
                    WHERE prontuarios.titulo LIKE :pesquisa
                       OR DATE_FORMAT(prontuarios.dataa, '%d/%m/%Y') LIKE :pesquisa
                       OR prontuarios.locala LIKE :pesquisa
                       OR animais.nome LIKE :pesquisa
                       OR tutores.nome LIKE :pesquisa
                       OR tutores.sobrenome LIKE :pesquisa
                       OR veterinarios.nome LIKE :pesquisa";

            $stm = $this->db->prepare($sql);
            $stm->bindValue(':pesquisa', $pesquisa, PDO::PARAM_STR);
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ)->total;
        }

        // BUSCAR PRONTUÁRIOS DE UM VETERINÁRIO PESQUISA
        public function buscar_pronts_vet_pesquisa($vet, $pesquisa, $limite, $offset)
        {
            $pesquisa = '%' . $pesquisa . '%';

            $sql = "SELECT prontuarios.*,
                           DATE_FORMAT(dataa, '%d/%m/%Y') AS data_formatada,
                           animais.nome AS nome_animal,
                           tutores.nome AS nome_tutor,
                           tutores.nome AS nome_tutor,
                           tutores.sobrenome,
                           veterinarios.nome AS nome_vet
                     FROM prontuarios
                     JOIN animais ON prontuarios.id_animal = animais.id_animal
                     JOIN tutores ON animais.id_tutor = tutores.id_tutor
                     JOIN veterinarios ON prontuarios.id_vet = veterinarios.id_vet
                     WHERE (prontuarios.titulo LIKE :pesquisa
                        OR DATE_FORMAT(prontuarios.dataa, '%d/%m/%Y') LIKE :pesquisa
                        OR prontuarios.locala LIKE :pesquisa
                        OR animais.nome LIKE :pesquisa
                        OR tutores.nome LIKE :pesquisa
                        OR tutores.sobrenome LIKE :pesquisa
                        OR veterinarios.nome LIKE :pesquisa)
                        AND prontuarios.id_vet = :id_vet
                     LIMIT :offset, :limite";

            $stm = $this->db->prepare($sql);

            $stm->bindValue('id_vet', $vet->getId(), PDO::PARAM_INT);
            $stm->bindValue(':pesquisa', $pesquisa, PDO::PARAM_STR);
            $stm->bindValue(':limite', (int) $limite, PDO::PARAM_INT);
            $stm->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_OBJ);
        }

        // CONTAR PRONTUÁRIOS DE UM VETERINÁRIO PESQUISA
        public function contar_pronts_vet_pesquisa($vet, $pesquisa)
        {
            $sql = "SELECT COUNT(*) AS total
                    FROM prontuarios
                    JOIN animais ON prontuarios.id_animal = animais.id_animal
                    JOIN tutores ON animais.id_tutor = tutores.id_tutor
                    JOIN veterinarios ON prontuarios.id_vet = veterinarios.id_vet 
                    WHERE (prontuarios.titulo LIKE :pesquisa
                       OR DATE_FORMAT(prontuarios.dataa, '%d/%m/%Y') LIKE :pesquisa
                       OR animais.nome LIKE :pesquisa
                       OR tutores.nome LIKE :pesquisa
                       OR tutores.sobrenome LIKE :pesquisa
                       OR veterinarios.nome LIKE :pesquisa)
                    AND prontuarios.id_vet = :id_vet";

            $stm = $this->db->prepare($sql);
            $stm->bindValue('id_vet', $vet->getId(), PDO::PARAM_INT);
            $stm->bindValue(':pesquisa', $pesquisa, PDO::PARAM_STR);
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ)->total;
        }

        // BUSCAR PRONTUÁRIOS DE UM VETERINÁRIO PESQUISA
        public function buscar_pronts_animal_pesquisa($animal, $pesquisa, $limite, $offset)
        {
            $pesquisa = '%' . $pesquisa . '%';

            $sql = "SELECT prontuarios.*,
                           DATE_FORMAT(dataa, '%d/%m/%Y') AS data_formatada,
                           animais.nome AS nome_animal,
                           tutores.nome AS nome_tutor,
                           tutores.nome AS nome_tutor,
                           tutores.sobrenome,
                           veterinarios.nome AS nome_vet
                     FROM prontuarios
                     JOIN animais ON prontuarios.id_animal = animais.id_animal
                     JOIN tutores ON animais.id_tutor = tutores.id_tutor
                     JOIN veterinarios ON prontuarios.id_vet = veterinarios.id_vet
                     WHERE (prontuarios.titulo LIKE :pesquisa
                        OR DATE_FORMAT(prontuarios.dataa, '%d/%m/%Y') LIKE :pesquisa
                        OR prontuarios.locala LIKE :pesquisa
                        OR animais.nome LIKE :pesquisa
                        OR tutores.nome LIKE :pesquisa
                        OR tutores.sobrenome LIKE :pesquisa
                        OR veterinarios.nome LIKE :pesquisa)
                        AND prontuarios.id_animal = :id_animal
                     LIMIT :offset, :limite";

            $stm = $this->db->prepare($sql);
            $stm->bindValue('id_animal', $animal->getId(), PDO::PARAM_INT);
            $stm->bindValue(':pesquisa', $pesquisa, PDO::PARAM_STR);
            $stm->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
            $stm->bindValue(':limite', (int) $limite, PDO::PARAM_INT);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }

        // CONTAR PRONTUÁRIOS DE UM ANIMAL PESQUISA
        public function contar_pronts_animal_pesquisa($animal, $pesquisa)
        {
            $sql = "SELECT COUNT(*) AS total
                    FROM prontuarios
                    JOIN animais ON prontuarios.id_animal = animais.id_animal
                    JOIN tutores ON animais.id_tutor = tutores.id_tutor
                    JOIN veterinarios ON prontuarios.id_vet = veterinarios.id_vet 
                    WHERE (prontuarios.titulo LIKE :pesquisa
                       OR DATE_FORMAT(prontuarios.dataa, '%d/%m/%Y') LIKE :pesquisa
                       OR animais.nome LIKE :pesquisa
                       OR tutores.nome LIKE :pesquisa
                       OR tutores.sobrenome LIKE :pesquisa
                       OR veterinarios.nome LIKE :pesquisa)
                    AND prontuarios.id_animal = :id_animal";

            $stm = $this->db->prepare($sql);
            $stm->bindValue('id_animal', $animal->getId(), PDO::PARAM_INT);
            $stm->bindValue(':pesquisa', $pesquisa, PDO::PARAM_STR);
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ)->total;
        }



        // BUSCAR PRONTUARIOS - ORDENAR POR LOCAL - PAGINADOS
        public function ordenar_pronts_local($offset, $limite)
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
                    ORDER BY locala ASC
                    LIMIT :offset, :limite";
            $stm = $this->db->prepare($sql);
            $stm->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
            $stm->bindValue(':limite', (int) $limite, PDO::PARAM_INT);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }

        // BUSCAR PRONTUARIOS - ORDENAR POR LOCAL - PAGINADOS
        public function ordenar_pronts_tutor($offset, $limite)
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
                    ORDER BY nome_tutor ASC
                    LIMIT :offset, :limite";
            $stm = $this->db->prepare($sql);
            $stm->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
            $stm->bindValue(':limite', (int) $limite, PDO::PARAM_INT);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }

        // BUSCAR PRONTUARIOS - ORDENAR POR LOCAL - PAGINADOS
        public function ordenar_pronts_vet($offset, $limite)
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
                    ORDER BY nome_vet ASC
                    LIMIT :offset, :limite";
            $stm = $this->db->prepare($sql);
            $stm->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
            $stm->bindValue(':limite', (int) $limite, PDO::PARAM_INT);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }

        // BUSCAR PRONTUARIOS DE UM ANIMAL - PAGINADOS
        public function buscar_pronts_animal($animal, $offset, $limite)
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
                    WHERE prontuarios.id_animal = :id_animal
                    LIMIT :offset, :limite";
            try
            {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(':id_animal', $animal->getId(), PDO::PARAM_INT);
                $stm->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
                $stm->bindValue(':limite', (int) $limite, PDO::PARAM_INT);
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_OBJ);
            }
            catch(PDOException $e)
            {
                echo "Problema ao buscar prontuários do animal: " . $e->getMessage();
                return null;
            }    
        }

        // CONTAR PRONTUÁRIOS ANIMAL
        public function contar_pronts_animal($animal)
        {
            $sql = "SELECT COUNT(*) AS total 
                    FROM prontuarios
                    JOIN animais ON prontuarios.id_animal = animais.id_animal
                    WHERE prontuarios.id_animal = :id_animal";
            $stm = $this->db->prepare($sql);
            $stm->bindValue('id_animal', $animal->getId(), PDO::PARAM_INT);
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ)->total;
        }

        // BUSCAR DADOS DO ANIMAL E TUTOR
        public function buscar_dados_animal_tutor($animal)
        {
            $sql = "SELECT animais.nome AS nome_animal, 
                   tutores.nome AS nome_tutor, 
                   tutores.sobrenome
            FROM animais
            JOIN tutores ON animais.id_tutor = tutores.id_tutor
            WHERE animais.id_animal = :id_animal";
            $stm = $this->db->prepare($sql);
            $stm->bindValue(':id_animal', $animal->getId(), PDO::PARAM_INT);
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        }


        // BUSCAR PRONTUARIOS DE UM VETERINARIO
        public function buscar_pronts_vet($vet, $offset, $limite)
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
                    WHERE prontuarios.id_vet = :id_vet
                    LIMIT :offset, :limite";
            try
            {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(':id_vet', $vet->getId(), PDO::PARAM_INT);
                $stm->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
                $stm->bindValue(':limite', (int) $limite, PDO::PARAM_INT);
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_OBJ);
            }
            catch(PDOException $e)
            {
                echo "Problema ao buscar prontuários do veterinario: " . $e->getMessage();
                return null;
            }    
        }

        // CONTAR PRONTUÁRIOS DE UM VETERINÁRIO
        public function contar_pronts_vet($vet)
        {
            $sql = "SELECT COUNT(*) AS total 
                    FROM prontuarios
                    JOIN veterinarios ON prontuarios.id_vet = veterinarios.id_vet
                    WHERE prontuarios.id_vet = :id_vet";
            $stm = $this->db->prepare($sql);
            $stm->bindValue('id_vet', $vet->getId(), PDO::PARAM_INT);
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ)->total;
        }

        // BUSCAR DADOS DO VETERINÁRIO
        public function buscar_dados_vet($vet)
        {
            $sql = "SELECT nome, sobrenome 
            FROM veterinarios 
            WHERE id_vet = :id_vet";
            $stm = $this->db->prepare($sql);
            $stm->bindValue(':id_vet', $vet->getId(), PDO::PARAM_INT);
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
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