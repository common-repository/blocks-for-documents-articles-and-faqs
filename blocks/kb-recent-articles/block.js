/**
 * Register KB: Recent Articles
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
const titleTypographyOptions = Object.assign({}, defaultTypographyFields);
const articleText_typographyOptions = Object.assign({}, defaultTypographyFields);
const advancedBoxShadowOptions = Object.assign({}, defaultBoxShadowFields);

titleTypographyOptions.sizeDesktop = 28;
titleTypographyOptions.sizeMobile = 28;
titleTypographyOptions.sizeTablet = 28;

registerBlockType( 'echo-document-blocks/kb-articles', {

	title: __( 'KB: Recent Articles' ),
	description: __( 'List of Recent Articles from Echo Knowledge Base.' ),
	icon: icons['kb_recent_articles_icon'], 
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
		
		// Title 
		title_toggle: {
			type: 'boolean',
			default: true
		},
		
		title_text: {
			type: 'string',
			default: __( 'Recent Articles' )
		},
		
		title_level: {
			type: "number",
			default: 3
		},
		
		title_HTMLTag: {
			type: 'string',
			default: 'h3'
		},
		
		// Articles 
		order_by: {
			type: 'string',
			default: 'date'
		},
		
		nof: {
			type: 'number',
			default: 5
		},
		
		// Style Tab
		// General 
		list_layout: {
			type: 'string',
			default: 'col' // or row
		},
		
		list_alignment: {
			type: 'string',
			default: 'flex-start'
		},
		
		icon_position: {
			type: 'string',
			default: 'icon-first'
		},
		
		// Title 
		title_padding_top: {
			type: 'number',
			default: 5
		},
		
		title_padding_right: {
			type: 'number',
			default: 5
		},
		
		title_padding_bottom: {
			type: 'number',
			default: 5
		},
		
		title_padding_left: {
			type: 'number',
			default: 0
		},
		
		title_color: {
			type: 'string',
			default: ''
		},
		
		title_backgroundColor: {
			type: 'string',
			default: ''
		},
		
		title_typography: {
			type: 'object',
			default: titleTypographyOptions
		},
		
		icon_size: {
			type: 'number',
			default: 16
		},
		
		icon_margin_top: {
			type: 'number',
			default: 0
		},
		
		icon_margin_right: {
			type: 'number',
			default: 0
		},
		
		icon_margin_bottom: {
			type: 'number',
			default: 0
		},
		
		icon_margin_left: {
			type: 'number',
			default: 0
		},
		
		icon_padding_top: {
			type: 'number',
			default: 0
		},
		
		icon_padding_right: {
			type: 'number',
			default: 5
		},
		
		icon_padding_bottom: {
			type: 'number',
			default: 0
		},
		
		icon_padding_left: {
			type: 'number',
			default: 0
		},
		
		icon_color: {
			type: 'string',
			default: ''
		},
		
		// Article
		articleText_typography: {
			type: 'object',
			default: articleText_typographyOptions
		},
		
		articleText_margin_top: {
			type: 'number',
			default: 0
		},
		
		articleText_margin_right: {
			type: 'number',
			default: 0
		},
		
		articleText_margin_bottom: {
			type: 'number',
			default: 0
		},
		
		articleText_margin_left: {
			type: 'number',
			default: 0
		},
		
		articleText_padding_top: {
			type: 'number',
			default: 0
		},
		
		articleText_padding_right: {
			type: 'number',
			default: 0
		},
		
		articleText_padding_bottom: {
			type: 'number',
			default: 0
		},
		
		articleText_padding_left: {
			type: 'number',
			default: 0
		},
		
		articleText_color: {
			type: 'string',
			default: ''
		},
		
		articleText_backgroundColor: {
			type: 'string',
			default: ''
		},
		
		articleText_borderType: {
			type: 'string',
			default: ''
		},
		
		articleText_BorderWidthTop: {
			type: 'number',
			default: 0
		},
		
		articleText_BorderWidthRight: {
			type: 'number',
			default: 0
		},
		
		articleText_BorderWidthBottom: {
			type: 'number',
			default: 0
		},
		
		articleText_BorderWidthLeft: {
			type: 'number',
			default: 0
		},
		
		articleText_BorderColor: {
			type: 'string',
			default: ''
		},
		
		articleText_BorderRadius: {
			type: 'number',
			default: 0
		},
		
		articleText_colorHover: {
			type: 'string',
			default: ''
		},
		
		articleText_backgroundColorHover: {
			type: 'string',
			default: ''
		},
		
		icon_colorHover: {
			type: 'string',
			default: ''
		},
		
		// advanced settings 
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

// Prevent click on the article's list 
jQuery('body').on( 'click', '.epbl-kb-article-list-items__item a', function(e){
	e.preventDefault();
});