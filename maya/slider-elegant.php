<?php 
/**
 * @package WordPress
 * @subpackage Sheeva
 * @since 1.0
 */
 ?>
 
        <!-- START SLIDER -->
        <div id="slider" class="slider_elegant group inner">
            <ul class="group">
                <?php while( yiw_have_slide() ) : ?>
                    <li class="group">
                        <div class="slider-featured group">
                        <?php yiw_slide_the( 'featured-content', array(
                                 'container' => false,
                                 'video_width' => 439,
                                 'video_height' => 245
                              ) )
                        ?> 
                        </div>
                        
                        <?php if( yiw_slide_get( 'content' ) ): ?>
                        <div class="slider-caption caption-<?php echo yiw_get_option( 'slider_elegant_caption_position' ) ?>">
                                <h2><?php yiw_slide_the( 'title' ) ?></h2>
                                <h4><?php yiw_slide_the( 'subtitle' ) ?></h4>
                                <?php yiw_slide_the( 'content' ) ?>
                        </div>
                        <?php endif ?>
                    </li>
                <?php endwhile; ?>
            </ul>
        </div> 
        <!-- END SLIDER --> 