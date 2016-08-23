<!DOCTYPE html>
<html>
<head>
    <title>CYBERITS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='shortcut icon' href='<?php echo base_url();?>assets/image/favicon-32x32.ico' type='image/x-icon'>
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,500,400' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/custom/preloading.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugin/datepicker/bootstrap-datepicker.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugin/hover_css/hover-min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/custom/animate_header.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/custom/main.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/custom/appointment_form.css">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            position: relative;
        }
    </style>
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="50">

<!--PRELOADING -->
<div id="loader-wrapper">
    <div id="loader" class="animated infinite flip">
        <img src="<?php echo base_url();?>assets/image/logo/Logo_300_V_ppi.png" class="img-responsive"/>
    </div>

    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>

</div>

<nav class="navbar navbar-inverse header-nav">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="#"><img src="<?php echo base_url();?>assets/image/logo/Logo_150_H_ppi.png" class="img-responsive" width="125"/></a>
        </div>
        <div>
            <div class="collapse navbar-collapse" id="home-navbar">
                <ul class="nav navbar-nav">
                    <li><a href="#home-section">HOME</a></li>
                    <li><a href="#article-section">ARTICLE</a></li>
                    <li><a href="#service-section">SERVICE</a></li>
                    <li><a href="#how-we-work-section">HOW WE WORK</a></li>
                    <li><a href="#our-team-section">OUR TEAM</a></li>
                    <li><a href="#contact-us-section">CONTACT US</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>


<?php $this->load->view('home_section');?>
<?php $this->load->view('article_section');?>

<section id="wrap1-section">
    <div class="container container-fluid">
        <h1 class=" slideInDown text-center">Kami ada untuk Anda! </h1>
        <p class=" slideInRight text-center"> Kami memberikan konsultasi terbaik bagi pemenuhan kebutuhan IT anda
            mendalami apa yang anda miliki saat ini,
            dan merekomendasikan ide serta teknologi terbaru yang sesuai dengan kebutuhan anda!
        </p>
    </div>
</section>

<?php $this->load->view('service_section');?>
<section id="wrap2-section">
    <div class="container container-fluid">
        <h2 class="slideInDown text-center">Memberdayakan UKM dan Bisnis Anda!</h2>
        <p class="slideInLeft text-center">
            Kami berkomitmen membangun setiap UKM dan Bisnis agar memiliki sistem infrastruktur IT yang baik untuk menjalankan bisnis mereka.
        </p>
    </div>
</section>

<?php $this->load->view('how_we_work_section');?>
<section id="wrap3-section">
    <div class="container container-fluid">
        <h2 class="slideInDown text-center">Kami mengedepankan Kualitas & Profesionalisme</h2>
        <p class="slideInRight text-center">
            Kami terus mengembangkan diri dalam memberikan solusi IT terbaik dan profesional bagi Anda!
        </p>
    </div>
</section>

<?php $this->load->view('team_section');?>
<?php $this->load->view('contact_us_section');?>
<?php $this->load->view('footer_section');?>

<!-- Appointment Form -->
<div id="appointment_form" class="modal fade" tabindex="1" aria-labelledby="modal_appointment_form" aria-hidden="true">
    <?php $this->load->view('fe/home/appointment_form_view'); ?>
</div>



