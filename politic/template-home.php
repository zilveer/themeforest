<?php
/*
Template Name: Home
*/
?>

<?php get_header(); ?>
        
        <!--START .container -->
        <div class="container slider-and-newsletter">
            
            <!--START SLIDER -->
            <div class="eleven columns">
                <?php 
                    $sliderEnabled = get_option('icy_enable_slider');
                    //Checking if slider is enabled / If Yes, Include it!
                    if($sliderEnabled == 'true') get_template_part('/includes/home-slider'); ?>            
            <!-- END SLIDER -->
            </div>

            <!-- START NEWSLETTER -->
                <!-- BEGIN .widget-section -->
                <div class="widget-section no-bottom">

                    <?php /* Widgetised Area */ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'Homepage Newsletter' ) ) ?>
                            
                <!-- END .widget-section -->   
                </div>
            <!--END NEWSLETTER -->


        <!--END .container -->            
        </div>
        <div class="shadow-separator"></div>
        
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <div class="container">    
            <!--BEGIN #main-content -->
            <section class="main-content full-width home-call">         

                <div class="homepage-widget-area">
                    
                    <!-- First ROW OF WIDGETS -->
                    <section class="main-content-widgets eleven columns no-bottom"> 
                          <?php /* Widgetised Area */ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'Homepage Widgets - First Row - 2/3' ) ) ?>
                    </section>
                    
                    <aside class="main-content-widgets five columns no-bottom"> 
                          <?php /* Widgetised Area */ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'Homepage Widgets - First Row - 1/3' ) ) ?>
                    </aside>
                    <!-- END First Row of Widgets -->

                    <!-- START Second Row Of WIDGETS -->
                    <section class="secondary-row-widgets six columns">
                        <?php /* Widgetised Area */ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'Homepage Widgets - Second Row - 1 of 3' ) ) ?>
                    </section>
                    <section class="secondary-row-widgets five columns">
                        <?php /* Widgetised Area */ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'Homepage Widgets - Second Row - 2 of 3' ) ) ?>
                    </section>
                    <section class="secondary-row-widgets five columns">
                        <?php /* Widgetised Area */ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'Homepage Widgets - Second Row - 3 of 3' ) ) ?>
                    </section>
                    <!-- END Second Row of Widgets -->

                </div>
    
            <?php the_content(); ?>

            </section>

        <!--END .container-->        
        </div>
            
    <?php endwhile; ?>

    <?php endif; ?>            


    

<?php get_footer(); ?>