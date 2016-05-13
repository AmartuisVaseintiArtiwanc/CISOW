// Get the form.
var form = $('#contactForm');

// validation form appointment
key_ajax_contactName = false;
key_ajax_contactEmail = false;
key_ajax_contactMessage = false;

function validateEmail_contact(email) { 
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}


$('#contactName').on('input', function() {
  $('#show_error_name').remove(); // remove the error text first
  var input=$(this);
  var input_name=input.val().trim();
  if(input_name != '' && input_name.length > 3){
    key_ajax_contactName = true;
    console.log(key_ajax_contactName);
    $('#contactName-group').removeClass('has-error');
    //$('$contactName-group , .help-block').remove();
  }
  else if(input_name != '' && input_name.length <= 3) {
    key_ajax_contactName = false;
    console.log(key_ajax_contactName);
    console.log('kurang');
    $('#contactName-group').addClass('has-error');
    $('#contactName-group').append('<div id = "show_error_name" class="help-block">' + 'Your Input Atleast Must Have 3 Characters' + '</div>');

  }
  else{
    key_ajax_contactName = false;
    console.log(key_ajax_contactName);
    $('#contactName-group').addClass('has-error');
    $('#contactName-group').append('<div id = "show_error_name" class="help-block">' + 'Please Input Your Name' + '</div>');
  }
});
$('#contactEmail').on('input', function() {
  $('#show_error_email_address').remove(); // remove the error text first
  var input=$(this);
  var input_email_contact=input.val().trim();
  if(input_email_contact != ''){

    if (validateEmail_contact(input_email_contact)) {
      key_ajax_contactEmail = true;
      $('#contactEmail-group').removeClass('has-error');
    }
    else {
      key_ajax_contactEmail = false;
      $('#contactEmail-group').addClass('has-error');
      $('#contactEmail-group').append('<div id = "show_error_email_address" class="help-block">' + 'Please Input Your Email Address Correctly' + '</div>');
    }

    console.log(key_ajax_contactEmail);
    //$('$contactEmail-group , .help-block').remove();
  }
  else{
    key_ajax_contactEmail = false;
    console.log(key_ajax_contactEmail);
    $('#contactEmail-group').addClass('has-error');
    $('#contactEmail-group').append('<div id = "show_error_email_address" class="help-block">' + 'Please Input Your Email Address' + '</div>');
  }
});
$('#contactMessage').on('input', function() {
  $('#show_error_message').remove(); // remove the error text first
  var input=$(this);
  var input_company_brand_name=input.val().trim();
  if(input_company_brand_name != ''){
    key_ajax_contactMessage = true;
    console.log(key_ajax_contactMessage);
    $('#contactMessage-group').removeClass('has-error');
    //$('$contactMessage-group , .help-block').remove();
  }
  else{
    key_ajax_contactMessage = false;
    console.log(key_ajax_contactMessage);
    $('#contactMessage-group').addClass('has-error');
    $('#contactMessage-group').append('<div id = "show_error_message" class="help-block">' + 'Please Input Your Message' + '</div>');
  }
});

// End Validation Form Before Submit