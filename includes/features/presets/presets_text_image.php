<?php
namespace Echo_Doc_Blocks\Includes\features\presets;

use Echo_Doc_Blocks\Includes\features\frontend\All_Blocks_CSS;


defined( 'ABSPATH' ) || exit();

class Presets_Text_Image extends Presets {

	public function get_block_defaults() {

		$default_attributes = All_Blocks_CSS::$text_image_defaults;

		$default_attributes['blockType'] = 'preset';
		$default_attributes['templateId'] = 0;
		$default_attributes['headingText'] = 'Defaults';

		return $default_attributes;
	}

	public function get_all_presets() {
		$all_presets = array();
		$all_presets[1] = self::get_preset( 1 );
		$all_presets[2] = self::get_preset( 2 );
		$all_presets[3] = self::get_preset( 3 );
		$all_presets[4] = self::get_preset( 4 );
		return $all_presets;
	}

	public function get_preset( $template_id ) {

		if ( ! Utilities::is_positive_int( $template_id ) ) {
			return self::get_block_defaults();
		}

		$preset = array();
		$preset['block_name'] = 'text-image';
		$preset['template_id'] = $template_id;

		switch( $template_id ) {
			case 1:
				$preset['template_name'] = 'Preset 1: Text + Image';
				$preset['template_description'] = 'Text than image, image description over image.';
				$preset['attributes'] = self::$preset_1;
				break;
			case 2:
				$preset['template_name'] = 'Preset 2: Text + Image';
				$preset['template_description'] = 'Text than image, image description under image.';
				$preset['attributes'] = self::$preset_2;
				break;
			case 3:
				$preset['template_name'] = 'Preset 3: Text + Image';
				$preset['template_description'] = 'Text than image, image description over image and rounded corners.';
				$preset['attributes'] = self::$preset_3;
				break;
			case 4:
				$preset['template_name'] = 'Preset 4: Image + Text';
				$preset['template_description'] = 'Image than Text';
				$preset['attributes'] = self::$preset_4;
				break;
			default:
				$preset['attributes'] = self::get_block_defaults();
		}

		$preset['attributes'] = array_merge(self::get_block_defaults(), $preset['attributes']);

		return $preset;
	}

	public function get_non_template_attribute_names() {
		return array('imageDescription' => 'unknown', 'cssClass' => 'unknown');
	}

	public static $preset_1 = array(
		'blockType'                         => 'preset',
		'templateId'                        => 1,                  // THIS IS PRESET ID
		'imageDescriptionTextColor'         => "#ffffff"
	);

	public static $preset_2 = array(
		'blockType'                         => 'preset',
		'templateId'                        => 2,                  // THIS IS PRESET ID
		'imageDescriptionLocation'          => 'below-image',
		'imageDescriptionPadding'           => 5
	);

	public static $preset_3 = array(
		'blockType'                         => 'preset',
		'templateId'                        => 3,                  // THIS IS PRESET ID
		'imageDescriptionTextColor'         => "#ffffff",
		'imageDescriptionBackgroundColor'   => "rgba(0, 0, 0, 0.5);",
		'imageDescriptionLocation'          => 'bottom-image',
		'imageBorderThickness'              =>'4',
		'imageBorderRadius'                 =>'50',
		'imageBorderColor'                  =>'#000'
	);

	public static $preset_4 = array(
		'blockType'                         => 'preset',
		'templateId'                        => 4,                  // THIS IS PRESET ID
		'imageDescriptionTextColor'         => "#ffffff",
		'imageDescriptionBackgroundColor'   => "rgba(0, 0, 0, 0.5);",
		'imageDescriptionLocation'          => 'top-image',
		'imageBorderThickness'              =>'2',
		'imageBorderRadius'                 =>'20',
		'imageBorderColor'                  =>'#000',
		'textLocation'                      =>'right'
	);
}