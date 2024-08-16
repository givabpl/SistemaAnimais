<?php require_once ROOT_PATH . '/views/cabecalho.php'; ?>

    <div class="content">
        <div class="container">
            <div class="">
                <div class="card mb-3" style="max-width: 1200px;">

                    <?php if (is_array($retorno) || is_object($retorno)): ?>
                    <?php foreach($retorno as $dado): ?>

                    <div class="row g-0 align-items-center"> <!-- CARD HORIZONTAL EM TELAS GRANDES | CARD VERTICAL TELAS PEQUENAS -->
                        <!-- IMAGEM -->
                        <div class="col-md-4">
                            <img src="<?= $dado->imagem ?>" class="card-img-fluid rounded-start" style="height: 450px; width: 100%; object-fit: cover; object-position: center;" alt="<?= $dado->especie ?>">
                        </div>
                        <div class="col-md-8">
                            <!-- TITULO -->
                            <!-- ESPECIE | RACA -->
                            <div class="card-body">
                                <h4 class="card-title">
                                    <span class="material-symbols-outlined" style="vertical-align: middle; margin-top: -5px;">pets</span> <!-- ÍCONE -->
                                    <?= $dado->especie ?> <?= $dado->raca ?>  <br>

                                </h4>
                                <!-- TITULO -->
                                <!-- PELAGEM -->
                                <h5>
                                    Pelagem: <?= $dado->pelagem ?> <br>
                                </h5>
                                <!-- TITULO -->
                                <!-- DATA | HORA | LOCAL -->
                                <h5 class="card-title">
                                    <!-- ENCONTRADO EM: DATA | HORA  -->
                                    Encontrado em <?= $dado->data_formatada ?> às <?= $dado->hora_formatada ?> <br>
                                    <!-- LOCAL: LOCAL -->
                                    No local <?= $dado->localac ?>
                                </h5>
                                <!-- TITULO -->
                                <!-- NOME | SOBRENOME -->
                                <h6 class="card-title">
                                    <!-- QUEM ENCONTROU: NOME | SOBRENOME -->
                                    Quem encontrou: <?= $dado->nome_pessoa ?>&nbsp;<?= $dado->sobrenome ?> <!-- NOME DA PESSOA-->
                                </h6>
                                <!-- TITULO -->
                                <!-- CONTATO -->
                                <h6 class="card-title">
                                    <!-- CONTATO: TELEFONE1 | TELEFONE2 -->
                                    Contato: <?= $dado->telefone1 ?>&nbsp;  <?= $dado->telefone2 ?> <!-- NOME DA PESSOA-->
                                </h6>
                                <br>
                                <!-- TITULO -->
                                <!-- DESCRITIVO -->
                                <h6>
                                    Descritivo:
                                </h6>
                                <p>
                                    <?= $dado->descritivo ?>
                                </p>
                                <br>


                                <!-- TITULO -->
                                <!-- CARACTERISTICAS -->
                                <h6>
                                    Características:
                                </h6>
                                <ul class="list-group list-group-flush no-indent">
                                    <div class="mb-3 row">
                                        <!-- PRIMEIRA COLUNA LISTA -->
                                        <!-- SEXO | ESPECIE-->
                                        <div class="col-md-4">
                                            <!-- SEXO -->
                                            <li class="list-group-item">
                                                <i class="bi bi-gender-ambiguous"></i><!-- ÍCONE -->
                                                <?= $dado->sexo ?>
                                            </li>
                                            <!-- ESPÉCIE -->
                                            <li class="list-group-item">
                                                <strong>Espécie: </strong>
                                                <?= $dado->especie ?>
                                            </li>

                                        </div>
                                        <!-- SEGUNDA COLUNA LISTA -->
                                        <!-- RACA -->
                                        <div class="col-md-6">
                                            <!-- RAÇA -->
                                            <li class="list-group-item">
                                                <strong>Raça: </strong>
                                                <?= $dado->raca ?>
                                            </li>
                                        </div>
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <br>
                </div>
                <div class="d-flex flex-wrap">
                    <div class="m-2 g-2">
                        <button onclick="history.back()" class="btn btn-primary"><i class="bi bi-caret-left-fill"></i> Voltar</button>
                    </div>
                    <div class="m-2 g-2">
                        <a href="index.php?controle=achadoController&metodo=aprovar&id=<?= $dado->id_solici_achado ?>" class="btn btn-outline-success"><i class="bi bi-check-square"></i> Aprovar</a>
                    </div>
                    <div class="m-2 g-2">
                        <a href="index.php?controle=achadoController&metodo=remover_solici&id=<?= $dado->id_solici_achado ?>" class="mb-2 btn btn-danger"><i class="bi bi-x-square"></i> Excluir</a>
                    </div>
                </div>
                <br>

                <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan='4'>Animal não encontrado</td></tr>
                <?php endif; ?>
                <br>
            </div>
        </div>
    </div>


<?php require_once ROOT_PATH . '/views/rodape.html'; ?>