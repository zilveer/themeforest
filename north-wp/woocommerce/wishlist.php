<?php
/**
 * Wishlist pages template; load template parts basing on the url
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Wishlist
 * @version 2.0.0
 */

?>
<div class="row align-center">
	<div class="small-12 medium-10  large-8 columns">
		<?php wc_print_notices() ?>
		<?php yith_wcwl_get_template( 'wishlist-' . $template_part . '.php', $atts ) ?>
	</div>
</div>