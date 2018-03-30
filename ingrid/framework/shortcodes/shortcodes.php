<?php

// SHORTCODES
// ***************************************************************/



// BUTTONS
	function ub_buttons($atts, $content = null){
		extract(shortcode_atts(array(
		'size' => '',		
		'link' => '',
		'color' => '',
		'target' => '',
		'align' => ''
		), $atts));


		//small, medium, large
		if($size == 'small'){
			$class = 'button small';
		}elseif($size == 'large'){
			$class = 'button large';
		}else{
			$class = 'button';
		}

		
		//color
		$style = '';
		if(!empty($color)){
			$style = ' style="background-color:'.$color.'"'; 
		}
		
		//target		
		if(!empty($target)){
			$target = ' target="'.$target.'"'; 
		}

		
		return '<a href="'.$link.'" '.$target.'class="'.$class.'"'.$style.'>'.$content.'</a>';
	}
	add_shortcode("button", "ub_buttons");


/******************************************************************/		
// COLUMNS	
	function tp_col_one_half($atts, $content = null){
		extract(shortcode_atts(array(
		'last' => '',
		'separator' => ''
		), $atts));

		$last_child = '';
		if($last == 'yes'){
			$last_child = ' last';
		}
		
		if($separator == 'yes'){
			$separator = ' column-separator';
		}
		
		return '<div class="one_half'.$last_child.$separator.'">'.force_balance_tags(do_shortcode($content)).'</div>';
	}
	add_shortcode("one_half", "tp_col_one_half");



	function tp_col_one_third($atts, $content = null){
		extract(shortcode_atts(array(
		'last' => '',
		'separator' => ''
		), $atts));

		$last_child = '';
		if($last == 'yes'){
			$last_child = ' last';
		}
		
		if($separator == 'yes'){
			$separator = ' column-separator';
		}
		
		if($last == 'yes'){
			return '<div class="one_third'.$last_child.$separator.'">'.force_balance_tags(do_shortcode($content)).'</div><div class="clear"></div>';
		}else{
			return '<div class="one_third'.$last_child.$separator.'">'.force_balance_tags(do_shortcode($content)).'</div>';
		}
	}
	add_shortcode("one_third", "tp_col_one_third");



	function tp_col_two_third($atts, $content = null){
		extract(shortcode_atts(array(
		'last' => '',
		'separator' => ''
		), $atts));

		$last_child = '';
		if($last == 'yes'){
			$last_child = ' last';
		}
		
		if($separator == 'yes'){
			$separator = ' column-separator';		
		}
		
		if($last == 'yes'){
			return '<div class="two_third'.$last_child.$separator.'">'.force_balance_tags(do_shortcode($content)).'</div><div class="clear"></div>';
		}else{
			return '<div class="two_third'.$last_child.$separator.'">'.force_balance_tags(do_shortcode($content)).'</div>';
		}
	}
	add_shortcode("two_third", "tp_col_two_third");



	function tp_col_one_fourth($atts, $content = null){
		extract(shortcode_atts(array(
		'last' => '',
		'separator' => ''
		), $atts));

		$last_child = '';
		if($last == 'yes'){
			$last_child = ' last';
		}
		
		if($separator == 'yes'){
			$separator = ' column-separator';
		}
		
		
		if($last == 'yes'){
			return '<div class="one_fourth'.$last_child.$separator.'">'.force_balance_tags(do_shortcode($content)).'</div><div class="clear"></div>';
		}else{
			return '<div class="one_fourth'.$last_child.$separator.'">'.force_balance_tags(do_shortcode($content)).'</div>';
		}
	}
	add_shortcode("one_fourth", "tp_col_one_fourth");



	function tp_col_three_fourth($atts, $content = null){
		extract(shortcode_atts(array(
		'last' => '',
		'separator' => ''
		), $atts));

		$last_child = '';
		if($last == 'yes'){
			$last_child = ' last';
		}
		
		if($separator == 'yes'){
			$separator = ' column-separator';
		}
		
		if($last == 'yes'){
			return '<div class="three_fourth'.$last_child.$separator.'">'.force_balance_tags(do_shortcode($content)).'</div><div class="clear"></div>';
		}else{
			return '<div class="three_fourth'.$last_child.$separator.'">'.force_balance_tags(do_shortcode($content)).'</div>';
		}
	}
	add_shortcode("three_fourth", "tp_col_three_fourth");




	function tp_col_one_fifth($atts, $content = null){
		extract(shortcode_atts(array(
		'last' => '',
		'separator' => ''
		), $atts));

		$last_child = '';
		if($last == 'yes'){
			$last_child = ' last';
		}
		
		if($separator == 'yes'){
			$separator = ' column-separator';
		}
		
		if($last == 'yes'){
			return '<div class="one_fifth'.$last_child.$separator.'">'.force_balance_tags(do_shortcode($content)).'</div><div class="clear"></div>';
		}else{
			return '<div class="one_fifth'.$last_child.$separator.'">'.force_balance_tags(do_shortcode($content)).'</div>';
		}
	}
	add_shortcode("one_fifth", "tp_col_one_fifth");



	function tp_col_two_fifth($atts, $content = null){
		extract(shortcode_atts(array(
		'last' => '',
		'separator' => ''
		), $atts));

		$last_child = '';
		if($last == 'yes'){
			$last_child = ' last';
		}
		
		if($last == 'yes'){
			return '<div class="two_fifth'.$last_child.$separator.'">'.force_balance_tags(do_shortcode($content)).'</div><div class="clear"></div>';
		}else{
			return '<div class="two_fifth'.$last_child.$separator.'">'.force_balance_tags(do_shortcode($content)).'</div>';
		}
	}
	add_shortcode("two_fifth", "tp_col_two_fifth");




	function tp_col_three_fifth($atts, $content = null){
		extract(shortcode_atts(array(
		'last' => '',
		'separator' => ''
		), $atts));

		$last_child = '';
		if($last == 'yes'){
			$last_child = ' last';
		}
		
		if($separator == 'yes'){
			$separator = ' column-separator';
		}
		
		
		if($last == 'yes'){
			return '<div class="three_fifth'.$last_child.$separator.'">'.force_balance_tags(do_shortcode($content)).'</div><div class="clear"></div>';
		}else{
			return '<div class="three_fifth'.$last_child.$separator.'">'.force_balance_tags(do_shortcode($content)).'</div>';
		}
	}
	add_shortcode("three_fifth", "tp_col_three_fifth");	
	
	

