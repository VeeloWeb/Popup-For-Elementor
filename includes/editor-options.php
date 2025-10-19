<?php
// Adds options to Elementor editor for configuring the popup
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
class Popupfe_Popup_Widget extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return "popup_widget";
    }
    public function get_title()
    {
        return esc_html__("Popup Widget", "popup-for-elementor");
    }

    public function get_categories()
    {
        return ["basic"];
    }
    public function get_icon() {
        return 'eicon-table-of-contents';
          }

    protected function _register_controls()
    {
        // Content controls
        $this->start_controls_section("content_section", [
            "label" => esc_html__("Content", "popup-for-elementor"),
            "tab" => \Elementor\Controls_Manager::TAB_CONTENT,
        ]);

        $templates = [];
        if (class_exists("\Elementor\Plugin")) {
            $template_manager = \Elementor\Plugin::instance()->templates_manager->get_source(
                "local"
            );
            $templates_raw = $template_manager
                ? $template_manager->get_items()
                : [];
            foreach ($templates_raw as $template) {
                $templates[$template["template_id"]] = $template["title"];
            }
        }

        $this->add_control("template_id", [
            "label" => esc_html__("Select Template", "popup-for-elementor"),
            "type" => \Elementor\Controls_Manager::SELECT2, // Cambiado a SELECT2
            "options" => $templates, // Asegúrate de que $templates tiene las opciones disponibles
            "default" => "",
            "description" => esc_html__(
                "Choose a template from your Elementor library.",
                "popup-for-elementor"
            ),
        ]);

        $this->add_control("template_create_link", [
            "type" => \Elementor\Controls_Manager::RAW_HTML,
            "raw" => sprintf(
                '<a href="%s" target="_blank" class="elementor-button elementor-button-success" style="margin-top: 10px;">%s</a>',
                admin_url("edit.php?post_type=elementor_library"),
                esc_html__("Create New Template", "popup-for-elementor")
            ),
            "content_classes" => "elementor-control-field",
        ]);

        $this->add_control("upgrade_to_pro_notice1", [
            "type" => \Elementor\Controls_Manager::RAW_HTML,
            "raw" => sprintf(
                '<div style="margin-top: 20px; padding: 24px; background: linear-gradient(135deg, #1e1e1e, #2b2b2b); border: 1px solid #3c3c3c; border-radius: 8px; text-align: center; box-shadow: 0 2px 8px rgba(0,0,0,0.2);">
                    <strong style="display: block; color: #ffffff; font-size: 14px; font-weight: 300; margin-bottom: 12px;">%s</strong>
                    <a href="%s" target="_blank" style="display: inline-block; padding: 10px 20px; background-color: #d33a92; color: #fff; border-radius: 4px; text-decoration: none; font-weight: 600; transition: background-color 0.3s;">
                        %s
                    </a>
                </div>',
                esc_html__("Need more triggers like Scroll, OnClick, or AdBlock detection?", "popup-for-elementor"),
                "https://popupforelementor.com/en/home/#buy",
                esc_html__("Get Popup for Elementor Pro", "popup-for-elementor")
            ),
            "content_classes" => "elementor-control-field",
        ]);

        $this->end_controls_section();

        // Style controls
        $this->start_controls_section("style_section", [
            "label" => esc_html__("Popup window", "popup-for-elementor"),
            "tab" => \Elementor\Controls_Manager::TAB_STYLE,
        ]);
        $this->add_responsive_control(
            'popup_background',
            [
                'label' => esc_html__('Background Color', 'popup-for-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .popup-content' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control("overlay_color", [
            "label" => esc_html__("Overlay Color", "popup-for-elementor"),
            "type" => \Elementor\Controls_Manager::COLOR,
            "default" => "rgba(0, 0, 0, 0.5)",
            "selectors" => [
                "{{WRAPPER}} .popup-overlay" => "background-color: {{VALUE}};",
            ],
        ]);

        $this->add_control("border_radius", [
            "label" => esc_html__("Border Radius", "popup-for-elementor"),
            "type" => \Elementor\Controls_Manager::SLIDER,
            "default" => [
                "size" => 10,
            ],
            "selectors" => [
                "{{WRAPPER}} .popup-content" =>
                    "border-radius: {{SIZE}}{{UNIT}};",
            ],
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                "name" => "popup_box_shadow",
                "label" => esc_html__("Box Shadow", "popup-for-elementor"),
                "selector" => "{{WRAPPER}} .popup-content",
                "description" => esc_html__(
                    "Configure the shadow settings directly.",
                    "popup-for-elementor"
                ),
            ]
        );

        $this->add_responsive_control("popup_width", [
            "label" => esc_html__("Popup Width", "popup-for-elementor"),
            "type" => \Elementor\Controls_Manager::SELECT,
            "default" => "400px",
            "options" => [
                "auto" => esc_html__("Auto (Fit Content)", "popup-for-elementor"),
                "custom" => esc_html__("Custom", "popup-for-elementor"),
            ],
            "selectors" => [
                "{{WRAPPER}} .popup-content" => "width: {{VALUE}};",
            ],
        ]);
        
        $this->add_responsive_control("custom_popup_width", [
            "label" => esc_html__("Custom Width", "popup-for-elementor"),
            "type" => \Elementor\Controls_Manager::SLIDER,
            "default" => [
                "size" => 400,
                "unit" => "px",
            ],
            "size_units" => ["px", "%", "vw"],
            "range" => [
                "px" => [
                    "min" => 100,
                    "max" => 2000,
                    "step" => 10,
                ],
                "%" => [
                    "min" => 1,
                    "max" => 100,
                ],
                "vw" => [
                    "min" => 1,
                    "max" => 100,
                ],
            ],
            "condition" => [
                "popup_width" => "custom",
            ],
            "selectors" => [
                "{{WRAPPER}} .popup-content" => "width: {{SIZE}}{{UNIT}};",
            ],
        ]);
        

        $this->add_responsive_control("popup_height", [
            "label" => esc_html__("Popup Height", "popup-for-elementor"),
            "type" => \Elementor\Controls_Manager::SELECT,
            "default" => "auto",
            "options" => [
                "auto" => esc_html__("Auto (Fit Content)", "popup-for-elementor"),
                "custom" => esc_html__("Custom", "popup-for-elementor"),
            ],
            "selectors" => [
                "{{WRAPPER}} .popup-content" => "height: {{VALUE}};",
            ],
        ]);
        
        $this->add_responsive_control("custom_popup_height", [
            "label" => esc_html__("Custom Height", "popup-for-elementor"),
            "type" => \Elementor\Controls_Manager::SLIDER,
            "default" => [
                "size" => 400,
                "unit" => "px",
            ],
            "size_units" => ["px", "%", "vh"],
            "range" => [
                "px" => [
                    "min" => 100,
                    "max" => 2000,
                    "step" => 10,
                ],
                "%" => [
                    "min" => 1,
                    "max" => 100,
                ],
                "vh" => [
                    "min" => 1,
                    "max" => 100,
                ],
            ],
            "condition" => [
                "popup_height" => "custom",
            ],
            "selectors" => [
                "{{WRAPPER}} .popup-content" => "height: {{SIZE}}{{UNIT}};",
            ],
        ]);
        


        $this->add_responsive_control("horizontal_position", [
            "label" => esc_html__("Horizontal Position", "popup-for-elementor"),
            "type" => \Elementor\Controls_Manager::CHOOSE,
            "options" => [
                "flex-start" => [
                    "title" => esc_html__("Left", "popup-for-elementor"),
                    "icon" => "eicon-h-align-left",
                ],
                "center" => [
                    "title" => esc_html__("Center", "popup-for-elementor"),
                    "icon" => "eicon-h-align-center",
                ],
                "flex-end" => [
                    "title" => esc_html__("Right", "popup-for-elementor"),
                    "icon" => "eicon-h-align-right",
                ],
            ],
            "default" => "center",
            "selectors" => [
                "{{WRAPPER}} .popup-overlay" => "justify-content: {{VALUE}};",
            ],
        ]);

        $this->add_responsive_control("vertical_position", [
            "label" => esc_html__("Vertical Position", "popup-for-elementor"),
            "type" => \Elementor\Controls_Manager::CHOOSE,
            "options" => [
                "flex-start" => [
                    "title" => esc_html__("Top", "popup-for-elementor"),
                    "icon" => "eicon-v-align-top",
                ],
                "center" => [
                    "title" => esc_html__("Center", "popup-for-elementor"),
                    "icon" => "eicon-v-align-middle",
                ],
                "flex-end" => [
                    "title" => esc_html__("Bottom", "popup-for-elementor"),
                    "icon" => "eicon-v-align-bottom",
                ],
            ],
            "default" => "center",
            "selectors" => [
                "{{WRAPPER}} .popup-overlay" => "align-items: {{VALUE}};",
            ],
        ]);

        // Control para el margen (Responsive)
        $this->add_responsive_control(
            'popup_margin',
            [
                'label' => esc_html__('Margin', 'popup-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .popup-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Control para el padding (Responsive)
        $this->add_responsive_control(
            'popup_padding',
            [
                'label' => esc_html__('Padding', 'popup-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .popup-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();

        // Animation

        $this->start_controls_section("animation_section_custom", [
            "label" => esc_html__("Animation", "popup-for-elementor"),
            "tab" => \Elementor\Controls_Manager::TAB_STYLE, // Colocamos esta sección en la pestaña de estilo
        ]);

        $this->add_control("popup_animation_in", [
            "label" => esc_html__("Entrance Animation", "popup-for-elementor"),
            "type" => \Elementor\Controls_Manager::SELECT,
            "options" => [
                "none" => esc_html__("None", "popup-for-elementor"),
                "animate__fadeIn" => esc_html__("Fade In", "popup-for-elementor"),
                "animate__fadeInUp" => esc_html__("Fade In Up", "popup-for-elementor"),
                "anixmate__fadeInDown" => esc_html__("Fade In Down", "popup-for-elementor"),
                "animate__fadeInLeft" => esc_html__("Fade In Left", "popup-for-elementor"),
                "animate__fadeInRight" => esc_html__("Fade In Right", "popup-for-elementor"),
                "animate__zoomIn" => esc_html__("Zoom In", "popup-for-elementor"),
                "animate__slideInUp" => esc_html__("Slide In Up", "popup-for-elementor"),
                "animate__slideInDown" => esc_html__("Slide In Down", "popup-for-elementor"),
                "animate__slideInLeft" => esc_html__("Slide In Left", "popup-for-elementor"),
                "animate__slideInRight" => esc_html__("Slide In Right", "popup-for-elementor"),
            ],
            "default" => "animate__fadeIn",
            "description" => esc_html__(
                "Choose an animation for the popup to appear.",
                "popup-for-elementor"
            ),
        ]);

        $this->add_control("popup_animation_out", [
            "label" => esc_html__("Exit Animation", "popup-for-elementor"),
            "type" => \Elementor\Controls_Manager::SELECT,
            "options" => [
                "none" => esc_html__("None", "popup-for-elementor"),
                "animate__fadeOut" => esc_html__("Fade Out", "popup-for-elementor"),
                "animate__fadeOutUp" => esc_html__("Fade Out Up", "popup-for-elementor"),
                "animate__fadeOutDown" => esc_html__("Fade Out Down", "popup-for-elementor"),
                "animate__fadeOutLeft" => esc_html__("Fade Out Left", "popup-for-elementor"),
                "animate__fadeOutRight" => esc_html__("Fade Out Right", "popup-for-elementor"),
                "animate__zoomOut" => esc_html__("Zoom Out", "popup-for-elementor"),
                "animate__slideOutUp" => esc_html__("Slide Out Up", "popup-for-elementor"),
                "animate__slideOutDown" => esc_html__("Slide Out Down", "popup-for-elementor"),
                "animate__slideOutLeft" => esc_html__("Slide Out Left", "popup-for-elementor"),
                "animate__slideOutRight" => esc_html__(
                    "Slide Out Right",
                    "popup-for-elementor"
                ),
            ],
            "default" => "animate__fadeOut",
            "description" => esc_html__(
                "Choose an animation for the popup to disappear.",
                "popup-for-elementor"
            ),
        ]);

        $this->add_control("animation_duration_custom", [
            "label" => esc_html__("Animation Duration (ms)", "popup-for-elementor"),
            "type" => \Elementor\Controls_Manager::SLIDER,
            "size_units" => ["ms"],
            "range" => [
                "ms" => [
                    "min" => 100,
                    "max" => 3000,
                    "step" => 100,
                ],
            ],
            "default" => [
                "size" => 500,
                "unit" => "ms",
            ],
            "selectors" => [
                "{{WRAPPER}} .popup-content" =>
                    "animation-duration: {{SIZE}}{{UNIT}};",
            ],
        ]);

        $this->end_controls_section();
        //Close Button

        $this->start_controls_section("close_button_section", [
            "label" => esc_html__("Close Button", "popup-for-elementor"),
            "tab" => \Elementor\Controls_Manager::TAB_STYLE, 
        ]);
        $this->add_control("hide_close_button", [
            "label" => esc_html__("Hide Close Button", "popup-for-elementor"),
            "type" => \Elementor\Controls_Manager::SWITCHER,
            "label_on" => esc_html__("Yes", "popup-for-elementor"),
            "label_off" => esc_html__("No", "popup-for-elementor"),
            "return_value" => "yes",
            "default" => "no",
            "selectors" => [
                "{{WRAPPER}} .popup-close" => "display: none;",
            ],
        ]);
        
        $this->add_control("close_button_background_color", [
            "label" => esc_html__("Close Button Background", "popup-for-elementor"),
            "type" => \Elementor\Controls_Manager::COLOR,
            "selectors" => [
                "{{WRAPPER}} .popup-close" => "background-color: {{VALUE}};",
            ],
        ]);

        $this->add_control("close_button_hover_background_color", [
            "label" => esc_html__("Close Button Hover Background", "popup-for-elementor"),
            "type" => \Elementor\Controls_Manager::COLOR,
            "selectors" => [
                "{{WRAPPER}} .popup-close:hover" =>
                    "background-color: {{VALUE}};",
            ],
        ]);

        $this->add_control("close_button_color", [
            "label" => esc_html__("Close Button Color", "popup-for-elementor"),
            "type" => \Elementor\Controls_Manager::COLOR,
            "selectors" => [
                "{{WRAPPER}} .popup-close" => "color: {{VALUE}};",
            ],
        ]);

        $this->add_control("close_button_hover_color", [
            "label" => esc_html__("Close Button Hover Color", "popup-for-elementor"),
            "type" => \Elementor\Controls_Manager::COLOR,
            "selectors" => [
                "{{WRAPPER}} .popup-close:hover" => "color: {{VALUE}};",
            ],
        ]);

        $this->add_control("close_button_size", [
            "label" => esc_html__("Close Button Size", "popup-for-elementor"),
            "type" => \Elementor\Controls_Manager::SLIDER,
            "size_units" => ["px"], // Solo permite px
            "range" => [
                "px" => [
                    "min" => 10,
                    "max" => 100,
                ],
            ],
            "default" => [
                "unit" => "px",
                "size" => 40, // Tamaño por defecto del botón de cerrar
            ],
            "selectors" => [
                "{{WRAPPER}} .popup-close" =>
                    "width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; font-size: calc({{SIZE}}{{UNIT}} / 2);",
            ],
            "description" => esc_html__(
                "Adjust the size of the close button.",
                "popup-for-elementor"
            ),
        ]);
        $this->add_control("close_button_alignment", [
            "label" => esc_html__("Close Button Alignment", "popup-for-elementor"),
            "type" => \Elementor\Controls_Manager::CHOOSE,
            "options" => [
                "left" => [
                    "title" => esc_html__("Left", "popup-for-elementor"),
                    "icon" => "eicon-h-align-left",
                ],
                "right" => [
                    "title" => esc_html__("Right", "popup-for-elementor"),
                    "icon" => "eicon-h-align-right",
                ],
            ],
            "default" => "right",
            "selectors" => [
                "{{WRAPPER}} .popup-close" => "{{VALUE}}: 10px;",
            ],
            "description" => esc_html__(
                "Align the close button to the left or right.",
                "popup-for-elementor"
            ),
        ]);

        $this->add_control("close_button_border_radius", [
            "label" => esc_html__("Close Button Border Radius", "popup-for-elementor"),
            "type" => \Elementor\Controls_Manager::SLIDER,
            "size_units" => ["px"], // Solo permite px
            "range" => [
                "px" => [
                    "min" => 0,
                    "max" => 50,
                ],
            ],
            "selectors" => [
                "{{WRAPPER}} .popup-close" =>
                    "border-radius: {{SIZE}}{{UNIT}};",
            ],
            "description" => esc_html__(
                "Controls the border radius of the close button.",
                "popup-for-elementor"
            ),
        ]);

        $this->end_controls_section();

        // Visibility controls
$this->start_controls_section("visibility_section", [
    "label" => esc_html__("Visibility", "popup-for-elementor"),
    "tab" => \Elementor\Controls_Manager::TAB_CONTENT,
]);

$this->add_control("show_on_load", [
    "label" => esc_html__("Show on Page Load", "popup-for-elementor"),
    "type" => \Elementor\Controls_Manager::SWITCHER,
    "default" => "",
    "description" => esc_html__("Activate to show popup when the page loads. Will disable other visibility options.", "popup-for-elementor"),
    "condition" => [
        "show_after_delay_enabled!" => "yes",
        "show_on_exit_intent!" => "yes",
        "show_once!" => "yes",
        "trigger_selector_enabled!" => "yes", 

    ],
]);

$this->add_control("show_after_delay_enabled", [
    "label" => esc_html__("Enable Show After Delay", "popup-for-elementor"),
    "type" => \Elementor\Controls_Manager::SWITCHER,
    "default" => "",
    "description" => esc_html__("Activate to show popup after a delay. Will disable other visibility options.", "popup-for-elementor"),
    "condition" => [
        "show_on_load!" => "yes",
        "show_on_exit_intent!" => "yes",
        "show_once!" => "yes",
        "trigger_selector_enabled!" => "yes", 

    ],
]);

$this->add_control("show_after_delay", [
    "label" => esc_html__("Delay (seconds)", "popup-for-elementor"),
    "type" => \Elementor\Controls_Manager::NUMBER,
    "default" => 3,
    "condition" => [
        "show_after_delay_enabled" => "yes",

    ],
]);

$this->add_control("show_on_exit_intent", [
    "label" => esc_html__("Show on Exit Intent", "popup-for-elementor"),
    "type" => \Elementor\Controls_Manager::SWITCHER,
    "default" => "",
    "description" => esc_html__("Activate to show popup when the user intends to exit. Will disable other visibility options.", "popup-for-elementor"),
    "condition" => [
        "show_on_load!"             => "yes",
        "show_after_delay_enabled!" => "yes",
        "show_once!"                => "yes",
        "trigger_selector_enabled!" => "yes", 

    ],
]);

// NUEVO: control interno del Exit Intent (no es switch)
$this->add_control("exit_intent_display_mode", [
    "label"       => esc_html__("Exit Intent — Display", "popup-for-elementor"),
    "type"        => \Elementor\Controls_Manager::SELECT,
    "default"     => "always",
    "options"     => [
        "always" => esc_html__("Always", "popup-for-elementor"),
        "once"   => esc_html__("Only once", "popup-for-elementor"),
    ],
    "description" => esc_html__("Show the Exit Intent popup always or only once per visitor (cookie).", "popup-for-elementor"),
    "condition"   => [
        "show_on_exit_intent" => "yes",  // ← aparece solo si el trigger está activo
    ],
]);

$this->add_control("show_once", [
    "label" => esc_html__("Show Only Once", "popup-for-elementor"),
    "type" => \Elementor\Controls_Manager::SWITCHER,
    "default" => "",
    "description" => esc_html__("Show the popup only once per session.", "popup-for-elementor"),
    "condition" => [
        "show_on_load!" => "yes",
        "show_after_delay_enabled!" => "yes",
        "show_on_exit_intent!" => "yes",
        "trigger_selector_enabled!" => "yes", 

    ],
]);

$this->add_control('trigger_selector_enabled', [
    'label'        => esc_html__('Trigger by selector (class or ID)', 'popup-for-elementor'),
    'type'         => \Elementor\Controls_Manager::SWITCHER,
    'label_on'     => esc_html__('Yes', 'popup-for-elementor'),
    'label_off'    => esc_html__('No', 'popup-for-elementor'),
    'return_value' => 'yes',
    'default'      => '',
    'description'  => esc_html__('Enter the class or ID name (without “.” or “#”). Example: my-button or popup-trigger. The popup will open when any element with that class or ID is clicked.', 'popup-for-elementor'),
    'condition'    => [
        'show_on_load!'             => 'yes',
        'show_after_delay_enabled!' => 'yes',
        'show_on_exit_intent!'      => 'yes',
        'show_once!'                => 'yes',
    ],
]);



$this->add_control('trigger_selector', [
    'label'       => esc_html__('Element name (class or ID)', 'popup-for-elementor'),
    'type'        => \Elementor\Controls_Manager::TEXT,
    'placeholder' => esc_html__('e.g. my-button or popup-trigger', 'popup-for-elementor'),
    'description' => esc_html__('Enter the class or ID name (without “.” or “#”). Example: my-button or popup-trigger.', 'popup-for-elementor'),
    'condition'   => [
        'trigger_selector_enabled' => 'yes', // ← solo dependemos del switch
    ],
]);






$this->add_control("upgrade_to_pro_notice2", [
    "type" => \Elementor\Controls_Manager::RAW_HTML,
    "raw" => sprintf(
        '<div style="margin-top: 20px; padding: 24px; background: linear-gradient(135deg, #1e1e1e, #2b2b2b); border: 1px solid #3c3c3c; border-radius: 8px; text-align: center; box-shadow: 0 2px 8px rgba(0,0,0,0.2);">
            <strong style="display: block; color: #ffffff; font-size: 14px; font-weight: 300; margin-bottom: 12px;">%s</strong>
            <a href="%s" target="_blank" style="display: inline-block; padding: 10px 20px; background-color: #d33a92; color: #fff; border-radius: 4px; text-decoration: none; font-weight: 600; transition: background-color 0.3s;">
                %s
            </a>
        </div>',
        esc_html__("Need more triggers like Scroll, OnClick, or AdBlock detection?", "popup-for-elementor"),
        "https://popupforelementor.com/en/home/#buy",
        esc_html__("Get Popup for Elementor Pro", "popup-for-elementor")
    ),
    "content_classes" => "elementor-control-field",
]);
$this->end_controls_section();
    $this->start_controls_section("refresh_section", [
            "label" => esc_html__("Refresh", "popup-for-elementor"),
            "tab" => \Elementor\Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control(
            'refresh_popup',
            [
                'label' => esc_html__('Refresh Popup', 'popup-for-elementor'),
                'type' => \Elementor\Controls_Manager::BUTTON,
                'button_type' => 'success',
                'text' => esc_html__('Refresh', 'popup-for-elementor'),
                'description' => esc_html__('Click to refresh the popup content.', 'popup-for-elementor'),
                'frontend_available' => true,
            ]
        );
        $this->add_control("upgrade_to_pro_notice3", [
            "type" => \Elementor\Controls_Manager::RAW_HTML,
            "raw" => sprintf(
                '<div style="margin-top: 20px; padding: 24px; background: linear-gradient(135deg, #1e1e1e, #2b2b2b); border: 1px solid #3c3c3c; border-radius: 8px; text-align: center; box-shadow: 0 2px 8px rgba(0,0,0,0.2);">
                    <strong style="display: block; color: #ffffff; font-size: 14px; font-weight: 300; margin-bottom: 12px;">%s</strong>
                    <a href="%s" target="_blank" style="display: inline-block; padding: 10px 20px; background-color: #d33a92; color: #fff; border-radius: 4px; text-decoration: none; font-weight: 600; transition: background-color 0.3s;">
                        %s
                    </a>
                </div>',
                esc_html__("Need more triggers like Scroll, OnClick, or AdBlock detection?", "popup-for-elementor"),
                "https://popupforelementor.com/en/home/#buy",
                esc_html__("Get Popup for Elementor Pro", "popup-for-elementor")
            ),
            "content_classes" => "elementor-control-field",
        ]);
        $this->end_controls_section();
        $this->start_controls_section("upgrade_section", [
            "label" => esc_html__("Popup for Elementor (PRO)", "popup-for-elementor"),
            "tab"   => null,
        ]);
        
        $this->add_control("pro_upgrade_box", [
            "type" => \Elementor\Controls_Manager::RAW_HTML,
            "raw" => sprintf(
                '<div style="padding: 24px; background: linear-gradient(135deg, #1e1e1e, #2b2b2b); border: 1px solid #3c3c3c; border-radius: 8px; text-align: center; box-shadow: 0 2px 8px rgba(0,0,0,0.2);">
                    <h3 style="color: #ffffff; font-size: 16px; margin-bottom: 12px; font-weight: 600;">%s</h3>
                    <p style="color: #bbbbbb; font-size: 13px; margin-bottom: 20px;">%s</p>
                    <a href="%s" target="_blank" style="display: inline-block; padding: 10px 20px; background-color: #d33a92; color: #fff; border-radius: 4px; text-decoration: none; font-weight: 600; transition: background-color 0.3s;">
                        %s
                    </a>
                </div>',
                esc_html__("Unlock More Power", "popup-for-elementor"),
                esc_html__("Upgrade to Pro and access all premium triggers and features.", "popup-for-elementor"),
                "https://popupforelementor.com/en/home/#buy",
                esc_html__("Upgrade to Pro", "popup-for-elementor")
            ),
        ]);
        
        $this->end_controls_section();
        
        

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        // Configuraciones dinámicas para pasar al script
        $config = [
            'showOnLoad'  => isset($settings['show_on_load']) && $settings['show_on_load'] === 'yes' ? 'yes' : 'no',
            'delay'       => isset($settings['show_after_delay']) ? (int) $settings['show_after_delay'] * 1000 : 0,
            'exitIntent'  => isset($settings['show_on_exit_intent']) && $settings['show_on_exit_intent'] === 'yes' ? 'yes' : 'no',
            'exitIntentDisplayMode' => !empty($settings['exit_intent_display_mode']) ? $settings['exit_intent_display_mode'] : 'always',
            'showOnce'    => isset($settings['show_once']) && $settings['show_once'] === 'yes' ? 'yes' : 'no',
            'cookieName'  => 'popup_seen',
            'cookieExpiry'=> 7,
                    'triggerBySelector' => (!empty($settings['trigger_selector_enabled']) && $settings['trigger_selector_enabled'] === 'yes') ? 'yes' : 'no',
            'triggerSelector'   => !empty($settings['trigger_selector']) ? $settings['trigger_selector'] : '',
        ];
        
           

        // Pasar configuraciones dinámicas al script
        wp_localize_script(
            'popup-widget-js',
            'PopupForElementorConfig',
            $config
        );


        // Obtener animaciones seleccionadas y duración
        $animation_in = $settings['popup_animation_in'] ?? 'animate__fadeIn';
        $animation_out = $settings['popup_animation_out'] ?? 'animate__fadeOut';
        $animation_duration = isset($settings['animation_duration_custom']['size'])
            ? (int) $settings['animation_duration_custom']['size']
            : 500;

        // Renderizar plantilla de Elementor si está configurada
       if (!empty($settings['template_id']) && class_exists('\Elementor\Plugin')) {
    $popup_content = \Elementor\Plugin::instance()->frontend->get_builder_content_for_display($settings['template_id']);

    if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
        // Recuperar la URL del editor de Elementor
        $edit_url = admin_url('post.php?post=' . absint($settings['template_id']) . '&action=elementor');

        // Solo eliminar etiquetas que no afecten la funcionalidad
        $filtered_content = preg_replace('/<meta\b[^>]*>(.*?)<\/meta>/is', '', $popup_content);
        $filtered_content = preg_replace('/<link\b[^>]*>(.*?)<\/link>/is', '', $filtered_content);

        // Crear contenido para el modal
        $popup_content = '
            <div class="elementor-template-button-wrapper" style="text-align: center; margin-top: 15px;">
                <a href="javascript:void(0);" 
                   class="popup-edit-button elementor-button elementor-button-success elementor-size-sm button-edit-custom" 
data-popup-id="' . esc_attr( 'popup_' . get_the_ID() . '_' . $settings['template_id'] ) . '"
                   data-edit-url="' . esc_url($edit_url) . '" 
                   id="open-modal">
                   <i class="eicon-edit" style="margin-right: 8px;"></i>' . esc_html__('Edit Template', 'popup-for-elementor') . '
                </a>
            </div>
            <div class="popup-editor-content">
                ' . $filtered_content . '
            </div>';
    }
}


        // Generar un identificador único para el popup
        $current_page_id = get_the_ID();
        $popup_id = get_post_meta($settings['template_id'], '_popup_id_' . $current_page_id, true);

        if (empty($popup_id)) {
            $popup_id = 'popup_' . $current_page_id . '_' . uniqid();
            update_post_meta($settings['template_id'], '_popup_id_' . $current_page_id, $popup_id);
        }

        // Renderizar el HTML del popup con ID único
        $styles = '';
        if (!defined('ELEMENTOR_VERSION') || !\Elementor\Plugin::$instance->editor->is_edit_mode()) {
            // Aplicar estilos para ocultar el popup fuera del editor
            $styles = 'display: none; visibility: hidden; opacity: 1;';
        }

        function filter_popup_content($content)
        {
            // Lista de etiquetas peligrosas a eliminar (pero manteniendo SVGs y estilos de Elementor)
            $dangerous_tags = ['iframe', 'embed', 'object', 'applet', 'meta', 'link'];

            foreach ($dangerous_tags as $tag) {
                $content = preg_replace('/<' . $tag . '.*?>.*?<\/' . $tag . '>/is', '', $content);
                $content = preg_replace('/<' . $tag . '.*?>/is', '', $content);
            }

            return $content;
        }

        /* Escaping is not applied here because the content has already been filtered
        by `filter_popup_content()`, which removes dangerous tags.
        Using `esc_html()` would break Elementor's functionality.
        This code has been reviewed and is safe. */

        $popup_content_filtered = filter_popup_content($popup_content);

        echo '<div id="' . esc_attr($popup_id) . '" class="popup-overlay popup-widget" style="' . esc_attr($styles) . '">
    <div class="popup-content animate__animated ' . esc_attr($animation_in) . '"
         style="position: relative; animation-duration: ' . esc_attr($animation_duration) . 'ms;">
         <button class="popup-close">&times;</button>';
         
// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
echo $popup_content_filtered;

echo '</div></div>';

// This script controls the popup behavior (open/close, animations, hover effects).
// It must be injected directly here because Elementor dynamically refreshes widget content.
// Using wp_enqueue_script or wp_add_inline_script would not persist across reloads.

        echo '<script>
    (function($) {
        $(document).ready(function() {
            const popup = $("#' .
            esc_attr($popup_id) .
            '");
            const popupContent = popup.find(".popup-content");

            if (popup.length) {
                // Abrir popup con animación de entrada
                popup.closest(".elementor-widget-popup_widget").off("click").on("click", function(e) {
                    e.preventDefault();
                    popup.css({
                        display: "flex",
                        visibility: "visible"
                    });
                    popupContent.removeClass("' .
            esc_attr($animation_out) .
            '").addClass("' .
            esc_attr($animation_in) .
            '");
                });

                // Cerrar popup con animación de salida
                popup.find(".popup-close").off("click").on("click", function(e) {
                    e.stopPropagation();
                    popupContent
                        .removeClass("' .
            esc_attr($animation_in) .
            '")
                        .addClass("' .
            esc_attr($animation_out) .
            '");

                    // Esperar la duración de la animación antes de ocultar el popup
                    const duration = ' .
            esc_attr($animation_duration) .
            ';
                    setTimeout(function() {
                        popup.css({
                            display: "none",
                            visibility: "hidden"
                        });
                        popupContent.removeClass("' .
            esc_attr($animation_out) .
            '");
                    }, duration);
                });

                // Hover en el botón para cambiar el fondo del popup
                popup.find(".popup-edit-button").on("mouseenter", function() {
                    popupContent.css("background-color", "#ffebf2");
                }).on("mouseleave", function() {
                    popupContent.css("background-color", "");
                });
            } else {
                console.error("Popup element not found in the DOM.");
            }
        });
		elementor.hooks.addAction("panel/open_editor/widget", function (panel, model) {
    panel.$el.on("click", ".elementor-control-refresh_popup .elementor-button", function () {
        console.log("¡Botón clicado! Refrescando el widget...");

        // Simular un cambio en el modelo
        model.set("refresh_trigger", Date.now()); // Valor ficticio para forzar el cambio
        model.trigger("change"); // Notificar el cambio a Elementor

        // Verificar si Elementor actualiza la vista
        setTimeout(function () {
            console.log("Intentando recargar la vista previa...");
            elementor.reloadPreview(); // Forzar la recarga si no responde
            elementor.once("preview:loaded", function () {
                console.log("Vista previa recargada correctamente.");

                // Reabrir el popup después de recargar la vista previa
                const $popupOverlay = jQuery(".popup-overlay");
                if ($popupOverlay.length) {
                    console.log("Reabriendo el popup...");
                    $popupOverlay.css({
                        display: "",
                        visibility: "",
                        opacity: 1,
                    });
                    console.log("Popup reabierto correctamente.");
                } else {
                    console.error("No se encontró el popup en el DOM.");
                }
            });
        }, 500); // Fallback por si el trigger no es suficiente
    });
});
    })(jQuery);
</script>';

// This script controls the custom modal editor outside the iframe (open, close, panel resize).
// Since the modal is rendered outside the iframe (via editor/after_footer),
// this script needs to access it using parent.jQuery.
// It must be echoed directly to stay bound to the button rendered in the iframe.

        echo '<div id="custom-modal">
        <div class="modal-container">
            <div class="modal-header">
                <div class="modal-title" style="display: flex; align-items: center;">
                    <div style="width: 40px; height: 40px; background-color: white; border-radius: 50%; display: flex; justify-content: center; align-items: center; margin-right: 10px;">
                        <span class="eicon-table-of-contents" style="font-size: 20px; color: #333;"></span> <!-- Icono de Elementor -->
                    </div>
                    ' . esc_html__("Popup for Elementor", "popup-for-elementor") . '
                </div>
                <button id="close-modal">&times;</button>
            </div>
            <iframe id="modal-iframe" src=""></iframe>
        </div>
      </div>';

      echo '<script>
      (function($) {
          $(document).ready(function() {
              const $modal = $("#custom-modal");
              const $iframe = $("#modal-iframe");
              const $closeButton = $("#close-modal");
      
              let originalPanelStyles = {}; // Guardamos los estilos originales
      
              function refreshWidget() {
                  console.log("Ejecutando refresh del widget...");
                  if (typeof parent.elementor !== "undefined" && parent.elementor.reloadPreview) {
                      parent.elementor.reloadPreview();
                      parent.elementor.once("preview:loaded", function() {
                          console.log("Vista previa recargada correctamente.");
                      });
                  }
              }
      
              function toggleElementorPanel(reduce) {
                  if (typeof parent.jQuery !== "undefined") {
                      const $panel = parent.jQuery("#elementor-panel");
                      const $preview = parent.jQuery("#elementor-preview");
      
                      if (reduce) {
                          console.log("Guardando estado del panel y reduciéndolo...");
                          originalPanelStyles = {
                              width: $panel.css("width"),
                              minWidth: $panel.css("min-width"),
                              maxWidth: $panel.css("max-width"),
                              overflow: $panel.css("overflow"),
                              visibility: $panel.css("visibility"),
                              opacity: $panel.css("opacity"),
                          };
      
                          $panel.css({
                              "width": "60px",
                              "min-width": "60px",
                              "max-width": "60px",
                              "overflow": "hidden",
                              "visibility": "hidden",
                              "opacity": "0",
                              "transition": "width 0.3s ease-in-out"
                          });
      
                          $preview.css({
                              "width": "calc(100% - 60px)",
                              "transition": "width 0.3s ease-in-out"
                          });
                      } else {
                          console.log("Restaurando el panel de Elementor...");
                          $panel.css(originalPanelStyles);
      
                          $preview.css({
                              "width": "calc(100% - " + originalPanelStyles.width + ")"
                          });
                      }
                  }
              }
      
              $("#open-modal").on("click", function() {
                  console.log("Modal abierto, reduciendo panel en la ventana principal...");
                  const editUrl = $(this).data("edit-url");
                  $iframe.attr("src", editUrl);
                  $modal.removeClass("hide").addClass("show");
      
                  toggleElementorPanel(true);
              });
      
              $closeButton.on("click", function() {
                  console.log("Cerrando modal, restaurando panel en la ventana principal...");
                  $modal.removeClass("show").addClass("hide");
      
                  setTimeout(() => {
                      $iframe.attr("src", ""); // Limpiar el iframe
                      toggleElementorPanel(false);
                      refreshWidget();
                  }, 300);
              });
      
              console.log("Script de reducción de panel cargado.");
          });
      })(jQuery);
      </script>';
    }
}
