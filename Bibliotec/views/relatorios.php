<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatórios e Estatísticas - LivraTec</title>
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
            <a class="nav-link collapsed" href="logout">
                <i class="bi bi-box-arrow-in-right"></i>
                <span>Logout</span>
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
                <a class="nav-link active" href="relatorios">
                    <i class="bi bi-graph-up"></i>
                    <span>Relatórios</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="listaLivro">
                    <i class="bi bi-book"></i>
                    <span>Livros</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="emprestimoA">
                    <i class="bi bi-list"></i>
                    <span>Empréstimos</span>
                </a>
            </li>
        </ul>
    </aside>

    <!-- Main Content -->
    <main id="main" class="main animate-fade-in">
        <div class="pagetitle">
            <h1><i class="bi bi-graph-up"></i> Relatórios e Estatísticas</h1>
            <p class="text-muted">Visualize dados e métricas do sistema</p>
        </div>

        <!-- Estatísticas Principais -->
        <section class="section">
            <div class="row">
                <!-- Total de Livros -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="stat-card animate-fade-in hover-scale">
                        <div class="stat-icon" style="background: linear-gradient(135deg, #4154f1, #717ff5);">
                            <i class="bi bi-book"></i>
                        </div>
                        <h3 class="stat-value"><?= $stats['total_livros'] ?? 0 ?></h3>
                        <p class="stat-label">Total de Livros</p>
                        <div class="progress-modern mt-2">
                            <div class="progress-bar-modern" style="width: 100%"></div>
                        </div>
                    </div>
                </div>

                <!-- Livros Disponíveis -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="stat-card animate-fade-in hover-scale" style="border-left-color: #28a745;">
                        <div class="stat-icon" style="background: linear-gradient(135deg, #28a745, #34ce57);">
                            <i class="bi bi-check-circle"></i>
                        </div>
                        <h3 class="stat-value"><?= $stats['livros_disponiveis'] ?? 0 ?></h3>
                        <p class="stat-label">Livros Disponíveis</p>
                        <div class="progress-modern mt-2">
                            <div class="progress-bar-modern" style="width: <?= ($stats['livros_disponiveis'] ?? 0) / max($stats['total_livros'] ?? 1, 1) * 100 ?>%; background: linear-gradient(90deg, #28a745, #34ce57);"></div>
                        </div>
                    </div>
                </div>

                <!-- Empréstimos Ativos -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="stat-card animate-fade-in hover-scale" style="border-left-color: #ffc107;">
                        <div class="stat-icon" style="background: linear-gradient(135deg, #ffc107, #ffdb4a);">
                            <i class="bi bi-hourglass-split"></i>
                        </div>
                        <h3 class="stat-value"><?= $stats['emprestimos_ativos'] ?? 0 ?></h3>
                        <p class="stat-label">Empréstimos Ativos</p>
                        <div class="progress-modern mt-2">
                            <div class="progress-bar-modern" style="width: <?= ($stats['emprestimos_ativos'] ?? 0) / max($stats['total_livros'] ?? 1, 1) * 100 ?>%; background: linear-gradient(90deg, #ffc107, #ffdb4a);"></div>
                        </div>
                    </div>
                </div>

                <!-- Usuários Ativos -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="stat-card animate-fade-in hover-scale" style="border-left-color: #17a2b8;">
                        <div class="stat-icon" style="background: linear-gradient(135deg, #17a2b8, #3dc2ff);">
                            <i class="bi bi-people"></i>
                        </div>
                        <h3 class="stat-value"><?= $stats['usuarios_ativos'] ?? 0 ?></h3>
                        <p class="stat-label">Usuários Ativos</p>
                        <div class="progress-modern mt-2">
                            <div class="progress-bar-modern" style="width: 100%; background: linear-gradient(90deg, #17a2b8, #3dc2ff);"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gráficos e Tabelas -->
            <div class="row mt-4">
                <!-- Livros por Categoria -->
                <div class="col-lg-6 mb-4">
                    <div class="card card-enhanced">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="bi bi-pie-chart"></i> Livros por Categoria
                            </h5>
                            <div class="table-responsive">
                                <table class="table table-modern">
                                    <thead>
                                        <tr>
                                            <th>Categoria</th>
                                            <th>Quantidade</th>
                                            <th>Porcentagem</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(isset($categorias) && count($categorias) > 0): ?>
                                            <?php foreach($categorias as $cat): ?>
                                                <tr>
                                                    <td><strong><?= htmlspecialchars($cat['categoria']) ?></strong></td>
                                                    <td><?= $cat['total'] ?></td>
                                                    <td>
                                                        <div class="progress-modern" style="height: 8px;">
                                                            <div class="progress-bar-modern" 
                                                                 style="width: <?= ($cat['total'] / $stats['total_livros']) * 100 ?>%">
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="3" class="text-center">Nenhuma categoria encontrada</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Top 5 Livros Mais Emprestados -->
                <div class="col-lg-6 mb-4">
                    <div class="card card-enhanced">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="bi bi-trophy"></i> Top 5 Livros Mais Emprestados
                            </h5>
                            <div class="table-responsive">
                                <table class="table table-modern">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Título</th>
                                            <th>Empréstimos</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(isset($top_livros) && count($top_livros) > 0): ?>
                                            <?php $pos = 1; foreach($top_livros as $livro): ?>
                                                <tr>
                                                    <td>
                                                        <span class="badge badge-modern" style="background: linear-gradient(135deg, #4154f1, #717ff5);">
                                                            <?= $pos++ ?>º
                                                        </span>
                                                    </td>
                                                    <td><strong><?= htmlspecialchars($livro['titulo']) ?></strong></td>
                                                    <td>
                                                        <span class="badge badge-status-emprestado">
                                                            <?= $livro['total_emprestimos'] ?> vezes
                                                        </span>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="3" class="text-center">Nenhum empréstimo registrado</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Empréstimos Recentes -->
            <div class="row mt-4">
                <div class="col-lg-12">
                    <div class="card card-enhanced">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="bi bi-clock-history"></i> Empréstimos Recentes
                            </h5>
                            <div class="table-responsive">
                                <table class="table table-modern">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Livro</th>
                                            <th>Usuário</th>
                                            <th>Data Empréstimo</th>
                                            <th>Data Devolução</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(isset($emprestimos_recentes) && count($emprestimos_recentes) > 0): ?>
                                            <?php foreach($emprestimos_recentes as $emp): ?>
                                                <tr>
                                                    <td><?= $emp['id'] ?></td>
                                                    <td><strong><?= htmlspecialchars($emp['titulo_livro']) ?></strong></td>
                                                    <td><?= htmlspecialchars($emp['nome_usuario']) ?></td>
                                                    <td><?= date('d/m/Y', strtotime($emp['data_emprestimo'])) ?></td>
                                                    <td>
                                                        <?= $emp['data_devolucao'] ? date('d/m/Y', strtotime($emp['data_devolucao'])) : 'Não devolvido' ?>
                                                    </td>
                                                    <td>
                                                        <?php if($emp['data_devolucao']): ?>
                                                            <span class="badge badge-status-disponivel">
                                                                <i class="bi bi-check-circle"></i> Devolvido
                                                            </span>
                                                        <?php else: ?>
                                                            <span class="badge badge-status-emprestado">
                                                                <i class="bi bi-hourglass-split"></i> Ativo
                                                            </span>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="6" class="text-center">Nenhum empréstimo encontrado</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botões de Ação -->
            <div class="row mt-4">
                <div class="col-lg-12">
                    <div class="card card-enhanced">
                        <div class="card-body text-center">
                            <h5 class="card-title"><i class="bi bi-download"></i> Exportar Dados</h5>
                            <p class="text-muted">Exporte os relatórios em diferentes formatos</p>
                            <button class="btn btn-primary-modern btn-modern me-2" onclick="showInfo('Funcionalidade em desenvolvimento')">
                                <i class="bi bi-file-pdf"></i> Exportar PDF
                            </button>
                            <button class="btn btn-success-modern btn-modern me-2" onclick="showInfo('Funcionalidade em desenvolvimento')">
                                <i class="bi bi-file-excel"></i> Exportar Excel
                            </button>
                            <button class="btn btn-modern" style="background: linear-gradient(135deg, #6c757d, #868e96); color: white;" 
                                    onclick="window.print()">
                                <i class="bi bi-printer"></i> Imprimir
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="views\support\js\notifications.js"></script>
</body>
</html>
