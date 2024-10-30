<?php
namespace Echo_Doc_Blocks\Includes\features\templates;

use Echo_Doc_Blocks\Includes\Utilities;

defined( 'ABSPATH' ) || exit();

/**
 * Controls template management screen functions
 *
 * @copyright   Copyright (C) 2019, Echo Plugins
 */
class Template_Manager_Cntrl {

	public function __construct() {
		add_filter( 'block_editor_settings', array( $this, 'set_block_editor_settings' ) );
		add_action( 'wp_ajax_epbl-save-block-type-selection', array($this, 'select_block_name') );
		add_action( 'wp_ajax_epbl-template-mgr-save', array($this, 'save_template') );
		add_action( 'wp_ajax_epbl-template-mgr-get', array($this, 'get_preset_template_attributes') );
		add_action( 'wp_ajax_epbl-template-mgr-rename', array($this, 'rename_template') );
		add_action( 'wp_ajax_epbl-template-mgr-copy', array($this, 'copy_template') );
		add_action( 'wp_ajax_epbl-template-mgr-delete', array($this, 'delete_template') );
		add_action( 'wp_ajax_epbl-template-mgr-get-list', array($this, 'get_list') );
		add_action( 'wp_ajax_epbl-template-mgr-get-presets-templates-page', array($this, 'get_presets_templates_page') );
		add_action( 'wp_ajax_nopriv_save-block-type-selection', array($this, 'user_not_logged_in') );
		add_action( 'wp_ajax_nopriv_epbl-template-mgr-save', array($this, 'user_not_logged_in') );
		add_action( 'wp_ajax_nopriv_epbl-template-mgr-get', array($this, 'user_not_logged_in') );
		add_action( 'wp_ajax_nopriv_epbl-template-mgr-rename', array($this, 'user_not_logged_in') );
		add_action( 'wp_ajax_nopriv_epbl-template-mgr-copy', array($this, 'user_not_logged_in') );
		add_action( 'wp_ajax_nopriv_epbl-template-mgr-delete', array($this, 'user_not_logged_in') );
		add_action( 'wp_ajax_nopriv_epbl-template-mgr-get-list', array($this, 'user_not_logged_in') );
		add_action( 'wp_ajax_nopriv_epbl-template-get-presets-templates-page', array($this, 'user_not_logged_in') );
	}

	/**
	 * Avoid creating extra drafts
	 * @param $settings
	 * @return mixed
	 */
	function set_block_editor_settings( $settings ) {
		$settings['autosaveInterval'] = 36000;
		return $settings;
	}

	/**
	 * User select block type to access presets and templates
	 */
	public function select_block_name() {
		/** @var $wpdb Wpdb */
		global $wpdb;

		// get block name
		$block_name = Utilities::post('selected_block_name');
		if ( ! Utilities_Blocks::is_echo_block_name_valid( $block_name ) ) {
			Utilities::ajax_show_error_die( __( 'Found invalid block type: ' . $block_name . '. Refresh your page', 'blocks-for-documents-articles-and-faqs' ) );
		}

		$posts = $wpdb->get_results( " SELECT * FROM $wpdb->posts WHERE post_type = 'epbl-post-type' LIMIT 1 ");
		if ( empty( $posts[0]->ID ) || ! is_array( $posts ) ) {
			$reload_url = 'post-new.php?post_type=epbl-post-type&block_name=' . $block_name;
		} else {
			$reload_url = 'post.php?post=' . $posts[0]->ID . '&action=edit&block_name=' . $block_name;
		}

		wp_die( json_encode( array( 'status' => 'success', 'reload_url' => esc_url_raw( $reload_url ) ) ) );
	}

