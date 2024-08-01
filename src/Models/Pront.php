<?php
    namespace SistemaAnimais\Models;

    class Pront
    {
        public function __construct(
            private int $id_pront = 0,
            private string $titulo = "",
            private string $dataa = "",
            private string $locala = "",
            private string $descritivo = "",
            private string $medicacao = "",
            private string $medicacao_info = "",
            private string $internacao = "",
            private string $internacao_info = "",
            private string $receita = "",
            private string $arquivo = "",
            private string $peso = "",
            private $animal = null,
            private $vet = null
            
        ){}

        public function getId()
        {
            return $this->id_pront;
        }

        public function getTitulo()
        {
            return $this->titulo;
        }

        public function getData()
        {
            return $this->dataa;
        }

        public function getLocal()
        {
            return $this->locala;
        }

        public function getDescr()
        {
            return $this->descritivo;
        }

        public function getMed()
        {
            return $this->medicacao;
        }

        public function getMedInfo()
        {
            return $this->medicacao_info;
        }

        public function getInter()
        {
            return $this->internacao;
        }

        public function getIntInfo()
        {
            return $this->internacao_info;
        }

        public function getReceita()
        {
            return $this->receita;
        }

        public function getArquivo()
        {
            return $this->arquivo; // Decodifica a string JSON para um array
        }

        public function getPeso()
        {
            return $this->peso;
        }

        public function getAnimal()
        {
            return $this->animal;
        }
        
        public function getVet()
        {
            return $this->vet;
        }
    }