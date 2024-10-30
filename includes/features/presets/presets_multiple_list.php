<?php
namespace Echo_Doc_Blocks\Includes\features\presets;

use Echo_Doc_Blocks\Includes\features\frontend\All_Blocks_CSS;

defined( 'ABSPATH' ) || exit();

class Presets_Multiple_list extends Presets {


	public function get_block_defaults() {

		$default_attributes = All_Blocks_CSS::$multiple_lists_defaults;

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
		$all_presets[5] = self::get_preset( 5 );
		$all_presets[6] = self::get_preset( 6 );
		$all_presets[7] = self::get_preset( 7 );
		$all_presets[8] = self::get_preset( 8 );
		$all_presets[9] = self::get_preset( 9 );
		//$all_presets[14] = self::get_preset( 14 );
		return $all_presets;
	}

	public function get_preset( $template_id ) {

		if ( ! Utilities::is_positive_int( $template_id ) ) {
			return self::get_block_defaults();
		}

		$preset = array();
		$preset['block_name'] = 'multiple-list';
		$preset['template_id'] = $template_id;

		switch( $template_id ) {

			// GROUP - BASIC
			case 1:
				$preset['template_name'] = 'List 1 - All bullets';
				$preset['template_description'] = 'Standard Bullet List all Black in color.';
				$preset['attributes'] = self::$preset_1;
				$preset['group'] = 'Basic:::1';
				break;
			case 2:
				$preset['template_name'] = 'List 2 -  Hierarchical numbers with bullets';
				$preset['template_description'] = 'Hierarchical numbers (level 1, level 2) with bullets (level 3 - 5)';
				$preset['attributes'] = self::$preset_2;
				$preset['group'] = 'Basic:::2';
				break;
			case 3:
				$preset['template_name'] = 'List 3 - All hierarchical numbers';
				$preset['template_description'] = 'All hierarchical numbers (3 > 3.1 > 3.1.1 > 3.1.1.1. )';
				$preset['attributes'] = self::$preset_3;
				$preset['group'] = 'Basic:::3';
				break;
			case 4:
				$preset['template_name'] = 'List 4 -  Number + Alpha + Bullets';
				$preset['template_description'] = 'Number (level 1), alpha (level 2), bullets (level 3-5)';
				$preset['attributes'] = self::$preset_4;
				$preset['group'] = 'Basic:::4';
				break;
			case 5:
				$preset['template_name'] = 'List 5 - Numbers + Bullets';
				$preset['template_description'] = 'Number (level 1), bullets (level 2-5)';
				$preset['attributes'] = self::$preset_5;
				$preset['group'] = 'Basic:::5';
				break;

			// GROUP - xxx
			case 6:
				$preset['template_name'] = 'List 6 - Hierarchical numbers + Bullets';
				$preset['template_description'] = 'Hierarchical numbers (3 > 3.1 ) + Bullet lists';
				$preset['attributes'] = self::$preset_6;
				break;
			case 7:
				$preset['template_name'] = 'List 7 - Mixed Types';
				$preset['template_description'] = 'Mixed types ( Number + Bullets + Number + Bullets + Alpha )';
				$preset['attributes'] = self::$preset_7;
				break;
			case 8:
				$preset['template_name'] = 'List 8 - Hierarchical Numbers ( Rounded Borders )';
				$preset['template_description'] = 'Hierarchical Numbers with rounded borders';
				$preset['attributes'] = self::$preset_8;
				break;
			case 9:
				$preset['template_name'] = 'List 9 - Hierarchical Numbers ( Square Borders )';
				$preset['template_description'] = 'Hierarchical Numbers with square borders';
				$preset['attributes'] = self::$preset_9;
				break;
			/*case 14:
				$preset['template_name'] = 'List 14';
				$preset['template_description'] = 'Description';
				$preset['attributes'] = self::$preset_14;
				break;*/

			default:
				$preset['attributes'] = self::get_block_defaults();
		}

		$preset['attributes'] = array_merge(self::get_block_defaults(), $preset['attributes']);

		return $preset;
	}

	public function get_non_template_attribute_names() {
		return array('levelOneStyleTypeTextPrefix' => 'unknown', 'levelTwoStyleTypeTextPrefix' => 'unknown', 'levelThreeStyleTypeTextPrefix' => 'unknown', 'levelFourStyleTypeTextPrefix' => 'unknown',
		             'levelFiveStyleTypeTextPrefix' => 'unknown', 'cssClass' => 'unknown');
	}

	/**
	 *  - all bullets
		- hierarchical numbers (level 1, level 2) with bullets (level 2 - 5)
		- all hierarchical numbers (3.1)
		- number (level 1), alpha (level 2), bullets (level 3-5)
		- HTML number (level 1), bullets (level 2-5)
	 */


	// All bullets
	public static $preset_1 = array(
		'blockType'                                 => 'preset',
		'templateId'                                => 1,                  // THIS IS PRESET ID
	);

	// Hierarchical numbers (level 1, level 2) with bullets (level 3 - 5)
	public static $preset_2 = array(
		'blockType'                                 => 'preset',
		'templateId'                                => 2,                  // THIS IS PRESET ID
		
		// Level 1: List ----------------------------------------------------------/
		// Number / Icon
		'levelOneStyleTypeFontSizeDesktop'          => 16,
		'levelOneStyleTypeFontSizeMobile'           => 16,
		'levelOneStyleTypeFontSizeTablet'           => 16,
		'levelOneStyleType'                         => 'decimal',

		// Level 2: List ----------------------------------------------------------/

		// Number / Icon
		'levelTwoStyleTypeFontSizeDesktop'          => 16,
		'levelTwoStyleTypeFontSizeMobile'           => 16,
		'levelTwoStyleTypeFontSizeTablet'           => 16,
		'levelTwoStyleType'                         => 'inherit',

		// Level 3: List ----------------------------------------------------------/

		// Number / Icon
		'levelThreeStyleTypeFontSizeDesktop'          => 26,
		'levelThreeStyleTypeFontSizeMobile'           => 26,
		'levelThreeStyleTypeFontSizeTablet'           => 26,
		'levelThreeStyleType'                         => 'disc',

		// Level 4: List ----------------------------------------------------------/

		// Number / Icon
		'levelFourStyleTypeFontSizeDesktop'          => 9,
		'levelFourStyleTypeFontSizeMobile'           => 9,
		'levelFourStyleTypeFontSizeTablet'           => 9,
		'levelFourStyleType'                         => 'square',
		'levelFourStyleTypeTopBottomMarginSize'      => 0,

		// Level 5: List ----------------------------------------------------------/

	);

	// All hierarchical numbers (3 > 3.1 > 3.1.1 > 3.1.1.1. )
	public static $preset_3 = array(
		'blockType'                                 => 'preset',
		'templateId'                                => 3,                  // THIS IS PRESET ID
		
		// Level 1: List ----------------------------------------------------------/

		// Number / Icon
		'levelOneStyleTypeFontSizeDesktop'          => 16,
		'levelOneStyleTypeFontSizeMobile'           => 16,
		'levelOneStyleTypeFontSizeTablet'           => 16,
		'levelOneStyleType'                         => 'decimal',

		// Level 2: List ----------------------------------------------------------/

		// Number / Icon
		'levelTwoStyleTypeFontSizeDesktop'          => 16,
		'levelTwoStyleTypeFontSizeMobile'           => 16,
		'levelTwoStyleTypeFontSizeTablet'           => 16,
		'levelTwoStyleType'                         => 'inherit',

		// Level 3: List ----------------------------------------------------------/

		// Number / Icon
		'levelThreeStyleTypeFontSizeDesktop'          => 16,
		'levelThreeStyleTypeFontSizeMobile'           => 16,
		'levelThreeStyleTypeFontSizeTablet'           => 16,
		'levelThreeStyleType'                         => 'inherit',

		// Level 4: List ----------------------------------------------------------/

		// Number / Icon
		'levelFourStyleTypeFontSizeDesktop'          => 16,
		'levelFourStyleTypeFontSizeMobile'           => 16,
		'levelFourStyleTypeFontSizeTablet'           => 16,
		'levelFourStyleType'                         => 'inherit',
		'levelFourStyleTypeTopBottomMarginSize'      => 0,

		// Level 5: List ----------------------------------------------------------/

	);

	// Number (level 1), alpha (level 2), bullets (level 3-5)
	public static $preset_4 = array(
		'blockType'                                 => 'preset',
		'templateId'                                => 4,                  // THIS IS PRESET ID

		// Level 1: List ----------------------------------------------------------/

		// Number / Icon
		'levelOneStyleTypeFontSizeDesktop'          => 16,
		'levelOneStyleTypeFontSizeMobile'           => 16,
		'levelOneStyleTypeFontSizeTablet'           => 16,
		'levelOneStyleType'                         => 'decimal',

		// Level 2: List ----------------------------------------------------------/

		// Number / Icon
		'levelTwoStyleTypeFontSizeDesktop'          => 17,
		'levelTwoStyleTypeFontSizeMobile'           => 17,
		'levelTwoStyleTypeFontSizeTablet'           => 17,
		'levelTwoStyleType'                         => 'lower-alpha',
		'levelTwoStyleTypeTopBottomMarginSize'      => -1,

		// Level 3: List ----------------------------------------------------------/

		// Number / Icon
		'levelThreeStyleTypeFontSizeDesktop'          => 26,
		'levelThreeStyleTypeFontSizeMobile'           => 26,
		'levelThreeStyleTypeFontSizeTablet'           => 26,
		'levelThreeStyleType'                         => 'disc',

		// Level 4: List ----------------------------------------------------------/

		// Number / Icon
		'levelFourStyleTypeFontSizeDesktop'          => 9,
		'levelFourStyleTypeFontSizeMobile'           => 9,
		'levelFourStyleTypeFontSizeTablet'           => 9,
		'levelFourStyleType'                         => 'square',
		'levelFourStyleTypeTopBottomMarginSize'      => -1,

		// Level 5: List ----------------------------------------------------------/

	);

	// HTML number (level 1), bullets (level 2-5)
	public static $preset_5 = array(
		'blockType'                                 => 'preset',
		'templateId'                                => 5,                  // THIS IS PRESET ID
		
		// Level 1: List ----------------------------------------------------------/

		// Number / Icon
		'levelOneStyleTypeFontSizeDesktop'          => 16,
		'levelOneStyleTypeFontSizeMobile'           => 16,
		'levelOneStyleTypeFontSizeTablet'           => 16,
		'levelOneStyleType'                         => 'decimal',

		// Level 2: List ----------------------------------------------------------/

		// Number / Icon
		'levelTwoStyleTypeFontSizeDesktop'          => 26,
		'levelTwoStyleTypeFontSizeMobile'           => 26,
		'levelTwoStyleTypeFontSizeTablet'           => 26,
		'levelTwoStyleType'                         => 'disc',
		'levelTwoStyleTypeTopBottomMarginSize'      => -1,

		// Level 3: List ----------------------------------------------------------/

		// Number / Icon
		'levelThreeStyleTypeFontSizeDesktop'          => 9,
		'levelThreeStyleTypeFontSizeMobile'           => 9,
		'levelThreeStyleTypeFontSizeTablet'           => 9,
		'levelThreeStyleType'                         => 'square',

		// Level 4: List ----------------------------------------------------------/

		// Number / Icon
		'levelFourStyleTypeFontSizeDesktop'          => 29,
		'levelFourStyleTypeFontSizeMobile'           => 29,
		'levelFourStyleTypeFontSizeTablet'           => 29,
		'levelFourStyleType'                         => 'circle',
		'levelFourStyleTypeTopBottomMarginSize'      => -1,

		// Level 5: List ----------------------------------------------------------/

	);





