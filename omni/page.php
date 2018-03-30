<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package omni
 */

get_header(); ?>

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


?>

	<section id="page-wrapper" class="blog-section">
		<div class="container">
			<?php if ( ! ( true === $page_meta['page_padding_disable'] ) && isset( $page_meta['page_padding_disable'] ) ){ ?>
			<div class="new-block">
				<?php }?>
			<div class="row">
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'page' ); ?>

			<?php endwhile; // End of the loop. ?>

			<?php if ( !($page_sidebar == 'none') ) {
				get_sidebar();
			} ?>
			</div><!--.row-->
				<?php if ( ! ( true === $page_meta['page_padding_disable'] ) && isset( $page_meta['page_padding_disable'] ) ){ ?>
		</div>
		<?php }?>
		</div><!-- .container -->
	</section><!-- #page-wrapper -->


<?php get_footer(); ?>
