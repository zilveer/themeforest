<?php
/** 
 * Theme Functions
 * @package VAN Framework
 */
	
/* Display default primary menu for scrolling page */
if( !function_exists( 'van_scroll_pagemenu') ){
	function van_scroll_pagemenu() {
		global $VAN;
		echo '<ul>'.PHP_EOL;
		echo '<li><a href="' . get_home_url() . '/#top">Home</a></li>'.PHP_EOL;
		if(isset($page_navi) && $page_navi <> '' )
			$pages = get_pages( array('include' => $page_navi, 'sort_column' => 'menu_order', 'sort_order' => 'ASC') );
		else
			$pages = get_pages('number=6&sort_column=menu_order&sort_order=ASC');
		$count = count($pages);
		for($i = 0; $i < $count; $i++)
		{
			echo '<li><a href="' . get_home_url() . '/#' . $pages[$i]->post_name . '">' . $pages[$i]->post_title . '</a></li>' . PHP_EOL;
		}
		if($VAN['hide_contact']==1){
		  echo '<li><a href="' . get_home_url() . '/#contact">Contact</a></li>'.PHP_EOL;
		}
		echo '</ul>'.PHP_EOL;
	}
}

class description_walker extends Walker_Nav_Menu{
      function start_el(&$output, $item, $depth=0, $args = array() ,$id = 0){
           global $wp_query;
           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
           $class_names = $value = '';
           $classes = empty( $item->classes ) ? array() : (array) $item->classes;
           $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
           $class_names = ' class="'. esc_attr( $class_names ) . '"';
           $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
           $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
           $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
           $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
           if($item->object == 'page')
           {
                $varpost = get_post($item->object_id);
                if(is_home()){
                  $attributes .= ' href="#' . $varpost->post_name . '"';
                }else{
                  $attributes .= ' href="'.home_url().'/#' . $varpost->post_name . '"';
                }
           }
           else
                $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
            $item_output = $args->before;
            $item_output .= '<a'. $attributes .'>';
            $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID );
            $item_output .= $args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;
            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args,$id );
     }
}

/* Check navigation menu setting*/
if( !function_exists( 'van_check_menu') ){
    function van_check_menu(){
		global $VAN;
		//If custom menu exist,get the ID of pages
		if (($locations = get_nav_menu_locations()) && $locations['primary_navi'] ) {
        $menu = wp_get_nav_menu_object( $locations['primary_navi'] );
        $menu_items = wp_get_nav_menu_items($menu->term_id);
        $pageID = array();
        foreach($menu_items as $item) {
            if($item->object == 'page')
                $pageID[] = $item->object_id;
        }
		query_posts( array( 'post_type' => 'page','post__in' => $pageID, 'posts_per_page' => count($pageID), 'orderby' => 'post__in' ) );
		}else {	
		   //If custom menu doesn't exist,check default page menu setting in theme options
		   //If default page menu setting exist
		   if(isset($VAN['pages_navi']) && $VAN['pages_navi'] <> '' ){
				query_posts(array( 'post_type' => 'page', 'post__in' => $VAN['pages_navi'], 'posts_per_page' => count($VAN['pages_navi']), 'orderby' => 'menu_order', 'order' => 'ASC' ) );
		   }else{
		   //If default page menu setting doesn't exist
				query_posts(array( 'post_type' => 'page','posts_per_page'=>6,'orderby' => 'menu_order', 'order' => 'ASC') );
		   }
		}
	}
}

/*Post meta info*/
if( !function_exists( 'van_posted_on') ){
  function van_posted_on(){
?>
             <figure>
                 <ul>
                   <li class="date"><?php the_time(get_option('date_format'));?></li>
                   <li class="author"><?php printf(__('By %s','SimpleKey'),get_the_author());?></li>
                   <li class="comment"><?php comments_popup_link( __( 'No comment', 'SimpleKey' ), __( '1 Comment', 'SimpleKey' ), __( '% Comments', 'SimpleKey' ) ); ?></li>
                   <?php if(get_post_type()=='post'):?>
                   <li class="category"><?php printf( __( 'in %2$s', 'SimpleKey' ), 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list( ', ' ) ); ?></li>
                   <?php else:?>
                   <li class="term"><?php echo get_the_term_list( get_the_ID(), 'portfolios', 'in ', ', ', '' );?></li>
                   <?php endif;?>
                 </ul>
             </figure>
<?php
  }
}


