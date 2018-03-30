<?php
/*
 Template Name: Featured page
 Displays the posts from a category that is set to be featured.
 */

get_header();

if(have_posts()){
	while(have_posts()){
		the_post();
		$title=get_the_title();
		$cat_id=get_opt('_featured_cat');
		$subtitle=get_post_meta($post->ID, 'subtitle_value', true);
		$intro=get_post_meta($post->ID, 'intro_value', true);
		$slider=get_post_meta($post->ID, 'slider_value', $single = true);
		$slider_prefix=get_post_meta($post->ID, 'slider_name_value', true);
		if($slider_prefix=='default'){
			$slider_prefix='';
		}
		$layout=get_post_meta($post->ID, 'layout_value', true);
		if($layout==''){
			$layout='right';
		}
		$sidebar=get_post_meta($post->ID, 'sidebar_value', true);
		if($sidebar==''){
			$sidebar='default';
		}

		//include the before content template
		locate_template( array( 'includes/html-before-content.php'), true, true );
		
		the_content();

		}
}
?>
<div class="post-boxes">
<?php 
query_posts(array(
      'cat' => $cat_id,
	  'posts_per_page' => -1
));


if(have_posts()){
	while(have_posts()){
		the_post();
		global $more;
		$more = 0;
		
	//include the post template
	locate_template( array( 'includes/post-template.php'), true, false );

	}  
}    ?>
</div>

<?php 
//include the after content template
locate_template( array( 'includes/html-after-content.php'), true, true );

get_footer();
?>
