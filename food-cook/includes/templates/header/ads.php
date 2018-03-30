<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

global $woo_options, $woocommerce;

if ( isset( $woo_options['woo_ad_top'] ) && ( 'true' == $woo_options['woo_ad_top'] ) ) : ?>
	        
    <div id="topad">
    
		<?php if ( ( isset( $woo_options['woo_ad_top_adsense'] ) ) && ( '' != $woo_options['woo_ad_top_adsense'] ) ) { 
            echo stripslashes( get_option('woo_ad_top_adsense') );             
        } else {
        	$top_ad_image = $woo_options['woo_ad_top_image'];
        	if ( is_ssl() ) $top_ad_image = str_replace( 'http://', 'https://', $top_ad_image );
        ?>
            <a href="<?php echo esc_url( get_option( 'woo_ad_top_url' ) ); ?>"><img src="<?php echo esc_url( $top_ad_image ); ?>" alt="" /></a>
        <?php } ?>		   	
        
    </div><!-- /#topad -->
    
<?php endif; ?>
