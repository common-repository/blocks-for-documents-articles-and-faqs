jQuery(document).ready(function($) {

	let textVidPrefixClass = '.epbl-textvid';
	let textVidPrefix              = 'epbl-textvid';

		//If user clicks on the Video, remove the help text container, so that it does not block the controls or the video. ( Only if Text is on top of the video )
		$( textVidPrefixClass+'__figure--help-text-top-video '+' , ' +textVidPrefixClass+'__figure--help-text-bottom-video ' ).on( 'click', function(){
			$( this ).find( textVidPrefixClass+'__help-text-container' ).remove();
		});

		//If user clicks on the Video show lightbox of video
		$( textVidPrefixClass+'__figure--zoom-on' ).on( 'click', function(){

			// Clear all active classes
			$( textVidPrefixClass+'__lightbox' ).removeClass( textVidPrefixClass+'--active-lightbox' );

			// Set Parent value
			let parent = $( this ).parent();


			// Get Image URL
			let urlImageFull = parent.find( textVidPrefixClass+'__lightbox__content__data-video-src' ).attr( "data-full-video-src" ) ;
			// Get Image figcaption
			let figCaptionText = parent.find( textVidPrefixClass+'__help-text__inner' ).text() ;

			// Image HTML
			let videoHTML         = '<video controls src="'+urlImageFull+'" class="'+textVidPrefix+'__lightbox__video"></video>';
			// Image Caption HTML
			// If there is no text don't output the Fig Caption HTML
			let figCaptionHTML;
			if( figCaptionText ){
				figCaptionHTML  = '<div class="'+textVidPrefix+'__lightbox__figcaption">'+figCaptionText+'</div>';
			}else{
				figCaptionHTML = '';
			}

			// Close Icon HTML
			let CloseHTML       = '<div class="'+textVidPrefix+'__lightbox__close epbl epbl-window-close"></div>';

			// Add Active Class to lightbox container
			parent.find( textVidPrefixClass+'__lightbox' ).addClass( textVidPrefix+'--active-lightbox' );
			// Output to lightbox container

			parent.find( textVidPrefixClass+'__lightbox ' + textVidPrefixClass+'__lightbox__content' ).append( videoHTML + figCaptionHTML + CloseHTML );
			parent.find( textVidPrefixClass+'__lightbox' ).show();

			// Calculate the Space required above the image. ( Window height - Img Height then divide by 2 top and bottom spaces )
			//Get Window Height
			let windowHeight = $(window).height();
			let imageHeight;

			// Delay the code below so it has a chance to find the elements as they are being loaded.
			setTimeout(function(){

				// Get the Image Height
				imageHeight  = parent.find( textVidPrefixClass+'__lightbox__video' ).outerHeight( true );

				//Subtract the two divide by 2
				topSpace = (windowHeight-imageHeight) / 2;
				$( textVidPrefixClass+'__lightbox' ).css( "padding-top", topSpace );

			}, 10);

		});

		// When the user clicks on (x), close the lightbox
		$( '.epbl-textvid' ).on( 'click' , textVidPrefixClass+'__lightbox__close' , function(){

			epbl_textVideo_close_lightBox();

		});

		// Listen to user click event.
		window.onclick = function( event ) {

			// Detect if Lightbox is open.
			if( $( '.epbl-textvid' ).find( textVidPrefixClass+'--active-lightbox' ).length > 0 ){

				//If user clicks outside of the image, then close the lightbox.
				if( event.target.className === 'epbl-textvid__lightbox epbl-textvid--active-lightbox' ){
					epbl_textVideo_close_lightBox();
				}
			}

		};

		// Removes and hides all elements required to hide the open lightbox.
		function epbl_textVideo_close_lightBox(){
			// Clear all active classes
			$( textVidPrefixClass+'__lightbox' ).removeClass( textVidPrefix+'--active-lightbox' );
			// Hide the Lightbox
			$( textVidPrefixClass+'__lightbox' ).hide();
			//Remove contents
			$( textVidPrefixClass+'__lightbox__video' ).remove();
			$( textVidPrefixClass+'__lightbox__figcaption' ).remove();
			$( textVidPrefixClass+'__lightbox__close' ).remove();
		}
});