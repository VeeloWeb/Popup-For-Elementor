(function($) {
    $(document).ready(function() {
        console.log('[Popup Widget] Esperando iframe de Elementor...');

        const checkIframeAndShowModal = setInterval(() => {
            const iframe = document.getElementById('elementor-preview-iframe');
            if (!iframe || !iframe.contentDocument) return;

            const iframeDoc = iframe.contentDocument || iframe.contentWindow.document;
            const popupWidgets = iframeDoc.querySelectorAll('.popup-overlay.popup-widget');

            if (popupWidgets.length > 1 && !iframeDoc.querySelector('#popup-duplicate-warning')) {
                clearInterval(checkIframeAndShowModal);

                const modal = iframeDoc.createElement('div');
                modal.id = 'popup-duplicate-warning';
                modal.style.position = 'fixed';
                modal.style.top = '0';
                modal.style.left = '0';
                modal.style.width = '100vw';
                modal.style.height = '100vh';
                modal.style.backgroundColor = 'rgba(0,0,0,0.8)';
                modal.style.zIndex = '99999';
                modal.style.display = 'flex';
                modal.style.justifyContent = 'center';
                modal.style.alignItems = 'center';

                modal.innerHTML = `
                    <div style="background: #fff; max-width: 500px; width: 90%; padding: 30px; border-radius: 10px; text-align: center; box-shadow: 0 0 20px rgba(0,0,0,0.3);">
                        <h2 style="color: #c0392b; margin-bottom: 10px;">Error crítico</h2>
                        <p style="font-size: 16px; margin-bottom: 10px;"><strong>Solo se permite un popup por página.</strong></p>
                        <p style="font-size: 14px; color: #555;">Has añadido más de uno y esto puede romper el sitio. Elimina el popup duplicado antes de continuar.</p>
                        <button id="popup-modal-close" style="margin-top: 20px; padding: 10px 20px; background: #c0392b; color: #fff; border: none; border-radius: 5px; cursor: pointer;">
                            Entendido
                        </button>
                    </div>
                `;

                iframeDoc.body.appendChild(modal);

                const closeBtn = iframeDoc.getElementById('popup-modal-close');
                closeBtn.addEventListener('click', () => {
                    modal.remove();
                });
            }
        }, 1000);
    });
})(jQuery);
