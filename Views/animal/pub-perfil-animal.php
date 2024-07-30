<?php require_once ROOT_PATH . '/views/cabecalho.php'; ?>

<div class="content">
    <div class="container">
        <div class="card">

            <?php if (is_array($retorno) || is_object($retorno)): ?>
                <?php foreach($retorno as $dado): ?>

                    <div class="card-header mb-3 row card-header-prontuario">

                        <h5 class="col-md-4">
                            <span class="material-symbols-outlined" style="vertical-align: middle; margin-top: -5px;">pets</span> <!-- ÍCONE --> 
                            <?= $dado->nome ?> <!-- NOME ANIMAL -->
                        </h5>

                        <h5 class="col-md-2">
                            <i class="bi bi-credit-card-2-front"></i> <!-- ÍCONE -->
                            <?= $dado->rga ?> <!-- RGA -->
                        </h5>

                        <h5 class="col-md-4">
                            <i class="bi bi-person-square"></i> <!--Í CONE -->
                            <?= $dado->nome_tutor ?><!-- NOME DO TUTOR-->
                        </h5>                    

                    </div>

                    <div class="card-body">

                        <ul class="list-group list-group-flush">
                            <div class="mb-3 row">
                                <div class="col-md-4">
                                    
                                    <li class="list-group-item">
                                        <i class="bi bi-sd-card"></i> <!-- ÍCONE -->
                                        <?= $dado->chip ?> <!-- CHIP -->
                                    </li>
                                    <li class="list-group-item">
                                        <i class="bi bi-calendar"></i> <!-- ÍCONE -->
                                        <?php 
                                            $date = new DateTime($dado->datan); 
                                            echo $date->format('d/m/Y'); 
                                        ?> <!-- DATA DE NASCIMENTO -->
                                    </li>
                                    <li class="list-group-item">
                                        <i class="bi bi-gender-ambiguous"></i><!-- ÍCONE -->
                                        <?= $dado->sexo ?> <!-- SEXO -->
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Peso: </strong>
                                        <?= $dado->peso ?> <!-- PESO -->
                                        Kg
                                    </li>
                                    <li class="list-group-item">
                                        <!-- ÍCONE -->
                                        <strong>Espécie: </strong>
                                        <?= $dado->especie ?> <!-- ESPÉCIE -->
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Raça: </strong>
                                        <?= $dado->raca ?> <!-- RAÇA -->
                                    </li>
                                    
                                </div>

                                <div class="col-md-4">
                                    <li class="list-group-item">
                                        <strong>Pelagem: </strong>
                                        <?= $dado->pelagem ?> <!-- PELAGEM -->
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Alergias: </strong>
                                        <?= $dado->alergias ?> <!-- ALERGIAS -->
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Doenças pré-existentes:  </strong>
                                        <?= $dado->doencas ?> <!-- DOENÇAS -->
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Cirurgias anteriores: </strong>
                                        <?= $dado->cirurgias ?> <!-- CIRURGIAS -->
                                    </li>
                                    <li class="list-group-item">
                                        <strong>Aquisição: </strong>
                                        <?= $dado->aquisicao ?> <!-- AQUISIÇÃO -->
                                    </li>
                                </div>
                            </div>
                        
                        </ul>
                        
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


<?php require_once ROOT_PATH . '/views/rodape.html'; ?>