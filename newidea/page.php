<?php
/**
 * The page  for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage newidea
 * @since newidea 4.0
 */
global $pages_rel, $page_id, $object_id, $template_type;

if($template_type == null){
	$template_type = "page";
}

$pages_rel = newidea_get_menus();

get_header();

// theme config
get_template_part('template/theme-config');
?>
<!-- All content elements -->
<section id="content-elements">
<?php
	$bool = true;
	$page_id = strtolower(get_the_title());
	$page_id = str_replace(' ','_',$page_id);
	$page_id = str_replace('&','_',$page_id);
	$object_id = get_the_ID();
	
	echo '<input id="content-elements-page" type="hidden" value="'.$page_id.'" ></input>';
	
	foreach($pages_rel as $page_item){
		if($page_item['type'] != 'custom' && $object_id == $page_item['object_id']){
			$bool = false;
			break;
		}
	}
	
	if($bool) {
		if(get_option('show_on_front') == 'page' && get_option('page_for_posts') == $object_id){
			get_template_part('template/pages/content', 'news');
		}else{
			get_template_part('template/pages/content', $template_type);
		}
	}
	
	// other pages
	get_template_part('template/pages/loop');
?>
</section>
<?php get_footer(); ?>