<?php
/**
 * The template for displaying Tag pages
 *
 * Used to display archive-type pages for posts in a tag.
 *
 * @package Volta
 * @subpackage Volta
 * @since Volta 1.0
 */

get_header();
$layout=MthemeCore::getOption('posts_layout', 'right');
$columns= MthemeCore::getOptionValue('posts_per_page', '10');

?>
<div class="main-content content-wrapper">
	<div class="container">
		<div class="row">
		<!-- Heading -->
		<section class="page-heading col-lg-12">
			<h1><?php printf( __( 'Tag Archives: %s', 'volta' ), single_tag_title( '', false ) ); ?></h1>
		</section>
		<!-- /Heading -->
				
		<?php
			if($layout=='left')
			{
		?>
				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
					<div class="sidebar "><?php get_sidebar(); ?></div>
				</div>
				<div class="posts-listing col-lg-9 col-md-9 col-sm-12 col-xs-12">
		<?php
			}
			elseif($layout=='right')
			{
		?>
			<div class="posts-listing col-lg-9 col-md-9 col-sm-12 col-xs-12">
		<?php
			}
			else
			{
		?>
				<div class="posts-listing col-lg-12">
		<?php
			}
		?>
		
		<?php
			if(have_posts()) {
				while(have_posts()) {
					the_post(); 
					if($layout=='fullwidth') { 
						get_template_part('content', 'blog');
					}
					else{
						get_template_part('content', 'post');
					}
				
				}
			} else {
				if(isset($_GET['s'])){
			?>
			<h3><?php _e('No posts found. Try a different search?','mtheme'); ?></h3>
			<p><?php _e('Sorry, no posts matched your search. Try again with some different keywords.','mtheme'); ?></p>
			<?php }else{ ?>
			<h3><?php _e('No posts found.','mtheme'); ?></h3>
			<?php } }?>
		</div>
				
		<?php if($layout=='right') { ?>
		<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
			<div class="sidebar "><?php get_sidebar(); ?></div>
		</div>
		<?php } ?>
			
		</div><!-- #row -->
	</div>
	
</div><!-- #main-content -->

<?php get_footer(); ?>