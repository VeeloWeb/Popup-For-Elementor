<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

add_action( 'admin_enqueue_scripts', function() {
  wp_enqueue_style(
      'popupfe-admin-style',
      POPUPFE_URL  . 'assets/admin-style.css',
      [],
      '1.5.5'  
  );
  wp_enqueue_script(
      'popupfe-admin-script',
      POPUPFE_URL .  'assets/admin-script.js',
      [],
      '1.5.5', 
      true
  );
} );


function popupfe_render_admin_page() {
    ?>
    <div class="pfe-dashboard-wrapper">
        <div class="pfe-dashboard-welcome">
            <h1><?php echo esc_html__('Thanks for using Popup for Elementor!', 'popup-for-elementor'); ?></h1>
            <p><?php echo esc_html__('You’re using the free version — start building amazing popups today using your Elementor templates.', 'popup-for-elementor'); ?></p>
            <p>
                <?php echo esc_html__('Want more power? ', 'popup-for-elementor'); ?>
                <a href="https://popupforelementor.com/en/#buy" target="_blank" style="color: #fff; text-decoration: underline;">
                    <?php echo esc_html__('Check out the Pro version', 'popup-for-elementor'); ?>
                </a>
            </p>
        </div>

        <div class="pfe-dashboard-actions">
            <div class="pfe-dashboard-card">
            <a href="<?php echo esc_url( admin_url('post-new.php?post_type=elementor_library') ); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M13 11h8v2h-8v8h-2v-8H3v-2h8V3h2v8z"/></svg>
                    <?php echo esc_html__('Create Popup Template', 'popup-for-elementor'); ?>
                </a>
            </div>
            <div class="pfe-dashboard-card pfe-promo-card">
            <a href="#" id="toggle-plans">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
  <path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 
  0-1.99.9-1.99 2S15.9 22 17 22s2-.9 2-2-.9-2-2-2zM7.16 14.26l.03.01L7.16 
  14.26zM7 16h10v-2H7v2zm13.31-3.9l1.39-6.49A1 1 0 0020.74 4H5.21L4.27 
  1.59A.996.996 0 003.31 1H1v2h1.61l3.6 7.59-.95 4.38A2.003 2.003 0 007.16 
  18H19v-2H7.42a.25.25 0 01-.24-.19l.03-.14.9-4.24h9.85c.46 0 .86-.31.97-.76z"/>
</svg>
                    <?php echo esc_html__('Compare Plans', 'popup-for-elementor'); ?>
                </a>
            </div>
            <div class="pfe-dashboard-card">
    <a href="#" id="toggle-faq">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 17h-2v-2h2v2zm1.07-7.75c-.9.92-1.07 1.25-1.07 2.25h-2v-.5c0-1.1.45-1.99 1.17-2.71.59-.59 1.07-1.1 1.07-1.79 0-.89-.72-1.61-1.61-1.61S10.39 8.11 10.39 9H8.4c0-2.04 1.66-3.7 3.7-3.7s3.7 1.66 3.7 3.7c0 1.41-.84 2.18-1.73 3.05z"/></svg>
        <?php echo esc_html__('FAQ', 'popup-for-elementor'); ?>
    </a>
</div>

            <div class="pfe-dashboard-card">
                <a href="https://popupforelementor.com/documentacion/" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M4 4h16v2H4zm0 4h16v2H4zm0 4h10v2H4z"/></svg>
                    <?php echo esc_html__('Documentation', 'popup-for-elementor'); ?>
                </a>
            </div>
            <div class="pfe-dashboard-card">
                <a href="https://popupforelementor.com/en/#contact" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M20 2H4a2 2 0 00-2 2v16l4-4h14a2 2 0 002-2V4a2 2 0 00-2-2z"/></svg>
                    <?php echo esc_html__('Contact & Support', 'popup-for-elementor'); ?>
                </a>
            </div>
        </div>

        <div class="pfe-faq" id="faq-section">
            <h2><?php echo esc_html__('Frequently Asked Questions', 'popup-for-elementor'); ?></h2>
            <div class="faq-item">
                <div class="faq-question"><?php echo esc_html__('Do I need Elementor Pro?', 'popup-for-elementor'); ?></div>
                <div class="faq-answer"><?php echo esc_html__('No. This plugin is fully compatible with Elementor Free.', 'popup-for-elementor'); ?></div>
            </div>
            <div class="faq-item">
                <div class="faq-question"><?php echo esc_html__('How do I create a popup?', 'popup-for-elementor'); ?></div>
                <div class="faq-answer"><?php echo esc_html__('Go to Templates > Saved Templates, and create a new section using the Popup widget.', 'popup-for-elementor'); ?></div>
            </div>
            <div class="faq-item">
                <div class="faq-question"><?php echo esc_html__('Can I use shortcodes or contact forms?', 'popup-for-elementor'); ?></div>
                <div class="faq-answer"><?php echo esc_html__('Yes. You can embed any Elementor-compatible widget inside your popup template.', 'popup-for-elementor'); ?></div>
            </div>
            <div class="faq-item">
                <div class="faq-question"><?php echo esc_html__('How do I unlock more features?', 'popup-for-elementor'); ?></div>
                <div class="faq-answer"><?php echo esc_html__('Upgrade to Pro for advanced triggers like scroll, adblock detection, inactivity, plus detailed statistics and more.', 'popup-for-elementor'); ?></div>
            </div>
        </div>

        <div class="pfe-plans" id="plans-section">
            <h2><?php echo esc_html__('Upgrade to Pro', 'popup-for-elementor'); ?></h2>
            <p><?php echo esc_html__('Here you can highlight pricing plans, Pro features, and benefits. This content will be displayed when the user clicks Compare Plans.', 'popup-for-elementor'); ?></p>
            <div class="popup-comparativa">
  <h2><?php esc_html_e('Feature Comparison', 'popup-for-elementor'); ?></h2>
  <div class="comparison-table">
    <div class="header"><?php esc_html_e('Feature', 'popup-for-elementor'); ?></div>
    <div class="header"><?php esc_html_e('Free', 'popup-for-elementor'); ?></div>
    <div class="header"><?php esc_html_e('Pro', 'popup-for-elementor'); ?></div>

    <div data-label="Feature"><?php esc_html_e('Visual editor with Elementor', 'popup-for-elementor'); ?></div><div class="yes"><?php esc_html_e('Yes', 'popup-for-elementor'); ?></div><div class="yes"><?php esc_html_e('Yes', 'popup-for-elementor'); ?></div>
    <div data-label="Feature"><?php esc_html_e('Compatible with Elementor Free', 'popup-for-elementor'); ?></div><div class="yes"><?php esc_html_e('Yes', 'popup-for-elementor'); ?></div><div class="yes"><?php esc_html_e('Yes', 'popup-for-elementor'); ?></div>
    <div data-label="Feature"><?php esc_html_e('Custom templates', 'popup-for-elementor'); ?></div><div class="yes"><?php esc_html_e('Yes', 'popup-for-elementor'); ?></div><div class="yes"><?php esc_html_e('Yes', 'popup-for-elementor'); ?></div>
    <div data-label="Feature"><?php esc_html_e('Responsive popups', 'popup-for-elementor'); ?></div><div class="yes"><?php esc_html_e('Yes', 'popup-for-elementor'); ?></div><div class="yes"><?php esc_html_e('Yes', 'popup-for-elementor'); ?></div>

    <div data-label="Feature"><?php esc_html_e('Basic triggers (load, delay, exit intent, cookies)', 'popup-for-elementor'); ?></div><div class="yes"><?php esc_html_e('Yes', 'popup-for-elementor'); ?></div><div class="yes"><?php esc_html_e('Yes', 'popup-for-elementor'); ?></div>
    <div data-label="Feature"><?php esc_html_e('Advanced triggers (scroll, click, AdBlock, etc.)', 'popup-for-elementor'); ?></div><div class="no"><?php esc_html_e('No', 'popup-for-elementor'); ?></div><div class="yes"><?php esc_html_e('Yes', 'popup-for-elementor'); ?></div>

    <div data-label="Feature"><?php esc_html_e('Basic stats (views, clicks, closures)', 'popup-for-elementor'); ?></div><div class="no"><?php esc_html_e('No', 'popup-for-elementor'); ?></div><div class="yes"><?php esc_html_e('Yes', 'popup-for-elementor'); ?></div>
    <div data-label="Feature"><?php esc_html_e('Advanced stats (conversion rate, duration, unique users)', 'popup-for-elementor'); ?></div><div class="no"><?php esc_html_e('No', 'popup-for-elementor'); ?></div><div class="yes"><?php esc_html_e('Yes', 'popup-for-elementor'); ?></div>

    <div data-label="Feature"><?php esc_html_e('Priority support', 'popup-for-elementor'); ?></div><div class="no"><?php esc_html_e('No', 'popup-for-elementor'); ?></div><div class="yes"><?php esc_html_e('Yes', 'popup-for-elementor'); ?></div>
  </div>
</div>
<div class="popup-plans">
  <div class="plan">
    <h3><?php esc_html_e('Free', 'popup-for-elementor'); ?></h3>
    <div class="price"><?php esc_html_e('$0', 'popup-for-elementor'); ?></div>
    <small><?php esc_html_e('Start without commitment', 'popup-for-elementor'); ?></small>
    <p class="desc"><?php esc_html_e('Try the plugin with basic features.', 'popup-for-elementor'); ?></p>
    <ul>
      <li><?php esc_html_e('On load trigger', 'popup-for-elementor'); ?></li>
      <li><?php esc_html_e('Mouse exit', 'popup-for-elementor'); ?></li>
      <li><?php esc_html_e('Delay timer', 'popup-for-elementor'); ?></li>
      <li><?php esc_html_e('Show once', 'popup-for-elementor'); ?></li>
    </ul>
    <a class="buy disabled" href="https://es.wordpress.org/plugins/popup-for-elementor/"><?php esc_html_e('Download', 'popup-for-elementor'); ?></a>
  </div>

  <div class="plan">
    <h3><?php esc_html_e('Single Site', 'popup-for-elementor'); ?></h3>
    <div class="price"><?php esc_html_e('$25', 'popup-for-elementor'); ?></div>
    <small><?php esc_html_e('Renews at $27.23/year', 'popup-for-elementor'); ?></small>
    <p class="desc"><?php esc_html_e('Choose this if you only need one installation.', 'popup-for-elementor'); ?></p>
    <ul>
      <li><?php esc_html_e('Advanced triggers', 'popup-for-elementor'); ?></li>
      <li><?php esc_html_e('Full compatibility', 'popup-for-elementor'); ?></li>
      <li><?php esc_html_e('1 site', 'popup-for-elementor'); ?></li>
      <li><?php esc_html_e('Priority support', 'popup-for-elementor'); ?></li>
    </ul>
    <a class="buy" href="https://popupforelementor.com/en/home/#contact"><?php esc_html_e('Buy now', 'popup-for-elementor'); ?></a>
  </div>

  <div class="plan">
    <h3><?php esc_html_e('5 Sites', 'popup-for-elementor'); ?></h3>
    <div class="price"><?php esc_html_e('$65', 'popup-for-elementor'); ?></div>
    <small><?php esc_html_e('Renews at $70.79/year', 'popup-for-elementor'); ?></small>
    <p class="desc"><?php esc_html_e('Ideal for small teams and freelancers.', 'popup-for-elementor'); ?></p>
    <ul>
      <li><?php esc_html_e('Everything in Single Site', 'popup-for-elementor'); ?></li>
      <li><?php esc_html_e('Up to 5 installations', 'popup-for-elementor'); ?></li>
      <li><?php esc_html_e('Multi-user', 'popup-for-elementor'); ?></li>
      <li><?php esc_html_e('Fast support', 'popup-for-elementor'); ?></li>
    </ul>
    <a class="buy" href="https://popupforelementor.com/en/home/#contact"><?php esc_html_e('Buy now', 'popup-for-elementor'); ?></a>
  </div>

  <div class="plan">
    <h3><?php esc_html_e('Unlimited', 'popup-for-elementor'); ?></h3>
    <div class="price"><?php esc_html_e('$70', 'popup-for-elementor'); ?></div>
    <small><?php esc_html_e('Renews at $76.23/year', 'popup-for-elementor'); ?></small>
    <p class="desc"><?php esc_html_e('Designed for agencies and large projects.', 'popup-for-elementor'); ?></p>
    <ul>
      <li><?php esc_html_e('Unlimited installations', 'popup-for-elementor'); ?></li>
      <li><?php esc_html_e('All triggers', 'popup-for-elementor'); ?></li>
      <li><?php esc_html_e('VIP support', 'popup-for-elementor'); ?></li>
      <li><?php esc_html_e('90% discount', 'popup-for-elementor'); ?></li>
    </ul>
    <a class="buy" href="https://popupforelementor.com/en/home/#contact"><?php esc_html_e('Buy now', 'popup-for-elementor'); ?></a>
  </div>
</div>

        </div>
    </div>
    <?php
}
