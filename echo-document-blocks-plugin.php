<?php
namespace Echo_Doc_Blocks;

use Echo_Doc_Blocks\Includes\System\Upgrades;
use Echo_Doc_Blocks\Includes\Utilities;
use Echo_Doc_Blocks\Includes\Controls_Manager;
use Echo_Doc_Blocks\Includes\Widgets_Manager;
use Echo_Doc_Blocks\Includes\Assets_Manager;
use Echo_Doc_Blocks\Includes\Cache_Manager;
use Echo_Doc_Blocks\includes\admin\Admin_Menus;
use Echo_Doc_Blocks\Includes\features\frontend\Page_Assets;
use Echo_Doc_Blocks\Includes\Admin\Admin_Handlers;

if ( ! defined( 'ABSPATH' ) ) exit;


/**
 * Main class to load the plugin.
 * Singleton
 */
final class Echo_Document_Blocks {

	/* @var Echo_Document_Blocks */
	private static $instance;

	/* @var Config_DB */
	public $config_obj;

	private function __construct() {
		spl_autoload_register( [ $this, 'autoload' ] );
		// $this->config_obj = new xxx()
	}

	/**
	 * Create a new instance
	 * @static
	 * @return Echo_Document_Blocks
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
			self::$instance->setup_plugin();
			// add_action( 'init', array( self::$instance, 'stop_heartbeat' ), 1 );
		}

		return self::$instance;
	}

	/**
	 * Setup plugin before it runs. Include functions and instantiate classes based on user action
	 */
	private function setup_plugin() {

		require_once ECHO_BLOCKS_DIR_PATH . 'includes/system/plugin-links.php';
		
		// Only load if Gutenberg is available.
		if ( ! function_exists( 'register_block_type' ) ) {  // TODO
			add_action( 'admin_notices', array( $this, 'epbl_gutenberg_missing' ) );
			$message = __( 'The Blocks for Documents, Articles and FAQs plugin requires Gutenberg to be active.', 'blocks-for-documents-articles-and-faqs' );
			echo '<div class="notice notice-error"><p>' . $message . '</p></div>';
			return;
		}

		new Page_Assets();
		// TODO FUTURE new Templates_CPT_Setup();

		Assets_Manager::init();

		new Upgrades();

		$action = Utilities::get( 'action' );

		// process action request if any
		if ( ! empty( $action ) ) {
			$this->handle_action_request( $action );
		}

		// handle AJAX front & back-end requests (no admin, no admin bar)
		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			$this->handle_ajax_requests( $action );
			return;
		}

		// ADMIN or CLI
		if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {    // || ( defined( 'REST_REQUEST' ) && REST_REQUEST )
			$this->setup_backend_classes();
			return;
		}

