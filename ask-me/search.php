<?php get_header();
	$blog_style = vpanel_options("home_display");
	$vbegy_sidebar_all = vpanel_options("sidebar_layout");
	$k = 0;
	if (have_posts() ) : while (have_posts() ) : the_post();
		$k++;
		if ($post->post_type == "question") {
			include ("question.php");
		}else {
			include ("post.php");
		}
	endwhile;else :
		echo "<div class='page-content page-content-user'><p class='no-item'>".__("Sorry, No Results Found.","vbegy")."</p></div>";
	endif;
	vpanel_pagination();
get_footer();?>