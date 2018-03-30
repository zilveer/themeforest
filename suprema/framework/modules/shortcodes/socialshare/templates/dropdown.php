<div class="qodef-social-share-holder qodef-dropdown <?php echo esc_attr($icon_type) ?>">
	<a href="javascript:void(0)" target="_self" class="qodef-social-share-dropdown-opener">
		<i class="social_share"></i>
		<span class="qodef-social-share-title"><?php esc_html_e('Share', 'suprema') ?></span>
	</a>
	<div class="qodef-social-share-dropdown">
		<ul>
			<?php foreach ($networks as $net) {
				print $net;
			} ?>
		</ul>
	</div>
</div>