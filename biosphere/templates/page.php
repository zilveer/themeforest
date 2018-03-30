<div <?php post_class( 'page-single' ); ?>>

	<div class="page-single-main">

		<h1 class="page-single-title"><?php the_title(); ?></h1>

		<div class="page-post-content">

			<?php the_content(); ?>

		</div><!-- .page-post-content -->

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

	</div><!-- .page-post-single-main -->

</div><!-- .page-post-single -->