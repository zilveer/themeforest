<?php
/**
 * Update from striking
 */
global $theme_options;
$options = array(
	'general',
	'background',
	'color',
	'font',
	'slideshow',
	'sidebar',
	'image',
	'media',
	'homepage',
	'blog',
	'portfolio',
	'footer',
	'advanced'
);
if(!get_option(THEME_SLUG.'_options_fixed')){
	foreach($options as $option){
		$value = get_option(THEME_SLUG . '_' . $option);
		if($value){
			$theme_options[$option] = $value;
			update_option('theme_' . $option, $value);
		}
	}
	update_option(THEME_SLUG.'_options_fixed', true);
}
if(!get_option('theme_upgrade_from_striking_done')){
	$check_old = get_option('striking_general');
	$check_new = get_option('theme_general');
	
	if(!empty($check_old) && $check_new === false){
		foreach($options as $option){
			$value = get_option('striking_' . $option);
			if($value){
				if(isset($theme_options[$option])){
					$theme_options[$option] = array_merge($theme_options[$option], $value);
				} else{
					$theme_options[$option] = $value;
				}
				
				update_option('theme_' . $option, $theme_options[$option]);
			}
		}
	}
	
	theme_save_skin_style();

	$search = get_option( 'widget_striking_search' );
	$updated_search = get_option('widget_theme_search');
	if($search && !$updated_search){
		update_option( 'widget_theme_search', $search );

		$sidebars_widgets = get_option( 'sidebars_widgets' );
		foreach($sidebars_widgets as &$sidebar_widgets){
			if(is_array($sidebar_widgets)){
				foreach($sidebar_widgets as &$widget){
					$widget = str_replace('striking_search', 'theme_search', $widget);
				}
			}
		}
		update_option( 'sidebars_widgets', $sidebars_widgets );
	}

	update_option('theme_upgrade_from_striking_done', true);
}

if(!get_option('striking_meta_information_fixed')){
	$meta_items = array();
	if(theme_get_option('blog','meta_category')){
		$meta_items[] = 'category';
	}
	if(theme_get_option('blog','meta_tags')){
		$meta_items[] = 'tags';
	}
	if(theme_get_option('blog','meta_author')){
		$meta_items[] = 'author';
	}
	if(theme_get_option('blog','meta_date')){
		$meta_items[] = 'date';
	}
	if(theme_get_option('blog','meta_comment')){
		$meta_items[] = 'comment';
	}
	theme_set_option('blog','meta_items',$meta_items);
	$single_meta_items = array();
	if(theme_get_option('blog','single_meta_date')){
		$single_meta_items[] = 'date';
	}
	if(theme_get_option('blog','single_meta_category')){
		$single_meta_items[] = 'category';
	}
	if(theme_get_option('blog','single_meta_tags')){
		$single_meta_items[] = 'tags';
	}			
	if(theme_get_option('blog','single_meta_comment')){
		$single_meta_items[] = 'comment';
	}
	theme_set_option('blog','single_meta_items',$single_meta_items);
	update_option('striking_meta_information_fixed', true);
}
if(is_multisite()){
	global $blog_id;
	if(!get_option('striking_multisite_images_dir_fixed_'.$blog_id)){
		if(!is_dir(THEME_CACHE_IMAGES_DIR)){
			mkdir(THEME_CACHE_IMAGES_DIR);
		}
		update_option('striking_multisite_images_dir_fixed_'.$blog_id, true);
	}
}
if(!get_option('striking_page_for_posts_fixed')){
	update_option('striking_page_for_posts_fixed', true);

	$page_for_posts = get_option('page_for_posts');
	$show_on_front = get_option('show_on_front');
	$page_on_front = get_option('page_on_front');

	if(!empty($page_for_posts)){
		if($show_on_front == "posts"|| ($show_on_front == "page" && !empty($page_on_front))){
			if(empty($theme_options['blog']['blog_page'])){
				$theme_options['blog']['blog_page'] = $page_for_posts;
				update_option('theme_' . 'blog', $theme_options['blog']);
			}
			update_option('page_for_posts',0);
		}
	}
}

