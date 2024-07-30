<?php
    namespace SistemaAnimais\Models;

    class Tutor
    {
        public function __construct(
            private int $id_tutor = 0,
            private string $nome = "",
            private string $sobrenome = "",
            private string $rg = "",
            private string $cpf = "",
            private string $cep = "",
            private string $logradouro = "",
            private string $numero = "",
            private string $bairro = "",
            private string $telefone1 = "",
            private string $telefone2 = ""
        ){}

        public function getId()
        {
            return $this->id_tutor;
        }
        public function setId($id_tutor)
        {
            $this->id_tutor = $id_tutor;
        }

        public function getNome()
        {
            return $this->nome;
        }

        public function getSobrenome()
        {
            return $this->sobrenome;
        }

        public function getRg()
        {
            return $this->rg;
        }

        public function getCpf()
        {
            return $this->cpf;
        }

        public function getCep()
        {
            return $this->cep;
        }

        public function getLogradouro()
        {
            return $this->logradouro;
        }

        public function getNumero()
        {
            return $this->numero;
        }
        
        public function getBairro()
        {
            return $this->bairro;
        }

        public function getTel1()
        {
            return $this->telefone1;
        }

        public function getTel2()
        {
            return $this->telefone2;
        }
    }