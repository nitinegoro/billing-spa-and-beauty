/*!
* Module Customer
* Kumpulan javascript module Customer
* @author Vicky Nitinrgoro <pkpvicky@gmail.com>
* @package Jquery, Form Validation, Bootstraps JS,Bootraps timepicker
* @see https://github.com/nitinegoro/spa-and-beauty
*/

jQuery(function($) {

	// modal delete user
	$('.open-customer-delete').click( function() {
		$('#modal-delete').modal('show');
		$('#button-delete').attr('href', base_url + '/customer/delete/' + $(this).data('id'));
	});

	// delete multiple customers
	$('.customer-delete-multiple').click( function() {
		if( $('input[type=checkbox]').is(':checked') != '' ) {
			$('#modal-delete-multiple').modal('show');
		}
	});

});