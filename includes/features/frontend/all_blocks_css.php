<?php
namespace Echo_Doc_Blocks\Includes\features\frontend;

use Echo_Doc_Blocks\Includes\Features\Dynamic\KB_Recent_Articles;
use Echo_Doc_Blocks\Includes\Features\Dynamic\KB_Categories;
use Echo_Doc_Blocks\Includes\Features\Dynamic\KB;

defined( 'ABSPATH' ) || exit();

/**
 * Generate CSS for custom blocks for FRONT END
 */
class All_Blocks_CSS {

	static $section_heading_defaults = array(

		'alignment'                     => 'left',

		// Title
		'level'                         => 2,
		'tagName'                       => 'h2',
		'fontSizeDesktop'               => 2,
		'fontSizeTablet'                => 2,
		'fontSizeMobile'                => 2,
		'fontSizeType'                  => 'em',
		'fontWeight'                    => '700',
		'headingColor'                  => '#373737',

		// Border bottom
		'borderTopStyle'                => 'none',
		'borderTopThickness'            => '2',
		'borderTopWidth'                => '100',
		'borderTopWidthType'            => '%',
		'borderTopPaddingBottomSize'    => 0,
		'borderTopPaddingType'          => 'px',
		'borderTopColor'                => '#00d1b2',

		// Border bottom
		'borderBottomStyle'             => 'solid',
		'borderBottomThickness'         => '2',
		'borderBottomWidth'             => '100',
		'borderBottomWidthType'         => '%',
		'borderBottomPaddingType'       => 'px',
		'borderBottomPaddingTopSize'    => 'px',
		'borderBottomColor'             => '#ddd',

		// Spacing
		'containerMarginTopType'        => 'em',
		'containerMarginTopSize'        => '1',
		'containerMarginBottomType'     => 'em',
		'containerMarginBottomSize'     => '1',

		// Advance
		'htmlAnchor'                    => '',
		'anchorIconVisibility'          => 'none',
		'cssClass'                      => '',
		'cssReset'                      => true
	);

	/**
	 * Get CSS for Section Heading Block
	 *
	 * @param array  $attr The block attributes.
	 * @param string $id The selector ID.
	 * @return array generated CSS
	 */
	public static function get_section_heading_css( $attr, $id ) {

		$attr = array_merge( self::$section_heading_defaults, (array) $attr );

		$prefixClass = '.epbl-section-heading';

		//Title
		$selectors_desktop = array(
			'' => array(
				'text-align'            => $attr['alignment'],
				'margin-top'            => self::get_css_value( $attr['containerMarginTopSize'], $attr['containerMarginTopType'] ),
				'margin-bottom'         => self::get_css_value( $attr['containerMarginBottomSize'], $attr['containerMarginBottomType'] ),
			),
			'  '.$prefixClass.'__title' => array(
				'text-align'            => $attr['alignment'],
				'font-weight'           => $attr['fontWeight'],
				'font-size'             => self::get_css_value( $attr['fontSizeDesktop'], $attr['fontSizeType'] ),
				'color'                 => $attr['headingColor']
			),
			' '.$prefixClass.'__border-top' => array(
				'text-align'            => $attr['alignment'],
				'padding-bottom'        => self::get_css_value( $attr['borderTopPaddingBottomSize'], $attr['borderTopPaddingType'] ),
				'border-top-style'      => $attr['borderTopStyle'],
				'border-top-width'   => $attr['borderTopThickness'].'px',
				'width'                 => self::get_css_value( $attr['borderTopWidth'], $attr['borderTopWidthType'] ),
				'border-color'          => $attr['borderTopColor'],
			),
			' '.$prefixClass.'__border-bottom' => array(
				'text-align'            => $attr['alignment'],
				'padding-top'           => self::get_css_value( $attr['borderBottomPaddingTopSize'], $attr['borderBottomPaddingType'] ),
				'border-bottom-style'   => $attr['borderBottomStyle'],
				'border-bottom-width'   => $attr['borderBottomThickness'].'px',
				'width'                 => self::get_css_value( $attr['borderBottomWidth'], $attr['borderBottomWidthType'] ),
				'border-color'          => $attr['borderBottomColor'],
			),
		);
		$selectors_tablet = array(
			' '.$prefixClass.'__title' => array(
				'font-size' => self::get_css_value( $attr['fontSizeTablet'], $attr['fontSizeType'] ),
			)
		);
		$selectors_smartphone = array(
			' '.$prefixClass.'__title' => array(
				'font-size' => self::get_css_value( $attr['fontSizeMobile'], $attr['fontSizeType'] ),
			)
		);

		$generated_css = array(
			'desktop' => self::generate_css( $selectors_desktop,    '#epbl-section-heading-' . $id ),
			'tablet'  => self::generate_css( $selectors_tablet,     '#epbl-section-heading-' . $id ),
			'mobile'  => self::generate_css( $selectors_smartphone, '#epbl-section-heading-' . $id ),
		);

		return $generated_css;
	}

	/**
	 * Get CSS for KB Recent Articles Block
	 *
	 * @param array  $attr The block attributes.
	 * @param string $id The selector ID.
	 * @return array generated CSS
	 */
	public static function get_kb_recent_articles_css( $attr, $id ) {
		
		$kb_recent_articles_defaults = array();
		
		foreach ( KB_Recent_Articles::get_default_fields() as $name => $arr ) {
			$kb_recent_articles_defaults[$name] = $arr['default'];
		}
		
		$attr = array_merge( $kb_recent_articles_defaults, (array) $attr );
		$prefixClass = '#epbl-kb-article-list-container-' . $attr['block_id'] . ' ';

		$selectors_desktop = array(

			// Container
			'' => array(
				'justify-content'   => $attr['list_alignment'],
				'margin-top'        => self::get_css_value($attr['advancedMarginTop'], 'px'),
				'margin-right'      => self::get_css_value($attr['advancedMarginRight'], 'px'),
				'margin-bottom'     => self::get_css_value($attr['advancedMarginBottom'], 'px'),
				'margin-left'       => self::get_css_value($attr['advancedMarginLeft'], 'px'),
				'padding-top'       => self::get_css_value($attr['advancedPaddingTop'], 'px'),
				'padding-right'     => self::get_css_value($attr['advancedPaddingRight'], 'px'),
				'padding-bottom'    => self::get_css_value($attr['advancedPaddingBottom'], 'px'),
				'padding-left'      => self::get_css_value($attr['advancedPaddingLeft'], 'px'),
				'z-index'           => $attr['advancedZIndex'],
				'border-style'      => $attr['advancedBorderType'],
				'border-top-width'      => self::get_css_value($attr['advancedBorderWidthTop'], 'px', '0px'),
				'border-right-width'      => self::get_css_value($attr['advancedBorderWidthRight'], 'px', '0px'),
				'border-bottom-width'      => self::get_css_value($attr['advancedBorderWidthBottom'], 'px', '0px'),
				'border-left-width'      => self::get_css_value($attr['advancedBorderWidthLeft'], 'px', '0px'),
				'border-color'      => $attr['advancedBorderColor'],
				'border-radius'     => self::get_css_value($attr['advancedBorderRadius'], 'px'),
				'box-shadow' => $attr['advancedBoxShadow']['x'] . 'px ' . $attr['advancedBoxShadow']['y'] . 'px ' . $attr['advancedBoxShadow']['blur'] . 'px ' . $attr['advancedBoxShadow']['spread'] . 'px ' . $attr['advancedBoxShadow']['color'] . ' ' . $attr['advancedBoxShadow']['position'],
			),


			// Title
			' .epbl-kb-article-list-title' => array(
				'justify-content'   => $attr['list_alignment'],
				'padding-top'       => self::get_css_value($attr['title_padding_top'], 'px'),
				'padding-right'     => self::get_css_value($attr['title_padding_right'], 'px'),
				'padding-bottom'    => self::get_css_value($attr['title_padding_bottom'], 'px'),
				'padding-left'      => self::get_css_value($attr['title_padding_left'], 'px'),
				'color'             => $attr['title_color'],
				'background-color'  => $attr['title_backgroundColor'],
				
				'font-weight'       => $attr['title_typography']['weight'],
				'font-family'       => $attr['title_typography']['family'],
				'font-size'         => self::get_css_value( $attr['title_typography']['sizeDesktop'], $attr['title_typography']['sizeUnit'] ),
				'text-transform'    => $attr['title_typography']['transform'],
				'text-decoration'   => $attr['title_typography']['decoration'],
				'font-style'        => $attr['title_typography']['style'],
				'line-height'       => self::get_css_value( $attr['title_typography']['lineHeightDesktop'], $attr['title_typography']['lineHeightUnit'] ),
				'letter-spacing'    => self::get_css_value($attr['title_typography']['letterSpacingDesktop'], 'px'),
			),
			// Item Container
			' .epbl-kb-article-list-items-container' => array(
				'justify-content'   => $attr['list_alignment'],
			),

			// Article Icon container
			' .epbl-kb-article-list-items__item__icon' => array(
				'margin-top'        => self::get_css_value($attr['icon_margin_top'], 'px'),
				'margin-right'      =>self::get_css_value($attr['icon_margin_right'], 'px'),
				'margin-bottom'     => self::get_css_value($attr['icon_margin_bottom'], 'px'),
				'margin-left'       => self::get_css_value($attr['icon_margin_left'], 'px'),
				'padding-top'       =>self::get_css_value($attr['icon_padding_top'], 'px'),
				'padding-right'     => self::get_css_value($attr['icon_padding_right'], 'px'),
				'padding-bottom'    => self::get_css_value($attr['icon_padding_bottom'], 'px'),
				'padding-left'      => self::get_css_value($attr['icon_padding_left'], 'px'),
			),

			// Article Icon
			' .epbl-recent-articles-icon' => array(
				'font-size'         => self::get_css_value($attr['icon_size'], 'px'),
				'color'             => $attr['icon_color'],
			),

			// Article Text
			' .epbl-kb-article-list-items__item__text' => array(
				'color'             => $attr['articleText_color'],
				'font-weight'       => $attr['articleText_typography']['weight'],
				'font-family'       => $attr['articleText_typography']['family'],
				'font-size'         => self::get_css_value( $attr['articleText_typography']['sizeDesktop'], $attr['articleText_typography']['sizeUnit'] ),
				'text-transform'    => $attr['articleText_typography']['transform'],
				'text-decoration'   => $attr['articleText_typography']['decoration'],
				'font-style'        => $attr['articleText_typography']['style'],
				'line-height'       => self::get_css_value( $attr['articleText_typography']['lineHeightDesktop'], $attr['articleText_typography']['lineHeightUnit'] ),
				'letter-spacing'    => self::get_css_value($attr['articleText_typography']['letterSpacingDesktop'], 'px'),
			),

			// Item Anchor
			' .epbl-kb-article-list-items-container .epbl-kb-article-list-items__item a' => array(
				'justify-content'   => $attr['list_alignment'],
				'margin-top'        => self::get_css_value($attr['articleText_margin_top'], 'px'),
				'margin-right'      => self::get_css_value($attr['articleText_margin_right'], 'px'),
				'margin-bottom'     => self::get_css_value($attr['articleText_margin_bottom'], 'px'),
				'margin-left'       => self::get_css_value($attr['articleText_margin_left'], 'px'),
				'padding-top'       => self::get_css_value($attr['articleText_padding_top'], 'px'),
				'padding-right'     => self::get_css_value($attr['articleText_padding_right'], 'px'),
				'padding-bottom'    => self::get_css_value($attr['articleText_padding_bottom'], 'px'),
				'padding-left'      => self::get_css_value($attr['articleText_padding_left'], 'px'),
				'color'             => $attr['articleText_color'],
				'background-color'  => $attr['articleText_backgroundColor'],
				'border-style'      => $attr['articleText_borderType'],
				'border-top-width'      => self::get_css_value($attr['articleText_BorderWidthTop'], 'px', '0px'),
				'border-right-width'      => self::get_css_value($attr['articleText_BorderWidthRight'], 'px', '0px'),
				'border-bottom-width'      => self::get_css_value($attr['articleText_BorderWidthBottom'], 'px', '0px'),
				'border-left-width'      => self::get_css_value($attr['articleText_BorderWidthLeft'], 'px', '0px'),
				'border-color'      => $attr['articleText_BorderColor'],
				'border-radius'     => self::get_css_value($attr['articleText_BorderRadius'], 'px'),
			),

			// Hover
			' .epbl-kb-article-list-items-container .epbl-kb-article-list-items__item a:hover' => array(
				'background-color'  => $attr['articleText_backgroundColorHover'],
				'color'             => $attr['articleText_colorHover'],
			),
			
			' .epbl-kb-article-list-items-container .epbl-kb-article-list-items__item a:hover .epbl-kb-article-list-items__item__icon .epbl-recent-articles-icon' => array(
				'color'             => $attr['icon_colorHover'],
			),


		);
		
		$selectors_desktop['']['display'] = ( $attr['hideOnDesktop'] === true ) ? 'none' : 'block';
		$selectors_tablet['']['display'] = ( $attr['hideOnTablet'] === true ) ? 'none' : 'block';
		$selectors_smartphone['']['display'] = ( $attr['hideOnMobile'] === true ) ? 'none' : 'block';

		$selectors_tablet[' .epbl-kb-article-list-title'] = array(
			'font-size'         => self::get_css_value( $attr['title_typography']['sizeTablet'], $attr['title_typography']['sizeUnit'] ),
			'line-height'       => self::get_css_value( $attr['title_typography']['lineHeightTablet'], $attr['title_typography']['lineHeightUnit'] ),
			'letter-spacing'    => self::get_css_value($attr['title_typography']['letterSpacingTablet'], 'px'),
		);

		$selectors_smartphone[' .epbl-kb-article-list-title'] = array(
			'font-size'         => self::get_css_value( $attr['title_typography']['sizeMobile'], $attr['title_typography']['sizeUnit'] ),
			'line-height'       => self::get_css_value( $attr['title_typography']['lineHeightMobile'], $attr['title_typography']['lineHeightUnit'] ),
			'letter-spacing'    => self::get_css_value($attr['title_typography']['letterSpacingMobile'], 'px'),
		);
		
		$import = '';
		
		if ( $attr['title_typography']['family'] ) {
			$import .= "@import url('https://fonts.googleapis.com/css2?family=" . str_replace( ' ', '+', $attr['title_typography']['family'] ) . "'); ";
		}
		
		if ( $attr['articleText_typography']['family'] ) {
			$import .= "@import url('https://fonts.googleapis.com/css2?family=" . str_replace( ' ', '+', $attr['articleText_typography']['family'] ) . "'); ";
		}
		
		$generated_css = array(
			'desktop' => self::generate_css( $selectors_desktop,    '#epbl-kb-article-list-container-' . $id ),
			'tablet'  => self::generate_css( $selectors_tablet,     '#epbl-kb-article-list-container-' . $id ),
			'mobile'  => self::generate_css( $selectors_smartphone, '#epbl-kb-article-list-container-' . $id ),
			'import' => $import
		);
		return $generated_css;
	}

