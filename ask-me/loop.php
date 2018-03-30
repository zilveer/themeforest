<?php $k = 0;
if (have_posts() ) : while (have_posts() ) : the_post();
	$k++;
    include ("post.php");
endwhile;else :
	echo "<div class='page-content page-content-user'><p class='no-item'>".__("No Posts Found.","vbegy")."</p></div>";
endif;