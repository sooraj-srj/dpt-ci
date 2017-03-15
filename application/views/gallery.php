<style>
    .gallery-div-bg-style {
        background-color: rgba(51,73,96,0.9);
        margin-bottom: 15px;
        float: left;
        position: relative;
        width: 100%;
    }
    .gallery-div-bg-style h4{
        color:#fff;
        font-weight:bold;
    }
    .filter-btn-style{border-radius:0px;}	
    .filter-btn-style .btn-primary{border-radius:0px !important;margin-top:3px;}
    .filter-btn-style ul li{margin-bottom:0px !important;}	
    .gallery{
        display: inline-block;
        margin-top: 20px;
    }
    /* for image resize */
    .img-resize{
        width: 100% !important;
        height: 130px !important;
    }
    /* for image resize */
</style>

<div class="detail-img-div"></div>
<div class="clearfix"></div>
<div class="gallery-div">
    <div class="container">
        <div class="col-md-3">

            <div class="clearfix"></div>
            <div class="left-package-list">
                <div class="widget banners">
                    <div class="banner">
                        <?php include('common/tripadvisor-widget.php'); ?>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <br>
            <img src="<?php echo assets_url(); ?>images/003.jpg" class="img-responsive"> <br>
            <img src="<?php echo assets_url(); ?>images/7fdc3fb083f48a1.jpg" class="img-responsive"></div>
        <div class="col-md-9 gallery-div-bg-right">
            <div class="gallery-div-bg-style">

                <div class="col-md-9"><h4><?php if($gallery_data['title'] != '') echo $gallery_data['title']; else echo 'All Images'; ?></h4></div>
                <div class="col-md-3">
                    <div class="dropdown filter-btn-style">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Select Gallery
                            <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <?php
                                foreach($galleries as $gal) {
                                    ?>
                                    <li><a href="<?php url('gallery?id='.$gal['id']) ?>"><?php echo $gal['title']; ?></a></li>
                                    <?php
                                }
                            ?>                            
                        </ul>
                    </div>
                </div>

            </div>
            <?php
                if(empty($gallery_images)){
                    echo '<center>No images in this gallery!</center>';
                }
            ?>
            <div class='list-group gallery'>
                <?php                     
                    foreach ($gallery_images as $gi) {
                ?>
                        <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                            <a class="thumbnail fancybox" rel="ligthbox" href="<?php echo_image('images/gallery/'.$gi['file_name']) ?>">
                                <img class="img-responsive img-resize" alt="" src="<?php echo_image('images/gallery/'.$gi['file_name']) ?>" />
                               <!--  <div class='text-right'>
                                    <small class='text-muted'>Image Title</small>
                                </div>  -->
                            </a>
                        </div> <!-- col-6 / end -->

                <?php
                    }
                ?>
                </div>


        </div>
    </div>
</div>
<script type="text/javascript">
    
</script>