	/**
	 * Get CSS for KB Categories Block
	 *
	 * @param array  $attr The block attributes.
	 * @param string $id The selector ID.
	 * @return array generated CSS
	 */
	
	public static function get_kb_categories_css( $attr, $id ) {
		
		$kb_categories_defaults = array();
		
		foreach ( KB_Categories::get_default_fields() as $name => $arr ) {
			$kb_categories_defaults[$name] = $arr['default'];
		}
		
		$attr = array_merge( $kb_categories_defaults, (array) $attr );
		$prefixClass = '#epbl-kb-categories-container-' . $attr['block_id'] . ' ';
		
		$selectors_desktop = array(

			// Container
			'' => array(
				'margin-top'        => self::get_css_value($attr['advancedMarginTop'], 'px'),
				'margin-right'      => self::get_css_value($attr['advancedMarginRight'], 'px'),
				'margin-bottom'     => self::get_css_value($attr['advancedMarginBottom'], 'px'),
				'margin-left'       => self::get_css_value($attr['advancedMarginLeft'], 'px'),
				'padding-top'       => self::get_css_value($attr['advancedPaddingTop'], 'px'),
				'padding-right'     => self::get_css_value($attr['advancedPaddingRight'], 'px'),
				'padding-bottom'    => self::get_css_value($attr['advancedPaddingBottom'], 'px'),
				'padding-left'      => self::get_css_value($attr['advancedPaddingLeft'], 'px'),
				'z-index'           => $attr['advancedZIndex'],
				'border-style'      => $attr['advancedBorderType'],
				'border-top-width'      => self::get_css_value($attr['advancedBorderWidthTop'], 'px', '0px'),
				'border-right-width'      => self::get_css_value($attr['advancedBorderWidthRight'], 'px', '0px'),
				'border-bottom-width'      => self::get_css_value($attr['advancedBorderWidthBottom'], 'px', '0px'),
				'border-left-width'      => self::get_css_value($attr['advancedBorderWidthLeft'], 'px', '0px'),
				'border-color'      => $attr['advancedBorderColor'],
				'border-radius'     => self::get_css_value($attr['advancedBorderRadius'], 'px'),
				'box-shadow' => $attr['advancedBoxShadow']['x'] . 'px ' . $attr['advancedBoxShadow']['y'] . 'px ' . $attr['advancedBoxShadow']['blur'] . 'px ' . $attr['advancedBoxShadow']['spread'] . 'px ' . $attr['advancedBoxShadow']['color'] . ' ' . $attr['advancedBoxShadow']['position'],
			),
			
			' .epbl-kb-cat-list-item__item:not(:first-child)' => array(
				'padding-top' => self::get_css_value($attr['list_paddingTopBottom']/2, 'px'),
			),
			
			' .epbl-kb-cat-list-item__item .epbl-kb-cat-list-items__item__icon' => array(
				'padding-top' => self::get_css_value($attr['icon_padding']['top'], 'px'),
				'padding-right' => self::get_css_value($attr['icon_padding']['right'], 'px'),
				'padding-bottom' => self::get_css_value($attr['icon_padding']['bottom'], 'px'),
				'padding-left' => self::get_css_value($attr['icon_padding']['left'], 'px'),
				'margin-top' => self::get_css_value($attr['icon_margin']['top'], 'px'),
				'margin-right' => self::get_css_value($attr['icon_margin']['right'], 'px'),
				'margin-bottom' => self::get_css_value($attr['icon_margin']['bottom'], 'px'),
				'margin-left' => self::get_css_value($attr['icon_margin']['left'], 'px'),
			),
			
			' .epbl-kb-cat-list-item__item .epbl-kb-cat-list-items__item__icon i' => array(
				'color' => $attr['icon_color'],
				'font-size' => self::get_css_value($attr['icon_size'], 'px'),
			),
			
			' .epbl-kb-cat-list-item__item .epbl-kb-cat-list-items__item__icon img' => array(
				'max-height' => self::get_css_value($attr['icon_size'], 'px'),
			),
			
			' .epbl-kb-cat-list-item__item a:hover .epbl-kb-cat-list-items__item__icon i' => array(
				'color' => $attr['icon_colorHover'],
			),
			
			' .epbl-kb-cat-list-item__item a:hover .epbl-kb-cat-list-items__item__text' => array(
				'color' => $attr['text_colorHover'],
			),
			
			' .epbl-kb-cat-list-item__item .epbl-kb-cat-list-items__item__text' => array(
				'padding-left' => self::get_css_value($attr['text_indent'], 'px'),
				'color' => $attr['text_color'],
			),
			
			' .epbl-kb-cat-list-item__item a' => array(
				'color' => $attr['text_color'],
			),
			
			' .epbl-kb-cat-list-item__item a:hover' => array(
				'color' => $attr['text_colorHover'],
			),

			' .epbl-kb-cat-list-title' => array(
				'font-weight'       => $attr['title_typography']['weight'],
				'font-family'       => $attr['title_typography']['family'],
				'font-size'         => self::get_css_value( $attr['title_typography']['sizeDesktop'], $attr['title_typography']['sizeUnit'] ),
				'text-transform'    => $attr['title_typography']['transform'],
				'text-decoration'   => $attr['title_typography']['decoration'],
				'font-style'        => $attr['title_typography']['style'],
				'line-height'       => self::get_css_value( $attr['title_typography']['lineHeightDesktop'], $attr['title_typography']['lineHeightUnit'] ),
				'letter-spacing'    => self::get_css_value($attr['title_typography']['letterSpacingDesktop'], 'px'),
				'padding-top' => self::get_css_value($attr['title_padding']['top'], 'px'),
				'padding-right' => self::get_css_value($attr['title_padding']['right'], 'px'),
				'padding-bottom' => self::get_css_value($attr['title_padding']['bottom'], 'px'),
				'padding-left' => self::get_css_value($attr['title_padding']['left'], 'px'),
				'color'       => $attr['title_color'],
				'background-color'       => $attr['title_background'],
			),

			' .epbl-kb-cat-list-item__item' => array(
				'padding-bottom' => self::get_css_value($attr['list_paddingTopBottom']/2, 'px'),
				'font-weight'       => $attr['text_typography']['weight'],
				'font-family'       => $attr['text_typography']['family'],
				'font-size'         => self::get_css_value( $attr['text_typography']['sizeDesktop'], $attr['text_typography']['sizeUnit'] ),
				'text-transform'    => $attr['text_typography']['transform'],
				'text-decoration'   => $attr['text_typography']['decoration'],
				'font-style'        => $attr['text_typography']['style'],
				'line-height'       => self::get_css_value( $attr['text_typography']['lineHeightDesktop'], $attr['text_typography']['lineHeightUnit'] ),
				'letter-spacing'    => self::get_css_value($attr['text_typography']['letterSpacingDesktop'], 'px'),
			),
			
		);
		
		if ( $attr['list_borderBottomToggle'] === true ) {
			
			$selectors_desktop[' .epbl-kb-cat-list-item__item:not(:last-child):after '] = array(
				'content' => "''",
				'border-bottom-style' => $attr['list_borderStyle'],
				'border-bottom-width' => self::get_css_value($attr['list_borderWidth'], 'px'),
				'border-color' => $attr['list_borderColor']
			);
		}
		
		$selectors_desktop['']['display'] = ( $attr['hideOnDesktop'] === true ) ? 'none' : 'block';
		$selectors_tablet['']['display'] = ( $attr['hideOnTablet'] === true ) ? 'none' : 'block';
		$selectors_smartphone['']['display'] = ( $attr['hideOnMobile'] === true ) ? 'none' : 'block';

		$selectors_tablet[' .epbl-kb-cat-list-title'] = array(
			'font-size'         => self::get_css_value( $attr['title_typography']['sizeTablet'], $attr['title_typography']['sizeUnit'] ),
			'line-height'       => self::get_css_value( $attr['title_typography']['lineHeightTablet'], $attr['title_typography']['lineHeightUnit'] ),
			'letter-spacing'    => self::get_css_value($attr['title_typography']['letterSpacingTablet'], 'px'),
		);

		$selectors_smartphone[' .epbl-kb-cat-list-title'] = array(
			'font-size'         => self::get_css_value( $attr['title_typography']['sizeMobile'], $attr['title_typography']['sizeUnit'] ),
			'line-height'       => self::get_css_value( $attr['title_typography']['lineHeightMobile'], $attr['title_typography']['lineHeightUnit'] ),
			'letter-spacing'    => self::get_css_value($attr['title_typography']['letterSpacingMobile'], 'px'),
		);
		
		$selectors_tablet[' .epbl-kb-cat-list-item__item'] = array(
			'font-size'         => self::get_css_value( $attr['text_typography']['sizeTablet'], $attr['text_typography']['sizeUnit'] ),
			'line-height'       => self::get_css_value( $attr['text_typography']['lineHeightTablet'], $attr['text_typography']['lineHeightUnit'] ),
			'letter-spacing'    => self::get_css_value($attr['text_typography']['letterSpacingTablet'], 'px'),
		);

		$selectors_smartphone[' .epbl-kb-cat-list-item__item'] = array(
			'font-size'         => self::get_css_value( $attr['text_typography']['sizeMobile'], $attr['text_typography']['sizeUnit'] ),
			'line-height'       => self::get_css_value( $attr['text_typography']['lineHeightMobile'], $attr['text_typography']['lineHeightUnit'] ),
			'letter-spacing'    => self::get_css_value($attr['text_typography']['letterSpacingMobile'], 'px'),
		);
		
		$import = '';
		
		if ( $attr['title_typography']['family'] ) {
			$import .= "@import url('https://fonts.googleapis.com/css2?family=" . str_replace( ' ', '+', $attr['title_typography']['family'] ) . "'); ";
		}
		
		if ( $attr['text_typography']['family'] ) {
			$import .= "@import url('https://fonts.googleapis.com/css2?family=" . str_replace( ' ', '+', $attr['text_typography']['family'] ) . "'); ";
		}
		
		$generated_css = array(
			'desktop' => self::generate_css( $selectors_desktop,    '#epbl-kb-categories-container-' . $id ),
			'tablet'  => self::generate_css( $selectors_tablet,     '#epbl-kb-categories-container-' . $id ),
			'mobile'  => self::generate_css( $selectors_smartphone, '#epbl-kb-categories-container-' . $id ),
			'import' => $import
		);
		
		return $generated_css;
	}
	
