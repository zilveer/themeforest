<?php get_header(); ?>

<?php $page_id = get_option( 'page_for_posts' );
$lsvr_sidebar_settings_meta = get_post_meta( $page_id, '_lsvr_sidebar_settings_meta', true );
$sidebar_pos = is_array( $lsvr_sidebar_settings_meta ) && array_key_exists( 'pos', $lsvr_sidebar_settings_meta ) ? $lsvr_sidebar_settings_meta['pos'] : 'right';
$sidebar_mobilepos = is_array( $lsvr_sidebar_settings_meta ) && array_key_exists( 'mobilepos', $lsvr_sidebar_settings_meta ) ? $lsvr_sidebar_settings_meta['mobilepos'] : 'bottom';
?>

<div id="core" <?php post_class(); ?>>

	<!-- PAGE HEADER : begin -->
	<div id="page-header">
		<div class="container">
			<?php if ( is_single() ) : ?>
				<h1 class="m-secondary-font"><?php the_title(); ?></h1>
			<?php else : ?>
				<h1 class="m-secondary-font"><?php echo get_the_title( $page_id ); ?></h1>
			<?php endif; ?>
			<?php get_template_part( 'title', 'breadcrumb' ); ?>
		</div>
	</div>
	<!-- PAGE HEADER : begin -->

	<div class="container">
		<div class="row">

			<?php if ( $sidebar_mobilepos === 'top' ) : ?>
			<div class="col-md-4
				<?php if ( $sidebar_pos === 'right' ) { echo ' col-md-push-8'; } ?>">

				<?php // SIDEBAR
				get_sidebar(); // load sidebar.php ?>

			</div>
			<?php endif; ?>

			<div class="col-md-8
				<?php if ( $sidebar_pos === 'left' && $sidebar_mobilepos === 'bottom' ) { echo ' col-md-push-4'; } ?>
				<?php if ( $sidebar_pos === 'right' && $sidebar_mobilepos === 'top' ) { echo ' col-md-pull-4'; } ?>">

				<!-- PAGE CONTENT : begin -->
				<div id="page-content">

					<?php if ( have_posts() ) : ?>

						<?php if ( is_single() ) : ?>

							<!-- BLOG DETAIL : begin -->
							<div class="blog-detail">
							<?php while ( have_posts() ) : the_post(); ?>

								<?php get_template_part( 'article' ); ?>

							<?php endwhile; ?>
							</div>
							<!-- BLOG DETAIL : end -->

						<?php else : ?>

							<!-- BLOG LIST : begin -->
                            <div class="blog-list">
							<?php while ( have_posts() ) : the_post(); ?>

								<?php get_template_part( 'article' ); ?>

							<?php endwhile; ?>
                            </div>
							<!-- BLOG LIST : end -->

                            <?php lsvr_pagination(); ?>

						<?php endif; ?>

					<?php else : ?>

						<div class="various-content">
							<p class="c-alert-message m-info max-width-400 margin-sides-auto"><i class="ico fa fa-info-circle"></i><?php _e( 'No posts found!', 'beautyspot' ); ?></p>
						</div>

					<?php endif; ?>

				</div>
				<!-- PAGE CONTENT : end -->

			</div>

			<?php if ( $sidebar_mobilepos === 'bottom' ) : ?>
			<div class="col-md-4
				<?php if ( $sidebar_pos === 'left' ) { echo ' col-md-pull-8'; } ?>">

				<?php // SIDEBAR
				get_sidebar(); // load sidebar.php ?>

			</div>
			<?php endif; ?>

		</div>
	</div>

</div>

<?php get_footer(); ?>