<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="CYBERITS merupakan sebuah perusahaan Startup yang berdiri sejak tahun 2012 bergerak dalam jasa konsultasi IT, Digital Marketing Solution lewat pengembangan platform aplikasi baik berbasis Website maupun Mobile & Service baik dalam...  bentuk pengadaan perangkat komputer maupun jaringan. Mitra bisnis CYBERITS adalah para UKM/Pemilik Usaha yang ingin mengembangkan usahanya secara online maupun melengkapi usaha mereka dengan sistem komputerisasi terintegrasi. Info lengkap mengenai apa yang kami kerjakan dapat dilihat di https://www.cyberits.co.id/">
<meta name="author" content="cyberits">
<meta property="og:image" content="<?=base_url()?>img/1-01.png" />
<meta property="og:description" content="CYBERITS merupakan sebuah perusahaan Startup yang berdiri sejak tahun 2012 bergerak dalam jasa konsultasi IT, Digital Marketing Solution lewat pengembangan platform aplikasi baik berbasis Website maupun Mobile & Service baik dalam...  bentuk pengadaan perangkat komputer maupun jaringan. Mitra bisnis CYBERITS adalah para UKM/Pemilik Usaha yang ingin mengembangkan usahanya secara online maupun melengkapi usaha mereka dengan sistem komputerisasi terintegrasi. Info lengkap mengenai apa yang kami kerjakan dapat dilihat di https://www.cyberits.co.id/" />
<meta property="og:url"content="https://cyberits.co.id/" />
<meta property="og:title" content="CYBERITS - One Stop IT Solutions" />
<title>Cyber IT Solutions</title>
<link href="<?=base_url()?>img/favicon.ico" rel="shortcut icon">
<!-- Bootstrap core CSS -->
<!--<link href="<?=base_url()?>css/bootstrap.css" rel="stylesheet">-->
<!-- Custom CSS -->
<link href="<?=base_url()?>css/animate.css" rel="stylesheet" >
<link href="<?=base_url()?>css/hover-min.css" rel="stylesheet" >
<link href="<?=base_url()?>css/bootstrap.min.css" rel="stylesheet" >
<link href="<?=base_url()?>css/main_parallax.min.css" rel="stylesheet">
<link href="<?=base_url()?>css/cyberits.min.css" rel="stylesheet">
<link href="<?=base_url()?>css/font-awesome.min.css" rel="stylesheet">
<link href="<?=base_url()?>css/bootstrap-datepicker.css" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'/>

<!-- Include Sidr bundled CSS theme -->
<link href="<?=base_url()?>css/side_nav_dark.css" rel="stylesheet">
<!-- Slide Portofolio CSS -->
<!-- Link Swiper's CSS -->
<script src="<?=base_url()?>js/jquery.min.js"></script>
<!-- script loading screen -->
<script>
    $(window).load(function() {
        //$("#logo-buat-loading").fadeIn(1000).slideDown(2000);

        $("#logo-buat-loading").fadeOut(1000, function(){
            $("#load_screen #loading").fadeOut(1000, function(){
                $("#load_screen").slideUp(1200);
            });
        });
//        $("#logo-buat-loading").fadeIn('slow');
//        $("#load_screen #loading").fadeIn('slow');
//        $("#load_screen").slideUp('slow');
    });
</script>

</head>

<body data-spy="scroll" data-offset="0" data-target="#navbar-main">
<!-- loading screen -->
<div id="load_screen">
    <div id="logo-buat-loading">
        <img src="<?=base_url() ?>img/logo.png" id="logo_loading_screen" />
    </div>
    <div id="loading">
        <div id="circularG">
            <div id="circularG_1" class="circularG"></div>
            <div id="circularG_2" class="circularG"></div>
            <div id="circularG_3" class="circularG"></div>
            <div id="circularG_4" class="circularG"></div>
            <div id="circularG_5" class="circularG"></div>
            <div id="circularG_6" class="circularG"></div>
            <div id="circularG_7" class="circularG"></div>
            <div id="circularG_8" class="circularG"></div>
        </div>
    </div>
