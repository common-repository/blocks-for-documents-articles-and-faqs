<?php
namespace Echo_Doc_Blocks\Includes\features\frontend;

use Echo_Doc_Blocks\Includes\features\templates\Templates_Setup;

defined( 'ABSPATH' ) || exit();

/**
 * Generate stylesheet for the front-end display.
 * Reused and modified some code from the UAGB_Helper class of the Ultimate addons for Gutenberg plugin.
 */
class Page_Assets {

	// generated EPBL blocks stylesheets and scripts
	public static $stylesheet;
	public static $script;

	public function __construct() {

		// 1. generate CSS and JS
		add_action( 'wp', array( $this, 'generate_assets' ), 99 );
      // TODO FUTURE add_action( 'wp_enqueue_scripts', array( $this, 'generate_asset_files' ), 1 );

		// 2. output generated CSS and JS
		add_action( 'wp_enqueue_scripts', array( $this, 'block_assets' ), 10 );
		add_action( 'wp_head', array( $this, 'print_stylesheet' ), 80 );
		// add_action( 'wp_footer', array( $this, 'print_script' ), 1000 );
	}

	/**
	 * Enqueue block assets for both frontend and backend.
	 */
	public function block_assets() {

		$front_end_blocks_js = array('text-image', 'text-video');

		// if SCRIPT_DEBUG is off then use minified scripts
		$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

		// get all unique EPBL block names
		$block_names = array();
		foreach( Templates_Setup::$page_epbl_blocks as $page_epbl_block ) {
			$block_name = empty($page_epbl_block['blockName']) ? '' : str_replace('echo-document-blocks/', '', $page_epbl_block['blockName']);

			if ( ! empty($block_name) && in_array($block_name, $front_end_blocks_js) ) {
				$block_names[] = $block_name;
			}
		}

		$jquery = array('jquery');
		foreach ( $block_names as $block_name ) {
			wp_enqueue_script( 'epbl-front-end-blocks-js-' . $block_name, ECHO_BLOCKS_ASSETS_URL . 'js/' . $block_name . $suffix . '.js', $jquery, ECHO_BLOCKS_VERSION );
			$jquery = array();
		}
	}

	/**
	 * Print the stylesheet in header.
	 */
	public function print_stylesheet() {

		if ( empty(self::$stylesheet) ) {
			return;
		}

		ob_start();		?>
		<style type="text/css" media="all" id="epbl-style-frontend"><?php echo self::$stylesheet; ?></style>		<?php
		ob_end_flush();
	}

	/**
	 * Print the Script in the page footer.
	 */
	public function print_script() {

		if ( empty(self::$script) ) {
			return;
		}

		ob_start();		?>
		<script type="text/javascript" id="epbl-frontend-script">( function( $ ) { <?php echo self::$script; ?> })(jQuery) </script>		<?php
		ob_end_flush();
	}

	/**
	 * Generates stylesheet and appends it in the HEAD tag.
	 */
	public function generate_assets() {

		if ( is_single() || is_page() || is_404() ) {

			global $post;
			$this_post = $post;
			if ( ! is_object( $this_post ) ) {
				return;
			}
			$this->get_generated_stylesheet_for_post( $this_post );

		} elseif ( is_archive() || is_home() || is_search() ) {

			global $wp_query;
          $cached_wp_query = $wp_query;

          foreach ( $cached_wp_query as $post ) {
              $this->get_generated_stylesheet_for_post( $post );
          }

		}
	}

	/**
	 * Find blocks for current post and then stylesheets for them.
	 *
	 * @param object $this_post Current Post Object.
	 */
	private function get_generated_stylesheet_for_post( $this_post ) {

		if ( ! is_object($this_post) || ! isset($this_post->ID) || ! has_blocks( $this_post->ID ) || empty( $this_post->post_content ) ) {
			return;
		}

		Templates_Setup::prep_templates( $this_post->post_content );  // get_stylesheet()
		$required_templates = Templates_Setup::$required_templates;
		$this->final_combine_resources( $required_templates );
	}

