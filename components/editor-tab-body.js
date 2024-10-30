/**
 * Component to show Tabs Body for EditorTabs component
 */

const { Component } = wp.element;

/**
 * Control to show KB select
 * Should be ONLY ONE on the page
 */
class EditorTabBody extends Component {

	render() {
		let currentClass = ((typeof  this.props.active !== 'undefined' ) && this.props.active ) ? 'epbl-tabs__body epbl-tabs__body--active' : 'epbl-tabs__body';
		return ( 
			<div className={currentClass}>
				{this.props.children}
			</div>
		);
	}
}

export default EditorTabBody;