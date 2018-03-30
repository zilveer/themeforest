<?php
/**
 * Template part for displaying single posts.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package omni
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="blog-wrapper">

		<?php
			echo '<div class="blog-media">';

			echo '</div><!-- end media -->';
		?>
		<div class="blog-desc">
			<header class="entry-header">

				<?php omni_entry_categories( true ); ?>

				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

				<div class="entry-meta">
					<?php omni_posted_on(); ?>
				</div>
				<!-- .entry-meta -->
			</header>
			<!-- .entry-header -->


			<div class="entry-content">
				<?php the_content(); ?>
				<?php
				numbered_in_page_links(array(
					'before' => '<div class="page-links">' . wp_kses(__( '<span class="page-links-wrapper">Pages:</span>', 'omni' ),array('span' => array( 'class' => array()))),
					'after'  => '</div>',
					'highlight_before' => '<span class="page-links-wrapper">',
					'highlight_after' => '</span>',
				));
				?>
			</div>
			<!-- .entry-content -->

			<footer class="entry-footer">
				<?php omni_entry_footer(); ?>

			</footer>
			<!-- .entry-footer -->

			<div class="blog-social social-share" data-directory="<?php echo esc_url( get_template_directory_uri() ); ?>"
			     data-template="share_full_post"></div>
			<!-- end blog-social -->

		</div>

		<?php crum_post_navigation(); ?>

	</div>
</article><!-- #post-## -->

<?php

get_template_part( 'template-parts/authorbox' );

