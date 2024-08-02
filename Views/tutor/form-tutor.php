<?php require_once ROOT_PATH . '/views/cabecalho.php'; ?>

<div class="content">
    <div class="container">
        <?php
            if(isset($_GET["msg"]))
            {
                echo "<div class='alert alert-success' role='alert'>{$_GET['msg']}</div>";
            }
        ?>

        <h1 class="col">Cadastrar Tutor</h1>
        <form action="#" method="post">

            <div class="mb-3 row">
                <div class="col-md-4">
                    <label for="nome" class="form-label">NOME</label>
                    <input
                        type="text"
                        class="form-control"
                        name="nome"
                        id="nome"
                        placeholder="Primeiro nome"
                        value="<?php echo isset($_POST['nome'])?$_POST['nome']:'';?>">
                        <div style="color:red"><?php echo $msg[0] != ""?$msg[0]:'';?></div>
                </div>
                <div class="col-md-4">
                    <label for="sobrenome" class="form-label">SOBRENOME</label>
                    <input
                        type="text"
                        class="form-control"
                        name="sobrenome"
                        id="sobrenome"
                        placeholder="Sobrenome"
                        value="<?php echo isset($_POST['sobrenome'])?$_POST['sobrenome']:'';?>">
                        <div style="color:red"><?php echo $msg[1] != ""?$msg[1]:'';?></div>
                </div>
            </div>

            <div class="mb-3 row">
                <div class="col-md-4">
                    <label for="rg" class="form-label">RG</label>
                    <input 
                        type="text" 
                        maxlength="12"
                        class="form-control" 
                        name="rg" 
                        id="rg" 
                        placeholder="Somente números" 
                        value="<?php echo isset($_POST['rg'])?$_POST['rg']:'';?>">
                        <div style="color:red"><?php echo $msg[2] != ""?$msg[2]:'';?></div>
                </div>

                <div class="col-md-4">
                    <label for="cpf" class="form-label">CPF</label>
                    <input 
                        type="text" 
                        maxlength="14"
                        class="form-control" 
                        name="cpf" 
                        id="cpf" 
                        placeholder="Somente números">
                        <div style="color:red"><?php echo $msg[3] != ""?$msg[3]:'';?></div>
                </div>

            </div>
            <div class="mb-3 row">
                <div class="col-md-4">
                    <label for="cep" class="form-label">CEP</label>
                    <input
                        type="text"
                        class="form-control"
                        name="cep"
                        id="cep"
                        placeholder="ex: 00000-000"
                        value="<?php echo isset($_POST['cep'])?$_POST['cep']:'';?>">
                        <div style="color:red"><?php echo $msg[4] != ""?$msg[4]:'';?></div>
                </div>
                <div class="col-md-4">
                    <label for="logradouro" class="form-label">LOGRADOURO</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        name="logradouro" 
                        id="logradouro" 
                        placeholder="ex: Av. Rodolpho Guimarães" 
                        value="<?php echo isset($_POST['logradouro'])?$_POST['logradouro']:'';?>">
                        <div style="color:red"><?php echo $msg[5] != ""?$msg[5]:'';?></div>
                </div>
                <div class="col-md-2">
                    <label for="numero" class="form-label">NÚMERO</label>
                    <input 
                        type="text"
                        class="form-control" 
                        name="numero" 
                        id="numero" 
                        placeholder="n°" 
                        value="<?php echo isset($_POST['numero'])?$_POST['numero']:'';?>">
                        <div style="color:red"><?php echo $msg[6] != ""?$msg[6]:'';?></div>
                </div>
            </div>

            <div class="mb-3 row">
                <div class="col">
                    <label for="bairro" class="form-label">BAIRRO</label>
                    <input
                        type="text"
                        class="form-control w-50"
                        name="bairro"
                        id="bairro"
                        placeholder="ex: Centro"
                        value="<?php echo isset($_POST['bairro'])?$_POST['bairro']:'';?>">
                        <div style="color:red"><?php echo $msg[7] != ""?$msg[7]:'';?></div>
                </div>
            </div>

            <div class="mb-3 row">
                <div class="col-md-4">
                    <label for="telefone1" class="form-label">TELEFONE 1</label>
                    <input 
                        type="text"
                        class="form-control" 
                        name="telefone1" 
                        id="telefone1" 
                        placeholder="(DDD) 9 XXXX-XXXX OU FIXO" 
                        value="<?php echo isset($_POST['telefone1'])?$_POST['telefone1']:'';?>">
                        <div style="color:red"><?php echo $msg[8] != ""?$msg[8]:'';?></div>
                </div>
                <div class="col-md-4">
                    <label for="telefone2" class="form-label">TELEFONE 2</label>
                    <input 
                        type="text"
                        class="form-control" 
                        name="telefone2" 
                        id="telefone2" 
                        placeholder="opcional (não obrigatório)" 
                        value="<?php echo isset($_POST['telefone2'])?$_POST['telefone2']:'';?>">
                </div>
            </div>

            <br><br>
            <div class="mb-3 row">
                <div class="col">
                    <input class="btn btn-primary" type="submit" value="Cadastrar">
                </div>
            </div>
            <br><br>
        </form>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const rgInput = document.getElementById('rg');
        const cpfInput = document.getElementById('cpf');

        rgInput.addEventListener('input', function () {
            let rg = rgInput.value.replace(/\D/g, '');
            rg = rg.replace(/(\d{2})(\d)/, '$1.$2');
            rg = rg.replace(/(\d{3})(\d)/, '$1.$2');
            rg = rg.replace(/(\d{3})(\d)$/, '$1-$2');
            rgInput.value = rg;
        });

        cpfInput.addEventListener('input', function () {
            let cpf = cpfInput.value.replace(/\D/g, '');
            cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
            cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
            cpf = cpf.replace(/(\d{3})(\d{2})$/, '$1-$2');
            cpfInput.value = cpf;
        });
    });

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