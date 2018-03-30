<?php
/**
 * Single Product tabs
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

$type = etheme_get_option('tabs_type');

if ( ! empty( $tabs ) && $type != 'disable' ) : $i=0; ?>

	<div class="tabs <?php echo esc_attr( $type ); ?>">
        <ul class="tabs-nav">
            <?php foreach ( $tabs as $key => $tab ) : $i++; ?>
                <li>
                    <a href="#tab_<?php echo $key ?>" id="tab_<?php echo $key ?>" class="tab-title <?php if($i == 1) echo 'opened'; ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ?></a>
                </li>
                <?php if ( $type == 'accordion' ): ?>
                    <div class="tab-content tab-<?php echo $key ?>" id="content_tab_<?php echo $key ?>" <?php if($i == 1) echo 'style="display:block;"'; ?>>
                        <div class="tab-content-inner">
                            <?php call_user_func( $tab['callback'], $key, $tab ) ?>
                        </div>
                    </div>
                <?php endif ?>
            <?php endforeach; ?>

            
            <?php if (etheme_get_custom_field('custom_tab1_title') && etheme_get_custom_field('custom_tab1_title') != '' ) : ?>
                <li>
                    <a href="#tab_7" id="tab_7" class="tab-title"><?php etheme_custom_field('custom_tab1_title'); ?></a>
                </li>
                <?php if ( $type == 'accordion' ): ?>
                    <div id="content_tab_7" class="tab-content">
                        <div class="tab-content-inner">
                            <?php echo do_shortcode(etheme_get_custom_field('custom_tab1')); ?>
                        </div>
                    </div>
                <?php endif ?>
            <?php endif; ?>  
        
            <?php if (etheme_get_option('custom_tab_title') && etheme_get_option('custom_tab_title') != '' ) : ?>
                <li>
                    <a href="#tab_9" id="tab_9" class="tab-title"><?php etheme_option('custom_tab_title'); ?></a>
                </li>  
                <?php if ( $type == 'accordion' ): ?>
                    <div id="content_tab_9" class="tab-content">
                        <div class="tab-content-inner">
                            <?php echo do_shortcode(etheme_get_option('custom_tab')); ?>
                        </div>
                    </div>
                <?php endif ?>              
            <?php endif; ?> 
        </ul>

        <?php if ( $type != 'accordion' ): ?>
            <?php $i = 0; foreach ( $tabs as $key => $tab ) : $i++; ?>
                <div class="tab-content tab-<?php echo $key ?>" id="content_tab_<?php echo $key ?>" <?php if($i == 1) echo 'style="display:block;"'; ?>>
                    <div class="tab-content-inner">
                        <?php call_user_func( $tab['callback'], $key, $tab ) ?>
                    </div>
                </div>
            <?php endforeach; ?>
    		
            <?php if (etheme_get_custom_field('custom_tab1_title') && etheme_get_custom_field('custom_tab1_title') != '' ) : ?>
                <div id="content_tab_7" class="tab-content">
                	<div class="tab-content-inner">
    	        		<?php echo do_shortcode(etheme_get_custom_field('custom_tab1')); ?>
    	            </div>
                </div>
            <?php endif; ?>	 
            
            <?php if (etheme_get_option('custom_tab_title') && etheme_get_option('custom_tab_title') != '' ) : ?>
                <div id="content_tab_9" class="tab-content">
                	<div class="tab-content-inner">
    	        		<?php echo do_shortcode(etheme_get_option('custom_tab')); ?>
    	            </div>
                </div>
            <?php endif; ?> 
        <?php endif; ?>	
	</div>

<?php endif; ?>