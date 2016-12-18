/*!
* Module Transaksi
* Kumpulan javascript module transaksi
* @author Vicky Nitinrgoro <pkpvicky@gmail.com>
* @package Jquery, Form Validation, Bootstraps JS,
* @see https://github.com/nitinegoro/spa-and-beauty
*/

jQuery(function($) {
	//$('#modal-id').modal('show');

	// get-payment modal
	$('.get-payments-modal').click( function() 
	{
		var booking_id = $(this).data('booking'); 

	    $.ajax({
	        url: base_url + '/transaction/getbooking/' + booking_id,
	        cache:false, 
	        type : 'GET',
	        success: function(obj) 
	        {
	        	show_modal_payment(obj[0], obj[1]);
	        }
	    });
	});

	// get modal booking delete
	$('.get-booking-delete').click( function() {
		var data_id = $(this).data('id');
		$('#modal-delete-booking').modal('show');
		$('#button-delete').attr('href', base_url + '/transaction/delete/' + data_id);
		return false;
	});

	// $('#table-packages').DataTable( {
	// 	"ordering" : true,
	// 	"order": [ 1,2,3],
	// 	"columns": [ { "orderable": false }, null, null,  null ]
	// });


	// get modal select package
	$('.get-modal-package').click( function() 
	{
		$('#booking-room-id').val($(this).data('room'));

	    $.ajax({
	        url: base_url + "/transaction/getpackage/" + $(this).data('room'), 
	        type:'GET',
	        success: function(response) {
	        	if(response.status == 'OK')
	        	{
					var rows = '';
		            $.each(response['results'], function(key, value)
		            {
		                rows = '<option value="'+value['ID']+'">'+value['name']+' - '+value['price']+'</option>';   
		               // console.log('<option value="'+value['ID']+'">'+value['name']+'</option>');  
		                rows = rows + '';
		                $('#inputSelect-Package').append(rows);    
		            });

					$('#modal-list-package').modal('show');
	        	} else {
					$.gritter.add({
						title: 'Warning!',
						text: 'Empty Package',
						time: '2000',
						class_name: 'gritter gritter-warning gritter-light'
					});
	        	}
	        }
	    });


		return false;
	});

    $('#table-customers').DataTable({ 
        "processing": true,
        "scrollCollapse": true,
        "paging": true,
        "order": [ 1,2,3, 4, 5, 6],
        "columns": [ { "orderable": false }, null, null,  null, null, null ],
    });

    $('#button-reset').click( function() {
    	$('#booking-customer').val("");
    	return;
    });
});


// checked tbles package
function checked(selector) 
{
	$(selector).prop('checked', true);
	return false;
}

// add to cart
function add_cart() 
{
	Pace.start();
    var form_asal  = $("#form-select-package");
    var form    = getFormData(form_asal);
    Pace.start();
    $.ajax({
        url: base_url + '/transaction/addcart', 
        type:'POST',
        data: form,
        success: function(obj) {
            if ( obj.status == 'OK' ) 
            {
            	show_cart_list(obj.result[0], obj.price, obj.result[1]);
               	$('#modal-list-package').modal('hide');
                return;
            } else {
            	$('#progress').hide();
				$.gritter.add({
					title: 'Warning!',
					text: obj.message,
					time: '2000',
					class_name: 'gritter gritter-warning gritter-light'
				});
				return false;            
			} 
        }
    });

    return false;
}

function add_customer() 
{
    var form_asal  = $("#form-select-customer");
    var form    = getFormData(form_asal);

    Pace.start();

    $.ajax({
        url: base_url + '/transaction/getcustomer/', 
        type:'POST',
        data: form,
        success: function(obj) {
            if ( obj.status == 'OK' ) 
            {
               	show_customer_data(obj.result);
               	$('#modal-customers').modal('hide');
                return;
            } else {

				$.gritter.add({
					title: 'Warning!',
					text: obj.message,
					time: '2000',
					class_name: 'gritter gritter-warning gritter-light'
				});
				return false;            
			} 
        }
    });

    return false;
}

function show_customer_data(customer) 
{
	$('#booking-customer').val(customer.customer_ID);
	$('#customer-name').val(customer.name);
	$('#customer-phone').val(customer.phone_number);
	$('#customer-address').val(customer.address);
	document.getElementById('input-optional').focus();
}

