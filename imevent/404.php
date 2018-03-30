<?php
get_header(); ?>

<div id="main">
        <!-- SLIDER -->
        <section class="page-section no-padding color">
            <div class="container">

                <div id="main-slider">

                    <!-- Slide -->
                    <div class="item page text-center slide0">
                        <div class="caption">
                            <div class="container">
                                <div class="div-table">
                                    <div class="div-cell">
                                        <h3 class="caption-subtitle" data-animation="fadeInUp" data-animation-delay="300"><i class="fa fa-warning"></i></h3>
                                        <h3 class="caption-subtitle" data-animation="fadeInUp" data-animation-delay="300"><?php _e('Error 404', TEXT_DOMAIN); ?></h3>
                                        <h2 class="caption-title" data-animation="fadeInDown" data-animation-delay="100"><?php _e('Page not Found', TEXT_DOMAIN); ?></h2>
                                        <p class="caption-text">
                                            <a class="btn btn-theme btn-theme-xl scroll-to" href="<?php echo home_url(); ?>" data-animation="flipInY" data-animation-delay="600"> <?php _e('Go to Homepage', TEXT_DOMAIN); ?> <i class="fa fa-arrow-circle-right"></i></a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section>
        <!-- /SLIDER -->
        </div>
    
<?php
get_footer(); ?>