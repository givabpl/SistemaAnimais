<?php

class buscaController
{
    public function buscar()
    {
        $query = $_GET['query'];

        $animalDAO = new animalDAO();
        $tutorDAO = new tutorDAO();
        $vetDAO = new vetDAO();
        $prontDAO = new prontDAO();

        $animais = $animalDAO->buscar_por_nome($query);
        $tutores = $tutorDAO->buscar_por_nome($query);
        $vets = $vetDAO->buscar_por_nome($query);
        $pronts = $prontDAO->buscar_por_titulo($query);

        require_once "Views/cabecalho.php";
    }
}
