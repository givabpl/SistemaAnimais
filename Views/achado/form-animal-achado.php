<?php require_once ROOT_PATH . '/views/cabecalho.php'; ?>

    <div class="content">
        <div class="container">
            <?php
            if(isset($_GET["msg"]))
            {
                echo "<div class='alert alert-success' role='alert'>{$_GET['msg']}</div>";
            }
            ?>

            <h1 class="h2 col">Registrar animal encontrado</h1>
            <form action="#" method="post" enctype="multipart/form-data"> <!-- INÍCIO FORMULÁRIO -->

                <h3 class="col-md-6">Informações do Animal</h3>
                <!-- INPUTS NESSA LINHA: -->
                <!-- ESPÉCIE | RAÇA -->
                <div class="mb-3 row">
                    <!-- ESPÉCIE -->
                    <div class="col-md-4">
                        <label for="especie" class="form-label">ESPÉCIE</label>
                        <input
                            type="text"
                            class="form-control"
                            name="especie"
                            id="especie"
                            placeholder="Ex: cachorro, gato..."
                            value="<?php echo isset($_POST['especie'])?$_POST['especie']:'';?>">
                        <div style="color:red"><?php echo $msg[0] != ""?$msg[0]:'';?></div>
                    </div>
                    <!-- RAÇA -->
                    <div class="col-md-4">
                        <label for="raca" class="form-label">RAÇA</label>
                        <input
                            type="text"
                            class="form-control"
                            name="raca"
                            id="raca"
                            value="<?php echo isset($_POST['raca'])?$_POST['raca']:'';?>">
                        <div style="color:red"><?php echo $msg[1] != ""?$msg[1]:'';?></div>
                    </div>
                </div>

                <!-- INPUTS NESSA LINHA: -->
                <!-- PELAGEM | SEXO -->
                <div class="mb-3 row">
                    <!-- PELAGEM -->
                    <div class="col-md-4">
                        <label for="pelagem" class="form-label">PELAGEM</label>
                        <input
                                type="text"
                                class="form-control"
                                name="pelagem"
                                id="pelagem"
                                placeholder="Descreva a cor, formato, textura, etc"
                                value="<?php echo isset($_POST['pelagem'])?$_POST['pelagem']:'';?>">
                        <div style="color:red"><?php echo $msg[2] != ""?$msg[2]:'';?></div>
                    </div>
                    <!-- FORM-SELECT DO BOOTSTRAP NÃO ESTÁ FUNCIONANDO. PERSONALIZEI NO CSS
                         POSSÍVEL CAUSA: LIMITAÇÕES DO PRÓPRIO NAVEGADOR -->
                    <!-- SEXO -->
                    <div class="col-md-2 ">
                        <label for="sexo">SEXO</label>  <br>
                        <select class="form-select-sexo" name="sexo" aria-label="label select example">
                            <option value="<?php echo isset($_POST['sexo'])?$_POST['sexo']:'';?>"><?php echo isset($_POST['sexo'])?$_POST['sexo']:'';?></option>
                            <option value="Fêmea">Fêmea</option>
                            <option value="Macho">Macho</option>
                            <option value="Ni">Não identificado</option>
                        </select>
                        <div style="color:red"><?php echo $msg[3] != ""?$msg[3]:'';?></div>
                    </div>
                </div>

                <!-- INPUTS NESSA LINHA: -->
                <!-- IMAGEM -->
                <div class="mb-3 row">
                    <div class="col-md-4">
                        <label for="imagem" class="form-label">UPLOAD DE IMAGEM</label> <br>
                        <input
                            type="file"
                            name="imagem"
                            id="imagem"
                            value="<?php echo isset($_POST['imagem'])?$_POST['imagem']:'';?>"
                            onchange="mostrar(this)"
                            accept="image/png, image/jpeg">
                        <div style="color:red"><?php echo $msg[4] != ""?$msg[4]:'';?></div>
                    </div>
                    <!-- PRE-VISUALIZACAO DA IMAGEM -->
                    <div class="col-md-4">
                        <img src="" id="img">
                    </div>
                </div>

                <!-- LOCAL | DATA | HORA-->
                <div class="mb-3 row">
                    <div class="col-md-6">
                        <!-- LOCAL DO ENCONTRO -->
                        <label for="localac" class="form-label">LOCAL DO ENCONTRO</label><br>
                        <input
                            type="text"
                            class="form-control"
                            name="localac"
                            id="localac"
                            placeholder="Região, bairro, rua..."
                            value="<?php echo isset($_POST['localac'])?$_POST['localac']:'';?>">
                        <div style="color:red"><?php echo $msg[5] != ""?$msg[5]:'';?></div>
                    </div>

                    <div class="col-md-4">
                        <!-- DATA DO ENCONTRO -->
                        <label for="dataac" class="form-label">DATA DO ENCONTRO</label><br>
                        <input
                            type="date"
                            class="form-control"
                            name="dataac"
                            id="dataac"
                            value="<?php echo isset($_POST['dataac'])?$_POST['dataac']:'';?>">
                        <div style="color:red"><?php echo $msg[6] != ""?$msg[6]:'';?></div>

                        <!-- HORARIO DO ENCONTRO -->
                        <label for="horaac" class="form-label">HORÁRIO DO ENCONTRO</label><br>
                        <input
                            type="time"
                            class="form-control"
                            name="horaac"
                            id="horaac"
                            value="<?php echo isset($_POST['horaac'])?$_POST['horaac']:'';?>">
                        <div style="color:red"><?php echo $msg[7] != ""?$msg[7]:'';?></div>
                    </div>
                </div>

                <!-- DESCRITIVO -->
                <div class="mb-3 row">
                    <div class="col-md-6">
                        <label for="descritivo" class="form-label">DESCRIÇÃO DO ENCONTRO</label><br>
                        <textarea
                            name="descritivo"
                            id="descritivo"
                            cols="50"
                            rows="6"><?php echo isset($_POST['descritivo'])?$_POST['descritivo']:'';?></textarea>
                    </div>
                </div>
                <br>

                <h2 class="col h3">Informações para contato</h2>

                <!-- INPUTS NESSA LINHA: -->
                <!-- NOME DA PESSOA| SOBRENOME -->
                <div class="mb-3 row">
                    <div class="col-md-4">
                        <label for="nome_pessoa" class="form-label">NOME</label>
                        <input
                            type="text"
                            class="form-control"
                            name="nome_pessoa"
                            id="nome_pessoa"
                            value="<?php echo isset($_POST['nome_pessoa'])?$_POST['nome_pessoa']:'';?>">
                        <div style="color:red"><?php echo $msg[8] != ""?$msg[8]:'';?></div>
                    </div>
                    <div class="col-md-4">
                        <label for="sobrenome" class="form-label">SOBRENOME</label>
                        <input
                            type="text"
                            class="form-control"
                            name="sobrenome"
                            id="sobrenome"
                            value="<?php echo isset($_POST['sobrenome'])?$_POST['sobrenome']:'';?>">
                    </div>
                </div>

                <!-- INPUTS NESSA LINHA: -->
                <!-- TELEFONE1 | TELEFONE2 -->
                <div class="mb-3 row">
                    <div class="col-md-4">
                        <label for="telefone1" class="form-label">TELEFONE PARA CONTATO</label>
                        <input
                            type="text"
                            class="form-control"
                            name="telefone1"
                            id="telefone1"
                            placeholder="(DDD) 9 XXXX-XXXX OU FIXO"
                            value="<?php echo isset($_POST['telefone1'])?$_POST['telefone1']:'';?>">
                        <div style="color:red"><?php echo $msg[9] != ""?$msg[9]:'';?></div>
                    </div>
                    <div class="col-md-4">
                        <label for="telefone2" class="form-label">TELEFONE SECUNDÁRIO</label>
                        <input
                            type="text"
                            class="form-control"
                            name="telefone2"
                            id="telefone2"
                            placeholder="Opcional (não obrigatório)"
                            value="<?php echo isset($_POST['telefone2'])?$_POST['telefone2']:'';?>">
                    </div>

                </div>

                <br><br>

                <br>
                <input type="checkbox" name="termos" id="termos" value="<?php echo isset($_POST['termos'])?$_POST['termos']:'';?>">
                <label for="termos">Concedo permissão de meus dados fornecidos ao Portal para prosseguir com a busca.</label>
                <br>

                <input class="btn btn-primary" type="submit" value="Cadastrar">
                <br><br><br><br><br>
            </form>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        document.getElementById('imagem').addEventListener('change', function() {
            const file = this.files[0];
            const maxSize = 2 * 1024 * 1024; // 3MB em bytes
            if (file.size > maxSize) {
                alert('O arquivo é muito grande! O tamanho máximo permitido é 3MB.');
                this.value = ''; // Limpa o campo de upload
            }
        });

        function mostrar(img)
        {
            if(img.files  && img.files[0])
            {
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#img')
                        .attr('src', e.target.result)
                        .width(170)
                        .height(170);
                };
                reader.readAsDataURL(img.files[0]);
            }
        }

        document.addEventListener('DOMContentLoaded', (event) => {
            const phoneInputs = document.querySelectorAll('#telefone1, #telefone2');

            phoneInputs.forEach(input => {
                input.addEventListener('input', function(e) {
                    let value = e.target.value.replace(/\D/g, '');
                    let formattedValue = '';

                    if (value.length <= 11) {
                        // Format as (DDD) NNNN-NNNN
                        if (value.length > 3) {
                            formattedValue += '(' + value.substring(0, 3) + ') ';
                            value = value.substring(3);
                        }
                        if (value.length > 4) {
                            formattedValue += value.substring(0, 4) + '-' + value.substring(4, 8);
                        } else {
                            formattedValue += value;
                        }
                    } else {
                        // Format as (DDD) 9 NNNN-NNNN
                        if (value.length > 3) {
                            formattedValue += '(' + value.substring(0, 3) + ') ';
                            value = value.substring(3);
                        }
                        if (value.length > 1) {
                            formattedValue += value[0] + ' ';
                            value = value.substring(1);
                        }
                        if (value.length > 4) {
                            formattedValue += value.substring(0, 4) + '-' + value.substring(4, 8);
                        } else {
                            formattedValue += value;
                        }
                    }

                    e.target.value = formattedValue;
                });
            });
        });
    </script>

<?php require_once ROOT_PATH . '/views/rodape.html'; ?>