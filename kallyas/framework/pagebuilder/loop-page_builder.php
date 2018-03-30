<?php get_header(); ?>

<?php
// We don't need to perform the loop as it will be made by the archive elements
if( is_archive() || is_home() ){
	do_action('zn_pb_content');
}
else{
	while ( have_posts() ) :

		the_post();

		do_action( 'zn_pb_content' );

	endwhile;
}

?>
<?php get_footer(); ?>