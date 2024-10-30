
const { __ } = wp.i18n;
const {
	Button,
	SelectControl,
	RadioControl,
	Modal
} = wp.components;
const { Component, Fragment } = wp.element;

$ = jQuery;

/**
 * Main UI control component to show and handle template UI operations
 */
class EditorBlockTemplate extends Component {

	constructor() {
		super( ...arguments );

		this.state = {isModalOpen: false, selectedBehavior: '', selectedTemplateId: '', templateSelection: [], behaviorDescription: '', behaviorChoices: [],
					  showTemplateList: true, showApplyButton: false };

		this.onApplyChangesClick = this.onApplyChangesClick.bind( this );
		this.onListRetrieved = this.onListRetrieved.bind( this );
		this.onChangeBlockBehavior = this.onChangeBlockBehavior.bind( this );
		this.onBlockBehaviorChange = this.onBlockBehaviorChange.bind( this );
		this.onDialogClose = this.onDialogClose.bind( this );
		this.onSaveTemplateChanges = this.onSaveTemplateChanges.bind( this );

		this.ajaxGetTemplateAttributesHandler = this.ajaxGetTemplateAttributesHandler.bind( this );
		this.ajaxSetTemplateAttributesNoTemplate = this.ajaxSetTemplateAttributesNoTemplate.bind( this );
		this.ajaxSetTemplateAttributesWithTemplate = this.ajaxSetTemplateAttributesWithTemplate.bind( this );
		this.helperSetBehaviorChoices = this.helperSetBehaviorChoices.bind( this );
	}

	componentDidMount() {

		this.helperSetBehaviorChoices();

		// EDITING TEMPLATE
		if ( this.isTemplateEdit() ) {
			// nothing to do

		// EDITING BLOCK - NO TEMPLATE: prepare block template description: no templates used
		}  else if (this.isNoTemplate()) {

		// EDITING BLOCK - TEMPLATE
		} else {

			this.hideTemplateInspectorSettings();
		}
	}

	// 1. USER INITIATE BLOCK BEHAVIOR CHANGE - SHOW DIALOG
	onChangeBlockBehavior() {

		if ( this.state.templateSelection.length > 0 ) {
			this.setState({isModalOpen: true});
			return;
		}

		// get list of presets and templates
		// noinspection JSUnresolvedVariable
		let postData = {
			action: 'epbl-template-mgr-get-list',
			nonce: epbl_blocks_configuration.ajax_nonce,
			blockName: this.props.blockName
		};

		epblSendAjaxRequest( 'POST', postData, 'Retrieving templates', this.onListRetrieved );
	}
	onListRetrieved( selectionList ) {
		this.setState({templateSelection: selectionList});
		this.setState({isModalOpen: true});
		$( '.epbl-admin-dialog-box-loading' ).remove();
	}

	// 2. USER CHANGED BEHAVIOR - SHOW TEMPLATES/PRESETS
	onBlockBehaviorChange( value ) {
		this.setState({ selectedTemplateId: '' });
		this.setState({ selectedBehavior: value, showTemplateList: value !== 'no-template', showApplyButton:  value === 'no-template' });
	}

	// 3. USER APPLIES CHANGES
	onApplyChangesClick() {
		this.setState( { isModalOpen: false } );

		if (this.state.selectedBehavior === 'no-template') {
			this.props.attributes.templateId = 0;
			this.helperSetBehaviorChoices();
		} else if (this.state.selectedBehavior === 'copy-template' && this.state.selectedTemplateId !== 'no-template') {
			let blockType = this.state.selectedTemplateId.charAt(0) === 'p' ? 'preset' : 'template';
			let templateId = blockType === 'preset' ? this.state.selectedTemplateId.substr(1) : this.state.selectedTemplateId;
			this.getTemplateAttributes( templateId, blockType, 'Copying the selected preset / template', true, this.ajaxSetTemplateAttributesNoTemplate );
		} else if (this.state.selectedBehavior === 'use-template' && this.state.selectedTemplateId !== 'no-template') {
			this.getTemplateAttributes( this.state.selectedTemplateId, 'template', 'Restoring the template.', true, this.ajaxSetTemplateAttributesWithTemplate );
		}

		this.setState({ showTemplateList: true });
		this.setState( { selectedBehavior: '' } );
	}

	// 4a. USER WANTS COPY
	ajaxSetTemplateAttributesNoTemplate(newAttributes ) {
		newAttributes.templateId = 0;
		this.props.setAttributes( newAttributes );
		this.helperSetBehaviorChoices();
	}

