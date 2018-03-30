<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Trizzy
 * @since Trizzy 1.0
 */
?>
<?php if(is_single()){
    $layout = get_post_meta($post->ID, 'pp_sidebar_layout', TRUE);
} else {
    $layout = '';
}?>
<div class="four columns widget-area <?php echo $layout ?>">
	<?php do_action( 'before_sidebar' ); ?>
	<?php if (!dynamic_sidebar('shop')) : ?>

	<?php endif; ?>
</div>
