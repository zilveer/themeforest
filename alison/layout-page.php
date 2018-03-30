<?php 
// Prevent loading this file directly
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
	<div class="post-header">
		
		<h1><?php the_title(); ?></h1>
		
	</div>
	
	<?php if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) : ?>
	<div class="post-featured-item">
		<?php the_post_thumbnail('thumbnail-full'); ?>
		<?php $gorilla_caption = get_post_field('post_excerpt', $post->ID);
		if(get_post(get_post_thumbnail_id())->post_excerpt){
		echo "<span class='custom-caption'>".get_post(get_post_thumbnail_id())->post_excerpt.'</span>'; 
		} ?>
	</div>
	<?php endif; ?>
	
	<div class="post-entry">
	
		<?php the_content(); ?>
		<?php wp_link_pages(); ?>
	
	</div>
	
</div>

<?php if(!get_theme_mod('gorilla_page_comments')) : ?>
	<?php comments_template( '', true );  ?>
<?php endif; ?>