<?php
namespace Echo_Doc_Blocks\Includes;

use Echo_Doc_Blocks\Includes\System\Logging;
use Elementor\Plugin;

defined( 'ABSPATH' ) || exit();

/**
 * Various utility functions
 */
class Utilities {

	static $wp_options_cache = array();


	public static function is_post_being_edited() {
		return (
			Plugin::instance()->editor->is_edit_mode() ||
			Plugin::instance()->preview->is_preview_mode() ||
			is_preview()
		);
	}


	/**************************************************************************************************************************
	 *                     POST OPERATIONS
	 *************************************************************************************************************************

	/**
	 * Retrieve a KB article with security checks
	 *
	 * @param $post_id
	 * @return null|WP_Post - return null if this is NOT KB post
	 */
	public static function get_post( $post_id ) {

		if ( empty($post_id) ) {
			return null;
		}

		// ensure post_id is valid
		$post_id = self::sanitize_int( $post_id );
		if ( empty($post_id) ) {
			return null;
		}

		// retrieve the post and ensure it is one
		$post = get_post( $post_id );
		if ( empty($post) || ! is_object($post) || ! $post instanceof WP_Post ) {
			return null;
		}

		return $post;
	}

	/**
	 * Get post status text.
	 * @param $post_status
	 * @return mixed
	 */
	public static function get_post_status_text( $post_status ) {

		$post_statuses = array( 'draft' => __( 'Draft', 'blocks-for-documents-articles-and-faqs' ), 'pending' => __( 'Pending', 'blocks-for-documents-articles-and-faqs' ),
		                        'publish' => __( 'Published', 'blocks-for-documents-articles-and-faqs' ), 'future' => __( 'Scheduled', 'blocks-for-documents-articles-and-faqs' ),
								'private' => __( 'Private', 'blocks-for-documents-articles-and-faqs' ),
								'trash'   => __( 'Trash', 'blocks-for-documents-articles-and-faqs' ));

		if ( empty($post_status) || ! in_array($post_status, array_keys($post_statuses)) ) {
			return $post_status;
		}

		return $post_statuses[$post_status];
	}


	/**************************************************************************************************************************
	 *
	 *                     STRING OPERATIONS
	 *
	 **************************************************************************************************************************/

	/**
	 * PHP substr() function returns FALSE if the input string is empty. This method
	 * returns empty string if input is empty or if error occurs.
	 *
	 * @param $string
	 * @param $start
	 * @param null $length
	 *
	 * @return string
	 */
	public static function substr( $string, $start, $length=null ) {
		$result = substr($string, $start, $length);
		return empty($result) ? '' : $result;
	}

	/**************************************************************************************************************************
	 *
	 *                     NUMBER OPERATIONS
	 *
	 **************************************************************************************************************************/

	/**
	 * Determine if value is positive integer ( > 0 )
	 * @param int $number is check
	 * @return bool
	 */
	public static function is_positive_int( $number ) {

		// no invalid format
		if ( empty($number) || ! is_numeric($number) ) {
			return false;
		}

		// no non-digit characters
		$numbers_only = preg_replace('/\D/', "", $number );
		if ( empty($numbers_only) || $numbers_only != $number ) {
			return false;
		}

		// only positive
		return $numbers_only > 0;
	}

	/**
	 * Determine if value is positive integer
	 * @param int $number is check
	 * @return bool
	 */
	public static function is_positive_or_zero_int( $number ) {

		if ( ! isset($number) || ! is_numeric($number) ) {
			return false;
		}

		if ( ( (int) $number) != ( (float) $number )) {
			return false;
		}

		$number = (int) $number;

		return is_int($number);
	}


	/**************************************************************************************************************************
	 *
	 *                     DATE OPERATIONS
	 *
	 **************************************************************************************************************************/

