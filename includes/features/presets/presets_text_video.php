<?php
namespace Echo_Doc_Blocks\Includes\features\presets;

use Echo_Doc_Blocks\Includes\features\frontend\All_Blocks_CSS;


defined( 'ABSPATH' ) || exit();

class Presets_Text_Video extends Presets {

	public function get_block_defaults() {

		$default_attributes = All_Blocks_CSS::$text_video_defaults;

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
		return $all_presets;
	}

	public function get_preset( $template_id ) {

		if ( ! Utilities::is_positive_int( $template_id ) ) {
			return self::get_block_defaults();
		}

		$preset = array();
		$preset['block_name'] = 'text-video';
		$preset['template_id'] = $template_id;

		switch( $template_id ) {
			case 1:
				$preset['template_name'] = 'Preset 1: Basic Text + Image setup';
				$preset['template_description'] = 'TODO';
				$preset['attributes'] = self::$preset_1;
				break;
			case 2:
				$preset['template_name'] = 'Preset 2: Basic Text + Image setup';
				$preset['template_description'] = 'TODO.';
				$preset['attributes'] = self::$preset_2;
				break;
			case 3:
				$preset['template_name'] = 'Preset 3: Basic Text + Image setup';
				$preset['template_description'] = 'TODO';
				$preset['attributes'] = self::$preset_3;
				break;
			case 4:
				$preset['template_name'] = 'TODO';
				$preset['template_description'] = 'TODO';
				$preset['attributes'] = self::$preset_4;
				break;
			default:
				$preset['attributes'] = self::get_block_defaults();
		}

		$preset['attributes'] = array_merge(self::get_block_defaults(), $preset['attributes']);

		return $preset;
	}

	public function get_non_template_attribute_names() {
		return array('videoDescription' => 'unknown', 'cssClass' => 'unknown');
	}

	public static $preset_1 = array(
	
		'blockType'                         =>  'preset',
		'templateId'                        =>  1,                  // THIS IS PRESET ID
		'textLocation'                      =>  'left',
		'videoBorderThickness'              =>  0,
		'videoBorderRadius'                 =>  0,
		'videoBorderColor'                  =>  '#de4141',
		'videoZoomOnToggle'                 =>  true,
		'videoZoomTextColor'                =>  '#212121',
		'videoZoomBorderColor'              =>  '#fcb900',
		'videoZoomIcon'                     =>  'epbl-plus-circle',
		'videoZoomIconColor'                =>  '#FFFFFF',
		'videoDescriptionLocation'          =>  'below-video',
		'videoDescriptionTextColor'         =>  '#212121',
		'videoDescriptionBackgroundColor'   =>  '#ffffff',
		'videoDescriptionTextAlign'         =>  'center',
		'videoDescriptionPadding'           =>  5,
		'videoDescriptionFontSizeType'      => 'px',
		'videoDescriptionFontSizeDesktop'   => 16,
		'videoDescriptionFontSizeTablet'    => 16,
		'videoDescriptionFontSizeMobile'    => 16,
		'videoPosition'                     =>  'left',

		);

	public static $preset_2 = array(
		'blockType'                         => 'preset',
		'templateId'                        => 2,                  // THIS IS PRESET ID
		'textLocation'                      =>  'left',
		'videoBorderThickness'              =>  0,
		'videoBorderRadius'                 =>  0,
		'videoBorderColor'                  =>  '#de4141',
		'videoZoomOnToggle'                 =>  true,
		'videoZoomTextColor'                =>  '#212121',
		'videoZoomBorderColor'              =>  '#fcb900',
		'videoZoomIcon'                     =>  'epbl-plus-circle',
		'videoZoomIconColor'                =>  '#FFFFFF',
		'videoDescriptionLocation'          =>  'bottom-video',
		'videoDescriptionTextColor'         =>  '#212121',
		'videoDescriptionBackgroundColor'   =>  'rgba(246, 255, 140, 0.91)',
		'videoDescriptionTextAlign'         =>  'center',
		'videoDescriptionPadding'           =>  20,
		'videoDescriptionFontSizeType'      => 'px',
		'videoDescriptionFontSizeDesktop'   => 16,
		'videoDescriptionFontSizeTablet'    => 16,
		'videoDescriptionFontSizeMobile'    => 16,
		'videoPosition'                     =>  'left',

	);

	public static $preset_3 = array(
		'blockType'                     => 'preset',
		'templateId'                    => 3,                  // THIS IS PRESET ID
		'textLocation'                      =>  'left',
		'videoBorderThickness'              =>  3,
		'videoBorderRadius'                 =>  20,
		'videoBorderColor'                  =>  '#2b7cac',
		'videoZoomOnToggle'                 =>  true,
		'videoZoomTextColor'                =>  '#212121',
		'videoZoomBorderColor'              =>  '#fcb900',
		'videoZoomIcon'                     =>  'epbl-plus-circle',
		'videoZoomIconColor'                =>  '#FFFFFF',
		'videoDescriptionLocation'          =>  'below-video',
		'videoDescriptionTextColor'         =>  '#212121',
		'videoDescriptionBackgroundColor'   =>  '#f7f7f7',
		'videoDescriptionTextAlign'         =>  'center',
		'videoDescriptionPadding'           =>  20,
		'videoDescriptionFontSizeType'      => 'px',
		'videoDescriptionFontSizeDesktop'   => 16,
		'videoDescriptionFontSizeTablet'    => 16,
		'videoDescriptionFontSizeMobile'    => 16,
		'videoPosition'
	);

	public static $preset_4 = array(
		'blockType'                     => 'preset',
		'templateId'                    => 4,                  // THIS IS PRESET ID

	);
}