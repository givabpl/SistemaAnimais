<?php require_once ROOT_PATH . '/views/cabecalho.php'; ?>

<div class="content">
    <div class="container">
        <br>
        <h1>Identificação</h1>
        <br>

        <form action="#" method="POST">

            <div class="mb-3">
                <div class="col-md-6">
                    <label for="nome" class="form-label">NOME</label>
                    <input
                    type="text"
                    class="form-control"
                    id="nome"
                    name="nome"
                    placeholder="Nome completo"
                    >
                    <div style="color:red"><?php echo $msg[0] != ""?$msg[0]:'';?></div>
                </div>
            </div>

            <br>

            <div class="mb-3 row">
                <div class="col-md-2">
                    <label for="crmv" class="form-label">CRMV</label>
                    <input
                    type="text"
                    class="form-control"
                    id="crmv"
                    name="crmv"
                    placeholder="n° CRMV"
                    >
                    <div style="color:red"><?php echo $msg[1] != ""?$msg[1]:'';?></div>
                </div>
                <div class="col-md-4">
                    <label for="">TIPO</label><br>
                    <select class="form-select-sexo" name="tipo" aria-label="label select example">
                                <option value="0">----</option>
                                <option value="Administrador">Administrador</option>
                                <option value="Membro">Membro</option>
                            </select>
                    <br>
                </div>
            </div>

            <div class="mb-3">
                <div class="col-md-6">
                    <label for="email" class="form-label">E-mail</label>
                    <input
                    type="email"
                    class="form-control"
                    id="email"
                    name="email"
                    placeholder="seu@email.com"
                    >
                    <div style="color:red"><?php echo $msg[2] != ""?$msg[2]:'';?></div>
                </div>
            </div>

            <br>

            <div class="mb-3">
                <div class="col-md-6">
                    <label for="senha" class="form-label">SENHA</label>
                    <input
                        type="password"
                        class="form-control"
                        id="senha"
                        name="senha">
                    <div style="color:red"><?php echo $msg[3] != ""?$msg[3]:'';?></div>
                </div>
            </div>

            <br>

            <div class="mb-3">
                <div class="col-md-6">
                    <label for="confirma" class="form-label">CONFIRMAR SENHA</label>
                    <input
                        type="password"
                        class="form-control"
                        id="confirma"
                        name="confirma">
                    <div style="color:red"><?php echo $msg[4] != ""?$msg[4]:'';?></div>
                </div>
            </div>

            <br>
            
            <div class="col-md-6">
                <input class="btn btn-primary" type="submit" value="Cadastrar">
            </div>
        </form>
        <br>
        <br>
        

    </div>
</div>

<?php require_once ROOT_PATH . '/views/rodape.html'; ?>