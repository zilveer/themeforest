<?php
get_header(); ?>
	<?php $header_background_for_blog = ot_get_option( 'header_background_for_blog' ); ?>
	<?php $parallax_header_background_for_blog = ot_get_option( 'parallax_header_background_for_blog' ); ?>
	<?php if ( ! empty( $header_background_for_blog ) ) { ?>
	
	<?php $blog_header_margin = ot_get_option( 'blog_header_margin' ); ?>
	<?php if ( empty( $blog_header_margin ) ) { ?>
		<?php $blog_header_margin = '130'; ?>
	<?php } ?>
	
	<div class="entry-header-wrapper" style="background-image: url(<?php echo esc_attr( $header_background_for_blog ); ?>);" <?php if ( ! empty( $parallax_header_background_for_blog ) ) { ?>data-600-top="background-position:50% 75%;" data--600-top="background-position:50% 25%;" data-smooth-scrolling="on"<?php } ?>>
		<header class="entry-header clearfix" <?php if ( $blog_header_margin != '130' ) { ?>style="margin: <?php echo esc_attr( $blog_header_margin - 1 ); ?>px auto  <?php echo esc_attr( $blog_header_margin ); ?>px";<?php } ?>>
			<?php $title = single_post_title();?>
			<h1 class="entry-title"><?php echo $title; ?></h1>
		</header><!-- .entry-header -->
	</div>
	<?php } else { ?>
		<?php $remove_sidebar_and_center_posts = ot_get_option( 'remove_sidebar_and_center_posts' ); ?>
		<?php if ( empty( $remove_sidebar_and_center_posts ) ) { ?>
		
			<?php $background_overlay_color_for_heading = ot_get_option( 'background_overlay_color_for_heading' ); ?>
			<?php if ( empty( $background_overlay_color_for_heading ) ) { ?>
				<?php $background_overlay_color_for_heading = '#ffffff'; ?>
			<?php } ?>
						
			<?php $background_overlay_opacity_for_heading = ot_get_option( 'background_overlay_opacity_for_heading' ); ?>
			<?php if ( empty( $background_overlay_opacity_for_heading ) ) { ?>
				<?php $background_overlay_opacity_for_heading = '.1'; ?>
			<?php } ?>
			<?php $rgb = mega_hex2rgb( $background_overlay_color_for_heading ); ?>
			<?php $rgba = "rgba(" . $rgb[0] . ", " . $rgb[1] . ", " . $rgb[2] . ", " . $background_overlay_opacity_for_heading . ")"; ?>
						
			<?php $color_for_heading = ot_get_option( 'color_for_heading' ); ?>
			<?php if ( empty( $color_for_heading ) ) { ?>
				<?php $color_for_heading = '#111111'; ?>
			<?php } ?>
		
			<div class="entry-header-wrapper" <?php if ( $background_overlay_color_for_heading != '#ffffff' || $background_overlay_opacity_for_heading != '.1' ) { ?>style="<?php if ( $background_overlay_color_for_heading != '#ffffff' ) { ?>background: <?php echo esc_attr( $background_overlay_color_for_heading ); ?>;<?php } ?> <?php if ( $background_overlay_opacity_for_heading != '.1' ) { ?>background: <?php echo esc_attr( $rgba ); ?>;<?php } ?>"<?php } ?>>
				<header class="entry-header clearfix">
					<?php //$title = single_post_title(); ?>
					<h1 class="entry-title" <?php if ( $color_for_heading != '#111111' ) { ?>style="color: <?php echo esc_attr( $color_for_heading ); ?>";<?php } ?>><?php single_post_title(); ?></h1>
				</header><!-- .entry-header -->
			</div>
		<?php } ?>
	<?php } ?>
	
	<div id="main" class="clearfix">
		<div id="primary">
			<div id="content" role="main">

				<?php if ( have_posts() ) : ?>

					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'content', get_post_format() ); ?>

					<?php endwhile; ?>
			
					<?php mega_content_nav( 'nav-pagination-single' ); ?>

				<?php else : ?>

					<article id="post-0" class="post no-results not-found">
						<header class="entry-header">
							<h1 class="entry-title"><?php _e( 'Nothing Found', 'mega' ); ?></h1>
						</header><!-- .entry-header -->

						<div class="entry-content">
							<p><?php _e( 'Apologies, but no results were found for the requested archive.', 'mega' ); ?></p>
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