<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de cliente</title>
</head>
<body>
    <div>
        <h2>Cadastro de cliente</h2>
        <form action="{{ url('/cliente/salvar') }}" method="POST">
            @csrf

            <div>
                <label for="nome">Nome</label>
                <input type="text" name="nome">
            </div>
            <br />
            <div>
                <label for="email">E-mail</label>
                <input type="text" name="email">
            </div>
            <br />
            <div>
                <label for="senha">Senha</label>
                <input type="text" name="senha">
            </div>
            <br />
            <div>
                <label for="saldo">Saldo</label>
                <input type="text" name="saldo">
            </div>
            <br />
            <div>
                <button type="submit">Salvar</button>
            </div>
        </form>
    </div>
</body>
</html>