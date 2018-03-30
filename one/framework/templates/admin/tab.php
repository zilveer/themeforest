<?php
	$page_slug = thb_input_get( 'page', 'string', '' );
	$tab_id = 'thb-page-tab-' . $tab->getSlug() . '-id';
	$tab_classes = array( 'thb-page-tab' );
	$tab_data_attrs = array(
		'slug' => $tab->getSlug(),
		'page' => $page_slug
	);

	if ( $tab->isActive() ) 		{ $tab_classes[] = 'thb-active'; }
	if ( $tab->getIndex() == 0 ) 	{ $tab_classes[] = 'thb-first'; }
?>

<div class="<?php thb_classes( $tab_classes ); ?>" id="<?php echo esc_attr( $tab_id ) ?>" <?php thb_data_attributes( $tab_data_attrs ); ?>>
	<form method="post" action="<?php echo admin_url('/admin-ajax.php'); ?>" class="thb-ajax">
		<input type="hidden" name="THB_nonce" value="<?php echo wp_create_nonce('THB_tab'); ?>" />
		<input type="hidden" name="action" value="thb_save_tab">
		<input type="hidden" name="page" value="<?php echo esc_attr( $page_slug ); ?>" />
		<input type="hidden" name="tab" value="<?php echo esc_attr( $tab->getSlug() ); ?>" />

		<?php
			foreach( $tab->getContainers() as $container ) {
				$container->render();
			}
		?>

		<input type="submit" value="<?php _e( 'Save changes', 'thb_text_domain' ); ?>" class="thb-btn thb-btn-save">
	</form>
</div>