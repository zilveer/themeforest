<?php
	global $post;
	
	$url[] = '';
	$url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
?>

<ul class="tags pull-right">
    <li>
        <a class="btn btn-sm btn-icon" target="_blank" href="https://twitter.com/share?url=<?php the_permalink(); ?>" onClick="return ebor_tweet_<?php echo the_ID(); ?>()">
            <i class="ti-twitter-alt"></i>
        </a>
    </li>
    <li>
        <a class="btn btn-sm btn-icon" target="_blank" href="http://www.facebook.com/share.php?u=<?php the_permalink(); ?>" onClick="return ebor_fb_like_<?php echo the_ID(); ?>()">
            <i class="ti-facebook"></i>
        </a>
    </li>
    <li>
        <a class="btn btn-sm btn-icon" target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>" onClick="return ebor_pin_<?php echo the_ID(); ?>()">
            <i class="ti-pinterest"></i>
        </a>
    </li>
</ul>

<script type="text/javascript">
	function ebor_fb_like_<?php echo the_ID(); ?>() {
		window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&t=<?php echo sanitize_title(get_the_title()); ?>','sharer','toolbar=0,status=0,width=626,height=436');
		return false;
	}
	function ebor_tweet_<?php echo the_ID(); ?>() {
		window.open('https://twitter.com/share?url=<?php the_permalink(); ?>&t=<?php echo sanitize_title(get_the_title()); ?>','sharer','toolbar=0,status=0,width=626,height=436');
		return false;
	}
	function ebor_pin_<?php echo the_ID(); ?>() {
		window.open('http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo esc_url($url[0]); ?>&description=<?php echo sanitize_title(get_the_title()); ?>','sharer','toolbar=0,status=0,width=626,height=436');
		return false;
	}
</script>