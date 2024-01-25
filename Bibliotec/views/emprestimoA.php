<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Lista de Empréstimos</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="views\support\css\bootstrap-icons.css" rel="stylesheet">
    <link href="views\support\css\bootstrap.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="views\support\css\style.css" rel="stylesheet">

    <!-- Font awesome -->
    <link rel="stylesheet" href="views/support/assets/font-awesome/css/font-awesome.min.css" />

</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center">
                <img src="assets/img/logo.png" alt="">
                <span class="d-none d-lg-block">LivraTec</span>
            </a>
            <a class="nav-link collapsed" href="logout">
                <i class="bi bi-box-arrow-in-right"></i>
                <span>Logout</span>
            </a>

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href=" dashboard">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse"
                    href="adicionarLivro">
                    <i class="bi bi-plus"></i><span>Adicionar Livro</span></i>
                </a>

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse"
                    href="listaLivro">
                    <i class="bi bi-list"></i><span>Listar Livros</span></i>
                </a>

            <li class="nav-item">
                <a class="nav-link" href=" emprestimoA">
                    <i class="bi bi-list"></i><span>Listar Empréstimos</span>
                </a>

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="listaUsuario">
                    <i class="bi bi-list"></i><span>Listar Usuários</span>
                </a>

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse"
                    href="ativarUsuario">
                    <i class="bi bi-pen"></i><span>Ativar Usuários</span>
                </a>

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse"
                    href="desativarUsuario">
                    <i class="bi bi-pen"></i><span>Desativar Usuários</span>
                </a>

            <li class="nav-item">
                <a class="nav-link collapsed" href="login">
                    <i class="bi bi-box-arrow-in-right"></i>
                    <span>Login</span>
                </a>
            </li><!-- End Login Page Nav -->

    </aside><!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Cliente</li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <h1>Secção de Empréstimos</h1>
        <table class="table datatable">
            <thead>
                <tr>
                    <th scope="col">Data de empréstimo</th>
                    <th scope="col">Data de devolução</th>
                    <th scope="col">Id do livro</th>
                    <th scope="col">Id do usuário</th>

                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($emprestimos as $emprestimo) :
                ?>
                <tr>
                    <td><?php echo $emprestimo['data_emprestimo']; ?></td>
                    <td><?php echo $emprestimo['data_devolucao']; ?></td>
                    <td><?php echo $emprestimo['id_livro']; ?></td>
                    <td><?php echo $emprestimo['id_usuario']; ?></td>
                    <td>
                        <?php $id = $emprestimo['id'] ?>
                        <a href=<?= "emprestimoA/$id" ?>><i class="fa fa-trash" aria-hidden="true"></i></a>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
</body>

</html>