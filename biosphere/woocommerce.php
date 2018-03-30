<?php
/**
 * The Template for showing WooCommerce pages.
 */

get_header();

$content_class = '';
$layout = get_post_meta( get_the_ID(), $dd_sn . 'layout', true );

if ( empty( $layout ) || $layout == 'cs' ) {
	$content_class = 'two-thirds column';
}

?>
		
	<div class="container clearfix">

		<div id="content" class="<?php echo $content_class; ?>">

			<div class="page-single">

				<div class="page-single-main">

					<?php woocommerce_content(); ?>

				</div><!-- .page-single-main -->

			</div><!-- .page-single -->

		</div>

		<?php if ( empty( $layout ) || $layout == 'cs' ) { get_sidebar( 'woocommerce' ); } ?>

	</div><!-- .container -->

<?php get_footer(); ?>