<?php	 		 	
	// Template Name: Blog Page
?>
<?php get_header();
global $oi_options, $more;
$more = 0;
?>
<?php
$title = get_the_title();
if($title=='The Blog'){
	$oi_options['oi_blog_settings'] ='oi_blog_rs';
	update_option( 'posts_per_page',4 );
};
if($title=='Standard: Left Sidebar'){
	$oi_options['oi_blog_settings'] ='oi_blog_ls';
	update_option( 'posts_per_page',4 );
};
if($title=='Mini Images: Right Sidebar'){
	$oi_options['oi_blog_settings'] ='oi_blog_mini_rs';
	update_option( 'posts_per_page',4 );
}
if($title=='Mini Images: Left Sidebar'){
	$oi_options['oi_blog_settings'] ='oi_blog_mini_ls';
	update_option( 'posts_per_page',4 );
}
if($title=='Masonry 2 Columns'){
	$oi_options['oi_blog_settings'] ='oi_blog_masonry_2col';
	update_option( 'posts_per_page',6 );
}
if($title=='Masonry: Right Sidebar'){
	$oi_options['oi_blog_settings'] ='oi_blog_masonry_rs';
	update_option( 'posts_per_page',5 );
}
if($title=='Masonry: Left Sidebar'){
	$oi_options['oi_blog_settings'] ='oi_blog_masonry_ls';
	update_option( 'posts_per_page',5 );
}
if($title=='Masonry 3 Columns'){
	$oi_options['oi_blog_settings'] ='oi_blog_masonry_3col';
	update_option( 'posts_per_page',9 );
}
if($title=='Chess Style'){
	$oi_options['oi_blog_settings'] ='oi_blog_chess';
	update_option( 'posts_per_page',6 );
}
if($title=='Chess Style: Right Sidebar'){
	$oi_options['oi_blog_settings'] ='oi_blog_chess_rs';
	update_option( 'posts_per_page',6 );
}
if($title=='Chess Style: Left Sidebar'){
	$oi_options['oi_blog_settings'] ='oi_blog_chess_ls';
	update_option( 'posts_per_page',6 );
}
?>

<?php get_template_part( 'framework/blog/blog', $oi_options['oi_blog_settings'] );?>
<?php get_footer(); ?>