	/**
	 * Get CSS for KB
	 *
	 * @param array  $attr The block attributes.
	 * @param string $id The selector ID.
	 * @return array generated CSS
	 */
	
	public static function get_kb_css( $attr, $id ) {
		
		$kb_defaults = array();
		
		foreach ( KB::get_default_fields() as $name => $arr ) {
			$kb_defaults[$name] = $arr['default'];
		}
		
		$attr = array_merge( $kb_defaults, (array) $attr );
		$prefixClass = '#epbl-knowledge-base-' . $attr['block_id'] . ' ';
		
		$selectors_desktop = array(

			// Container
			'' => array(
				'margin-top'        => self::get_css_value($attr['advancedMarginTop'], 'px'),
				'margin-right'      => self::get_css_value($attr['advancedMarginRight'], 'px'),
				'margin-bottom'     => self::get_css_value($attr['advancedMarginBottom'], 'px'),
				'margin-left'       => self::get_css_value($attr['advancedMarginLeft'], 'px'),
				'padding-top'       => self::get_css_value($attr['advancedPaddingTop'], 'px'),
				'padding-right'     => self::get_css_value($attr['advancedPaddingRight'], 'px'),
				'padding-bottom'    => self::get_css_value($attr['advancedPaddingBottom'], 'px'),
				'padding-left'      => self::get_css_value($attr['advancedPaddingLeft'], 'px'),
				'z-index'           => $attr['advancedZIndex'],
				'border-style'      => $attr['advancedBorderType'],
				'border-top-width'      => self::get_css_value($attr['advancedBorderWidthTop'], 'px', '0px'),
				'border-right-width'      => self::get_css_value($attr['advancedBorderWidthRight'], 'px', '0px'),
				'border-bottom-width'      => self::get_css_value($attr['advancedBorderWidthBottom'], 'px', '0px'),
				'border-left-width'      => self::get_css_value($attr['advancedBorderWidthLeft'], 'px', '0px'),
				'border-color'      => $attr['advancedBorderColor'],
				'border-radius'     => self::get_css_value($attr['advancedBorderRadius'], 'px'),
				'box-shadow' => $attr['advancedBoxShadow']['x'] . 'px ' . $attr['advancedBoxShadow']['y'] . 'px ' . $attr['advancedBoxShadow']['blur'] . 'px ' . $attr['advancedBoxShadow']['spread'] . 'px ' . $attr['advancedBoxShadow']['color'] . ' ' . $attr['advancedBoxShadow']['position'],
			),
			
		);
		
		$selectors_desktop['']['display'] = ( $attr['hideOnDesktop'] === true ) ? 'none' : 'block';
		$selectors_tablet['']['display'] = ( $attr['hideOnTablet'] === true ) ? 'none' : 'block';
		$selectors_smartphone['']['display'] = ( $attr['hideOnMobile'] === true ) ? 'none' : 'block';
		
		$generated_css = array(
			'desktop' => self::generate_css( $selectors_desktop,    '#epbl-knowledge-base-' . $id ),
			'tablet'  => self::generate_css( $selectors_tablet,     '#epbl-knowledge-base-' . $id ),
			'mobile'  => self::generate_css( $selectors_smartphone, '#epbl-knowledge-base-' . $id ),
		);
		
		return $generated_css;
	}

	static $info_box_defaults = array(

		//Toolbar settings or Editor
		'containerAlignment'                => 'left',
		'headingText'                       =>'Information',

		// General
		'containerWidth'                    => '100',
		'containerWidthType'                => '%',
		'containerMarginSize'               => '10',
		'containerMarginType'               => 'px',
		'containerPaddingSize'              => '20',
		'containerPaddingType'              => 'px',
		'containerBorderLocation'           => 'all',
		'containerBorderThickness'          => 3,
		'containerBorderRadius'             => 4,
		'containerBorderColor'              => '#dedede',

		// Icon
		'iconLocation'                      => 'left',
		'iconType'                          => 'epbl-info-circle',
		'iconColor'                         => '#666666',
		'iconFontSizeDesktop'               => 45,
		'iconFontSizeTablet'                => 40,
		'iconFontSizeMobile'                => 30,
		'iconFontSizeType'                  => 'px',

		// Title
		'headingToggle'                     => true,
		'level'							    => 4,
		'tagName'						    => 'h4',
		'headingFontSizeDesktop'            => 32,
		'headingFontSizeTablet'             => 32,
		'headingFontSizeMobile'             => 32,
		'headingFontSizeType'               => 'px',
		'headingFontWeight'                 => 700,
		'headingPaddingSize'                => 10,
		'headingPaddingType'                => 'px',
		'headingTextColor'                  => '#666666',
		'headingBackgroundColor'            => '#f2f2f2',

		// Body
		'bodyFontSizeDesktop'               => 16,
		'bodyFontSizeTablet'                => 16,
		'bodyFontSizeMobile'                => 16,
		'bodyFontSizeType'                  => 'px',
		'bodyLineHeightSize'                => 2,
		'bodyLineHeightType'                => 'em',
		'bodyTextHeadingAlignmentToggle'    => true,
		'bodyPaddingSize'                   => 10,
		'bodyPaddingType'                   => 'px',
		'bodyTextColor'                     => '#666666',
		'bodyBackgroundColor'               => '#fafafa',

		// Learn More
		'learnMoreType'                     => 'button',
		'learnMoreIconToggle'               => true,
		'learnMoreNewTabToggle'             => false,
		'learnMoreLocationBesideTextToggle' => false,
		'learnMoreURL'                      => '',
		'learnMoreTopBottomPaddingSize'     => 10,
		'learnMoreTopBottomPaddingType'     => 'px',
		'learnMoreLeftRightPaddingSize'     => 20,
		'learnMoreLeftRightPaddingType'     => 'px',
		'learnMoreTopBottomMarginSize'      => 20,
		'learnMoreTopBottomMarginType'      => 'px',
		'learnMoreLeftRightMarginSize'      => 0,
		'learnMoreLeftRightMarginType'      => 'px',
		'learnMoreFontSizeDesktop'          => 16,
		'learnMoreFontSizeTablet'           => 16,
		'learnMoreFontSizeMobile'           => 16,
		'learnMoreFontSizeType'             => 'px',
		'learnMoreBorderThickness'          => 1,
		'learnMoreBorderRadius'             => 4,
		'learnMoreTextColor'                => '#666666',
		'learnMoreTextHoverColor'           => '#676767',
		'learnMoreBorderColor'              => '#dedede',
		'learnMoreBackgroundColor'          => '#f2f2f2',
		'learnMoreBackgroundHoverColor'     => '#f2f2f2',

		// Advanced
		'cssClass'                          => '',
		'cssReset'                          => true
	);