<script src="<?php echo base_url();?>assets/jquery/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugin/datepicker/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url();?>assets/plugin/wow_js/wow.min.js"></script>
<script src="<?php echo base_url();?>assets/custom/appointment_form_validation.js"></script>
<!-- write script to toggle class on scroll -->
<script>
    $(window).scroll(function() {
        if ($(this).scrollTop() > 1){
            $('nav.header-nav').addClass("sticky");
        }
        else{
            $('nav.header-nav').removeClass("sticky");
        }
    });

    $(document).ready(function(){

        new WOW().init();

        //remove scroll bar
        $('html, body').css({ 'overflow': 'hidden', 'height': '100%' });
        $("#home-section-logo-container img").hide();

        $(window).load(function(){
            setTimeout(function(){
                $("#loader").removeClass("animated infinite flip");
                setTimeout(function() {
                    $("#loader").addClass("animated zoomOutUp");
                    $('html, body').removeAttr('style');
                    $('body').addClass('loaded');
                    animationHome();
                },300);
            }, 2000);
        });

        function animationHome(){

            setTimeout(function() {
                $("#home-section-logo-container img").addClass("animated zoomIn").show();
                $("#tag-line-container").delay(400).addClass("flipInX");
                $("#tag-line-two-container").delay(800).addClass("flipInX");
                $("#btn-meet-us-home").delay(1200).addClass("flipInX");

            },400);
        }


        $(".our-team-item").hover(function(){
            $(this).children(".team-link-container").css("visibility", "visible");
        }, function(){
            $(this).children(".team-link-container").css("visibility", "hidden");
        });

        //Smoth Scroll
        $('#home-navbar ul li a').click(function () {
            var url = $(this).attr('href');
            $('html,body').animate({
                scrollTop: $(url).offset().top
            }, 1000, 'swing');
            //$('#sidebar-wrapper').animate({width: 0}, {duration: 400});
            return false;
        });

        //SERVICE
        $(".service-item-btn").click(function(){
            var $service = $(this).attr("data-src");
            var $service_form = $(this).attr("data-form");
            //Show hide ICON
            $(".service-item-img").hide(1000);
            $($service+"icon").show(1000);

            //Show hide DESC
            $(".service-desc-item ").fadeOut(500);
            $($service+"desc").fadeIn(1000);

            $(".service-item-btn").removeClass("active");
            $(this).addClass("active");

            //Jenis form Checked
            $($service_form).prop("checked", true);
        });
    });
</script>



