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
            <br>
            <div>
                <div class="mb-3 row">
                    <div class="col-md-8">
                        <h3>
                            <?= $dados_vet->nome ?>
                        </h3>
                    </div>

                    <div class="col-md-4 d-flex justify-content-end">
                        <div>
                            <a href="index.php?controle=prontController&metodo=criar&id=<?= $_GET['id'] ?>" class="btn btn-primary"><i class="bi bi-clipboard2-plus"></i> Novo prontuário</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FORMULÁRIO DE BUSCA -->
            <form method="get" action="">

                <input type="hidden" name="controle" value="prontController">
                <input type="hidden" name="metodo" value="listar_pronts_vet">
                <input type="hidden" name="id" value="<?= $_GET['id'] ?>">

                <div class="mb-3 row">
                    <div class="input-group col-md-6 col-sm-12">
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
            <br>

            <table class="table table-hover table-striped table-striped-color col-24">
                <tr>
                    <th>Título</th>
                    <th>Data de<br>atendimento</th>
                    <th>Local de<br>atendimento</th>
                    <th>Paciente</th>
                    <th>Ações</th>
                </tr>
                <?php if(!empty($retorno[0]->titulo)): ?>
                    <?php if (is_array($retorno) || is_object($retorno)): ?>
                        <?php foreach($retorno as $dado): ?> 

                            <tr>
                                <td><?= $dado->titulo ?></td>
                                <td>
                                    <?= $dado->data_formatada ?>
                                </td>
                                <td><?= $dado->locala ?></td>
                                <td><?= $dado->nome_animal ?></td>
                                
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
                    <?php endif; ?>
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
        window.location.href = 'index.php?controle=prontController&metodo=listar_pronts_vet&id=<?= $retorno[0]->id_vet ?>';
    });
</script>

<?php require_once ROOT_PATH . '/views/rodape.html'; ?>