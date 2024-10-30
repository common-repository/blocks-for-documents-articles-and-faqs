jQuery(document).ready(function($) {

	let textImgPrefixClass         = '.epbl-textimg';
	let textImgPrefix              = 'epbl-textimg';

	//If user clicks on the Image or text in the image, show lightbox of bigger version image.
	$( textImgPrefixClass+'__figure--zoom-on' ).on( 'click', function() {

		// Clear all active classes
		$( textImgPrefixClass+'__lightbox' ).removeClass( textImgPrefixClass+'--active-lightbox' );

		// Set Parent value
		let parent = $( this ).parent();


		// Get Image URL
		let urlImageFull = parent.find( textImgPrefixClass+'__lightbox__content__data-img-src' ).attr( "data-full-img-src" ) ;
		// Get Image figcaption
		let figCaptionText = parent.find( textImgPrefixClass+'__help-text__inner' ).text() ;

		// Image HTML
		let imgHTML         = '<img src="'+urlImageFull+'" class="'+textImgPrefix+'__lightbox__img">';
		// Image Caption HTML
		// If there is no text don't output the Fig Caption HTML
		let figCaptionHTML;
		if ( figCaptionText ) {
			figCaptionHTML  = '<div class="'+textImgPrefix+'__lightbox__figcaption">'+figCaptionText+'</div>';
		} else {
			figCaptionHTML = '';
		}

		// Close Icon HTML
		let CloseHTML       = '<div class="'+textImgPrefix+'__lightbox__close epbl epbl-window-close"></div>';

		// Add Active Class to lightbox container
		parent.find( textImgPrefixClass+'__lightbox' ).addClass( textImgPrefix+'--active-lightbox' );
		// Output to lightbox container

		parent.find( textImgPrefixClass+'__lightbox ' + textImgPrefixClass+'__lightbox__content' ).append( imgHTML + figCaptionHTML + CloseHTML );
		parent.find( textImgPrefixClass+'__lightbox' ).show();

		// Calculate the Space required above the image. ( Window height - Img Height then divide by 2 top and bottom spaces )
		//Get Window Height
		let windowHeight = $(window).height();
		let imageHeight;

		// Delay the code below so it has a chance to find the elements as they are being loaded.
		setTimeout(function(){

			// Get the Image Height
			imageHeight  = parent.find( textImgPrefixClass+'__lightbox__img' ).outerHeight( true );

			//Subtract the two divide by 2
			let topSpace = (windowHeight-imageHeight) / 2;
			$( textImgPrefixClass+'__lightbox' ).css( "padding-top", topSpace );

		}, 10);

	});

	// When the user clicks on (x), close the lightbox
	$( '.epbl-textimg' ).on( 'click' , textImgPrefixClass+'__lightbox__close' , function(){

			epbl_textImage_close_lightBox();

	});

	// Listen to user click event.
	window.onclick = function( event ) {

		// Detect if Lightbox is open.
		if ( $( '.epbl-textimg' ).find( textImgPrefixClass+'--active-lightbox' ).length > 0 ) {

			//If user clicks outside of the image, then close the lightbox.
			if ( event.target.className === 'epbl-textimg__lightbox epbl-textimg--active-lightbox' ) {
					epbl_textImage_close_lightBox();
			}
		}

	};

	// Removes and hides all elements required to hide the open lightbox.
		function epbl_textImage_close_lightBox(){
		// Clear all active classes
		$( textImgPrefixClass+'__lightbox' ).removeClass( textImgPrefix+'--active-lightbox' );
		// Hide the Lightbox
		$( textImgPrefixClass+'__lightbox' ).hide();
		//Remove contents
		$( textImgPrefixClass+'__lightbox__img' ).remove();
		$( textImgPrefixClass+'__lightbox__figcaption' ).remove();
		$( textImgPrefixClass+'__lightbox__close' ).remove();
	}

});