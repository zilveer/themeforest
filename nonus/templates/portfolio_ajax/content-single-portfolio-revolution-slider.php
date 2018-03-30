<?php $custom = get_post_custom(get_the_ID()); ?>
<?php echo do_shortcode('[rev_slider '.$custom['revolution_slider'][0].']') ?>
