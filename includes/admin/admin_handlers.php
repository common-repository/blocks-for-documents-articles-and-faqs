<?php
namespace Echo_Doc_Blocks\Includes\Admin;

use Echo_Doc_Blocks\Includes\Utilities;

defined( 'ABSPATH' ) || exit();

/**
 * Handle ajax requests for Admin Settings
 */
class Admin_Handlers {

	const EPBL_DEBUG = 'epbl_debug';

	public function __construct() {
		add_action( 'admin_init', array( $this, 'download_debug_info' ) );
		add_action( 'wp_ajax_epbl_toggle_debug', array( $this, 'toggle_debug' ) );
		add_action( 'wp_ajax_nopriv_epbl_toggle_debug', array( $this, 'user_not_logged_in' ) );
	}

	/**
	 * Triggered when user clicks to toggle debug.
	 */
	public function toggle_debug() {

		// verify that request is authentic
		if ( ! isset( $_REQUEST['_wpnonce_epbl_toggle_debug'] ) || !wp_verify_nonce( $_REQUEST['_wpnonce_epbl_toggle_debug'], '_wpnonce_epbl_toggle_debug' ) ) {
			Utilities::ajax_show_error_die( __( 'Refresh your page', 'blocks-for-documents-articles-and-faqs' ) );
		}

		// ensure user has correct permissions
		if ( ! current_user_can( 'manage_options' ) ) {
			Utilities::ajax_show_error_die( __( 'You do not have permission.', 'blocks-for-documents-articles-and-faqs' ) );
		}

		$is_debug_on = Utilities::get_wp_option( Admin_Handlers::EPBL_DEBUG, false );

		$is_debug_on = empty($is_debug_on) ? 1 : 0;

		Utilities::save_wp_option( Admin_Handlers::EPBL_DEBUG, $is_debug_on, true );

		// we are done here
		Utilities::ajax_show_info_die( __( 'Debug is now ' . ( $is_debug_on ? 'on' : 'off' ), 'blocks-for-documents-articles-and-faqs' ) );
	}

	/**
	 * Generates a System Info download file
	 */
	public function download_debug_info() {

		if ( Utilities::post('action') != 'epbl_download_debug_info' ) {
			return;
		}

		// verify that the request is authentic
		if ( ! isset( $_REQUEST['_wpnonce_epbl_download_debug_info'] ) || ! wp_verify_nonce( $_REQUEST['_wpnonce_epbl_download_debug_info'], '_wpnonce_epbl_download_debug_info' ) ) {
			Utilities::ajax_show_error_die(__( 'Debug not loaded. First refresh your page', 'blocks-for-documents-articles-and-faqs' ));
		}

		// ensure user has correct permissions - only admin can download info
		if ( ! current_user_can( 'manage_options' ) ) {
			Utilities::ajax_show_error_die(__( 'You do not have permission to access this page', 'blocks-for-documents-articles-and-faqs' ));
		}

		Utilities::save_wp_option( Admin_Handlers::EPBL_DEBUG, false, true);

		nocache_headers();

		header( 'Content-Type: text/plain' );
		header( 'Content-Disposition: attachment; filename="echo-epbl-debug-info.txt"' );

		$output = Admin_Pages::display_debug_data();
		echo wp_strip_all_tags( $output );

		die();
	}

	public function user_not_logged_in() {
		Utilities::ajax_show_error_die( '<p>' . __( 'You are not logged in. Refresh your page and log in.', 'blocks-for-documents-articles-and-faqs' ) . '</p>', __( 'Cannot save your changes', 'blocks-for-documents-articles-and-faqs' ) );
	}
}