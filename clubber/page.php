<?php
get_header();
?>


<?php
global $post;
$location      = str_replace(array(
    strtolower(home_url())
), '', strtolower(get_permalink()));
$page_layout   = sidebar_layout();
$slide_nr      = of_get_option('nr_slide');
$slide_seconds = of_get_option('seconds_slide');
if (strlen($location) > 2) {
    echo '
<div class="title-head"><h1>' . get_the_title() . '</h1></div>';
    switch ($page_layout) {
        case "layout-sidebar-left":
            echo '<div class="fixed">';
            echo '
<div class="content-left">';
            if (have_posts())
                while (have_posts()):
                    the_post();
                    echo the_content();
                endwhile;
            echo '
</div><!-- end .content-left -->';
            echo '
<div class="sidebar-left">';
            wz_setSection('zone-sidebar');
            if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-page'));
            echo '
</div><!-- end .sidebar-left -->';
            echo '
</div><!-- end .fixed -->';
            break;
        case "layout-sidebar-right":
            echo '<div class="fixed">';
            echo '
<div class="content-right">';
            if (have_posts())
                while (have_posts()):
                    the_post();
                    echo the_content();
                endwhile;
            echo '
</div><!-- end .content-right -->';
            echo '
<div class="sidebar-right">';
            wz_setSection('zone-sidebar');
            if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-page'));
            echo '
</div><!-- end .sidebar-right -->';
            echo '
</div><!-- end .fixed -->';
            break;
        case "layout-full":
            echo '
<div class="single-page-col">';
            if (have_posts())
                while (have_posts()):
                    the_post();
                    echo the_content();
                endwhile;
            echo '
</div><!-- end .single-page-col -->';
            break;
    }
} else {
    if (of_get_option('active_slide', '1') == '1') {
        $wp_slider_query = new WP_Query(array(
            'post_type' => 'slide',
            'posts_per_page' => $slide_nr,
            'orderby' => 'DATE',
            'order' => 'DESC'
        ));
        echo '
<div id="slide"> 
  <div class="cycle-slideshow" data-cycle-timeout="' . $slide_seconds . '" data-cycle-next="#next1" data-cycle-prev="#prev1" data-cycle-slides="div.slide">
    <a id="prev1" href="#"><div class="cycle-prev"></div></a>
    <a id="next1" href="#"><div class="cycle-next"></div></a>';
        if ($wp_slider_query->post_count) {
            while ($wp_slider_query->have_posts()):
                $wp_slider_query->the_post();
                $custom    = get_post_custom($post->ID);
                $image_id  = get_post_thumbnail_id();
                $cover     = wp_get_attachment_image_src($image_id, 'slider-full');
                $slide_des = $custom["slide_des"][0];
                $slide_url = $custom["slide_url"][0];
                $slide_title = get_the_title();
                echo '
    <div class="slide">';
                if ($slide_url != null) {
                    echo '
      <a href="' . $slide_url . '">';
                }
                echo '
        <img src="' . $cover[0] . '" alt="' . get_the_title() . '" />';
                if ($slide_url != null) {
                    echo '
      </a>';
                }
                if ($slide_url != null) {
                    echo '
      <a href="' . $slide_url . '">';
                }
                
                if ($slide_title != null) {
                echo '
        <div class="slide-title">' . $slide_title . '</div>';
                }
                
                if ($slide_url != null) {
                    echo '
      </a>';
                }
                if ($slide_url != null) {
                    echo '
      <a href="' . $slide_url . '">';
                }
                if ($slide_des != null) {
                    echo '
        <div class="slide-desc">' . $slide_des . '</div>';
                }
                if ($slide_url != null) {
                    echo '
      </a>';
                }
                echo '
    </div><!-- end .slide -->';
            endwhile;
            echo '
  </div><!-- end .cycle-slideshow -->
</div><!-- end #slide -->';
        }
    }
    switch ($page_layout) {
        case "layout-sidebar-left":
            echo '
<div class="fixed">';
            echo '
<div class="content-home-left">';
            if (have_posts())
                while (have_posts()):
                    the_post();
                    echo the_content();
                endwhile;
            echo '
</div><!-- end .content-home-left -->';
            echo '
<div class="sidebar-left">';
            wz_setSection('zone-sidebar');
            if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-page'));
            echo '
</div><!-- end .sidebar-left -->';
            echo '
</div><!-- end .fixed -->';
            break;
        case "layout-sidebar-right":
            echo '
<div class="fixed">';
            echo '
<div class="content-home-right">';
            if (have_posts())
                while (have_posts()):
                    the_post();
                    echo the_content();
                endwhile;
            echo '
</div><!-- end .content-home-right -->';
            echo '
<div class="sidebar-right">';
            wz_setSection('zone-sidebar');
            if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-page'));
            echo '
</div><!-- end .sidebar-right -->';
            echo '
</div><!-- end .fixed -->';
            break;
        case "layout-full":
            echo '
<div class="single-page-col">';
            if (have_posts())
                while (have_posts()):
                    the_post();
                    echo the_content();
                endwhile;
            echo '
</div><!-- end .single-page-col -->';
            break;
    }
}
?>


<?php
get_footer();
?>