			<div class="clearfix">
					<div class="post-body blog3 layout3">
						<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>														
						<ul class="post-meta clearfix">
							<li><?php _e( 'by', 'morphis' ); ?> <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo esc_attr( sprintf( __( 'View all posts by %s', 'morphis' ), get_the_author() ) ); ?>" rel="author"><?php echo get_the_author(); ?></a></li>
							<li><?php _e( 'on', 'morphis' ); ?> <?php echo esc_attr( get_the_time('F j, Y') ); ?></li>
							<li><a href="">
								<?php if ( comments_open() ) : ?>				
									<?php comments_popup_link( __( 'Leave a comment', 'morphis' ) . '</span>', __( 'with <b>1</b> Comment', 'morphis' ), __( 'with <b>%</b> Comments', 'morphis' ) ); ?>
								<?php endif; // End if comments_open() ?></a>
							</li>
							<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
									<?php
										/* translators: used between list items, there is a space after the comma */
										$categories_list = get_the_category_list( ', ' );
										if ( $categories_list ):
									?>
									<li><?php printf( __( '<span class="%1$s">under </span> %2$s', '' ), 'entry-utility-prep entry-utility-prep-cat-links', $categories_list );
									 ?></li>	
							<?php endif; // End if categories ?>
							<?php endif; // End if 'post' == get_post_type() ?>
						</ul>		
						<div class="entry-content">
					<?php 
					global $NHP_Options; 
					$options_morphis = $NHP_Options; 
					?>
					<?php $img_id = get_post_thumbnail_id($post->ID); ?>				
					<?php $featured_url = wp_get_attachment_url( $img_id ); ?>
					<?php $alt_text = get_post_meta( $img_id, '_wp_attachment_image_alt', true ); ?>			
					<?php $thumb_get = get_post($img_id); ?>
					<?php $thumb_title = $thumb_get->post_title; ?>
					
					<?php if($featured_url != ''): ?>
						<div class="overlay squared half-bottom">
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
						<p class="content"><?php
							if($options_morphis['select_post_content']=='2'):
								global $more;    // Declare global $more (before the loop).
								$more = 0;       // Set (inside the loop) to display content above the more tag.
								the_content( __( morphis_read_more_text(), 'morphis' ) );
							else:
								the_excerpt();
							endif;
						?></p>								
						
					</div>	
					</div>	
					<hr />
					<?php $divider = $options_morphis['radio_img_select_divider']; ?>
					<?php if($divider != 'vintage-none') : ?>
						<hr class="<?php echo $divider; ?>" />	
					<?php endif; ?>
			</div>