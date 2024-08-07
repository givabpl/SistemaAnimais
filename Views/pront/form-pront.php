<?php 
    require_once ROOT_PATH . '/views/cabecalho.php'; 
    $vetId = $_SESSION['id_vet'];
?>


<div class="content">
    <div class="container">
        <?php
            if(isset($_GET["msg"]))
            {
                echo "<div class='alert alert-success' role='alert'>{$_GET['msg']}</div>";
            }
        ?>

        <h1 class="col">Criar prontuário</h1>
        <form action="#" method="post" enctype="multipart/form-data">

            <div class="mb-3 row">
                <!-- TITULO -->
                <div class="col-md-4">
                    <input type="hidden" id="id_animal" name="id_animal" value = "<?php echo $retorno[0]->id_animal;?>">
                    <label for="titulo" class="form-label">TÍTULO</label>
                    <input
                        type="text"
                        class="form-control"
                        name="titulo"
                        id="titulo"
                        value="<?php echo isset($_POST['titulo'])?$_POST['titulo']:'';?>">
                        <div style="color:red"><?php echo $msg[0] != ""?$msg[0]:'';?></div>
                </div>

                <!-- PACIENTE -->
                <div class="col-md-4">
                    <label for="nome" class="form-label">PACIENTE</label>
                    <input
                        type="text"
                        class="form-control"
                        name="nome"
                        id="nome"
                        placeholder="Nome"
                        value="<?php echo isset($_POST['nome'])?$_POST['nome']:$retorno[0]->nome;?>" disabled>
                </div>

                <!-- TUTOR -->
                <div class="col-md-4">
                    <label for="nome_tutor" class="form-label">TUTOR</label>
                    <input
                        type="text"
                        class="form-control"
                        name="nome_tutor"
                        id="nome_tutor"
                        placeholder="Nome_tutor"
                        value="<?php echo isset($_POST['nome_tutor'])?$_POST['nome_tutor']:$retorno[0]->nome_tutor;?>" disabled>
                        
                </div>

            </div>

            <div class="mb-3 row">
                <!-- DATA ATENDIMENTO -->
                <div class="col-md-4">
                    <label for="dataa" class="form-label">DATA</label>
                    <input
                        type="date"
                        class="form-control"
                        name="dataa"
                        id="dataa"
                        value="<?php echo isset($_POST['dataa'])?$_POST['dataa']:'';?>">
                        <div style="color:red"><?php echo $msg[1] != ""?$msg[1]:'';?></div>
                </div>

                <!-- LOCAL ATENDIMENTO -->
                <div class="col-md-4">
                    <label for="locala" class="form-label">LOCAL</label>
                    <input
                        type="text"
                        class="form-control"
                        name="locala"
                        id="locala"
                        placeholder="Local de atendimento"
                        value="<?php echo isset($_POST['locala'])?$_POST['locala']:'';?>">
                        <div style="color:red"><?php echo $msg[2] != ""?$msg[2]:'';?></div>
                </div>

            </div>

            <!-- DESCRITIVO -->
            <div class="col-md-8">
                <label for="descritivo" class="form-label">DESCRITIVO</label>
                <textarea
                    rows="4"
                    class="form-control" 
                    name="descritivo" 
                    id="descritivo" 
                    placeholder="Descrição do atendimento / anotações"><?php echo isset($_POST['descritivo'])?$_POST['descritivo']:'';?></textarea>
                    <div style="color:red"><?php echo $msg[3] != ""?$msg[3]:'';?></div>
            </div>

            <!-- MEDICACAO -->
            <!-- SELECT (SIM OU NAO) / SE SIM: INFORMAR -->
            <div class="col-md-4">
                <label for="medicacao">MEDICAÇÃO</label>  <br>
                <select class="form-select-pront" name="medicacao" id="medicacao" aria-label="Flabel select example">
                    <option value="<?php echo isset($_POST['medicacao'])?$_POST['medicacao']:'';?>"><?php echo isset($_POST['medicacao'])?$_POST['medicacao']:'';?></option>
                    <option value="Sim">Sim</option>
                    <option value="Não">Não</option>
                </select>
                <div style="color:red"><?php echo $msg[4] != ""?$msg[4]:'';?></div>
            </div>

            <!-- TEXT AREA DE MEDICACAO -->
            <div class="col-md-8" id="medicacao_textarea" style="display: none;">
                <label for="medicacao_info" class="form-label">Informe as medicações</label>
                <textarea
                        rows="4"
                        class="form-control"
                        name="medicacao_info"
                        id="medicacao_info"
                        placeholder="Descreva as medicações utilizadas na consulta"><?php echo isset($_POST['medicacao_info'])?$_POST['medicacao_info']:'';?></textarea>
            </div>

            <!-- INTERNACAO -->
            <div class="col-md-4">
                <label for="internacao">INTERNAÇÃO</label>  <br>
                <select class="form-select-pront" name="internacao" id="internacao" aria-label="Flabel select example">
                    <option value="<?php echo isset($_POST['internacao'])?$_POST['internacao']:'';?>"><?php echo isset($_POST['internacao'])?$_POST['internacao']:'';?></option>
                    <option value="Sim">Sim</option>
                    <option value="Não">Não</option>
                </select>
                <div style="color:red"><?php echo $msg[5] != ""?$msg[5]:'';?></div>
            </div>

            <!-- TEXT AREA DE INTERNACAO -->
            <div class="col-md-8" id="internacao_textarea" style="display: none;">
                <label for="internacao_info" class="form-label">Informe detalhes da internação</label>
                <textarea
                        rows="4"
                        class="form-control"
                        name="internacao_info"
                        id="internacao_info"
                        placeholder="Informe o tempo, motivo..."><?php echo isset($_POST['internacao_info'])?$_POST['internacao_info']:'';?></textarea>
            </div>

            <!-- RECEITA -->
            <div class="col-md-8">
                <label for="receita" class="form-label">RECEITA</label>
                <textarea
                        rows="4"
                        class="form-control"
                        name="receita"
                        id="receita"
                        placeholder="Receita a ser entregue ao tutor"><?php echo isset($_POST['receita'])?$_POST['receita']:'';?></textarea>
            </div>

            <!-- ARQUIVOS -->
            <div class="col-md-4">
                <label for="arquivos" class="form-label">UPLOAD DE ARQUIVO</label> <br>
                <input 
                    type="file" 
                    name="arquivos[]"
                    id="arquivos"
                    multiple
                    value="<?php echo isset($_POST['arquivos'])?$_POST['arquivos']:'';?>">
                    <div id="file-list"></div>
            </div>

            <!-- PESO -->
            <div class="col-md-4">
                <label for="peso" class="form-label">PESO (Kg)</label>
                <input
                        type="text"
                        class="form-control"
                        name="peso"
                        id="peso"
                        placeholder="Peso"
                        value="<?php echo isset($_POST['peso'])?$_POST['peso']:'';?>">
                <div style="color:red"><?php echo $msg[6] != ""?$msg[6]:'';?></div>
            </div>


            <input 
                type="hidden"
                name="vet" 
                id="vet" 
                value="<?php echo $vetId; ?>">
            <br>
            <div class="col-md-4">
                <input class="btn btn-primary" type="submit" value="Criar">
            </div>
            <br><br><br><br>
            
        </form>
    </div>
</div>
<script>
    document.getElementById('medicacao').addEventListener('change', function(){
        var medTextarea = document.getElementById('medicacao_textarea');
        if(this.value === 'Sim') {
            medTextarea.style.display = 'block';
        } else {
            medTextarea.style.display = 'none';
        }
    });

    document.getElementById('internacao').addEventListener('change', function(){
        var intTextarea = document.getElementById('internacao_textarea');
        if(this.value === 'Sim') {
            intTextarea.style.display = 'block';
        } else {
            intTextarea.style.display = 'none';
        }
    });

    document.getElementById('arquivos').addEventListener('change', function(){
        var fileList = document.getElementById('file-list');
        fileList.innerHTML = "";
        for (var i = 0; i < this.files.length; i++) {
            var file = this.files[i];
            var fileItem = document.createElement("p");
            fileItem.textContent = file.name;
            fileList.appendChild(fileItem);
        }
    });
</script>


<?php require_once ROOT_PATH . '/views/rodape.html'; ?>