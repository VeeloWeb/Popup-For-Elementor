/* One instance controller for every popup, including Elementor previews. */
(function ($) {
    'use strict';
    const opened = [];
    let nextLayer = 9999;
    window.PopupFE = {
        init: function () {
            const instances = [];
            const readCookie = name => document.cookie.split(';').some(part => part.trim().startsWith(name + '='));
            const writeCookie = (name, days) => {
                document.cookie = name + '=true; expires=' + new Date(Date.now() + days * 86400000).toUTCString() + '; path=/';
            };
            $('.popup-overlay.popup-widget[data-popupfe-config]').each(function (index) {
                const overlay = this;
                if (overlay.dataset.popupfeInitialized) return;
                let config;
                try { config = JSON.parse(overlay.getAttribute('data-popupfe-config')); }
                catch (error) { return; }
                overlay.dataset.popupfeInitialized = 'yes';
                const $overlay = $(overlay);
                const $content = $overlay.children('.popup-content');
                if (config.isEditor && config.isExample) {
                    $overlay.css({ display: 'flex', visibility: 'visible', opacity: 1 });
                }
                // Preserve the existing cookie on the first popup, including after opting in.
                const cookie = index === 0 ? 'popup_seen' : 'popup_seen_' + config.instanceKey;
                const once = config.showOnce === 'yes' || (config.exitIntent === 'yes' && config.exitIntentDisplayMode === 'once');
                const duration = Math.max(0, Number(config.animationDuration) || 0);
                const animationIn = config.animationIn === 'none' ? '' : config.animationIn;
                const animationOut = config.animationOut === 'none' ? '' : config.animationOut;
                // The button and template share the same animated container.
                const $animated = $content;
                $animated.css('animation-duration', duration + 'ms');
                let state = config.isEditor ? 'open' : 'hidden';
                let openedAt = 0;
                const instance = {
                    open: function () {
                        if (state !== 'hidden' || (!config.isEditor && once && readCookie(cookie))) return;
                        if (config.isEditor) {
                            state = 'open';
                            $overlay.css({ display: 'flex', visibility: 'visible', opacity: 1 });
                            return;
                        }
                        opened.push(instance);
                        nextLayer = Math.max(nextLayer, parseInt(window.getComputedStyle(overlay).zIndex, 10) || 9999) + 1;
                        $overlay.css('z-index', nextLayer);
                        state = 'open';
                        openedAt = Date.now();
                        $animated.removeClass(animationOut).addClass(animationIn);
                        $overlay.css({ display: 'flex', visibility: 'visible', opacity: 1 });
                    },
                    close: function () {
                        if (state !== 'open') return;
                        if (config.isEditor) {
                            state = 'hidden';
                            $overlay.css({ display: 'none', visibility: 'hidden', opacity: 0 });
                            return;
                        }
                        if (Date.now() - openedAt < 250) return;
                        state = 'closing';
                        $animated.removeClass(animationIn).addClass(animationOut);
                        setTimeout(function () {
                            $overlay.css({ display: 'none', visibility: 'hidden', opacity: 0 });
                            $animated.removeClass(animationOut);
                            if (once) writeCookie(cookie, Number(config.cookieExpiry) || 7);
                            state = 'hidden';
                            const position = opened.indexOf(instance);
                            if (position !== -1) opened.splice(position, 1);
                        }, animationOut ? duration : 0);
                    }
                };
                instances.push(instance);
                $overlay.on('click.popupfeMulti', function (event) {
                    if (event.target === overlay) instance.close();
                });
                $content.on('click.popupfeMulti', function (event) { event.stopPropagation(); });
                $content.find('.popup-close').on('click.popupfeMulti', function (event) {
                    event.preventDefault();
                    event.stopPropagation();
                    instance.close();
                });
                if (config.isEditor) {
                    $overlay.closest('.elementor-widget-popup_widget').off('click.popupfeEditor').on('click.popupfeEditor', function (event) {
                        if (state !== 'hidden') return;
                        event.preventDefault();
                        instance.open();
                    });
                    return;
                }
                if (config.triggerBySelector === 'yes' && config.triggerSelector.trim()) {
                    const raw = config.triggerSelector.trim();
                    const selector = /^[.#]/.test(raw) ? raw : '.' + raw;
                    try {
                        document.querySelectorAll(selector);
                        $(document).on('click.popupfeMulti', selector, function (event) {
                            event.preventDefault();
                            instance.open();
                        });
                    } catch (error) { /* An invalid selector must not disable other popups. */ }
                }
                const delay = Math.max(0, Number(config.multiDelay) || 0);
                if (config.showOnLoad === 'yes' || delay > 0 || config.showOnce === 'yes') {
                    setTimeout(instance.open, delay);
                }
                if (config.exitIntent === 'yes') {
                    let lastExit = 0;
                    $(document).on('mouseleave.popupfeMulti', function (event) {
                        const now = Date.now();
                        if ((event.clientY <= 20 || event.relatedTarget === null) && now - lastExit >= 1200) {
                            lastExit = now;
                            instance.open();
                        }
                    });
                    const touch = ('ontouchstart' in window) || navigator.maxTouchPoints > 0;
                    const width = Math.max(document.documentElement.clientWidth || 0, window.innerWidth || 0);
                    if (touch || width < 1024) {
                        const started = Date.now();
                        let shown = false;
                        let timer;
                        const onScroll = function () {
                            clearTimeout(timer);
                            timer = setTimeout(function () {
                                if (shown || Date.now() - started < 5000) return;
                                const doc = document.documentElement;
                                const body = document.body;
                                const track = (doc.scrollHeight || body.scrollHeight) - (doc.clientHeight || window.innerHeight);
                                const percent = track <= 0 ? 100 : ((doc.scrollTop || body.scrollTop || 0) / track) * 100;
                                if (percent >= 35) {
                                    shown = true;
                                    instance.open();
                                    window.removeEventListener('scroll', onScroll);
                                }
                            }, 150);
                        };
                        window.addEventListener('scroll', onScroll, { passive: true });
                    }
                }
            });
            if (instances.length) {
                $(document).off('keydown.popupfeMulti').on('keydown.popupfeMulti', function (event) {
                    if (event.key === 'Escape' || event.keyCode === 27) {
                        if (opened.length) opened[opened.length - 1].close();
                    }
                });
            }
        }
    };
    $(document).ready(function () { window.PopupFE.init(); });
    $(window).on('elementor/frontend/init.popupfe', function () {
        if (window.elementorFrontend && window.elementorFrontend.hooks) {
            window.elementorFrontend.hooks.addAction('frontend/element_ready/popup_widget.default', function () {
                window.PopupFE.init();
            });
        }
    });
})(jQuery);
