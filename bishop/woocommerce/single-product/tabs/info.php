<?php
/**
 * Info Tab
 */
global $post;
$show = yit_get_post_meta($post->ID, '_info_form');
$form_id = yit_get_option('shop-single-product-contact-form');
if($form_id != -1 && $show ) : ?>
    <?php echo do_shortcode( '[contact_form name="'. $form_id .'" ]' ) ?>
<?php endif ?>