	/**
	 * Retrieve specific format from given date-time string e.g. '10-16-2003 10:20:01' becomes '10-16-2003'
	 *
	 * @param $datetime_str
	 * @param string $format e.g. 'Y-m-d H:i:s'  or  'M j, Y'
	 *
	 * @return string formatted date or the original string
	 */
	public static function get_formatted_datetime_string( $datetime_str, $format='M j, Y' ) {

		if ( empty($datetime_str) || empty($format) ) {
			return $datetime_str;
		}

		$time = strtotime($datetime_str);
		if ( empty($time) ) {
			return $datetime_str;
		}

		$date_time = date_i18n($format, $time);
		if ( $date_time == $format ) {
			$date_time = $datetime_str;
		}

		return empty($date_time) ? $datetime_str : $date_time;
	}

	/**
	 * Get nof hours passed between two dates.
	 *
	 * @param string $date1
	 * @param string $date2 OR if empty then use current date
	 *
	 * @return int - number of hours between dates [0-x] or null if error
	 * @noinspection PhpParamsInspection
	 * @throws \Exception
	 */
	public static function get_hours_since( $date1, $date2='' ) {

		try {
			$date1_dt = new \DateTime( $date1 );
			$date2_dt = new \DateTime( $date2 );
		} catch(Exception $ex) {
			return null;
		}

		if ( empty($date1_dt) || empty($date2_dt) ) {
			return null;
		}

		$hours = date_diff($date1_dt, $date2_dt)->h;

		return $hours === false ? null : $hours;
	}

	/**
	 * Get nof days passed between two dates.
	 *
	 * @param string $date1
	 * @param string $date2 OR if empty then use current date
	 *
	 * @return int - number of days between dates [0-x] or null if error
	 * @noinspection PhpParamsInspection
	 * @throws \Exception
	 */
	public static function get_days_since( $date1, $date2='' ) {

		try {
			$date1_dt = new \DateTime( $date1 );
			$date2_dt = new \DateTime( $date2 );
		} catch(Exception $ex) {
			return null;
		}

		if ( empty($date1_dt) || empty($date2_dt) ) {
			return null;
		}

		$days = (int)date_diff($date1_dt, $date2_dt)->format("%r%a");

		return $days === false ? null : $days;
	}


	/**
	 * How long ago pass date occurred.
	 *
	 * @param string $date1
	 *
	 * @return string x year|month|week|day|hour|minute|second(s) or '[unknown]' on error
	 */
	public static function time_since_today( $date1 ) {
		return self::how_long_ago( $date1 );
	}

	/**
	 * How long ago since now.
	 *
	 * @param string $date1
	 * @param string $date2 or if empty use current time
	 *
	 * @return string x year|month|week|day|hour|minute|second(s) or '[unknown]' on error
	 */
	public static function how_long_ago( $date1, $date2='' ) {

		$time1 = strtotime($date1);
		$time2 = empty($date2) ? time() : strtotime($date2);
		if ( empty($time1) || empty($time2) ) {
			return '[???]';
		}

		$time = abs($time2 - $time1);
		$time = ( $time < 1 )? 1 : $time;
		$tokens = array (
			31536000 => __( 'year', 'blocks-for-documents-articles-and-faqs' ),
			2592000 => __( 'month', 'blocks-for-documents-articles-and-faqs' ),
			604800 => __( 'week', 'blocks-for-documents-articles-and-faqs' ),
			86400 => __( 'day', 'blocks-for-documents-articles-and-faqs' ),
			3600 => __( 'hour', 'blocks-for-documents-articles-and-faqs' ),
			60 => __( 'min', 'blocks-for-documents-articles-and-faqs' ),
			1 => __( 'sec', 'blocks-for-documents-articles-and-faqs' )
		);

		$output = '';
		foreach ($tokens as $unit => $text) {
			if ($time >= $unit) {
				$numberOfUnits = floor($time / $unit);
				$output =  $numberOfUnits . ' ' . $text . ( $numberOfUnits >1 ? 's' : '');
				break;
			}
		}

		return $output;
	}


	/**************************************************************************************************************************
	 *
	 *                     NOTICES
	 *
	 *************************************************************************************************************************/

	/**
	 * Display content (not message).
	 *
	 * @param $message
	 */
	public static function ajax_show_content( $message ) {
		wp_die( json_encode( array( 'message' => $message ) ) );
	}

