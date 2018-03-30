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
 * YIT Type: SelectIcon
 * 
 * @since 1.0.0
 */
class YIT_Type_SelectIcon {

	/**
	 * Load and print the correspondent field type.
	 * 
	 * @param @field
	 * @return string
	 */
	public static function display( $value, $dep ) {
		$config = YIT_Config::load();
		
       	$icon_value = maybe_unserialize( yit_get_option( $value['id'], $value['std'] ) );   
        if ( ! is_array( $icon_value ) ) {
        	$icon_value = array( 'icon' => $icon_value, 'custom' => '' );
        }
		
		ob_start(); ?>
			<div id="<?php echo $value['id_container'] ?>" <?php if($dep): ?>data-field="<?php echo $dep['field'] ?>" data-dep="<?php echo $dep['dep'] ?>" data-value="<?php echo $dep['value'] ?>" <?php endif ?>class="yit_options rm_option rm_input rm_text">
                <div class="option">
                <label for="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></label>
                
                <div class="select_wrapper">
                    <select name="<?php yit_field_name( $value['id'] ); ?>[icon]" id="<?php echo $value['id'] ?>">
                        <?php foreach ( $config['awesome_icons'] as $val => $option ): ?>
                            <option value="<?php echo $val ?>"<?php selected( $icon_value['icon'], $val ) ?>><?php echo $option; ?></option>
                        
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="icon-preview"><span class="<?php echo $icon_value['icon'] ?>"></span></div>
                
                <?php if( isset( $value['upload'] ) && $value['upload'] ) : ?>
				<div class="clearboth"></div>
				
				<div class="upload-button">
				    <?php _e( 'or upload your own icon:', 'yit' ) ?>
				    <input type="text" style="width:200px;" id="<?php echo $value['id']; ?>_custom" name="<?php yit_field_name( $value['id'] ); ?>[custom]" value="<?php if ( isset( $icon_value['custom'] ) ) echo $icon_value['custom']; ?>" />
				    <a href="#" class="button-secondary" id="<?php echo $value['id']; ?>_upload_button"><?php _e( 'Upload', 'yit' ) ?></a>
                </div>
                <?php endif ?>

                </div>
                <div class="description">
                    <?php $std = is_string( $value['std'] ) ? explode( '-', $value['std'] ) : $value['std']; ?>
				<?php echo $value['desc'] ?> <?php printf( __( '(Default: %s)', 'yit' ), ucfirst( end( $std ) ) ) ?>
                </div>
                <div class="clear"></div>
            </div>
            
            
            <script type="text/javascript">
            jQuery(document).ready( function( $ ) {
                $( '#<?php echo( $value['id'] ); ?>_icon' ).attr( 'class', $( '#<?php echo( $value['id'] ); ?>' ).val() );
                        
                $( '#<?php echo( $value['id'] ); ?>' ).change( function() {
                    $( '#<?php echo( $value['id'] ); ?>_icon' ).removeAttr( 'class' );
                    $( '#<?php echo( $value['id'] ); ?>_icon' ).attr( 'class', $( this ).val() );
                    
                    $(this).parents('.yit_options').find('.icon-preview span').attr( 'class', $( this ).val() );
                });   
                             
                $('#<?php echo( $value['id'] ); ?>_upload_button').live('click', function(){
                    var yit_this_object = $(this).prev();
                    
                    tb_show('', 'media-upload.php?post_id=0&type=image&TB_iframe=true');    
                    
                    window.send_to_editor = function(html) {
                    	imgurl = $('img', html).attr('src');
                    	yit_this_object.val(imgurl);
                    			
                    	tb_remove();
                    }
                    	
                    return false;
                });
            });
            </script>
        <?php
		return ob_get_clean();
	}
}