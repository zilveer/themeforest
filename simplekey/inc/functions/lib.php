<?php
/**
 * van Common Functions
 * @package VAN Framework
 */

 /* TABLE OF CONTENTS
 *
 * - van_category_root_id($cat)
 * - van_cat_slug($cate_name)
 * - van_cat_name($cate_ID)
 * - van_auto_thumbnail()
 * - van_truncate($full_str,$max_length) 
 * - van_pagenavi()
 * - van_format($content) 
 * - van_content()
 * - van_breadcrumbs()
 * - van_ad()
 * - van_category_tags($cate_slug,$number,$format)
 * - van_is_mobile()
 * - van_social()
 * - van_shortcode()
 * - van_strip_tags()
 * - van_random_string()
 /

/*Get sub category ID
 * parameter:
 * $root_cat_id: The parent category id
*/
function van_category_root_id($root_cat_id)   {   
	$current_category = get_category($root_cat_id); 
	while($current_category->category_parent)  {   
	 $current_category = get_category($current_category->category_parent);  
	}
	$term_id=$current_category->term_id;
	$term_id = apply_filters('van_category_root_id', $term_id);
	return $term_id;
}

/*Get category slug
 * Parameter:
 * $cate_name: Category name
*/
function van_cat_slug($cate_name){
	$cat_ID = get_cat_ID($cate_name); 
	$thisCat = get_category($cat_ID);
	$cat_slug = $thisCat->slug;
	$cat_slug = apply_filters('van_cat_slug', $cat_slug);
	return $cat_slug;
}

/*Get category name
 *Parameter:
 *$cate_ID:Category id
*/
function van_cat_name($cate_ID){
	$current_cat = get_category($cate_ID);
	$cate_name = $current_cat->name;
	$cate_name = apply_filters('van_cat_name', $cate_name);
	return $cate_name;
}
	
/*Auto get the first images in post content and it will serve for the post thumbnail*/
function van_auto_thumbnail() {
    global $post, $posts;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    $first_img = $matches [1] [0];
    if(!empty($first_img)){
      $html ='<a href="'.get_permalink().'" title="'.get_the_title().'" class="thumb"><img src="'.$first_img.'" alt="'.get_the_title().'" /></a>';
	}
	$html = apply_filters('van_auto_thumbnail', $html);
    return $html;
}

/*Truncate the long string
 *Parameter:
 *$full_start: The string you want to truncate.
 *$max_length: The max length of output. 
*/
function van_truncate($full_str,$max_length) {
	if (mb_strlen($full_str,'utf-8') > $max_length ) {
	  $full_str = mb_substr($full_str,0,$max_length,'utf-8').'...';
	}
	$full_str = apply_filters('van_truncate', $full_str);
return $full_str;
}

/*Output page navi
 *Parameter:
 *$p: Default page number
*/

function van_pagenavi( $p = 5 ) { 
  if ( is_singular() ) return; 
  global $wp_query, $paged;
  $max_page = $wp_query->max_num_pages;
  if ( $max_page == 1 ) return; 
  if ( empty( $paged ) ) $paged = 1;
  echo '<div class="van-pagenavi">'; 
  //if ( $paged > 1 )  posts_nav_link('','','&laquo; Previous');
  if ( $paged > $p + 1 ) p_link( 1, 'Oldest' );
  if ( $paged > $p + 2 ) echo'<em>...</em>';
  for( $i = $paged - $p; $i <= $paged + $p; $i++ ) { 
	  if ( $i > 0 && $i <= $max_page ) $i == $paged ? print"<span class='current'>{$i}</span> " : p_link( $i );
  }
  if ( $paged < $max_page - $p - 1 ) $return_navi.='<em>...</em>';
  if ( $paged < $max_page - $p ) p_link( $max_page, 'Newest' );
  //if ( $paged < $max_page ) posts_nav_link('','','Next &raquo;');
  echo  '</div>';
}
function p_link( $i, $title = '', $linktype = '' ) {
  if ( $title == '' ) $title = "{$i}";
  if ( $linktype == '' ) { $linktext = $i; } else { $linktext = $linktype; }
  echo "<a class='page' href='", esc_html( get_pagenum_link( $i ) ), "' title='{$title}'>{$linktext}</a> ";
}

/*Output format content*/
function van_content($echo=true,$format=true){
      $content = get_the_content(__('Read More &raquo;','van'));
	  if($format){
	   global $more;
	   $more = 0;
	   $content = apply_filters('the_content', $content);
	   $content = str_replace(']]>', ']]&gt;', $content);
	  }
	  if($echo){
	    print do_shortcode($content);
	  }else{
	    return do_shortcode($content);
	  }
}

