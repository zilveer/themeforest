<?php
/**
 * @package quote
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> class="row gap">

	<div class="col-md-2 nopadding">
		<p><?php echo get_avatar( get_the_author_meta( 'ID' ), 190 ); ?></p>	
		<?php quote_posted_on(); ?>		
		<?php
			/* translators: used between list items, there is a space after the comma */
			$category_list = get_the_category_list( __( ', ', 'quote' ) );

			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list( '', __( ', ', 'quote' ) );

			if ( ! quote_categorized_blog() ) {
				// This blog only has 1 category so we just need to worry about tags in the meta text
				if ( '' != $tag_list ) {
					$meta_text = __( '<p class="post-details"><i class="fa fa-tag"></i> %2$s</p>', 'quote' );
				} else {
					$meta_text = __( '', 'quote' );
				}

			} else {
				// But this blog has loads of categories so we should probably display them here
				if ( '' != $tag_list ) {
					$meta_text = __( '<p class="post-details"><i class="fa fa-folder"></i> %1$s</p><p class="post-details"><i class="fa fa-tag"></i> %2$s</p>', 'quote' );
				} else {
					$meta_text = __( '<p class="post-details"><i class="fa fa-folder"></i> %1$s</p>.', 'quote' );
				}

			} // end check for categories on this blog

			printf(
				$meta_text,
				$category_list,
				$tag_list,
				get_permalink()
			);
		?>

		<?php edit_post_link( __( 'Edit', 'quote' ), '<span class="btn btn-primary btn-outlined edit-link">', '</span>' ); ?>		
	</div>

	<div class="col-md-10 post-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'quote' ),
				'after'  => '</div>',
			) );
		?>

		<?php $postshare = get_theme_mod('single_social' , 'show');
        $projectshare = get_theme_mod('portfolio_social', 'show');
        if ($postshare == 'show' || $projectshare == 'show') { quote_share(); } ?>

		<?php 
        $authorinfo = get_theme_mod('author_info', 'show');
        $posnav = get_theme_mod('post_links', 'show'); ?>

        <?php if ($authorinfo == 'show' && !is_singular('dt_portfolio_cpt')) { require_once( trailingslashit( get_template_directory() ) . 'author-bio.php' ); } else { ?><hr class="gap"><?php } ?>

		<?php if ($posnav == 'show') { quote_post_nav(); } ?>

		<?php dt_related_posts(); ?>

		<?php
			// If comments are open or we have at least one comment, load up the comment template
			if ( comments_open() || '0' != get_comments_number() ) :
				comments_template();
			endif;
		?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->
