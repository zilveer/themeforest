
		<div class="post clearfix layout2">					
			<div class="four columns alpha">
				<div class="half-bottom">	
					<div class="entry-content quote-pf">
						<?php $postformat_quote = get_post_meta($post->ID,'_cmb_quote_pf_text',TRUE); ?>
						<?php $postformat_quote_cite = get_post_meta($post->ID,'_cmb_quote_cite_pf_text',TRUE); ?>			
						<h6>&#147;<?php echo $postformat_quote; ?>&#148; <span class="cite-quote">--<?php echo $postformat_quote_cite; ?></span></h6>
					</div>
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
								<li><?php _e( 'on', 'morphis' ); ?> <?php echo esc_attr( get_the_time('F j, Y') ); ?></li>
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
		