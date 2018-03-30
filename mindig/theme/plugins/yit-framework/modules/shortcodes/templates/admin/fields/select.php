<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Template for admin select
 *
 * @package Yithemes
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$is_multiple = ( isset( $var[1]['multiple'] ) && $var[1]['multiple'] );
$multiple = ( $is_multiple ) ? 'multiple' : '';
?>

<div class="fieldset" id="<?php echo $var[0].'-'.$var[2]?>-container" <?php if ( isset($var[1]['deps']) ): ?>data-field="<?php echo $var[0].'-'.$var[2] ?>" data-dep="<?php echo $var[1]['deps']['ids'].'-'.$var[2] ?>" data-value="<?php echo $var[1]['deps']['values'] ?>"<?php endif;?> >
	<label for="<?php echo $var[0].'-'.$var[2]; ?>"><?php echo $var[1]['title']; ?></label>
	<div class="select_wrapper <?php echo ( $is_multiple ) ? 'multiple' : '' ?>">
        <?php if( isset($var[1]['composer_layout']) && $var[1]['composer_layout'] ): ?>
            <input type="hidden" class="select-value wpb_vc_param_value" name="<?php echo $var[0]; ?>" value="<?php ( $is_multiple && is_serialized( $var[1]['std'] ) ) ? implode( ',', unserialize($var[1]['std'] ) ) : $var[1]['std'] ?>">
        <?php endif; ?>
		<select id="<?php echo $var[0].'-'.$var[2]; ?>" name="shortcode-<?php echo $var[0]; ?>" <?php echo $multiple ?> >
			<?php if ($var[1]['std'] == '') : ?>
				<option value=""><?php _e('Choose your option' , 'yit'); ?></option>
			<?php endif ?>
			<?php foreach ( $var[1]['options'] as $key => $value) : ?>

                <?php $std = '';

                if(is_serialized( $var[1]['std'] )) {
                    $std = unserialize( $var[1]['std'] );
                } elseif(is_array($var[1]['std']) && empty($var[1]['std'])) {
                    $std = $var[1]['std'];
                } else {
                   $std = explode( ',', $var[1]['std'] );
                }

                ?>

                <option <?php ( $is_multiple ) ? selected( true, in_array( $key, $std ) ) : selected( $key, $var[1]['std'] ) ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>

            <?php endforeach; ?>
		</select>
	</div>
	<?php if (isset($var[1]['description']) && $var[1]['description'] != '') : ?> 
		<span class="description"><?php echo $var[1]['description']; ?></span>
	<?php endif; ?>
</div>