	/**
	 * Save changes to one of the templates.
	 */
	public function save_template() {

		// verify that request is authentic
		if ( empty( $_REQUEST['nonce'] ) || ! wp_verify_nonce( $_REQUEST['nonce'], 'epbl-templates-mgr-nonce' ) ) {
			Utilities::ajax_show_error_die( __( 'Refresh your page', 'blocks-for-documents-articles-and-faqs' ) );
		}

		// ensure user has correct permissions
		if ( ! is_admin() || ! current_user_can( 'manage_options' ) ) {
			Utilities::ajax_show_error_die( __( 'Refresh your page', 'blocks-for-documents-articles-and-faqs' ) );
		}

		// get template Id
		$template_id = Utilities::post('templateId');
		if ( ! Utilities::is_positive_int($template_id) ) {
			Utilities::ajax_show_error_die( __( 'Could not get the template id. Refresh your page', 'blocks-for-documents-articles-and-faqs' ) );
		}

		$block_type = Utilities::post('blockType', null);
		$block_type = $block_type == 'template-edit' ? 'template' : $block_type;
		if ( empty($block_type) || ( $block_type != 'preset' && $block_type != 'template' ) ) {
			Utilities::ajax_show_error_die( __( 'Could not get the template type for ID ' . $template_id . '. Refresh your page', 'blocks-for-documents-articles-and-faqs' ) );
		}

		$block_name = Utilities::post('blockName');
		if ( empty($block_name) || ! Utilities_Blocks::is_echo_block_name_valid( $block_name ) ) {
			Utilities::ajax_show_error_die( __( 'Could not get the block name for ID ' . $template_id . '. Refresh your page', 'blocks-for-documents-articles-and-faqs' ) );
		}

		// get template data from the request
		$received_template_attributes = Utilities::post('templateAttributes');
		$received_template_attributes['blockType'] = $received_template_attributes['blockType'] == 'template-edit' ? 'template' : $received_template_attributes['blockType'];
		if ( ! is_array($received_template_attributes) ) {
			Utilities::ajax_show_error_die( __( 'Could not save the template id. Refresh your page', 'blocks-for-documents-articles-and-faqs' ) );
		}

		// get preset/template attributes
		$attributes = Utilities_Blocks::get_attributes( $template_id, $block_type, $block_name );
		if ( empty($attributes) ) {
			Utilities::ajax_show_error_die( __( 'Could not retrieve attributes for ID ' . $template_id . '. ' . ($attributes === null ? 'Refresh your page' : 'Template not found'), 'blocks-for-documents-articles-and-faqs' ) );
		}

		$template_attributes = array_merge($attributes, $received_template_attributes);
		unset($template_attributes['block_id']);

		// validate template ID and block type
		if ( empty($template_id) || ! Utilities::is_positive_int($template_id) || $template_id != $template_attributes['templateId'] ) {
			Utilities::ajax_show_error_die( __( 'Template ID does not match for ' . $template_id . '. Refresh your page', 'blocks-for-documents-articles-and-faqs' ) );
		}
		if ( $block_type != $template_attributes['blockType'] ) {
			Utilities::ajax_show_error_die( __( 'Block type does not match for ' . $template_id . '. Refresh your page', 'blocks-for-documents-articles-and-faqs' ) );
		}

		$handle = new Templates_DB();
		$result = $handle->update_template_attributes( $template_id, $block_name, $template_attributes );
		if ( is_wp_error($result) || empty($result) ) {
			Utilities::ajax_show_error_die( __( 'Could not update the template with ID ' . $template_id . '. Refresh your page', 'blocks-for-documents-articles-and-faqs' ), __( 'Update Template', 'blocks-for-documents-articles-and-faqs' ) );
		}

		// we are done here
		// TODO FUTURE Utilities::ajax_return_success( '' );
	}