	// 4b. USER WANTS TEMPLATE
	ajaxSetTemplateAttributesWithTemplate( newAttributes ) {
		epblTemplateNames[newAttributes.templateId] = typeof epblTemplateNames === "undefined" ? 'unknown' : newAttributes['templateName'];
		this.props.setAttributes( newAttributes );
		this.helperSetBehaviorChoices();
	}

	helperSetBehaviorChoices() {

		// EDITING TEMPLATE
		if ( this.isTemplateEdit() ) {
			// nothing to do

		// EDITING BLOCK - NO TEMPLATE: prepare block template description: no templates used
		} else if ( this.isNoTemplate() ) {
			this.showInspectorSettings();
			this.state.behaviorDescription = __('No template used.');
			this.setState( { behaviorDescription: __('No template used.') } );
			this.state.behaviorChoices = [
				{label: 'Copy template style into this block. Then I can style it further', value: 'copy-template'},
				{label: 'Keep the style of this block same as my template. I cannot customize the block further. ', value: 'use-template'},
			];

		// EDITING BLOCK - TEMPLATE
		} else {
			let templateName = typeof epblTemplateNames !== "undefined" && epblTemplateNames[this.props.attributes.templateId] !== undefined ? epblTemplateNames[this.props.attributes.templateId] : 'unknown';
			this.state.behaviorDescription = templateName + ' (' + this.props.attributes.templateId + ')';
			this.setState({ behaviorDescription: templateName + ' (' + this.props.attributes.templateId + ')' });
			this.state.behaviorChoices = [
				{ label: 'I want to turn off the template and go back to configuring the block itself.', value: 'no-template' },
				{ label: 'I want to switch to another template.', value: 'use-template' }
			];

			this.hideTemplateInspectorSettings();
		}
	}


	/*****************************************************************************
	 /  TEMPLATE EDITOR
	 /*****************************************************************************/

	onSaveTemplateChanges() {
		// noinspection JSUnresolvedVariable
		let postData = {
			action: 'epbl-template-mgr-save',
			nonce: epbl_blocks_configuration.ajax_nonce,
			templateId: this.props.attributes.templateId,
			blockType: this.props.attributes.blockType,
			blockName: this.props.blockName,
			templateAttributes: this.props.attributes
		};

		epblSendAjaxRequest( 'POST', postData, 'Saving template', null );
	}


	/*****************************************************************************
	 /  RENDERING
	 /*****************************************************************************/

	render() {
		return ''; // Temporary disable templates TODO FUTURE: Enable
		return this.isTemplateEdit() ?
				<Fragment>
					<div className="epbl-editor-block-template-controls">
						<div className="epbl-ebtc__action">
							<Button className="epbl-change-template-action" onClick={ this.onSaveTemplateChanges }>
								Apply Template Changes
							</Button>
						</div>
					</div>
				</Fragment> : (
			<Fragment>
				<div className="epbl-editor-block-template-controls epbl-range-options-container">
					<div className="epbl-ebtc__title">{__("Template: ")}</div>
					<div className="epbl-ebtc__desc">{ this.state.behaviorDescription } </div>
					<div className="epbl-ebtc__action"><Button className="epbl-change-template-action" onClick={ this.onChangeBlockBehavior }>{ __( 'change' ) }</Button></div>
				</div>
				{ ! this.isNoTemplate() &&
					(<div className="epbl-template-edit-link" id="epbl-template-edit-link"><a href={"post-new.php?post_type=epbl-post-type&block_name=" + this.props.blockName + "&template_id=" + this.props.attributes.templateId} target="_blank">View Template</a></div>) }
				<div id='epbl-ajax-in-progress' style={{display: 'none'}} ></div>
				{ this.state.isModalOpen && (

					<Modal
						className ="epbl-model"
						title={__('Use of Templates')}
						onRequestClose={ this.onDialogClose }>
						<div className="epbl-model__form">
							<RadioControl
								label="How Do You Want This Block To Look Like?"
								selected={ this.state.selectedBehavior }
								options={ this.state.behaviorChoices }
								onChange={ ( value ) => this.onBlockBehaviorChange(value)  }
							/>
							{ this.state.showTemplateList && (
							<SelectControl
								label={ __( "What Template Do You Want to Use:" ) }
								value={ this.state.selectedTemplateId }
								onChange={ ( value ) => this.setState( { selectedTemplateId: value, showApplyButton: true } ) }
								options={ this.state.templateSelection[this.state.selectedBehavior === 'copy-template' ? 'all' : 'templates'] }
							/> ) }
							{ <Button className="epbl-model__apply-btn epbl-model__btn epbl-model__btn--success" isDefault onClick={ this.onApplyChangesClick }>
								Apply Changes
							</Button> }
						</div>
						<div className="epbl-model__footer">
							<div className="epbl-model__help-link">
								<a href="https://www.echoplugins.com/support/" target="_blank">Help</a>
							</div>
						</div>
					</Modal> )
				}
			</Fragment>
		);
	}


