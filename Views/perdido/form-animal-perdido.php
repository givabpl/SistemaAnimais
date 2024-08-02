<?php require_once ROOT_PATH . '/views/cabecalho.php'; ?>

<div class="content">
    <div class="container">
        <?php
            if(isset($_GET["msg"]))
            {
                echo "<div class='alert alert-success' role='alert'>{$_GET['msg']}</div>";
            }
        ?>

        <h1 class="h2 col">Registrar animal desaparecido</h1>
        <form action="#" method="post" enctype="multipart/form-data"> <!-- INÍCIO FORMULÁRIO -->

            <h3 class="col-md-6">Informações do Animal</h3>
            <!-- INPUTS NESSA LINHA: -->
            <!-- RGA | CHIP DE RASTREAMENTO  -->
            <div class="mb-3 row"> <!-- INPUTS EM ROW / MESMA LINHA -->
                    <!-- RGA -->
                    <div class="col-md-4">
                        <label for="rga" class="form-label">RGA</label> 
                        <input 
                            type="text" 
                            class="form-control" 
                            name="rga" 
                            id="rga" 
                            placeholder="n° RGA (Se houver)" 
                            value="<?php echo isset($_POST['rga'])?$_POST['rga']:'';?>">
                    </div>
                    <!-- CHIP DE RASTREAMENTO -->
                    <div class="col-md-4">
                        <label for="chip" class="form-label">CHIP DE RASTREAMENTO</label> <!-- CHIP DE RASTREAMENTO -->
                            <input 
                                type="text" 
                                class="form-control" 
                                name="chip" 
                                id="chip"
                                placeholder="n° do chip (Se houver)"
                                value="<?php echo isset($_POST['chip'])?$_POST['chip']:'';?>">
                                <!-- CHIP DE RASTREAMENTO NÃO TEM MENSAGEM DE AVISO DE PREENCHIMENTO, POIS NÃO É OBRIGATÓRIO, É OPCIONAL -->
                    </div>
                   
            </div>

           
            <!-- NOME | DATA DE NASCIMENTO | SEXO -->
            <div class="mb-3 row"> <!-- INPUTS EM ROW / MESMA LINHA -->
                <!-- NOME -->
                <div class="col-md-4">
                    <label for="nome_animal" class="form-label">NOME</label> 
                    <input 
                        type="text" 
                        class="form-control" 
                        name="nome_animal" 
                        id="nome_animal" 
                        placeholder="Nome do animal" 
                        value="<?php echo isset($_POST['nome_animal'])?$_POST['nome_animal']:'';?>">
                        
                        <div style="color:red"><?php echo $msg[0] != ""?$msg[0]:'';?></div>
                        
                </div>
                <!-- DATA DE NASCIMENTO -->
                <div class="col-md-4">
                    <label for="datan" class="form-label">DATA DE NASCIMENTO</label> 
                        <input 
                            type="date" 
                            class="form-control" 
                            name="datan" 
                            id="datan"
                            value="<?php echo isset($_POST['datan'])?$_POST['datan']:'';?>">
                            <div style="color:red"><?php echo $msg[1] != ""?$msg[1]:'';?></div>
                </div>

                <!-- FORM-SELECT DO BOOTSTRAP NÃO ESTÁ FUNCIONANDO. PERSONALIZEI NO CSS
                     POSSÍVEL CAUSA: LIMITAÇÕES DO PRÓPRIO NAVEGADOR -->
                <!-- SEXO -->
                <div class="col-md-2 ">
                    <label for="sexo">SEXO</label>  <br> 
                    <select class="form-select-sexo" name="sexo" aria-label="label select example">
                        <option value="0"></option>
                        <option value="Fêmea">Fêmea</option>
                        <option value="Macho">Macho</option>
                        <option value="Macho">Não identificado</option>
                        <option value="<?php echo isset($_POST['sexo'])?$_POST['sexo']:'';?>"></option>
                    </select>

                    <div style="color:red"><?php echo $msg[2] != ""?$msg[2]:'';?></div>
                </div>
                
            </div>
            <div class="mb-3 row">
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
                 <!-- DOENÇAS PRÉ-EXISTENTES -->
                <div class="col-lg-4 col-md-6">
                    <label for="doencas" class="form-label">DOENÇAS/DEFICIÊNCIAS PRÉ-EXISTENTES</label> 
                    <input 
                        placeholder="Responda 'Não' caso não exista"
                        type="text"  
                        class="form-control" 
                        name="doencas" 
                        id="doencas" 
                        value="<?php echo isset($_POST['doencas'])?$_POST['doencas']:'';?>">
                </div>
            </div>
            
            <!-- INPUTS NESSA LINHA: -->
            <!-- CIRURGIAS ANTERIORES | PESO (KG) -->
            <div class="mb-3 row">
               
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
                </div>
            </div>
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
                        <div style="color:red"><?php echo $msg[3] != ""?$msg[3]:'';?></div>
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
                        <div style="color:red"><?php echo $msg[4] != ""?$msg[4]:'';?></div>
                </div>
            </div>
            <!-- AQUISIÇÃO -->
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
                        <div style="color:red"><?php echo $msg[5] != ""?$msg[5]:'';?></div>
                </div>
                <div class="col-md-4">
                    <label for="aquisicao" class="form-label">AQUISIÇÃO</label> 
                    <input 
                        type="text"
                        class="form-control" 
                        name="aquisicao" 
                        id="aquisicao" 
                        placeholder="Adotado, comprado, resgatado..."
                        value="<?php echo isset($_POST['aquisicao'])?$_POST['aquisicao']:'';?>">
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
                            <div style="color:red"><?php echo $msg[6] != ""?$msg[6]:'';?></div>
                </div>
                <div class="col-md-4">
                    <img src="" id="img">
                </div>
                
            </div>
        <!-- LOCAL | DATA -->
            <div class="mb-3 row">
                <div class="col-md-6">
                    <label for="locald" class="form-label">LOCAL DO DESAPARECIMENTO</label><br>
                    <input 
                        type="text"
                        class="form-control" 
                        name="locald" 
                        id="locald" 
                        placeholder="Região, bairro, rua..."
                        value="<?php echo isset($_POST['locald'])?$_POST['locald']:'';?>">
                    <div style="color:red"><?php echo $msg[7] != ""?$msg[7]:'';?></div>
                </div>
                <div class="col-md-4">
                    <label for="datad" class="form-label">DATA DO DESAPARECIMENTO</label><br>
                    <input 
                        type="date"
                        class="form-control" 
                        name="datad" 
                        id="datad" 
                        value="<?php echo isset($_POST['datad'])?$_POST['datad']:'';?>">
                    <div style="color:red"><?php echo $msg[8] != ""?$msg[8]:'';?></div>

                    <label for="horad" class="form-label">HORÁRIO DO DESAPARECIMENTO</label><br>
                    <input 
                        type="time"
                        class="form-control" 
                        name="horad" 
                        id="horad" 
                        value="<?php echo isset($_POST['horad'])?$_POST['horad']:'';?>">
                    <div style="color:red"><?php echo $msg[9] != ""?$msg[9]:'';?></div>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-md-6">
                    <label for="descritivo" class="form-label">DESCRIÇÃO DO DESAPARECIMENTO</label><br>
                    <textarea name="descritivo" id="descritivo" cols="50" rows="6"></textarea>
                </div>
            </div>
            <br>

            <h2 class="col h3">Informações do Tutor</h2>

            <!-- INPUTS NESSA LINHA: -->
            <!-- NOME DO TUTOR | EMAIL -->
            <div class="mb-3 row">
                <div class="col-md-4">
                    <label for="nome_tutor" class="form-label">NOME</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        name="nome_tutor" 
                        id="nome_tutor" 
                        value="<?php echo isset($_POST['nome_tutor'])?$_POST['nome_tutor']:'';?>">
                        <div style="color:red"><?php echo $msg[10] != ""?$msg[10]:'';?></div>
                </div>
                <div class="col-md-4">
                    <label for="sobrenome" class="form-label">SOBRENOME</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        name="sobrenome" 
                        id="sobrenome" 
                        value="<?php echo isset($_POST['sobrenome'])?$_POST['sobrenome']:'';?>">
                        <div style="color:red"><?php echo $msg[11] != ""?$msg[11]:'';?></div>
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
                        value="<?php echo isset($_POST['telefone1'])?$_POST['telefone1']:'';?>">
                        <div style="color:red"><?php echo $msg[12] != ""?$msg[12]:'';?></div>
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
                <input type="hidden" name="status" value="Perdido">
            </div>
            
            <br><br>

            <br>
            <input type="checkbox" name="termos" id="termos" value="termo">
            <label for="termos">Concedo permissão de meus dados fornecidos ao Portal para prosseguir com a busca.</label>
            <br>

            <input class="btn btn-primary" type="submit" value="Cadastrar">
            <br><br><br><br><br>
        </form>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
	<script>
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