	/**
	 * Rename given template
	 */
	public function rename_template() {

		// verify that request is authentic
		if ( empty( $_REQUEST['nonce'] ) || ! wp_verify_nonce( $_REQUEST['nonce'], '_wpnonce_epbl_template_manager_action' ) ) {
			Utilities::ajax_show_error_die( __( 'Refresh your page', 'blocks-for-documents-articles-and-faqs' ) );
		}

		// ensure user has correct permissions
		if ( ! is_admin() || ! current_user_can( 'manage_options' ) ) {
			Utilities::ajax_show_error_die( __( 'Refresh your page', 'blocks-for-documents-articles-and-faqs' ) );
		}

		// get template Id
		$template_id = Utilities::post('templateId');
		if ( ! Utilities::is_positive_int($template_id) ) {
			Utilities::ajax_show_error_die( __( 'Could not get the template id. Refresh your page', 'blocks-for-documents-articles-and-faqs' ) );
		}

		$block_type = Utilities::post('blockType', null);
		if ( empty($block_type) || $block_type != 'template' ) {
			Utilities::ajax_show_error_die( __( 'Could not get the template type for ID ' . $template_id . '. Refresh your page', 'blocks-for-documents-articles-and-faqs' ) );
		}

		$block_name = Utilities::post('blockName');
		if ( empty($block_name) || ! Utilities_Blocks::is_echo_block_name_valid( $block_name ) ) {
			Utilities::ajax_show_error_die( __( 'Could not get the block name for ID ' . $template_id . '. Refresh your page', 'blocks-for-documents-articles-and-faqs' ) );
		}

		$template_name = Utilities::post('templateName', null);
		if ( empty($template_name) || strlen($template_name) > 100 ) {
			Utilities::ajax_show_error_die( __( 'Could not get the template name for ID ' . $template_id . '. Refresh your page', 'blocks-for-documents-articles-and-faqs' ) );
		}

		$template_description = Utilities::post('templateDescription', null);
		if ( strlen($template_description) > 500 ) {
			Utilities::ajax_show_error_die( __( 'Could not get the template description for ID ' . $template_id . '. Refresh your page', 'blocks-for-documents-articles-and-faqs' ) );
		}

		$handle = new Templates_DB();
		$result = $handle->update_template_name_description( $template_id, $block_name, $template_name, $template_description );
		if ( is_wp_error($result) ) {
			Utilities::ajax_show_error_die( __( 'Could not update template for ID ' . $template_id . '. Refresh your page', 'blocks-for-documents-articles-and-faqs' ), __('Could not update template name', 'blocks-for-documents-articles-and-faqs' ) );
		}

		// we are done here
        // TODO FUTURE  Utilities::ajax_return_success( array( 'template_id' => $template_id, 'template_name' => $template_name, 'template_description' => $template_description)  );
	}

	/**
	 * Copy selected preset or template
	 */
	public function copy_template() {

		// verify that request is authentic
		if ( empty( $_REQUEST['nonce'] ) || ! wp_verify_nonce( $_REQUEST['nonce'], '_wpnonce_epbl_template_manager_action' ) ) {
			Utilities::ajax_show_error_die( __( 'Refresh your page', 'blocks-for-documents-articles-and-faqs' ) );
		}

		// ensure user has correct permissions
		if ( ! is_admin() || ! current_user_can( 'manage_options' ) ) {
			Utilities::ajax_show_error_die( __( 'Refresh your page', 'blocks-for-documents-articles-and-faqs' ) );
		}

		// get template Id
		$template_id = Utilities::post('templateId');
		if ( ! Utilities::is_positive_int($template_id) ) {
			Utilities::ajax_show_error_die( __( 'Could not get the template id. Refresh your page', 'blocks-for-documents-articles-and-faqs' ) );
		}

		$block_type = Utilities::post('blockType', null);
		if ( empty($block_type) || ( $block_type != 'preset' && $block_type != 'template' ) ) {
			Utilities::ajax_show_error_die( __( 'Could not get the template type for ID ' . $template_id . '. Refresh your page', 'blocks-for-documents-articles-and-faqs' ) );
		}

		$block_name = Utilities::post('blockName');
		if ( empty($block_name) || ! Utilities_Blocks::is_echo_block_name_valid( $block_name ) ) {
			Utilities::ajax_show_error_die( __( 'Could not get the block name for ID ' . $template_id . '. Refresh your page', 'blocks-for-documents-articles-and-faqs' ) );
		}

		// get preset/template attributes
		$preset_template = Utilities_Blocks::get_preset_template( $template_id, $block_type, $block_name );
		if ( empty($preset_template) ) {
			Utilities::ajax_show_error_die( __( 'Could not retrieve attributes for ID ' . $template_id . '. Refresh your page', 'blocks-for-documents-articles-and-faqs' ) );
		}

		$attributes = $preset_template['attributes'];

		// validate template ID and block type
		if ( $template_id != $attributes['templateId'] ) {
			Utilities::ajax_show_error_die( __( 'Template ID does not match for ' . $template_id . '. Refresh your page', 'blocks-for-documents-articles-and-faqs' ) );
		}

		Utilities_Blocks::remove_non_template_attributes( $block_name, $attributes );

		$handle = new Templates_DB();
		$template_name = __( 'COPY OF ', 'blocks-for-documents-articles-and-faqs' ) . $preset_template['template_name'];
		$template_description = __( 'COPY OF ', 'blocks-for-documents-articles-and-faqs' ) . $preset_template['template_description'];
		$new_template_id = $handle->insert_template_record( $block_name, $template_name, $template_description, '', $attributes );
		if ( is_wp_error($new_template_id) || empty($new_template_id) ) {
			Utilities::ajax_show_error_die( __( 'Could not copy the template with ID ' . $template_id . '. Refresh your page', 'blocks-for-documents-articles-and-faqs' ), __( 'Copy Template', 'blocks-for-documents-articles-and-faqs' ) );
		}

		// we are done here
        // TODO FUTURE Utilities::ajax_return_success( array( 'template_id' => $new_template_id, 'template_name' => $template_name, 'template_description' => $template_description) );
	}