		// FRONT-END (no ajax, possibly admin bar)
	}

	/**
	 * Handle plugin actions here such as saving settings
	 * @param $action
	 */
	private function handle_action_request( $action ) {

		if ( empty( $action ) ) {
			return;
		}

		if ( $action == 'epbl_download_debug_info' ) {
			new Admin_Handlers();
			return;
		}
	}

	/**
	 * Handle AJAX requests coming from front-end and back-end
	 * @param $action
	 */
	private function handle_ajax_requests( $action ) {

		if ( empty( $action ) ) {
			return;
		}

		// user selects template type
		if ( in_array($action, array('epbl-save-block-type-selection', 'epbl-template-mgr-save', 'epbl-template-mgr-get', 'epbl-template-mgr-rename',
									 'epbl-template-mgr-copy', 'epbl-template-mgr-delete', 'epbl-template-mgr-get-list', 'epbl-template-mgr-get-presets-templates-page' ) ) ) {
			// TODO FUTURE new Template_Manager_Cntrl();
			return;
		}

		// user saves configuration
		if ( $action == 'epbl_save_settings' ) {
			// TODO FUTURE new Config_Controller();
            return;
		}

		// user Toggle Debug Info
		if ( $action == 'epbl_toggle_debug' ) {
			new Admin_Handlers();
			return;
		}
	}

	/**
	 * Setup up classes when on ADMIN pages
	 */
	private function setup_backend_classes() {
		global $pagenow;

		Admin_Menus::init();

		$pageNowAdmin = empty($pagenow) ? '' : $pagenow;
		$page = Utilities::get('page', '', false);
		$action = Utilities::get('action', '', false);

		// Dashboard and other admin pages
		if ( $page == 'blocks-for-documents-articles-and-faqs' || $page == 'echo-doc-blocks-add-ons' ||  $page == 'blocks-for-documents-articles-and-faqs-get-help' ) {
			add_action( 'admin_enqueue_scripts', [ new Assets_Manager(), 'load_admin_plugin_pages_resources'] );
		}

		// Templates Manager
        // TODO FUTURE new Admin_Page_Assets();

        /* FUTURE TODO		if ( $page == 'echo-doc-blocks-templates-manager' ) {
                    new Template_Manager_Cntrl();
                    new Template_Manager_View();
                    add_action( 'admin_enqueue_scripts', ['Echo_Doc_Blocks\Includes\Assets_Manager', 'load_admin_template_manager'] );
                }

                // Configuration
                if ( $page == 'echo-doc-blocks-configuration' ) {
                    new Config_Controller();
                    new Config_Page();
                }

                $is_template_editor = false;
                if ( $pageNowAdmin == 'post.php' ) {
                    $post_id = Utilities::get('post');
                    $post_id = empty($post_id) ? Utilities::post('post_ID', false) : $post_id;
                    $post = Utilities::get_post( $post_id );
                    $is_template_editor = ! empty( $post->post_type ) && $post->post_type == 'epbl-post-type';
                }

                // Templates Editor
                if ( $is_template_editor ||  Utilities::get('post_type') == 'epbl-post-type' ) {
                    add_filter( 'admin_body_class', ['Echo_Doc_Blocks\Includes\Assets_Manager', 'load_admin_template_editor'] );
                    new Template_Manager_Cntrl();
                } */
	}

	// Don't allow this singleton to be cloned.
	public function __clone() {
		_doing_it_wrong( __FUNCTION__, 'Invalid (#1)', '4.0' );
	}

	// Don't allow un-serializing of the class except when testing
	public function __wakeup() {
		if ( strpos($GLOBALS['argv'][0], 'phpunit') === false ) {
			_doing_it_wrong( __FUNCTION__, 'Invalid (#1)', '4.0' );
		}
	}

	/** When developing and debugging we don't need heartbeat */
	public function stop_heartbeat() {
		if ( defined( 'RUNTIME_ENVIRONMENT' ) && RUNTIME_ENVIRONMENT == 'ECHODEV' ) {
			wp_deregister_script( 'heartbeat' );
		}
	}

	// auto-load classes (taken from Elementor)
	public function autoload( $class ) {
		if ( 0 !== strpos( $class, __NAMESPACE__ ) ) {
			return;
		}

		$class_to_load = $class;
		if ( ! class_exists( $class_to_load ) ) {
			$filename = strtolower(
				preg_replace(
					[ '/^' . __NAMESPACE__ . '\\\/', '/([a-z])([A-Z])/', '/_/', '/\\\/' ],
					[ '', '$1-$2', '-', DIRECTORY_SEPARATOR ],
					$class_to_load
				)
			);
			$filename = str_replace('-', '_', $filename);
			$filename = ECHO_BLOCKS_DIR_PATH . $filename . '.php';

			if ( is_readable( $filename ) ) {
				include( $filename );
			}
		}
	}
}

/**
 * Returns the single instance of this class
 * @return Echo_Document_Blocks - this class instance
 */
function epbl_get_instance() {
	return Echo_Document_Blocks::instance();
}

Echo_Document_Blocks::instance();