/******************************************************************/		
// GALLERY	
	function tp_gallery($attr, $content = null){
	//hijack default [gallery] shortcode
	// own gallery
		global $post;
		
		if(get_post_format() == 'gallery' || get_post_meta( $post->ID, '_wp_page_template', true ) == 'page-gallery-with_title.php' || get_post_meta( $post->ID, '_wp_page_template', true ) == 'page-gallery.php'){	
			extract(shortcode_atts(array(
				'ids' => ''
			), $attr));
			
			$img_ids = explode(',',$ids);
			
			if(!empty($img_ids)){
				$output = '<div id="tp_gallery">
					<div id="large_pic">';
					
					//print first image
						$pic = wp_get_attachment_image_src($img_ids[0],'full');				
						$output .= '<a href="'.$pic[0].'" target="_blank"><img src="'.$pic[0].'"'; if(!empty($pic['title'])){ $output .= ' title="'.$pic['title'].'"'; } $output .= ' alt="image" /></a>					
						
					</div>
					
					<div class="title"></div>
					';				
					
				//print img list
					$output .= '
					<div id="pic_list">					
						<a id="nav-left" href="#" title="move list left">&nbsp;</a>
						
						<div id="pics">					
						<ul>';
					
					foreach($img_ids as $img){					
						$pic = wp_get_attachment_image_src($img,array(150,150));
						$picfull = wp_get_attachment_image_src($img,'full');
						$attachment = get_post($img);
						if(is_object($attachment)){
							$imgtitle = $attachment->post_excerpt;
						}
						$output .= '<li><a href="'.$picfull[0].'" data-url="'.$picfull[0].'"><img src="'.$pic[0].'"'; if(!empty($imgtitle)){ $output .= ' title="'.$imgtitle.'"'; } $output .= ' alt="image thumb" /></a></li>';				
					}
					
					$output .= '					
						</ul>
						</div>
					
						<a id="nav-right" href="#" title="move list right">&nbsp;</a>
					</div>';
				
					
					
				$output .= '
				</div>';			
				
				return $output;
				
			}else{
				return '<p><strong>'.__('Error! Couldn\'t find any attached image!','ingrid').'</strong></p>';
			}
		
			
		}else{
		// default gallery
			$post = get_post();

			static $instance = 0;
			$instance++;

			if ( ! empty( $attr['ids'] ) ) {
				// 'ids' is explicitly ordered, unless you specify otherwise.
				if ( empty( $attr['orderby'] ) )
					$attr['orderby'] = 'post__in';
				$attr['include'] = $attr['ids'];
			}

			// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
			if ( isset( $attr['orderby'] ) ) {
				$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
				if ( !$attr['orderby'] )
					unset( $attr['orderby'] );
			}

			extract(shortcode_atts(array(
				'order'      => 'ASC',
				'orderby'    => 'menu_order ID',
				'id'         => $post->ID,
				'itemtag'    => 'dl',
				'icontag'    => 'dt',
				'captiontag' => 'dd',
				'columns'    => 3,
				'size'       => 'thumbnail',
				'include'    => '',
				'exclude'    => ''
			), $attr));

			$id = intval($id);
			if ( 'RAND' == $order )
				$orderby = 'none';

			if ( !empty($include) ) {
				$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

				$attachments = array();
				foreach ( $_attachments as $key => $val ) {
					$attachments[$val->ID] = $_attachments[$key];
				}
			} elseif ( !empty($exclude) ) {
				$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
			} else {
				$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
			}

			if ( empty($attachments) )
				return '';

			if ( is_feed() ) {
				$output = "\n";
				foreach ( $attachments as $att_id => $attachment )
					$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
				return $output;
			}

			$itemtag = tag_escape($itemtag);
			$captiontag = tag_escape($captiontag);
			$icontag = tag_escape($icontag);
			$valid_tags = wp_kses_allowed_html( 'post' );
			if ( ! isset( $valid_tags[ $itemtag ] ) )
				$itemtag = 'dl';
			if ( ! isset( $valid_tags[ $captiontag ] ) )
				$captiontag = 'dd';
			if ( ! isset( $valid_tags[ $icontag ] ) )
				$icontag = 'dt';

			$columns = intval($columns);
			$itemwidth = $columns > 0 ? floor(100/$columns) : 100;
			$float = is_rtl() ? 'right' : 'left';

			$selector = "gallery-{$instance}";

			$gallery_style = $gallery_div = '';
			if ( apply_filters( 'use_default_gallery_style', true ) )
				$gallery_style = "
				<style type='text/css'>
					#{$selector} {
						margin: auto;
					}
					#{$selector} .gallery-item {
						float: {$float};
						margin-top: 10px;
						text-align: center;
						width: {$itemwidth}%;
					}
					#{$selector} img {
						border: 2px solid #cfcfcf;
					}
					#{$selector} .gallery-caption {
						margin-left: 0;
					}
				</style>
				<!-- see gallery_shortcode() in wp-includes/media.php -->";
			$size_class = sanitize_html_class( $size );
			$gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
			$output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );

			$i = 0;
			foreach ( $attachments as $id => $attachment ) {
				//$link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, true, false);
				$link = str_replace( '<a','<a rel="prettyPhoto[gallery'.$post->ID.']" ',wp_get_attachment_link($id, $size, false, false) );

				$output .= "<{$itemtag} class='gallery-item'>";
				$output .= "
					<{$icontag} class='gallery-icon'>
						$link
					</{$icontag}>";
				if ( $captiontag && trim($attachment->post_excerpt) ) {
					$output .= "
						<{$captiontag} class='wp-caption-text gallery-caption'>
						" . wptexturize($attachment->post_excerpt) . "
						</{$captiontag}>";
				}
				$output .= "</{$itemtag}>";
				if ( $columns > 0 && ++$i % $columns == 0 )
					$output .= '<br style="clear: both" />';
			}

			$output .= "
					<br style='clear: both;' />
				</div>\n";

			return $output;
		}
	}
	remove_shortcode('gallery', 'gallery_shortcode');
	add_shortcode('gallery', 'tp_gallery');	
	
	

/******************************************************************/		
// HEADINGS
	function tp_heading($atts, $content = null){
		extract(shortcode_atts(array(
		'title' => '',
		'subtitle' => '',
		'style' => ''
		), $atts));
		
		if(!empty($style) && $style == '2'){		
			$output = '<header class="heading2">
				<div class="left">&nbsp;</div>
					<div class="center">';
			
			if(!empty($title)){
				$output .= '<h1>'.$title.'</h1>';
			}
				
			if(!empty($subtitle)){
				$output .= '<h2>'.$subtitle.'</h2>';
			}
				
			$output .= '
					</div>	
				<div class="right">&nbsp;</div>
			</header>
			';
		
		}else{
			$output = '
			<header class="heading">';
			
			
			if(!empty($title)){
				$output .= '<h1>'.$title.'</h1>';
			}
				
			if(!empty($subtitle)){
				$output .= '<h2>'.$subtitle.'</h2>';
			}
			
			
			$output .= '</header>
			';
			
		}
		
		
			return $output;
	}
	add_shortcode("heading", "tp_heading");	
	
	

/******************************************************************/		
// RULERS	
	function tp_hr(){			
		return '<hr />';
	}
	add_shortcode("hr", "tp_hr");


	function tp_hr_b(){			
		return '<hr class="hr2" />';
	}
	add_shortcode("hr2", "tp_hr_b");


	function tp_hr_c(){			
		return '<hr class="hr3" />';
	}
	add_shortcode("hr3", "tp_hr_c");


	function tp_hr_d(){					
		return '<hr class="hr4" />';
	}
	add_shortcode("hr4", "tp_hr_d");
	
	
	
	
	
