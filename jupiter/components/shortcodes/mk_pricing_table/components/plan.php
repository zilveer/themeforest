<?php if ( $view_params['featured'] == 'true' && $view_params['style'] == 'multicolor' ) { ?>
	<span class="premium-ribbon"><?php echo get_post_meta( get_the_ID(), '_ribbon_txt', true ); ?></span>
<?php } ?>

<div class="pricing-plan"><?php echo get_post_meta( get_the_ID(), '_plan', true ); ?></div>