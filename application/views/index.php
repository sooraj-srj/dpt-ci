<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="slider-div">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->

        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="item active"><img src="<?php echo assets_url(); ?>images/1920.jpg" style="width:100%" alt="First slide">
                <div class="container">
                    <div class="carousel-caption">
                        <h3><b>Discover Dubai with Dubaiprivatetour.com</b></h3>
                        <p>​Dubai private tour is an exclusive touring provided for all as our exquisites.
                            Unforgettable experience which is going to make this beautiful city one of your
                            favourite destination all year round. The historical cultural and modernisation of Dubai
                            revealed with its full glory. Come have the Dubai tour of your life with us.</p>
                        <p><a class="btn main-btn-style" href="#" role="button">Quick Contact</a></p>
                    </div>
                </div>
            </div>
            <div class="item"><img src="<?php echo assets_url(); ?>images/1920.jpg" style="width:100%" data-src="" alt="Second    slide">
                <div class="container">
                    <div class="carousel-caption">
                        <h3><b>Discover Dubai with Dubaiprivatetour.com</b></h3>
                        <p>​Dubai private tour is an exclusive touring provided for all as our exquisites.
                            Unforgettable experience which is going to make this beautiful city one of your
                            favourite destination all year round. The historical cultural and modernisation of Dubai
                            revealed with its full glory. Come have the Dubai tour of your life with us.</p>
                        <p><a class="btn main-btn-style" href="#" role="button">Quick Contact</a></p>
                    </div>
                </div>
            </div>

        </div>
        <!-- <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a> <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a> -->
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
                                    <img src="<?php echo_image('images/tours/tour1.jpg'); ?>" class="img-responsive item-1-img">
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
                                                <h4 class="atgrid__item__title"><a href="#"><?php echo $pt['title']; ?></a>
                                                </h4>
                                            </center>
                                        </div>
                                        <div class="item--footer-1">
                                            <div class="col-md-6">
                                                <i class="fa fa-clock-o" aria-hidden="true"></i> &nbsp; <?php echo $pt['duration']; ?>
                                            </div>
                                            <div class="col-md-6">
                                            <a href="#">Read More <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
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
                                    <a href="<?php url(); ?>">
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
                                    <center>
                                        <i class="fa fa-map-marker" aria-hidden="true"></i> <br>
                                        <h4><b><?php echo $cats['title']; ?></b></h4>
                                    </center>
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
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                    the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
                    of type and scrambled it to make a type specimen book. </p>
                <div class="col-md-6 position-div-4-allign">
                    <div class="position-4-div">
                        <div class="round-div-2"><i class="fa fa-globe" aria-hidden="true"></i></div>
                    </div>
                    <div class="position-5-div">
                        <h4><b>Lorem Ipsum</b></h4>
                        <p>Our wide range of tours and services include bespoke options… <a href="whyus.html"><i
                                    class="fa fa-long-arrow-right" aria-hidden="true"></i></a></p>
                    </div>
                </div>
                <div class="col-md-6 position-div-4-allign">
                    <div class="position-4-div">
                        <div class="round-div-2"><i class="fa fa-plane" aria-hidden="true"></i></div>
                    </div>
                    <div class="position-5-div">
                        <h4><b>Lorem Ipsum</b></h4>
                        <p>We are licensed specialists in the field of travel and tours,… <a href="whyus.html"><i
                                    class="fa fa-long-arrow-right" aria-hidden="true"></i></a></p>
                    </div>
                </div>
                <div class="col-md-6 position-div-4-allign">
                    <div class="position-4-div">
                        <div class="round-div-2"><i class="fa fa-star-o" aria-hidden="true"></i></div>
                    </div>
                    <div class="position-5-div">
                        <h4><b>Lorem Ipsum</b></h4>
                        <p>We pride ourselves on the outstanding services given by our… <a href="whyus.html"><i
                                    class="fa fa-long-arrow-right" aria-hidden="true"></i></a></p>
                    </div>
                </div>
                <div class="col-md-6 position-div-4-allign">
                    <div class="position-4-div">
                        <div class="round-div-2"><i class="fa fa-certificate" aria-hidden="true"></i></div>
                    </div>
                    <div class="position-5-div">
                        <h4><b>Lorem Ipsum</b></h4>
                        <p>We have extensive knowledge of the region and can give you the… <a href="whyus.html"><i
                                    class="fa fa-long-arrow-right" aria-hidden="true"></i></a></p>
                    </div>
                </div>
                <div class="col-md-6 position-div-4-allign">
                    <div class="position-4-div">
                        <div class="round-div-2"><i class="fa fa-money" aria-hidden="true"></i></div>
                    </div>
                    <div class="position-5-div">
                        <h4><b>Lorem Ipsum</b></h4>
                        <p>We believe in relationship Rather than just a Guide-Tourist… <a href="whyus.html"><i
                                    class="fa fa-long-arrow-right" aria-hidden="true"></i></a></p>
                    </div>
                </div>
                <div class="col-md-6 position-div-4-allign">
                    <div class="position-4-div">
                        <div class="round-div-2"><i class="fa fa-heart" aria-hidden="true"></i></div>
                    </div>
                    <div class="position-5-div">
                        <h4><b>Lorem Ipsum</b></h4>
                        <p>We believe in relationship Rather than just a Guide-Tourist… <a href="whyus.html"><i
                                    class="fa fa-long-arrow-right" aria-hidden="true"></i></a></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <img src="<?php echo assets_url(); ?>images/7fdc3fb083f48a1.jpg" class="img-responsive">
            <br>
            <img src="<?php echo assets_url(); ?>images/b7734aab25c8c4d.jpg" class="img-responsive">
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
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                        been the industry's standard dummy text ever since the 1500s, when an unknown printer took a
                        galley of type and scrambled it to make a type specimen book. It has survived not only five
                        centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                        It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum
                        passages,</p>
                </div>
                <center>
                    <a href="about.html">
                        <button type="button" class="btn main-btn-style">Read more</button>
                    </a>
                </center>
            </div>
        </div>
        <div class="col-md-6">
            <div class="title title--big title--center title--underline title--decoration-bottom-center">
                <h3 class="title__primary">WHAT OUR CUSTOMERS SAYS!</h3>
            </div>
            <div class="shortcode-tour-reviews">
                <h4 class="review-name"><b>Name</b></h4>
                <span class="country-name">india</span>
                <br>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                    the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
                    of type and scrambled it to make a type specimen book. It has survived not only five centuries,
                    but also the leap into electronic typesetting, remaining essentially unchanged. It was
                    popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum
                    passages,</p>

                <div class="pro-rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                        class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
            </div>
            <div class="clearfix"></div>
            <br>
            <div class="shortcode-tour-reviews">
                <h4 class="review-name"><b>Name</b></h4>
                <span class="country-name">india</span>
                <br>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                    the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
                    of type and scrambled it to make a type specimen book. It has survived not only five centuries,
                    but also the leap into electronic typesetting, remaining essentially unchanged. It was
                    popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum
                    passages,</p>

                <div class="pro-rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                        class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
            </div>

            <center>
                <a href="review.html">
                    <button type="button" class="btn main-btn-style">Read more</button>
                </a>&nbsp;
                <a href="review.html">
                    <button type="button" class="btn main-btn-style">Write a Review</button>
                </a>
            </center>

        </div>
    </div>
</div>
