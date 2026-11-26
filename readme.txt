=== Popup for Elementor ===
Contributors: veelo
Tags: popup, elementor, modal, wordpress popup
Requires at least: 6.6
Tested up to: 7.2
Requires PHP: 7.4
Requires Plugins: elementor
Stable tag: 1.6.7
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Create customizable popups with Elementor Free. Add multiple popups per page with independent triggers, animations and close controls.

== Description ==

✨ **Your content. Your design. Your popups.**

Create customizable popups directly in **Elementor Free**, using the templates you already know how to build. Choose your content, style your popup and decide when it appears — **no coding or Elementor Pro required**.

🚀 **New in 1.6.7: multiple popups on the same page!**

Add a Popup Widget for each message, offer or announcement. Each popup has its own template, trigger and close controls, with **nothing extra to activate**.

= 🎨 Design it your way =

Make your popup feel at home on your website with responsive controls for:

* **Size and placement:** width, height and alignment.
* **Colors and spacing:** background, overlay, margins and padding.
* **Finishing touches:** borders, shadows and close-button styling.
* **Motion:** entrance and exit animations, with your chosen duration.

The close button follows the popup's animation, appearing and disappearing with it.

= ⚡ Open at the right moment =

Choose the trigger that fits your content:

* 🖱️ **On click:** open from a button, link, class or ID selector.
* ⏱️ **After a delay:** give visitors a moment before showing your message.
* 🚪 **On exit intent:** display a popup when the pointer leaves the page.
* 👋 **On page load:** welcome visitors as they arrive.
* 🍪 **Once-only display options:** use cookies to limit repeat appearances.

📱 On touch devices and narrow screens, exit intent uses a time-and-scroll alternative. See the FAQ for details.

= 🧩 One page, multiple popups =

Give different messages their own space. **Popups work independently**, even when another one is already open.

* Add as many Popup Widgets as your page needs.
* Select a template and trigger for each widget.
* The most recently opened popup appears on top.
* Close one popup without closing the others.
* Use **Escape** to close the topmost popup.

= 🖼️ Bring your Elementor templates =

Build your popup content as a saved Elementor template, then select it in the widget. Update the template whenever your message changes.

A simple **editor-only example** helps you see the popup before selecting a template. It does not create a template in your library or add example content to your public website.

= 🛠️ A clearer dashboard =

Get started with **template shortcuts, a three-step setup guide, quick answers and support links**. No Pro upgrade banners or pricing panels.

= 🌍 English and Spanish included =

The dashboard, widget controls, options and help text are available in **English and Spanish**. WordPress uses the active interface language.

= 💚 Built for Elementor Free =

Create and manage your popups without an Elementor Pro subscription. Close them with the **X button, an overlay click or Escape**.

= 💬 We're here to help =

* 🌐 **Official website:** https://www.popupforelementor.com
* 🧑‍💻 **Developer:** https://www.veelo.es
* ✉️ **Support:** support@popupforelementor.com

== Installation ==

1. Install and activate Elementor.
2. Install Popup for Elementor through Plugins > Add New, or upload the plugin ZIP.
3. Activate the plugin.
4. Open Popup for Elementor in the WordPress dashboard and create an Elementor template for your popup content.
5. Edit a page with Elementor, add Popup Widget and select the saved template.
6. Choose the visibility trigger, adjust the appearance, and save and preview your page.
7. To add another popup, add another Popup Widget and configure it independently.

== Frequently Asked Questions ==

= Do I need Elementor Pro? =
No. The plugin works with Elementor Free.

= Can I add multiple popups to the same page? =
Yes. Add a Popup Widget for each popup and choose its template and trigger. Multiple popups work automatically, without an additional switch.

= Can another popup open while one is already visible? =
Yes. Popups open independently. The latest one appears on top, and each popup has its own close button. Escape closes the topmost popup.

= How do I open a popup with a button or link? =
Enable Trigger by selector in the widget visibility controls. Use a class selector such as .my-button or an ID selector such as #my-button. A name entered without a prefix is treated as a class.

= Does exit intent work on mobile? =
On touch devices or narrow screens, the plugin uses a mobile alternative: a scroll event after at least five seconds on the page and at least 35 percent scroll depth. This approximates engagement; it does not detect a mobile browser closing.

= How does the once-only display option work? =
The Show Only Once option opens the popup automatically and uses a cookie to suppress repeat displays. Exit intent also has its own Only once setting. The cookie is stored when the popup closes and lasts seven days; it is not limited to the current browser session.

= What happens to existing popups when updating? =
Existing Elementor templates and saved widget settings are retained. The first popup on a page keeps the existing frequency cookie; additional popups use their own cookies. As with any update, back up your site and check existing pages before deploying to a live site.

= Where do I edit the popup content? =
Edit the saved Elementor template selected in the widget. You can also open it with Edit Template in the widget preview.

