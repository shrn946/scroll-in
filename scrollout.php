<?php
/**
 * Plugin Name: Scroll In
 * Description: Add GSAP scroll reveal animation to Elementor text widgets. Just add the CSS class "scroll-in" to trigger the effect.
 * Version: 2.6
 * Author: WP Design Lab
 */

if (!defined("ABSPATH")) exit;

/**
 * Enqueue GSAP + plugin scripts
 */
function si_enqueue_scripts() {
    if (!is_admin()) {
        // Core GSAP scripts
        wp_enqueue_script("gsap", "https://unpkg.com/gsap@3/dist/gsap.min.js", [], null, true);
        wp_enqueue_script("splittext", "https://assets.codepen.io/16327/SplitText3-beta.min.js", ["gsap"], null, true);
        wp_enqueue_script("scrolltrigger", "https://unpkg.com/gsap@3/dist/ScrollTrigger.min.js", ["gsap"], null, true);

        // Plugin script
        wp_enqueue_script("si-script", plugin_dir_url(__FILE__) . "script.js", ["gsap", "splittext", "scrolltrigger"], "2.6", true);
    }
}
add_action("wp_enqueue_scripts", "si_enqueue_scripts");

/**
 * Admin menu (optional, can remove completely if no settings needed)
 */
function si_add_admin_menu() {
    add_options_page("Scroll In Settings", "Scroll In", "manage_options", "si-settings", "si_options_page");
}
add_action("admin_menu", "si_add_admin_menu");

/**
 * Admin settings page (optional)
 */
function si_options_page() { ?>
    <div class="wrap">
        <h1>Scroll In</h1>
        <p>Simply add the class <code>scroll-in</code> to any Elementor text widget (or any text block). The animation will trigger when the element scrolls into view.</p>
    </div>
<?php }
