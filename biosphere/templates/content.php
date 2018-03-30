<?php 
	
	// Globals
	global $dd_sn;
	global $dd_post_class;
	global $dd_thumb_size;
	global $dd_count;
	global $dd_max_count;
	global $dd_style;
	global $more; $more = 0; // Make the more tag work

	// Default - Post Class
	if ( ! isset( $dd_post_class ) ) {
		$dd_post_class = 'four columns ';
	}

	// Default - Thumb Size
	if ( ! isset( $dd_thumb_size ) ) {
		$dd_thumb_size = 'dd-one-fourth';	
	}

	// Default - Post Style
	if ( ! isset( $dd_style ) ) {
		$dd_style = 1;
	}

	// Post Class - Append - Thumbnail
	if ( has_post_thumbnail() ) {
		$dd_post_class_append = 'has-thumb ';
	} else {
		$dd_post_class_append = '';
	}

	// Post Class - Last (column)
	if ( $dd_count == $dd_max_count ) {
		$last_class = 'last';
		$dd_count = 0;
	} else {
		$last_class = '';
	}

	if ( $dd_count == 1 ) {
		$last_class = 'clear';
	}


?>

<?php if ( is_single() ) : ?>
		
	<div <?php post_class( 'blog-post-single' ); ?>>

		<div class="blog-post-single-main">

			<h1 class="blog-post-single-title"><?php the_title(); ?></h1>

			<div class="blog-post-single-meta">
				
				<div class="blog-post-single-meta-cats">

					<?php _e( 'Posted in:', 'dd_string' ); ?> <?php the_category( ', ' ); ?>

				</div><!-- .blog-post-single-meta-cats -->

				<div class="blog-post-single-meta-tags">

					<?php _e( 'Tags:', 'dd_string' ); ?> <?php the_tags( '', ', ' ); ?>

				</div><!-- .blog-post-single-meta-tags -->

			</div><!-- .blog-post-single-meta -->

			<div class="blog-post-single-content">

				<?php the_content(); ?>

			</div><!-- .blog-post-single-content -->

			<div id="post-pagination">
				<?php 
					$args = array(
						'before' => '',
						'after' => '',
						'link_before' => '<span class="dd-button">',
						'link_after' => '</span>',
						'next_or_number' => 'number',
						'pagelink' => '%',
					);
					wp_link_pages( $args ); 
				?>
			</div><!-- #post-pagination -->

		</div><!-- .blog-post-single-main -->

	</div><!-- .blog-post-single -->

<?php else : ?>

	<div <?php post_class( 'blog-post ' . $dd_post_class . $dd_post_class_append . $last_class ); ?>>

		<?php if ( $dd_style == '1' ) : ?>

			<div class="blog-post-inner">

				<div class="blog-post-thumb">

					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( $dd_thumb_size ); ?></a>

				</div><!-- .blog-post-thumb -->

				<div class="blog-post-main">

					<h2 class="blog-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

					<div class="blog-post-date"><?php the_time( get_option( 'date_format' ) ); ?></div>
						
					<div class="blog-post-excerpt">
						<?php the_excerpt(); ?>
					</div><!-- .blog-post-excerpt -->

					<div class="blog-post-category">
						<?php _e( 'Posted In:', 'dd_string' ); ?> <?php the_category( ', ' ); ?>
					</div><!-- .blog-post-category -->

					<div class="blog-post-permalink">
						<a href="<?php the_permalink(); ?>" class="dd-button small orange-light"><?php _e( 'CONTINUE READING', 'dd_string' ); ?></a>
					</div><!-- .blog-post-permalink -->

				</div><!-- .blog-post-main -->

			</div><!-- .blog-post-inner -->

			<?php if ( is_sticky() ) : ?><span class="dd-sticky"></span><?php endif; ?>

		<?php elseif ( $dd_style == '2' ) : ?>

			<div class="blog-post-inner clearfix">

				<div class="blog-post-thumb four columns">
					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'dd-one-fourth-crop' ); ?></a>
				</div><!-- .blog-post-thumb -->

				<div class="blog-post-main">

					<h2 class="blog-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

					<div class="blog-post-meta">

						<div class="blog-post-date"><?php the_time( get_option( 'date_format' ) ); ?></div>

						<div class="blog-post-category">
							<?php _e( 'Posted In:', 'dd_string' ); ?> <?php the_category( ', ' ); ?>
						</div><!-- .blog-post-category -->

					</div><!-- .blog-post-meta -->
						
					<div class="blog-post-excerpt">
						<?php the_excerpt(); ?>
					</div><!-- .blog-post-excerpt -->

					<div class="blog-post-permalink">
						<a href="<?php the_permalink(); ?>" class="dd-button small orange-light"><?php _e( 'CONTINUE READING', 'dd_string' ); ?></a>
					</div><!-- .blog-post-permalink -->

				</div><!-- .blog-post-main -->

			</div><!-- .blog-post-inner -->

		<?php endif; ?>

	</div><!-- .blog-post -->

<?php endif; ?>