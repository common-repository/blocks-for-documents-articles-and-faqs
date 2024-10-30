jQuery(document).ready(function($) {

	/*****************************************************************************
	 /  DASHBOARD
	 /*****************************************************************************/

	if ( $( '#epbl-getting-started-container').length > 0 ){

		$( '.epbl-gs-tab-nav-container li' ).on( 'click', function(){

			let id = $( this ).attr( 'id' );

			console.log( id );
			//Hide Panels
			$( '.epbl-gs-panel' ).hide();

			//Remove active tab class
			$( '.epbl-gs-tab-nav-container li' ).removeClass( 'epbl-active-tab' );
			//Show Panel based on selected tab
			$( '#'+id+'-panel' ).show();

			//Add active tab class
			$( this ).addClass( 'epbl-active-tab' );

		});
	}

	// Settings Page - Tab Toggle
	if( $( '.epbl-dashboard__tabs' ).length > 0 ) {

		$( '.epbl-dashboard-tabs__nav__item' ).on( 'click', function(e){

			e.preventDefault();

			//Get ID of Nav item
			let navID = $( this ).attr( 'id' );


			// Remove all active classes
			$( '.epbl-dashboard-tabs__nav__item' ).removeClass( 'epbl-dashboard-tabs__nav__item--active' );
			$( '.epbl-dashboard-tabs__content__panel' ).removeClass( 'epbl-dashboard-tabs__content__panel--active' );

			// Add Class to clicked on tab
			$( this ).addClass( 'epbl-dashboard-tabs__nav__item--active' );

			// Show Tab Content for active Tab
			$( '#'+navID+'-content' ).addClass( 'epbl-dashboard-tabs__content__panel--active' );

		})

	}

	// AJAX DIALOG USED BY KB CONFIGURATION AND SETTINGS PAGES
	$('#epbl-ajax-in-progress').dialog({
		resizable: false,
		height: 70,
		width: 200,
		modal: false,
		autoOpen: false
	}).hide();


	/*****************************************************************************
	 /  CONFIGURATION PAGE
	 /*****************************************************************************/

	// SAVE WPML Enabled configuration
	$( '#epbl_save_settings' ).on( 'click', function (e) {
		e.preventDefault();  // do not submit the form
		let msg = '';

		let postData = {
			action: 'epbl_save_config_changes',
			_wpnonce_epbl_template_manager_action: $('#_wpnonce_epbl_template_manager_action').val(),
			block_editor_full_width: $('#block_editor_full_width').is(':checked')
		};

		$.ajax({
			type: 'POST',
			dataType: 'json',
			data: postData,
			url: ajaxurl,
			beforeSend: function (xhr)
			{
				//noinspection JSUnresolvedVariable
			//	$('#epbl-ajax-in-progress').text(epbl_vars.save_config).dialog('open');
			}

		}).done(function (response)
		{
			response = ( response ? response : '' );
			if ( ! response.error && typeof response.message !== 'undefined' )
			{
				msg = response.message;

			} else {
				//noinspection JSUnresolvedVariable
				msg = response.message ? response.message : epbl_admin_notification('', epbl_vars.reload_try_again, 'error');
			}

		}).fail(function (response, textStatus, error)
		{
			//noinspection JSUnresolvedVariable
			msg = ( error ? ' [' + error + ']' : epbl_vars.unknown_error );
			//noinspection JSUnresolvedVariable
			msg = epbl_admin_notification(epbl_vars.not_saved + ' ' + epbl_vars.msg_try_again, msg, 'error');

		}).always(function ()
		{
			$('#epbl-ajax-in-progress').dialog('close');

			if ( msg ) {
				$('.eckb-bottom-notice-message').replaceWith(msg);
				$("html, body").animate({scrollTop: 0}, "slow");
			}
		});
	});

	/*****************************************************************************
	 /  Debug PAGE
	 /*****************************************************************************/
	$( '#epbl-nav-debug-content #epbl_toggle_debug' ).on( 'click', function() {

		var postData = {
			action: 'epbl_toggle_debug',
			_wpnonce_epbl_toggle_debug: $('#_wpnonce_epbl_toggle_debug').val()
		};

		var msg;

		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: ajaxurl,
			data: postData,
			beforeSend: function (xhr)
			{
				epbl_loading_Dialog( 'show', 'Switching Debug...' );
			}
		}).done(function (response)
		{
			window.location.href = window.location.href + '&tab=debug';
		}).always(function(){

			//epbl_loading_Dialog( 'remove', '' );
		});
	});

	/* Dialogs --------------------------------------------------------------------*/

	/**
	 * Displays a Center Dialog box with a loading icon and text.
	 *
	 * This should only be used for indicating users that loading or saving or processing is in progress, nothing else.
	 * This code is used in these files, any changes here must be done to the following files.
	 *   - admin-plugin-pages.js
	 *   - admin-kb-config-scripts.js
	 *   - admin-kb-wizard-script.js
	 *
	 * @param  {string}    displayType     Show or hide Dialog initially. ( show, remove )
	 * @param  {string}    message         Optional    Message output from database or settings.
	 *
	 * @return {html}                      Removes old dialogs and adds the HTML to the end body tag with optional message.
	 *
	 */
	function epbl_loading_Dialog( displayType, message ){

		if( displayType === 'show' ){

			let output =
				'<div class="epbl-admin-dialog-box-loading">' +

				//<-- Header -->
				'<div class="epbl-admin-dbl__header">' +
				'<div class="epbl-admin-dbl-icon epblfa epblfa-hourglass-half"></div>'+
				(message ? '<div class="epbl-admin-text">' + message + '</div>' : '' ) +
				'</div>'+

				'</div>' +
				'<div class="epbl-admin-dialog-box-overlay"></div>';

			//Add message output at the end of Body Tag
			$( 'body' ).append( output );
		}else if( displayType === 'remove' ){

			// Remove loading dialogs.
			$( '.epbl-admin-dialog-box-loading' ).remove();
			$( '.epbl-admin-dialog-box-overlay' ).remove();
		}

	}
});
