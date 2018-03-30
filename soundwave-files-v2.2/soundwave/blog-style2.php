<?php
/*
Template Name: Blog Style 2
*/
?>

<?php get_header(); ?>

<div id="content">

<?php

if (is_front_page()) {
    $paged = (get_query_var('page')) ? get_query_var('page') : 1;
}

$page_layout = sidebar_layout();
switch ($page_layout) {
    case "layout-sidebar-left":	
		echo '
   <div class="col-right-media">';
	break;
	
	case "layout-sidebar-right":	
		echo '
   <div class="col-left-media">';
	break;
	
	case "layout-full":
        echo '<div class="title-head"><h1>Please select left or right from  "Sidebar layout settings" of this page.</h1></div>';
    break;
}	
	
echo '	
      <div class="title-head"><h1>';
$prefix = false;
if (function_exists('is_tag') && is_tag()) {
    $prefix = true;
} elseif (is_archive()) {
    wp_title(' ');
} elseif (is_page()) {
    the_title();
}
echo '</h1></div>
      <div class="bl2page clearfix">';

$query    = array(
    'post_type' => 'post',
    'paged' => $paged
);
$wp_query = new WP_Query($query);
if (have_posts())
    while ($wp_query->have_posts()):
        the_post();
        $image_id 	  = get_post_thumbnail_id($post->ID);
        $cover        = wp_get_attachment_image_src($image_id, 'blog-home');
		$cover_large  = wp_get_attachment_image_src($image_id, 'photo-large');
		$num_comments = get_comments_number();
        echo '
         <div class="bl2page-col">';
        if ($image_id) {
            echo '
            <div class="bl2page-cover">
               <div class="wz-wrap wz-hover">
		         <img src="' . $cover[0] . '" alt="' . get_the_title() . '" />
                  <div class="he-view">
                     <div class="bg a0" data-animate="fadeIn">
                        <a href="' . get_permalink() . '" class="bl2page-link a2" data-animate="zoomIn"></a>
                        <a href="' . $cover_large[0] . '" class="bl2page-zoom a2" data-animate="zoomIn" data-rel="prettyPhoto-cover"></a>	
					 </div>
	              </div>	  
	           </div> 
            </div><!-- end .bl2page-cover -->';
        }
       echo '
            <h2 class="bl2page-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>
            <div class="bl2page-text">
               <p>' . the_excerpt_max(280) . '</p>
		    </div><!-- end .bl2page-text -->
            <div class="bl2page-info">
               <p class="bl2page-user">' . get_the_author() . '</p> 
               <p class="bl2page-date">' . get_the_time('F jS, Y') . '</p> 
               <p class="bl2page-comment">';
			if ($num_comments == 0) {  
				echo '' . __('No comments', 'wizedesign') . '';  
			} elseif ($num_comments == 1) {  
				echo '' . __('One comment', 'wizedesign') . '';  
			} else {  
				echo '' .$num_comments . ' ' . __('comments', 'wizedesign') . '';  
			} 
			echo '</p>  
			</div><!-- end .bl2page-info -->
         </div><!-- end .bl2page-col -->';
    endwhile;
if (function_exists("pag_half_wz")) {
    pag_half_wz();
}
	echo '						
      </div><!-- end .bl2page clearfix --> 			 
   </div><!-- end .col -->';

switch ($page_layout) {	
	case "layout-sidebar-left":
        echo '
   <div class="sidebar-left">';
        wz_setSection('zone-sidebar');
		if ( is_active_sidebar('sidebar-blog-archive') ) {
        if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-blog-archive'));
		} else {
		if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-page'));
		}	
        echo '
   </div><!-- end .sidebar-left -->';
    break;
    case "layout-sidebar-right":
        echo '
   <div class="sidebar-right">';
        wz_setSection('zone-sidebar');
		if ( is_active_sidebar('sidebar-blog-archive') ) {
        if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-blog-archive'));
		} else {
		if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-page'));
		}	
        echo '
   </div><!-- end .sidebar-right -->';
    break;
}
?>
	
</div><!-- end #content -->

<?php get_footer(); ?>