/* Call Blog
 * parameter:
 * $category_slug: category slug
 * $number: How many posts you want to display?
*/
if( !function_exists( 'van_blog') ){
	function van_blog($number=5,$thumbnail=1,$gridview=0,$category_slug='',$css_animation){
	    global $post,$more;
		$tmp_post = $post;
		$tmp_more = $more;
		if($category_slug<>''){
		  $category_array=explode(',',$category_slug);
		  $args = array( 
			'numberposts' => $number, 
			'orderby' => 'post_date',
			'order'=>'DESC',
			'tax_query' => array(
				array(
				  'taxonomy' => 'category',
				  'field' => 'slug',
				  'terms' => $category_array,
				  'include_children' => false
				)
			  ));
		}else{
		  $args = array( 
			'numberposts' => $number, 
			'orderby' => 'post_date',
			'order'=>'DESC',
		   );
		}
		$posts = get_posts($args);
		$post_list='';
		$recent_blog='';
		foreach($posts as $post){
		  setup_postdata($post);
		  $image_id = get_post_thumbnail_id($post->ID);
		  $thumbnail_url = wp_get_attachment_image_src($image_id, 'blog_thumbnail', true);
		  $more = 0;
		  $url=get_permalink($post->ID);
		  $title=$post->post_title;
          if($thumbnail==0){
			$recent_blog.='<article class="post post-'.$post->ID.custom_css_animation($css_animation).'">';
			$excerpt=van_content($echo=false);	
			$recent_blog.='<h2><a href="'.$url.'" title="'.$title.'">'.$title.'</a></h2>';
			$recent_blog.='<p class="meta">'.__('BY ').get_the_author().' / '.get_the_category_list( ', ' ).' / '. get_comments_number().__(' COMMENTS').'</p>';
			$recent_blog.='<div class="entry">'.$excerpt.'</div><div class="clearfix"></div>';
			$recent_blog.='</article>';
		  }elseif($thumbnail==1){
			//Full Width Layout
			if($gridview==1){
		     $grid=" grid_blog";
		    }else{
		     $grid="";
		    }
			$recent_blog.='<article class="post post-'.$post->ID.''.$grid.custom_css_animation($css_animation).'">';
            if(has_post_thumbnail()){
              $recent_blog.='<div class="thumbnail"><a href="'.$url.'" title="'.$title.'"><img src="'.$thumbnail_url[0].'" alt="'.$title.'" /></a></div>';
			}
            $recent_blog.='<h2><a href="'.$url.'" title="'.esc_attr($title).'" rel="bookmark">'.$title.'</a></h2>';
            $recent_blog.='<p class="meta">'.get_the_time(get_option('date_format')).'</p>';
			$recent_blog.='<div class="entry">';
            $recent_blog.='<div class="entry">';
			if($gridview==1){
				$recent_blog.= van_truncate(get_the_excerpt(),120);
			  $recent_blog.= '<a href="'.get_permalink().'" class="more-link">'. __( 'Read More &raquo;', 'SimpleKey') .'</a>';
			}else{
			   if(has_post_thumbnail()){
				if($post->post_excerpt){
				  $recent_blog.=get_the_excerpt();
				}else{
				   $recent_blog.= van_truncate(strip_tags(get_the_content()),250);
				}
				$recent_blog.= '<a href="'.get_permalink().'" class="more-link">'. __( 'Read More &raquo;', 'SimpleKey') .'</a>';
			  }else{
				$recent_blog.= van_content(false,false);
			  }
			 
			}
             $recent_blog.= '</div>
               <div class="clearfix"></div>
              </article>';
		   }
		 }
		$post = $tmp_post;
		$more = $tmp_more;
		
		$recent_blog = apply_filters('van_blog', $recent_blog);
	    return $recent_blog;
	}
}