/*Breadcrumbs navi*/
function van_breadcrumbs() {
  $delimiter = '&raquo;';
  $name = 'Home';
  $currentBefore = '<span class="current">';
  $currentAfter = '</span>';
  if ( !is_home() && !is_front_page() || is_paged() ) {
    global $post;
    $home = home_url();
    echo '<a href="' . $home . '">' . $name . '</a> ' . $delimiter . ' ';
    if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
      echo $currentBefore;
      single_cat_title();
      echo $currentAfter;
    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $currentBefore . get_the_time('d') . $currentAfter;
    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $currentBefore . get_the_time('F') . $currentAfter;
    } elseif ( is_year() ) {
      echo $currentBefore . get_the_time('Y') . $currentAfter;
    } elseif ( is_single() && !is_attachment() ) {
      $cat = get_the_category(); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo $currentBefore;
      the_title();
      echo $currentAfter;
    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
      echo $currentBefore;
      the_title();
      echo $currentAfter;
    } elseif ( is_page() && !$post->post_parent ) {
      echo $currentBefore;
      the_title();
      echo $currentAfter;
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
      echo $currentBefore;
      the_title();
      echo $currentAfter;
    } elseif ( is_search() ) {
      echo $currentBefore . 'Search result &#39;' . get_search_query() . '&#39;' . $currentAfter;
    } elseif ( is_tag() ) {
      echo $currentBefore;
      single_tag_title();
      echo $currentAfter;
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $currentBefore . 'Author:' . $userdata->display_name . $currentAfter;
    } elseif ( is_404() ) {
      echo $currentBefore . 'Error 404' . $currentAfter;
    }
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page','van') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
  }
}

/*Get tags cloud in specified category
 *Parameter:
 *$cate_slug: category slug
 *$number: Number of ouput
 *$format: additional parameter, it will use for pass parameter to next page. 
*/
function van_category_tags($cate_slug='',$number=20,$label='') {
 query_posts('posts_per_page='.$number.'&category_name='.$cate_slug);
  if (have_posts()) :
			  $all_tags_arr=array(); 
			  $tagcloud='<div class="van_widget">';
			  while (have_posts()) :
				the_post();
				$posttags = get_the_tags();
				if ($posttags) {
				  foreach($posttags as $tag) {
				   if(in_array($tag->name,$all_tags_arr)){
					  continue;
				   }else{
					$all_tags_arr[] = $tag->name;
					if($cate_slug<>''){
		               $cat='&cat='.$cate_slug;
					}else{
					   $cat='';
					}
					if($label<>''){
					   $lab='&label='.$label;
					}else{
					   $lab='';
					}
					$tagcloud.='<a href ="'.home_url().'/?tag='.$tag->name.$cat.$lab.'" class="tagclouds-item">'.$tag->name.'</a>';
				   }
				  }
				}
			  endwhile;
			  $tagcloud.='</div>';
   endif;
   wp_reset_query();
   $tagcloud = apply_filters('van_category_tags', $tagcloud);
   return $tagcloud;
}

/*Check user's mobile device*/
function van_is_mobile() {
	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	$mobile_agents = Array("240x320","acer","acoon","acs-","abacho","ahong","airness","alcatel","amoi","android","anywhereyougo.com","applewebkit/525","applewebkit/532","asus","audio","au-mic","avantogo","becker","benq","bilbo","bird","blackberry","blazer","bleu","cdm-","compal","coolpad","danger","dbtel","dopod","elaine","eric","etouch","fly ","fly_","fly-","go.web","goodaccess","gradiente","grundig","haier","hedy","hitachi","htc","huawei","hutchison","inno","ipod","jbrowser","kddi","kgt","kwc","lenovo","lg ","lg2","lg3","lg4","lg5","lg7","lg8","lg9","lg-","lge-","lge9","longcos","maemo","mercator","meridian","micromax","midp","mini","mitsu","mmm","mmp","mobi","mot-","moto","nec-","netfront","newgen","nexian","nf-browser","nintendo","nitro","nokia","nook","novarra","obigo","palm","panasonic","pantech","philips","phone","pg-","playstation","pocket","pt-","qc-","qtek","rover","sagem","sama","samu","sanyo","samsung","sch-","scooter","sec-","sendo","sgh-","sharp","siemens","sie-","softbank","sony","spice","sprint","spv","symbian","tablet","talkabout","tcl-","teleca","telit","tianyu","tim-","toshiba","tsm","up.browser","utec","utstar","verykool","virgin","vk-","voda","voxtel","vx","wap","wellco","wig browser","wii","windows ce","wireless","xda","xde","zte");
	$is_mobile = false;
	foreach ($mobile_agents as $device) {
		if (stristr($user_agent, $device)) {
			$is_mobile = true;
			break;
		}
	}
	$is_mobile = apply_filters('van_is_mobile', $is_mobile);
	return $is_mobile;
}

