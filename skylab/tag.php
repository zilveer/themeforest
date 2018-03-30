<?php
get_header(); ?>
	<?php $header_background_for_blog = ot_get_option( 'header_background_for_blog' ); ?>
	<?php if ( ! empty( $header_background_for_blog ) ) { ?>
	<?php $parallax_header_background_for_blog = ot_get_option( 'parallax_header_background_for_blog' ); ?>
	<div class="entry-header-wrapper" style="background-image: url(<?php echo esc_attr( $header_background_for_blog ); ?>);" <?php if ( ! empty( $parallax_header_background_for_blog ) ) { ?>data-600-top="background-position:50% 75%;" data--600-top="background-position:50% 25%;" data-smooth-scrolling="on"<?php } ?>>
		<header class="entry-header clearfix">
			<h1 class="entry-title"><?php printf( __( 'Tag: %s', 'mega' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?></h1>
		</header><!-- .entry-header -->
	</div>
	<?php } else { ?>
		<div class="entry-header-wrapper">
		<header class="entry-header clearfix">
			<h1 class="entry-title"><?php printf( __( 'Tag: %s', 'mega' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?></h1>
		</header><!-- .entry-header -->
	</div>
	<?php } ?>
	
	<div id="main" class="clearfix">
		<div id="primary">
			<div id="content" role="main">

				<?php if ( have_posts() ) : ?>

					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'content', get_post_format() ); ?>

					<?php endwhile; ?>

				<?php mega_pagination_content_nav( 'nav-pagination' ); ?>

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'mega' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'mega' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php $remove_sidebar_and_center_posts = ot_get_option( 'remove_sidebar_and_center_posts' ); ?>
<?php if ( empty( $remove_sidebar_and_center_posts ) ) { ?>
<?php get_sidebar(); ?>
<?php } ?>
<?php get_footer(); ?>