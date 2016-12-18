/*!
* Module Master
* Kumpulan javascript module Master
* @author Vicky Nitinrgoro <pkpvicky@gmail.com>
* @package Jquery, Form Validation, Bootstraps JS,Bootraps timepicker
* @see https://github.com/nitinegoro/spa-and-beauty
*/

jQuery(function($) {

	// modal delete user
	$('.open-room-delete').click( function() {
		$('#modal-delete').modal('show');
		$('#button-delete').attr('href', base_url + '/master/deleteroom/' + $(this).data('id'));
	});

	// open delete multiple
	$('.room-delete-multiple').click( function() {
		if( $('input[type=checkbox]').is(':checked') != '' ) {
			$('#modal-delete-multiple').modal('show');
		}
	});

	// time Picker
	$('#timepicker1').timepicker({
		minuteStep: 1,
		showSeconds: true,
		showMeridian: false,
		disableFocus: false,
		icons: {
			up: 'fa fa-chevron-up',
			down: 'fa fa-chevron-down'
		}
	}).on('focus', function() {
		$('#timepicker1').timepicker('showWidget');
	}).next().on(ace.click_event, function(){
		$(this).prev().focus();
	});


	// modal delete package
	$('.open-package-delete').click( function() {
		$('#modal-delete').modal('show');
		$('#button-delete').attr('href', base_url + '/master/deletepackage/' + $(this).data('id'));
	});

	// delete multiple package
	$('.package-delete-multiple').click( function() {
		if( $('input[type=checkbox]').is(':checked') != '' ) {
			$('#modal-delete-multiple').modal('show');
		}
	})
});