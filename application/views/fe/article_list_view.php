

<style>

    .row-paging{

        text-align: right;

    }

    .article-img-container{

        position: relative;

        height:auto;

        width:100%;

        overflow:hidden;

    }

    .article-paging{

        margin-left: 13px;

    }



    

   

</style>



<div class="row article-body">

    <div class="article-head-title">

        <h2><?=$category?></h2>

    </div>

    <div class="article-nav">

        <div class="row">

            <div class="col-sm-8 col-xs-12">

                <ul id="article-nav-left">

                    <li class="active"><a href="<?=site_url('fe/article/lastArticleList')?>">Artikel Terbaru</a></li>

                    <li><a  href="<?=site_url('fe/article/popular')?>">Artikel Populer</a></li>

                </ul>

            </div>

            <div class="col-sm-4">

                <ul id="article-nav-right" class="navbar-right">

                    <li class="dropdown">

                        <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                            Kategori <span class="caret"></span></a>

                        <ul class="dropdown-menu">

                            <?php foreach($dataCategory as $row){?>

                                <li><a href="<?=site_url('fe/article/articleCategory/'.$row['category'])?>"><?=$row['category']?></a></li>

                            <?php } ?>

                        </ul>

                    </li>

                </ul>

            </div>

        </div>

    </div>

        <?php

        foreach($articles as $row){
            $id_or_title = str_replace("\"","(-)",$row['title_url_clean']);
            $title_url_clean = $id_or_title;
        ?>

        <div class="col-xs-12 article-col">

            <a href="<?php echo site_url('fe/article/getArticleDetail/'.$title_url_clean)?>" class="article-link">

                <div class="article-img-container">

                    <img class="img-responsive list-img-container" src="<?=base_url();?>img/article/<?=$row['articleID']?>/<?=$row['articleImgLink']?>"/>

                    <div class="link-category">

                        <a href="<?=site_url('fe/article/articleCategory/'.$row['category'])?>"><?=$row['category']?></a>

                    </div>

                </div>

                <h3 class="article-title"> <a href="<?=site_url('fe/article/getArticleDetail/'.$title_url_clean)?>" class="article-link"> <?=$row['title']?> </a> </h3>

                <h5 class="article-date">

                    <?php

                        $date = date_create($row['created']);

                        echo date_format($date, 'F d, Y \a\t g:ia' );

                    ?>

                </h5>

                <p><?=$row['description']?></p>

                <a href="<?=site_url('fe/article/getArticleDetail/'.$title_url_clean)?>"><span class="see-more">See More</span></a>

                <hr>

            </a>

        </div>



        <?php

        }

        ?>



    <div class="article-paging">

        <?=$pages?>

    </div>

</div>