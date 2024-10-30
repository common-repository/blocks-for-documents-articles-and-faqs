<?php
namespace Echo_Doc_Blocks\includes\admin;

use Echo_Doc_Blocks\Includes\Assets_Manager;

defined( 'ABSPATH' ) || exit();

class Admin_Menus {

    public static function init() {
	    add_action( 'admin_menu', [__CLASS__, 'add_plugin_menus'], 20 );
      //  add_action( 'admin_enqueue_scripts', [__CLASS__, 'enqueue_assets'] );
        add_action( 'admin_menu', [__CLASS__, 'admin_menu_change_name' ], 200 );
    }

	/**
	 *  Register plugin menus
	 * @noinspection PhpUnused
	 */
	public static function add_plugin_menus() {

        add_menu_page( __( 'Document Blocks', 'blocks-for-documents-articles-and-faqs' ),__( 'Document Blocks', 'blocks-for-documents-articles-and-faqs' ),
                            'manage_options', 'blocks-for-documents-articles-and-faqs', [new Admin_Pages(), 'show_dashboard'], ECHO_BLOCKS_ASSETS_URL.'images/Admin-d-logo.png', '58.7' );

		add_submenu_page( 'blocks-for-documents-articles-and-faqs', __( 'Get Help - Echo Document Blocks Addons', 'blocks-for-documents-articles-and-faqs' ), __( 'Get Help', 'blocks-for-documents-articles-and-faqs' ),
							'manage_options', 'blocks-for-documents-articles-and-faqs-get-help', [new Admin_Pages(), 'get_help'] );
	}

    public static function admin_menu_change_name() {
        global $submenu;

        if ( isset( $submenu['blocks-for-documents-articles-and-faqs'] ) ) {
            $submenu['blocks-for-documents-articles-and-faqs'][0][0] = __( 'Settings', 'blocks-for-documents-articles-and-faqs' );
        }
    }

   /* public static function enqueue_assets() {
	    Assets_Manager::backend_register_assets();
		
		if ( ! empty($_GET['page']) && ( $_GET['page'] == 'blocks-for-documents-articles-and-faqs' || $_GET['page'] == 'blocks-for-documents-articles-and-faqs-settings') ) {
			wp_enqueue_style( 'epbl-admin-styles' );
			wp_enqueue_script( 'epbl-admin-scripts' );
			Assets_Manager::enqueue_elementor_icons();
		}
    } */
}
