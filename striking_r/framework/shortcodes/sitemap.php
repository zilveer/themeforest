<?php
if(!function_exists('theme_shortcode_sitemap')){
function theme_shortcode_sitemap($atts, $content = null, $code) {
	if(isset($atts['type'])){
		switch($atts['type']){
			case 'pages':
				return theme_sitemap_pages($atts);
			case 'posts':
				return theme_sitemap_posts($atts);
			case 'categories':
				return theme_sitemap_categories($atts);
			case 'portfolios':
				return theme_sitemap_portfolios($atts);
			case 'all':
			default:
				return theme_sitemap_all($atts);			
		}
	}
	return '';
}
}

add_shortcode('sitemap', 'theme_shortcode_sitemap');

if(!function_exists('theme_sitemap_pages')){
function theme_sitemap_pages($atts){
	extract(shortcode_atts(array(
		'number' => '0',
		'depth' => '0',
		'class' => '',
	), $atts));

	if($class){
		$class = ' '.$class;
	}
	
	return '<ul class="sitemap_wrap'.$class.'">'.wp_list_pages('depth=0&sort_column=menu_order&echo=0&title_li=&depth='.$depth.'&number='.$number ).'</ul>';
}
}

if(!function_exists('theme_sitemap_categories')){
function theme_sitemap_categories($atts){
	extract(shortcode_atts(array(
		'number' => '0',
		'depth' => '0',
		'show_count' => true,
		'show_feed' => true,
		'class' => '',
	), $atts));
	
	if($class){
		$class = ' '.$class;
	}

	if($show_count === 'false'){
		$show_count = false;
	}
	if($show_feed === true || $show_feed == 'true'){
		$feed = __( 'RSS', 'striking-r' );
	}else{
		$feed = '';
	}

	$exclude_cats = theme_get_option('blog','exclude_categorys');
	return '<ul class="sitemap_wrap'.$class.'">'.wp_list_categories( array( 'exclude'=> implode(",",$exclude_cats), 'feed' => $feed, 'show_count' => $show_count, 'use_desc_for_title' => false, 'title_li' => false, 'echo' => 0, 'depth'=> $depth) ).'</ul>';
}
}

if(!function_exists('theme_sitemap_posts')){
function theme_sitemap_posts($atts){
	extract(shortcode_atts(array(
		'show_comment' => true,
		'number' => '0',
		'cat' => '',
		'posts' => '',
		'author' => '',
		'class' => '',
	), $atts));

	if($class){
		$class = ' '.$class;
	}
	
	if($number == 0){
		$number = 1000;
	}
	if($show_comment === 'false'){
		$show_comment = false;
	}
	
	$query = array(
		'showposts' => (int)$number,
		'post_type'=>'post',
	);
	if($cat){
		$query['cat'] = $cat;
	}
	if($posts){
		$query['post__in'] = explode(',',$posts);
	}
	if($author){
		$query['author'] = $author;
	}
	$archive_query = new WP_Query( $query );
	
	$output = '';
	while ($archive_query->have_posts()) : $archive_query->the_post();
		$output .= '<li><a href="'.get_permalink().'" rel="bookmark" title="'.sprintf( __("Permanent Link to %s", 'striking-r'), get_the_title() ).'">'. get_the_title().'</a>'.($show_comment?' ('.get_comments_number().')':'').'</li>';
	endwhile;
	return '<ul class="sitemap_wrap'.$class.'">'.$output.'</ul>';
}
}

if(!function_exists('theme_sitemap_portfolios')){
function theme_sitemap_portfolios($atts){
	extract(shortcode_atts(array(
		'show_comment' => false,
		'number' => '0',
		'cat' => '',
		'class' => '',
	), $atts));
	
	if($class){
		$class = ' '.$class;
	}

	if($number == 0){
		$number = 1000;
	}
	
	if($show_comment === 'true' && theme_get_option('portfolio','enable_comment')){
		$show_comment = true;
	}
	
	$query = array(
		'showposts' => (int)$number,
		'post_type'=>'portfolio',
		
	);
	if($cat != ''){
		global $wp_version;
		if(version_compare($wp_version, "3.1", '>=')){
			$query['tax_query'] = array(
				array(
					'taxonomy' => 'portfolio_category',
					'field' => 'slug',
					'terms' => explode(',', $cat)
				)
			);
		}else{
			$query['taxonomy'] = 'portfolio_category';
			$query['term'] = $cat;
		}
	}
	
	query_posts( $query );
	
	$output = '';
	while (have_posts()) : the_post();
		$output .= '<li><a href="'.get_permalink().'" rel="bookmark" title="'.sprintf( __("Permanent Link to %s", 'striking-r'), get_the_title() ).'">'. get_the_title().'</a>'.($show_comment?' ('.get_comments_number().')':'').'</li>';
	endwhile;
	wp_reset_query();
	return '<ul class="sitemap_wrap'.$class.'">'.$output.'</ul>';
}
}

if(!function_exists('theme_sitemap_all')){
function theme_sitemap_all($atts){
	extract(shortcode_atts(array(
		'number' => '0',
		'shows' => 'pages,categories,posts,portfolios',
	), $atts));
	
	$shows = explode(',', $shows);
	if(empty($shows)){
		return '';
	}
	
	$output = '';
	
	if(in_array('pages',$shows)){
		$output .= '<h2>'.__('Pages','striking-r').'</h2>';
		$output .= theme_sitemap_pages($atts);
		$output .= '<div class="divider top"><a href="#">'.__('Top','striking-r').'</a></div> ';
	}
	if(in_array('categories',$shows)){
		$output .= '<h2>'.__('Category Archives','striking-r').'</h2>';
		$output .= theme_sitemap_categories($atts);
		$output .= '<div class="divider top"><a href="#">'.__('Top','striking-r').'</a></div> ';
	}
	if(in_array('posts',$shows)){
		$output .= '<h2>'.__('Blog Posts','striking-r').'</h2>';
		$output .= theme_sitemap_posts($atts);
		$output .= '<div class="divider top"><a href="#">'.__('Top','striking-r').'</a></div> ';
	}
	if(in_array('portfolios',$shows)){
		$output .= '<h2>'.__('Portfolios','striking-r').'</h2>';
		$output .= theme_sitemap_portfolios($atts);
		$output .= '<div class="divider top"><a href="#">'.__('Top','striking-r').'</a></div> ';
	}
	
	return $output;
}
}