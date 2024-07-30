<?php
    namespace SistemaAnimais\Models;

    class Perdido
    {
        public function __construct(
            private int $id_perdido = 0,
            private $animal = null,
            private string $imagem = "",
            private string $locald = "",
            private string $datad = "",
            private string $horad = "",
            private string $descritivo = "",
            private $tutor = null,
            private string $status = ""
            
        ){}

        public function getId()
        {
            return $this->id_perdido;
        }

        public function getAnimal()
        {
            return $this->animal;
        }

        public function getImagem()
        {
            return $this->imagem;
        }

        public function getLocal()
        {
            return $this->locald;
        }

        public function getData()
        {
            return $this->datad;
        }

        public function getHora()
        {
            return $this->horad;
        }

        public function getDescr()
        {
            return $this->descritivo;
        }

        
        public function getTutor()
        {
            return $this->tutor;
        }

        public function getStatus()
        {
            return $this->status;
        }

    }