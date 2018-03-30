<?php
/**
 * Top Cart
 *
 * @author      Ibrahim Ibn Dawood
 * @package     Templates/Header
 * @version     2.0.0
 */
if ( ! defined( 'ABSPATH' ) ){
    exit;
}

?>
<div class="top-cart-row-container">
    <div class="wishlist-compare-holder">
        <div class="ecwid-favorite-signin"></div>
        <script type="text/javascript">
        	Ecwid.OnPageLoaded.add(function(page) {
		        jQuery("div.ecwid-productBrowser-auth").appendTo(".ecwid-favorite-signin");
		    });
        </script>
    </div><!-- /.wishlist-compare-holder -->

    <?php
        if( class_exists('EcwidMinicartMiniViewWidget') ) {
            the_widget( 'EcwidMinicartMiniViewWidget' );
        }
    ?>
    
</div><!-- /.top-cart-row-container -->