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
?>
<label for="<?php echo $id ?>"><?php echo $title ?></label>
<p>
    <input type="text" id="<?php echo $id ?>" name="<?php echo $name ?>" value="<?php echo $value ?>" <?php if( isset( $std ) ) : ?>data-std="<?php echo $std ?>"<?php endif ?> />   
    <input type="button" class="button-secondary upload_button" value="<?php _e( 'Upload', 'yit' ) ?>" />   
    <span class="desc inline"><?php echo $desc ?></span>
</p>