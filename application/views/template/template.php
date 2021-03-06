<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Dubai Private Tour Discover Dubai with Dubai Private Tour</title>

    <!-- Bootstrap -->
    <link href="<?php echo c('css_path_url'); ?>bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo c('css_path_url'); ?>style.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo c('css_path_url'); ?>owl.carousel.css" rel="stylesheet">
    <link href="<?php echo c('css_path_url'); ?>owl.theme.css" rel="stylesheet">
    
    <link rel="stylesheet" type="text/css" href="<?php echo c('css_path_url'); ?>demo.css">
    <link rel="stylesheet" type="text/css" href="<?php echo c('css_path_url'); ?>set1.css">
    <link rel="stylesheet" type="text/css" href="<?php echo c('css_path_url'); ?>datepicker3.css">
    
    <link rel="stylesheet" type="text/css" href="<?php echo c('css_path_url'); ?>bootstrapValidator.min.css">    
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    
    <link rel="stylesheet" type="text/css" href="<?php echo c('css_path_url'); ?>media.css">
    <link rel="stylesheet" type="text/css" href="<?php echo c('css_path_url'); ?>bannerscollection_zoominout.css">
      
    
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<a href="#" id="scroll" title="Scroll to Top" style="display: none;">Top<span></span></a>
<div class="top-div">
    <div class="container">
        <div class="col-md-6">
            <ul class="top-ul-num">
                <li><i class="fa fa-mobile" aria-hidden="true"></i> &nbsp; +971 55 955 4333</li>
                <li><i class="fa fa-phone" aria-hidden="true"></i> &nbsp; +971 4 3961 444</li>
            </ul>
        </div>
        <div class="col-md-6">
            <ul class="top-ul-social">
                <li><a href="https://www.facebook.com/Dubaiprivatetour-1200810873344965/" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li><i class="fa fa-twitter" aria-hidden="true"></i></li>
                <li><i class="fa fa-google-plus" aria-hidden="true"></i></li>
                <li><i class="fa fa-linkedin" aria-hidden="true"></i></li>
                <li><i class="fa fa-instagram" aria-hidden="true"></i></li>
            </ul>
        </div>
    </div>
</div>

<div class="logo-menu-div">
    <div class="container">
        <div class="col-md-12">
            <nav id='cssmenu'>
                <div class="logo mob-logo"><a href="<?php echo url(); ?>"><img src="<?php echo assets_url(); ?>images/logo.png" class="img-responsive"></a></div>
                <div id="head-mobile"></div>
                <div class="button mob-btn"></div>
                <ul class="menu-ul-style">
                <?php 
                    $menus = get_menu(); 
                    foreach($menus as $menu){              
                        ?>
                        <li>
                            <a href='<?php url($menu['link']); ?>'><?php echo $menu['menu_name']; ?></a>
                            <?php 
                            if($menu['type'] == 'category'){
                                ?>
                                <ul>
                                    <?php $categories = get_categories(); ?>
                                    <?php 
                                        foreach ($categories as $cats){
                                            if($cats['slug'] == 'ferrari-world'){
                                                $link = base_url().'plan/ferrari-world/4?plan=74';
                                            }
                                            else{
                                                $link = base_url().'tours/'.$cats['slug'];
                                            }
                                    ?>  
                                        <li>
                                            <a href='<?php echo $link; ?>'>
                                                <?php echo $cats['title']; ?>
                                            </a>
                                        </li>
                                    <?php
                                        }
                                    ?>                            
                                </ul>
                                <?php
                            }
                            else if($menu['type'] == 'emirates'){
                                ?>
                                <ul>
                                <?php 
                                    $emirates = get_emirates();  
                                    foreach ($emirates as $em) {
                                        ?>
                                        <li><a href='<?php url('transfer/'.$em['id']); ?>'><?php echo $em['name']; ?></a> </li>
                                        <?php
                                    }
                                ?>                           
                                </ul>
                                <?php
                            }
                            ?>

                        </li>
                        <?php
                    }
                ?>
                  
                </ul>
            </nav>
        </div>
    </div>
</div>

<?php
    //contents goes here
    echo $content;
?>