/******************************************************************/	
// POSTS / CAROUSEL	
	function tp_posts($atts, $content = null){
		extract(shortcode_atts(array(    
		'limit' => '',
		'columns' => '',
		'category' => '',
		'carousel' => '',
		'title' => '',
		'excerpt' => '',
		'date' => '',
		'review' => ''
		), $atts));	
		
		//columns 4 by default >> 1-4 max	
		if($columns == '3'){ $columns = 'three'; }
		elseif($columns == '2'){ $columns = 'two'; }
		elseif($columns == '1'){ $columns = 'one'; }	
		else{ $columns = 'four'; }
		
		
		
		$output = '<div class="tp-sc-posts" data-col="'.$columns.'">';

			//my excerpt
			if(!function_exists('the_excerpt_max_charlength')){
				function the_excerpt_max_charlength($excerpt,$charlength) {				
					$charlength++;

					if ( mb_strlen( $excerpt ) > $charlength ) {
						$subex = mb_substr( $excerpt, 0, $charlength - 5 );
						$exwords = explode( ' ', $subex );
						$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
						if ( $excut < 0 ) {
							$out = mb_substr( $subex, 0, $excut );
						} else {
							$out = $subex;
						}
						return $out . '...';
					} else {
						return $excerpt;
					}
				}
			}
				
		
				if(empty($limit)){ $limit = '-1'; }
			
				$the_query = new WP_Query( array(				
					'post_type' => 'post',
					'category_name' => $category,
					'posts_per_page' => $limit
				) );
				
			
			if(!empty($carousel)){
				$output .= '
				<div class="tp-carousel" data-text="lol">
					<div class="tp-carousel-nav">
						<a href="#" class="left"></a>
						<a href="#" class="right"></a>
					</div>			
					<ul class="content '.$columns.'">';
			}else{
				$output .= '
				<ul class="'.$columns.'">';
			}
				
				while ( $the_query->have_posts() ){
					$the_query->the_post();		
					
					$thumbnail = wp_get_attachment_image_src ( get_post_thumbnail_id ( $the_query->post->ID ), array('347','158'));
					
					
					
					if($thumbnail[0] != ''){
						$output .= '<li class="hasthumb"><a href="'.get_permalink().'"><img src="'.$thumbnail[0].'" alt="post thumbnail" class="tn" /></a><a href="'.get_permalink().'" class="black">&nbsp;</a>';
					}else{
						$output .= '<li>';
					}
					
					if(!empty($date)){
						$output .= '<a href="'.get_permalink().'"><div class="post-date"><span>'.get_the_date('d').'</span><br />'.strtoupper(get_the_date('M')).'<br /><span class="y">'.get_the_date('Y').'</span></div></a>';
					}
					
					if(!empty($title)){
						$output .= '<a href="'.get_permalink().'"><h3>'.get_the_title().'</h3></a>';
					}
					
					if(!empty($excerpt)){
						$xc = get_the_excerpt();
						$output .= '<p>'.the_excerpt_max_charlength($xc,99).'</p>';
					}
					
					if(!empty($review)){
						//'.get_post_meta($the_query->post->ID,'tp_post_review_overall',true).'
						$output .= '<div class="post-review">';	
						$tp_post_review_style = get_post_meta($the_query->post->ID,'tp_post_review_style',true);
						$tp_post_review_overall = get_post_meta($the_query->post->ID,'tp_post_review_overall',true);
						$tp_post_review_overall_score = get_post_meta($the_query->post->ID,'tp_post_review_overall_score',true);
						if($tp_post_review_style == 'stars'){
							if($tp_post_review_overall_score > 0 && $tp_post_review_overall_score <= 5){																						
								for($i = '1'; $i <= 5; $i++){
									if($tp_post_review_overall_score >= $i){
										$output .= '<img src="'.get_bloginfo('template_url').'/images/review-star.png" alt="review star" />';
									}else{
										$output .= '<img src="'.get_bloginfo('template_url').'/images/review-star-off.png" alt="review star" />';
									}
								}
							}
						}elseif($tp_post_review_style == 'score'){
							$output .= '<span>'.intval($tp_post_review_overall_score).' '.__('out of 10').'</span>';
						}elseif($tp_post_review_style == 'percent'){
							$output .= '<span>'.intval($tp_post_review_overall_score).'%'.'</span>';
						}
					
						$output .= '</div>';
					}
				
					
					$output .= '</li>';
				}		
		
				if(!empty($carousel)){				
					$output .= '				
					</ul>
				</div>';
				}else{
					$output .= '				
					</ul>';
				}
				
		
		wp_reset_postdata();
				
		$output .= '
		</div>';		
				
		return $output;
		
	}
	add_shortcode("posts", "tp_posts");



/******************************************************************/	
// PULLQUOTE
	function tp_pullquote($atts, $content = null){
		extract(shortcode_atts(array(
		'align' => '',
		'type' => ''
		), $atts));
		
		$output = '
		<span class="pullquote';
		
		if($align == 'right'){
			$output .= ' alignright';
		}	
		
		if($type == 'modern'){
			$output .= ' modern';
		}	
		
		$output .= '">'.$content.'</span>
		';
		
		return $output;
	}
	add_shortcode("pullquote", "tp_pullquote");




/******************************************************************/	
// TESTEMONIAL
	function tp_testemonial($atts, $content = null){
		extract(shortcode_atts(array(
		'author' => '',
		'company' => ''
		), $atts));
		
		$output = '
		<div class="testemonial">'.$content;
		
		if(!empty($author) || !empty($company)){
			$output .= '<div class="author">'.$author.'<br /><span>'.$company.'</span></div>';
		}	
		
		$output .= '</div><br />';
		
		return $output;
	}
	add_shortcode("testemonial", "tp_testemonial");
		
	
	
	

/******************************************************************/	
// VERTICAL TABS
	function ub_vtabs($atts, $content = null){	
		extract(shortcode_atts(array(
		'titles' => ''
		), $atts));
		
		$titles = explode(',',$titles);
		
		
		
		$out = '<div class="tabs-vertical"><ul>';
					
		if($titles){
			static $fctr = '1';		
			foreach($titles as $title){
				$GLOBALS['rand'.$fctr] = rand();
				$out .= '<li><a href="#tabs-'.$GLOBALS['rand'.$fctr].'">'.trim($title).'</a></li>';
				$fctr++;
			}
		}	
					
		$out .= '</ul>';
				
			//get contents
			$out .= force_balance_tags(do_shortcode($content));
				
		$out .= '</div>';
					
					
		return $out;
		
	}
	add_shortcode("vtabs", "ub_vtabs");



	function ub_vtab($atts, $content = null){	
		static $foo_count=0; $foo_count++;
		
		return '<div id="tabs-'.$GLOBALS['rand'.$foo_count].'">'.force_balance_tags(do_shortcode($content)).'</div>';
	}
	add_shortcode("vtab", "ub_vtab");

	

