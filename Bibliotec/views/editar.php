<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicione um Livro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input[type="text"],
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .form-group textarea {
            height: 100px;
        }

        .form-group button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edite o Livro</h1>
        <form>
            <div class="form-group">
                <label for="titulo">Título</label>
                <input type="text" id="titulo" name="titulo" required>
            </div>
            <div class="form-group">
                <label for="editora">Editora</label>
                <input type="text" id="editora" name="editora" required>
            </div>
            <div class="form-group">
                <label for="editora">Autor</label>
                <input type="text" id="editora" name="editora" required>
            </div>
            <div class="form-group">
                <label for="editora">Quantidade</label>
                <input type="text" id="editora" name="editora" required>
            </div>
            <div class="form-group">
                <label for="editora">Categoria</label>
                <input type="text" id="editora" name="" required>
            </div>
            <div class="form-group">
                <label for="descricao">Descrição</label>
                <textarea id="descricao" name="descricao" required></textarea>
            </div>
            <div class="form-group">
                <button type="submit">Editar Livro</button>
            </div>
        </form>
    </div>
</body>
</html>
