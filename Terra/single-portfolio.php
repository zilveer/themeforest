<?php 
get_header(); ?>

	<div class="full_container_page_title">	
		<div class="container animationStart">		
			<div class="row no_bm">
				<div class="sixteen columns">
				    <?php boc_breadcrumbs(); ?>
					<div class="page_heading"><h1><?php the_title(); ?></h1></div>
				</div>		
			</div>
		</div>
	</div>



<?php // IF Post type is Gallery - Only then do the SCROLLING Sidebar
	if (( function_exists( 'get_post_format' ) && get_post_format( $post->ID ) == 'gallery' )) { ?>

	<!-- SCROLL -->
	<script>
			jQuery(window).load(function(){

                        var $float_box = jQuery('.portfolio_description_scrolling');
                    
                        if(jQuery('.portfolio_page').length > 0){
 
                            var bodyY = parseInt(jQuery('.portfolio_page').offset().top)-25;
                            var float_right_h = jQuery('.portfolio_description').height();
							var all =    jQuery('.portfolio_media').height()+bodyY-float_right_h;
							
							jQuery(window).scroll(function () { 
                        	
                            	var win_width = jQuery(window).width();
	                            if(win_width>960){
	                                var scrollY = jQuery(window).scrollTop();
	                                var isfixed = $float_box.css('position') == 'fixed';
	                                var end = jQuery('.portfolio_page').height() - float_right_h -40;
	                                var end2 = jQuery('.portfolio_page').height() + (jQuery('.portfolio_description').height()/2);
	                                
	                                if($float_box.length > 0){
	  
	                                    if ( scrollY > bodyY && scrollY < all && !isfixed ) {
	                                        $float_box.stop().css({position: 'fixed', top:25});
	                                    } 
	                                    else if ( scrollY > all) {
	                                        $float_box.stop().css({position: 'relative', top:end });
	                        
	                                    } else if ( scrollY < bodyY && scrollY < all && isfixed ) {
	                                        $float_box.css({position: 'relative', top:0 });
	                                    }		
	                                }
                            	}
                            });
                        }
             });
	</script>
	<!-- SCROLL :: END -->

<?php } // IF Post type is Gallery :: END ?>


		
	<div class="container">	
		
		<div class="row portfolio_page">

				<div class="portfolio_media eleven columns">
				
	
	<?php 
		$str = '';
		while(have_posts()): the_post(); ?>
			
		<?php
			$args = array(
			    'post_type' => 'attachment',
			    'numberposts' => '16',
			    'post_status' => null,
			    'post_parent' => $post->ID,
				'orderby' => 'menu_order',
				'order' => 'ASC',
				'exclude' => get_post_thumbnail_id()
			);
			$attachments = get_posts($args);
			if($attachments || has_post_thumbnail()):
		?>


		<?php // IF Post type is Standard (false) 	
		if(function_exists( 'get_post_format' ) && get_post_format( $post->ID ) != 'gallery' && get_post_format( $post->ID ) != 'video' && has_post_thumbnail()) { ?> 

		        	<?php if(has_post_thumbnail()): ?>

						<?php $attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'portfolio-full'); ?>
						<?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'portfolio-full'); ?>
						<?php $attachment_data = wp_get_attachment_metadata(get_post_thumbnail_id()); ?>
						<div class="pic animationStart">
							<a href="<?php echo $full_image[0]; ?>" rel="prettyPhoto['gal']" title="">
							  	<img src="<?php echo $attachment_image[0]; ?>" alt=" "/><div class="img_overlay_zoom"></div>
							</a>
						</div>
						<div class="h40"></div>	
						
					<?php endif; ?>

		
		<?php } // IF Post type is Standard :: END ?>
		
		<?php // IF Post type is Gallery
		if (( function_exists( 'get_post_format' ) && get_post_format( $post->ID ) == 'gallery' )) { ?>

		        	<?php if(has_post_thumbnail()): ?>
					
						<?php $attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'portfolio-full'); ?>
						<?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'portfolio-full'); ?>
						<?php $attachment_data = wp_get_attachment_metadata(get_post_thumbnail_id()); ?>					
						<div class="pic animationStart">
							<a href="<?php echo $full_image[0]; ?>" rel="prettyPhoto['gal']" title="">
							  	<img src="<?php echo $attachment_image[0]; ?>" alt=" "/><div class="img_overlay_zoom"></div>			  		
							</a>
						</div>
						<div class="h40"></div>	
					
					<?php endif; ?>
					
		        	<?php foreach($attachments as $attachment): ?>

						<?php $attachment_image = wp_get_attachment_image_src($attachment->ID, 'portfolio-full'); ?>
						<?php $full_image = wp_get_attachment_image_src($attachment->ID, 'portfolio-full'); ?>
						<?php $attachment_data = wp_get_attachment_metadata($attachment->ID); ?>
									
						<div class="pic animationStart">
							<a href="<?php echo $full_image[0]; ?>" rel="prettyPhoto['gal']" title="">
							  	<img src="<?php echo $attachment_image[0]; ?>" alt=" "/><div class="img_overlay_zoom"></div>			  		
							</a>
						</div>
						<div class="h40"></div>	
					
					<?php endforeach; ?>
		
				
		<?php } // IF Post type is Gallery :: END ?>
		
		<?php	// IF Post type is Video 
				if (( function_exists( 'get_post_format' ) && get_post_format( $post->ID ) == 'video')  ) {					
					if($video_embed_code = get_post_meta($post->ID, 'video_embed_code', true)) {
						echo "<div class='pic'>";
						echo "<div class='video_max_scale'>";
						echo $video_embed_code;
						echo "</div>";
						echo '</div><div class="h40"></div>	';
					}										
				} // IF Post type is Video :: END 
		?>

			
			<?php endif; ?>
			
			</div>
			
			<div class="five columns portfolio_description">
				<div class="portfolio_description_scrolling" style="width: inherit;">			
					<?php the_content(); ?>
				</div>
			</div>

		</div>
	</div>


