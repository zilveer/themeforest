<?php
get_header();
?>


<div id="content">

<div class="title-head"><h1><?php
$category = get_the_category();
echo $category[0]->cat_name;
?>
</h1></div>

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

<div class="fixed">
  <div class="single-col">					
<?php
if (have_posts())
    while (have_posts()):
        the_post();
        $image_id = get_post_thumbnail_id($post->ID);
        $cover    = wp_get_attachment_image_src($image_id, 'blog-preview');
        if ($image_id) {
            echo '
    <div class="blog-arc-cover">     
        <img src="' . $cover[0] . '" alt="' . get_the_title() . '" />
    </div><!-- end .blog-arc-cover -->';
        }
        echo '  
    <h2 class="blog-arc-heading">' . get_the_title($post->ID) . '</h2>
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
        echo "<p>" . the_content() . "</p>";
    endwhile;
?>			
				
<?php
comments_template('', true);
?>

    </div><!-- end .single-col -->			
</div><!-- end .fixed -->		 
</div><!-- end #content -->
	
<?php
get_footer();
?>