/* Call post list
 * parameter:
 * $category_slug: category slug
 * $number: How many posts you want to display?
*/
if( !function_exists( 'van_post_list') ){
	function van_post_list($number=5,$showimg=1,$category_slug=''){
	    global $post;
		$tmp_post = $post;
		if($category_slug<>''){
		  $category_array=explode(',',$category_slug);
		  $args = array( 
			'numberposts' => $number, 
			'orderby' => 'post_date',
			'order'=>'DESC',
			'tax_query' => array(
				array(
				  'taxonomy' => 'category',
				  'field' => 'slug',
				  'terms' => $category_array,
				  'include_children' => false
				)
			  ));
		}else{
		  $args = array( 
			'numberposts' => $number, 
			'orderby' => 'post_date',
			'order'=>'DESC'
		   );
		}
		$posts = get_posts($args);
		$post_list='<div class="post_list van_widget"><ul>';
		$excerpt='';
		foreach($posts as $post){
		    setup_postdata($post);
			$url=get_permalink($post->ID);
			$title=$post->post_title;	

			$post_list.='<li id="post-list-'.$post->ID.'">';
			if($showimg==1){ 
				if(has_post_thumbnail($post->ID)){
					  $image_id = get_post_thumbnail_id($post->ID);
					  $thumbnail_url = wp_get_attachment_image_src($image_id, array(80,80), true);
					  $post_list.='<a href="'.$url.'" class="thumbnail"><img src="'.$thumbnail_url[0].'" alt="'.$title.'" /></a>';
				}
			$excerpt='<p>'.van_truncate(trim(strip_tags(get_the_excerpt())),60).'</p>';
			}
			$post_list.='<a href="'.$url.'" class="post_title">'.$title.'</a>';
			$post_list.=$excerpt;
			$post_list.='</li>';
		 }
		$post = $tmp_post;
		$post_list.='</ul></div>';
		
		$post_list = apply_filters('van_post_list', $post_list);
	    return $post_list;
	}
}

/* Call comment
 * parameter:
 * $category_slug: category slug
 * $number: How many posts you want to display?
 * $paged: show the paged navigation
*/
if( !function_exists( 'van_comments') ){
	function van_comments($number=5){
		global $wpdb;
		$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID,
		comment_post_ID, comment_author, comment_date_gmt, comment_approved,
		comment_type,comment_author_url,
		SUBSTRING(comment_content,1,30) AS com_excerpt
		FROM $wpdb->comments
		LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID =
		$wpdb->posts.ID)
		WHERE comment_approved = '1' AND comment_type = '' AND
		post_password = ''
		ORDER BY comment_date_gmt DESC
		LIMIT ".$number;
		
		$comments = $wpdb->get_results($sql);
		$comments_html = '';
		$comments_html .= "<div class=\"van_widget\">\n<ul>";
		foreach ($comments as $comment) {
			$comments_html .= "\n<li><a href=\"" . get_permalink($comment->ID) .
			"#comment-" . $comment->comment_ID . "\" title=\"on " .
			$comment->post_title . "\">" . strip_tags($comment->com_excerpt)
			."</a></li>";
		}
		$comments_html .= "\n</ul></div>";
		$comments_html = apply_filters('van_comments', $comments_html);
		return $comments_html;
	}
}

/* Call Blog Slider*/
if( !function_exists( 'van_post_slider') ){
	function van_post_slider(){
	   $post_slider_html='';
	   if ( $images = get_children(array(
            'post_parent' => get_the_ID(),
            'post_type' => 'attachment',
            'order' => 'ASC',
            'orderby' => 'ID',
            'post_mime_type' => 'image',)))
            {
		$post_slider_html.='<div id="post-gallery" class="flexslider">
            <ul class="slides maxHeight">';
              foreach( $images as $image ) {
                $attachmenturl=wp_get_attachment_url($image->ID);
                $post_slider_html.='<li><img src="'.$attachmenturl.'" alt="" /></li>';
                }
             $post_slider_html.='</ul>
           </div>';
	    }
	    $post_slider_html = apply_filters('van_post_slider', $post_slider_html);
		return $post_slider_html;
	}
}

