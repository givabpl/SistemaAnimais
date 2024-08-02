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
    <!-- CSS do Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- JavaScript do Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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
                    <div class='collapse navbar-collapse justify-content-end'>

                        <!--<form class="d-flex" role="search" method="get" action="">

                            <select name="entidade_busca" class="form-control form-select-entidade-busca" id="entidade_busca"  onchange="updateTipoBusca()">
                                <option value="todos">Todos</option>
                                <option value="animal">Animal</option>
                                <option value="tutor">Tutor</option>
                                <option value="vet">Veterinário</option>
                            </select>
                            <select name="tipo_busca" class="form-control form-select-tipo-busca" id="tipo_busca">
                                 As opções serão preenchidas dinamicamente pelo JavaScript
                            </select>

                            <input name="busca" id="busca" class="form-control me-2" type="search" placeholder="Busca" aria-label="Search">

                            <input class="btn btn-outline-success" type="submit" value="Buscar">
                        </form>-->
                    </div>
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

                    <?php endif; ?>
                
            </div>
        </div>
	</nav>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
        function updateTipoBusca()
        {
            const entidade = document.getElementById('entidade_busca').value;
            const tipoBusca = document.getElementById('tipo_busca');

            // Limpa opcoes atuais
            tipoBusca.innerHTML = '';

            // Define as novas opcoes com base na entidade selecionada
            let options = [];
            if (entidade === 'animal')
            {
                options = [
                    { value: 'nome', text: 'Nome'},
                    { value: 'rga', text: 'RGA' },
                    { value: 'chip', text: 'Chip' }
                ];
            }else if (entidade === 'tutor')
            {
                options = [
                    { value: 'nome', text: 'Nome'}
                ];
            }else if (entidade === 'vet')
            {
                options = [
                    { value: 'nome', text: 'Nome' },
                    { value: 'crmv', text: 'CRMV' }
                ];
            }

            // Adiciona novas opcoes ao select
            options.forEach(option => {
                const opt = document.createElement('option');
                opt.value = option.value;
                opt.textContent = option.text;
                tipoBusca.appendChild(opt);
            });


        }
        // Atualiza as opcoes do tipo de busca ao carregar a pagina
        document.addEventListener('DOMContentLoaded', updateTipoBusca);

        // Preenche o campo hidden com a URL atual
        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('redirect').value = window.location.href;
        });
    </script>
