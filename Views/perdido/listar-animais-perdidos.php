<?php require_once ROOT_PATH . '/views/cabecalho.php'; ?>

<div class="content" id="listar-animais">
    <div class="container">
        
        <?php
            if(isset($_GET["msg"]))
            {
                echo "<div class='alert alert-success' role='alert'>{$_GET['msg']}</div>";
            }
        ?>

            <h1 class="h2 row justify-content-center">Animais Desaparecidos</h1><br>

            <div class="mb-3 row">
                <div class="p-2">
                    <i class="bi bi-arrow-down-up"></i>
                    Ordenar por
                </div>
                <div class="p-2">
                    <a class="btn btn-outline-secondary" href="index.php?controle=perdidoController&metodo=listar">
                        _/_/_ 
                        Data
                    </a>
                </div>

                <div class="p-2">
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
            <div class="mb-3 row justify-content-start">
                    <div class="col-md-4 com-sm-12 mb-2">
                        <a class="btn btn-danger" href="index.php?controle=perdidoController&metodo=inserir">Registrar animal desaparecido</a>&nbsp;&nbsp;
                    </div>
                    <div class="col-md-4 com-sm-12 mb-2">
                        <a class="btn btn-primary" href="index.php?controle=achadoController&metodo=inserir">Registrar animal encontrado</a>&nbsp;&nbsp;
                    </div>
                    <div class="col-md-4 col-sm-12 mb-2">
                        <a class="btn btn-outline-primary" href="index.php?controle=achadoController&metodo=listar">Ver animais encontrados</a>&nbsp;&nbsp;
                    </div>
            </div>
            <br>
            <div class="row justify-content-evenly justify-content-sm-center justify-content-sm-center">
                <?php if (is_array($retorno) || is_object($retorno)): ?>
                    <?php foreach($retorno as $dado): ?>
                            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                                <div class="card">
                                    <img src="<?= $dado->imagem ?>" class="card-img-top" style="height: 250px; width: 100%; object-fit: cover; object-position: center;" alt="<?= $dado->nome_animal ?>">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $dado->nome_animal ?></h5>
                                        <p class="card-text">
                                        <i class="bi bi-gender-ambiguous"></i>&nbsp;<?= $dado->sexo ?>&nbsp; | &nbsp;<?= $dado->raca ?> <br>
                                        Pelagem: <?= $dado->pelagem ?> <br>
                                        </p>
                                        <p class="card-text">
                                            Tutor:
                                            <?= $dado->nome_tutor ?>&nbsp;<?= $dado->sobrenome ?><br>

                                            <?= $dado->telefone1 ?> <br>
                                            <?= $dado->telefone2 ?> <br>

                                            <a href="index.php?controle=perdidoController&metodo=buscar_perdido&id=<?= $dado->id_perdido ?>" class="btn btn-outline-primary">Mais informações</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                            <a href="index.php?controle=perdidoController&metodo=gerar_pdf&id=<?= $dado->id_perdido ?>" class="btn btn-outline-danger" target="_blank"><i class="bi bi-file-earmark-pdf"></i>PDF</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                            <a href="index.php?controle=perdidoController&metodo=excluir&id=<?= $dado->id_perdido ?>" class="btn btn-danger"><i class="bi bi-x-square"></i> Excluir</a>
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
    </div>
</div>

<?php require_once ROOT_PATH . '/views/rodape.html'; ?>
