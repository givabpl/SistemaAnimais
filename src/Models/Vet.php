<?php
    namespace SistemaAnimais\Models;

    class Vet 
    {
        public function __construct(
            private int $id_vet = 0,
            private string $nome = "",
            private string $crmv = "",
            private string $tipo = "",
            private string $email = "",
            private string $senha = ""
        ){}

        public function getId()
        {
            return $this->id_vet;
        }

        public function getCrmv()
        {
            return $this->crmv;
        }

        public function getTipo()
        {
            return $this->tipo;
        }

        public function getNome()
        {
            return $this->nome;
        }

        public function getEmail()
        {
            return $this->email;
        }

        public function getSenha()
        {
            return $this->senha;
        }
    }