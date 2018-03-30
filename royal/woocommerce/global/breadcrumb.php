<?php
/**
 * Shop breadcrumb
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 * @see         woocommerce_breadcrumb()
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $wp_query;

$l = et_page_config();

$delimiter    = '<span class="delimeter">/</span>';

if ($l['heading'] !== 'disable' && !$l['slider']):
?>
<div class="page-heading bc-type-<?php etheme_option('breadcrumb_type'); ?>">
	<div class="container">
		<div class="row">
			<div class="col-md-12 a-center">
				
				<?php do_action('etheme_before_breadcrumbs'); ?>
								<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
					<h1 class="title">
                        <?php if(is_single() && ! is_attachment()): ?>
                            <?php echo get_the_title(); ?>
                        <?php else: ?>
                            <?php woocommerce_page_title(); ?>
                        <?php endif; ?>
                    </h1>
				<?php endif; ?>

				<?php if ( $breadcrumb ) : ?>

					<?php echo $wrap_before; ?>

					<?php foreach ( $breadcrumb as $key => $crumb ) : ?>

						<?php echo $before; ?>

						<?php if ( ! empty( $crumb[1] ) && sizeof( $breadcrumb ) !== $key + 1 ) : ?>
							<?php echo '<a href="' . esc_url( $crumb[1] ) . '">' . esc_html( $crumb[0] ) . '</a>'; ?>
						<?php else : ?>
							<?php echo esc_html( $crumb[0] ); ?>
						<?php endif; ?>

						<?php echo $after; ?>

						<?php if ( sizeof( $breadcrumb ) !== $key + 1 ) : ?>
							<?php echo $delimiter; ?>
						<?php endif; ?>

					<?php endforeach; ?>

					<?php echo $wrap_after; ?>

				<?php endif; ?>

				
				<?php et_back_to_page(); ?>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>

<?php 
	if($l['breadcrumb_image'] != '') {
	    ?>
	        <style type="text/css">
	            .page-heading {
	                background-image: url(<?php echo $l['breadcrumb_image']; ?>);
	            }
	        </style>
	    <?php
	}
 ?>


<?php if($l['slider']): ?>
	<div class="page-heading-slider">
		<?php  echo do_shortcode('[rev_slider_vc alias="'.$l['slider'].'"]'); ?>
	</div>
<?php endif; ?>