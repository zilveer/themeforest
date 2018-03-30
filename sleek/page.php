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

				<?php

					$comments_main = false;
					if(
						get_post_meta( get_the_ID(), 'comments_use', true ) != '0' // comments are not disabled on post MUST
						&& ( comments_open() || get_comments_number() > 0 ) // comments are open or count > 0 MUST
						&& (
							!$theme_settings->layout['use_sidebar'] // global sidebar is off
							|| !$theme_settings->layout['comments_in_sidebar'] // comments are not in sidebar
						)
					){
						$comments_main = true;
					}

					$page_blog_use = get_post_meta( get_the_ID(), 'blog_use', true );



					$post_classes = '';
					$post_classes .= ' article-single article-single--page';

					if( !$comments_main && $page_blog_use ){
						$post_classes .= ' article-single--post-blog-last';
					}
				?>



				<!-- article -->
				<article id="post-<?php the_ID(); ?>" <?php post_class( $post_classes ); ?> role="main">



					<?php get_template_part('title_header'); ?>



					<div class="post__content">
						<?php the_content(); ?>
					</div>



					<?php get_template_part('link-split-pages'); ?>



					<?php
						if( get_post_meta( get_the_ID(), 'blog_use', true ) ){
							get_template_part('page_blog');
						}
					?>



					<?php if( $comments_main ){
						echo '<div class="post__comments">';
						comments_template();
						echo '</div>';
					}?>



				</article> <!-- /.page -->



			<?php endwhile; ?>
			<?php endif; ?>

			</div>
			</div>

		</div> <!-- /main content -->

		<?php get_sidebar(); ?>

	</div> <!-- /# content wrapper inside -->
</div> <!-- /# content wrapper -->

<?php get_footer(); ?>
