(() => {
    'use strict';

    function handleConfirmDelete(event) {
        const deleteLink = event.target.closest('[data-action="confirm-delete"]');
        if (!deleteLink) {
            return;
        }
        event.preventDefault();
        const row = deleteLink.closest('tr');
        const contactName = row?.cells[0]?.textContent?.trim() || 'este contato';
        const message = `Tem certeza que deseja excluir "${contactName}"?`;
        if (confirm(message)) {
            window.location.href = deleteLink.href;
        }
    }

    function initialize() {
        document.body.addEventListener('click', handleConfirmDelete);
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initialize);
    } else {
        initialize();
    }
})();
