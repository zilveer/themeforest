<?php
/**
 * Template Name: Archive
 */
get_header();

if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();

		//get all the page meta data (settings) needed (function located in unctions/meta.php)
		$pexeto_page=pexeto_get_post_meta( $post->ID, array( 'slider', 'layout', 'header_display', 'sidebar' ) );

		//include the before content template
		locate_template( array( 'includes/html-before-content.php' ), true, true );

		?><div class="content-box"><?php 
		the_content();

		?>
		
		<div class="archive-page">
			<div class="cols-wrapper cols-2">
				<div class="col">
					<h2><?php _e( 'Categories', 'pexeto' ); ?></h2>
					<ul><?php wp_list_categories(array('show_count'=>1 , 'hide_empty'=>0, 'title_li'=>'')); ?></ul>
				</div>
				<div class="col nomargin">
					<h2><?php _e( 'Monthly archive', 'pexeto' ); ?></h2>
					<ul><?php wp_get_archives(array('type'=>'monthly', 'echo'=>1, 'show_post_count'=>true)); ?></ul>
				</div>
			</div>
			<h2><?php _e( 'Post List', 'pexeto' ); ?></h2>
			<ul><?php wp_get_archives(array('type'=>'postbypost', 'echo'=>1)); ?></ul>
			</div>
		</div>
		<?php
	}
}

//include the after content template
locate_template( array( 'includes/html-after-content.php' ), true, true );

get_footer();
?>

