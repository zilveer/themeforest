<?php

get_header();

global $post;

$location    = str_replace(array(
    strtolower(home_url())
), '', strtolower(get_permalink()));
$page_layout = wize_page_sidebar_layout();

if (strlen($location) > 2) {
    
    echo '	
	<div id="wrap" class="fixed">
	
	<div class="page-title">
		<h1 class="blog">' . get_the_title() . '</h1>
	</div>';
    
    switch ($page_layout) {
        case "sidebar-left":
            echo '
	<div id="page-right">';
            if (have_posts())
                while (have_posts()):
                    the_post();
                    echo the_content();
                endwhile;
            echo '
	</div><!-- end #page-right -->';
			if ( is_active_sidebar( 'sidebar-page' ) ) {
				echo '
	<div id="sidebar-left">';
        dynamic_sidebar('sidebar-page');
				echo '
	</div><!-- end #sidebar-left -->';
			}
        break;
        
        case "sidebar-full":
            echo '
	<div id="page-full">';
            if (have_posts())
                while (have_posts()):
                    the_post();
                    echo the_content();
                endwhile;
            echo '
	</div><!-- end #page-full -->';
		break;
        
        case "sidebar-right":
            echo '
	<div id="page-left">';
            if (have_posts())
                while (have_posts()):
                    the_post();
                    echo the_content();
                endwhile;
            echo '
	</div><!-- end .page-left -->';
			if ( is_active_sidebar( 'sidebar-page' ) ) {
				echo '
	<div id="sidebar-right">';
		dynamic_sidebar('sidebar-page');
				echo '
	</div><!-- end #sidebar-right -->';
			}
        break;
    }
    
} else {
    require_once('start-page.php');
}

get_footer();