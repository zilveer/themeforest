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

        <div class="rm_number">
            <label for="<?php echo $id ?>"><?php echo $title ?></label>
            <span class="field">
                <input class="number" type="text" id="<?php echo $id ?>" name="<?php echo $name ?>" value="<?php echo $value ?>" <?php if( isset( $std ) ) : ?>data-std="<?php echo $std ?>"<?php endif ?>" />      
                <?php yit_string( '<span class="description">', $desc, '</span>' ); ?>
            </span>
        </div>            
            
        <script type="text/javascript" charset="utf-8">
            jQuery(document).ready( function( $ ) {
            	$('#<?php echo $id ?>').spinner({
            		<?php if( isset( $min )): ?>min: <?php echo $min ?>, <?php endif ?>
            		<?php if( isset( $max )): ?>max: <?php echo $max ?>, <?php endif ?> 
            		showOn: 'always',
					upIconClass: "ui-icon-plus",
					downIconClass: "ui-icon-minus",
            	});
            });
        </script>