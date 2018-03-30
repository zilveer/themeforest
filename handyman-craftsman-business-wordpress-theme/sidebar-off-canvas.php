<?php
use \Handyman\Front as F;

    $social_fb = layers_get_theme_mod('social-fb');
    $social_tw = layers_get_theme_mod('social-tw');
    $social_yt = layers_get_theme_mod('social-yt');

    $pinterest = layers_get_theme_mod("social-pinterest");
    $glplus    = layers_get_theme_mod("social-glplus");
    $linkin    = layers_get_theme_mod("social-linkin");
    $instagram = layers_get_theme_mod("social-instagram");
    $tumblr    = layers_get_theme_mod("social-tumblr");
    $flickr    = layers_get_theme_mod("social-flickr");
    $reddit    = layers_get_theme_mod("social-reddit");
?>
<div class="wrapper invert off-canvas-right" id="off-canvas-right">
    <a class="close-canvas l-close" data-toggle="#off-canvas-right" data-toggle-class="open"></a>
    <div class="grid content nav-mobile">
        <?php wp_nav_menu( [ 'theme_location' => LAYERS_THEME_SLUG . '-primary' ,
                                  'container' => 'nav',
                                  'container_class' => 'nav nav-vertical',
                                  'fallback_cb' => create_function('', 'echo "&nbsp";')]);
        ?>
    </div>

    <?php if(!layers_get_theme_mod('social-hide-in-mobile-menu')): ?>

    <div class="header-contact">
        <ul>
            <?php if($social_tw): ?><li><a target="_blank" href="<?php echo esc_url($social_tw); ?>" title="Tweeter"><i class="icon-ti-twitter-alt"></i></a></li><?php endif; ?>
            <?php if($social_fb): ?><li><a target="_blank" href="<?php echo esc_url($social_fb); ?>" title="Facebook"><i class="icon-ti-facebook"></i></a></li><?php endif; ?>
            <?php if($social_yt): ?><li><a target="_blank" href="<?php echo esc_url($social_yt); ?>" title="Youtube"><i class="icon-ti-youtube"></i></a></li><?php endif; ?>
            <?php if($pinterest): ?><li><a target="_blank" href="<?php echo esc_url($pinterest); ?>" title="Youtube"><i class="icon-ti-pinterest-alt"></i></a></li><?php endif; ?>
            <?php if($glplus): ?><li><a target="_blank" href="<?php echo esc_url($glplus); ?>" title="Google Plus"><i class="icon-ti-google"></i></a></li><?php endif; ?>
            <?php if($linkin): ?><li><a target="_blank" href="<?php echo esc_url($linkin); ?>" title="LinkedIn"><i class="icon-ti-linkedin"></i></a></li><?php endif; ?>
            <?php if($instagram): ?><li><a target="_blank" href="<?php echo esc_url($instagram); ?>" title="Instagram"><i class="icon-ti-instagram"></i></a></li><?php endif; ?>
            <?php if($tumblr): ?><li><a target="_blank" href="<?php echo esc_url($tumblr); ?>" title="Tumblr"><i class="icon-ti-tumblr-alt"></i></a></li><?php endif; ?>
            <?php if($flickr): ?><li><a target="_blank" href="<?php echo esc_url($flickr); ?>" title="flickf"><i class="icon-ti-flickr-alt"></i></a></li><?php endif; ?>
            <?php if($reddit): ?><li><a target="_blank" href="<?php echo esc_url($reddit); ?>" title="Reddit"><i class="icon-ti-reddit"></i></a></li><?php endif; ?>
        </ul>
    </div>
    <?php endif; ?>
    <?php dynamic_sidebar( LAYERS_THEME_SLUG . '-off-canvas-sidebar' ); ?>
</div>