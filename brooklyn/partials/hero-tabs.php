<?php
/**
 * The Template for displaying Tab Hero
 *
 * @author 		United Themes
 * @package 	Brooklyn
 * @version     1.0
 */

/* template config: content */
$ut_custom_slogan           = ut_return_hero_config('ut_custom_slogan');
$ut_expertise_slogan 	    = ut_return_hero_config('ut_expertise_slogan');
$ut_company_slogan 	    	= ut_return_hero_config('ut_company_slogan');
$ut_catchphrase 		    = ut_return_hero_config('ut_catchphrase');

/* template config: effects */
$ut_company_slogan_glow = ut_return_hero_config('ut_company_slogan_glow' , 'off') == 'on' ? 'ut-glow' : '';

/* template config: canvas color */
$ut_accentcolor             = get_option('ut_accentcolor' , '#F1C40F');
$ut_effect_color            = ut_return_hero_config('ut_hero_overlay_effect_color');
$ut_effect_color            = !empty($ut_effect_color) ? $ut_effect_color : $ut_accentcolor;

/* template config: pattern */
$ut_hero_overlay_pattern    = ut_return_hero_config('ut_hero_overlay_pattern' , 'on') == 'on' ? 'parallax-overlay-pattern' : '';

/* template config: main button */
$ut_main_hero_button = ut_return_hero_config('ut_main_hero_button');
if( !empty( $ut_main_hero_button ) ) {
    $ut_main_hero_button_url_type    = ut_return_hero_config('ut_main_hero_button_url_type', 'section');    
    $ut_main_hero_button_target	     = ut_return_hero_config('ut_main_hero_button_target' , '#ut-to-first-section');
    $ut_main_hero_button_link_target = ut_return_hero_config('ut_main_hero_button_link_target');
    $ut_main_hero_button_style       = ut_return_hero_config('ut_main_hero_button_style' , 'default');
    $ut_main_hero_button_settings    = ut_return_hero_config('ut_main_hero_button_settings');
}

/* template config: second button */ 
$ut_second_hero_button = ut_return_hero_config('ut_second_hero_button' , 'off');
if( $ut_second_hero_button == 'on' ) {    
    $ut_second_hero_button_text     = ut_return_hero_config('ut_second_hero_button_text');
    $ut_second_hero_button_url_type = ut_return_hero_config('ut_second_hero_button_url_type', 'page');
    $ut_second_hero_button_target   = ut_return_hero_config('ut_second_hero_button_target');
    $ut_second_hero_button_url      = ut_return_hero_config('ut_second_hero_button_url');
    $ut_second_hero_button_style    = ut_return_hero_config('ut_second_hero_button_style' , 'default'); 
    $ut_second_hero_button_settings = ut_return_hero_config('ut_second_hero_button_settings');	
}

/* template config: tabs */ 
$ut_tabs_headline               = ut_return_hero_config('ut_tabs_headline');
$ut_tabs                        = ut_return_hero_config('ut_tabs');

/* tablet color and shadow */
$ut_tabs_tablet_color  = ut_return_hero_config('ut_tabs_tablet_color', 'black');
$ut_tabs_tablet_shadow = ut_return_hero_config('ut_tabs_tablet_shadow', 'off') == 'on' ? 'shadow' : '';

