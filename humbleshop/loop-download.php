<article class="col-sm-4 product">
	
	<figure class="edd_download_inner">
		
		<div class="download-image">
			<a title="<?php _e( 'View ', 'shop-front' ) . the_title_attribute(); ?>" href="<?php the_permalink(); ?>">
				<?php 
				if ( has_post_thumbnail() ) :
					the_post_thumbnail('download',array( 'class'	=> "img-responsive"));
				else: ?>
            		<img src="//placehold.it/500x500&text=Placeholder" alt="" class="img-responsive"/>
            		<?php //echo apply_filters( 'shopfront_download_icon', '<i class="i fa fa-shopping-cart"></i>');
             	endif; ?>
			</a>
		</div>
		
		<figcaption class="download-info text-center">
			<?php 
			
			/* Product Price ---------------------------------------- */
			
			if(function_exists('edd_price')) { ?>
				<div class="product-price">
					<?php 
						if(edd_has_variable_prices(get_the_ID())) {
							// if the download has variable prices, show the first one as a starting price
							echo 'From: '; edd_price(get_the_ID());
						} else {
							edd_price(get_the_ID()); 
						}
					?>
				</div><!--end .product-price-->
			<?php } ?>

			<?php
	        
	       	/* Excerpt ---------------------------------------- */
			
			$excerpt_length = apply_filters('excerpt_length', 12);
	        if ( has_excerpt() ) {
	        	echo '<p><small>' . wp_trim_words( get_the_excerpt(), $excerpt_length ) . '</small></p>';
	        
	        } ?>

			<?php 

			/* Buttons ---------------------------------------- */

			if(function_exists('edd_price')) { ?>
				<div class="product-buttons">
					<?php if(!edd_has_variable_prices(get_the_ID())) { ?>
						<?php //echo edd_get_purchase_link(get_the_ID(), 'Add to Cart', 'button'); ?>
					<?php } ?>
					<a href="<?php the_permalink(); ?>" class="btn btn-default btn-sm"><i class="fa fa-search"></i> <?php _e('View', 'humbleshop'); ?></a>
				</div><!--end .product-buttons-->
				
			<?php } ?>
		</figcaption>
	</figure>

	<p class="edd_download_title text-center"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
</article><!--end .product-->