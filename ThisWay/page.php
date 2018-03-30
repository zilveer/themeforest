<?php 
/**
 * Template Name: Page Template
 */
 
get_header();
if(@$_GET['info']=='description'){
	echo $pageDescription;
	exit;
}elseif(@$_GET['info']=='title'){
	wp_title( '|', true, 'right' );
	exit;
}elseif(@$_GET['info']=='page'){
	if(have_posts())
	{
		have_posts();
		the_post();
		$postID	= get_the_ID();
		$content = get_the_content();
		$content = apply_filters('the_content', $content);
		$title = get_the_title();
	}
	?>
	<h1 class="caption"><?php echo $pageTitle; ?> <a class="closebutton" href="#!/"></a></h1>
	<?php echo $content;
	wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number'));
}else{
	redirectWithEscapeFragment();
}
?> 