/*Social network icons*/
function van_social(){
  global $VAN;
  $social='<div class="social-icons-new">'.PHP_EOL;
  if(isset($VAN['googlplus']) && $VAN['googlplus']<>'')
	$social.='<a href="'.$VAN['googlplus'].'" title="Google+" class="gplus" target="_blank"><i class="fa fa-google-plus"></i></a> '.PHP_EOL;
  if(isset($VAN['facebook']) && $VAN['facebook']<>'')
	$social.='<a href="'.$VAN['facebook'].'" title="Facebook" class="facebook" target="_blank"><i class="fa fa-facebook"></i></a> '.PHP_EOL;
  if(isset($VAN['twitter']) && $VAN['twitter']<>'')
	$social.=' <a href="'.$VAN['twitter'].'" title="Twitter" class="twitter" target="_blank"><i class="fa fa-twitter"></i></a> '.PHP_EOL;
  if(isset($VAN['deviantart']) && $VAN['deviantart']<>'')
	$social.='<a href="'.$VAN['deviantart'].'" title="Deviantart" class="deviantart" target="_blank"><i class="fa fa-deviantart"></i></a>'.PHP_EOL;
  if(isset($VAN['tumblr']) && $VAN['tumblr']<>'')
	$social.='<a href="'.$VAN['tumblr'].'" title="tumblr" class="tumblr" target="_blank"><i class="fa fa-tumblr"></i></a>  '.PHP_EOL;
  if(isset($VAN['flickr']) && $VAN['flickr']<>'')
	$social.='<a href="'.$VAN['flickr'].'" title="Flickr" class="flickr" target="_blank"><i class="fa fa-flickr"></i></a> '.PHP_EOL;
  if(isset($VAN['behance']) && $VAN['behance']<>'')
	$social.='<a href="'.$VAN['behance'].'" title="Behance" class="behance" target="_blank"><i class="fa fa-behance"></i></a> '.PHP_EOL;
  if(isset($VAN['dribbble']) && $VAN['dribbble']<>'')
	$social.='<a href="'.$VAN['dribbble'].'" title="Dribbble" class="dribbble" target="_blank"><i class="fa fa-dribbble"></i></a> '.PHP_EOL;
  if(isset($VAN['pinterest']) && $VAN['pinterest']<>'')
	$social.='<a href="'.$VAN['pinterest'].'" title="Pinterest" class="pinterest" target="_blank"><i class="fa fa-pinterest"></i></a>'.PHP_EOL;
  if(isset($VAN['youtube']) && $VAN['youtube']<>'')
	$social.='<a href="'.$VAN['youtube'].'" title="Youtube" class="youtube" target="_blank"><i class="fa fa-youtube"></i></a>'.PHP_EOL;
  if(isset($VAN['vimeo']) && $VAN['vimeo']<>'')
	$social.='<a href="'.$VAN['vimeo'].'" title="Vimeo" class="vimeo" target="_blank"><i class="fa fa-vimeo-square"></i></a>'.PHP_EOL;
  if(isset($VAN['linkedIn']) && $VAN['linkedIn']<>'')
	$social.='<a href="'.$VAN['linkedIn'].'" title="linkedIn" class="linkedIn" target="_blank"><i class="fa fa-linkedin"></i></a>'.PHP_EOL;
  if(isset($VAN['soundCloud']) && $VAN['soundCloud']<>'')
	$social.='<a href="'.$VAN['soundCloud'].'" title="SoundCloud" class="soundcloud" target="_blank"><i class="fa fa-soundcloud"></i></a>'.PHP_EOL;
  if(isset($VAN['hearthis']) && $VAN['hearthis']<>'')
	$social.='<a href="'.$VAN['hearthis'].'" title="hearthis" class="hearthis" target="_blank"><i class="mf mf-hearthis"></i></a> '.PHP_EOL;
  if(isset($VAN['blogger']) && $VAN['blogger']<>'')
	$social.='<a href="'.$VAN['blogger'].'" title="blogger" class="blogger" target="_blank"><i class="mf mf-blogger"></i></a> '.PHP_EOL;
  if(isset($VAN['github']) && $VAN['github']<>'')
	$social.='<a href="'.$VAN['github'].'" title="GitHub" class="github" target="_blank"><i class="fa fa-github"></i></a>'.PHP_EOL;
  if(isset($VAN['myspace']) && $VAN['myspace']<>'')
	$social.='<a href="'.$VAN['myspace'].'" title="MySpace" class="old myspace" target="_blank"><i class="fa fa-myspace"></i></a>'.PHP_EOL;
  if(isset($VAN['myemail']) && $VAN['myemail']<>'')
	$social.='<a href="mailto:'.$VAN['myemail'].'" title="Email" class="myemail" target="_blank"><i class="fa fa-envelope"></i></a>'.PHP_EOL;
  if(isset($VAN['yahooim']) && $VAN['yahooim']<>'')
	$social.='<a href="ymsgr:sendIM?'.$VAN['yahooim'].'" title="Yahoo IM" class="yahooim" target="_blank"><i class="fa fa-yahoo"></i></a>'.PHP_EOL;
  if(isset($VAN['aim']) && $VAN['aim']<>'')
	$social.='<a href="aim:GoIm?screenname=?'.$VAN['aim'].'" title="AIM" class="old aim" target="_blank">AIM</a>'.PHP_EOL;
  if(isset($VAN['instagram']) && $VAN['instagram']<>'')
	$social.='<a href="'.$VAN['instagram'].'" title="instagram" class="instagram" target="_blank"><i class="fa fa-instagram"></i></a> '.PHP_EOL;
  if(isset($VAN['meetup']) && $VAN['meetup']<>'')
	$social.='<a href="'.$VAN['meetup'].'" title="meetup" class="old meetup" target="_blank"><i class="fa fa-meetup"></i></a> '.PHP_EOL;
  if(isset($VAN['fivehundreds']) && $VAN['fivehundreds']<>'')
	$social.='<a href="'.$VAN['fivehundreds'].'" title="meetup" class="icon_500px" target="_blank"><i class="fa fa-500px"></i></a> '.PHP_EOL;
  if(isset($VAN['xing']) && $VAN['xing']<>'')
	$social.='<a href="'.$VAN['xing'].'" title="Xing" class="xing" target="_blank"><i class="fa fa-xing"></i></a> '.PHP_EOL;
  if(isset($VAN['klout']) && $VAN['klout']<>'')
	$social.='<a href="'.$VAN['klout'].'" title="klout" class="old klout" target="_blank"><i class="fa fa-klout"></i></a> '.PHP_EOL;
  if(isset($VAN['houzz']) && $VAN['houzz']<>'')
	$social.='<a href="'.$VAN['houzz'].'" title="houzz" class="old houzz" target="_blank"><i class="fa fa-houzz"></i></a> '.PHP_EOL;
  if(isset($VAN['vk']) && $VAN['vk']<>'')
	$social.='<a href="'.$VAN['vk'].'" title="vk" class="vk" target="_blank"><i class="fa fa-vk"></i></a> '.PHP_EOL;
  if(isset($VAN['yelp']) && $VAN['yelp']<>'')
	$social.='<a href="'.$VAN['yelp'].'" title="yelp" class="yelp" target="_blank"><i class="fa fa-yelp"></i></a> '.PHP_EOL;
  if(isset($VAN['rss']) && $VAN['rss']<>'')
	$social.='<a href="'.$VAN['rss'].'" title="Feed" class="feed" target="_blank"><i class="fa fa-rss"></i></a> '.PHP_EOL;
  $social.='</div>'.PHP_EOL;
  $social = apply_filters('van_social', $social);
  return $social;
} 

