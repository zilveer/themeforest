<?php
/**
 * The Template for displaying the Fancy Image Slider
 *
 * @author 		United Themes
 * @package 	Brooklyn
 * @version     1.0
 */

/* template config */
$ut_fancy_slider_slides  = ut_return_hero_config( 'ut_fancy_slider_slides' );
$ut_fancy_slider_effect  = ut_return_hero_config( 'ut_fancy_slider_effect' , 'fxSoftScale' );
?>

<!-- hero section -->
<section class="ha-waypoint" data-animate-up="ha-header-hide" data-animate-down="ha-header-hide">
    
    <?php if( !empty($ut_fancy_slider_slides) && is_array($ut_fancy_slider_slides) ) : ?>
        
    <!-- slider -->
    <div id="ut-fancy-slider" class="ut-fancy-slider ut-fancy-slider-fullwidth <?php echo $ut_fancy_slider_effect; ?>">
        
        <ul class="ut-fancy-slides">
            
            <?php $slidecount = 1; ?>
            
            <?php foreach( $ut_fancy_slider_slides as $slide ) : ?>
            
                <li <?php echo $slidecount==1 ? 'class="current"' : ''; ?>>
                        
                    <?php 
                    
                    /* single caption settings */
                    $style = ( !empty($slide['style']) && $slide['style'] != 'global') ? $slide['style'] : ut_return_hero_config('ut_hero_style' , 'ut-hero-style-1');
                    $fontstyle = ( !empty($slide['font_style']) && $slide['font_style'] != 'global') ? $slide['font_style'] : ut_return_hero_config('ut_hero_font_style' , 'semibold');
                    
                    if( !empty( $slide['font_style'] ) && $slide['font_style'] == 'global' && ot_get_option('ut_front_hero_font_type' , 'ut-font') == 'ut-google' ) {
                        $fontstyle = NULL;
                    }
                    
                    $link_description = !empty($slide['link_description']) ? $slide['link_description'] : '';
                    
                    if( !empty( $slide['scroll_to_target'] ) ) {
                                                        
                        $slidelink = '#section-' . ut_get_the_slug($slide['scroll_to_target']);  
                                                      
                    } elseif( !empty($link_description) ) {  
                                                  
                        $slidelink = !empty($slide['link']) ? $slide['link'] : '#ut-to-first-section';  
                                                  
                    }
                    
                    ?>                
                                                                    
                    <div class="grid-container">
                        <!-- hero holder -->
                        <div class="hero-holder grid-100 mobile-grid-100 tablet-grid-100 <?php echo $style; ?>">
                            <div class="hero-inner" style="text-align:<?php echo $slide['align']; ?>">                
                                
                                <?php if( !empty($slide['expertise']) ) : ?>
                                    <div class="hdh"><span class="hero-description"><?php echo do_shortcode( nl2br( $slide['expertise'] ) ); ?></span></div>
                                <?php endif; ?>
                                                
                                <?php if( !empty($slide['description']) ) : ?>
                                    <div class="hth"><h1 class="hero-title <?php echo $fontstyle; ?>"><?php echo do_shortcode( nl2br( $slide['description'] ) ); ?></h1></div>
                                <?php endif; ?>
                                
                                <?php if( !empty($slide['catchphrase']) ) : ?>
                                    <div class="hdb"><span class="hero-description-bottom"><?php echo do_shortcode( nl2br( $slide['catchphrase'] ) ); ?></span></div>
                                <?php endif; ?>
                                
                                <?php if( !empty($link_description) ) : ?>
                                    <span class="hero-btn-holder"><a target="_blank" href="<?php echo $slidelink; ?>" class="hero-btn hero-slider-button"><?php echo ut_translate_meta($link_description); ?></a></span>
                                <?php endif; ?>    
                                                               
                            </div>
                        </div><!-- close hero-holder -->
                    </div>
                    
                    <img alt="<?php echo !empty($slide['title']) ? ut_translate_meta($slide['title']) : ''; ?>" src="<?php echo ut_translate_meta($slide['image']); ?>">

                </li>
            
            <?php $slidecount++; endforeach; ?>
            
        </ul>
        
        <nav>
            <a class="prev" href="#"><?php _e('Previous item' , 'unitedthemes'); ?></a>
            <a class="next" href="#"><?php _e('Next item' , 'unitedthemes'); ?></a>
        </nav>
        
    </div>
    
    <?php endif; ?>

</section>
<!-- end hero section -->