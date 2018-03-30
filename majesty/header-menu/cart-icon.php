<div id="shop_cart">
	<div id="shop_tigger">
		<?php sama_cart_link(); ?>
	</div>
	<div class="shop_cart_content">
	  <h4><?php esc_html_e('Shopping Cart', 'theme-majesty'); ?></h4>
	  <?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
	</div>
</div>
		