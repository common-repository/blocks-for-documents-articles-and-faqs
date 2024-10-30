<?php
namespace Echo_Doc_Blocks\Includes\features\presets;


defined( 'ABSPATH' ) || exit();

abstract class Presets {

	protected abstract function get_block_defaults();

	protected abstract function get_all_presets();

	protected abstract function get_preset( $template_id );

	protected abstract function get_non_template_attribute_names();

	/**
	 * Get presets class for given block name.
	 * @param $block_name
	 * @return Object|null
	 */
	public static function get_block_preset_class( $block_name ) {
		switch ( $block_name ) {
			case 'section-heading':
				return new Presets_Section_Heading();
			case 'info-box':
				return new Presets_Info_Box();
			case 'multiple-lists':
				return new Presets_Multiple_list();
			case 'text-image':
				return new Presets_Text_Image();
			case 'text-video':
				return new Presets_Text_Video();
		}

		return null;
	}

	public static function get_the_block_defaults( $block_name ) {
		$handler = self::get_block_preset_class( $block_name );
		if ( empty($handler) ) {
			return null;
		}

		return $handler->get_block_defaults();
	}
}