<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'YIT' ) ) {
    exit( 'Direct access forbidden.' );
}


extract( $args );

if ( ! isset( $labels ) ) $labels = '';
 
?>

        <div class="rm_number slider_control slider" id="<?php echo $id ?>-option">
            <label for="<?php echo $id ?>"><?php echo $label ?></label>
            <span class="field">
                <div class="ui-slider">
                    <span class="minCaption"><?php echo $min . $labels ?></span>
                    <span class="maxCaption"><?php echo $max . $labels ?></span>
                    <span id="<?php echo $id ?>-feedback" class="feedback"><strong><?php echo $value ?></strong></span>
                    
                    <div id="<?php echo $id ?>-div" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
                        <input id="<?php echo $id ?>" type="hidden" name="<?php echo $name ?>" value="<?php echo esc_attr( $value ) ?>" <?php if( isset( $std ) ) : ?>data-std="<?php echo $std ?>"<?php endif ?> />
                    </div> 
                </div>      
                <?php yit_string( '<span class="desc">', $desc, '</span>' ); ?>
            </span>
        </div>            

        <script type="text/javascript">
        jQuery(document).ready(function($){
            $('#<?php echo $id ?>-option .ui-slider .ui-slider').each(function(e){
                var val = <?php echo $value ?>; 
                var minValue = <?php echo $min ?>; 
                var maxValue = <?php echo $max ?>; 
                
                $(this).slider({
                    value: val,
                    min: minValue,
                    max: maxValue,
                    range: 'min',
                    <?php if ( isset( $step ) ) : ?>
                    step: <?php echo $step ?>,
                    <?php endif ?>
                    slide: function( event, ui ) {
            			$( 'input#<?php echo $id; ?>' ).val( ui.value );
            			$( '#<?php echo $id; ?>-feedback strong' ).text( ui.value + '<?php echo $labels ?>' );
                    }
                });
            });
        });
        </script>