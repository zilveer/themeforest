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

$options = yit_get_responsive_sliders();
?>
<label for="<?php echo $id ?>"><?php echo $title ?></label>
<div class="select_wrapper">
    <select id="<?php echo $id ?>" name="<?php echo $name ?>" <?php if( isset( $std ) ) : ?>data-std="<?php echo $std ?>"<?php endif ?>>
        <option></option>
        <option value="none"><?php _e( 'None', 'yit' ) ?></option>
        <?php foreach ( $options as $key => $item ) : ?>
        <option value="<?php echo $key ?>"<?php selected( $key, $value ) ?>><?php echo $item ?></option>
        <?php endforeach; ?>
    </select>      
</div>
<span class="desc inline"><?php echo $desc ?></span>