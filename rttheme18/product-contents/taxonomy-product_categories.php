<?php
/* 
* rt-theme product taxomony categories
*/
global $rt_sidebar_location, $rt_title;

$term                       = get_queried_object();
$rt_taxonomy                = $term->taxonomy;
$term_id                    = $term->term_id;
$rt_title                   = $term->name; 
$products_item_width        = get_option(RT_THEMESLUG."_product_layout");
$products_list_orderby      = get_option(RT_THEMESLUG.'_product_list_orderby');
$products_list_order        = get_option(RT_THEMESLUG.'_product_list_order');
$products_item_per_page     = get_option(RT_THEMESLUG.'_product_list_pager');
$hide_current_category_desc = get_option(RT_THEMESLUG.'_hide_current_category_desc');


$tax_meta = get_option( "taxonomy_$term_id" );
$cat_image_id = is_array( $tax_meta ) && isset( $tax_meta["product_category_image"] ) && ! empty( $tax_meta["product_category_image"] ) ? $tax_meta["product_category_image"] : "";

if( $cat_image_id ){
	$get_cat_image = wp_get_attachment_image_src( $cat_image_id, "thumbnail" );
	$cat_image_url = is_array( $get_cat_image ) ? $get_cat_image[0] : "";
}

get_header();	
?>
<section class="content_block_background">
	<section id="category-<?php echo $term_id; ?>" class="content_block clearfix">
		<section class="content <?php echo $rt_sidebar_location[0];?>">
		<div class="row">

			<?php do_action( "get_info_bar", apply_filters( 'get_info_bar_product_taxonomies', array( "called_for" => "inside_content" ) ) ); ?>

			<?php if( $term->description && ! $hide_current_category_desc ):?>
			<!-- Category Description -->
				<div class="row margin-b30 clearfix product-category-description <?php echo isset( $cat_image_url ) ? 'with-cat-image' : ""; ?> "> 
					<?php echo isset( $cat_image_url ) ? '<img src="'. $cat_image_url .'" class="product-category-thumbnail">' : ""; ?> 
					<?php echo apply_filters('the_content',($term->description));?> 
				</div> 
				<hr class="style-four">
			<?php endif;?>		

			<?php
			//show subcategories	 
			$category_display = get_option(RT_THEMESLUG."_category_display");
			$term_childrens = get_term_children( $term_id, $rt_taxonomy );

			if( $category_display == "both" || $category_display == "categories_only" ):
			?>

				<?php
					$sub_categories_item_width     = get_option( RT_THEMESLUG .'_product_category_layout' );
					$sub_categories_list_orderby   = get_option( RT_THEMESLUG .'_product_category_list_orderby' );
					$sub_categories_list_order     = get_option( RT_THEMESLUG .'_product_category_list_order' );
					$product_category_show_names   = get_option( RT_THEMESLUG .'_product_category_show_names' ) ? "true" : "";
					$product_category_show_desc    = get_option( RT_THEMESLUG .'_product_category_show_desc' ) ? "true" : "";
					$product_category_show_thumbs  = get_option( RT_THEMESLUG .'_product_category_show_thumbs' ) ? "true" : "";
					$product_category_image_crop   = get_option( RT_THEMESLUG .'_product_category_crop' ) ? "true" : "";
					$product_category_image_height = get_option( RT_THEMESLUG .'_product_category_image_height' );

					if( is_array( $term_childrens ) && ! empty( $term_childrens ) ):
				?> 
					<?php

						$create_category_shortcode = sprintf( 
							'[rt_product_categories item_width="%s" parent="%s" orderby="%s" order="%s" display_descriptions="%s" display_titles="%s" display_thumbnails="%s" image_max_height="%s" crop="%s"]', 
							$sub_categories_item_width, $term_id, $sub_categories_list_orderby, $sub_categories_list_order, $product_category_show_desc, $product_category_show_names, $product_category_show_thumbs, $product_category_image_height, $product_category_image_crop
						);

						echo do_shortcode( $create_category_shortcode );
					?>			

					<?php if ( $category_display != "categories_only" ) : ?><hr class="style-four"><?php endif; ?>

				<?php endif; ?>
			<?php endif; ?>

			<?php if ( empty( $category_display ) || $category_display == "both" || $category_display == "products_only" || ( is_array( $term_childrens ) && empty( $term_childrens ) ) ) : ?>

					<?php if ( have_posts() ) : 

					//show products
					$create_shortcode = sprintf( 
						'[product_box id="%s" item_width="%s" pagination="%s" list_orderby="%s" list_order="%s" item_per_page="%s" categories="%s" with_borders="true" display_descriptions="true" display_titles="true"]', 
						$term->slug, $products_item_width, "on", $products_list_orderby, $products_list_order, $products_item_per_page, $term_id
					);

					echo do_shortcode( $create_shortcode );
						
					else : ?>
						<?php get_template_part( 'content', 'none' ); ?>
					<?php endif; ?>

			<?php endif; ?>

		</div>
		</section><!-- / end section .content -->  
	<?php get_sidebar(); ?>
	</section><!-- / end section .content_block -->  
</section>
<?php get_footer(); ?>