/*Show Portfolio*/
if( !function_exists( 'van_portfolios') ){
	function van_portfolios($portfolios_id,$category_slug='',$items=6,$lightbox=1,$ajax=0,$intro=1,$col=3,$orderby='date',$css_animation,$echo=TRUE){
		global $post;
		$tmp_post = $post;
		if($category_slug<>''){
		  $category_array=explode(',',$category_slug);
		  $args = array( 
			'numberposts' => $items, 
			'post_type'=>'portfolio',
			'orderby' => 'post_date',
			'order'=>'DESC',
			'tax_query' => array(
				array(
				  'taxonomy' => 'portfolios',
				  'field' => 'slug',
				  'terms' => $category_array,
				  'include_children' => false
				)
			  ));
		}else{
			
		  if($orderby=='date'){	
		    $args = array( 
			'numberposts' => $items, 
			'post_type'=>'portfolio',
			'orderby' => 'post_date',
			'order'=>'DESC'
		    );
		  }elseif($orderby=='rand'){
		    $args = array( 
			'numberposts' => $items, 
			'post_type'=>'portfolio',
			'orderby' => 'rand',
		    );
		  }
		}
		$posts = get_posts($args);
		$return_html='<div id="portfolios-'.$portfolios_id.'" class="portfolios columns'.$col.custom_css_animation($css_animation).'">';
		foreach($posts as $post){
		   setup_postdata($post);
		   
		   if(has_post_thumbnail($post->ID)){
			$image_id = get_post_thumbnail_id($post->ID);
			$image_url = wp_get_attachment_image_src($image_id, 'full', true);
			if($col==3 || $col==''){
			  $excerpt=van_truncate(strip_tags(do_shortcode($post->post_content)),180);
			}elseif($col==4){
			  $excerpt=van_truncate(strip_tags(do_shortcode($post->post_content)),120);
			}elseif($col==5){
			  $excerpt=van_truncate(strip_tags(do_shortcode($post->post_content)),80);
			}
		
			$thumbnail_url = wp_get_attachment_image_src($image_id, 'portfolio_thumbnail', true);
			
			if($post->post_excerpt){
			  $description=$post->post_excerpt;
			}else{
			  $description=$excerpt;
			}
			
			$portfolio_type=trim(strip_tags(get_post_meta($post->ID, "portfolio_type_value", true)));
			$portfolio_video=trim(strip_tags(get_post_meta($post->ID, "portfolio_video_value", true)));
			$portfolio_audio=trim(strip_tags(get_post_meta($post->ID, "portfolio_audio_value", true)));
			$portfolio_link=trim(strip_tags(get_post_meta($post->ID, "portfolio_link_value", true)));
			$portfolio_hover_image=trim(strip_tags(get_post_meta($post->ID, "portfolio_hover_image_value", true)));
			if($portfolio_hover_image==''){$portfolio_hover_image=$thumbnail_url[0];}
			
			if($portfolio_type=='')$portfolio_type="Image";
			if($ajax==0){
				if($lightbox==1){
				  switch($portfolio_type){
					case 'Image':
						$class=" lightbox";
						$url=$image_url[0];
						$dataUrl=' data-url=""';
					break;
					
					case 'Video':
						$class="";
						$url=get_permalink($post->ID);
						$dataUrl=' data-url=""';
					break;
					
					case 'Audio':
						$class="";
						$url=get_permalink($post->ID);
						$dataUrl=' data-url=""';
					break;
				  }
				}elseif($lightbox==0){
				     $class=' data-url=""';
					 $url=get_permalink($post->ID);
					 $dataUrl="";
				}else{
				  $class="";
				  $url=get_permalink($post->ID);
				}
			}else{
			    $class=" ajax";
				$url='javascript:void(0)';
				$dataUrl=' data-url="'.get_permalink($post->ID).'"';
			}
			$target='';
			if($portfolio_link<>'' && isset($portfolio_link)){
			   $url=$portfolio_link;
			   $target=' target="_blank"';
			   $dataUrl='';
			   $class='';
			}
			$terms = get_the_terms($post->ID,'portfolios');
			$slug=array();
			if ( $terms && ! is_wp_error( $terms ) ){
				foreach($terms as $term) {
					$slug[] = $term->slug;
				}
			}
			$on_slug = join( " ", $slug);
				$return_html.='<div class="portfolio-item '.$on_slug.'" id="portfolio-'.$post->ID.'"'.$dataUrl.' data-hover-image="'.$portfolio_hover_image.'" data-original-image="'.$thumbnail_url[0].'">
				<a class="overlay'.$class.'" href="'.$url.'" title="'.$post->post_title.'"'.$target.'>';
				$return_html.='<h3>'.$post->post_title.'</h3>';
				if($intro==1){
				  $return_html.='<p class="intro">'.$description.'</p>';
				}
				$return_html.='</a>
				<div class="tools">';
				   if($portfolio_link<>'' && isset($portfolio_link)){
				      $return_html.='<a href="'.$url.'" class="zoomin iframe_window"'.$target.'>ZoomIn</a>';			 
				      $return_html.='<a href="'.$url.'" class="info">Info</a>';
				   }else{
					 $return_html.='<span'.$dataUrl.'><a href="'.$url.'" class="zoomin'.$class.'" title="'.$post->post_title.'">ZoomIn</a></span>';
					 $return_html.='<a href="'.get_permalink($post->ID).'" class="info">Info</a>';
				   }
				$return_html.='</div>
				<a href="'.$url.'" class="item'.$class.'"><img src="'.$thumbnail_url[0].'" alt="'.$post->post_title.'" /></a>';
				$return_html.='</div>'.PHP_EOL;
				}
		 }
		$post = $tmp_post;
		$return_html.='<div class="clearfix"></div></div>';
		$return_html.='<script type="text/javascript">
		jQuery(document).ready(function($){
			 $(window).load(function(){
			  $("#portfolios-'.$portfolios_id.'").isotope({ 
				  itemSelector: ".portfolio-item",
				  animationEngine: "best-available",
				  filter: "*"
		     });
		     
		     $("#filter-'.$portfolios_id.' a").click(function(){
			  var selector = $(this).attr("data-filter");
			  $("#portfolios-'.$portfolios_id.'").isotope({ 
			    filter: selector
			  });
			  $(this).parent().attr("class","filter_current");
			  $(this).parent().siblings().removeAttr("class");
			  return false;
			 });
			});
		});
		</script>';
		
		//$return_html = apply_filters('van_portfolios', $return_html);
		if($echo)
		{
			echo $return_html;
		}
		else
		{
			return $return_html;
		}
	}
}

