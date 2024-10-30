/**
 * Generate CSS for the back end blocks
 *
 * KB RECENT ARTICLES
 */

import generate_block_css from "../../../helpers/generate_block_css";
import TypographyControl, {defaultTypographyFields, getTypographyStyles, getTypographyImports} from "../../../components/typography.js";
import BoxShadowControl, {defaultBoxShadowFields, getBoxShadowStyles} from "../../../components/box-shadow.js";

function generate_style( props ) {

	const {
		list_alignment,
		title_padding_top,
		title_padding_right,
		title_padding_bottom,
		title_padding_left,
		title_color,
		title_backgroundColor,
		icon_size,
		icon_margin_top,
		icon_margin_right,
		icon_margin_bottom,
		icon_margin_left,
		icon_padding_top,
		icon_padding_right,
		icon_padding_bottom,
		icon_padding_left,
		icon_color,
		articleText_margin_top,
		articleText_margin_right,
		articleText_margin_bottom,
		articleText_margin_left,
		articleText_padding_top,
		articleText_padding_right,
		articleText_padding_bottom,
		articleText_padding_left,
		articleText_color,
		articleText_backgroundColor,
		articleText_borderType,
		articleText_BorderWidthTop,
		articleText_BorderWidthRight,
		articleText_BorderWidthBottom,
		articleText_BorderWidthLeft,
		articleText_BorderColor,
		articleText_BorderRadius,
		articleText_colorHover,
		articleText_backgroundColorHover,
		icon_colorHover,
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
		hideOnDesktop,
		hideOnTablet,
		hideOnMobile,
		title_typography,
		articleText_typography,
		advancedBoxShadow,
	} = props.attributes;
	
	let container_id = `.block-editor-page #wpwrap #epbl-kb-article-list-container-${ props.clientId }`;
	
	let $selectors_desktop          = {};
	let $selectors_tablet           = {};
	let $selectors_mobile           = {};

	// container 
	$selectors_desktop[' '] = {
		'justify-content' : list_alignment,
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
	
	$selectors_desktop[' .epbl-kb-article-list-items__item a '] = {
		'justify-content' : list_alignment,
		'margin-top' : generate_CSS_value ( articleText_margin_top, 'px' ),
		'margin-right' : generate_CSS_value ( articleText_margin_right, 'px' ),
		'margin-bottom' : generate_CSS_value ( articleText_margin_bottom, 'px' ),
		'margin-left' : generate_CSS_value ( articleText_margin_left, 'px' ),
		'padding-top' : generate_CSS_value ( articleText_padding_top, 'px' ),
		'padding-right' : generate_CSS_value ( articleText_padding_right, 'px' ),
		'padding-bottom' : generate_CSS_value ( articleText_padding_bottom, 'px' ),
		'padding-left' : generate_CSS_value ( articleText_padding_left, 'px' ),
		'color' : articleText_color,
		'background-color' : articleText_backgroundColor,
		'border-style' : articleText_borderType,
		'border-top-width' : generate_CSS_value ( articleText_BorderWidthTop, 'px' ),
		'border-right-width' : generate_CSS_value ( articleText_BorderWidthRight, 'px' ),
		'border-bottom-width' : generate_CSS_value ( articleText_BorderWidthBottom, 'px' ),
		'border-left-width' : generate_CSS_value ( articleText_BorderWidthLeft, 'px' ),
		'border-color' : articleText_BorderColor,
		'border-radius' : generate_CSS_value ( articleText_BorderRadius, 'px' ),
	};
	
	$selectors_desktop[' .epbl-kb-article-list-items__item a:hover '] = {
		'color' : articleText_colorHover,
		'background-color' : articleText_backgroundColorHover,
	}
	
	$selectors_desktop[' .epbl-kb-article-list-items-container .epbl-kb-article-list-items__item a:hover .epbl-kb-article-list-items__item__icon .epbl-recent-articles-icon '] = {
		'color' : icon_colorHover,
	}
	
	$selectors_desktop[' .epbl-kb-article-list-items__item__text '] = {
		'color' : articleText_color,
	};
	
	$selectors_desktop[' .epbl-kb-article-list-title '] = {
		'justify-content' : list_alignment,
		'padding-top' : generate_CSS_value ( title_padding_top, 'px' ),
		'padding-right' : generate_CSS_value ( title_padding_right, 'px' ),
		'padding-bottom' : generate_CSS_value ( title_padding_bottom, 'px' ),
		'padding-left' : generate_CSS_value ( title_padding_left, 'px' ),
		'color': title_color,
		'background-color' : title_backgroundColor,
	};
	
	$selectors_desktop[' .epbl-recent-articles-icon '] = {
		'font-size' : icon_size + 'px',
		'color' : icon_color,
	}
	
	$selectors_desktop[' .epbl-kb-article-list-items-container '] = {
		'justify-content' : list_alignment,
	}
	
	$selectors_desktop[' .epbl-kb-article-list-items__item__icon '] = {
		'margin-top' : generate_CSS_value ( icon_margin_top, 'px' ),
		'margin-right' : generate_CSS_value ( icon_margin_right, 'px' ),
		'margin-bottom' : generate_CSS_value ( icon_margin_bottom, 'px' ),
		'margin-left' : generate_CSS_value ( icon_margin_left, 'px' ),
		'padding-top' : generate_CSS_value ( icon_padding_top, 'px' ),
		'padding-right' : generate_CSS_value ( icon_padding_right, 'px' ),
		'padding-bottom' : generate_CSS_value ( icon_padding_bottom, 'px' ),
		'padding-left' : generate_CSS_value ( icon_padding_left, 'px' ),
	} 
	
	
	let styling_css = '';
	
	// typography 
	styling_css += getTypographyImports( title_typography );
	styling_css += getTypographyImports( articleText_typography );
	styling_css += getTypographyStyles( container_id + ' .epbl-kb-article-list-title', title_typography );
	styling_css += getTypographyStyles( container_id + ' .epbl-kb-article-list-items__item__text', articleText_typography );
	
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
