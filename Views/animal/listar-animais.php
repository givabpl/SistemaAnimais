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
            <h1 class="row justify-content-center">Animais</h1><br>

            <!-- BOTOES -->
            <div class="mb-3 row">
                <div class="col-2">
                    <i class="bi bi-arrow-down-up"></i>
                    Ordenar por
                </div>
                <div class="col-md-2 col-sm-12">
                    <a class="btn btn-outline-secondary" href="index.php?controle=animalController&metodo=listar">
                        _/_/_ 
                        Cadastro
                    </a>
                </div>

                <div class="col-md-2 col-sm-12">
                    <a class="btn btn-outline-secondary" href="index.php?controle=animalController&metodo=listar_alf">
                        A - B
                    </a>
                </div>

                <div class="col-md-2 col-sm-12">
                    <a class="btn btn-outline-secondary" href="index.php?controle=animalController&metodo=listar_tutor">
                        <i class="bi bi-person-square"></i>
                        Tutor
                    </a>
                </div>

                <div class="col-md-4 d-flex justify-content-end">
                    <div>
                        <a  class="btn btn-primary" href="index.php?controle=animalController&metodo=inserir">Cadastrar um animal</a>&nbsp;&nbsp;
                    </div>
                </div>
                    
            </div>
            <br>
            <div class="">
                <table class="table table-hover table-striped table-striped-color w-100">
                    <tr>
                        <th>RGA</th>
                        <th>n° chip</th>
                        <th>Nome</th>
                        <th>Espécie</th>
                        <th>Raça</th>
                        <th>Tutor</th>
                        <th>Ações</th>
                    </tr>
                    <?php if (is_array($retorno) || is_object($retorno)): ?>
                        <?php foreach($retorno as $dado): ?>
                            <tr>
                                <td><?= $dado->rga ?></td>
                                <td><?= $dado->chip ?></td>
                                <td><?= $dado->nome ?></td>
                                <td><?= $dado->especie ?></td>
                                <td><?= $dado->raca ?></td>
                                <td><?= $dado->nome_tutor ?>&nbsp;<?= $dado->sobrenome_tutor ?></td>
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
                    <?php else: ?>
                        <tr><td colspan='4'>Nenhum animal encontrado.</td></tr>
                    <?php endif; ?>
                </table>

            </div>
        </div>
        <br>
    </div>
</div>

<?php require_once ROOT_PATH . '/views/rodape.html'; ?>