/*Show blog as portfolios*/
if( !function_exists( 'van_blog_grid') ){
	function van_blog_grid($category_slug='',$items=6,$ajax=0,$intro=1,$col=3,$orderby='date',$css_animation,$echo=TRUE){
		global $post;
		$tmp_post = $post;
		if($category_slug<>''){
		  $category_array=explode(',',$category_slug);
		  $args = array( 
			'numberposts' => $items, 
			'post_type'=>'post',
			'orderby' => 'post_date',
			'order'=>'DESC',
			'tax_query' => array(
				array(
				  'taxonomy' => 'category',
				  'field' => 'slug',
				  'terms' => $category_array,
				  'include_children' => false
				)
			  ));
		}else{
			
		  if($orderby=='date'){	
		    $args = array( 
			'numberposts' => $items, 
			'post_type'=>'post',
			'orderby' => 'post_date',
			'order'=>'DESC'
		    );
		  }elseif($orderby=='rand'){
		    $args = array( 
			'numberposts' => $items, 
			'post_type'=>'post',
			'orderby' => 'rand',
		    );
		  }
		}
		$posts = get_posts($args);
		$return_html='<div class="portfolios columns'.$col.custom_css_animation($css_animation).'">';
		foreach($posts as $post){
		   setup_postdata($post);
		   
		   if(has_post_thumbnail($post->ID)){
			$image_id = get_post_thumbnail_id($post->ID);
			$image_url = wp_get_attachment_image_src($image_id, 'full', true);
			if($col==3 || $col==''){
			  $excerpt=van_truncate(strip_tags(do_shortcode($post->post_content)),180);
			  $thumbnail_url = wp_get_attachment_image_src($image_id, 'portfolio_thumbnail', true);
			}elseif($col==4){
			  $excerpt=van_truncate(strip_tags(do_shortcode($post->post_content)),120);
			  $thumbnail_url = wp_get_attachment_image_src($image_id, 'portfolio_thumbnail_4', true);
			}elseif($col==5){
			  $excerpt=van_truncate(strip_tags(do_shortcode($post->post_content)),80);
			  $thumbnail_url = wp_get_attachment_image_src($image_id, 'portfolio_thumbnail_5', true);
			}
			if(van_is_mobile()){
			  $thumbnail_url = wp_get_attachment_image_src($image_id, 'portfolio_thumbnail', true);
			}
			
			if($post->post_excerpt){
			  $description=$post->post_excerpt;
			}else{
			  $description=$excerpt;
			}
			
			if($ajax==0){
			    $class='';
				$url=get_permalink($post->ID);
				$dataUrl="";
			}else{
			    $class=" ajax";
				$url='javascript:void(0)';
				$dataUrl=' data-url="'.get_permalink($post->ID).'"';
			}
			$terms = get_the_terms($post->ID,'category');
			$slug=array();
			if ( $terms && ! is_wp_error( $terms ) ){
				foreach($terms as $term) {
					$slug[] = $term->slug;
				}
			}
			$on_slug = join( " ", $slug);
				$return_html.='<div class="portfolio-item '.$on_slug.'" id="post-'.$post->ID.'"'.$dataUrl.'>
				<a class="overlay'.$class.'" href="'.$url.'" title="'.$post->post_title.'">';
				$return_html.='<h3>'.$post->post_title.'</h3>';
				if($intro==1){
				  $return_html.='<p class="intro">'.$description.'</p>';
				}
				$return_html.='</a>
				<div class="tools">';
					 $return_html.='<span'.$dataUrl.'><a href="'.$url.'" class="zoomin'.$class.'" title="'.$post->post_title.'">ZoomIn</a></span>';
					 $return_html.='<a href="'.get_permalink($post->ID).'" class="info">Info</a>';
				$return_html.='</div>
				<a href="'.$url.'" class="item'.$class.'"><img src="'.$thumbnail_url[0].'" alt="'.$post->post_title.'" /></a>';
				$return_html.='</div>'.PHP_EOL;
				}
		 }
		$post = $tmp_post;
		$return_html.='<div class="clearfix"></div></div>';
		$return_html = apply_filters('van_blog_grid', $return_html);
		if($echo)
		{
			echo $return_html;
		}
		else
		{
			return $return_html;
		}
	}
}