	/**
	 * Save changes to one of the templates.
	 */
	public function delete_template() {

		// verify that request is authentic
		if ( empty( $_REQUEST['nonce'] ) || ! wp_verify_nonce( $_REQUEST['nonce'], '_wpnonce_epbl_template_manager_action' ) ) {
			Utilities::ajax_show_error_die( __( 'Refresh your page', 'blocks-for-documents-articles-and-faqs' ) );
		}

		// ensure user has correct permissions
		if ( ! is_admin() || ! current_user_can( 'manage_options' ) ) {
			Utilities::ajax_show_error_die( __( 'Refresh your page', 'blocks-for-documents-articles-and-faqs' ) );
		}

		// get template Id
		$template_id = Utilities::post('templateId');
		if ( ! Utilities::is_positive_int($template_id) ) {
			Utilities::ajax_show_error_die( __( 'Could not get the template id. Refresh your page', 'blocks-for-documents-articles-and-faqs' ) );
		}

		$block_name = Utilities::post('blockName');
		if ( empty($block_name) || ! Utilities_Blocks::is_echo_block_name_valid( $block_name ) ) {
			Utilities::ajax_show_error_die( __( 'Could not get the block name for ID ' . $template_id . '. Refresh your page', 'blocks-for-documents-articles-and-faqs' ) );
		}

		$handle = new Templates_DB();
		$result = $handle->delete_template( $template_id, $block_name );
		if ( is_wp_error($result) || empty($result) ) {
			Utilities::ajax_show_error_die( __( 'Could not delete the template with ID ' . $template_id . '. Refresh your page', 'blocks-for-documents-articles-and-faqs' ), __( 'Delete Template', 'blocks-for-documents-articles-and-faqs' ) );
		}

		// we are done here
        // TODO FUTURE Utilities::ajax_return_success( '' );
	}

	/**
	 * Return list of templates or presets + templates
	 */
	public function get_list() {

		// verify that request is authentic
		if ( empty( $_REQUEST['nonce'] ) || ! wp_verify_nonce( $_REQUEST['nonce'], 'epbl-templates-mgr-nonce' ) ) {
			Utilities::ajax_show_error_die( __( 'Refresh your page', 'blocks-for-documents-articles-and-faqs' ) );
		}

		$block_name = Utilities::post('blockName');
		if ( empty($block_name) || ! Utilities_Blocks::is_echo_block_name_valid( $block_name ) ) {
			Utilities::ajax_show_error_die( __( 'Could not get the block name ' . $block_name . '. Refresh your page', 'blocks-for-documents-articles-and-faqs' ) );
		}

		$presets = Utilities_Blocks::get_block_presets( $block_name );
		if ( is_wp_error($presets) ) {
			Utilities::ajax_show_error_die( __( 'Could not get presets for ' . $block_name . '. Refresh your page', 'blocks-for-documents-articles-and-faqs' ) );
		}

		$templates = Utilities_Blocks::get_block_templates( $block_name );
		if ( is_wp_error($templates) ) {
			Utilities::ajax_show_error_die( __( 'Could not get templates for ' . $block_name . '. Refresh your page', 'blocks-for-documents-articles-and-faqs' ) );
		}

		$all_list = array_merge( $presets, $templates );

		// at them to the template manager page
		$selection = new stdClass();
		$selection->label = '< choose template >';
		$selection->value = 0;
		$list_selection['all'][] = $selection;
		$list_selection['templates'][] = $selection;

		foreach( $all_list as $item ) {
			if ( empty($item['template_name']) || empty($item['template_id']) ) {
				Utilities::ajax_show_error_die( __( 'Could not get templates for ' . $block_name . ' (2). Refresh your page', 'blocks-for-documents-articles-and-faqs' ) );
			}

			$block_type = $item['attributes']['blockType'];
			$selection = new stdClass();
			$selection->label = $item['template_name'];
			$selection->value = ( $block_type == 'preset' ? 'p' : '' ) . $item['template_id'];
			if ( $block_type == 'template' ) {
				$list_selection['templates'][] = $selection;
			}
			$list_selection['all'][] = $selection;
		}

        // TODO FUTURE Utilities::ajax_return_success( $list_selection );
	}

