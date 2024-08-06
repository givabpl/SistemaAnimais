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
        
        <div>
            <h1 class="row justify-content-center">Animais Desaparecidos</h1><br>
            <!-- MENU DE ORDEM -->
            <div class="d-flex flex-wrap justify-content-center">
                <div class="p-2 g-6">
                    <i class="bi bi-arrow-down-up"></i>
                    Ordenar por
                </div>
                <div class="p-2 g-6">
                    <a class="btn btn-outline-secondary" href="index.php?controle=perdidoController&metodo=listar">
                        _/_/_ 
                        Data
                    </a>
                </div>

                <div class="p-2 g-6">
                    <a class="btn btn-outline-secondary" href="index.php?controle=perdidoController&metodo=listar_alf">
                        A - B
                    </a>
                </div>

                <div class="p-2">
                    <a class="btn btn-outline-secondary" href="index.php?controle=perdidoController&metodo=listar_tutor">
                        <i class="bi bi-person-square"></i>
                        Tutor
                    </a>
                </div>
            </div>
            
            <!-- BOTÃO REGISTRAR -->
            <div class="mb-3 row justify-content-end">
                <div class="col-md-4 d-flex">
                    <div class="">
                        <a class="btn btn-primary" href="index.php?controle=perdidoController&metodo=inserir">Registrar desaparecimento</a>&nbsp;&nbsp;
                    </div>
                </div>
            </div>

            <div class="row justify-content-evenly justify-content-sm-center justify-content-sm-center">
                <?php if (is_array($retorno) || is_object($retorno)): ?>
                    <?php foreach($retorno as $dado): ?>
                         
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                            <div class="card" style="height: 550px;">
                                <img src="<?= $dado->imagem ?>" class="card-img-top img-fluid" alt="<?= $dado->nome_animal ?>" style="height: 250px; width: 100%; object-fit: cover; object-position: center;">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $dado->nome_animal ?></h5>
                                    <p class="card-text">
                                    <i class="bi bi-gender-ambiguous"></i>&nbsp;<?= $dado->sexo ?>&nbsp; | &nbsp;<?= $dado->raca ?> <br>
                                    Pelagem: <?= $dado->pelagem ?> <br>
                                    </p>
                                    <p class="card-text">
                                        Tutor:
                                        <?= $dado->nome_tutor ?><br>

                                        <?= $dado->telefone1 ?> <br>
                                        <?= $dado->telefone2 ?> <br>

                                        <a href="index.php?controle=perdidoController&metodo=buscar_perdido&id=<?= $dado->id_perdido ?>" class="btn btn-outline-primary">Mais informações</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a href="index.php?controle=perdidoController&metodo=gerar_pdf&id=<?= $dado->id_perdido ?>" class="btn btn-outline-danger" target="_blank"><i class="bi bi-file-earmark-pdf"></i>PDF</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                    <?php endforeach; ?>
                <?php else: ?>
                            <tr><td colspan='4'>Nenhum animal encontrado.</td></tr>
                <?php endif; ?>
            </div>
        </div>
        <br>
        <!-- Paginação -->
        <nav aria-label="Navegação de página">
            <ul class="pagination justify-content-center">
                <?php if ($pagina_atual > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="index.php?controle=perdidoController&metodo=listar&pagina=<?= $pagina_atual - 1 ?>" aria-label="Anterior">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                    <li class="page-item <?= $i == $pagina_atual ? 'active' : '' ?>">
                        <a class="page-link" href="index.php?controle=perdidoController&metodo=listar&pagina=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($pagina_atual < $total_paginas): ?>
                    <li class="page-item">
                        <a class="page-link" href="index.php?controle=perdidoController&metodo=listar&pagina=<?= $pagina_atual + 1 ?>" aria-label="Próximo">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</div>

<?php require_once ROOT_PATH . '/views/rodape.html'; ?>
