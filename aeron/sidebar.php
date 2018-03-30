<?php 
$values = get_post_custom( $post->ID );
$custom_sidebar = (isset($values['custom_sidebar']) && $values['custom_sidebar'][0] != '') ? $values['custom_sidebar'][0] : __( 'Primary Sidebar', 'ABdev_aeron');

if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($custom_sidebar) ) : ?>
	<div class="widget">
		<h3><?php _e('Search', 'ABdev_aeron'); ?></h3>
		<?php get_search_form(); ?>
	</div>
<?php endif;