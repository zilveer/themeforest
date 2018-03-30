<?php if(get_post_meta(get_the_ID(), "eltd_post_soundcloud_link_meta", true) !== ""){ ?>
	<div class="eltd-blog-souncloud-holder">
		<?php
		$audiolink = get_post_meta(get_the_ID(), "eltd_post_soundcloud_link_meta", true);
		$embed = wp_oembed_get( $audiolink );
		print $embed;
		?>
	</div>
<?php } ?>