	/**
	 * Get CSS for Info Bbox Block
	 *
	 * @param array  $attr The block attributes.
	 * @param string $id The selector ID.
	 * @return array generated CSS
	 */
	public static function get_info_box_css( $attr, $id ) {

		$attr = array_merge( self::$info_box_defaults, (array) $attr );

		$prefixClass = '.epbl-info-box';

		//Title
		$selectors_desktop = array(
			'' => array(
				'width'             => self::get_css_value( $attr['containerWidth'], $attr['containerWidthType'] ),
				'margin-top'        => self::get_css_value( $attr['containerMarginSize'], $attr['containerMarginType'] ),
				'margin-bottom'     => self::get_css_value( $attr['containerMarginSize'], $attr['containerMarginType'] ),
				'text-align'        => $attr['containerAlignment'],
				'border-radius'     => $attr['containerBorderRadius'].'px',
			),
			' '.$prefixClass.'__icon:before' => array(
				'color'             => $attr['iconColor'],
				'font-size'         => self::get_css_value( $attr['iconFontSizeDesktop'], $attr['iconFontSizeType'] ),
			),
			' '.$prefixClass.'__header' => array(
				'background-color'  => $attr['headingBackgroundColor'],
				'padding-top'       => self::get_css_value( $attr['headingPaddingSize'], $attr['headingPaddingType'] ),
				'padding-bottom'    => self::get_css_value( $attr['headingPaddingSize'], $attr['headingPaddingType'] ),
				'padding-left'      => self::get_css_value( $attr['containerPaddingSize'], $attr['containerPaddingType'] ),
				'padding-right'     => self::get_css_value( $attr['containerPaddingSize'], $attr['containerPaddingType'] ),
			),
			' '.$prefixClass.'__header__title' => array(
				'color'             => $attr['headingTextColor'],
				'font-weight'       => $attr['headingFontWeight'],
				'font-size'         => self::get_css_value( $attr['headingFontSizeDesktop'], $attr['headingFontSizeType'] ),
			),
			' '.$prefixClass.'__body' => array(
				'background-color'  => $attr['bodyBackgroundColor'],
				'padding-top'       => self::get_css_value( $attr['bodyPaddingSize'], $attr['bodyPaddingType'] ),
				'padding-bottom'    => self::get_css_value( $attr['bodyPaddingSize'], $attr['bodyPaddingType'] ),
				'padding-left'      => self::get_css_value( $attr['containerPaddingSize'], $attr['containerPaddingType'] ),
				'padding-right'     => self::get_css_value( $attr['containerPaddingSize'], $attr['containerPaddingType'] ),
			),
			' '.$prefixClass.'__body__text' => array(
				'font-size'         => self::get_css_value( $attr['bodyFontSizeDesktop'], $attr['bodyFontSizeType'] ),
				'line-height'       => self::get_css_value( $attr['bodyLineHeightSize'], $attr['bodyLineHeightType'] ),
				'color'             => $attr['bodyTextColor'],
			),

			//Position Icon relative to body paragraph text.
			' '.$prefixClass.'__body '.$prefixClass.'__icon' => array(
				'top'       => self::get_css_value( $attr['bodyPaddingSize'], $attr['bodyPaddingType'] ),
				'left'       => self::get_css_value( $attr['containerPaddingSize'], $attr['containerPaddingType'] ),
			),
			' '.$prefixClass.'__body__learn-more-btn' => array(
				'padding-top'       => self::get_css_value( $attr['learnMoreTopBottomPaddingSize'], $attr['learnMoreTopBottomPaddingType'] ),
				'padding-bottom'    => self::get_css_value( $attr['learnMoreTopBottomPaddingSize'], $attr['learnMoreTopBottomPaddingType'] ),
				'padding-left'      => self::get_css_value( $attr['learnMoreLeftRightPaddingSize'], $attr['learnMoreLeftRightPaddingType'] ),
				'padding-right'     => self::get_css_value( $attr['learnMoreLeftRightPaddingSize'], $attr['learnMoreLeftRightPaddingType'] ),
				'margin-top'        => self::get_css_value( $attr['learnMoreTopBottomMarginSize'], $attr['learnMoreTopBottomMarginType'] ),
				'margin-bottom'     => self::get_css_value( $attr['learnMoreTopBottomMarginSize'], $attr['learnMoreTopBottomMarginType'] ),
				'margin-left'       => self::get_css_value( $attr['learnMoreLeftRightMarginSize'], $attr['learnMoreLeftRightMarginType'] ),
				'margin-right'      => self::get_css_value( $attr['learnMoreLeftRightMarginSize'], $attr['learnMoreLeftRightMarginType'] ),
				'border-width'      => $attr['learnMoreBorderThickness'].'px',
				'border-radius'     => $attr['learnMoreBorderRadius'].'px',
				'border-color'      => $attr['learnMoreBorderColor'],
				'background-color'  => $attr['learnMoreBackgroundColor'],
			),
			' '.$prefixClass.'__body__learn-more-btn:hover' => array(
				'background-color'  => $attr['learnMoreBackgroundHoverColor'],
				"cursor"            => 'pointer',
			),
			' '.$prefixClass.'__body__learn-more-btn__text' => array(
				'color'             => $attr['learnMoreTextColor'],
				'font-size'         => self::get_css_value( $attr['learnMoreFontSizeDesktop'], $attr['learnMoreFontSizeType'] ),
			),
			' '.$prefixClass.'__body__learn-more-btn:hover '.$prefixClass.'__body__learn-more-btn__text' => array(
				'color'             => $attr['learnMoreTextHoverColor'],
			),
			' .epbl-external-link:before' => array(
				'color'             => $attr['learnMoreTextColor'],
				'font-size'         => self::get_css_value( $attr['learnMoreFontSizeDesktop'], $attr['learnMoreFontSizeType'] ),
			)
		);
		// If heading is off, add additional left padding to the body to compensate for the icon and it's size.
		if (  $attr['headingToggle'] === false && $attr['iconLocation'] == 'left' ) {

			if ( $attr['iconFontSizeType'] === 'em' ) {
				$extraLeftPadding = $attr['containerPaddingSize']+$attr['containerPaddingSize']+($attr['iconFontSizeDesktop']*16);
			} else {
				$extraLeftPadding = $attr['containerPaddingSize']+$attr['containerPaddingSize']+$attr['iconFontSizeDesktop'];
			}
			$selectors_desktop[' '.$prefixClass.'__body']['padding-left'] = self::get_css_value( $extraLeftPadding, $attr['containerPaddingType'] );

		} else {

			//Heading is active
			//If Icon is located on the left then add some additional space between the icon and the heading.
			if (  $attr['iconLocation'] == 'left' ) {

				//And toggle to align with body is not active
				if (  $attr['bodyTextHeadingAlignmentToggle'] === false ) {
					$selectors_desktop[' '.$prefixClass.'__header__title']['padding-left'] = '10px';
				}
			}

			//If toggle is on, to align the body text with the heading text
			if (  $attr['bodyTextHeadingAlignmentToggle'] ) {

				if ( $attr['iconFontSizeType'] === 'em' ) {
					$extraLeftPadding = $attr['containerPaddingSize']+($attr['iconFontSizeDesktop']*16);
				} else {
					$extraLeftPadding = $attr['containerPaddingSize']+$attr['iconFontSizeDesktop'];
				}

				$selectors_desktop[' '.$prefixClass.'__icon']['width'] = self::get_css_value( $attr['iconFontSizeDesktop'], 'px' );
				$selectors_desktop[' '.$prefixClass.'__body']['padding-left'] = self::get_css_value( $extraLeftPadding, $attr['containerPaddingType'] );
			}
		}

		if ( $attr['containerBorderLocation'] == 'all' ) {
			$selectors_desktop['']['border-color'] = $attr['containerBorderColor'];
			$selectors_desktop['']['border-style'] = 'solid';
			$selectors_desktop['']['border-width'] = $attr['containerBorderThickness'].'px';

		} elseif ( $attr['containerBorderLocation'] == 'left' ) {
			$selectors_desktop['']['border-color'] = $attr['containerBorderColor'];
			$selectors_desktop['']['border-left-style'] = 'solid';
			$selectors_desktop['']['border-left-width'] = $attr['containerBorderThickness'].'px';
		} elseif ( $attr['containerBorderLocation'] == 'right' ) {
			$selectors_desktop['']['border-color'] = $attr['containerBorderColor'];
			$selectors_desktop['']['border-right-style'] = 'solid';
			$selectors_desktop['']['border-right-width'] = $attr['containerBorderThickness'].'px';
		}
		if ( $attr['learnMoreType'] == 'button' ) {
			$selectors_desktop[' '.$prefixClass.'__body__learn-more-btn']['border-style'] = 'solid';
	    }

		$selectors_tablet = array(
			' '.$prefixClass.'__icon:before' => array(
				'font-size'         => self::get_css_value( $attr['iconFontSizeTablet'], $attr['iconFontSizeType'] ),
			),
			' '.$prefixClass.'__header__title' => array(
				'font-size'         => self::get_css_value( $attr['headingFontSizeTablet'], $attr['headingFontSizeType'] ),
			),
			' '.$prefixClass.'__body__text' => array(
				'font-size'         => self::get_css_value( $attr['bodyFontSizeTablet'], $attr['bodyFontSizeType'] ),
			),
			' '.$prefixClass.'__body__learn-more-btn__text' => array(
				'font-size'         => self::get_css_value( $attr['learnMoreFontSizeTablet'], $attr['learnMoreFontSizeType'] ),
			),
			' .epbl-external-link:before' => array(
				'font-size'         => self::get_css_value( $attr['learnMoreFontSizeTablet'], $attr['learnMoreFontSizeType'] ),
			),
		);
		$selectors_mobile = array(
			' '.$prefixClass.'__icon:before' => array(
				'font-size'         => self::get_css_value( $attr['iconFontSizeMobile'], $attr['iconFontSizeType'] ),
			),
			' '.$prefixClass.'__header__title' => array(
				'font-size'         => self::get_css_value( $attr['headingFontSizeMobile'], $attr['headingFontSizeType'] ),
			),
			' '.$prefixClass.'__body__text' => array(
				'font-size'         => self::get_css_value( $attr['bodyFontSizeMobile'], $attr['bodyFontSizeType'] ),
			),
			' '.$prefixClass.'__body__learn-more-btn__text' => array(
				'font-size'         => self::get_css_value( $attr['learnMoreFontSizeMobile'], $attr['learnMoreFontSizeType'] ),
			),
			' .epbl-external-link:before' => array(
				'font-size'         => self::get_css_value( $attr['learnMoreFontSizeMobile'], $attr['learnMoreFontSizeType'] ),
			),
		);

		$generated_css = array(
			'desktop'   => self::generate_css( $selectors_desktop, '#epbl-info-box-' . $id ),
			'tablet'    => self::generate_css( $selectors_tablet, '#epbl-info-box-' . $id ),
			'mobile'    => self::generate_css( $selectors_mobile, '#epbl-info-box-' . $id ),
		);

		return $generated_css;
	}

	static $multiple_lists_defaults = array(

		/*
		Note: If you change these values make sure you change the values in multiple-lists\blocks.js to match these.
		In the attributes
		 */
		// Level 1: List ----------------------------------------------------------/

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
		'levelOneStyleTypeFontSizeType'             => 'px',
		'levelOneStyleTypeFontSizeDesktop'          => 21,
		'levelOneStyleTypeFontSizeMobile'           => 21,
		'levelOneStyleTypeFontSizeTablet'           => 21,
		'levelOneStyleTypeTextPrefix'               => '',
		'levelOneStyleType'                         => 'disc',
		'levelOneStyleTypeTopBottomPaddingType'     => 'px',
		'levelOneStyleTypeTopBottomPaddingSize'     => 0,
		'levelOneStyleTypeLeftRightPaddingType'     => 'px',
		'levelOneStyleTypeLeftRightPaddingSize'     => 0,
		'levelOneStyleTypeTopBottomMarginType'      => 'px',
		'levelOneStyleTypeTopBottomMarginSize'      => -1,
		'levelOneStyleTypeLeftMarginType'           => 'px',
		'levelOneStyleTypeLeftMarginSize'           => -15,
		'levelOneStyleTypeRightMarginType'          => 'px',
		'levelOneStyleTypeRightMarginSize'          => 6,
		'levelOneStyleTypeTextColor'                => '#000000',
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
		'levelTwoLITextColor'                       => '#000000',
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
		'levelTwoStyleTypeFontSizeType'             => 'px',
		'levelTwoStyleTypeFontSizeDesktop'          => 9,
		'levelTwoStyleTypeFontSizeMobile'           => 9,
		'levelTwoStyleTypeFontSizeTablet'           => 9,
		'levelTwoStyleTypeTextPrefix'               => '',
		'levelTwoStyleType'                         => 'square',
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
		'levelTwoStyleTypeTextColor'                => '#000000',
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
		'levelThreeLITextColor'                       => '#000000',
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
		'levelThreeLILeftRightMarginSize'             => 20,
		'levelThreeLIBorderThicknessLeft'             => 0,
		'levelThreeLIBorderThicknessRight'            => 0,
		'levelThreeLIBorderThicknessUp'               => 0,
		'levelThreeLIBorderThicknessDown'             => 0,
		'levelThreeLIBorderRadius'                    => 0,
		'levelThreeLIBorderColor'                     => '#6C656D',

		// Number / Icon
		'levelThreeStyleTypeFontSizeType'             => 'px',
		'levelThreeStyleTypeFontSizeDesktop'          => 16,
		'levelThreeStyleTypeFontSizeMobile'           => 16,
		'levelThreeStyleTypeFontSizeTablet'           => 16,
		'levelThreeStyleTypeTextPrefix'               => '',
		'levelThreeStyleType'                         => 'circle',
		'levelThreeStyleTypeTopBottomPaddingType'     => 'px',
		'levelThreeStyleTypeTopBottomPaddingSize'     => 0,
		'levelThreeStyleTypeLeftRightPaddingType'     => 'px',
		'levelThreeStyleTypeLeftRightPaddingSize'     => 0,
		'levelThreeStyleTypeTopBottomMarginType'      => 'px',
		'levelThreeStyleTypeTopBottomMarginSize'      => -1,
		'levelThreeStyleTypeLeftMarginType'           => 'px',
		'levelThreeStyleTypeLeftMarginSize'           => -15,
		'levelThreeStyleTypeRightMarginType'          => 'px',
		'levelThreeStyleTypeRightMarginSize'          => 6,
		'levelThreeStyleTypeTextColor'                => '#000000',
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
		'levelFourLILeftRightMarginSize'             => 10,
		'levelFourLIBorderThicknessLeft'             => 0,
		'levelFourLIBorderThicknessRight'            => 0,
		'levelFourLIBorderThicknessUp'               => 0,
		'levelFourLIBorderThicknessDown'             => 0,
		'levelFourLIBorderRadius'                    => 0,
		'levelFourLIBorderColor'                     => '#6C656D',

		// Number / Icon
		'levelFourStyleTypeFontSizeType'             => 'px',
		'levelFourStyleTypeFontSizeDesktop'          => 16,
		'levelFourStyleTypeFontSizeMobile'           => 16,
		'levelFourStyleTypeFontSizeTablet'           => 16,
		'levelFourStyleTypeTextPrefix'               => '',
		'levelFourStyleType'                         => 'disc',
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
		'levelFourStyleTypeTextColor'                => '#000000',
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
		'levelFiveLILeftPaddingSize'                 => 1,
		'levelFiveLIRightPaddingSize'                => 0,
		'levelFiveLITopBottomMarginType'             => 'px',
		'levelFiveLITopBottomMarginSize'             => 1,
		'levelFiveLILeftRightMarginType'             => 'px',
		'levelFiveLILeftRightMarginSize'             => 20,
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
		'levelFiveStyleTypeTextColor'                => '#4f4f4f',
		'levelFiveStyleTypeBackgroundColor'          => '#ffffff',
		'levelFiveStyleTypeBorderRadius'             => 30,
		'levelFiveStyleTypeBorderThickness'          => 0,
		'levelFiveStyleTypeBorderColor'              => '#6C656D',

		'cssClass'                      => '',
		'cssReset'                      => true
	);

