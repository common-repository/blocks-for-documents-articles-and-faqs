
jQuery(document).ready(function($) {

    let clickedOnElement;
    let isPreset = false;

    // COPY PRESET
    $('.epbl-tm-panel-container').on( 'click', '.epbl-tm-section-preset__header__controls__copy', function(e) {
        e.preventDefault();
        clickedOnElement = $(this);
        isPreset = true;
	    hide_all_dialogs();
        epblSendRequest( 'epbl-template-mgr-copy', 'Copying preset', epblHandleCopyResponse );
    });
    // COPY TEMPLATE
    $('.epbl-tm-section-template__header__controls__copy').on( 'click', function(e) {
        e.preventDefault();
        clickedOnElement = $(this);
        isPreset = false;
	    hide_all_dialogs();
        epblSendRequest( 'epbl-template-mgr-copy', 'Copying template', epblHandleCopyResponse );
    });
    function epblHandleCopyResponse( templateResult ) {
        let clonedBlock = isPreset ? $('.epbl-tm-section-template').first().clone(true) : clickedOnElement.closest('.epbl-tm-preset-template').clone(true);
        let newUrl = clonedBlock.find('.epbl-template-edit-url').attr('href').replace('template_id=0', 'template_id=' + templateResult['template_id']);
        clonedBlock.attr('data-template-id', templateResult['template_id']);
        clonedBlock.find('.epbl-template-edit-url').attr('href', newUrl);
        clonedBlock.find('.epbl-tm-section-template__header__info__name').contents().first()[0].textContent = templateResult['template_name'];
        clonedBlock.find('.epbl-tm-section-template__header__info__disc').text(templateResult['template_description']);

        if ( isPreset ) {
            let blockPreview = clickedOnElement.closest('.epbl-tm-section-preset').find('.epbl-tm-section-preset__preview').clone(true);
            clonedBlock.find('.epbl-tm-section-template__preview').html(blockPreview);
        }

        clonedBlock.css('display', 'block');

        $('.epbl-tm-no-heading-message').hide();
	    $('.epbl-admin-info-box-container').hide();
        $('#epbl-tm-template-panel').append( clonedBlock );
        $('.epbl-tm-tab-nav-container li').click();
    }

    // RENAME TEMPLATE
	$('.epbl-template-manager-container').on( 'click', '.epbl-tm-section-template__header__controls__rename', function(e) {
		e.preventDefault();
		clickedOnElement = $(this);
		hide_all_dialogs();
		$('#epbl_tm_template_name_change_dialog').css('display', 'block');
	});

    $('#epbl-tm-accept-button').on( 'click', function(e) {
        e.preventDefault();
        epblSendRequest( 'epbl-template-mgr-rename', 'Updating template', epblHandleRenameResponse, $('#epbl_tm_template_name').val(), $('#epbl_tm_template_description').val() );
    });
    function epblHandleRenameResponse( templateResult ) {
        clickedOnElement.closest('.epbl-tm-preset-template').find('.epbl-tm-section-template__header__info__name').text(templateResult['template_name']);
        clickedOnElement.closest('.epbl-tm-preset-template').find('.epbl-tm-section-template__header__info__disc').text(templateResult['template_description']);

        $('#epbl_tm_template_name').text('');
        $('#epbl_tm_template_description').text('');
        $('.epbl-template-manager-container #epbl_tm_template_name_change_dialog').css('display', 'none');
    }

    // DELETE TEMPLATE
	$('.epbl-template-manager-container').on( 'click', '.epbl-tm-section-template__header__controls__delete', function(e) {
        e.preventDefault();
        clickedOnElement = $(this);
		hide_all_dialogs();
        $('#epbl_tm_delete_template_confirmation').css('display', 'block');
    });
    $('#epbl_tm_accept_delete_template').on( 'click', function(e) {
        $('#epbl_tm_delete_template_confirmation').css('display', 'none');
        epblSendRequest( 'epbl-template-mgr-delete', 'Deleting template', epblHandleDeleteResponse );
    });
    function epblHandleDeleteResponse() {
        clickedOnElement.closest('.epbl-tm-preset-template').remove();
		if ( $('.epbl-tm-template-counter').length < 2 ) {
			$('.epbl-tm-no-heading-message').show();
			$('.epbl-admin-info-box-container').show();
		}
    }

	// SWITCH GROUP
	$('.epbl-template-manager-container').on( 'click', '.epbl-preset-group-link', function(e) {
		e.preventDefault();
		clickedOnElement = $(this);
		hide_all_dialogs();

		let newGroupName = this.textContent;
		if ( ! newGroupName ) {
			return;
		}

		// first hide all presets/templates
		let elements = document.getElementsByClassName('epbl-tm-preset-template');
		for (let i = 0; i < elements.length; i++) {
			if ( newGroupName === elements[i].getAttribute('data-group-name') ) {
				elements[i].style.display = 'block';
			} else {
				elements[i].style.display = 'none';
			}
		}
	});


    /*****************************************************************************
     /  BLOCK TYPE SELECTION
     /*****************************************************************************/

    // Block Type Selection
    $( '.epbl-tm-block-type-selection li' ).on( 'click', function(e){

	    //Remove active tab class
	    $( '.epbl-tm-block-type-selection li' ).removeClass( 'epbl-tm-block-type-selection__list-item--active-tab' );

	    //Add active tab class
	    $( this ).addClass( 'epbl-tm-block-type-selection__list-item--active-tab' );

        // noinspection JSUnresolvedVariable
        let postData = {
            action: 'epbl-template-mgr-get-presets-templates-page',
            nonce: $('#_wpnonce_epbl_template_manager_action').val(),
            blockName: $(e.currentTarget).attr('data-block-name')
        };
        epblSendAjaxRequest( 'POST', postData, 'Loading templates', epblHandlePresetsPageResponse );
    });
    function epblHandlePresetsPageResponse( jsonMessage ) {
        $('.epbl-template-manager-container').attr('data-block-name', jsonMessage['blockName']);
        $('#epbl-tm-preset-panel').html( jsonMessage['presets'] );
        $('#epbl-tm-template-panel').html( jsonMessage['templates'] );
    }

    // Tabs
    $( '.epbl-tm-tab-nav-container li' ).on( 'click', function(){

        let id = $( this ).attr( 'id' );

        //Hide Panels
        $( '.epbl-tm-panel' ).hide();

        //Remove active tab class
        $( '.epbl-tm-tab-nav-container li' ).removeClass( 'epbl-active-tab' );
        //Show Panel based on selected tab
        $( '#epbl-tm-' + id + '-panel' ).show();

        //Add active tab class
        $( this ).addClass( 'epbl-active-tab' );

    });

    // Show Preset Block Settings when Gear Icon clicked on.
	$( '.epbl-template-manager-container' ).on( 'click', ' .epbl-tm-section-preset__header__info__config', function () {
		$( this ).parents( '.epbl-tm-section-preset__header' ).toggleClass( 'epbl-tm-section-preset__header--show-settings');
	});
	// Show Template Block Settings when Gear Icon clicked on.
	$( '.epbl-template-manager-container' ).on( 'click', ' .epbl-tm-section-template__header__info__config', function () {
		$( this ).parents( '.epbl-tm-section-template__header' ).toggleClass( 'epbl-tm-section-template__header--show-settings');
	});

    /*****************************************************************************
     /  UTILITY FUNCTIONS
     /*****************************************************************************/

    function epblSendRequest( action, message, handler, templateName='', templateDescription='' ) {

        // noinspection JSUnresolvedVariable
        let postData = {
            action: action,
            nonce: $('#_wpnonce_epbl_template_manager_action').val(),
            templateId: epbl_get_selected_template_id(),
            blockType: epbl_get_selected_type(),
            blockName: epbl_get_block_name(),
            templateName: templateName,
            templateDescription: templateDescription
        };

        epblSendAjaxRequest( 'POST', postData, message, handler );
    }

    function epbl_get_block_name() {
        return $('.epbl-template-manager-container').attr('data-block-name');
    }

    function epbl_get_selected_template_id() {
        return clickedOnElement.closest('.epbl-tm-preset-template').attr('data-template-id');
    }

    function epbl_get_selected_type() {
        return clickedOnElement.closest('.epbl-tm-preset-template').attr('data-template-type');
    }

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
	            errorTitle = ajaxResponse.title ? ajaxResponse.title : '';
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

	/**
	  * Displays a small Message at the bottom left hand corner of page and fades away after 3 seconds.
	  *
	  * This is good for quick messages like Successful load or Saved changes etc...
	  *
	  * @param  String    message    Optional    Message output from database or settings.
	  * @param  String    type       Type of message ( success, error, danger, attention ) These will just affect the color.
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
	  * @param  String    type       Type of message ( success, error, danger, attention ) These will affect the color and icon and close button.
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
});
