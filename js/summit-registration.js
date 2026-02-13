/* jQuery */

( function( $ ) {
	
	$('.afrfb-form-register').attr('id', 'summitregistration');
	
	jQuery.validator.setDefaults({
  		debug: false,
  		success: "valid"
	});

	// function to validate first password
	jQuery.validator.addMethod("pwcheck", function(value) {
		return /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/.test(value)
	});
	jQuery.validator.addMethod("emailcheck", function(value) {
		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  		return regex.test(value);
	});

	$( "#summitregistration" ).validate({
  		rules: {
			password:{
				minlength:8,
				pwcheck:true
			},
			confirm_password:{
				minlength:8,
				equalTo:'#password'
			},
			email:{
				emailcheck:true
			},
			confirm_email:{
				equalTo:'#email'
			}
  		},
		messages: {
            password: {
                minlength: "Please enter a password at least 8 characters long.",
				pwcheck: "Please enter a password with at least one number and one special character."
            },
            confirm_password: {
				minlength: "Your passwords do not match. Please try again.",
               	equalTo: "Your passwords do not match. Please try again."
           	},
			confirm_email: {
				equalTo: "Your emails do not match. Please try again."
			}
        },
	});
	
}( jQuery ) );

const params = new URLSearchParams(window.location.search);
if (params.get('app') === 'success') {
	
	var successDiv = document.getElementById('app-success');
	var form = document.getElementById('summitregistration');
	if (successDiv) {
		successDiv.style.display = 'block';
	}
	
	if (form) {
		form.style.display = 'none';
	}
	
	window.lintrk('track', { conversion_id: 19734473 });
}

