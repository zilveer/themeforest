<?php if(get_post_meta(get_the_ID(), "mkd_post_audio_link_meta", true) !== "") { ?>
    <div class="mkd-blog-audio-holder mkd-blog-audio-transparent <?php echo esc_attr(hue_mikado_options()->getOptionValue('blog_gradient_element_style')); ?>">
        <audio class="mkd-blog-audio" src="<?php echo esc_url(get_post_meta(get_the_ID(), "mkd_post_audio_link_meta", true)) ?>" controls="controls">
            <?php esc_html_e("Your browser don't support audio player", "hue"); ?>
        </audio>
    </div>
<?php } ?>