<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>SendMails</title>
    <style>
        .card:hover {
            background-color: #eee;
            cursor: pointer;
            border-left: 8px solid orangered;
        }

        .card {
            text-decoration: none;
        }
    </style>
</head>
<body>
    

    <!-- Navbar Dark -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <i class="bi bi-envelope-at-fill"></i> SendMails
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#menuLateral" aria-controls="menuLateral" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-grid-3x3-gap-fill"></i>
            </button>
        </div>
    </nav>
    

    <!-- Menu Lateral (Offcanvas) -->
    <div class="offcanvas offcanvas-start bg-dark" tabindex="-1" id="menuLateral" aria-labelledby="menuLateralLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title text-light" id="menuLateralLabel">Menu Lateral</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Fechar"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="list-unstyled">
                <li><a href="#" class="text-decoration-none text-light">Home</a></li>
                <li><a href="#" class="text-decoration-none text-light">Sobre</a></li>
                <li><a href="#" class="text-decoration-none text-light">Serviços</a></li>
                <li><a href="#" class="text-decoration-none text-light">Contato</a></li>
            </ul>
        </div>
    </div>

    <div class="container">
       @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>