	/**
	 * AJAX: Used on response back to JS. will call wp_die()
	 *
	 * @param string $message
	 * @param string $title
	 * @param string $type
	 */
	public static function ajax_show_info_die( $message, $title='', $type='success' ) {
		wp_die( json_encode( array( 'message' => self::get_bottom_notice_message_box( $message, $title, $type) ) ) );
	}

	/**
	 * AJAX: Used on response back to JS. will call wp_die()
	 *
	 * @param $message
	 * @param string $title
	 */
	public static function ajax_show_error_die( $message, $title='' ) {
		wp_die( json_encode( array( 'error' => true, 'message' => self::get_bottom_notice_message_box( $message, $title, 'error') ) ) );
	}

	/**
	 * Show info or error message to the user
	 *
	 * @param $message
	 * @param string $title
	 * @param string $type
	 *
	 * @return string
	 */
	public static function get_bottom_notice_message_box($message, $title='', $type='success' ) {

		$title = empty($title) ? '' : '<h4>' . $title . '</h4>';
		$message = empty($message) ? '' : $message;
		return
			"<div class='eckb-bottom-notice-message'>
				<div class='contents'>
					<span class='$type'>
						$title
						<p> " . wp_kses_post($message) . "</p>
					</span>
				</div>
				<div class='epbl-close-notice fa fa-window-close'></div>
			</div>";
	}

	public static function user_not_logged_in() {
		self::ajax_show_error_die( '<p>' . __( 'You are not logged in. Refresh your page and log in.', 'blocks-for-documents-articles-and-faqs' ) . '</p>', __( 'Cannot save your changes', 'blocks-for-documents-articles-and-faqs' ) );
	}


	/**************************************************************************************************************************
	 *
	 *                     SECURITY
	 *
	 *************************************************************************************************************************/

	/**
	 * Return digits only.
	 *
	 * @param $number
	 * @param int $default
	 * @return int <default>
	 */
	public static function sanitize_int( $number, $default=0 ) {

		if ( $number === null || ! is_numeric($number) ) {
			return $default;
		}

		$number = preg_replace('/\D/', '', $number);

		return empty($number) ? $default : (int) $number;
	}

	/**
	 * Return text, space, "-" and "_" only.
	 *
	 * @param $text
	 * @param String $default
	 * @return String|<default>
	 */
	public static function sanitize_english_text( $text, $default='' ) {

		if ( empty($text) || ! is_string($text) ) {
			return $default;
		}

		$text = preg_replace('/[^A-Za-z0-9 \-_]/', '', $text);

		return empty($text) ? $default : $text;
	}

	/**
	 * Retrieve ID or return error. Used for KB ID and other IDs.
	 *
	 * @param mixed $id is either $id number or array with 'id' index
	 *
	 * @return int|WP_Error
	 */
	public static function sanitize_get_id( $id ) {

		if ( empty( $id) || is_wp_error($id) ) {
			Logging::add_log( 'Error occurred (01)' );
			return new \WP_Error('E001', __( 'invalid ID', 'blocks-for-documents-articles-and-faqs' ) );
		}

		if ( is_array( $id) ) {
			if ( ! isset( $id['id']) ) {
				Logging::add_log( 'Error occurred (02)' );
				return new \WP_Error('E002', __( 'invalid ID', 'blocks-for-documents-articles-and-faqs' ) );
			}

			$id_value = $id['id'];
			if ( ! self::is_positive_int( $id_value ) ) {
				Logging::add_log( 'Error occurred (03)', $id_value );
				return new \WP_Error('E003', __( 'invalid ID', 'blocks-for-documents-articles-and-faqs' ) . self::get_variable_string($id_value));
			}

			return (int) $id_value;
		}

		if ( ! self::is_positive_int( $id ) ) {
			Logging::add_log( 'Error occurred (04)', $id );
			return new \WP_Error('E004', __( 'invalid ID', 'blocks-for-documents-articles-and-faqs' ) . $id);
		}

		return (int) $id;
	}

