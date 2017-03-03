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
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugin/animate.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugin/sweetalert2/sweetalert2.min.css">
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
    <script src="<?php echo base_url();?>assets/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugin/wow_js/wow.min.js"></script>
    <script src="<?php echo base_url();?>assets/plugin/sweetalert2/sweetalert2.min.js"></script>
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="50">

<!--PRELOADING -->
<div id="preloader-wrapper">
    <div id="preloader" class="animated infinite flip">
        <img src="<?php echo base_url();?>assets/image/logo/Logo_300_V_ppi.png" class="img-responsive"/>
    </div>

    <div class="preloader-section section-left"></div>
    <div class="preloader-section section-right"></div>

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

<section id="wrap1-section" class="transition-text">
    <div class="container container-fluid  wow bounceInDown" >
        <h1 class=" slideInDown text-center">Kami ada untuk Anda! </h1>
        <p class=" slideInRight text-center"> Kami memberikan konsultasi terbaik bagi pemenuhan kebutuhan IT anda
            mendalami apa yang anda miliki saat ini,
            dan merekomendasikan ide serta teknologi terbaru yang sesuai dengan kebutuhan anda!
        </p>
    </div>
</section>

<?php $this->load->view('service_section');?>
<section id="wrap2-section" class="transition-text">
    <div class="container container-fluid  wow bounceInDown">
        <h2 class="slideInDown text-center">Memberdayakan UKM dan Bisnis Anda!</h2>
        <p class="slideInLeft text-center">
            Kami berkomitmen membangun setiap UKM dan Bisnis agar memiliki sistem infrastruktur IT yang baik untuk menjalankan bisnis mereka.
        </p>
    </div>
</section>

<?php $this->load->view('how_we_work_section');?>
<section id="wrap3-section" class="transition-text">
    <div class="container container-fluid  wow bounceInDown">
        <h2 class="slideInDown text-center">Kami mengedepankan Kualitas & Profesionalisme</h2>
        <p class="slideInRight text-center">
            Kami terus mengembangkan diri dalam memberikan solusi IT terbaik dan profesional bagi Anda!
        </p>
    </div>
</section>

<?php $this->load->view('team_section');?>
<?php $this->load->view('contact_us_section');?>
<?php $this->load->view('footer_section');?>
<!--LOADING SCREEN-->
<?php $this->load->view('loading_screen');?>

<!-- Appointment Form -->
<div id="appointment_form" class="modal fade" tabindex="1" aria-labelledby="modal_appointment_form" aria-hidden="true">
    <?php $this->load->view('appointment_form_view'); ?>
</div>
<input type="hidden" name="site-url" id="site-url" value="<?php echo site_url();?>" />

<script src="<?php echo base_url();?>assets/plugin/datepicker/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url();?>assets/custom/appointment_form_validation.js"></script>
<script src="<?php echo base_url();?>assets/custom/parallax.js"></script>
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
                $("#preloader").removeClass("animated infinite flip");
                setTimeout(function() {
                    $("#preloader").addClass("animated zoomOutUp");
                    $('html, body').removeAttr('style');
                    $('body').addClass('loaded');
                    //SET ACTIVE NAV
                    $(".navbar-nav li").removeClass("active");
                    $(".navbar-nav li:nth-child(1)").addClass("active");
                    animationHome();
                },900);
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
            $(".sosmed-ul li").addClass("animated zoomInDown");
        }, function(){
            $(this).children(".team-link-container").css("visibility", "hidden");
            $(".sosmed-ul li").removeClass("animated zoomInDown");
        });

        //Smoth Scroll
        $('#home-navbar ul li a').click(function () {
            var url = $(this).attr('href');
            var offset_top = $(url).offset().top;
            if(url == "#home-section"){
                offset_top = 0;
            }

            $('html,body').animate({
                scrollTop : offset_top
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

</body>
</html>

