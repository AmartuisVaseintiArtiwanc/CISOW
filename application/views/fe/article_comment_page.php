<div>
    <h3>Feedback</h3>
</div>

<?php
$no=0;
foreach ($data_comment as $row){
    $no++;
    ?>
    <div class=" row comment-content">
        <div class="row comment-info">
            <div class="col-sm-6 comment-name">
                <h4><b><?=$row['name'];?></b><h4>
            </div>
            <div class="col-sm-6 comment-time">
                <h5><?php
                    $date = date_create($row['created']);
                    echo date_format($date, 'F d, Y \a\t H:i' );
                    ?></h5>
            </div>
        </div>
        <div class="row comment-text">
            <div class="col-md-9 col-lg-9">
                <p><?=$row['comment'];?></p>
            </div>
        </div>
    </div><!--Comment Content-->
<?php
}
?>
<?=$pages?>