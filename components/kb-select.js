const { __ } = wp.i18n;
const {	SelectControl } = wp.components;
const { Component, Fragment } = wp.element;

$ = jQuery;

/**
 * Control to show KB selection component for KB blocks.
 * Only one component per page.
 */
class KbSelect extends Component {

	constructor() {
		super( ...arguments );
		
		this.state = {
			kb_id : this.props.attributes.kb_id,
			kbChoices: epbl_blocks_configuration.kbChoices,
		};
	}

	render() {
	
		// Some error happens 
		if ( ! this.state.kbChoices.length ) {
			return (
				<Fragment>
					<div className="epbl-kb-select-control">{__( 'Knowledge Base plugin is not active.')}</div>
				</Fragment>
			);
		}
		
		// Show nothing if we have only 1 KB 
		
		if ( this.state.kbChoices.length == 1 ) {
			return (
				<div className="epbl-component-control epbl-component-control-select-horizontal epbl-kb-select-control">
					<SelectControl
						label={ __( "Knowledge Base" ) }
						value={ this.state.kb_id }
						onChange={ (value) => this.props.setAttributes({ kb_id : parseInt(value) })  }
						options={ this.state.kbChoices }
					/>

					<div className="epbl-inspector-notice epbl-inspector-notice--note">
						{ __( 'Get') } <a href="https://www.echoknowledgebase.com/documentation/multiple-kbs-overview/" target="_blank">{ __( 'Multiple Knowledge Bases' )}</a> { __('add-on to use different Knowledge Bases')}
					</div>

				</div>
			);
		}
		
		// here we have more than one KB 
		return (
			<div className="epbl-kb-select-control">
				<SelectControl
					label={ __( "Select Knowledge Base to Use:" ) }
					value={ this.state.kb_id }
					onChange={ (value) => {
						this.props.setAttributes({ kb_id : parseInt(value) });
						this.setState( { kb_id: parseInt(value) });
					}  }
					options={ this.state.kbChoices }
				/>
			</div>
		);
	}

}

export default KbSelect