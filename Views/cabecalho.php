<?php
	if(!isset($_SESSION))
	{
		session_start();
	}
	
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="src/styles/style.css">
    <link rel="shortcut icon" href="src/assets/icon/favicon.ico" type="image/x-icon">
    <title>Sistema veterinário</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light" style="margin-bottom: 40px;">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="src/assets/icon/logo-sist.png" alt="" width="30" height="30">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">	
                <ul class="navbar-nav">
                
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    
<!-- exibir se a sessão de veterinário estiver ativa -->
                    <?php if(isset($_SESSION["id_vet"])): ?>
                        
                        <li class='nav-item'>
                            <a class='nav-link' href='index.php?controle=animalController&metodo=listar'>Animais</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='index.php?controle=tutorController&metodo=listar'>Tutores</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='index.php?controle=vetController&metodo=listar'>Veterinários</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='index.php?controle=prontController&metodo=listar'>Prontuários</a>
                        </li>

                </ul>
                
                        <div class='collapse navbar-collapse justify-content-end'>
                            <form class="d-flex" role="search" method="get">
                                <input class="form-control me-2" type="search" placeholder="Busca" aria-label="Search">&nbsp;
                                <button class="btn btn-outline-success" type="submit">Buscar</button>
                            </form>&nbsp;&nbsp;&nbsp;&nbsp;
                            <ul class='navbar-nav'>
                                <li class='nav-item'>
                                    <a class='nav-link' href='index.php?controle=vetController&metodo=logout'><i class="bi bi-power"></i> Sair</a>
                                </li>
                            </ul>
                        </div>
<!-- exibir se a sessão de veterinário NÃO estiver ativa -->
                    <?php else: ?>
                        <li class='nav-item'>
                            <a class='nav-link' href='index.php?controle=vetController&metodo=login'>Login veterinário</a>
                        </li>

                        <li class='nav-item'>
                            <a class='nav-link' href='index.php?controle=animalController&metodo=listar_publico'>Animais</a>
                        </li>
                        </ul>
                        <div class='collapse navbar-collapse justify-content-end'>
                            <form class="d-flex" role="search" method="get" action="#">
                                <input type="hidden" name="controle" value="buscaController">
                                <input type="hidden" name="metodo" value="buscar">
                                <input class="form-control me-2" type="search" placeholder="Busca" aria-label="Search">
                                <button class="btn btn-outline-success" type="submit">Buscar</button>
                            </form>
                        </div>
                    <?php endif; ?>
                
            </div>
        </div>
	</nav>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <div class="container">
        <!-- Adicione a seção de resultados de busca -->
        <?php if (!empty($animais) || !empty($tutores) || !empty($vets) || !empty($pronts)): ?>
            <h2>Resultados da Busca</h2>

            <h3>Animais</h3>
            <ul>
                <?php foreach ($animais as $animal): ?>
                    <li><?php echo $animal->nome; ?></li>
                <?php endforeach; ?>
            </ul>

            <h3>Tutores</h3>
            <ul>
                <?php foreach ($tutores as $tutor): ?>
                    <li><?php echo $tutor->nome; ?></li>
                <?php endforeach; ?>
            </ul>

            <h3>Veterinários</h3>
            <ul>
                <?php foreach ($vets as $vet): ?>
                    <li><?php echo $vet->nome; ?></li>
                <?php endforeach; ?>
            </ul>

            <h3>Prontuários</h3>
            <ul>
                <?php foreach ($pronts as $pront): ?>
                    <li><?php echo $pront->titulo; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>