	//Inherited Number list
	public static $preset_6 = array(
		'blockType'                                 => 'preset',
		'templateId'                                => 6,                  // THIS IS PRESET ID
		
		// Level 1: List ----------------------------------------------------------/

		// Ol
		'levelOneOLPaddingType'                     => 'px',
		'levelOneOLPaddingSize'                     => 1,
		'levelOneOLMarginType'                      => 'px',
		'levelOneOLMarginSize'                      => 1,
		'levelOneOLBackgroundColor'                 => '#FFFFFF',

		// Li
		'levelOneLITextColor'                       => '#666666',
		'levelOneLIBackgroundColor'                 => '#FFFFFF',
		'levelOneLIFontSizeType'                    => 'px',
		'levelOneLIFontSizeDesktop'                 => 16,
		'levelOneLIFontSizeMobile'                  => 16,
		'levelOneLIFontSizeTablet'                  => 16,
		'levelOneLILineHeightType'                  => 'em',
		'levelOneLILineHeightSize'                  => 2,
		'levelOneLITopBottomPaddingType'            => 'px',
		'levelOneLITopBottomPaddingSize'            => 1,
		'levelOneLILeftRightPaddingType'            => 'px',
		'levelOneLILeftRightPaddingSize'            => 1,
		'levelOneLILeftPaddingSize'                 => 1,
		'levelOneLIRightPaddingSize'                => 1,
		'levelOneLITopBottomMarginType'             => 'px',
		'levelOneLITopBottomMarginSize'             => 1,
		'levelOneLILeftRightMarginType'             => 'px',
		'levelOneLILeftRightMarginSize'             => 20,
		'levelOneLIBorderThicknessLeft'             => 0,
		'levelOneLIBorderThicknessRight'            => 0,
		'levelOneLIBorderThicknessUp'               => 0,
		'levelOneLIBorderThicknessDown'             => 0,
		'levelOneLIBorderRadius'                    => 0,
		'levelOneLIBorderColor'                     => '#6C656D',

		// Number / Icon
		'levelOneStyleTypeFontSizeType'             => 'em',
		'levelOneStyleTypeFontSizeDesktop'          => 1.2,
		'levelOneStyleTypeFontSizeMobile'           => 1.2,
		'levelOneStyleTypeFontSizeTablet'           => 1.2,
		'levelOneStyleTypeTextPrefix'               => '',
		'levelOneStyleType'                         => 'decimal',
		'levelOneStyleTypeTopBottomPaddingType'     => 'px',
		'levelOneStyleTypeTopBottomPaddingSize'     => 0,
		'levelOneStyleTypeLeftRightPaddingType'     => 'px',
		'levelOneStyleTypeLeftRightPaddingSize'     => 0,
		'levelOneStyleTypeTopBottomMarginType'      => 'px',
		'levelOneStyleTypeTopBottomMarginSize'      => 1,
		'levelOneStyleTypeLeftMarginType'           => 'px',
		'levelOneStyleTypeLeftMarginSize'           => -15,
		'levelOneStyleTypeRightMarginType'          => 'px',
		'levelOneStyleTypeRightMarginSize'          => 6,
		'levelOneStyleTypeTextColor'                => '#07b0f0',
		'levelOneStyleTypeBackgroundColor'          => '#ffffff',
		'levelOneStyleTypeBorderRadius'             => 0,
		'levelOneStyleTypeBorderThickness'          => 0,
		'levelOneStyleTypeBorderColor'              => '#6C656D',

		// Level 2: List ----------------------------------------------------------/

		// Ol
		'levelTwoOLPaddingType'                     => 'px',
		'levelTwoOLPaddingSize'                     => 1,
		'levelTwoOLMarginType'                      => 'px',
		'levelTwoOLMarginSize'                      => 1,
		'levelTwoOLBackgroundColor'                 => '#FFFFFF',

		// Li
		'levelTwoLITextColor'                       => '#666666',
		'levelTwoLIBackgroundColor'                 => '#FFFFFF',
		'levelTwoLIFontSizeType'                    => 'px',
		'levelTwoLIFontSizeDesktop'                 => 16,
		'levelTwoLIFontSizeMobile'                  => 16,
		'levelTwoLIFontSizeTablet'                  => 16,
		'levelTwoLILineHeightType'                  => 'em',
		'levelTwoLILineHeightSize'                  => 2,
		'levelTwoLITopBottomPaddingType'            => 'px',
		'levelTwoLITopBottomPaddingSize'            => 1,
		'levelTwoLILeftRightPaddingType'            => 'px',
		'levelTwoLILeftPaddingSize'                 => 60,
		'levelTwoLIRightPaddingSize'                => 0,
		'levelTwoLITopBottomMarginType'             => 'px',
		'levelTwoLITopBottomMarginSize'             => 1,
		'levelTwoLILeftRightMarginType'             => 'px',
		'levelTwoLILeftRightMarginSize'             => 6,
		'levelTwoLIBorderThicknessLeft'             => 0,
		'levelTwoLIBorderThicknessRight'            => 0,
		'levelTwoLIBorderThicknessUp'               => 0,
		'levelTwoLIBorderThicknessDown'             => 0,
		'levelTwoLIBorderRadius'                    => 0,
		'levelTwoLIBorderColor'                     => '#6C656D',

		// Number / Icon
		'levelTwoStyleTypeFontSizeType'             => 'em',
		'levelTwoStyleTypeFontSizeDesktop'          => 1.2,
		'levelTwoStyleTypeFontSizeMobile'           => 1.2,
		'levelTwoStyleTypeFontSizeTablet'           => 1.2,
		'levelTwoStyleTypeTextPrefix'               => '',
		'levelTwoStyleType'                         => 'inherit',
		'levelTwoStyleTypeTopBottomPaddingType'     => 'px',
		'levelTwoStyleTypeTopBottomPaddingSize'     => 0,
		'levelTwoStyleTypeLeftRightPaddingType'     => 'px',
		'levelTwoStyleTypeLeftRightPaddingSize'     => 0,
		'levelTwoStyleTypeTopBottomMarginType'      => 'px',
		'levelTwoStyleTypeTopBottomMarginSize'      => 1,
		'levelTwoStyleTypeLeftMarginType'           => 'px',
		'levelTwoStyleTypeLeftMarginSize'           => -15,
		'levelTwoStyleTypeRightMarginType'          => 'px',
		'levelTwoStyleTypeRightMarginSize'          => 6,
		'levelTwoStyleTypeTextColor'                => '#07b0f0',
		'levelTwoStyleTypeBackgroundColor'          => '#ffffff',
		'levelTwoStyleTypeBorderRadius'             => 0,
		'levelTwoStyleTypeBorderThickness'          => 0,
		'levelTwoStyleTypeBorderColor'              => '#FFFFFF',

		// Level 3: List ----------------------------------------------------------/

		// Ol
		'levelThreeOLPaddingType'                     => 'px',
		'levelThreeOLPaddingSize'                     => 1,
		'levelThreeOLMarginType'                      => 'px',
		'levelThreeOLMarginSize'                      => 1,
		'levelThreeOLBackgroundColor'                 => '#FFFFFF',

		// Li
		'levelThreeLITextColor'                       => '#666666',
		'levelThreeLIBackgroundColor'                 => '#FFFFFF',
		'levelThreeLIFontSizeType'                    => 'px',
		'levelThreeLIFontSizeDesktop'                 => 16,
		'levelThreeLIFontSizeMobile'                  => 16,
		'levelThreeLIFontSizeTablet'                  => 16,
		'levelThreeLILineHeightType'                  => 'em',
		'levelThreeLILineHeightSize'                  => 2,
		'levelThreeLITopBottomPaddingType'            => 'px',
		'levelThreeLITopBottomPaddingSize'            => 1,
		'levelThreeLILeftRightPaddingType'            => 'px',
		'levelThreeLILeftPaddingSize'                 => 60,
		'levelThreeLIRightPaddingSize'                => 1,
		'levelThreeLITopBottomMarginType'             => 'px',
		'levelThreeLITopBottomMarginSize'             => 1,
		'levelThreeLILeftRightMarginType'             => 'px',
		'levelThreeLILeftRightMarginSize'             => 1,
		'levelThreeLIBorderThicknessLeft'             => 0,
		'levelThreeLIBorderThicknessRight'            => 0,
		'levelThreeLIBorderThicknessUp'               => 0,
		'levelThreeLIBorderThicknessDown'             => 0,
		'levelThreeLIBorderRadius'                    => 0,
		'levelThreeLIBorderColor'                     => '#6C656D',

		// Number / Icon
		'levelThreeStyleTypeFontSizeType'             => 'em',
		'levelThreeStyleTypeFontSizeDesktop'          => 1.2,
		'levelThreeStyleTypeFontSizeMobile'           => 1.2,
		'levelThreeStyleTypeFontSizeTablet'           => 1.2,
		'levelThreeStyleTypeTextPrefix'               => '',
		'levelThreeStyleType'                         => 'disc',
		'levelThreeStyleTypeTopBottomPaddingType'     => 'px',
		'levelThreeStyleTypeTopBottomPaddingSize'     => 0,
		'levelThreeStyleTypeLeftRightPaddingType'     => 'px',
		'levelThreeStyleTypeLeftRightPaddingSize'     => 0,
		'levelThreeStyleTypeTopBottomMarginType'      => 'px',
		'levelThreeStyleTypeTopBottomMarginSize'      => 1,
		'levelThreeStyleTypeLeftMarginType'           => 'px',
		'levelThreeStyleTypeLeftMarginSize'           => -15,
		'levelThreeStyleTypeRightMarginType'          => 'px',
		'levelThreeStyleTypeRightMarginSize'          => 6,
		'levelThreeStyleTypeTextColor'                => '#07b0f0',
		'levelThreeStyleTypeBackgroundColor'          => '#ffffff',
		'levelThreeStyleTypeBorderRadius'             => 0,
		'levelThreeStyleTypeBorderThickness'          => 0,
		'levelThreeStyleTypeBorderColor'              => '#6C656D',

		// Level 4: List ----------------------------------------------------------/

		// Ol
		'levelFourOLPaddingType'                     => 'px',
		'levelFourOLPaddingSize'                     => 1,
		'levelFourOLMarginType'                      => 'px',
		'levelFourOLMarginSize'                      => 1,
		'levelFourOLBackgroundColor'                 => '#FFFFFF',

		// Li
		'levelFourLITextColor'                       => '#000000',
		'levelFourLIBackgroundColor'                 => '#FFFFFF',
		'levelFourLIFontSizeType'                    => 'px',
		'levelFourLIFontSizeDesktop'                 => 16,
		'levelFourLIFontSizeMobile'                  => 16,
		'levelFourLIFontSizeTablet'                  => 16,
		'levelFourLILineHeightType'                  => 'em',
		'levelFourLILineHeightSize'                  => 2,
		'levelFourLITopBottomPaddingType'            => 'px',
		'levelFourLITopBottomPaddingSize'            => 1,
		'levelFourLILeftRightPaddingType'            => 'px',
		'levelFourLILeftPaddingSize'                 => 60,
		'levelFourLIRightPaddingSize'                => 0,
		'levelFourLITopBottomMarginType'             => 'px',
		'levelFourLITopBottomMarginSize'             => 1,
		'levelFourLILeftRightMarginType'             => 'px',
		'levelFourLILeftRightMarginSize'             => 6,
		'levelFourLIBorderThicknessLeft'             => 0,
		'levelFourLIBorderThicknessRight'            => 0,
		'levelFourLIBorderThicknessUp'               => 0,
		'levelFourLIBorderThicknessDown'             => 0,
		'levelFourLIBorderRadius'                    => 0,
		'levelFourLIBorderColor'                     => '#6C656D',

		// Number / Icon
		'levelFourStyleTypeFontSizeType'             => 'em',
		'levelFourStyleTypeFontSizeDesktop'          => 0.5,
		'levelFourStyleTypeFontSizeMobile'           => 0.5,
		'levelFourStyleTypeFontSizeTablet'           => 0.5,
		'levelFourStyleTypeTextPrefix'               => '',
		'levelFourStyleType'                         => 'square',
		'levelFourStyleTypeTopBottomPaddingType'     => 'px',
		'levelFourStyleTypeTopBottomPaddingSize'     => 0,
		'levelFourStyleTypeLeftRightPaddingType'     => 'px',
		'levelFourStyleTypeLeftRightPaddingSize'     => 0,
		'levelFourStyleTypeTopBottomMarginType'      => 'px',
		'levelFourStyleTypeTopBottomMarginSize'      => 1,
		'levelFourStyleTypeLeftMarginType'           => 'px',
		'levelFourStyleTypeLeftMarginSize'           => -15,
		'levelFourStyleTypeRightMarginType'          => 'px',
		'levelFourStyleTypeRightMarginSize'          => 6,
		'levelFourStyleTypeTextColor'                => '#07b0f0',
		'levelFourStyleTypeBackgroundColor'          => '#ffffff',
		'levelFourStyleTypeBorderRadius'             => 0,
		'levelFourStyleTypeBorderThickness'          => 0,
		'levelFourStyleTypeBorderColor'              => '#6C656D',

		// Level 5: List ----------------------------------------------------------/

		// Ol
		'levelFiveOLPaddingType'                     => 'px',
		'levelFiveOLPaddingSize'                     => 1,
		'levelFiveOLMarginType'                      => 'px',
		'levelFiveOLMarginSize'                      => 1,
		'levelFiveOLBackgroundColor'                 => '#FFFFFF',

		// Li
		'levelFiveLITextColor'                       => '#000000',
		'levelFiveLIBackgroundColor'                 => '#FFFFFF',
		'levelFiveLIFontSizeType'                    => 'px',
		'levelFiveLIFontSizeDesktop'                 => 16,
		'levelFiveLIFontSizeMobile'                  => 16,
		'levelFiveLIFontSizeTablet'                  => 16,
		'levelFiveLILineHeightType'                  => 'em',
		'levelFiveLILineHeightSize'                  => 2,
		'levelFiveLITopBottomPaddingType'            => 'px',
		'levelFiveLITopBottomPaddingSize'            => 1,
		'levelFiveLILeftRightPaddingType'            => 'px',
		'levelFiveLILeftPaddingSize'                 => 60,
		'levelFiveLIRightPaddingSize'                => 0,
		'levelFiveLITopBottomMarginType'             => 'px',
		'levelFiveLITopBottomMarginSize'             => 1,
		'levelFiveLILeftRightMarginType'             => 'px',
		'levelFiveLILeftRightMarginSize'             => 1,
		'levelFiveLIBorderThicknessLeft'             => 0,
		'levelFiveLIBorderThicknessRight'            => 0,
		'levelFiveLIBorderThicknessUp'               => 0,
		'levelFiveLIBorderThicknessDown'             => 0,
		'levelFiveLIBorderRadius'                    => 0,
		'levelFiveLIBorderColor'                     => '#6C656D',

		// Number / Icon
		'levelFiveStyleTypeFontSizeType'             => 'em',
		'levelFiveStyleTypeFontSizeDesktop'          => 1.5,
		'levelFiveStyleTypeFontSizeMobile'           => 1.5,
		'levelFiveStyleTypeFontSizeTablet'           => 1.5,
		'levelFiveStyleTypeTextPrefix'               => '',
		'levelFiveStyleType'                         => 'circle',
		'levelFiveStyleTypeTopBottomPaddingType'     => 'px',
		'levelFiveStyleTypeTopBottomPaddingSize'     => 0,
		'levelFiveStyleTypeLeftRightPaddingType'     => 'px',
		'levelFiveStyleTypeLeftRightPaddingSize'     => 5,
		'levelFiveStyleTypeTopBottomMarginType'      => 'px',
		'levelFiveStyleTypeTopBottomMarginSize'      => -1,
		'levelFiveStyleTypeLeftMarginType'           => 'px',
		'levelFiveStyleTypeLeftMarginSize'           => -15,
		'levelFiveStyleTypeRightMarginType'          => 'px',
		'levelFiveStyleTypeRightMarginSize'          => 6,
		'levelFiveStyleTypeTextColor'                => '#07b0f0',
		'levelFiveStyleTypeBackgroundColor'          => '#ffffff',
		'levelFiveStyleTypeBorderRadius'             => 30,
		'levelFiveStyleTypeBorderThickness'          => 0,
		'levelFiveStyleTypeBorderColor'              => '#6C656D',
	);

