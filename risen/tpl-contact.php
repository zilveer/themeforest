<?php
/* Template Name: Contact */

// Header
get_template_part( 'header', 'page' ); // this makes $content_title available

?>

<?php while ( have_posts() ) : the_post(); ?>

<div id="content">

	<div id="content-inner"<?php if ( risen_sidebar_enabled( 'contact' ) ) : ?> class="has-sidebar"<?php endif; ?>>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<?php if ( $content_title ) : // this comes from header-page.php; empty if no title should show at top of content ?>
			<header>
				<h1 class="page-title"><?php echo $content_title ?></h1>
			</header>
			<?php endif; ?>

			<?php if ( trim( strip_tags( $post->post_content ) ) ) : // has content ?>
				<div class="post-content"> <!-- confines heading font to this content -->
					<?php the_content(); ?>
				</div>
			<?php endif; ?>

			<?php
			// multipage nav: 1, 2, 3, etc. for when <!--nextpage--> is used in content
			if ( ! post_password_required() ) {
				wp_link_pages( array(
					'before'	=> '<div class="box multipage-nav"><span>' . __( 'Pages:', 'risen' ) . '</span>',
					'after'		=> '</div>'
				) );
			}
			?>

			<?php if ( get_edit_post_link( $post->ID ) ) : ?>
			<footer class="box page-footer">
				<?php edit_post_link( __( 'Edit Page', 'risen' ), '<span class="edit-link">', '</span>' ); ?>
			</footer>
			<?php endif; ?>

		</article>

		<?php // NO COMMENTS comments_template( '', true ); ?>

	</div>

</div>

<?php risen_show_sidebar( 'contact' ); ?>

<?php endwhile; ?>

<?php get_footer(); ?>