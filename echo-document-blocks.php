<?php
/**
 * Plugin Name: Blocks for Documents, Articles and FAQs
 * Plugin URI: https://www.echoplugins.com
 * Description: Easy and fast way to write articles and documents with our simple but powerful blocks.
 * Version: 1.0.6
 * Author: Echo Plugins
 * Author URI: https://www.echoplugins.com
 * Text Domain: blocks-for-documents-articles-and-faqs
 * Domain Path: languages
 * License: GNU General Public License v2.0
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Blocks for Documents, Articles and FAQs is distributed under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Blocks for Documents, Articles and FAQs is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Blocks for Documents, Articles and FAQs. If not, see <http://www.gnu.org/licenses/>.
 *
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'ECHO_BLOCKS_VERSION', '1.0.6' );
define( 'ECHO_BLOCKS_PLUGIN_NAME', 'Blocks for Documents, Articles and FAQs' );
define( 'ECHO_BLOCKS_MINIMUM_PHP_VERSION', '5.4' );
define( 'ECHO_BLOCKS__FILE__', __FILE__ );

define( 'ECHO_BLOCKS_DIR_PATH', plugin_dir_path( ECHO_BLOCKS__FILE__ ) );
define( 'ECHO_BLOCKS_DIR_URL', plugin_dir_url( ECHO_BLOCKS__FILE__ ) );
define( 'ECHO_BLOCKS_URL', plugins_url( '/', ECHO_BLOCKS__FILE__ ) );

define( 'ECHO_BLOCKS_ASSETS', trailingslashit( ECHO_BLOCKS_DIR_URL . 'assets' ) );
define( 'ECHO_BLOCKS_ASSETS_PATH', ECHO_BLOCKS_DIR_PATH . 'assets/' );
define( 'ECHO_BLOCKS_ASSETS_URL', ECHO_BLOCKS_URL . 'assets/' );

define( 'ECHO_BLOCKS_TABLET_BREAKPOINT', '976' );
define( 'ECHO_BLOCKS_MOBILE_BREAKPOINT', '767' );

/**
 * Load the plugin after Elementor loads.
 */
function epbl_load_plugin() {

	load_plugin_textdomain( 'blocks-for-documents-articles-and-faqs' );

	// Check that builder is installed and activated
	if ( ! function_exists( 'register_block_type' ) ) {
		add_action( 'admin_notices', 'epbl_admin_notice_builder_is_missing' );
		return;
	}

	// Check for required PHP version
	if ( version_compare( PHP_VERSION, ECHO_BLOCKS_MINIMUM_PHP_VERSION, '<' ) ) {
		add_action( 'admin_notices', 'epbl_admin_notice_php_is_old' );
		return;
	}

	require ECHO_BLOCKS_DIR_PATH . 'echo-document-blocks-plugin.php';
}
add_action( 'plugins_loaded', 'epbl_load_plugin' );

/**
 * Show Admin notice if the builder is missing
 */
function epbl_admin_notice_builder_is_missing() {
	$notice = sprintf(
	/* translators: 1: Plugin name */
		__( '%1$s needs Gutenberg in order to work.', 'blocks-for-documents-articles-and-faqs' ),
		'<strong>' . __( 'Blocks for Documents, Articles and FAQs', 'blocks-for-documents-articles-and-faqs' ) . '</strong>'
	);

	printf( '<div class="notice notice-warning is-dismissible"><p style="padding: 13px 0">%1$s</p></div>', $notice );
}

/**
 * Show Admin notice if PHP version is old
 */
function epbl_admin_notice_php_is_old() {
	$notice = sprintf(
	/* translators: 1: Plugin name 2: Minimum PHP version */
		esc_html__( '"%1$s" requires PHP version to be %3$s or greater.', 'blocks-for-documents-articles-and-faqs' ),
		'<strong>' . esc_html__( 'Blocks for Documents, Articles and FAQs ', 'blocks-for-documents-articles-and-faqs' ) . '</strong>',
		ECHO_BLOCKS_MINIMUM_PHP_VERSION
	);

	printf( '<div class="notice notice-warning is-dismissible"><p style="padding: 13px 0">%1$s</p></div>', $notice );
}
