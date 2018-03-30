<?php
/**
 * Created by Clapat.
 * Date: 01/02/15
 * Time: 1:54 PM
 */

global $clapat_bg_theme_options;


require_once ( get_template_directory() . '/include/util_functions.php');

?>


			<!-- Full Screen Slider -->
        	<div class="clapat-slider">

                    <?php

                    $args = array(
                        'post_type' => THEME_ID . '_main_slider',
                        'orderby'   => 'menu_order',
                        'order'     => 'ASC',
						'posts_per_page' => -1
                    );

                    $query_slides = new WP_Query( $args );

                    if( $query_slides->have_posts() ){

                    ?>

                <ul class="slides">

                    <?php

                        while ( $query_slides->have_posts() ) {

                            $query_slides->the_post();

                            $image = redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-slider-image');
                            $image_path   = trim( $image['url'] );

                            $bknd_repeat  = redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-slider-bknd-repeat' );
                            $style_repeat = '';
                            if( $bknd_repeat ){

                                $style_repeat = 'background-repeat: repeat; ';
                            }

                            $caption_alignment = redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-slider-caption-alignment' );

                            $overlay_color   = redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-slider-overlay-color' );
                            $overlay_opacity = redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-slider-overlay-opacity' );
                            $overlay_rgba    = hex2rgba( $overlay_color, $overlay_opacity );

                            $content_type    = redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-slider-content-type' );
                            $class_content_type = '';
							$class_slide_background = '';
                            if( $content_type == 'light' ){

                                $class_content_type = ' light-content';
								$class_slide_background = 'class="dark-bg" ';
                            }

                    ?>

                        <!-- Slide -->
                        <li <?php echo $class_slide_background; ?> style="<?php echo $style_repeat; ?>background-image:url(<?php echo esc_url( $image_path ); ?>)">

                            <div class="overlay" style="background-color:<?php echo $overlay_rgba; ?>">


                                <!-- Slide Caption -->
                                <div class="clapat-caption<?php echo $class_content_type; ?>">
                                    <div class="caption-content <?php echo $caption_alignment; ?>">
                                        <?php the_content(); ?>
                                    </div>
                                </div>
                                <!--/Slide Caption -->


                            </div>

                        </li>
                        <!--/Slide -->

                    <?php

                        } // while posts

                    ?>

                </ul>

                    <?php
                    }
                    else{

                        _e('There are no slides defined. You can create them in admin dashboard under Main Slider.', THEME_LANGUAGE_DOMAIN );
                    }

                    wp_reset_postdata();

                    ?>

            </div>
			<?php if( !$clapat_bg_theme_options['clapat_bg_slider_arrow_cursor'] ) { ?>
			<div id="static-slider-nav"></div>
			<?php } ?>
            <!-- /Full Screen Slider -->