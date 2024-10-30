/** 
 * Border Sizes component 
 * Use example: 
 * <BorderSizesControl
 * 	optionsLabel = 'name-of-the-props-item',
 *		label = 'title',
 *		min = { 0 },
 *		max = { 100 },
 *		steps = { 1 }
 *		initialPosition={ 5 }
 *		{ ...this.props } // required
 * />
 * defaults:
 * values = {
 * 	top: 0,
 * 	right: 0,
 * 	bottom: 0,
 * 	left: 0,
 *	}
 */

import icons from "../assets/js/icons";

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

/**
 * Main UI control component for Border Sizes
 */
class BorderSizesControl extends Component {

	setValue( val, name ) {
		let newValues = {};
		newValues[this.props.optionsLabel] = Object.assign( {}, this.props.attributes[this.props.optionsLabel] );
		newValues[this.props.optionsLabel][name] = val;
		this.props.setAttributes( newValues );
	}

	render() {
		
		return ( 
			<Fragment>
				<div className="epbl-component-group-control-spacing epbl-border-sizes">
					<h3 className="epbl-heading-options__title">
						{ this.props.label }
					</h3>
					<div className="epbl-range-options-container condensed"> 
						<div className="epbl-range-svg">{ icons['padding_top'] }</div>
						<RangeControl
							value={[this.props.optionsLabel].top}
							onChange={ (value) => this.setValue(value, 'top') }
							min={this.props.min}
							max={this.props.max}
							step={this.props.steps}
							initialPosition={this.props.attributes[this.props.optionsLabel].top}
						/>
					</div>
					<div className="epbl-range-options-container condensed"> 
						<div className="epbl-range-svg">{ icons['padding_right'] }</div>
						<RangeControl
							value={[this.props.optionsLabel].right}
							onChange={ (value) => this.setValue(value, 'right') }
							min={this.props.min}
							max={this.props.max}
							step={this.props.steps}
							initialPosition={this.props.attributes[this.props.optionsLabel].right}
						/>
					</div>
					<div className="epbl-range-options-container condensed"> 
						<div className="epbl-range-svg">{ icons['padding_bottom'] }</div>
						<RangeControl
							value={[this.props.optionsLabel].bottom}
							onChange={ (value) => this.setValue(value, 'bottom') }
							min={this.props.min}
							max={this.props.max}
							step={this.props.steps}
							initialPosition={this.props.attributes[this.props.optionsLabel].bottom}
						/>
					</div>
					<div className="epbl-range-options-container condensed"> 
						<div className="epbl-range-svg">{ icons['padding_left'] }</div>
						<RangeControl
							value={[this.props.optionsLabel].left}
							onChange={ (value) => this.setValue(value, 'left') }
							min={this.props.min}
							max={this.props.max}
							step={this.props.steps}
							initialPosition={this.props.attributes[this.props.optionsLabel].left}
						/>
					</div>
				</div>
			</Fragment>
		);
	}
}

export default BorderSizesControl;