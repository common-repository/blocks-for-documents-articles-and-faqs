
const { __ } = wp.i18n;
const {
	Button, Modal, ButtonGroup
} = wp.components;
const { Component, Fragment } = wp.element;

import map from 'lodash/map';

/**
 * Dialog to show pre-set styles for given custom block.
 */
class PresetsDialog extends Component {

	constructor() {
		super( ...arguments );
		this.state = {
			modalOpen: false,
		};
	}
	render() {

		const prebuilt = [
			{
				key: 'echo_demo_header',
				content: "TEST",
				name: __( 'Header Demo' ),
				image: 'https://test.jpg',
			},
			{
				key: 'echo_demo_icons',
				content: "TEST",
				name: __( 'Three Icons' ),
				image: 'https://test.jpg',
			}
		];

		return (
			<Fragment>
				<Button className="epbl-preset-btn" onClick={ () => this.setState( { modalOpen: true } ) }>{ __( 'Presets' ) }</Button>
				{ this.state.modalOpen ?
					<Modal
						className="epbl-preset-popup"
						title={ __( 'Presets' ) }
						onRequestClose={ () => this.setState( { modalOpen: false } ) }>

						<ButtonGroup aria-label={ __( 'Prebuilt Options' ) }>
							{ map( prebuilt, ( { key, name, image, content } ) => {
									return (
										<div className="epbl-preset-item">
											<Button
												key={ key }
												className="kt-import-btn"
												isSmall
												onClick={ () => this.onInsertContent( content )  }
											>
												<img src={ image } alt={ name } />
											</Button>
										</div>
									);
							} ) }
						</ButtonGroup>

					</Modal>
					: null }
			</Fragment>
		);
	}
}
export default PresetsDialog;
