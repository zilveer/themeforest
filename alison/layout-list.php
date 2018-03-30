<?php 
// Prevent loading this file directly
if ( ! defined( 'ABSPATH' ) ) { exit; }

global $post, $gorilla_sidebar_home;
$gorilla_template_uri = get_template_directory_uri();

$post_id = $post->id;

?>

<div id="post-<?php the_ID(); ?>" <?php post_class(array("article-item","post","clearfix")); ?>>
	
	<?php if(!has_post_format('link') && !has_post_format('quote')) : ?>

		<?php get_template_part('inc/post-featured-files/content'); ?>
	
	<?php endif; ?>

	<div class="post-entry-wrapper">

		<?php if(!has_post_format('link') && !has_post_format('quote')) : ?>

			<div class="post-header">
				<h2><a href="<?php echo esc_url(get_permalink()); ?>"><?php echo strip_tags(get_the_title()); ?></a></h2>

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
		<?php endif; ?>

		<?php if(has_post_format('link') || has_post_format('quote')) : ?>
			<div class="post-entry animative reverse">
				<div class="post-entry-text">
				<?php the_content(__('Continue Reading', 'alison')); ?>
				</div>
			</div>
		<?php else: ?>
			<div class="post-entry">
				<div class="post-entry-text">
				<?php 
					$gorilla_content = get_the_excerpt();
					if($gorilla_sidebar_home){
						$gorilla_trim_words = "25";
					}
					else {
						$gorilla_trim_words = "50";
					}
					echo "<p>".wp_trim_words( $gorilla_content , $gorilla_trim_words )."</p>";
				?>
				<?php wp_link_pages(); ?>
				</div>
			</div>
		<?php endif; ?>

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
	</div>

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