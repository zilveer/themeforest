<?php if ( strlen( $view_params['content'] ) < 5 ) return false; ?>

<div class="pricing-offer-grid">
	<div class="offers"><?php echo wpb_js_remove_wpautop( $view_params['content'] ); ?></div>
</div>