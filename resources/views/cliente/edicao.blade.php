<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar cliente</title>
</head>
<body>
    <div>
        <h2>Editar cliente</h2>
        <form action="{{ url('/cliente/alterar') }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $cliente->id }}">

            <div>
                <label for="nome">Nome</label>
                <input type="text" name="nome" value="{{ $cliente->nome }}">
            </div>
            <br />
            <div>
                <label for="email">E-mail</label>
                <input type="text" name="email" value="{{ $cliente->email }}">
            </div>
            <br />
            <div>
                <label for="senha">Senha</label>
                <input type="text" name="senha" value="{{ $cliente->senha }}">
            </div>
            <br />
            <div>
                <label for="saldo">Saldo</label>
                <input type="text" name="saldo" value="{{ $cliente->saldo }}">
            </div>
            <br />
            <div>
                <button type="submit">Alterar</button>
            </div>
        </form>
    </div>
</body>
</html>