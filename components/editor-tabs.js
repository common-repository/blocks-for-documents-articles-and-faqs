/**
 * Component to show Tabs like in Elementor 
 * Example: 
 * <EditorTabs>
 *		<EditorTabBody type='Content' active={true} icon='dashicon name or nothing'>
 *			some content 
 *		</EditorTabBody>
 *		<EditorTabBody type='Style'>
 *			some content 
 *		</EditorTabBody>
 *		<EditorTabBody type='Advanced'>
 *			some content 
 *		</EditorTabBody>
 *	</EditorTabs>
 *
 * Types with predefined icons: 'Content', 'Style', 'Advanced'
 */


const { __ } = wp.i18n;
const {	Dashicon } = wp.components;
const { Component } = wp.element;

class EditorTabs extends Component {
	
	constructor() {
		super( ...arguments );
		this.state = { active: this.getFirstName() } // set first tab as active 
	}
	
	getFirstName() {
		let first = '';
		
		this.props.children.map(function(child){
			if ( ( typeof child.type == 'function' ) && ( child.type.name == 'EditorTabBody' ) && !first ) {
				first = child.props.type;
			}
		});
		
		return first;
	}
	
	render() {	
		return (
			<div className="epbl-tabs">
				<div className="epbl-tabs__header">
					{this.props.children.map((child, i) => {
						
						if ( !( typeof child.type == 'function' ) || !( child.type.name == 'EditorTabBody' ) ) return;
						
						let icon = 'marker';
						
						if ( child.props.type == 'Content' ) {
							icon = 'edit';
						} else if ( child.props.type == 'Style' ) { 
							icon = 'admin-appearance';
						} else if ( child.props.type == 'Advanced' ) {
							icon = 'admin-generic';
						}
						
						if ( typeof child.props.icon !== 'undefined' ) {
							icon = child.props.icon;
						}
						
						let itemClass = ( this.state.active == child.props.type ) ? 'epbl-tabs__header__item epbl-tabs__header__item--active' : 'epbl-tabs__header__item';
						
						return (
							<div className={itemClass} key={child.props.type} onClick={ () => this.setState( { active: child.props.type } ) }>
								<Dashicon icon={icon}/>
								<span>{ __( child.props.type )}</span>
							</div>
						);
						
					})}
				</div>
				<div className="epbl-tabs__wrap">
					{/* this.props.children*/ }
					{ this.props.children.map((child, i) => {
						if ( this.state.active == child.props.type ) {
							return React.cloneElement(child, {
								active: true,
								key: 'tab-' + i
							});
						} else {
							return React.cloneElement(child, {
								active: false,
								key: 'tab-' + i
							});
						}
					}) }
				</div>
			</div>
		);
	}

}

export default EditorTabs;