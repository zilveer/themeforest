
		<div class="post clearfix layout2">					
			<div class="four columns alpha">
				<div class="half-bottom">
					<?php $img_id = get_post_thumbnail_id($post->ID); ?>				
					<?php $featured_url = wp_get_attachment_url( $img_id ); ?>
					<?php $alt_text = get_post_meta( $img_id, '_wp_attachment_image_alt', true ); ?>			
					<?php $thumb_get = get_post($img_id); ?>
					<?php $thumb_title = $thumb_get->post_title; ?>
					
					<?php if($featured_url != ''): ?>
						<div class="overlay squared">
							<figure>								
								<a href="<?php the_permalink(); ?>" class="overlay-mask" title="<?php echo $thumb_title; ?>"></a>									
									<a class="icon-view" href="<?php echo $featured_url; ?>" rel="prettyPhoto" title="<?php echo $thumb_title; ?>"></a>												
									<a class="icon-link" href="<?php the_permalink(); ?>" title="<?php printf( esc_attr( __( 'Permalink to %s', 'morphis' ) ), the_title_attribute( 'echo=0' ) ); ?>"></a>							
																					
									<a href="<?php the_permalink(); ?>" title="<?php echo $thumb_title; ?>">
										<img src="<?php echo $featured_url; ?>" alt="<?php echo $alt_text; ?>" title="<?php echo $thumb_title; ?>" class="" />
									</a>														
							</figure>
						</div>
					<?php endif; ?>				
				</div>
			</div>
			<?php 
				global $NHP_Options; 
				$options_morphis = $NHP_Options; 
				?>
			<?php $sidebar_pos = $options_morphis['radio_img_select_sidebar'] ?>
			
			<?php global $wp_query; ?>
			<?php $page_id = $wp_query->get_queried_object_id(); ?>		
			<?php $unique_sidebar_layout = get_post_meta($page_id,'_cmb_page_layout_sidebar',TRUE); ?>	
			
			<?php if($sidebar_pos == '3') : ?>				
				<?php if($unique_sidebar_layout == 'right_sidebar' || $unique_sidebar_layout == 'left_sidebar') : ?>
					<div class="eight columns post-body omega">		
				<?php else: ?>
					<div class="twelve columns post-body omega">		
				<?php endif; ?>								
			<?php else :  ?>
				<?php if($unique_sidebar_layout == 'right_sidebar' || $unique_sidebar_layout == 'left_sidebar') : ?>
					<div class="eight columns post-body omega">		
				<?php else: ?>
					<?php if($sidebar_pos == '2' || $sidebar_pos == '1') : ?>	
						<div class="eight columns omega clearfix">						
					<?php else: ?>
						<div class="twelve columns omega clearfix">						
					<?php endif; ?>		
				<?php endif; ?>	
			<?php endif; ?>		
					<div class="inner-content entry-content">
						<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
						<div class="blog2">
							<ul class="post-meta clearfix">
								<li><?php printf( __('on', 'morphis') ); ?> <?php echo esc_attr( get_the_time('F j, Y') ); ?></li>
								<li><a href=""><?php if ( comments_open() ) : ?>				
								<?php comments_popup_link( __( 'Leave a comment', 'morphis' ) . '</span>', __( 'with <b>1</b> Comment', 'morphis' ), __( 'with <b>%</b> Comments', 'morphis' ) ); ?>
								<?php endif; // End if comments_open() ?></a></li>
								<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
									<?php
										/* translators: used between list items, there is a space after the comma */
										$categories_list = get_the_category_list( ', ' );
										if ( $categories_list ):
									?>
									<li><?php printf( __( '<span class="%1$s">under </span> %2$s', 'morphis' ), 'entry-utility-prep entry-utility-prep-cat-links', $categories_list );
									 ?></li>	
								<?php endif; // End if categories ?>
								<?php endif; // End if 'post' == get_post_type() ?>
								
							</ul>
						</div>								
						<?php
							if($options_morphis['select_post_content']=='2'):
								global $more;    // Declare global $more (before the loop).
								$more = 0;       // Set (inside the loop) to display content above the more tag.
								the_content( __( morphis_read_more_text(), 'morphis' ) );
							else:
								the_excerpt();
							endif;
						?>						
					</div>
				
			</div>
		</div>
		<hr />
		<?php $divider = $options_morphis['radio_img_select_divider']; ?>
				<?php if($divider != 'vintage-none') : ?>
					<hr class="<?php echo $divider; ?>" />	
				<?php endif; ?>	
		