<div class="clearfix"></div>
<br>
<div class="footer-div-style">
    <div class="container">
        <div class="col-md-3">
            <h4 class="footer-head-style">Quick Link</h4>
            <ul class="footer-quick-ul">
                <li><a href="<?php url(); ?>" style="color:#fff;">HOME</a></li>
                <li><a href="<?php url('about'); ?>" style="color:#fff;">ABOUT US</a></li>
                <li><a href="<?php url('why-us'); ?>" style="color:#fff;">WHY US</a></li>
                <li><a href="<?php url('faqs'); ?>" style="color:#fff;">FAQ'S</a></li>
                <li><a href="<?php url('terms-and-conditions'); ?>" style="color:#fff;">CANCELLATION POLICY</a></li>
                <li><a href="<?php url('careers'); ?>" style="color:#fff;">CAREERS</a></li>
                <li><a href="<?php url('contact'); ?>" style="color:#fff;">CONTACT US</a></li>
            </ul>

            <img src="<?php echo assets_url(); ?>images/credit-card.png" class="img-responsive">
        </div>
        <div class="col-md-2"> <img src="<?php echo assets_url(); ?>images/trip2.png" class="img-responsive">
            <br>
            <div class="widget-last-posts__item">
                <!-- Tripadviser -->
                <div id="TA_excellent59" class="TA_excellent"><div id="CDSWIDEXC" class="widEXC"> <div class="bravoBox"> <div class="bravoWrapper"> <div class="bravoText"> Bravo! </div> </div> <img src="https://www.tripadvisor.com/img/cdsi/partner/transparent_pixel-11863-2.gif" height="1" width="1"> </div> <br> <div id="CDSWIDEXCLINK" class="widEXCLINK"> <a target="_blank" href="https://www.tripadvisor.com/Attraction_Review-g295424-d2510773-Reviews-Dubai_Private_Tour-Dubai_Emirate_of_Dubai.html" onclick="ta.cds.handleTALink(11863,this);return true;" rel="nofollow">Dubai Private Tour rated "excellent" by 1,231 travelers</a><br> </div> <div class="widEXCTALOGO"> <a target="_blank" href="https://www.tripadvisor.com/"><img src="https://static.tacdn.com/img2/widget/tripadvisor_logo_115x18.gif" alt="TripAdvisor" class="widEXCIMG" id="CDSWIDEXCLOGO"></a> </div> </div><!--/ cdsEXCBadge--> </div>
                <script src="http://www.jscache.com/wejs?wtype=excellent&amp;uniq=59&amp;locationId=2510773&amp;lang=en_US&amp;display_version=2"></script>
                <script src="https://www.tripadvisor.com/WidgetEmbed-excellent?lang=en_US&amp;locationId=2510773&amp;display_version=2&amp;uniq=59"></script>
                <!-- end of tripadviser -->

                <div class="margin-top  margin-bottom" style="text-align:center"> <img src="<?php echo assets_url(); ?>images/100-percent-satisfaction.png" class="img-responsive img-mob"></div>
            </div>
        </div>
        <div class="col-md-4">
            <h4 class="footer-head-style">Facebook Updates</h4>
            <iframe src="http://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FDubaiprivatetour-1200810873344965%2F&tabs=timeline&width=300&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=false&appId" width="300" height="300" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
        </div>
        <div class="col-md-3">
            <h4 class="footer-head-style">Contact Us</h4>
            <div class="footer-div-contact-styl">
                <div class="footer-contact-icon">
                    <div class="footer-icon-div"> <i class="fa fa-map-marker" aria-hidden="true"></i> </div>
                </div>
                <div class="footer-contact-text">
                    <ul class="footer-contact-ul-style">
                        <?php echo get_settings('contact_address'); ?>
                    </ul>
                </div>

            </div>
            <div class="footer-div-contact-styl">
                <div class="footer-contact-icon">
                    <div class="footer-icon-div"> <i class="fa fa-phone" aria-hidden="true"></i> </div>
                </div>
                <div class="footer-contact-text">
                    <ul class="footer-contact-ul-style">
                        <?php //$contact_no = get_settings('contact_no'); ?>
                        <li><a href="tel:<?php echo $contact_no; ?>" style="color: #fff;">Tel: +971 55 955 4333<?php //echo $contact_no; ?></a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-div-contact-styl">
                <div class="footer-contact-icon">
                    <div class="footer-icon-div"> <i class="fa fa-mobile" aria-hidden="true"></i> </div>
                </div>
                <div class="footer-contact-text">
                    <ul class="footer-contact-ul-style">
                        <?php $cell_no = get_settings('contact_cell_no'); ?>
                        <li><a href="tel:<?php echo $cell_no; ?>" style="color: #fff;">Cell: <?php echo $cell_no; ?></a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-div-contact-styl">

                <div class="footer-contact-icon">
                    <div class="footer-icon-div"> <i class="fa fa-envelope" aria-hidden="true"></i> </div>
                </div>
                <div class="footer-contact-text">
                    <ul class="footer-contact-ul-style">
                        <li>info@dubaiprivatetour.com<br>info@milantoursdubai.com  <?php //echo get_settings('contact_email_addr'); ?></li>
                    </ul>
                </div>
            </div>

            <div class="footer-social-icon">
                <div class="foot-soc-icon-div col-1"><i class="fa fa-twitter" aria-hidden="true"></i></div>
                <div class="foot-soc-icon-div col-2">
                    <a href="https://www.facebook.com/Dubaiprivatetour-1200810873344965/" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                </div>
                <div class="foot-soc-icon-div col-3"><i class="fa fa-google-plus" aria-hidden="true"></i></div>
                <div class="foot-soc-icon-div col-4"><i class="fa fa-linkedin" aria-hidden="true"></i></div>
                <div class="foot-soc-icon-div col-5"><i class="fa fa-instagram" aria-hidden="true"></i></div>
                <div class="foot-soc-icon-div col-6"><i class="fa fa-youtube" aria-hidden="true"></i></div>
            </div>


        </div>
    </div>
