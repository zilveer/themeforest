<?php
/**
 * Your Inspiration Themes
 * 
 * In this files the framework register default metaboxes.
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */
 
extract( $args );                   
?>
<div id="<?php echo $id ?>-option" class="rm_onoff">
    <label for="<?php echo $id ?>"><?php echo $title ?></label>
    <p>
        <input type="checkbox" id="<?php echo $id ?>" name="<?php echo $name ?>" value="1"<?php checked( $value, 1 ) ?> class="on_off" <?php if( isset( $std ) ) : ?>data-std="<?php echo $std ?>"<?php endif ?> />
        <span class="onoff">&nbsp;</span>
        <span class="desc inline"><?php echo $desc ?></span>
    </p>    
</div>      
         
<script type="text/javascript">
jQuery( document ).ready( function( $ ) {
    $( '#<?php echo $id ?>-option span' ).click( function() {
    	var input = $( this ).prev( 'input' );
        var checked = input.attr( 'checked' );
                    
        if( checked ) {
        	input.attr( 'checked', false ).attr( 'value', 0 ).removeClass('onoffchecked');
        } else {
            input.attr( 'checked', true ).attr( 'value', 1 ).addClass('onoffchecked');
        }
                   
        input.change();
    } );
} );
</script>