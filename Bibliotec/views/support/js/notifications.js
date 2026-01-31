/**
 * Sistema de Notificações - LivraTec v2.0
 * 
 * Biblioteca JavaScript para exibir notificações toast
 * no sistema de biblioteca.
 * 
 * @author Sistema LivraTec
 * @version 2.0
 * @since 2026-02-01
 */

class NotificationSystem {
    constructor() {
        this.container = this.createContainer();
        this.init();
    }

    /**
     * Inicializa o sistema de notificações
     */
    init() {
        // Adiciona o container ao body se ainda não existir
        if (!document.getElementById('notification-container')) {
            document.body.appendChild(this.container);
        }

        // Verifica parâmetros da URL para mostrar notificações automáticas
        this.checkUrlParams();
    }

    /**
     * Cria o container de notificações
     */
    createContainer() {
        const container = document.createElement('div');
        container.id = 'notification-container';
        container.style.cssText = `
            position: fixed;
            top: 80px;
            right: 20px;
            z-index: 9999;
            width: 350px;
        `;
        return container;
    }

    /**
     * Verifica parâmetros da URL e exibe notificações
     */
    checkUrlParams() {
        const urlParams = new URLSearchParams(window.location.search);

        if (urlParams.has('sucesso')) {
            const message = this.getSuccessMessage(urlParams.get('sucesso'));
            this.success(message);
        }

        if (urlParams.has('erro')) {
            const message = this.getErrorMessage(urlParams.get('erro'));
            this.error(message);
        }

        if (urlParams.has('aviso')) {
            const message = this.getWarningMessage(urlParams.get('aviso'));
            this.warning(message);
        }
    }

    /**
     * Obtém mensagem de sucesso baseada no código
     */
    getSuccessMessage(code) {
        const messages = {
            'livro_adicionado': 'Livro adicionado com sucesso!',
            'livro_atualizado': 'Livro atualizado com sucesso!',
            'livro_removido': 'Livro removido com sucesso!',
            'livro_emprestado': 'Empréstimo realizado com sucesso!',
            'livro_devolvido': 'Devolução realizada com sucesso!',
            'usuario_cadastrado': 'Usuário cadastrado com sucesso!',
            'usuario_atualizado': 'Usuário atualizado com sucesso!',
            'login_realizado': 'Login realizado com sucesso!'
        };
        return messages[code] || 'Operação realizada com sucesso!';
    }

    /**
     * Obtém mensagem de erro baseada no código
     */
    getErrorMessage(code) {
        const messages = {
            'campos_obrigatorios': 'Preencha todos os campos obrigatórios!',
            'email_invalido': 'Email inválido!',
            'senha_incorreta': 'Senha incorreta!',
            'usuario_nao_encontrado': 'Usuário não encontrado!',
            'livro_nao_encontrado': 'Livro não encontrado!',
            'id_invalido': 'ID inválido!',
            'erro_banco': 'Erro ao conectar com o banco de dados!'
        };
        return messages[code] || 'Ocorreu um erro na operação!';
    }

    /**
     * Obtém mensagem de aviso baseada no código
     */
    getWarningMessage(code) {
        const messages = {
            'livro_ja_emprestado': 'Este livro já está emprestado!',
            'usuario_desativado': 'Este usuário está desativado!',
            'emprestimo_atrasado': 'Este empréstimo está atrasado!'
        };
        return messages[code] || 'Atenção!';
    }

    /**
     * Exibe notificação de sucesso
     */
    success(message, duration = 5000) {
        this.show(message, 'success', duration);
    }

    /**
     * Exibe notificação de erro
     */
    error(message, duration = 5000) {
        this.show(message, 'error', duration);
    }

    /**
     * Exibe notificação de aviso
     */
    warning(message, duration = 5000) {
        this.show(message, 'warning', duration);
    }

    /**
     * Exibe notificação de informação
     */
    info(message, duration = 5000) {
        this.show(message, 'info', duration);
    }

    /**
     * Exibe uma notificação
     */
    show(message, type = 'info', duration = 5000) {
        const notification = this.createNotification(message, type);
        this.container.appendChild(notification);

        // Animação de entrada
        setTimeout(() => {
            notification.style.transform = 'translateX(0)';
            notification.style.opacity = '1';
        }, 10);

        // Remove após o tempo especificado
        if (duration > 0) {
            setTimeout(() => {
                this.remove(notification);
            }, duration);
        }
    }

    /**
     * Cria o elemento de notificação
     */
    createNotification(message, type) {
        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;

        const icons = {
            success: 'bi-check-circle-fill',
            error: 'bi-x-circle-fill',
            warning: 'bi-exclamation-triangle-fill',
            info: 'bi-info-circle-fill'
        };

        const colors = {
            success: 'linear-gradient(135deg, #28a745, #34ce57)',
            error: 'linear-gradient(135deg, #dc3545, #ff4757)',
            warning: 'linear-gradient(135deg, #ffc107, #ffdb4a)',
            info: 'linear-gradient(135deg, #17a2b8, #3dc2ff)'
        };

        notification.style.cssText = `
            background: ${colors[type]};
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            margin-bottom: 1rem;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.16);
            display: flex;
            align-items: center;
            gap: 1rem;
            transform: translateX(400px);
            opacity: 0;
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        `;

        notification.innerHTML = `
            <i class="bi ${icons[type]}" style="font-size: 1.5rem;"></i>
            <span style="flex: 1; font-weight: 500;">${message}</span>
            <i class="bi bi-x" style="font-size: 1.2rem; cursor: pointer;"></i>
        `;

        // Adiciona progress bar
        const progressBar = document.createElement('div');
        progressBar.style.cssText = `
            position: absolute;
            bottom: 0;
            left: 0;
            height: 3px;
            background: rgba(255, 255, 255, 0.5);
            width: 100%;
            animation: progress 5s linear;
        `;
        notification.appendChild(progressBar);

        // Evento de clique para fechar
        notification.querySelector('.bi-x').addEventListener('click', (e) => {
            e.stopPropagation();
            this.remove(notification);
        });

        return notification;
    }

    /**
     * Remove uma notificação
     */
    remove(notification) {
        notification.style.transform = 'translateX(400px)';
        notification.style.opacity = '0';

        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 300);
    }

    /**
     * Remove todas as notificações
     */
    clearAll() {
        const notifications = this.container.querySelectorAll('.notification');
        notifications.forEach(notification => this.remove(notification));
    }
}

// Adiciona animação CSS para progress bar
const style = document.createElement('style');
style.textContent = `
    @keyframes progress {
        from { width: 100%; }
        to { width: 0%; }
    }
`;
document.head.appendChild(style);

// Inicializa o sistema globalmente
window.notifications = new NotificationSystem();

// Funções de atalho globais
window.showSuccess = (message, duration) => window.notifications.success(message, duration);
window.showError = (message, duration) => window.notifications.error(message, duration);
window.showWarning = (message, duration) => window.notifications.warning(message, duration);
window.showInfo = (message, duration) => window.notifications.info(message, duration);
