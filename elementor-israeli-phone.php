<?php
/**
 * Plugin Name: Elementor Israeli Phone Validation
 * Plugin URI: https://www.dorzki.co.il
 * Description: An israeli phone validator for Elementor phone field.
 * Version: 1.0.0
 * Author: Dor Zuberi (dorzki)
 * Author URI: https://www.dorzki.co.il
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: dorzki-elm-phone
 *
 * @packeage   WordPress
 * @subpackage Plugins
 * @author     Dor Zuberi <webmaster@dorzki.co.il>
 * @link       https://www.dorzki.co.il
 * @version    1.0.0
 */

// Block if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Enable support for plugin localization and internationalization.
 */
function dorzki_register_plugin_i18n() {

	load_plugin_textdomain( 'dorzki-elm-phone', false, basename( dirname( __FILE__ ) ) . '/languages/' );

}

add_action( 'plugins_loaded', 'dorzki_register_plugin_i18n' );


/**
 * Checks if Elementor is installed and activated.
 *
 * @return bool
 */
function dorzki_check_required_plugins() {

	if ( ! in_array( 'elementor-pro/elementor-pro.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ), true ) ) {

		add_action( 'admin_notices', 'dorzki_display_elementor_notice' );

		return false;

	}

	include_once 'class-plugin.php';

}

add_action( 'plugins_loaded', 'dorzki_check_required_plugins' );


/**
 * Displays an admin notice for WooCommerce.
 */
function dorzki_display_elementor_notice() {

	$notice = sprintf(
	/* translators: 1: Elementor Pro 2: Plugin Name */
		esc_html__( '"%1$s" is required to be installed and activated in order to use "%2$s".', 'dorzki-elm-phone' ),
		'<strong>' . esc_html__( 'Elementor Pro', 'dorzki-elm-phone' ) . '</strong>',
		'<strong>' . esc_html__( 'Elementor Israeli Phone Validation', 'dorzki-elm-phone' ) . '</strong>'
	);

	echo "<div class='notice notice-error'><p>{$notice}</p></div>";

}