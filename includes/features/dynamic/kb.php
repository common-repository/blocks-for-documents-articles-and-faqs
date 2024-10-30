<?php
namespace Echo_Doc_Blocks\Includes\Features\Dynamic;

use Echo_Doc_Blocks\Includes\Utilities;
use Echo_Doc_Blocks\Includes\Utilities_Plugin;

defined( 'ABSPATH' ) || exit();

/**
 * Dynamic block for KB shortcode
 */
class KB {
	
	public static function get_default_fields() {
			return array(
			
				'block_id' => array(
					'default' => '',
					'type' => 'string'
				),
				
				'blockType' => array(
					'default' => '',
					'type' => 'string'
				),
				
				'templateId' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'kb_id' => array(
					'default' => 1,
					'type' => 'number'
				),
				
				'advancedMarginTop' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'advancedMarginRight' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'advancedMarginBottom' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'advancedMarginLeft' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'advancedPaddingTop' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'advancedPaddingRight' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'advancedPaddingBottom' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'advancedPaddingLeft' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'advancedZIndex' => array(
					'default' => '',
					'type' => 'string'
				),
				
				'advancedClass' => array(
					'default' => '',
					'type' => 'string'
				),
				
				'advancedBorderType' => array(
					'default' => '',
					'type' => 'string'
				),
				
				'advancedBorderWidthTop' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'advancedBorderWidthRight' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'advancedBorderWidthBottom' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'advancedBorderWidthLeft' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'advancedBorderColor' => array(
					'default' => '',
					'type' => 'string'
				),
				
				'advancedBorderRadius' => array(
					'default' => 0,
					'type' => 'number'
				),
				
				'advancedBoxShadow' => array(
					'default' => array(
						'blur' => 0,
						'color' => '',
						'position' => '',
						'spread' => 0,
						'x' => 0,
						'y' => 0,
					),
					'type' => 'object'
				),

				'hideOnDesktop' => array(
					'default' => false,
					'type' => 'boolean'
				),
				
				'hideOnMobile' => array(
					'default' => false,
					'type' => 'boolean'
				),
				
				'hideOnTablet' => array(
					'default' => false,
					'type' => 'boolean'
				),

			);
	}
	
	public function __construct()  {
		add_action( 'init', array( $this, 'register_knowledge_base' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'load_resources' ), 99 );
	}
	
	public function load_resources() {
		global $pagenow;
		
		if ( ( $pagenow == 'post.php' || $pagenow == 'post-new.php' ) && Utilities::is_block_editor_active() && function_exists('epkb_register_public_resources') && function_exists('epkb_enqueue_public_resources') ) {
			epkb_register_public_resources();
			epkb_enqueue_public_resources();
		}
	}
	
	public function register_knowledge_base() {
		register_block_type( 'echo-document-blocks/knowledge-base', array(
			'attributes' => self::get_default_fields(),
			'render_callback' => array( $this, 'render_knowledge_base' )
		) );
	}
	
	public function render_knowledge_base( $block_attributes, $content ) {
		global $post;

		// KB plugin needs to be active
		if ( ! Utilities::is_kb_plugin_active() ) {
			return Utilities_Plugin::get_kb_error_message();
		}

		// only pages can have KB Main Page
		if ( empty($post->post_type) || $post->post_type != 'page' ) {
			return Utilities_Plugin::get_kb_post_error_message();
		}

		ob_start();
	
		$kb_id =  empty($block_attributes['kb_id']) ? 1 : $block_attributes['kb_id'];
		$advancedClass = $block_attributes['advancedClass'];
		$block_id = $block_attributes['block_id'];		?>
		
		<div id="epbl-knowledge-base-<?php echo $block_id; ?>" class="epbl-kb-container <?php echo $advancedClass; ?>">
			<?php echo do_shortcode('[epkb-knowledge-base id="' . $kb_id . '"]'); ?>
		</div>		<?php

		return ob_get_clean();
	}

	public static function get_kb_plugin_install_link() {
		return '<a href="' . admin_url( 'plugin-install.php' ) . '?s=echoplugins&tab=search&type=author' . '" target="_blank">' . __( 'here', 'blocks-for-documents-articles-and-faqs' ) . '</a>';
	}
	
}