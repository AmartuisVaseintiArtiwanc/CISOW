<!DOCTYPE html>
<!--[if lt IE 7]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class='no-js' lang='en'>
	<!--<![endif]-->
	<head>
		<meta charset='utf-8' />
		<meta content='IE=edge,chrome=1' http-equiv='X-UA-Compatible' />
		<title>Cyber IT Solutions | View Appointment</title>
		<link rel="shortcut icon" href="favicon.ico" />
		<link rel="apple-touch-icon" href="<?=base_url()?>images/favicon.png" />
		
		<link rel="stylesheet" href="<?=base_url()?>css/maximage.css" type="text/css" media="screen" charset="utf-8" />
		<link rel="stylesheet" href="<?=base_url()?>css/styles.css" type="text/css" media="screen" charset="utf-8" />
		
		<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
		
		<!--[if IE 6]>
			<style type="text/css" media="screen">
				.gradient {display:none;}
			</style>
		<![endif]-->
	</head>
	<body>

		<!-- Switch to full screen -->
		<button class="full-screen" onclick="$(document).toggleFullScreen()"></button>

		<!-- Logo -->
		<div id="logo"></div>

		<!-- Home Page -->
<?php if($data['appointmentID'] != null && $data['appointmentID'] != "") {?>
		<section class="content show" id="home">
		<h2>Terima Kasih telah menghubungi kami, berikut data appointment Anda : </h2>
			<?php
					echo "<p>Appointment ID &nbsp&nbsp&nbsp: ".$data['appointmentID']."</p>"; 		
					echo "<p>Nama &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp : ".$data['nama']."</p>";
					echo "<p>Email &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: ".$data['email']."</p>";
					echo "<p>Telepon &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: ". $data['telp']."</p>";
					echo "<p>Perushaan &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: ".$data['namaPerusahaan']."</p>";
					echo "<p>Category&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: ".$data['category']."</p>";
					echo "<p>Tanggal/Waktu&nbsp&nbsp&nbsp&nbsp&nbsp: ".date_format(date_create($data['appointmentDatetime']), 'M d, Y')."</p>";
					echo "<p>Lokasi&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: ".$data['appointmentLocation']."</p>";
					echo "<p>Deskripsi&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: ".$data['deskripsi']."</p>";
			?>
			<form method="POST" action="<?=site_url('be/appointment/deleteAppointment')?>">
				<input type="hidden" name="appointmentID" id="appointmentID" value="<?=$data['appointmentID']?>">
				<input type="submit" value="Cancel Appointment">
			</form>
			
		</section>
        <?php }else{ ?>
        <section class="content show" id="home">
            <h2>Maaf appointment anda tidak ditemukan</h2>
        </section>
        <?php }?>

		
		<!-- Background Slides -->
		<div id="maximage">
			<div>
				<img src="<?=base_url()?>img/backgrounds/bg-img-1.jpg" alt="" />
				<img class="gradient" src="<?=base_url()?>img/backgrounds/gradient.png" alt="" />
			</div>
			
		</div>
		
		<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.js'></script>
		<script src="<?=base_url()?>js/jquery.easing.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="<?=base_url()?>js/jquery.cycle.all.js" type="text/javascript" charset="utf-8"></script>
		<script src="<?=base_url()?>js/jquery.maximage.js" type="text/javascript" charset="utf-8"></script>
		<script src="<?=base_url()?>js/jquery.fullscreen.js" type="text/javascript" charset="utf-8"></script>
		<script src="<?=base_url()?>js/jquery.ba-hashchange.js" type="text/javascript" charset="utf-8"></script>
		<script src="<?=base_url()?>js/main.js" type="text/javascript" charset="utf-8"></script>
		
		<script type="text/javascript" charset="utf-8">
			$(function(){
				$('#maximage').maximage({
					cycleOptions: {
						fx: 'fade',
						speed: 1000, // Has to match the speed for CSS transitions in jQuery.maximage.css (lines 30 - 33)
						timeout: 5000,
						prev: '#arrow_left',
						next: '#arrow_right',
						pause: 0,
						before: function(last,current){
							if(!$.browser.msie){
								// Start HTML5 video when you arrive
								if($(current).find('video').length > 0) $(current).find('video')[0].play();
							}
						},
						after: function(last,current){
							if(!$.browser.msie){
								// Pauses HTML5 video when you leave it
								if($(last).find('video').length > 0) $(last).find('video')[0].pause();
							}
						}
					},
					onFirstImageLoaded: function(){
						jQuery('#cycle-loader').hide();
						jQuery('#maximage').fadeIn('fast');
					}
				});
	
				// Helper function to Fill and Center the HTML5 Video
				jQuery('video,object').maximage('maxcover');
	
			});
		</script>
  </body>
</html>