</div>
<div class="copy-div-style">
    <p>© Dubai Private Tour, <?php date('Y'); ?>.</p>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo c('js_path_url'); ?>bootstrap.min.js"></script>
<script src="<?php echo c('js_path_url'); ?>bootstrapValidator.min.js"></script>
<script src="<?php echo c('js_path_url'); ?>menumaker.js"></script>
<script src="<?php echo c('js_path_url'); ?>owl.carousel.min.js"></script>

<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
<script src="<?php echo c('js_path_url'); ?>bannerscollection_zoominout.js"></script> 
<script src="<?php echo c('js_path_url'); ?>jquery.ui.touch-punch.min.js"></script> 
    <script>
        jQuery(function() {
            jQuery('#bannerscollection_zoominout_generous').bannerscollection_zoominout({
                skin: 'generous',
                responsive:true,
                width: 1920,
                height: 600,
                width100Proc:true,
                fadeSlides:true,
                thumbsOnMarginTop:14,
                thumbsWrapperMarginTop: -110,
                autoHideBottomNav:true
            });     
        });
    </script>
<script>

    $(document).ready(function($) {
      $("#owl-example").owlCarousel({
		  //Autoplay
    items : 3,
	itemsMobile : [479,1],
	itemsTablet: [768,3],
    autoPlay : false,
    stopOnHover : false,
	  // Navigation
navigation : true,
 navigationText : ["<",">"],
    rewindNav : true,
    scrollPerPage : false,
		      pagination : false,
    paginationNumbers: false,
		  //Basic Speeds
    slideSpeed : 200,
    paginationSpeed : 800,
    rewindSpeed : 1000,
 
 
		  });
   });
   
    $(document).ready(function($) {
      $("#owl-example2").owlCarousel({
		  //Autoplay
    items : 4,
	itemsMobile : [479,1],
	itemsTablet: [768,3],
    autoPlay : false,
    stopOnHover : false,
	  // Navigation
   navigation : true,
navigationText : ["<",">"],
    rewindNav : true,
    scrollPerPage : false,
		      pagination : false,
    paginationNumbers: false,
		  //Basic Speeds
    slideSpeed : 200,
    paginationSpeed : 800,
    rewindSpeed : 1000,
 
 
		  });
   });
    $(document).ready(function($) {
      $("#owl-example3").owlCarousel({
		  //Autoplay
    items : 5,
	itemsMobile : [479,1],
	itemsTablet: [768,3],
    autoPlay : false,
    stopOnHover : false,
	  // Navigation
   navigation : true,
navigationText : ["<",">"],
    rewindNav : true,
    scrollPerPage : false,
		      pagination : false,
    paginationNumbers: false,
		  //Basic Speeds
    slideSpeed : 200,
    paginationSpeed : 800,
    rewindSpeed : 1000,
 
 
		  });
   });

    $("body").data("page", "frontpage");

    </script> 
<script src="<?php echo c('js_path_url'); ?>owl.custom.js"></script>
<script src="<?php echo c('js_path_url'); ?>photo-gallery.js"></script>
<script src="<?php echo c('js_path_url'); ?>calen.js"></script>
<script src="<?php echo c('js_path_url'); ?>bootstrap-datepicker.js"></script>
<script src="<?php echo c('js_path_url'); ?>jssor.slider-22.0.7.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
<script src="<?php echo c('js_path_url'); ?>jssor.custom.js"></script>

<script>
    $("body").data("page", "frontpage");
</script>
<script src="<?php echo c('js_path_url'); ?>web.custom.js"></script>

</body>
</html>
<?php  $this->load->view("common/modals"); 

