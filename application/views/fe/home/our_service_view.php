<div class="row">
    <h2 class="centered">OUR SERVICES</h2>
    <hr>
    <div class="col-lg-8 col-lg-offset-2">
        <p class="large">Apa yang kami berikan ?</p>
    </div>

    <!-- corasel -->
    <div class="container">
        <br>
        <div id="our-service-carousel" class="carousel slide" data-ride="carousel">

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="<?=base_url()?>img/services/apps.png" alt="...">
                    <div class="item-p col-xs-8 col-sm-8 col-md-6 col-lg-6 col-xs-offset-2 col-sm-offset-2 col-md-offset-3 col-lg-offset-3">
                        <h4>Integrated Systems Solutions</h4>
                        <p>Kami melengkapi Bisnis/Usaha Anda dengan serangkaian solusi sistem terintegrasi yang handal untuk pengembangan
                            bisnis Anda kedepan melalui teknologi terbaru dalam pengembangan Sistem Informasi, Aplikasi, Corporate Website
                            & System, Security System, e-commerce, dan SEO service kami berkomitmen untuk memberikan Anda pelayanan yang terbaik!</p>
                    </div>
                    <div class = "item-a col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <a data-toggle="modal"  href="#appointment_form" id="submit_application" class="button_mod" value="Send Message">Buat Janji</a>
                    </div>
                </div>

                <div class="item">
                    <img src="<?=base_url()?>img/services/multimedia.png" alt="...">
                    <div class="item-p col-xs-8 col-sm-8 col-md-6 col-lg-6 col-xs-offset-2 col-sm-offset-2 col-md-offset-3 col-lg-offset-3">
                        <h4>Multimedia & Creative Advertising Solution</h4>
                        <p>Bagi Anda yang ingin memperluas jaringan bisnis Anda melalui ide - ide yang kreatif, kami menyediakan solusi
                            periklanan kreatif dan multimedia melalui Audio/Video Creative, Branding,  dan Advertising untuk mewujudkan keinginan Anda!</p>
                    </div>
                    <div class = "item-a col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <a data-toggle="modal"  href="#appointment_form" id="submit_multimedia" class="button_mod" value="Send Message">Buat Janji</a>
                    </div>
                </div>

                <div class="item">
                    <img src="<?=base_url()?>img/services/supps.png" alt="...">
                    <div class="item-p col-xs-8 col-sm-8 col-md-6 col-lg-6 col-xs-offset-2 col-sm-offset-2 col-md-offset-3 col-lg-offset-3">
                        <h4>Hardware, Software & IT Support Solutions</h4>
                        <p> Kami menyediakan solusi pengadaan kebutuhan perangkat keras, perangkat lunak, instalasi jaringan komputer,
                            dan IT Supports untuk menunjang bisnis/usaha Anda! Kami bekerjasama dengan vendor dan brand IT terkemuka Indonesia
                            agar produk yang anda terima adalah produk dengan kualitas terbaik dan berlisensi resmi.</p>
                    </div>
                    <div class = "item-a col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <a data-toggle="modal"  href="#appointment_form" id="submit_support" class="button_mod" value="Send Message">Buat Janji</a>
                    </div>
                </div>
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#our-service-carousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#our-service-carousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

</div>

<script>
    $(function(){
        $('.carousel').carousel({
            interval: 5000
        });
    });
</script>