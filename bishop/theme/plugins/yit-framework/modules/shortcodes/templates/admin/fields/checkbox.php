<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Template for admin checkbox
 *
 * @package Yithemes
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<div class="fieldset" id="<?php echo $var[0].'-'.$var[2]?>-container" <?php if ( isset($var[1]['deps']) ): ?>data-field="<?php echo $var[0].'-'.$var[2] ?>" data-dep="<?php echo $var[1]['deps']['ids'].'-'.$var[2] ?>" data-value="<?php echo $var[1]['deps']['values'] ?>"<?php endif;?> >
	<label for="<?php echo $var[0].'-'.$var[2]; ?>"><?php echo $var[1]['title']; ?></label>
	<input class="on_off" id="<?php echo $var[0].'-'.$var[2]; ?>" type="checkbox" name="shortcode-<?php echo $var[0]; ?>" value="yes" <?php if ( $var[1]['std'] == 'yes' ) : ?> checked="checked" <?php endif; ?> />
	<span>&nbsp;</span>
</div>

<script type="text/javascript">
jQuery( document ).ready( function( $ ) {
    $( '#<?php echo $var[0].'-'.$var[2]; ?>-container span' ).click( function() {
        var checked = $( this ).prev( 'input' ).attr( 'checked' );
        
        if( checked ) {
            $( this ).prev( 'input' ).attr( 'checked', false );
            $( this ).prev( 'input' ).attr( 'value', 0 );
        } else {
            $( this ).prev( 'input' ).attr( 'checked', true )
            $( this ).prev( 'input' ).attr( 'value', 1 );
        }

        $(this).prev( 'input').change();
    } );
} );
</script>