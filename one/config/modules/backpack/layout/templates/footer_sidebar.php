<?php

$thb_columns_classes = explode( ',', thb_get_footer_layout() );

?>

<?php thb_footer_sidebar_before(); ?>
<section id="footer-sidebar" class="sidebar">

	<?php thb_footer_sidebar_start(); ?>

	<?php $thb_i=0; foreach( $thb_columns_classes as $class ) : ?>
		<?php if( is_active_sidebar('footer-sidebar-' . $thb_i) ) : ?>
			<section class="col <?php echo $class; ?>">
				<?php dynamic_sidebar( 'footer-sidebar-' . $thb_i ); ?>
			</section>
		<?php endif; ?>
	<?php $thb_i++; endforeach; ?>

	<?php thb_footer_sidebar_end(); ?>

</section>
<?php thb_footer_sidebar_after(); ?>