/******************************************************************/	
// HORIZONTAL TABS
	function ub_tabs($atts, $content = null){	
		extract(shortcode_atts(array(
		'titles' => ''
		), $atts));
		
		$titles = explode(',',$titles);
		
		
		
		$out = '
				<div class="tabs">
					<ul class="tabnav">
					';
					
		if($titles){
			static $fctr = '1';		
			foreach($titles as $title){
				$GLOBALS['rand'.$fctr] = rand();
				$out .= '<li><a href="#tabs-'.$GLOBALS['rand'.$fctr].'">'.trim($title).'</a></li>
				';
				$fctr++;
			}
		}	
					
		$out .= '	
					</ul>
					';
				
			//get contents
			$out .= force_balance_tags(do_shortcode($content));
				
		$out .= '</div>
				<div class="clear"></div>';
					
					
		return $out;
		
	}
	add_shortcode("tabs", "ub_tabs");



	function ub_tab($atts, $content = null){	
		static $foo_count=0; $foo_count++;
		
		return '<div id="tabs-'.$GLOBALS['rand'.$foo_count].'" class="tabdiv">'.$content.'</div>';
	}
	add_shortcode("tab", "ub_tab");
	
	
	
/******************************************************************/	
// CIRCLED LETTER
	function tp_circle($atts, $content = null){		

		return '<span class="circle">'.$content.'</span>';
	}
	add_shortcode("circle", "tp_circle");

		
	
/******************************************************************/	
// DROPCAP
	function tp_dropcap($atts, $content = null){		

		return '<span class="dropcap">'.$content.'</span>';
	}
	add_shortcode("dropcap", "tp_dropcap");

	
	
/******************************************************************/	
// LISTS
	function tp_list1($atts, $content = null){
			$content = str_replace('<ul>','<ul class="list">',$content);
			$content = str_replace('<ol>','<ol class="list">',$content);
			return $content;
	}
	add_shortcode("list1", "tp_list1");

	function tp_list2($atts, $content = null){
			$content = str_replace('<ul>','<ul class="list-1">',$content);
			$content = str_replace('<ol>','<ol class="list-1">',$content);
			return $content;
	}
	add_shortcode("list2", "tp_list2");

	function tp_list3($atts, $content = null){
			$content = str_replace('<ul>','<ul class="list-2">',$content);
			$content = str_replace('<ol>','<ol class="list-2">',$content);
			return $content;
	}
	add_shortcode("list3", "tp_list3");



/******************************************************************/	
// ICONS
	function tp_icon($atts, $content = null){
		extract(shortcode_atts(array(
		'type' => '',	
		'name' => '',	
		'image' => '',	
		'link' => '',	
		'color' => ''	
		), $atts));
				
		$output = '';
		
		if(!empty($link)){
			$output .= '<a href="'.$link.'" target="_blank">';
		}		
		
		if(!empty($name)){
			$output .= '<i class="fa '.$name.'"'; 
			if(!empty($color)){
				$output .= ' style="color: '.$color.';"';
			}
			$output .= '></i>';
		}elseif(!empty($type)){
			$output .= '<img src="'.get_bloginfo('template_url').'/images/icons/'.$type.'.png" class="tp-icon" alt="icon" title="'.ucfirst($type).'" />';
		}elseif(!empty($image)){
			$output .= '<img src="'.$image.'" class="tp-icon" alt="icon" />';
		}
		
		if(!empty($link)){
			$output .= '</a>';
		}
		
		return $output;
	}
	add_shortcode("icon", "tp_icon");

	
	

