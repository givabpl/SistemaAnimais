<?php
    namespace SistemaAnimais\DAOs;

    use SistemaAnimais\Models\Conexao;
    use PDO;
    use PDOException;

    class tutorDAO extends Conexao
    {
        public function __construct()
        {
            parent:: __construct();
        }

        // INSERIR TUTOR
        public function inserir($tutor)
        {
            $sql = "INSERT INTO tutores (nome, sobrenome, rg, cpf, cep, logradouro, numero, bairro, telefone1, telefone2) VALUES (?,?,?,?,?,?,?,?,?,?)";

            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $tutor->getNome());
            $stm->bindValue(2, $tutor->getSobrenome());
            $stm->bindValue(3, $tutor->getRg());
            $stm->bindValue(4, $tutor->getCpf());
            $stm->bindValue(5, $tutor->getCep());
            $stm->bindValue(6, $tutor->getLogradouro());
            $stm->bindValue(7, $tutor->getNumero());
            $stm->bindValue(8, $tutor->getBairro());
            $stm->bindValue(9, $tutor->getTel1());
            $stm->bindValue(10, $tutor->getTel2());

            $stm->execute();
            return $this->db->lastInsertId();
        }

        // EDITAR TUTOR
        public function editar($tutor)
        {
            $sql = "UPDATE tutores SET nome = ?, sobrenome = ?, rg = ?, cpf = ?, cep = ?, logradouro = ?, numero = ?, bairro = ?, telefone1 = ?, telefone2 = ? WHERE id_tutor = ?";

            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $tutor->getNome());
            $stm->bindValue(2, $tutor->getSobrenome());
            $stm->bindValue(3, $tutor->getRg());
            $stm->bindValue(4, $tutor->getCpf());
            $stm->bindValue(5, $tutor->getCep());
            $stm->bindValue(6, $tutor->getLogradouro());
            $stm->bindValue(7, $tutor->getNumero());
            $stm->bindValue(8, $tutor->getBairro());
            $stm->bindValue(9, $tutor->getTel1());
            $stm->bindValue(10, $tutor->getTel2());
            $stm->bindValue(11, $tutor->getId());
            $stm->execute();
            $this->db = null;
            return "Tutor editado com sucesso";
        }

        // BUSCAR TUTORES (PRIVADO: CONTEM TODOS OS DADOS DO TUTOR)
        public function buscar_tutores()
        {
            $sql = "SELECT * FROM tutores";
            $stm = $this->db->prepare($sql);
            $stm->execute();
            $this->db = null;
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }

        // BUSCAR TUTORES PAGINADOS
        public function buscar_tutores_paginados($offset, $limite)
        {
            $sql = "SELECT * FROM tutores ORDER BY id_tutor DESC LIMIT :offset, :limite";
            $stm = $this->db->prepare($sql);
            $stm->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
            $stm->bindValue(':limite', (int) $limite, PDO::PARAM_INT);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }

        // BUSCA PAGINADA: CONTA TUTORES
        public function contar_tutores()
        {
            $sql = "SELECT COUNT(*) AS total FROM tutores";
            $stm = $this->db->prepare($sql);
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ)->total;
        }

        // BUSCAR TUTORES PESQUISA
        public function buscar_tutores_pesquisa($pesquisa, $limite, $offset)
        {
            $pesquisa = '%' . $pesquisa . '%';
            $sql = "SELECT * FROM tutores
                    WHERE nome LIKE :pesquisa
                       OR sobrenome LIKE :pesquisa
                       OR rg LIKE :pesquisa
                       OR cpf LIKE :pesquisa
                       OR logradouro LIKE :pesquisa
                       OR bairro LIKE :pesquisa";

            $stm = $this->db->prepare($sql);

            $stm->bindValue(':pesquisa', $pesquisa, PDO::PARAM_STR);
            $stm->bindValue(':limite', (int) $limite, PDO::PARAM_INT);
            $stm->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
            $stm->execute();

            $retorno = $stm->fetchAll(PDO::FETCH_OBJ);
            return $retorno;
        }

        // CONTAR TUTORES PESQUISA
        public function contar_tutores_pesquisa($pesquisa)
        {
            $sql = "SELECT COUNT(*) AS total 
                    FROM tutores
                    WHERE nome LIKE :pesquisa
                       OR sobrenome LIKE :pesquisa
                       OR rg LIKE :pesquisa
                       OR cpf LIKE :pesquisa
                       OR logradouro LIKE :pesquisa
                       OR bairro LIKE :pesquisa";

            $stm = $this->db->prepare($sql);
            $stm->bindValue(':pesquisa', $pesquisa, PDO::PARAM_STR);
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ)->total;
        }

        // BUSCAR ANIMAIS DE UM TUTOR PESQUISA
        public function buscar_animais_tutor_pesquisa($tutor, $pesquisa, $limite, $offset)
        {
            $pesquisa = '%' . $pesquisa . '%';

            $sql = "SELECT animais.*,
                           animais.nome AS nome_animal,
                           tutores.id_tutor,
                           tutores.nome AS nome_tutor, 
                           tutores.sobrenome
                    FROM animais 
                    JOIN tutores ON animais.id_tutor = tutores.id_tutor
                    WHERE animais.nome LIKE :pesquisa
                       OR animais.rga LIKE :pesquisa
                       OR animais.chip LIKE :pesquisa
                       OR animais.especie LIKE :pesquisa
                       OR animais.raca LIKE :pesquisa
                       OR animais.pelagem LIKE :pesquisa
                       AND animais.id_tutor = :id_tutor
                    LIMIT :offset, :limite";

            $stm = $this->db->prepare($sql);

            $stm->bindValue('id_tutor', $tutor->getId(), PDO::PARAM_INT);
            $stm->bindValue(':pesquisa', $pesquisa, PDO::PARAM_STR);
            $stm->bindValue(':limite', (int) $limite, PDO::PARAM_INT);
            $stm->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
            $stm->execute();

            $retorno = $stm->fetchAll(PDO::FETCH_OBJ);
            return $retorno;
        }

        // CONTAR ANIMAIS DE UM TUTOR PESQUISA
        public function contar_animais_tutor_pesquisa($tutor, $pesquisa)
        {
            $pesquisa = '%' . $pesquisa . '%';
            $sql = "SELECT COUNT(*) AS total 
                    FROM animais
                    JOIN tutores ON animais.id_tutor = tutores.id_tutor
                    WHERE animais.nome LIKE :pesquisa
                       OR animais.rga LIKE :pesquisa
                       OR animais.chip LIKE :pesquisa
                       OR animais.especie LIKE :pesquisa
                       OR animais.raca LIKE :pesquisa
                       OR animais.pelagem LIKE :pesquisa
                       AND animais.id_tutor = :id_tutor
                    ";

            $stm = $this->db->prepare($sql);
            $stm->bindValue('id_tutor', $tutor->getId(), PDO::PARAM_INT);
            $stm->bindValue(':pesquisa', $pesquisa, PDO::PARAM_STR);
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ)->total;
        }

        // BUSCAR TUTORES EM ORDEM ALFABETICA PAGINADO
        public function ordenar_tutores_alf($offset, $limite)
        {
            $sql = "SELECT * FROM tutores ORDER BY nome ASC LIMIT :offset, :limite";
            $stm = $this->db->prepare($sql);
            $stm->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
            $stm->bindValue(':limite', (int) $limite, PDO::PARAM_INT);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }

        // BUSCAR UM TUTOR
        public function buscar_tutor($tutor)
        {
            $sql = "SELECT * FROM tutores WHERE id_tutor = ?";

            try
            {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $tutor->getId());
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_OBJ);
            }
            catch(PDOException $e)
            {
                echo "Problema ao buscar tutor: " . $e->getMessage();
                return null;
            }
        }

        // BUSCAR ANIMAIS DE UM TUTOR PRIVADO (BUSCA NOME E SOBRENOME)
        public function buscar_animais_tutor($tutor, $offset, $limite)
        {
            $sql = "SELECT animais.*, 
                    animais.nome AS nome_animal, 
                    tutores.nome AS nome_tutor, 
                    tutores.sobrenome
                    FROM animais 
                    JOIN tutores ON animais.id_tutor = tutores.id_tutor
                    WHERE animais.id_tutor = :id_tutor
                    LIMIT :offset, :limite";
            try
            {
                $stm = $this->db->prepare($sql);
                $stm->bindValue('id_tutor', $tutor->getId(), PDO::PARAM_INT);
                $stm->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
                $stm->bindValue(':limite', (int) $limite, PDO::PARAM_INT);
                $stm->execute();
                $retorno = $stm->fetchAll(PDO::FETCH_OBJ);
                return $retorno;
            }
            catch(PDOException $e)
            {
                echo "Problema ao buscar animais do tutor: " . $e->getMessage();
                return null;
            }
        }

        // CONTAR ANIMAIS TUTOR
        public function contar_animais_tutor($tutor)
        {
            $sql = "SELECT COUNT(*) AS total
                    FROM animais
                    JOIN tutores ON animais.id_tutor = tutores.id_tutor
                    WHERE animais.id_tutor = :id_tutor";

            $stm = $this->db->prepare($sql);
            $stm->bindValue('id_tutor', $tutor->getId(), PDO::PARAM_INT);
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ)->total;
        }

        // BUSCAR NOME DO ANIMAL & NOME DO TUTOR
        public function buscar_animal_tutor($tutor)
        {
            $sql = "SELECT animais.nome AS nome_animal, tutores.nome AS nome_tutor 
                    FROM animais 
                    JOIN tutores ON animais.id_tutor = tutores.id_tutor
                    WHERE animais.id_tutor = ?";

            try
            {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $tutor->getId());
                $stm->execute();
                $retorno = $stm->fetchAll(PDO::FETCH_OBJ);
                return $retorno;
            }
            catch(PDOException $e)
            {
                echo "Problema ao buscar animais do tutor: " . $e->getMessage();
                return null;
            }
        }

        // BUSCAR RG
        public function buscar_rg($tutor)
        {
            $sql = "SELECT * FROM tutores WHERE rg = ?";

            try
            {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $tutor->getRg());
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_OBJ);
            }
            catch(PDOException $e)
            {
                echo "Problema ao buscar rg: " . $e->getMessage();
                return null;
            }
        }
        
        // BUSCAR CPF
        public function buscar_cpf($tutor)
        {
            $sql = "SELECT * FROM tutores WHERE cpf = ?";

            try
            {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $tutor->getCpf());
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_OBJ);
            }
            catch(PDOException $e)
            {
                echo "Problema ao buscar cpf: " . $e->getMessage();
                return null;
            }
        }


        // EXCLUIR TUTOR
        public function excluir($tutor)
		{
			$sql = "DELETE FROM tutores WHERE id_tutor = ?";

			try
			{
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $tutor->getId());
				$stm->execute();
				$this->db = null;
				return "Tutor Excluido com Sucesso";
			}
			catch(PDOException $e)
			{
				$this->db = null;
				if($e->getCode() == "23000")
				{
					return "Tutor contém animais. Não pode ser excluido.";
				}
				else
				{
					return "Problema ao excluir uma tutor";
				}
			}
		}


    }