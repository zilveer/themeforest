<div class="article--grid__header">
	<a href="<?php the_permalink(); ?>">
		<div class="article--grid__thumb article__featured-image">

			<?php
			$flush_top = 'push--top';

			if ( has_post_thumbnail() ):

				$thumbsize = 'blog-medium';
				$has_thumb = has_post_thumbnail();

				// flush if we have a thumbnail
				$flush_top = 'flush--top';

				// grab the desired thumb size from the query params if present
				global $wp_query;

				if ( isset( $wp_query->query_vars['thumbnail_size'] ) ) {
					$thumbsize = $wp_query->query_vars['thumbnail_size'];
				}

				$image = wp_get_attachment_image_src( get_post_thumbnail_id(), $thumbsize );

				$image_ratio = bucket::get_image_aspect_ratio( $image );
				?>

				<div class="image-wrap" style="padding-top: <?php echo $image_ratio; ?>%">
					<?php bucket::the_img_tag( $image[0], get_the_title() ) ?>
				</div>
				<?php post_format_icon();
				if ( bucket::has_average_score() ) {
					?>
					<div class="badge  badge--article"><?php echo bucket::get_average_score(); ?>
						<span class="badge__text"><?php __( 'score', 'bucket' ) ?></span></div>
				<?php } ?>

			<?php
			endif;
			?>

		</div>

		<div class="article__title  article--grid__title <?php echo $flush_top; ?>">
			<h3 class="hN"><?php the_title(); ?></h3>
		</div>
	</a>
</div>
