<?php

if(!function_exists('theme_shortcode_carousel')){
function theme_shortcode_carousel($atts, $content=null){
	global $wp_filter;
	$the_content_filter_backup = $wp_filter['the_content'];

	extract(shortcode_atts(array(
		'title' => false,
		'width' => '200',
		'height' => '150',
		'number' => -1,
		'autoplay'=>'true',
		'infinite' => 'true',
		'circular' => 'false',
		'delay' => '4000',
		'speed' => '1000',
		'direction' => 'right', // top, right, bottom, left
		'nav' => 'false',
		// 'mousewheel' => 'true',
		'touch' => 'true',
		'source' => '',
		'keyboard' => 'false',
		'lightbox' => 'false',
		'link_target' => '_self',
		'class' => '',
	), $atts));
	
	wp_enqueue_script( 'carousel-init');
	$output = '<ul>';
	$images = array();
	if(!empty($source)){
		$images = SlideshowGenerator::get_images($source,$number,'full');
	}

	if (preg_match_all("/(.?)\[(carousel_image)\b(.*?)(?:(\/))?\](?:(.+?)\[\/carousel_image\])?(.?)/s", $content, $matches)) {
		for($i = 0; $i < count($matches[0]); $i++) {
			$options = theme_shortcode_parse_atts($matches[3][$i]);
			if(!isset($options['source_type']) || !isset($options['source_value'])){
				continue;
			}
			$image = array(
				'source' => array(
					'type' => $options['source_type'],
					'value' => $options['source_value'],
				)
			);

			if(isset($options['caption'])){
				$image['caption'] = $options['caption'];
			}
			if(isset($options['link'])){
				$image['link'] = $options['link'];
			}
			$images[] = $image;
		}
	}
	foreach ($images as $image) {
		$image_src = theme_get_image_src($image['source'], array($width, $height));
		if(!$image_src){
			continue;
		}
		$output .= '<li>';
		
		if(isset($image['caption'])){
			$caption = $image['caption'];
		} else {
			$caption = '';
		}
		$img = '<img data-src="'.$image_src.'" data-lazyload="true" alt="'.$caption.'" />';

		if($lightbox === 'true'){
			$output .= '<a class="fancybox" href="'.theme_get_image_src($image['source'], 'full').'" alt="'.$caption.'" title="'.$caption.'">'.$img.'</a>';
		}elseif(isset($image['link']) && !empty($image['link'])){
			$output .= '<a href="'.$image['link'].'" alt="'.$caption.'" title="'.$caption.'" target="'.$link_target.'">'.$img.'</a>';
		} else {
			$output .= $img;
		}
		$output .= '</li>';
	}
	$output .= '</ul>';

	$heading = '';
	$title_html = '';
	$nav_html = '';
	if($title){
		$title_html = '<div class="carousel_title">'.$title.'</div>';
	}
	if($nav === 'true'){
		$nav_html = '<div class="carousel_nav"><a class="carousel_nav_prev" href="#"> </a><a class="carousel_nav_next" href="#"> </a></div>';
	}
	if($title_html || $nav_html){
		$heading = '<div class="carousel_heading">'.$title_html.$nav_html.'</div>';
	}
	$id = md5(serialize($output).rand(10, 1000));

	wp_reset_postdata();
	$wp_filter['the_content'] = $the_content_filter_backup;
	if($circular === 'true') {
		$type = 'circular';
	}else{
		$type = 'basic';
	}
	if($class){
		$class = ' '.$class;
	}
	return <<<HTML
<div class="carousel_wrap{$class}">{$heading}
<div id="carousel_{$id}" data-autoplay="{$autoplay}" data-infinite="{$infinite}" data-type="{$type}" data-delay="{$delay}" data-speed="{$speed}" data-direction="{$direction}" data-touch="{$touch}" data-keyboard="{$keyboard}" class="carousel">{$output}</div>
<style>
#carousel_{$id} > ul > li {
	width: {$width}px;
	height: {$height}px;
}
</style>
</div>
HTML;
}
}
add_shortcode('carousel', 'theme_shortcode_carousel');

