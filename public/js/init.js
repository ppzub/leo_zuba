(function($){
  $(function(){

    $('.sidenav').sidenav();
	$('.parallax').parallax();
	$('.collapsible').collapsible();
	$('.carousel').carousel({
		padding: 60,

	});
	$( '.my-hover' ).mouseover(function() {
  		$( this ).addClass('green lighten-2 white-text');
	});
	$( '.my-hover' ).mouseout(function() {
  		$( this ).removeClass('green lighten-2 white-text');
	});
	$('.materialboxed').materialbox();

	$('.imageGallery').magnificPopup({
		delegate: 'a',
		type: 'image',
		tLoading: 'Loading image #%curr%...',
		mainClass: 'mfp-img-mobile',
		gallery: {
			enabled: true,
			navigateByImgClick: true,
			preload: [0,1] // Will preload 0 - before current, and 1 after the current image
		},
		image: {
			tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
		}
	});
	$('.imageSingle').magnificPopup({
		type: 'image',
		closeOnContentClick: true,
		mainClass: 'mfp-img-mobile',
		image: {
			verticalFit: true
		}
	});

	$('.lightBoxVideoLink').simpleLightbox();

	$('#alert_close').click(function(){$( "#alert_box" ).fadeOut( "slow", function() {});});

	M.updateTextFields();
	M.textareaAutoResize($('#content'));
	$('select').formSelect();

  }); // end of document ready

})(jQuery); // end of jQuery name space


