<?php get_header(); ?>

<div id="content">

<?php
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
        echo '
	<div class="title-head"><h1>Please select left or right from  "Sidebar layout settings" of this page.</h1></div>';
    break;
}	
?>	

<div class="title-head"><h1><?php
_e('Search Results for:', 'wizedesign');
?> <?php
echo $_GET['s'];
?></h1></div>
	
		<div class="bl2page clearfix">

<?php
$src   = null;
$count = 0;
if (have_posts())
    while (have_posts()):
        the_post();
        $count++;
		$image_id   = get_post_thumbnail_id($post->ID);
        $cover = wp_get_attachment_image_src($image_id, 'blog-preview');
		$cover_large    = wp_get_attachment_image_src($image_id, 'photo-large');
               $src .= '
			<div class="bl2page-col">';
        if ($image_id) {
            $src .= '
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
       $src .= '
				<h2 class="bl2page-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>
				<div class="bl2page-text">
				<p>' . the_excerpt_max(280) . '</p>
				</div><!-- end .bl2page-text -->
				<div class="bl2page-info">
					<p class="bl2page-user">' . get_the_author() . '</p> 
					<p class="bl2page-date">' . get_the_time('F jS, Y') . '</p> 
				</div><!-- end .bl2page-info -->
			</div><!-- end .bl2page-col -->';
    endwhile;
if ($count == 0) {
    echo '<h4>' . __('No posts were found!', 'wizedesign') . '</h4>';
}
echo $src;

if (function_exists("pagination")) {
    pagination();
}

wp_link_pages();
 
?>
							
  </div><!-- end .bl2page clearfix -->   			 
</div><!-- end .col -->

<?php
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