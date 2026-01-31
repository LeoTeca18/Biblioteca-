# 🤝 Guia de Contribuição - LivraTec

Obrigado por considerar contribuir com o LivraTec! Este documento fornece diretrizes para contribuições ao projeto.

---

## 📋 Índice

1. [Código de Conduta](#código-de-conduta)
2. [Como Posso Contribuir?](#como-posso-contribuir)
3. [Padrões de Código](#padrões-de-código)
4. [Processo de Pull Request](#processo-de-pull-request)
5. [Reportando Bugs](#reportando-bugs)
6. [Sugerindo Melhorias](#sugerindo-melhorias)

---

## 📜 Código de Conduta

### Nosso Compromisso

Estamos comprometidos em fornecer uma experiência acolhedora e inspiradora para todos.

### Comportamento Esperado

- ✅ Seja respeitoso e inclusivo
- ✅ Use linguagem acolhedora
- ✅ Aceite críticas construtivas
- ✅ Foque no que é melhor para a comunidade
- ✅ Mostre empatia

### Comportamento Inaceitável

- ❌ Linguagem ou imagens sexualizadas
- ❌ Comentários depreciativos ou ataques pessoais
- ❌ Assédio público ou privado
- ❌ Publicação de informações privadas de terceiros
- ❌ Conduta inadequada em contexto profissional

---

## 🚀 Como Posso Contribuir?

### 1. Reportando Bugs

Antes de criar um relatório de bug:
- Verifique se o bug já não foi reportado
- Teste na versão mais recente
- Colete informações sobre o ambiente

**Template de Bug Report:**

```markdown
**Descrição do Bug**
Descrição clara e concisa do bug.

**Passos para Reproduzir**
1. Vá para '...'
2. Clique em '...'
3. Role até '...'
4. Veja o erro

**Comportamento Esperado**
O que você esperava que acontecesse.

**Screenshots**
Se aplicável, adicione screenshots.

**Ambiente:**
- OS: [e.g. Windows 10]
- PHP: [e.g. 7.4]
- MySQL: [e.g. 5.7]
- Browser: [e.g. Chrome 90]

**Informações Adicionais**
Qualquer outro contexto relevante.
```

### 2. Sugerindo Melhorias

**Template de Feature Request:**

```markdown
**A melhoria está relacionada a um problema?**
Descrição clara do problema.

**Descreva a solução desejada**
Descrição clara da funcionalidade desejada.

**Descreva alternativas consideradas**
Outras soluções ou funcionalidades consideradas.

**Contexto adicional**
Screenshots, mockups, ou exemplos.
```

### 3. Contribuindo com Código

#### Tipos de Contribuições

- 🐛 Correção de bugs
- ✨ Novas funcionalidades
- 📝 Melhorias na documentação
- 🎨 Melhorias na interface
- ⚡ Otimizações de performance
- 🔒 Melhorias de segurança

---

## 💻 Padrões de Código

### PHP

Seguimos a **PSR-12** para código PHP.

#### Nomenclatura

```php
// Classes: PascalCase
class UsuarioController {}

// Métodos e funções: camelCase
public function buscarUsuario() {}

// Variáveis: snake_case ou camelCase
$usuario_id = 1;
$usuarioNome = "João";

// Constantes: UPPER_SNAKE_CASE
const MAX_USERS = 100;
```

#### Documentação

Use PHPDoc para todas as classes, métodos e propriedades:

```php
/**
 * Busca um usuário por ID
 * 
 * @param int $id ID do usuário
 * @return array|null Dados do usuário ou null
 * @throws PDOException Se houver erro no banco
 */
public function buscarPorId($id)
{
    // código
}
```

#### Boas Práticas PHP

```php
// ✅ BOM
if ($usuario === null) {
    return false;
}

// ❌ EVITAR
if ($usuario == null) {
    return false;
}

// ✅ BOM - Prepared Statements
$stmt = $pdo->prepare("SELECT * FROM usuario WHERE id = :id");
$stmt->execute(['id' => $id]);

// ❌ EVITAR - SQL direto
$sql = "SELECT * FROM usuario WHERE id = $id";
```

### HTML/CSS

#### HTML

```html
<!-- ✅ BOM: Semântico e bem indentado -->
<section class="container">
    <header class="page-header">
        <h1>Título</h1>
    </header>
    <article class="content">
        <p>Conteúdo</p>
    </article>
</section>

<!-- ❌ EVITAR: Divs genéricas -->
<div class="container">
    <div class="header">
        <div class="title">Título</div>
    </div>
</div>
```

#### CSS

```css
/* ✅ BOM: Classes semânticas, bem organizadas */
.user-card {
    display: flex;
    padding: 1rem;
    border-radius: 8px;
}

.user-card__title {
    font-size: 1.5rem;
    font-weight: 600;
}

/* ❌ EVITAR: IDs para estilo, !important */
#user1 {
    color: red !important;
}
```

### JavaScript

```javascript
// ✅ BOM: ES6+, const/let, arrow functions
const buscarUsuarios = async () => {
    try {
        const response = await fetch('/api/usuarios');
        const data = await response.json();
        return data;
    } catch (error) {
        console.error('Erro:', error);
    }
};

// ❌ EVITAR: var, funções antigas
var buscarUsuarios = function() {
    // código
}
```

### SQL

```sql
-- ✅ BOM: Maiúsculas para keywords, indentação
SELECT 
    u.id,
    u.nome,
    u.email,
    COUNT(e.id) as total_emprestimos
FROM usuario u
LEFT JOIN empresta e ON u.id = e.id_usuario
WHERE u.estado = 1
GROUP BY u.id
ORDER BY total_emprestimos DESC;

-- ❌ EVITAR: Tudo minúsculo, sem formatação
select u.id,u.nome from usuario u where u.estado=1;
```

---

## 🔄 Processo de Pull Request

### 1. Fork e Clone

```bash
# Fork o repositório no GitHub
# Clone seu fork
git clone https://github.com/seu-usuario/livratec.git
cd livratec

# Adicione o repositório original como upstream
git remote add upstream https://github.com/original/livratec.git
```

### 2. Crie uma Branch

```bash
# Atualize seu fork
git fetch upstream
git checkout main
git merge upstream/main

# Crie uma branch para sua feature
git checkout -b feature/nova-funcionalidade
# ou
git checkout -b fix/correcao-bug
```

### 3. Faça suas Mudanças

- Escreva código limpo e bem documentado
- Siga os padrões de código
- Teste suas mudanças
- Commit frequentemente com mensagens claras

### 4. Commit Conventions

Use **Conventional Commits**:

```bash
# Tipos de commit
feat:     Nova funcionalidade
fix:      Correção de bug
docs:     Mudanças na documentação
style:    Formatação, ponto e vírgula, etc
refactor: Refatoração de código
test:     Adição ou correção de testes
chore:    Atualizações de build, dependências

# Exemplos
git commit -m "feat: adiciona busca avançada de livros"
git commit -m "fix: corrige validação de email no login"
git commit -m "docs: atualiza README com novas instruções"
git commit -m "style: formata código conforme PSR-12"
```

### 5. Push e Pull Request

```bash
# Push para seu fork
git push origin feature/nova-funcionalidade

# Crie Pull Request no GitHub
# Preencha o template fornecido
```

### 6. Template de Pull Request

```markdown
## Descrição
Descrição clara das mudanças realizadas.

## Tipo de Mudança
- [ ] Bug fix (correção de problema)
- [ ] New feature (nova funcionalidade)
- [ ] Breaking change (mudança que quebra compatibilidade)
- [ ] Documentation update (atualização de documentação)

## Como Foi Testado?
Descreva os testes realizados.

## Checklist
- [ ] Código segue os padrões do projeto
- [ ] Código está documentado (PHPDoc)
- [ ] Mudanças foram testadas
- [ ] Não há warnings ou erros
- [ ] Documentação foi atualizada
- [ ] Commits seguem convenções

## Screenshots (se aplicável)
Cole screenshots aqui.

## Issues Relacionadas
Closes #123
```

---

## ✅ Checklist de Revisão

Antes de submeter um PR, verifique:

### Código
- [ ] Código segue PSR-12
- [ ] Variáveis e funções têm nomes descritivos
- [ ] Sem código comentado ou debug
- [ ] Sem console.log() ou var_dump()
- [ ] Tratamento adequado de erros

### Segurança
- [ ] Inputs são validados e sanitizados
- [ ] Queries usam prepared statements
- [ ] Sem exposição de informações sensíveis
- [ ] Headers de segurança configurados

### Documentação
- [ ] PHPDoc em todas as funções públicas
- [ ] README atualizado se necessário
- [ ] Comentários em código complexo
- [ ] CHANGELOG atualizado

### Testes
- [ ] Funcionalidade testada manualmente
- [ ] Casos extremos considerados
- [ ] Testes em diferentes navegadores
- [ ] Responsividade verificada

---

## 🎨 Contribuindo com Design

### Princípios de Design

1. **Consistência**: Use componentes e estilos existentes
2. **Acessibilidade**: Contraste, tamanhos, navegação por teclado
3. **Responsividade**: Mobile-first
4. **Performance**: Otimize imagens e assets
5. **Usabilidade**: Interface intuitiva

### Assets

- **Ícones**: Use Bootstrap Icons
- **Cores**: Defina no `:root` do CSS
- **Espaçamento**: Use múltiplos de 8px (0.5rem)
- **Tipografia**: Nunito para títulos, Open Sans para corpo

---

## 📚 Recursos

### Documentação
- [PHP PSR-12](https://www.php-fig.org/psr/psr-12/)
- [Conventional Commits](https://www.conventionalcommits.org/)
- [Keep a Changelog](https://keepachangelog.com/)

### Ferramentas
- [PHP CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer)
- [PHPStan](https://phpstan.org/)
- [ESLint](https://eslint.org/)

---

## 🙋 Dúvidas?

- Abra uma issue com a tag `question`
- Entre em contato: contribuir@livratec.com
- Consulte a [documentação](README.md)

---

## 🎉 Agradecimentos

Obrigado por contribuir com o LivraTec! Toda contribuição, grande ou pequena, é valiosa.

**Principais Contribuidores:**
- [Lista de contribuidores será atualizada]

---

**Mantido por**: Sistema LivraTec  
**Última Atualização**: 01/02/2026
