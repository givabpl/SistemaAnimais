<?php require_once "cabecalho.php"; ?>

<div class="content">
    <div class="container">
        <div class="">
            <h1 class="text-center col h2">Portal Veterinário Brotas-SP</h1>
        </div>
        <br>
        
            <div class="row justify-content-evenly justify-content-sm-center justify-content-sm-center">
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="card" style="width: 20rem; height:545px;">
                        <img src="../src/assets/rga.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">REGISTRO GERAL DO ANIMAL (RGA)</h5>
                            <p class="card-text">É obrigatório por Lei no município de São Paulo a todos os cães e gatos com idade superior a 3 meses de idade e facilita a localização dos tutores no caso de animais perdidos...</p>
                            <a href="https://www.prefeitura.sp.gov.br/cidade/secretarias/saude/saude_e_protecao_ao_animal_domestico/index.php?p=272497#" target="_blank" class="btn btn-primary">Leia Mais</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="card" style="width: 20rem;  height:545px;">
                        <img src="../src/assets/cachorro.png" class="card-img-top" alt="..." >
                        <div class="card-body">
                            <h5 class="card-title">Procurando alguém?</h5>
                            <p class="card-text">Ainda estamos começando por aqui! Mas verifique se o seu bichinho pode estar em nossa lista de achados. Registre o desaparecimento aqui!</p>
                            <br>
                            <a class="btn btn-outline-success" href="index.php?controle=achadoController&metodo=listar">
                                <span class="material-symbols-outlined" style="vertical-align: middle; margin-top: -5px;">pets</span> <!-- ÍCONE --> 
                            ANIMAIS ACHADOS
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="card" style="width: 20rem; height:545px;">
                        <img src="../src/assets/gato.png" class="card-img-top" alt="..." >
                        <div class="card-body">
                            <h5 class="card-title">Encontrou um bichinho perdido?</h5>
                            <p class="card-text">Veja se alguém está procurando por ele! Registre sua descoberta aqui! Quanto mais detalhes, melhor.</p>
                            <br>
                            <a class="btn btn-outline-primary" href="index.php?controle=perdidoController&metodo=listar">
                                <i class="bi bi-clipboard-pulse"></i>
                                ANIMAIS DESAPARECIDOS
                            </a>
                        </div>
                        
                    </div>
                </div>
            </div>

    </div>
</div>