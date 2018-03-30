<?php

if (!function_exists('register_button')) {
function register_button( $buttons ) {
   array_push( $buttons, "|", "qode_shortcodes" );
   return $buttons;
}
}

if (!function_exists('add_plugin')) {
function add_plugin( $plugin_array ) {
   $plugin_array['qode_shortcodes'] = get_template_directory_uri() . '/includes/qode_shortcodes.js';
   return $plugin_array;
}
}

if (!function_exists('qode_shortcodes_button')) {
function qode_shortcodes_button() {

   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
      return;
   }

   if ( get_user_option('rich_editing') == 'true' ) {
      add_filter( 'mce_external_plugins', 'add_plugin' );
      add_filter( 'mce_buttons', 'register_button' );
   }

}
}

add_action('init', 'qode_shortcodes_button');


if (!function_exists('no_wpautop')) {
function no_wpautop($content) 
{ 
        $content = do_shortcode( shortcode_unautop($content) ); 
        $content = preg_replace( '#^<\/p>|^<br \/>|<p>$#', '', $content );
        return $content;
}
}
if (!function_exists('num_shortcodes')) {
function num_shortcodes($content) 
{ 
        $columns = substr_count( $content, '[pricing_cell' );
		return $columns;
}
}


/* Three columns wrap shortcode */

if (!function_exists('three_columns')) {
function three_columns($atts, $content = null) {
    return '<div class="three_columns clearfix">' . do_shortcode($content) . '</div>';
}
}
add_shortcode('three_columns', 'three_columns');

/* Four columns wrap shortcode */

if (!function_exists('four_columns')) {
function four_columns($atts, $content = null) {
    return '<div class="four_columns clearfix">' . do_shortcode($content) . '</div>';
}
}
add_shortcode('four_columns', 'four_columns');

/* Two columns wrap shortcode */

if (!function_exists('two_columns')) {
function two_columns($atts, $content = null) {
    return '<div class="two_columns_50_50 clearfix">' . do_shortcode($content) . '</div>';
}
}
add_shortcode('two_columns', 'two_columns');

/* Two columns 66_33 wrap shortcode */

if (!function_exists('two_columns_66_33')) {
function two_columns_66_33($atts, $content = null) {
    return '<div class="two_columns_66_33 clearfix">' . do_shortcode($content) . '</div>';
}
}
add_shortcode('two_columns_66_33', 'two_columns_66_33');

/* Two columns 33_66 wrap shortcode */

if (!function_exists('two_columns_33_66')) {
function two_columns_33_66($atts, $content = null) {
    return '<div class="two_columns_33_66 clearfix">' . do_shortcode($content) . '</div>';
}
}
add_shortcode('two_columns_33_66', 'two_columns_33_66');

/* Two columns 75_25 wrap shortcode */

if (!function_exists('two_columns_75_25')) {
function two_columns_75_25($atts, $content = null) {
    return '<div class="two_columns_75_25 clearfix">' . do_shortcode($content) . '</div>';
}
}
add_shortcode('two_columns_75_25', 'two_columns_75_25');

/* Two columns 25_75 wrap shortcode */

if (!function_exists('two_columns_25_75')) {
function two_columns_25_75($atts, $content = null) {
    return '<div class="two_columns_25_75 clearfix">' . do_shortcode($content) . '</div>';
}
}
add_shortcode('two_columns_25_75', 'two_columns_25_75');

/* Column one shortcode */

if (!function_exists('column1')) {
function column1($atts, $content = null) {
	return '<div class="column1"><div class="column_inner">' . do_shortcode($content) . '</div></div>';
}
}
add_shortcode('column1', 'column1');

/* Column two shortcode */

if (!function_exists('column2')) {
function column2($atts, $content = null) {
	return '<div class="column2"><div class="column_inner">' . do_shortcode($content) . '</div></div>';
}
}
add_shortcode('column2', 'column2');

/* Column three shortcode */

if (!function_exists('column3')) {
function column3($atts, $content = null) {
   return '<div class="column3"><div class="column_inner">' . do_shortcode($content) . '</div></div>';
}
}
add_shortcode('column3', 'column3');

/* Column four shortcode */

if (!function_exists('column4')) {
function column4($atts, $content = null) {
   return '<div class="column4"><div class="column_inner">' . do_shortcode($content) . '</div></div>';
}
}
add_shortcode('column4', 'column4');

/* Dropcaps shortcode */

