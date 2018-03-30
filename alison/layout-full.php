<?php 
// Prevent loading this file directly
if ( ! defined( 'ABSPATH' ) ) { exit; }

global $post;
$gorilla_template_uri = get_template_directory_uri();

$post_id = $post->id;

?>

<div id="post-<?php the_ID(); ?>" <?php post_class(array("article-item","post")); ?>>
	
	<?php if(!has_post_format('link') && !has_post_format('quote')) : ?>

		<div class="post-header">

			<?php gorilla_format_icon($post_id); ?>
			
			<?php if(is_single()) : ?>
				<h1><?php the_title(); ?></h1>
			<?php else : ?>
				<h2><a href="<?php echo esc_url(get_permalink()); ?>"><?php the_title(); ?></a></h2>
			<?php endif; ?>

			<?php if(!get_theme_mod('gorilla_post_author') || !get_theme_mod('gorilla_post_date') || !get_theme_mod('gorilla_post_cat')) : ?>
				<div class="date-author">
					<p>
					<?php if(!get_theme_mod('gorilla_post_cat')) : ?>
						<span class="cat"><?php gorilla_category('', ' / '); ?></span>
					<?php endif; ?>
					<?php if((!get_theme_mod('gorilla_post_cat') && !get_theme_mod('gorilla_post_author')) || (!get_theme_mod('gorilla_post_cat') && !get_theme_mod('gorilla_post_date'))) : 
						echo "<span class='seperator'>-</span>";
						endif; ?>
					<?php if(!get_theme_mod('gorilla_post_author')) : ?>
						<span class="author"><?php the_author(); ?></span>
					<?php endif; ?>
					<?php if(!get_theme_mod('gorilla_post_author') && !get_theme_mod('gorilla_post_date')) : 
						echo "<span class='seperator'>-</span>";
						endif; ?>
					<?php if(!get_theme_mod('gorilla_post_date')) : ?>
						<span class="date"><?php the_time( get_option('date_format') ); ?></span>
					<?php endif; ?>
					</p>
				</div>
			<?php endif; ?>
			
		</div>
							
		<?php get_template_part('inc/post-featured-files/content', get_post_format() ); ?>

	<?php endif; ?>

	<?php if(has_post_format('link') || has_post_format('quote')) : ?>
		<div class="post-entry animative reverse">
	<?php else: ?>
		<div class="post-entry">
	<?php endif; ?>
	
		<div class="post-entry-text">
		<?php the_content(__('Continue Reading', 'alison')); ?>
		<?php wp_link_pages(); ?>
		</div>
	</div>

	<?php if(!has_post_format('link') && !has_post_format('quote')) : ?>
		<div class="post-entry-bottom clearfix">
			<?php if(!is_singular()) : ?>
				<a class="custom-more-link animative-btn" href="<?php echo get_permalink($post->ID); ?>"><?php _e('Continue Reading', 'alison') ?></a>
			<?php endif; ?>
			<?php if(!get_theme_mod('gorilla_post_tags')) : ?>
				<?php if(is_single() && has_tag()) : ?>
					<div class="post-tags">
						<?php _e("<em>Tags</em> | ", 'alison') ?><?php the_tags("",", "); ?>
					</div>
				<?php endif; ?>
			<?php endif; ?>

			<!-- Like Button -->
			<div class="like-comment-buttons-wrapper clearfix">
				<div class="like-comment-buttons">
					<?php echo getPostLikeLink( $post->ID ); ?>
					<?php echo gorilla_comment_button( $post->ID ); ?>
				</div>
			</div>
			<!-- Like Button -->
		</div>
	<?php endif; ?>

	<?php  
		if(is_sticky() && !is_single()){
			echo '<span class="featured"><i class="elegant elegant-ribbon"></i></span>';	
		}
	?>
	
</div>

<?php if(is_single() && !get_theme_mod('gorilla_post_share')) : ?>
<!-- Share Buttons -->
<?php do_action("gorilla_get_share_buttons"); ?>
<!-- Share Buttons -->
<?php endif; ?>

<?php if(!get_theme_mod('gorilla_post_author_box') && is_single()) : ?>
	<?php get_template_part('inc/includes/about_author'); ?>
<?php endif; ?>

<?php if(!get_theme_mod('gorilla_post_related') && is_single()) : ?>
	<?php get_template_part('inc/includes/related_posts'); ?>
<?php endif; ?>

<?php comments_template( '', true );  ?>

<?php if(!get_theme_mod('gorilla_post_nav') && is_single()) : ?>
	<?php get_template_part('inc/includes/post_pagination'); ?>
<?php endif; ?>