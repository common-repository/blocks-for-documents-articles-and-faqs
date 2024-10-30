<?php
namespace Echo_Doc_Blocks\Includes\features\templates;

/**
 * Parse blocks for given page, retrieve EPBL templates and store them in memory
 *
 */
class Templates_Setup {

	// do we have EPBL block(s) on the page
	public static $found_epbl_blocks = false;
	public static $page_epbl_blocks = array();
	public static $required_templates = array();

	/**
	 * Find temlates for given content and retrieve them from DB
	 *
	 * @param String $content post content
	 */
	public static function prep_templates( $content ) {

		$blocks = self::parse( $content );
		if ( ! is_array($blocks) || empty($blocks) ) {
			return;
		}

		self::find_templates( $blocks );
		// TODO FUTURE self::store_templates();
	}

	/**
	 * Generates stylesheet for reusable blocks.
	 *
	 * @param array $blocks Blocks array.
	 */
	private static function find_templates( $blocks ) {  // get_assets()

		// get stylesheet for each block
		foreach ( $blocks as $i => $block ) {

			if ( ! is_array( $block ) || empty($block['blockName']) ) {
				continue;
			}

			// parse REUSABLE BLOCKS
			if ( 'core/block' === $block['blockName'] ) {
				$id = ( isset( $block['attrs']['ref'] ) ) ? $block['attrs']['ref'] : 0;
				if ( $id ) {
					$content = get_post_field( 'post_content', $id );
					$reusable_blocks = self::parse( $content );
					self::find_templates( $reusable_blocks );
				}

			// retrieve CUSTOM BLOCK CSS (ours or someone's else)
			} else {

				if ( strpos( $block['blockName'], 'echo-document-blocks/' ) !== false ) {
					self::$page_epbl_blocks[] = $block;
				}

				self::get_inner_block_resources( $block );
			}
		}
	}

	/**
	 * Generates CSS recursively for this specific EPBL block.
	 *
	 * @param array $block The block object.
	 */
	private static function get_inner_block_resources( $block ) {  // get_block_css() -> get_block_css_and_js()

		$block = (array) $block;
		if ( empty($block['blockName']) ) {
			return;
		}

		// loop through blocks within blocks
		$inner_blocks = empty($block['innerBlocks']) ? array() : $block['innerBlocks'];
		foreach ( $inner_blocks as $j => $inner_block ) {

			// parse REUSABLE BLOCKS
			if ( 'core/block' === $inner_block['blockName'] ) {
				$id = ( isset( $inner_block['attrs']['ref'] ) ) ? $inner_block['attrs']['ref'] : 0;
				if ( $id ) {
					$content = get_post_field( 'post_content', $id );
					$reusable_blocks = self::parse( $content );
					self::find_templates( $reusable_blocks );
				}

			// retrieve CUSTOM BLOCK CSS (ours or someone's else)
			} else {

				if ( strpos( $inner_block['blockName'], 'echo-document-blocks/' ) !== false ) {
					self::$page_epbl_blocks[] = $inner_block;
				}

				// Get CSS for the Block.
				self::get_inner_block_resources( $inner_block );
			}
		}
	}

	/**
	 * Retrieve templates from DB (if they exist) and store them
	 */
	private static function store_templates() { // TODO FUTURE

		// page has no EPBL blocks
		if ( empty(self::$page_epbl_blocks) ) {
			return;
		} else {
			self::$found_epbl_blocks = true;
		}

		// get all unique template IDs to retrieve from DB
		$all_template_ids = array();
		foreach( self::$page_epbl_blocks as $page_epbl_block ) {
			$template_id = empty($page_epbl_block['attrs']['templateId']) || ! is_numeric($page_epbl_block['attrs']['templateId']) ? 0 : $page_epbl_block['attrs']['templateId'];
			$template_id = $template_id < 0 ? 0 : $template_id;
			$all_template_ids[] = $template_id;
		}
		$all_template_ids = array_unique( $all_template_ids );

		// TODO FUTURE self::retrieve_templates_from_db( $all_template_ids );
	}

	/**
	 * Retrieve all required tempplates from DB if they exists
	 *
	 * @param $all_template_ids
	 */
	private static function retrieve_templates_from_db( $all_template_ids ) {  // TODO FUTURE
		$handler = new Templates_DB();
		$templates = $handler->get_templates( $all_template_ids );
		if ( empty($templates) ) {
			$templates = array();
		}

		// regroup
		foreach( $templates as $template ) {
			$template_id = empty($template['template_id']) ? 0 : $template['template_id'];
			if (  empty($template_id) || ! is_numeric($template_id) || empty($template['block_name']) || empty($template['attributes']) || ! is_array($template['attributes']) ) {
				continue;
			}
			self::$required_templates[$template_id] = $template;
		}
	}

	/**
	 * Parse Gutenberg Block.
	 *
	 * @param string $content the content string.
	 * @return array
	 */
	public static function parse( $content ) {
		global $wp_version;
		/** @noinspection PhpUndefinedFunctionInspection */
		return ( version_compare( $wp_version, '5', '>=' ) ) ? parse_blocks( $content ) : gutenberg_parse_blocks( $content );
	}
}