	/**
	 * Combine CSS / JS for all EPBL blocks.
	 *
	 * @param $required_templates
	 */
	public function final_combine_resources( $required_templates ) {

		// page has no EPBL blocks
		if ( empty(Templates_Setup::$page_epbl_blocks) ) {
			return;
		} else {
			Templates_Setup::$found_epbl_blocks = true;
		}

		$css_desktop = '';
		$css_tablet  = '';
		$css_mobile  = '';
		$css_import = '';
		$js_all = '';

		foreach( Templates_Setup::$page_epbl_blocks as $page_epbl_block ) {

			$block_attributes = ! empty($page_epbl_block['attrs']) && is_array($page_epbl_block['attrs']) ? $page_epbl_block['attrs'] : array();
			$block_id  = empty($block_attributes['block_id']) ? '' : $block_attributes['block_id'];
			$block_template_id = empty($block_attributes['templateId']) ? 0 : $block_attributes['templateId'];
			$block_name = empty($page_epbl_block['blockName']) ? '' : $page_epbl_block['blockName'];

			// if available then apply template
			$block_template = empty($required_templates[$block_template_id]) ? array() : $required_templates[$block_template_id];
			if ( ! empty($block_template_id) && ! empty($block_template) && ( 'echo-document-blocks/' .$block_template['block_name'] == $block_name ) ) {
				$block_attributes = array_merge( $block_attributes, $block_template['attributes'] );
			}

			$resources = $this->get_epbl_block_resources( $block_name, $block_attributes, $block_id );
			$css = $resources['css'];

			$css_desktop .= ( isset( $css['desktop'] ) ? $css['desktop'] : '' );
			$css_tablet  .= ( isset( $css['tablet'] ) ? $css['tablet'] : '' );
			$css_mobile  .= ( isset( $css['mobile'] ) ? $css['mobile'] : '' );
			
			$css_import .= ( isset( $css['import'] ) ? $css['import'] : '' );
		}

		$tab_styling_css = '';
		if ( ! empty( $css_tablet ) ) {
			$tab_styling_css .= '@media only screen and (max-width: ' . ECHO_BLOCKS_TABLET_BREAKPOINT . 'px) {';
			$tab_styling_css .= $css_tablet;
			$tab_styling_css .= '}';
		}

		$mob_styling_css = '';
		if ( ! empty( $css_mobile ) ) {
			$mob_styling_css .= '@media only screen and (max-width: ' . ECHO_BLOCKS_MOBILE_BREAKPOINT . 'px) {';
			$mob_styling_css .= $css_mobile;
			$mob_styling_css .= '}';
		}

		// prepare for output
		self::$stylesheet = $css_import . $css_desktop . $tab_styling_css . $mob_styling_css;
		self::$script = $js_all;
	}

	public function get_epbl_block_resources( $block_name, $blockattr, $block_id ) {
		$css = array();
		$js = array();
		switch ( $block_name ) {
			case 'echo-document-blocks/section-heading':
				$css += All_Blocks_CSS::get_section_heading_css( $blockattr, $block_id );
				break;
			case 'echo-document-blocks/kb-articles':
				$css += All_Blocks_CSS::get_kb_recent_articles_css( $blockattr, $block_id );
				break;
			case 'echo-document-blocks/kb-categories':
				$css += All_Blocks_CSS::get_kb_categories_css( $blockattr, $block_id );
				break;
			case 'echo-document-blocks/knowledge-base':
				$css += All_Blocks_CSS::get_kb_css( $blockattr, $block_id );
				break;
			case 'echo-document-blocks/info-box':
				$css += All_Blocks_CSS::get_info_box_css( $blockattr, $block_id );
				break;
			case 'echo-document-blocks/multiple-lists':
				$css += All_Blocks_CSS::get_multiple_lists_css( $blockattr, $block_id );
				break;
			case 'echo-document-blocks/text-image':
				$css += All_Blocks_CSS::get_text_image_css( $blockattr, $block_id );
				break;
			case 'echo-document-blocks/text-video':
				$css += All_Blocks_CSS::get_text_video_css( $blockattr, $block_id );
				break;
			default:
				// this is not our block
				break;
		}

		return array('css' => $css, 'js' => $js );
	}

	/**
	 * Parse Gutenberg Block.
	 *
	 * @param string $content the content string.
	 * @return array
	 */
	private function parse( $content ) {
		global $wp_version;
		/** @noinspection PhpUndefinedFunctionInspection */
		return ( version_compare( $wp_version, '5', '>=' ) ) ? parse_blocks( $content ) : gutenberg_parse_blocks( $content );
	}
}