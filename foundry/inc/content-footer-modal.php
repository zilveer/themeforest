<?php
	$content = get_option('foundry_footer_modal_content');
	$cookie = ( get_option('foundry_footer_modal_cookie') ) ? 'data-cookie="'. get_option('foundry_footer_modal_cookie') .'"' : false;
	
	if( $content ) :
?>

	<div class="modal-strip <?php echo esc_attr(get_option('foundry_footer_modal_colour','bg-white')); ?>" <?php echo esc_attr($cookie); ?>>        	
		<div class="container">
			<div class="row">
				<div class="col-sm-12 overflow-hidden">
					<p class="mb0 pull-left"><?php echo wp_kses($content, ebor_allowed_tags()); ?></p>
				</div>
			</div>
		</div>
	</div>

<?php endif;