<!-- START SCRIPT CONTACT US -->
<script>
    $(function() {
        // validation form appointment
        key_ajax_contactEmail = false;
        key_ajax_contactSubject = false;
        key_ajax_contactMessage = false;
        function validateEmail_contact(email) { 
          var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
          return re.test(email);
        }
        // EMAIL
        $('#contact-us-form-email').on('input', function() {
          $('#show_error_email_address').remove(); // remove the error text first
          var input=$(this);
          var input_email_contact=input.val().trim();
          if(input_email_contact != ''){
            if (validateEmail_contact(input_email_contact)) {
              key_ajax_contactEmail = true;
              $('#contact-us-form-email-group').removeClass('has-error');
            }
            else {
              key_ajax_contactEmail = false;
              $('#contact-us-form-email-group').addClass('has-error');
              $('#contact-us-form-email-group').append('<div id = "show_error_email_address" class="help-block">' + 'Please Input Your Email Address Correctly' + '</div>');
            }
            console.log(key_ajax_contactEmail);
            //$('$contact-us-form-email-group , .help-block').remove();
          }
          else{
            key_ajax_contactEmail = false;
            console.log(key_ajax_contactEmail);
            $('#contact-us-form-email-group').addClass('has-error');
            $('#contact-us-form-email-group').append('<div id = "show_error_email_address" class="help-block">' + 'Please Input Your Email Address' + '</div>');
          }
        });

        // SUBJECT
        $('#contact-us-form-subject').on('input', function() {
          $('#show_error_subject').remove(); // remove the error text first
          var input=$(this);
          var input_subject=input.val().trim();
          if(input_subject != '' && input_subject.length > 3){
            key_ajax_contactSubject = true;
            console.log(key_ajax_contactSubject);
            $('#contact-us-form-subject-group').removeClass('has-error');
            //$('$contact-us-form-subject-group , .help-block').remove();
          }
          else if(input_subject != '' && input_subject.length <= 3) {
            key_ajax_contactSubject = false;
            console.log(key_ajax_contactSubject);
            console.log('kurang');
            $('#contact-us-form-subject-group').addClass('has-error');
            $('#contact-us-form-subject-group').append('<div id = "show_error_subject" class="help-block">' + 'Your Input At Least Must Have 3 Characters' + '</div>');
           }
          else{
            key_ajax_contactSubject = false;
            console.log(key_ajax_contactSubject);
            $('#contact-us-form-subject-group').addClass('has-error');
            $('#contact-us-form-subject-group').append('<div id = "show_error_subject" class="help-block">' + 'Please Input Your Subject' + '</div>');
          }
        });


        // MESSAGE
        $('#contact-us-form-message').on('input', function() {
          $('#show_error_message').remove(); // remove the error text first
          var input=$(this);
          var input_message=input.val().trim();
          if(input_message != ''){
            key_ajax_contactMessage = true;
            console.log(key_ajax_contactMessage);
            $('#contact-us-form-message-group').removeClass('has-error');
            //$('$contact-us-form-message-group , .help-block').remove();
          }
          else{
            key_ajax_contactMessage = false;
            console.log(key_ajax_contactMessage);
            $('#contact-us-form-message-group').addClass('has-error');
            $('#contact-us-form-message-group').append('<div id = "show_error_message" class="help-block">' + 'Please Input Your Message' + '</div>');
          }
        });

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
        var form = $('#contact-us-form-isi');
        // Set up an event listener for the appointment form.


        $(form).submit(function(e) {
            // Stop the browser from submitting the form.
            e.preventDefault();
            // user data
            var contactEmail    = $("#contact-us-form-email").val().trim();
            var contactSubject  = $("#contact-us-form-subject").val().trim();
            var contactMessage  = $("#contact-us-form-message").val().trim();

            //*
            if (key_ajax_contactEmail == true && key_ajax_contactSubject == true && key_ajax_contactMessage == true) {
                $.ajax({
                    type : "POST",
                    url : "<?php echo site_url('Parallax/Send_email_contactus'); ?>",
                    dataType : "json",
                    data : {    contactSubject : contactSubject,
                                contactEmail : contactEmail,
                                contactMessage : contactMessage
                    },
                    beforeSend: function() {
                        $("#contact-us-form-isi button").attr('disabled','disabled');
                        $("#success_ajax").addClass("alert alert-info");
                        $("#success_ajax").append(div_loading);
                    },
                    success : function(result, status, xhr){
                        $("#contact-us-form-isi button").removeAttr('disabled');
                        $("#success_ajax").html("");
                        $("#success_ajax").removeClass("alert alert-info");
                        $("#success_ajax").removeClass("alert alert-danger");
                        $("#success_ajax").addClass("alert alert-success");
                        $("#success_ajax").html(result.msg);
                        $('#success_ajax').fadeIn().delay(4000).fadeOut();
                        $('#contact-us-form-isi')[0].reset();
                        key_ajax_contactEmail = false;
                        key_ajax_contactSubject = false;
                        key_ajax_contactMessage = false;
                        console.log("berhasil kirim pesan");
                    },
                    error : function(result, status, xhr){
                        console.log('error mau keserver');
                        $("#contact-us-form-isi button").removeAttr('disabled');
                        //console.log(result.msg);
                        $("#success_ajax").html("");
                        $("#success_ajax").removeClass("alert alert-info");
                        $("#success_ajax").removeClass("alert alert-success");
                        $("#success_ajax").addClass("alert alert-danger");
                        $("#success_ajax").html('Thankyou for your message, but we are sorry your message wont reach us any time soon. We will fix it as soon as posible');
                        $('#success_ajax').fadeIn().delay(8000).fadeOut();
                        $('#contact-us-form-isi')[0].reset();
                        key_ajax_contactEmail = false;
                        key_ajax_contactSubject = false;
                        key_ajax_contactMessage = false;
                    }
                });// End Ajax
            } else {
                console.log('tidak masuk ajax');
                $('#show_error_subject').remove(); // remove the error text first
                $('#show_error_email_address').remove(); // remove the error text first
                $('#show_error_message').remove(); // remove the error text first

                // show error if submit button is press
                if (contactSubject == '' && contactSubject.length <= 3) {
                    $('#contact-us-form-subject-group').addClass('has-error');
                    $('#contact-us-form-subject-group').append('<div id = "show_error_subject" class="help-block">' + 'Please Input Your Subject' + '</div>');
                }
                else if (contactSubject.length <= 3) {
                    $('#contact-us-form-email-group').addClass('has-error');
                    $('#contact-us-form-email-group').append('<div id = "show_error_subject" class="help-block">' + 'Not Quite Long Enought' + '</div>');
                }
                if (contactEmail == '') {
                    $('#contact-us-form-email-group').addClass('has-error');
                    $('#contact-us-form-email-group').append('<div id = "show_error_email_address" class="help-block">' + 'Please Input Your Email Address' + '</div>');
                }
                if (contactMessage == '') {
                    $('#contact-us-form-message-group').addClass('has-error');
                    $('#contact-us-form-message-group').append('<div id = "show_error_message" class="help-block">' + 'Please Input Your Message' + '</div>');
                }
            } // End if else statement
            //*/
        }); // End Form Submit
    }); // End Function
</script>
<!-- END SCRIPT CONTACT US -->

</body>
</html>

