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
            private string $telefone2 = ""
            
        ){}

        /**
         * @return int
         */
        public function getId(): int
        {
            return $this->id_perdido;
        }

        /**
         * @param int $id_perdido
         */
        public function setId(int $id_perdido): void
        {
            $this->id_perdido = $id_perdido;
        }

        /**
         * @return string
         */
        public function getRga(): string
        {
            return $this->rga;
        }

        /**
         * @param string $rga
         */
        public function setRga(string $rga): void
        {
            $this->rga = $rga;
        }

        /**
         * @return string
         */
        public function getChip(): string
        {
            return $this->chip;
        }

        /**
         * @param string $chip
         */
        public function setChip(string $chip): void
        {
            $this->chip = $chip;
        }

        /**
         * @return string
         */
        public function getNome(): string
        {
            return $this->nome;
        }

        /**
         * @param string $nome
         */
        public function setNome(string $nome): void
        {
            $this->nome = $nome;
        }

        /**
         * @return string
         */
        public function getDatan(): string
        {
            return $this->datan;
        }

        /**
         * @param string $datan
         */
        public function setDatan(string $datan): void
        {
            $this->datan = $datan;
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
        public function getAlergias(): string
        {
            return $this->alergias;
        }

        /**
         * @param string $alergias
         */
        public function setAlergias(string $alergias): void
        {
            $this->alergias = $alergias;
        }

        /**
         * @return string
         */
        public function getDoencas(): string
        {
            return $this->doencas;
        }

        /**
         * @param string $doencas
         */
        public function setDoencas(string $doencas): void
        {
            $this->doencas = $doencas;
        }

        /**
         * @return string
         */
        public function getPeso(): string
        {
            return $this->peso;
        }

        /**
         * @param string $peso
         */
        public function setPeso(string $peso): void
        {
            $this->peso = $peso;
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
        public function getLocal(): string
        {
            return $this->locald;
        }

        /**
         * @param string $locald
         */
        public function setLocal(string $locald): void
        {
            $this->locald = $locald;
        }

        /**
         * @return string
         */
        public function getData(): string
        {
            return $this->datad;
        }

        /**
         * @param string $datad
         */
        public function setData(string $datad): void
        {
            $this->datad = $datad;
        }

        /**
         * @return string
         */
        public function getHora(): string
        {
            return $this->horad;
        }

        /**
         * @param string $horad
         */
        public function setHora(string $horad): void
        {
            $this->horad = $horad;
        }

        /**
         * @return string
         */
        public function getNomeTutor(): string
        {
            return $this->nome_tutor;
        }

        /**
         * @param string $nome_tutor
         */
        public function setNomeTutor(string $nome_tutor): void
        {
            $this->nome_tutor = $nome_tutor;
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