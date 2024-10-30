/**
 * Register KB: Categories
 */

// Import block dependencies and support files
import edit from "./edit"

// Import block CSS
import './styles/style.scss';
import './styles/editor.scss';
import icons from "../../assets/js/icons";
import TypographyControl, {defaultTypographyFields} from "../../components/typography.js";
import BoxShadowControl, {defaultBoxShadowFields} from "../../components/box-shadow.js";

// common libraries
const { __ } = wp.i18n;

const {
	registerBlockType
} = wp.blocks;

// set default Typography options for different texts. Clone object, not use '=' 
const text_typographyOptions = Object.assign({}, defaultTypographyFields);
const title_typographyOptions = Object.assign({}, defaultTypographyFields);
const advancedBoxShadowOptions = Object.assign({}, defaultBoxShadowFields);

title_typographyOptions.sizeDesktop = 28;
title_typographyOptions.sizeMobile = 28;
title_typographyOptions.sizeTablet = 28;

registerBlockType( 'echo-document-blocks/kb-categories', {

	title: __( 'KB: Categories' ),
	description: __( 'List of KB categories from Echo Knowledge Base.' ),
	icon: icons['kb_categories_icon'],
	category: 'echo-document-blocks', 
	keywords: [
		__( 'knowledge' ),
		__( 'list' ),
		__( '' )
	],
	attributes: {

		block_id: {
			type: "string"
		},
		
		blockType: {
			type: 'string',
			default: ''
		},
		
		templateId: {
			type: 'number',
			default: 0
		},

		// Content Tab 
		// Knowledge Base  
		kb_id: {
			type: 'number',
			default: 1
		},
		
		// Content 
		title_toggle: {
			type: 'boolean',
			default: true
		},
		
		title_text: {
			type: 'string',
			default: __( 'Categories' )
		},
		title_level: {
			type: "number",
			default: 3
		},

		title_HTMLTag: {
			type: 'string',
			default: 'h3'
		},
		
		title_padding: {
			type: 'object',
			default: {
				top : 0,
				right : 0,
				bottom : 15,
				left : 0,
			}
		},
		
		title_color: {
			type: 'string',
			default: ''
		},
		
		title_background: {
			type: 'string',
			default: ''
		},
		
		title_typography: { 
			type: 'object',
			default: title_typographyOptions
		},
		
		categories_filter: {
			type: 'string',
			default: 'all'
		},
		
		categories_ids_text: {
			type: 'string',
			default: ''
		},
		
		// Style Tab
		// List 
		list_paddingTopBottom: {
			type: 'number',
			default: 10
		},
		
		list_alignment: {
			type: 'string',
			default: 'left'
		},
		
		icon_position: {
			type: 'string',
			default: 'icon-first'
		},
		
		list_borderBottomToggle: {
			type: 'boolean',
			default: false
		},
		
		list_borderStyle: {
			type: 'string',
			default: 'solid'
		},
		
		list_borderWidth: {
			type: 'number',
			default: 1
		},
		
		list_borderColor: {
			type: 'string',
			default: ''
		},
		
		// Icon
		icon_color: {
			type: 'string',
			default: ''
		},
		
		icon_colorHover: {
			type: 'string',
			default: ''
		},
		
		icon_size: {
			type: 'number',
			default: 14
		},
		
		icon_padding: {
			type: 'object',
			default: {
				top : 0,
				right : 0,
				bottom : 0,
				left : 0,
			}
		},
		
		icon_margin: {
			type: 'object',
			default: {
				top : 0,
				right : 0,
				bottom : 0,
				left : 0,
			}
		},
		
		// Text
		text_color: {
			type: 'string',
			default: ''
		},
		
		text_colorHover: {
			type: 'string',
			default: ''
		},
		
		text_indent: {
			type: 'number',
			default: 0
		},
		
		text_typography: { 
			type: 'object',
			default: text_typographyOptions
		},
		
		// Advanced settings 
		advancedMarginTop: {
			type: 'number',
			default: 0
		},
		
		advancedMarginRight: {
			type: 'number',
			default: 0
		},
		
		advancedMarginBottom: {
			type: 'number',
			default: 0
		},
		
		advancedMarginLeft: {
			type: 'number',
			default: 0
		},
		
		advancedPaddingTop: {
			type: 'number',
			default: 0
		},
		
		advancedPaddingRight: {
			type: 'number',
			default: 0
		},
		
		advancedPaddingBottom: {
			type: 'number',
			default: 0
		},
		
		advancedPaddingLeft: {
			type: 'number',
			default: 0
		},
		
		advancedZIndex: {
			type: 'string',
			default: ''
		},
		
		advancedClass: {
			type: 'string',
			default: ''
		},
		
		advancedBorderType: {
			type: 'string',
			default: ''
		},
		
		advancedBorderWidthTop: {
			type: 'number',
			default: 0
		},
		
		advancedBorderWidthRight: {
			type: 'number',
			default: 0
		},
		
		advancedBorderWidthBottom: {
			type: 'number',
			default: 0
		},
		
		advancedBorderWidthLeft: {
			type: 'number',
			default: 0
		},
		
		advancedBorderColor: {
			type: 'string',
			default: ''
		},
		
		advancedBorderRadius: {
			type: 'number',
			default: 0
		},
		
		advancedBoxShadow: {
			type: 'object',
			default: advancedBoxShadowOptions
		},
		
		hideOnDesktop: {
			type: 'boolean',
			default: false
		},
		
		hideOnTablet: {
			type: 'boolean',
			default: false
		},
		
		hideOnMobile: {
			type: 'boolean',
			default: false
		},
	},
	supports: {
		className:false,
		customClassName:false
	},

	// Render the block in editor
	edit,

	// Save the attributes and markup, null because use php render
	save: function( props ) {
		return null;
	}
} );

// Prevent click on the links inside block
jQuery('body').on( 'click', '.epbl-kb-categories-container a', function(e){
	e.preventDefault();
});