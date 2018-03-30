<?php
$page_layout = wize_page_sidebar_layout();
$page_slider = wize_page_slider_layout();

switch ($page_slider) {
    case "sliderfull":
        require_once('slider-full.php');
    break;
    
    case "sliderboxed":
        require_once('slider-boxed.php');
    break;
}

echo '	
	<div id="wrap" class="fixed">';

switch ($page_layout) {
    case "sidebar-left":
        echo '
<div class="home-fixed">
	<div id="home-right">';
        if (have_posts())
            while (have_posts()):
                the_post();
                echo the_content();
            endwhile;
        echo '
	</div><!-- end #home-right -->';
		if ( is_active_sidebar( 'homepage-page' ) ) {
			echo '
	<div id="sidebar-left">';
        dynamic_sidebar( 'homepage-page' );
			echo '
	</div><!-- end #sidebar-left -->';
		}
		echo '
</div><!-- end .home-fixed -->';
    break;
		
    case "sidebar-full":
        echo '
<div class="home-fixed">
	<div id="blog-full">';
        if (have_posts())
            while (have_posts()):
                the_post();
                echo the_content();
            endwhile;
        echo '
	</div><!-- end #blog-full -->
</div><!-- end .home-fixed -->';
    break;
	
    case "sidebar-right":
        echo '
<div class="home-fixed">
	<div id="home-left">';
        if (have_posts())
            while (have_posts()):
                the_post();
                echo the_content();
            endwhile;
        echo '
	</div><!-- end #home-left -->';
		if ( is_active_sidebar( 'homepage-page' ) ) {
			echo '
	<div id="sidebar-right">';
        dynamic_sidebar( 'homepage-page' );
			echo '
	</div><!-- end #sidebar-right -->';
		}
		echo '
</div><!-- end .home-fixed -->';
    break;
}