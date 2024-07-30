<?php
    namespace SistemaAnimais\Models;

    class Achado
    {
        public function __construct(
            private int $id_achado = 0,
            private $animal = null,
            private string $imagem = "",
            private string $localac = "",
            private string $dataac = "",
            private string $horaac = "",
            private string $descritivo = "",
            private string $nome_pessoa = "",
            private string $sobrenome = "",
            private string $telefone1 = "",
            private string $telefone2 = "",
            private string $statusac = ""
            
        ){}

        /**
         * @return int
         */
        public function getId(): int
        {
            return $this->id_achado;
        }

        /**
         * @return null
         */
        public function getAnimal()
        {
            return $this->animal;
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
        public function getDescr(): string
        {
            return $this->descritivo;
        }

        /**
         * @return string
         */
        public function getNome(): string
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
            return $this->statusac;
        }

    }