	/*****************************************************************************
	 /  UTILITY FUNCTIONS
	 /*****************************************************************************/

	showInspectorSettings() {

		$('#epbl-inspector-blocks').removeClass("epbl-inspector--template-on");

		// loop through each Inspector panel
/*		$('#epbl-inspector-blocks').find('.epbl-inspector-panel').each(function(i, obj) {
			$(this).show();
		}); */
	}

	hideTemplateInspectorSettings() {
		// loop through each Inspector panel

		$('#epbl-inspector-blocks').addClass("epbl-inspector--template-on");

	/*	$('#epbl-inspector-blocks').find('.epbl-inspector-panel').each(function(i, obj) {


			// epbl-inspector-panel--template-show

			// if panel does not have config to show then hide the panel
			if ( ! $(this).hasClass('epbl-inspector-panel--template-tag') ) {
				$(this).hide();
				return;
			}

			// we need to show panel but hide config that should be hidden
			$(this).find('.epbl-inspector-panel__component').each(function(i, obj) {
				if ( ! $(this).hasClass('epbl-inspector-component--template-show') ) {
					$(this).hide();
				}
			});
 		}); */
	}

	onDialogClose() {
		this.setState( { isModalOpen: false, selectedBehavior: '' } );
	}

	isTemplateEdit() {
		return $('#epbl-template-editor').length > 0;
	}

	isNoTemplate() {
		return this.props.attributes.templateId === 0;
	}

	getTemplateAttributes( templateId, blockType, message, excludeCore, handler ) {
		// revert attributes
		// noinspection JSUnresolvedVariable
		let postData = {
			action: 'epbl-template-mgr-get',
			nonce: epbl_blocks_configuration.ajax_nonce,
			templateId: templateId,
			blockType: blockType,
			blockName: this.props.blockName,
			excludeCore: excludeCore
		};

		epblSendAjaxRequest( 'POST', postData, message, handler );
	}
	ajaxGetTemplateAttributesHandler(newAttributes ) {
		this.props.setAttributes( newAttributes );
	}

}

export default EditorBlockTemplate


	function epblSendAjaxRequest(ajax_type, postData, action_msg, handler ) {

		let errorTitle = 'Error Occurred';
		let errorMessage = '';
		let result = '';
		let ajaxResponse = '';

		$.ajax({
			type: ajax_type,
			dataType: 'json',
			data: postData,
			url: ajaxurl,
			beforeSend: function (xhr)
			{
				loadingDialog( action_msg );
			}
		}).done(function (response) {

			ajaxResponse = ( response ? response : '' );
			if ( ajaxResponse.error || ajaxResponse.status !== 'success' ) {
				errorTitle = ajaxResponse.title ? ajaxResponse.title : errorTitle;
				errorMessage = ajaxResponse.message ? ajaxResponse.message : 'Please try again later. (L01)';
			} else {
				result = ajaxResponse.result ? ajaxResponse.result : '';
			}

		}).fail(function (response, textStatus, error) {
			errorMessage = ( error ? ' [' + error + ']' : 'unknown error' );
		}).always(function () {

			if ( errorMessage !== '' ) {
				centerStatusDialog(errorTitle, errorMessage, 'error' );
				return;
			}

			bottomNoticeMessage( 'Completed', 'success' );

			if ( handler ) {
				handler(result);
				return;
			}
		});
	}

	// Info / Dialogs -------------------------------------------------------------------------------------------------/
