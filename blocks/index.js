/**
 * Import internationalization
 */
import "../helpers/i18n.js";

/**
 * Import registerBlockType blocks
 */
import "./knowledge-base/block.js";
// TODO FUTURE import "./section-heading/block.js";
import "./kb-recent-articles/block.js";
import "./kb-categories/block.js";
// TODO LATER import "./info-box/block.js";
// TODO LATER import "./text-image/block.js";
// TODO LATER import "./text-video/block.js";
// TODO LATER import "./multiple-lists/block.js";

/**
 * Import CSS for backend block configuration UI layout
 */
import '../assets/css/scss/admin/admin-block-editor.scss';
// TODO LATER import '../assets/css/scss/admin/admin-dashboard.scss';
import '../assets/css/scss/admin/admin-plugin-pages.scss';

// TODO LATER import '../assets/css/scss/admin/admin-template-manager.scss';
// TODO LATER import '../helpers/template-editor-intro.js';


const { updateCategory } = wp.blocks;
import EPBL_Block_Icons from "../assets/js/icons";
updateCategory( "echo-document-blocks", {
	icon: EPBL_Block_Icons['d_logo_icon']
} );

// load template properties if any
function epblUpdateBlockAttributes( props, blockType ) {

	// 1. handle only our blocks
	let blockName = typeof blockType === 'string' || blockType instanceof String ? blockType : blockType.name;
	if ( ! blockName.startsWith('echo-document-blocks/') ) {
		return props;
	}

	// 2. does this block uses template? find the template ID
	let foundTemplateId = 0;
	if ( typeof templateEditorId !== 'undefined' && templateEditorId > 0 ) {
		foundTemplateId = templateEditorId;
	} else {

		// TODO FUTURE for some reason templateId is not propagated from DB here; workaround
		if ( props.templateId <= 0 && typeof blockEditorBlockIds !== "undefined" && props.block_id && blockEditorBlockIds[props.block_id] !== undefined ) {
			props.templateId = blockEditorBlockIds[props.block_id];
		}

		foundTemplateId = props.templateId;
	}

	// 3. initialize based on if Template Editor or editing block with template
	if ( blockName === 'echo-document-blocks/template-info' ) {
		props.templateId = foundTemplateId;
	} else if ( foundTemplateId && typeof epblTemplateAttributes !== "undefined" && epblTemplateAttributes[foundTemplateId] !== undefined ) {
		Object.assign(props, epblTemplateAttributes[foundTemplateId]);
	}

	return props;
}

/* TODO FUTURE wp.hooks.addFilter(
	'blocks.getBlockAttributes',
	'echo-document-blocks/section-heading',
	epblUpdateBlockAttributes
); */