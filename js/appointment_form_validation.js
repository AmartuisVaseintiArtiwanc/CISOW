







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










/* START SUBMIT VALIDATION FORM */
$(function() {

      var div_loading = $("<div>", {id: "fountainG"});

      var div_loading_item1 = $("<div>", {id: "fountainG_1", class: "fountainG"});

      var div_loading_item2 = $("<div>", {id: "fountainG_2", class: "fountainG"});

      var div_loading_item3 = $("<div>", {id: "fountainG_3", class: "fountainG"});

      var div_loading_item4 = $("<div>", {id: "fountainG_4", class: "fountainG"});

      var div_loading_item5 = $("<div>", {id: "fountainG_5", class: "fountainG"});

      var div_loading_item6 = $("<div>", {id: "fountainG_6", class: "fountainG"});

      var div_loading_item7 = $("<div>", {id: "fountainG_7", class: "fountainG"});

      var div_loading_item8 = $("<div>", {id: "fountainG_8", class: "fountainG"});

      div_loading.append(div_loading_item1,div_loading_item2,div_loading_item3,div_loading_item4,div_loading_item5,div_loading_item6,div_loading_item7,div_loading_item8);

      // Get the form.

      var form = $('#appointment_form_ajax');

      // Set up an event listener for the appointment form.

      $(form).submit(function(e) {

          // Stop the browser from submitting the form.

          e.preventDefault();

          // user data

          var name_appointment    = $("#appointment_name").val().trim();

          var email_address       = $("#appointment_email_address").val().trim();

          var phone_number        = $("#appointment_phone_number").val().trim();

          // company data

          var company_brand_name  = $("#appointment_company_brand_name").val().trim();

          // project data

          var services_need       = $('input[name=services_need]:checked').val().trim();

          var describe_project    = $("#appointment_describe_project").val().trim();

          var meeting_date        = $("#meeting_date").val().trim();

          var location            = $("#appointment_location").val().trim();








          if (key_ajax_name == true && key_ajax_email == true && key_ajax_phone_number == true && key_ajax_company_brand_name == true &&

              key_ajax_meeting_date == true && key_ajax_describe_project == true && key_ajax_location == true) {



              $.ajax({

                  type : "POST",

                  url : "<?php echo site_url('Parallax/Send_email_appointment'); ?>",

                  dataType : "json",

                  data : {    name_appointment : name_appointment,

                      email_address : email_address,

                      phone_number : phone_number,

                      company_brand_name : company_brand_name,

                      services_need : services_need,

                      meeting_date : meeting_date,

                      describe_project : describe_project,

                      location : location

                  },

                  beforeSend: function() {

                      $("#send-appointment-btn").attr('disabled','disabled');

                      $("#success_ajax_appointment").addClass("alert alert-info");

                      $("#success_ajax_appointment").append(div_loading);

                  },

                  success : function(result, status, xhr) {

                      $("#send-appointment-btn").removeAttr('disabled');

                      $("#success_ajax_appointment").html("");

                      $("#success_ajax_appointment").removeClass("alert alert-info");

                      $("#success_ajax_appointment").removeClass("alert alert-danger");

                      $("#success_ajax_appointment").addClass("alert alert-success");

                      $("#success_ajax_appointment").html(result.msg);

                      $('#success_ajax_appointment').fadeIn().delay(4000).fadeOut();



                      $('#notification p').html(result.msg);

                      $('#notification').modal('toggle');

                      /*

                       setTimeout(function() {

                       $('#notification').toggleClass('in');

                       setTimeout(function() {

                       $('#notification').modal('toggle');

                       }, 500);

                       }, 4000);

                       */

                      $('#appointment_form_ajax')[0].reset();

                      key_ajax_name = false;

                      key_ajax_email = false;

                      key_ajax_phone_number = false;

                      key_ajax_company_brand_name = false;

                      key_ajax_describe_project = false;

                      key_ajax_meeting_date = false;

                      key_ajax_location = false;



                  },

                  error : function(result, status, xhr){

                      //console.log('error');

                      $("#send-appointment-btn").removeAttr('disabled');

                      $("#success_ajax_appointment").html("");

                      $("#success_ajax_appointment").removeClass("alert alert-info");

                      $("#success_ajax_appointment").removeClass("alert alert-success");

                      $("#success_ajax_appointment").addClass("alert alert-danger");

                      $("#success_ajax_appointment").html('Thankyou for your message, but we are sorry your message wont reach us any time soon. We will fix it as soon as posible');

                      $('#success_ajax_appointment').fadeIn().delay(8000).fadeOut();



                      $('#notification p').html('Sorry your message wont reach us any time soon. We will fix it as soon as posible');

                      //$('#notification p').html(result.responseText);

                      $('#notification').modal('toggle');

                      /*

                       setTimeout(function() {

                       $('#notification').toggleClass('in');

                       setTimeout(function() {

                       $('#notification').modal('toggle');

                       }, 500);

                       }, 4000);

                       */

                      $('#appointment_form_ajax')[0].reset();

                      key_ajax_name = false;

                      key_ajax_email = false;

                      key_ajax_phone_number = false;

                      key_ajax_company_brand_name = false;

                      key_ajax_describe_project = false;

                      key_ajax_meeting_date = false;

                      key_ajax_location = false;

                  }





              });// End Ajax

          }

          else {

              //console.log('tidak masuk ajax');

              end_ajax_name = $("#appointment_name").val();

              $('#show_error_name').remove(); // remove the error text first

              $('#show_error_email_address').remove(); // remove the error text first

              $('#show_error_phone_number').remove(); // remove the error text first

              $('#show_error_company_brand_name').remove(); // remove the error text first

              $('#show_error_describe_project').remove(); // remove the error text first

              $('#show_error_meeting_date').remove(); // remove the error text first

              $('#show_error_location').remove(); // remove the error text first



              // show error if submit button is press

              if (name_appointment == '' && name_appointment.length <= 3) {

                  $('#name-group').addClass('has-error');

                  $('#name-group').append('<div id = "show_error_name" class="help-block">' + 'Please Input Your Name' + '</div>');

              }

              else if (name_appointment.length <= 3) {

                  $('#name-group').addClass('has-error');

                  $('#name-group').append('<div id = "show_error_name" class="help-block">' + 'Kurang Panjang' + '</div>');

              }

              if (email_address == '') {

                  $('#email_address-group').addClass('has-error');

                  $('#email_address-group').append('<div id = "show_error_email_address" class="help-block">' + 'Please Input Your Email Address' + '</div>');

              }

              if (phone_number == '') {

                  $('#phone_number-group').addClass('has-error');

                  $('#phone_number-group').append('<div id = "show_error_phone_number" class="help-block">' + 'Please Input Your Phone Number' + '</div>');

              }

              if (company_brand_name == '') {

                  $('#company_brand_name-group').addClass('has-error');

                  $('#company_brand_name-group').append('<div id = "show_error_company_brand_name" class="help-block">' + 'Please Input Your Company or Brand Name' + '</div>');

              }

              if (describe_project == '') {

                  $('#describe_project-group').addClass('has-error');

                  $('#describe_project-group').append('<div id = "show_error_describe_project" class="help-block">' + 'Please Describe Your Project' + '</div>');

              }

              if (meeting_date == '') {

                  $('#meeting_date-group').addClass('has-error');

                  $('#meeting_date-group').append('<div id = "show_error_meeting_date" class="help-block">' + 'Please Input Your Meeting Date' + '</div>');

              }

              if (location == '') {

                  $('#location-group').addClass('has-error');

                  $('#location-group').append('<div id = "show_error_location" class="help-block">' + 'Please Input Your Meeting Location' + '</div>');

              }

          } // End if else statement

      }); // End Form Submit

}); // End Function

/* END SUBMIT VALIDATION FORM */

$('#meeting_date-group input').datepicker({
  format: "dd/MM/yyyy",
  startDate: "+1d",
  daysOfWeekDisabled: "0",
  daysOfWeekHighlighted: "0",
  todayHighlight: true,
  autoclose: true
});