/******************************************************************/	
// GRID
	function tp_grid($atts, $content = null){
		extract(shortcode_atts(array(
		'style' => '',
		'category' => '',
		'columns' => '',
		'portfolio' => ''
		), $atts));
		
		if(empty($category)){
			return false;
			break;
		}
		
		if($columns == '3'){ 
			$columns = 'three'; 
			$coln = '3';
		}elseif($columns == '5'){
			$columns = 'five';
			$coln = '5';
		}else{
			$columns = 'four';
			$coln = '4';
		}
		
		if(empty($limit)){ $limit = '-1'; }
		if(empty($style)){ $style = 'modern'; }
		
		if($style == 'modern'){
			$output = '';
		
			//category selector
				if(!empty($portfolio)){
					$currpurl = get_permalink();					
					$output .= '<p class="catselector"><a href="'.$currpurl.'">'.__('ALL CATEGORIES','ingrid').'</a>';
					
					//show all child cats of current parent cat					
					$allcats = get_categories(array(
						'type' => 'post',
						'child_of' => get_cat_id($category)
					));
					if(!empty($allcats)){
						foreach($allcats as $ccats){
							//create category url
							if(strstr($currpurl,'?')){ 
								$caturl = $currpurl.'&amp;cat='.$ccats->slug;
							}else{
								$caturl = $currpurl.'?cat='.$ccats->slug;
							}
							
							$output .= ' <img src="'.get_bloginfo('template_url').'/images/cat-sep.png" alt="category separator" /> <a href="'.$caturl.'">'.$ccats->name.'</a>';
						}
					}
					
					$output .= '</p>';
				}
		
		
			$output .= '<div class="grid '.$style.'">';
				
				
			if(!empty($_GET['cat'])){
				$the_query = new WP_Query( array(				
					'post_type' => 'post',
					'category_name' => sanitize_title($_GET['cat']),
					'posts_per_page' => $limit
				) );
			}else{					
				$the_query = new WP_Query( array(				
					'post_type' => 'post',
					'category_name' => $category,
					'posts_per_page' => $limit
				) );
			}	
				
					
			while ( $the_query->have_posts() ){
				$the_query->the_post();		
				
				$tp_post_grid_size = get_post_meta($the_query->post->ID, 'tp_post_grid_size', true);		
				if(empty($tp_post_grid_size)){ $tp_post_grid_size = ''; $brick_w = '241'; $brick_h = '144'; }
					if($tp_post_grid_size == 'one-two'){ $brick_w = '241'; $brick_h = '292'; }
					if($tp_post_grid_size == 'two-one'){ $brick_w = '486'; $brick_h = '144'; }
					if($tp_post_grid_size == 'two-two'){ $brick_w = '486'; $brick_h = '292'; }
					
				//calc proper image sizes
					if($tp_post_grid_size == ''){
						$thumbnail = wp_get_attachment_image_src ( get_post_thumbnail_id ( $the_query->post->ID ),'grid-one-one');
					}elseif($tp_post_grid_size == 'one-two'){
						$thumbnail = wp_get_attachment_image_src ( get_post_thumbnail_id ( $the_query->post->ID ),'grid-one-two');
					}elseif($tp_post_grid_size == 'two-one'){
						$thumbnail = wp_get_attachment_image_src ( get_post_thumbnail_id ( $the_query->post->ID ),'grid-two-one');
					}elseif($tp_post_grid_size == 'two-two'){
						$thumbnail = wp_get_attachment_image_src ( get_post_thumbnail_id ( $the_query->post->ID ),'grid-two-two');
					}else{
						$thumbnail = wp_get_attachment_image_src ( get_post_thumbnail_id ( $the_query->post->ID ),array($brick_w,$brick_h));
					}
					
					//find exact size for brick
					$img_wh = '';
					$img_w = '';
					$img_h = '';
					
					if($thumbnail[1] == $brick_w && $thumbnail[2] == $brick_h){
						//if found, use it
						$img_wh = 'width="'.$brick_w.'"';
					}else{	
						//if not found, use larger but calculate perfect size to fit well into brick				
						//get large
						$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id ( $the_query->post->ID ),'large' );	
						
						//calc if larger than brick
						if($thumbnail[1] > $brick_w && $thumbnail[2] > $brick_h){
							$ratio = $thumbnail[1] / $thumbnail[2];
							if($ratio > 1){					
								//landscape
								$img_h = round($brick_w / $ratio);
								$img_wh = ' height="'.$img_h.'"';	
							}else{
								//portrait
								$img_w = round($brick_h * $ratio);
								//if img width is smaller than brick, use brick width to fit
								if($img_w < $brick_w){
									$img_w = $brick_w;
								}
								
								$img_wh = ' width="'.$img_w.'"';						
							}					
						}else{
							$img_wh = ' width="'.$brick_w.'"';
						}
					}	
						
			
				$bclass = '';
				if(get_post_format() == 'quote'){$bclass = ' quote';}
			
				$output .= '<div class="brick '.$tp_post_grid_size.$bclass.'">';
				
				if(!empty($thumbnail[0])){
					if(get_post_format() == 'video'){
						$output .= '<a href="'.get_permalink().'"><img src="'.$thumbnail[0].'" '.$img_wh.' alt="post thumbnail" /><img src="'.get_bloginfo('template_url').'/images/blog-video.png" class="video" alt="video post"></a>';					
					}else{
						$output .= '<a href="'.get_permalink().'"><img src="'.$thumbnail[0].'" '.$img_wh.' alt="post thumbnail" /></a>';				
					}
					
					//hover info
					
					$output .= '<div class="hover-info">
					';
					
					$h1x = '';
					if(!has_excerpt()){
						$output .= '<div class="only">';
					}
					
						if(get_post_format() == 'link'){					
							if($GLOBALS['nu_wp_version'] == '1'){					
								$output .= '<a href="'.get_the_post_format_url().'" target="_blank"><h1>'.get_the_title().'</h1></a>';
							}else{
								$output .= '<a href="'.get_post_meta($the_query->post->ID,'tp_postf_link',true).'" target="_blank"><h1>'.get_the_title().'</h1></a>';
							}
						}else{
							$output .= '<a href="'.get_permalink().'"><h1>'.get_the_title().'</h1></a>';
						}
						
						//review if allowed
						$show_review = get_post_meta($the_query->post->ID,'tp_post_review_showoverall',true);
						
						if(!empty($show_review)){
							$tp_post_review_style = get_post_meta($the_query->post->ID,'tp_post_review_style',true);
							$tp_post_review_overall = get_post_meta($the_query->post->ID,'tp_post_review_overall',true);
							$tp_post_review_overall_score = get_post_meta($the_query->post->ID,'tp_post_review_overall_score',true);
							
							if($tp_post_review_overall_score != 'Score' && !empty($tp_post_review_overall_score)){
							
								$output .= '<div class="post-review">';				
									
									
									if($tp_post_review_style == 'stars'){
										$output .= '<span class="stars">';
										if($tp_post_review_overall_score > 0 && $tp_post_review_overall_score <= 5){																						
											for($i = '1'; $i <= 5; $i++){
												if($tp_post_review_overall_score >= $i){
													$output .= '<img src="'.get_bloginfo('template_url').'/images/review-star.png" alt="review star" />';
												}else{
													$output .= '<img src="'.get_bloginfo('template_url').'/images/review-star-off.png" alt="review star" />';
												}
											}
										}
										$output .= '</span>';
									}elseif($tp_post_review_style == 'score'){
										if(!empty($tp_post_review_overall)){
											$output .= '<p>'.$tp_post_review_overall.'<span class="score">'.intval($tp_post_review_overall_score).'%'.'</span></p>';
										}
										
										$output .= '<span class="score">'.intval($tp_post_review_overall_score).' '.__('out of 10').'</span>';
									}elseif($tp_post_review_style == 'percent'){
										if(!empty($tp_post_review_overall)){
											$output .= '<p>'.$tp_post_review_overall.'<span class="score">'.intval($tp_post_review_overall_score).'%'.'</span></p>';
										}
										
									}				
									
									
								$output .= '</div>';
							}
						}
						
						if(!has_excerpt()){
							$output .= '</div>';
						}
						
						
						if(has_excerpt()){
							$excerpt = get_the_excerpt();
								if(!empty($show_review)){ $xlen = 87; }else{ $xlen = 107; }
								if ( strlen( $excerpt ) > $xlen && $tp_post_grid_size == '') {
									$subex = mb_substr( $excerpt, 0, $xlen - 5 );
									$exwords = explode( ' ', $subex );
									$excut = - ( strlen( $exwords[ count( $exwords ) - 1 ] ) );
									if ( $excut < 0 ) {
										$excerpt = mb_substr( $subex, 0, $excut );
									}
									$excerpt .= '...';
								}
								
							$output .= '<p>'.$excerpt.'</p>';
						}
						
					$output .= '
					</div>';
					
					
				}else{
				
					if(get_post_format() == 'audio'){
						
							if(strstr(get_post_meta($the_query->post->ID,'tp_postf_audio',true), '.mp3')){
								$output .= '<a href="'.get_permalink().'"><h1>'.get_the_title().'</h1></a>';
							
								$output .= '
								<div id="audioplayer_'.$the_query->post->ID.'" class="flash-audio">'.__('Couldn\'t load the Audio Player!','ingrid').'</div>
								<script type="text/javascript">
								';  			
								if(empty($audio_printed)){
									$audio_printed = '1';
									
									$output .= '
									AudioPlayer.setup(\''.get_bloginfo('template_url').'/swf/player.swf\', {  
										width: 400,
										height: 50,
										initialvolume: 75,  
										transparentpagebg: \'no\',  
										bg: \'f8f8f8\',
										noinfo: \'yes\',  
										animation: \'no\',
										bg: \'f6f6f6\',
										border: \'f2f2f2\',
										leftbg: \'f8f8f8\',
										rightbg: \'f8f8f8\',
										loader: \'f8f8f8\',
										track: \'e9e9e9\',
										lefticon: \'4a4a4a\',
										righticon: \'4a4a4a\',
										tracker: \'4a4a4a\',
										righticon: \'volslider\',
										righticonhover: \'e9e9e9\',
										rightbghover: \'f8f8f8\',
										voltrack: \'e9e9e9\'
									}); 
									';
								}
								$output .= '
									AudioPlayer.embed("audioplayer_'.$the_query->post->ID.'", {soundFile: "'.get_post_meta($the_query->post->ID,'tp_postf_audio',true).'"});  
								</script>  
								';
							}else{
								$aud = str_replace('&','&amp;',get_post_meta($the_query->post->ID,'tp_postf_audio',true));
								$output .= $aud;
							}
						
					}elseif(get_post_format() == 'video'){
						if($GLOBALS['nu_wp_version'] == '1'){							
							$pattern = '/(width)="[0-9]*"/i';
							$patternb = '/(height)="[0-9]*"/i';
							$cnt = preg_replace($pattern,'width="'.$brick_w.'"',get_the_post_format_media('video'));				
							$cnt = preg_replace($patternb,'height="'.$brick_h.'"',$cnt);	
							$output .= str_replace('?feature=oembed','?feature=oembed&showinfo=0&controls=2&autohide=1',$cnt);
						}else{
							$pattern = '/(width)="[0-9]*"/i';
							$pattern2 = '/(height)="[0-9]*"/i';
							$cnt = preg_replace($pattern,'width="'.$brick_w.'"',get_post_meta($the_query->post->ID,'tp_postf_video',true));
							$cnt = preg_replace($pattern,'height="'.$brick_h.'"',$cnt);					
							$output .= $cnt;
						}	
					
					}elseif(get_post_format() == 'quote'){					
						$output .= '<a href="'.get_permalink().'"><h1>'.get_the_title().'</h1></a>';
						$output .= get_the_content();
						
					}elseif(get_post_format() == 'link'){
						if($GLOBALS['nu_wp_version'] == '1'){					
							$output .= '<a href="'.get_the_post_format_url().'" target="_blank"><h1>'.get_the_title().'</h1></a>';
						}else{
							$output .= '<a href="'.get_post_meta($the_query->post->ID,'tp_postf_link',true).'" target="_blank"><h1>'.get_the_title().'</h1></a>';
						}
						
						if(has_excerpt()){
							$excerpt = get_the_excerpt();
								if ( strlen( $excerpt ) > 137 && $tp_post_grid_size == '') {
									$subex = mb_substr( $excerpt, 0, 137 - 5 );
									$exwords = explode( ' ', $subex );
									$excut = - ( strlen( $exwords[ count( $exwords ) - 1 ] ) );
									if ( $excut < 0 ) {
										$excerpt = mb_substr( $subex, 0, $excut );
									}
									$excerpt .= '...';
								}
								
							$output .= '<p>'.$excerpt.'</p>';
						}
					}else{				
						$output .= '<a href="'.get_permalink().'"><h1>'.get_the_title().'</h1></a>';
						
						if(has_excerpt()){
							$excerpt = get_the_excerpt();
								if ( strlen( $excerpt ) > 137 && $tp_post_grid_size == '' ) {
									$subex = mb_substr( $excerpt, 0, 137 - 5 );
									$exwords = explode( ' ', $subex );
									$excut = - ( strlen( $exwords[ count( $exwords ) - 1 ] ) );
									if ( $excut < 0 ) {
										$excerpt = mb_substr( $subex, 0, $excut );
									}
									$excerpt .= '...';
								}
								
							$output .= '<p>'.$excerpt.'</p>';
						}
					}
				}
							
				$output .= '</div>';
			}
			
			$output .= '</div>';
		
		
		}elseif($style == 'classic'){
			$output = '<div class="grid-classic">';
			
				//category selector
				if(!empty($portfolio)){
					$currpurl = get_permalink();					
					$output .= '<p class="catselector"><a href="'.$currpurl.'">'.__('ALL CATEGORIES','ingrid').'</a>';
					
					//show all child cats of current parent cat					
					$allcats = get_categories(array(
						'type' => 'post',
						'child_of' => get_cat_id($category)
					));
					if(!empty($allcats)){
						foreach($allcats as $ccats){
							//create category url
							if(strstr($currpurl,'?')){ 
								$caturl = $currpurl.'&amp;cat='.$ccats->slug;
							}else{
								$caturl = $currpurl.'?cat='.$ccats->slug;
							}
							
							$output .= ' <img src="'.get_bloginfo('template_url').'/images/cat-sep.png" alt="category separator" /> <a href="'.$caturl.'">'.$ccats->name.'</a>';
						}
					}
					
					$output .= '</p>';
				}
			
				
				if(!empty($_GET['cat'])){
					$the_query = new WP_Query( array(				
						'post_type' => 'post',
						'category_name' => sanitize_title($_GET['cat']),
						'posts_per_page' => $limit
					) );
				}else{					
					$the_query = new WP_Query( array(				
						'post_type' => 'post',
						'category_name' => $category,
						'posts_per_page' => $limit
					) );
				}

				$brickc = '0';
				while ( $the_query->have_posts() ){
					$the_query->the_post();		
					
					$brickc++;
					
					if(($brickc-1)%$coln == 0){
						$clear = ' clearleft';
					}else{
						$clear = '';
					}
					
					
					
					$output .= '<div class="brick '.$columns.$clear.'">';
					
					$thumbnail = wp_get_attachment_image_src ( get_post_thumbnail_id ( $the_query->post->ID ),array(243,180));
					if($thumbnail[1] < 324 || $thumbnail[2] < 180 ){
						$thumbnail = wp_get_attachment_image_src ( get_post_thumbnail_id ( $the_query->post->ID ),'grid-two-two');						
					}
					$fullthumb = wp_get_attachment_image_src(get_post_thumbnail_id ( $the_query->post->ID ),'full');
					
					
					if(!empty($thumbnail[0])){
						if(get_post_format() == 'video'){
							$output .= '<div class="thumb">
							<a href="'.get_permalink().'" class="featuredi"><img src="'.$thumbnail[0].'" alt="post thumbnail" class="tn" /><img src="'.get_bloginfo('template_url').'/images/blog-video.png" class="video" alt="video post"></a>							
								<div class="black">
									<a href="'.get_permalink().'" class="open" rel="prettyPhoto"><img src="'.get_bloginfo('template_url').'/images/thumb-play.png" alt="" /></a>
									<a href="'.get_permalink().'" class="go"><img src="'.get_bloginfo('template_url').'/images/thumb-hover.png" alt="link" /></a>
								</div>
							</div>';
						}else{
							$output .= '<div class="thumb">
							<a href="'.get_permalink().'"><img src="'.$thumbnail[0].'" alt="post thumbnail" class="tn" /></a>
								<div class="black">
									<a href="'.$fullthumb[0].'" class="open" rel="prettyPhoto"><img src="'.get_bloginfo('template_url').'/images/thumb-open.png" alt="" /></a>
									<a href="'.get_permalink().'" class="go"><img src="'.get_bloginfo('template_url').'/images/thumb-hover.png" alt="link" /></a>
								</div>
							</div>';
						}
					}else{
						//audio
						if(get_post_format() == 'audio'){													
						
								if(strstr(get_post_meta($the_query->post->ID,'tp_postf_audio',true), '.mp3')){
									$output .= '<div class="thumb audio">
										<img src="'.get_bloginfo('template_url').'/images/icon-audio.png" alt="audio icon" />
										<div id="audioplayer_'.$the_query->post->ID.'" class="flash-audio">'.__('Couldn\'t load the Audio Player!','ingrid').'</div>
									</div>
									<script type="text/javascript">
									';  			
									if(empty($audio_printed)){
										$audio_printed = '1';
										
										$output .= '
										AudioPlayer.setup(\''.get_bloginfo('template_url').'/swf/player.swf\', {  
											width: 400,
											height: 50,
											initialvolume: 75,  
											transparentpagebg: \'no\',  
											bg: \'f8f8f8\',
											noinfo: \'yes\',  
											animation: \'no\',
											bg: \'f6f6f6\',
											border: \'f2f2f2\',
											leftbg: \'f8f8f8\',
											rightbg: \'f8f8f8\',
											loader: \'f8f8f8\',
											track: \'e9e9e9\',
											lefticon: \'4a4a4a\',
											righticon: \'4a4a4a\',
											tracker: \'4a4a4a\',
											righticon: \'volslider\',
											righticonhover: \'e9e9e9\',
											rightbghover: \'f8f8f8\',
											voltrack: \'e9e9e9\'
										}); 
										';
									}
									$output .= '
										AudioPlayer.embed("audioplayer_'.$the_query->post->ID.'", {soundFile: "'.get_post_meta($the_query->post->ID,'tp_postf_audio',true).'"});  
									</script>  
									';
								}else{									
									$aud = '<div class="thumb">'.str_replace('&','&amp;',get_post_meta($the_query->post->ID,'tp_postf_audio',true)).'</div>';
									$output .= $aud;
								}
							
						}
						elseif(get_post_format() == 'video'){
							$pattern = '/(width)="[0-9]*"/i';
							$pattern2 = '/(height)="[0-9]*"/i';
							if($columns == 'four'){$cw = '243';; $ch = '170';}
							if($columns == 'three'){$cw = '324';; $ch = '170';}
							if($columns == 'five'){$cw = '194'; $ch = '150';}
							
							if($GLOBALS['nu_wp_version'] == '1'){		
								$cnt = preg_replace($pattern,'width="'.$cw.'"',get_the_post_format_media('video'));												
								$cnt = preg_replace($pattern2,'height="'.$ch.'"',$cnt);				
								$output .= '<div class="thumb">'.str_replace('?feature=oembed','?feature=oembed&showinfo=0&controls=2',$cnt).'</div>';
							}else{								
								$cnt = preg_replace($pattern,'width="'.$cw.'"',get_post_meta($the_query->post->ID,'tp_postf_video',true));
								$cnt = preg_replace($pattern2,'height="'.$ch.'"',$cnt);					
								$output .= $cnt;
							}
						}else{
							$output .= '<div class="thumb">&nbsp;</div>';
						}
						
						
					}
					
					if(get_post_format() == 'link'){
						if($GLOBALS['nu_wp_version'] == '1'){					
							$output .= '<a href="'.get_the_post_format_url().'" target="_blank"><h1>'.get_the_title().'</h1></a>';
						}else{
							$output .= '<a href="'.get_post_meta($the_query->post->ID,'tp_postf_link',true).'" target="_blank"><h1>'.get_the_title().'</h1></a>';
						}
					}else{
						$output .= '<a href="'.get_permalink().'"><h1>'.get_the_title().'</h1></a>';
					}
					
					$cats = '';
					$get_cats = get_the_category();
					if(!empty($get_cats)){
						$output .= '<p class="category">';
						foreach($get_cats as $category) { 
							if($category->category_parent  != 0){
								$cats[] .= $category->cat_name;
							}
						}
						if(!empty($cats)){
							$output .= implode(', ',$cats);						
						}
						$output .= '</p>';
					}else{
						$output .= '<p>&nbsp;</p>';
					}
					
					$output .= '</div>';
				}
			
			$output .= '</div>';
		}
		

		return $output;
	}
	add_shortcode("grid", "tp_grid");
	
	
	
