<?php
namespace Echo_Doc_Blocks\Includes\features\templates;

use Echo_Doc_Blocks\Includes\Utilities;

defined( 'ABSPATH' ) || exit();

/**
 * Register a new CUSTOM POST TYPE + category + tag
 *
 * @copyright   Copyright (C) 2019, Echo Plugins
 */
class Templates_CPT_Setup {

	public function __construct() {
		add_action( 'init', array( $this, 'epbl_register_post_types'), 10 );
	}

	/**
	 * Read configuration and create configured custom post types, each representing certain block templates
	 */
	public function epbl_register_post_types() {

		/** setup Custom Post Type */
		$post_type_name = 'Echo Document Blocks Templates';
		$labels = array(
				'name'               => $post_type_name,
				'singular_name'      => $post_type_name . ' - ' . _x( 'template', 'post type singular name', 'blocks-for-documents-articles-and-faqs' ),
				'add_new'            => _x( 'Edit Block Template', 'Articles', 'blocks-for-documents-articles-and-faqs' ),
				'add_new_item'       => __( 'Edit Block Template', 'blocks-for-documents-articles-and-faqs' ),
				'edit_item'          => __( 'Edit Template', 'blocks-for-documents-articles-and-faqs' ),
				'new_item'           => __( 'Edit Template', 'blocks-for-documents-articles-and-faqs' ),
				'all_items'          => __( 'All Templates', 'blocks-for-documents-articles-and-faqs' ),
				'view_item'          => __( 'View Template', 'blocks-for-documents-articles-and-faqs' ),
				'search_items'       => __( 'Search in Template', 'blocks-for-documents-articles-and-faqs' ),
				'not_found'          => __( 'No Template found', 'blocks-for-documents-articles-and-faqs' ),
				'not_found_in_trash' => __( 'No Template found in Trash', 'blocks-for-documents-articles-and-faqs' ),
				'menu_name'          => _x( 'Document Blocks', 'admin menu', 'blocks-for-documents-articles-and-faqs' )
		);
		$args = array(
				'labels'             => $labels,
				'public'             => false,
				'show_ui'            => true,
				'show_in_menu'       => false,
				'template'           => $this->get_block_presets_and_templates(),
				'template_lock'      => 'all',
				'publicly_queryable' => false,
				'query_var'          => false,
				'capability_type'    => 'post',
				'map_meta_cap'       => true,
				'has_archive'        => false,
				'hierarchical'       => false,
				'show_in_rest'       => true, // need for GT
				'menu_position'      => 5,    // below Posts menu
				'menu_icon'          => 'dashicons-welcome-learn-more',
				'supports'           => array( 'editor' ),
		);
		$result = register_post_type( 'epbl-post-type', $args );
		if ( is_wp_error( $result ) ) {
			return $result;
		}

		return true;
	}

	/**
	 * Get given block presets and templates.
	 * @return array|bool
	 */
	private function get_block_presets_and_templates() {

		// get presets and blocks for given block
		$block_name = Utilities::get('block_name');
		$template_id = Utilities::get('template_id');
		if ( ! Utilities_Blocks::is_echo_block_name_valid( $block_name ) || ! Utilities::is_positive_int( $template_id ) ) {
			return array();
		}

		$template = Utilities_Blocks::get_preset_template( $template_id, 'template', $block_name );
		$attributes = $template['attributes'];
		$attributes['blockType'] = 'template-edit';

		return array( array('echo-document-blocks/template-info', array('templateId' => $template_id, 'imageUrl' => ECHO_BLOCKS_ASSETS_URL . 'images/epbl-background.svg',
		                                                                'templateName' => $template['template_name'], 'templateDescription' => $template['template_description'])),
					  array('echo-document-blocks/' . $block_name, $attributes) );
	}
}