</div>
<!-- Fixed navbar -->
<div class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
     <div class="left-navbar">
		    <a href="<?=base_url()?>">
                <img src="<?=base_url()?>img/logo.png"/></a>
     </div>

     <div class="right-navbar">
        <a href="#">
          <img id="side-menu" src="<?=base_url()?>img/icon-mobile-nav.png"/>
        </a>
     </div>

  </div>
</div>

<div id="sidebar">
    <div id="sidebar-wrapper" class="sidebar-wrapper">
        <h2 class = "text-left">Menu</h2>
        <h2><span class="glyphicon glyphicon-remove" id="sidebar-closed" aria-hidden="true"></span></h2>
        <div class="clear"></div>
      <ul>
        <li><a href="#headerwrap">Home</a></li>
        <li><a href="#about">Article</a></li>
        <li><a href="#services">Services</a></li>
        <li><a href="#how-we-work">How We Work</a></li>
        <li><a href="#team-member">Our Team</a></li>
        <li><a href="#contact">Contact Us</a></li>
      </ul>
    </div>
</div>

<!--headerwrap -->
<section id="headerwrap" name="home" class="parallax">
  <header class="clearfix">
    <h1>We Provides Solution Not Just Application</h1>
    <h1>Siapa kami ?</h1><br />
    <h2><b>Kami adalah partner Anda!</b></h2><br />
    <p class="strong">Kami menyediakan solusi IT terbaik bagi Anda untuk membantu Anda </br> dalam mengembangkan bisnis dan usaha Anda!</p>
    <div class="clearfix">
      <a data-toggle="modal" data-target="#appointment_form" class="smoothScroll btn btn-lg">Buat Janji</a>
    </div>
  </header>
</section>
<!--headerwrap -->

<!--article-->
<div id="about" name="about">
  <div class="container">
    <?php $this->load->view('fe/home/article_home_parallax_view'); ?>
  </div>
</div>
<!--article-->

<!--gambar-->
<section id="teamwrap" name="team" class="parallax">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <header class="clearfix">
            <h2 class=" slideInDown">Kami ada untuk Anda! </h2>
            <p class=" slideInRight"> Kami memberikan konsultasi terbaik bagi pemenuhan kebutuhan IT anda
                mendalami apa yang anda miliki saat ini,
                dan merekomendasikan ide serta teknologi terbaru yang sesuai dengan kebutuhan anda!</p>
        </header>
    </div>
</section>
<!--gambar-->

<!--services-->
<div id="services" name="services">
    <?php $this->load->view('fe/home/our_service_view'); ?>
</div>
<!-- container -->

<!--gambar-->
<section id="ukmwrap" name="team" class="parallax">
    <header class="clearfix">
    <h2 class=" slideInDown">Memberdayakan UKM dan Bisnis Anda!</h2>
    <p class=" slideInLeft">Kami berkomitmen membangun setiap UKM dan Bisnis agar memiliki sistem infrastruktur IT yang baik untuk menjalankan bisnis mereka.</p></header>
</section>
<!--gambar-->

<!--how we work-->
<div id="how-we-work" name="how-we-work">
    <?php $this->load->view('fe/home/how_we_work_view'); ?>
</div>
<!-- /how we work -->

<!--gambar-->
<section id="qualitywrap" name="team" class="parallax" >
    <header class="clearfix">
    <h2 class="slideInDown">Kami mengedepankan Kualitas & Profesionalisme</h2>
    <p class="slideInRight">Kami terus mengembangkan diri dalam memberikan solusi IT terbaik dan profesional bagi Anda!</p></header>
</section>
<!--gambar-->

<!-- ==== TEAM MEMBERS ==== -->
<div id="team-member" name="team" >
    <?php $this->load->view('fe/home/our_team_view'); ?>
</div>
<!-- container -->

<!-- ==== CONTACT ==== -->
<div id="contact" name="contact">
    <?php $this->load->view('fe/home/contact_us_view'); ?>
</div>
<!-- container -->

<!-- Appointment Form -->
<div id="appointment_form" class="modal fade" tabindex="1" aria-labelledby="modal_appointment_form" aria-hidden="true">
    <?php $this->load->view('fe/home/appointment_form_view'); ?>
