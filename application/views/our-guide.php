<style type="text/css">
    .no-click{
        pointer-events: none !important;
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
                <?php $this->load->view('common/left-ad'); ?>
            </div>
            <div class="col-md-9">


                <div class="row">
                    <div id="content-wrap1">

                        <div class="panel with-nav-tabs panel-default">
                            <div class="panel-heading">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab1default" data-toggle="tab">Our Guides</a></li>

                                    <li><a href="#tab12default" data-toggle="tab">Ask Questions</a></li>

                                </ul>
                            </div>
                            <div class="panel-body">
                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="tab1default">
                                        <div class="col-md-12">
                                            <div class="title title--big title--center title--underline title--decoration-bottom-center">
                                                <h3 class="title__primary">OUR GUIDES</h3>
                                            </div>
                                            <div class="clearfix"></div>
                                            <?php echo $contents['our_guide']; ?>
                                            <div class="clearfix"></div>
                                            <br>
                                            <ul class="flags">
                                                <li>
                                                    <img alt="" class="no-click" src="<?php echo_image('images/flags/en_usa.png'); ?>">ENGLISH
                                                </li>
                                                <li>
                                                    <img alt="" class="no-click" src="<?php echo_image('images/flags/en_british.png'); ?>">ENGLISH
                                                </li>
                                                <li>
                                                    <img alt="" class="no-click"  src="<?php echo_image('images/flags/italian.png'); ?>">ITALIAN
                                                </li>
                                                <li>
                                                    <img alt="" class="no-click"  src="<?php echo_image('images/flags/german.png'); ?>">GERMAN
                                                </li>
                                                <li>
                                                    <img alt="" class="no-click" src="<?php echo_image('images/flags/portuguese.png'); ?>">PORTUGUESE
                                                </li>
                                                <li>
                                                    <img alt="" class="no-click" src="<?php echo_image('images/flags/spanish.png'); ?>">SPANISH
                                                </li>
                                                <li>
                                                    <img alt="" class="no-click" src="<?php echo_image('images/flags/french.png'); ?>">FRENCH
                                                </li>
                                                <li>
                                                    <img alt="" class="no-click" src="<?php echo_image('images/flags/dutch.png'); ?>">DUTCH
                                                </li>
                                                <li>
                                                    <img alt="" class="no-click" src="<?php echo_image('images/flags/greek.png'); ?>">GREEK
                                                </li>
                                                <li>
                                                    <img alt="" class="no-click" src="<?php echo_image('images/flags/turkish.png'); ?>">TURKISH
                                                </li>
                                                <li>
                                                    <img alt="" class="no-click" src="<?php echo_image('images/flags/malay.png'); ?>">MALAY
                                                </li>
                                                <li>
                                                    <img alt="" class="no-click" src="<?php echo_image('images/flags/bahasa.png'); ?>">BAHASA
                                                </li>
                                                <li>
                                                    <img alt="" class="no-click" src="<?php echo_image('images/flags/japanese.png'); ?>">JAPANES
                                                </li>
                                                <li>
                                                    <img alt="" class="no-click" src="<?php echo_image('images/flags/russian.png'); ?>">RUSSIAN
                                                </li>
                                                <li>
                                                    <img alt="" class="no-click" src="<?php echo_image('images/flags/chinese.png'); ?>">CHINESE
                                                </li>
                                            </ul>

                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="tab12default">
                                        <?php $this->load->view('contact-form'); ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <br>
                        <div class="details-share-div">
                            <?php $this->load->view('addthis'); ?>
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
