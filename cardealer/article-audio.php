<?php if (!defined('ABSPATH')) exit(); ?>
<p>
<?php
$post_type_values = get_post_meta( get_the_ID(), 'post_type_values', true );
echo do_shortcode('[tmm_audio]' . $post_type_values['audio'] . '[/tmm_audio]');
?>
<p>