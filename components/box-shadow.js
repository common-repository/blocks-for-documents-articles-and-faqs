/** 
 * Box Shadow component 
 * Use example: 
 * <BoxShadowControl
 * 	optionsLabel = 'name-of-the-props-item'
 *		{ ...this.props } // required
 * />
 * use getBoxShadowStyles() to show styles
 */

import generate_block_css from "../helpers/generate_block_css";

const { __ } = wp.i18n;
const {
	RangeControl,
	Button,
	Dashicon,
	SelectControl,
	Popover
} = wp.components;

const {
	ColorPalette,
} = wp.blockEditor;

const { Component, Fragment } = wp.element;

const defaultBoxShadowFields = {
	color: '',
	x: 0,
	y: 0,
	blur: 0,
	spread: 0,
	position: ''
};


/**
 * Main UI control component for Box Shadow
 */
class BoxShadowControl extends Component {

	constructor() {
		super( ...arguments );
		
		this.state = { 
			showReset: false,
			defaultValues: this.props.attributes[this.props.optionsLabel],
			popover: false,
		}
		
	}
	
	setValue( val, name ) {
		let newValues = {};
		newValues[this.props.optionsLabel] = Object.assign( {}, this.props.attributes[this.props.optionsLabel] );
		newValues[this.props.optionsLabel][name] = val;
		this.props.setAttributes( newValues );
		this.setState({ showReset: true });
	}

	render() {
		
		return ( 
			<Fragment>
				<div className="epbl-box-shadow">
					<div className="epbl-box-shadow__header">
						{ __( 'Box Shadow' ) }
					</div>
					<div className="epbl-box-shadow__buttons">
						{ this.state.showReset &&
							<Button isSecondary onClick={ () => {
									this.props.setAttributes( this.state.defaultValues ) 
									let newValues = {};
									newValues[this.props.optionsLabel] = Object.assign( {}, this.state.defaultValues );
									this.props.setAttributes( newValues );
									this.setState({ showReset: false });
								} }
							>
								<Dashicon icon="image-rotate" />
							</Button>
						}
						<Button isSecondary onClick={ () => this.setState({ popover: !this.state.popover }) }>
							<Dashicon icon="admin-tools" />
						</Button>
						{ this.state.popover && 
							<Popover
								className="epbl-box-shadow__modal"
								position="right bottom"
								onClose={ () => this.setState({ popover: false }) }
							>
								
								<h3 className="epbl-heading-options__title">{  __( 'Color' ) }</h3>
								<ColorPalette
									value={ this.props.attributes[this.props.optionsLabel].color }
									onChange={(val) => this.setValue( val, 'color' )}
								/>
								
								<RangeControl
									label={ __('Horizontal Offset') }
									value={[this.props.optionsLabel].x}
									onChange={(val) => this.setValue( val, 'x' )}
									min={-100}
									max={100}
									step={1}
									initialPosition={this.props.attributes[this.props.optionsLabel].x}
								/>
								
								<RangeControl
									label={ __('Vertical Offset') }
									value={[this.props.optionsLabel].y}
									onChange={(val) => this.setValue( val, 'y' )}
									min={-100}
									max={100}
									step={1}
									initialPosition={this.props.attributes[this.props.optionsLabel].y}
								/>
								
								<RangeControl
									label={ __('Blur') }
									value={[this.props.optionsLabel].blur}
									onChange={(val) => this.setValue( val, 'blur' )}
									min={0}
									max={100}
									step={1}
									initialPosition={this.props.attributes[this.props.optionsLabel].blur}
								/>
								
								<RangeControl
									label={ __('Spread') }
									value={[this.props.optionsLabel].spread}
									onChange={(val) => this.setValue( val, 'spread' )}
									min={-100}
									max={100}
									step={1}
									initialPosition={this.props.attributes[this.props.optionsLabel].spread}
								/>
								
								<SelectControl
									label= { __('Position') }
									value={ this.props.attributes[this.props.optionsLabel].position }
									options={ [
										{ label: __('Outline'), value: ''},
										{ label: __('Inset'), value: 'inset'}
									] }
									onChange={ ( val ) => this.setValue( val, 'position' ) }
								/>
								
							</Popover>
						}
						
					</div>
				</div>
			</Fragment>
		);
	}
}

function getBoxShadowStyles( selector, options ) {
	
	if ( ! options.color ) return '';
	
	let $selectors_desktop = {};
	$selectors_desktop[selector] = {
		'box-shadow' : options.x + 'px ' + options.y + 'px ' + options.blur + 'px ' + options.spread + 'px ' + options.color + ' ' + options.position
	};

	return generate_block_css($selectors_desktop, '');
}

export default BoxShadowControl;
export { defaultBoxShadowFields, getBoxShadowStyles };