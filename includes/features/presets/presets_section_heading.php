<?php
namespace Echo_Doc_Blocks\Includes\features\presets;

use Echo_Doc_Blocks\Includes\features\frontend\All_Blocks_CSS;


defined( 'ABSPATH' ) || exit();

class Presets_Section_Heading extends Presets {

	public function get_block_defaults() {

		$default_attributes = All_Blocks_CSS::$section_heading_defaults;

		$default_attributes['blockType'] = 'preset';
		$default_attributes['templateId'] = 0;
		$default_attributes['headingText'] = 'Defaults';

		return $default_attributes;
	}

	public function get_all_presets() {
		$all_presets = array();
		$all_presets[1] = self::get_preset( 1 );
		$all_presets[2] = self::get_preset( 2 );
		return $all_presets;
	}

	public function get_preset( $template_id ) {

		if ( ! Utilities::is_positive_int( $template_id ) ) {
			return self::get_block_defaults();
		}

		$preset = array();
		$preset['block_name'] = 'section-heading';
		$preset['template_id'] = $template_id;

		switch( $template_id ) {

			// GROUP - BASIC
			case 1:
				$preset['template_name'] = 'Basic Main Heading';
				$preset['template_description'] = 'H2 - Black Text with bottom Grey Solid Border';
				$preset['attributes'] = self::$preset_1;
				$preset['group'] = 'Basic:::1';
				break;
			case 2:
				$preset['template_name'] = 'Basic Sub Heading';
				$preset['template_description'] = 'H3 - Dark Grey Text with bottom Grey Dashed Border';
				$preset['attributes'] = self::$preset_2;
				$preset['group'] = 'Basic:::2';
				break;
			default:
				$preset['attributes'] = self::get_block_defaults();
		}

		$preset['attributes'] = array_merge(self::get_block_defaults(), $preset['attributes']);

		return $preset;
	}

	public function get_non_template_attribute_names() {
		return array('headingText' => 'unknown', 'htmlAnchor' => 'unknown', 'cssClass' => 'unknown');
	}

	public static $preset_1 = array(
		'blockType'                     => 'preset',
		'templateId'                    => 1,                  // THIS IS PRESET ID
		'headingText'                   => 'Preset Title',
	);

	public static $preset_2 = array(
		'blockType'                     => 'preset',
		'templateId'                    => 2,                  // THIS IS PRESET ID
		'headingText'                   => 'Title',

		'level'                         => 3,
		'tagName'                       => 'h3',
		'fontSizeDesktop'               => 23,
		'fontSizeTablet'                => 23,
		'fontSizeMobile'                => 23,
		'headingColor'                  => '#666',
		'borderBottomStyle'             => 'dotted',
	);

}