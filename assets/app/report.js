/*!
* Module Report
* Kumpulan javascript module Report
* @author Vicky Nitinrgoro <pkpvicky@gmail.com>
* @package Jquery, Form Validation, Bootstraps JS,Bootraps timepicker
* @see https://github.com/nitinegoro/spa-and-beauty
*/

jQuery(function($) {

	// date Range
	$('.input-daterange').datepicker({
		autoclose:true,
		format: 'yyyy-mm-dd',
	});

	// open delte payment
	$('.open-payment-delete').click( function() {
		$('#modal-delete').modal('show');
		$('#button-delete').attr('href', base_url + '/report/deletepayment/' + $(this).data('id'));
	});

	// Delete Multiple Payments
	$('.payment-delete-multiple').click( function() {
		if( $('input[type=checkbox]').is(':checked') != '' ) {
			$('#modal-delete-multiple').modal('show');
		}
	});
});