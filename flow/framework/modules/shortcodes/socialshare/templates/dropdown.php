<div class="eltd-social-share-holder eltd-dropdown">
	<a href="javascript:void(0)" target="_self" class="eltd-social-share-dropdown-opener">
		<i class="social_share"></i>
		<span class="eltd-social-share-title"><?php esc_html_e('Share', 'flow') ?></span>
	</a>
	<div class="eltd-social-share-dropdown">
		<ul>
			<?php foreach ($networks as $net) {
				print $net;
			} ?>
		</ul>
	</div>
</div>