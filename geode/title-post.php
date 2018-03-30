<?php
/**
 * @package WordPress
 * @subpackage Geode
 * @since Geode 1.0
 */
?>
<?php global $shortcodelic_blog_masonry; ?>

	<?php if ( (is_single() && !pix_hide_title()) || !is_single() ) { ?>
	<?php if ( is_single() && !geode_is_related()  ) : ?>

		<header class="entry-header row">
			<div class="row-inside">
				<?php do_action('pix_title_bg'); ?>
				<div class="<?php echo apply_filters('geode_fx_title',''); ?>">
					<?php the_title( '<h1 class="entry-title"><span class="row-inside">', '</span></h1>' ); ?>
	<?php else :
		if ( get_post_format() != 'aside' && get_post_format() != 'status' )
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
	endif; ?>

	<?php if ( !is_search() && !geode_is_related() && geode_blog_layout_class('')=='' && !$shortcodelic_blog_masonry ) : ?>
		<?php if (( !is_single() ) ) { ?>

			<div class="entry-meta">

			<?php 
				geode_posted_on('meta');

				if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) { ?>
					<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'geode' ), __( '1 Comment', 'geode' ), __( '% Comments', 'geode' ) ); ?></span>
				<?php } 
				//geode_posted_on('category');

			?>

			</div><!-- .entry-meta -->
			
			<?php } else {
				get_template_part( 'woocommerce/global/breadcrumb' );
			} ?>
	<?php endif; ?>

	<?php if ( is_single() && !geode_is_related()  ) : ?>
		</div>
	<?php endif; ?>

	<?php if ( is_single() && get_post_format() != 'aside' && get_post_format() != 'status' ) : ?>
			</div><!-- .row-inside -->
		</header><!-- .entry-header -->
	<?php endif; ?>
	<?php } else { ?>

		<header class="entry-header row height_0">
		</header><!-- .entry-header -->
	<?php } ?>


