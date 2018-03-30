<?php $show_breadcrumbs = couponxl_get_option( 'show_breadcrumbs' ); 
$breadcrumbs = couponxl_get_breadcrumbs();
if( !empty( $breadcrumbs ) ):
?>
	<section class="breadcrumb-section <?php echo $show_breadcrumbs == 'yes' ? '' : 'breadcrumb-hide' ?>">
		<div class="container">
			<?php echo $breadcrumbs; ?>
		</div>
	</section>
<?php else: ?>
	<section class="breadcrumb-section">
	</section>
<?php endif; ?>