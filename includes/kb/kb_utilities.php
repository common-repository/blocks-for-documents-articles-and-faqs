<?php
namespace Echo_Doc_Blocks\Includes\Kb;

defined( 'ABSPATH' ) || exit();

/**
 * Various utility functions
 */
class KB_Utilities {

	const DEFAULT_KB_ID = 1;

	private static $kb_configs = [];
	private static $kb_config = [];

	/**
	 * Retrieve specific KB configuration
	 * @param $kb_id
	 * @return array|null
	 */
	public static function get_kb_config( $kb_id ) {

		if ( ! empty(self::$kb_config) ) {
			return self::$kb_config;
		}

		$kb_config = null;

		if ( has_filter( 'kb_core/kb_config/get_kb_configs' ) ) {

			$kb_config = apply_filters( 'kb_core/kb_config/get_kb_config', $kb_id );

		} else {

			if ( function_exists('epkb_get_instance' ) && isset(epkb_get_instance()->kb_config_obj) ) {
				$kb_config = epkb_get_instance()->kb_config_obj->get_kb_config_or_default( $kb_id );
			}
		}

		self::$kb_config = $kb_config;

		return $kb_config;
	}

	/**
	 * Retrieve KB configurations
	 * @return array|mixed
	 */
	public static function get_kb_configs() {

		if ( ! empty(self::$kb_configs) ) {
			return self::$kb_configs;
		}

		$kb_configs = [];

		if ( has_filter( 'kb_core/kb_config/get_kb_configs' ) ) {

			$kb_configs = apply_filters( 'kb_core/kb_config/get_kb_configs', [] );

		} else {

			if ( function_exists('epkb_get_instance' ) && isset(epkb_get_instance()->kb_config_obj) ) {
				$kb_configs = epkb_get_instance()->kb_config_obj->get_kb_configs();
			}
		}

		self::$kb_configs = $kb_configs;

		return $kb_configs;
	}

	/**
	 * Check if KB is ARCHIVED.
	 *
	 * @param $kb_status
	 * @return bool
	 */
	public static function is_kb_archived( $kb_status ) {
		return $kb_status === 'archived';
	}

	/**
	 * Check if Aaccess Manager is considered active.
	 *
	 * @param bool $is_active_check_only
	 * @return bool
	 */
	public static function is_amag_on( $is_active_check_only=false ) {
		/** @var $wpdb \Wpdb */
		global $wpdb;

		if ( defined( 'AMAG_PLUGIN_NAME' ) ) {
			return true;
		}

		if ( $is_active_check_only ) {
			return false;
		}

		$table = $wpdb->prefix . 'am'.'gr_kb_groups';
		$result = $wpdb->get_var( "SHOW TABLES LIKE '" . $table ."'" );

		return ( ! empty($result) && ( $table == $result ) );
	}

}
