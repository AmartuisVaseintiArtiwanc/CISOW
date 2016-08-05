<!DOCTYPE html>
<html>
<head>
    <title>CYBERITS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='shortcut icon' href='<?php echo base_url();?>assets/image/favicon-32x32.ico' type='image/x-icon'>
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,500,400' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css">
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
<!-- Appointment Form -->
<div id="appointment_form" class="modal fade" tabindex="1" aria-labelledby="modal_appointment_form" aria-hidden="true">
    <?php $this->load->view('fe/home/appointment_form_view'); ?>
</div>



<script src="<?php echo base_url();?>assets/jquery/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
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

</body>
</html>

