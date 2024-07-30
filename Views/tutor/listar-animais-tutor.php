<?php require_once ROOT_PATH . '/views/cabecalho.php'; ?>

<div class="content" id="listar-animais">
    <div class="container">
        
        <?php
            if(isset($_GET["msg"]))
            {
                echo "<div class='alert alert-success' role='alert'>{$_GET['msg']}</div>";
            }
        ?>
    
        <div>
            <?php if (is_array($retorno) && count($retorno) > 0): ?>
                <div class="mb-3 row">
                    <div class="col-md-8">
                        <h3>Animais de <?= $retorno[0]->nome_tutor ?></h3>
                    </div>
                </div>
            <?php endif; ?>

            
                    <div class="">
                        <table class="table table-hover table-striped table-striped-color">
                            <tr>
                                <th>RGA</th>
                                <th>n° chip</th>
                                <th>Nome</th>
                                <th>Espécie</th>
                                <th>Raça</th>
                                <th>Pelagem</th>
                                <th>Ações</th>
                            </tr>
                            <?php if(!empty($retorno[0]->rga)): ?>
                                <?php if (is_array($retorno) || is_object($retorno)): ?>
                                    <?php foreach($retorno as $dado): ?> 
                                        <tr>
                                            <td><?= $dado->rga ?></td>
                                            <td><?= $dado->chip ?></td>
                                            <td><?= $dado->nome_animal ?></td>
                                            <td><?= $dado->especie ?></td>
                                            <td><?= $dado->raca ?></td>
                                            <td><?= $dado->pelagem ?></td>
                                            <td>
                                                <a class="btn btn-outline-success" href="index.php?controle=animalController&metodo=buscar_animal&id=<?= $dado->id_animal ?>">
                                                    <span class="material-symbols-outlined" style="vertical-align: middle; margin-top: -5px;">pets</span> <!-- ÍCONE --> 
                                                    Perfil
                                                </a>
                                                    &nbsp;
                                                <a class="btn btn-outline-primary" href="index.php?controle=prontController&metodo=listar_pronts_animal&id=<?= $dado->id_animal ?>">
                                                    <i class="bi bi-clipboard-pulse"></i> Prontuários
                                                </a>

                                                <?php if(isset($_SESSION["tipo"]) && $_SESSION["tipo"] == "Administrador"): ?>
                                                    &nbsp;
                                                    <a class="btn btn-outline-warning" href="index.php?controle=animalController&metodo=editar&id=<?= $dado->id_animal ?>">
                                                        <i class="bi bi-pencil-square"></i> Editar
                                                    </a>
                                                        &nbsp;
                                                    <a class="btn btn-outline-danger" href="index.php?controle=animalController&metodo=excluir&id=<?= $dado->id_animal ?>">
                                                        <i class="bi bi-x-square"></i> Excluir
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>

                                
                                <?php endif; ?>
                            <?php else: ?>
                                <tr><td colspan='4'>Nenhum animal encontrado.</td></tr>
                            <?php endif;?>
                            </table>
                            <a  class="btn btn-primary" href="index.php?controle=animalController&metodo=inserir">Cadastrar um animal</a>&nbsp;&nbsp;
                </div>
        </div>
        <br>
    
    </div>
</div>

<?php require_once ROOT_PATH . '/views/rodape.html'; ?>