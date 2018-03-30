<?php
get_header();
?>


<div id="content">



<?php
$page_layout = of_get_option('blog_images');

switch ($page_layout) {
	case "left-blog-sidebar":
		echo '
   <div class="col-right-single">';
	break;
	
	case "right-blog-sidebar":
		echo '
   <div class="col-left-single">';
	break;	
}		
echo '	
      <div class="title-head"><h1>';
$category = get_the_category();
echo $category[0]->cat_name;
echo '</h1></div>		
      <div class="single-col clearfix">';
if (have_posts())
    while (have_posts()):
        the_post();
        $image_id	  = get_post_thumbnail_id($post->ID);
        $cover   	  = wp_get_attachment_image_src($image_id, 'blog-preview');
		$cover_large  = wp_get_attachment_image_src($image_id, 'photo-large');
		$num_comments = get_comments_number();
        if ($image_id) {
            echo '
         <div class="blog-cover">     
            <div class="wz-wrap wz-hover">
               <img src="' . $cover[0] . '" alt="' . get_the_title() . '" />
               <div class="he-view">
                  <div class="bg a0" data-animate="fadeIn">
                     <a href="' . get_permalink() . '" class="bl1page-link a2" data-animate="zoomIn"></a>
                     <a href="' . $cover_large[0] . '" class="bl1page-zoom a2" data-animate="zoomIn" data-rel="prettyPhoto-cover"></a>
                  </div>
               </div>	  
            </div>  
         </div><!-- end .blog-cove -->';
        }
        echo '  
         <h2 class="blog-title">' . get_the_title($post->ID) . '</h2>';
        echo 
         "<p>" . the_content() . "</p>";
		echo '
         <div class="blog-arc-info">
            <p class="bl1page-user">' . get_the_author() . '</p> 
            <p class="bl1page-date">' . get_the_time('F jS, Y') . '</p> 
			<p class="bl1page-comment">';
			if ($num_comments == 0) {  
				echo '' . __('No comments', 'wizedesign') . '';  
			} elseif ($num_comments == 1) {  
				echo '' . __('One comment', 'wizedesign') . '';  
			} else {  
				echo '' .$num_comments . ' ' . __('comments', 'wizedesign') . '';  
			} 
			echo '</p> 
         </div><!-- end .blog-arc-info -->';
		
    endwhile;
	echo '	
      </div><!-- end .single-col clearfix -->
      <div class="single-comment">';	
comments_template('', true);
echo '
      </div><!-- end .single-comment -->	
   </div><!-- end .col -->';

switch ($page_layout) {
    case "left-blog-sidebar":
        echo '
   <div class="sidebar-left">';
        wz_setSection('zone-sidebar');
		if ( is_active_sidebar('sidebar-blog-single') ) {
        if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-blog-single'));
		} else {
		if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-page'));
		}
        echo '
   </div><!-- end .sidebar-left -->';
        break;
    case "right-blog-sidebar":
        echo '
   <div class="sidebar-right">';
        wz_setSection('zone-sidebar');
		if ( is_active_sidebar('sidebar-blog-single') ) {
        if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-blog-single'));
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