



// validation form appointment
key_ajax_name = false;
key_ajax_email = false;
key_ajax_phone_number = false;
key_ajax_company_brand_name = false;
key_ajax_meeting_date = false;
key_ajax_describe_project = false;
key_ajax_location = false;


function validateEmail(email) { 
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}



$('#appointment_name').on('input', function() {
  $('#show_error_name').remove(); // remove the error text first
  var input=$(this);
  var input_name=input.val().trim();
  if(input_name != '' && input_name.length > 3){
    key_ajax_name = true;
    console.log(key_ajax_name);
    $('#name-group').removeClass('has-error');
    //$('$name-group , .help-block').remove();
  }
  else if(input_name != '' && input_name.length <= 3) {
    key_ajax_name = false;
    console.log(key_ajax_name);
    //console.log('Your Input Atleast Must Have 3 Characters');
    $('#name-group').addClass('has-error');
    $('#name-group').append('<div id = "show_error_name" class="help-block">' + 'Your Input Atleast Must Have 3 Characters' + '</div>');

  }
  else{
    key_ajax_name = false;
    //console.log(key_ajax_name);
    $('#name-group').addClass('has-error');
    $('#name-group').append('<div id = "show_error_name" class="help-block">' + 'Please Input Your Name' + '</div>');
  }
});
$('#appointment_email_address').on('input', function() {
  $('#show_error_email_address').remove(); // remove the error text first
  var input=$(this);
  var input_email=input.val().trim();
  if(input_email != ''){
    if (validateEmail(input_email)) {
      key_ajax_email = true;
      $('#email_address-group').removeClass('has-error');
    }
    else {
      key_ajax_email = false;
      $('#email_address-group').addClass('has-error');
      $('#email_address-group').append('<div id = "show_error_email_address" class="help-block">' + 'Please Input Your Email Address Correctly' + '</div>');
    }
    //console.log(key_ajax_email);
    //$('$email_address-group , .help-block').remove();
  }
  else{
    key_ajax_email = false;
    //console.log(key_ajax_email);
    $('#email_address-group').addClass('has-error');
    $('#email_address-group').append('<div id = "show_error_email_address" class="help-block">' + 'Please Input Your Email Address' + '</div>');
  }
});
$('#appointment_phone_number').on('input', function() {
  $('#show_error_phone_number').remove(); // remove the error text first
  var input=$(this);
  var input_phone_number=input.val().trim();
  if(input_phone_number != ''){
    key_ajax_phone_number = true;
    //console.log(key_ajax_phone_number);
    $('#phone_number-group').removeClass('has-error');
    //$('$phone_number-group , .help-block').remove();
  }
  else{
    key_ajax_phone_number = false;
    //console.log(key_ajax_phone_number);
    $('#phone_number-group').addClass('has-error');
    $('#phone_number-group').append('<div id = "show_error_phone_number" class="help-block">' + 'Please Input Your Phone Number' + '</div>');
  }
});
$('#appointment_company_brand_name').on('input', function() {
  $('#show_error_company_brand_name').remove(); // remove the error text first
  var input=$(this);
  var input_company_brand_name=input.val().trim();
  if(input_company_brand_name != ''){
    key_ajax_company_brand_name = true;
    //console.log(key_ajax_company_brand_name);
    $('#company_brand_name-group').removeClass('has-error');
    //$('$company_brand_name-group , .help-block').remove();
  }
  else{
    key_ajax_company_brand_name = false;
    //console.log(key_ajax_company_brand_name);
    $('#company_brand_name-group').addClass('has-error');
    $('#company_brand_name-group').append('<div id = "show_error_company_brand_name" class="help-block">' + 'Please Input Your Company or Brand Name' + '</div>');
  }
});
$('#appointment_describe_project').on('input', function() {
  $('#show_error_describe_project').remove(); // remove the error text first
  var input=$(this);
  var input_describe_project=input.val().trim();
  if(input_describe_project != ''){
    key_ajax_describe_project = true;
    //console.log(key_ajax_describe_project);
    $('#describe_project-group').removeClass('has-error');
    //$('$describe_project-group , .help-block').remove();
  }
  else{
    key_ajax_describe_project = false;
    //console.log(key_ajax_describe_project);
    $('#describe_project-group').addClass('has-error');
    $('#describe_project-group').append('<div id = "show_error_describe_project" class="help-block">' + 'Please Describe Your Project' + '</div>');
  }
});
// validasi meeting date setelah di submit
$("#appointment_form_ajax").submit(function(e) {
  $('#show_error_meeting_date').remove(); // remove the error text first
  var meeting_date = $("#meeting_date").val().trim();
  if(meeting_date != ''){
    key_ajax_meeting_date = true;
    $('#meeting_date-group').removeClass('has-error');
    //$('$meeting_date-group , .help-block').remove();
  }
  else{
    key_ajax_meeting_date = false;
    $('#meeting_date-group').addClass('has-error');
    $('#meeting_date-group').append('<div id = "show_error_meeting_date" class="help-block">' + 'Please Input Your Meeting Date Location' + '</div>');
  }
});
$('#appointment_location').on('input', function() {
  $('#show_error_location').remove(); // remove the error text first
  var input=$(this);
  var input_location=input.val().trim();
  if(input_location != ''){
    key_ajax_location = true;
    //console.log(key_ajax_location);
    $('#location-group').removeClass('has-error');
    //$('$location-group , .help-block').remove();
  }
  else{
    key_ajax_location = false;
    //console.log(key_ajax_location);
    $('#location-group').addClass('has-error');
    $('#location-group').append('<div id = "show_error_location" class="help-block">' + 'Please Input Your Company Location' + '</div>');
  }
});

// End Validation Form Before Submit