	/**
	 * Get CSS for Section Heading Block
	 *
	 * @param array  $attr The block attributes.
	 * @param string $id The selector ID.
	 * @return array generated CSS
	 */
	public static function get_multiple_lists_css( $attr, $id ) {

		$attr = array_merge( self::$multiple_lists_defaults, (array) $attr );
		
		// Level 2 -------------------------------------------------/
		$counter2       = 'levelTwoItem';
		$styleType2     = $attr['levelTwoStyleType'];
		if ( $attr['levelTwoStyleType'] === 'inherit' ) {
			$counter2       = 'levelOneItem';
			$styleType2     = $attr['levelOneStyleType'];
		}

		// Level 3 -------------------------------------------------/
		$counter3       = 'levelThreeItem';
		$styleType3     = $attr['levelThreeStyleType'];
		if ( $attr['levelThreeStyleType'] === 'inherit' ) {

			if ( $attr['levelTwoStyleType'] === 'inherit' ) {
				$counter3       = 'levelOneItem';
				$styleType3     = $attr['levelOneStyleType'];
			} else {
				$counter3       = 'levelTwoItem';
				$styleType3     = $attr['levelTwoStyleType'];
			}
		}

		// Level 4 -------------------------------------------------/
		$counter4       = 'levelFourItem';
		$styleType4     = $attr['levelFourStyleType'];

		if ( $attr['levelFourStyleType'] === 'inherit' ) {

			if ( $attr['levelThreeStyleType'] === 'inherit' ) {

				if ( $attr['levelTwoStyleType'] === 'inherit' ) {
					$counter4       = 'levelOneItem';
					$styleType4     = $attr['levelOneStyleType'];
				} else {
					$counter4       = 'levelTwoItem';
					$styleType4     = $attr['levelTwoStyleType'];
				}

			} else {
				$counter4       = 'levelThreeItem';
				$styleType4     = $attr['levelThreeStyleType'];
			}
		}

		// Level 5 -------------------------------------------------/
		$counter5       = 'levelFiveItem';
		$styleType5     = $attr['levelFiveStyleType'];

		if ( $attr['levelFiveStyleType'] === 'inherit' ) {

			if ( $attr['levelFourStyleType'] === 'inherit' ) {

				if ( $attr['levelThreeStyleType'] === 'inherit' ) {

					if ( $attr['levelTwoStyleType'] === 'inherit' ) {
						$counter5       = 'levelOneItem';
						$styleType5     = $attr['levelOneStyleType'];
					} else {
						$counter5       = 'levelTwoItem';
						$styleType5     = $attr['levelTwoStyleType'];
					}
				} else {
					$counter5       = 'levelThreeItem';
					$styleType5     = $attr['levelThreeStyleType'];
				}
			} else {
				$counter5       = 'levelFourItem';
				$styleType5     = $attr['levelFourStyleType'];
			}
		}



		$selectors_desktop = array(

			// Level 1: --------------------------------------------------------------------------------------/
			' ul ' => array(
				'padding'               => self::get_css_value( $attr['levelOneOLPaddingSize'], $attr['levelOneOLPaddingType'] ),
				'margin'                => self::get_css_value( $attr['levelOneOLMarginSize'], $attr['levelOneOLMarginType'] ),
				'background-color'      => $attr['levelOneOLBackgroundColor'],
				'counter-reset'         => 'levelOneItem',
			),
			' ul li ' => array(
				'color'                 => $attr['levelOneLITextColor'],
				'background-color'      => $attr['levelOneLIBackgroundColor'],
				'list-style-type'       => "none",
				'font-size'             => self::get_css_value( $attr['levelOneLIFontSizeDesktop'], $attr['levelOneLIFontSizeType'] ),
				'line-height'           => self::get_css_value( $attr['levelOneLILineHeightSize'], $attr['levelOneLILineHeightType'] ),
				'padding-top'           => self::get_css_value( $attr['levelOneLITopBottomPaddingSize'], $attr['levelOneLITopBottomPaddingType'] ),
				'padding-bottom'        => self::get_css_value( $attr['levelOneLITopBottomPaddingSize'], $attr['levelOneLITopBottomPaddingType'] ),
				'padding-left'          => self::get_css_value( $attr['levelOneLILeftPaddingSize'], $attr['levelOneLILeftRightPaddingType'] ),
				'padding-right'         => self::get_css_value( $attr['levelOneLIRightPaddingSize'], $attr['levelOneLILeftRightPaddingType'] ),
				'margin-top'            => self::get_css_value( $attr['levelOneLITopBottomMarginSize'], $attr['levelOneLITopBottomMarginType'] ),
				'margin-bottom'         => self::get_css_value( $attr['levelOneLITopBottomMarginSize'], $attr['levelOneLITopBottomMarginType'] ),
				'margin-left'           => self::get_css_value( $attr['levelOneLILeftRightMarginSize'], $attr['levelOneLILeftRightMarginType'] ),
				'margin-right'          => self::get_css_value( $attr['levelOneLILeftRightMarginSize'], $attr['levelOneLILeftRightMarginType'] ),
				'border-left-width'     => $attr['levelOneLIBorderThicknessLeft'].'px',
				'border-right-width'    => $attr['levelOneLIBorderThicknessRight'].'px',
				'border-top-width'      => $attr['levelOneLIBorderThicknessUp'].'px',
				'border-bottom-width'   => $attr['levelOneLIBorderThicknessDown'].'px',
				'border-radius'         => $attr['levelOneLIBorderRadius'].'px',
				'border-color'          => $attr['levelOneLIBorderColor'],
				'border-style'          => "solid",
			),
			' ul li:before ' => array(
				'font-size'             => self::get_css_value( $attr['levelOneStyleTypeFontSizeDesktop'], $attr['levelOneStyleTypeFontSizeType'] ),
				'counter-increment'     => "levelOneItem",
				'content'               => '"'.$attr['levelOneStyleTypeTextPrefix'].'"'.' counters(levelOneItem, ".",'.$attr['levelOneStyleType'].')',
				'padding-top'           => self::get_css_value( $attr['levelOneStyleTypeTopBottomPaddingSize'], $attr['levelOneStyleTypeTopBottomPaddingType'] ),
				'padding-bottom'        => self::get_css_value( $attr['levelOneStyleTypeTopBottomPaddingSize'], $attr['levelOneStyleTypeTopBottomPaddingType'] ),
				'padding-left'          => self::get_css_value( $attr['levelOneStyleTypeLeftRightPaddingSize'], $attr['levelOneStyleTypeLeftRightPaddingType'] ),
				'padding-right'         => self::get_css_value( $attr['levelOneStyleTypeLeftRightPaddingSize'], $attr['levelOneStyleTypeLeftRightPaddingType'] ),
				'margin-top'            => self::get_css_value( $attr['levelOneStyleTypeTopBottomMarginSize'], $attr['levelOneStyleTypeTopBottomMarginType'] ),
				'margin-bottom'         => self::get_css_value( $attr['levelOneStyleTypeTopBottomMarginSize'], $attr['levelOneStyleTypeTopBottomMarginType'] ),
				'margin-left'           => self::get_css_value( $attr['levelOneStyleTypeLeftMarginSize'], $attr['levelOneStyleTypeLeftMarginType'] ),
				'margin-right'          => self::get_css_value( $attr['levelOneStyleTypeRightMarginSize'], $attr['levelOneStyleTypeRightMarginType'] ),
				'color'                 => $attr['levelOneStyleTypeTextColor'],
				'background-color'      => $attr['levelOneStyleTypeBackgroundColor'],
				'border-radius'         => $attr['levelOneStyleTypeBorderRadius'].'px',
				'border-width'          => $attr['levelOneStyleTypeBorderThickness'].'px',
				'border-color'          => $attr['levelOneStyleTypeBorderColor'],
				'border-style'          => "solid",
			),

			// Level 2: --------------------------------------------------------------------------------------/
			' ul > li > ul ' => array(
				'padding'               => self::get_css_value( $attr['levelTwoOLPaddingSize'], $attr['levelTwoOLPaddingType'] ),
				'margin'                => self::get_css_value( $attr['levelTwoOLMarginSize'], $attr['levelTwoOLMarginType'] ),
				'background-color'      => $attr['levelTwoOLBackgroundColor'],
				'counter-reset'         => $counter2,
			),
			' ul > li > ul > li ' => array(
				'color'                 => $attr['levelTwoLITextColor'],
				'background-color'      => $attr['levelTwoLIBackgroundColor'],
				'list-style-type'       => "none",
				'font-size'             => self::get_css_value( $attr['levelTwoLIFontSizeDesktop'], $attr['levelTwoLIFontSizeType'] ),
				'line-height'           => self::get_css_value( $attr['levelTwoLILineHeightSize'], $attr['levelTwoLILineHeightType'] ),
				'padding-top'           => self::get_css_value( $attr['levelTwoLITopBottomPaddingSize'], $attr['levelTwoLITopBottomPaddingType'] ),
				'padding-bottom'        => self::get_css_value( $attr['levelTwoLITopBottomPaddingSize'], $attr['levelTwoLITopBottomPaddingType'] ),
				'padding-left'          => self::get_css_value( $attr['levelTwoLILeftPaddingSize'], $attr['levelTwoLILeftRightPaddingType'] ),
				'padding-right'         => self::get_css_value( $attr['levelTwoLIRightPaddingSize'], $attr['levelTwoLILeftRightPaddingType'] ),
				'margin-top'            => self::get_css_value( $attr['levelTwoLITopBottomMarginSize'], $attr['levelTwoLITopBottomMarginType'] ),
				'margin-bottom'         => self::get_css_value( $attr['levelTwoLITopBottomMarginSize'], $attr['levelTwoLITopBottomMarginType'] ),
				'margin-left'           => self::get_css_value( $attr['levelTwoLILeftRightMarginSize'], $attr['levelTwoLILeftRightMarginType'] ),
				'margin-right'          => self::get_css_value( $attr['levelTwoLILeftRightMarginSize'], $attr['levelTwoLILeftRightMarginType'] ),
				'border-left-width'     => $attr['levelTwoLIBorderThicknessLeft'].'px',
				'border-right-width'    => $attr['levelTwoLIBorderThicknessRight'].'px',
				'border-top-width'      => $attr['levelTwoLIBorderThicknessUp'].'px',
				'border-bottom-width'   => $attr['levelTwoLIBorderThicknessDown'].'px',
				'border-radius'         => $attr['levelTwoLIBorderRadius'].'px',
				'border-color'          => $attr['levelTwoLIBorderColor'],
				'border-style'          => "solid",
			),
			' ul > li > ul > li:before ' => array(
				'font-size'             => self::get_css_value( $attr['levelTwoStyleTypeFontSizeDesktop'], $attr['levelTwoStyleTypeFontSizeType'] ),
				'counter-increment'     => $counter2,
				'content'               => '"'.$attr['levelTwoStyleTypeTextPrefix'].'"'.' counters('.$counter2.', ".",'.$styleType2.')',
				'padding-top'           => self::get_css_value( $attr['levelTwoStyleTypeTopBottomPaddingSize'], $attr['levelTwoStyleTypeTopBottomPaddingType'] ),
				'padding-bottom'        => self::get_css_value( $attr['levelTwoStyleTypeTopBottomPaddingSize'], $attr['levelTwoStyleTypeTopBottomPaddingType'] ),
				'padding-left'          => self::get_css_value( $attr['levelTwoStyleTypeLeftRightPaddingSize'], $attr['levelTwoStyleTypeLeftRightPaddingType'] ),
				'padding-right'         => self::get_css_value( $attr['levelTwoStyleTypeLeftRightPaddingSize'], $attr['levelTwoStyleTypeLeftRightPaddingType'] ),
				'margin-top'            => self::get_css_value( $attr['levelTwoStyleTypeTopBottomMarginSize'], $attr['levelTwoStyleTypeTopBottomMarginType'] ),
				'margin-bottom'         => self::get_css_value( $attr['levelTwoStyleTypeTopBottomMarginSize'], $attr['levelTwoStyleTypeTopBottomMarginType'] ),
				'margin-left'           => self::get_css_value( $attr['levelTwoStyleTypeLeftMarginSize'], $attr['levelTwoStyleTypeLeftMarginType'] ),
				'margin-right'          => self::get_css_value( $attr['levelTwoStyleTypeRightMarginSize'], $attr['levelTwoStyleTypeRightMarginType'] ),
				'color'                 => $attr['levelTwoStyleTypeTextColor'],
				'background-color'      => $attr['levelTwoStyleTypeBackgroundColor'],
				'border-radius'         => $attr['levelTwoStyleTypeBorderRadius'].'px',
				'border-width'          => $attr['levelTwoStyleTypeBorderThickness'].'px',
				'border-color'          => $attr['levelTwoStyleTypeBorderColor'],
				'border-style'          => "solid",
			),

			// Level 3: --------------------------------------------------------------------------------------/
			' ul > li > ul > li > ul ' => array(
				'padding'               => self::get_css_value( $attr['levelThreeOLPaddingSize'], $attr['levelThreeOLPaddingType'] ),
				'margin'                => self::get_css_value( $attr['levelThreeOLMarginSize'], $attr['levelThreeOLMarginType'] ),
				'background-color'      => $attr['levelThreeOLBackgroundColor'],
				'counter-reset'         => $counter3,
			),
			' ul > li > ul > li > ul > li ' => array(
				'color'                 => $attr['levelThreeLITextColor'],
				'background-color'      => $attr['levelThreeLIBackgroundColor'],
				'list-style-type'       => "none",
				'font-size'             => self::get_css_value( $attr['levelThreeLIFontSizeDesktop'], $attr['levelThreeLIFontSizeType'] ),
				'line-height'           => self::get_css_value( $attr['levelThreeLILineHeightSize'], $attr['levelThreeLILineHeightType'] ),
				'padding-top'           => self::get_css_value( $attr['levelThreeLITopBottomPaddingSize'], $attr['levelThreeLITopBottomPaddingType'] ),
				'padding-bottom'        => self::get_css_value( $attr['levelThreeLITopBottomPaddingSize'], $attr['levelThreeLITopBottomPaddingType'] ),
				'padding-left'          => self::get_css_value( $attr['levelThreeLILeftPaddingSize'], $attr['levelThreeLILeftRightPaddingType'] ),
				'padding-right'         => self::get_css_value( $attr['levelThreeLIRightPaddingSize'], $attr['levelThreeLILeftRightPaddingType'] ),
				'margin-top'            => self::get_css_value( $attr['levelThreeLITopBottomMarginSize'], $attr['levelThreeLITopBottomMarginType'] ),
				'margin-bottom'         => self::get_css_value( $attr['levelThreeLITopBottomMarginSize'], $attr['levelThreeLITopBottomMarginType'] ),
				'margin-left'           => self::get_css_value( $attr['levelThreeLILeftRightMarginSize'], $attr['levelThreeLILeftRightMarginType'] ),
				'margin-right'          => self::get_css_value( $attr['levelThreeLILeftRightMarginSize'], $attr['levelThreeLILeftRightMarginType'] ),
				'border-left-width'     => $attr['levelThreeLIBorderThicknessLeft'].'px',
				'border-right-width'    => $attr['levelThreeLIBorderThicknessRight'].'px',
				'border-top-width'      => $attr['levelThreeLIBorderThicknessUp'].'px',
				'border-bottom-width'   => $attr['levelThreeLIBorderThicknessDown'].'px',
				'border-radius'         => $attr['levelThreeLIBorderRadius'].'px',
				'border-color'          => $attr['levelThreeLIBorderColor'],
				'border-style'          => "solid",
			),
			' ul > li > ul > li > ul > li:before ' => array(
				'font-size'             => self::get_css_value( $attr['levelThreeStyleTypeFontSizeDesktop'], $attr['levelThreeStyleTypeFontSizeType'] ),
				'counter-increment'     => $counter3,
				'content'               => '"'.$attr['levelThreeStyleTypeTextPrefix'].'"'.' counters('.$counter3.', ".",'.$styleType3.')',
				'padding-top'           => self::get_css_value( $attr['levelThreeStyleTypeTopBottomPaddingSize'], $attr['levelThreeStyleTypeTopBottomPaddingType'] ),
				'padding-bottom'        => self::get_css_value( $attr['levelThreeStyleTypeTopBottomPaddingSize'], $attr['levelThreeStyleTypeTopBottomPaddingType'] ),
				'padding-left'          => self::get_css_value( $attr['levelThreeStyleTypeLeftRightPaddingSize'], $attr['levelThreeStyleTypeLeftRightPaddingType'] ),
				'padding-right'         => self::get_css_value( $attr['levelThreeStyleTypeLeftRightPaddingSize'], $attr['levelThreeStyleTypeLeftRightPaddingType'] ),
				'margin-top'            => self::get_css_value( $attr['levelThreeStyleTypeTopBottomMarginSize'], $attr['levelThreeStyleTypeTopBottomMarginType'] ),
				'margin-bottom'         => self::get_css_value( $attr['levelThreeStyleTypeTopBottomMarginSize'], $attr['levelThreeStyleTypeTopBottomMarginType'] ),
				'margin-left'           => self::get_css_value( $attr['levelThreeStyleTypeLeftMarginSize'], $attr['levelThreeStyleTypeLeftMarginType'] ),
				'margin-right'          => self::get_css_value( $attr['levelThreeStyleTypeRightMarginSize'], $attr['levelThreeStyleTypeRightMarginType'] ),
				'color'                 => $attr['levelThreeStyleTypeTextColor'],
				'background-color'      => $attr['levelThreeStyleTypeBackgroundColor'],
				'border-radius'         => $attr['levelThreeStyleTypeBorderRadius'].'px',
				'border-width'          => $attr['levelThreeStyleTypeBorderThickness'].'px',
				'border-color'          => $attr['levelThreeStyleTypeBorderColor'],
				'border-style'          => "solid",
			),

			// Level 4: --------------------------------------------------------------------------------------/
			' ul > li > ul > li > ul > li > ul ' => array(
				'padding'               => self::get_css_value( $attr['levelFourOLPaddingSize'], $attr['levelFourOLPaddingType'] ),
				'margin'                => self::get_css_value( $attr['levelFourOLMarginSize'], $attr['levelFourOLMarginType'] ),
				'background-color'      => $attr['levelFourOLBackgroundColor'],
				'counter-reset'         => $counter4,
			),
			' ul > li > ul > li > ul > li > ul > li ' => array(
				'color'                 => $attr['levelFourLITextColor'],
				'background-color'      => $attr['levelFourLIBackgroundColor'],
				'list-style-type'       => "none",
				'font-size'             => self::get_css_value( $attr['levelFourLIFontSizeDesktop'], $attr['levelFourLIFontSizeType'] ),
				'line-height'           => self::get_css_value( $attr['levelFourLILineHeightSize'], $attr['levelFourLILineHeightType'] ),
				'padding-top'           => self::get_css_value( $attr['levelFourLITopBottomPaddingSize'], $attr['levelFourLITopBottomPaddingType'] ),
				'padding-bottom'        => self::get_css_value( $attr['levelFourLITopBottomPaddingSize'], $attr['levelFourLITopBottomPaddingType'] ),
				'padding-left'          => self::get_css_value( $attr['levelFourLILeftPaddingSize'], $attr['levelFourLILeftRightPaddingType'] ),
				'padding-right'         => self::get_css_value( $attr['levelFourLIRightPaddingSize'], $attr['levelFourLILeftRightPaddingType'] ),
				'margin-top'            => self::get_css_value( $attr['levelFourLITopBottomMarginSize'], $attr['levelFourLITopBottomMarginType'] ),
				'margin-bottom'         => self::get_css_value( $attr['levelFourLITopBottomMarginSize'], $attr['levelFourLITopBottomMarginType'] ),
				'margin-left'           => self::get_css_value( $attr['levelFourLILeftRightMarginSize'], $attr['levelFourLILeftRightMarginType'] ),
				'margin-right'          => self::get_css_value( $attr['levelFourLILeftRightMarginSize'], $attr['levelFourLILeftRightMarginType'] ),
				'border-left-width'     => $attr['levelFourLIBorderThicknessLeft'].'px',
				'border-right-width'    => $attr['levelFourLIBorderThicknessRight'].'px',
				'border-top-width'      => $attr['levelFourLIBorderThicknessUp'].'px',
				'border-bottom-width'   => $attr['levelFourLIBorderThicknessDown'].'px',
				'border-radius'         => $attr['levelFourLIBorderRadius'].'px',
				'border-color'          => $attr['levelFourLIBorderColor'],
				'border-style'          => "solid",
			),
			' ul > li > ul > li > ul > li > ul > li:before ' => array(
				'font-size'             => self::get_css_value( $attr['levelFourStyleTypeFontSizeDesktop'], $attr['levelFourStyleTypeFontSizeType'] ),
				'counter-increment'     => $counter4,
				'content'               => '"'.$attr['levelFourStyleTypeTextPrefix'].'"'.' counters('.$counter4.', ".",'.$styleType4.')',
				'padding-top'           => self::get_css_value( $attr['levelFourStyleTypeTopBottomPaddingSize'], $attr['levelFourStyleTypeTopBottomPaddingType'] ),
				'padding-bottom'        => self::get_css_value( $attr['levelFourStyleTypeTopBottomPaddingSize'], $attr['levelFourStyleTypeTopBottomPaddingType'] ),
				'padding-left'          => self::get_css_value( $attr['levelFourStyleTypeLeftRightPaddingSize'], $attr['levelFourStyleTypeLeftRightPaddingType'] ),
				'padding-right'         => self::get_css_value( $attr['levelFourStyleTypeLeftRightPaddingSize'], $attr['levelFourStyleTypeLeftRightPaddingType'] ),
				'margin-top'            => self::get_css_value( $attr['levelFourStyleTypeTopBottomMarginSize'], $attr['levelFourStyleTypeTopBottomMarginType'] ),
				'margin-bottom'         => self::get_css_value( $attr['levelFourStyleTypeTopBottomMarginSize'], $attr['levelFourStyleTypeTopBottomMarginType'] ),
				'margin-left'           => self::get_css_value( $attr['levelFourStyleTypeLeftMarginSize'], $attr['levelFourStyleTypeLeftMarginType'] ),
				'margin-right'          => self::get_css_value( $attr['levelFourStyleTypeRightMarginSize'], $attr['levelFourStyleTypeRightMarginType'] ),
				'color'                 => $attr['levelFourStyleTypeTextColor'],
				'background-color'      => $attr['levelFourStyleTypeBackgroundColor'],
				'border-radius'         => $attr['levelFourStyleTypeBorderRadius'].'px',
				'border-width'          => $attr['levelFourStyleTypeBorderThickness'].'px',
				'border-color'          => $attr['levelFourStyleTypeBorderColor'],
				'border-style'          => "solid",
			),

			// Level 5: --------------------------------------------------------------------------------------/
			' ul > li > ul > li > ul > li > ul > li > ul ' => array(
				'padding'               => self::get_css_value( $attr['levelFiveOLPaddingSize'], $attr['levelFiveOLPaddingType'] ),
				'margin'                => self::get_css_value( $attr['levelFiveOLMarginSize'], $attr['levelFiveOLMarginType'] ),
				'background-color'      => $attr['levelFiveOLBackgroundColor'],
				'counter-reset'         => $counter5,

			),
			' ul > li > ul > li > ul > li > ul > li > ul > li ' => array(
				'color'                 => $attr['levelFiveLITextColor'],
				'background-color'      => $attr['levelFiveLIBackgroundColor'],
				'list-style-type'       => "none",
				'font-size'             => self::get_css_value( $attr['levelFiveLIFontSizeDesktop'], $attr['levelFiveLIFontSizeType'] ),
				'line-height'           => self::get_css_value( $attr['levelFiveLILineHeightSize'], $attr['levelFiveLILineHeightType'] ),
				'padding-top'           => self::get_css_value( $attr['levelFiveLITopBottomPaddingSize'], $attr['levelFiveLITopBottomPaddingType'] ),
				'padding-bottom'        => self::get_css_value( $attr['levelFiveLITopBottomPaddingSize'], $attr['levelFiveLITopBottomPaddingType'] ),
				'padding-left'          => self::get_css_value( $attr['levelFiveLILeftPaddingSize'], $attr['levelFiveLILeftRightPaddingType'] ),
				'padding-right'         => self::get_css_value( $attr['levelFiveLIRightPaddingSize'], $attr['levelFiveLILeftRightPaddingType'] ),
				'margin-top'            => self::get_css_value( $attr['levelFiveLITopBottomMarginSize'], $attr['levelFiveLITopBottomMarginType'] ),
				'margin-bottom'         => self::get_css_value( $attr['levelFiveLITopBottomMarginSize'], $attr['levelFiveLITopBottomMarginType'] ),
				'margin-left'           => self::get_css_value( $attr['levelFiveLILeftRightMarginSize'], $attr['levelFiveLILeftRightMarginType'] ),
				'margin-right'          => self::get_css_value( $attr['levelFiveLILeftRightMarginSize'], $attr['levelFiveLILeftRightMarginType'] ),
				'border-left-width'     => $attr['levelFiveLIBorderThicknessLeft'].'px',
				'border-right-width'    => $attr['levelFiveLIBorderThicknessRight'].'px',
				'border-top-width'      => $attr['levelFiveLIBorderThicknessUp'].'px',
				'border-bottom-width'   => $attr['levelFiveLIBorderThicknessDown'].'px',
				'border-radius'         => $attr['levelFiveLIBorderRadius'].'px',
				'border-color'          => $attr['levelFiveLIBorderColor'],
				'border-style'          => "solid",
			),
			' ul > li > ul > li > ul > li > ul > li > ul > li:before ' => array(
				'font-size'             => self::get_css_value( $attr['levelFiveStyleTypeFontSizeDesktop'], $attr['levelFiveStyleTypeFontSizeType'] ),
				'counter-increment'     => $counter5,
				'content'               => '"'.$attr['levelFiveStyleTypeTextPrefix'].'"'.' counters('.$counter5.', ".",'.$styleType5.')',
				'padding-top'           => self::get_css_value( $attr['levelFiveStyleTypeTopBottomPaddingSize'], $attr['levelFiveStyleTypeTopBottomPaddingType'] ),
				'padding-bottom'        => self::get_css_value( $attr['levelFiveStyleTypeTopBottomPaddingSize'], $attr['levelFiveStyleTypeTopBottomPaddingType'] ),
				'padding-left'          => self::get_css_value( $attr['levelFiveStyleTypeLeftRightPaddingSize'], $attr['levelFiveStyleTypeLeftRightPaddingType'] ),
				'padding-right'         => self::get_css_value( $attr['levelFiveStyleTypeLeftRightPaddingSize'], $attr['levelFiveStyleTypeLeftRightPaddingType'] ),
				'margin-top'            => self::get_css_value( $attr['levelFiveStyleTypeTopBottomMarginSize'], $attr['levelFiveStyleTypeTopBottomMarginType'] ),
				'margin-bottom'         => self::get_css_value( $attr['levelFiveStyleTypeTopBottomMarginSize'], $attr['levelFiveStyleTypeTopBottomMarginType'] ),
				'margin-left'           => self::get_css_value( $attr['levelFiveStyleTypeLeftMarginSize'], $attr['levelFiveStyleTypeLeftMarginType'] ),
				'margin-right'          => self::get_css_value( $attr['levelFiveStyleTypeRightMarginSize'], $attr['levelFiveStyleTypeRightMarginType'] ),
				'color'                 => $attr['levelFiveStyleTypeTextColor'],
				'background-color'      => $attr['levelFiveStyleTypeBackgroundColor'],
				'border-radius'         => $attr['levelFiveStyleTypeBorderRadius'].'px',
				'border-width'          => $attr['levelFiveStyleTypeBorderThickness'].'px',
				'border-color'          => $attr['levelFiveStyleTypeBorderColor'],
				'border-style'          => "solid",
			),

		);





		$generated_css = array(
			'desktop' => self::generate_css( $selectors_desktop, '#epbl-multi-list-' . $id ),
			#'tablet'  => self::generate_css( $selectors_tablet, '##epbl-multi-list-' . $id ),
			#'mobile'  => self::generate_css( $selectors_smartphone, '##epbl-multi-list-' . $id ),
		);

		return $generated_css;
	}

