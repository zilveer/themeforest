<?php

// Template for Cart66 Lite & Pro	
	
get_header();?>
<div id="single_product_page">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<?php $args = array(
				'post_type' => 'attachment',
				'numberposts' => null,
				'post_status' => null,
				'order'		  => 'ASC',
				'post_parent' => $post->ID,
				'posts_per_page'	=> '99'
			);
			$attachments = get_posts($args); ?>
	<div <?php post_class(); ?>>
		<?php if(count($attachments) != 0) { ?>
		<div id="product_images">
			<?php if (has_post_thumbnail()) { ?>
			<a id="main_product_image" href="<?php $image_id = get_post_thumbnail_id(); $image_url = wp_get_attachment_image_src($image_id,'full', true); echo $image_url[0]; ?>" class="lightbox">
				<span class="preview"></span>
				<?php the_post_thumbnail( 'product_main', array('alt' => get_the_title()) ); ?>
			</a>
			<?php } ?>	
			<?php if(count($attachments) > 1) { ?>
			<div id="product_thumbs">
				<?php $featured_image = get_post_thumbnail_id(get_the_ID());
					foreach ($attachments as $attachment) {
					if ($featured_image != ($attachment->ID)) {	?>
				<a href="<?php echo wp_get_attachment_url($attachment->ID); ?>" class="lightbox">
					<span class="preview"></span>
					<?php echo wp_get_attachment_image( $attachment->ID, 'product_mini_gallery' ); ?>
				</a>
				<?php } } ?>
				<div class="clear"></div>
			</div>
			<?php } ?>
			<?php if ((get_the_term_list( $post->ID, 'types' ) != '') || (get_the_term_list( $post->ID, 'product_tags' ) != '')) { ?>
			<div class="single-product-meta">
				<?php if (get_the_term_list( $post->ID, 'types' ) != '') { ?>
				<span><?php echo get_the_term_list( $post->ID, 'types', 'Product Categories: ', ', ', '' ); ?></span>
				<?php } if (get_the_term_list( $post->ID, 'product_tags' ) != '') { ?>
				<span><?php echo get_the_term_list( $post->ID, 'product_tags', 'Tagged with: ', ', ', '' ); ?></span>
				<?php } ?>
			</div>
			<?php } ?>
		</div><!-- end #product_images -->
		<div id="product_info" class="entry-content">
		<?php } else { // else, if there are NOT images ?>
			<div id="product_info_full" class="entry-content">
		<?php } // end if there are images ?>
				<h2 class="post_title"><?php the_title(); ?></h2>
				<?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>
		
          <?php $shortcode_attr = (get_post_meta($post->ID, '_dc_product_shortcode_attr', true)) ? get_post_meta($post->ID, '_dc_product_shortcode_attr', true) : 'display="inline" quantity="true" price="true"';  ?>
				
			<?php if (of_get_option('affiliate_mode') == 'yes') { // check if affiliate_mode is on ?>
				<div class="Cart66CartButton">
					<?php if (get_post_meta($post->ID, '_dc_price', true) != '') { ?>
					<span class="Cart66Price"><?php echo get_post_meta($post->ID, '_dc_price', true);?></span>
					<?php } if (get_post_meta($post->ID, '_dc_aff_info', true) != '') { ?>
					<div class="aff_info">
					<?php echo get_post_meta($post->ID, '_dc_aff_info', true);?>
					</div>
					<?php } if (get_post_meta($post->ID, '_dc_aff_link', true) != '') { ?>
					<a class="Cart66ButtonPrimary" target="_blank" href="<?php echo get_post_meta($post->ID, '_dc_aff_link', true);?>"><?php _e('Buy Now', 'designcrumbs'); ?></a>
					<?php } ?>
										
					<div class="clear"></div>
				</div>
			<?php } // end affiliate_mode ?>
	
			<?php // Start Cloud
			if (class_exists('CC_Cart66Cloud')) { ?>
			<?php $cart66_product = cart66_get_product(get_post_meta($post->ID, '_dc_product_id', true)); ?>
			<?php if($cart66_product): ?>	

				<!-- Start Cloud Pricing -->
			<div class="Cart66CartButton">
				
				<div id="price_container">
					  <?php if(!empty($cart66_product['on_sale']) && !empty($cart66_product['sale_price'])): ?>
									<span class="price"><del><?php echo $cart66_product['formatted_price']; ?></del></span><span class="price sale-price"><?php echo $cart66_product['formatted_sale_price']; ?></span>
								<?php else: ?>
									<span class="price"><?php echo $cart66_product['formatted_price']; ?></span>
								<?php endif; ?>
					  
					 
					 <div class="clear"></div>
				</div><!-- end Cloud Pricing -->
				<?php echo do_shortcode('[cc_product sku="'.$cart66_product['sku'].'" '.$shortcode_attr.']'); ?>
				<div class="clear"></div>
			</div>
			<?php endif; ?>
			<?php } // End Cloud ?>

			</div><!-- end #product_info -->
		<div class="clear"></div>
		</div><!-- end .post_class -->
	<?php if (of_get_option('product_comments') == 'yes') { ?>
		<div id="product_comments">
		<?php comments_template('', true); ?>
		</div>			
	<?php } ?>
		
		<?php endwhile; else: ?>
	<h2 class="page_title"><?php _e('Sorry, we can\'t seem to find what you\'re looking for.', 'designcrumbs'); ?></h2>
	<p><?php _e('Please try one of the links on top.', 'designcrumbs'); ?></p>
			
		<?php endif; ?>
		<div class="clear"></div>
	</div><!-- end #single_product_page -->
<?php get_footer(); ?>