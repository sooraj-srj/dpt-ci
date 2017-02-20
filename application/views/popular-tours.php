<h3>You May Also Like</h3>
<br>
<?php 
    $ptours = get_tours('popular',3);

    foreach ($ptours as $pt) {
?>
    <div class="col-md-4">
        <div class="item-main-div1">
            <img src="<?php echo assets_url(); ?>images/carous1/fit (1).jpg" class="img-responsive item-1-img">
            <div class="price-first-position">
                <div class="price-div-bg-text">
                    <center>
                        <h4><b>AED <?php echo $pt['price']; ?></b></h4>
                        <h5><b>USD <?php echo $pt['usd_price']; ?></b></h5>
                    </center>
                </div>
            </div>
            <div class="item-head-1">
                <center>
                    <h4 class="atgrid__item__title"><a href="<?php url('plan/'.$pt['cat_slug'].'/'.$pt['emirates_id'].'?plan='.$pt['tour_id']) ?>"><?php echo $pt['title']; ?></a>
                    </h4>
                </center>
            </div>
            <div class="item--footer-1">
                <div class="col-md-6"><i class="fa fa-clock-o" aria-hidden="true"></i> &nbsp;<?php echo $pt['duration']; ?>
                </div>
                <div class="col-md-6">
                <a href="<?php url('plan/'.$pt['cat_slug'].'/'.$pt['emirates_id'].'?plan='.$pt['tour_id']) ?>">Read More 
                <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></div>
            </div>
        </div>
    </div>
<?php
    }
?>