//change upload option from string to source array since ver.5.0.5
if(!get_option('striking_upload_option_source_fixed')){
	update_option('striking_upload_option_source_fixed', true);
	$upload_options = array(
		array('page'=>'general', 'name'=>'logo'),
		array('page'=>'background', 'name'=>'box_image'),
		array('page'=>'background', 'name'=>'header_image'),
		array('page'=>'background', 'name'=>'feature_image'),
		array('page'=>'background', 'name'=>'page_image'),
		array('page'=>'background', 'name'=>'footer_image'),
	);
	foreach($upload_options as $option){
		if(isset($theme_options[$option['page']][$option['name']])){
			if(is_string($theme_options[$option['page']][$option['name']])){
				if(!empty($theme_options[$option['page']][$option['name']])){
					$theme_options[$option['page']][$option['name']] = array(
						'type'=>'url',
						'value'=>$theme_options[$option['page']][$option['name']]
					);
				}else{
					$theme_options[$option['page']][$option['name']] = array();
				}					
			}
		}
	}
	
	update_option( 'theme_' . 'general', $theme_options['general']);
	update_option( 'theme_' . 'background', $theme_options['background']);

	$posts = get_posts( array( 
		'post_type'   => 'portfolio', 
		'numberposts' => -1,
		'post_status' => 'publish'
	));
	foreach ( $posts as $post ) {
		$source = get_post_meta($post->ID, '_image', true);
		if(is_string($source)){
			if(!empty($source)){
				$source = array(
					'type'=>'url',
					'value'=>$source
				);
			}else{
				$source = array();
			}
			update_post_meta($post->ID, '_image', $source);
		}
	}
}

//change slideshow source b => p since version.5.0.2
if(version_compare(get_option(THEME_SLUG.'_version'), "5.0.2", '<')){
	if(!get_option('striking_slideshow_source_fixed')){
		update_option('striking_slideshow_source_fixed', true);
		if(isset($theme_options['homepage']['slideshow_category'])){
			$theme_options['homepage']['slideshow_category'] = str_replace('{p','{b',$theme_options['homepage']['slideshow_category']);
			update_option( 'theme_' . 'homepage', $theme_options['homepage']);
		}

		$loop = new WP_Query( array('post_type'=> 'any', 'meta_key' => '_introduce_text_type', 'meta_value' => 'slideshow' ) );
		while ( $loop->have_posts() ) : $loop->the_post();
			$slideshow_category = get_post_meta(get_the_ID(), '_slideshow_category', true);
			$slideshow_category =  str_replace('{p','{b',$slideshow_category);
			
			update_post_meta(get_the_ID(), '_slideshow_category', $slideshow_category);
		endwhile;

		$posts = get_posts( array( 
			'post_type'   => 'any', 
			'numberposts' => -1,
			'post_status' => 'publish'
		));
		foreach ( $posts as $post ) {
			$post_content = $post->post_content;
			$pattern = '/\[slideshow\b(.*?)(?:(\/))?\]/s';
			if(preg_match_all($pattern, $post_content, $matches)){
				if(!empty($matches[0])){
					foreach($matches[0] as $string){
						$updated_string = str_replace('{p:','{b:',$string);
						$updated_string = str_replace('{p}','{b}',$updated_string);
						$post_content = str_replace($string,$updated_string,$post_content);
					}
				}
				
				$update_post = array();
				$update_post['ID'] = $post->ID;
				$update_post['post_content'] = $post_content;
				wp_update_post( $update_post );
			}
		}
	}
}

//change homepage'content to page_content since ver.3.0.1
if(isset($theme_options['homepage']['content'])){
	if(!empty($theme_options['homepage']['content'])){
		if(empty($theme_options['homepage']['page_content'])){
			$theme_options['homepage']['page_content'] = $theme_options['homepage']['content'];
		}
	}
	unset($theme_options['homepage']['content']);
	update_option( 'theme_' . 'homepage', $theme_options['homepage']);
}
if(isset($theme_options['video'])){
	if(!empty($theme_options['video'])){
		if(empty($theme_options['video'])){
			$theme_options['media'] = $theme_options['video'];
		}
	}
	unset($theme_options['video']);
	update_option( 'theme_' . 'media', $theme_options['media']);
}

if(isset($theme_options['font']['enable_cufon'])){
	if(!empty($theme_options['font']['enable_cufon'])){
		if(empty($theme_options['cufon']['enable_cufon'])){
			$theme_options['cufon']['enable_cufon'] = $theme_options['font']['enable_cufon'];
		}
	}
	if(!empty($theme_options['font']['fonts'])){
		if(empty($theme_options['cufon']['fonts'])){
			$theme_options['cufon']['fonts'] = $theme_options['font']['fonts'];
		}
	}
	if(!empty($theme_options['font']['code'])){
		if(empty($theme_options['cufon']['code'])){
			$theme_options['cufon']['code'] = $theme_options['font']['code'];
		}
	}
	unset($theme_options['font']['enable_cufon']);
	unset($theme_options['font']['fonts']);
	unset($theme_options['font']['code']);
	update_option( 'theme_' . 'font', $theme_options['font']);
	update_option( 'theme_' . 'cufon', $theme_options['cufon']);
}

