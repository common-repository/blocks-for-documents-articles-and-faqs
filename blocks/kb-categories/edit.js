/**
 * KB: Categories
 */

// Import block CSS
import './styles/style.scss';
import './styles/editor.scss';
import generate_style from "./styles/generate_style";
import HTagToolbar from "../../components/htag-toolbar";
import RangeScaledControl from "../../components/range-scaled";
import EditorBlockTemplate from "../../components/editor-block-template.js";
import EditorTabs from "../../components/editor-tabs.js";
import EditorTabBody from "../../components/editor-tab-body.js";
import BorderSizesControl from "../../components/border-sizes.js";
import KbSelect from "../../components/kb-select.js";
import TypographyControl, {defaultTypographyFields, getTypographyStyles} from "../../components/typography.js";
import BoxShadowControl, {defaultBoxShadowFields, getBoxShadowStyles} from "../../components/box-shadow.js";
import icons from "../../assets/js/icons";

// common libraries
const { __ } = wp.i18n;
const { Component, Fragment } = wp.element;

// Register editor components
const {
	ColorPalette,
	BlockControls,
	InspectorControls,
} = wp.blockEditor;

const {
	PanelBody,
	SelectControl,
	TextControl,
	ToggleControl,
	SVG,
	Toolbar,
} = wp.components;

const { ServerSideRender } = wp.editor;
export default class EPBL_KB_Categories extends Component {

	constructor() {
		super( ...arguments );
	}

	// runs after the component output has been rendered to the DOM
	componentDidMount() {
		// save ID of the block for reference
		this.props.setAttributes( { block_id: this.props.clientId } );
		
		// Pushing Style tag for this block css.
		const styleElement = document.createElement( "style" );
		styleElement.setAttribute( "id", "epbl-section-categories-style-" + this.props.clientId );
		document.head.appendChild( styleElement );
	}