<?php if(ot_get_option('related_portfolio_projects')){ ?>
		<?php $projects = get_related_portfolio_items($post->ID); ?>
		<?php if($projects->have_posts()): ?>
		
		<?php 
		
		$portfolio_style = ot_get_option('portfolio_style') ? ot_get_option('portfolio_style') : 'type1';
					
		$str.='	
		<div class="container">
		  <div class="sixteen columns">
			<div class="info_block animationStart">
				<div class="h10 clear"></div>
				<h2 class="title"><span>'.__("Related Portfolio Items", "Terra").'</span></h2>
				<div class="clear h20"></div>
				<div class="carousel_section">
					<div class="carousel_arrows_bgr"></div>
					<ul id="portfolio_carousel">';
						while($projects->have_posts()): $projects->the_post(); 
						if(has_post_thumbnail()): 
						
							$taxonomy = 'portfolio_category';
							$terms = get_the_terms( $post->ID , $taxonomy );
							$cats = array();
							
							if (! empty( $terms ) ) :
								foreach ( $terms as $term ) {
									
									$link = get_term_link( $term, $taxonomy );
									if ( !is_wp_error( $link ) )
										$cats[] = $term->name;
								}
							endif;
						
							$str.=
								'
								<li class="one-third column info_item">
									<a href="'.get_permalink().'" title="">
										<div class="pic_info '.$portfolio_style.'">
											'.get_the_post_thumbnail($post->ID, 'portfolio-medium').'<div class="img_overlay_icon"><span class="portfolio_icon icon_'.getPortfolioItemIcon($post->ID).'"></span></div>
											<div class="info_overlay">
												<div class="info_overlay_padding">
													<div class="info_desc">
														<span class="portfolio_icon icon_'.getPortfolioItemIcon($post->ID).'"></span>
														<h3>'.get_the_title().'</h3>
														<p>'.implode(' / ', $cats).'</p>
													</div>
												</div>
											</div>
										</div>
									</a>
								</li>
								';
							
							
						endif; endwhile;
						$str.='
					</ul>
				</div>
			</div>

			<div class="h20 clear"></div>
						
			<script type="text/javascript">
				jQuery(document).ready(function() {
					jQuery("#portfolio_carousel").jcarousel({
						scroll: (jQuery(window).width() > 767 ? 3 : 1),
						easing: "easeInOutExpo",
						animation: 600
					});
				});	
				
				
				// Reload carousels on window resize to scroll only 1 item if viewport is small
				jQuery(window).resize(function() {
					 var el = jQuery("#portfolio_carousel"), carousel = el.data("jcarousel"), win_width = jQuery(window).width();
					   var visibleItems = (win_width > 767 ? 3 : 1);
					   carousel.options.visible = visibleItems;
					   carousel.options.scroll = visibleItems;
					   carousel.reload();
				});
			</script>
		  </div>
		</div>';

		
		echo $str; ?>
		
		
		<?php endif; ?>

	<?php } // RELATED PROJECTS :: END ?>


	<?php endwhile; // END LOOP ?>


<?php get_footer(); ?>