if(!get_option('striking_fontface_gfont_cufon_fixed')){
	$theme_options['font']['cufon_enabled'] = theme_get_option_from_db('cufon','enable_cufon');
	$theme_options['font']['cufon_code'] = theme_get_option_from_db('cufon','code');
	$cufon_used_array = theme_get_option_from_db('cufon','fonts');

	$theme_options['font']['cufon_used'] = array();
	if(!empty($cufon_used_array)){
		foreach ($cufon_used_array as $key => $value) {
			$theme_options['font']['cufon_used'][] = $key;
		}
	}
	if(!empty($theme_options['font']['cufon_used'])){
		$theme_options['font']['cufon_default'] = current($theme_options['font']['cufon_used']);
	}

	$theme_options['font']['gfont_code'] = theme_get_option_from_db('gfont','code');
	$theme_options['font']['gfont_used'] = theme_get_option_from_db('gfont','used_gfont');
	$theme_options['font']['gfont_default'] = theme_get_option_from_db('gfont','default_font');

	$theme_options['font']['fontface_enabled'] = theme_get_option_from_db('fontface','enable_fontface');
	$theme_options['font']['fontface_code'] = theme_get_option_from_db('fontface','code');
	$fontface_used_array = theme_get_option_from_db('fontface','fonts');

	$theme_options['font']['fontface_used'] = array();
	if(!empty($fontface_used_array)){
		foreach ($fontface_used_array as $key => $value) {
			$theme_options['font']['fontface_used'][] = $key;
		}
	}
	
	if(!empty($theme_options['font']['fontface_used']) && is_array($theme_options['font']['fontface_used'])){
		$theme_options['font']['fontface_default'] = current($theme_options['font']['fontface_used']);
	}

	update_option( 'theme_' . 'font', $theme_options['font']);
	delete_option( 'theme_' . 'cufon', array());
	delete_option( 'theme_' . 'fontface', array());
	delete_option( 'theme_' . 'gfont', array());
	update_option('striking_fontface_gfont_cufon_fixed', true);
}

if(!get_option('striking_advanced_fixed')){
	
	$advance = theme_get_option_from_db('advance');
	if(!empty($advance)){
		$theme_options['advanced'] = $advance;
		delete_option( 'theme_' . 'advance', array());
		update_option( 'theme_' . 'advanced', $theme_options['advanced']);
	}
	update_option(THEME_SLUG.'_advanced_fixed', true);
}

if(!get_option(THEME_SLUG.'_blog_author_link_fixed')){
	if(theme_get_option_from_db('blog','author_link_to_website')){
		$theme_options['blog']['author_link_to_website'] = 'website';
	}else{
		$theme_options['blog']['author_link_to_website'] = 'archive';
	}
	
	update_option( 'theme_' . 'blog', $theme_options['blog']);

	update_option(THEME_SLUG.'_blog_author_link_fixed', true);
}

if(!get_option(THEME_SLUG.'_advanced_fancybox_fixed')){
	if(isset($theme_options['advanced']['no_colorbox'])){
		$theme_options['advanced']['no_fancybox'] = $theme_options['advanced']['no_colorbox'];
		unset($theme_options['advanced']['no_colorbox']);
	}
	if(isset($theme_options['advanced']['restrict_colorbox'])){
		$theme_options['advanced']['fancybox_fitToView'] = $theme_options['advanced']['restrict_colorbox'];
		unset($theme_options['advanced']['restrict_colorbox']);
	}
	
	update_option( 'theme_' . 'advanced', $theme_options['advanced']);

	update_option(THEME_SLUG.'_advanced_fancybox_fixed', true);
}

if(!get_option(THEME_SLUG.'_portfolio_fixed')){
	$theme_options['portfolio']['video_width'] = theme_portolio_lightbox_value_fix($theme_options['portfolio']['video_width']);
	$theme_options['portfolio']['video_height'] = theme_portolio_lightbox_value_fix($theme_options['portfolio']['video_height']);
	
	$theme_options['portfolio']['lightbox_width'] = theme_portolio_lightbox_value_fix($theme_options['portfolio']['lightbox_width']);
	$theme_options['portfolio']['lightbox_height'] = theme_portolio_lightbox_value_fix($theme_options['portfolio']['lightbox_height']);

	update_option( 'theme_' . 'portfolio', $theme_options['portfolio']);

	$loop = new WP_Query( array('post_type'=> 'portfolio', 'post_status'=>'any', 'posts_per_page'=>-1 ) );
	while ( $loop->have_posts() ) : $loop->the_post();
		$video_width = theme_portolio_lightbox_value_fix(get_post_meta($loop->post->ID, '_video_width', true));
		update_post_meta(get_the_ID(), '_video_width', $video_width);

		$video_height = theme_portolio_lightbox_value_fix(get_post_meta($loop->post->ID, '_video_height', true));
		update_post_meta(get_the_ID(), '_video_height', $video_height);

		$lightbox_width = theme_portolio_lightbox_value_fix(get_post_meta($loop->post->ID, '_lightbox_width', true));
		update_post_meta(get_the_ID(), '_lightbox_width', $lightbox_width);

		$lightbox_height = theme_portolio_lightbox_value_fix(get_post_meta($loop->post->ID, '_lightbox_height', true));
		update_post_meta(get_the_ID(), '_lightbox_height', $lightbox_height);
	endwhile;

	update_option(THEME_SLUG.'_portfolio_fixed', true);
}