	static $text_image_defaults = array(
		/*'alignment'                     => 'left',
		'fontSizeDesktop'               => 2,
		'fontSizeTablet'                => 2,
		'fontSizeMobile'                => 2,
		'fontSizeType'                  => 'em',
		'fontWeight'                    => '100',*/

		// General
		'textLocation'                      => 'left',
		'containerMarginType'               => 'px',
		'containerMarginSize'               => 10,
		'columnWidthSize'                   => 50,

		// Image - General
		'imageBorderThickness'              => 0,
		'imageBorderRadius'                 => 0,
		'imageBorderColor'                  => '#000000',
		'imageDescriptionLocation'          => 'bottom-image',

		// Image - Zoom
		'imageZoomOnToggle'                 => true,
		'imageZoomTextColor'                => '#212121',
		'imageZoomBorderColor'              => '#cde81f',
		'imageZoomIconColor'                => '#212121',

		// Image - Help text
		'imageDescriptionTextColor'        => '#212121',
		'imageDescriptionBackgroundColor'  => 'rgba(255, 255, 255, 0.53);',
		'imageDescriptionFontSizeType'     => 'px',
		'imageDescriptionTextAlign'        => 'center',
		'imageDescriptionFontSizeDesktop'  => 16,
		'imageDescriptionFontSizeTablet'   => 16,
		'imageDescriptionFontSizeMobile'   => 16,
		'imageDescriptionPadding'          => 20,

		'cssClass'                      => '',
		'cssReset'                      => true
	);

