<?php if ( is_page() ) : ?>
	<?php $page_id = get_the_ID(); ?>
<?php elseif ( class_exists( 'woocommerce' ) && is_woocommerce() ) : ?>
	<?php if ( function_exists( 'wc_get_page_id' ) ) : ?>
		<?php $page_id = wc_get_page_id( 'shop' ); ?>
	<?php elseif ( function_exists( 'woocommerce_get_page_id' ) ) : ?>
		<?php $page_id = woocommerce_get_page_id( 'shop' ); ?>
	<?php endif; ?>
<?php else: ?>
    <?php $page_id = get_option( 'page_for_posts' ); ?>
<?php endif; ?>


<?php $lsvr_sidebar_settings_meta = get_post_meta( $page_id, '_lsvr_sidebar_settings_meta', true );
$sidebar_id = is_array( $lsvr_sidebar_settings_meta ) && array_key_exists( 'id', $lsvr_sidebar_settings_meta ) ? $lsvr_sidebar_settings_meta['id'] : 'primary-sidebar';
$sidebar_pos = is_array( $lsvr_sidebar_settings_meta ) && array_key_exists( 'pos', $lsvr_sidebar_settings_meta ) ? $lsvr_sidebar_settings_meta['pos'] : 'right';
$sidebar_mobilepos = is_array( $lsvr_sidebar_settings_meta ) && array_key_exists( 'mobilepos', $lsvr_sidebar_settings_meta ) ? $lsvr_sidebar_settings_meta['mobilepos'] : 'bottom';
?>

<?php if ( is_active_sidebar( $sidebar_id ) ) : ?>

	<!-- SIDEBAR : begin -->
	<aside id="sidebar" class="<?php
		if ( $sidebar_pos === 'left' ) { echo ' m-left-position'; }
		if ( $sidebar_mobilepos === 'top' ) { echo ' m-before-content'; }?>">
		<ul class="widget-list">

			<?php dynamic_sidebar( $sidebar_id ); ?>

		</ul>
	</aside>
	<!-- SIDEBAR : end -->

<?php endif; ?>
