/**
 * Register Knowledge Base
 */

// Import block dependencies and support files
import edit from "./edit"

// Import block CSS
import './styles/style.scss';
import './styles/editor.scss';
import icons from "../../assets/js/icons";
import BoxShadowControl, {defaultBoxShadowFields} from "../../components/box-shadow.js";

// common libraries
const { __ } = wp.i18n;

const {
	registerBlockType
} = wp.blocks;

const {
	RichText
} = wp.blockEditor;

const advancedBoxShadowOptions = Object.assign({}, defaultBoxShadowFields);

registerBlockType( 'echo-document-blocks/knowledge-base', {

	title: __( 'Knowledge Base' ),
	description: __( 'Shortcode for Echo Knowledge Base plugin.' ),
	icon: icons['kb_main_page_icon'],
	category: 'echo-document-blocks',
	keywords: [
		__( 'knowledge KB' ),
		__( 'article' ),
		__( 'wiki' )
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
		className: false,
		customClassName: false
	},

	// Render the block in editor
	edit,

	// Save the attributes and markup, null because use php render
	save: function( props ) {
		return null;
	}
} );

// Prevent click on the links inside block
jQuery('body').on( 'click', '.epbl-kb-container a, button', function(e){
	e.preventDefault();
});

jQuery('body').on( 'submit', '.epbl-kb-container form', function(e){
	e.preventDefault();
});