<?php if (etheme_get_option('top_bar')): ?>
	<div class="top-bar">
		<div class="container">
			<div>
				<div class="languages-area">
					<?php if((!function_exists('dynamic_sidebar') || !dynamic_sidebar('languages-sidebar'))): ?><?php endif; ?>	
				</div>

				
				<div class="top-links">
					<?php etheme_top_links(); ?>
					<?php if((!function_exists('dynamic_sidebar') || !dynamic_sidebar('top-bar-right'))): ?>
					<?php endif; ?>	
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>