<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisar Cliente</title>
</head>
<body>
    <h2>Pesquisar Cliente</h2>

    @foreach($clientes as $cliente)
        <div>
            {{ $cliente->nome }}<br>
            {{ $cliente->email }}<br>
            {{ $cliente->saldo }}<br>
            <a href="{{ url('/cliente/edicao/'.$cliente->id) }}">Editar</a>
            /cliente/edicao/
        </div>
        <br />
    @endforeach
</body>
</html>