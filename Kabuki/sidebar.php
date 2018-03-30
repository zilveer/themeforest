<div id="sidebar">
	
		<?php if ( ! dynamic_sidebar( 'Sidebar' )) : ?>
	
			<div class="widget-area widget-sidebar">
					<h3><?php echo __('No Widgets Here Yet!', 'satori'); ?></h3>
					<div class="clearleft"></div>
						<ul id="nowidgets">
							<li>
							<?php echo __("You see this text because you haven't placed any widgets in the sidebar widget area! Please go to your website's admin panel 'Appearance' - 'Widgets' and place at least one widget into the sidebar widget area.", 'satori'); ?>
							</li>
						</ul>
					<div class="clearleft"></div>
				</div>
	
		<?php endif; ?>
	
</div><!--sidebar-->