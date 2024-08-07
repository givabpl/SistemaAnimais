<?php
    require_once ROOT_PATH . '/views/cabecalho.php';
?>

<div class="content">
    <div class="container">

        <br>
        <h1>Senha de Acesso ao Cadastro</h1>
        <br>

        <form action="index.php?controle=vetController&metodo=cadastrar" method="POST">

            <br>

            <div class="mb-3">
                <label for="access_password" class="form-label">Senha de Acesso</label>
                <input
                    type="password"
                    class="form-control w-50"
                    id="access_password"
                    name="access_password">
                <div style="color:red"><?php echo $msg[10] != ""? $msg[10] : '';?></div>
            </div>

            <br>

            <input class="btn btn-primary" type="submit" value="Entrar">
        </form>
    </div>
</div>

<?php require_once ROOT_PATH . '/views/rodape.html'; ?>
