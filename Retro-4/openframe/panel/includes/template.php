<?php
/*
*	openframe
*	written by stefano giliberti (stfno@me.com),
*	opendept.net
*/

function op_panel_tab_open( $tab_name = null ) {
	?>

	<?php
		$tab_shortname = str_replace(' ', '', $tab_name);
	?>
	
	<div class="op-panel-section" data-tab="<?php esc_attr_e( $tab_name ); ?>" data-hash="<?php esc_attr_e( $tab_shortname ); ?>">	
	<?php
}

function op_panel_tab_open_close() {
	?>
	</div>	
	<?php
}

function op_panel_group_open( $father = null, $child = null ) {
	?>
	<div class="op-panel-opt-group <?php if ( $child && ! op_theme_opt( $child ) ) echo 'hidden'; ?>" <?php if ( $father ) echo 'data-father="' . $father . '"'; ?> <?php if ( $child ) echo 'data-child="' . $child . '"'; ?>>	
	<?php
}

function op_panel_group_close() {
	?>
	</div>	
	</div>	
	<?php
}

function op_panel_opt_title( $text ) {
	?>
	<div class="aside"><?php echo $text; ?></div>
	<div class="section">		
	<?php
}

function op_panel_opt_media( $option_name ) {
	$option_value = op_theme_opt( $option_name );
	?>
	<a href="#" class="button button-secondary op-panel-image-select"><?php _e( 'Select Image', 'openframe' ); ?></a>
	<a href="#" class="button button-secondary op-panel-image-select-reset hidden"><?php _e( 'Empty', 'openframe' ); ?></a>
	<input type="hidden" name="<?php esc_attr_e( $option_name ); ?>" value="<?php esc_attr_e( $option_value ); ?>" />	
	<?php
}

function op_panel_opt_check( $option_name ) {
	?>
	<input <?php op_panel_opt_checked( $option_name ); ?> name="<?php esc_attr_e( $option_name ); ?>" type="checkbox" value="<?php esc_attr_e( $option_name ); ?>" class="op-panel-checkbox" />
	<?php
}

function op_panel_opt_text( $option_name, $placeholder = null ) {
	?>
		
	<input type="text" placeholder="<?php esc_attr_e( $placeholder ); ?>" name="<?php esc_attr_e( $option_name ); ?>" class="op-panel-text regular-text code" value="<?php esc_attr_e( op_theme_opt( $option_name ) ); ?>" />
	
	<?php
}

function op_panel_opt_textarea( $option_name, $placeholder = null ) {
	?>
	<textarea placeholder="<?php esc_attr_e( $placeholder ); ?>" name="<?php esc_attr_e( $option_name ); ?>" class="op-panel-textarea large-text code"><?php echo esc_textarea( op_theme_opt( $option_name ) ); ?></textarea>	
	<?php
}

function op_panel_opt_select( $option_name, $option_list = array() ) {
	?>
	<select class="op-panel-select" name="<?php esc_attr_e( $option_name ); ?>">
	<?php foreach ( $option_list as $option_id => $option ) : ?>					
	<option <?php op_panel_opt_selected( $option_name, $option_id ); ?> value="<?php esc_attr_e( $option_id ); ?>"><?php echo $option; ?></option>
	<?php endforeach; ?>
	</select>	
	<?php
}

function op_panel_opt_multiselect( $option_name, $placeholder = null, $option_list = array() ) {
	?>
	<select class="op-panel-select" multiple name="<?php esc_attr_e( $option_name ); ?>[]">		
	<?php foreach ( $option_list as $option_id => $option ) : ?>
	<option <?php op_panel_opt_selected( $option_name, $option_id ); ?> value="<?php esc_attr_e( $option_id ); ?>"><?php echo $option; ?></option>
	<?php endforeach; ?>
	</select>	
	<?php
}

function op_panel_opt_picker( $option_name, $placeholder = null ) {
	?>
	<span class="op-panel-picker-pal"></span>
	<input type="text" name="<?php esc_attr_e( $option_name ) ?>" class="op-panel-picker regular-text code" value="<?php esc_attr_e( op_theme_opt( $option_name ) ); ?>" placeholder="<?php esc_attr_e( $placeholder ); ?>" />
	<?php
}

?>