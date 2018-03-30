<?php global $query; if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>

	<!-- Article -->
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>

		<div class="row">
			<div class="offset2 span8 ">

				<div class="categories serif">
					<?php
						$categories = get_the_category();
						$separator  = ', ';
						$output     = '';
						if ( $categories ) :
							foreach ( $categories as $category ) {
								$output .= '<a href="' . get_category_link( $category->term_id ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s", "spritz" ), $category->name ) ) . '" class="">' . $category->cat_name . '</a>' . $separator;
							}
							echo trim($output, $separator);
						endif;
					?>
				</div>

				<!-- Post Title -->
				<h2 class="post-title"><?php if (is_sticky()) { echo '<i class="icon-pushpin sticky" title="Sticky"></i> ';}?><a href="<?php echo get_permalink( $post->ID ); ?>" class=""><?php the_title(); ?></a></h2>
				<!-- /Post Title -->

				<hr class="sexy_line"/>
				<div class="tags"><?php the_tags( '' );?></div>

				<?php if ( has_post_thumbnail() ) :
					$src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'slides', false, '' ); ?>
					<div class="header" style="background-image:url(<?php echo $src[0] ?>); ">
						<div class="diamond"><?php spritz_short_posted_on(); ?></div>
					</div>
				<?php endif; ?>

				<?php the_excerpt(); // Dynamic Content ?>
			</div>
		</div>

	</article>
	<!-- /Article -->

<?php endwhile; else: ?>
	<div class="row">
		<div class="offset2 span8 ">

			<!-- Article -->
			<article>
				<h1><?php _e( 'Sorry, nothing to display.', 'spritz' ); ?></h1>
				<p><?php _e( 'You are looking for an empty page. We are sorry for the inconvenience.', 'spritz' ); ?></p>
				<hr class="sexy_line" />
				<p><a href="/"><?php _e( 'Return to home', 'spritz' ); ?></a></p>
			</article>
			<!-- /Article -->

		</div>
	</div>

<?php endif; ?>