$(document).ready(function($) {
	// Dialog Box Confirmation Close
	$( '.epbl-admin-dbc__close' ).on( 'click', function(){
		$( '.epbl-admin-dialog-box-confirmation' ).hide();
	});
	$( '.epbl-admin-dbc__footer__cancel' ).on( 'click', function(){
		$( '.epbl-admin-dialog-box-confirmation' ).hide();
	});

	// Dialog Box Form Close
	$( '.epbl-tm-dbf__close' ).on( 'click', function(){
		$( '.epbl-tm-dialog-box-form' ).hide();
	});
	$( '.epbl-tm-dbf__footer__cancel' ).on( 'click', function(){
		$( '.epbl-tm-dialog-box-form' ).hide();
	});
	function hide_all_dialogs(){
		$( '.epbl-tm-dialog-box-form' ).hide();
		$( '.epbl-admin-dialog-box-confirmation' ).hide();
	}
});



	/**
	  * Displays a small Message at the bottom left hand corner of page and fades away after 3 seconds.
	  *
	  * This is good for quick messages like Successful load or Saved changes etc...
	  *
	  * @param  String    message    Optional    Message output from database or settings.
	  * @param  String    type       Type of message ( success, error, error, attention ) These will just affect the color.
	  *
	  * Outputs: Removes old dialogs and adds the HTML to the end of the Template div.
	  *
	  */
	function bottomNoticeMessage( message , type ) {

		// Remove any old dialogs.
		if ( $( '.epbl-admin-dialog-box-status' ).hasClass( 'epbl-admin-dialog-box-status--success')){
			$( '.epbl-admin-dialog-box-status' ).remove();
		}
		if ( $( '.epbl-admin-dialog-box-status' ).hasClass( 'epbl-admin-dialog-box-status--info')){
			$( '.epbl-admin-dialog-box-status' ).remove();
		}

		// $( '.epbl-admin-dialog-box-status' ).remove();
		$( '.epbl-admin-dialog-box-loading' ).remove();

		let output = '<div class="epbl-bottom-notice-message epbl-bottom-notice-message--' + type + '">' +

			(message ? message : '') +

			'</div>';

		//Add message output at the end of Body Tag
		$('body' ).append( output );

		setTimeout(function(){
			$( '.epbl-bottom-notice-message' ).addClass('fadeOutDown');
		}, 3000)

	}

	/**
	  * Displays a Center Dialog box with a loading icon and text.
	  *
	  * This should only be used for indicating users that loading is in progress, nothing else.
	  *
	  * @param  String    message    Optional    Message output from database or settings.
	  *
	  * Outputs: Removes old dialogs and adds the HTML to the end body tag
	  *
	  */
	function loadingDialog( message ){

		// Remove any old dialogs.
		$( '.epbl-admin-dialog-box-status' ).remove();

		let output = '<div class="epbl-admin-dialog-box-loading">' +

			//<-- Header -->
			'<div class="epbl-admin-dbl__header">' +
			'<div class="epbl-admin-dbl-icon epbl epbl-hourglass-half"></div>'+
			(message ? '<h4>' + message + '</h4>' : '' ) +
			'</div>'+
			'</div>';

		//Add message output at the end of Body Tag
		$( 'body' ).append( output );
	}

	/**
	  * Displays a Center Dialog box with an icon and text.
	 *
	  * This is good for Warning Messages or messages that are more detailed and require the user to see it more promptly.
	  * Warning / Error messages will not disappear and will require the user to close the box.
	  *
	  * @param  String    title      Optional    Title of message.
	  * @param  String    message    Optional    Message output from database or settings.
	  * @param  String    type       Type of message ( success, error, error, attention ) These will affect the color and icon and close button.
	  *
	  * Outputs: Removes old dialogs and adds the HTML to the end of the Template div.
	  *
	  */
	function centerStatusDialog( title, message, type ){

		// Remove any old dialogs.
		$( '.epbl-admin-dialog-box-status' ).remove();
		$( '.epbl-admin-dialog-box-loading' ).remove();

		// Icon type
		let icon = '';
		switch(type) {
			case 'success':
				icon = 'epbl-check';
				break;
			case 'info':
				icon = 'epbl-info';
				break;
			case 'warning':
				icon = 'epbl-exclamation-triangle';
				break;
			case 'error':
				icon = 'epbl-exclamation';
				break;
			default:
			// code block
		}

		//Close button ( If error )
		let footer ='';
		if( type === 'error' || type === 'warning' ) {
			footer = '<div class="epbl-admin-dbs__footer">' +
				'<div class="epbl-admin-dbs__footer__close">Close</div>' +
				'</div>';
		}

		let output = '<div class="epbl-admin-dialog-box-status epbl-admin-dialog-box-status--' + type + '">' +

			//<-- Header -->
			'<div class="epbl-admin-dbs__header">' +
			'<div class="epbl-dbs-icon epbl ' + icon + '"></div>'+
			(title ? '<h4>' + title + '</h4>' : '' ) +
			'</div>' +

			//<-- Body -->
			'<div class="epbl-admin-dbs__body">' +
			(message ? message : '') +
			'</div>' +

			//<-- Footer -->
			footer +

			'</div>';

		//Add message output at the end body tag
		$('body' ).append( output );

		$( '.epbl-admin-dbs__footer__close' ).on('click', function () {
			$( '.epbl-admin-dialog-box-status' ).remove();
		})
	}
