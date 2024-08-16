<?php
    namespace SistemaAnimais\Models;

    class Achado
    {
        public function __construct(
            private int $id_achado = 0,
            private string $especie = "",
            private string $raca = "",
            private string $pelagem = "",
            private string $sexo = "",
            private string $imagem = "",
            private string $localac = "",
            private string $dataac = "",
            private string $horaac = "",
            private string $descritivo = "",
            private string $nome_pessoa = "",
            private string $sobrenome = "",
            private string $telefone1 = "",
            private string $telefone2 = ""
            
        ){}

        /**
         * @return int
         */
        public function getId(): int
        {
            return $this->id_achado;
        }

        /**
         * @param int $id_achado
         */
        public function setId(int $id_achado): void
        {
            $this->id_achado = $id_achado;
        }

        /**
         * @return string
         */
        public function getEspecie(): string
        {
            return $this->especie;
        }

        /**
         * @param string $especie
         */
        public function setEspecie(string $especie): void
        {
            $this->especie = $especie;
        }

        /**
         * @return string
         */
        public function getRaca(): string
        {
            return $this->raca;
        }

        /**
         * @param string $raca
         */
        public function setRaca(string $raca): void
        {
            $this->raca = $raca;
        }

        /**
         * @return string
         */
        public function getPelagem(): string
        {
            return $this->pelagem;
        }

        /**
         * @param string $pelagem
         */
        public function setPelagem(string $pelagem): void
        {
            $this->pelagem = $pelagem;
        }

        /**
         * @return string
         */
        public function getSexo(): string
        {
            return $this->sexo;
        }

        /**
         * @param string $sexo
         */
        public function setSexo(string $sexo): void
        {
            $this->sexo = $sexo;
        }

        /**
         * @return string
         */
        public function getImagem(): string
        {
            return $this->imagem;
        }

        /**
         * @param string $imagem
         */
        public function setImagem(string $imagem): void
        {
            $this->imagem = $imagem;
        }

        /**
         * @return string
         */
        public function getLocal(): string
        {
            return $this->localac;
        }

        /**
         * @param string $localac
         */
        public function setLocal(string $localac): void
        {
            $this->localac = $localac;
        }

        /**
         * @return string
         */
        public function getData(): string
        {
            return $this->dataac;
        }

        /**
         * @param string $dataac
         */
        public function setData(string $dataac): void
        {
            $this->dataac = $dataac;
        }

        /**
         * @return string
         */
        public function getHora(): string
        {
            return $this->horaac;
        }

        /**
         * @param string $horaac
         */
        public function setHora(string $horaac): void
        {
            $this->horaac = $horaac;
        }

        /**
         * @return string
         */
        public function getDescr(): string
        {
            return $this->descritivo;
        }

        /**
         * @param string $descritivo
         */
        public function setDescr(string $descritivo): void
        {
            $this->descritivo = $descritivo;
        }

        /**
         * @return string
         */
        public function getNome(): string
        {
            return $this->nome_pessoa;
        }

        /**
         * @param string $nome_pessoa
         */
        public function setNomePessoa(string $nome_pessoa): void
        {
            $this->nome_pessoa = $nome_pessoa;
        }

        /**
         * @return string
         */
        public function getSobrenome(): string
        {
            return $this->sobrenome;
        }

        /**
         * @param string $sobrenome
         */
        public function setSobrenome(string $sobrenome): void
        {
            $this->sobrenome = $sobrenome;
        }

        /**
         * @return string
         */
        public function getTelefone1(): string
        {
            return $this->telefone1;
        }

        /**
         * @param string $telefone1
         */
        public function setTelefone1(string $telefone1): void
        {
            $this->telefone1 = $telefone1;
        }

        /**
         * @return string
         */
        public function getTelefone2(): string
        {
            return $this->telefone2;
        }

        /**
         * @param string $telefone2
         */
        public function setTelefone2(string $telefone2): void
        {
            $this->telefone2 = $telefone2;
        }
    }