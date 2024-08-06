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
            <h1 class="row justify-content-center align-items-center">Prontuários</h1><br>

            <!-- BOTÕES -->
            <div class="d-flex flex-wrap">
                <div class="p-2 g-6">
                    <i class="bi bi-arrow-down-up"></i>
                    Ordenar por
                </div>
                <div class="p-2 g-6"">
                    <a class="btn btn-outline-secondary" href="index.php?controle=prontController&metodo=listar">
                        _/_/_
                        Data
                    </a>
                </div>

                <div class="p-2 g-6"">
                    <a class="btn btn-outline-secondary" href="index.php?controle=prontController&metodo=listar_local">
                        <i class="bi bi-geo-alt"></i>
                        Local
                    </a>
                </div>

                <div class="p-2 g-6"">
                    <a class="btn btn-outline-secondary" href="index.php?controle=prontController&metodo=listar_tutor">
                        <i class="bi bi-person-square"></i>
                        Tutor
                    </a>
                </div>

                <div class="p-2 g-6"">
                    <a class="btn btn-outline-secondary" href="index.php?controle=prontController&metodo=listar_vet">
                        <i class="bi bi-activity"></i>
                        Veterinário
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10">
                    <!-- FORMULÁRIO DE BUSCA -->
                    <form method="get" action="">

                        <input type="hidden" name="controle" value="prontController">
                        <input type="hidden" name="metodo" value="listar">

                        <div class="mb-3 row">
                            <div class="input-group col-md-8 col-sm-12">
                                <!-- BOTÃO LIMPAR BUSCA -->
                                <button class="btn btn-outline-secondary" type="button" id="clear-search-button">
                                    <i class="bi bi-x-square"></i>
                                </button>
                                <input
                                        type="text"
                                        class="form-control"
                                        name="busca"
                                        placeholder="Buscar por título, data, animal, tutor, veterinário ou local"
                                        value="<?= isset($_GET['busca']) ? $_GET['busca'] : '' ?>">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-search"></i>
                                    Buscar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-2">
                    <a href="index.php?controle=prontController&metodo=estatisticas" class="btn btn-outline-primary">
                        <i class="bi bi-bar-chart-line"></i>Estatísticas
                    </a>
                </div>
            </div>


            <br>
        
            <div class="">
                    
                <table class="table table-hover table-striped table-striped-color w-100">
                    <tr>
                        <th>Data</th>
                        <th>Local</th>
                        <th>Paciente</th>
                        <th>Tutor</th>
                        <th>Veterinário</th>
                        <th>Ações</th>
                    </tr>
                    <?php if (is_array($retorno) || is_object($retorno)): ?>
                        <?php foreach($retorno as $dado): ?>
                            <tr>
                                <td>
                                    <?= $dado->data_formatada ?>
                                </td>
                                <td><?= $dado->locala ?></td>
                                <td><?= $dado->nome_animal ?></td>
                                <td><?= $dado->nome_tutor ?>&nbsp;<?= $dado->sobrenome ?></td>
                                <td><?= $dado->nome_vet ?></td>
                                <td>
                                    <div class="d-flex flex-wrap">
                                        <div class="p-2">
                                            <a class="btn btn-outline-primary" href="index.php?controle=prontController&metodo=abrir&id=<?= $dado->id_pront ?>">
                                                <i class="bi bi-eye"></i> Visualizar
                                            </a>
                                        </div>

                                        <?php if(isset($_SESSION["tipo"]) && $_SESSION["tipo"] == "Administrador"): ?>
                                            &nbsp;
                                            <div class="p-2">
                                                <a class="btn btn-outline-danger" href="index.php?controle=prontController&metodo=excluir&id=<?= $dado->id_pront ?>&return_url=<?= urlencode($_SERVER['REQUEST_URI']) ?>">
                                                    <i class="bi bi-x-square"></i> Excluir
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan='4'>Nenhum prontuário encontrado.</td></tr>
                    <?php endif; ?>
                </table>
            </div>
        <br>
        <!-- Paginação -->
        <nav aria-label="Navegação de página">
            <ul class="pagination justify-content-center">
                <?php if ($pagina_atual > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="index.php?controle=prontController&metodo=listar&pagina=<?= $pagina_atual - 1 ?>" aria-label="Anterior">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                    <li class="page-item <?= $i == $pagina_atual ? 'active' : '' ?>">
                        <a class="page-link" href="index.php?controle=prontController&metodo=listar&pagina=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($pagina_atual < $total_paginas): ?>
                    <li class="page-item">
                        <a class="page-link" href="index.php?controle=prontController&metodo=listar&pagina=<?= $pagina_atual + 1 ?>" aria-label="Próximo">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    
    </div>
</div>

<script>
    document.getElementById('clear-search-button').addEventListener('click', function() {
        window.location.href = 'index.php?controle=prontController&metodo=listar';
    });
</script>

<?php require_once ROOT_PATH . '/views/rodape.html'; ?>