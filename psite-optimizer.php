<?php

/**
 * @package           Psite Optimizer
 * @author            Krešimir Meze
 * @copyright         2021 Krešimir Meze
 * @license           GPL-3.0
 *
 * @wordpress-plugin
 * Plugin Name:       Psite Optimizer
 * Plugin URI:        https://github.com/kmeze/psite-optimizer
 * Description:       Turns off unnecessary WordPress features and speeds up page loading.
 * Version:           1.0
 * Requires at least: 5.6
 * Requires PHP:      7.2
 * Author:            Krešimir Meze
 * Author URI:        https://github.com/kmeze
 * License:           GPL v3
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       psopt
 * Domain Path:       /languages
 *
 * Psite Optimizer is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, version 3 of the License.
 *
 * Psite Optimizer is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Psite Optimizer. If not, see https://www.gnu.org/licenses/gpl-3.0.html.
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
 * Options page
 */
function psopt_admin_menu() {
	// Create plugin options page in Settings Admin Menu
	add_options_page( __( 'Optimization Settings', 'psopt' ), __( 'Optimization', 'psopt' ), 'manage_options', 'psopt_options_page', 'psopt_options_page_html' );
}

add_action( 'admin_menu', 'psopt_admin_menu' );

function psopt_admin_init() {
	// Register settings
	register_setting( 'psopt_options', 'psopt_options' );

	// Register main section
	add_settings_section( 'psopt_options_main', __( 'Posts and Page Cleanup', 'psopt' ), 'psopt_options_main_html', 'psopt_options_page' );

	// Options fields
	add_settings_field( 'psopt_dns_prefetch_links', __( 'DNS prefetch links', 'psopt' ), 'psopt_options_field_dns_prefetch_links_html', 'psopt_options_page', 'psopt_options_main' );
	add_settings_field( 'psopt_generator_meta', __( 'Generator meta element', 'psopt' ), 'psopt_options_field_generator_meta_html', 'psopt_options_page', 'psopt_options_main' );
}

add_action( 'admin_init', 'psopt_admin_init' );

/**
 * Options page callbacks
 */
function psopt_options_field_dns_prefetch_links_html() {
	$options = get_option( 'psopt_options' );
	?>
    <label for="dns_prefetch_links">
        <input id="dns_prefetch_links"
               name="psopt_options[dns_prefetch_links]"
               type="checkbox" <?php echo isset( $options['dns_prefetch_links'] ) ? ' checked="checked" ' : ''; ?>>
		<?php esc_html_e( 'Disable DNS prefetch links', 'psopt' ); ?>
    </label>
	<?php
}

function psopt_options_field_generator_meta_html() {
	$options = get_option( 'psopt_options' );
	?>
    <label for="psopt_generator_meta">
        <input id="psopt_generator_meta"
               name="psopt_options[generator_meta]"
               type="checkbox" <?php echo isset( $options['generator_meta'] ) ? ' checked="checked" ' : ''; ?>>
		<?php esc_html_e( 'Disable generator meta element', 'psopt' ); ?>
    </label>
	<?php
}

function psopt_options_page_html() {
	?>
    <div class="wrap">
        <h1><?php _e( 'Optimization Settings', 'psopt' ) ?></h1>
        <form method="post" action="options.php">
			<?php settings_fields( 'psopt_options' ); ?>
			<?php do_settings_sections( 'psopt_options_page' ); ?>
            <p class="submit">
                <input type="submit" name="submit" id="submit" class="button button-primary"
                       value="<?php _e( 'Save Changes' ) ?>">
            </p>
        </form>
    </div>
	<?php
}

function psopt_options_main_html() {
	esc_html_e( 'Uncheck options below to remove link elements from all posts and pages <head>.', 'psopt' );
}

/**
 * HTML cleanup
 */
// Get settings
$options = get_option( 'psopt_options' );

// DNS prefetch link
if ( isset( $options['dns_prefetch_links'] ) ) {
	remove_action( 'wp_head', 'wp_resource_hints', 2 );
}

// Generator meta element
if ( isset( $options['generator_meta'] ) ) {
	remove_action( 'wp_head', 'wp_generator' );
}

// Windows Live Writer manifest link
remove_action( 'wp_head', 'wlwmanifest_link' );

// Weblog client link
remove_action( 'wp_head', 'rsd_link' );

// WordPress Page/Post shortlinks
remove_action( 'wp_head', 'wp_shortlink_wp_head' );

// Post relational links
remove_action( 'wp_head', 'start_post_rel_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'adjacent_posts_rel_link' );

// Emoji support
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

// REST API link
remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );

// oEmbed discovery support
remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
remove_action( 'wp_head', 'wp_oembed_add_host_js' );
remove_action( 'rest_api_init', 'wp_oembed_register_route' );
remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );

// RSS Feed links
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'feed_links_extra', 3 );

/**
 * Activate the plugin.
 */
function psopt_activate() {
}

register_activation_hook( __FILE__, 'psopt_activate' );

/**
 * Deactivation hook.
 */
function psopt_deactivate() {
}

register_deactivation_hook( __FILE__, 'psopt_deactivate' );