if(!function_exists('theme_shortcode_product_carousel')){
function theme_shortcode_product_carousel($atts, $content=null){
	global $wp_filter;
	$the_content_filter_backup = $wp_filter['the_content'];

	extract(shortcode_atts(array(
		'ids' => false,
		'title' => false,
		'width' => '200',
		'height' => '150',
		'number' => -1,
		'autoplay'=>'true',
		'infinite' => 'true',
		'circular' => 'false',
		'delay' => '4000',
		'speed' => '1000',
		'direction' => 'right', // top, right, bottom, left
		'nav' => 'false',
		// 'mousewheel' => 'true',
		'touch' => 'true',
		'post_type' => 'product',
		'taxonomy' => false,
		'terms' => false,
		'keyboard' => 'false',
		'random' => 'false',
		'link_target' => '_self',
		'class' => '',
	), $atts));
	
	wp_enqueue_script( 'carousel-init');

	$query = array(
		'posts_per_page' => (int)$number,
		'post_type'=>$post_type,
		'showposts' => $number
	);
	if($random === 'true'){
		$query['orderby'] = 'rand';
	}

	if($post_type === 'product'){
		if($post_type === 'product' && class_exists('Woocommerce')){
			//if ( get_option( 'woocommerce_hide_out_of_stock_items' ) == 'yes' ) {
				$query['meta_query'] = array(
					array(
						'key'       => '_stock_status',
						'value'     => 'instock',
						'compare'   => '='
					)
				);
			//}
		}
	}
	if($taxonomy && $terms){
		$query['tax_query'] = array(
			array(
				'taxonomy' => $taxonomy,
				'field' => 'slug',
				'terms' => explode(',',$terms)
			)
		);
	}

	if($ids){
		$query['post__in'] = explode(',', $ids);
	}

	$r = new WP_Query($query);

	$images = array();
	while ( $r->have_posts() ) : $r->the_post();
	$image_id = get_post_thumbnail_id();
	if(!empty($image_id)){
		$image_array = array(
			'source' => array(
				'type'=>'attachment_id',
				'value'=>$image_id
			),
			'post_id'=> get_the_ID(),
			'title' => get_the_title(),
			'desc'  => get_the_excerpt(),
			'link' => get_permalink(),
			'target' => '_self'
		);
		$images[] = $image_array;
	}
	endwhile;

	$output = '<ul>';	
	foreach ($images as $image) {
		$image_src = theme_get_image_src($image['source'], array($width, $height));
		if(!$image_src){
			continue;
		}
		$output .= '<li>';
		$image_src = theme_get_image_src($image['source'], array($width, $height));

		if(isset($image['title'])){
			$caption = $image['title'];
		} else {
			$caption = '';
		}
		$img = '<img data-src="'.$image_src.'" data-lazyload="true" alt="'.wp_strip_all_tags($caption).'" />';

		if(isset($image['link'])){
			$output .= '<a href="'.$image['link'].'" title="'.wp_strip_all_tags($caption).'" alt="'.wp_strip_all_tags($caption).'" target="'.$link_target.'">'.$img.'</a>';
		} else {
			$output .= $img;
		}
		$output .= '</li>';
	}
	$output .= '</ul>';

	$heading = '';
	$title_html = '';
	$nav_html = '';
	if($title){
		$title_html = '<div class="carousel_title">'.$title.'</div>';
	}
	if($nav === 'true'){
		$nav_html = '<div class="carousel_nav"><a class="carousel_nav_prev" href="#"> </a><a class="carousel_nav_next" href="#"> </a></div>';
	}
	if($title_html || $nav_html){
		$heading = '<div class="carousel_heading">'.$title_html.$nav_html.'</div>';
	}
	$id = md5(serialize($output).rand(10, 1000));

	wp_reset_postdata();
	$wp_filter['the_content'] = $the_content_filter_backup;
	if($circular === 'true') {
		$type = 'circular';
	}else{
		$type = 'basic';
	}
	if($class){
		$class = ' '.$class;
	}
	return <<<HTML
<div class="carousel_wrap{$class}">{$heading}
<div id="carousel_{$id}" data-autoplay="{$autoplay}" data-infinite="{$infinite}" data-type="{$type}" data-delay="{$delay}" data-speed="{$speed}" data-direction="{$direction}" data-touch="{$touch}" data-keyboard="{$keyboard}" class="carousel">{$output}</div>
<style>
#carousel_{$id} > ul > li {
	width: {$width}px;
	height: {$height}px;
}
</style>
</div>
HTML;
}
}
add_shortcode('product_carousel', 'theme_shortcode_product_carousel');