<?php
    namespace SistemaAnimais\Models;
    
    class Animal
    {
        public function __construct(
            private int $id_animal = 0,
            private string $rga = "",
            private string $chip = "",
            private string $nome = "",
            private string $datan = "",
            private string $sexo = "",
            private string $alergias = "",
            private string $doencas = "",
            private string $cirurgias = "",
            private string $peso = "",
            private string $especie = "",
            private string $raca = "",
            private string $pelagem = "",
            private string $aquisicao = "",
            private $tutor = null
            
        ){}

        public function getId()
        {
            return $this->id_animal;
        }
        public function setId($id_animal)
        {
            $this->id_animal = $id_animal;
        }

        public function getRga()
        {
            return $this->rga;
        }

        public function getChip()
        {
            return $this->chip;
        }

        public function getNome()
        {
            return $this->nome;
        }

        public function getDatan()
        {
            return $this->datan;
        }

        public function getSexo()
        {
            return $this->sexo;
        }

        public function getAlergias()
        {
            return $this->alergias;
        }

        public function getDoencas()
        {
            return $this->doencas;
        }

        public function getCirurgias()
        {
            return $this->cirurgias;
        }

        public function getPeso()
        {
            return $this->peso;
        }

        public function getEspecie()
        {
            return $this->especie;
        }

        public function getRaca()
        {
            return $this->raca;
        }

        public function getPelagem()
        {
            return $this->pelagem;
        }

        public function getAquisicao()
        {
            return $this->aquisicao;
        }

        public function getTutor()
        {
            return $this->tutor;
        }

    }