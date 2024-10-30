/**
 * Knowledge Base editor output
 */

// Import block CSS
import './styles/style.scss';
import './styles/editor.scss';
import generate_style from "./styles/generate_style";
import RangeScaledControl from "../../components/range-scaled";
import EditorBlockTemplate from "../../components/editor-block-template.js";
import EditorTabs from "../../components/editor-tabs.js";
import EditorTabBody from "../../components/editor-tab-body.js";
import KbSelect from "../../components/kb-select.js";
import BoxShadowControl, {defaultBoxShadowFields, getBoxShadowStyles} from "../../components/box-shadow.js";
import icons from "../../assets/js/icons";

// common libraries
const { __ } = wp.i18n;
const { Component, Fragment } = wp.element;

// Register editor components
const {
	ColorPalette,
	BlockControls,
	InspectorControls
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
export default class EPBL_Knowledge_Base extends Component {

	constructor() {
		super( ...arguments );
	}

	// runs after the component output has been rendered to the DOM
	componentDidMount() {

		// save ID of the block for reference
		this.props.setAttributes( { block_id: this.props.clientId } );

		// Pushing Style tag for this block css.
		const styleElement = document.createElement( "style" );
		styleElement.setAttribute( "id", "epbl-section-kb-style-" + this.props.clientId );
		document.head.appendChild( styleElement );
	}

	render() {

		const {
			attributes: {

				block_id, blockType, templateId,
				
				// Knowledge Base 
				kb_id,
				
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
			insertBlocksAfter
		} = this.props;
		
		const element = document.getElementById( "epbl-section-kb-style-" + this.props.clientId );
		if ( element != null && typeof element != "undefined" ) {
			element.innerHTML = generate_style( this.props );
		}

		return (
			<Fragment>

				{/* 1. show in block Toolbar */}
				<BlockControls key='controls'></BlockControls>

				{/* 2. show configuration in Inspector */}
				<InspectorControls>

					<EditorBlockTemplate attributes={this.props.attributes} blockName={"knowledge-base"} setAttributes={setAttributes} />

					<div id={"epbl-inspector-blocks"}>
					<EditorTabs>
							{ /** Content Tab */ }
							<EditorTabBody type='Content' active={true}>
								<PanelBody className="epbl-inspector-panel" title = { __( "Knowledge Base" ) }>
									<div className="epbl-inspector-panel__component">
										<KbSelect attributes={this.props.attributes} setAttributes={setAttributes} />
									</div>
								</PanelBody>
							</EditorTabBody>
							
							{ /** Advanced Tab */ }
							<EditorTabBody type='Advanced'>
								<PanelBody className="epbl-inspector-panel" title = { __( "Block Settings" ) }>
									<div className="epbl-inspector-panel__component epbl-component-control  epbl-component-group-control-spacing">
										<h3 className="epbl-heading-options__title">{  __( 'Margin (px)' ) }</h3>
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
										<h3 className="epbl-heading-options__title">{  __( 'Padding (px)' ) }</h3>
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
									<div className="epbl-inspector-panel__component epbl-component-control  epbl-component-group-control-spacing">
										<h3 className="epbl-heading-options__title">{  __( 'Border Width (px)' ) }</h3>
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
										<h3 className="epbl-heading-options__title">{  __( 'Border Color' ) }</h3>
										<ColorPalette
											value={ advancedBorderColor }
											onChange={ value => setAttributes( { advancedBorderColor: value } ) }
										/>
									</div>
									<div className="epbl-inspector-panel__component epbl-component-control  epbl-component-group-control-spacing">
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
					block="echo-document-blocks/knowledge-base"
					attributes = {{
						block_id : this.props.attributes.block_id,
						blockType : this.props.attributes.blockType,
						templateId : this.props.attributes.templateId,
						kb_id : this.props.attributes.kb_id,
						advancedClass : this.props.attributes.advancedClass,
					}}
				/>

			</Fragment>
		)
	}
}