if (!function_exists('dropcaps')) {
function dropcaps($atts, $content = null) {
	extract(shortcode_atts(array("style" => ""), $atts));
	return "<span class='dropcap $style'>" . no_wpautop($content)  . "</span>";
}
}
add_shortcode('dropcaps', 'dropcaps');

/* Blockquote shortcode */

if (!function_exists('blockquote')) {
function blockquote($atts, $content = null) {
	$html = ""; 
  extract(shortcode_atts(array("width" => ""), $atts));
	$html .= "<blockquote"; 
	if($width > 0){
		$html .= " style=width:$width%;";
	}
	$html .= ">" . no_wpautop($content) . "</blockquote>";
  return $html;
}
}
add_shortcode('blockquote', 'blockquote');

/* Message shortcode */

if (!function_exists('message')) {
function message($atts, $content = null) {
	global $qode_options_magnet;
  $html = ""; 
	extract(shortcode_atts(array("text_color"=>"" ,"background_color"=>"", "close_button"=>""), $atts));
	$html .= "<div class='message $close_button";
	$html .= "' style='";
	if($background_color != ""){
		$html .= 'background-color: '.$background_color.'; ';
	}
	
	$html .= "'><a href='#' class='close'><span class='$close_button'></span></a>" .no_wpautop($content) . "</div>";
	
	return $html;
}
}
add_shortcode('message', 'message');

/* Latest post shortcode */

if (!function_exists('latest_post')) {
function latest_post($atts, $content = null) {
	global $qode_options_magnet;
  	$html = ""; 
		extract(shortcode_atts(array("type"=>"" ,"post_number"=>"", "text_length"=>""), $atts));
		if(empty($post_number)){
		 $post_number = 2;
		}
		if(empty($text_length)){
		 $text_length = 55;
		}
		$q = new WP_Query( 
		   array( 'orderby' => 'date', 'posts_per_page' => $post_number) 
		);		
		$html .= "<div class='latest_post_holder'>";
		$html .= '<ul class="latest_post">';

			while($q->have_posts()) : $q->the_post();

			if($type == "type2"){
				$html .= '<li><div class="post_date"><span><span class="day">' . get_the_date('j') . '</span><span class="month">' . get_the_date('M') . '</span></span></div><div class="post_content"><a href="' . get_permalink() . '">' . get_the_title() . '</a>' . '<p>' . substr(get_the_excerpt(), 0, intval($text_length)) . '</p></div><div class="latest_post_separator"></div></li>';
			} else {
				$html .= '<li><div class="post_image"><a href="'. get_permalink() .'">' . get_the_post_thumbnail(get_the_id(),'latest-type-1') . '</a></div><div class="post_content"><a href="' . get_permalink() . '">' . get_the_title() . '</a>' . '<p>' . substr(get_the_excerpt(), 0, intval($text_length)) . '</p></div><div class="latest_post_separator"></div></li>';
			}

			endwhile;

			wp_reset_query();

	return $html . '</ul>' . "</div>";	
}
}
add_shortcode('latest_post', 'latest_post');

/* Accordion shortcode */

if (!function_exists('accordion')) {
function accordion($atts, $content = null) {
	extract(shortcode_atts(array("accordion_type" => ""), $atts));
	return "<div class='accordion $accordion_type'>" . no_wpautop($content) . "</div>";
}
}
add_shortcode('accordion', 'accordion');

/* Accordion item shortcode */

if (!function_exists('accordion_item')) {
function accordion_item($atts, $content = null) {

	extract(shortcode_atts(array("caption" => ""), $atts));
	return "<h5><span><span class='control-inner'><span class='control-pm'></span></span></span>".$caption."</h5><div><div class='inner'>" . no_wpautop($content) ."</div></div>";
}
}
add_shortcode('accordion_item', 'accordion_item');

/* Unordered List shortcode */

if (!function_exists('unordered_list')) {
function unordered_list($atts, $content = null) {
    extract(shortcode_atts(array("style" => ""), $atts));
    $html =  "<div class='list $style'>" . $content . "</div>";  
    return $html;
}
}
add_shortcode('unordered_list', 'unordered_list');

/* Ordered List shortcode */

if (!function_exists('ordered_list')) {
function ordered_list($atts, $content = null) {
    $html =  "<div class=ordered>" . $content . "</div>";  
    return $html;
}
}
add_shortcode('ordered_list', 'ordered_list');

/* Buttons shortcode */

