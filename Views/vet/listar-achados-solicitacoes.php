<?php
require_once ROOT_PATH . '/views/cabecalho.php';
$total_paginas = ceil($total_registros / $limite);
?>

<div class="content" id="listar-animais">
    <div class="container">

        <?php
        if(isset($_GET["msg"]))
        {
            echo "<div class='alert alert-success' role='alert'>{$_GET['msg']}</div>";
        }
        ?>
        <!-- TITULO -->
        <h1 class="h2 row justify-content-center">Solicitações: Animais Encontrados</h1><br>

        <!-- BOTOES -->
        <div class="d-flex flex-wrap justify-content-center">
            <div class="p-2 g-6"">
                <a class="btn btn-danger" href="index.php?controle=perdidoController&metodo=inserir">Registrar animal desaparecido</a>&nbsp;&nbsp;
            </div>
            <div class="p-2 g-6"">
                <a class="btn btn-primary" href="index.php?controle=achadoController&metodo=inserir">Registrar animal encontrado</a>&nbsp;&nbsp;
            </div>
            <div class="p-2 g-6"">
                <a class="btn btn-outline-primary" href="index.php?controle=perdidoController&metodo=listar">Ver animais desaparecidos</a>&nbsp;&nbsp;
            </div>
        </div>
        <br>
        <div class="row justify-content-evenly justify-content-sm-center justify-content-sm-center">
            <?php if (is_array($retorno) || is_object($retorno)): ?>
                <?php foreach($retorno as $dado): ?>
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <div class="card">
                            <!-- IMAGEM -->
                            <img src="<?= $dado->imagem ?>" class="card-img-top" style="height: 250px; width: 100%; object-fit: cover; object-position: center;" alt="<?= $dado->especie ?> <?= $dado->raca ?>">

                            <!-- TITULO -->
                            <!-- TIPO -->
                            <!-- PELAGEM | SEXO | RACA -->
                            <!-- RESPONSAVEL: NOME | SOBRENOME | CONTATO -->
                            <!-- CONTATO -->
                            <!-- BOTOES -->
                            <div class="card-body">
                                <!-- ESPECIE -->
                                <h5 class="card-title"><?= $dado->especie ?></h5>
                                <!-- PELAGEM | SEXO | RACA -->
                                <p class="card-text">
                                    Pelagem: <?= $dado->pelagem ?> <br>
                                    <i class="bi bi-gender-ambiguous"></i>&nbsp;<?= $dado->sexo ?>&nbsp; | <?= $dado->raca ?>
                                </p>

                                <!-- NOME | SOBRENOME | CONTATO | BOTOES -->
                                <p class="card-text">
                                    Responsável:
                                    <?= $dado->nome_pessoa ?>&nbsp;<?= $dado->sobrenome ?><br>

                                    <?= $dado->telefone1 ?> <br>
                                    <?= $dado->telefone2 ?> <br>

                                    <div class="d-flex flex-wrap">
                                        <div class="m-2 g-2">
                                            <a href="index.php?controle=achadoController&metodo=buscar_solici&id=<?= $dado->id_solici_achado ?>" class="mb-2 btn btn-outline-primary"><i class="bi bi-plus-square"></i> Informações</a>
                                        </div>
                                        <div class="m-2 g-2">
                                            <a href="index.php?controle=achadoController&metodo=aprovar&id=<?= $dado->id_solici_achado ?>" class="btn btn-outline-success"><i class="bi bi-check-square"></i> Aprovar</a>
                                        </div>
                                        <div class="m-2 g-2">
                                            <a href="index.php?controle=achadoController&metodo=remover_solici&id=<?= $dado->id_solici_achado ?>" class="mb-2 btn btn-danger"><i class="bi bi-x-square"></i> Excluir</a>
                                        </div>
                                    </div>

                                </p>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan='4'>Nenhum animal encontrado.</td></tr>
            <?php endif; ?>
        </div>
        <br>
        <!-- Paginação -->
        <nav aria-label="Navegação de página">
            <ul class="pagination justify-content-center">
                <?php if ($pagina_atual > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="index.php?controle=achadoController&metodo=_solici&pagina=<?= $pagina_atual - 1 ?>" aria-label="Anterior">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                    <li class="page-item <?= $i == $pagina_atual ? 'active' : '' ?>">
                        <a class="page-link" href="index.php?controle=achadoController&metodo=listar_solici&pagina=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($pagina_atual < $total_paginas): ?>
                    <li class="page-item">
                        <a class="page-link" href="index.php?controle=achadoController&metodo=listar_solici&pagina=<?= $pagina_atual + 1 ?>" aria-label="Próximo">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</div>

<?php require_once ROOT_PATH . '/views/rodape.html'; ?>
