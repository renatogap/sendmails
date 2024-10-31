<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-mail de inscrição do evento</title>
</head>
<body>

    <div class="container">

        Olá {{ $dados->nome }},

        seu e-mail é {{ $dados->email }}

    </div>
    
</body>
</html>