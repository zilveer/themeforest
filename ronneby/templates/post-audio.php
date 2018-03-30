<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
wp_enqueue_script('js-audio');
//wp_enqueue_script('js-audio-run');
?>
<?php if (get_post_meta(get_the_ID(), 'post_custom_post_audio_url', true)): ?>
	<audio class="audio"  preload="auto" controls="controls">
		<source id="audio-post<?php the_ID();?>" src="<?php echo get_post_meta(get_the_ID(), 'post_custom_post_audio_url', true);?> ">      
	</audio>
<?php endif; ?> 

<?php if( get_post_meta(get_the_ID(), "post_self_hosted_audio", true ) ):  ?>
	<audio class="audio" preload="auto" controls="controls">              
		<source src="<?php echo get_post_meta(get_the_ID(), "post_self_hosted_audio",true ) ?>" type="audio/mpeg">
	</audio>
<?php endif; ?>

<script type="text/javascript">
	(function($) {
		if(typeof $.fn.addAudioPlayer !== "undefined") {
			$('.post.format-audio').addAudioPlayer();
		}
	})(jQuery);
</script>

<?php if( get_post_meta(get_the_ID(), "post_soundcloud_audio", true ) ):  ?>
	<div class="dfd-soundcloud-audio"><?php echo get_post_meta(get_the_ID(), "post_soundcloud_audio", true ); ?></div>
<?php endif; ?>