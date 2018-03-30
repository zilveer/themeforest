<?php

/*--------------------------------------------------*/
/* Template Name: WOOCOMMERCE
/*--------------------------------------------------*/

get_header();

global $post;
  
    echo '	
	<div id="wrap" class="fixed">
	
	<div class="page-title">
		<h1 class="blog">' . get_the_title() . '</h1>
	</div>
    
    <div id="page-full">
        <div id="wizewoo" class="fixed">
            <div class="wizewoopage">';
            if (have_posts())
                while (have_posts()):
                    the_post();
                    echo the_content();
                endwhile;
            echo '
            </div>
        </div>  
	</div><!-- end #page-full -->';

get_footer();