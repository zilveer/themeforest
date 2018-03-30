<?php if( get_post_meta($post->ID,'meta_blogvideoservice',true) == 'html5' && ! post_password_required() ) { ?>

<video width="100%" height="405" id="home_video" class="entry-video video-js vjs-default-skin" poster="<?php $url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "post-full" ); echo esc_url($url[0]); ?>" data-aspect-ratio='2.41' data-setup="{}" controls>
	<source src="<?php echo get_post_meta($post->ID,'meta_blogvideourl',true); ?>.mp4" type="video/mp4"/>
	<source src="<?php echo get_post_meta($post->ID,'meta_blogvideourl',true); ?>.webm" type="video/webm"/>
	<source src="<?php echo get_post_meta($post->ID,'meta_blogvideourl',true); ?>.ogg" type="video/ogg"/>
</video>

<?php } ?>


<?php if( get_post_meta($post->ID,'meta_blogvideoservice',true) == 'vimeo' && ! post_password_required() ) { ?>

<div class="video-container" style="height:405px;" >
	<iframe src="http://player.vimeo.com/video/<?php echo get_post_meta($post->ID,'meta_blogvideourl',true); ?>?js_api=1&amp;js_onLoad=player<?php echo get_post_meta($post->ID,'meta_blogvideourl',true); ?>_1798970533.player.moogaloopLoaded" width="100%" height="405"  allowFullScreen></iframe>
</div>
<?php } ?>


<?php if( get_post_meta($post->ID,'meta_blogvideoservice',true) == 'youtube' && ! post_password_required() ) { ?>
<div class="video-container" style="height:405px;" >
	<iframe width="100%" height="405" src="http://www.youtube.com/embed/<?php echo get_post_meta($post->ID,'meta_blogvideourl',true); ?>?wmode=transparent" allowfullscreen ></iframe>
</div>
<?php } ?>