<?php
/**
 * @package quote
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> class="row gap">

	<div class="col-md-12 post-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'quote' ),
				'after'  => '</div>',
			) );
		?>

		<?php $postshare = get_theme_mod('single_social', 'show');
        $projectshare = get_theme_mod('portfolio_social', 'show');
        if ($postshare == 'show' || $projectshare == 'show') { quote_share(); } ?>

		<hr class="gap">

		<?php quote_post_nav(); ?>

		<?php dt_related_posts(); ?>

		<?php
			// If comments are open or we have at least one comment, load up the comment template
			if ( comments_open() || '0' != get_comments_number() ) :
				comments_template();
			endif;
		?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->
