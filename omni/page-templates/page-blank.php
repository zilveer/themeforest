<?php
/**
 * Template Name: Blank page
 *
 * @package omni
 */
?>

<?php
if ( null === cs_get_customize_option( 'page_sidebar' ) ) {
	$page_sidebar = 'none';
} else {
	$page_sidebar = cs_get_customize_option( 'page_sidebar' );
}

$page_meta = get_post_meta( get_the_ID(), 'custom_sidebar_options', true );
if ( isset( $page_meta['custom_page_sidebar'] ) && ! ( $page_meta['custom_page_sidebar'] == '' ) && ! ( $page_meta['custom_page_sidebar'] == 'default' ) ) {
	$page_sidebar = $page_meta['custom_page_sidebar'];
}

if ( isset( $page_sidebar ) && ( $page_sidebar == 'left' ) ) {
	$sidebar_class = 'pull-right';
} else {
	$sidebar_class = '';
}

$blank_page_meta = get_post_meta( get_the_ID(), 'blank_template_options', true );
?>

<?php if ( isset( $blank_page_meta['blank_page_header_enable'] ) && true === $blank_page_meta['blank_page_header_enable'] ) {
	get_header();
} else {
	?>
	<!DOCTYPE html>
	<!--[if lt IE 7]>
	<html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
	<!--[if ( IE 7 )&!( IEMobile )]>
	<html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
	<!--[if ( IE 8 )&!( IEMobile )]>
	<html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
	<!--[if gt IE 8]><!-->
	<html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

	<head>
		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>
	<div id="main-wrapper">
<?php } ?>

	<section class="blog-section">
		<div class="container">
			<?php if ( ! ( true === $page_meta['page_padding_disable'] ) && isset( $page_meta['page_padding_disable'] ) ){ ?>
			<div class="new-block">
				<?php } ?>
				<div class="row">

					<?php if (isset( $page_sidebar ) && ( $page_sidebar == 'none' )){ ?>
					<div class=" col-md-12 col-sm-12 col-xs-12">
						<?php }else{ ?>
						<div class=" col-md-8 col-sm-8 col-xs-12 <?php echo esc_attr( $sidebar_class ); ?>">
							<?php } ?>

							<?php /* Start the Loop */ ?>
							<?php while ( have_posts() ) : the_post(); ?>

								<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

									<div class="blog-wrapper single-blog-wrapper">

										<?php if ( ! ( true === $page_meta['page_title_hide'] ) && isset( $page_meta['page_title_hide'] ) ) { ?>

											<div class="aligntext">

												<?php omni_entry_categories( true ); ?>

												<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

												<div class="entry-meta">
													<?php omni_posted_on(); ?>
												</div>
												<!-- .entry-meta -->

											</div>
											<!--.text-center-->

										<?php } ?>

										<?php the_content(); ?>

									</div>
									<!--.blog-wrapper-->

								</article><!-- #post-## -->

							<?php endwhile; ?>

						</div>
						<!-- end content -->

						<?php if ( ! ( $page_sidebar == 'none' ) ) {
							get_sidebar();
						} ?>

					</div>
					<!--.row-->
					<?php if ( ! ( true === $page_meta['page_padding_disable'] ) && isset( $page_meta['page_padding_disable'] ) ){ ?>
				</div>
			<?php } ?>
			</div>
			<!--.container-->

	</section>
	<!--.blog-section-->

<?php if ( isset( $blank_page_meta['blank_page_footer_enable'] ) && true === $blank_page_meta['blank_page_footer_enable'] ) {
	get_footer();
} else {
	?>

	<?php wp_footer(); ?>
	</div><!--main-wrapper-->
	</body>
	</html>
<?php } ?>