
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet'  type='text/css'>

  <?php $this->load->helper('HTML');
        echo link_tag('css/article_detail.css');      
  ?>
<script>
    window.fbAsyncInit = function() {
        FB.init({appId: '167566846934106', status: true, cookie: true,
            xfbml: true});
    };
    (function() {
        var e = document.createElement('script'); e.async = true;
        e.src = document.location.protocol +
        '//connect.facebook.net/en_US/all.js';
        document.getElementById('fb-root').appendChild(e);
    }());
</script>
<script>
    $(function() {
        $(".loading-wrap").hide();

        //jump to Comment
        $("#btn-leave-comment").click(function(){
            //$.scrollTo($(".comment-form"), { duration: 0});
            $(window).scrollTop($(".comment-form").offset().top);
        });

        //pagination
        $(document).on('click',"ul.pagination li a",function(e){
            var url = $(this).attr("href");
            $.ajax({
                type: "POST",
                data: "ajax=1",
                url: url,
                beforeSend: function() {
                    $(".loading-wrap").show();
                    $("#comment-container").html("");
                },
                success: function(msg) {
                    $("#comment-container").html(msg);
                    $(".loading-wrap").hide();
                }
            });
            e.preventDefault();
            return false;
        });
    });
</script>

<div id="fb-root"></div>
<?php if($data_article != null) { ?>
<div id="article-detail-wrapper">
    <div class="row content" id="content-1">
        <div class="content-info">
            <h1 class="content-title"><?=$data_article->title?></h1>
            <div class="row" id="article-info">
                <div class="col-md-12 col-lg-12">
                    <h4>In <a href="<?=site_url('fe/article/articleCategory/'.$data_article->category)?>"><?=$data_article->category?></a> on
                        <?php $date = date_create($data_article->created);
                        echo date_format($date, 'M d, Y' );?> by <a href="<?=site_url('fe/article/articleAuthor/'.$data_article->name)?>"><?=$data_article->name?></a></h4>
                </div>
            </div><!--Content Info-->
        </div>
        <div class="content">
            <div class="img-content">
                <img class="img-responsive" src="<?php echo base_url(); ?>img/article/<?=$data_article->articleID?>/<?=$data_article->articleImgLink?>">
            </div>

            <div class="col-md-12 col-lg-12 article-content">
                <?php echo $data_article->content;?>
            </div>
        </div>
    </div><!--Content-->

    <div class="row" id="social-share">
        <div class="social-share-btn">
            <a href="#">
                <span id="share-facebook" class="share-btn">
                    <img src="<?php echo base_url(); ?>img/icon/facebook.png" height="20" width="20" >
                         Share
                </span>
            </a>
        </div>
        <div  class="social-share-btn">
            <a href="https://twitter.com/intent/tweet?text=<?=$data_article->title?>&url=<?php echo site_url(uri_string());?>">
                <span id="share-twitter" class="share-btn">
                    <img src="<?php echo base_url(); ?>img/icon/twitter.png" height="20" width="20" >
                        Tweet
                </span>
            </a>
        </div>
        <div class="clear"></div>
    </div><!--Share Button-->

    <div class="row" id="tag-container">
        <h4 class="right">Tags : </h4>
        <?php foreach($data_tag as $row) { ?>
            <a href="<?=site_url('fe/article/articleTag/'.$row['tag'])?>">
                <button type="button" class="btn btn-default btn-sm btn-tag float-right"><span class="glyphicon glyphicon-tag" aria-hidden="true"></span> <?=$row['tag']?></button>
            </a>
        <?php } ?>
        <div class="clear"></div>
    </div>

    <div class="row" id="author">

        <div class="author-img col-sm-3">
            <img class="img-responsive" src="<?php echo base_url(); ?>img/user/<?=$data_article->userImgLink?>">
        </div>

        <div class="author-detail col-sm-9">
            <h4><b><?=$data_article->name?></b></h4>
            <p><?=$data_article->userDescription?></p>
        </div>
    </div><!--Author-->

    <!--Related Article-->
    <div class="row related-article-container">
        <h1>Artikel Terkait</h1>
        <?php 
        foreach($related_article as $row) { 
        ?>
            <div class="related-article-item">
                <div class="article-img-wrapper">
                    <a href="<?php echo site_url('fe/article/getArticleDetail/'.$row['title_url_clean']);?>">
                        <img class="img-responsive" src="<?php echo base_url(); ?>img/article/<?=$row['articleID']?>/<?=$row['articleImgLink']?>" width="200" />
                    </a>
                </div>
                <h4><a href="<?php echo site_url('fe/article/getArticleDetail/'.$row['title_url_clean']);?>"><?=$row['title']?></a></h4>
            </div>
        <?php } ?>
    </div><!--Related Article-->

    <!--Loading Comment-->
    <div class="row loading-wrap">
        <div class="bubblingG">
            <span id="bubblingG_1">
            </span>
            <span id="bubblingG_2">
            </span>
            <span id="bubblingG_3">
            </span>
        </div>
    </div><!--Loading Comment-->
    <!--Article Comment-->
    <div class="comment-container" id="comment-container">
        <div class="row">
            <div class="col-lg-3">
                <h3>Feedback</h3>
            </div>
        </div>
        <div id="disqus_thread"></div>
        <script>
            /**
             *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
             *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables
             */
            var disqus_config = function () {
				this.page.url = '<?php echo site_url("fe/article/getArticleDetail/".$data_article->title);?>';
				this.page.identifier = '<?php echo "fe/article/getArticleDetail/".$data_article->title;?>';
				this.page.title = '<?php echo $data_article->title;?>';
			};
            (function() {  // DON'T EDIT BELOW THIS LINE
                var d = document, s = d.createElement('script');

                s.src = '//cyberits.disqus.com/embed.js';

                s.setAttribute('data-timestamp', +new Date());
                (d.head || d.body).appendChild(s);
            })();
        </script>
        <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
        <?=$pages?>

    </div><!--Article Comment-->

</div>
<?php } ?>

