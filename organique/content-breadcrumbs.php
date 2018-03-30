<?php
/**
 * Helper file for the breadcrumbs
 *
 * @package Organique
 */


if(
	! is_page_template( 'front-template.php' ) &&
	! is_page_template( 'front-template-slider.php' ) &&
	! is_page_template( 'front-template-slider-no-captions.php' )
) :
?>

<div class="breadcrumbs<?php echo is_page_template( 'page-maps.php' ) ? '  no-margin' : ''; ?>">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<?php
					if ( is_woocommerce_active() && is_woocommerce() && function_exists( 'woocommerce_breadcrumb' ) ) {
						woocommerce_breadcrumb( array(
							'delimiter'   => '',
							'wrap_before' => '<ul class="breadcrumb">',
							'wrap_after'  => '</ul>',
							'before'      => '<li>',
							'after'       => '</li>',
							'home'        => __( 'Home Page', 'organique_wp' )
						) );
					} else {
						echo dimox_breadcrumbs();
					}
				?>
			</div>
		</div>
	</div>
</div>
<?php
	endif;
?>