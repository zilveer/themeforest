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
 * YIT Type: SidebarList
 * 
 * @since 1.0.0
 */
class YIT_Type_SidebarList {

	/**
	 * Load and print the correspondent field type.
	 * 
	 * @param @field
	 * @return string
	 */
	public static function display( $value, $dep ) {         
		ob_start(); ?>
			<div id="<?php echo $value['id_container'] ?>" <?php if($dep): ?>data-field="<?php echo $dep['field'] ?>" data-dep="<?php echo $dep['dep'] ?>" data-value="<?php echo $dep['value'] ?>" <?php endif ?>class="yit_options rm_option rm_input rm_text rm_sidebarlist">
                <div class="option">
                    <label><?php printf( __( '%s', 'yit' ), $value['name'] ); ?> <small><?php echo $value['desc'] ?></small></label>
                    <?php 
                    	$sidebars = yit_get_option( $value['values'] );
                    	
                    	if( !is_array( $sidebars ) )
							$sidebars = unserialize( $sidebars );
					?>
                    
					<table class="cc-options">
						<tbody>                                                                          
                    	<?php if( is_array( $sidebars ) AND !empty( $sidebars ) ) : ?>
							<?php foreach( $sidebars as $id => $sidebar ) : ?>
							<tr>
					            <td>                                          
						            <a href="?page=<?php echo $_GET['page'] ?>&yit-action=delete&option=<?php echo $value['values'] ?>&i=<?php echo $id ?>" title="<?php _e( 'Delete', 'yit' ) ?>"><img src="<?php echo YIT_CORE_ASSETS_URL ?>/images/close_20.png" alt="<?php _e( 'Delete', 'yit' ) ?>" /></a>
                                    <?php echo $sidebar ?>
					            </td>
					        </tr>                                  
					        <?php endforeach ?> 
						<?php else : ?>
							<tr><td><?php printf( __( 'No %s created!', 'yit' ), strtolower( $value['label'][1] ) ) ?></td></tr>
						<?php endif ?>                                  
				        </tbody>
					</table>
                </div>
                <div class="clear"></div>
            </div>
        <?php
		return ob_get_clean();
	}
}