if (!function_exists('button')) {
function button($atts, $content = null) {
	global $qode_options_magnet;
	$html = "";
	extract(shortcode_atts(array("size" => "", "color"=> "", "background_color"=>"", "font_size"=>"", "line_height"=>"", "font_style"=>"", "font_weight"=>"", "text"=> "Button", "link"=> "http://qodeinteractive.com/", "target"=> "_self"), $atts));
    $html .=  '<a href="'.$link.'" target="'.$target.'" class="button '.$size.'" style="';
		if($color != ""){
			$html .= 'color: '.$color.'; ';
		}
		if($background_color != ""){
			$html .= 'background-color: '.$background_color.'; ';
		}
		if($font_size != ""){
			$html .= 'font-size: '.$font_size.'px; ';
		}
		if($line_height != ""){
			$html .= 'line-height: '.$line_height.'px; ';
		}
		if($font_style != ""){
			$html .= 'font-style: '.$font_style.'; ';
		}
		if($font_weight != ""){
			$html .= 'font-weight: '.$font_weight.'; ';
		}
		$html .= '"><span>' . $text . '</span></a>';  
    return $html;
}
}
add_shortcode('button', 'button');

/* Tabs shortcode */

if (!function_exists('tabs')) {
function tabs( $atts, $content = null ) {
  $html = ""; 
	extract(shortcode_atts(array(
    ), $atts));
	$html .= '<div class="tabs '.(isset($atts['type'])?$atts['type']:'').'">';
	$html .= '<ul class="tabs-nav">';
	$key = array_search((isset($atts['type'])?$atts['type']:''),$atts);
		if($key!==false){
			unset($atts[$key]);
	}
	foreach ($atts as $key => $tab) {
		$html .= '<li><a href="#' . $key . '"><span>' . $tab . '</span></a></li>';
	}
	$html .= '</ul>';
	$html .= '<div class="tabs-container">';
	$html .= no_wpautop($content) .'</div></div>';
	return $html;
}
}
add_shortcode('tabs', 'tabs');

/* Tab shortcode */

if (!function_exists('tab')) {
function tab( $atts, $content = null ) {
  $html = ""; 
	extract(shortcode_atts(array(
    ), $atts));
	$html .= '<div id="tab' . $atts['id'] . '" class="tab-content">' . no_wpautop($content) .'</div>';
	return $html;
}
}
add_shortcode('tab', 'tab');

/* Progress bars shortcode */

if (!function_exists('progress_bars')) {
function progress_bars($atts, $content = null) {
	extract(shortcode_atts(array(), $atts));
    $html =  "<div class='progress_bars'>" . no_wpautop($content) . "</div>";  
    return $html;
}
}
add_shortcode('progress_bars', 'progress_bars');

/* Progress bar shortcode */

if (!function_exists('progress_bar')) {
function progress_bar($atts, $content = null) {
	extract(shortcode_atts(array("title" => "Web Design", "percent"=> "100"), $atts));
		$html =  "<div class='progress_bar'><span class='progress_title'>$title</span><span class='progress_number'></span>	<div class='progress_content_outer'><div data-percentage='$percent' class='progress_content'><span>&nbsp;</span></div></div></div>";  
    return $html;
}
}
add_shortcode('progress_bar', 'progress_bar');

/* Pricing table shortcode */

if (!function_exists('pricing_table')) {
function pricing_table($atts, $content = null) {
    $html = ""; 
    $html .=  "<div class='price_tables";
	$html .= " clearfix'>" . no_wpautop($content) . "</div>";  
    return $html;
}
}
add_shortcode('pricing_table', 'pricing_table');

/* Pricing table column shortcode */

if (!function_exists('pricing_column')) {
function pricing_column($atts, $content = null) {
  $html = ""; 
	extract(shortcode_atts(array("title" => '',"price" => "0", "link" => "", "signup_text" => "Sign Up", "active"=>""), $atts));
	$html .=  "<div class='price_table";
	if($active == "yes"){
		$html .= " active";
	}
	$html .="'><div class='price_table_outer'><div class='price_table_inner'><ul><li><div class='price'><span>$</span><span class='price'>".$price."</span></div></li><li><h4>$title</h4></li>" . no_wpautop($content) . "<li><div class='buynow'><a class='button' href='$link'><span>$signup_text</span></a></div></li></ul></div></div></div>";
	
    return $html;
}
}
add_shortcode('pricing_column', 'pricing_column');


/* Pricing table cell shortcode */

