<?php
/**
 * Plugin Name: Scroll In
 * Description: Add GSAP scroll reveal animation to Elementor text widgets. Multiple animation styles with per-class usage (fade, slide, rotate, scale, blur, flip, drop, wave, skew).
 * Version: 2.4
 * Author: WP Design Lab
 */

if (!defined("ABSPATH")) exit;

/**
 * Enqueue GSAP + plugin scripts
 */
function si_enqueue_scripts() {
    if (!is_admin() && get_option("si_enabled", 1)) {
        // Core GSAP scripts
        wp_enqueue_script("gsap", "https://unpkg.com/gsap@3/dist/gsap.min.js", [], null, true);
        wp_enqueue_script("splittext", "https://assets.codepen.io/16327/SplitText3-beta.min.js", ["gsap"], null, true);
        wp_enqueue_script("scrolltrigger", "https://unpkg.com/gsap@3/dist/ScrollTrigger.min.js", ["gsap"], null, true);

        // Options for JS
        $options = [
            "speed"    => min(max(floatval(get_option("si_speed", 1)), 0.1), 5),      // 0.1s – 5s
            "stagger"  => min(max(floatval(get_option("si_stagger", 0.04)), 0.01), 1), // 0.01 – 1s
            "delay"    => min(max(floatval(get_option("si_delay", 0)), 0), 5),        // 0 – 5s
            "once"     => get_option("si_once", 0),
        ];

        // Plugin script
        wp_enqueue_script("si-script", plugin_dir_url(__FILE__) . "script.js", ["gsap", "splittext", "scrolltrigger"], "2.4", true);
        wp_localize_script("si-script", "siOptions", $options);
    }
}
add_action("wp_enqueue_scripts", "si_enqueue_scripts");

/**
 * Admin menu
 */
function si_add_admin_menu() {
    add_options_page("Scroll In Settings", "Scroll In", "manage_options", "si-settings", "si_options_page");
}
add_action("admin_menu", "si_add_admin_menu");

/**
 * Register settings
 */
function si_register_settings() {
    $settings = ["si_enabled", "si_speed", "si_stagger", "si_delay", "si_once"];
    foreach ($settings as $setting) {
        register_setting("si_settings_group", $setting);
    }
}
add_action("admin_init", "si_register_settings");

/**
 * Admin settings page
 */
function si_options_page() { ?>
    <div class="wrap">
        <h1>Scroll In - Animation Settings</h1>
        <form method="post" action="options.php">
            <?php settings_fields("si_settings_group"); ?>
            <?php do_settings_sections("si_settings_group"); ?>

            <table class="form-table">
                <tr>
                    <th scope="row">Enable Animation</th>
                    <td>
                        <input type="checkbox" name="si_enabled" value="1" <?php checked(1, get_option('si_enabled', 1)); ?> />
                    </td>
                </tr>
                <tr>
                    <th scope="row">Animation Speed (Duration)</th>
                    <td>
                        <input type="number" step="0.1" min="0.1" max="5" name="si_speed" value="<?php echo esc_attr(get_option('si_speed', 1)); ?>" /> seconds
                        <p class="description">How long each animation runs (0.1 – 5s).</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Stagger Delay</th>
                    <td>
                        <input type="number" step="0.01" min="0.01" max="1" name="si_stagger" value="<?php echo esc_attr(get_option('si_stagger', 0.04)); ?>" /> seconds
                        <p class="description">Delay between characters (0.01 – 1s).</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Initial Delay</th>
                    <td>
                        <input type="number" step="0.1" min="0" max="5" name="si_delay" value="<?php echo esc_attr(get_option('si_delay', 0)); ?>" /> seconds
                        <p class="description">Wait before animation starts (0 – 5s).</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Play Once?</th>
                    <td><input type="checkbox" name="si_once" value="1" <?php checked(1, get_option('si_once', 0)); ?> /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>

        <hr>
        <h2>How to Use</h2>
        <p>Apply any of the following CSS classes to your Elementor text widget (or any text block) to reveal it with animation when scrolled into view:</p>

        <h3>Available CSS Classes:</h3>
        <ul>
            <li><code>scroll-in-fade</code> → Fade In</li>
            <li><code>scroll-in-slide</code> → Slide Left</li>
            <li><code>scroll-in-rotate</code> → 3D Rotate</li>
            <li><code>scroll-in-scale</code> → Scale Pop</li>
            <li><code>scroll-in-blur</code> → Blur Reveal</li>
            <li><code>scroll-in-flip</code> → Flip Y</li>
            <li><code>scroll-in-drop</code> → Drop Bounce</li>
            <li><code>scroll-in-wave</code> → Wavy Float</li>
            <li><code>scroll-in-skew</code> → Skew Slide</li>
        </ul>
    </div>
<?php }
