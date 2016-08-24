
<style>

    #contact-us-section #contact-us-wrap{
        margin-top: 150px;
    }
    #contact-us-section #contact-us-info {
        background-color: #ffcb1f;
        height: 400px;
        color: #000;
        padding: 20px;
        padding-top: 0px;
        padding-left: 40px;
        font-size: 16px;
    }

    #contact-us-section #contact-us-info .contact-us-info-detail {
        margin-bottom: 16px;
    }
    #contact-us-section #contact-us-info hr{
        border-top: 3px solid #000;
        width: 40%;
        margin-left: 0px;
    }

    #contact-us-section #contact-us-form {
        padding-left: 20px;
        padding-right: 20px;
        font-size: 28px;
        font-weight: 400!important;
    }
    #contact-us-section #contact-us-form #button-submit {
        width: 100%;
        border-radius: 0;
        margin-top: 100px;
        padding: 10px;
        margin: auto;
        cursor: pointer;
        background-color: #ffcb1f;
        color: #000;
    }
    #contact-us-section #contact-us-form #button-submit > h3{
        font-size: 1.5vw;
        font-weight: 500;
        margin: 0 auto;
    }

    #contact-us-form-isi .form-control{
        border-radius: 0;
        font-size: 16px;
    }
    #contact-us-form-isi .form-control:focus{
        border-color: #ffcb1f;
    }
    .label-error-msg{
        font-size: 17px;
        font-weight: 500;
        display: none;
    }
</style>

<section id="contact-us-section" class="parallax">
    <div class="container container-fluid">

        <div id = "contact-us-wrap">
            <div class = "row">
                <div id = "contact-us-info" class = "col-lg-4">
                    <div>
                        <h2> CYBERITS </h2>
                    </div>
                    <br>
                    <hr>
                    <div>
                        <b>Jakarta - 11530</b>
                    </div>
                    <div class = "contact-us-info-detail">
                        Jl. Kebon Jeruk Raya No. 27
                    </div>
                    <div class = "contact-us-info-detail">
                        <div class="glyphicon glyphicon-earphone"></div> +62 21-5350651 ext 2427
                    </div>
                    <div class = "contact-us-info-detail">
                        <div class="glyphicon glyphicon-comment"></div> cs@cyberits.co.id
                    </div>
                </div>
                <div id = "contact-us-form" class = "col-lg-8">
                    <form id = "contact-us-form-isi" class="form" novalidate>
                        <div id ="contact-us-form-email-group" class="form-group">
                            <label for="contact-us-form-email">Email</label>
                            <!--ERROR MSG -->
                            <label class="label label-danger label-error-msg" id="label-err-email">
                                <span class="glyphicon glyphicon-exclamation-sign"></span>
                                <span id="contact-us-email-err-msg">asd</span>
                            </label>
                            <input type="text" class="form-control" id="contact-us-form-email" placeholder="Your Email">
                        </div>

                        <div id ="contact-us-form-subject-group" class="form-group">
                            <label for="contact-us-form-subject">Subject</label>
                            <!--ERROR MSG -->
                            <label class="label label-danger label-error-msg" id="label-err-subject">
                                <span class="glyphicon glyphicon-exclamation-sign"></span>
                                <span id="contact-us-subject-err-msg">asd</span>
                            </label>
                            <input type="text" class="form-control" id="contact-us-form-subject" placeholder="Subject Message">
                        </div>

                        <div id ="contact-us-form-message-group" class="form-group">
                            <label for="contact-us-form-message">Message</label>
                            <!--ERROR MSG -->
                            <label class="label label-danger label-error-msg" id="label-err-msg">
                                <span class="glyphicon glyphicon-exclamation-sign"></span>
                                <span id="contact-us-msg-err-msg">asd</span>
                            </label>
                            <textarea class="form-control" id="contact-us-form-message" rows="4" placeholder="Your Message"></textarea>
                        </div>
                        <button id="button-submit" class="btn btn btn-lg hvr-outline-in text-center" type="submit">
                            <h3>Send Message</h3>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- START SCRIPT CONTACT US -->
<script>
    $(function(){

        function validateEmail_contact(email) {
            var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        }

        function validateFormContactUs(){
            var err=0;
            var contactEmail    = $("#contact-us-form-email").val().trim();
            var contactSubject  = $("#contact-us-form-subject").val().trim();
            var contactMessage  = $("#contact-us-form-message").val().trim();

            if(!validateEmail_contact(contactEmail)){
                err++;
                $("#label-err-email").show();
                $("#contact-us-email-err-msg").html("Please Input Your Email Address Correctly ");
            }else{
                $("#label-err-email").hide();
            }

            if(contactSubject == "" || contactSubject == null){
                err++;
                $("#label-err-subject").show();
                $("#contact-us-subject-err-msg").html("Please Input Your Subject");
            }else{
                $("#label-err-subject").hide();
                //alert(contactSubject);
            }

            if(contactMessage == "" || contactMessage == null){
                err++;
                $("#label-err-msg").show();
                $("#contact-us-msg-err-msg").html("Please Input Your Message");
            }else{
                $("#label-err-msg").hide();
                //alert(contactMessage);
            }

            if(err==0){
                return true;
            }else{
                return false;
            }
        }
        // Get the form.
        var form = $('#contact-us-form-isi');
        // Set up an event listener for the appointment form.
        $(form).submit(function(e) {
            e.preventDefault();
            if(validateFormContactUs()){
                var contactEmail    = $("#contact-us-form-email").val().trim();
                var contactSubject  = $("#contact-us-form-subject").val().trim();
                var contactMessage  = $("#contact-us-form-message").val().trim();

                $.ajax({
                    type : "POST",
                    url : "<?php echo site_url('Parallax/Send_email_contactus'); ?>",
                    dataType : "json",
                    data : {
                        contactSubject : contactSubject,
                        contactEmail : contactEmail,
                        contactMessage : contactMessage
                    },
                    beforeSend: function() {
                        $("#contact-us-form-isi button").attr('disabled','disabled');
                        $("#loading-screen-wrapper").show();
                    },
                    success : function(result, status, xhr){
                        resetForm();
                        $("#loading-screen-wrapper").hide();
                        swal(
                            'Success!',
                            'You Message has been sent successfully!',
                            'success'
                        )
                    },
                    error : function(result, status, xhr){
                        console.log('error mau keserver');
                        $("#contact-us-form-isi button").removeAttr('disabled');
                        $("#loading-screen-wrapper").hide();
                        swal(
                            'Fail!',
                            'Thankyou for your message, but we are sorry your message wont reach us any time soon. We will fix it as soon as posible.',
                            'error'
                        )
                    }
                });// End Ajax
            }
            return false;
        });

        function resetForm(){
            $(form).find("input[type=text], textarea").val("");
            $(".label-error-msg").hide();
            $("#contact-us-form-isi button").attr('disabled','disabled');
        }
    });
</script>