function van_category_filter($id='',$inverse=0,$exclude='',$include_slug='',$tax,$echo=true){
	$ex_arr=explode(',',$exclude);
	if($include_slug<>''){
	   $include_slug_array=explode(',',$include_slug);
	   $include='';
	   for($i=0;$i<count($include_slug_array);$i++){
		 $terms = get_term_by('slug', $include_slug_array[$i], $tax); 
		 $include .= $terms->term_id.',';
	   }
	   $include = trim($include, ',');
	}else{
	   $include='';
	}
	
	$terms = get_terms($tax,array('hide_empty'=>true,'parent'=>0,'include'=>$include,'exclude'=>$ex_arr));
	$count = count($terms);

	if($inverse==0){
	  $class='';
	}else{
	  $class=' inverse';
	}
	$return_html='';
	if($count > 0){
     $return_html.='<nav id="filter-'.$id.'" data-option-key="filter" class="tax'.$class.van_css_animate(' wpb_animate_when_almost_visible wpb_bottom-to-top').'">
		  <ul>
			<li class="filter_current"><a href="#fliter" data-filter="*">'.__('All','SimpleKey').'</a></li>';
	 foreach($terms as $term) {
		$return_html .= '<li><a href="javascript:void(0)" data-filter=".'.$term->slug.'">'.$term->name.'</a></li>';
	 }
	 $return_html.='</ul></nav>';
	}
	//$return_html = apply_filters('van_category_filter','',$inverse,$exclude,$include_slug,$tax,$echo);
	if($echo)
		{
			echo $return_html;
		}
		else
		{
			return $return_html;
	}
}

