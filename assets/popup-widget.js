(function ($) {
    $(document).ready(function () {
        const config = PopupForElementorConfig; 
        const cookieName = config.cookieName || 'popup_seen'; 
        const cookieExpiry = parseInt(config.cookieExpiry, 10) || 7; 
        const delayInMilliseconds = parseInt(config.delay, 10) || 0; 
        const isSelectorMode = (config.triggerBySelector === 'yes' && config.triggerSelector && config.triggerSelector.trim() !== '');

        let isClosing = false; 
        let popupOpenedAt = 0;   // marca de última apertura (ms)
        let lastExitTs = 0;      // anti-rebote de exit-intent (ms)
        const EXIT_COOLDOWN_MS = 1200;
        
        const $popupOverlay = $('.popup-overlay');
        const $popupContent = $popupOverlay.find('.popup-content');

        if (!$popupOverlay.length) {
            return;
        }

        console.log("PopupForElementorConfig:", config);
        function setCookie(name, value, days) {
            const expires = new Date(Date.now() + days * 24 * 60 * 60 * 1000).toUTCString();
            document.cookie = `${name}=${value}; expires=${expires}; path=/`;
            console.log(`Cookie "${name}" set for ${days} days.`);
        }

        function getCookie(name) {
            const cookies = document.cookie.split(';').map(c => c.trim());
            for (const cookie of cookies) {
                if (cookie.startsWith(`${name}=`)) {
                    return cookie.split('=')[1];
                }
            }
            return null;
        }

        function showPopup() {
            if (isClosing) return;

            if (config.showOnce === 'yes') {
                const cookieValue = getCookie(cookieName);
                console.log(`Checking cookie "${cookieName}":`, cookieValue);
                if (cookieValue) {
                    console.log("Popup already shown. Skipping.");
                    return; 
                }
            }

            console.log("Showing popup.");
            popupOpenedAt = Date.now();
            $popupOverlay.css({
                display: 'flex',
                visibility: 'visible',
                opacity: 1,
            });

            $popupContent.removeClass('animate__fadeOut').addClass('animate__fadeIn');

            if (config.showOnce === 'yes') {
                setCookie(cookieName, 'true', cookieExpiry);
            }
        }

        function closePopup() {
            console.log("Attempting to close popup...");
        
            if (popupOpenedAt && (Date.now() - popupOpenedAt) < 250) {
                console.log("Close ignored due to debounce after open.");
                return;
            }
        
            if (isClosing) {
                console.log("Popup is already closing. Aborting.");
                return;
            }
        
            isClosing = true;
            console.log("Closing popup...");
        
            let handled = false;
            $popupContent
                .removeClass('animate__fadeIn')
                .addClass('animate__fadeOut')
                .one('animationend', function (e) {
                    if (handled) return;
                    if (e.target !== this) return; 
                    handled = true;
        
                    console.log("Fade-out animation ended. Hiding popup.");
                    $popupOverlay.css({
                        display: 'none',
                        visibility: 'hidden',
                        opacity: 0,
                    });
                    $popupContent.removeClass('animate__fadeOut');
                    isClosing = false;
                    console.log("Popup closed successfully.");
                });
        
            setTimeout(() => {
                if (!handled) {
                    console.warn("Fallback triggered: Forcing popup closure.");
                    handled = true;
                    $popupOverlay.css({
                        display: 'none',
                        visibility: 'hidden',
                        opacity: 0,
                    });
                    $popupContent.removeClass('animate__fadeOut');
                    isClosing = false;
                }
            }, 700); 
        }
        

        function handlePopupDisplay() {
            console.log("Entrando en la lógica de visibilidad...");
            if (config.showOnLoad === 'yes') {
                console.log("onLoad habilitado.");
                setTimeout(() => {
                    console.log("Mostrando popup con onLoad.");
                    showPopup();
                }, delayInMilliseconds);
            }
            else if (delayInMilliseconds > 0) {
                console.log(`Delay habilitado. Mostrando popup después de ${delayInMilliseconds} ms.`);
                setTimeout(() => {
                    console.log("Mostrando popup después del delay.");
                    showPopup();
                }, delayInMilliseconds);
            }
            else if (config.showOnce === 'yes') {
                console.log("Show Once habilitado. Verificando cookies...");
                showPopup();
            } else {
                console.log("Ningún método de visibilidad habilitado. Popup no se mostrará.");
            }
        }

        if (config.exitIntent === 'yes') {
            console.log("IntentExit habilitado.");
        
            $(document).on('mouseleave', function (e) {
                const now = Date.now();
                const nearTop = (e.clientY <= 0 || e.clientY <= 20);
                const leavingWindow = (e.relatedTarget === null);
        
                console.log(`Intento de salida: clientY=${e.clientY}, nearTop=${nearTop}, leaving=${leavingWindow}`);
        
                if (config.exitIntentDisplayMode === 'once' && getCookie(cookieName)) {
                    console.log('ExitIntent en modo "once" y cookie presente. No se muestra.');
                    return;
                }
        
                if (isClosing || (popupOpenedAt && (now - popupOpenedAt) < 250)) {
                    console.log('Ignorado: está cerrando o se acaba de abrir.');
                    return;
                }
        
                if (now - lastExitTs < EXIT_COOLDOWN_MS) {
                    console.log('Cooldown activo. Ignorando ExitIntent repetido.');
                    return;
                }
        
                if (nearTop || leavingWindow) {
                    lastExitTs = now;
                    console.log("Mostrando popup por IntentExit.");
                    showPopup();
        
                    if (config.exitIntentDisplayMode === 'once') {
                        setCookie(cookieName, 'true', cookieExpiry);
                        console.log(`Cookie "${cookieName}" marcada por ExitIntent durante ${cookieExpiry} días.`);
                    }
                }
            });
        } else {
            console.log("IntentExit no habilitado.");
        }


        $popupOverlay.on('click', function (e) {
            if ($(e.target).is($popupOverlay)) {
                console.log("Overlay clicado. Cerrando popup...");
                closePopup();
            }
        });

        $(document).on('keydown', function (e) {
            if (e.key === 'Escape' || e.keyCode === 27) {
                console.log("Tecla Escape detectada. Cerrando popup...");
                closePopup();
            }
        });

        if (isSelectorMode) {
            const raw = config.triggerSelector.trim();
            const selector = /^[.#]/.test(raw) ? raw : ('.' + raw);
            $(document).off('click.popupfeSelector');
            console.log('[PopupFE] Trigger por selector activo →', selector, '| matches:', document.querySelectorAll(selector).length);
            $(document).on('click.popupfeSelector', selector, function(e){
              if ($popupOverlay.is(':visible') || isClosing) return;
              showPopup();
            });
          }

    
            handlePopupDisplay();
        });
    })(jQuery);
    
