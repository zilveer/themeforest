<?php
/**
 * This is the main index file - it is displayed by default as a front page when the theme is initialized
 * or on the posts page that has been selected in Settings -> Reading section.
 * This file actually represents the blog page template - it displays the posts, separated by pages and
 * ordered by date.
 */
get_header();

$subtitle=get_opt("_posts_subtitle");
$intro=get_opt("_posts_intro");
$slider=get_opt('_home_slider');
$slider_prefix=get_opt('_home_slider_name')=='default'?'':get_opt('_home_slider_name');
$layout=get_opt('_blog_layout');
$static_image=get_opt('_blog_static_image');
$sidebar=get_opt('_blog_sidebar');

//include the before content template
locate_template( array( 'includes/html-before-content.php'), true, true );

if(have_posts()){
	while(have_posts()){
		the_post();
		global $more;
		$more = 0;
		
		//include the post template
		locate_template( array( 'includes/post-template.php'), true, false );
	} 

	print_pagination(); 

}else{
	echo pex_text('_no_posts_available');
}

//include the after content template
locate_template( array( 'includes/html-after-content.php'), true, true );

get_footer();
?>
