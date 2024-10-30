<?php
namespace Echo_Doc_Blocks\Includes\features\presets;

use Echo_Doc_Blocks\Includes\features\frontend\All_Blocks_CSS;

defined( 'ABSPATH' ) || exit();

class Presets_Info_Box extends Presets {

	public function get_block_defaults() {

		$default_attributes = All_Blocks_CSS::$info_box_defaults;

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
		$preset['block_name'] = 'info-box';
		$preset['template_id'] = $template_id;

		switch( $template_id ) {

			// GROUP - BASIC
			case 1:
				$preset['template_name'] = 'Information Box';
				$preset['template_description'] = 'Standard Grey info box, used to give users some information';
				$preset['attributes'] = self::$preset_1;
				$preset['group'] = 'Basic:::1';
				break;
			case 2:
				$preset['template_name'] = 'Success box';
				$preset['template_description'] = 'Standard Green notification box, used to give users some update of successful task.';
				$preset['attributes'] = self::$preset_2;
				$preset['group'] = 'Basic:::2';
				break;
			case 3:
				$preset['template_name'] = 'Warning box';
				$preset['template_description'] = 'Standard Orange notification box, used to give users some warning';
				$preset['attributes'] = self::$preset_3;
				$preset['group'] = 'Basic:::3';
				break;
			case 4:
				$preset['template_name'] = 'Error box';
				$preset['template_description'] = 'Standard Red notification box, used to give users some critical warnings';
				$preset['attributes'] = self::$preset_4;
				$preset['group'] = 'Basic:::4';
				break;
			default:
				$preset['attributes'] = self::get_block_defaults();
		}

		$preset['attributes'] = array_merge(self::get_block_defaults(), $preset['attributes']);

		return $preset;
	}

	public function get_non_template_attribute_names() {
		return array('learnMoreURL' => 'unknown', 'bodyText' => 'unknown', 'learnMoreText' => 'unknown', 'cssClass' => 'unknown');
	}

	//Information Box - Grey Box
	public static $preset_1 = array(
	
		'blockType'                     => 'preset',
		'templateId'                    => 1,                  // THIS IS PRESET ID

		// General
		// Icon		
		// Header ( Title )
		
		// Body
		'bodyText'                          => 'The <strong>Information</strong> Box is light grey, and is meant to convey information to the user. The Title, background and all other attributes can be changed in the sidebar settings. This example text is going to run a bit longer so that you can see how spacing within this box works with this kind of content.',
	);

	//Success Box - Green Box
	public static $preset_2 = array(
		'blockType'                     => 'preset',
		'templateId'                    => 2,                  // THIS IS PRESET ID
		// General
		'containerBorderColor'          => '#c3e2ca',

		// Icon
		'iconType'                      => 'epbl-check-square-o',
		'iconColor'                     => '#155724',

		// Header ( Title )
		'headingText'                   =>'Well done!',
		'headingTextColor'              => '#155724',
		'headingBackgroundColor'        => '#e4f6e8',

		// Body
		'bodyText'                          => 'The <strong>Success</strong> Box is light green, and is meant to convey information to the user of some successful task. The Title, background and all other attributes can be changed in the sidebar settings. This example text is going to run a bit longer so that you can see how spacing within this box works with this kind of content.',
		'bodyTextColor'                     => '#155724',
		'bodyBackgroundColor'               => '#eefff2',

		'learnMoreTextColor'                => '#155724',
		'learnMoreTextHoverColor'           => '#155724',
		'learnMoreBorderColor'              => '#c3e2ca',
		'learnMoreBackgroundColor'          => '#e4f6e8',
		'learnMoreBackgroundHoverColor'     => '#e4f6e8',
	);

	//Warning Box - Light Orange Box
	public static $preset_3 = array(
		'blockType'                     => 'preset',
		'templateId'                    => 3,                  // THIS IS PRESET ID
		// General
		'containerBorderColor'          => '#fbeed5',

		// Icon
		'iconType'                      => 'epbl-exclamation-triangle',
		'iconColor'                     => '#856404',

		// Header ( Title )
		'headingText'                   =>'Important Notice: Please Read!',
		'headingTextColor'              => '#856404',
		'headingBackgroundColor'        => '#f4f0d8',

		// Body
		'bodyText'                          => 'The <strong>Warning</strong> Box is light orange, and is meant to convey information to the user of some warning. The Title, background and all other attributes can be changed in the sidebar settings. This example text is going to run a bit longer so that you can see how spacing within this box works with this kind of content.',
		'bodyTextColor'                     => '#856404',
		'bodyBackgroundColor'               => '#fcf8e3',

		'learnMoreTextColor'                => '#856404',
		'learnMoreTextHoverColor'           => '#856404',
		'learnMoreBorderColor'              => '#e4dfc5',
		'learnMoreBackgroundColor'          => '#f4f0d8',
		'learnMoreBackgroundHoverColor'     => '#f4f0d8',
	);

	//Error Box - Light red Box
	public static $preset_4 = array(
		'blockType'                     => 'preset',
		'templateId'                    => 4,                  // THIS IS PRESET ID

		// General
		'containerBorderColor'          => '#f5c6cb',

		// Icon
		'iconType'                      => 'epbl-exclamation-circle',
		'iconColor'                     => '#721c24',

		// Header ( Title )
		'headingText'                   =>'Critical Warning!',
		'headingTextColor'              => '#721c24',
		'headingBackgroundColor'        => '#ffeaeb',

		// Body
		'bodyText'                          => 'The <strong>Error</strong> Box is light red, and is meant to convey information to the user of some critical issue. The Title, background and all other attributes can be changed in the sidebar settings. This example text is going to run a bit longer so that you can see how spacing within this box works with this kind of content.',
		'bodyTextColor'                     => '#721c24',
		'bodyBackgroundColor'               => '#fff3f4',

		'learnMoreTextColor'                => '#721c24',
		'learnMoreTextHoverColor'           => '#721c24',
		'learnMoreBorderColor'              => '#f5c6cb',
		'learnMoreBackgroundColor'          => '#ffeaeb',
		'learnMoreBackgroundHoverColor'     => '#ffeaeb',
	);

}