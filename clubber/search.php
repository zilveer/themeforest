<?php
get_header();
?>

	<div id="content">

<div class="title-head"><h1><?php
_e('Search Results for:', 'clubber');
?> <?php
echo $_GET['s'];
?></h1></div>


<?php
$page_layout = of_get_option('blog_images');
?>	


<?php
$page_layout = of_get_option('blog_images');
switch ($page_layout) {
    case "left-blog-sidebar":
        echo '
<div class="sidebar-left">';
        wz_setSection('zone-sidebar');
        if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-page'));
        echo '
</div><!-- end .sidebar-left -->';
        break;
    case "right-blog-sidebar":
        echo '
<div class="sidebar-right">';
        wz_setSection('zone-sidebar');
        if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-page'));
        echo '
</div><!-- end .sidebar-right -->';
        break;
}
?>
	
<div class="row fixed">  
  <div class="col-blog-archive">
<?php
$src   = null;
$count = 0;
if (have_posts())
    while (have_posts()):
        the_post();
        $count++;
        $src .= '<div class="blog-post">';
        $image_id     = get_post_thumbnail_id($post->ID);
        $cover        = wp_get_attachment_image_src($image_id, 'blog-preview');
		$num_comments = get_comments_number();
        $src .= '
    <div class="blog-archive">';
        if ($image_id) {
            $src .= '
      <div class="blog-arc-cover">
        <a href="' . get_permalink() . '"><img src="' . $cover[0] . '" alt="' . get_the_title() . '" /></a>
      </div><!-- end .blog-arc-cover -->';
        }
        $src .= '
      <h2 class="blog-arc-heading"><a href="' . get_permalink() . '" rel="bookmark">' . get_the_title($post->ID) . '</a></h2>
      <div class="blog-arc-info">
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
      </div><!-- end .blog-arc-info -->';
        $src .= "<p>" . get_the_excerpt() . "</p>";
        $src .= '
      <div class="blog-arc-more"><a href="' . get_permalink() . '" rel="bookmark">' . __('Read more', 'clubber') . '</a></div>
    </div><!-- end .blog-archive -->
    </div>';
    endwhile;
if ($count == 0) {
    echo '<h4>' . __('No posts were found!', 'clubber') . '</h4>';
}
echo $src;
?>

  
<div class="pagination-pos">
            <?php
if (function_exists("pagination")) {
    pagination();
}
?>
    </div><!-- end .pagination-pos -->								
  </div><!-- end .col-blog-archive -->   			 
</div><!-- end .row fixed -->
</div><!-- end #content -->

<?php
get_footer();
?>