	//Standard List
	public static $preset_7 = array(
			'blockType'                     => 'preset',
			'templateId'                    => 7,                  // THIS IS PRESET ID
		// Level 1: List ----------------------------------------------------------/

		// Ol
		'levelOneOLPaddingType'                     => 'px',
		'levelOneOLPaddingSize'                     => 1,
		'levelOneOLMarginType'                      => 'px',
		'levelOneOLMarginSize'                      => 1,
		'levelOneOLBackgroundColor'                 => '#FFFFFF',

		// Li
		'levelOneLITextColor'                       => '#000000',
		'levelOneLIBackgroundColor'                 => '#FFFFFF',
		'levelOneLIFontSizeType'                    => 'px',
		'levelOneLIFontSizeDesktop'                 => 16,
		'levelOneLIFontSizeMobile'                  => 16,
		'levelOneLIFontSizeTablet'                  => 16,
		'levelOneLILineHeightType'                  => 'em',
		'levelOneLILineHeightSize'                  => 2,
		'levelOneLITopBottomPaddingType'            => 'px',
		'levelOneLITopBottomPaddingSize'            => 1,
		'levelOneLILeftRightPaddingType'            => 'px',
		'levelOneLILeftRightPaddingSize'            => 1,
		'levelOneLILeftPaddingSize'                 => 1,
		'levelOneLIRightPaddingSize'                => 1,
		'levelOneLITopBottomMarginType'             => 'px',
		'levelOneLITopBottomMarginSize'             => 1,
		'levelOneLILeftRightMarginType'             => 'px',
		'levelOneLILeftRightMarginSize'             => 20,
		'levelOneLIBorderThicknessLeft'             => 0,
		'levelOneLIBorderThicknessRight'            => 0,
		'levelOneLIBorderThicknessUp'               => 0,
		'levelOneLIBorderThicknessDown'             => 0,
		'levelOneLIBorderRadius'                    => 0,
		'levelOneLIBorderColor'                     => '#6C656D',

		// Number / Icon
		'levelOneStyleTypeFontSizeType'             => 'em',
		'levelOneStyleTypeFontSizeDesktop'          => 1.2,
		'levelOneStyleTypeFontSizeMobile'           => 1.2,
		'levelOneStyleTypeFontSizeTablet'           => 1.2,
		'levelOneStyleTypeTextPrefix'               => '',
		'levelOneStyleType'                         => 'decimal',
		'levelOneStyleTypeTopBottomPaddingType'     => 'px',
		'levelOneStyleTypeTopBottomPaddingSize'     => 1,
		'levelOneStyleTypeLeftRightPaddingType'     => 'px',
		'levelOneStyleTypeLeftRightPaddingSize'     => 1,
		'levelOneStyleTypeTopBottomMarginType'      => 'px',
		'levelOneStyleTypeTopBottomMarginSize'      => 1,
		'levelOneStyleTypeLeftMarginType'           => 'px',
		'levelOneStyleTypeLeftMarginSize'           => -18,
		'levelOneStyleTypeRightMarginType'          => 'px',
		'levelOneStyleTypeRightMarginSize'          => 6,
		'levelOneStyleTypeTextColor'                => '#0077be',
		'levelOneStyleTypeBackgroundColor'          => '#FFFFFF',
		'levelOneStyleTypeBorderRadius'             => 0,
		'levelOneStyleTypeBorderThickness'          => 0,
		'levelOneStyleTypeBorderColor'              => '#6C656D',

		// Level 2: List ----------------------------------------------------------/

		// Ol
		'levelTwoOLPaddingType'                     => 'px',
		'levelTwoOLPaddingSize'                     => 1,
		'levelTwoOLMarginType'                      => 'px',
		'levelTwoOLMarginSize'                      => 1,
		'levelTwoOLBackgroundColor'                 => '#FFFFFF',

		// Li
		'levelTwoLITextColor'                       => '#5a5a5a',
		'levelTwoLIBackgroundColor'                 => '#FFFFFF',
		'levelTwoLIFontSizeType'                    => 'px',
		'levelTwoLIFontSizeDesktop'                 => 16,
		'levelTwoLIFontSizeMobile'                  => 16,
		'levelTwoLIFontSizeTablet'                  => 16,
		'levelTwoLILineHeightType'                  => 'em',
		'levelTwoLILineHeightSize'                  => 2,
		'levelTwoLITopBottomPaddingType'            => 'px',
		'levelTwoLITopBottomPaddingSize'            => 1,
		'levelTwoLILeftRightPaddingType'            => 'px',
		'levelTwoLILeftPaddingSize'                 => 60,
		'levelTwoLIRightPaddingSize'                => 0,
		'levelTwoLITopBottomMarginType'             => 'px',
		'levelTwoLITopBottomMarginSize'             => 1,
		'levelTwoLILeftRightMarginType'             => 'px',
		'levelTwoLILeftRightMarginSize'             => 6,
		'levelTwoLIBorderThicknessLeft'             => 0,
		'levelTwoLIBorderThicknessRight'            => 0,
		'levelTwoLIBorderThicknessUp'               => 0,
		'levelTwoLIBorderThicknessDown'             => 0,
		'levelTwoLIBorderRadius'                    => 0,
		'levelTwoLIBorderColor'                     => '#6C656D',

		// Number / Icon
		'levelTwoStyleTypeFontSizeType'             => 'em',
		'levelTwoStyleTypeFontSizeDesktop'          => 1.2,
		'levelTwoStyleTypeFontSizeMobile'           => 1.2,
		'levelTwoStyleTypeFontSizeTablet'           => 1.2,
		'levelTwoStyleTypeTextPrefix'               => '',
		'levelTwoStyleType'                         => 'disc',
		'levelTwoStyleTypeTopBottomPaddingType'     => 'px',
		'levelTwoStyleTypeTopBottomPaddingSize'     => 1,
		'levelTwoStyleTypeLeftRightPaddingType'     => 'px',
		'levelTwoStyleTypeLeftRightPaddingSize'     => 1,
		'levelTwoStyleTypeTopBottomMarginType'      => 'px',
		'levelTwoStyleTypeTopBottomMarginSize'      => 1,
		'levelTwoStyleTypeLeftMarginType'           => 'px',
		'levelTwoStyleTypeLeftMarginSize'           => -18,
		'levelTwoStyleTypeRightMarginType'          => 'px',
		'levelTwoStyleTypeRightMarginSize'          => 6,
		'levelTwoStyleTypeTextColor'                => '#d44950',
		'levelTwoStyleTypeBackgroundColor'          => '#FFFFFF',
		'levelTwoStyleTypeBorderRadius'             => 0,
		'levelTwoStyleTypeBorderThickness'          => 0,
		'levelTwoStyleTypeBorderColor'              => '#FFFFFF',

		// Level 3: List ----------------------------------------------------------/

		// Ol
		'levelThreeOLPaddingType'                     => 'px',
		'levelThreeOLPaddingSize'                     => 1,
		'levelThreeOLMarginType'                      => 'px',
		'levelThreeOLMarginSize'                      => 1,
		'levelThreeOLBackgroundColor'                 => '#FFFFFF',

		// Li
		'levelThreeLITextColor'                       => '#666666',
		'levelThreeLIBackgroundColor'                 => '#FFFFFF',
		'levelThreeLIFontSizeType'                    => 'px',
		'levelThreeLIFontSizeDesktop'                 => 16,
		'levelThreeLIFontSizeMobile'                  => 16,
		'levelThreeLIFontSizeTablet'                  => 16,
		'levelThreeLILineHeightType'                  => 'em',
		'levelThreeLILineHeightSize'                  => 2,
		'levelThreeLITopBottomPaddingType'            => 'px',
		'levelThreeLITopBottomPaddingSize'            => 1,
		'levelThreeLILeftRightPaddingType'            => 'px',
		'levelThreeLILeftPaddingSize'                 => 60,
		'levelThreeLIRightPaddingSize'                => 1,
		'levelThreeLITopBottomMarginType'             => 'px',
		'levelThreeLITopBottomMarginSize'             => 1,
		'levelThreeLILeftRightMarginType'             => 'px',
		'levelThreeLILeftRightMarginSize'             => 6,
		'levelThreeLIBorderThicknessLeft'             => 0,
		'levelThreeLIBorderThicknessRight'            => 0,
		'levelThreeLIBorderThicknessUp'               => 0,
		'levelThreeLIBorderThicknessDown'             => 0,
		'levelThreeLIBorderRadius'                    => 0,
		'levelThreeLIBorderColor'                     => '#6C656D',

		// Number / Icon
		'levelThreeStyleTypeFontSizeType'             => 'em',
		'levelThreeStyleTypeFontSizeDesktop'          => 1.2,
		'levelThreeStyleTypeFontSizeMobile'           => 1.2,
		'levelThreeStyleTypeFontSizeTablet'           => 1.2,
		'levelThreeStyleTypeTextPrefix'               => '',
		'levelThreeStyleType'                         => 'decimal',
		'levelThreeStyleTypeTopBottomPaddingType'     => 'px',
		'levelThreeStyleTypeTopBottomPaddingSize'     => 1,
		'levelThreeStyleTypeLeftRightPaddingType'     => 'px',
		'levelThreeStyleTypeLeftRightPaddingSize'     => 1,
		'levelThreeStyleTypeTopBottomMarginType'      => 'px',
		'levelThreeStyleTypeTopBottomMarginSize'      => 1,
		'levelThreeStyleTypeLeftMarginType'           => 'px',
		'levelThreeStyleTypeLeftMarginSize'           => -18,
		'levelThreeStyleTypeRightMarginType'          => 'px',
		'levelThreeStyleTypeRightMarginSize'          => 6,
		'levelThreeStyleTypeTextColor'                => '#3ce462',
		'levelThreeStyleTypeBackgroundColor'          => '#FFFFFF',
		'levelThreeStyleTypeBorderRadius'             => 0,
		'levelThreeStyleTypeBorderThickness'          => 0,
		'levelThreeStyleTypeBorderColor'              => '#6C656D',

		// Level 4: List ----------------------------------------------------------/

		// Ol
		'levelFourOLPaddingType'                     => 'px',
		'levelFourOLPaddingSize'                     => 1,
		'levelFourOLMarginType'                      => 'px',
		'levelFourOLMarginSize'                      => 1,
		'levelFourOLBackgroundColor'                 => '#FFFFFF',

		// Li
		'levelFourLITextColor'                       => '#000000',
		'levelFourLIBackgroundColor'                 => '#FFFFFF',
		'levelFourLIFontSizeType'                    => 'px',
		'levelFourLIFontSizeDesktop'                 => 16,
		'levelFourLIFontSizeMobile'                  => 16,
		'levelFourLIFontSizeTablet'                  => 16,
		'levelFourLILineHeightType'                  => 'em',
		'levelFourLILineHeightSize'                  => 2,
		'levelFourLITopBottomPaddingType'            => 'px',
		'levelFourLITopBottomPaddingSize'            => 1,
		'levelFourLILeftRightPaddingType'            => 'px',
		'levelFourLILeftPaddingSize'                 => 60,
		'levelFourLIRightPaddingSize'                => 0,
		'levelFourLITopBottomMarginType'             => 'px',
		'levelFourLITopBottomMarginSize'             => 1,
		'levelFourLILeftRightMarginType'             => 'px',
		'levelFourLILeftRightMarginSize'             => 6,
		'levelFourLIBorderThicknessLeft'             => 0,
		'levelFourLIBorderThicknessRight'            => 0,
		'levelFourLIBorderThicknessUp'               => 0,
		'levelFourLIBorderThicknessDown'             => 0,
		'levelFourLIBorderRadius'                    => 0,
		'levelFourLIBorderColor'                     => '#6C656D',

		// Number / Icon
		'levelFourStyleTypeFontSizeType'             => 'em',
		'levelFourStyleTypeFontSizeDesktop'          => 0.5,
		'levelFourStyleTypeFontSizeMobile'           => 0.5,
		'levelFourStyleTypeFontSizeTablet'           => 0.5,
		'levelFourStyleTypeTextPrefix'               => '',
		'levelFourStyleType'                         => 'square',
		'levelFourStyleTypeTopBottomPaddingType'     => 'px',
		'levelFourStyleTypeTopBottomPaddingSize'     => 1,
		'levelFourStyleTypeLeftRightPaddingType'     => 'px',
		'levelFourStyleTypeLeftPaddingSize'          => 0,
		'levelFourStyleTypeRightPaddingSize'         => 1,
		'levelFourStyleTypeTopBottomMarginType'      => 'px',
		'levelFourStyleTypeTopBottomMarginSize'      => 1,
		'levelFourStyleTypeLeftMarginType'           => 'px',
		'levelFourStyleTypeLeftMarginSize'           => -18,
		'levelFourStyleTypeRightMarginType'          => 'px',
		'levelFourStyleTypeRightMarginSize'          => 6,
		'levelFourStyleTypeTextColor'                => '#81c992',
		'levelFourStyleTypeBackgroundColor'          => '#FFFFFF',
		'levelFourStyleTypeBorderRadius'             => 0,
		'levelFourStyleTypeBorderThickness'          => 0,
		'levelFourStyleTypeBorderColor'              => '#6C656D',

		// Level 5: List ----------------------------------------------------------/

		// Ol
		'levelFiveOLPaddingType'                     => 'px',
		'levelFiveOLPaddingSize'                     => 1,
		'levelFiveOLMarginType'                      => 'px',
		'levelFiveOLMarginSize'                      => 1,
		'levelFiveOLBackgroundColor'                 => '#FFFFFF',

		// Li
		'levelFiveLITextColor'                       => '#000000',
		'levelFiveLIBackgroundColor'                 => '#FFFFFF',
		'levelFiveLIFontSizeType'                    => 'px',
		'levelFiveLIFontSizeDesktop'                 => 16,
		'levelFiveLIFontSizeMobile'                  => 16,
		'levelFiveLIFontSizeTablet'                  => 16,
		'levelFiveLILineHeightType'                  => 'em',
		'levelFiveLILineHeightSize'                  => 2,
		'levelFiveLITopBottomPaddingType'            => 'px',
		'levelFiveLITopBottomPaddingSize'            => 1,
		'levelFiveLILeftRightPaddingType'            => 'px',
		'levelFiveLILeftPaddingSize'                 => 60,
		'levelFiveLIRightPaddingSize'                => 0,
		'levelFiveLITopBottomMarginType'             => 'px',
		'levelFiveLITopBottomMarginSize'             => 1,
		'levelFiveLILeftRightMarginType'             => 'px',
		'levelFiveLILeftRightMarginSize'             => 1,
		'levelFiveLIBorderThicknessLeft'             => 0,
		'levelFiveLIBorderThicknessRight'            => 0,
		'levelFiveLIBorderThicknessUp'               => 0,
		'levelFiveLIBorderThicknessDown'             => 0,
		'levelFiveLIBorderRadius'                    => 0,
		'levelFiveLIBorderColor'                     => '#6C656D',

		// Number / Icon
		'levelFiveStyleTypeFontSizeType'             => 'em',
		'levelFiveStyleTypeFontSizeDesktop'          => 1,
		'levelFiveStyleTypeFontSizeMobile'           => 1,
		'levelFiveStyleTypeFontSizeTablet'           => 1,
		'levelFiveStyleTypeTextPrefix'               => '',
		'levelFiveStyleType'                         => 'lower-alpha',
		'levelFiveStyleTypeTopBottomPaddingType'     => 'px',
		'levelFiveStyleTypeTopBottomPaddingSize'     => 0,
		'levelFiveStyleTypeLeftRightPaddingType'     => 'px',
		'levelFiveStyleTypeLeftRightPaddingSize'     => 1,
		'levelFiveStyleTypeTopBottomMarginType'      => 'px',
		'levelFiveStyleTypeTopBottomMarginSize'      => -1,
		'levelFiveStyleTypeLeftMarginType'           => 'px',
		'levelFiveStyleTypeLeftMarginSize'           => -18,
		'levelFiveStyleTypeRightMarginType'          => 'px',
		'levelFiveStyleTypeRightMarginSize'          => 6,
		'levelFiveStyleTypeTextColor'                => '#2fa6d5',
		'levelFiveStyleTypeBackgroundColor'          => '#FFFFFF',
		'levelFiveStyleTypeBorderRadius'             => 0,
		'levelFiveStyleTypeBorderThickness'          => 0,
		'levelFiveStyleTypeBorderColor'              => '#6C656D',
		);

