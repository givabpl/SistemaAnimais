<?php
    require_once ROOT_PATH . '/views/cabecalho.php';

?>

<div class="content">
    <div class="container">

        <?php
            if(isset($_GET["msg"]))
            {
                echo "<div class='alert alert-success' role='alert'>{$_GET['msg']}</div>";
            }
        ?>

        <br>
        <h1>Identificação</h1>
        <br>

        <form action="#" method="POST">

            <br>

            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input 
                type="email" 
                class="form-control w-50" 
                id="email"
                name="email"
                placeholder="seu@email.com"
                >
                <div style="color:red"><?php echo $msg[0] != ""?$msg[0]:'';?></div>
            </div>

            <br>

            <div class="mb-3">
                <label for="senha" class="form-label">SENHA</label>
                <input 
                    type="password" 
                    class="form-control w-50" 
                    id="senha" 
                    name="senha">
                <div style="color:red"><?php echo $msg[1] != ""?$msg[1]:'';?></div>
            </div>

            <br>
            
            <input class="btn btn-primary" type="submit" value="Enviar">
        </form>
        <br>
        <br>

        <div>
            <a class="btn btn-primary" href="index.php?controle=vetController&metodo=cadastrar">Novo cadastro</a>
        </div>


    </div>
</div>

<?php require_once ROOT_PATH . '/views/rodape.html'; ?>