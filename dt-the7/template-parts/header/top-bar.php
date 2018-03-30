<?php
/**
 * Top bar.
 *
 * @package the7
 * @since 1.0.0
 * @version 4.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( presscore_get_header_elements_list( 'top_bar_left' ) || presscore_get_header_elements_list( 'top_bar_right' ) ):
?>
		<div <?php presscore_top_bar_class( 'top-bar' ); ?>>
			<?php presscore_render_header_elements( 'top_bar_left', 'left-widgets' ); ?>
			<?php presscore_render_header_elements( 'top_bar_right', 'right-widgets' ); ?>
		</div>
<?php endif; ?>