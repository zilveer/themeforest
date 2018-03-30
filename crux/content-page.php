<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package StagFramework
 * @subpackage Crux
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); stag_markup_helper( array( 'context' => 'entry' ) ); ?>>
	<header class="entry-header">

	<?php if ( stag_is_woocommerce_active() && is_cart() ) : ?>
		<h1 class="entry-title inline-title"<?php stag_markup_helper( array( 'context' => 'title' ) ); ?>><?php _e( 'Your Shopping Cart', 'stag' ); ?></h1>
		<a href="<?php echo get_permalink( woocommerce_get_page_id('shop') ); ?>" class="button button-secondary"><?php _e( 'Continue Shopping', 'stag' ); ?></a>
	<?php elseif ( stag_is_woocommerce_active() && is_account_page() && !is_user_logged_in() ): ?>
		<h1 class="section-header"<?php stag_markup_helper( array( 'context' => 'title' ) ); ?>><?php _e( 'Login or Signup for a new Account', 'stag' ); ?></h1>
	<?php else : ?>
		<h1 class="entry-title"<?php stag_markup_helper( array( 'context' => 'title' ) ); ?>><?php the_title(); ?></h1>
	<?php endif; ?>

	</header><!-- .entry-header -->

	<div class="entry-content"<?php stag_markup_helper( array( 'context' => 'entry_content' ) ); ?>>
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'stag' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->
