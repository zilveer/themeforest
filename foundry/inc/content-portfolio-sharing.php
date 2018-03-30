<?php
	global $post;
	
	$url[] = '';
	$url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
?>

<div class="row">
    <div class="col-md-6 col-md-offset-3 text-center">
    
        <h6 class="uppercase"><?php _e('Share The Love','foundry'); ?></h6>
        
        <ul class="social-list list-inline">
            <li>
                <a target="_blank" href="https://twitter.com/share?url=<?php the_permalink(); ?>" onClick="return ebor_tweet()">
                    <i class="ti-twitter-alt icon icon-sm"></i>
                </a>
            </li>
            <li>
                <a target="_blank" href="http://www.facebook.com/share.php?u=<?php the_permalink(); ?>" onClick="return ebor_fb_like()">
                    <i class="ti-facebook icon icon-sm"></i>
                </a>
            </li>
            <li>
                <a target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>" onClick="return ebor_pin()">
                    <i class="ti-pinterest icon icon-sm"></i>
                </a>
            </li>
        </ul>
        
    </div>
</div>

<script type="text/javascript">
	function ebor_fb_like() {
		window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&t=<?php echo sanitize_title(get_the_title()); ?>','sharer','toolbar=0,status=0,width=626,height=436');
		return false;
	}
	function ebor_tweet() {
		window.open('https://twitter.com/share?url=<?php the_permalink(); ?>&t=<?php echo sanitize_title(get_the_title()); ?>','sharer','toolbar=0,status=0,width=626,height=436');
		return false;
	}
	function ebor_pin() {
		window.open('http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo esc_url($url[0]); ?>&description=<?php echo sanitize_title(get_the_title()); ?>','sharer','toolbar=0,status=0,width=626,height=436');
		return false;
	}
</script>