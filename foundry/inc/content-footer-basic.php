<?php $logo_light = ( get_option('alt_footer_logo', false) ) ? get_option('alt_footer_logo', false) : get_option('custom_logo_light', EBOR_THEME_DIRECTORY . 'style/img/logo-light.png'); ?>

<footer class="footer-2 bg-dark pt0 pb40">
	<div class="container">
	
		<div class="row">
			<hr class="mt0 mb40" />
		</div>
		
		<div class="row">
		
			<div class="col-sm-4">
				<a href="<?php echo esc_url(home_url('/')); ?>">
					<img alt="<?php echo esc_attr(get_bloginfo('title')); ?>" class="image-xxs fade-half" src="<?php echo esc_url($logo_light); ?>" />
				</a>
			</div>
		
			<div class="col-sm-4 text-center">
				<span class="fade-half">
					<?php echo wp_kses(htmlspecialchars_decode(get_option('foundry_footer_copyright', 'Configure this message in "appearance" => "customize"')), ebor_allowed_tags()); ?>
				</span>
			</div>
		
			<div class="col-sm-4 text-right">
				<ul class="list-inline social-list">
					<?php get_template_part('inc/content','footer-social-icons'); ?>
				</ul>
			</div>
			
		</div>
		
	</div>
</footer>