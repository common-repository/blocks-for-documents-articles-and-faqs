<?php
namespace Echo_Doc_Blocks\Includes\features\templates;

defined( 'ABSPATH' ) || exit();

/**
 * Generate stylesheet for the front-end display.
 * Reused and modified some code from the UAGB_Helper class of the Ultimate addons for Gutenberg plugin.
 */
class Admin_Page_Assets {

	// do we have EPBL block(s) on the page
	public static $found_epbl_blocks = false;
	public static $page_epbl_blocks = array();

	public function __construct() {
		add_action( 'admin_head', array( $this, 'prepare_template_data' ), 80 );
	}

	public function prepare_template_data() {
		global $post;

		$template_names = array();

		if ( empty($post->post_content) ) {     ?>
			<script type="text/javascript" >
				let epblTemplateNames = <?php echo json_encode($template_names, JSON_HEX_TAG); ?>;
			</script>   <?php
			return;
		}

		Templates_Setup::prep_templates( $post->post_content );

		$template_attributes = array();
		foreach( Templates_Setup::$required_templates as $template ) {
			if ( ! isset($template['template_id']) ) {
				continue;
			}

			Utilities_Blocks::remove_non_template_attributes( $template['block_name'], $template['attributes'] );
			$template_attributes[$template['template_id']] = $template['attributes'];
			$template_names[$template['template_id']] = $template['template_name'];
		}

		if ( empty($template_attributes) ) {    ?>
			<script type="text/javascript" >
				let epblTemplateNames = <?php echo json_encode($template_names, JSON_HEX_TAG); ?>;
			</script>   <?php
			return;
		}

		$template_id = 0;
		$blockEditorBlockIds = array();
		foreach( Templates_Setup::$page_epbl_blocks as $page_block ) {

			// ignore other blocks
			if ( empty($page_block['blockName']) || strpos($page_block['blockName'], 'echo-document-blocks/') === false || empty($page_block['attrs']['templateId']) ) {
				continue;
			}

			if ( ! empty($page_block['blockName']) && $page_block['blockName'] == 'echo-document-blocks/template-info' ) {
				$template_id = $page_block['attrs']['templateId'];
				break;
			} else if ( ! empty($page_block['attrs']['block_id']) ) {
				$blockEditorBlockIds[$page_block['attrs']['block_id']] = $page_block['attrs']['templateId'];
			}
		}       ?>

		<script type="text/javascript" >
			let epblTemplateAttributes = <?php echo json_encode($template_attributes, JSON_HEX_TAG); ?>;
			let epblTemplateNames = <?php echo json_encode($template_names, JSON_HEX_TAG); ?>;
			let templateEditorId = <?php echo json_encode($template_id, JSON_HEX_TAG); ?>;
			let blockEditorBlockIds = <?php echo json_encode($blockEditorBlockIds, JSON_HEX_TAG); ?>;
		</script>   <?php
	}
}