function show_cart_list(room, price, package) 
{
	var html_tbody;
	html_tbody 	= "<tr><td>- " + room.room_name + "<br> - " + package.package_name + "</td>";
	html_tbody += "<td>" + price + "</td>";
	html_tbody += '<td class="text-center"><a class="green pad update-package" data-room="'+room.ID_room+'" data-rel="popover" data-trigger="hover" data-placement="top" data-content="Update Package"><i class="ace-icon fa fa-pencil bigger-130"></i></a>';
	html_tbody += '<a class="red pad delete-cart" href="#" data-rel="popover" data-trigger="hover" data-placement="top" data-content="Delete Item"><i class="ace-icon fa fa-trash-o bigger-130"></i></a></td>';
	$('#table-cart').html(html_tbody);
	$('#booking-room').val(room.ID_room);
	$('#booking-package').val(package.package_ID);
	$('span.tprice').html(price);

	// get modal select package
	$('.update-package').click( function() 
	{
		$('#modal-list-package').modal('show');
		$('#booking-room-id').val($(this).data('room'));
		return false;
	});

	$('.delete-cart').click( function() 
	{
		$('#modal-delete-cart').modal('show');
		$('#yes-delete-cart').click( function() 
		{
			$('#modal-delete-cart').modal('hide');
			$('#table-cart').html("");
			$('span.tprice').html("0,00");
		})
		return;
	})
}

function show_modal_payment(object, price) 
{
	$('#modal-payments').modal('show');
	console.log(object);
	$('#booking-id').val(object['booking_id']);
	$('#incustomer-name').html(object['name']);
	$('#incustomer-address').html(object['address']);
	$('#item-value').html(object['package_name']);
	$('#item-price').html(object['price']);
	$('#total-amount').html(price['total_amount']);
	$('#total-value').val(price['total_amount']);
	$('#tax-amount').html(price['tax_amount']);
	document.getElementById('input-cash').focus();
	// /^-?\d+$/
	$('#input-cash').on('input', function() {
		var input_cash = $('#input-cash').val();
		$('#input-cash').val(input_cash.match(/^\d*\.?\d+$/));
	});

	$('#input-discount').on('input', function() {
		var discout;
		discout = $(this).val();
		console.log(discout.match(/^\d*\.?\d+$/));

		discout_fix = discout.match(/^\d*\.?\d+$/);

		$.ajax({
		    url: base_url + '/transaction/calculate/' + object['booking_id'] + '?disc=' + discout_fix + '&cash=' + $('#input-cash').val(),
		    cache:false, 
		    type : 'GET',
		    success: function(disc) 
		    {
		     	$('#total-amount').html(disc['total_amount']);
		     	$('#total-value').val(disc['total_amount']);
		     	$('#change-value').html(disc['change']);
		     	$('#discount-total').html(disc['total_discount']);
		    }
		});

		$('#total-amount').html('<i class="fa fa-spinner"></i>');
	});

	$('#input-cash').on('change keyup', function() 
	{
		$('#change-value').html('<i class="fa fa-spinner"></i>');
		if ($(this).val().length >= 4) { 
		    $.ajax({
		        url: base_url + '/transaction/calculate/' + object['booking_id'] + '?cash=' + $(this).val() + '&disc=' + $('#input-discount').val(),
		        cache:false, 
		        type : 'GET',
		        success: function(res) 
		        {
		        	$('#change-value').html(res['change']);
		        }
		    });
		}
	})

	return false;
}



function save_transaction(param) 
{
    var form_asal  = $("#form-payment");
    var form    = getFormData(form_asal);

    $.ajax({
        url: base_url + '/transaction/insert', 
        type:'POST',
        data: form,
        success: function(obj) {
            if ( obj.status == 'OK' ) {
                popup(base_url + '/transaction/print_out/' + obj.ID);
                newwindow=window.open(base_url + '/transaction/print_out/' + obj.ID,'name','height=600,width=800');
                if (window.focus) 
                {
                   	newwindow.focus();
                    window.location.assign(base_url + '/transaction');
                } else {
                	window.location.assign(base_url + '/transaction');
                }
                
            } else {
                alert("Failed to saving data.");
            } 
        }
    });

    function popup(url) {
        newwindow=window.open(url,'name','height=600,width=800');
        if (window.focus) {
            newwindow.focus()
        }
    }
}


function print_nota(id) {
    newwindow=window.open(base_url + '/transaction/print_out/' + id,'name','height=600,width=800');
    if (window.focus) {
        newwindow.focus()
    }
    return false;
}