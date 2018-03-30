<?php
/**
 * Content wrappers
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

	<!-- Content -->
	<div id="content">

		<div id="content-ajax">

		<?php 
		 
		if( is_shop() ){
			
			$shop_page_id = wc_get_page_id( 'shop' );
			$hero_type = redux_post_meta( THEME_OPTIONS, $shop_page_id, 'cpbg-opt-page-hero-type' );
			if( $hero_type != 'none' ){
			
				get_template_part('sections/shop_hero_section'); 
			}
		}
		
		
		?>
		
		<!-- Main --> 
        <div id="main">

			<!-- Container -->
            <div class="container">
			
				<?php
				if( !is_product() && redux_post_meta( THEME_OPTIONS, $shop_page_id, 'cpbg-opt-page-show-title' ) ){
				?>
				<!-- Page Title -->
                <div class="page-title text-align-center">                
                    <h3><?php woocommerce_page_title(); ?></h3>
                    <?php if( !is_search() && !is_tax() ){ ?>                        
                    <p class="monospace title-has-line"><?php echo redux_post_meta( THEME_OPTIONS, $shop_page_id, 'cpbg-opt-page-subtitle' ); ?></p>
                    <?php } ?>
                </div>
                <!-- Page Title -->
				<?php }	?>

				<?php
				if( is_shop() ){
					
				?>
				
				<!-- Shop Filters -->
                <div id="shop-filters" class="filters-shop-hide">  
                    
                
                    <div class="one_third">
                        
                        <?php
                        
                        woocommerce_catalog_ordering();
                        
                        ?>
                    
                    </div>
                    
                    <div class="one_third">
                        
                        <?php
                         
                        the_widget('WC_Widget_Price_Filter');
                                                
                        ?>
                        
                    </div>
                    
                    <div class="one_third last">
                    
                    	<?php 
                        
                        get_product_search_form();
                        
                        ?>
                        
                    </div>
                
                </div>
                <!--/Shop Filters -->
                
				<?php
					
				}
				?>