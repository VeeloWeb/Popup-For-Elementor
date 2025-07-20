<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

function popupfe_dynamic_styles() {
    $overlay_color          = get_option( 'popup_overlay_color', 'rgba(0, 0, 0, 0.5)' );
    $border_radius          = get_option( 'popup_border_radius', '10px' );
    $box_shadow             = get_option( 'popup_box_shadow', '0 4px 6px rgba(0,0,0,0.1)' );
    $close_button_size      = get_option( 'popup_close_button_size', '40px' );
    $close_button_radius    = get_option( 'popup_close_button_radius', '10px' );
    $close_button_alignment = get_option( 'popup_close_button_alignment', 'right' );

    $dynamic_css = '
    .popup-overlay {
        background-color: ' . esc_attr( $overlay_color ) . ';
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }
    .popup-content {
        border-radius: ' . esc_attr( $border_radius ) . ';
        box-shadow: ' . esc_attr( $box_shadow ) . ';
        position: relative;
        overflow: auto;
    }
    .popup-close {
        width: ' . esc_attr( $close_button_size ) . ';
        height: ' . esc_attr( $close_button_size ) . ';
        font-size: calc(' . esc_attr( $close_button_size ) . ' / 2);
        border-radius: ' . esc_attr( $close_button_radius ) . ';
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #fff;
        border: none;
        cursor: pointer;
        z-index: 999999;
        position: absolute;
        top: 10px;
        ' . esc_attr( $close_button_alignment ) . ': 10px;
    }

    .button-edit-custom {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 8px 15px;
        font-size: 14px;
        line-height: 1.4;
        font-weight: 600;
        border-radius: 3px;
        text-decoration: none;
        background-color: #f301a5;
        color: #fff;
        cursor: pointer;
        transition: background-color 0.3s ease, color 0.3s ease;
    }
    .button-edit-custom:hover {
        background-color: #de01f3;
    }

    #custom-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        z-index: 999999;
        display: flex;
        justify-content: center;
        align-items: center;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;
    }
    #custom-modal .modal-container {
        background: #ffffff;
        width: 95%;
        max-width: 100%;
        height: 95%;
        border-radius: 15px;
        box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.3);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transform: translateY(-20px);
        transition: transform 0.3s ease-in-out;
    }
    #custom-modal .modal-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 20px;
        background: linear-gradient(135deg, #0073aa, #005a87);
        color: white;
        font-size: 18px;
        font-weight: bold;
        position: relative;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    }
    #custom-modal .modal-header .modal-title {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    #custom-modal .modal-header i {
        font-size: 24px;
    }
    #custom-modal #close-modal {
        background: #e74c3c;
        border: none;
        color: white;
        font-size: 20px;
        cursor: pointer;
        transition: all 0.2s ease-in-out;
        padding: 0px 9px;
        border-radius: 50%;
        position: absolute;
        right: 15px;
        top: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
    }
    #custom-modal #close-modal:hover {
        background: #c0392b;
        color: #fff;
        transform: scale(1.1);
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
    }
    #custom-modal iframe {
        width: 100%;
        height: 100%;
        border: none;
        flex: 1;
    }
    #custom-modal.show {
        opacity: 1;
        visibility: visible;
    }
    #custom-modal.show .modal-container {
        transform: translateY(0);
    }
    #custom-modal.hide {
        opacity: 0;
        visibility: hidden;
    }
    #custom-modal.hide .modal-container {
        transform: translateY(-20px);
    }
    @media (max-width: 768px) {
        #custom-modal .modal-container {
            height: 100%;
        }
    }
    ';

    // Registrar el estilo dinámico con versión manual para cache-busting
    wp_register_style(
        'popupfe_dynamic_style',
        false,
        [],
        '1.5.5'  // versión manual
    );
    wp_enqueue_style( 'popupfe_dynamic_style' );

    // Añadir el CSS inline
    wp_add_inline_style( 'popupfe_dynamic_style', $dynamic_css );
}
add_action( 'wp_head', 'popupfe_dynamic_styles' );
