<?php 
// Prevent loading this file directly
if ( ! defined( 'ABSPATH' ) ) { exit; }

$gorilla_template_uri = get_template_directory_uri();

?>

<div class="post-item article-item">
	<div id="post-<?php the_ID(); ?>" <?php post_class(array("post","item")); ?>>

		<?php if(!has_post_format('link') && !has_post_format('quote')) : ?>
		<?php get_template_part('inc/post-featured-files/content', get_post_format() ); ?>
		<?php endif; ?>
		
		<div class="item-content">
			<?php if(has_post_format('link') || has_post_format('quote')) : ?>
			<div class="post-entry animative reverse">
			<?php else : ?>
			<div class="post-entry">
			<?php endif; ?>
				<?php if(!has_post_format('link') && !has_post_format('quote')) : ?>
				<h2><a href="<?php echo esc_url(get_permalink()); ?>"><?php the_title(); ?></a></h2>
				<?php endif; ?>

				<?php if(has_post_format('link') || has_post_format('quote')) : ?>
				<?php the_content(); ?>
				<?php else : ?>
				<?php 
					$gorilla_content = get_the_excerpt();
					echo "<p>".wp_trim_words( $gorilla_content , '25' )."</p>";
				?>
				<?php endif; ?>

				<?php if(!has_post_format('link') && !has_post_format('quote')) : ?>
				<div class="masonry-item-footer clearfix">
					<div class="sub-meta-container">
						<?php if(!get_theme_mod('gorilla_post_cat')) : ?>
						<span class="cat"><?php gorilla_category('', ', '); ?></span>
						<?php endif; ?>
						<?php if(!get_theme_mod('gorilla_post_cat') && !get_theme_mod('gorilla_post_date')) : ?>
						<span class='seperator'> / </span> 
						<?php endif; ?>
						<?php if(!get_theme_mod('gorilla_post_date')) : ?>
						<span class="date"><?php the_time( get_option('date_format') ); ?></span>
						<?php endif; ?>
					</div>
					<div class="comment-like-container">
						<!-- Like Button -->
						<div class="like-comment-buttons-wrapper clearfix">
							<div class="like-comment-buttons">
								<?php echo gorilla_comment_button( $post->ID ); ?>
								<?php echo getPostLikeLink( $post->ID ); ?>
							</div>
						</div>
						<!-- Like Button -->
					</div>
				</div>
				<?php endif; ?>
			</div>
		
		</div>

		<?php 
			if(is_sticky() && !is_single()){
				echo '<span class="featured"><i class="elegant elegant-ribbon"></i></span>';
			}

		?>
		
	</div>
</div>