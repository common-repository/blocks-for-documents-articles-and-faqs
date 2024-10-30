<?php

// Exit if accessed directly
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) exit;


/**
 * Uninstall this plugin
 *
 */

/** Delete plugin options */
delete_option( 'epbl_version' );
delete_option( 'epbl_version_first' );
delete_option( 'epbl_error_log' );
delete_option( 'epbl_long_notices' );
delete_option( 'epbl_one_time_notices' );
delete_option( 'epbl_show_upgrade_message' );
delete_transient( '_epbl_plugin_activated' );