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

        // BUSCAR TUTORES (PRIVADO: CONTEM TODOS OS DADOS SO TUTOR)
        public function buscar_tutores()
        {
            $sql = "SELECT * FROM tutores";
            $stm = $this->db->prepare($sql);
            $stm->execute();
            $this->db = null;
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }  

        // BUSCAR TUTORES PUBLICO
        public function buscar_publico()
        {
            $sql = "SELECT id_tutor, nome FROM tutores";
            $stm = $this->db->prepare($sql);
            $stm->execute();
            $this->db = null;
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }  

        // BUSCAR TUTORES EM ORDEM ALFABETICA
        public function ordenar_tutores_alf()
        {
            $sql = "SELECT * FROM tutores ORDER BY nome";
            $stm = $this->db->prepare($sql);
            $stm->execute();
            $this->db = null;
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }  

        // BUSCAR TUTORES EM ORDEM ALFABETICA PUBLICO
        public function ordenar_tutores_alf_publico()
        {
            $sql = "SELECT id_tutor, nome FROM tutores ORDER BY nome";
            $stm = $this->db->prepare($sql);
            $stm->execute();
            $this->db = null;
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
        public function buscar_animais_tutor($tutor)
        {
            $sql = "SELECT animais.*, animais.nome AS nome_animal, tutores.nome AS nome_tutor, tutores.sobrenome AS sobrenome_tutor
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

        // BUSCAR ANIMAIS DE UM TUTOR PUBLICO (BUSCA APENAS O NOME)
        public function buscar_animais_tutor_publico($tutor)
        {
            $sql = "SELECT animais.*, animais.nome AS nome_animal, tutores.nome AS nome_tutor 
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




        public function buscar_por_nome($nome)
        {
            $sql = "SELECT * FROM tutores WHERE nome LIKE ?";
            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, '%' . $nome . '%');
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }

        public function buscar_por_rg($rg)
        {
            $sql = "SELECT * FROM tutores WHERE rg LIKE ?";
            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, '%' . $rg . '%');
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }

        public function buscar_por_cpf($cpf)
        {
            $sql = "SELECT * FROM tutores WHERE cpf LIKE ?";
            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, '%' . $cpf . '%');
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
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
    }