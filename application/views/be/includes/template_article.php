<!doctype html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Header style -->
    <?php $this->load->helper('HTML');
    echo link_tag('css/bootstrap.css');
    echo link_tag('css/article.css');
    echo link_tag('css/jquery.rating.css');
    ?>
    <script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>js/jquery.rating.pack.js" type="text/javascript"></script>

    <title>Article</title>
</head>
<body>
<div class="header-container">
    <div class="container">
        <div class="logo">
            <img alt="Brand" src="<?php echo base_url(); ?>img/ironman.jpg" height="70" width="80">
        </div>

        <div class="logo-text">
            <h1>Put Some Text</h1>
        </div>

        <div class="clear"></div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="content-container col-md-9" id="content">
            <?php $this->load->view($main_content); ?>
        </div><!--Content Containter-->

        <div class="advertise col-md-3 col-xs-12">
        </div><!--adds-->
    </div>
</div>

</body>
</html>