<?php if ( !$is_compact ) echo VP_View::instance()->load( 'control/template_control_head', $head_info ); ?>

<?php
// prepare value for tinyMCE editor
$value = html_entity_decode( $value, ENT_COMPAT, 'UTF-8' );
if ( has_filter( 'the_editor_content' ) )
	$value = apply_filters( 'the_editor_content', $value );
else
	$value = wp_editor( $value );
?>
<div class="customEditor">
    <div class="wp-editor-tools">
        <div class="custom_upload_buttons hide-if-no-js wp-media-buttons"><?php do_action( 'media_buttons' ); ?></div>
    </div>
    <textarea class="vp-input vp-js-wpeditor" id="<?php echo esc_attr( $name ) . '_ce'; ?>" data-vp-opt="<?php echo esc_attr( $opt ); ?>" rows="10" cols="50" name="<?php echo esc_attr( $name ); ?>" rows="3"><?php echo esc_attr( $value ); ?></textarea>
</div>

<?php
if ( !$is_compact )
	echo VP_View::instance()->load( 'control/template_control_foot' );?>