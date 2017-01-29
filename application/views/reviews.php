<style type="text/css">
    .gray{
        color: #e2e0dc !important;
    }
</style>
    <div class="detail-img-div"></div>
    <div class="clearfix"></div>
    <div class="details-booking-div">
        <div class="booking-inn-div">
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
                <div class="col-md-9">
                    <div class="row">
                        <div id="content-wrap1">
                            <div class="panel with-nav-tabs panel-default">
                                <div class="panel-heading">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#tab1default" data-toggle="tab">Read Reviews</a>
                                        </li>
                                        <li><a href="#tab12default" data-toggle="tab">Write a Review</a></li>
                                    </ul>
                                </div>
                                <div class="panel-body">
                                    <div class="tab-content">
                                        <div class="tab-pane fade in active" id="tab1default">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <?php 
                                                    if(!empty($reviews)){
                                                        foreach($reviews as $rev){ 
                                                    ?>                                                  
                                                            <div class="atlist__item " style="margin-bottom:5px">
                                                                <div class="padding-all">
                                                                    <h2> <?php echo $rev['name']; ?><small><i> <?php echo $rev['country']; ?></i></small></h2>
                                                                    <div class="meta">
                                                                        <div class="date"> <small class="text-muted">Posted:</small> <span><?php echo $rev['review_date']; ?></span>
                                                                        </div>
                                                                        <div class="shortcode-tour-reviews__item__rating">
                                                                            <?php 
                                                                            $rating = $rev['rating'];
                                                                            $gray = 5 - $rating;
                                                                            for($i=1; $i<=$rating; $i++) { ?>
                                                                            <i class="fa fa-star"></i>
                                                                            <?php } ?>
                                                                            <?php for($i=1; $i<=$gray; $i++) { ?>
                                                                            <i class="fa fa-star gray"></i>
                                                                            <?php } ?>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                    <div class="preview"><?php echo $rev['comments']; ?></div>
                                                                </div>
                                                            </div>
                                                    <?php 
                                                        }
                                                    } else {
                                                        ?>
                                                        <h3 class="text-muted">No reviews posted!</h3>
                                                        <?php
                                                    }
                                                    ?>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab12default">
                                            <form name="reviewForm" id="reviewForm" method="post" action="<?php url('review-appln') ?>">
                                            <div class="form-group col-md-6 col-sm-6">
                                                <label for="email">Name<span class="red">*</span></label>
                                                <input type="text" class="form-control input-sm" id="" name="name" placeholder="Your Name">
                                            </div>

                                            <div class="form-group col-md-6 col-sm-6">
                                                <label for="email">Email<span class="red">*</span></label>
                                                <input type="email" class="form-control input-sm" id="email" name="email" placeholder="Your Email">
                                            </div>

                                            <div class="form-group col-md-6 col-sm-12">
                                                <label for="email">Your Rating<span class="red">*</span></label>
                                                <select class="form-control input-sm" id="years" name="rating">
                                                    <option value="">Select </option>
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                    <option>5</option>                                                    
                                                </select>
                                            </div>

                                            <div class="form-group col-md-6 col-sm-12">
                                                <label for="email">Select Country<span class="red">*</span></label>
                                                <select class="form-control input-sm" id="years" name="country">
                                                    <option value="">Select</option>
                                                    <?php
                                                    foreach ($isd_code as $nation){
                                                    ?>
                                                    <option value="<?php echo $nation['country_name'] ?>"><?php echo $nation['country_name'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-12 col-sm-12">
                                                <label for="address">Comments </label>
                                                <textarea class="form-control input-sm" id="address" rows="5" name="comments"></textarea>
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit" class="btn main-btn-style">Submit</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="details-div-last">
                            <?php $this->load->view('popular-tours'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
