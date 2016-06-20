<style>

.wrap-mini-coba{

  margin: auto;

  width: 120px;



}

.wrap-mini-coba h4{

  float: left;

  margin-left: 10px;



}

.container-wrap-mid{

  margin:auto;

  width: 100%;

}







</style>

<div class="content-bg-image">

<div class="container-wrap-mid">

  <h1 style="text-align:center"><span>Article</span></h1><br/>

  <div class="wrap-mini-coba">

      <h4 style="text-align:center;"><a href="<?=site_url('fe/article/lastArticleList')?>"><b>All</b></a></h4>

      <h4 style="text-align:center;"><a href="<?=site_url('fe/article/popular')?>"><b>Popular</b></a></h4>

  </div>

  <div class="clearfix"></div>



  <?php foreach ($category_data as $row){ ?>

      <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 centered hvr-shrink">

        <a data-toggle="modal" href = "<?=site_url('fe/article/articleCategory/'.$row['category'])?>">

          <img class="img img-circle wow flipInX" src="<?=base_url()?>img/category/<?=$row['categoryImgLink']?>"

               height="200px" width="200px" alt="">

          <h4><strong><?=$row['category']?></strong></h4>

        </a>

        <p><?=$row['categoryDescription']?></p>



      </div>

  <?php } ?>



  </div>

</div>

