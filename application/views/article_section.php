<section id="article-section" class="parallax">
    <div class="container container-fluid">
        <h1>ARTICLE</h1>
        <p  data-wow-delay="1s" class=" wow flipInX">Stay updated with our news and articles</p>

        <div id="article-shortcut-container">
            <div class="btn-group btn-group-justified" role="group" id="article-shortcut-wrapper">
                <a href="<?=site_url('fe/article/lastArticleList')?>" target="_blank" class="btn btn-default active" role="button">ALL</a>
                <a href="<?=site_url('fe/article/popular')?>" target="_blank" class="btn btn-default" role="button">POPULAR</a>
            </div>
        </div>

        <div id="article-category-container" class="row">
            <div class="article-category-item col-md-4 wow bounceInUp " data-wow-delay="0.5s">
                <a href = "<?=site_url('fe/article/articleCategory/Lifestyle')?>" target="_blank">
                    <div class="item-box hvr-glow">
                        <h1 class="article-title" align="center">LIFESTYLE</h1>
                        <img class="img-responsive article-img" src="<?php echo base_url();?>assets/image/category/lifestyle.png">
                        <p class="article-desc">All about lifestyle</p>
                    </div>
                </a>
            </div>
            <div class="article-category-item col-md-4 wow bounceInUp " data-wow-delay="0.8s">
                <a href = "<?=site_url('fe/article/articleCategory/Tutorial')?>" target="_blank">
                    <div class="item-box hvr-glow">
                        <h1 class="article-title" align="center">TUTORIAL</h1>
                        <img class="img-responsive article-img" src="<?php echo base_url();?>assets/image/category/tutorial.png">
                        <p class="article-desc">Get all the latest information about technology all around the world</p>
                    </div>
                </a>
            </div>
            <div class="article-category-item col-md-4 wow bounceInUp " data-wow-delay="1.2s">
                <a href = "<?=site_url('fe/article/articleCategory/Technology')?>" target="_blank">
                    <div class="item-box hvr-glow">
                        <h1 class="article-title" align="center">TECHNOLOGY</h1>
                        <img class="img-responsive article-img" src="<?php echo base_url();?>assets/image/category/technology.png">
                        <p class="article-desc">Learn with us to improve your technology knowledge</p>
                    </div>
                </a>
            </div>
        </div>

        <div class="clear"></div>
    </div>
</section>