    /**
     * Sanitize array full of ints.
     *
     * @param $array_values
     * @param string $default
     * @return array|string
     */
	public static function sanitize_int_array( $array_values, $default='' ) {
	    if ( ! is_array($array_values) ) {
	        return $default;
        }

        $sanitized_array = array();
        foreach( $array_values as $value ) {
	        $sanitized_array[] = self::sanitize_int( $value );
        }

        return $sanitized_array;
    }


	/**
	 * Return ints and comma only.
	 *
	 * @param $text
	 * @param String $default
	 * @return String|<default>
	 */
	public static function sanitize_comma_separated_ints( $text, $default='' ) {

		if ( empty($text) || ! is_string($text) ) {
			return $default;
		}

		$text = preg_replace('/[^0-9 \,_]/', '', $text);

		return empty($text) ? $default : $text;
	}

	/**
	 * Get a list of all the allowed html tags.
	 * @return array
	 */
	public static function get_allowed_html_tags() {
		return [
			'abbr' => [
				'title' => []
			],
			'b' => [],
			'br' => [],
			'em' => [],
			'i' => [],
			'span' => [
				'class' => []
			],
			'strong' => [],
			'u' => []
		];
	}

	/**
	 * Strip tags that are not allowed.
	 * @param string $string
	 * @return string
	 */
	public static function use_kses_filter( $string='' ) {
		return wp_kses( $string, self::get_allowed_html_tags() );
	}

	/**
	 * Retrieve value from POST or GET
	 *
	 * @param $key
	 * @param string $default
	 * @param bool $sanitize
	 *
	 * @return array|string - empty if not found
	 */
	public static function post( $key, $default='', $sanitize=true ) {

		if ( ! isset($_POST[$key]) && ! isset($_GET[$key]) ) {
			return $default;
		}

		$value = isset($_POST[$key]) ? $_POST[$key] : $_GET[$key];

		return $value === null ? $default : ( $sanitize && is_scalar($value) ? sanitize_text_field( $value ) : $value );
	}

	/**
	 * Retrieve value from GET or POST
	 *
	 * @param $key
	 * @param string $default
	 * @param bool $sanitize
	 *
	 * @return string - empty if not found
	 */
	public static function get( $key,  $default='', $sanitize=true ) {

		if ( ! isset($_GET[$key]) && ! isset($_POST[$key]) ) {
			return $default;
		}

		$value = isset($_GET[$key]) ? $_GET[$key] : $_POST[$key];

		return $value === null ? $default : ( $sanitize && is_scalar($value) ? sanitize_text_field( $value ) : $value );
	}


	/**************************************************************************************************************************
	 *
	 *                     GET/SAVE/UPDATE AN OPTION
	 *
	 *************************************************************************************************************************/

	/**
	 * Get KB-SPECIFIC option. Function adds KB ID suffix. Prefix represent core or ADD-ON prefix.
	 *
	 * WARN: Use ep.kb_get_instance()->kb_config_obj->get_kb_configs() to get KB specific configuration.
	 *
	 * @param $kb_id - assuming it is a valid ID
	 * @param $option_name - without kb suffix
	 * @param $default - use if KB option not found
	 * @param bool $is_array - ensure returned value is an array, otherwise return default
	 * @return string|array|null or default
	 */
	public static function get_kb_option( $kb_id, $option_name, $default, $is_array=false ) {
		$full_option_name = $option_name . '_' . $kb_id;
		return self::get_wp_option( $full_option_name, $default, $is_array );
	}

