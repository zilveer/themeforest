<div class="mkd-tabs <?php echo esc_attr($tab_class) ?> clearfix">
	<ul class="mkd-tabs-nav">
		<?php foreach($tabs_titles_subtitles as $tab_title_subtitle) { ?>
			<li>
				<a href="#tab-<?php echo sanitize_title($tab_title_subtitle['tab_title']) ?>">
					<span class="mkd-icon-frame"></span>
				</a>
			</li>
		<?php } ?>
		<li class="mkd-tab-line <?php echo esc_attr($gradient_style); ?>"><span class="mkd-tab-line-inner <?php echo esc_attr($gradient_style); ?>"></span></li>
	</ul>
	<?php echo hue_mikado_remove_auto_ptag($content) ?>
</div>
