<?php
    $pin_thumb = wp_get_attachment_image_src($post->ID, 'grandportfolio-gallery-grid', true);
    if(!isset($pin_thumb[0]))
    {
	    $pin_thumb[0] = '';
    }
?>
<div id="social_share_wrapper">
	<ul>
		<li><a class="tooltip" title="<?php esc_html_e('Share On Facebook', 'grandportfolio-translation' ); ?>" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink(); ?>"><i class="fa fa-facebook marginright"></i></a></li>
		<li><a class="tooltip" title="<?php esc_html_e('Share On Twitter', 'grandportfolio-translation' ); ?>" target="_blank" href="https://twitter.com/intent/tweet?original_referer=<?php echo get_permalink(); ?>&amp;url=<?php echo get_permalink(); ?>"><i class="fa fa-twitter marginright"></i></a></li>
		<li><a class="tooltip" title="<?php esc_html_e('Share On Pinterest', 'grandportfolio-translation' ); ?>" target="_blank" href="http://www.pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink()); ?>&amp;media=<?php echo urlencode($pin_thumb[0]); ?>"><i class="fa fa-pinterest marginright"></i></a></li>
		<li><a class="tooltip" title="<?php esc_html_e('Share On Google+', 'grandportfolio-translation' ); ?>" target="_blank" href="https://plus.google.com/share?url=<?php echo get_permalink(); ?>"><i class="fa fa-google-plus marginright"></i></a></li>
		<li><a class="tooltip" title="<?php esc_html_e('Share by Email', 'grandportfolio-translation' ); ?>" href="mailto:someone@example.com?Subject=<?php echo urlencode($post->post_title); ?>&body=<?php echo urlencode(get_permalink()); ?>"><i class="fa fa-envelope marginright"></i></a></li>
	</ul>
</div>