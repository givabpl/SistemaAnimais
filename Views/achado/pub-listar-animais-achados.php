<?php require_once ROOT_PATH . '/views/cabecalho.php'; ?>

<div class="content" id="listar-animais">
    <div class="container">

        <?php
        if(isset($_GET["msg"]))
        {
            echo "<div class='alert alert-success' role='alert'>{$_GET['msg']}</div>";
        }
        ?>
        <!-- TITULO -->
        <h1 class="h2 row justify-content-center">Animais Encontrados</h1><br>

        <!-- BOTOES -->
        <div class="mb-3 row justify-content-start">
            <div class="col-md-4 com-sm-12 mb-2">
                <a class="btn btn-danger" href="index.php?controle=perdidoController&metodo=inserir">Registrar animal desaparecido</a>&nbsp;&nbsp;
            </div>
            <div class="col-md-4 com-sm-12 mb-2">
                <a class="btn btn-primary" href="index.php?controle=achadoController&metodo=inserir">Registrar animal encontrado</a>&nbsp;&nbsp;
            </div>
            <div class="col-md-4 col-sm-12 mb-2">
                <a class="btn btn-outline-primary" href="index.php?controle=perdidoController&metodo=listar">Ver animais desaparecidos</a>&nbsp;&nbsp;
            </div>
        </div>
        <br>
        <div class="row justify-content-evenly justify-content-sm-center justify-content-sm-center">
            <?php if (is_array($retorno) || is_object($retorno)): ?>
                <?php foreach($retorno as $dado): ?>
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <div class="card">
                            <!-- IMAGEM -->
                            <img src="<?= $dado->imagem ?>" class="card-img-top" style="height: 250px; width: 100%; object-fit: cover; object-position: center;" alt="<?= $dado->nome_animal ?>">

                            <!-- TITULO -->
                            <!-- TIPO -->
                            <!-- PELAGEM | SEXO | RACA -->
                            <!-- RESPONSAVEL: NOME | CONTATO -->
                            <!-- CONTATO -->
                            <!-- BOTOES -->
                            <div class="card-body">
                                <!-- TIPO -->
                                <h5 class="card-title"><?= $dado->tipo ?></h5>
                                <!-- PELAGEM | SEXO | RACA -->
                                <p class="card-text">
                                    Pelagem: <?= $dado->pelagem ?> <br>
                                    <i class="bi bi-gender-ambiguous"></i>&nbsp;<?= $dado->sexo ?>&nbsp; | <?= $dado->raca ?>
                                </p>

                                <!-- NOME | SOBRENOME | CONTATO | BOTOES -->
                                <p class="card-text">
                                    Responsável:
                                    <?= $dado->nome_pessoa ?><br>

                                    <?= $dado->telefone1 ?> <br>
                                    <?= $dado->telefone2 ?> <br>

                                    <a href="index.php?controle=achadoController&metodo=buscar_achado&id=<?= $dado->id_achado ?>" class="mb-2 btn btn-outline-primary">Mais informações</a>&nbsp;&nbsp;&nbsp;&nbsp;

                                    <a href="index.php?controle=achadoController&metodo=excluir&id=<?= $dado->id_achado ?>" class="mb-2 btn btn-danger"><i class="bi bi-x-square"></i> Excluir</a>
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
