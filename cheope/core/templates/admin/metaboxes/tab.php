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

global $post;

do_action( 'yit_before_metaboxes_tab' ) ?>
<div class="metaboxes-tab">
    
    <?php do_action( 'yit_before_metaboxes_labels' ) ?>
    <ul class="metaboxes-tabs clearfix"<?php if ( count($tabs) <= 1 ) : ?> style="display:none;"<?php endif; ?>>
    <?php
    $i = 0;
    foreach( $tabs as $tab ) :
        if( !isset( $options[$tab] ) || empty( $options[$tab] ) )
            { continue; }
        ?><li<?php if( !$i ) : ?> class="tabs"<?php endif ?>><a href="#<?php echo sanitize_key( $tab ) ?>"><?php echo $tab ?></a></li><?php
        $i++;
    endforeach;
    ?>
    </ul>
    <?php do_action( 'yit_after_metaboxes_labels' ) ?>
    
    <?php do_action( 'yit_before_metabox_option_' . sanitize_key( $tab ) ); ?>  
    
    
    <?php
    // Use nonce for verification
    wp_nonce_field( 'metaboxes-fields-nonce', 'yit_metaboxes_nonce' );
    ?>
    <?php foreach( $tabs as $tab ) : ?>
    <div class="tabs-panel" id="<?php echo sanitize_key( $tab ) ?>">
        <?php
        if( !isset( $options[$tab] ) )
            { continue; }   
        foreach( $options[$tab] as $option ) : 
			$value = yit_get_post_meta( $post->ID, $option['name'] );
            $option['value'] = $value != '' ? $value : (isset($option['std']) ? $option['std'] : '');
            
            $option['name'] = yit_option_metabox_name( $option['name'] );
        ?>
        <div class="the-metabox <?php echo $option['type'] ?> clearfix<?php if ( empty( $option['title'] ) ) : ?> no-label<?php endif; ?>">
            <?php yit_get_template( 'admin/metaboxes/types/' . $option['type'] . '.php', array( 'args' => $option ) ) ?>
        </div>
        <?php endforeach ?>
    </div>
    <?php endforeach ?>
    <?php do_action( 'yit_after_metabox_option_' . sanitize_key( $tab ) ) ?>
</div>