</div>


<!-- Pop up verifikasi -->
<style>
  .modal.fade .modal-dialog {
    transform: translate(0px, -25%);
    transition: transform 0.3s ease-out 0s;
  }
  .modal.fade.in .modal-dialog {
    transform: translate(0px, 0px);
  }
  .flyover {
    left: 150%;
    overflow: hidden;
    position: fixed;
    width: 50%;
    /*opacity: 0.9;*/
    z-index: 1050;
    transition: left 0.6s ease-out 0s;
  }

  .flyover-centered {
    top: 50%;
    transform: translate(-50%, -50%);
  }
  .flyover.in {
    left: 50%;
  }
  .flyover-bottom {
    bottom: 10px;
  }
</style>
<div id="notification" class="jumbotron flyover flyover-centered">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  <h1> Thankyou for your appoinment </h1>
  <p> But we are sorry your message wont reach us any time soon. We will fix it as soon as posible </p>
</div>

<div style = "visibility:visible;" id="back_to_top">
    <a href="#headerwrap"> <img class="img img-circle" src="<?=base_url()?>img/back-to-top.png" height="50px" width="50px" alt="back-to-top"> </a>
</div>

<div id="footerwrap">
  <div class="container">
    <div class="row">
      <div class="col-md-12"> <span class="copyright">Copyright &copy; 2015 CyberITS</div>
      <div class="col-md-12">
        <ul class="list-inline social-buttons">
          <li><a href="https://twitter.com/CyberIts" target="_blank"><i class="fa fa-twitter"></i></a> </li>
          <li><a href="https://www.facebook.com/Cyberits" target="_blank"><i class="fa fa-facebook"></i></a> </li>
        </ul>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script type="text/javascript" src="<?=base_url()?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/appointment_form_validation.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/contact_me_form_validation.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/bootstrap-datepicker.js"></script>
<!-- Slide Portofolio Javascript -->
<!-- Swiper JS-->
<script src="<?=base_url()?>js/wow.min.js"></script>

<!-- Datepicker -->
<script>
  $('#meeting_date-group input').datepicker({
    format: "dd/MM/yyyy",
    startDate: "+1d",
    daysOfWeekDisabled: "0",
    daysOfWeekHighlighted: "0",
    todayHighlight: true,
    autoclose: true
  });
</script>

<script>
  $('#submit_application').click(function(){
    $("#services_application").prop("checked", true)
  });

  $('#submit_multimedia').click(function(){
    $("#services_multimedia").prop("checked", true)
  });

  $('#submit_support').click(function(){
    $("#services_support").prop("checked", true)
  });
</script>

<!-- Script Back to top-->
<script>
  $(document).ready(function() {
    var offset = 250;
    var duration = 300;
    $(window).scroll(function() {
      if ($(this).scrollTop() > offset) {
        $("#back_to_top").fadeIn(duration);
      }
      else {
        $("#back_to_top").fadeOut(duration);
      }
    });
    $("#back_to_top").click(function(event) {
      event.preventDefault();
      $("html, body").animate({scrollTop: 0}, 700);
      return false;
    })
  });
</script>
<script>
    //Wow JS
    new WOW().init();
    $(function() {

        //Side Bar OPEN
        $('.right-navbar a').click(function(){
            //$('#sidebar-wrapper').css('visibility','visible');
            $('#sidebar-wrapper').animate({width: 300}, {duration: 400});
            return false;
        });

        //Side Bar Closed
        $('#sidebar-closed, body').click(function(){
            $('#sidebar-wrapper').animate({width: 0}, {duration: 400});
        });

        //Smoth Scroll
        $('#sidebar-wrapper ul li a').click(function () {
            var url = $(this).attr('href');
            $('html,body').animate({
                scrollTop: $(url).offset().top
            }, 1500, 'linear');
            $('#sidebar-wrapper').animate({width: 0}, {duration: 400});
            return false;
        });
    });
</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-73056388-1', 'auto');
  ga('send', 'pageview');

</script>

</body>
</html>