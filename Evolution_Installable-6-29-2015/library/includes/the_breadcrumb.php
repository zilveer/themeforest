<?php
class the_breadcrumb{
	var $options;
	
function the_breadcrumb(){
	
	$this->options = array( 	
	'before' => '',
	'after' => '',
	'delimiter' => ''
	);
	
	$markup = $this->options['before'].$this->options['delimiter'].$this->options['after'];
	
	global $post;
	echo '<ul class="breadcrumbs right"><li><a href="'.home_url().'">'.__('Home', 'Evolution').'</a></li>';
		if(!is_front_page()){echo $markup;}
				
		$output = $this->simple_breadcrumb_case($post);
		
		echo "<li class='current'><a href='#'>";
		if ( is_page() || is_single()) {
		the_title();
		}else{
		echo $output;
		}
		echo " </a></li></ul>";
	}
	
function simple_breadcrumb_case($der_post){
	$markup = $this->options['before'].$this->options['delimiter'].$this->options['after'];
	if (is_page()){
		 if($der_post->post_parent) {
			 $my_query = get_post($der_post->post_parent);			 
			 $this->simple_breadcrumb_case($my_query);
			 $link = '<li><a href="';
			 $link .= get_permalink($my_query->ID);
			 $link .= '">';
			 $link .= ''. get_the_title($my_query->ID) . '</a></li>'. $markup;
			 echo $link;
		  }	
	return;			 	
	} 
			
			
	if(is_single()){
		$category = get_the_category();
		if (is_attachment()){
		
			$my_query = get_post($der_post->post_parent);			 
			$category = get_the_category($my_query->ID);
			$ID = $category[0]->cat_ID;

			echo get_category_parents($ID, TRUE, $markup, FALSE );
			previous_post_link("%link $markup");
			
		}else{
			
			$postType = get_post_type();
			
			if($postType == 'post')
			{
				$ID = $category[0]->cat_ID;
				echo '<li>'.get_category_parents($ID, TRUE, $markup, FALSE ).'</li>';
			}
			
			else if($postType == 'portfolio')
			{
				$terms = get_the_term_list( get_the_ID(), 'portfolio_category', '<li>', '', '</li>' );				
				
				$terms = explode(',',$terms);
			 	$post_type = get_post_type_object(get_post_type()); 
				echo '<li>'.$post_type->labels->singular_name.$markup.'</li>';
 				
				echo $terms[0].$markup;
			}
			
			else if($postType == 'news')
			{
				$terms = get_the_term_list( get_the_ID(), 'news', '', '', '' );				
				
				$terms = explode('',$terms);
			 	$post_type = get_post_type_object(get_post_type()); 
				echo $post_type->labels->singular_name.$markup;
 				
				echo $terms[0].$markup;
			}
		}
	return;
	}
	
	if(is_tax()){
		  $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		  return $term->name;

	}
	
	
	if(is_category()){
		$category = get_the_category(); 
		$i = $category[0]->cat_ID;
		$parent = $category[0]-> category_parent;
		
		if($parent > 0 && $category[0]->cat_name == single_cat_title("", false)){
			echo get_category_parents($parent, TRUE, $markup, FALSE);
		}
	return single_cat_title('',FALSE);
	}
	
	
	if(is_author()){
		$curauth = get_userdatabylogin(get_query_var('author_name'));
		return "Author: ".$curauth->nickname;
	}
	if(is_tag()){ return " Tag: ".single_tag_title('',FALSE); }
	
	if(is_404()){ return "404 - Page not Found"; }
	
	if(is_search()){ return "Search"; }	
	
	if(is_year()){ return get_the_time('Y'); }
	
	if(is_month()){
	$k_year = get_the_time('Y');
	echo "<li><a href='".get_year_link($k_year)."'>".$k_year."</a></li>".$markup;
	return get_the_time('F'); }
	
	if(is_day() || is_time()){ 
	$k_year = get_the_time('Y');
	$k_month = get_the_time('m');
	$k_month_display = get_the_time('F');
	echo "<li><a href='".get_year_link($k_year)."'>".$k_year."</a></li>".$markup;
	echo "<li><a href='".get_month_link($k_year, $k_month)."'>".$k_month_display."</a></li>".$markup;

	return get_the_time('jS (l)'); }
	
	}

}

?>