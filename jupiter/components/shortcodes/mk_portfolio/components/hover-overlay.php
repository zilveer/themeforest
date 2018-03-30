<?php
$hover_overlay       = !empty($hover_overlay_color) ? (' style="background-color:' . $hover_overlay_color . '"') : '';
$item_bg_color_value = get_post_meta($post->ID, '_hover_skin', true);
$item_bg_color       = !empty($item_bg_color_value) ? (' background-color:' . $item_bg_color_value . '!important') : '';


//gets the permalink chosen in portfolio single item. if custom url is not selected, post single link will be returned
$href = mk_get_super_link(get_post_meta(get_the_ID(), '_portfolio_permalink', true));

if ($view_params['hover_scenarios'] == 'none') { ?>
	<a class="full-cover-link project-load" href="<?php echo $href; ?>" data-post-id="<?php the_ID(); ?>">&nbsp;</a>
<?php } else if ($view_params['hover_scenarios'] == 'fadebox') { ?>
    <div class="hover-overlay add-gradient"<?php echo $hover_overlay; ?>></div>
<?php } else {
	if ($view_params['hover_scenarios'] == 'zoomout') { ?>
	    <div class="image-hover-overlay" style="<?php echo $item_bg_color; ?>"></div>
	<?php } else { ?>
	    <div class="image-hover-overlay"></div>
	<?php } 
} ?>