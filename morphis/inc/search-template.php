			<div class="clearfix">
					<div class="post-body blog3 layout3">
						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>														
						<ul class="post-meta clearfix">
							<li><?php _e( 'on', 'morphis' ); ?> <?php echo esc_attr( get_the_time('F j, Y') ); ?></li>
							<li> <a href=""><?php if ( comments_open() ) : ?>				
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
					<?php $featured_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
					<?php if($featured_url != ''): ?>
						<div class="overlay squared">
							<figure>								
								<a href="<?php the_permalink(); ?>" class="overlay-mask">									
									<a class="icon-view" href="<?php echo $featured_url; ?>" rel="prettyPhoto" title=""></a>												
									<a class="icon-link" href="<?php the_permalink(); ?>" title="<?php printf( esc_attr( __( 'Permalink to %s', 'morphis' ) ), the_title_attribute( 'echo=0' ) ); ?>"></a>							
								</a>													
									<a href="<?php the_permalink(); ?>"><img src="<?php echo $featured_url; ?>" alt="<?php the_title(); ?>" class="" /></a>														
							</figure>
						</div>
					<?php endif; ?>	
						<p class="content"><?php
							the_excerpt();
						?></p>								
						
					</div>	
					<hr />
			</div>