<?php require_once ROOT_PATH . '/views/cabecalho.php'; ?>

<div class="content" id="listar-animais">
    <div class="container">
        <div>
            <h1 class="row justify-content-center align-items-center">Animais</h1><br>
            <div class="mb-3 row">
                <div class="col-2">
                    <i class="bi bi-arrow-down-up"></i>
                    Ordenar por
                </div>

                <div class="col-2">
                    <a class="btn btn-outline-secondary" href="index.php?controle=animalController&metodo=listar_alf_publico">
                        A - B
                    </a>
                </div>

                <div class="col-2">
                    <a class="btn btn-outline-secondary" href="index.php?controle=animalController&metodo=listar_tutor_publico">
                        <i class="bi bi-person-square"></i>
                        Tutor
                    </a>
                </div>
                    
            </div>
            <div class="col-24">
                <div class="row">
                    <table class="table table-hover table-striped table-striped-color">
                        <tr>
                            <th>RGA</th>
                            <th>n° chip</th>
                            <th>Nome</th>
                            <th>Nascimento</th>
                            <th>Espécie</th>
                            <th>Raça</th>
                            <th>Pelagem</th>
                            <th>Aquisição</th>
                            <th>Tutor</th>
                            <th>Ações</th>
                        </tr>
                        <?php if (is_array($retorno) || is_object($retorno)): ?>
                            <?php foreach($retorno as $dado): ?>
                                <tr>
                                    <td><?= $dado->rga ?></td>
                                    <td><?= $dado->chip ?></td>
                                    <td><?= $dado->nome ?></td>
                                    <td>
                                        <?php 
                                            $date = new DateTime($dado->datan); 
                                            echo $date->format('d/m/Y'); 
                                        ?> <!-- DATA DE NASCIMENTO -->
                                    </td>
                                    <td><?= $dado->especie ?></td>
                                    <td><?= $dado->raca ?></td>
                                    <td><?= $dado->pelagem ?></td>
                                    <td><?= $dado->aquisicao ?></td>
                                    <td><?= $dado->nome_tutor ?></td>
                                    <td>
                                        <a class="btn btn-outline-success" href="index.php?controle=animalController&metodo=buscar_animal_publico&id=<?= $dado->id_animal ?>">
                                            <span class="material-symbols-outlined" style="vertical-align: middle; margin-top: -5px;">pets</span> <!-- ÍCONE --> 
                                            Perfil
                                        </a>
                                    </td>
                                    
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan='4'>Nenhum animal encontrado.</td></tr>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
        </div>
        <br>
    
    </div>
</div>

<?php require_once ROOT_PATH . '/views/rodape.html'; ?>
