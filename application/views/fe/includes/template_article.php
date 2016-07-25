<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title><?php echo $title_tag;?></title>
    <link href="<?=base_url()?>img/favicon.ico" rel="shortcut icon">
    <link href="<?=base_url()?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>css/article.css" rel="stylesheet">
    <link href="<?=base_url()?>css/cyberits.css" rel="stylesheet">
    <link href="<?=base_url()?>css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'/>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>

    <script src="<?=base_url()?>js/jquery.min.js"></script>
    <script src="<?=base_url()?>js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>js/modernizr.custom.js"></script>

    <!-- Social Media -->
    <script src='http://connect.facebook.net/en_US/all.js'></script>
    <script type="text/javascript" async src="https://platform.twitter.com/widgets.js"></script>
</head>

<body data-spy="scroll" data-offset="0" data-target="#navbar-main">

<div id="fb-root"></div>
<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '167566846934106',
            xfbml      : true,
            version    : 'v2.5'
        });
    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

<!-- Fixed navbar -->
<div class="header-container">
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="row">
                <div class="left-navbar col-sm-4">
                    <div class="logo-container">
                        <a href="<?=site_url()?>"><img src="<?=base_url()?>img/logo.png"/></a>
                    </div>
                </div>
                <div class="right-navbar col-sm-8">
                    <form action="<?=site_url('fe/Article/articleListSearch')?>" method="get">
                        <div class="input-group search-bar">
                            <input type="text" class="form-control" name="search" placeholder="Search for...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                            </button>
                        </span>
                        </div><!-- /input-group -->
                    </form>
                </div><!-- /right-navbar -->
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="content-container col-sm-7" id="content">
            <?php 
                $this->load->view($main_content);
            ?>
        </div><!--Content Containter-->
        <div class="content-container col-sm-5" id="advertisement">
            <div class="row ads-container">
                <div class="ads-item">
                    <a href="https://www.niagahoster.co.id/ref/10470" target="_blank">
                        <img src="https://www.niagahoster.co.id/banners/Set1-niagahoster-300x250.jpg"
                             alt="Hosting Unlimited Indonesia" border="0"
                             width="270" height="220" />
                    </a>
                </div>
                <div class="ads-item">
                    <a href="https://www.niagahoster.co.id/ref/10470" target="_blank">
                        <img src="https://www.niagahoster.co.id/banners/Set1-niagahoster-300x250.jpg"
                             alt="Hosting Unlimited Indonesia" border="0"
                             width="270" height="220" />
                    </a>
                </div>
            </div>
            <div class="row more-article-container">
                <h3 class="head-title">Article Menarik Lainnya</h3>
                <?php 

                foreach($moreArticles as $row) {
                    $title_url_clean = preg_replace('/[^A-Za-z0-9\-]/', '', $row['title_url_clean']);
                ?>
                    <div class="more-article-item">
                        <a href="<?=site_url('fe/article/getArticleDetail/'.$row['articleID'].'/'.$title_url_clean)?>" class="article-link">
                            <div class="article-img-container">
                                <img class="img-responsive" src="<?=base_url();?>img/article/<?=$row['articleID']?>/<?=$row['articleImgLink']?>"/>
                            </div>
                            <h4 class="article-title"><?=$row['title']?></h4>
                        </a>
                    </div>
                <?php } ?>
            </div>
            <div class="row follow-container">
                <h3 class="head-title">FOLLOW US!</h3>
                <div class="fb-like-container">
                    <h3>Facebook</h3>
                    <div class="fb-like" data-href="https://www.facebook.com/Cyberits"
                         data-layout="standard" data-action="like"
                         data-show-faces="false" data-share="false">
                    </div>
                </div>
                <div>
                    <h3>Twitter</h3>
                    <a href="https://twitter.com/cyberITS" class="twitter-follow-button" data-show-count="false">Follow @cyberITS</a>
                    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                </div>
            </div>
        </div><!--Content Containter-->
    </div>
</div>

<div style = "visibility:show;" id="back_to_top" class = "centered">
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
</body>
</html>