if (!function_exists('pricing_cell')) {
function pricing_cell($atts, $content = null) {
	extract(shortcode_atts(array(), $atts));
    $html =  "<li class='cell'>" . no_wpautop($content) . "</li>"; 
	return $html;
}
}
add_shortcode('pricing_cell', 'pricing_cell');

/* Testimonials shortcode */

if (!function_exists('testimonials')) {
function testimonials($atts, $content = null) {
	extract(shortcode_atts(array("background_color"=>"", "type"=>"type1"), $atts));
  	$html = ""; 	
		if($type == "type1"){
			$html .=  "<div class='testimonial' style='background-color: $background_color;'><ul class='testimonials'>" . no_wpautop($content) . "</ul></div>";
		}
		if($type == "type2"){
			$html .=  '<div class="twitter_post"><div class="tweet"><img src="'.get_template_directory_uri().'/img/testimonials.png" alt=""/><ul class="tweets">' . no_wpautop($content) . '</ul><div class="twitter_controls"><span class="twitter_outer"><span class="twitter_prev"></span></span><span class="twitter_outer"><span class="twitter_next"></span></span></div></div></div>';
		}
											
    return $html;
}
}
add_shortcode('testimonials', 'testimonials');

/* Testimonial shortcode */

if (!function_exists('testimonial')) {
function testimonial($atts, $content = null) {
  $html = ""; 
	extract(shortcode_atts(array("name"=>""), $atts));
  	$html .= "<li><h5>$name</h5><p>".no_wpautop($content)."</p></li>";  
    return $html;
}
}
add_shortcode('testimonial', 'testimonial');

/* Table shortcode */

if (!function_exists('table')) {
function table($atts, $content = null) {
  $html = ""; 
	extract(shortcode_atts(array("border"=>"yes"), $atts));
    $html .=  "<table class='standard-table";
		if($border == "yes"){
			$html .= ' border';
		}
		$html .= "'><tbody>" . no_wpautop($content) . "</tbody></table>";  
    return $html;
}
}
add_shortcode('table', 'table');

/* Table row shortcode */

if (!function_exists('table_row')) {
function table_row($atts, $content = null) {
	extract(shortcode_atts(array(), $atts));
    $html =  "<tr>" . no_wpautop($content) . "</tr>";  
    return $html;
}
}
add_shortcode('table_row', 'table_row');

/* Table head cell shortcode */

if (!function_exists('table_cell_head')) {
function table_cell_head($atts, $content = null) {
	extract(shortcode_atts(array(), $atts));
    $html =  "<th><h4>" . no_wpautop($content) . "</h4></th>";  
    return $html;
}
}
add_shortcode('table_cell_head', 'table_cell_head');

/* Table body cell shortcode */

if (!function_exists('table_cell_body')) {
function table_cell_body($atts, $content = null) {
	extract(shortcode_atts(array(), $atts));
    $html =  "<td>" . no_wpautop($content) . "</td>";  
    return $html;
}
}
add_shortcode('table_cell_body', 'table_cell_body');

/* Highlights shortcode */

if (!function_exists('highlight')) {
function highlight($atts, $content = null) {
	$html =  "<span class='highlight'>" . $content . "</span>";  
    return $html;
}
}
add_shortcode('highlight', 'highlight');

/* Action shortcode */

if (!function_exists('action')) {
function action($atts, $content = null) {
	extract(shortcode_atts(array("title" => "New stylish minimalist Wordpress theme avaliable for only $45!"), $atts));
	$html =  "<div class='action'><h3>$title</h3>" . no_wpautop($content) . "</div>";  
    return $html;
}
}
add_shortcode('action', 'action');

/* Portfolio shortcode */

