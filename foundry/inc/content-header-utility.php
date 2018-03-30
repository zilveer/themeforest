<?php
	$header_address = get_option('foundry_header_address', '68 Cardamon Place, Melbourne Vic 3000');
	$header_email = get_option('foundry_header_email', 'hello@foundry.net');
	$header_button_url = get_option('cta_url', '#');
	$header_button = get_option('cta_text', 'Login');
?>	

<div class="nav-utility">
	
	<?php if( $header_address ) : ?>
	    <div class="module left">
	        <i class="<?php echo esc_attr(get_option('header_address_icon','ti-location-arrow')); ?>">&nbsp;</i>
	        <span class="sub"><?php echo wp_kses($header_address, ebor_allowed_tags()); ?></span>
	    </div>
    <?php endif; ?>
    
    <?php if( $header_email ) : ?>
	    <div class="module left">
	        <i class="<?php echo esc_attr(get_option('header_email_icon','ti-email')); ?>">&nbsp;</i>
	        <span class="sub"><?php echo wp_kses($header_email, ebor_allowed_tags()); ?></span>
	    </div>
    <?php endif; ?>
    
    <?php if( $header_button_url && $header_button ) : ?>
	    <div class="module right">
	        <a class="btn btn-sm" href="<?php echo esc_url($header_button_url); ?>"><?php echo wp_kses($header_button, ebor_allowed_tags()); ?></a>
	    </div>
    <?php endif; ?>
    
    <?php if( 'yes' == get_option('foundry_header_utility_social', 'no') ) : ?>
	    <div class="module right">
	        <ul class="list-inline social-list">
	        	<?php echo ebor_header_social_items(); ?>
	        </ul>
	    </div>
    <?php endif; ?>
    
</div>