	/**
	 * Use to get:
	 *  a) PLUGIN-WIDE option not specific to any KB with e p k b prefix.
	 *  b) ADD-ON-SPECIFIC option with ADD-ON prefix.
	 *  b) KB-SPECIFIC configuration with e p k b prefix and KB ID suffix.
	 *
	 * @param $option_name
	 * @param $default
	 * @param bool|false $is_array
	 * @param bool $return_error
	 *
	 * @return array|string|WP_Error or default or error if $return_error is true
	 */
	public static function get_wp_option( $option_name, $default, $is_array=false, $return_error=false ) {
		/** @var $wpdb \Wpdb */
		global $wpdb;

		if ( isset(self::$wp_options_cache[$option_name]) ) {
			return self::$wp_options_cache[$option_name];
		}

		// retrieve specific KB option
		$option = $wpdb->get_var( $wpdb->prepare("SELECT option_value FROM $wpdb->options WHERE option_name = %s", $option_name ) );
		if ($option !== null ) {
			$option = maybe_unserialize( $option );
		}

		if ( $return_error && $option === null && ! empty($wpdb->last_error) ) {
			Logging::add_log( "DB failure: " . $wpdb->last_error, 'Option Name: ' . $option_name );
			return new \WP_Error('DB failure', $wpdb->last_error);
		}

		// if KB option is missing then return defaults
		if ( $option === null || ( $is_array && ! is_array($option) ) ) {
			return $default;
		}

		self::$wp_options_cache[$option_name] = $option;

		return $option;
	}

	/**
	 * Save KB-SPECIFIC option. Function adds KB ID suffix. Prefix represent core or ADD-ON prefix.
	 *
	 * @param $kb_id - assuming it is a valid ID
	 * @param $option_name - without kb suffix
	 * @param array $option_value
	 * @param $sanitized - ensures input is sanitized
	 *
	 * @return array|WP_Error if option cannot be serialized or db insert failed
	 */
	public static function save_kb_option( $kb_id, $option_name, array $option_value, $sanitized ) {
		$full_option_name = $option_name . '_' . $kb_id;
		return self::save_wp_option( $full_option_name, $option_value, $sanitized );
	}

	/**
	 * Use to save:
	 *  a) PLUGIN-WIDE option not specific to any KB with e p k b prefix.
	 *  b) ADD-ON-SPECIFIC option with ADD-ON prefix.
	 *  b) KB-SPECIFIC configuration with e p k b prefix and KB ID suffix.
	 *
	 * @param $option_name
	 * @param $option_value
	 * @param $sanitized
	 * @return mixed|WP_Error
	 */
	public static function save_wp_option( $option_name, $option_value, $sanitized ) {
		/** @var $wpdb \Wpdb */
		global $wpdb;

		if ( $sanitized !== true ) {
			return new \WP_Error( '433', 'Option value was not sanitized for option: ' . $option_name );
		}

		// do not store null
		if ( $option_value === null ) {
            $option_value = '';
        }

		// add or update the option
		$serialized_value = $option_value;
		if ( is_array( $option_value ) || is_object( $option_value ) ) {
			$serialized_value = maybe_serialize($option_value);
			if ( empty($serialized_value) ) {
				return new \WP_Error( '434', 'Failed to serialize value for option: ' . $option_name );
			}
		}

		$result = $wpdb->query( $wpdb->prepare( "INSERT INTO $wpdb->options (`option_name`, `option_value`, `autoload`) VALUES (%s, %s, %s)
 												 ON DUPLICATE KEY UPDATE `option_name` = VALUES(`option_name`), `option_value` = VALUES(`option_value`), `autoload` = VALUES(`autoload`)",
												$option_name, $serialized_value, 'no' ) );
		if ( $result === false ) {
			Logging::add_log( 'Failed to update option', $option_name );
			return new \WP_Error( '435', 'Failed to update option ' . $option_name );
		}

		self::$wp_options_cache[$option_name] = $option_value;

		return $option_value;
	}


    /**************************************************************************************************************************
     *
     *                     DATABASE
     *
     *************************************************************************************************************************/

