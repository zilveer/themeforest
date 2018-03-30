<?php
/**
 * Template Name: Full Width
 * Description: A Page Template for displaying pages without sidebar
 */

if(is_blog()){
	return load_template(THEME_DIR . "/template_blog.php");
}

$post_id = theme_get_queried_object_id();
$content_width = 960;
get_header(); 
echo theme_generator('introduce',$post_id);?>
<div id="page">
	<div class="inner">
		<?php echo theme_generator('breadcrumbs',$post_id);?>
		<div id="main">
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<div class="content">
				<?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'striking-r' ), 'after' => '</div>' ) ); ?>
				<?php edit_post_link(__('Edit', 'striking-r'),'<footer><p class="entry_edit">','</p></footer>'); ?>
				<div class="clearboth"></div>
			</div>
<?php endwhile; ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