/******************************************************************/	
// TOGGLES
	function ub_toggles($atts, $content = null){	
		extract(shortcode_atts(array(
		'title' => '',
		'image' => ''
		), $atts));
		
		if(!empty($image)){
			$image = ' style="background-image:url(\''.$image.'\');"';
		}
					
		return do_shortcode('<a href="#" class="toggle"'.$image.'>'.$title.'</a>
		<div class="toggle_box">
			<div class="block">
				'.$content.'
			</div>
		</div>');
		
	}
	add_shortcode("toggle", "ub_toggles");
	
	
	
/******************************************************************/	
// VIDEO
	function tp_video($atts, $content = null){
		extract(shortcode_atts(array(    
		'url' => '',
		'width' => '',
		'height' => ''
		), $atts));
		
		if(strstr($url,'youtube')){
			$type = 'youtube';
		}elseif(strstr($url,'vimeo')){
			$type = 'vimeo';
		}
		
		if(!empty($width) || !empty($height)){
			$style = ' style="';
			if(!empty($width)){
				$style .= 'width: '.$width.';';
			}
			if(!empty($height)){
				$style .= 'height: '.$width.';';
			}
			
			$style .= '"';
		}
		
		if($type=='youtube'){
		
			parse_str( parse_url( $url, PHP_URL_QUERY ) );	
			
			
			return '<iframe src="http://www.youtube.com/embed/'.$v.'?showinfo=0" frameborder="0" class="tp-video"'.$style.' allowfullscreen></iframe>';
		}elseif($type=='vimeo'){
		
			$expu = explode('/',$url);
			$eind = count($expu) - 1;
			$videoid = $expu[$eind];		
			
			return '<iframe src="http://player.vimeo.com/video/'.$videoid.'?title=0&amp;byline=0&amp;portrait=0"'.$style.' frameborder="0"></iframe>';	
		}	
		
	}
	add_shortcode("vid", "tp_video");

	
	
	

/******************************************************************/	
// VERTICAL SPACE
	function tp_vspace($atts, $content = null){	
		if(!empty($atts)){
			extract(shortcode_atts(array(
			'size' => ''
			), $atts));
		}

		$style = '';
		if(!empty($size)){
			$size = intval($size);
			$style = ' style="height: '.$size.'px;"';
		}
		
		return '<div class="vspace"'.$style.'></div>';
		
	}
	add_shortcode("vspace", "tp_vspace");

	
	
	
/******************************************************************/	
// PRICING TABLE	
	function tp_plan($atts, $content = null){	
		if(!empty($atts)){
			extract(shortcode_atts(array(
			'price' => '',
			'title' => '',
			'button' => '',
			'link' => '',
			'color' => '',
			'per' => ''
			), $atts));
		}
		
		if(!empty($color)){
			$color = ' color="'.$color.'"';
		}
		
		$output = '<div class="pricing-table">';
		
		//plan title
		if(!empty($title)){
			$output .= '<h3>'.$title.'</h3>';
		}
		
		//circle
		if(!empty($price)){
			$output .= '<div class="price">'.$price.'</div>';
		}
		
		//per
		if(!empty($per)){
			$output .= '<p class="per">'.$per.'</p>';
		}	
		
		//content -> list
		$output .= $content;
		
		//button
		if(!empty($button) && !empty($link)){
			$output .= do_shortcode('[button link="'.$link.'"'.$color.']'.$button.'[/button]');
		}
		
		
		
		$output .= '</div>';
		
		return $output;
	}
	add_shortcode("plan", "tp_plan");

	

/******************************************************************/	
// GOOGLE MAPS
	function tp_gmaps($atts) {	
		$randid = 'gmap'.mt_rand(1,1000);
		$atts = shortcode_atts(array(		
			'zoom' => '1',
			'width' => '100%',
			'height' => '300',
			'maptype' => 'ROADMAP',
			'address' => '',			
			'marker' => '',
			'markerimage' => '',
			'infowindow' => '',
			'infowindowdefault' => 'yes',			
			'hidecontrols' => 'false',
			'scale' => 'false',
			'scrollwheel' => 'true'			
		), $atts);
										
		$output = '<div class="mapholder"><div id="' .$randid . '" style="width:' . $atts['width'] . '; height:' . $atts['height'] . ';" class="gmap"></div></div>';
		
		if(empty($_SESSION['gmapjs'])){
		$output .= '
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>';
		$_SESSION['gmapjs'] = '1';
		}
		
		$output .= '
		<script type="text/javascript">			
			var latlng = new google.maps.LatLng(0, 0);
			var myOptions = {			
				center: latlng,
				zoom: ' . $atts['zoom'] . ',				
				scrollwheel: ' . $atts['scrollwheel'] .',
				scaleControl: ' . $atts['scale'] .',
				disableDefaultUI: ' . $atts['hidecontrols'] .',
				mapTypeId: google.maps.MapTypeId.' . $atts['maptype'] . '
			};
			var ' . $randid . ' = new google.maps.Map(document.getElementById("' . $randid . '"),
			myOptions);
			';
					
		//address
			if($atts['address'] != ''){
				$output .= '
				var geocoder_' . $randid . ' = new google.maps.Geocoder();
				var address = \'' . $atts['address'] . '\';
				geocoder_' . $randid . '.geocode( { \'address\': address}, function(results, status) {
					if (status == google.maps.GeocoderStatus.OK) {
						' . $randid . '.setCenter(results[0].geometry.location);
						';
						
						if ($atts['marker'] !='')
						{
							//add custom image
							if ($atts['markerimage'] !='')
							{
								$output .= 'var image = "'. $atts['markerimage'] .'";';
							}
							$output .= '
							var marker = new google.maps.Marker({
								map: ' . $randid . ', 
								';
								if ($atts['markerimage'] !='')
								{
									$output .= 'icon: image,';
								}
							$output .= '
								position: ' . $randid . '.getCenter()
							});
							';

							//infowindow
							if($atts['infowindow'] != '') 
							{
								//first convert and decode html chars
								$thiscontent = htmlspecialchars_decode($atts['infowindow']);
								$output .= '
								var contentString = \'' . $thiscontent . '\';
								var infowindow = new google.maps.InfoWindow({
									content: contentString
								});
											
								google.maps.event.addListener(marker, \'click\', function() {
								  infowindow.open(' . $randid . ',marker);
								});
								';

								//infowindow default
								if ($atts['infowindowdefault'] == 'yes')
								{
									$output .= '
										infowindow.open(' . $randid . ',marker);
									';
								}
							}
						}
				$output .= '
					} else {
					alert("Geocode was not successful for the following reason: " + status);
				}
				});
				';
			}

		//marker: show if address is not specified
			if ($atts['marker'] != '' && $atts['address'] == ''){
				//add custom image
				if ($atts['markerimage'] !='')
				{
					$output .= 'var image = "'. $atts['markerimage'] .'";';
				}

				$output .= '
					var marker = new google.maps.Marker({
					map: ' . $randid . ', 
					';
					if ($atts['markerimage'] !='')
					{
						$output .= 'icon: image,';
					}
				$output .= '
					position: ' . $randid . '.getCenter()
				});
				';

			//infowindow
				if($atts['infowindow'] != ''){
					$output .= '
					var contentString = \'' . $atts['infowindow'] . '\';
					var infowindow = new google.maps.InfoWindow({
						content: contentString
					});
								
					google.maps.event.addListener(marker, \'click\', function() {
					  infowindow.open(' . $randid . ',marker);
					});
					';
					//infowindow default
					if ($atts['infowindowdefault'] == 'yes')
					{
						$output .= '
							infowindow.open(' . $randid . ',marker);
						';
					}				
				}
			}
			
			$output .= '</script>';
			
			
			return $output;
	}
	add_shortcode('map', 'tp_gmaps');
	
	
	


