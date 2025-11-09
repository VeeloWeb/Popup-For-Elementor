=== Popup for Elementor ===
Contributors: veelo
Tags: popup, elementor, modal, wordpress popup
Requires at least: 5.8
Tested up to: 6.8.3
Requires PHP: 7.4
Stable tag: 1.6.2
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Create powerful, customizable popups with **Elementor Free** — no coding or Elementor Pro required.

== Description ==

✨ **Popup for Elementor** is the easiest and most lightweight popup builder for **Elementor Free**.  
Design responsive, conversion-focused popups directly inside Elementor with full visual control — 100% no-code and performance-optimized. 🚀

Unlike other popup plugins, this one works **without Elementor Pro** and **without third-party modal builders**. Everything is native, simple, and fast.

### 🔹 Key Features

– 🎨 **Design Freedom with Elementor**  
  Build beautiful popups visually. Control layout, colors, padding, overlay, borders, animations, and close buttons.  

– ⚡ **Free Trigger Options (No Pro Needed)**  
  – Show on page load  
  – Show after a delay (in seconds)  
  – Show on exit intent *(improved in 1.6.2)*  
  – Show on click *(added in 1.5.8)*  
  – Option to show only once (cookie-based, now works with all triggers)

– 🧠 **Smart Popup Behavior**  
  – Close popup on ESC key  
  – Close when clicking outside (overlay)  
  – Option to disable right-click inside popup content

– 🧩 **Elementor Template Integration**  
  – Load any Elementor section or saved template directly inside the popup for ultimate flexibility

– ⚙️ **Performance-First**  
  – Lightweight JavaScript and CSS  
  – Clean code, no dependencies  
  – Fully responsive and SEO-friendly  
  – Works with any WordPress theme

– 💡 **No Elementor Pro Required**  
  Every feature works natively with **Elementor Free**.

**Optional Pro Version:**  
Adds advanced targeting and automation features:  
– 📜 Scroll-based and inactivity triggers  
– 🌐 Referral URL and login-based display  
– 🕒 Time-scheduled popups  
– 🚫 AdBlock detection  
– ⚡ Dynamic content loading for speed and personalization  

**Official Website:** https://www.popupforelementor.com  
**Developer:** https://www.veelo.es  
**Support:** support@popupforelementor.com  
We respond to support requests within 48 hours.  
💬 Live chat available on our website with typical response times between 2 and 3 hours.

== Installation ==

1. Download the plugin ZIP file.  
2. In your WordPress admin, go to **Plugins → Add New**.  
3. Click **Upload Plugin** and select the downloaded file.  
4. Click **Install Now**, then **Activate**.  
5. In Elementor, search for **Popup for Elementor** in the widget panel.

== Frequently Asked Questions ==

= Do I need Elementor Pro? =  
No. Popup for Elementor works perfectly with **Elementor Free**.

= How do I make a popup appear when users click a button or link? =  
Use the **Click Trigger** (added in version 1.5.8).  
You can set a CSS selector or Elementor element to open the popup.

= Can I control when the popup appears? =  
Yes — you can trigger it **on load**, **after a delay**, **on click**, or **on exit intent**.

= Does Exit Intent work on mobile? =  
Yes — since **1.6.2**, Exit Intent includes a **mobile fallback** that triggers after a minimum time on page and scroll depth.

= Can I show the popup only once? =  
Yes. Enable the **Show only once** option to use a cookie that prevents the popup from appearing again.  
Since **1.6.2**, the cookie is set **when the user closes the popup** (X, overlay, or Escape).

= Can I use Elementor templates inside the popup? =  
Absolutely. Load any Elementor template or section inside the popup container.

== Screenshots ==

1. Popup widget settings inside the Elementor editor  
2. Trigger and visibility controls  
3. Popup design customization  
4. Example popup rendered on the page  
5. Elementor template loaded inside a popup

== Changelog ==

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

= 1.6.2 =
Now Exit Intent also works on mobile devices.  
Popups trigger after scroll + time, and links inside popups are now fully clickable.  
Highly recommended update for all users.
