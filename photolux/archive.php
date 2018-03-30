<?php
/**
 * Archive page - displays posts in a blog format, filtered by category, date created, etc.
 */
get_header();
//get all the page data needed and set it to an object that can be used in other files
$pex_page=new stdClass();
$pex_page->slider='none';
$pex_page->layout=get_opt('_blog_layout');
$pex_page->sidebar=get_opt('_blog_sidebar');

$pex_page->title;

//include the before content template
locate_template( array( 'includes/html-before-content.php'), true, true ); ?>

<div class="page-content-box"><h1 class="page-heading posts-heading"><?php 
if (is_category()){
	single_cat_title();
} elseif( is_tag() ) {
	single_tag_title();
} elseif (is_day()) {
	the_time('F jS, Y');
} elseif (is_month()) {
	the_time('F Y');
} elseif (is_year()) {
	the_time('Y');
} elseif (is_author()){
	echo get_userdata(get_query_var('author'))->display_name;
}
?></h1></div>

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

//include the after content template
locate_template( array( 'includes/html-after-content.php'), true, true );

get_footer();
?>