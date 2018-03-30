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
        <div id="slider" class="group inner">
        	<ul class="group">
                <?php while( yiw_have_slide() ) : ?>
	                
	            <li<?php yiw_slide_class( 'group' ) ?>>    
					<div class="slider-featured group"><?php yiw_slide_the( 'featured-content', array( 'container' => false ) ) ?></div>   
	                <?php if ( yiw_slide_get( 'content' ) != '' ) : ?>
	                <div class="slider-caption caption-<?php echo yiw_get_option( 'slider_elegant_caption_position' ) ?>">
	                    <!-- TITLE -->
						<?php yiw_string_( '<h2>', yiw_slide_get( 'title' ), '</h2>' ) ?>
						<?php yiw_string_( '<h4>', yiw_slide_get( 'subtitle' ), '</h4>' ) ?>
	                    
	                    <!-- TEXT -->
						<?php yiw_slide_the( 'content' ) ?>
	                </div>
	                <?php endif; ?>
	            </li>
				<?php endwhile; ?>
			</ul>
        </div> 
        <!-- END SLIDER --> 