/******************************************************************/	
// GOOGLE FONTS	
	function tp_gfonts( $atts, $content = null) {
		extract( shortcode_atts( array(
			'name' => 'Economica',
			'size' => '20px',
			'style' => ''
		), $atts ) );
		
	    $font = str_replace(" ","+",$name);
      
		return '<link href="http://fonts.googleapis.com/css?family='.$font.'" rel="stylesheet" type="text/css" />
      	<div class="gfont" style="font-family:\'' .$name. '\', serif !important; font-size:' .$size. '; '.$style.'">' . do_shortcode($content) . '</div>';				
	}
	add_shortcode('font', 'tp_gfonts');
	
	
	
	


/******************************************************************/	
// RESPONSIVE APPEREANCE
	function tp_display( $atts, $content = null) {
		extract( shortcode_atts( array(
			'device' => 'mobile'			
		), $atts ) );		
	  
		return '<div class="tp-display-'.$device.'">' . do_shortcode($content) . '</div>';				
	}
	add_shortcode('display', 'tp_display');	


	


/******************************************************************/	
// AUDIO	
	function tp_audio( $atts, $content = null) {
		extract( shortcode_atts( array(
			'url' => '',			
			'width' => ''			
		), $atts ) );		
	  
		if(!empty($width)){
			$width = intval($width);
		}else{
			$width = '700';
		}
		
		$randid = mt_rand(1,999);
		
		return '<div id="audioplayer_'.$randid.'" class="flash-audio">'.__('Couldn\'t load the Audio Player!','ingrid').'</div>
		<div class="clear"></div>
		<script type="text/javascript">
			AudioPlayer.setup(\''.get_bloginfo('template_url').'/swf/player.swf\', {  
				width: '.$width.',
				height: 50,
				initialvolume: 75,  
				transparentpagebg: \'no\',  
				bg: \'f8f8f8\',
				noinfo: \'yes\',  
				animation: \'no\',
				bg: \'f6f6f6\',
				border: \'f2f2f2\',
				leftbg: \'f8f8f8\',
				rightbg: \'f8f8f8\',
				loader: \'f8f8f8\',
				track: \'e9e9e9\',
				lefticon: \'4a4a4a\',
				righticon: \'4a4a4a\',
				tracker: \'4a4a4a\',
				righticon: \'volslider\',
				righticonhover: \'e9e9e9\',
				rightbghover: \'f8f8f8\',
				voltrack: \'e9e9e9\'
			}); 
			AudioPlayer.embed("audioplayer_'.$randid.'", {soundFile: "'.$url.'"});  
		</script>  
		';
	
	}
	add_shortcode('aud', 'tp_audio');	




/******************************************************************/	
// CALL TO ACTION PART

	function tp_cta( $atts, $content = null) {	  
		return '<div class="cta">' . do_shortcode($content) . '</div>';				
	}
	add_shortcode('cta', 'tp_cta');	


	
?>