if(!get_option(THEME_SLUG.'_slideshow_type_fixed')){
	if(isset($theme_options['homepage']['slideshow_type'])){
		$theme_options['homepage']['slideshow_type'] = theme_slideshow_type_fix($theme_options['homepage']['slideshow_type']);
		update_option( 'theme_' . 'homepage', $theme_options['homepage']);
	}

	$loop = new WP_Query( array('post_type'=> 'any', 'meta_key' => '_introduce_text_type', 'meta_value' => 'slideshow', 'post_status'=>'any', 'posts_per_page'=>-1 ) );
	while ( $loop->have_posts() ) : $loop->the_post();
		$slideshow_type = get_post_meta(get_the_ID(), '_slideshow_type', true);
		$slideshow_type = theme_slideshow_type_fix($slideshow_type);
		
		update_post_meta(get_the_ID(), '_slideshow_type', $slideshow_type);
	endwhile;
	update_option(THEME_SLUG.'_slideshow_type_fixed', true);
}

if(!get_option(THEME_SLUG.'_disable_breadcrumb_fixed')){
	if(isset($theme_options['general']['disable_breadcrumb'])) {
		$theme_options['general']['breadcrumb'] = !$theme_options['general']['disable_breadcrumb'];
		unset($theme_options['general']['disable_breadcrumb']);
	}
	
	$loop = new WP_Query( array('post_type'=> 'any', 'meta_key' => '_disable_breadcrumb') );
	while ( $loop->have_posts() ) : $loop->the_post();
		$disable_breadcrumb = get_post_meta(get_the_ID(), '_disable_breadcrumb', true);
		if($disable_breadcrumb == 'true'){
			$breadcrumb = 'false';
		}elseif($disable_breadcrumb == 'false'){
			$breadcrumb = 'true';
		}else {
			$breadcrumb = 'default';
		}
		
		update_post_meta(get_the_ID(), '_breadcrumb', $breadcrumb);
	endwhile;
	
	update_option( 'theme_' . 'general', $theme_options['general']);
	update_option(THEME_SLUG.'_disable_breadcrumb_fixed', true);
}

if(!get_option(THEME_SLUG.'_sticky_fixed')){
	if(isset($theme_options['advanced']['stricky_footer'])){
		$theme_options['advanced']['sticky_footer'] = $theme_options['advanced']['stricky_footer'];
		update_option(THEME_SLUG . '_' . 'advanced', $theme_options['advanced']);
	}
	if(isset($theme_options['general']['stricky_header'])){
		$theme_options['general']['sticky_header'] = $theme_options['general']['stricky_header'];			
		update_option(THEME_SLUG . '_' . 'general', $theme_options['general']);
	}
	if(isset($theme_options['general']['stricky_sidebar'])){
		$theme_options['general']['sticky_sidebar'] = $theme_options['general']['stricky_sidebar'];			
		update_option(THEME_SLUG . '_' . 'general', $theme_options['general']);
	}
	
	update_option(THEME_SLUG.'_sticky_fixed', true);
}

if(!get_option(THEME_SLUG.'_search_fixed')){
	if(isset($theme_options['blog']['search_layout'])){
		$theme_options['advanced']['search_layout'] = $theme_options['blog']['search_layout'];
		$theme_options['advanced']['search_display_full'] = $theme_options['blog']['search_display_full'];
		$theme_options['advanced']['search_nothing_found'] = $theme_options['blog']['search_nothing_found'];
		$theme_options['advanced']['search_sidebar'] = $theme_options['sidebar']['search'];

		update_option(THEME_SLUG . '_' . 'advanced', $theme_options['advanced']);
	}
	
	
	update_option(THEME_SLUG.'_search_fixed', true);
}

function theme_portolio_lightbox_value_fix($value){
	if(strpos($value,'%')){
		return '';
	}else{
		return str_replace('px', '', $value);
	}
}

function theme_slideshow_type_fix($type){
	switch($type){
		case 'nivo':
			return 'nivo_default';
		case '3d':
			return 'nivo_default';
		case 'kwicks':
			return 'unleash_default';
		case 'anything':
			return 'ken_default';
	}
}