	/**
	 * Get CSS for Text Image Block
	 *
	 * @param array  $attr The block attributes.
	 * @param string $id The selector ID.
	 * @return array generated CSS
	 */
	public static function get_text_image_css( $attr, $id ) {

		$attr = array_merge( self::$text_image_defaults, (array) $attr );

		$prefixClass = '.epbl-textimg';

		$gridTemplateColumns = '';
		if (  $attr['textLocation'] == 'left' ) {
			$gridTemplateColumns =  'auto '.$attr['columnWidthSize'].'%';
		} elseif ( $attr['textLocation'] == 'right' ) {
			$gridTemplateColumns =  $attr['columnWidthSize'].'% auto';
			//gridTemplateColumns =  columnWidthSize+'% auto';
		}

		$helpTextColor = $attr['imageDescriptionBackgroundColor'];
		if ( isset($attr['imageDescriptionBackgroundColor']['rgb']['r'] )) {
			$r = $attr['imageDescriptionBackgroundColor']['rgb']['r'];
			$g = $attr['imageDescriptionBackgroundColor']['rgb']['g'];
			$b = $attr['imageDescriptionBackgroundColor']['rgb']['b'];
			$a = $attr['imageDescriptionBackgroundColor']['rgb']['a'];
			$helpTextColor = 'rgba('.$r.','.$g.','.$b.','.$a.')';
		}

		//Title
		$selectors_desktop = array(
				'' => array(
						'grid-template-columns'   => $gridTemplateColumns,
						'margin-top'            => self::get_css_value( $attr['containerMarginSize'], $attr['containerMarginType'] ),
						'margin-bottom'         => self::get_css_value( $attr['containerMarginSize'], $attr['containerMarginType'] ),
				),
				' '.$prefixClass.'__inner' => array(
					'grid-template-columns'   => $gridTemplateColumns,
				),

				/*
					Based on where the Help text is located will depend how the styling will be applied.

					__figure--help-text-above-image
							- Target Img tag for ( Border attributes )
					__figure--help-text-top-image
							- Target this class for ( Border attributes )
					__figure--help-text-below-image
							- Target Img tag for ( Border attributes )
					__figure--help-text-bottom-image
							- Target this class for ( Border attributes )
			    */

				// ABOVE IMAGE
				' '.$prefixClass.'__figure--zoom-on'.$prefixClass.'__figure--help-text-above-image img:hover' => array(
					'border-color'          => $attr['imageZoomBorderColor'],
				),
				' '.$prefixClass.'__figure--help-text-above-image img' => array(
					'border-radius'         => $attr['imageBorderRadius'].'px',
					'border-width'          => $attr['imageBorderThickness'].'px',
					'border-color'          => $attr['imageBorderColor'],
					'background-color'      => $attr['imageBorderColor'],
					'border-style'          => 'solid'
				),
				// TOP IMAGE
				' '.$prefixClass.'__figure--help-text-top-image img:hover' => array(
					'border-color'          => $attr['imageZoomBorderColor'],
				),
				' '.$prefixClass.'__figure--help-text-top-image' => array(
					'border-radius'         => $attr['imageBorderRadius'].'px',
					'border-width'          => $attr['imageBorderThickness'].'px',
					'border-color'          => $attr['imageBorderColor'],
					'background-color'          => $attr['imageBorderColor'],
				),
				' '.$prefixClass.'__figure--help-text-top-image:hover' => array(
					'border-color'          => $attr['imageZoomBorderColor'],
				),
				// BELOW IMAGE
				' '.$prefixClass.'__figure--help-text-below-image img' => array(
					'border-radius'         => $attr['imageBorderRadius'].'px',
					'border-width'          => $attr['imageBorderThickness'].'px',
					'border-color'          => $attr['imageBorderColor'],
					'background-color'      => $attr['imageBorderColor'],
				),
				' '.$prefixClass.'__figure--zoom-on'.$prefixClass.'__figure--help-text-below-image img:hover' => array(
					'border-color'          => $attr['imageZoomBorderColor'],
				),
				//BOTTOM IMAGE
				' '.$prefixClass.'__figure--help-text-bottom-image' => array(
					'border-radius'         => $attr['imageBorderRadius'].'px',
					'border-width'          => $attr['imageBorderThickness'].'px',
					'border-color'          => $attr['imageBorderColor'],
					'background-color'          => $attr['imageBorderColor'],
				),
				' '.$prefixClass.'__figure--zoom-on'.$prefixClass.'__figure--help-text-bottom-image:hover' => array(
					'border-color'          => $attr['imageZoomBorderColor'],
				),


				' '.$prefixClass.'__figure '.$prefixClass.'__help-text-container' => array(
					'background-color'          => $helpTextColor,
				),
				' '.$prefixClass.'__figure '.$prefixClass.'__help-text__inner' => array(
					'color'                     => $attr['imageDescriptionTextColor'],
					'padding'                   => $attr['imageDescriptionPadding'].'px',
					'text-align'                => $attr['imageDescriptionTextAlign'],
					'font-size'                 => self::get_css_value( $attr['imageDescriptionFontSizeDesktop'], $attr['imageDescriptionFontSizeType'] ),
				),
				' '.$prefixClass.'__zoom-text' => array(
					'color'                     => $attr['imageZoomTextColor'],
				),

				' '.$prefixClass.'__zoom-icon' => array(
						'color'                     => $attr['imageZoomIconColor'],
			),
		);

		/*$selectors_tablet = array(
				' .epbl-section-heading__title' => array(
						'font-size' => self::get_css_value( $attr['fontSizeTablet'], $attr['fontSizeType'] ),
				)
		);
		$selectors_smartphone = array(
				' .epbl-section-heading__title' => array(
						'font-size' => self::get_css_value( $attr['fontSizeMobile'], $attr['fontSizeType'] ),
				)
		);
		*/
		$generated_css = array(
				'desktop' => self::generate_css( $selectors_desktop, '#epbl-textimg-' . $id ),
				//'tablet'  => self::generate_css( $selectors_tablet, '#epbl-section-heading-' . $id ),
				//'mobile'  => self::generate_css( $selectors_smartphone, '#epbl-section-heading-' . $id ),
		);

		return $generated_css;
	}

