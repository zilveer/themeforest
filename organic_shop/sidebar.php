<?php if ( is_page_template('template-left-sidebar.php') ) : ?>
	<!-- BEGIN .col-sidebar -->
	<li class="col-sidebar">
		
		<?php if(is_plugin_active('woocommerce/woocommerce.php')) {
		
			if ( is_woocommerce() or is_cart() or is_checkout() or is_account_page() ) {
				
				if ( is_active_sidebar('woocommerce-widget-area') ) {
					dynamic_sidebar( 'woocommerce-widget-area' );
				} else {
					_e('<p>Yikes no widgets? go to "Appearance > Widgets" and add some to the "WooCommerce Widget Area".</p>','qns');
				}

			} else {
				dynamic_sidebar( 'primary-widget-area' ); 
			} ?>
		
		<?php } else {
			dynamic_sidebar( 'primary-widget-area' ); 
		}?>
		
	</li>
	
<?php elseif ( is_page_template('template-right-sidebar.php') ) : ?>
	<!-- BEGIN .col-sidebar -->
	<li class="col-sidebar">
		
		<?php if(is_plugin_active('woocommerce/woocommerce.php')) {
		
			if ( is_woocommerce() or is_cart() or is_checkout() or is_account_page() ) {
				
				if ( is_active_sidebar('woocommerce-widget-area') ) {
					dynamic_sidebar( 'woocommerce-widget-area' );
				} else {
					_e('<p>Yikes no widgets? go to "Appearance > Widgets" and add some to the "WooCommerce Widget Area".</p>','qns');
				}
				
			} else {
				dynamic_sidebar( 'primary-widget-area' ); 
			} ?>
		
		<?php } else {
			dynamic_sidebar( 'primary-widget-area' ); 
		}?>
		
	</li>

<?php else : ?>
	<?php if ( sidebar_position('secondary-content') != 'full-width' ) { ?>
	<!-- BEGIN .col-sidebar -->
	<li class="<?php echo sidebar_position('secondary-content'); ?>">
		
		<?php if(is_plugin_active('woocommerce/woocommerce.php')) {
		
			if ( is_woocommerce() or is_cart() or is_checkout() or is_account_page() ) {
				
				if ( is_active_sidebar('woocommerce-widget-area') ) {
					dynamic_sidebar( 'woocommerce-widget-area' );
				} else {
					_e('<p>Yikes no widgets? go to "Appearance > Widgets" and add some to the "WooCommerce Widget Area".</p>','qns');
				}
				
			} else {
				dynamic_sidebar( 'primary-widget-area' ); 
			} ?>
		
		<?php } else {
			dynamic_sidebar( 'primary-widget-area' ); 
		}?>
		
	</li>
	<?php } ?>
	
<?php endif; ?>