if (!function_exists('portfolio_list')) {
function portfolio_list($atts, $content = null) {
	$html = "";
	extract(shortcode_atts(array("columns" => "3", "number"=>"-1", "filter"=>'no', "category"=>"", "selected_projects"=>""), $atts));
	
	if($filter == "yes"){
		$html .= "<div class='filter'>
						<ul>
						<li><a data-filter='*' href='#'>". __('All','qode') ."</a></li>";
				if ($category == "") {
					$args = array(
						'parent'  => 0
					);
					$portfolio_categories = get_terms( 'portfolio_category',$args);
				} else {
					$top_category = get_term_by('slug',$category,'portfolio_category');
					$term_id = '';
					if (isset($top_category->term_id)) $term_id = $top_category->term_id;
					$args = array(
						'parent'  => $term_id
					);
					$portfolio_categories = get_terms( 'portfolio_category',$args);
				}
				foreach($portfolio_categories as $portfolio_category) {
					$html .=	"<li><a data-filter='.$portfolio_category->slug' href='#'>$portfolio_category->name</a>";
					$args = array(
						'child_of' => $portfolio_category->term_id
					);
					$portfolio_categories2 = get_terms( 'portfolio_category',$args);
					
					if(count($portfolio_categories2) > 0){
						$html .= '<ul>';
						foreach($portfolio_categories2 as $portfolio_category2) {
							$html .=	"<li><a data-filter='.$portfolio_category2->slug' href='#'>$portfolio_category2->name</a></li>";
						}
						$html .= '</ul>';
					}
					
					$html .= '</li>';
				}
		$html .= "</ul></div>";
	}
	$html .= "<div class='portfolio_outer'><div class='portfolio_holder portfolio_holder_v$columns'>";
	
	if ($category == "") {
		$args = array(
			'post_type'=> 'portfolio_page',
			'orderby' => 'menu_order',
			'order' => 'ASC',
			'posts_per_page' => $number
		);
	} else {
		$args = array(
			'post_type'=> 'portfolio_page',
			'portfolio_category' => $category,
			'orderby' => 'menu_order',
			'order' => 'ASC',
			'posts_per_page' => $number
		);
	}
	$project_ids = null;
	if ($selected_projects != "") {
		$project_ids = explode(",",$selected_projects);
		$args['post__in'] = $project_ids;
	}
	query_posts( $args );
	if ( have_posts() ) : while ( have_posts() ) : the_post(); 
	$terms = wp_get_post_terms(get_the_ID(),'portfolio_category');
	$html .= "<article class='element ";
	foreach($terms as $term) {
		$html .= "$term->slug ";
	}
	$html .="'>";
	$html .= "<div class='image'><a href='". get_permalink() ."' class='more'>".get_the_post_thumbnail()."</a></div>";
	$html .= "<h4><a href='". get_permalink() ."' class='more'>" . get_the_title() . "</a></h4>";
	$html .= '<p>'.strip_tags(get_the_excerpt()).'</p>';
	$html .= "</article>";
						
	endwhile; else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.','qode'); ?></p>
	<?php endif; 	
	wp_reset_query();	
	
	$html .= "</div></div>";
    return $html;
}
}
add_shortcode('portfolio_list', 'portfolio_list');

/* Sliders shortcode */

