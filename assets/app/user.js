/*!
*
* @user user module
* @author Vicky Nitinegoro 
* 
*/

jQuery(function($) {

    // set delete one
    $('.open-user-delete').click( function() {
        var data_id = $(this).data('id');
        $('#modal-delete').modal('show');
        $('a#button-delete').attr('href', base_url + '/user/delete/' + data_id);
        return false;
    });

    // set delete multiple
    $('.open-delete-multiple').click( function() {
        if( $('input[type=checkbox]').is(':checked') != '' ) {
            $('#modal-delete-multiple').modal('show');
        }
        return false;
    });

    // get form update divisi
    $('.open-role-delete').click( function() {
        var data_id = $(this).data('id');
        $('#modal-delete-role').modal('show');
         $('a#button-delete').attr('href', base_url + '/user/deleterole/' + data_id);
        return false;
    });

});


$(document).ready(function() {
    $('#create_user').formValidation({
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            username: {
                validators: {  
                    notEmpty: { },
                   	remote: {
                        message: 'Username is already in use.',
                        type: 'POST',
                        url: base_url + '/user/getusername/',
                        delay: 1000
                    }
                },

            },
            password: {
                validators: {
                    identical: {
                        field: 'pass_again'
                    },
                    stringLength: {
                        min: 6
                    }
                }
            },
            pass_again: {
                validators: {
                    identical: {
                        field: 'password'
                    }
                }
            }
        }
    });
    $('#account_setting').formValidation({
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            username: {
                validators: {  
                    notEmpty: { },
                    remote: {
                        message: 'Username is already in use.',
                        type: 'POST',
                        url: base_url + '/user/getusername/',
                        delay: 1000
                    }
                },

            },
            password: {
                validators: {
                    identical: {
                        field: 'pass_again',
                    },
                    stringLength: {
                        min: 6,
                        message: 'Minimal 6 Karakter.'
                    }
                }
            },
            pass_again: {
                validators: {
                    identical: {
                        field: 'password',
                    }
                }
            },
            old_pass: {
                validators: {
                    notEmpty: {},
                    remote: {
                        type: 'POST',
                        url: base_url + '/user/authpass/',
                        delay: 1000,
                        message: 'Old password does not match'
                    }
                }
            }
        }
    });
});

$('#password').pwstrength({
    ui: { showVerdictsInsideProgressBar: true }
});

