<div class="container">

    <div class="row">

        <h2 class="centered">CONTACT US</h2>

        <hr>

        <div class="col-md-4 centered wow bounceInLeft"> <i class="fa fa-map-marker fa-2x"></i>

            <p><b>Cyber IT Solution</b><br />

                + 62 21 535 0 651 ext 2427<br />

                Jl. Kebon Jeruk Raya No. 27 DKI Jakarta - 11530<br />

                www.cyberits.co.id</p>

        </div>

        <div class="col-md-4 wow fadeInDown"> <i class="fa fa-envelope-o fa-2x"></i>

            <p>CS@cyberits.co.id</p>

        </div>

        <div class="col-md-4 wow bounceInRight"> <i class="fa fa-phone fa-2x"></i>

            <p> + 62 21 535 0 651 <br/>(Ext. 2427)</p>

        </div>

    </div>

    <div class="row wow bounceInUp">

        <div class="contact-form-container">

            <!--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut eaque, laboriosam veritatis, quos non quis ad perspiciatis, totam corporis ea, alias ut unde.</p>-->

            <form id="contactForm" name="sentMessage" class="form" novalidate>

                <div class = "row">

                    <div id = 'success_ajax' class="text-center"> </div>

                </div>



                <div class="row">

                    <div id = 'contactName-group' class="col-xs-12 col-sm-6 col-md-6 form-group">

                        <input type="text" id="contactName" class="form-control" placeholder="Name" required="required">

                        <p class="help-block text-danger"></p>

                    </div>

                    <div id = 'contactEmail-group' class="col-xs-12 col-sm-6 col-md-6 form-group">

                        <input type="email" id="contactEmail" class="form-control" placeholder="Email" required="required">

                        <p class="help-block text-danger"></p>

                    </div>

                    <div id = 'contactMessage-group' class="col-xs-12 col-md-12 form-group">

                        <textarea name="contactMessage" id="contactMessage" class="form-control" rows="5" placeholder="Message" required></textarea>

                        <p class="help-block text-danger"></p>

                    </div>

                </div>



                <div id="success"></div>

                <button class="btn btn btn-lg" type="submit">Kirim Pesan</button>

            </form>

            <!-- form -->

        </div>

    </div>

    <!-- row -->



</div>



<!-- Script Ajax Conctact Me  -->

<script>

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

        var form = $('#contactForm');

        // Set up an event listener for the appointment form.

        $(form).submit(function(e) {

            // Stop the browser from submitting the form.

            e.preventDefault();

            // user data

            var contactName     = $("#contactName").val().trim();

            var contactEmail    = $("#contactEmail").val().trim();

            var contactMessage  = $("#contactMessage").val().trim();



            if (key_ajax_contactName == true && key_ajax_contactEmail == true && key_ajax_contactMessage == true) {

                $.ajax({

                    type : "POST",

                    url : "<?php echo site_url('Parallax/Send_email_contactus'); ?>",

                    dataType : "json",

                    data : {    contactName : contactName,

                        contactEmail : contactEmail,

                        contactMessage : contactMessage

                    },

                    beforeSend: function() {

                        $("#contactForm button").attr('disabled','disabled');

                        $("#success_ajax").addClass("alert alert-info");

                        $("#success_ajax").append(div_loading);

                    },

                    success : function(result, status, xhr){

                        $("#contactForm button").removeAttr('disabled');

                        $("#success_ajax").html("");

                        $("#success_ajax").removeClass("alert alert-info");

                        $("#success_ajax").removeClass("alert alert-danger");

                        $("#success_ajax").addClass("alert alert-success");

                        $("#success_ajax").html(result.msg);

                        $('#success_ajax').fadeIn().delay(4000).fadeOut();



                        $('#contactForm')[0].reset();

                        key_ajax_contactName = false;

                        key_ajax_contactEmail = false;

                        key_ajax_contactMessage = false;



                    },

                    error : function(result, status, xhr){

                        console.log('error mau keserver');

                        $("#contactForm button").removeAttr('disabled');

                        //console.log(result.msg);

                        $("#success_ajax").html("");

                        $("#success_ajax").removeClass("alert alert-info");

                        $("#success_ajax").removeClass("alert alert-success");

                        $("#success_ajax").addClass("alert alert-danger");

                        $("#success_ajax").html('Thankyou for your message, but we are sorry your message wont reach us any time soon. We will fix it as soon as posible');

                        $('#success_ajax').fadeIn().delay(8000).fadeOut();



                        $('#contactForm')[0].reset();

                        key_ajax_contactName = false;

                        key_ajax_contactEmail = false;

                        key_ajax_contactMessage = false;

                    }

                });// End Ajax

            } else {

                console.log('tidak masuk ajax');



                $('#show_error_name').remove(); // remove the error text first

                $('#show_error_email_address').remove(); // remove the error text first

                $('#show_error_message').remove(); // remove the error text first



                // show error if submit button is press

                if (contactName == '' && contactName.length <= 3) {

                    $('#contactName-group').addClass('has-error');

                    $('#contactName-group').append('<div id = "show_error_name" class="help-block">' + 'Please Input Your Name' + '</div>');

                }

                else if (contactName.length <= 3) {

                    $('#contactName-group').addClass('has-error');

                    $('#contactName-group').append('<div id = "show_error_name" class="help-block">' + 'Kurang Panjang' + '</div>');

                }

                if (contactEmail == '') {

                    $('#contactEmail-group').addClass('has-error');

                    $('#contactEmail-group').append('<div id = "show_error_email_address" class="help-block">' + 'Please Input Your Email Address' + '</div>');

                }

                if (contactMessage == '') {

                    $('#contactMessage-group').addClass('has-error');

                    $('#contactMessage-group').append('<div id = "show_error_message" class="help-block">' + 'Please Input Your Message' + '</div>');

                }

            } // End if else statement

        }); // End Form Submit

    }); // End Function

</script>