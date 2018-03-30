<div class="eltd-related-posts-holder">
	<?php
		if ( $related_posts && $related_posts->have_posts() ) : ?>

			<div class="eltd-related-posts-title">
				<h5><?php esc_html_e( 'Related Posts', 'flow' ); ?></h5>
			</div>

			<div class="eltd-related-posts-inner clearfix">
				<?php while ( $related_posts->have_posts() ) :
					$related_posts->the_post();
					?>
					<div class="eltd-related-post" id="post-<?php echo esc_attr(get_the_ID())?>">
						<a href="<?php the_permalink(); ?> ">
							<div class="eltd-related-post-image">
								<?php if ( has_post_thumbnail() ) :
									the_post_thumbnail(array(600,400));
									do_action( 'flow_elated_after_related_post_image' );
								endif; ?>
							</div>
						</a>
						<div class="eltd-related-post-title">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
								<?php the_title( '<h6>', '</h6>' ); ?>
							</a>
							<span class="eltd-related-post-date">
								<?php the_time(get_option('date_format')); ?>
							</span>
						</div>
					</div>
					<?php
				endwhile;
				?>
			</div>
		<?php
		endif;
	wp_reset_postdata();
	?>
</div>