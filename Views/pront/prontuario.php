<?php require_once ROOT_PATH . '/views/cabecalho.php'; ?>

<div class="content">
    <div class="container">
        <div class="card">

            <?php if (is_array($retorno) || is_object($retorno)): ?>
                <?php foreach($retorno as $dado): ?>

                    <div class="card-header mb-3 row card-header-prontuario" style="margin-bottom: 0;">

                        <h5 class="col-md-4">
                            <i class="bi bi-clipboard-pulse"></i> <!-- ÍCONE -->
                            <?= $dado->titulo ?> <!-- TÍTULO -->
                        </h5>

                        <h5 class="col-md-2">
                            <i class="bi bi-calendar"></i> <!-- ÍCONE -->
                            <?=$dado->dataa_formatada?> <!-- DATA ATENDIMENTO -->
                        </h5>

                        <h5 class="col-md-2">
                            <i class="bi bi-geo-alt"></i> <!-- ÍCONE -->
                            <?= $dado->locala ?> <!-- LOCAL ATENDIMENTO -->
                        </h5>

                        <!-- EXIBIR ANIMAL E TUTOR NO PRONTUÁRIO -->
                        <h5 class="col-md-2">
                            <span class="material-symbols-outlined" style="vertical-align: middle; margin-top: -5px;">pets</span> <!-- ÍCONE -->
                            <?= $dado->nome_animal ?> <!--NOME DO ANIMAL-->
                        </h5>

                        <h5 class="col-md-2">
                            <i class="bi bi-person-square"></i> <!--Í CONE -->
                            <?= $dado->nome_tutor ?>&nbsp;<?= $dado->sobrenome ?> <!-- NOME DO TUTOR-->
                        </h5>

                    </div>

                    <div class="card-body" style="padding-top:0;">
                            Atendimento: 
                            <i class="bi bi-person-square"></i> <!-- ÍCONE -->
                            <?= $dado->nome_vet ?> <!-- NOME DO VETERINÁRIO -->
                    </div>
                
                    <ul class="list-group list-group-flush">

                        <!-- DESCRITIVO -->
                        <li class="list-group-item">
                            <h6>
                                <i class="bi bi-file-earmark-text"></i> <!-- ÍCONE -->
                                Descritivo 
                            </h6>
                            <p class="card-text">
                                <pre><?= $dado->descritivo ?></pre> <!-- DESCRITIVO -->
                            </p>
                        </li>

                        <!-- MEDICACAO -->
                        <li class="list-group-item">
                            <h6>
                                <i class="bi bi-capsule"></i> <!-- ÍCONE -->
                                Medicações: <?= $dado->medicacao ?>
                            </h6>
                            <p class="card-text">
                                <pre><?= $dado->medicacao_info ?></pre> <!-- MEDICACAO -->
                            </p>
                        </li>

                        <!-- INTERNACAO -->
                        <li class="list-group-item">
                            <h6>
                                <i class="bi bi-capsule"></i> <!-- ÍCONE -->
                                Internação: <?= $dado->internacao ?>
                            </h6>
                            <p class="card-text">
                                <pre><?= $dado->internacao_info ?></pre> <!-- INTERNACAO -->
                            </p>
                        </li>

                        <!-- RECEITA -->
                        <li class="list-group-item">
                            <h6>
                                <i class="bi bi-file-earmark-text"></i> <!-- ÍCONE -->
                                Receita
                            </h6>
                            <p class="card-text">
                                <pre><?= $dado->receita ?></pre>
                            </p>
                            <a class="btn btn-outline-danger" target="_blank" href="index.php?controle=prontController&metodo=gerar_pdf_receita&id=<?= $dado->id_pront ?>" role="button">
                                <i class="bi bi-printer"></i>
                                Imprimir receita
                            </a>
                        </li>

                        <li class="list-group-item">
                            <h6>
                                <i class="bi bi-file-earmark"></i> <!-- ÍCONE -->
                                Anexo 
                            </h6>
                            <p class="card-text">
                                <?php if(!empty($dado->arquivo)): ?>
                                    <i class="bi bi-download"></i>
                                    <a href="uploads/<?= $dado->arquivo ?>" download>Download do Arquivo</a> <!-- LINK DE DOWNLOAD -->
                                <?php else: ?>
                                    Nenhum anexo encontrado
                                <?php endif; ?>
                            </p>
                        </li>
                        <li class="list-group-item">
                            <h5>
                                Perfil de <?= $dado->nome_animal ?>
                            </h5>
                            <p class="card-text">
                                <ul>
                                    <div class="mb-3 row">
                                        <div class="col-md-4">
                                            <li>
                                                <strong>Rga: </strong> <?= $dado->rga ?>
                                            </li>
                                            <li>
                                                <strong>Chip: </strong> <?= $dado->chip ?>
                                            </li>
                                            <li>
                                                <strong>Nascimento: </strong> 
                                                <?= $dado->datan_formatada?> <!-- DATA DE NASCIMENTO -->
                                            </li>
                                            <li>
                                                <strong>Sexo: </strong> <?= $dado->sexo ?>
                                            </li> 
                                            <li>
                                                <strong>Espécie: </strong> <?= $dado->especie ?>
                                            </li>
                                            <li>
                                                <strong>Raça: </strong> <?= $dado->raca ?>
                                            </li>
                                        </div>
                                        <div class="col-md-4">
                                            <li>
                                                <strong>Peso: </strong> <?= $dado->peso_animal ?>Kg
                                            </li>
                                            <li>
                                                <strong>Pelagem: </strong> <?= $dado->pelagem ?>
                                            </li>
                                            <li>
                                                <strong>Alergias: </strong> <?= $dado->alergias ?>
                                            </li>
                                            <li>
                                                <strong>Doenças pré-existentes: </strong> <?= $dado->doencas ?>
                                            </li>
                                            <li>
                                                <strong>Cirurgias passadas: </strong> <?= $dado->cirurgias ?>
                                            </li>
                                            <li>
                                                <strong>Aquisição: </strong> <?= $dado->aquisicao ?>
                                            </li>
                                        </div>
                                    </div>

                                </ul>
                            </p>
                        </li>
                    </ul>
                </div>
                <br>
                <a class="btn btn-danger" target="_blank" href="index.php?controle=prontController&metodo=gerar_pdf&id=<?= $dado->id_pront ?>" role="button">
                    <i class="bi bi-file-earmark-pdf"></i>
                    Gerar Pdf
                </a>
                <br>
                <br><br><br>
                <?php endforeach; ?>

            <?php else: ?>

                <tr><td colspan='4'>Prontuário não encontrado</td></tr>

            <?php endif; ?>
    </div>
</div>


<?php require_once ROOT_PATH . '/views/rodape.html'; ?>