if (!function_exists('slider')) {
function slider($atts, $content = null) {
	extract(shortcode_atts(array("type"=>"big1","id" => "", "margin"=>"", "drager"=>"", "min_height"=>""), $atts));

	$woocommerce_page_id = get_option('woocommerce_shop_page_id'); 
	$page_id = get_the_ID();
	
	$is_shop=false;
	if(function_exists("is_shop"))
		$is_shop = is_shop();

	if($is_shop){
		$sliders = get_post_meta($woocommerce_page_id, "qode_sliders", true);
	} else {
		$sliders = get_post_meta($page_id, "qode_sliders", true);
	}

	$html = "";
	if($type == "big1" || $type == "big2"){
		foreach($sliders as $slider) 
		{
		
			if($slider['unique'] == $id) 
			{
				$html .= '<div class="flexslider"';
				if($min_height != ""){
					$html .= ' style="min-height:' . $min_height . 'px;"';
				}
				$html .= '><ul class="slides">';
				$i=0;
				if (count($slider)>1) {
					unset($slider['unique']);
					usort($slider, "compareSlides");
				}
				while (isset($slider[$i]))
				{
						
				
					$slide = $slider[$i];
					
					$href = $slide['link'];
					//$baseurl = site_url();
					$baseurl = home_url();
					$baseurl = str_replace('http://', '', $baseurl);
					$baseurl = str_replace('www', '', $baseurl);
					$host = parse_url($href, PHP_URL_HOST);
					if($host != $baseurl) {
						$target = 'target="_blank"';
					}
					else {
						$target = 'target="_self"';
					}
					
					$html .= '<li class="slide ' . (isset($slide['imgsize'])?$slide['imgsize']:'') . '">';
					$html .= '<div class="image"><img src="' . $slide['img'] . '" alt="' . $slide['title'] . '" /></div>';
					
					if($type == "big1"){
					
						$html .= '<div class="text ' . $slide['descposition'] . '">';
						if((isset($slide['toplabel'])?$slide['toplabel']:"") != ""){
							$html .= '<span class="toplabel">'. $slide['toplabel'] .'</span>';
						}
						if($slide['title'] != ""){
							$html .= '<h2';						
							if($slide['titlecolor'] != ""){
							$html .= ' style="color:'. $slide['titlecolor'] .'"';
							}
							$html .= '>'.$slide['title'].'</h2>';
							$html .= '<hr';
							if($slide['titlecolor'] != ""){
							$html .= ' style="background-color:'. $slide['titlecolor'] .'"';
							}
							$html .= '></hr>';
						}
						$html .= '<p';
						if($slide['color'] != ""){
						$html .= ' style="color:'. $slide['color'] .'"';
						}
						$html .= '>' . $slide['description'] . '</p>';
						if($slide['link'] != ""){
						$html .=	'<a class="button small" ';
							if($slide['linkcolor'] != ""){
							$html .= ' style="color:'. $slide['linkcolor'] .'"';
							}
							$html .= ' href="' . $slide['link'] . '" '. $target .' ><span>';
							if($slide['linklabel'] == ""){
								$html .= __('Read','qode');
							}else{
								$html .= $slide['linklabel'];
							}
							$html .= '</span></a>';
						}
						$html .= '</div>';
					
					} elseif($type == "big2"){
						
						$html .= '<div class="text type2">';
						if($slide['title'] != ""){
							$html .= '<h2';						
							if($slide['titlecolor'] != ""){
							$html .= ' style="color:'. $slide['titlecolor'] .'"';
							}
							$html .= '>';
							if($slide['link'] != ""){
								$html .=	'<a';
								if($slide['titlecolor'] != ""){
									$html .= ' style="color:'. $slide['titlecolor'] .'"';
								}
								$html .= ' href="' . $slide['link'] . '" '. $target .' >';
							}
							$html .= $slide['title'].'</a></h2></div>';
						}
					}
					
					$html .= '</li>';
					$i++; 
				}
				$html .= '</ul></div>';
			}							
		}
	}
	if($type == "scroller1" || $type == "scroller2" || $type == "scroller3" || $type == "scroller_catalog"){
		foreach($sliders as $slider) 
		{
			if($slider['unique'] == $id) 
			{
				$html .= '<div class="big-slider-wrapper';
				if($type == "scroller1"){
					$html .= ' box1';
				}else if($type == "scroller2"){
					$html .= ' box2';
				}else if($type == "scroller3"){
					$html .= ' box4';
				}else if($type == "scroller_catalog"){
					$html .= ' box1 catalog';
				}
				if($margin == "no"){
					$html .= ' no_margin';
				}
				$html .= '"><div class="big-slider">';
				if($drager == "yes"){
					$html .= '<div id="scrollTeaser"><div id="scrollTeaser-left1"></div><div id="scrollTeaser-left2"></div><div id="scrollTeaser-left3"></div></div>';
				}
				$html .= '<div class="big-slider-inner"><div class="big-slider-uber-inner">';
				
				if (count($slider)>1) {
					unset($slider['unique']);
					usort($slider, "compareSlides");
				}
				
				$i=0;
				while (isset($slider[$i]))
				{
					$slide = $slider[$i];
					
					$href = $slide['link'];
					$baseurl = home_url();
					$baseurl = str_replace('http://', '', $baseurl);
					$baseurl = str_replace('www', '', $baseurl);
					$host = parse_url($href, PHP_URL_HOST);
					if($host != $baseurl) {
						$target = 'target="_blank"';
					}
					else {
						$target = 'target="_self"';
					}
					$html .= '<div class="big-slider-slide"><div class="image">';
													
					// if($slide['link'] != ""){
						// $html .=	'<a href="' . $slide['link'] . '" '. $target .' >';
					// }
					$html .= '<img src="' . $slide['img'] . '" alt="' . $slide['title'] . '" />';
					// if($slide['link'] != ""){
						// $html .=	'</a>';
					// }
					$html .= '</div><div class="more-info ' . $slide['descposition'] . '">';
					if($type == "scroller3"){
						if($slide['link'] != ""){
							$html .= '<h4><a';
							if($slide['titlecolor'] != ""){
								$html .= ' style="color:'. $slide['titlecolor'] .'"';
							}
							$html .= ' href="' . $slide['link'] . '" '. $target .' >' . $slide['title'] . '</a></h4>';
							$html .= '<p><a ';
							if($slide['color'] != ""){
								$html .= ' style="color:'. $slide['color'] .'"';
							}
							$html .= 'href="' . $slide['link'] . '" '. $target .' >' . $slide['linklabel'] . '</a></p>';
						}else{
							$html .= '<h4';
							if($slide['titlecolor'] != ""){
								$html .= ' style="color:'. $slide['titlecolor'] .'"';
							}
							$html .= '>' . $slide['title'] . '</h4>';
							$html .= '<p';
							if($slide['color'] != ""){
								$html .= ' style="color:'. $slide['color'] .'"';
							}
							$html .= '>' . $slide['linklabel'] . '</p>';
						}
						
					}else if($type == "scroller_catalog"){
						if((isset($slide['toplabel'])?$slide['toplabel']:"") != ""){
							$html .= '<span class="toplabel">'. $slide['toplabel'] .'</span>';
						}
						if($slide['title'] != ""){
							$html .= '<h2';						
							if($slide['titlecolor'] != ""){
							$html .= ' style="color:'. $slide['titlecolor'] .'"';
							}
							$html .= '>'.$slide['title'].'</h2>';
						}
						$html .= '<p';
						if($slide['color'] != ""){
						$html .= ' style="color:'. $slide['color'] .'"';
						}
						$html .= '>' . $slide['description'] . '</p>';
						if($slide['link'] != ""){
						$html .=	'<a class="button" ';
							if($slide['linkcolor'] != ""){
							$html .= ' style="color:'. $slide['linkcolor'] .'"';
							}
							$html .= ' href="' . $slide['link'] . '" '. $target .' ><span>';
							if($slide['linklabel'] == ""){
								$html .= __('Read','qode');
							}else{
								$html .= $slide['linklabel'];
							}
							$html .= '</span></a>';
						}
						
					}else{
						
						$html .= '<h2 ';
						if($slide['titlecolor'] != ""){
							$html .= ' style="color:'. $slide['titlecolor'] .'"';
						}
						$html .= '>' . $slide['title'] . '</h2>';
						$html .= '<p';
						if($slide['color'] != ""){
						$html .= ' style="color:'. $slide['color'] .'"';
						}
						$html .= '>' . $slide['description'] . '</p>';
						if($slide['link'] != ""){
							$html .=	'<a';
							if($slide['linkcolor'] != ""){
								$html .= ' style="color:'. $slide['linkcolor'] .'"';
							}
							$html .= ' href="' . $slide['link'] . '" '. $target .' >';
							if($slide['linklabel'] == ""){
								$html .= __('Read','qode');
							}else{
								$html .= $slide['linklabel'];
							}
							$html .= '</a>';
						}
					}
					
					
					$html .= '</div></div>';
					
					$i++;
				}
				$html .= '</div></div></div>';
				$html .= '<div class="big-slider-control"><div class="control-seek" style=""><div class="control-seek-box"><div class="control-seek-box-inner"><div class="control-seek-background"></div></div></div></div><a class="control-left" href="#"><span class="control-inner"><span class="control-arrow"></span></span></a><a class="control-right" href="#"><span class="control-inner"><span class="control-arrow"></span></span></a></div></div>';
				
				
			}
		}
		
	}
	return $html;
}
}
add_shortcode('slider', 'slider');