<script>
	$(function() {

        //SHARE
        $(document).ready(function(){
            $('#share-facebook').click(function(e){
                e.preventDefault();
                var url = window.location.href;
                var img = '<?php echo base_url(); ?>img/article/<?=$data_article->articleID?>/<?=$data_article->articleImgLink?>';
                var desc = '<?=$data_article->description?>';
                var caption = 'cyberits.co.id | By '+'<?=$data_article->name?>';
                FB.ui(
                    {
                        method: 'feed',
                        name: '<?=$data_article->title?>',
                        link: url,
                        picture: img,
                        caption: caption,
                        description: desc,
                        message: ''
                    });
                return false;
            });
        });

        function isValidEmailAddress(emailAddress) {
            var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
            return pattern.test(emailAddress);
        };

        function validateComment(){

            $(".label-danger").remove();
            var name = $('#comment-name').val();
            var email = $('#comment-email').val();
            var comment = $('#comment-text').val();
            var err=0;

            if(name.trim() == "" || name.trim() == null){
                $("input#comment-name").css("border-color","#fc5d32");
                $('<span class="label label-danger">Must be filled !</span>').appendTo("#err-comment-name");
                err++;
            }else{
                var count_comment = comment.length;
                if(count_comment < 3){
                    $("input#comment-name").css("border-color","#fc5d32");
                    $('<span class="label label-danger">Name must al least 3 characters !</span>').appendTo("#err-comment-name");
                    err++;
                }else{
                    $("input#comment-name").css("border-color","black");
                    $('#err-comment-name').html("");
                }
            }

            if( !isValidEmailAddress( email ) ) {
                $("input#comment-email").css("border-color","#fc5d32");
                $('<span class="label label-danger">Must be valid !</span>').appendTo("#err-comment-email");
                err++;
            }else{
                $("input#comment-email").css("border-color","black");
                $('#err-comment-email').html("");
            }

            if(comment.trim() == "" || comment.trim() == null){
                $("textarea#comment-text").css("border-color","#fc5d32");
                $('<span class="label label-danger">Must be filled !</span>').appendTo("#err-comment-text");
                err++;
            }else{
                var count_comment = comment.length;
                if(count_comment < 20){
                    $("textarea#comment-text").css("border-color","#fc5d32");
                    $('<span class="label label-danger">Comment must al least 20 characters !</span>').appendTo("#err-comment-text");
                    err++;
                }else{
                    $("textarea#comment-text").css("border-color","black");
                    $('#err-comment-text').html("");
                }
            }

            if(err==0){
                return true;
            }else{
                return false;
            }
        }

        function validateCommentAdmin(){
            var comment = $('#comment-text-admin').val();
            var err=0;

            if(comment.trim() == "" || comment.trim() == null){
                $("textarea#comment-text-admin").css("border-color","#fc5d32");
                $('<span class="label label-danger">Must be filled !</span>').appendTo("#err-comment-text-admin");
                err++;
            }else{
                var count_comment = comment.length;
                if(count_comment < 20){
                    $("textarea#comment-text-admin").css("border-color","#fc5d32");
                    $('<span class="label label-danger">Comment must al least 20 characters !</span>').appendTo("#err-comment-text-admin");
                    err++;
                }else{
                    $("textarea#comment-text-admin").css("border-color","black");
                    $('#err-comment-text-admin').html("");
                }
            }

            if(err==0){
                return true;
            }else{
                return false;
            }
        }

        $("#submit-comment-admin").click(function(){
            if(validateCommentAdmin()){

                var dataComment = {
                    comment : $('#comment-text-admin').val()
                };

                $.ajax({
                    url: "<?php echo site_url("fe/article/insertCommentAdmin/".$data_article->articleID);?>",
                    data: dataComment,
                    dataType: 'json',
                    type : "POST",
                    success:function(data){
                        if(data.status != 'error') {
                            //alertify.success(data.msg);
                            window.location.reload();
                        }else{
                            alertify.error(data.msg);
                        }
                    },
                    error:function(data){
                        //alertify.alert(data.responseText);
                        alertify.error('Failed to Save Data!');
                    }
                });
            }
            return false;
        });

        $("#submit-comment").click(function(){
            if(validateComment()){

                var dataComment = {
                    name : $('#comment-name').val() ,
                    email : $('#comment-email').val(),
                    comment : $('#comment-text').val()
                };

                $.ajax({
                    url: "<?php echo site_url("fe/article/insertComment/".$data_article->articleID);?>",
                    data: dataComment,
                    dataType: 'json',
                    type : "POST",
                    success:function(data){
                        if(data.status != 'error') {
                            //alertify.success(data.msg);
                            window.location.reload();
                            //location.href = "<?= site_url("be/article/getArticleListCms")?>";
                        }else{
                            alertify.error(data.msg);
                        }
                    },
                    error:function(data){
                        //alertify.alert(data.responseText);
                        alertify.error('Failed to Save Data!');
                    }
                });
            }
            return false;
        });
	});
</script>