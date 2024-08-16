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
                                <img src="<?= $dado->imagem ?>" class="card-img-fluid rounded-start" style="height: 450px; width: 100%; object-fit: cover; object-position: center;" alt="<?= $dado->nome_animal ?>">
                            </div>
                            <div class="col-md-8">
                                <!-- NOME -->
                                <!-- NOME TUTOR | SOBRENOME -->
                                <div class="card-body">

                                    <!-- TITULO -->
                                    <!-- NOME ANIMAL -->
                                    <h4 class="card-title">
                                        <span class="material-symbols-outlined" style="vertical-align: middle; margin-top: -5px;">pets</span> <!-- ÍCONE -->
                                        <?= $dado->nome ?>
                                    </h4>

                                    <!-- TITULO -->
                                    <!-- NOME DO TUTOR-->
                                    <h5 class="card-title">
                                        <i class="bi bi-person-square"></i> <!--Í CONE -->
                                        <?= $dado->nome_tutor ?>&nbsp;<?= $dado->sobrenome ?>
                                    </h5>

                                    <!-- TITULO -->
                                    <!-- DESAPARECIMENTO: DATA | HORA | LOCAL -->
                                    <h5 class="card-title">
                                        Desaparecido desde <?= $dado->data_formatada ?> às <?= $dado->hora_formatada ?> <br><br>
                                        No local <?= $dado->locald ?>
                                    </h5>
                                    <!-- DESCRITIVO -->
                                    <h6 class="card-title">Descritivo:</h6>
                                    <p><?= $dado->descritivo ?></p>


                                    <!-- DADOS -->
                                    <ul class="list-group list-group-flush no-indent">
                                        <div class="mb-3 row">
                                            <div class="col-md-4">

                                                <!-- DATA DE NASCIMENTO -->
                                                <li class="list-group-item">
                                                    <strong>Nascimento: </strong><!-- ÍCONE -->
                                                    <?= $dado->datan_formatada ?>
                                                </li>

                                                <!-- SEXO -->
                                                <li class="list-group-item">
                                                    <i class="bi bi-gender-ambiguous"></i><!-- ÍCONE -->
                                                    <?= $dado->sexo ?>
                                                </li>

                                                <!-- PESO -->
                                                <li class="list-group-item">
                                                    <strong>Peso: </strong>
                                                    <?= $dado->peso ?>
                                                    Kg
                                                </li>

                                                <!-- ESPÉCIE -->
                                                <li class="list-group-item">
                                                    <strong>Espécie: </strong>
                                                    <?= $dado->especie ?>
                                                </li>
                                            </div>

                                            <div class="col-md-6">
                                                <!-- RAÇA -->
                                                <li class="list-group-item">
                                                    <strong>Raça: </strong>
                                                    <?= $dado->raca ?>
                                                </li>

                                                <!-- PELAGEM -->
                                                <li class="list-group-item">
                                                    <strong>Pelagem: </strong>
                                                    <?= $dado->pelagem ?>
                                                </li>

                                                <!-- ALERGIAS -->
                                                <li class="list-group-item">
                                                    <strong>Alergias: </strong>
                                                    <?= $dado->alergias ?>
                                                </li>

                                                <!-- DOENÇAS -->
                                                <li class="list-group-item">
                                                    <strong>Doenças pré-existentes:  </strong>
                                                    <?= $dado->doencas ?>
                                                </li>
                                            </div>
                                        </div>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>

                    <div class="d-flex flex-wrap">
                        <div class="m-2 g-2">
                            <button onclick="history.back()" class="btn btn-primary"><i class="bi bi-caret-left-fill"></i> Voltar</button>
                        </div>
                        <div class="m-2 g-2">
                            <a href="index.php?controle=perdidoController&metodo=gerar_pdf&id=<?= $dado->id_perdido ?>" class="btn btn-danger" target="_blank"><i class="bi bi-file-earmark-pdf"></i>PDF para impressão</a>
                        </div>

                    </div>
                    <?php endforeach; ?>
                <?php else: ?>

                    <tr><td colspan='4'>Animal não encontrado</td></tr>

                <?php endif; ?>
            <br>
        </div>
    </div>
</div>


<?php require_once ROOT_PATH . '/views/rodape.html'; ?>