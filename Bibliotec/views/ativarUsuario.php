<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Ativos</title>
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
                <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="emprestimoA">
                    <i class="bi bi-list"></i><span>Listar Empréstimos</span>
                </a>

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="
                    listaUsuario">
                    <i class="bi bi-list"></i><span>Listar Usuários</span>
                </a>
            <li class="nav-item">
                <a class="nav-link" href=" ativarUsuario">
                    <i class="bi bi-pen"></i><span>Usuarios Ativos</span>
                </a>

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse"
                    href="desativarUsuario">
                    <i class="bi bi-pen"></i><span>Usuarios Desativados</span>
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
            <h1>Listagem de Ativos</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Admin</li>
                    <li class="breadcrumb-item active">Lista de Ativos</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-8">
                    <div class="row">

                        <h1>Lista de Ativos</h1>
                        <table class="table">
                            <thead>
                                <tr>

                                    <th scope="col">Nome</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Desativar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                foreach ($usuarios as $usuario) :
                ?>
                                <tr>
                                    <td><?php echo $usuario['nome']; ?></td>
                                    <td><?php echo $usuario['email']; ?></td>
                                    <td>
                                        <?php $id = $usuario['id'] ?>
                                        <a href=<?= "desativar/$id" ?>><i class="fa fa-pencil"
                                                aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
</body>

</html>