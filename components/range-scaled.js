
const { __ } = wp.i18n;
const {
	RangeControl,
	ButtonGroup,
	Button,
	TabPanel,
	Dashicon,
} = wp.components;
const { Component, Fragment } = wp.element;

import map from "lodash/map"

/**
 * Main UI control component with range and scale to allow user to change custom block configuration.
 */
class RangeScaledControl extends Component {

	assemble_range_control(unitTypesControls, sizeValue, sizeValueName, beforeSVG) {

		let min = 0;
		let max = 1;

		if (  this.props.currentUnitType === '%' ) {
			min = 0;
			max = 100;
		} else if ( this.props.currentUnitType === 'em' ) {
			min = 0;
			max = 10;
		} else {
			min = this.props.min;
			max = this.props.max;
		}

		return (

			<Fragment>
				{unitTypesControls}
				{beforeSVG && 
					<div className="epbl-range-svg">{beforeSVG}</div>
				}
				<RangeControl
					label={__(this.props.controlLabel)}
					value={sizeValueName}
					onChange={(value) => this.props.setAttributes({[sizeValueName]: value})}
					min={min}
					max={max}
					step={this.props.steps}
					beforeIcon={this.props.iconName}
					initialPosition={this.props.initialPosition}
				/>
			</Fragment>
		);
	}

	render() {

		const { controlLabel, unitTypes, currentUnitType, unitTypeLabel,
				size, sizeLabel, sizeLabelDesktop, sizeLabelMobile, sizeLabelTablet, sizeDesktop, sizeMobile, sizeTablet, beforeSVG, wrapClass, hideTabs } = this.props;

		// DEVICES
		const devicesTabControl = ( size !== undefined || hideTabs ) ? "" : (

			<TabPanel className="epbl-range-options__size-type-field-tabs" activeClass="active-tab"
			          tabs={[
				          {
					          name: "desktop",
					          title: <Dashicon icon="desktop"/>,
					          className: "epbl-desktop-tab epbl-responsive-tabs",
				          },
				          {
					          name: "tablet",
					          title: <Dashicon icon="tablet"/>,
					          className: "epbl-tablet-tab epbl-responsive-tabs",
				          },
				          {
					          name: "smartphone",
					          title: <Dashicon icon="smartphone"/>,
					          className: "epbl-smartphone-tab epbl-responsive-tabs",
				          }
			          ]}>
				{
					(tab) => {
						let tabout;
						let sizeValueName = tab.name === "smartphone" ? sizeLabelMobile : ( tab.name === "tablet" ? sizeLabelTablet : sizeLabelDesktop);
						let sizeValue = tab.name === "smartphone" ? sizeMobile : ( tab.name === "tablet" ? sizeTablet : sizeDesktop);

						tabout = this.assemble_range_control( unitTypesControls, sizeValue, sizeValueName, beforeSVG );

						return tabout
					}
				}
			</TabPanel>
		);

		let unitTypesPair = "";
		if ( unitTypes === "px|em" ) {
			unitTypesPair = [ { key: "px", name: __( "px" ) }, { key: "em", name: __( "em" ) } ];
		} else if ( unitTypes === "px|%"  ) {
			unitTypesPair = [ { key: "px", name: __( "px" ) }, { key: "%", name: __( "%" ) } ];
		} else if ( unitTypes === "px|em|%"  ) {
			unitTypesPair = [
				{ key: "px", name: __( "px" ) },
				{ key: "em", name: __( "em" ) },
				{ key: "%", name: __( "%" ) }
				];
		}

		// UNITS of MEASURE ( PX / EM / % )
		const unitTypesControls = unitTypesPair === "" ? '' : (
			<ButtonGroup className="epbl-range-options__size-type-field" aria-label={controlLabel }>
				{ map( unitTypesPair, ( { name, key } ) => (
					<Button
						key={ key }
						className="epbl-size-btn"
						isSmall
						isPrimary={ currentUnitType === key }
						aria-pressed={ currentUnitType === key }
						onClick={ () => this.props.setAttributes( { [unitTypeLabel]: key } ) }
					>
						{ name }
					</Button>
				) ) }
			</ButtonGroup>
		);


		// FINAL OUTPUT
		const finalOutput = ( size === undefined && ! hideTabs ) ? devicesTabControl : this.assemble_range_control( unitTypesControls, size, sizeLabel, beforeSVG );
		
		const wrapperClass = ( typeof wrapClass !== 'undefined' ) ? 'epbl-range-options-container condensed' : 'epbl-range-options-container';
		
		return (
			<div className={wrapperClass}>
				{ finalOutput }
			</div>
		);
	}


}

RangeScaledControl.defaultProps = {
  beforeSVG: '',
  hideTabs: false
};

export default RangeScaledControl
