/**
 * Generate CSS for the back end blocks
 *
 * KB CATEGORIES
 */

import generate_block_css from "../../../helpers/generate_block_css";
import TypographyControl, {defaultTypographyFields, getTypographyStyles, getTypographyImports} from "../../../components/typography.js";
import BoxShadowControl, {defaultBoxShadowFields, getBoxShadowStyles} from "../../../components/box-shadow.js";

function generate_style( props ) {

	const {
		title_typography,
		title_color,
		title_background,
		title_padding,
		list_paddingTopBottom,
		list_borderBottomToggle,
		list_borderStyle,
		list_borderWidth,
		list_borderColor,
		icon_color,
		icon_colorHover,
		icon_size,
		text_color,
		text_colorHover,
		text_indent,
		text_typography,
		advancedMarginTop,
		advancedMarginRight,
		advancedMarginBottom,
		advancedMarginLeft,
		advancedPaddingTop,
		advancedPaddingRight,
		advancedPaddingBottom,
		advancedPaddingLeft,
		advancedZIndex,
		advancedBorderType,
		advancedBorderWidthTop,
		advancedBorderWidthRight,
		advancedBorderWidthBottom,
		advancedBorderWidthLeft,
		advancedBorderColor,
		advancedBorderRadius,
		advancedBoxShadow,
		hideOnDesktop,
		hideOnTablet,
		hideOnMobile,
		icon_padding,
		icon_margin,
	} = props.attributes;

	let container_id = `.block-editor-page #wpwrap #epbl-kb-categories-container-${ props.clientId }`;
	
	let $selectors_desktop          = {};
	let $selectors_tablet           = {};
	let $selectors_mobile           = {};

	// container 
	$selectors_desktop[' '] = {
		'margin-top' : generate_CSS_value ( advancedMarginTop, 'px' ),
		'margin-right' : generate_CSS_value ( advancedMarginRight, 'px' ),
		'margin-bottom' : generate_CSS_value ( advancedMarginBottom, 'px' ),
		'margin-left' : generate_CSS_value ( advancedMarginLeft, 'px' ),
		'padding-top' : generate_CSS_value ( advancedPaddingTop, 'px' ),
		'padding-right' : generate_CSS_value ( advancedPaddingRight, 'px' ),
		'padding-bottom' : generate_CSS_value ( advancedPaddingBottom, 'px' ),
		'padding-left' : generate_CSS_value ( advancedPaddingLeft, 'px' ),
		'z-index' : advancedZIndex,
		'border-style' : advancedBorderType,
		'border-top-width' : generate_CSS_value ( advancedBorderWidthTop, 'px' ),
		'border-right-width' : generate_CSS_value ( advancedBorderWidthRight, 'px' ),
		'border-bottom-width' : generate_CSS_value ( advancedBorderWidthBottom, 'px' ),
		'border-left-width' : generate_CSS_value ( advancedBorderWidthLeft, 'px' ),
		'border-color' : advancedBorderColor,
		'border-radius' : generate_CSS_value ( advancedBorderRadius, 'px' ),
	};
	
	$selectors_desktop[' .epbl-kb-cat-list-item__item:not(:first-child) '] = {
		'padding-top': generate_CSS_value ( list_paddingTopBottom/2, 'px' ),
	};
	
	$selectors_desktop[' .epbl-kb-cat-list-item__item '] = {
		'padding-bottom': generate_CSS_value ( list_paddingTopBottom/2, 'px' ),
	};
	
	if ( list_borderBottomToggle ) {
		$selectors_desktop[' .epbl-kb-cat-list-item__item:not(:last-child):after '] = {
			'content' : "''",
			'border-bottom-style' : list_borderStyle,
			'border-bottom-width' : generate_CSS_value ( list_borderWidth, 'px' ),
			'border-color' : list_borderColor
		}
	}
	
	$selectors_desktop[' .epbl-kb-cat-list-title '] = {
		'color': title_color,
		'background-color': title_background,
	};
	
	if ( title_padding.top ) $selectors_desktop[' .epbl-kb-cat-list-title ']['padding-top'] =  generate_CSS_value ( title_padding.top, 'px' );
	if ( title_padding.right ) $selectors_desktop[' .epbl-kb-cat-list-title ']['padding-right'] =  generate_CSS_value ( title_padding.right, 'px' );
	if ( title_padding.bottom ) $selectors_desktop[' .epbl-kb-cat-list-title ']['padding-bottom'] =  generate_CSS_value ( title_padding.bottom, 'px' );
	if ( title_padding.left ) $selectors_desktop[' .epbl-kb-cat-list-title ']['padding-left'] =  generate_CSS_value ( title_padding.left, 'px' );
	
	$selectors_desktop[' .epbl-kb-cat-list-items__item__icon '] = {};
	
	if ( icon_padding.top ) $selectors_desktop[' .epbl-kb-cat-list-items__item__icon ']['padding-top'] =  generate_CSS_value ( icon_padding.top, 'px' );
	if ( icon_padding.right ) $selectors_desktop[' .epbl-kb-cat-list-items__item__icon ']['padding-right'] =  generate_CSS_value ( icon_padding.right, 'px' );
	if ( icon_padding.bottom ) $selectors_desktop[' .epbl-kb-cat-list-items__item__icon ']['padding-bottom'] =  generate_CSS_value ( icon_padding.bottom, 'px' );
	if ( icon_padding.left ) $selectors_desktop[' .epbl-kb-cat-list-items__item__icon ']['padding-left'] =  generate_CSS_value ( icon_padding.left, 'px' );
	
	if ( icon_margin.top ) $selectors_desktop[' .epbl-kb-cat-list-items__item__icon ']['margin-top'] =  generate_CSS_value ( icon_margin.top, 'px' );
	if ( icon_margin.right ) $selectors_desktop[' .epbl-kb-cat-list-items__item__icon ']['margin-right'] =  generate_CSS_value ( icon_margin.right, 'px' );
	if ( icon_margin.bottom ) $selectors_desktop[' .epbl-kb-cat-list-items__item__icon ']['margin-bottom'] =  generate_CSS_value ( icon_margin.bottom, 'px' );
	if ( icon_margin.left ) $selectors_desktop[' .epbl-kb-cat-list-items__item__icon ']['margin-left'] =  generate_CSS_value ( icon_margin.left, 'px' );
	
	$selectors_desktop[' .epbl-kb-cat-list-item__item .epbl-kb-cat-list-items__item__icon i '] = {
		'color' : icon_color,
		'font-size' : generate_CSS_value ( icon_size, 'px' ),
	};
	
	$selectors_desktop[' .epbl-kb-cat-list-item__item .epbl-kb-cat-list-items__item__icon img '] = {
		'max-height' : generate_CSS_value ( icon_size, 'px' ),
	};
	
	$selectors_desktop[' .epbl-kb-cat-list-item__item a:hover .epbl-kb-cat-list-items__item__icon i '] = {
		'color' : icon_colorHover,
	};
	
	$selectors_desktop[' .epbl-kb-cat-list-item__item a:hover .epbl-kb-cat-list-items__item__text '] = {
		'color' : text_colorHover,
	};
	
	$selectors_desktop[' .epbl-kb-cat-list-item__item .epbl-kb-cat-list-items__item__text '] = {
		'padding-left' : generate_CSS_value ( text_indent, 'px' ),
		'color' : text_color,
	};
	
	$selectors_desktop[' .epbl-kb-cat-list-item__item a '] = {
		'color' : text_color,
	};
	
	$selectors_desktop[' .epbl-kb-cat-list-item__item a:hover '] = {
		'color' : text_colorHover,
	};
	
	let styling_css = '';
	
	// typography 
	styling_css += getTypographyImports( title_typography );
	styling_css += getTypographyImports( text_typography );
	styling_css += getTypographyStyles( container_id + ' .epbl-kb-cat-list-title', title_typography );
	styling_css += getTypographyStyles( container_id + ' .epbl-kb-cat-list-item__item .epbl-kb-cat-list-items__item__text', text_typography );
	
	// box shadows 
	styling_css += getBoxShadowStyles( container_id, advancedBoxShadow );
	
	styling_css += generate_block_css( $selectors_desktop, container_id );
	styling_css += generate_block_css( $selectors_tablet, container_id, "tablet" );
	styling_css += generate_block_css( $selectors_mobile, container_id, "mobile" );
	
	
	if ( hideOnDesktop ) {
		styling_css += generate_block_css( { ' ' : { 'display' : 'none!important' } }, container_id, "only_desktop" );
	}
	
	if ( hideOnTablet ) {
		styling_css += generate_block_css( { ' ' : { 'display' : 'none!important' } }, container_id, "only_tablet" );
	}
	
	if ( hideOnMobile ) {
		styling_css += generate_block_css( { ' ' : { 'display' : 'none!important' } }, container_id, "mobile" );
	}
	
	
	return styling_css;
}

function generate_CSS_value ( value, unit ) {
	return typeof value == "undefined" ? '' : value + unit;
}

export default generate_style
