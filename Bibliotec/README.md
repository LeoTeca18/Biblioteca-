# 📚 LivraTec - Sistema de Gestão de Biblioteca v2.0

![Status](https://img.shields.io/badge/Status-Ativo-success)
![Versão](https://img.shields.io/badge/Versão-2.0-blue)
![PHP](https://img.shields.io/badge/PHP-7.4+-purple)
![MySQL](https://img.shields.io/badge/MySQL-5.7+-orange)

Sistema completo de gestão de biblioteca desenvolvido em PHP com arquitetura MVC, incluindo controle de livros, usuários e empréstimos, com interface moderna e responsiva.

---

## 📋 Índice

- [Sobre o Projeto](#sobre-o-projeto)
- [Funcionalidades](#funcionalidades)
- [Tecnologias Utilizadas](#tecnologias-utilizadas)
- [Pré-requisitos](#pré-requisitos)
- [Instalação](#instalação)
- [Estrutura do Projeto](#estrutura-do-projeto)
- [Arquitetura](#arquitetura)
- [Uso](#uso)
- [Novidades da Versão 2.0](#novidades-da-versão-20)
- [Documentação](#documentação)
- [Contribuindo](#contribuindo)
- [Licença](#licença)

---

## 🎯 Sobre o Projeto

O **LivraTec** é um sistema de gerenciamento de biblioteca que oferece uma solução completa para controle de acervo, empréstimos, usuários e relatórios. Desenvolvido com foco em usabilidade, segurança e manutenibilidade.

### Objetivos

- Facilitar o gerenciamento de livros e empréstimos
- Proporcionar interface intuitiva para administradores e usuários
- Gerar relatórios e estatísticas detalhadas
- Garantir segurança no acesso e manipulação de dados

---

## ✨ Funcionalidades

### 📖 Gerenciamento de Livros
- ✅ Cadastro de livros com informações completas (título, autor, categoria, editora, descrição)
- ✅ Edição e exclusão de livros
- ✅ Listagem com filtros e ordenação
- ✅ Busca avançada com múltiplos critérios
- ✅ Controle de disponibilidade (disponível/emprestado)

### 👥 Gerenciamento de Usuários
- ✅ Cadastro de novos usuários
- ✅ Sistema de autenticação seguro
- ✅ Ativação e desativação de contas
- ✅ Controle de permissões (administrador/cliente)
- ✅ Listagem e busca de usuários

### 📚 Sistema de Empréstimos
- ✅ Registro de empréstimos
- ✅ Controle de devoluções
- ✅ Histórico de empréstimos por usuário
- ✅ Listagem de empréstimos ativos
- ✅ Validações automáticas

### 📊 Relatórios e Estatísticas
- ✅ Dashboard com métricas principais
- ✅ Estatísticas de livros por categoria
- ✅ Top 5 livros mais emprestados
- ✅ Empréstimos recentes
- ✅ Exportação de dados (funcionalidade planejada)

### 🔍 Busca Avançada
- ✅ Filtros por título, autor, categoria, editora
- ✅ Filtro por status (disponível/emprestado)
- ✅ Resultados paginados e organizados

### 🔔 Sistema de Notificações
- ✅ Notificações toast animadas
- ✅ Feedback visual para todas as operações
- ✅ Mensagens de sucesso, erro e aviso
- ✅ Auto-fechamento configurável

---

## 🛠️ Tecnologias Utilizadas

### Backend
- **PHP 7.4+** - Linguagem principal
- **MySQL 5.7+** - Banco de dados
- **PDO** - Acesso seguro ao banco de dados
- **Sessions** - Gerenciamento de sessões

### Frontend
- **HTML5** - Estrutura
- **CSS3** - Estilização
- **Bootstrap 5.3** - Framework CSS
- **Bootstrap Icons** - Ícones
- **JavaScript ES6+** - Interatividade
- **Animações CSS** - Transições e efeitos

### Arquitetura
- **MVC (Model-View-Controller)** - Padrão arquitetural
- **DAO (Data Access Object)** - Acesso a dados
- **DTO (Data Transfer Object)** - Transferência de dados
- **Autoloading** - Carregamento automático de classes

---

## 📦 Pré-requisitos

Antes de começar, certifique-se de ter instalado:

- **PHP 7.4 ou superior**
- **MySQL 5.7 ou superior** / MariaDB
- **Apache** (ou outro servidor web com suporte a PHP)
- **Composer** (opcional, para dependências futuras)

### Extensões PHP Necessárias
- `pdo_mysql`
- `mysqli`
- `session`
- `json`

---

## 🚀 Instalação

### 1. Clone o Repositório

```bash
git clone https://github.com/seu-usuario/livratec.git
cd livratec
```

### 2. Configure o Banco de Dados

Crie um banco de dados MySQL:

```sql
CREATE DATABASE biblioteca CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE biblioteca;
```

Execute o script SQL para criar as tabelas:

```sql
-- Tabela de usuários
CREATE TABLE usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    estado TINYINT DEFAULT 1,
    adm TINYINT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabela de livros
CREATE TABLE livro (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(200) NOT NULL,
    autor VARCHAR(100) NOT NULL,
    categoria VARCHAR(50),
    editora VARCHAR(100),
    descricao TEXT,
    emprestado TINYINT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabela de empréstimos
CREATE TABLE empresta (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_livro INT NOT NULL,
    id_usuario INT NOT NULL,
    data_emprestimo DATETIME NOT NULL,
    data_devolucao DATETIME,
    FOREIGN KEY (id_livro) REFERENCES livro(id) ON DELETE CASCADE,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id) ON DELETE CASCADE,
    INDEX idx_emprestimo (data_emprestimo),
    INDEX idx_devolucao (data_devolucao)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

### 3. Configure a Conexão

Edite o arquivo `models/Connect/Database.php`:

```php
$hostname = "localhost";      // Seu host
$db_name = "biblioteca";      // Nome do banco
$username = "root";           // Usuário do MySQL
$password = "";               // Senha do MySQL
```

### 4. Configure o Servidor

#### Usando Apache

Coloque o projeto na pasta `htdocs` (XAMPP/WAMP) ou configure um Virtual Host:

```apache
<VirtualHost *:80>
    ServerName livratec.local
    DocumentRoot "C:/caminho/para/Bibliotec"
    <Directory "C:/caminho/para/Bibliotec">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

#### Usando PHP Built-in Server (Desenvolvimento)

```bash
cd Bibliotec
php -S localhost:8000
```

### 5. Crie um Usuário Administrador

Insira manualmente um usuário admin no banco:

```sql
INSERT INTO usuario (nome, email, senha, estado, adm) 
VALUES ('Administrador', 'admin@livratec.com', 'admin123', 1, 1);
```

⚠️ **Nota de Segurança**: Em produção, use sempre senhas criptografadas com `password_hash()`.

### 6. Acesse o Sistema

Abra o navegador e acesse:
- **http://localhost/Bibliotec** (Apache)
- **http://localhost:8000** (PHP Built-in)

---

## 📁 Estrutura do Projeto

```
Bibliotec/
│
├── index.php                  # Ponto de entrada da aplicação
│
├── core/
│   └── core.php              # Núcleo do sistema (roteamento)
│
├── routes/
│   └── routes.php            # Definição de rotas
│
├── controllers/              # Controladores MVC
│   ├── HomeController.php
│   ├── UsuarioController.php
│   ├── LivroController.php
│   ├── EmprestaController.php
│   └── NotFoundController.php
│
├── models/
│   ├── Connect/
│   │   └── Database.php      # Conexão com banco de dados
│   ├── DAO/                  # Data Access Objects
│   │   ├── usuario/
│   │   │   └── UsuarioDAO.php
│   │   ├── livro/
│   │   │   └── LivroDAO.php
│   │   └── empresta/
│   │       └── EmprestaDAO.php
│   └── DTO/                  # Data Transfer Objects
│       ├── usuario/
│       │   └── UsuarioDTO.php
│       ├── livro/
│       │   └── LivroDTO.php
│       └── empresta/
│           └── EmprestaDTO.php
│
├── views/                    # Visualizações (páginas)
│   ├── home.php
│   ├── login.php
│   ├── dashboard.php
│   ├── buscaAvancada.php
│   ├── relatorios.php
│   ├── listaLivro.php
│   ├── adicionarLivro.php
│   └── support/
│       ├── css/
│       │   ├── style.css
│       │   ├── custom-improvements.css
│       │   └── bootstrap.min.css
│       └── js/
│           └── notifications.js
│
└── utils/
    └── RenderViews.php       # Utilitário para renderização
```

---

## 🏗️ Arquitetura

### Padrão MVC

O sistema segue o padrão **Model-View-Controller**:

#### **Model** 
Responsável pela lógica de negócios e acesso a dados.
- **DAO** (Data Access Object): Operações no banco de dados
- **DTO** (Data Transfer Object): Estrutura de dados

#### **View**
Interface do usuário (HTML/CSS/JS).

#### **Controller**
Gerencia a lógica da aplicação e faz a ponte entre Model e View.

### Fluxo de Requisição

```
Usuário → index.php → Core (Roteamento) → Controller → Model (DAO) → Database
                                              ↓
                                          View (Renderização)
                                              ↓
                                          Resposta
```

### Segurança

- ✅ Prepared Statements (PDO) contra SQL Injection
- ✅ Sanitização de entradas
- ✅ Validação de dados
- ✅ Controle de sessões
- ✅ Proteção de rotas

---

## 💻 Uso

### Acessando o Sistema

1. **Página Inicial**: Apresentação do sistema
2. **Login**: Autenticação de usuários
3. **Dashboard**: Painel administrativo

### Perfis de Acesso

#### Administrador
- Gerenciar livros (CRUD completo)
- Gerenciar usuários
- Visualizar relatórios
- Gerenciar empréstimos

#### Cliente
- Visualizar livros disponíveis
- Solicitar empréstimos
- Ver histórico pessoal

### Exemplos de Uso

#### Cadastrar um Livro

1. Acesse **Dashboard > Adicionar Livro**
2. Preencha os campos obrigatórios
3. Clique em **Salvar**
4. O livro será adicionado ao sistema

#### Realizar um Empréstimo

1. Acesse a lista de livros disponíveis
2. Clique no botão de empréstimo
3. Confirme a operação
4. O livro será marcado como emprestado

#### Busca Avançada

1. Acesse **Busca Avançada**
2. Preencha os filtros desejados
3. Clique em **Buscar**
4. Visualize os resultados

---

## 🆕 Novidades da Versão 2.0

### Melhorias de Interface
- ✨ CSS moderno com variáveis customizáveis
- ✨ Animações suaves e transições
- ✨ Design responsivo aprimorado
- ✨ Cards e tabelas com efeitos hover
- ✨ Sistema de cores consistente

### Novas Funcionalidades
- 🔍 Sistema de busca avançada com múltiplos filtros
- 📊 Página de relatórios e estatísticas completa
- 🔔 Sistema de notificações toast animadas
- 📈 Dashboard com métricas em tempo real
- 🎨 Tema visual modernizado

### Melhorias Técnicas
- 📝 Documentação completa do código com PHPDoc
- 🔒 Validações de segurança aprimoradas
- 🛡️ Sanitização de inputs
- ⚡ Otimizações de performance
- 🗃️ Queries SQL otimizadas

### Documentação
- 📖 README completo
- 💡 Comentários inline detalhados
- 🔧 Guia de instalação passo a passo
- 📚 Documentação de APIs internas

---

## 📚 Documentação

### Classes Principais

#### Database
```php
/**
 * Gerencia a conexão com o banco de dados
 * @return PDO Conexão PDO
 */
public static function getConnection()
```

#### LivroDAO
```php
/**
 * Busca avançada de livros
 * @param array $filtros Filtros de busca
 * @return array Livros encontrados
 */
public function advancedSearch($filtros)
```

#### UsuarioController
```php
/**
 * Processa o login do usuário
 * @return void
 */
public function login()
```

### Rotas Disponíveis

| Rota | Controller | Método | Descrição |
|------|-----------|--------|-----------|
| `/` | HomeController | index | Página inicial |
| `/login` | UsuarioController | login | Login |
| `/dashboard` | UsuarioController | dashboard | Dashboard |
| `/buscaAvancada` | LivroController | buscaAvancada | Busca avançada |
| `/relatorios` | UsuarioController | relatorios | Relatórios |
| `/listaLivro` | LivroController | buscar | Lista de livros |

---

## 🤝 Contribuindo

Contribuições são sempre bem-vindas!

1. Faça um Fork do projeto
2. Crie uma Branch para sua feature (`git checkout -b feature/NovaFuncionalidade`)
3. Commit suas mudanças (`git commit -m 'Adiciona nova funcionalidade'`)
4. Push para a Branch (`git push origin feature/NovaFuncionalidade`)
5. Abra um Pull Request

### Padrões de Código

- Use PHPDoc para documentar funções e classes
- Siga PSR-12 para código PHP
- Mantenha a consistência no estilo
- Escreva código legível e bem comentado

---

## 📝 Licença

Este projeto está sob a licença MIT. Veja o arquivo `LICENSE` para mais detalhes.

---

## 👨‍💻 Autores

**Sistema LivraTec**
- Versão 2.0 desenvolvida em Fevereiro de 2026

---

## 📞 Suporte

Para suporte, envie um email para suporte@livratec.com ou abra uma issue no GitHub.

---

## 🔄 Atualizações Futuras

- [ ] Exportação de relatórios em PDF/Excel
- [ ] Sistema de multas por atraso
- [ ] Reserva de livros
- [ ] Notificações por email
- [ ] API RESTful
- [ ] Aplicativo mobile
- [ ] Integração com código de barras
- [ ] Chat de suporte

---

## 🙏 Agradecimentos

- Bootstrap Team pelo framework CSS
- Comunidade PHP
- Todos os contribuidores

---

<div align="center">

**📚 LivraTec v2.0 - Gestão Inteligente de Bibliotecas**

Desenvolvido com ❤️ em PHP

</div>
