<?php
/**
 * @package Foundry
 * @author TommusRhodus
 * @version 3.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) : ?>

<div class="tabbed-content text-tabs">
    <ul class="tabs">
    
    	<?php 
    		$i = 0;
    		foreach ( $tabs as $key => $tab ) : 
    		$i++;
    		$active = ( $i == 1 ) ? 'active' : '';
    	?>
    	
    		<li class="<?php echo esc_attr($active); ?>">
    		    <div class="tab-title">
    		        <span><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?></span>
    		    </div>
    		    <div class="tab-content">
    		        <?php call_user_func( $tab['callback'], $key, $tab ); ?>
    		    </div>
    		</li>
    		
    	<?php endforeach; ?>
        
    </ul>
</div>

<?php endif; ?>