	/**
	 * Get given Post Metadata
	 *
	 * @param $post_id
	 * @param $meta_key
	 * @param $default
	 * @param bool|false $is_array
	 * @param bool $return_error
	 *
	 * @return array|string or default or error if $return_error is true
	 */
	public static function get_postmeta( $post_id, $meta_key, $default, $is_array=false, $return_error=false ) {
		/** @var $wpdb \Wpdb */
		global $wpdb;

		if ( ! self::is_positive_int( $post_id) ) {
			return $return_error ? new \WP_Error( 'Invalid Post ID', self::get_variable_string( $post_id ) ) : $default;
		}

		// retrieve specific KB option
		$option = $wpdb->get_var( $wpdb->prepare("SELECT meta_value FROM $wpdb->postmeta WHERE post_id = %d and meta_key = '%s'", $post_id, $meta_key ) );
		if ($option !== null ) {
			$option = maybe_unserialize( $option );
		}

		if ( $return_error && $option === null && ! empty($wpdb->last_error) ) {
			Logging::add_log( "DB failure: " . $wpdb->last_error, 'Meta Key: ' . $meta_key );
			return new \WP_Error('DB failure', $wpdb->last_error);
		}

		// if KB option is missing then return defaults
		if ( $option === null || ( $is_array && ! is_array($option) ) ) {
			return $default;
		}

		return $option;
	}

	/**
	 * Save or Insert Post Metadata
	 *
	 * @param $post_id
	 * @param $meta_key
	 * @param $meta_value
	 * @param $sanitized
	 *
	 * @return mixed|WP_Error
	 */
	public static function save_postmeta( $post_id, $meta_key, $meta_value, $sanitized ) {
		/** @var $wpdb \Wpdb */
		global $wpdb;

		if ( ! self::is_positive_int( $post_id) ) {
			return new \WP_Error( 'Invalid Post ID', self::get_variable_string( $post_id ) );
		}

		if ( $sanitized !== true ) {
			return new \WP_Error( '433', 'Option value was not sanitized for meta key: ' . $meta_key );
		}

		// do not store null
		if ( $meta_value === null ) {
			$meta_value = '';
		}

		// add or update the option
		$serialized_value = $meta_value;
		if ( is_array( $meta_value ) || is_object( $meta_value ) ) {
			$serialized_value = maybe_serialize($meta_value);
			if ( empty($serialized_value) ) {
				return new \WP_Error( '434', 'Failed to serialize value for meta key: ' . $meta_key );
			}
		}

		// check if the meta field already exists before doing 'upsert'
		$result = $wpdb->get_row( $wpdb->prepare( "SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = '%s' AND post_id = %d", $meta_key, $post_id ) );
		if ( $result === null && ! empty($wpdb->last_error) ) {
			Logging::add_log( "DB failure: " . $wpdb->last_error );
			return new \WP_Error('DB failure', $wpdb->last_error);
		}

		// INSERT or UPDATE the meta field
		if ( empty($result) ) {
			if ( false === $wpdb->query( $wpdb->prepare( "INSERT INTO $wpdb->postmeta (`meta_key`, `meta_value`, `post_id`) VALUES (%s, %s, %d)", $meta_key, $serialized_value, $post_id ) ) ) {
				Logging::add_log("Failed to insert meta data. ", $meta_key);
				return new \WP_Error( '33', 'Failed to insert meta data' );
			}
		} else {
			if ( false === $wpdb->query( $wpdb->prepare( "UPDATE $wpdb->postmeta SET meta_value = %s WHERE meta_key = '%s' AND post_id = %d", $serialized_value, $meta_key, $post_id ) ) ) {
				Logging::add_log("Failed to update meta data. ", $meta_key);
				return new \WP_Error( '33', 'Failed to update meta data' );
			}
		}

		if ( $result === false ) {
			Logging::add_log( 'Failed to update meta key', $meta_key );
			return new \WP_Error( '435', 'Failed to update meta key ' . $meta_key );
		}

		return $meta_value;
	}

	/**
	 * Delete given Post Metadata
	 *
	 * @param $post_id
	 * @param $meta_key
	 *
	 * @return bool
	 */
	public static function delete_postmeta( $post_id, $meta_key ) {
		/** @var $wpdb \Wpdb */
		global $wpdb;

		if ( ! self::is_positive_int( $post_id) ) {
			return false;
		}

		// delete specific KB option
		if ( false === $wpdb->query( $wpdb->prepare( "DELETE FROM $wpdb->postmeta WHERE post_id = %d and meta_key = '%s'", $post_id, $meta_key ) ) ) {
			Logging::add_log("Could not delete post '" . self::get_variable_string($meta_key) . "'' metadata: ", $post_id);
			return false;
		}

		return true;
	}


