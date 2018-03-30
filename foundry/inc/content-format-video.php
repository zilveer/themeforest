<div class="embed-video-container embed-responsive embed-responsive-16by9 mb24">
    <?php echo wp_oembed_get(get_post_meta($post->ID, '_ebor_the_oembed', 1), array('class' => 'embed-responsive-item mb0')); ?>
</div>