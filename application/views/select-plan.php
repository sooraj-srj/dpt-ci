
<div class="detail-img-div"></div>
<div class="clearfix"></div>
<div class="details-booking-div">
    <div class="booking-inn-div">
        <div class="container">
            <div class="col-md-3">
                <div class="price-decoration block-after-indent  screen-only">
                    <!--<div class="price-decoration__value"> <i class="fa fa-tag"></i> <span class="amount"><small>AED </small>580</span> <span class="amount"><small>USD </small>159</span> </div>-->
                    <div class="price-decoration__label"><h4>Select Your Package</h4></div>
                </div>
                <div class="clearfix"></div>
                <div class="left-package-list">
                    <ul id="mainNav" class="list-product-ul">
                        <?php
                        $i = 1;
                        foreach ($tours as $tour) {
                            ?>
                            <li class="mainNavItem <?php if ($tour['tour_id'] == $tour_id) {
                            echo 'active';
                        } ?>">
                                <div id="navItem<?php echo $i; ?>" data-url="<?php echo current_url() . '?plan=' . $tour['tour_id']; ?>" class="tour-nav">
                            <?php echo $tour['title'] ?>
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

                <img src="<?php echo assets_url(); ?>images/003.jpg" class="img-responsive">
                <br>
                <img src="<?php echo assets_url(); ?>images/7fdc3fb083f48a1.jpg" class="img-responsive">
                <br>
                <img src="<?php echo assets_url(); ?>images/004.jpg" class="img-responsive">
                <br>
                <img src="<?php echo assets_url(); ?>images/005.jpg" class="img-responsive">


            </div>
            <div class="col-md-9">
                <div class="row">
                    <div id="content-wrap1">
                        <div class="price-decoration2 block-after-indent  screen-only">
                            <div class="price-decoration__value"><i class="fa fa-tag"></i> <span class="amount"><small>AED </small>580</span>
                                <span class="amount"><small>USD </small>159</span></div>
                            <div class="price-decoration__label"><i class="td-clock-2"></i> Duration 4 Hours</div>
                        </div>
                        <div class="panel with-nav-tabs panel-default">
                            <div class="panel-heading">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab1default" data-toggle="tab">Book This Tour</a>
                                    </li>
                                    <li><a href="#tab2default" data-toggle="tab">Details</a></li>
                                    <li><a href="#tab3default" data-toggle="tab">Ask Questions</a></li>
                                    <li><a href="#tab4default" data-toggle="tab">Photos</a></li>
                                </ul>
                            </div>
                            <div class="panel-body">
                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="tab1default">
                                        <div class="col-md-12">
                                            <h4><b>Booking Details</h4>
                                            </b></div>
                                        <form>
                                            <div class="col-md-12 col-sm-12">
                                                <div class="form-group col-md-6 col-sm-6">
                                                    <label for="arrival">Tour Date *</label>
                                                    <input type="text" class="form-control input-sm datepicker"
                                                           id="arrival" placeholder="">
                                                </div>
                                                <div class="form-group col-md-6 col-sm-6">
                                                    <label for="name">Preferred Pickup Time*</label>
                                                    <select class="form-control input-sm" id="months">
                                                        <option>-- Select No of Month --</option>
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                        <option>4</option>
                                                        <option>5</option>
                                                        <option>6</option>
                                                        <option>7</option>
                                                        <option>8</option>
                                                        <option>9</option>
                                                        <option>10</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6 col-sm-6">
                                                    <label for="name">Preferred Location*</label>
                                                    <select class="form-control input-sm" id="months">
                                                        <option>-- Select No of Month --</option>
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                        <option>4</option>
                                                        <option>5</option>
                                                        <option>6</option>
                                                        <option>7</option>
                                                        <option>8</option>
                                                        <option>9</option>
                                                        <option>10</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6 col-sm-6">
                                                    <label for="name">End Location*</label>
                                                    <select class="form-control input-sm" id="months">
                                                        <option>-- Select No of Month --</option>
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                        <option>4</option>
                                                        <option>5</option>
                                                        <option>6</option>
                                                        <option>7</option>
                                                        <option>8</option>
                                                        <option>9</option>
                                                        <option>10</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-6 col-sm-6">
                                                            <div class="row">
                                                                <div class="form-group col-md-7 col-sm-6">
                                                                    <label for="name">Preferred Guide
                                                                        Language*</label>
                                                                    <select class="form-control input-sm"
                                                                            id="months">
                                                                        <option>-- Select No of Month --</option>
                                                                        <option>1</option>
                                                                        <option>2</option>
                                                                        <option>3</option>
                                                                        <option>4</option>
                                                                        <option>5</option>
                                                                        <option>6</option>
                                                                        <option>7</option>
                                                                        <option>8</option>
                                                                        <option>9</option>
                                                                        <option>10</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-md-5 col-sm-6">
                                                                    <label for="name">Payment Option*</label>
                                                                    <select class="form-control input-sm"
                                                                            id="months">
                                                                        <option>-- Select No of Month --</option>
                                                                        <option>1</option>
                                                                        <option>2</option>
                                                                        <option>3</option>
                                                                        <option>4</option>
                                                                        <option>5</option>
                                                                        <option>6</option>
                                                                        <option>7</option>
                                                                        <option>8</option>
                                                                        <option>9</option>
                                                                        <option>10</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6">
                                                            <div class="row">
                                                                <div class="form-group col-md-6 col-sm-6">
                                                                    <label for="gender">Pref.currency</label>
                                                                    <select class="form-control input-sm"
                                                                            id="months">
                                                                        <option>-- Select No of Month --</option>
                                                                        <option>1</option>
                                                                        <option>2</option>
                                                                        <option>3</option>
                                                                        <option>4</option>
                                                                        <option>5</option>
                                                                        <option>6</option>
                                                                        <option>7</option>
                                                                        <option>8</option>
                                                                        <option>9</option>
                                                                        <option>10</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-md-6 col-sm-6">
                                                                    <label for="gender">Payment Mode *</label>
                                                                    <select class="form-control input-sm"
                                                                            id="months">
                                                                        <option>-- Select No of Month --</option>
                                                                        <option>1</option>
                                                                        <option>2</option>
                                                                        <option>3</option>
                                                                        <option>4</option>
                                                                        <option>5</option>
                                                                        <option>6</option>
                                                                        <option>7</option>
                                                                        <option>8</option>
                                                                        <option>9</option>
                                                                        <option>10</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-4 col-sm-4">
                                                            <label for="name">Adults*</label>
                                                            <input type="text" class="form-control input-sm"
                                                                   id="name" placeholder="">
                                                        </div>
                                                        <div class="form-group col-md-4 col-sm-4">
                                                            <label for="name">Children</label>
                                                            <input type="text" class="form-control input-sm"
                                                                   id="name" placeholder="Age 5-12">
                                                        </div>
                                                        <div class="form-group col-md-4 col-sm-4">
                                                            <label for="name">Infants</label>
                                                            <input type="text" class="form-control input-sm"
                                                                   id="name" placeholder="Age < 5">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <br>
                                                <div class="col-md-12">
                                                    <h4><b>Personal Details</h4>
                                                    </b></div>
                                                <div class="form-group col-md-6 col-sm-6">
                                                    <label for="email">First Name*</label>
                                                    <input type="email" class="form-control input-sm" id="email"
                                                           placeholder="">
                                                </div>
                                                <div class="form-group col-md-6 col-sm-6">
                                                    <label for="email">Last Name*</label>
                                                    <input type="email" class="form-control input-sm" id="email"
                                                           placeholder="">
                                                </div>
                                                <div class="form-group col-md-6 col-sm-6">
                                                    <label for="email">Email*</label>
                                                    <input type="email" class="form-control input-sm" id="email"
                                                           placeholder="">
                                                </div>
                                                <div class="form-group col-md-6 col-sm-6">
                                                    <label for="email">Confirm Email*</label>
                                                    <input type="email" class="form-control input-sm" id="email"
                                                           placeholder="">
                                                </div>
                                                <div class="form-group col-md-12 col-sm-12">
                                                    <label for="email">Nationality*</label>
                                                    <select class="form-control input-sm" id="years">
                                                        <option>-- Select No of Year --</option>
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                        <option>4</option>
                                                        <option>5</option>
                                                        <option>6</option>
                                                        <option>7</option>
                                                        <option>8</option>
                                                        <option>9</option>
                                                        <option>10</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="row">
                                                        <div class="form-group col-md-3 col-sm-6">
                                                            <label for="city">Cell No *</label>
                                                            <select class="form-control input-sm" id="years">
                                                                <option>-- Select No of Year --</option>
                                                                <option>1</option>
                                                                <option>2</option>
                                                                <option>3</option>
                                                                <option>4</option>
                                                                <option>5</option>
                                                                <option>6</option>
                                                                <option>7</option>
                                                                <option>8</option>
                                                                <option>9</option>
                                                                <option>10</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-9 col-sm-6">
                                                            <label for="city">&nbsp;</label>
                                                            <input type="text" class="form-control input-sm"
                                                                   id="city" placeholder="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="row">
                                                        <div class="form-group col-md-3 col-sm-6">
                                                            <label for="city">Cell No2 *</label>
                                                            <select class="form-control input-sm" id="years">
                                                                <option>-- Select No of Year --</option>
                                                                <option>1</option>
                                                                <option>2</option>
                                                                <option>3</option>
                                                                <option>4</option>
                                                                <option>5</option>
                                                                <option>6</option>
                                                                <option>7</option>
                                                                <option>8</option>
                                                                <option>9</option>
                                                                <option>10</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-9 col-sm-6">
                                                            <label for="city">&nbsp;</label>
                                                            <input type="text" class="form-control input-sm"
                                                                   id="city" placeholder="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12 col-sm-12">
                                                    <label for="email">How Did You Discover Us *</label>
                                                    <select class="form-control input-sm" id="years">
                                                        <option>-- Select No of Year --</option>
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                        <option>4</option>
                                                        <option>5</option>
                                                        <option>6</option>
                                                        <option>7</option>
                                                        <option>8</option>
                                                        <option>9</option>
                                                        <option>10</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-12 col-sm-12">
                                                    <label for="address">Special Requests</label>
                                                    <textarea class="form-control input-sm" id="address"
                                                              rows="5"></textarea>
                                                </div>
                                                <div class="col-md-12">
                                                    <button type="button" class="btn main-btn-style">Confirm
                                                        Booking
                                                    </button>
                                                    &nbsp;
                                                    <button type="button" class="btn main-btn-style">Clear</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="tab2default">
                                        <?php //echo $tour_details['intro']; ?>
                                        <?php echo $tour_details['body']; ?>
                                    </div>
                                    <div class="tab-pane fade" id="tab3default">
                                        <div class="form-group col-md-6 col-sm-6">
                                            <label for="email">First Name*</label>
                                            <input type="email" class="form-control input-sm" id="email"
                                                   placeholder="">
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6">
                                            <label for="email">Last Name*</label>
                                            <input type="email" class="form-control input-sm" id="email"
                                                   placeholder="">
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6">
                                            <label for="email">Email*</label>
                                            <input type="email" class="form-control input-sm" id="email"
                                                   placeholder="">
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6">
                                            <label for="email">Phone Number</label>
                                            <input type="email" class="form-control input-sm" id="email"
                                                   placeholder="">
                                        </div>
                                        <div class="form-group col-md-12 col-sm-12">
                                            <label for="email">Nationality*</label>
                                            <select class="form-control input-sm" id="years">
                                                <option>-- Select No of Year --</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                                <option>6</option>
                                                <option>7</option>
                                                <option>8</option>
                                                <option>9</option>
                                                <option>10</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12 col-sm-12">
                                            <label for="address">Message:</label>
                                            <textarea class="form-control input-sm" id="address"
                                                      rows="5"></textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="button" class="btn main-btn-style">Send</button>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="tab4default">
                                        <div id="jssor_1"
                                             style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 800px; height: 456px; overflow: hidden; visibility: hidden; background-color: #24262e;">
                                            <!-- Loading Screen -->
                                            <div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
                                                <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
                                                <div style="position:absolute;display:block;background:url('<?php echo assets_url(); ?>images/img/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
                                            </div>
                                            <div data-u="slides"
                                                 style="cursor: default; position: relative; top: 0px; left: 0px; width: 800px; height: 356px; overflow: hidden;">
                                                <div data-p="144.50"><img data-u="image" src="<?php echo assets_url(); ?>images/img/01.jpg"/>
                                                    <img data-u="thumb" src="<?php echo assets_url(); ?>images/img/thumb-01.jpg"/></div>
                                                <div data-p="144.50" style="display:none;"><img data-u="image"
                                                                                                src="<?php echo assets_url(); ?>images/img/02.jpg"/>
                                                    <img data-u="thumb" src="<?php echo assets_url(); ?>images/img/thumb-02.jpg"/></div>
                                                <div data-p="144.50" style="display:none;"><img data-u="image"
                                                                                                src="<?php echo assets_url(); ?>images/img/03.jpg"/>
                                                    <img data-u="thumb" src="<?php echo assets_url(); ?>images/img/thumb-03.jpg"/></div>
                                                <a data-u="any" href="http://www.jssor.com" style="display:none">Image
                                                    Gallery</a>
                                                <div data-p="144.50" style="display:none;"><img data-u="image"
                                                                                                src="<?php echo assets_url(); ?>images/img/04.jpg"/>
                                                    <img data-u="thumb" src="<?php echo assets_url(); ?>images/img/thumb-04.jpg"/></div>
                                                <div data-p="144.50" style="display:none;"><img data-u="image"
                                                                                                src="<?php echo assets_url(); ?>images/img/05.jpg"/>
                                                    <img data-u="thumb" src="<?php echo assets_url(); ?>images/img/thumb-05.jpg"/></div>
                                                <div data-p="144.50" style="display:none;"><img data-u="image"
                                                                                                src="<?php echo assets_url(); ?>images/img/06.jpg"/>
                                                    <img data-u="thumb" src="<?php echo assets_url(); ?>images/img/thumb-06.jpg"/></div>
                                                <div data-p="144.50" style="display:none;"><img data-u="image"
                                                                                                src="<?php echo assets_url(); ?>images/img/07.jpg"/>
                                                    <img data-u="thumb" src="<?php echo assets_url(); ?>images/img/thumb-07.jpg"/></div>
                                                <div data-p="144.50" style="display:none;"><img data-u="image"
                                                                                                src="<?php echo assets_url(); ?>images/img/08.jpg"/>
                                                    <img data-u="thumb" src="<?php echo assets_url(); ?>images/img/thumb-08.jpg"/></div>
                                                <div data-p="144.50" style="display:none;"><img data-u="image"
                                                                                                src="<?php echo assets_url(); ?>images/img/09.jpg"/>
                                                    <img data-u="thumb" src="<?php echo assets_url(); ?>images/img/thumb-09.jpg"/></div>
                                                <div data-p="144.50" style="display:none;"><img data-u="image"
                                                                                                src="<?php echo assets_url(); ?>images/img/10.jpg"/>
                                                    <img data-u="thumb" src="<?php echo assets_url(); ?>images/img/thumb-10.jpg"/></div>
                                                <div data-p="144.50" style="display:none;"><img data-u="image"
                                                                                                src="<?php echo assets_url(); ?>images/img/11.jpg"/>
                                                    <img data-u="thumb" src="<?php echo assets_url(); ?>images/img/thumb-11.jpg"/></div>
                                                <div data-p="144.50" style="display:none;"><img data-u="image"
                                                                                                src="<?php echo assets_url(); ?>images/img/12.jpg"/>
                                                    <img data-u="thumb" src="<?php echo assets_url(); ?>images/img/thumb-12.jpg"/></div>
                                            </div>
                                            <!-- Thumbnail Navigator -->
                                            <div data-u="thumbnavigator" class="jssort01"
                                                 style="position:absolute;left:0px;bottom:0px;width:800px;height:100px;"
                                                 data-autocenter="1">
                                                <!-- Thumbnail Item Skin Begin -->
                                                <div data-u="slides" style="cursor: default;">
                                                    <div data-u="prototype" class="p">
                                                        <div class="w">
                                                            <div data-u="thumbnailtemplate" class="t"></div>
                                                        </div>
                                                        <div class="c"></div>
                                                    </div>
                                                </div>
                                                <!-- Thumbnail Item Skin End -->
                                            </div>
                                            <!-- Arrow Navigator -->
                                            <span data-u="arrowleft" class="jssora05l"
                                                  style="top:158px;left:8px;width:40px;height:40px;"></span> <span
                                                  data-u="arrowright" class="jssora05r"
                                                  style="top:158px;right:8px;width:40px;height:40px;"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <br>
                        <div class="details-share-div">
                            <a class="share-btn share-btn-branded share-btn-twitter" href="#" title="Share on Twitter"> <span
                                    class="share-btn-icon"></span> <span class="share-btn-text"><i
                                        class="fa fa-twitter" aria-hidden="true"></i> Twitter</span> 
                            </a>

                            <!-- Branded Facebook button -->
                            <a class="share-btn share-btn-branded share-btn-facebook"
                               href="#"
                               title="Share on Facebook"> <span class="share-btn-icon"></span> <span
                                    class="share-btn-text"><i class="fa fa-facebook" aria-hidden="true"></i> Facebook</span>
                            </a>

                            <!-- Branded Google+ button -->
                            <a class="share-btn share-btn-branded share-btn-googleplus"
                               href="#"
                               title="Share on Google+"> <span class="share-btn-icon"></span> <span
                                    class="share-btn-text"><i class="fa fa-google-plus" aria-hidden="true"></i> Google+</span>
                            </a>

                            <!-- Branded LinkedIn button -->
                            <a class="share-btn share-btn-branded share-btn-linkedin"
                               href="#"
                               title="Share on LinkedIn"> <span class="share-btn-icon"></span> <span
                                    class="share-btn-text"><i class="fa fa-linkedin" aria-hidden="true"></i> LinkedIn</span>
                            </a>

                            <!-- Branded Pinterest button -->
                            <a class="share-btn share-btn-branded share-btn-pinterest"
                               href="#"
                               title="Share on Pinterest"> <span class="share-btn-icon"></span> <span
                                    class="share-btn-text"><i class="fa fa-pinterest-p" aria-hidden="true"></i> Pinterest</span>
                            </a>
                        </div>
                    </div>

                    <div class="details-div-last">
                        <h3>You May Also Like</h3>
                        <br>
                        <div class="col-md-4">
                            <div class="item-main-div1"><img src="<?php echo assets_url(); ?>images/carous1/fit (1).jpg"
                                                             class="img-responsive item-1-img">
                                <div class="price-first-position">
                                    <div class="price-div-bg-text">
                                        <center>
                                            <h4><b>AED 580</b></h4>
                                            <h5><b>USD 159</b></h5>
                                        </center>
                                    </div>
                                </div>
                                <div class="item-head-1">
                                    <center>
                                        <h4 class="atgrid__item__title"><a href="#">4 Hours Dubai Private Tour</a>
                                        </h4>
                                    </center>
                                </div>
                                <div class="item--footer-1">
                                    <div class="col-md-6"><i class="fa fa-clock-o" aria-hidden="true"></i> &nbsp;4
                                        Hours
                                    </div>
                                    <div class="col-md-6"><a href="#">Read More <i class="fa fa-long-arrow-right"
                                                                                   aria-hidden="true"></i></a></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="item-main-div1"><img src="<?php echo assets_url(); ?>images/carous1/fit (2).jpg"
                                                             class="img-responsive item-1-img">
                                <div class="price-first-position">
                                    <div class="price-div-bg-text">
                                        <center>
                                            <h4><b>AED 580</b></h4>
                                            <h5><b>USD 159</b></h5>
                                        </center>
                                    </div>
                                </div>
                                <div class="item-head-1">
                                    <center>
                                        <h4 class="atgrid__item__title"><a href="#">4 Hours Dubai Private Tour</a>
                                        </h4>
                                    </center>
                                </div>
                                <div class="item--footer-1">
                                    <div class="col-md-6"><i class="fa fa-clock-o" aria-hidden="true"></i> &nbsp;4
                                        Hours
                                    </div>
                                    <div class="col-md-6"><a href="#">Read More <i class="fa fa-long-arrow-right"
                                                                                   aria-hidden="true"></i></a></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="item-main-div1"><img src="<?php echo assets_url(); ?>images/carous1/fit (7).jpg"
                                                             class="img-responsive item-1-img">
                                <div class="price-first-position">
                                    <div class="price-div-bg-text">
                                        <center>
                                            <h4><b>AED 580</b></h4>
                                            <h5><b>USD 159</b></h5>
                                        </center>
                                    </div>
                                </div>
                                <div class="item-head-1">
                                    <center>
                                        <h4 class="atgrid__item__title"><a href="#">4 Hours Dubai Private Tour</a>
                                        </h4>
                                    </center>
                                </div>
                                <div class="item--footer-1">
                                    <div class="col-md-6"><i class="fa fa-clock-o" aria-hidden="true"></i> &nbsp;4
                                        Hours
                                    </div>
                                    <div class="col-md-6"><a href="#">Read More <i class="fa fa-long-arrow-right"
                                                                                   aria-hidden="true"></i></a></div>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>
</div>