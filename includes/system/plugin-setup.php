<?php

use Echo_Doc_Blocks\Includes\Utilities;

/**
 * Activate the plugin
*/

/**
 * Activate this plugin i.e. setup tables, data etc.
 * NOT invoked on plugin updates
 *
 * @param bool $network_wide - If the plugin is being network-activated
 */
function epbl_activate_plugin( $network_wide=false ) {
	global $wpdb;

	if ( is_multisite() && $network_wide ) {
		foreach ( $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs LIMIT 100" ) as $blog_id ) {
			switch_to_blog( $blog_id );
			// epbl_get_instance()->config_obj->reset_cache();
			epbl_activate_plugin_do();
			restore_current_blog();
		}
	} else {
		epbl_activate_plugin_do();
	}
}

function epbl_activate_plugin_do() {

	// true if the plugin was activated for the first time since installation
	$plugin_version = get_option( 'epbl_version' );
	if ( empty($plugin_version) ) {
		set_transient( '_epbl_plugin_installed', true, WEEK_IN_SECONDS );
		Utilities::save_wp_option( 'epbl_version', ECHO_BLOCKS_VERSION, true );
		Utilities::save_wp_option( 'epbl_version_first', ECHO_BLOCKS_VERSION, true );
	}

	/** Ensure that we have template table in place */
	// TODO FUTURE	$handle = new Templates_DB();
	// TODO FUTURE	@$handle->create_table();
	
	set_transient( '_epbl_plugin_activated', true, 3600 );
}
register_activation_hook( ECHO_BLOCKS__FILE__, 'epbl_activate_plugin' );

/**
 * User deactivates this plugin so refresh the permalinks
 */
function epbl_deactivation() {
}
register_deactivation_hook( ECHO_BLOCKS__FILE__, 'epbl_deactivation' );
