<?php
/*
Plugin Name: Simple Breadcrumb Navigation
Plugin URI: http://www.kriesi.at/archives/wordpress-plugin-simple-breadcrumb-navigation
Description: A simple and very lightweight breadcrumb navigation that covers nested pages and categories
Version: 1
Author: Christian "Kriesi" Budschedl
Author URI: http://www.kriesi.at/
*/

/*
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/


class simple_breadcrumb{
	var $options;
	
function simple_breadcrumb(){
	$this->options = array( 	//change this array if you want another output scheme
	'before' => '',
	'after' => '',
	'delimiter' => ''
	);
	
	$markup = $this->options['before'].$this->options['delimiter'].$this->options['after'];
	
	global $post;
	echo '<p class="breadcrumb"><a href="'.home_url().'">';
	
	/*
	* get user entered breadcrumb home text, 
	* if empty we show default "home" for home page link
	* @since version 2.6 development.
	*/
	global $ttso;
	$home_text = $ttso->ka_breadcrumbs_home_text;
	if(!empty($home_text)){
		echo $home_text;
		}
	else{	
		echo 'Home';
	}
	
	echo "</a>";
	if(!is_front_page()){echo $markup;}
			
	$output = $this->simple_breadcrumb_case($post);
	
	echo "<span class='current_crumb'>";
	if ( is_page() || is_single()) {
	the_title();
	}else{
	echo $output;
	}
	echo " </span></p>";
}

	
function simple_breadcrumb_case($der_post){
	$karma_blog_page = get_option('ka_blogpage');
	$karma_blog_title = get_option('ka_blogtitle');
	$karma_404_title = get_option('ka_404title');
	$karma_searchpage_title = get_option('ka_results_title');
	
	
	global $post, $blog_page;
	$markup = $this->options['before'].$this->options['delimiter'].$this->options['after'];
	if (is_page()){
		 if($der_post->post_parent) {
			 $my_query = get_post($der_post->post_parent);			 
			 $this->simple_breadcrumb_case($my_query);
			 $link = '<a href="';
			 $link .= get_permalink($my_query->ID);
			 $link .= '">';
			 $link .= ''. get_the_title($my_query->ID) . '</a>'. $markup;
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

			//mod by denzel 2.7.1 dev 1
			//show url of parent post only for attached image, 
			//so that there is not error from unattached image view from WordPress admin
			if($post->post_parent !== 0){
			echo get_category_parents($ID, TRUE, $markup, FALSE );
			previous_post_link("%link $markup");
			}
			
		
		}else{
			 $link = '<a href="';
			 
			 //@since 4.0 mod by denzel to use either posts page permalink or site option > blog settings > blog page.
			 
			 $page_for_posts_id = get_option('page_for_posts'); //saved by wordpress.
			 $karma_blog_page = get_permalink($page_for_posts_id);
			 if(empty($page_for_posts_id)):
			    //if no post page set, we use the site option > blog settings > blog page.
			    $blog_page_id = get_option('ka_blogpage');
			 	$karma_blog_page = get_permalink($blog_page_id);
			 else:
			    //this is the post page link.
			 	$karma_blog_page = get_permalink($page_for_posts_id);
			 endif;
			 
			 $link .= $karma_blog_page;
			 $link .= '">';
			 $link .= ''. $karma_blog_title . '</a>'. $markup;
			 echo $link;
			
			}
		
	return;
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
		//$curauth = get_userdatabylogin(get_query_var('author_name'));
		//deprecated WordPress function since WP3.3, use get_user_by() instead..
		$curauth = get_user_by('login',get_query_var('author_name'));		
		return "Author: ".$curauth->nickname;
	}
	if(is_tag()){ return "Tag: ".single_tag_title('',FALSE); }
	
	if(is_404()){ return $karma_404_title; }
	
	if(is_home()){ return $karma_blog_title; }
	
	if(is_search()){ return $karma_searchpage_title; }	
	
	if(is_year()){ return get_the_time('Y'); }
	
	if(is_month()){
	$k_year = get_the_time('Y');
	echo "<a href='".get_year_link($k_year)."'>".$k_year."</a>".$markup;
	return get_the_time('F'); }
	
	if(is_day() || is_time()){ 
	$k_year = get_the_time('Y');
	$k_month = get_the_time('m');
	$k_month_display = get_the_time('F');
	echo "<a href='".get_year_link($k_year)."'>".$k_year."</a>".$markup;
	echo "<a href='".get_month_link($k_year, $k_month)."'>".$k_month_display."</a>".$markup;

	return get_the_time('jS (l)'); }
	
	}

}
?>