	render() {

		const {
			attributes: {

				block_id, blockType, templateId,
				
				// Knowledge Base 
				kb_id,
				
				// Content
				title_toggle,
				title_text,
				title_level,
				title_HTMLTag,
				title_typography,
				title_padding,
				title_color,
				title_background,
				categories_filter,
				categories_ids_text,
				
				// Style 
				list_paddingTopBottom,
				list_alignment,
				list_borderBottomToggle,
				list_borderStyle,
				list_borderWidth,
				list_borderColor,
				icon_position,
				icon_color,
				icon_colorHover,
				icon_size,
				icon_padding,
				icon_margin,
				text_color,
				text_colorHover,
				text_indent,
				text_typography,
				
				// Advanced
				advancedMarginTop, advancedMarginRight, advancedMarginBottom, advancedMarginLeft,
				advancedPaddingTop, advancedPaddingRight, advancedPaddingBottom, advancedPaddingLeft,
				advancedZIndex,
				advancedClass,
				advancedBorderType,
				advancedBorderWidthTop, advancedBorderWidthRight, advancedBorderWidthBottom, advancedBorderWidthLeft,
				advancedBorderColor,
				advancedBorderRadius,
				advancedBoxShadow,
				
				hideOnDesktop,
				hideOnTablet,
				hideOnMobile,
			},
			className,
			setAttributes,
		} = this.props;
		
		const element = document.getElementById( "epbl-section-categories-style-" + this.props.clientId );
		if ( element != null && typeof element != "undefined" ) {
			element.innerHTML = generate_style( this.props );
		}
		
		return (
		
			<Fragment>
				
				{/* 1. show in block Toolbar */}
				<BlockControls key='controls'></BlockControls>

				{/* 2. show configuration in Inspector */}
				<InspectorControls>
					
					<EditorBlockTemplate attributes={this.props.attributes} blockName={"kb-categories"} setAttributes={setAttributes} />
					<div id={"epbl-inspector-blocks"}>
						<EditorTabs>
							{ /** Content Tab */ }
							<EditorTabBody type='Content' active={true}>
								<PanelBody className="epbl-inspector-panel" title = { __( "Knowledge Base" ) }>
									<div className="epbl-inspector-panel__component">
										<KbSelect attributes={this.props.attributes} setAttributes={setAttributes} />
									</div>
								</PanelBody>
								<PanelBody className="epbl-inspector-panel" title = { __( "Content" ) }>
									<div className="epbl-inspector-panel__component epbl-component-control">
										<ToggleControl
											label={ __( 'Show Title' )}
											checked={ title_toggle }
											onChange={ ( value ) => setAttributes( { title_toggle: ! title_toggle } ) }
										/>
									</div>
									<div className={ this.props.attributes.title_toggle ? 'epbl-inspector-panel__component epbl-component-control' : 'hidden' }>
										<TextControl
											label={ __( 'Title' ) }
											value={ title_text }
											onChange={ value => setAttributes( { title_text: value } ) }
										/>
									</div>
									<div className={ this.props.attributes.title_toggle ? 'epbl-inspector-panel__component epbl-component-control' : 'hidden' }>
										<HTagToolbar
											headingTitle={ __('Title HTML Tag') }
											minLevel={1}
											maxLevel={7}
											selectedLevel={title_level}
											onChange={ (newLevel) => setAttributes({title_level: newLevel, title_HTMLTag: 'h' + newLevel}) }
										/>
									</div>
									<div className="epbl-inspector-panel__component epbl-component-control epbl-component-control-select-horizontal">
										<SelectControl
											label={ __( "Show Categories" ) }
											value={ categories_filter }
											onChange={ ( value ) => setAttributes( { categories_filter: value } ) }
											options={[
												{ value: 'all', label: __( 'All' ) },
												{ value: 'top', label: __( 'Top' ) },
											]}
										/>
									</div>
									<div className="epbl-inspector-panel__component epbl-component-control epbl-component-control-text-horizontal">
										<TextControl
											label={ __( 'Category ID(s)' ) }
											value={ categories_ids_text }
											onChange={ value => setAttributes( { categories_ids_text: value } ) }
										/>
									</div>
								</PanelBody>
							</EditorTabBody>
							
							{ /** Style Tab */ }
							<EditorTabBody type='Style'>
								<PanelBody className="epbl-inspector-panel" title = { __( "General" ) }>
									<div className="epbl-inspector-panel__component">
										<h3 className="epbl-component-control__title">{  __( 'Space Between (px)' ) }</h3>
										<RangeScaledControl
											size = { list_paddingTopBottom }
											sizeLabel = { 'list_paddingTopBottom' }
											wrapClass = 'condensed'
											min={ 0 }
											max={ 100 }
											initialPosition={ list_paddingTopBottom }
											steps = { 1 }
											hideTabs = { true }
											{ ...this.props }
										/>
									</div>
									<div className="epbl-inspector-panel__component epbl-component-control epbl-component-control-select-icon-horizontal">
										<h3 className="epbl-component-control__title">{ __('Alignment') }</h3>
										<Toolbar controls={ [ 'left', 'center', 'right' ].map( (item) => this.listAlignmentControl( item, list_alignment ) ) } />
									</div>
									<div className="epbl-inspector-panel__component epbl-component-control epbl-component-control-select-icon-horizontal">
										<h3 className="epbl-component-control__title">{ __('Icon Position') }</h3>
										<Toolbar controls={ [ 'icon-first', 'icon-last' ].map( (item) => this.iconPositionControl( item, icon_position ) ) } />
									</div>
									<div className="epbl-inspector-panel__component">
										<ToggleControl
											label={ __( 'Divider' )}
											checked={ list_borderBottomToggle }
											onChange={ ( value ) => setAttributes( { list_borderBottomToggle: ! list_borderBottomToggle } ) }
										/>
									</div>
									<div className={ this.props.attributes.list_borderBottomToggle ? 'epbl-inspector-panel__component' : 'hidden' }>
										<SelectControl
											label={ __( "Style" ) }
											value={ list_borderStyle }
											onChange={ (value) => setAttributes({ list_borderStyle : value }) }
											options={ [
												{ label: __( "Solid" ), value: 'solid' },
												{ label: __( "Double" ), value: 'double' },
												{ label: __( "Dotted" ), value: 'dotted' },
												{ label: __( "Dashed" ), value: 'dashed' },
												{ label: __( "Groove" ), value: 'groove' }
											]}
										/>
									</div>
									<div className={ this.props.attributes.list_borderBottomToggle ? 'epbl-inspector-panel__component' : 'hidden' }>
										<h3 className="epbl-component-control__title">{  __( 'Width (px)' ) }</h3>
										<RangeScaledControl
											beforeSVG = { icons['padding_bottom'] }
											wrapClass = 'condensed'
											size = { list_borderWidth }
											sizeLabel = { 'list_borderWidth' }
											min={ 0 }
											max={ 100 }
											initialPosition={ list_borderWidth }
											steps = { 1 }
											hideTabs = { true }
											{ ...this.props }
										/>
									</div>
									<div className={ this.props.attributes.list_borderBottomToggle ? 'epbl-inspector-panel__component epbl-component-control epbl-component-color-palette' : 'hidden' }>
										<h3 className="epbl-component-control__title">{  __( 'Color' ) }</h3>
										<ColorPalette
											value={ list_borderColor }
											onChange={ value => setAttributes( { list_borderColor: value } ) }
										/>
									</div>
									
								</PanelBody>
								<PanelBody className={ this.props.attributes.title_toggle ? 'epbl-inspector-panel' : 'hidden' } title = { __( "Title" ) }>
									<div className="epbl-inspector-panel__component">
										<BorderSizesControl
											optionsLabel = 'title_padding'
											label = { __( "Title Padding" ) }
											min = { 0 }
											max = { 100 }
											steps = { 1 }
											{ ...this.props } 
										/>
									</div>
									<div className="epbl-inspector-panel__component epbl-component-control epbl-component-color-palette">
										<h3 className="epbl-component-control__title">{  __( 'Title Color' ) }</h3>
										<ColorPalette
											value={ title_color }
											onChange={ value => setAttributes( { title_color: value } ) }
										/>
									</div>
									<div className="epbl-inspector-panel__component epbl-component-control epbl-component-color-palette">
										<h3 className="epbl-component-control__title">{  __( 'Title Background' ) }</h3>
										<ColorPalette
											value={ title_background }
											onChange={ value => setAttributes( { title_background: value } ) }
										/>
									</div>
									<div className="epbl-inspector-panel__component epbl-component-control">
										<TypographyControl 
												optionsLabel = 'title_typography' 
												{ ...this.props }
											/>
									</div>
								</PanelBody>
								<PanelBody className="epbl-inspector-panel" title = { __( "Icon" ) }>
									<div className='epbl-inspector-panel__component'>
										<h3 className="epbl-component-control__title">{  __( 'Size' ) }</h3>
										<RangeScaledControl
											size = { icon_size }
											sizeLabel = { 'icon_size' }
											min={ 6 }
											max={ 100 }
											initialPosition={ icon_size }
											steps = { 1 }
											hideTabs = { true }
											{ ...this.props }
										/>
									</div>
									<div className="epbl-inspector-panel__component">
										<BorderSizesControl
											optionsLabel = 'icon_padding'
											label = { __( "Icon Padding" ) }
											min = { 0 }
											max = { 100 }
											steps = { 1 }
											{ ...this.props } 
										/>
									</div>
									<div className="epbl-inspector-panel__component">
										<BorderSizesControl
											optionsLabel = 'icon_margin'
											label = { __( "Icon Margin" ) }
											min = { 0 }
											max = { 100 }
											steps = { 1 }
											{ ...this.props } 
										/>
									</div>
									<div className="epbl-inspector-panel__component epbl-component-control epbl-component-color-palette">
										<h3 className="epbl-component-control__title">{  __( 'Color' ) }</h3>
										<ColorPalette
											value={ icon_color }
											onChange={ value => setAttributes( { icon_color: value } ) }
										/>
									</div>
									<div className="epbl-inspector-panel__component epbl-component-control epbl-component-color-palette">
										<h3 className="epbl-component-control__title">{  __( 'Hover' ) }</h3>
										<ColorPalette
											value={ icon_colorHover }
											onChange={ value => setAttributes( { icon_colorHover: value } ) }
										/>
									</div>
								</PanelBody>
								<PanelBody className="epbl-inspector-panel" title = { __( "Text" ) }>
									<div className="epbl-inspector-panel__component epbl-component-control epbl-component-color-palette">
										<h3 className="epbl-component-control__title">{  __( 'Text Color' ) }</h3>
										<ColorPalette
											value={ text_color }
											onChange={ value => setAttributes( { text_color: value } ) }
										/>
									</div>
									<div className="epbl-inspector-panel__component epbl-component-control epbl-component-color-palette">
										<h3 className="epbl-component-control__title">{  __( 'Hover' ) }</h3>
										<ColorPalette
											value={ text_colorHover }
											onChange={ value => setAttributes( { text_colorHover: value } ) }
										/>
									</div>
									<div className="epbl-inspector-panel__component">
										<RangeScaledControl
											controlLabel = { __( "Text Indent" ) }
											size = { text_indent }
											sizeLabel = { 'text_indent' }
											min = { 0 }
											max = { 50 }
											initialPosition = { text_indent }
											steps = { 1 }
											hideTabs = { true }
											{ ...this.props }
										/>
									</div>
									<div className='epbl-inspector-panel__component' >
										<TypographyControl 
											optionsLabel = 'text_typography' 
											{ ...this.props }
										/>
									</div>
								</PanelBody>
							</EditorTabBody>
							
							{ /** Advanced Tab */ }
							<EditorTabBody type='Advanced'>
								<PanelBody className="epbl-inspector-panel" title = { __( "Block Settings" ) }>
									<div className="epbl-inspector-panel__component epbl-component-control epbl-component-group-control-spacing">
										<h3 className="epbl-component-control__title">{  __( 'Margin (px)' ) }</h3>
										<RangeScaledControl
											beforeSVG = { icons['padding_top'] }
											wrapClass = 'condensed'
											size = { advancedMarginTop }
											sizeLabel = { 'advancedMarginTop' }
											min={ 0 }
											max={ 100 }
											initialPosition={ advancedMarginTop }
											steps = { 1 }
											hideTabs = { true }
											{ ...this.props }
										/>
										<RangeScaledControl
											beforeSVG = { icons['padding_right'] }
											wrapClass = 'condensed'
											size = { advancedMarginRight }
											sizeLabel = { 'advancedMarginRight' }
											min={ 0 }
											max={ 100 }
											initialPosition={ advancedMarginRight }
											steps = { 1 }
											hideTabs = { true }
											{ ...this.props }
										/>
										<RangeScaledControl
											beforeSVG = { icons['padding_bottom'] }
											wrapClass = 'condensed'
											size = { advancedMarginBottom }
											sizeLabel = { 'advancedMarginBottom' }
											min={ 0 }
											max={ 100 }
											initialPosition={ advancedMarginBottom }
											steps = { 1 }
											hideTabs = { true }
											{ ...this.props }
										/>
										<RangeScaledControl
											beforeSVG = { icons['padding_left'] }
											wrapClass = 'condensed'
											size = { advancedMarginLeft }
											sizeLabel = { 'advancedMarginLeft' }
											min={ 0 }
											max={ 100 }
											initialPosition={ advancedMarginLeft }
											steps = { 1 }
											hideTabs = { true }
											{ ...this.props }
										/>
									</div>
									<div className="epbl-inspector-panel__component epbl-component-control epbl-component-group-control-spacing">
										<h3 className="epbl-component-control__title">{  __( 'Padding (px)' ) }</h3>
										<RangeScaledControl
											beforeSVG = { icons['padding_top'] }
											wrapClass = 'condensed'
											size = { advancedPaddingTop }
											sizeLabel = { 'advancedPaddingTop' }
											min={ 0 }
											max={ 100 }
											initialPosition={ advancedPaddingTop }
											steps = { 1 }
											hideTabs = { true }
											{ ...this.props }
										/>
										<RangeScaledControl
											beforeSVG = { icons['padding_right'] }
											wrapClass = 'condensed'
											size = { advancedPaddingRight }
											sizeLabel = { 'advancedPaddingRight' }
											min={ 0 }
											max={ 100 }
											initialPosition={ advancedPaddingRight }
											steps = { 1 }
											hideTabs = { true }
											{ ...this.props }
										/>
										<RangeScaledControl
											beforeSVG = { icons['padding_bottom'] }
											wrapClass = 'condensed'
											size = { advancedPaddingBottom }
											sizeLabel = { 'advancedPaddingBottom' }
											min={ 0 }
											max={ 100 }
											initialPosition={ advancedPaddingBottom }
											steps = { 1 }
											hideTabs = { true }
											{ ...this.props }
										/>
										<RangeScaledControl
											beforeSVG = { icons['padding_left'] }
											wrapClass = 'condensed'
											size = { advancedPaddingLeft }
											sizeLabel = { 'advancedPaddingLeft' }
											min={ 0 }
											max={ 100 }
											initialPosition={ advancedPaddingLeft }
											steps = { 1 }
											hideTabs = { true }
											{ ...this.props }
										/>
									</div>
									
									<div className="epbl-inspector-panel__component epbl-component-control epbl-component-control-text-horizontal">
										<TextControl
											label={ __( 'Z-Index' ) }
											value={ advancedZIndex }
											onChange={ value => setAttributes( { advancedZIndex: value } ) }
										/>
									</div>
									<div className="epbl-inspector-panel__component epbl-component-control epbl-component-control-text-horizontal">
										<TextControl
											label={ __( 'CSS Classes' ) }
											value={ advancedClass }
											onChange={ value => setAttributes( { advancedClass: value } ) }
										/>
									</div>
								</PanelBody>
								<PanelBody className="epbl-inspector-panel" title = { __( "Block Border" ) }>
									<div className="epbl-inspector-panel__component epbl-component-control epbl-component-control-select-horizontal">
										<SelectControl
											label={ __( "Border Type" ) }
											value={ advancedBorderType }
											onChange={ (value) => setAttributes({ advancedBorderType : value }) }
											options={ [
												{ label: __( "None" ), value: '' },
												{ label: __( "Solid" ), value: 'solid' },
												{ label: __( "Double" ), value: 'double' },
												{ label: __( "Dotted" ), value: 'dotted' },
												{ label: __( "Dashed" ), value: 'dashed' },
												{ label: __( "Groove" ), value: 'groove' }
											]}
										/>
									</div>
									<div className="epbl-inspector-panel__component epbl-component-control epbl-component-group-control-spacing">
										<h3 className="epbl-component-control__title">{  __( 'Border Width (px)' ) }</h3>
										<RangeScaledControl
											beforeSVG = { icons['padding_top'] }
											wrapClass = 'condensed'
											size = { advancedBorderWidthTop }
											sizeLabel = { 'advancedBorderWidthTop' }
											min={ 0 }
											max={ 100 }
											initialPosition={ advancedBorderWidthTop }
											steps = { 1 }
											hideTabs = { true }
											{ ...this.props }
										/>
										<RangeScaledControl
											beforeSVG = { icons['padding_right'] }
											wrapClass = 'condensed'
											size = { advancedBorderWidthRight }
											sizeLabel = { 'advancedBorderWidthRight' }
											min={ 0 }
											max={ 100 }
											initialPosition={ advancedBorderWidthRight }
											steps = { 1 }
											hideTabs = { true }
											{ ...this.props }
										/>
										<RangeScaledControl
											beforeSVG = { icons['padding_bottom'] }
											wrapClass = 'condensed'
											size = { advancedBorderWidthBottom }
											sizeLabel = { 'advancedBorderWidthBottom' }
											min={ 0 }
											max={ 100 }
											initialPosition={ advancedBorderWidthBottom }
											steps = { 1 }
											hideTabs = { true }
											{ ...this.props }
										/>
										<RangeScaledControl
											beforeSVG = { icons['padding_left'] }
											wrapClass = 'condensed'
											size = { advancedBorderWidthLeft }
											sizeLabel = { 'advancedBorderWidthLeft' }
											min={ 0 }
											max={ 100 }
											initialPosition={ advancedBorderWidthLeft }
											steps = { 1 }
											hideTabs = { true }
											{ ...this.props }
										/>
									</div>
									<div className="epbl-inspector-panel__component epbl-component-control epbl-component-control epbl-component-color-palette">
										<h3 className="epbl-component-control__title">{  __( 'Border Color' ) }</h3>
										<ColorPalette
											value={ advancedBorderColor }
											onChange={ value => setAttributes( { advancedBorderColor: value } ) }
										/>
									</div>
									<div className="epbl-inspector-panel__component">
										<RangeScaledControl
											controlLabel = { __( 'Border Radius' ) }
											size = { advancedBorderRadius }
											sizeLabel = { 'advancedBorderRadius' }
											min={ 0 }
											max={ 100 }
											initialPosition={ advancedBorderRadius }
											steps = { 1 }
											hideTabs = { true }
											{ ...this.props }
										/>
									</div>
									<div className="epbl-inspector-panel__component">
										<BoxShadowControl
											optionsLabel="advancedBoxShadow"
											{ ...this.props }
										/>
									</div>
								</PanelBody>
								<PanelBody className="epbl-inspector-panel" title = { __( "Responsive" ) }>
									<div className="epbl-inspector-panel__component">
										<ToggleControl
											label={ __( 'Hide on Desktop' )}
											checked={ hideOnDesktop }
											onChange={ ( value ) => setAttributes( { hideOnDesktop: ! hideOnDesktop } ) }
										/>
									</div>
									<div className="epbl-inspector-panel__component">
										<ToggleControl
											label={ __( 'Hide on Tablets' )}
											checked={ hideOnTablet }
											onChange={ ( value ) => setAttributes( { hideOnTablet: ! hideOnTablet } ) }
										/>
									</div>
									<div className="epbl-inspector-panel__component">
										<ToggleControl
											label={ __( 'Hide on Mobile' )}
											checked={ hideOnMobile }
											onChange={ ( value ) => setAttributes( { hideOnMobile: ! hideOnMobile } ) }
										/>
									</div>
								</PanelBody>
							</EditorTabBody>
						</EditorTabs>
					</div>

				</InspectorControls>

				{/* 3. display block */}
				
				<ServerSideRender
					block="echo-document-blocks/kb-categories"
					attributes = {{
						block_id : this.props.attributes.block_id,
						blockType : this.props.attributes.blockType,
						templateId : this.props.attributes.templateId,
						kb_id : this.props.attributes.kb_id,
						title_text : this.props.attributes.title_text,
						list_alignment : this.props.attributes.list_alignment,						
						categories_filter : this.props.attributes.categories_filter,
						categories_ids_text : this.props.attributes.categories_ids_text,
						title_HTMLTag : this.props.attributes.title_HTMLTag,
						title_level : this.props.attributes.title_level,
						icon_position : this.props.attributes.icon_position,
						advancedClass : this.props.attributes.advancedClass,
						title_toggle : this.props.attributes.title_toggle,
					}}
				/>
			</Fragment>
		)
	}
	
	/* Toolbars icons */
	listAlignmentControl( position, list_alignment ) {
		
		let icon = 'editor-alignleft';
		let title = __( 'Left');
		
		if ( position == 'center' ) {
			icon = 'editor-aligncenter';
			title = __( 'Center');
		}
		
		if ( position == 'right' ) {
			icon = 'editor-alignright';
			title = __( 'Right');
		}
		
		return {
            icon: icon,
            title: title,
            isActive: list_alignment === position,
            onClick: () => this.props.setAttributes( { list_alignment: position } ),
        };
	}

	iconPositionControl( position, icon_position ) {
		return {
            icon: ( position == 'icon-first' ) ? 'arrow-left-alt' : 'arrow-right-alt',
            title: ( position == 'icon-first' ) ? __('Left') : __('Right'),
            isActive: icon_position === position,
            onClick: () => this.props.setAttributes( { icon_position: position } ),
        };
	}
}
