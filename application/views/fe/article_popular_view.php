

<style>

    .article-popular-container .article-img-container{

        width: 270px;

    }

</style>



<div class="row article-body">

    <div class="article-head-title">

        <h2><?=$category?></h2>

    </div>

    <div class="article-nav">

        <div class="row">

            <div class=" col-sm-8">

                <ul id="article-nav-left">

                    <li><a href="<?=site_url('fe/article/lastArticleList')?>">Artikel Terbaru</a></li>

                    <li class="active">Artikel Populer</li>

                </ul>

            </div>

            <div class=" col-sm-4">

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



    <ol class="article-popular-container">

    <?php

    foreach($articles as $row){

        ?>

        <li>

            <a href="<?=site_url('fe/article/getArticleDetail/'.$row['title'])?>">

            <h3 class="article-title"> <a href="<?=site_url('fe/article/getArticleDetail/'.$row['title'])?>"> <?=$row['title']?> </a> </h3>

            <div class="article-img-container">

                <img class="img-responsive" src="<?=base_url();?>img/article/<?=$row['articleID']?>/<?=$row['articleImgLink']?>"/>

            </div>

            </a>

        </li>

    <?php

    }

    ?>

    </ol>

</div>