<!-- FORMULARIO EDIT. PRONTUARIO -->
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

        <h1>Editar prontuário</h1>
        <form action="#" method="post" enctype="multipart/form-data">

            <div class="mb-3 row">

                <div class="col-md-4">
                    <input type="hidden" id="id_animal" name="id_animal" value = "<?php echo $retorno[0]->id_animal;?>">
                    <label for="titulo" class="form-label">TÍTULO</label>
                    <input
                        type="text"
                        class="form-control"
                        name="titulo"
                        id="titulo"
                        value="<?php echo isset($_POST['titulo'])?$_POST['titulo']:$retorno[0]->titulo;?>">
                        <div style="color:red"><?php echo $msg[0] != ""?$msg[0]:'';?></div>
                </div>
                
                <div class="col-md-4">
                    <label for="nome" class="form-label">PACIENTE</label>
                    <input
                        type="text"
                        class="form-control"
                        name="nome"
                        id="nome"
                        placeholder="Nome"
                        value="<?php echo isset($_POST['nome_animal'])?$_POST['nome_animal']:$retorno[0]->nome_animal;?>" disabled>
                        
                </div>

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

                <div class="col-md-4">
                    <label for="dataa" class="form-label">DATA</label>
                    <input
                        type="date"
                        class="form-control"
                        name="dataa"
                        id="dataa"
                        value="<?php echo isset($_POST['dataa'])?$_POST['dataa']:$retorno[0]->dataa;?>" disabled>
                        <div style="color:red"><?php echo $msg[1] != ""?$msg[1]:'';?></div>
                </div>

                <div class="col-md-4">
                    <label for="locala" class="form-label">LOCAL</label>
                    <input
                        type="text"
                        class="form-control"
                        name="locala"
                        id="locala"
                        placeholder="Local de atendimento"
                        value="<?php echo isset($_POST['locala'])?$_POST['locala']:$retorno[0]->locala;?>" disabled>
                        <div style="color:red"><?php echo $msg[2] != ""?$msg[2]:'';?></div>
                </div>

            </div>

            <div class="col-md-8">
                <label for="descritivo" class="form-label">DESCRITIVO</label>
                <textarea
                    rows="4"
                    type="text"  
                    class="form-control" 
                    name="descritivo" 
                    id="descritivo" 
                    placeholder="Descrição do atendimento / anotações" 
                    value="<?php echo isset($_POST['descritivo'])?$_POST['descritivo']:$retorno[0]->descritivo;?>">
                        <?php echo isset($_POST['descritivo'])?$_POST['descritivo']:$retorno[0]->descritivo;?>
                </textarea>
                    <div style="color:red"><?php echo $msg[3] != ""?$msg[3]:'';?></div>
            </div>

            <div class="col-md-4">
                <label for="arquivo" class="form-label">UPLOAD DE ARQUIVO</label> <br>
                <input 
                    type="file" 
                    name="arquivo" 
                    id="arquivo" 
                    value="<?php echo isset($_POST['arquivo'])?$_POST['arquivo']:$retorno[0]->arquivo;?>">            
            </div>

            <input 
                type="hidden"
                name="vet" 
                id="vet" 
                value="<?php echo $vetId; ?>">
            <br><br>
            <input class="btn btn-primary" type="submit" value="Alterar">
            
        </form>
    </div>
</div>

<?php require_once ROOT_PATH . '/views/rodape.html'; ?>