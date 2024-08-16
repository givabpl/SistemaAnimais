<?php
    namespace SistemaAnimais\DAOs;

    use SistemaAnimais\Models\Conexao;
    use SistemaAnimais\Models\Perdido;
    use PDO;
    use PDOException;
    

    class perdidoDAO extends Conexao
    {
        public function __construct()
        {
            parent:: __construct();
        }

        // INSERIR ANIMAL PERDIDO
        public function inserir($perdido)
        {
            $sql = "INSERT INTO perdidos (rga, chip, nome, datan, sexo, alergias, doencas, peso, especie, raca, pelagem, imagem, locald, datad, horad, descritivo, nome_tutor, sobrenome, telefone1, telefone2, statusp) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $perdido->getRga());
            $stm->bindValue(2, $perdido->getChip());
            $stm->bindValue(3, $perdido->getNome());
            $stm->bindValue(4, $perdido->getDatan());
            $stm->bindValue(5, $perdido->getSexo());
            $stm->bindValue(6, $perdido->getAlergias());
            $stm->bindValue(7, $perdido->getDoencas());
            $stm->bindValue(8, $perdido->getPeso());
            $stm->bindValue(9, $perdido->getEspecie());
            $stm->bindValue(10, $perdido->getRaca());
            $stm->bindValue(11, $perdido->getPelagem());
            $stm->bindValue(12, $perdido->getImagem());
            $stm->bindValue(13, $perdido->getLocal());
            $stm->bindValue(14, $perdido->getData());
            $stm->bindValue(15, $perdido->getHora());
            $stm->bindValue(16, $perdido->getDescr());
            $stm->bindValue(17, $perdido->getNomeTutor());
            $stm->bindValue(18, $perdido->getSobrenome());
            $stm->bindValue(19, $perdido->getTelefone1());
            $stm->bindValue(20, $perdido->getTelefone2());
            $stm->bindValue(21, $perdido->getStatus());
            return $stm->execute();
        }

        // INSERIR SOLICITAÇÃO ANIMAL PERDIDO (USUÁRIO PÚBLICO ENVIA PARA A TABELA DE SOLICITAÇÕES)
        public function inserir_solici($perdido)
        {
            $sql = "INSERT INTO solici_perdidos (rga, chip, nome, datan, sexo, alergias, doencas, peso, especie, raca, pelagem, imagem, locald, datad, horad, descritivo, nome_tutor, sobrenome, telefone1, telefone2, statusp) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $perdido->getRga());
            $stm->bindValue(2, $perdido->getChip());
            $stm->bindValue(3, $perdido->getNome());
            $stm->bindValue(4, $perdido->getDatan());
            $stm->bindValue(5, $perdido->getSexo());
            $stm->bindValue(6, $perdido->getAlergias());
            $stm->bindValue(7, $perdido->getDoencas());
            $stm->bindValue(8, $perdido->getPeso());
            $stm->bindValue(9, $perdido->getEspecie());
            $stm->bindValue(10, $perdido->getRaca());
            $stm->bindValue(11, $perdido->getPelagem());
            $stm->bindValue(12, $perdido->getImagem());
            $stm->bindValue(13, $perdido->getLocal());
            $stm->bindValue(14, $perdido->getData());
            $stm->bindValue(15, $perdido->getHora());
            $stm->bindValue(16, $perdido->getDescr());
            $stm->bindValue(17, $perdido->getNomeTutor());
            $stm->bindValue(18, $perdido->getSobrenome());
            $stm->bindValue(19, $perdido->getTelefone1());
            $stm->bindValue(20, $perdido->getTelefone2());
            $stm->bindValue(21, $perdido->getStatus());
            return $stm->execute();
        }

        // BUSCA PAGINADA: SOLICITAÇÕES (LIMITE 15)
        public function buscar_solicis_paginados($offset, $limite)
        {
            $sql = "SELECT * FROM solici_perdidos 
                    LIMIT :offset, :limite";

            $stm = $this->db->prepare($sql);
            $stm->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
            $stm->bindValue(':limite', (int) $limite, PDO::PARAM_INT);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }

        // BUSCA PAGINADA: CONTA SOLICITAÇÕES
        public function contar_solicis()
        {
            $sql = "SELECT COUNT(*) AS total FROM solici_perdidos";
            $stm = $this->db->prepare($sql);
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ)->total;
        }


        // BUSCA PAGINADA: ANIMAIS PERDIDOS  (LIMITE 15)
        public function buscar_perdidos_paginados($offset, $limite)
        {
            $sql = "SELECT * FROM perdidos 
                    LIMIT :offset, :limite";

            $stm = $this->db->prepare($sql);
            $stm->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
            $stm->bindValue(':limite', (int) $limite, PDO::PARAM_INT);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }


        // BUSCA PAGINADA: ANIMAIS PERDIDOS PUBLICO (LIMITE 15)
        public function buscar_perdidos_paginados_pub($offset, $limite)
        {
            $sql = "SELECT id_perdido, rga, chip, nome, 
                           DATE_FORMAT(datan, '%d/%m/%Y') AS datan_formatada, 
                           sexo, alergias, doencas, peso, especie, raca, pelagem, imagem, descritivo, locald, 
                           DATE_FORMAT(datad, '%d/%m/%Y') AS data_formatada,
                           DATE_FORMAT(horad, '%H:%i') AS hora_formatada,
                           nome_tutor, telefone1, telefone2, statusp
                    FROM perdidos 
                    LIMIT :offset, :limite";
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
            $sql = "SELECT * FROM perdidos 
                    ORDER BY nome
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
            $sql = "SELECT rga, chip, nome, 
                           DATE_FORMAT(datan, '%d/%m/%Y') AS datan_formatada, 
                           sexo, alergias, doencas, peso, especie, raca, pelagem, imagem, locald, 
                           DATE_FORMAT(datad, '%d/%m/%Y') AS data_formatada,
                           DATE_FORMAT(horad, '%H:%i') AS hora_formatada,
                           descritivo, nome_tutor, telefone1, statusp
                    FROM perdidos 
                    ORDER BY nome
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
            $sql = "SELECT * FROM perdidos 
                    ORDER BY nome_tutor
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
            $sql = "SELECT rga, chip, nome, 
                           DATE_FORMAT(datan, '%d/%m/%Y') AS datan_formatada, 
                           sexo, alergias, doencas, peso, especie, raca, pelagem, imagem, locald, 
                           DATE_FORMAT(datad, '%d/%m/%Y') AS data_formatada,
                           DATE_FORMAT(horad, '%H:%i') AS hora_formatada,
                           descritivo, nome_tutor, telefone1, statusp
                    FROM perdidos
                    ORDER BY nome_tutor
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
            $sql = "SELECT * FROM perdidos 
                    WHERE id_perdido = ?";
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
            $sql = "SELECT * FROM perdidos
                    WHERE id_perdido = ?";
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


        // BUSCAR UM ANIMAL PERDIDO
        public function buscar_perdido($perdido)
        {
            $sql = "SELECT *,
                    DATE_FORMAT(datad, '%d/%m/%Y') AS data_formatada,
                    DATE_FORMAT(horad, '%H:%i') AS hora_formatada,
                    DATE_FORMAT(datan, '%d/%m/%Y') AS datan_formatada
                    FROM perdidos 
                    WHERE id_perdido = ?";

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
            $sql = "SELECT rga, chip, nome, 
                           DATE_FORMAT(datan, '%d/%m/%Y') AS datan_formatada, 
                           sexo, alergias, doencas, peso, especie, raca, pelagem, imagem, locald, 
                           DATE_FORMAT(datad, '%d/%m/%Y') AS data_formatada,
                           DATE_FORMAT(horad, '%H:%i') AS hora_formatada,
                           descritivo, nome_tutor, telefone1, telefone2, statusp
                    FROM perdidos 
                    WHERE id_perdido = ?";

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

        // BUSCAR UMA SOLICITAÇÃO DE ANIMAL PERDIDO
        public function buscar_solici($perdido)
        {
            $sql = "SELECT *,
                    DATE_FORMAT(datad, '%d/%m/%Y') AS data_formatada,
                    DATE_FORMAT(horad, '%H:%i') AS hora_formatada,
                    DATE_FORMAT(datan, '%d/%m/%Y') AS datan_formatada
                    FROM solici_perdidos 
                    WHERE id_solici_perdido = ?";
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



        public function aprovar_solici($perdidoId)
        {
            // Primeiro, obtém os dados da solicitação
            $sql = "SELECT * FROM solici_perdidos WHERE id_solici_perdido = ?";
            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $perdidoId);
            $stm->execute();
            $dados = $stm->fetch(PDO::FETCH_OBJ);

            if ($dados)
            {
                // Criar um objeto $perdido com os dados obtidos
                $perdido = new Perdido();
                $perdido->setRga($dados->rga);
                $perdido->setChip($dados->chip);
                $perdido->setNome($dados->nome);
                $perdido->setDatan($dados->datan);
                $perdido->setSexo($dados->sexo);
                $perdido->setAlergias($dados->alergias);
                $perdido->setDoencas($dados->doencas);
                $perdido->setPeso($dados->peso);
                $perdido->setEspecie($dados->especie);
                $perdido->setRaca($dados->raca);
                $perdido->setPelagem($dados->pelagem);
                $perdido->setImagem($dados->imagem);
                $perdido->setDescr($dados->descritivo);
                $perdido->setLocal($dados->locald);
                $perdido->setData($dados->datad);
                $perdido->setHora($dados->horad);
                $perdido->setNomeTutor($dados->nome_tutor);
                // Verifica se sobrenome é nulo, se for, define uma string vazia ou um valor padrão
                $sobrenome = $dados->sobrenome ?? '';
                $perdido->setSobrenome($sobrenome);

                $perdido->setTelefone1($dados->telefone1);

                $telefone2 = $dados->telefone2 ?? '';
                $perdido->setTelefone2($telefone2);

                $perdido->setStatus($dados->status);

                // Usar o método inserir para mover os dados para a tabela 'perdidos'
                $this->inserir($perdido);

                // Remover o registro da tabela 'solici_perdidos'
                $sql = "DELETE FROM solici_perdidos WHERE id_solici_perdido = ?";
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $perdidoId);
                $stm->execute();
            }
        }

        // REMOVER SOLICITAÇÃO
        public function remover_solici($perdidoId)
        {
            $sql = "DELETE FROM solici_perdidos WHERE id_solici_perdido = ?";
            $stm = $this->db->prepare($sql);
            $stm->bindValue(1, $perdidoId);
            $stm->execute();
            $this->db = null;
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
    }