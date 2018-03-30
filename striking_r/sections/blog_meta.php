<?php
if(!function_exists('theme_section_blog_meta')){
/**
 * The default template for displaying blog meta in the pages
 */
function theme_section_blog_meta($single = false){
	global $post;
	if(get_post_type(get_the_ID())=='page'){
		return '';
	}
	$output = '';
	if($single){
		$meta_items = theme_get_option('blog','single_meta_items');
	}else{
		$meta_items = theme_get_option('blog','meta_items');
	}

	if(!empty($meta_items)){
		$outputs = array();
		foreach($meta_items as $item){
			switch($item){
				case 'category':
					$content = get_the_category_list(', ');
					if(!empty($content)){
						$outputs[] = '<span class="categories">'.__('Posted in: ', 'striking-r').$content.'</span>';
					}
					break;
				case 'tags':
					$content = get_the_tag_list(__('Tags: ', 'striking-r'),', ','');
					if(!empty($content)){
						$outputs[] = '<span class="tags">'.$content.'</span>';
					}
					break;
				case 'author':
					global $authordata;
					if(!$authordata){
						$authordata = get_userdata($post->post_author);
					}
					switch(theme_get_option('blog','author_link_to_website')){
						case 'website':
							$author = get_the_author_link();
							break;
						case 'archive':
							$author = get_the_author_posts_link();
							break;
						case 'none':
						default:
							$author = get_the_author();
					}
					$outputs[] = '<span class="author vcard">'.__('By: ', 'striking-r').'<span class="fn">'.$author.'</span></span>';
					
					break;
				case 'date':
					$outputs[] = '<time class="published updated" datetime="'.get_the_time('Y-m-d').'"><a href="'.get_month_link(get_the_time('Y'), get_the_time('m')).'">'.get_the_date().'</a></time>';
					break;
				/*
				case 'comment':
					if(($post->comment_count > 0 || comments_open())){
						ob_start();
						comments_popup_link(__('No Comments','striking-r'), __('1 Comment','striking-r'), __('% Comments','striking-r'),'');
						$outputs[] = '<span class="comments">'.ob_get_clean().'</span>';
					}
					break;
				*/
			}
		}
		$output = implode('<span class="separater">|</span>',$outputs);
		$output .= get_edit_post_link( __( 'Edit', 'striking-r' ), '<span class="separater">|</span> <span class="edit-link">', '</span>' );
		if(in_array('comment',$meta_items) && ($post->comment_count > 0 || comments_open())){
			ob_start();
			comments_popup_link(__('No Comments','striking-r'), __('1 Comment','striking-r'), __('% Comments','striking-r'),'');
			$output .= '<span class="comments">'.ob_get_clean().'</span>';
		}
	}

	return $output;
}
}