<?php 
global $portfolio_category;
if(!empty($portfolio_category)): ?>
<div class="container cs-portfolio-related cshero-shortcode text-center">
	<h3 class="cs-portfolio-related-title">
		<span><?php _e('Related Projects', THEMENAME); ?></span>
	</h3>
	<div class="row">
	   <?php
	   $args = array(
	       'posts_per_page' => 3,
	       'post_type' => 'portfolio',
	       'post_status' => 'publish'
	   );
	   if($portfolio_category != ''){
		   $args['tax_query'] = array(
	           array(
	               'taxonomy' => 'portfolio_category',
	               'field' => 'term_id',
	               'terms' => explode(',', $portfolio_category)
	           )
	       );
	   }
	   $wp_query = new WP_Query($args);
	   while ($wp_query->have_posts()) : $wp_query->the_post();
	   ?>
	   <article class="cs-portfolio-similar-item col-xs-12 col-sm-12 col-md-4 col-lg-4">
	   		<div class="cs-portfolio-thumbnail">
		   		<?php if (has_post_thumbnail() && ! post_password_required() && ! is_attachment() && wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false)) { ?>
					<?php
						$attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', false);
		                $image_resize = mr_image_resize( $attachment_image[0], 370, 250, true, 'c', false );
		                echo '<img alt="" class="" src="'. esc_url($image_resize)  .'"/>';
					?>
				<?php } else { 
					$no_image = get_template_directory_uri().'/assets/images/no-image.jpg';
		    		$image_resize = mr_image_resize( $no_image, 370, 250, true,'c', false );
					?>
					<img alt="" src="<?php echo $image_resize; ;?>" />
				<?php } ?>
				<div class="overlay from-center">
					<div class="overlay-content">
						<a class="portfolio-link" href="<?php the_permalink(); ?>"><i class="pe-7s-search"></i></a>
					</div>
				</div>
	   		</div>
	       <div class="cs-portfolio-similar-details">
				<?php echo cshero_title_render();?>
				<?php echo cshero_getPortfolioCategory(); ?>
			</div>
		</article>
	   <?php
	   endwhile;
	   wp_reset_query();
	   ?>
   </div>
<?php endif; ?>