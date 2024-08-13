<?php
    namespace SistemaAnimais\Models;

    class Perdido
    {
        public function __construct(
            private int $id_perdido = 0,
            private string $rga = "",
            private string $chip = "",
            private string $nome = "",
            private string $datan = "",
            private string $sexo = "",
            private string $alergias = "",
            private string $doencas = "",
            private string $peso = "",
            private string $especie = "",
            private string $raca = "",
            private string $pelagem = "",
            private string $imagem = "",
            private string $descritivo = "",
            private string $locald = "",
            private string $datad = "",
            private string $horad = "",
            private string $nome_tutor = "",
            private string $sobrenome = "",
            private string $telefone1 = "",
            private string $telefone2 = "",
            private string $status = ""
            
        ){}

        /**
         * @return int
         */
        public function getIdPerdido(): int
        {
            return $this->id_perdido;
        }

        /**
         * @return string
         */
        public function getRga(): string
        {
            return $this->rga;
        }

        /**
         * @return string
         */
        public function getChip(): string
        {
            return $this->chip;
        }

        /**
         * @return string
         */
        public function getNome(): string
        {
            return $this->nome;
        }

        /**
         * @return string
         */
        public function getDatan(): string
        {
            return $this->datan;
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
        public function getAlergias(): string
        {
            return $this->alergias;
        }

        /**
         * @return string
         */
        public function getDoencas(): string
        {
            return $this->doencas;
        }

        /**
         * @return string
         */
        public function getPeso(): string
        {
            return $this->peso;
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
        public function getImagem(): string
        {
            return $this->imagem;
        }

        /**
         * @return string
         */
        public function getLocald(): string
        {
            return $this->locald;
        }

        /**
         * @return string
         */
        public function getDatad(): string
        {
            return $this->datad;
        }

        /**
         * @return string
         */
        public function getHorad(): string
        {
            return $this->horad;
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
        public function getNomeTutor(): string
        {
            return $this->nome_tutor;
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