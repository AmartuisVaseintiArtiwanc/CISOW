$(function() {

  // Get the form.
  var form = $('#appointment_form_ajax');

  console.log('masuk');

  // Set up an event listener for the contact form.
  $(form).submit(function(e) {
    // Stop the browser from submitting the form.
    e.preventDefault();

    // Serialize the form data.
    //var formData = $(form).serialize();
   
    // user data
    var name_appointment    = $("#appointment_name").val();
    var email_address       = $("#appointment_email_address").val();
    var phone_number        = $("#appointment_phone_number").val();

    // company data
    var company_brand_name  = $("#appointment_company_brand_name").val();
    var location            = $("#appointment_location").val();

    // project data
    var describe_project    = $("#appointment_describe_project").val();

    //console.log(name_appointment);
    $.ajax({
      type : "POST",
      url : "<?php echo site_url('Parallax/Appointment_parallax_view'); ?>",
      dataType : "json",
      data : {    name_appointment : name_appointment, 
                  email_address : email_address
              },
      success : function(result, status, xhr){
        console.log('berhasil');
      },
      error : function(result, status, xhr){
        // do something
        //alert('salah');
        console.log('error');
        console.log(arguments);
      }
    });
    /*
    $.ajax({
      type : "POST",
      url : "<?php echo site_url('Parallax/Appointment_parallax_view'); ?>",
      dataType : "json",
      data : {    name_appointment : name_appointment, 
                  email_address : email_address,
                  phone_number : phone_number,

                  company_brand_name : company_brand_name,
                  location : location,

                  describe_project : describe_project 

              },
      success : function(result, status, xhr){
        alert(result.msg);
        //$("#name").val("Dolly Duck");
        //alert($("#email_address").html());

        //email_address = 'jahjhas';
        console.log(result.name_appointment);
        console.log(result.email_address);
        console.log(result.phone_number);

        console.log(result.company_brand_name);
        console.log(result.location);

        console.log(result.describe_project);


      },
      error : function(result, status, xhr){
          // do something
          alert('salah');
      }
    });
    //*/






  });


});