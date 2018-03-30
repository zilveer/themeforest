<footer class="bg-primary pt96 pb96 pt-xs-48 pb-xs-48">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 text-center">
			
				<p class="fade-1-4">
					<?php echo wp_kses(htmlspecialchars_decode(get_option('foundry_footer_copyright', 'Configure this message in "appearance" => "customize"')), ebor_allowed_tags()); ?>
				</p>
				
				<ul class="list-inline social-list mb0">
					<?php get_template_part('inc/content','footer-social-icons'); ?>
				</ul>
				
			</div>
		</div>
	</div>
</footer>