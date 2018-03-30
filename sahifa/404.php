<?php get_header(); ?>
	<div class="content">
			
		<div class="post error404 full-width">
			<div class="post-inner">
				<div class="title-404"><?php _eti( '404 :(' ); ?></div>
				<h2 class="post-title"><?php _eti( 'Not Found' ); ?></h2>
				<div class="clear"></div>
				<div class="entry">
					<p><?php _eti( 'Apologies, but the page you requested could not be found. Perhaps searching will help.' ); ?></p>
					
					<div class="search-block-large">
						<form method="get" action="<?php echo home_url(); ?>/">
							<button class="search-button" type="submit" value="<?php if( !$is_IE ) _eti( 'Search' , 'tie' ) ?>"><i class="fa fa-search"></i></button>	
							<input type="text" id="s" name="s" value="<?php _eti( 'Search' ) ?>" onfocus="if (this.value == '<?php _eti( 'Search' ) ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _eti( 'Search' ) ?>';}"  />
						</form>
					</div><!-- .search-block /-->	
				</div><!-- .entry /-->	
	
				<?php 
					$original_post = $post;

					$args = array( 'posts_per_page'=> 4 , 'no_found_rows' => 1 );	
					$related_query = new wp_query( $args );
					if( $related_query->have_posts() ) : $count=0;
				?>
	
				<section id="related_posts">
					<div class="block-head">
						<h3><?php _eti( 'Check Also' ); ?></h3><div class="stripe-line"></div>
					</div>
					<div class="post-listing">
						<?php while ( $related_query->have_posts() ) : $related_query->the_post()?>
						<div <?php tie_post_class('related-item'); ?>>
							<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) : ?>			
							<div class="post-thumbnail">
								<a href="<?php the_permalink(); ?>" rel="bookmark">
									<?php the_post_thumbnail( 'tie-medium' ); ?>
									<span class="fa overlay-icon"></span>
								</a>
							</div><!-- post-thumbnail /-->
							<?php endif; ?>			
							<h3><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
							<p class="post-meta"><?php tie_get_time() ?></p>
						</div>
						<?php endwhile;?>
						<div class="clear"></div>
					</div>
				</section>
				<?php
				endif;
				
				$post = $original_post;
				wp_reset_query();
				?>
	
			</div><!-- .post-inner -->
		</div><!-- .post-listing -->
	</div>
<?php get_footer(); ?>