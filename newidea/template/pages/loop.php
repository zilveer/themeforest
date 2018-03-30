<?php
/**
 * Theme Menu & Content Loop
 *
 * @subpackage newidea
 * @since newidea 4.0
 */
global $pages_rel, $page_id, $object_id;

foreach($pages_rel as $page_item){
	$page_id = strtolower($page_item['title']);
	$page_id = str_replace(' ','_',$page_id);
	$page_id = str_replace('&','_',$page_id);
	$object_id = $page_item['object_id'];
	
	if($page_item['type'] != 'custom'){
		if(get_option('show_on_front') == 'page' && get_option('page_for_posts') == $object_id){
			get_template_part('template/pages/content', 'news');
		}else{
			get_template_part('template/pages/content', newidea_get_template_name($page_item['template_name']));
		}	
	}else if(strtolower($page_item['post_name']) == 'home') {
		if((get_option('show_on_front') == 'posts' || intval(get_option('page_on_front')) == 0) && !is_front_page()){
			get_template_part('template/pages/content','news');
		}else if(get_option('show_on_front') != 'posts' && intval(get_option('page_on_front')) != 0 ){
			$template_name = get_post_meta( get_option('page_on_front') , '_wp_page_template', true );
			$post_obj = get_post(get_option('page_on_front'));
			$page_id = strtolower($post_obj->post_title);
			$page_id = str_replace(' ','_',$page_id);
			get_template_part('template/pages/content', newidea_get_template_name($template_name));
		}
	}
}
?>