<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="slider-div">
    <div class="slider-div">
        <div id="bannerscollection_zoominout_generous">
            <div class="myloader"></div>
                <!-- CONTENT -->
            <ul class="bannerscollection_zoominout_list">
               <li data-text-id="#bannerscollection_zoominout_photoText3" data-bottom-thumb="<?php echo assets_url() ?>images/1920.jpg" data-horizontalPosition="left" data-verticalPosition="top" data-initialZoom="1" data-finalZoom="0.77">
               <img src="<?php echo assets_url() ?>images/1920.jpg" alt="" width="2500" height="1000" />
               </li>
               <li data-text-id="#bannerscollection_zoominout_photoText3" data-bottom-thumb="<?php echo assets_url() ?>images/1920.jpg" data-horizontalPosition="left" data-verticalPosition="top" data-initialZoom="1" data-finalZoom="0.77">
               <img src="<?php echo assets_url() ?>images/1920.jpg" alt="" width="2500" height="1000" />
               </li>
            </ul>    
            <div id="bannerscollection_zoominout_photoText3" class="bannerscollection_zoominout_texts">
                <div class="bannerscollection_zoominout_text_line textElement32_generousFullWidth slider-text-div" data-initial-left="10" data-initial-top="175" data-final-left="100" data-final-top="175" data-duration="0.5" data-fade-start="0" data-delay="0">
                <h3>Discover Dubai with Dubaiprivatetour.com</h3><br>
                ​Dubai private tour is an exclusive touring provided for all as our exquisites. Unforgettable experience which is going to make this beautiful city one of your favourite destination all year round. The historical cultural and modernisation of Dubai revealed with its full glory. Come have the Dubai tour of your life with us.<br>
                <p><a class="btn main-btn-style" href="<?php url('contact'); ?>" role="button">Quick Contact</a></p>
                </div>
            </div>
      </div>  
    </div>
</div>

