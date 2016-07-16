<?php

    echo link_tag('css/article_home.css');

?>



<!-- last post -->

<div class="row top">

    <h2>

        <div class="col-sm-6">

            <div class="left">

                <a href="<?=site_url('fe/article/lastArticleList')?>">

                    Latest Post</a>

            </div>

        </div>



        <div class="col-sm-6">

            <div class="right">

                <a href="<?=site_url('fe/article/lastArticleList')?>">

                    See More</a>

            </div>

        </div>

        <div class="clear"></div>

    </h2>

</div>

<div class="row">

    

    <?php

    foreach($latest_post_data as $row){
        $id_or_title = str_replace("\"","(-)",$row['title_url_clean']);
        $title_url_clean = $id_or_title;
    ?>

    <div class="col-xs-12 col-sm-6 col-lg-3 lastest-post-container">

        <img class="img-responsive" src="<?= base_url() ?>img/article/<?= $row['articleID'] ?>/<?= $row['articleImgLink'] ?>" />

        <div class="title-post main-title-post"><?= $row['category'] ?></div>

        <a href="<?=site_url("fe/article/getArticleDetail/".$title_url_clean)?>"><h4><?= $row['title'] ?></h4></a>

        <?= $row['created']?> 

    </div>

    <?php

        }

    ?>

</div>

<!-- last post -->



<?php foreach($article_data as $data){ ?>

<?php 

if(count($data['listArticle']) == 0){

}else{

    

?>

    <div class="row top">

        <h2>

            <div class="col-sm-6">

                <div class="left">

                    <a href="<?=site_url('fe/article/articleListByCategory/'.$data['categoryName'].'/'.$data['categoryID'])?>">

                        <?=$data['categoryName']?></a>

                </div>

            </div>

            <div class="col-sm-6">

                <div class="right">

                    <a href="<?=site_url('fe/article/articleListByCategory/'.$data['categoryName'].'/'.$data['categoryID'])?>">

                        See More</a>

                </div>

            </div>

            <div class="clear"></div>

        </h2>

    </div>

    <div class="row">



        <?php $i=0; 

        foreach($data['listArticle'] as $article){ 
            $id_or_title = str_replace("\"","(-)",$row['title_url_clean']);
            $title_url_clean = $id_or_title;
        ?>

            <?php if($i==0) { ?>

                <a href="<?=site_url('fe/article/getArticleDetail/'.$title_url_clean)?>">

                    <div class="col-sm-6 col-custom container-img ">

                        <img src="<?=base_url()?>img/article/<?= $article['articleID'] ?>/<?=$article['articleImgLink']?>" class="highlight">

                        <div class="item-info-container">

                            <h5 class="item-title"><?=$article['title']?></h5>

                            <h5 class="item-date"><?=$article['created']?></h5>

                        </div>

                    </div>

                </a>

            <?php }else{ ?>

                 <a href="<?=site_url('fe/article/getArticleDetail/'.$title_url_clean)?>">

                     <div class="col-sm-6 col-custom col-side-item ">

                        <img src="<?=base_url()?>img/article/<?= $article['articleID'] ?>/<?=$article['articleImgLink']?>" class="img-responsive">

                        <div class="item-info-container">

                            <h5 class="item-title"><?=$article['title']?></h5>

                            <h5 class="item-date"><?=$article['created']?></h5>

                        </div>

                    </div>

                 </a>

            <?php } ?>

            

        <?php $i++; } ?>

        

    </div>

    <?php }?>

<?php } ?>