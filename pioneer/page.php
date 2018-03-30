<?php 
get_header();

global $wp_query;
$post_id = $wp_query->post->ID;
?>
<div id="sortable_2" class="connectedSortable">
<?php
$modules = get_post_meta($post->ID, 'epic_pageorder',true);

// Check if page has modules
if(!empty($modules)){
	
	$modules = explode(',', $modules);

	foreach ($modules as $module){
		get_template_part('modules/'.$module);
	}

}

// If page has no modules - add the content module

else { 
	get_template_part('modules/module-header');
	get_template_part('modules/module-page-title');
	get_template_part('modules/module-page-content');
	get_template_part('modules/module-footer');
}
?>
</div>
<?php get_footer();?>