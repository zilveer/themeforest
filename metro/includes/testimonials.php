<?php if(get_option(OM_THEME_PREFIX . 'show_testimonials') == 'true') { ?>
		<!-- Partners, Testimnials -->
		<div class="content-pane decor-bottom">
			<div class="one-fourth">
				<h2><?php echo get_option(OM_THEME_PREFIX . 'testimonials_block_name') ?></h2>
				<div class="header-comment align-right"><?php echo get_option(OM_THEME_PREFIX . 'testimonials_block_name_comment') ?></div>
			</div>
			
			<div class="three-fourth">
				<div id="partners-testimonial-container"></div>
			</div>
			<div class="clear"></div>
			
			<div class="full-width">
			
				<div class="dots-divider"></div>
				
				<div class="partners-list-wrapper">
					<ul id="partners-list">
						<li class="prev"><span class="colored">&lt;</span> <?php _e('Back','om_theme')?></li> <!-- Prev link -->

<?php

		$arg=array (
			'post_type' => 'testimonials',
			'orderby' => 'menu_order',
			'order' => 'ASC',
			'posts_per_page' => -1
		);
		
		$query = new WP_Query($arg);
		
		while ( $query->have_posts() ) : $query->the_post(); ?>

						<li id="post-<?php the_ID(); ?>">
							<div class="pic">
							<?php if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) { ?>
							<?php the_post_thumbnail('testimonial-thumb', array('alt'=>$post->post_title, 'title'=>$post->post_title)); ?>
							<?php } ?>	
							</div>
							<?php if($post->post_content) { ?>
								<div class="partner-testimonial">
									<div class="title"><?php the_title(); ?></div>
									<?php the_excerpt(); ?>
									<a href="<?php the_permalink() ?>"><?php _e('Read More','om_theme') ?></a>
								</div>
							<?php } ?>
						</li>

		<?php endwhile; ?>
		
		<?php wp_reset_postdata(); ?>
						<!-- /Items -->
						<li class="next"><?php _e('More','om_theme')?> <span class="colored">&gt;</span></li> <!-- Next link -->
					</ul>
					<div class="clear"></div>
				</div>
			</div>
		</div>
		<!-- /Partners, Testimnials -->

		<div class="content-pane-divider"></div>
		
<?php } ?>