	/**
	 * Get selected preset or template
	 */
	public function get_preset_template_attributes() {

		// verify that request is authentic
		if ( empty( $_REQUEST['nonce'] ) || ! wp_verify_nonce( $_REQUEST['nonce'], 'epbl-templates-mgr-nonce' ) ) {
			Utilities::ajax_show_error_die( __( 'Refresh your page', 'blocks-for-documents-articles-and-faqs' ) );
		}

		// get template Id
		$template_id = Utilities::post('templateId');
		if ( ! Utilities::is_positive_int($template_id) ) {
			Utilities::ajax_show_error_die( __( 'Could not get the template id. Refresh your page', 'blocks-for-documents-articles-and-faqs' ) );
		}

		$block_type = Utilities::post('blockType', null);
		if ( empty($block_type) || ( $block_type != 'preset' && $block_type != 'template' ) ) {
			Utilities::ajax_show_error_die( __( 'Could not get the template type for ID ' . $template_id . '. Refresh your page', 'blocks-for-documents-articles-and-faqs' ) );
		}

		$block_name = Utilities::post('blockName');
		if ( empty($block_name) || ! Utilities_Blocks::is_echo_block_name_valid( $block_name ) ) {
			Utilities::ajax_show_error_die( __( 'Could not get the block name for ID ' . $template_id . '. Refresh your page', 'blocks-for-documents-articles-and-faqs' ) );
		}

		// get preset/template attributes
		$preset_template = Utilities_Blocks::get_preset_template( $template_id, $block_type, $block_name );
		if ( empty($preset_template) ) {
			Utilities::ajax_show_error_die( __( 'Could not retrieve attributes for ID ' . $template_id . '. Refresh your page', 'blocks-for-documents-articles-and-faqs' ) );
		}

		$attributes = $preset_template['attributes'];
		$attributes['templateName'] = $preset_template['template_name'];

		// remove attributes that are not part of the template
		if ( Utilities::post('excludeCore', false) ) {
			//	unset($attributes['templateId']);
			unset($attributes['blockType']);

			Utilities_Blocks::remove_non_template_attributes( $block_name, $attributes );
		}

        // TODO FUTURE Utilities::ajax_return_success( $attributes );
	}

	/**
	 * Get page for all presets for given block type
	 */
	public function get_presets_templates_page() {

		// verify that request is authentic
		if ( empty( $_REQUEST['nonce'] ) || ! wp_verify_nonce( $_REQUEST['nonce'], '_wpnonce_epbl_template_manager_action' ) ) {
			Utilities::ajax_show_error_die( __( 'Refresh your page', 'blocks-for-documents-articles-and-faqs' ) );
		}

		$block_name = Utilities::post('blockName');
		if ( empty($block_name) || ! Utilities_Blocks::is_echo_block_name_valid( $block_name ) ) {
			Utilities::ajax_show_error_die( __( 'Could not get the block type. Refresh your page', 'blocks-for-documents-articles-and-faqs' ) );
		}

		$result = array();
		$handler = new Template_Manager_View();
		$handler->load_selected_block_type( $block_name );

		// retrieve presets
		ob_start();
		$handler->display_preset_panel();
		$result['presets'] = ob_get_clean();

		// get templates
		ob_start();
		$handler->display_template_panel( $block_name );
		$result['templates'] = ob_get_clean();

		$result['blockName'] = $block_name;

        // TODO FUTURE Utilities::ajax_return_success( $result );
	}

	public function user_not_logged_in() {
		Utilities::ajax_show_error_die( '<p>' . __( 'You are not logged in. Refresh your page and log in', 'blocks-for-documents-articles-and-faqs' ) . '.</p>', __( 'Cannot save your changes', 'blocks-for-documents-articles-and-faqs' ) );
	}
}
