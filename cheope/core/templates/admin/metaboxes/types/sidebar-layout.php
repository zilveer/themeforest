<?php 
/**
 * Your Inspiration Themes
 * 
 * In this files there is a collection of a functions useful for the core
 * of the framework.   
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

$layout  = ! isset( $value['layout'] ) ? 'sidebar-right' : $value['layout'];
$sidebar = ! isset( $value['sidebar'] ) ? '' : $value['sidebar'];
?>
<label for="<?php echo $id ?>"><?php echo $title ?></label>
<p class="yit-sidebar-layout">
    <input type="radio" name="<?php echo $name ?>[layout]" id="<?php echo $id . '-left' ?>" value="sidebar-left" <?php checked( $layout, 'sidebar-left' ) ?> />
    <img src="<?php echo YIT_CORE_ASSETS_URL ?>/images/sideleft.png" title="<?php _e( 'Left sidebar', 'yit' ) ?>" alt="<?php _e( 'Left sidebar', 'yit' ) ?>" />
    
    <input type="radio" name="<?php echo $name ?>[layout]" id="<?php echo $id . '-no' ?>" value="sidebar-no" <?php checked( $layout, 'sidebar-no' ) ?> />
    <img src="<?php echo YIT_CORE_ASSETS_URL ?>/images/noside.png" title="<?php _e( 'No sidebar', 'yit' ) ?>" alt="<?php _e( 'No sideabr', 'yit' ) ?>" />
    
    <input type="radio" name="<?php echo $name ?>[layout]" id="<?php echo $id . '-right' ?>" value="sidebar-right" <?php checked( $layout, 'sidebar-right' ) ?> />
    <img src="<?php echo YIT_CORE_ASSETS_URL ?>/images/sideright.png" title="<?php _e( 'Right sidebar', 'yit' ) ?>" alt="<?php _e( 'Right sidebar', 'yit' ) ?>" />

    <select name="<?php echo $name ?>[sidebar]" id="<?php echo $id ?>-sidebar">
        <option value="-1"><?php _e( 'Choose a sidebar', 'yit' ) ?></option>
        <?php foreach ( yit_registered_sidebars() as $val => $option ) { ?>
            <option value="<?php echo $val ?>" <?php selected( $sidebar, $val ) ?>><?php echo $option; ?></option>
        <?php } ?>
    </select>
    <script type="text/javascript">
    jQuery( document ).ready( function( $ ) {
        $( '.yit-sidebar-layout img' ).click( function() {
            $( this ).parent().children( ':radio' ).attr( 'checked', false );
            $( this ).prev( ':radio' ).attr( 'checked', true ); 
        });
        
        if( $( '#<?php echo $id . '-no' ?>' ).attr( 'checked' ) ) {
            $( '#<?php echo $id ?>-sidebar' ).hide();
        }

        $( '.yit-sidebar-layout :radio' ).next( 'img' ).click( function() {
            
            if( $( this ).prev( ':radio' ).val() == 'sidebar-no' ) {
                $( '#<?php echo $id ?>-sidebar' ).fadeOut();
            } else {
                $( '#<?php echo $id ?>-sidebar' ).fadeIn();
            }
        } );
    } );
    </script>
</p>