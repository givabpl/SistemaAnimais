<?php
    require_once ROOT_PATH . '/views/cabecalho.php';
    $total_paginas = ceil($total_registros / $limite);
?>

<div class="content p-4" id="listar-tutores">
    <div class="container-fluid">
        <?php
            if(isset($_GET["msg"]))
            {
                echo "<div class='alert alert-success' role='alert'>{$_GET['msg']}</div>";
            }
        ?>
        
        <div>
            <h1 class="row justify-content-center">Tutores</h1><br>

            <!-- BOTÕES -->
            <div class="d-flex flex-wrap">
                <div class="p-2 g-6"">
                    <i class="bi bi-arrow-down-up"></i>
                    Ordenar por
                </div>
                <div class="p-2 g-6"">
                    <a class="btn btn-outline-secondary" href="index.php?controle=tutorController&metodo=listar">
                        _/_/_ 
                        Cadastro
                    </a>
                </div>
                <div class="p-2 g-6"">
                    <a class="btn btn-outline-secondary" href="index.php?controle=tutorController&metodo=listar_alf">
                        A - B
                    </a>
                </div>
                <div class="p-2 g-6"">
                    <div>
                        <a class="btn btn-primary" href="index.php?controle=tutorController&metodo=inserir">Cadastrar um tutor</a>&nbsp;
                    </div>
                </div>
            </div>

            <!-- FORMULÁRIO DE BUSCA -->
            <form method="get" action="">

                <input type="hidden" name="controle" value="tutorController">
                <input type="hidden" name="metodo" value="listar">

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
                                placeholder="Buscar por nome, RG, CPF ou endereço"
                                value="<?= isset($_GET['busca']) ? $_GET['busca'] : '' ?>">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search"></i>
                            Buscar
                        </button>
                    </div>
                </div>
            </form>
            <br>

            <table class="table table-hover table-striped table-striped-color col-24-outline">
                <tr>
                    <th>Nome</th>
                    <th>RG</th>
                    <th>CPF</th>
                    <th>Endereço</th>
                    <th>Contato</th>
                    <th>Ações</th>
                </tr>
                <?php if (is_array($retorno) || is_object($retorno)): ?>
                    <?php foreach($retorno as $dado): ?> 

                        <tr>
                            <td><?= $dado->nome ?>&nbsp;<?= $dado->sobrenome ?></td>
                            <td><?= $dado->rg ?></td>
                            <td><?= $dado->cpf ?></td>
                            <td>
                                Cep: <?= $dado->cep ?> <br>
                                Logradouro: <?= $dado->logradouro ?>, n°: <?= $dado->numero ?> <br>
                                Bairro: <?= $dado->bairro ?>
                            </td>
                            <td>
                                Tel1: <?= $dado->telefone1 ?> <br>
                                Tel2: <?= $dado->telefone2 ?>
                            </td>
                            <td>
                                <a class="btn btn-outline-primary" href="index.php?controle=tutorController&metodo=listar_animais&id=<?= $dado->id_tutor ?>">
                                <i class="bi bi-eye"></i> Animais
                                </a>

                                <?php if(isset($_SESSION["tipo"]) && $_SESSION["tipo"] == "Administrador"): ?>
                                    &nbsp;
                                    <a class="btn btn-outline-warning" href="index.php?controle=tutorController&metodo=editar&id=<?= $dado->id_tutor ?>">
                                        <i class="bi bi-pencil-square"></i> Editar
                                    </a>
                                        &nbsp;
                                    <a class="btn btn-outline-danger" href="index.php?controle=tutorController&metodo=excluir&id=<?= $dado->id_tutor ?>">
                                        <i class="bi bi-x-square"></i> Excluir
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan='4'>Nenhum tutor encontrado.</td></tr>
                <?php endif; ?>
            </table>

        </div>

        <br>

        <!-- Paginação -->
        <nav aria-label="Navegação de página">
            <ul class="pagination justify-content-center">
                <?php if ($pagina_atual > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="index.php?controle=tutorController&metodo=listar&pagina=<?= $pagina_atual - 1 ?>" aria-label="Anterior">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                    <li class="page-item <?= $i == $pagina_atual ? 'active' : '' ?>">
                        <a class="page-link" href="index.php?controle=tutorController&metodo=listar&pagina=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($pagina_atual < $total_paginas): ?>
                    <li class="page-item">
                        <a class="page-link" href="index.php?controle=tutorController&metodo=listar&pagina=<?= $pagina_atual + 1 ?>" aria-label="Próximo">
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
        window.location.href = 'index.php?controle=tutorController&metodo=listar';
    });

</script>

<?php require_once ROOT_PATH . '/views/rodape.html'; ?>
