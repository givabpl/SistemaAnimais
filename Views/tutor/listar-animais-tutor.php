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


            <!-- FORMULÁRIO DE BUSCA -->
            <form method="get" action="">
                <input type="hidden" name="controle" value="tutorController">
                <input type="hidden" name="metodo" value="listar_animais">
                <input type="hidden" name="id" value="<?= $retorno[0]->id_tutor ?>">
            <?php endif; ?>
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
                                placeholder="Buscar por nome, RGA, chip, espécie, raça ou pelagem"
                                value="<?= isset($_GET['busca']) ? $_GET['busca'] : '' ?>">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search"></i>
                            Buscar
                        </button>
                    </div>
                    <!-- BOTÃO CADASTRAR UM ANIMAL -->
                    <div class="justify-content-end col-md-6">
                        <a  class="btn btn-primary" href="index.php?controle=animalController&metodo=inserir">Cadastrar um animal</a>&nbsp;&nbsp;
                    </div>
                </div>
            </form>
            <br>

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

        </div>
        </div>
        <br>
    
    </div>
</div>

<script>
    document.getElementById('clear-search-button').addEventListener('click', function() {
        window.location.href = 'index.php?controle=tutorController&metodo=listar_animais&id=<?= $retorno[0]->id_tutor ?>';
    });
</script>

<?php require_once ROOT_PATH . '/views/rodape.html'; ?>