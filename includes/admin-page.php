<?php
if (!defined('ABSPATH')) { exit; }

add_action('admin_enqueue_scripts', function ($hook) {
    if ($hook !== 'toplevel_page_popupfe_for_elementor') { return; }
    wp_enqueue_style('popupfe-admin-style', POPUPFE_URL . 'assets/admin-style.css', [], '1.6.7');
});

function popupfe_render_admin_page() {
    if (!current_user_can('manage_options')) { return; }
    ?>
<div class="wrap pfe-dashboard">
    <header class="pfe-hero">
        <p class="pfe-brand">Popup for Elementor</p>
        <h1><?php esc_html_e("Your popups, in one place.", 'popup-for-elementor'); ?></h1>
        <p class="pfe-intro"><?php esc_html_e("Build your template, add it to a page and choose when it appears.", 'popup-for-elementor'); ?></p>
        <div class="pfe-actions">
            <a class="button button-primary button-hero" href="<?php echo esc_url(admin_url('post-new.php?post_type=elementor_library')); ?>"><?php esc_html_e("Create a template", 'popup-for-elementor'); ?></a>
            <a class="button button-hero" href="<?php echo esc_url(admin_url('edit.php?post_type=elementor_library')); ?>"><?php esc_html_e("View saved templates", 'popup-for-elementor'); ?></a>
        </div>
    </header>
    <div class="pfe-layout">
        <main>
            <section class="pfe-panel" aria-labelledby="pfe-start">
                <h2 id="pfe-start"><?php esc_html_e("Getting started", 'popup-for-elementor'); ?></h2>
                <ol class="pfe-steps">
                    <li><h3><?php esc_html_e("Create the content", 'popup-for-elementor'); ?></h3><p><?php esc_html_e("Design and save the content of your popup as an Elementor template.", 'popup-for-elementor'); ?></p></li>
                    <li><h3><?php esc_html_e("Add the popup widget", 'popup-for-elementor'); ?></h3><p><?php esc_html_e("Edit your page with Elementor, add Popup Widget and select your saved template.", 'popup-for-elementor'); ?></p></li>
                    <li><h3><?php esc_html_e("Choose when it opens", 'popup-for-elementor'); ?></h3><p><?php esc_html_e("Set the trigger in the widget visibility controls, then save and preview your page.", 'popup-for-elementor'); ?></p></li>
                </ol>
                <div class="pfe-tip"><h3><?php esc_html_e("More than one popup?", 'popup-for-elementor'); ?></h3><p><?php esc_html_e("Add another Popup Widget and choose its template and trigger. Each popup works independently.", 'popup-for-elementor'); ?></p></div>
            </section>
            <section class="pfe-panel pfe-faq" aria-labelledby="pfe-questions">
                <h2 id="pfe-questions"><?php esc_html_e("Quick answers", 'popup-for-elementor'); ?></h2>
                <details><summary><?php esc_html_e("Do I need Elementor Pro?", 'popup-for-elementor'); ?></summary><p><?php esc_html_e("No. Popup for Elementor works with Elementor Free.", 'popup-for-elementor'); ?></p></details>
                <details><summary><?php esc_html_e("Where do I edit the popup content?", 'popup-for-elementor'); ?></summary><p><?php esc_html_e("Edit the saved Elementor template used by the widget. You can also open it with Edit Template in the widget preview.", 'popup-for-elementor'); ?></p></details>
                <details><summary><?php esc_html_e("Can I use forms and shortcodes?", 'popup-for-elementor'); ?></summary><p><?php esc_html_e("Yes. Add Elementor-compatible forms or shortcodes to your saved template.", 'popup-for-elementor'); ?></p></details>
                <details><summary><?php esc_html_e("Why does my popup not appear again?", 'popup-for-elementor'); ?></summary><p><?php esc_html_e("Check the visibility settings. If a once-only display option is enabled, a cookie can prevent the popup from appearing again.", 'popup-for-elementor'); ?></p></details>
            </section>
        </main>
        <aside class="pfe-panel pfe-help" aria-labelledby="pfe-help-title">
            <span class="dashicons dashicons-sos" aria-hidden="true"></span>
            <h2 id="pfe-help-title"><?php esc_html_e("Need a hand?", 'popup-for-elementor'); ?></h2><p><?php esc_html_e("Find setup guidance or contact us for help with your popups.", 'popup-for-elementor'); ?></p>
            <a href="https://popupforelementor.com/documentacion/" target="_blank" rel="noopener noreferrer"><?php esc_html_e("Read the documentation", 'popup-for-elementor'); ?> <span aria-hidden="true">↗</span></a>
            <a href="https://popupforelementor.com/en/#contact" target="_blank" rel="noopener noreferrer"><?php esc_html_e("Contact support", 'popup-for-elementor'); ?> <span aria-hidden="true">↗</span></a>
        </aside>
    </div>
</div>
    <?php
}
