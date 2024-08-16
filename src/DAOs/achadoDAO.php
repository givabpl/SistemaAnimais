<?php
    namespace SistemaAnimais\DAOs;

    use SistemaAnimais\Models\Conexao;
    use SistemaAnimais\Models\Achado;
    use PDO;
    use PDOException;
    

    class achadoDAO extends Conexao
    {
        public function __construct()
        {
            parent:: __construct();
        }

        // INSERIR ANIMAL ACHADO
        public function inserir($achado)
        {
            $sql = "INSERT INTO achados (especie, raca, pelagem, sexo, imagem, localac, dataac, horaac, descritivo, nome_pessoa, sobrenome, telefone1, telefone2) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";

            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $achado->getEspecie());
            $stm->bindValue(2, $achado->getRaca());
            $stm->bindValue(3, $achado->getPelagem());
            $stm->bindValue(4, $achado->getSexo());
            $stm->bindValue(5, $achado->getImagem());
            $stm->bindValue(6, $achado->getLocal());
            $stm->bindValue(7, $achado->getData());
            $stm->bindValue(8, $achado->getHora());
            $stm->bindValue(9, $achado->getDescr());
            $stm->bindValue(10, $achado->getNome());
            $stm->bindValue(11, $achado->getSobrenome());
            $stm->bindValue(12, $achado->getTelefone1());
            $stm->bindValue(13, $achado->getTelefone2());
            return $stm->execute();
        }


        // INSERIR SOLICITAÇÃO ANIMAL ACHADO (USUÁRIO PÚBLICO ENVIA PARA A TABELA DE SOLICITAÇÕES)
        public function inserir_solici($achado)
        {
            $sql = "INSERT INTO solici_achados (especie, raca, pelagem, sexo, imagem, localac, dataac, horaac, descritivo, nome_pessoa, sobrenome, telefone1, telefone2) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";

            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $achado->getEspecie());
            $stm->bindValue(2, $achado->getRaca());
            $stm->bindValue(3, $achado->getPelagem());
            $stm->bindValue(4, $achado->getSexo());
            $stm->bindValue(5, $achado->getImagem());
            $stm->bindValue(6, $achado->getLocal());
            $stm->bindValue(7, $achado->getData());
            $stm->bindValue(8, $achado->getHora());
            $stm->bindValue(9, $achado->getDescr());
            $stm->bindValue(10, $achado->getNome());
            $stm->bindValue(11, $achado->getSobrenome());
            $stm->bindValue(12, $achado->getTelefone1());
            $stm->bindValue(13, $achado->getTelefone2());
            return $stm->execute();
        }

        // BUSCA PAGINADA: SOLICITAÇÕES  (LIMITE 15)
        public function buscar_solicis_paginados($offset, $limite)
        {
            $sql = "SELECT * FROM solici_achados 
                    LIMIT :limite OFFSET :offset";

            $stm = $this->db->prepare($sql);
            $stm->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
            $stm->bindValue(':limite', (int) $limite, PDO::PARAM_INT);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }

        // BUSCA PAGINADA: CONTA SOLICITAÇÕES
        public function contar_solicis()
        {
            $sql = "SELECT COUNT(*) AS total FROM solici_achados";
            $stm = $this->db->prepare($sql);
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ)->total;
        }


        // BUSCA PAGINADA: ANIMAIS ACHADOS (LIMITE 15)
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
            $sql = "SELECT id_achado, especie, raca, pelagem, sexo, imagem, localac, 
                           DATE_FORMAT(dataac, '%d/%m/%Y') AS data_formatada,
                           DATE_FORMAT(horaac, '%H:%i') AS hora_formatada,
                           descritivo, nome_pessoa, telefone1, telefone2
                    FROM achados
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

        // BUSCAR UM ANIMAL ACHADO
        public function buscar_achado($achado)
        {
            $sql = "SELECT *,
                    DATE_FORMAT(dataac, '%d/%m/%Y') AS data_formatada,
                    DATE_FORMAT(horaac, '%H:%i') AS hora_formatada
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
            $sql = "SELECT id_achado, especie, raca, pelagem, sexo, imagem, localac, 
                           DATE_FORMAT(dataac, '%d/%m/%Y') AS data_formatada,
                           DATE_FORMAT(horaac, '%H:%i') AS hora_formatada,
                           descritivo, nome_pessoa, telefone1, telefone2
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

        // BUSCAR UMA SOLICITAÇÃO DE ANIMAL ACHADO
        public function buscar_solici($achado)
        {
            $sql = "SELECT *,
                    DATE_FORMAT(dataac, '%d/%m/%Y') AS data_formatada,
                    DATE_FORMAT(horaac, '%H:%i') AS hora_formatada
                    FROM solici_achados 
                    WHERE id_solici_achado = ?";
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

        public function aprovar_solici($achadoId)
        {
            $sql = "SELECT * FROM solici_achados WHERE id_solici_achado = ?";
            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $achadoId);
            $stm->execute();
            $dados = $stm->fetch(PDO::FETCH_OBJ);

            if ($dados)
            {
                $achado = new Achado();
                $achado->setEspecie($dados->especie);
                $achado->setRaca($dados->raca);
                $achado->setPelagem($dados->pelagem);
                $achado->setSexo($dados->sexo);
                $achado->setImagem($dados->imagem);
                $achado->setLocal($dados->localac);
                $achado->setData($dados->dataac);
                $achado->setHora($dados->horaac);
                $achado->setDescr($dados->descritivo);
                $achado->setNomePessoa($dados->nome_pessoa);

                $sobrenome = $dados->sobrenome ?? '';
                $achado->setSobrenome($sobrenome);

                $achado->setTelefone1($dados->telefone1);

                $telefone2 = $dados->telefone2 ?? '';
                $achado->setTelefone2($telefone2);

                $this->inserir($achado);

                $sql = "DELETE FROM solici_achados WHERE id_solici_achado = ?";
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $achadoId);
                $stm->execute();
            }
        }

        public function remover_solici($achadoId)
        {
            $sql = "DELETE FROM solici_achados WHERE id_solici_achado = ?";
            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $achadoId);
            $stm->execute();
            $this->db = null;
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