if (!function_exists('parallax')) {
function parallax($atts, $content = null) {
	extract(shortcode_atts(array("drager" => ""), $atts));
	$html = "";
	$html .= "<section class='parallax'>";
	if($drager == "yes"){
		$html .= '<div id="scrollTeaserVertical"><div id="scrollTeaser-down1"></div><div id="scrollTeaser-down2"></div><div id="scrollTeaser-down3"></div></div>';
	}
	$html .= '<div class="link_holder"></div>';
	$html .= no_wpautop($content);
	$html .= "</section>";
	return $html;
}
}
add_shortcode('parallax', 'parallax');

if (!function_exists('parallax_section')) {
function parallax_section($atts, $content = null) {
	extract(shortcode_atts(array("id" => "", "height"=>"300", "title" => "..."), $atts));
	$parallaxes = get_post_meta(get_the_ID(), "qode_parallaxes", true);
	$html = "";
	
	
	
	foreach($parallaxes as $parallax) 
	{	
		if($parallax['imageid'] == $id) 
			{
			$html .= '<section id="'.$parallax['imageid'].'" style="background-image:url('. $parallax['parimg'] .'); background-color:'. $parallax['parcolor'] .';" data-height="' . $height . '" data-title="' . $title . '">';
			$html .= '<div class="parallax_content">';
			$html .= no_wpautop($content);
			$html .= '</div>';
			$html .= '</section>';
		}			
	}
	
	return $html;
}
}
add_shortcode('parallax_section', 'parallax_section');


