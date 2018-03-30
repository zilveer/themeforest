<?php
/*
Template Name: Blog Style 2
*/
?>

<?php
get_header();
?>


<div id="content">

<div class="title-head"><h1>
<?php
$prefix = false;
if (function_exists('is_tag') && is_tag()) {
    $prefix = true;
} elseif (is_archive()) {
    wp_title(' ');
} elseif (is_page()) {
    the_title();
}
?>
</h1></div>

<?php
$page_layout = sidebar_layout();
switch ($page_layout) {
    case "layout-sidebar-left":
        echo '
<div class="sidebar-left">';
        wz_setSection('zone-sidebar');
        if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-page'));
        echo '
</div><!-- end .sidebar-left -->';
        break;
    case "layout-sidebar-right":
        echo '
<div class="sidebar-right">';
        wz_setSection('zone-sidebar');
        if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-page'));
        echo '
</div><!-- end .sidebar-right -->';
        break;
    case "layout-full":
        echo '
<div class="sidebar-right">';
        wz_setSection('zone-sidebar');
        if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-page'));
        echo '
</div><!-- end .sidebar-right -->';
        break;
}
?>
	
<div class="fixed">  
  <div class="col-blog-archive">
<?php
$query    = array(
    'post_type' => 'post',
    'paged' => $paged
);
$wp_query = new WP_Query($query);
if (have_posts())
    while ($wp_query->have_posts()):
        the_post();
        $image_id     = get_post_thumbnail_id($post->ID);
        $cover_blog   = wp_get_attachment_image_src($image_id, 'blog-home');
		$num_comments = get_comments_number();
        echo '
    <div class="blog-archive">';
        if ($image_id) {
        echo '
        <div class="blog-home-cover">
          <a href="' . get_permalink() . '">
            <img src="' . $cover_blog[0] . '" alt="' . get_the_title() . '" />
          </a>
        </div><!-- end .blog-home-cover --> ';
        }
        echo '
        <h2 class="event-arc-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>
        <div class="blog-home-info">
          <p class="blog-user">' . get_the_author() . '</p> 
          <p class="blog-date">' . get_the_time('F jS, Y') . '</p> 
          <p class="blog-comment"><a href="' . get_comments_link() . '">';
		  	if ($num_comments == 0) {  
				echo '' . __('No comments', 'clubber') . '';  
			} elseif ($num_comments == 1) {  
				echo '' . __('One comment', 'clubber') . '';  
			} else {  
				echo '' .$num_comments . ' ' . __('comments', 'clubber') . '';  
			}
		echo '</a></p> 
        </div><!-- end .blog-home-info -->
        <p>' . the_excerpt_max(200) . '...</p>
        <div class="blog-arc-more2"><a href="' . get_permalink() . '" rel="bookmark">' . __('Read more', 'clubber') . '</a></div>';
        echo '
    </div><!-- end .blog-archive -->';
    endwhile;
?>

    <div class="pagination-pos">
            <?php
if (function_exists("pagination")) {
    pagination();
}
?>
    </div><!-- end .pagination-pos -->								
  </div><!-- end .col-blog-archive -->   			 
</div><!-- end .fixed -->
</div><!-- end #content -->

<?php
get_footer();
?>