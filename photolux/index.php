<?php
/**
 * This is the main index file - it is displayed by default as a front page when the theme is initialized
 * or on the posts page that has been selected in Settings -> Reading section.
 * This file actually represents the blog page template - it displays the posts, separated by pages and
 * ordered by date.
 */
get_header();
//get all the page data needed and set it to an object that can be used in other files
$pex_page=new stdClass();
$pex_page->slider=get_opt('_home_slider');
$pex_page->layout=get_opt('_blog_layout');
$pex_page->static_image=get_opt('_blog_static_image');
$pex_page->sidebar=get_opt('_blog_sidebar');

//include the before content template
locate_template( array( 'includes/html-before-content.php'), true, true );

?>

<div class="page-wraper">
<?php 
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
?>

</div>


<?php 
//include the after content template
locate_template( array( 'includes/html-after-content.php'), true, true );

get_footer();
?>