	//Inherited Number list
	public static $preset_8 = array(
		'blockType'                                 => 'preset',
		'templateId'                                => 8,                  // THIS IS PRESET ID
		// Level 1: List ----------------------------------------------------------/

		// Ol
		'levelOneOLPaddingType'                     => 'px',
		'levelOneOLPaddingSize'                     => 1,
		'levelOneOLMarginType'                      => 'px',
		'levelOneOLMarginSize'                      => 1,
		'levelOneOLBackgroundColor'                 => '#FFFFFF',

		// Li
		'levelOneLITextColor'                       => '#000000',
		'levelOneLIBackgroundColor'                 => '#FFFFFF',
		'levelOneLIFontSizeType'                    => 'px',
		'levelOneLIFontSizeDesktop'                 => 16,
		'levelOneLIFontSizeMobile'                  => 16,
		'levelOneLIFontSizeTablet'                  => 16,
		'levelOneLILineHeightType'                  => 'em',
		'levelOneLILineHeightSize'                  => 2,
		'levelOneLITopBottomPaddingType'            => 'px',
		'levelOneLITopBottomPaddingSize'            => 1,
		'levelOneLILeftRightPaddingType'            => 'px',
		'levelOneLILeftRightPaddingSize'            => 1,
		'levelOneLILeftPaddingSize'                 => 1,
		'levelOneLIRightPaddingSize'                => 1,
		'levelOneLITopBottomMarginType'             => 'px',
		'levelOneLITopBottomMarginSize'             => 4,
		'levelOneLILeftRightMarginType'             => 'px',
		'levelOneLILeftRightMarginSize'             => 20,
		'levelOneLIBorderThicknessLeft'             => 0,
		'levelOneLIBorderThicknessRight'            => 0,
		'levelOneLIBorderThicknessUp'               => 0,
		'levelOneLIBorderThicknessDown'             => 0,
		'levelOneLIBorderRadius'                    => 0,
		'levelOneLIBorderColor'                     => '#6C656D',

		// Number / Icon
		'levelOneStyleTypeFontSizeType'             => 'em',
		'levelOneStyleTypeFontSizeDesktop'          => 1,
		'levelOneStyleTypeFontSizeMobile'           => 1,
		'levelOneStyleTypeFontSizeTablet'           => 1,
		'levelOneStyleTypeTextPrefix'               => '',
		'levelOneStyleType'                         => 'decimal',
		'levelOneStyleTypeTopBottomPaddingType'     => 'px',
		'levelOneStyleTypeTopBottomPaddingSize'     => 0,
		'levelOneStyleTypeLeftRightPaddingType'     => 'px',
		'levelOneStyleTypeLeftRightPaddingSize'     => 11,
		'levelOneStyleTypeTopBottomMarginType'      => 'px',
		'levelOneStyleTypeTopBottomMarginSize'      => 1,
		'levelOneStyleTypeLeftMarginType'           => 'px',
		'levelOneStyleTypeLeftMarginSize'           => -36,
		'levelOneStyleTypeRightMarginType'          => 'px',
		'levelOneStyleTypeRightMarginSize'          => 6,
		'levelOneStyleTypeTextColor'                => '#ffffff',
		'levelOneStyleTypeBackgroundColor'          => '#5cacff',
		'levelOneStyleTypeBorderRadius'             => 30,
		'levelOneStyleTypeBorderThickness'          => 0,
		'levelOneStyleTypeBorderColor'              => '#6C656D',

		// Level 2: List ----------------------------------------------------------/

		// Ol
		'levelTwoOLPaddingType'                     => 'px',
		'levelTwoOLPaddingSize'                     => 1,
		'levelTwoOLMarginType'                      => 'px',
		'levelTwoOLMarginSize'                      => 1,
		'levelTwoOLBackgroundColor'                 => '#FFFFFF',

		// Li
		'levelTwoLITextColor'                       => '#666666',
		'levelTwoLIBackgroundColor'                 => '#FFFFFF',
		'levelTwoLIFontSizeType'                    => 'px',
		'levelTwoLIFontSizeDesktop'                 => 16,
		'levelTwoLIFontSizeMobile'                  => 16,
		'levelTwoLIFontSizeTablet'                  => 16,
		'levelTwoLILineHeightType'                  => 'em',
		'levelTwoLILineHeightSize'                  => 2,
		'levelTwoLITopBottomPaddingType'            => 'px',
		'levelTwoLITopBottomPaddingSize'            => 1,
		'levelTwoLILeftRightPaddingType'            => 'px',
		'levelTwoLILeftPaddingSize'                 => 60,
		'levelTwoLIRightPaddingSize'                => 0,
		'levelTwoLITopBottomMarginType'             => 'px',
		'levelTwoLITopBottomMarginSize'             => 4,
		'levelTwoLILeftRightMarginType'             => 'px',
		'levelTwoLILeftRightMarginSize'             => 6,
		'levelTwoLIBorderThicknessLeft'             => 0,
		'levelTwoLIBorderThicknessRight'            => 0,
		'levelTwoLIBorderThicknessUp'               => 0,
		'levelTwoLIBorderThicknessDown'             => 0,
		'levelTwoLIBorderRadius'                    => 0,
		'levelTwoLIBorderColor'                     => '#6C656D',

		// Number / Icon
		'levelTwoStyleTypeFontSizeType'             => 'em',
		'levelTwoStyleTypeFontSizeDesktop'          => 1,
		'levelTwoStyleTypeFontSizeMobile'           => 1,
		'levelTwoStyleTypeFontSizeTablet'           => 1,
		'levelTwoStyleTypeTextPrefix'               => '',
		'levelTwoStyleType'                         => 'inherit',
		'levelTwoStyleTypeTopBottomPaddingType'     => 'px',
		'levelTwoStyleTypeTopBottomPaddingSize'     => 0,
		'levelTwoStyleTypeLeftRightPaddingType'     => 'px',
		'levelTwoStyleTypeLeftRightPaddingSize'     => 6,
		'levelTwoStyleTypeTopBottomMarginType'      => 'px',
		'levelTwoStyleTypeTopBottomMarginSize'      => 1,
		'levelTwoStyleTypeLeftMarginType'           => 'px',
		'levelTwoStyleTypeLeftMarginSize'           => -36,
		'levelTwoStyleTypeRightMarginType'          => 'px',
		'levelTwoStyleTypeRightMarginSize'          => 6,
		'levelTwoStyleTypeTextColor'                => '#ffffff',
		'levelTwoStyleTypeBackgroundColor'          => '#545454',
		'levelTwoStyleTypeBorderRadius'             => 30,
		'levelTwoStyleTypeBorderThickness'          => 0,
		'levelTwoStyleTypeBorderColor'              => '#FFFFFF',

		// Level 3: List ----------------------------------------------------------/

		// Ol
		'levelThreeOLPaddingType'                     => 'px',
		'levelThreeOLPaddingSize'                     => 1,
		'levelThreeOLMarginType'                      => 'px',
		'levelThreeOLMarginSize'                      => 1,
		'levelThreeOLBackgroundColor'                 => '#FFFFFF',

		// Li
		'levelThreeLITextColor'                       => '#666666',
		'levelThreeLIBackgroundColor'                 => '#FFFFFF',
		'levelThreeLIFontSizeType'                    => 'px',
		'levelThreeLIFontSizeDesktop'                 => 16,
		'levelThreeLIFontSizeMobile'                  => 16,
		'levelThreeLIFontSizeTablet'                  => 16,
		'levelThreeLILineHeightType'                  => 'em',
		'levelThreeLILineHeightSize'                  => 2,
		'levelThreeLITopBottomPaddingType'            => 'px',
		'levelThreeLITopBottomPaddingSize'            => 1,
		'levelThreeLILeftRightPaddingType'            => 'px',
		'levelThreeLILeftPaddingSize'                 => 60,
		'levelThreeLIRightPaddingSize'                => 1,
		'levelThreeLITopBottomMarginType'             => 'px',
		'levelThreeLITopBottomMarginSize'             => 4,
		'levelThreeLILeftRightMarginType'             => 'px',
		'levelThreeLILeftRightMarginSize'             => 1,
		'levelThreeLIBorderThicknessLeft'             => 0,
		'levelThreeLIBorderThicknessRight'            => 0,
		'levelThreeLIBorderThicknessUp'               => 0,
		'levelThreeLIBorderThicknessDown'             => 0,
		'levelThreeLIBorderRadius'                    => 0,
		'levelThreeLIBorderColor'                     => '#6C656D',

		// Number / Icon
		'levelThreeStyleTypeFontSizeType'             => 'em',
		'levelThreeStyleTypeFontSizeDesktop'          => .9,
		'levelThreeStyleTypeFontSizeMobile'           => .9,
		'levelThreeStyleTypeFontSizeTablet'           => .9,
		'levelThreeStyleTypeTextPrefix'               => '',
		'levelThreeStyleType'                         => 'inherit',
		'levelThreeStyleTypeTopBottomPaddingType'     => 'px',
		'levelThreeStyleTypeTopBottomPaddingSize'     => 0,
		'levelThreeStyleTypeLeftRightPaddingType'     => 'px',
		'levelThreeStyleTypeLeftRightPaddingSize'     => 6,
		'levelThreeStyleTypeTopBottomMarginType'      => 'px',
		'levelThreeStyleTypeTopBottomMarginSize'      => 1,
		'levelThreeStyleTypeLeftMarginType'           => 'px',
		'levelThreeStyleTypeLeftMarginSize'           => -50,
		'levelThreeStyleTypeRightMarginType'          => 'px',
		'levelThreeStyleTypeRightMarginSize'          => 6,
		'levelThreeStyleTypeTextColor'                => '#ffffff',
		'levelThreeStyleTypeBackgroundColor'          => '#777777',
		'levelThreeStyleTypeBorderRadius'             => 30,
		'levelThreeStyleTypeBorderThickness'          => 0,
		'levelThreeStyleTypeBorderColor'              => '#6C656D',

		// Level 4: List ----------------------------------------------------------/

		// Ol
		'levelFourOLPaddingType'                     => 'px',
		'levelFourOLPaddingSize'                     => 1,
		'levelFourOLMarginType'                      => 'px',
		'levelFourOLMarginSize'                      => 1,
		'levelFourOLBackgroundColor'                 => '#FFFFFF',

		// Li
		'levelFourLITextColor'                       => '#000000',
		'levelFourLIBackgroundColor'                 => '#FFFFFF',
		'levelFourLIFontSizeType'                    => 'px',
		'levelFourLIFontSizeDesktop'                 => 16,
		'levelFourLIFontSizeMobile'                  => 16,
		'levelFourLIFontSizeTablet'                  => 16,
		'levelFourLILineHeightType'                  => 'em',
		'levelFourLILineHeightSize'                  => 2,
		'levelFourLITopBottomPaddingType'            => 'px',
		'levelFourLITopBottomPaddingSize'            => 1,
		'levelFourLILeftRightPaddingType'            => 'px',
		'levelFourLILeftPaddingSize'                 => 60,
		'levelFourLIRightPaddingSize'                => 0,
		'levelFourLITopBottomMarginType'             => 'px',
		'levelFourLITopBottomMarginSize'             => 5,
		'levelFourLILeftRightMarginType'             => 'px',
		'levelFourLILeftRightMarginSize'             => 6,
		'levelFourLIBorderThicknessLeft'             => 0,
		'levelFourLIBorderThicknessRight'            => 0,
		'levelFourLIBorderThicknessUp'               => 0,
		'levelFourLIBorderThicknessDown'             => 0,
		'levelFourLIBorderRadius'                    => 0,
		'levelFourLIBorderColor'                     => '#6C656D',

		// Number / Icon
		'levelFourStyleTypeFontSizeType'             => 'em',
		'levelFourStyleTypeFontSizeDesktop'          => .9,
		'levelFourStyleTypeFontSizeMobile'           => .9,
		'levelFourStyleTypeFontSizeTablet'           => .9,
		'levelFourStyleTypeTextPrefix'               => '',
		'levelFourStyleType'                         => 'inherit',
		'levelFourStyleTypeTopBottomPaddingType'     => 'px',
		'levelFourStyleTypeTopBottomPaddingSize'     => 3,
		'levelFourStyleTypeLeftRightPaddingType'     => 'px',
		'levelFourStyleTypeLeftRightPaddingSize'     => 6,
		'levelFourStyleTypeTopBottomMarginType'      => 'px',
		'levelFourStyleTypeTopBottomMarginSize'      => 1,
		'levelFourStyleTypeLeftMarginType'           => 'px',
		'levelFourStyleTypeLeftMarginSize'           => -61,
		'levelFourStyleTypeRightMarginType'          => 'px',
		'levelFourStyleTypeRightMarginSize'          => 6,
		'levelFourStyleTypeTextColor'                => '#ffffff',
		'levelFourStyleTypeBackgroundColor'          => '#474745',
		'levelFourStyleTypeBorderRadius'             => 30,
		'levelFourStyleTypeBorderThickness'          => 0,
		'levelFourStyleTypeBorderColor'              => '#6C656D',

		// Level 5: List ----------------------------------------------------------/

		// Ol
		'levelFiveOLPaddingType'                     => 'px',
		'levelFiveOLPaddingSize'                     => 1,
		'levelFiveOLMarginType'                      => 'px',
		'levelFiveOLMarginSize'                      => 10,
		'levelFiveOLBackgroundColor'                 => '#FFFFFF',

		// Li
		'levelFiveLITextColor'                       => '#000000',
		'levelFiveLIBackgroundColor'                 => '#FFFFFF',
		'levelFiveLIFontSizeType'                    => 'px',
		'levelFiveLIFontSizeDesktop'                 => 16,
		'levelFiveLIFontSizeMobile'                  => 16,
		'levelFiveLIFontSizeTablet'                  => 16,
		'levelFiveLILineHeightType'                  => 'em',
		'levelFiveLILineHeightSize'                  => 2,
		'levelFiveLITopBottomPaddingType'            => 'px',
		'levelFiveLITopBottomPaddingSize'            => 1,
		'levelFiveLILeftRightPaddingType'            => 'px',
		'levelFiveLILeftPaddingSize'                 => 60,
		'levelFiveLIRightPaddingSize'                => 0,
		'levelFiveLITopBottomMarginType'             => 'px',
		'levelFiveLITopBottomMarginSize'             => 1,
		'levelFiveLILeftRightMarginType'             => 'px',
		'levelFiveLILeftRightMarginSize'             => 1,
		'levelFiveLIBorderThicknessLeft'             => 0,
		'levelFiveLIBorderThicknessRight'            => 0,
		'levelFiveLIBorderThicknessUp'               => 0,
		'levelFiveLIBorderThicknessDown'             => 0,
		'levelFiveLIBorderRadius'                    => 0,
		'levelFiveLIBorderColor'                     => '#6C656D',

		// Number / Icon
		'levelFiveStyleTypeFontSizeType'             => 'em',
		'levelFiveStyleTypeFontSizeDesktop'          => .9,
		'levelFiveStyleTypeFontSizeMobile'           => .9,
		'levelFiveStyleTypeFontSizeTablet'           => .9,
		'levelFiveStyleTypeTextPrefix'               => '',
		'levelFiveStyleType'                         => 'inherit',
		'levelFiveStyleTypeTopBottomPaddingType'     => 'px',
		'levelFiveStyleTypeTopBottomPaddingSize'     => 3,
		'levelFiveStyleTypeLeftRightPaddingType'     => 'px',
		'levelFiveStyleTypeLeftRightPaddingSize'     => 6,
		'levelFiveStyleTypeTopBottomMarginType'      => 'px',
		'levelFiveStyleTypeTopBottomMarginSize'      => 1,
		'levelFiveStyleTypeLeftMarginType'           => 'px',
		'levelFiveStyleTypeLeftMarginSize'           => -73,
		'levelFiveStyleTypeRightMarginType'          => 'px',
		'levelFiveStyleTypeRightMarginSize'          => 6,
		'levelFiveStyleTypeTextColor'                => '#ffffff',
		'levelFiveStyleTypeBackgroundColor'          => '#a4a4a4',
		'levelFiveStyleTypeBorderRadius'             => 30,
		'levelFiveStyleTypeBorderThickness'          => 0,
		'levelFiveStyleTypeBorderColor'              => '#6C656D',
	);

