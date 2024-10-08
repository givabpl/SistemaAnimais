<?php
    namespace SistemaAnimais\DAOs;

    use SistemaAnimais\Models\Conexao;
    use PDO;
    use PDOException;
    

    class animalDAO extends Conexao
    {
        public function __construct()
        {
            parent:: __construct();
        }

        // INSERIR ANIMAL
        public function inserir($animal)
        {
            $sql = "INSERT INTO animais (rga, chip, nome, datan, sexo, alergias, doencas, cirurgias, peso, especie, raca, pelagem, aquisicao, id_tutor) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $animal->getRga());
            $stm->bindValue(2, $animal->getChip());
            $stm->bindValue(3, $animal->getNome());
            $stm->bindValue(4, $animal->getDatan() ? $animal->getDatan() : null);
            $stm->bindValue(5, $animal->getSexo());
            $stm->bindValue(6, $animal->getAlergias());
            $stm->bindValue(7, $animal->getDoencas());
            $stm->bindValue(8, $animal->getCirurgias());
            $stm->bindValue(9, $animal->getPeso());
            $stm->bindValue(10, $animal->getEspecie());
            $stm->bindValue(11, $animal->getRaca());
            $stm->bindValue(12, $animal->getPelagem());
            $stm->bindValue(13, $animal->getAquisicao());
            // Verifica se o tutor é nulo antes de obter o ID
            if ($animal->getTutor() !== null) {
                $stm->bindValue(14, $animal->getTutor()->getId());
            } else {
                $stm->bindValue(14, null, PDO::PARAM_NULL);
            }

            $stm->execute();
            return $this->db->lastInsertId();
        }

        // BUSCAR ANIMAIS
        public function buscar_animais()
        {
            $sql = "SELECT animais.*, tutores.nome AS nome_tutor, tutores.sobrenome 
                    FROM animais 
                    JOIN tutores ON animais.id_tutor = tutores.id_tutor";

            $stm = $this->db->prepare($sql);
            $stm->execute();
            $this->db = null;

            $retorno = $stm->fetchAll(PDO::FETCH_OBJ);
            return $retorno;
        }

        // BUSCAR ANIMAIS PUBLICO
        public function buscar_animais_publico()
        {
            $sql = "SELECT animais.*, 
                           tutores.nome AS nome_tutor
                    FROM animais 
                    JOIN tutores ON animais.id_tutor = tutores.id_tutor";

            $stm = $this->db->prepare($sql);
            $stm->execute();
            $this->db = null;

            $retorno = $stm->fetchAll(PDO::FETCH_OBJ);
            return $retorno;
        }

        // BUSCA PAGINADA: ANIMAIS  (LIMITE 15)
        public function buscar_animais_paginados($offset, $limite)
        {
            $sql = "SELECT animais.*, 
                           tutores.nome AS nome_tutor, 
                           tutores.sobrenome
                    FROM animais 
                    JOIN tutores ON animais.id_tutor = tutores.id_tutor
                    ORDER BY id_animal DESC
                    LIMIT :offset, :limite";

            $stm = $this->db->prepare($sql);
            $stm->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
            $stm->bindValue(':limite', (int) $limite, PDO::PARAM_INT);
            $stm->execute();

            $retorno = $stm->fetchAll(PDO::FETCH_OBJ);
            return $retorno;
        }

        // BUSCA PAGINADA PÚBLICA: ANIMAIS  (LIMITE 15)
        public function buscar_animais_paginados_pub($offset, $limite)
        {
            $sql = "SELECT animais.*, 
                           tutores.nome AS nome_tutor
                    FROM animais 
                    JOIN tutores ON animais.id_tutor = tutores.id_tutor
                    ORDER BY id_animal DESC
                    LIMIT :offset, :limite";

            $stm = $this->db->prepare($sql);
            $stm->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
            $stm->bindValue(':limite', (int) $limite, PDO::PARAM_INT);
            $stm->execute();

            $retorno = $stm->fetchAll(PDO::FETCH_OBJ);
            return $retorno;
        }

        // BUSCA PAGINADA: CONTA ANIMAIS
        public function contar_animais()
        {
            $sql = "SELECT COUNT(*) AS total FROM animais";

            $stm = $this->db->prepare($sql);
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ)->total;
        }

        // BUSCAR ANIMAIS PESQUISA
        public function buscar_animais_pesquisa($pesquisa, $limite, $offset)
        {
            $pesquisa = '%' . $pesquisa . '%';
            $sql = "SELECT animais.*,
                           tutores.nome AS nome_tutor,
                           tutores.sobrenome
                    FROM animais
                    JOIN tutores ON animais.id_tutor = tutores.id_tutor
                    WHERE animais.nome LIKE :pesquisa 
                       OR animais.rga LIKE :pesquisa 
                       OR animais.chip LIKE :pesquisa 
                       OR animais.especie LIKE :pesquisa 
                       OR animais.raca LIKE :pesquisa 
                       OR tutores.nome LIKE :pesquisa 
                       OR tutores.sobrenome LIKE :pesquisa 
                    LIMIT :limite OFFSET :offset";

            $stm = $this->db->prepare($sql);
            $stm->bindValue(':pesquisa', $pesquisa, PDO::PARAM_STR);
            $stm->bindValue(':limite', (int) $limite, PDO::PARAM_INT);
            $stm->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
            $stm->execute();

            $retorno = $stm->fetchAll(PDO::FETCH_OBJ);
            return $retorno;
        }

        // CONTAR ANIMAIS PESQUISA
        public function contar_animais_pesquisa($pesquisa)
        {
            $pesquisa = '%' . $pesquisa . '%';
            $sql = "SELECT COUNT(*) as total 
                    FROM animais 
                    JOIN tutores ON animais.id_tutor = tutores.id_tutor
                    WHERE animais.nome LIKE :pesquisa 
                       OR animais.rga LIKE :pesquisa 
                       OR animais.chip LIKE :pesquisa 
                       OR animais.especie LIKE :pesquisa 
                       OR animais.raca LIKE :pesquisa 
                       OR tutores.nome LIKE :pesquisa 
                       OR tutores.sobrenome LIKE :pesquisa";

            $stm = $this->db->prepare($sql);
            $stm->bindValue(':pesquisa', $pesquisa, PDO::PARAM_STR);
            $stm->execute();

            return $stm->fetch(PDO::FETCH_OBJ)->total;
        }


        // ORDENAR ANIMAIS POR ORDEM ALFABETICA
        public function ordenar_animais_alf($offset, $limite)
        {
            $sql = "SELECT animais.*, 
                           tutores.nome AS nome_tutor, 
                           tutores.sobrenome
                    FROM animais 
                    JOIN tutores ON animais.id_tutor = tutores.id_tutor
                    ORDER BY nome
                    LIMIT :offset, :limite";

            $stm = $this->db->prepare($sql);
            $stm->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
            $stm->bindValue(':limite', (int) $limite, PDO::PARAM_INT);
            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_OBJ);
        }

        // ORDENAR ANIMAIS POR ORDEM ALFABETICA PUBLICO
        public function ordenar_animais_alf_publico($offset, $limite)
        {
            $sql = "SELECT animais.*, 
                           tutores.nome AS nome_tutor
                    FROM animais 
                    JOIN tutores ON animais.id_tutor = tutores.id_tutor
                    ORDER BY nome
                    LIMIT :offset, :limite";
            $stm = $this->db->prepare($sql);
            $stm->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
            $stm->bindValue(':limite', (int) $limite, PDO::PARAM_INT);
            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_OBJ);
        }

        // ORDENAR ANIMAIS POR NOME DO TUTOR
        public function ordenar_animais_tutor($offset, $limite)
        {
            $sql = "SELECT animais.*, 
                           tutores.nome AS nome_tutor, 
                           tutores.sobrenome 
                    FROM animais 
                    JOIN tutores ON animais.id_tutor = tutores.id_tutor
                    ORDER BY nome_tutor
                    LIMIT :offset, :limite";

            $stm = $this->db->prepare($sql);
            $stm->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
            $stm->bindValue(':limite', (int) $limite, PDO::PARAM_INT);
            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_OBJ);
        }

        // ORDENAR ANIMAIS POR NOME DO TUTOR PUBLICO
        public function ordenar_animais_tutor_publico($offset, $limite)
        {
            $sql = "SELECT animais.*, 
                           tutores.nome AS nome_tutor
                    FROM animais 
                    JOIN tutores ON animais.id_tutor = tutores.id_tutor
                    ORDER BY nome_tutor
                    LIMIT :offset, :limite";

            $stm = $this->db->prepare($sql);
            $stm->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
            $stm->bindValue(':limite', (int) $limite, PDO::PARAM_INT);
            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_OBJ);
        }

        // BUSCAR NOME DO ANIMAL & NOME DO TUTOR
        public function buscar_animal_tutor($animal)
        {
            $sql = "SELECT animais.nome AS nome_animal, 
                           tutores.nome AS nome_tutor, 
                           tutores.sobrenome
                    FROM animais 
                    JOIN tutores ON animais.id_tutor = tutores.id_tutor
                    WHERE animais.id_animal = ?";
            try
            {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $animal->getId());
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


        // BUSCAR UM ANIMAL
        public function buscar_animal($animal)
        {
            $sql = "SELECT animais.*, 
                           tutores.nome AS nome_tutor,
                           tutores.sobrenome 
                    FROM animais 
                    JOIN tutores ON animais.id_tutor = tutores.id_tutor 
                    WHERE animais.id_animal = ?";
            try
            {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $animal->getId());
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
        public function buscar_animal_publico($animal)
        {
            $sql = "SELECT animais.*, 
                           tutores.nome AS nome_tutor, 
                           tutores.sobrenome
                    FROM animais 
                    JOIN tutores ON animais.id_tutor = tutores.id_tutor 
                    WHERE animais.id_animal = ?";

            try
            {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $animal->getId());
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_OBJ);
            }
            catch(PDOException $e)
            {
                echo "Problema ao buscar animal: " . $e->getMessage();
                return null;
            }
        }

        
        public function buscar_rga($animal)
        {
            $sql = "SELECT * FROM animais WHERE rga = ?";

            try
            {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $animal->getRga());
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
        public function excluir($animal)
        {
            $sql = "DELETE FROM animais WHERE id_animal = ?";

            try
            {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $animal->getId());
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

        // EDITAR ANIMAL
        public function editar($animal)
        {
            $sql = "UPDATE animais SET rga = ?, chip = ?, nome = ?, datan = ?, sexo = ?, alergias = ?, doencas = ?, cirurgias = ?, peso = ?, especie = ?, raca = ?, pelagem = ?, aquisicao = ?, id_tutor = ? WHERE id_animal = ?";

            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $animal->getRga());
            $stm->bindValue(2, $animal->getChip());
            $stm->bindValue(3, $animal->getNome());
            $stm->bindValue(4, $animal->getDatan());
            $stm->bindValue(5, $animal->getSexo());
            $stm->bindValue(6, $animal->getAlergias());
            $stm->bindValue(7, $animal->getDoencas());
            $stm->bindValue(8, $animal->getCirurgias());
            $stm->bindValue(9, $animal->getPeso());
            $stm->bindValue(10, $animal->getEspecie());
            $stm->bindValue(11, $animal->getRaca());
            $stm->bindValue(12, $animal->getPelagem());
            $stm->bindValue(13, $animal->getAquisicao());
            $stm->bindValue(14, $animal->getTutor()->getId());
            $stm->bindValue(15, $animal->getId());
            $stm->execute();
            $this->db = null;
            return "Animal editado com sucesso";
        }
    }