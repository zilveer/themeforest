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
 * Template for admin code
 *
 * @package Yithemes
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<div class="fieldset" id="code-<?php echo $var[1]?>-container">
	<p><?php _e('This is a special shortcode. Insert shortcode for configure it.', 'yit') ?></p>
	<input type="hidden" class="<?php echo ( isset($var[1]['composer_layout']) && $var[1]['composer_layout'] ) ? 'wpb_vc_param_value' : '' ?>" id="code-<?php echo $var[1]; ?>" name="<?php echo ( isset($var[1]['composer_layout']) && $var[1]['composer_layout'] ) ? '' : 'code-' ?><?php echo $var[1]; ?>" value='<?php echo $var[0]; ?>' />
</div>