	static $text_video_defaults = array(
		/*'alignment'                     => 'left',
		'fontSizeDesktop'               => 2,
		'fontSizeTablet'                => 2,
		'fontSizeMobile'                => 2,
		'fontSizeType'                  => 'em',
		'fontWeight'                    => '100',*/

		// General
		'textLocation'                      => 'left',
		'containerMarginType'               => 'px',
		'containerMarginSize'               => 10,
		'columnWidthSize'                   => 50,

		// Video - General
		'videoBorderThickness'              => 0,
		'videoBorderRadius'                 => 0,
		'videoBorderColor'                  => '000000',

		// Video - Zoom
		'videoZoomOnToggle'                 => true,
		'videoZoomTextColor'                => '#212121',
		'videoZoomBorderColor'              => '#cde81f',
		'videoZoomIconColor'                => '#212121',

		// Video - Help text
		'videoDescriptionTextColor'        => '#212121',
		'videoDescriptionBackgroundColor'  => '#FFFFFF',
		'videoDescriptionFontSizeType'     => 'em',
		'videoDescriptionTextAlign'        => 'center',
		'videoDescriptionFontSizeDesktop'  => 1,
		'videoDescriptionFontSizeTablet'   => 1,
		'videoDescriptionFontSizeMobile'   => 1,
		'videoDescriptionPadding'          => 0,

		'cssClass'                      => '',
		'cssReset'                      => true
	);

	/**
	 * Get CSS for Text Image Block
	 *
	 * @param array  $attr The block attributes.
	 * @param string $id The selector ID.
	 * @return array generated CSS
	 */
	public static function get_text_video_css( $attr, $id ) {

		$attr = array_merge( self::$text_video_defaults, (array) $attr );

		$prefixClass = '.epbl-textvid';

		$gridTemplateColumns = '';
		if (  $attr['textLocation'] == 'left' ) {
			$gridTemplateColumns =  'auto '.$attr['columnWidthSize'].'%';
		} elseif ( $attr['textLocation'] == 'right' ) {
			$gridTemplateColumns =  $attr['columnWidthSize'].'% auto';
			//gridTemplateColumns =  columnWidthSize+'% auto';
		}

		$helpTextColor = $attr['videoDescriptionBackgroundColor'];
		if ( isset($attr['videoDescriptionBackgroundColor']['rgb']['r'] )) {
			$r = $attr['videoDescriptionBackgroundColor']['rgb']['r'];
			$g = $attr['videoDescriptionBackgroundColor']['rgb']['g'];
			$b = $attr['videoDescriptionBackgroundColor']['rgb']['b'];
			$a = $attr['videoDescriptionBackgroundColor']['rgb']['a'];
			$helpTextColor = 'rgba('.$r.','.$g.','.$b.','.$a.')';
		}

		//Title
		$selectors_desktop = array(
				'' => array(
						'grid-template-columns'   => $gridTemplateColumns,
						'margin-top'            => self::get_css_value( $attr['containerMarginSize'], $attr['containerMarginType'] ),
						'margin-bottom'         => self::get_css_value( $attr['containerMarginSize'], $attr['containerMarginType'] ),
				),
				' '.$prefixClass.'__inner' => array(
						'grid-template-columns'   => $gridTemplateColumns,
				),

			/*
                Based on where the Help text is located will depend how the styling will be applied.

                __figure--help-text-above-video
                        - Target Img tag for ( Border attributes )
                __figure--help-text-top-video
                        - Target this class for ( Border attributes )
                __figure--help-text-below-video
                        - Target Img tag for ( Border attributes )
                __figure--help-text-bottom-video
                        - Target this class for ( Border attributes )
            */

			// ABOVE VIDEO
				' '.$prefixClass.'__figure--zoom-on'.$prefixClass.'__figure--help-text-above-video video:hover' => array(
						'border-color'          => $attr['videoZoomBorderColor'],
				),
				' '.$prefixClass.'__figure--help-text-above-video video' => array(
						'border-radius'         => $attr['videoBorderRadius'].'px',
						'border-width'          => $attr['videoBorderThickness'].'px',
						'border-color'          => $attr['videoBorderColor'],
						'background-color'      => $attr['videoBorderColor'],
						'border-style'          => 'solid'
				),
			// TOP VIDEO
				' '.$prefixClass.'__figure--help-text-top-video video:hover' => array(
						'border-color'          => $attr['videoZoomBorderColor'],
				),
				' '.$prefixClass.'__figure--help-text-top-video' => array(
						'border-radius'         => $attr['videoBorderRadius'].'px',
						'border-width'          => $attr['videoBorderThickness'].'px',
						'border-color'          => $attr['videoBorderColor'],
						'background-color'          => $attr['videoBorderColor'],
				),
				' '.$prefixClass.'__figure--help-text-top-video:hover' => array(
						'border-color'          => $attr['videoZoomBorderColor'],
				),
			// BELOW VIDEO
				' '.$prefixClass.'__figure--help-text-below-video video' => array(
						'border-radius'         => $attr['videoBorderRadius'].'px',
						'border-width'          => $attr['videoBorderThickness'].'px',
						'border-color'          => $attr['videoBorderColor'],
						'background-color'      => $attr['videoBorderColor'],
						'border-style'          => 'solid'
				),
				' '.$prefixClass.'__figure--zoom-on'.$prefixClass.'__figure--help-text-below-video video:hover' => array(
						'border-color'          => $attr['videoZoomBorderColor'],
				),
			//BOTTOM VIDEO
				' '.$prefixClass.'__figure--help-text-bottom-video' => array(
						'border-radius'         => $attr['videoBorderRadius'].'px',
						'border-width'          => $attr['videoBorderThickness'].'px',
						'border-color'          => $attr['videoBorderColor'],
						'background-color'          => $attr['videoBorderColor'],
				),
				' '.$prefixClass.'__figure--zoom-on'.$prefixClass.'__figure--help-text-bottom-video:hover' => array(
						'border-color'          => $attr['videoZoomBorderColor'],
				),


				' '.$prefixClass.'__figure '.$prefixClass.'__help-text-container' => array(
						'background-color'          => $helpTextColor,
				),
				' '.$prefixClass.'__figure '.$prefixClass.'__help-text__inner' => array(
						'color'                     => $attr['videoDescriptionTextColor'],
						'padding'                   => $attr['videoDescriptionPadding'].'px',
						'text-align'                => $attr['videoDescriptionTextAlign'],
						'font-size'                 => self::get_css_value( $attr['videoDescriptionFontSizeDesktop'], $attr['videoDescriptionFontSizeType'] ),
				),
				' '.$prefixClass.'__zoom-text' => array(
						'color'                     => $attr['videoZoomTextColor'],
				),

				' '.$prefixClass.'__zoom-icon' => array(
						'color'                     => $attr['videoZoomIconColor'],
				),
		);

		/*$selectors_tablet = array(
				' .epbl-section-heading__title' => array(
						'font-size' => self::get_css_value( $attr['fontSizeTablet'], $attr['fontSizeType'] ),
				)
		);
		$selectors_smartphone = array(
				' .epbl-section-heading__title' => array(
						'font-size' => self::get_css_value( $attr['fontSizeMobile'], $attr['fontSizeType'] ),
				)
		);
		*/
		$generated_css = array(
				'desktop' => self::generate_css( $selectors_desktop, '#epbl-textvid-' . $id ),
			//'tablet'  => self::generate_css( $selectors_tablet, '#epbl-section-heading-' . $id ),
			//'mobile'  => self::generate_css( $selectors_smartphone, '#epbl-section-heading-' . $id ),
		);

		return $generated_css;
	}

	/**
	 * Combine CSS value and unit.
	 * @param string $value
	 * @param string $unit
	 * @return string
	 */
	public static function get_css_value( $value = '', $unit = '', $default = '' ) {
		return empty($value) ? $default : esc_attr( $value ) . $unit;
	}

	/**
	 * Generate CSS from array.
	 * @param $selectors
	 * @param $id
	 * @return string
	 */
	public static function generate_css( $selectors, $id ) {

		$output_css = '';
		foreach ( $selectors as $key => $value ) {

			$css = '';
			foreach ( $value as $name => $content ) {

				if ( 'font-family' === $name && 'Default' === $content ) {
					continue;
				}

				if ( ! empty($content) || $content === 0 || $name == 'content' ) {
					$css .= $name . ': ' . $content . ';';
				}
			}

			if ( ! empty( $css ) ) {
				$output_css .= $id;
				$output_css .= $key . '{';
				$output_css .= $css . '}';
			}
		}

		return $output_css;
	}
}