	/**************************************************************************************************************************
	 *
	 *                     OTHER
	 *
	 *************************************************************************************************************************/

	/**
	 * Return string representation of given variable for logging purposes
	 *
	 * @param $var
	 *
	 * @return string
	 */
	public static function get_variable_string( $var ) {

		if ( ! is_array($var) ) {
			return self::get_variable_not_array( $var );
		}

		if ( empty($var) ) {
			return '[empty]';
		}

		$output = 'array';
		$ix = 0;
		foreach ($var as $key => $value) {

            if ( $ix++ > 10 ) {
                $output .= '[.....]';
                break;
            }

			$output .= "[" . $key . " => ";
			if ( ! is_array($value) ) {
				$output .= self::get_variable_not_array( $value ) . "]";
				continue;
			}

			$ix2 = 0;
			$output .= "[";
			$first = true;
			foreach($value as $key2 => $value2) {
                if ( $ix2++ > 10 ) {
                    $output .= '[.....]';
                    break;
                }

				if ( is_array($value2) ) {
                    $output .= print_r($value2, true);
                } else {
					$output .= ( $first ? '' : ', ' ) . $key2 . " => " . self::get_variable_not_array( $value2 );
					$first = false;
					continue;
				}
            }
			$output .= "]]";
		}

		return $output;
	}

	private static function get_variable_not_array( $var ) {

		if ( $var === null ) {
			return '<null>';
		}

		if ( ! isset($var) ) {
            /** @noinspection HtmlUnknownAttribute */
            return '<not set>';
		}

		if ( is_array($var) ) {
			return empty($var) ? '[]' : '[...]';
		}

		if ( is_object( $var ) ) {
			return '<' . get_class($var) . '>';
		}

		if ( is_bool( $var ) ) {
			return $var ? 'TRUE' : 'FALSE';
		}

		if ( is_string($var) || is_numeric($var) ) {
			return $var;
		}

		return '<unknown>';
	}

	/**
	 * Array1 VALUES NOT IN array2
	 *
	 * @param array $array1
	 * @param array $array2
	 *
	 * @return array of values in array1 NOT in array2
	 */
	public static function diff_two_dimentional_arrays( array $array1, array $array2 ) {

		if ( empty($array1) ) {
			return array();
		}

		if ( empty($array2) ) {
			return $array1;
		}

		// flatten first array
		foreach( $array1 as $key => $value ) {
			if ( is_array($value) ) {
				$tmp_value = '';
				foreach( $value as $tmp ) {
					$tmp_value .= ( empty($tmp_value) ? '' : ',' ) . ( empty($tmp) ? '' : $tmp );
				}
				$array1[$key] = $tmp_value;
			}
		}

		// flatten second array
		foreach( $array2 as $key => $value ) {
			if ( is_array($value) ) {
				$tmp_value = '';
				foreach( $value as $tmp ) {
					$tmp_value .= ( empty($tmp_value) ? '' : ',' ) . ( empty($tmp) ? '' : $tmp );
				}
				$array2[$key] = $tmp_value;
			}
		}

		return array_diff_assoc($array1, $array2);
	}

	/**
	 * Get current user.
	 *
	 * @return null|WP_User
	 */
	public static function get_current_user() {

		$user = wp_get_current_user();

		// is user not logged in? user ID is 0 if not logged
		if ( empty($user) || ! $user instanceof WP_User || empty($user->ID) ) {
			$user = null;
		}

		return $user;
	}