= Are English and Spanish included? =
Yes. English is the source language. Spanish translations are included in the PO and compiled MO catalogs. WordPress selects the interface language according to the active locale.

== Screenshots ==

1. Popup widget settings inside the Elementor editor.
2. Trigger and visibility controls.
3. Popup design customization.
4. Example popup rendered on the page.
5. Elementor template loaded inside a popup.

== Changelog ==

= 1.6.7 =
* Tested with WordPress 7.2.
* New: A simple translated example appears in the editor when no template is selected. No library template is created and example content is never displayed on the public site.
* New: Automatic multiple-popups support with independent templates, triggers, state and close controls.
* New: Popups can open simultaneously; the most recently opened appears on top and Escape closes the topmost popup.
* Fix: Removed the one-popup-per-page restriction in the Elementor editor.
* Fix: Prevented function redeclaration and duplicate widget identifiers when rendering multiple popups.
* Fix: Restored close and reopen controls in the Elementor editor.
* Fix: Synchronized the close button with popup entrance and exit animations and respected the configured animation duration.
* Fix: Respected the delay activation control and isolated invalid selectors from other popups.
* Fix: Unified close and frequency-cookie handling, including the mobile exit-intent alternative.
* Improved: Replaced separate popup behavior scripts with one controller and per-widget configuration.
* Improved: Redesigned the dashboard with template shortcuts, a setup guide, accessible FAQs and help links. Dashboard styles load only on its own screen.
* Updated: Completed Spanish interface translations, regenerated the POT and PO catalogs, compiled the MO, and registered bundled translations.
* Removed: Pro upgrade notices, pricing and feature comparison panels.

= 1.6.6 =
* Minor bug fix.
* Tested WordPress 7.0

= 1.6.5 =
* Minor bug fixes and stability improvements.

= 1.6.4 =
* Fix: Prevented a brief visual flash of the internal editor modal header before popup initialization (FOUC issue in Elementor editor).
* Improved: Modal now initializes hidden by default to ensure smoother rendering and better compatibility with optimized environments.
* Update: Minor internal stability improvements.

= 1.6.3 =
* Fix: Minor bug fixes.
* Update: Compatibility adjustments for latest WordPress and Elementor versions.


= 1.6.2 =
* New: Added mobile fallback for Exit Intent (scroll + time). The popup now works on touch devices by showing after a minimum time and scroll depth.  
* Improved: Cookie logic for "Show Once" — cookie is now set only when the user closes the popup (close button, overlay click, or Escape key).  
* Fix: Links and buttons inside the popup are now fully clickable (resolved issues with Voxel and Elementor Free).  
* Improved: Event handling and overlay behavior to avoid duplicate triggers or blocked interactions.  
* Added: Debug flag to control console logs safely in production.  
* Update: Code cleanup, pointer-events, and z-index refinements for better theme compatibility.  
* Tested: Fully compatible with WordPress 6.8.3 and Elementor 3.22+.

= 1.6.1 =
* Minor bug fix.

= 1.6 =
* Fix: File correction and cleanup.

= 1.5.9 =
* Fix: Prevented rare fatal error caused by multiple declarations of `popup_for_elementor_register_assets()` on some setups.  
* Improved: Script registration now fully guarded and compatible with all caching and optimization plugins.  
* Update: Safe loading logic added to avoid duplicate includes.  

= 1.5.8 =
* New: Added Click Trigger to the free version (previously Pro only).  
* Improved: Exit Intent detection logic rewritten for smoother, more accurate behavior.  
* Improved: “Show only once” option now works across all triggers.  
* Fix: Minor issues when combining multiple triggers.  
* Update: Tested up to WordPress 6.8.3 and Elementor 3.22+.  
* UI: Minor visual and label adjustments in the widget controls.  

= 1.5.7 =
* Fix: Close button works properly with all trigger configurations.  
* New: Internal improvements to dynamic template loading.  
* Update: Compatibility tested with WordPress 6.9 and Elementor 3.20+.  
* Update: Minor UI tweaks in the widget editor.

= 1.5.6 =
* Fix: Resolved issues with dynamic width on mobile view.  
* New: Close on Escape key and overlay click now configurable.  
* Update: Improved template rendering system.

= 1.5.1 =
* Minor bug fixes and stability improvements.

= 1.5.0 =
* Initial public release.  
* Added support for On Load, Delay, and Exit Intent triggers.  
* Integrated cookie-based visibility control.  
* Full Elementor Free compatibility.  
* Pro version adds advanced targeting: scroll, referral, inactivity, schedule, login, and AdBlock detection.

== Upgrade Notice ==

= 1.6.7 =
Adds automatic multiple popups, independent triggers and close controls, a redesigned dashboard and completed Spanish translations. Saved templates and widget settings are retained. Check existing pages and cookie-based display behavior after updating.