?>
<!-- hero section -->
<section id="ut-hero" class="hero ha-waypoint parallax-section parallax-background" data-animate-up="ha-header-hide" data-animate-down="ha-header-hide">
    
    <div class="parallax-scroll-container"></div>
    
    <?php /* overlay animation effect for hero */ 
    if( ut_return_hero_config('ut_hero_overlay_effect') == 'on') : ?>
    
        <canvas data-strokecolor="<?php echo ut_hex_to_rgb($ut_effect_color); ?>" id="ut-animation-canvas"></canvas>        
    
    <?php endif; ?>
    
    
    <?php /* overlay effect for hero */ 
    if( ut_return_hero_config('ut_hero_overlay') == 'on') : ?>
        
        <div class="parallax-overlay <?php echo $ut_hero_overlay_pattern; ?> <?php echo ut_return_hero_config('ut_hero_overlay_pattern_style' , 'style_one'); ?>">
        
    <?php endif; ?>
        
    <?php /* main output for hero */ ?>
    
    <div class="grid-container">
        
        <!-- hero holder -->
        <div class="hero-holder ut-half-height grid-100 mobile-grid-100 tablet-grid-100 <?php echo ut_return_hero_config('ut_hero_style' , 'ut-hero-style-1'); ?>">
            <div class="hero-inner" style="text-align:<?php echo ut_return_hero_config('ut_hero_align' , 'center'); ?>;">                
                
                <?php if( !empty($ut_expertise_slogan) ) : ?>
                    <div class="hdh"><span class="hero-description"><?php echo do_shortcode( nl2br( $ut_expertise_slogan ) ); ?></span></div>
                <?php endif; ?>
                                
                <?php if( !empty($ut_company_slogan) ) : ?>
                    <div class="hth"><h1 class="hero-title <?php echo $ut_company_slogan_glow; ?>"><?php echo do_shortcode( nl2br( $ut_company_slogan ) ); ?></h1></div>
                <?php endif; ?>
                
                <?php if( !empty($ut_catchphrase) ) : ?>
                    <div class="hdb"><span class="hero-description-bottom"><?php echo do_shortcode( nl2br( $slide['catchphrase'] ) ); ?></span></div>
                <?php endif; ?>
                
                <?php if( !empty($ut_main_hero_button) ) : ?>
                        
                        <span class="hero-btn-holder">
                            
                            <a id="to-about-section" target="<?php echo ut_clean_section_id($ut_main_hero_button_link_target); ?>" href="<?php echo $ut_main_hero_button_url_type == 'section' ? ut_clean_section_id( $ut_main_hero_button_target ) : $ut_main_hero_button_target; ?>" class="hero-btn <?php echo $ut_main_hero_button_style; ?>">
                            
                                <?php if( $ut_main_hero_button_style == 'custom' ) : ?>                                        
                                    
                                    <?php echo !empty($ut_main_hero_button_settings['icon']) ? '<i class="fa ' . $ut_main_hero_button_settings['icon'] . '"></i>' : ''; ?> 
                                    
                                <?php endif; ?>
                                
                                <?php echo ut_translate_meta($ut_main_hero_button); ?>
                            
                            </a>
                            
                            <?php if( $ut_second_hero_button == 'on' ) : ?>
                        
                                <a href="<?php echo $ut_second_hero_button_url_type == 'section' ? ut_clean_section_id( $ut_second_hero_button_url ) : $ut_second_hero_button_url; ?>" class="hero-second-btn <?php echo $ut_second_hero_button_style; ?>" target="<?php echo $ut_second_hero_button_target; ?>">
                                    
                                <?php if( $ut_second_hero_button_style == 'custom' ) : ?>                                        
                            
                                    <?php echo !empty($ut_second_hero_button_settings['icon']) ? '<i class="fa ' . $ut_second_hero_button_settings['icon'] . '"></i>' : ''; ?> 
                                    
                                <?php endif; ?>
                                
                                <?php echo ut_translate_meta($ut_second_hero_button_text); ?>                                        
                                
                                </a>
                        
                            <?php endif; ?> 
                        
                        </span>
                        
                    <?php endif; ?>
                
            </div>
        </div><!-- close hero-holder -->
        
        <div class="ut-tablet-holder ut-half-height hide-on-mobile">
            
            <div class="ut-tablet-inner">
                
                <div class="grid-40 suffix-5 mobile-grid-100 tablet-grid-40 tablet-suffix-5">
                    
                    <?php if( !empty( $ut_tabs_headline  ) ) : ?>
                        
                        <h2 class="ut-tablet-title"><?php echo ut_translate_meta( $ut_tabs_headline  ); ?></h2>
                        
                    <?php endif;?>
                                        
                    <?php if( !empty($ut_tabs) && is_array($ut_tabs) ) : ?>
                        
                        <ul class="ut-tablet-nav">
                            
                        <?php $counter = 1; foreach($ut_tabs as $tab) : ?>
                            
                            <?php if( !empty( $tab['title'] ) ) : ?>
                                    
                                <li class="<?php echo ($counter == 1) ? 'selected' : ''; ?>"><a href="#"><?php echo ut_translate_meta( $tab['title'] ); ?></a></li>
                            
                            <?php endif; ?>
                            
                        <?php $counter++; endforeach; ?>
                        
                        </ul>
                    
                    <?php endif; ?>
                        
                </div>
                
                <div class="grid-55 mobile-grid-100 tablet-grid-55">
                    
                    <?php if( !empty($ut_tabs) && is_array($ut_tabs) ) : ?>
                        
                        <ul class="ut-tablet <?php echo esc_attr( $ut_tabs_tablet_color ); ?> <?php echo esc_attr( $ut_tabs_tablet_shadow ); ?>">
                            
                        <?php $counter = 1; foreach($ut_tabs as $tab) : ?>
                                    
                            <li class="<?php echo ($counter == 1) ? 'show' : ''; ?>">
                                
                                <?php 
                                
                                $tab_image = ut_resize( ut_translate_meta( $tab['image'] ) , '800' , '800', true , true , true ); 
                                
                                if( !$tab_image && function_exists( 'vc_asset_url' ) ) {
                                
                                    $tab_image = vc_asset_url( 'vc/no_image.png' );    
                                
                                }
                                
                                ?>
                                
                                <img src="<?php echo $tab_image; ?>" alt="<?php echo $tab['title']; ?>">
                                
                                <div class="ut-tablet-overlay">
                                    
                                    <div class="ut-tablet-overlay-content-wrap">
                                    
                                        <div class="ut-tablet-overlay-content">
                                        
                                        <?php if( !empty( $tab['title'] ) ) : ?>
                                        
                                            <h2 class="ut-tablet-single-title"><?php echo ut_translate_meta( $tab['title'] ); ?></h2>
                                        
                                        <?php endif; ?>
                                        
                                        <?php if( !empty( $tab['description'] ) ) : ?>
                                            
                                            <p class="ut-tablet-desc"><?php echo ut_translate_meta( $tab['description'] ); ?></p>
                                            
                                        <?php endif; ?>
                                        
                                        <?php if( !empty( $tab['link_one_text'] ) ) : ?>
                                            
                                            <a class="ut-btn ut-left-tablet-button theme-btn small round" href="<?php echo ut_translate_meta( $tab['link_one_url'] ); ?>"><?php echo ut_translate_meta( $tab['link_one_text'] ); ?></a>
                                            
                                        <?php endif; ?>
                                        
                                        <?php if( !empty( $tab['link_two_text'] ) ) : ?>
                                            
                                            <a class="ut-btn ut-right-tablet-button theme-btn small round" href="<?php echo ut_translate_meta( $tab['link_two_url'] ); ?>"><?php echo ut_translate_meta( $tab['link_two_text'] ); ?></a>
                                            
                                        <?php endif; ?>
                                        
                                        </div>
                                    
                                    </div>
                                    
                                </div>
                            
                            </li>
                    
                        <?php $counter++; endforeach; ?>
                        
                        </ul>
                        
                    <?php endif; ?>
                    
                </div>
        
            </div>
            
        </div>
        
    </div>                
    
    <?php /* overlay effect for hero */ ?>
    
    <?php if( ut_return_hero_config('ut_hero_overlay') == 'on') : ?>
    
        </div> 
    
    <?php endif; ?>
    
    <div data-section="top" class="ut-scroll-up-waypoint"></div>
    
</section>
<!-- end hero section -->