	/**
	 * Output inline CSS style based on configuration.
	 *
	 * @param string $styles A list of Configuration Setting styles
	 * @param $kb_config
	 * @return string
	 */
	public static function get_inline_style( $styles, $kb_config ) {

		if ( empty($styles) || ! is_string($styles) ) {
			return '';
		}

		$style_array = explode(',', $styles);
		if ( empty($style_array) ) {
			return '';
		}

		$output = 'style="';
		foreach( $style_array as $style ) {

			$key_value = array_map( 'trim', explode(':', $style) );
			if ( empty($key_value[0]) ) {
				continue;
			}

			$output .= $key_value[0] . ': ';

			// true if using KB config value
			if ( count($key_value) == 2 && isset($key_value[1]) ) {
				$output .= $key_value[1];
			} else if ( isset($key_value[2]) && isset($kb_config[$key_value[2]]) ) {
				$output .= $kb_config[ $key_value[2] ];

				switch ( $key_value[0] ) {
					case 'border-radius':
					case 'border-width':
					case 'border-bottom-width':
					case 'border-top-left-radius':
					case 'border-top-right-radius':
					case 'border-bottom-left-radius':
					case 'border-bottom-right-radius':
					case 'min-height':
					case 'max-height':
					case 'height':
					case 'padding-left':
					case 'padding-right':
					case 'padding-top':
					case 'padding-bottom':
					case 'margin':
					case 'margin-top':
					case 'margin-right':
					case 'margin-bottom':
					case 'margin-left':
					case 'font-size':
						$output .= 'px';
						break;
				}
			}

			$output .= '; ';
		}

		return trim($output) . '"';
	}

	/**
	 * Output CSS classes based on configuration.
	 *
	 * @param $classes
	 * @param $kb_config
	 * @return string
	 */
	public static function get_css_class( $classes, $kb_config ) {

		if ( empty($classes) || ! is_string($classes) ) {
			return '';
		}

		$output = ' class="';
		foreach( array_map( 'trim', explode(',', $classes) ) as $class ) {
			$class_name = trim(str_replace(':', '', $class));
			$is_kb_config = $class != $class_name;

			if ( $is_kb_config && empty($kb_config[$class_name]) ) {
				continue;
			}

			$output .= ( $is_kb_config ? $kb_config[$class_name] : $class ) . ' ';
		}
		return trim($output) . '"';
	}
	
	/* 
	 * Check if KB / Access Manager plugin is INSTALLED. Don't check if the plugin is active
	 * @return bool
	*/
	public static function is_kb_plugin_installed() {
		$installed_plugins = get_plugins();
		return isset( $installed_plugins[ 'echo-knowledge-base/echo-knowledge-base.php' ] ) || isset( $installed_plugins['echo-kb-access-manager/echo-kb-access-manager.php'] );
	}
	
		
	public static function is_kb_plugin_active() {
		return defined( 'EP'.'KB_PLUGIN_NAME' ) || defined( 'AMAG_PLUGIN_NAME' );
	}
	
	public static function replace_icons_name( $str ) {
		return str_replace( 'ep'.'kbfa', 'epblfa', $str );
	}
	
	/**
	 * Check if Block Editor is active.
	 * Must only be used after plugins_loaded action is fired.
	 * By KAGG Design
	 * @return bool
	 */
	public static function is_block_editor_active() {
		// Gutenberg plugin is installed and activated.
		$gutenberg = ! ( false === has_filter( 'replace_editor', 'gutenberg_init' ) );

		// Block editor since 5.0.
		$block_editor = version_compare( $GLOBALS['wp_version'], '5.0-beta', '>' );

		if ( ! $gutenberg && ! $block_editor ) {
			return false;
		}

		if ( self::is_classic_editor_plugin_active() ) {
			$editor_option       = get_option( 'classic-editor-replace' );
			$block_editor_active = array( 'no-replace', 'block' );
			return in_array( $editor_option, $block_editor_active, true );
		}

		return true;
	}
	
	/**
	 * Check if Classic Editor plugin is active.
	 * By KAGG Design
	 * @return bool
	 */
	public static function is_classic_editor_plugin_active() {
		if ( ! function_exists( 'is_plugin_active' ) ) {
			include_once ABSPATH . 'wp-admin/includes/plugin.php';
		}

		if ( is_plugin_active( 'classic-editor/classic-editor.php' ) ) {
			return true;
		}

		return false;
	}
}