function van_categories($taxonomy='category',$parent_id='',$echo=true){
	$terms = get_terms($taxonomy,array('child_of=>'.$parent_id.',hide_empty'=>true,'parent'=>0));
	$count = count($terms);
	$return_html='';
	if($count > 0){
     $return_html.='<nav id="portfolios-set" class="tax">
		  <ul>';
	 foreach($terms as $term) {
		$return_html .= '<li><a href="'.home_url().'/portfolios/'.$term->slug.'">'.$term->name.'</a></li>';
	 }
	 $return_html.='</ul></nav>';
	}
	$return_html = apply_filters('van_categories', $return_html);
	if($echo)
		{
			echo $return_html;
		}
		else
		{
			return $return_html;
	}
}

/* Custom comment layout*/
if( !function_exists( 'van_custom_comments') ){
	function van_custom_comments($comment, $args, $depth){
	  $GLOBALS['comment'] = $comment; ?>
      <li id="comment-<?php comment_ID() ?>">
                  <aside class="avatar"><?php echo get_avatar( $comment, 98 ); ?></aside>
                  <div class="commentDetail">
                    <hgroup><strong><?php printf(__('%s','SimpleKey'),get_comment_author_link());?></strong> <?php printf(__('%1$s at %2$s','SimpleKey'), get_comment_date(), get_comment_time()) ?></hgroup>
                    <p>
                     <?php if ($comment->comment_approved == '0') : ?>
                        <em>
                        <?php _e('Your comment is waiting for approvel...','SimpleKey') ?>
                        </em> <br />
                        <?php endif; ?>
                        <?php comment_text();?>
                    </p>
                  </div>
      </li>
<?php }
}

/*Only display normal post in seach result*/
function van_searchFilter($query) {
	$post_type='post';
    if ($query->is_search) {
        $query->set('post_type', $post_type);
    };
    return $query;
};
//add_filter('pre_get_posts','van_searchFilter');

add_filter( 'get_search_form', 'van_search_form' );
function van_search_form( $form ) {
    $form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
    <div><label class="screen-reader-text" for="s">' . __( 'Search for:' ) . '</label>
    <input type="text" value="' . get_search_query() . '" name="s" id="s" />
	<input type="hidden" value="post" name="post_type" id="post_type" />
    <input type="submit" id="searchsubmit" value="'. esc_attr__( 'Search' ) .'" />
    </div>
    </form>';
    return $form;
}

/*CSS animation*/
function van_css_animate($css_animate){
    $no_animate='';
	if ( function_exists( 'vc_map')){
	   return $css_animate;
	}else{
	   return $no_animate;
	}
}

/*Multi-image metabox filter*/
add_filter('images_cpt','portfolio_image_cpt');
function portfolio_image_cpt(){
        $cpts = array('portfolio');
        return $cpts;
}
add_filter('list_images','portfolio_list_images');
function portfolio_list_images(){
        $picts = array(
            'image1' => '_image1',
            'image2' => '_image2',
            'image3' => '_image3',
            'image4' => '_image4',
            'image5' => '_image5',
            'image6' => '_image6',
            'image7' => '_image7',
            'image8' => '_image8',
            'image9' => '_image9',
            'image10' => '_image10',
            'image11' => '_image11',
            'image12' => '_image12',
            'image13' => '_image13',
            'image14' => '_image14',
            'image15' => '_image15',
        );
        return $picts;
}
?>