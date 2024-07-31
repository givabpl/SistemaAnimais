<?php

use SistemaAnimais\DAOs\tutorDAO;
use SistemaAnimais\DAOs\vetDAO;
use SistemaAnimais\DAOs\animalDAO;
use SistemaAnimais\DAOs\prontDAO;

class buscaController
{
    public function buscar_animais()
    {
        $pesquisa = $mysqli->real_scape_string($_GET['busca']);
        $entidade = $_GET['entidade_busca'];
        $tipo = $_GET['tipo_busca'];
        $redirect = $_GET['redirect'];

        $animalDAO = new animalDAO();
        $animalDAO->pesquisa_todos($pesquisa);


        /*if($entidade === 'animal')
        {
            $animalDAO = new animalDAO();
            if ($tipo === 'nome')
            {
                $resultados = $animalDAO->buscar_por_nome($query);
            } elseif ($tipo === 'rga')
            {
                $resultados = $animalDAO->buscar_por_rga($query);
            } elseif ($tipo === 'chip')
            {
                $resultados = $animalDAO->buscar_por_chip($query);
            } else {
                $resultados = [];
            }
        } elseif ($entidade === 'tutor')
        {
            $tutorDAO = new tutorDAO();
            if ($tipo === 'nome')
            {
                $resultados = $tutorDAO->buscar_por_nome($query);
            } else {
                $resultados = [];
            }
        } elseif ($entidade === 'vet')
        {
            $vetDAO = new vetDAO();
            if ($tipo === 'nome')
            {
                $resultados = $vetDAO->buscar_por_nome($query);
            } elseif ($tipo === 'crmv')
            {
                $resultados = $vetDAO->buscar_por_crmv($query);
            } else {
                $resultados = [];
            }
        } else {
            // Se for "todos" ou outra entidade não reconhecida, buscar em todas as entidades
            $animalDAO = new animalDAO();
            $tutorDAO = new tutorDAO();
            $vetDAO = new vetDAO();
            $prontDAO = new prontDAO();

            $resultados = array_merge(
                $animalDAO->buscar_por_nome($query),
                $tutorDAO->buscar_por_nome($query),
                $vetDAO->buscar_por_nome($query),
                $prontDAO->buscar_por_titulo($query)
            );
        }
        require_once "Views/cabecalho.php";*/
    }
}
