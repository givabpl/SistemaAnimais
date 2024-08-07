<?php require_once ROOT_PATH . '/views/cabecalho.php'; ?>

<div class="content">
    <div class="container">
        <?php
            if(isset($_GET["msg"]))
            {
                echo "<div class='alert alert-success' role='alert'>{$_GET['msg']}</div>";
            }
        ?>

        <h1 class="col">Cadastrar Animal</h1>
        <form action="#" method="post"> <!-- INÍCIO FORMULÁRIO -->

            <!-- INPUTS NESSA LINHA: -->
            <!-- RGA | CHIP DE RASTREAMENTO | NOME -->
            <div class="mb-3 row"> <!-- INPUTS EM ROW / MESMA LINHA -->
                    <!-- RGA -->
                    <div class="col-md-4">
                        <label for="rga" class="form-label">RGA</label> 
                        <input
                            maxlength="9"
                            type="text" 
                            class="form-control" 
                            name="rga" 
                            id="rga" 
                            value="<?php echo isset($_POST['rga'])?$_POST['rga']:'';?>">
                            <div style="color:red"><?php echo $msg[0] != ""?$msg[0]:'';?></div>
                    </div>
                    <!-- CHIP DE RASTREAMENTO -->
                    <div class="col-md-4">
                        <label for="chip" class="form-label">CHIP DE RASTREAMENTO</label> <!-- CHIP DE RASTREAMENTO -->
                            <input 
                                type="text" 
                                class="form-control" 
                                name="chip" 
                                id="chip"
                                placeholder="n° chip (Se houver)"
                                value="<?php echo isset($_POST['chip'])?$_POST['chip']:'';?>">
                                <!-- CHIP DE RASTREAMENTO NÃO TEM MENSAGEM DE AVISO DE PREENCHIMENTO, POIS NÃO É OBRIGATÓRIO, É OPCIONAL -->
                    </div>
                    <!-- NOME -->
                    <div class="col-md-4">
                        <label for="nome" class="form-label">NOME</label> 
                        <input 
                            type="text" 
                            class="form-control" 
                            name="nome" 
                            id="nome" 
                            placeholder="Nome" 
                            value="<?php echo isset($_POST['nome'])?$_POST['nome']:'';?>">
                            <div style="color:red"><?php echo $msg[1] != ""?$msg[1]:'';?></div>
                    </div>
                    
            </div>

           
            <!-- DATA DE NASCIMENTO | SEXO | ALERGIAS -->
            <div class="mb-3 row"> <!-- INPUTS EM ROW / MESMA LINHA -->
                <!-- DATA DE NASCIMENTO -->
                <div class="col-md-2">
                    <label for="datan" class="form-label">DATA DE NASCIMENTO</label> 
                        <input 
                            type="date" 
                            class="form-control" 
                            name="datan" 
                            id="datan"
                            value="<?php echo isset($_POST['datan'])?$_POST['datan']:'';?>">
                            <div style="color:red"><?php echo $msg[2] != ""?$msg[2]:'';?></div>
                </div>

                <!-- FORM-SELECT DO BOOTSTRAP NÃO ESTÁ FUNCIONANDO. PERSONALIZEI NO CSS
                     POSSÍVEL CAUSA: LIMITAÇÕES DO PRÓPRIO NAVEGADOR -->
                <!-- SEXO -->
                <div class="col-md-2 ">
                    <label for="sexo">SEXO</label>  <br> 
                    <select class="form-select-sexo" name="sexo" aria-label="Flabel select example">
                        <option value="0"></option>
                        <option value="Fêmea">Fêmea</option>
                        <option value="Macho">Macho</option>
                        <option value="Macho">Não identificado</option>
                    </select>

                    <div style="color:red"><?php echo $msg[3] != ""?$msg[3]:'';?></div>
                </div>
                <!-- ALERGIAS -->
                <div class="col-md-4">
                    <label for="alergias" class="form-label">ALERGIAS</label> 
                    <input
                        placeholder="Responda 'Não' caso não exista"
                        type="text" 
                        class="form-control" 
                        name="alergias" 
                        id="alergias" 
                        value="<?php echo isset($_POST['alergias'])?$_POST['alergias']:'';?>">
                </div>

            </div>
            
            <!-- INPUTS NESSA LINHA: -->
            <!-- DOENÇAS PRÉ-EXISTENTES | CIRURGIAS ANTERIORES | PESO (KG) -->
            <div class="mb-3 row">
                <!-- DOENÇAS PRÉ-EXISTENTES -->
                <div class="col-md-4">
                    <label for="doencas" class="form-label">DOENÇAS PRÉ-EXISTENTES</label> 
                    <input 
                        placeholder="Responda 'Não' caso não exista"
                        type="text"  
                        class="form-control" 
                        name="doencas" 
                        id="doencas" 
                        value="<?php echo isset($_POST['doencas'])?$_POST['doencas']:'';?>">
                </div>
                <!-- CIRURGIAS ANTERIORES -->
                <div class="col-md-4">
                    <label for="cirurgias" class="form-label">CIRURGIAS ANTERIORES</label> 
                    <input 
                    placeholder="Responda 'Não' caso não exista"
                        type="text"  
                        class="form-control" 
                        name="cirurgias" 
                        id="cirurgias" 
                        value="<?php echo isset($_POST['cirurgias'])?$_POST['cirurgias']:'';?>">
                </div>
                <!-- >PESO (KG) -->
                <div class="col-md-2">
                    <label for="peso" class="form-label">PESO (KG)</label> 
                    <input 
                        type="text"  
                        class="form-control" 
                        name="peso" 
                        id="peso" 
                        value="<?php echo isset($_POST['peso'])?$_POST['peso']:'';?>">
                        <div style="color:red"><?php echo $msg[4] != ""?$msg[4]:'';?></div>
                </div>
            </div>
            <!-- INPUTS NESSA LINHA: -->
            <!-- ESPÉCIE | RAÇA | PELAGEM | AQUISIÇÃO -->
            <div class="mb-3 row">
                <!-- ESPÉCIE -->
                <div class="col-md-2">
                    <label for="especie" class="form-label">ESPÉCIE</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        name="especie" 
                        id="especie" 
                        value="<?php echo isset($_POST['especie'])?$_POST['especie']:'';?>">
                        <div style="color:red"><?php echo $msg[5] != ""?$msg[5]:'';?></div>
                </div>
                <!-- RAÇA -->
                <div class="col-md-2">
                    <label for="raca" class="form-label">RAÇA</label> 
                    <input 
                        type="text"  
                        class="form-control" 
                        name="raca" 
                        id="raca" 
                        value="<?php echo isset($_POST['raca'])?$_POST['raca']:'';?>">
                        <div style="color:red"><?php echo $msg[6] != ""?$msg[6]:'';?></div>
                </div>
                <!-- PELAGEM -->
                <div class="col-md-2">
                    <label for="pelagem" class="form-label">PELAGEM</label> 
                    <input 
                        type="text" 
                        class="form-control" 
                        name="pelagem" 
                        id="pelagem"  
                        value="<?php echo isset($_POST['pelagem'])?$_POST['pelagem']:'';?>">
                        <div style="color:red"><?php echo $msg[7] != ""?$msg[7]:'';?></div>
                </div>
                <!-- AQUISIÇÃO -->
                <div class="col-md-2">
                    <label for="aquisicao" class="form-label">AQUISIÇÃO</label> 
                    <input 
                        type="text"
                        class="form-control" 
                        name="aquisicao" 
                        id="aquisicao" 
                        value="<?php echo isset($_POST['aquisicao'])?$_POST['aquisicao']:'';?>">
                        <div style="color:red"><?php echo $msg[8] != ""?$msg[8]:'';?></div>
                </div>
        </div>

        <!-- SELECT TUTOR -->
        <div class="mb-3">
            <div class="col">
                <!-- TUTOR -->
                <label for="tutor" class="form-label">TUTOR</label> <br>

                <select name="tutor" id="tutor-select" class="form-select-tutor">
                    <option value="0">Selecione um tutor</option>
                    <?php foreach($retorno as $dado): ?>
                        <option value="<?php echo $dado->id_tutor; ?>" <?php echo (isset($_POST["tutor"]) && $_POST["tutor"] == $dado->id_tutor) ? 'selected' : ''; ?>>
                            <?php echo $dado->nome; ?>  <?php echo $dado->sobrenome; ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <div style="color:red"><?php echo $msg[9] != ""?$msg[9]:'';?></div>
            </div>
        </div>
            
            <br><br>

            <input class="btn btn-primary" type="submit" value="Cadastrar">
            
        </form>
    </div>
</div>
    <!-- PERMITE BUSCA DENTRO DO SELECT PARA FACILITAR -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const rgaInput = document.getElementById('rga');

            rgaInput.addEventListener('input', function () {
                let rga = rgaInput.value.replace(/\D/g, '');
                rga = rga.replace(/(\d)(\d)/, '$1.$2');
                rga = rga.replace(/(\d{3})(\d)/, '$1.$2');
                rga = rga.replace(/(\d{3})(\d)$/, '$1.$2');
                rgaInput.value = rga;
            });
        });

        $(document).ready(function() {
            $('#tutor-select').select2({
                placeholder: "Selecione um tutor",
                allowClear: true
            });
        });


    </script>

<?php require_once ROOT_PATH . '/views/rodape.html'; ?>