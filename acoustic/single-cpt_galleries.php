<?php get_header(); ?>

<?php get_template_part('inc_section'); ?>

<div class="row main">
	<div class="twelve columns">

		<ol class="row listing">
			<?php ci_column_classes(ci_setting('archive_tpl'), 12, true); ?>

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<?php
					$captions= get_post_meta($post->ID, 'ci_cpt_galleries_caption', true);
					$attachments = ci_featgal_get_attachments();
				?>

				<?php while ( $attachments->have_posts() ) : $attachments->the_post(); ?>
					<?php
						$attr = array(
							'alt'   => trim(strip_tags( get_post_meta($post->ID, '_wp_attachment_image_alt', true) )),
							'title' => trim(strip_tags( $post->post_title )),
							'class'	=> 'scale-with-grid'
						);
						$img_attrf = wp_get_attachment_image_src( $post->ID, 'large' );
					?>

					<li class="<?php echo ci_column_classes(ci_setting('archive_tpl'), 12); ?> columns">
						<div class="widget-content">
							<?php
								$gallery_class = '';
								if($captions == 1)
									$gallery_class = 'gallery-link-pad';
							?>

							<a href="<?php echo $img_attrf[0]; ?>" title="" data-rel="prettyPhoto[pp_gal]" class="gallery-link <?php echo $gallery_class; ?>"><?php echo wp_get_attachment_image( $post->ID, 'ci_featured', false, $attr ); ?></a>
	
							<?php if ($captions == 1): ?>
								<div class="album-info">
									<h4 class="pair-title"><?php the_title(); ?></h4>
								</div>
							<?php endif; ?>
						</div>
					</li>
				<?php endwhile; ?>
				<?php
					// We need this after the nested loop ends
					wp_reset_postdata();
				?>
			<?php endwhile; endif; ?>
		</ol><!-- /discography -->

	</div><!-- /twelve columns -->
</div><!-- /row -->

<?php get_footer(); ?>