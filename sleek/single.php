<?php
	$theme_settings = sleek_theme_settings();
	get_header();
?>

<!-- wrapper -->
<div id="content-wrapper" class="content-wrapper">
	<div id="content-wrapper-inside" class="content-wrapper__inside <?php echo sleek_layout_classes(); ?>">

		<div id="main-content" class="main-content">

			<!-- main content -->
			<div class="main-content__inside js-nano js-nano-main" role="main">
			<div class="nano-content">



			<?php if (have_posts()): while (have_posts()) : the_post(); ?>



				<!-- Post Classes -->
				<?php
					$post_classes = '';
					$post_classes .= ' article-single article-single--post';
					$post_classes .= ' post--size-large';

					if( get_post_meta( get_the_ID(), 'image_is_light', true ) ){
						$post_classes .= ' image-light';
					}else{
						$post_classes .= ' image-dark';
					}

					$post_format = get_post_format();
				?>



				<!-- article -->
				<article id="post-<?php the_ID(); ?>" <?php post_class( $post_classes ); ?> role="main">



					<?php get_template_part('single_item_head'); ?>



					<!-- Only Standard Post -->
					<?php if( !$post_format ):

						echo '<div class="post__intro">';

						// Show Excerpt
						if(
							$post->post_excerpt
							&& get_post_meta( get_the_ID(), 'show_excerpt', true ) != '0'
						){
							echo '<p class="highlighted-p excerpt">'.wptexturize( $post->post_excerpt ).'</p>';
						}

						// Show Featured Image
						if(
							has_post_thumbnail()
							&& get_post_meta( get_the_ID(), 'show_featured_image', true ) != '0'
						){
							the_post_thumbnail( 'l' );
						}

						if(
							(
								$post->post_excerpt
								&& get_post_meta( get_the_ID(), 'show_excerpt', true ) != '0'
							)
							|| (
								has_post_thumbnail()
								&& get_post_meta( get_the_ID(), 'show_featured_image', true ) != '0'
							)
						){
							echo '<div class="separator separator--medium"></div>';
						}

						echo '</div>';

					endif; ?>
					<!-- /Only Standard Post -->



					<div class="post__content">
						<?php the_content(); ?>
					</div>

					<?php get_template_part('link-split-pages'); ?>



					<?php if( $theme_settings->posts['post_tags'] ): ?>
						<div class="post__tags">
							<?php echo get_the_tag_list(); ?>
						</div>
					<?php endif; ?>



					<?php if( $theme_settings->posts['post_share'] ): ?>
						<div class="post__share">
							<?php get_template_part('share_block'); ?>
						</div>
					<?php endif; ?>



					<?php if( $theme_settings->posts['post_author'] ): ?>
						<div class="post__author">
							<?php get_template_part('author_block'); ?>
						</div>
					<?php endif; ?>



					<?php if( $theme_settings->posts['post_related'] ): ?>
						<div class="post__related">
							<?php get_template_part('related_posts') ?>
						</div>
					<?php endif; ?>


					<?php if(
						get_post_meta( get_the_ID(), 'comments_use', true ) != '0' // comments are not disabled on post MUST
						&& ( comments_open() || get_comments_number() > 0 ) // comments are open or count > 0 MUST
						&& (
							!$theme_settings->layout['use_sidebar'] // global sidebar is off
							|| !$theme_settings->layout['comments_in_sidebar'] // comments are not in sidebar
						)
					){
						echo '<div class="post__comments">';
						comments_template();
						echo '</div>';
					}?>



				</article> <!-- /.post -->



			<?php endwhile; ?>
			<?php endif; ?>

			</div>
			</div>

		</div> <!-- /main content -->

		<?php get_sidebar(); ?>

	</div> <!-- /# content wrapper inside -->
</div> <!-- /# content wrapper -->

<?php get_footer(); ?>
