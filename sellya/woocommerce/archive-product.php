<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

get_header(); ?>
<script type="text/javascript"><!--

jQuery(function($){

	"use strict";

	$.display = function(view) {
	
		if (view == 'list') {
			
			$('.product-grid').attr('class', 'product-list');
			
			$('.product-list > ul > li').each(function(index, element) {
		         
                                var element = $(this);
                                
				var htmls = '<div class="left">';
				
				var image = element.find('.image').html();
				
				if (image != undefined) { 					
                                    htmls += '<div class="image span2">' + image + '</div>';
				}
                                
				htmls += '<div class="span4">';
				htmls += '<div class="name">' + element.find('.name').html() + '</div>';
				
				var rating = element.find('div.rating').html();
				
				if (rating != undefined) {
					htmls += '<div class="rating">' + rating + '</div>';
				}				
                                else {
                                    
                                    if(element.find('div.star-rating').length > 0){
                                    
                                        var rating = element.find('div.star-rating').html();

                                        var rattitle = element.find('div.star-rating').attr('title');

                                        htmls += '<div class="star-rating" title="'+rattitle+'">'+rating+'</div>';
                                    }
                                }
                                
				htmls += '  <div class="description">' + element.find('.description').html() + '</div>';	
				//html += '  <div class="wishlist">' + $(element).find('.wishlist').html() + '</div>';
				//html += '  <div class="compare">' + $(element).find('.compare').html() + '</div>';			
					
				htmls += '</div>';
		
				htmls += '</div>';
				
				htmls += '<div class="span2">';
				var price = element.find('.price').html();
				
				if (price != null) {
					htmls += '<div class="price span12">' + price  + '</div>';
				}				
				htmls += '  <div class="cart">' + element.find('.cart').html() + '</div>';
				htmls += '</div>';				
		
							
				element.html(htmls);
			});		
		
			//$('.display').html('<?php _e('Display:','sellya')?>&nbsp;<img src="<?php echo get_template_directory_uri(); ?>/image/icon_list.png" alt="List" title="List" />&nbsp;<img onclick="jQuery.display(\'grid\');" src="<?php echo get_template_directory_uri(); ?>/image/icon_grid.png" alt="Grid" title="Grid" />');
			
			$.cookie('display', 'list'); 
		} else {
			$('.product-list').attr('class', 'product-grid');
			
			$('.product-grid > ul > li').each(function(index, element) {
				var html = '';
				
				html += '<div class="pbox">';			
				
                                var element = $(this);
                                
				var image = element.find('.image').html();
				
				if (image != undefined) {
                                        
					html += '<div class="image">' + image + '</div>';
				}
				html += '<div class="description hidden-phone hidden-tablet">' + $(element).find('.description').html() + '</div>';
				
				var rating = element.find('div.rating').html();
				
				if (rating != undefined) {
					html += '<div class="rating hidden-phone hidden-tablet">' + rating + '</div>';
				}
				
				html += '<div class="name">' + element.find('.name').html() + '</div>';
                                
				if (rating == undefined) {
                                    
                                    if(element.find('div.star-rating').length > 0){
                                    
                                        var rating = element.find('div.star-rating').html();

                                        var rattitle = element.find('div.star-rating').attr('title');

                                        html += '<div class="star-rating" title="'+rattitle+'">'+rating+'</div>';
                                    }
                                }
                                
				var price = element.find('.price').html();
				
				if (price != null) {
					html += '<div class="price">' + price  + '</div>';
				}
							
				html += '<div class="cart">' + element.find('.cart').html() + '</div>';
				//html += '<div class="wishlist">' + $(element).find('.wishlist').html() + '</div>';
				//html += '<div class="compare">' + $(element).find('.compare').html() + '</div>';
				html += '</div>';
				
				element.html(html);
			});	
			
			//$('.display').html('<?php _e('Display:','sellya')?>&nbsp;<img src="<?php echo get_template_directory_uri(); ?>/image/icon_list.png" alt="List" title="List" onclick="jQuery.display(\'list\');"/>&nbsp;<img src="<?php echo get_template_directory_uri(); ?>/image/icon_grid.png" alt="Grid" title="Grid"/>');	
			
			$.cookie('display', 'grid');
		}
	}
	
	$('a.list-trigger').click(function(){
            $.display('list');	
	});
	$('a.grid-trigger').click(function(){
            $.display('grid');		 
	});
	
	var view = $.cookie('display');
	
	if (view) {
            $.display(view);
	} else {
            $.display('grid');
	}
	
	
	
});
//--></script> 
<section id="midsection" class="container">
<div class="row">
 <?php get_leftbar('left'); ?>
	<section class="span9" id="content">
	<div class="row-fluid">  
		<div class="breadcrumb">
		<?php
			/**
			 * woocommerce_before_main_content hook
			 *
			 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
			 * @hooked woocommerce_breadcrumb - 20
			 */
			do_action('woocommerce_before_main_content');
		?>
		</div>
        
			<h1 class="page-title">
				<?php if ( is_search() ) : ?>
					<?php
						printf( __( 'Search Results: &ldquo;%s&rdquo;', 'woocommerce' ), get_search_query() );
						if ( get_query_var( 'paged' ) )
							printf( __( '&nbsp;&ndash; Page %s', 'woocommerce' ), get_query_var( 'paged' ) );
					?>
				<?php elseif ( is_tax() ) : ?>
					<?php echo single_term_title( "", false ); ?>
				<?php else : ?>
					<?php
						$shop_page = get_post( woocommerce_get_page_id( 'shop' ) );
	
						echo apply_filters( 'the_title', ( $shop_page_title = get_option( 'woocommerce_shop_page_title' ) ) ? $shop_page_title : $shop_page->post_title );
					?>
				<?php endif; ?>
			</h1>
            <?php
			
			$slug = get_query_var('term');
			$taxonomy = get_query_var('taxonomy');
			
			if(!empty($taxonomy) && !empty($slug)):
			
				$term = get_term_by('slug',$slug,$taxonomy);
				
				
				$thumbnail_id = get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true );
				
				$image = wp_get_attachment_image_src($thumbnail_id,'full');
				
				$image = $image[0]; 
				
				if($thumbnail_id):
			?>
				
				<div class="category-info">
					<p>
					<img src="<?php echo $image?>" alt="<?php echo $term->name?>">
					</p>
				</div>
			<?php
				endif;
				 
			endif;
			
			do_action( 'woocommerce_archive_description' ); 
			
			?>
            
            <?php 
			if(get_option('woocommerce_category_archive_display') == 'both' and get_query_var('taxonomy')):
			
				$parent_cat = get_term_by('slug',get_query_var('term'),get_query_var('taxonomy'));
				
				if($parent_cat->parent == 0):
			?>
            
            	<h4><?php _e('Refine Search','sellya')?></h4>
            <?php endif;endif;?>
            
            <div class="category-list">
            
            <?php 
			if(!isset($GLOBALS['woocm_subcat_loop']))
				$GLOBALS['woocm_subcat_loop'] = 0;
			
			woocommerce_product_subcategories(); ?>
                
            </div>
            
			<?php if ( is_tax() ) : ?>            
				<?php do_action( 'woocommerce_taxonomy_archive_description' ); ?>               
			<?php elseif ( ! empty( $shop_page ) && is_object( $shop_page ) ) : ?>
				<?php do_action( 'woocommerce_product_archive_description', $shop_page ); ?>
			<?php endif; ?>
			
			
			<!--div class="product-filter">
				<div class="display">Display:&nbsp;
					<a href="#" class="switch_thumb">Switch Thumb</a>
				</div>				
			</div-->
			 <div class="product-filter">
				<div class="display"><?php _e('Display:','sellya')?>&nbsp;
                                    <a class="list-trigger">
                                        <img src="<?php echo get_template_directory_uri(); ?>/image/icon_list.png" alt="List" title="List" />
                                    </a>
                                    <a class="grid-trigger">
                                        <img src="<?php echo get_template_directory_uri(); ?>/image/icon_grid.png" alt="Grid" title="Grid" />
                                    </a>
                                </div>
			
			<div class="sort">      
				<?php
					/**
					 * woocommerce_pagination hook
					 *
					 * @hooked woocommerce_pagination - 10
					 * @hooked woocommerce_catalog_ordering - 20
					 */
					do_action( 'woocommerce_pagination' );
				?>
			</div>
	
	</div>
			
	
			<?php if ( have_posts() ) : ?>
	
				<?php do_action('woocommerce_before_shop_loop'); ?>
                                
				<div class="product-grid">
                                    
					<ul class="products">
                    
					<?php while ( have_posts() ) : the_post(); ?>
	
						<?php woocommerce_get_template_part( 'content', 'product' );?>
	
					<?php endwhile; // end of the loop. ?>
	
                                        </ul>
    
				</div>
	
				<?php do_action('woocommerce_after_shop_loop'); ?>
	
			<?php else : ?>
	
                                <p><?php _e( 'No products found which match your selection.', 'woocommerce' ); ?></p>
	
			<?php endif; ?>
	
			<div class="clear"></div>
	
			
	
		<?php
			/**
			 * woocommerce_after_main_content hook
			 *
			 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
			 */
			do_action('woocommerce_after_main_content');
		?>
	</div>
	</section>
	
		<?php
			/**
			 * woocommerce_sidebar hook
			 *
			 * @hooked woocommerce_get_sidebar - 10
			 */
			//do_action('woocommerce_sidebar');
		?>
</div>
</section>

<?php get_footer('shop'); ?>