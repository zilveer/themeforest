<?php get_header(); ?>

<div id="content">

<?php
global $post;
$location      = str_replace(array(
    strtolower(get_bloginfo('url'))
), '', strtolower(get_permalink()));
$page_layout   = sidebar_layout();
$slidertype = of_get_option('slider_type');
if (strlen($location) > 2) {
    switch ($page_layout) {
        case "layout-sidebar-left":
            echo '	
	<div class="col-right clearfix">			
		<div class="title-page"><h1>' . get_the_title() . '</h1></div>			
			<div class="content-page">';
            if (have_posts())
                while (have_posts()):
                    the_post();
                    echo the_content();
                endwhile;
            echo '
			</div><!-- end .content-left -->
	</div>';
            echo '
	<div class="sidebar-left">';
            wz_setSection('zone-sidebar');
            if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-page'));
            echo '
	</div><!-- end .sidebar-left -->';
            echo '';
            break;
			
       case "layout-sidebar-right":
            echo '
	<div class="col-left clearfix">				
		<div class="title-page"><h1>' . get_the_title() . '</h1></div>
			<div class="content-page">';
            if (have_posts())
                while (have_posts()):
                    the_post();
                    echo the_content();
                endwhile;
            echo '
		</div><!-- end .content-right -->
	</div>';
            echo '
	<div class="sidebar-right">';
            wz_setSection('zone-sidebar');
            if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-page'));
            echo '
	</div><!-- end .sidebar-right -->';
            break;		
        case "layout-full":
            echo '
			<div class="title-page"><h1>' . get_the_title() . '</h1></div>
	<div class="content-page-full clearfix">';
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
 
     switch ($page_layout) {
        case "layout-sidebar-left":

switch ($slidertype) {
	case "slider_large":
if (of_get_option('slider_active', '1') == '1') {		
		echo ' '. get_template_part( 'slider' ) . '';	
}
break;
}

echo '
	<div class="col-right-home clearfix">';
switch ($slidertype) {
			case "slider_small":
if (of_get_option('slider_active', '1') == '1') {		
		echo ' '. get_template_part( 'slider' ) . '';	
}
			break;
}	
            if (have_posts())
                while (have_posts()):
                    the_post();
                    echo the_content();
                endwhile;
            echo '
	</div><!-- end .col-right-home clearfix -->';	           
            echo '
	<div class="sidebar-left">';
            wz_setSection('zone-sidebar');
            if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-page'));
            echo '
	</div><!-- end .sidebar-left -->';
            break;	
			case "layout-sidebar-right":


switch ($slidertype) {
	case "slider_large":
if (of_get_option('slider_active', '1') == '1') {		
		echo ' '. get_template_part( 'slider' ) . '';	
}
break;
}		
            echo '
	<div class="col-left-home clearfix">';
switch ($slidertype) {
	case "slider_small":
if (of_get_option('slider_active', '1') == '1') {		
		echo ' '. get_template_part( 'slider' ) . '';	
}
	break;
}		
            if (have_posts())
                while (have_posts()):
                    the_post();
                    echo the_content();
                endwhile;
            echo '
	</div>';
            echo '
	<div class="sidebar-right">';
            wz_setSection('zone-sidebar');
            if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-page'));
            echo '
	</div><!-- end .sidebar-right -->';

            break;
        case "layout-full":		
switch ($slidertype) {
	case "slider_large":
if (of_get_option('slider_active', '1') == '1') {		
		echo ' '. get_template_part( 'slider' ) . '';	
}
	break;
}	
            echo '
	<div class="content-page-full clearfix">';
            if (have_posts())
                while (have_posts()):
                    the_post();
                    echo the_content();
                endwhile;
            echo '
	</div><!-- end .content-home-right -->';
    }
}
?>

</div>

<?php get_footer(); ?>