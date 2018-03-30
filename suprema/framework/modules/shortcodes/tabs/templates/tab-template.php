<div class="qodef-tabs <?php echo esc_attr($tab_class); ?> <?php echo esc_attr($tab_title_layout); ?> clearfix">
	<ul class="qodef-tabs-nav">
		<?php foreach ($tabs_titles as $tab_title) { ?>
			<li>
				<a href="#tab-<?php echo sanitize_title($tab_title)?>">
					<?php if($tab_class === 'qodef-vertical-tab' && ($tab_title_layout === 'qodef-tab-with-icon' || $tab_title_layout === 'qodef-tab-only-icon')) { ?>
						<span class="qodef-icon-frame"></span>
					<?php } ?>

					<?php if($tab_title !== '' && $tab_title_layout !== 'qodef-tab-only-icon') { ?>
						<span class="qodef-tab-text-after-icon">
							<?php echo esc_attr($tab_title)?>
						</span>
					<?php } ?>
						
					<?php if($tab_class !== 'qodef-vertical-tab' && ($tab_title_layout === 'qodef-tab-with-icon' || $tab_title_layout === 'qodef-tab-only-icon')) { ?>
						<span class="qodef-icon-frame"></span>
					<?php } ?>
				</a>
			 </li>
		<?php } ?>
	</ul> 
	<?php echo do_shortcode($content); ?>
</div>