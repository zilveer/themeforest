<?php 
if(!function_exists('theme_shortcode_portfolio')){
function theme_shortcode_portfolio($atts, $content = null, $code) {
	$opts = shortcode_atts(array(
		'column' => 4,
		'layout' => 'full',//sidebar
		'cat' => '',
		'max' => -1,
		'title' => '',
		'titlelinkable' => 'false',
		'titlelinktarget' => '_self',
		'desc' => '',
		'desc_length' => 'default',
		'more' => 'default',
		'moretext' => '',
		'morebutton' => 'default',
		'height' => '',
		"ajax" => 'false',
		'current' => '',
		'nopaging' => 'false',
		'sortable' => 'false',
		'sortable_all'=> 'true',
		'sortable_showtext'=> '',
		'group' => 'true',
		'lightboxtitle' => 'portfolio', //portfolio,image,imagecaption,imagedesc,none
		'advancedesc'=>'false',
		'effect' => 'icon', //icon,grayscale,zoom,blur,rotate,morph,tilt,none
		'ids' => '',
		'order'=> 'ASC',
		'orderby'=> 'menu_order', //none, id, author, title, date, modified, parent, rand, comment_count, menu_order
		'rel_group' => 'portfolio_'.rand(1,1000),
		'class' => '',
	), $atts);

	extract($opts);
	switch($column){
		case 1:
			$column_class = 'one_column';
			break;
		case 2:
			$column_class = 'two_columns';
			break;
		case 3:
			$column_class = 'three_columns';
			break;
		case 5:
			$column_class = 'five_columns';
			break;
		case 6:
			$column_class = 'six_columns';
			break;
		case 7:
			$column_class = 'seven_columns';
			break;
		case 8:
			$column_class = 'eight_columns';
			break;
		case 4:
		default:
			$column_class = 'four_columns';
	}
	if($class){
		$class = ' '.$class;
	}
	
	if ($sortable != 'false') {
		if($sortable_showtext == ''){
			$sortable_showtext = wpml_t(THEME_NAME , 'Portfolio Sortable Show Text',theme_get_option('portfolio','show_text'));
		}
		if(!empty($current)){
			$ajax = true;
		}
		if($nopaging === 'false'){
			$ajax = true;
		}
		//print scripts for sortable
		wp_print_scripts('jquery-quicksand');
		wp_print_scripts('jquery-easing');

		if($ajax == 'true'){
			$output = '<section class="portfolios sortable'.$class.'" data-options="'.htmlspecialchars(json_encode($opts)).'">';
		}else{
			$output = '<section class="portfolios sortable'.$class.'">';
		}
		
		$output .= '<header class="sort_by_cat">';
		$output .= '<span>'.$sortable_showtext.'</span>';
		if($sortable_all == 'true'){
			if(empty($current)){
				$output .= '<a class="current" data-value="all" href="#">'.__('All','striking-r').'</a>';
			}else{
				$output .= '<a data-value="all" href="#">'.__('All','striking-r').'</a>';
			}
		}
		$terms = array();
		if ($cat != '') {
			foreach(explode(',', $cat) as $term_slug) {
				$terms[] = get_term_by('slug', $term_slug, 'portfolio_category');
			}
		} else {
			$terms = get_terms('portfolio_category', 'hide_empty=1');
		}
		foreach($terms as $term) {
			if($term->slug == $current){
				$output .= '<a data-value="' . $term->slug . '" href="#" class="current">' . $term->name . '</a>';
			}else{
				$output .= '<a data-value="' . $term->slug . '" href="#">' . $term->name . '</a>';
			}
		}
		
		$output .= '</header>';
		$nopaging = 'true';
	} else {
		$opts['current'] = '';
		if($ajax == 'true'){
			$output = '<section class="portfolios'.$class.'" data-options="'.htmlspecialchars(json_encode($opts)).'">';
		}else{
			$output = '<section class="portfolios'.$class.'">';
		}
	}
	$output .= theme_generator('portfolio_list',$opts);
	$output .= '</section>';
	return $output;
}
}
add_shortcode('portfolio', 'theme_shortcode_portfolio');