<div class="position-div-1">
    <div class="container">


        <div class="title title--big title--center title--decoration-bottom-center">
            <div class="title__subtitle">Take a Look at Our</div>
            <h3 class="title__primary">Most Popular Tours</h3>
        </div>


        <div class="col-md-12">
            <div class="span12">
                <div id="owl-example" class="owl-carousel">
                    <?php 
                        foreach ($popular_tours as $pt) {                        
                    ?>
                            <div class="item">
                                <div class="col-md-12">
                                    <div class="item-main-div1">
                                    <img src="<?php echo_image('images/tours/'.$pt['image']); ?>" class="img-responsive item-1-img" style="width:360px; height:229px;">
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
                                            <div class="col-md-6">
                                                <i class="fa fa-clock-o" aria-hidden="true"></i> &nbsp; <?php echo $pt['duration']; ?>
                                            </div>
                                            <div class="col-md-6">
                                            <a href="<?php url('plan/'.$pt['cat_slug'].'/'.$pt['emirates_id'].'?plan='.$pt['tour_id']) ?>">
                                            Read More <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                                            <!--plan/luxury-tours/1?plan=32-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="position-div-2">
    <div class="container">
        <div class="title title--big title--center title--decoration-bottom-center">
            <div class="title__subtitle">Find a Tour by</div>
            <h3 class="title__primary">DESTINATION</h3>
        </div>
        <div class="col-md-12">
            <div class="span12">
                <div id="owl-example2" class="owl-carousel">
                    <?php 
                        foreach ($emirates as $emirate) {
                           ?>
                            <div class="item">
                                <div class="col-md-12">
                                    <a href="<?php url('transfer/'.$emirate['id']); ?>">
                                        <img src="<?php echo_image('images/emirates/'.$emirate['image']); ?>" class="img-responsive">
                                        <div class="text-2-style"><?php echo $emirate['name']; ?></div>
                                    </a>
                                </div>
                            </div>
                           <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="position-div-3">
    <div class="container">

        <div class="title title--big title--center title--decoration-bottom-center">
            <div class="title__subtitle">Find a Tour by</div>
            <h3 class="title__primary">TOUR TYPE</h3>
        </div>

        <div class="col-md-12">
            <div class="span12">
                <div id="owl-example3" class="owl-carousel">
                    <?php 
                        foreach ($categories as $cats) { 
                    ?>
                    <div class="item">
                        <div class="col-md-12">
                            <div class="plan-round-div">
                                <div class="icon-text-div">
                                    <a href="<?php url('tours/'.$cats['slug']); ?>">
                                        <center>
                                            <i class="fa fa-map-marker" aria-hidden="true"></i> <br>
                                            <h4><b><?php echo $cats['title']; ?></b></h4>
                                        </center>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    ?>                                    
                </div>
            </div>
        </div>
    </div>
</div>
<div class="position-div-4">
    <div class="container">
        <div class="col-md-9">
            <div class="row">
                <div class="title title--big title--center title--underline title--decoration-bottom-center">
                    <h3 class="title__primary">WHY US</h3>
                </div>
                <p style="word-wrap:break-word;">Dubai Private Tour / Milan Tours & Tour Guide Services LLC we believe that it’s the small things that make the difference between a good day out and a perfect one. We always do that little bit extra to ensure your tour is special.   - See more at: http://www.dubaiprivatetour.com/#sthash.66kbLrHV.dpuf</p>
                <div class="col-md-6 position-div-4-allign">
                    <div class="position-4-div">
                        <div class="round-div-2"><i class="fa fa-globe" aria-hidden="true"></i></div>
                    </div>
                    <div class="position-5-div">
                        <h4><b>Our Expertise</b></h4>
                        <p>
                            We are licensed specialists in the field of travel and tours, with sixteen years of rich experience… 
                            <a href="<?php url('why-us'); ?>"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                        </p>
                    </div>
                </div>
                <div class="col-md-6 position-div-4-allign">
                    <div class="position-4-div">
                        <div class="round-div-2"><i class="fa fa-plane" aria-hidden="true"></i></div>
                    </div>
                    <div class="position-5-div">
                        <h4><b>The Widest Range of Tour Options</b></h4>
                        <p>Our wide range of tours and services include bespoke options to suit your requirements… <a href="<?php url('why-us'); ?>"><i
                                    class="fa fa-long-arrow-right" aria-hidden="true"></i></a></p>
                    </div>
                </div>
                <div class="col-md-6 position-div-4-allign">
                    <div class="position-4-div">
                        <div class="round-div-2"><i class="fa fa-star-o" aria-hidden="true"></i></div>
                    </div>
                    <div class="position-5-div">
                        <h4><b>Highest Rate of Customer Satisfaction</b></h4>
                        <p>At Dubai Private Tour / Milan Tours and Tour Guide Services LLC , we pride ourselves in knowing… <a href="<?php url('why-us'); ?>"><i
                                    class="fa fa-long-arrow-right" aria-hidden="true"></i></a></p>
                    </div>
                </div>
                <div class="col-md-6 position-div-4-allign">
                    <div class="position-4-div">
                        <div class="round-div-2"><i class="fa fa-certificate" aria-hidden="true"></i></div>
                    </div>
                    <div class="position-5-div">
                        <h4><b>The most experienced Tour Operators, Managers and Guides</b></h4>
                        <p>We pride ourselves on the outstanding services given by our experienced Tour Managers and Guides… <a href="<?php url('why-us'); ?>"><i
                                    class="fa fa-long-arrow-right" aria-hidden="true"></i></a></p>
                    </div>
                </div>
                <div class="col-md-6 position-div-4-allign">
                    <div class="position-4-div">
                        <div class="round-div-2"><i class="fa fa-money" aria-hidden="true"></i></div>
                    </div>
                    <div class="position-5-div">
                        <h4><b>The Best Value in the Industry</b></h4>
                        <p>We have extensive knowledge of the region and can give you the best value for your money…  <a href="<?php url('why-us'); ?>"><i
                                    class="fa fa-long-arrow-right" aria-hidden="true"></i></a></p>
                    </div>
                </div>
                <div class="col-md-6 position-div-4-allign">
                    <div class="position-4-div">
                        <div class="round-div-2"><i class="fa fa-heart" aria-hidden="true"></i></div>
                    </div>
                    <div class="position-5-div">
                        <h4><b>Relationship</b></h4>
                        <p>We believe in relationship Rather than just a Guide-Tourist Thread…  <a href="<?php url('why-us'); ?>"><i
                                    class="fa fa-long-arrow-right" aria-hidden="true"></i></a></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <a href="<?php url('tourist-visa'); ?>"><img src="<?php echo assets_url(); ?>images/7fdc3fb083f48a1.jpg" class="img-responsive"></a>
            <br>
            <a href="<?php url('reviews'); ?>"><img src="<?php echo assets_url(); ?>images/b7734aab25c8c4d.jpg" class="img-responsive"></a>
        </div>
    </div>
</div>
<div class="position-div-5">
    <div class="container">
        <div class="col-md-6">
            <div class="title title--big title--center title--underline title--decoration-bottom-center">
                <h3 class="title__primary">ABOUT US</h3>
            </div>
            <img src="<?php echo assets_url(); ?>images/760.jpg" class="img-responsive">
            <div class="col-md-10 col-md-offset-1 about-text-div-main">

                <div class="about-text-div">
                    <p>If you are looking for a warm and sunny holiday or a family vacation, look no further than Dubai city. Dubai is every tourist’s paradise. With its modern skyline, comprehensive infrastructure, brilliant attractions, glamorous shopping malls, fine dining and quality hotels; Dubai is easily one of the best places to visit in the world.</p>
                </div>
                <center>
                    <a href="<?php url('about'); ?>">
                        <button type="button" class="btn main-btn-style">Read more</button>
                    </a>
                </center>
            </div>
        </div>
        <div class="col-md-6">
            <div class="title title--big title--center title--underline title--decoration-bottom-center">
                <h3 class="title__primary">WHAT OUR CUSTOMERS SAYS!</h3>
            </div>
            <?php 
            if(!empty($reviews)){
                foreach($reviews as $rev){ 
            ?> 
            <div class="shortcode-tour-reviews">
                <h4 class="review-name"><b><?php echo $rev['name']; ?></b></h4>
                <span class="country-name"><?php echo $rev['country']; ?></span>
                <br>
                <p><?php echo $rev['comments']; ?></p>

                <div class="pro-rating">
                    <?php 
                    $rating = $rev['rating'];
                    $gray = 5 - $rating;
                    for($i=1; $i<=$rating; $i++) { ?>
                    <i class="fa fa-star"></i>
                    <?php } ?>
                    <?php for($i=1; $i<=$gray; $i++) { ?>
                    <i class="fa fa-star" style="color: #e2e0dc !important;"></i>
                    <?php } ?>
                </div>
            </div>
            <div class="clearfix"></div>
            <br>
            <?php 
                }
            } else {
                ?>
                <h3 class="text-muted">No reviews posted!</h3>
                <?php
            }
            ?>

            <center>
                <a href="<?php url('reviews'); ?>">
                    <button type="button" class="btn main-btn-style">Read more</button>
                </a>&nbsp;
                <a href="<?php url('reviews'); ?>">
                    <button type="button" class="btn main-btn-style">Write a Review</button>
                </a>
            </center>

        </div>
    </div>
</div>

