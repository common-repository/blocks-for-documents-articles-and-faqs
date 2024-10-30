
const { __ } = wp.i18n;
const {
	Toolbar
} = wp.components;
const { Component } = wp.element;

import range from 'lodash/range';

/**
 * Component that allow user to choose Multi List level to edit
 */
class MultiLevelToolbar extends Component {
	createLevelControl( targetLevel, selectedLevel, onChange ) {
		return {
			icon: 'heading',
			// translators: %s: list level e.g: "1", "2", "3"
			title: sprintf( __( 'Level %d' ), targetLevel ),
			isActive: targetLevel === selectedLevel,
			onClick: () => onChange( targetLevel ),
			subscript: String( targetLevel ),
		};
	}

	render() {
		const { levelTitle, minLevel, maxLevel, selectedLevel, onChange } = this.props;
		return (
			<div className="epbl-heading-options-container">
				<h3 className="epbl-heading-options__title">{levelTitle}</h3>
				<Toolbar controls={ range( minLevel, maxLevel ).map( ( index ) => this.createLevelControl( index, selectedLevel, onChange ) ) } />
			</div>
		);
	}
}


export default MultiLevelToolbar;