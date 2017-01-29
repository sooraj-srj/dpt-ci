
<div class="list-img-div"></div>
<div class="details-booking-div">
    <div class="booking-inn-div">
        <div class="container">
            <div class="col-md-3">
                <div class="price-decoration block-after-indent  screen-only">
                    <!--<div class="price-decoration__value"> <i class="fa fa-tag"></i> <span class="amount"><small>AED </small>580</span> <span class="amount"><small>USD </small>159</span> </div>-->
                    <div class="price-decoration__label"><h4>Tours & Safaries</h4></div>
                </div>
                <div class="clearfix"></div>
                <div class="left-package-list">
                    <ul id="mainNav" class="list-product-ul">
                        <?php 
                        $i = 1;
                        foreach ($categories as $cats){
                        ?>
                        <li class="mainNavItem <?php if($current == $cats['slug']){ echo 'active'; } ?>">
                            <div id="navItem<?php echo $i; ?>" data-url="<?php echo base_url().'tours/'.$cats['slug']; ?>" class="cat-nav">
                                <?php echo $cats['title'] ?>
                            </div>
                        </li>
                        <?php
                        $i++;
                        }
                        ?>
                    </ul>
                </div>
                <div class="clearfix"></div>
                <br>
                <div class="widget banners">
                    <div class="banner">
                        <?php include('common/tripadvisor-widget.php'); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="list-div-style-1">
                        <div class="title title--big title--center title--underline title--decoration-bottom-center">
                            <h3 class="title__primary">Select Your Emirates </h3>
                        </div>
                        <?php
                            foreach ($emirates as $em) {
                                ?>
                                <div class="col-md-4">
                                    <div class="grid">
                                        <figure class="effect-marley">
                                            <img src="<?php echo_image('images/emirates/'.$em['image']) ?>" class="img-responsive" alt="img11"/>
                                            <figcaption>
                                                <h2><span><?php  echo $em['name']; ?></span></h2>
                                                <p>Select</p>
                                                <a href="<?php echo base_url(); ?>plan/<?php echo $current; ?>/<?php echo $em['id']; ?>">Select</a>
                                            </figcaption>
                                        </figure>
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
</div>
<div class="clearfix"></div>