/*Filter shortcode*/
function van_shortcode($content){
   $content = apply_filters('van_shortcode', $content);
   return do_shortcode(strip_tags($content, "<h1><h2><h3><h4><h5><h6><a><img><embed><iframe><form><input><button><object><div><ul><li><ol><table><tbody><tr><td><th><span><p><br/><strong><em><del>"));
}

/*Filter string*/
function van_strip_tags($tagsArr,$str) {   
	foreach ($tagsArr as $tag) {  
		$p[]="/(<(?:\/".$tag."|".$tag.")[^>]*>)/i";  
	}  
	$return_str = preg_replace($p,"",$str);
	$return_str = apply_filters('van_strip_tags', $return_str);
	return $return_str;  
}  

/*Random string*/
function van_random_string($length, $max=FALSE){
  if (is_int($max) && $max > $length){
    $length = mt_rand($length, $max);
  }
  $output = '';
  
  for ($i=0; $i<$length; $i++){
    $which = mt_rand(0,2);
    
    if ($which === 0){
      $output .= mt_rand(0,9);
    }
    elseif ($which === 1){
      $output .= chr(mt_rand(65,90));
    }else{
      $output .= chr(mt_rand(97,122));
    }
  }
  $output = apply_filters('van_random_string', $output);
  return $output;
  
}
?>