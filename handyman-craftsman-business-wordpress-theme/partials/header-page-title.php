<?php
use \Handyman\Front as F;
/**
 * This partial is used for displaying the Site Header when in archive pages
 *
 * @package Layers
 * @since Layers 1.0.0
 */
global $layers_page_title_shown;
$layers_page_title_shown = 1;

$teaser_align = F\tl_copt('teaser-align');

// Set inline CSS styles
layers_inline_styles(array('selectors' => array('.header-site'),
                      'css'       => array('background-color' => F\tl_copt('theme-secondary-color') .' !important')));

/**
* Fetch the site title array
*/
$details = F\tl_layers_get_page_title();

if( isset( $details[ 'title' ] )) { ?>
	<div <?php layers_wrapper_class( 'title_container', 'title-container' ); ?>>
		<?php do_action('layers_before_header_page_title'); ?>
		<div class="title <?php echo esc_attr($teaser_align)?>">
			<?php

			if( isset( $details[ 'title' ] ) && '' != $details[ 'title' ] ) { ?>
				<?php do_action('layers_before_title_heading'); ?>
				<h3 class="heading"><?php echo $details[ 'title' ]; ?></h3>
				<?php do_action('layers_after_title_heading'); ?>
			<?php } // if isset $title
            /**
             * Display Breadcrumbs
             */
            ob_start();
            layers_bread_crumbs('nav', 'bread-crumbs', '/');
            $bread = ob_get_contents();
            $bread = str_replace('>/<', '><i class="l-close"></i><', $bread);
            ob_end_clean();
            echo $bread;
            ?>
		</div>
		<?php do_action('layers_after_header_page_title'); ?>
        <?php if(!layers_get_theme_mod('header-show-primary-navigation', false)):?>
        <div class="widget widget_nav_menu">
            <?php wp_nav_menu(array('theme_location' => LAYERS_THEME_SLUG . '-primary',
                                    'menu_class'     => 'menu',
                                    'fallback_cb' => '\Handyman\Front\tl_layers_menu_fallback')) ?>
        </div>
        <?php endif; ?>
	</div>
<?php } ?>
