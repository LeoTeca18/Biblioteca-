<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
    body {
        font-family: Arial, Helvetica, sans-serif;
        background-image: linear-gradient(45deg, white, blue);
    }

    div {
        background-color: rgba(0, 0, 0, 0.8);
        position: absolute;
        top: 0%;
        left: 40%;
        padding: 80px;
        border-radius: 15px;
        color: white;
        bottom: 0%;
    }

    input {
        padding: 15px;
        border: none;
        outline: none;
        font-size: 15px;
    }

    button {
        background-color: dodgerblue;
        border: none;
        padding: 15px;
        width: 100%;
        border-radius: 10px;
        color: white;
        font-size: 15px;
        cursor: pointer;
    }

    a:link {
        color: #3498db;
        /* Cor para links não visitados */
    }

    a:visited {
        color: #3498db;
        /* Cor para links visitados */
    }
    </style>
</head>

<body>
    <div>
        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
            <a class="text-blue-600 decoration-2 font-medium" href="login">
                Login
            </a>
        <h1>Cadastro</h1>
        <form method="post" action="cadastrar">
            <input type="email" placeholder="Email" id="email" name="email" required>
            <br><br>
            <input type="text" placeholder="Nome" id="nome" name="nome" required>
            <br><br>
            <input type="text" placeholder="Senha" id="senha" name="senha" required>
            <br><br>
            <br><br>
            <button type="submit">Cadastrar</button>
        </form>
    </div>
</body>

</html>