<div class="fieldset" id="<?php echo $var[0].'-'.$var[2]; ?>">
	<label for="<?php echo $var[0].'-'.$var[2]; ?>"><?php echo $var[1]['title']; ?></label>
	<input class="on_off" id="<?php echo $var[0].'-'.$var[2]; ?>" type="checkbox" name="shortcode-<?php echo $var[0]; ?>" value="yes" <?php if (strcmp($var[1]['std'], 'yes') == 0) : ?> checked="checked" <?php endif; ?> />
	<span>&nbsp;</span>
</div>

<script type="text/javascript">
jQuery( document ).ready( function( $ ) {
    $( '#<?php echo $var[0].'-'.$var[2]; ?> span' ).click( function() {
        var checked = $( this ).prev( 'input' ).attr( 'checked' );
        
        if( checked ) {
            $( this ).prev( 'input' ).attr( 'checked', false );
            $( this ).prev( 'input' ).attr( 'value', 0 );
        } else {
            $( this ).prev( 'input' ).attr( 'checked', true )
            $( this ).prev( 'input' ).attr( 'value', 1 );
        }
    } );
} );
</script>