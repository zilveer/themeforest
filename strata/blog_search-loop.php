<?php 
global $qode_options_theme13;
$blog_hide_comments = "";
if (isset($qode_options_theme13['blog_hide_comments'])) {
	$blog_hide_comments = $qode_options_theme13['blog_hide_comments'];
}
$qode_like = "on";
if (isset($qode_options_theme13['qode_like'])) {
	$qode_like = $qode_options_theme13['qode_like'];
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post_content_holder">
		<?php if ( has_post_thumbnail() ) { ?>
			<div class="post_image">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<?php the_post_thumbnail('full'); ?>
				</a>
			</div>
		<?php } ?>
		<div class="post_text">
			<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
			<div class="post_description">
				<div class="post_description_left">
					<span class="date"><i class="fa fa-clock-o"></i><?php the_time('H:i d F'); ?></span>
					<span class="post_author">
						<?php _e('by','qode'); ?>
						<a class="post_author_link" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author_meta('display_name'); ?></a>
					</span>
				</div>
			</div>
			<?php
				$my_excerpt = get_the_excerpt();
				if ($my_excerpt != '') {
					echo $my_excerpt;
				}
			?>
			<div class="post_info">
				<div class="post_info_left">
					<a href="<?php the_permalink(); ?>" class="qbutton small dark"><?php _e('Read More','qode'); ?></a>
				</div>
			</div>
		</div>
	</div>
</article>