if (!function_exists('separator')) {
function separator($atts, $content = null) {
		extract(shortcode_atts(array("type" => "", "color" => "", "thickness" => "", "up" => "","down" => ""), $atts));
		$html =  '<div style="';
		if($up != ""){
		$html .= "margin-top:". $up ."px;";
		}
		if($down != ""){
		$html .= "margin-bottom:". $down ."px;"; 
		}
		if($color != ""){
		$html .= "border-color: ". $color .";";
		}
		if($thickness != ""){
		$html .= "height:". $thickness ."px;";
		}
		$html .= '" class="separator';
		if($type == "dotted"){
			$html .= ' dotted';
		}
		if($type == "normal"){
			$html .= ' normal';
		}
		$html .= '"></div>';  
		
    return $html;
}
}
add_shortcode('separator', 'separator');

/* Social Icons shortcode */

if (!function_exists('social_icons')) {
function social_icons($atts, $content = null) {
    extract(shortcode_atts(array("style" => ""), $atts));
    $html = ""; 
    $html .=  "       <ul class='social_menu $style'>";  
    $social_icons_array = explode(",", $content);
    for ($i = 0 ; $i < count($social_icons_array) ; $i = $i + 2)
    {
		$html .=  "<li class='" . trim($social_icons_array[$i]) . "'><a href='" . trim($social_icons_array[$i + 1]) . "' target='_blank'><span class='inner'><span>" . trim($social_icons_array[$i]) . "</span></span></a></li>";   
    }
     $html .=  "           </ul>";


    return $html;
}
}
add_shortcode('social_icons', 'social_icons');

/* Services shortcode */

if (!function_exists('service')) {
function service($atts, $content = null) {
    $html = ""; 
	extract(shortcode_atts(array("type"=>"", "title" => "", "link" => "") , $atts));
	if($type == "circle"){
		$html .= '<div class="circle_item circle_top">';
		if ($link == "")
			$html .= '<div class="circle"><span class="services"><div style="padding:70.5px 0px;">'.$title.'</div></span></div><div class="text">';
		else
			$html .= '<div class="circle"><span class="services"><div style="padding:70.5px 0px;"><a href="'.$link.'">'.$title.'</a></div></span></div><div class="text">';
		$html .= no_wpautop($content);
		$html .= '</div></div>';		
	} elseif ($type == "square") {
		$html .= '<div class="square_item square_top">';
		if ($link == "")
			$html .= '<div class="square"><span class="services"><div style="padding:54.5px 0px;">'.$title.'</div></span></div><div class="text">';
		else
			$html .= '<div class="square"><span class="services"><div style="padding:54.5px 0px;"><a href="'.$link.'">'.$title.'</a></div></span></div><div class="text">';
		$html .= no_wpautop($content);
		$html .= '</div></div>';			
	}	

	
	return $html;
}
}
add_shortcode('service', 'service');


/* Video shortcode */

if (!function_exists('video')) {
function video($atts, $content = null) {
    $html = ""; 
	extract(shortcode_atts(array("type"=>"youtube", "id"=>"", "width"=>"", "height"=>"") , $atts));	
	$html .= "<div class='video_holder'>"; 
	if($type == 'youtube'){
		$html .= '<iframe title="YouTube video player" width="' . $width . '" height="' . $height . '" src="http://www.youtube.com/embed/' . $id . '?wmode=transparent" wmode="Opaque" frameborder="0" allowfullscreen></iframe>';
	}elseif($type == 'vimeo'){
		$html .= '<iframe src="http://player.vimeo.com/video/' . $id . '" width="' . $width . '" height="' . $height . '" frameborder="0"></iframe>';
	}
	$html .= "</div>"; 
	return $html;
}
}
add_shortcode('video', 'video');

if (!function_exists('icon')) {
function icon($atts, $content = null) {
    extract(shortcode_atts(array("icon_number" => ""), $atts));
    $html = "";  
		$html .=  '<div class="box_small"><div class="box_small_inner"><div class="icon icon'.$icon_number.'"></div></div></div>';

    return $html;
}
}
add_shortcode('icon', 'icon');

?>