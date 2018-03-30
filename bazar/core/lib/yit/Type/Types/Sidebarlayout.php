<?php
/**
 * Your Inspiration Themes
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

/**
 * YIT Type: SidebarLayout
 * 
 * @since 1.0.0
 */
class YIT_Type_SidebarLayout {

	/**
	 * Load and print the correspondent field type.
	 * 
	 * @param @field
	 * @return string
	 */
	public static function display( $value, $dep ) {         
		ob_start(); ?>
			<div id="<?php echo $value['id_container'] ?>" <?php if($dep): ?>data-field="<?php echo $dep['field'] ?>" data-dep="<?php echo $dep['dep'] ?>" data-value="<?php echo $dep['value'] ?>" <?php endif ?>class="yit_options rm_option rm_input rm_sidebarlayout">
                <div class="option">
                    <label for="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></label>
                    
                    <div class="rm_radio yit-sidebar-layout">
                       	<input type="radio" name="<?php yit_field_name( $value['id'] ); ?>" id="<?php echo $value['id'] . '-left' ?>" value="sidebar-left" <?php checked( yit_get_option( $value['id'] ), 'sidebar-left' ) ?> />
                        <img src="<?php echo YIT_CORE_ASSETS_URL ?>/images/sideleft.png" title="<?php _e( 'Left sidebar', 'yit' ) ?>" alt="<?php _e( 'Left sidebar', 'yit' ) ?>" />
                        
                        <input type="radio" name="<?php yit_field_name( $value['id'] ); ?>" id="<?php echo $value['id'] . '-no' ?>" value="sidebar-no" <?php checked( yit_get_option( $value['id'] ), 'sidebar-no' ) ?> />
                        <img src="<?php echo YIT_CORE_ASSETS_URL ?>/images/noside.png" title="<?php _e( 'No sidebar', 'yit' ) ?>" alt="<?php _e( 'No sideabr', 'yit' ) ?>" />
                        
                        <input type="radio" name="<?php yit_field_name( $value['id'] ); ?>" id="<?php echo $value['id'] . '-right' ?>" value="sidebar-right" <?php checked( yit_get_option( $value['id'] ), 'sidebar-right' ) ?> />
                        <img src="<?php echo YIT_CORE_ASSETS_URL ?>/images/sideright.png" title="<?php _e( 'Right sidebar', 'yit' ) ?>" alt="<?php _e( 'Right sidebar', 'yit' ) ?>" />
                    </div>
                </div>
                <div class="description">
                    <?php
                    $std = explode( '-', $value['std'] );
                    $std_layout = ucfirst( end( $std ) );
                
                    echo $value['desc'];
                    printf( __( '(Default: %s)', 'yit' ),  $std_layout );
                    ?>
                </div>
                <div class="clear"></div>
            </div>
            <script type="text/javascript">
            jQuery( document ).ready( function( $ ) {
                $( '#<?php echo $value['id_container'] ?> .yit-sidebar-layout img' ).click( function() {
                    $( '#<?php echo $value['id_container'] ?> .yit-sidebar-layout :radio' ).attr( 'checked', false );
                    $( this ).prev( ':radio' ).attr( 'checked', true ); 
                });
            } );
            </script>
        <?php
		return ob_get_clean();
	}
}