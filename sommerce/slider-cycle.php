<?php 
/**
 * @package WordPress
 * @subpackage Sommerce
 * @since 1.0
 */
 
if ( yiw_is_empty() )
    return;
?>
 
        <!-- START SLIDER -->
        <div id="slider" class="cycle group inner">
                
                <div class="images">
                    <?php while( yiw_have_slide() ) : ?>
                    <!-- START PANEL -->
                    <div<?php yiw_slide_class( 'panel' ) ?>>
                        <?php yiw_slide_the( 'featured-content', array(
                                 'container' => false,
                                 'video_width' => 439,
                                 'video_height' => 245
                              ) ) ?>                        
                        <div class="hentry">
                            <h2><?php yiw_slide_the( 'title' ) ?></h2>
                                                                                       
                            <?php yiw_slide_the( 'content' ) ?>
                        </div>
                    </div>
                    <!-- END PANEL -->
                    <?php endwhile; ?>
                </div>
                
                <!-- START PAGINATION -->
                <div class="controls">
                    <a href="#" title="Pause" id="slider-pause"><img src="<?php echo get_template_directory_uri() . '/images/icons/slider-pause.png' ?>" alt="Pause" /></a>
                    <a href="#" title="Play" id="slider-play"><img src="<?php echo get_template_directory_uri() . '/images/icons/slider-play.png' ?>" alt="Play" /></a> 
                </div>
                <div class="pagination"></div>
                <!-- END PAGINATION -->  

        </div> 
        <!-- END SLIDER --> 
        