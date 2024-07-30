<?php require_once ROOT_PATH . '/views/cabecalho.php'; ?>

<div class="content" id="listar-vets">
    <div class="container">
        <div>
            <h1 class="row justify-content-center align-items-center">Veterinários</h1><br>
            <table class="table table-hover table-striped table-striped-color col-24-outline">
                <tr>
                    <th>Crmv</th>
                    <th>Nome</th>
                    <th>email</th>
                    <th>Ações</th>
                </tr>
                <?php if (is_array($retorno) || is_object($retorno)): ?>
                    <?php foreach($retorno as $dado): ?> 

                        <tr>
                            <td><?= $dado->crmv ?></td>
                            <td><?= $dado->nome ?></td>
                            <td><?= $dado->email ?></td>

                            <td>
                                <a class="btn btn-outline-primary" href="index.php?controle=prontController&metodo=listar_pronts_vet&id=<?= $dado->id_vet ?>">
                                    <i class="bi bi-clipboard-pulse"></i> Prontuários
                                </a>
                            </td>
                        </tr>


                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan='4'>Nenhum veterinario encontrado.</td></tr>
                <?php endif; ?>
            </table>
        </div>
    
    </div>
</div>

<?php require_once ROOT_PATH . '/views/rodape.html'; ?>