	//Background List
	public static $preset_9 = array(
		'blockType'                                 => 'preset',
		'templateId'                                => 9,                  // THIS IS PRESET ID
		// Level 1: List ----------------------------------------------------------/

		// Ol
		'levelOneOLPaddingType'                     => 'px',
		'levelOneOLPaddingSize'                     => 1,
		'levelOneOLMarginType'                      => 'px',
		'levelOneOLMarginSize'                      => 1,
		'levelOneOLBackgroundColor'                 => '#FFFFFF',

		// Li
		'levelOneLITextColor'                       => '#000000',
		'levelOneLIBackgroundColor'                 => '#fafafa',
		'levelOneLIFontSizeType'                    => 'px',
		'levelOneLIFontSizeDesktop'                 => 16,
		'levelOneLIFontSizeMobile'                  => 16,
		'levelOneLIFontSizeTablet'                  => 16,
		'levelOneLILineHeightType'                  => 'em',
		'levelOneLILineHeightSize'                  => 2,
		'levelOneLITopBottomPaddingType'            => 'px',
		'levelOneLITopBottomPaddingSize'            => 2,
		'levelOneLILeftRightPaddingType'            => 'px',
		'levelOneLILeftRightPaddingSize'            => 1,
		'levelOneLILeftPaddingSize'                 => 10,
		'levelOneLIRightPaddingSize'                => 1,
		'levelOneLITopBottomMarginType'             => 'px',
		'levelOneLITopBottomMarginSize'             => 20,
		'levelOneLILeftRightMarginType'             => 'px',
		'levelOneLILeftRightMarginSize'             => 20,
		'levelOneLIBorderThicknessLeft'             => 0,
		'levelOneLIBorderThicknessRight'            => 0,
		'levelOneLIBorderThicknessUp'               => 2,
		'levelOneLIBorderThicknessDown'             => 0,
		'levelOneLIBorderRadius'                    => 0,
		'levelOneLIBorderColor'                     => '#6C656D',

		// Number / Icon
		'levelOneStyleTypeFontSizeType'             => 'em',
		'levelOneStyleTypeFontSizeDesktop'          => 1,
		'levelOneStyleTypeFontSizeMobile'           => 1,
		'levelOneStyleTypeFontSizeTablet'           => 1,
		'levelOneStyleTypeTextPrefix'               => '',
		'levelOneStyleType'                         => 'decimal',
		'levelOneStyleTypeTopBottomPaddingType'     => 'px',
		'levelOneStyleTypeTopBottomPaddingSize'     => 2,
		'levelOneStyleTypeLeftRightPaddingType'     => 'px',
		'levelOneStyleTypeLeftRightPaddingSize'     => 11,
		'levelOneStyleTypeTopBottomMarginType'      => 'px',
		'levelOneStyleTypeTopBottomMarginSize'      => -2,
		'levelOneStyleTypeLeftMarginType'           => 'px',
		'levelOneStyleTypeLeftMarginSize'           => -10,
		'levelOneStyleTypeRightMarginType'          => 'px',
		'levelOneStyleTypeRightMarginSize'          => 6,
		'levelOneStyleTypeTextColor'                => '#ffffff',
		'levelOneStyleTypeBackgroundColor'          => '#666666',
		'levelOneStyleTypeBorderRadius'             => 0,
		'levelOneStyleTypeBorderThickness'          => 0,
		'levelOneStyleTypeBorderColor'              => '#6C656D',

		// Level 2: List ----------------------------------------------------------/

		// Ol
		'levelTwoOLPaddingType'                     => 'px',
		'levelTwoOLPaddingSize'                     => 1,
		'levelTwoOLMarginType'                      => 'px',
		'levelTwoOLMarginSize'                      => 17,
		'levelTwoOLBackgroundColor'                 => '#fafafa',

		// Li
		'levelTwoLITextColor'                       => '#5a5a5a',
		'levelTwoLIBackgroundColor'                 => '#fafafa',
		'levelTwoLIFontSizeType'                    => 'px',
		'levelTwoLIFontSizeDesktop'                 => 16,
		'levelTwoLIFontSizeMobile'                  => 16,
		'levelTwoLIFontSizeTablet'                  => 16,
		'levelTwoLILineHeightType'                  => 'em',
		'levelTwoLILineHeightSize'                  => 2,
		'levelTwoLITopBottomPaddingType'            => 'px',
		'levelTwoLITopBottomPaddingSize'            => 1,
		'levelTwoLILeftRightPaddingType'            => 'px',
		'levelTwoLILeftPaddingSize'                 => 39,
		'levelTwoLIRightPaddingSize'                => 0,
		'levelTwoLITopBottomMarginType'             => 'px',
		'levelTwoLITopBottomMarginSize'             => 20,
		'levelTwoLILeftRightMarginType'             => 'px',
		'levelTwoLILeftRightMarginSize'             => 1,
		'levelTwoLIBorderThicknessLeft'             => 0,
		'levelTwoLIBorderThicknessRight'            => 0,
		'levelTwoLIBorderThicknessUp'               => 2,
		'levelTwoLIBorderThicknessDown'             => 0,
		'levelTwoLIBorderRadius'                    => 0,
		'levelTwoLIBorderColor'                     => '#666666',

		// Number / Icon
		'levelTwoStyleTypeFontSizeType'             => 'em',
		'levelTwoStyleTypeFontSizeDesktop'          => 1,
		'levelTwoStyleTypeFontSizeMobile'           => 1,
		'levelTwoStyleTypeFontSizeTablet'           => 1,
		'levelTwoStyleTypeTextPrefix'               => '',
		'levelTwoStyleType'                         => 'decimal',
		'levelTwoStyleTypeTopBottomPaddingType'     => 'px',
		'levelTwoStyleTypeTopBottomPaddingSize'     => 2,
		'levelTwoStyleTypeLeftRightPaddingType'     => 'px',
		'levelTwoStyleTypeLeftRightPaddingSize'     => 11,
		'levelTwoStyleTypeTopBottomMarginType'      => 'px',
		'levelTwoStyleTypeTopBottomMarginSize'      => -2,
		'levelTwoStyleTypeLeftMarginType'           => 'px',
		'levelTwoStyleTypeLeftMarginSize'           => -39,
		'levelTwoStyleTypeRightMarginType'          => 'px',
		'levelTwoStyleTypeRightMarginSize'          => 0,
		'levelTwoStyleTypeTextColor'                => '#ffffff',
		'levelTwoStyleTypeBackgroundColor'          => '#666666',
		'levelTwoStyleTypeBorderRadius'             => 0,
		'levelTwoStyleTypeBorderThickness'          => 0,
		'levelTwoStyleTypeBorderColor'              => '#FFFFFF',

		// Level 3: List ----------------------------------------------------------/

		// Ol
		'levelThreeOLPaddingType'                     => 'px',
		'levelThreeOLPaddingSize'                     => 1,
		'levelThreeOLMarginType'                      => 'px',
		'levelThreeOLMarginSize'                      => 1,
		'levelThreeOLBackgroundColor'                 => '#fafafa',

		// Li
		'levelThreeLITextColor'                       => '#666666',
		'levelThreeLIBackgroundColor'                 => '#fafafa',
		'levelThreeLIFontSizeType'                    => 'px',
		'levelThreeLIFontSizeDesktop'                 => 16,
		'levelThreeLIFontSizeMobile'                  => 16,
		'levelThreeLIFontSizeTablet'                  => 16,
		'levelThreeLILineHeightType'                  => 'em',
		'levelThreeLILineHeightSize'                  => 2,
		'levelThreeLITopBottomPaddingType'            => 'px',
		'levelThreeLITopBottomPaddingSize'            => 1,
		'levelThreeLILeftRightPaddingType'            => 'px',
		'levelThreeLILeftPaddingSize'                 => 30,
		'levelThreeLIRightPaddingSize'                => 1,
		'levelThreeLITopBottomMarginType'             => 'px',
		'levelThreeLITopBottomMarginSize'             => 20,
		'levelThreeLILeftRightMarginType'             => 'px',
		'levelThreeLILeftRightMarginSize'             => 1,
		'levelThreeLIBorderThicknessLeft'             => 0,
		'levelThreeLIBorderThicknessRight'            => 0,
		'levelThreeLIBorderThicknessUp'               => 2,
		'levelThreeLIBorderThicknessDown'             => 0,
		'levelThreeLIBorderRadius'                    => 0,
		'levelThreeLIBorderColor'                     => '#666666',

		// Number / Icon
		'levelThreeStyleTypeFontSizeType'             => 'em',
		'levelThreeStyleTypeFontSizeDesktop'          => 1,
		'levelThreeStyleTypeFontSizeMobile'           => 1,
		'levelThreeStyleTypeFontSizeTablet'           => 1,
		'levelThreeStyleTypeTextPrefix'               => '',
		'levelThreeStyleType'                         => 'decimal',
		'levelThreeStyleTypeTopBottomPaddingType'     => 'px',
		'levelThreeStyleTypeTopBottomPaddingSize'     => 2,
		'levelThreeStyleTypeLeftRightPaddingType'     => 'px',
		'levelThreeStyleTypeLeftRightPaddingSize'     => 11,
		'levelThreeStyleTypeTopBottomMarginType'      => 'px',
		'levelThreeStyleTypeTopBottomMarginSize'      => -2,
		'levelThreeStyleTypeLeftMarginType'           => 'px',
		'levelThreeStyleTypeLeftMarginSize'           => -30,
		'levelThreeStyleTypeRightMarginType'          => 'px',
		'levelThreeStyleTypeRightMarginSize'          => 19,
		'levelThreeStyleTypeTextColor'                => '#ffffff',
		'levelThreeStyleTypeBackgroundColor'          => '#666666',
		'levelThreeStyleTypeBorderRadius'             => 0,
		'levelThreeStyleTypeBorderThickness'          => 0,
		'levelThreeStyleTypeBorderColor'              => '#6C656D',

		// Level 4: List ----------------------------------------------------------/

		// Ol
		'levelFourOLPaddingType'                     => 'px',
		'levelFourOLPaddingSize'                     => 1,
		'levelFourOLMarginType'                      => 'px',
		'levelFourOLMarginSize'                      => 1,
		'levelFourOLBackgroundColor'                 => '#fafafa',

		// Li
		'levelFourLITextColor'                       => '#000000',
		'levelFourLIBackgroundColor'                 => '#fafafa',
		'levelFourLIFontSizeType'                    => 'px',
		'levelFourLIFontSizeDesktop'                 => 16,
		'levelFourLIFontSizeMobile'                  => 16,
		'levelFourLIFontSizeTablet'                  => 16,
		'levelFourLILineHeightType'                  => 'em',
		'levelFourLILineHeightSize'                  => 2,
		'levelFourLITopBottomPaddingType'            => 'px',
		'levelFourLITopBottomPaddingSize'            => 1,
		'levelFourLILeftRightPaddingType'            => 'px',
		'levelFourLILeftPaddingSize'                 => 40,
		'levelFourLIRightPaddingSize'                => 0,
		'levelFourLITopBottomMarginType'             => 'px',
		'levelFourLITopBottomMarginSize'             => 20,
		'levelFourLILeftRightMarginType'             => 'px',
		'levelFourLILeftRightMarginSize'             => 1,
		'levelFourLIBorderThicknessLeft'             => 0,
		'levelFourLIBorderThicknessRight'            => 0,
		'levelFourLIBorderThicknessUp'               => 2,
		'levelFourLIBorderThicknessDown'             => 0,
		'levelFourLIBorderRadius'                    => 0,
		'levelFourLIBorderColor'                     => '#666666',

		// Number / Icon
		'levelFourStyleTypeFontSizeType'             => 'em',
		'levelFourStyleTypeFontSizeDesktop'          => 1,
		'levelFourStyleTypeFontSizeMobile'           => 1,
		'levelFourStyleTypeFontSizeTablet'           => 1,
		'levelFourStyleTypeTextPrefix'               => '',
		'levelFourStyleType'                         => 'inherit',
		'levelFourStyleTypeTopBottomPaddingType'     => 'px',
		'levelFourStyleTypeTopBottomPaddingSize'     => 2,
		'levelFourStyleTypeLeftRightPaddingType'     => 'px',
		'levelFourStyleTypeLeftRightPaddingSize'     => 5,
		'levelFourStyleTypeTopBottomMarginType'      => 'px',
		'levelFourStyleTypeTopBottomMarginSize'      => -2,
		'levelFourStyleTypeLeftMarginType'           => 'px',
		'levelFourStyleTypeLeftMarginSize'           => -40,
		'levelFourStyleTypeRightMarginType'          => 'px',
		'levelFourStyleTypeRightMarginSize'          => 11,
		'levelFourStyleTypeTextColor'                => '#ffffff',
		'levelFourStyleTypeBackgroundColor'          => '#666666',
		'levelFourStyleTypeBorderRadius'             => 0,
		'levelFourStyleTypeBorderThickness'          => 0,
		'levelFourStyleTypeBorderColor'              => '#6C656D',

		// Level 5: List ----------------------------------------------------------/

		// Ol
		'levelFiveOLPaddingType'                     => 'px',
		'levelFiveOLPaddingSize'                     => 1,
		'levelFiveOLMarginType'                      => 'px',
		'levelFiveOLMarginSize'                      => 1,
		'levelFiveOLBackgroundColor'                 => '#fafafa',

		// Li
		'levelFiveLITextColor'                       => '#000000',
		'levelFiveLIBackgroundColor'                 => '#fafafa',
		'levelFiveLIFontSizeType'                    => 'px',
		'levelFiveLIFontSizeDesktop'                 => 16,
		'levelFiveLIFontSizeMobile'                  => 16,
		'levelFiveLIFontSizeTablet'                  => 16,
		'levelFiveLILineHeightType'                  => 'em',
		'levelFiveLILineHeightSize'                  => 2,
		'levelFiveLITopBottomPaddingType'            => 'px',
		'levelFiveLITopBottomPaddingSize'            => 1,
		'levelFiveLILeftRightPaddingType'            => 'px',
		'levelFiveLILeftPaddingSize'                 => 60,
		'levelFiveLIRightPaddingSize'                => 0,
		'levelFiveLITopBottomMarginType'             => 'px',
		'levelFiveLITopBottomMarginSize'             => 20,
		'levelFiveLILeftRightMarginType'             => 'px',
		'levelFiveLILeftRightMarginSize'             => 1,
		'levelFiveLIBorderThicknessLeft'             => 0,
		'levelFiveLIBorderThicknessRight'            => 0,
		'levelFiveLIBorderThicknessUp'               => 2,
		'levelFiveLIBorderThicknessDown'             => 0,
		'levelFiveLIBorderRadius'                    => 0,
		'levelFiveLIBorderColor'                     => '#666666',

		// Number / Icon
		'levelFiveStyleTypeFontSizeType'             => 'em',
		'levelFiveStyleTypeFontSizeDesktop'          => 1,
		'levelFiveStyleTypeFontSizeMobile'           => 1,
		'levelFiveStyleTypeFontSizeTablet'           => 1,
		'levelFiveStyleTypeTextPrefix'               => '',
		'levelFiveStyleType'                         => 'inherit',
		'levelFiveStyleTypeTopBottomPaddingType'     => 'px',
		'levelFiveStyleTypeTopBottomPaddingSize'     => 2,
		'levelFiveStyleTypeLeftRightPaddingType'     => 'px',
		'levelFiveStyleTypeLeftRightPaddingSize'     => 5,
		'levelFiveStyleTypeTopBottomMarginType'      => 'px',
		'levelFiveStyleTypeTopBottomMarginSize'      => -2,
		'levelFiveStyleTypeLeftMarginType'           => 'px',
		'levelFiveStyleTypeLeftMarginSize'           => -60,
		'levelFiveStyleTypeRightMarginType'          => 'px',
		'levelFiveStyleTypeRightMarginSize'          => 6,
		'levelFiveStyleTypeTextColor'                => '#ffffff',
		'levelFiveStyleTypeBackgroundColor'          => '#666666',
		'levelFiveStyleTypeBorderRadius'             => 0,
		'levelFiveStyleTypeBorderThickness'          => 0,
		'levelFiveStyleTypeBorderColor'              => '#666666',
	);

