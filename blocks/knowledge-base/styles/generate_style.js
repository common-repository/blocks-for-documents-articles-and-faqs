/**
 * Generate CSS for the back end blocks
 *
 * KB Shortcode
 */
 
import generate_block_css from "../../../helpers/generate_block_css";
import BoxShadowControl, {defaultBoxShadowFields, getBoxShadowStyles} from "../../../components/box-shadow.js";

function generate_style( props ) {

	const {
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
	} = props.attributes;

	let container_id = `.block-editor-page #wpwrap #epbl-knowledge-base-${ props.clientId }`;
	
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
	
	let styling_css = '';
	
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
