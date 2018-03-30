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
<label for="<?php echo $id ?>"><?php echo $title ?></label>
<p>
    <input type="checkbox" id="<?php echo $id ?>" name="<?php echo $name ?>" value="1" <?php if( isset( $std ) ) : ?>data-std="<?php echo $std ?>" <?php endif; checked( $value, 1 ) ?> />
    <span class="desc inline"><?php echo $desc ?></span>
</p>