	//Background List
	public static $preset_14 = array(
		'blockType'                                 => 'preset',
		'templateId'                                => 14,                  // THIS IS PRESET ID
		// Level 1: List ----------------------------------------------------------/

		// Ol
		'levelOneOLPaddingType'                     => 'px',
		'levelOneOLPaddingSize'                     => 1,
		'levelOneOLMarginType'                      => 'px',
		'levelOneOLMarginSize'                      => 1,
		'levelOneOLBackgroundColor'                 => '#FFFFFF',

		// Li
		'levelOneLITextColor'                       => '#000000',
		'levelOneLIBackgroundColor'                 => '#fafafa',
		'levelOneLIFontSizeType'                    => 'px',
		'levelOneLIFontSizeDesktop'                 => 16,
		'levelOneLIFontSizeMobile'                  => 16,
		'levelOneLIFontSizeTablet'                  => 16,
		'levelOneLILineHeightType'                  => 'em',
		'levelOneLILineHeightSize'                  => 2,
		'levelOneLITopBottomPaddingType'            => 'px',
		'levelOneLITopBottomPaddingSize'            => 1,
		'levelOneLILeftRightPaddingType'            => 'px',
		'levelOneLILeftRightPaddingSize'            => 1,
		'levelOneLILeftPaddingSize'                 => 1,
		'levelOneLIRightPaddingSize'                => 1,
		'levelOneLITopBottomMarginType'             => 'px',
		'levelOneLITopBottomMarginSize'             => 20,
		'levelOneLILeftRightMarginType'             => 'px',
		'levelOneLILeftRightMarginSize'             => 20,
		'levelOneLIBorderThicknessLeft'             => 0,
		'levelOneLIBorderThicknessRight'            => 0,
		'levelOneLIBorderThicknessUp'               => 0,
		'levelOneLIBorderThicknessDown'             => 0,
		'levelOneLIBorderRadius'                    => 0,
		'levelOneLIBorderColor'                     => '#6C656D',

		// Number / Icon
		'levelOneStyleTypeFontSizeType'             => 'em',
		'levelOneStyleTypeFontSizeDesktop'          => 1,
		'levelOneStyleTypeFontSizeMobile'           => 1,
		'levelOneStyleTypeFontSizeTablet'           => 1,
		'levelOneStyleTypeTextPrefix'               => '',
		'levelOneStyleType'                         => 'decimal',
		'levelOneStyleTypeTopBottomPaddingType'     => 'px',
		'levelOneStyleTypeTopBottomPaddingSize'     => 5,
		'levelOneStyleTypeLeftRightPaddingType'     => 'px',
		'levelOneStyleTypeLeftRightPaddingSize'     => 11,
		'levelOneStyleTypeTopBottomMarginType'      => 'px',
		'levelOneStyleTypeTopBottomMarginSize'      => 1,
		'levelOneStyleTypeLeftMarginType'           => 'px',
		'levelOneStyleTypeLeftMarginSize'           => -36,
		'levelOneStyleTypeRightMarginType'          => 'px',
		'levelOneStyleTypeRightMarginSize'          => 6,
		'levelOneStyleTypeTextColor'                => '#ffffff',
		'levelOneStyleTypeBackgroundColor'          => '#5cacff',
		'levelOneStyleTypeBorderRadius'             => 30,
		'levelOneStyleTypeBorderThickness'          => 0,
		'levelOneStyleTypeBorderColor'              => '#6C656D',

		// Level 2: List ----------------------------------------------------------/

		// Ol
		'levelTwoOLPaddingType'                     => 'px',
		'levelTwoOLPaddingSize'                     => 1,
		'levelTwoOLMarginType'                      => 'px',
		'levelTwoOLMarginSize'                      => 1,
		'levelTwoOLBackgroundColor'                 => '#FFFFFF',

		// Li
		'levelTwoLITextColor'                       => '#5a5a5a',
		'levelTwoLIBackgroundColor'                 => '#fcfff2',
		'levelTwoLIFontSizeType'                    => 'px',
		'levelTwoLIFontSizeDesktop'                 => 16,
		'levelTwoLIFontSizeMobile'                  => 16,
		'levelTwoLIFontSizeTablet'                  => 16,
		'levelTwoLILineHeightType'                  => 'em',
		'levelTwoLILineHeightSize'                  => 2,
		'levelTwoLITopBottomPaddingType'            => 'px',
		'levelTwoLITopBottomPaddingSize'            => 1,
		'levelTwoLILeftRightPaddingType'            => 'px',
		'levelTwoLILeftPaddingSize'                 => 60,
		'levelTwoLIRightPaddingSize'                => 0,
		'levelTwoLITopBottomMarginType'             => 'px',
		'levelTwoLITopBottomMarginSize'             => 1,
		'levelTwoLILeftRightMarginType'             => 'px',
		'levelTwoLILeftRightMarginSize'             => 6,
		'levelTwoLIBorderThicknessLeft'             => 0,
		'levelTwoLIBorderThicknessRight'            => 0,
		'levelTwoLIBorderThicknessUp'               => 0,
		'levelTwoLIBorderThicknessDown'             => 0,
		'levelTwoLIBorderRadius'                    => 0,
		'levelTwoLIBorderColor'                     => '#6C656D',

		// Number / Icon
		'levelTwoStyleTypeFontSizeType'             => 'em',
		'levelTwoStyleTypeFontSizeDesktop'          => 1,
		'levelTwoStyleTypeFontSizeMobile'           => 1,
		'levelTwoStyleTypeFontSizeTablet'           => 1,
		'levelTwoStyleTypeTextPrefix'               => '',
		'levelTwoStyleType'                         => 'inherit',
		'levelTwoStyleTypeTopBottomPaddingType'     => 'px',
		'levelTwoStyleTypeTopBottomPaddingSize'     => 5,
		'levelTwoStyleTypeLeftRightPaddingType'     => 'px',
		'levelTwoStyleTypeLeftRightPaddingSize'     => 5,
		'levelTwoStyleTypeTopBottomMarginType'      => 'px',
		'levelTwoStyleTypeTopBottomMarginSize'      => 1,
		'levelTwoStyleTypeLeftMarginType'           => 'px',
		'levelTwoStyleTypeLeftMarginSize'           => -36,
		'levelTwoStyleTypeRightMarginType'          => 'px',
		'levelTwoStyleTypeRightMarginSize'          => 6,
		'levelTwoStyleTypeTextColor'                => '#ffffff',
		'levelTwoStyleTypeBackgroundColor'          => '#545454',
		'levelTwoStyleTypeBorderRadius'             => 30,
		'levelTwoStyleTypeBorderThickness'          => 0,
		'levelTwoStyleTypeBorderColor'              => '#FFFFFF',

		// Level 3: List ----------------------------------------------------------/

		// Ol
		'levelThreeOLPaddingType'                     => 'px',
		'levelThreeOLPaddingSize'                     => 1,
		'levelThreeOLMarginType'                      => 'px',
		'levelThreeOLMarginSize'                      => 1,
		'levelThreeOLBackgroundColor'                 => '#FFFFFF',

		// Li
		'levelThreeLITextColor'                       => '#666666',
		'levelThreeLIBackgroundColor'                 => '#f9ffff',
		'levelThreeLIFontSizeType'                    => 'px',
		'levelThreeLIFontSizeDesktop'                 => 16,
		'levelThreeLIFontSizeMobile'                  => 16,
		'levelThreeLIFontSizeTablet'                  => 16,
		'levelThreeLILineHeightType'                  => 'em',
		'levelThreeLILineHeightSize'                  => 2,
		'levelThreeLITopBottomPaddingType'            => 'px',
		'levelThreeLITopBottomPaddingSize'            => 1,
		'levelThreeLILeftRightPaddingType'            => 'px',
		'levelThreeLILeftPaddingSize'                 => 60,
		'levelThreeLIRightPaddingSize'                => 1,
		'levelThreeLITopBottomMarginType'             => 'px',
		'levelThreeLITopBottomMarginSize'             => 1,
		'levelThreeLILeftRightMarginType'             => 'px',
		'levelThreeLILeftRightMarginSize'             => 1,
		'levelThreeLIBorderThicknessLeft'             => 0,
		'levelThreeLIBorderThicknessRight'            => 0,
		'levelThreeLIBorderThicknessUp'               => 0,
		'levelThreeLIBorderThicknessDown'             => 0,
		'levelThreeLIBorderRadius'                    => 0,
		'levelThreeLIBorderColor'                     => '#6C656D',

		// Number / Icon
		'levelThreeStyleTypeFontSizeType'             => 'em',
		'levelThreeStyleTypeFontSizeDesktop'          => 1,
		'levelThreeStyleTypeFontSizeMobile'           => 1,
		'levelThreeStyleTypeFontSizeTablet'           => 1,
		'levelThreeStyleTypeTextPrefix'               => '',
		'levelThreeStyleType'                         => 'inherit',
		'levelThreeStyleTypeTopBottomPaddingType'     => 'px',
		'levelThreeStyleTypeTopBottomPaddingSize'     => 5,
		'levelThreeStyleTypeLeftRightPaddingType'     => 'px',
		'levelThreeStyleTypeLeftRightPaddingSize'     => 6,
		'levelThreeStyleTypeTopBottomMarginType'      => 'px',
		'levelThreeStyleTypeTopBottomMarginSize'      => 1,
		'levelThreeStyleTypeLeftMarginType'           => 'px',
		'levelThreeStyleTypeLeftMarginSize'           => -50,
		'levelThreeStyleTypeRightMarginType'          => 'px',
		'levelThreeStyleTypeRightMarginSize'          => 6,
		'levelThreeStyleTypeTextColor'                => '#ffffff',
		'levelThreeStyleTypeBackgroundColor'          => '#777777',
		'levelThreeStyleTypeBorderRadius'             => 30,
		'levelThreeStyleTypeBorderThickness'          => 0,
		'levelThreeStyleTypeBorderColor'              => '#6C656D',

		// Level 4: List ----------------------------------------------------------/

		// Ol
		'levelFourOLPaddingType'                     => 'px',
		'levelFourOLPaddingSize'                     => 1,
		'levelFourOLMarginType'                      => 'px',
		'levelFourOLMarginSize'                      => 1,
		'levelFourOLBackgroundColor'                 => '#FFFFFF',

		// Li
		'levelFourLITextColor'                       => '#000000',
		'levelFourLIBackgroundColor'                 => '#fcfff2',
		'levelFourLIFontSizeType'                    => 'px',
		'levelFourLIFontSizeDesktop'                 => 16,
		'levelFourLIFontSizeMobile'                  => 16,
		'levelFourLIFontSizeTablet'                  => 16,
		'levelFourLILineHeightType'                  => 'em',
		'levelFourLILineHeightSize'                  => 2,
		'levelFourLITopBottomPaddingType'            => 'px',
		'levelFourLITopBottomPaddingSize'            => 1,
		'levelFourLILeftRightPaddingType'            => 'px',
		'levelFourLILeftPaddingSize'                 => 60,
		'levelFourLIRightPaddingSize'                => 0,
		'levelFourLITopBottomMarginType'             => 'px',
		'levelFourLITopBottomMarginSize'             => 1,
		'levelFourLILeftRightMarginType'             => 'px',
		'levelFourLILeftRightMarginSize'             => 6,
		'levelFourLIBorderThicknessLeft'             => 0,
		'levelFourLIBorderThicknessRight'            => 0,
		'levelFourLIBorderThicknessUp'               => 0,
		'levelFourLIBorderThicknessDown'             => 0,
		'levelFourLIBorderRadius'                    => 0,
		'levelFourLIBorderColor'                     => '#6C656D',

		// Number / Icon
		'levelFourStyleTypeFontSizeType'             => 'em',
		'levelFourStyleTypeFontSizeDesktop'          => 1,
		'levelFourStyleTypeFontSizeMobile'           => 1,
		'levelFourStyleTypeFontSizeTablet'           => 1,
		'levelFourStyleTypeTextPrefix'               => '',
		'levelFourStyleType'                         => 'inherit',
		'levelFourStyleTypeTopBottomPaddingType'     => 'px',
		'levelFourStyleTypeTopBottomPaddingSize'     => 5,
		'levelFourStyleTypeLeftRightPaddingType'     => 'px',
		'levelFourStyleTypeLeftRightPaddingSize'     => 5,
		'levelFourStyleTypeTopBottomMarginType'      => 'px',
		'levelFourStyleTypeTopBottomMarginSize'      => 1,
		'levelFourStyleTypeLeftMarginType'           => 'px',
		'levelFourStyleTypeLeftMarginSize'           => -61,
		'levelFourStyleTypeRightMarginType'          => 'px',
		'levelFourStyleTypeRightMarginSize'          => 6,
		'levelFourStyleTypeTextColor'                => '#ffffff',
		'levelFourStyleTypeBackgroundColor'          => '#474745',
		'levelFourStyleTypeBorderRadius'             => 30,
		'levelFourStyleTypeBorderThickness'          => 0,
		'levelFourStyleTypeBorderColor'              => '#6C656D',

		// Level 5: List ----------------------------------------------------------/

		// Ol
		'levelFiveOLPaddingType'                     => 'px',
		'levelFiveOLPaddingSize'                     => 1,
		'levelFiveOLMarginType'                      => 'px',
		'levelFiveOLMarginSize'                      => 1,
		'levelFiveOLBackgroundColor'                 => '#FFFFFF',

		// Li
		'levelFiveLITextColor'                       => '#000000',
		'levelFiveLIBackgroundColor'                 => '#fafafa',
		'levelFiveLIFontSizeType'                    => 'px',
		'levelFiveLIFontSizeDesktop'                 => 16,
		'levelFiveLIFontSizeMobile'                  => 16,
		'levelFiveLIFontSizeTablet'                  => 16,
		'levelFiveLILineHeightType'                  => 'em',
		'levelFiveLILineHeightSize'                  => 2,
		'levelFiveLITopBottomPaddingType'            => 'px',
		'levelFiveLITopBottomPaddingSize'            => 1,
		'levelFiveLILeftRightPaddingType'            => 'px',
		'levelFiveLILeftPaddingSize'                 => 60,
		'levelFiveLIRightPaddingSize'                => 0,
		'levelFiveLITopBottomMarginType'             => 'px',
		'levelFiveLITopBottomMarginSize'             => 1,
		'levelFiveLILeftRightMarginType'             => 'px',
		'levelFiveLILeftRightMarginSize'             => 1,
		'levelFiveLIBorderThicknessLeft'             => 0,
		'levelFiveLIBorderThicknessRight'            => 0,
		'levelFiveLIBorderThicknessUp'               => 0,
		'levelFiveLIBorderThicknessDown'             => 0,
		'levelFiveLIBorderRadius'                    => 0,
		'levelFiveLIBorderColor'                     => '#6C656D',

		// Number / Icon
		'levelFiveStyleTypeFontSizeType'             => 'em',
		'levelFiveStyleTypeFontSizeDesktop'          => 1,
		'levelFiveStyleTypeFontSizeMobile'           => 1,
		'levelFiveStyleTypeFontSizeTablet'           => 1,
		'levelFiveStyleTypeTextPrefix'               => '',
		'levelFiveStyleType'                         => 'inherit',
		'levelFiveStyleTypeTopBottomPaddingType'     => 'px',
		'levelFiveStyleTypeTopBottomPaddingSize'     => 5,
		'levelFiveStyleTypeLeftRightPaddingType'     => 'px',
		'levelFiveStyleTypeLeftRightPaddingSize'     => 5,
		'levelFiveStyleTypeTopBottomMarginType'      => 'px',
		'levelFiveStyleTypeTopBottomMarginSize'      => 1,
		'levelFiveStyleTypeLeftMarginType'           => 'px',
		'levelFiveStyleTypeLeftMarginSize'           => -73,
		'levelFiveStyleTypeRightMarginType'          => 'px',
		'levelFiveStyleTypeRightMarginSize'          => 6,
		'levelFiveStyleTypeTextColor'                => '#ffffff',
		'levelFiveStyleTypeBackgroundColor'          => '#a4a4a4',
		'levelFiveStyleTypeBorderRadius'             => 30,
		'levelFiveStyleTypeBorderThickness'          => 0,
		'levelFiveStyleTypeBorderColor'              => '#6C656D',
	);
}