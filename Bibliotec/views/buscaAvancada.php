<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Busca Avançada - LivraTec</title>
    <link href="views\support\css\bootstrap.min.css" rel="stylesheet">
    <link href="views\support\css\bootstrap-icons.css" rel="stylesheet">
    <link href="views\support\css\style.css" rel="stylesheet">
    <link href="views\support\css\custom-improvements.css" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a href="dashboard" class="logo d-flex align-items-center">
                <span class="d-none d-lg-block">LivraTec</span>
            </a>
        </div>
    </header>

    <!-- Sidebar -->
    <aside id="sidebar" class="sidebar sidebar-modern">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link" href="dashboard">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="buscaAvancada">
                    <i class="bi bi-search"></i>
                    <span>Busca Avançada</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="listaLivro">
                    <i class="bi bi-book"></i>
                    <span>Todos os Livros</span>
                </a>
            </li>
        </ul>
    </aside>

    <!-- Main Content -->
    <main id="main" class="main animate-fade-in">
        <div class="pagetitle">
            <h1><i class="bi bi-search"></i> Busca Avançada de Livros</h1>
            <p class="text-muted">Utilize os filtros abaixo para encontrar o livro desejado</p>
        </div>

        <!-- Formulário de Busca Avançada -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-enhanced">
                        <div class="card-body">
                            <h5 class="card-title"><i class="bi bi-funnel"></i> Filtros de Busca</h5>
                            
                            <form id="advancedSearchForm" method="GET" action="buscaAvancada">
                                <div class="row g-3">
                                    <!-- Título -->
                                    <div class="col-md-6">
                                        <label class="form-label-modern">
                                            <i class="bi bi-bookmark"></i> Título do Livro
                                        </label>
                                        <input type="text" name="titulo" class="form-control form-control-modern" 
                                               placeholder="Digite o título..." value="<?= $_GET['titulo'] ?? '' ?>">
                                    </div>

                                    <!-- Autor -->
                                    <div class="col-md-6">
                                        <label class="form-label-modern">
                                            <i class="bi bi-person"></i> Autor
                                        </label>
                                        <input type="text" name="autor" class="form-control form-control-modern" 
                                               placeholder="Digite o nome do autor..." value="<?= $_GET['autor'] ?? '' ?>">
                                    </div>

                                    <!-- Categoria -->
                                    <div class="col-md-6">
                                        <label class="form-label-modern">
                                            <i class="bi bi-tag"></i> Categoria
                                        </label>
                                        <select name="categoria" class="form-control form-control-modern">
                                            <option value="">Todas as categorias</option>
                                            <option value="Romance">Romance</option>
                                            <option value="Ficção">Ficção</option>
                                            <option value="Técnico">Técnico</option>
                                            <option value="História">História</option>
                                            <option value="Ciência">Ciência</option>
                                            <option value="Fantasia">Fantasia</option>
                                            <option value="Biografia">Biografia</option>
                                        </select>
                                    </div>

                                    <!-- Editora -->
                                    <div class="col-md-6">
                                        <label class="form-label-modern">
                                            <i class="bi bi-building"></i> Editora
                                        </label>
                                        <input type="text" name="editora" class="form-control form-control-modern" 
                                               placeholder="Digite a editora..." value="<?= $_GET['editora'] ?? '' ?>">
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-6">
                                        <label class="form-label-modern">
                                            <i class="bi bi-info-circle"></i> Status
                                        </label>
                                        <select name="status" class="form-control form-control-modern">
                                            <option value="">Todos</option>
                                            <option value="0">Disponível</option>
                                            <option value="1">Emprestado</option>
                                        </select>
                                    </div>

                                    <!-- Botões -->
                                    <div class="col-md-12 mt-4">
                                        <button type="submit" class="btn btn-primary-modern btn-modern">
                                            <i class="bi bi-search"></i> Buscar
                                        </button>
                                        <button type="reset" class="btn btn-secondary btn-modern ms-2" onclick="window.location.href='buscaAvancada'">
                                            <i class="bi bi-arrow-clockwise"></i> Limpar Filtros
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Resultados da Busca -->
            <div class="row mt-4">
                <div class="col-lg-12">
                    <div class="card card-enhanced">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="bi bi-list-ul"></i> Resultados da Busca
                                <?php if(isset($livros) && count($livros) > 0): ?>
                                    <span class="badge badge-modern badge-status-disponivel ms-2">
                                        <?= count($livros) ?> livro(s) encontrado(s)
                                    </span>
                                <?php endif; ?>
                            </h5>

                            <?php if(isset($livros) && count($livros) > 0): ?>
                                <div class="table-responsive">
                                    <table class="table table-modern">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Título</th>
                                                <th>Autor</th>
                                                <th>Categoria</th>
                                                <th>Editora</th>
                                                <th>Status</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($livros as $livro): ?>
                                                <tr class="animate-slide-in">
                                                    <td><?= $livro['id'] ?></td>
                                                    <td><strong><?= htmlspecialchars($livro['titulo']) ?></strong></td>
                                                    <td><?= htmlspecialchars($livro['autor']) ?></td>
                                                    <td><span class="badge bg-info"><?= htmlspecialchars($livro['categoria']) ?></span></td>
                                                    <td><?= htmlspecialchars($livro['editora']) ?></td>
                                                    <td>
                                                        <?php if($livro['emprestado'] == 0): ?>
                                                            <span class="badge badge-modern badge-status-disponivel">
                                                                <i class="bi bi-check-circle"></i> Disponível
                                                            </span>
                                                        <?php else: ?>
                                                            <span class="badge badge-modern badge-status-emprestado">
                                                                <i class="bi bi-hourglass-split"></i> Emprestado
                                                            </span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <a href="editarLivro?id=<?= $livro['id'] ?>" class="btn btn-sm btn-primary-modern">
                                                            <i class="bi bi-pencil"></i>
                                                        </a>
                                                        <?php if($livro['emprestado'] == 0): ?>
                                                            <a href="emprestar?id=<?= $livro['id'] ?>" class="btn btn-sm btn-success-modern">
                                                                <i class="bi bi-arrow-right-circle"></i>
                                                            </a>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php elseif(isset($_GET['titulo']) || isset($_GET['autor']) || isset($_GET['categoria']) || isset($_GET['editora'])): ?>
                                <div class="alert alert-info-modern">
                                    <i class="bi bi-info-circle-fill"></i>
                                    <div>
                                        <strong>Nenhum resultado encontrado</strong>
                                        <p class="mb-0">Tente utilizar filtros diferentes ou menos específicos.</p>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="alert alert-warning-modern">
                                    <i class="bi bi-lightbulb-fill"></i>
                                    <div>
                                        <strong>Utilize os filtros acima</strong>
                                        <p class="mb-0">Preencha um ou mais campos para realizar a busca.</p>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
