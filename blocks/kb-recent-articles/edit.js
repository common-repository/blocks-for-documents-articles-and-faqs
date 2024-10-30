/**
 * KB: Recent Articles
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

export default class EPBL_KB_Articles extends Component {

	constructor() {
		super( ...arguments );
	}

	// runs after the component output has been rendered to the DOM
	componentDidMount() {
		// save ID of the block for reference
		this.props.setAttributes( { block_id: this.props.clientId } );
		
		// Pushing Style tag for this block css.
		const styleElement = document.createElement( "style" );
		styleElement.setAttribute( "id", "epbl-section-recent-articles-style-" + this.props.clientId );
		document.head.appendChild( styleElement );
	}

	render() {

		const {
			attributes: {

				block_id, blockType, templateId,
				
				// Knowledge Base 
				kb_id,
				
				// Title 
				title_toggle,
				title_text,
				title_level,
				title_HTMLTag,
				
				// Articles 
				order_by,
				nof,
				
				// General 
				list_layout,
				list_alignment,
				icon_position,
				
				// Title
				title_padding_top, title_padding_right, title_padding_bottom, title_padding_left,
				title_color,
				title_backgroundColor,
				title_typography,
				
				// Article Icon
				icon_size,
				icon_margin_top, icon_margin_right, icon_margin_bottom, icon_margin_left,
				icon_padding_top, icon_padding_right, icon_padding_bottom, icon_padding_left,
				icon_color,
				
				// Article 
				articleText_typography,
				articleText_margin_top, articleText_margin_right, articleText_margin_bottom, articleText_margin_left,
				articleText_padding_top, articleText_padding_right, articleText_padding_bottom, articleText_padding_left,
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
				
				cssClass,
				cssReset,
				
			},
			className,
			setAttributes,
			insertBlocksAfter,
			mergeBlocks,
			onReplace
		} = this.props;
		
		const element = document.getElementById( "epbl-section-recent-articles-style-" + this.props.clientId );
		if ( element != null && typeof element != "undefined" ) {
			element.innerHTML = generate_style( this.props );
		}
		
		return (
		
			<Fragment>
				
				{/* 1. show in block Toolbar */}
				<BlockControls key='controls'></BlockControls>

				{/* 2. show configuration in Inspector */}
				<InspectorControls>
					
					<EditorBlockTemplate attributes={this.props.attributes} blockName={"recent-articles"} setAttributes={setAttributes} />
					<div id={"epbl-inspector-blocks"}>
						<EditorTabs>
							{ /** Content Tab */ }
							<EditorTabBody type='Content' active={true}>
								<PanelBody className="epbl-inspector-panel" title = { __( "Knowledge Base" ) }>
									<div className="epbl-inspector-panel__component epbl-component-control">
										<KbSelect attributes={this.props.attributes} setAttributes={setAttributes} />
									</div>
								</PanelBody>
								<PanelBody className="epbl-inspector-panel" title = { __( "Title" ) }>
									<div className="epbl-inspector-panel__component epbl-component-control">
										<ToggleControl
											label={ __( 'Show Title' )}
											checked={ title_toggle }
											onChange={ ( value ) => setAttributes( { title_toggle: ! title_toggle } ) }
										/>
									</div>
									<div className={ this.props.attributes.title_toggle ? 'epbl-inspector-panel__component epbl-component-control' : 'hidden' } >
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
								</PanelBody>
								<PanelBody className="epbl-inspector-panel" title = { __( "Articles" ) }>
									<div className="epbl-inspector-panel__component epbl-component-control epbl-component-control-select-horizontal">
										<SelectControl
											label={ __( "Order By" ) }
											value={ order_by }
											onChange={ ( value ) => setAttributes( { order_by: value } ) }
											options={[
												{ value: 'date', label: __( 'Creation Date' ) },
												{ value: 'modified', label: __( 'Modification Date' ) },
											]}
										/>
									</div>
									<div className="epbl-inspector-panel__component epbl-component-control">
										<RangeScaledControl
											controlLabel = { __( "Number of Articles" ) }
											size = { nof }
											sizeLabel = { 'nof' }
											min={ 1 }
											max={ 20 }
											initialPosition={ nof }
											steps = { 1 }
											hideTabs = { true }
											{ ...this.props }
										/>
									</div>
								</PanelBody>
							</EditorTabBody>

							{ /** Style Tab */ }
							<EditorTabBody type='Style'>
								<PanelBody className="epbl-inspector-panel" title = { __( "General" ) }>
									<div className="epbl-inspector-panel__component epbl-component-control epbl-component-control-select-icon-horizontal">
										<h3 className="epbl-component-control__title">{ __('Layout') }</h3>
										<Toolbar controls={ [ 'col', 'row' ].map( (item) => this.listLayoutControl( item, list_layout ) ) } />
									</div>
									<div className="epbl-inspector-panel__component epbl-component-control epbl-component-control-select-icon-horizontal">
										<h3 className="epbl-component-control__title">{ __('Alignment') }</h3>
										<Toolbar controls={ [ 'flex-start', 'center', 'flex-end' ].map( (item) => this.listAlignmentControl( item, list_alignment ) ) } />
									</div>
									<div className="epbl-inspector-panel__component epbl-component-control epbl-component-control-select-icon-horizontal">
										<h3 className="epbl-component-control__title">{ __('Icon Position') }</h3>
										<Toolbar controls={ [ 'icon-first', 'icon-last' ].map( (item) => this.iconPositionControl( item, icon_position ) ) } />
									</div>
								</PanelBody>
								<PanelBody className="epbl-inspector-panel" title = { __( "Title" ) }>
									<div className="epbl-inspector-panel__component epbl-component-control  epbl-component-group-control-spacing">
										<h3 className="epbl-component-control__title">{  __( 'Padding (px)' ) }</h3>
										<RangeScaledControl
											beforeSVG = { icons['padding_top'] }
											wrapClass = 'condensed'
											size = { title_padding_top }
											sizeLabel = { 'title_padding_top' }
											min={ 0 }
											max={ 100 }
											initialPosition={ title_padding_top }
											steps = { 1 }
											hideTabs = { true }
											{ ...this.props }
										/>
										<RangeScaledControl
											beforeSVG = { icons['padding_right'] }
											wrapClass = 'condensed'
											size = { title_padding_right }
											sizeLabel = { 'title_padding_right' }
											min={ 0 }
											max={ 100 }
											initialPosition={ title_padding_right }
											steps = { 1 }
											hideTabs = { true }
											{ ...this.props }
										/>
										<RangeScaledControl
											beforeSVG = { icons['padding_bottom'] }
											wrapClass = 'condensed'
											size = { title_padding_bottom }
											sizeLabel = { 'title_padding_bottom' }
											min={ 0 }
											max={ 100 }
											initialPosition={ title_padding_bottom }
											steps = { 1 }
											hideTabs = { true }
											{ ...this.props }
										/>
										<RangeScaledControl
											beforeSVG = { icons['padding_left'] }
											wrapClass = 'condensed'
											size = { title_padding_left }
											sizeLabel = { 'title_padding_left' }
											min={ 0 }
											max={ 100 }
											initialPosition={ title_padding_left }
											steps = { 1 }
											hideTabs = { true }
											{ ...this.props }
										/>
									</div>
									<div className="epbl-inspector-panel__component epbl-component-control epbl-component-color-palette">
										<h3 className="epbl-component-control__title">{  __( 'Text Color' ) }</h3>
										<ColorPalette
											value={ title_color }
											onChange={ value => setAttributes( { title_color: value } ) }
										/>
									</div>
									<div className="epbl-inspector-panel__component epbl-component-control epbl-component-color-palette">
										<h3 className="epbl-component-control__title">{  __( 'Background Color' ) }</h3>
										<ColorPalette
											value={ title_backgroundColor }
											onChange={ value => setAttributes( { title_backgroundColor: value } ) }
										/>
									</div>
									<div className={ this.props.attributes.title_toggle ? 'epbl-inspector-panel__component epbl-component-control' : 'hidden' } >
										<TypographyControl 
											optionsLabel = 'title_typography' 
											{ ...this.props }
										/>
									</div>
								</PanelBody>
								<PanelBody className="epbl-inspector-panel" title = { __( "Article Icon" ) }>
									<div className="epbl-inspector-panel__component epbl-component-control">
										<RangeScaledControl
											controlLabel = { __( "Icon Size" ) }
											size = { icon_size }
											sizeLabel = { 'icon_size' }
											min = { 5 }
											max = { 200 }
											initialPosition = { icon_size }
											steps = { 1 }
											hideTabs = { true }
											{ ...this.props }
										/>
									</div>
									<div className="epbl-inspector-panel__component epbl-component-control  epbl-component-group-control-spacing">
										<h3 className="epbl-component-control__title">{  __( 'Margin (px)' ) }</h3>
										<RangeScaledControl
											beforeSVG = { icons['padding_top'] }
											wrapClass = 'condensed'
											size = { icon_margin_top }
											sizeLabel = { 'icon_margin_top' }
											min={ 0 }
											max={ 100 }
											initialPosition={ icon_margin_top }
											steps = { 1 }
											hideTabs = { true }
											{ ...this.props }
										/>
										<RangeScaledControl
											beforeSVG = { icons['padding_right'] }
											wrapClass = 'condensed'
											size = { icon_margin_right }
											sizeLabel = { 'icon_margin_right' }
											min={ 0 }
											max={ 100 }
											initialPosition={ icon_margin_right }
											steps = { 1 }
											hideTabs = { true }
											{ ...this.props }
										/>
										<RangeScaledControl
											beforeSVG = { icons['padding_bottom'] }
											wrapClass = 'condensed'
											size = { icon_margin_bottom }
											sizeLabel = { 'icon_margin_bottom' }
											min={ 0 }
											max={ 100 }
											initialPosition={ icon_margin_bottom }
											steps = { 1 }
											hideTabs = { true }
											{ ...this.props }
										/>
										<RangeScaledControl
											beforeSVG = { icons['padding_left'] }
											wrapClass = 'condensed'
											size = { icon_margin_left }
											sizeLabel = { 'icon_margin_left' }
											min={ 0 }
											max={ 100 }
											initialPosition={ icon_margin_left }
											steps = { 1 }
											hideTabs = { true }
											{ ...this.props }
										/>
									</div>
									<div className="epbl-inspector-panel__component epbl-component-control  epbl-component-group-control-spacing">
										<h3 className="epbl-component-control__title">{  __( 'Padding (px)' ) }</h3>
										<RangeScaledControl
											beforeSVG = { icons['padding_top'] }
											wrapClass = 'condensed'
											size = { icon_padding_top }
											sizeLabel = { 'icon_padding_top' }
											min={ 0 }
											max={ 100 }
											initialPosition={ icon_padding_top }
											steps = { 1 }
											hideTabs = { true }
											{ ...this.props }
										/>
										<RangeScaledControl
											beforeSVG = { icons['padding_right'] }
											wrapClass = 'condensed'
											size = { icon_padding_right }
											sizeLabel = { 'icon_padding_right' }
											min={ 0 }
											max={ 100 }
											initialPosition={ icon_padding_right }
											steps = { 1 }
											hideTabs = { true }
											{ ...this.props }
										/>
										<RangeScaledControl
											beforeSVG = { icons['padding_bottom'] }
											wrapClass = 'condensed'
											size = { icon_padding_bottom }
											sizeLabel = { 'icon_padding_bottom' }
											min={ 0 }
											max={ 100 }
											initialPosition={ icon_padding_bottom }
											steps = { 1 }
											hideTabs = { true }
											{ ...this.props }
										/>
										<RangeScaledControl
											beforeSVG = { icons['padding_left'] }
											wrapClass = 'condensed'
											size = { icon_padding_left }
											sizeLabel = { 'icon_padding_left' }
											min={ 0 }
											max={ 100 }
											initialPosition={ icon_padding_left }
											steps = { 1 }
											hideTabs = { true }
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
								</PanelBody>
								<PanelBody className="epbl-inspector-panel" title = { __( "Article" ) }>
									<div className={ this.props.attributes.title_toggle ? 'epbl-inspector-panel__component epbl-component-control' : 'hidden' } >
										<TypographyControl 
											optionsLabel = 'articleText_typography' 
											{ ...this.props }
										/>
									</div>
									<div className="epbl-inspector-panel__component epbl-component-control  epbl-component-group-control-spacing">
										<h3 className="epbl-component-control__title">{  __( 'Margin (px)' ) }</h3>
										<RangeScaledControl
											beforeSVG = { icons['padding_top'] }
											wrapClass = 'condensed'
											size = { articleText_margin_top }
											sizeLabel = { 'articleText_margin_top' }
											min={ 0 }
											max={ 100 }
											initialPosition={ articleText_margin_top }
											steps = { 1 }
											hideTabs = { true }
											{ ...this.props }
										/>
										<RangeScaledControl
											beforeSVG = { icons['padding_right'] }
											wrapClass = 'condensed'
											size = { articleText_margin_right }
											sizeLabel = { 'articleText_margin_right' }
											min={ 0 }
											max={ 100 }
											initialPosition={ articleText_margin_right }
											steps = { 1 }
											hideTabs = { true }
											{ ...this.props }
										/>
										<RangeScaledControl
											beforeSVG = { icons['padding_bottom'] }
											wrapClass = 'condensed'
											size = { articleText_margin_bottom }
											sizeLabel = { 'articleText_margin_bottom' }
											min={ 0 }
											max={ 100 }
											initialPosition={ articleText_margin_bottom }
											steps = { 1 }
											hideTabs = { true }
											{ ...this.props }
										/>
										<RangeScaledControl
											beforeSVG = { icons['padding_left'] }
											wrapClass = 'condensed'
											size = { articleText_margin_left }
											sizeLabel = { 'articleText_margin_left' }
											min={ 0 }
											max={ 100 }
											initialPosition={ articleText_margin_left }
											steps = { 1 }
											hideTabs = { true }
											{ ...this.props }
										/>
									</div>
									<div className="epbl-inspector-panel__component epbl-component-control  epbl-component-group-control-spacing">
										<h3 className="epbl-component-control__title">{  __( 'Padding (px)' ) }</h3>
										<RangeScaledControl
											beforeSVG = { icons['padding_top'] }
											wrapClass = 'condensed'
											size = { articleText_padding_top }
											sizeLabel = { 'articleText_padding_top' }
											min={ 0 }
											max={ 100 }
											initialPosition={ articleText_padding_top }
											steps = { 1 }
											hideTabs = { true }
											{ ...this.props }
										/>
										<RangeScaledControl
											beforeSVG = { icons['padding_right'] }
											wrapClass = 'condensed'
											size = { articleText_padding_right }
											sizeLabel = { 'articleText_padding_right' }
											min={ 0 }
											max={ 100 }
											initialPosition={ articleText_padding_right }
											steps = { 1 }
											hideTabs = { true }
											{ ...this.props }
										/>
										<RangeScaledControl
											beforeSVG = { icons['padding_bottom'] }
											wrapClass = 'condensed'
											size = { articleText_padding_bottom }
											sizeLabel = { 'articleText_padding_bottom' }
											min={ 0 }
											max={ 100 }
											initialPosition={ articleText_padding_bottom }
											steps = { 1 }
											hideTabs = { true }
											{ ...this.props }
										/>
										<RangeScaledControl
											beforeSVG = { icons['padding_left'] }
											wrapClass = 'condensed'
											size = { articleText_padding_left }
											sizeLabel = { 'articleText_padding_left' }
											min={ 0 }
											max={ 100 }
											initialPosition={ articleText_padding_left }
											steps = { 1 }
											hideTabs = { true }
											{ ...this.props }
										/>
									</div>
									<div className="epbl-inspector-panel__component epbl-component-control epbl-component-color-palette">
										<h3 className="epbl-component-control__title">{  __( 'Color' ) }</h3>
										<ColorPalette
											value={ articleText_color }
											onChange={ value => setAttributes( { articleText_color: value } ) }
										/>
									</div>
									<div className="epbl-inspector-panel__component epbl-component-control epbl-component-color-palette">
										<h3 className="epbl-component-control__title">{  __( 'Background Color' ) }</h3>
										<ColorPalette
											value={ articleText_backgroundColor }
											onChange={ value => setAttributes( { articleText_backgroundColor: value } ) }
										/>
									</div>
									<div className="epbl-inspector-panel__component epbl-component-control-select-horizontal">
										<SelectControl
											label={ __( "Border Type" ) }
											value={ articleText_borderType }
											onChange={ (value) => setAttributes({ articleText_borderType : value }) }
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
									<div className="epbl-inspector-panel__component epbl-component-control  epbl-component-group-control-spacing">
										<h3 className="epbl-component-control__title">{  __( 'Border Width (px)' ) }</h3>
										<RangeScaledControl
											beforeSVG = { icons['padding_top'] }
											wrapClass = 'condensed'
											size = { articleText_BorderWidthTop }
											sizeLabel = { 'articleText_BorderWidthTop' }
											min={ 0 }
											max={ 100 }
											initialPosition={ articleText_BorderWidthTop }
											steps = { 1 }
											hideTabs = { true }
											{ ...this.props }
										/>
										<RangeScaledControl
											beforeSVG = { icons['padding_right'] }
											wrapClass = 'condensed'
											size = { articleText_BorderWidthRight }
											sizeLabel = { 'articleText_BorderWidthRight' }
											min={ 0 }
											max={ 100 }
											initialPosition={ articleText_BorderWidthRight }
											steps = { 1 }
											hideTabs = { true }
											{ ...this.props }
										/>
										<RangeScaledControl
											beforeSVG = { icons['padding_bottom'] }
											wrapClass = 'condensed'
											size = { articleText_BorderWidthBottom }
											sizeLabel = { 'articleText_BorderWidthBottom' }
											min={ 0 }
											max={ 100 }
											initialPosition={ articleText_BorderWidthBottom }
											steps = { 1 }
											hideTabs = { true }
											{ ...this.props }
										/>
										<RangeScaledControl
											beforeSVG = { icons['padding_left'] }
											wrapClass = 'condensed'
											size = { articleText_BorderWidthLeft }
											sizeLabel = { 'articleText_BorderWidthLeft' }
											min={ 0 }
											max={ 100 }
											initialPosition={ articleText_BorderWidthLeft }
											steps = { 1 }
											hideTabs = { true }
											{ ...this.props }
										/>
									</div>
									<div className="epbl-inspector-panel__component epbl-component-control epbl-component-color-palette">
										<h3 className="epbl-component-control__title">{  __( 'Border Color' ) }</h3>
										<ColorPalette
											value={ articleText_BorderColor }
											onChange={ value => setAttributes( { articleText_BorderColor: value } ) }
										/>
									</div>
									<div className="epbl-inspector-panel__component epbl-component-control">
										<RangeScaledControl
											controlLabel = { __( 'Border Radius' ) }
											size = { articleText_BorderRadius }
											sizeLabel = { 'articleText_BorderRadius' }
											min={ 0 }
											max={ 100 }
											initialPosition={ articleText_BorderRadius }
											steps = { 1 }
											hideTabs = { true }
											{ ...this.props }
										/>
									</div>
									<div className="epbl-inspector-panel__component epbl-component-control epbl-component-color-palette">
										<h3 className="epbl-component-control__title">{  __( 'Hover Text Color' ) }</h3>
										<ColorPalette
											value={ articleText_colorHover }
											onChange={ value => setAttributes( { articleText_colorHover: value } ) }
										/>
									</div>
									<div className="epbl-inspector-panel__component epbl-component-control epbl-component-color-palette">
										<h3 className="epbl-component-control__title">{  __( 'Hover Background Color' ) }</h3>
										<ColorPalette
											value={ articleText_backgroundColorHover }
											onChange={ value => setAttributes( { articleText_backgroundColorHover: value } ) }
										/>
									</div>
									<div className="epbl-inspector-panel__component epbl-component-control epbl-component-color-palette">
										<h3 className="epbl-component-control__title">{  __( 'Icon Hover Color' ) }</h3>
										<ColorPalette
											value={ icon_colorHover }
											onChange={ value => setAttributes( { icon_colorHover: value } ) }
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
									<div className="epbl-inspector-panel__component epbl-component-control  epbl-component-group-control-spacing">
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
											initialPosition={ advancedBorderWidthRight }
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
									<div className="epbl-inspector-panel__component epbl-component-control  epbl-component-color-palette">
										<h3 className="epbl-component-control__title">{  __( 'Border Color' ) }</h3>
										<ColorPalette
											value={ advancedBorderColor }
											onChange={ value => setAttributes( { advancedBorderColor: value } ) }
										/>
									</div>
									<div className="epbl-inspector-panel__component epbl-component-control">
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
									<div className="epbl-inspector-panel__component epbl-component-control">
										<BoxShadowControl
											optionsLabel="advancedBoxShadow"
											{ ...this.props }
										/>
									</div>
								</PanelBody>
								<PanelBody className="epbl-inspector-panel" title = { __( "Responsive" ) }>
									<div className="epbl-inspector-panel__component epbl-component-control">
										<ToggleControl
											label={ __( 'Hide on Desktop' )}
											checked={ hideOnDesktop }
											onChange={ ( value ) => setAttributes( { hideOnDesktop: ! hideOnDesktop } ) }
										/>
									</div>
									<div className="epbl-inspector-panel__component epbl-component-control">
										<ToggleControl
											label={ __( 'Hide on Tablets' )}
											checked={ hideOnTablet }
											onChange={ ( value ) => setAttributes( { hideOnTablet: ! hideOnTablet } ) }
										/>
									</div>
									<div className="epbl-inspector-panel__component epbl-component-control">
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
					block="echo-document-blocks/kb-articles"
					attributes = {{
						advancedClass : this.props.attributes.advancedClass, 
						blockType : this.props.attributes.blockType,
						block_id : this.props.attributes.block_id,
						kb_id : this.props.attributes.kb_id,
						list_layout : this.props.attributes.list_layout,
						nof : this.props.attributes.nof,
						order_by : this.props.attributes.order_by,
						templateId : this.props.attributes.templateId,
						title_HTMLTag : this.props.attributes.title_HTMLTag,
						title_level : this.props.attributes.title_level,
						title_text : this.props.attributes.title_text,
						title_toggle : this.props.attributes.title_toggle,
						icon_position : this.props.attributes.icon_position,
					}}
				/>
			</Fragment>
		)
	}
	
	/* Toolbars icons */
	listLayoutControl( view, list_layout ) {
		return {
            icon: ( view == 'col' ) ? 'list-view' : 'editor-insertmore',
            title: ( view == 'col' ) ? __('Column') : __('Row'),
            isActive: list_layout === view,
            onClick: () => this.props.setAttributes( { list_layout: view } ),
        };
	}
	
	listAlignmentControl( position, list_alignment ) {
		
		let icon = 'editor-alignleft';
		let title = __( 'Left');
		
		if ( position == 'center' ) {
			icon = 'editor-aligncenter';
			title = __( 'Center');
		}
		
		if ( position == 'flex-end' ) {
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