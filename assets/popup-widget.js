(function ($) {
    $(document).ready(function () {
        const config = PopupForElementorConfig; 
        const cookieName = config.cookieName || 'popup_seen'; 
        const cookieExpiry = parseInt(config.cookieExpiry, 10) || 7; 
        const delayInMilliseconds = parseInt(config.delay, 10) || 0; 
        let isClosing = false; 

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
            if (isClosing) {
                console.log("Popup is already closing. Aborting.");
                return;
            }

            isClosing = true;
            console.log("Closing popup...");

            $popupContent
                .removeClass('animate__fadeIn') 
                .addClass('animate__fadeOut') 
                .one('animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd', function () {
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
                if (isClosing) {
                    console.warn("Fallback triggered: Forcing popup closure.");
                    $popupOverlay.css({
                        display: 'none',
                        visibility: 'hidden',
                        opacity: 0,
                    });
                    $popupContent.removeClass('animate__fadeOut');
                    isClosing = false; 
                }
            }, 500); 
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
                console.log(`Intento de salida detectado: clientY = ${e.clientY}`);
                if (e.clientY < 0) {
                    console.log("Mostrando popup por IntentExit.");
                    showPopup();
                }
            });
        } else {
            console.log("IntentExit no habilitado.");
        }
        if (config.showOnScroll === 'yes') {
            console.log(`On Scroll habilitado. Porcentaje configurado: ${config.scrollPercentage}%`);

            let scrollTriggered = false; 

            $(window).on('scroll', function () {
                if (scrollTriggered) return; 

                const scrollTop = $(window).scrollTop();
                const windowHeight = $(window).height();
                const documentHeight = $(document).height();
                const scrolledPercentage = (scrollTop / (documentHeight - windowHeight)) * 100;

                if (scrolledPercentage >= config.scrollPercentage) {
                    console.log(`Porcentaje de scroll alcanzado: ${scrolledPercentage.toFixed(2)}%`);
                    showPopup();
                    scrollTriggered = true; 
                    $(window).off('scroll'); 
                }
            });
        } else {
            console.log("On Scroll no habilitado.");
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

        handlePopupDisplay();
    });
})(jQuery);
