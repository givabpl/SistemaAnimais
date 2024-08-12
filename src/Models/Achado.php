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
            private string $telefone2 = "",
            private string $status = ""
            
        ){}

        /**
         * @return int
         */
        public function getIdAchado(): int
        {
            return $this->id_achado;
        }

        /**
         * @return string
         */
        public function getEspecie(): string
        {
            return $this->especie;
        }

        /**
         * @return string
         */
        public function getRaca(): string
        {
            return $this->raca;
        }

        /**
         * @return string
         */
        public function getPelagem(): string
        {
            return $this->pelagem;
        }

        /**
         * @return string
         */
        public function getSexo(): string
        {
            return $this->sexo;
        }

        /**
         * @return string
         */
        public function getImagem(): string
        {
            return $this->imagem;
        }

        /**
         * @return string
         */
        public function getLocalac(): string
        {
            return $this->localac;
        }

        /**
         * @return string
         */
        public function getDataac(): string
        {
            return $this->dataac;
        }

        /**
         * @return string
         */
        public function getHoraac(): string
        {
            return $this->horaac;
        }

        /**
         * @return string
         */
        public function getDescritivo(): string
        {
            return $this->descritivo;
        }

        /**
         * @return string
         */
        public function getNomePessoa(): string
        {
            return $this->nome_pessoa;
        }

        /**
         * @return string
         */
        public function getSobrenome(): string
        {
            return $this->sobrenome;
        }

        /**
         * @return string
         */
        public function getTelefone1(): string
        {
            return $this->telefone1;
        }

        /**
         * @return string
         */
        public function getTelefone2(): string
        {
            return $this->telefone2;
        }

        /**
         * @return string
         */
        public function getStatus(): string
        {
            return $this->status;
        }


    }