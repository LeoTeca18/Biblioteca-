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
        top: 10%;
        left: 40%;
        padding: 80px;
        border-radius: 15px;
        color: white;
        bottom: 10%;
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
        <h1>Login</h1>
        <!--<p style="color: red"><?php /*=$error_message*/?></p><br>-->
        <form action="login" method="post">
            <label for="email"></label>
            <input type="email" id="email" name="email" placeholder="email">
            <br><br>
            <label for="senha"></label>
            <input type="password" id="senha" name="senha" placeholder="Senha">
            <br>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                <a class="text-blue-600 decoration-2 font-medium" href="cadastro">
                    Cadastrar-se
                </a>
            </p>
            <br><br>
            <button type="submit" href="dashboard">Login</button>
        </form>
    </div>
</body>

</html>