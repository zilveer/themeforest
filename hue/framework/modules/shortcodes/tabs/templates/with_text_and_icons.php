<div class="mkd-tabs <?php echo esc_attr($tab_class) ?> clearfix">
	<ul class="mkd-tabs-nav">
		<?php foreach($tabs_titles_subtitles as $tab_title_subtitle) { ?>
			<li>
				<a href="#tab-<?php echo sanitize_title($tab_title_subtitle['tab_title']) ?>">
					<span class="mkd-icon-frame"></span>
					<span class="mkd-tab-title-subtitle">
						<span class="mkd-tab-title">
							<?php echo esc_attr($tab_title_subtitle['tab_title']) ?>
						</span>
						<?php if($tab_title_subtitle['tab_subtitle']!==''){?>
						<span class="mkd-tab-subtitle">
							<?php echo esc_attr($tab_title_subtitle['tab_subtitle']) ?>
						</span>
						<?php } ?>
					</span>
				</a>
			</li>
		<?php } ?>
		<li class="mkd-tab-line <?php echo esc_attr($gradient_style); ?>"><span class="mkd-tab-line-inner <?php echo esc_attr($gradient_style); ?>"></span></li>
	</ul>
	<?php echo hue_mikado_remove_auto_ptag($content) ?>
</div>
