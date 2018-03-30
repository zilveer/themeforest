<?php 
$layout = get_query_var("layout");
$padding_class = '';

if ($layout === 'left_sidebar') {
	$padding_class = 'padding-r-2x';
} elseif ($layout === 'right_sidebar') {
	$padding_class = 'padding-l-2x';
}
?>

<div class="col-md-4 hidden-xs hidden-sm <?php echo esc_attr( $padding_class ); ?> medium-text">
	<?php if ( is_active_sidebar( 'kowloonbay_blog_sidebar' ) ) : ?>
	<?php dynamic_sidebar( 'kowloonbay_blog_sidebar' ); ?>
	<?php else: ?>
	<div class="widget_recent_entries sidebar-block">
		<h5 class="h5-style"><?php esc_html_e('Recent Posts', 'KowloonBay'); ?></h5>
		<?php $recent_posts_args = array(
			'numberposts' => 5,
			'offset' => 0,
			'category' => 0,
			'orderby' => 'post_date',
			'order' => 'DESC',
			'post_type' => 'post',
			'post_status' => 'publish',
			'suppress_filters' => true );

		$recent_posts = wp_get_recent_posts($recent_posts_args);

		if (!empty($recent_posts)):
			echo '<ul>';
		foreach ($recent_posts as $p): ?>
		<li>
			<a href="<?php echo esc_url(post_permalink($p['ID'])); ?> "><?php echo esc_html($p['post_title']); ?></a>
			<span class="post-date"><?php echo esc_html(get_the_date( get_option('date_format'), $p['ID'])); ?></span>
		</li>
		<?php
		endforeach;
		echo '</ul>';
		endif;
		?>
	</div>
	<div class="widget_archive sidebar-block">
		<h5 class="h5-style"><?php esc_html_e('Archives', 'KowloonBay'); ?></h5>
		<ul>
			<?php
			$archives_args = array(
				'type'            => 'monthly',
				'limit'           => '',
				'format'          => 'html', 
				'before'          => '',
				'after'           => '',
				'show_post_count' => true,
				'echo'            => 1,
				'order'           => 'DESC'
				);
			wp_get_archives($archives_args);
			?>
		</ul>
	</div>
	<div class="widget_categories sidebar-block">
		<h5 class="h5-style"><?php esc_html_e('Categories', 'KowloonBay'); ?></h5>
		<ul>
			<?php wp_list_categories('title_li='); ?>
		</ul>
	</div>
	<div class="widget_tag_cloud sidebar-block">
		<h5 class="h5-style"><?php esc_html_e('Tags', 'KowloonBay'); ?></h5>
		<?php wp_tag_cloud(); ?>
	</div>
	<div class="widget_recent_comments sidebar-block">
		<h5 class="h5-style"><?php esc_html_e('Recent Comments', 'KowloonBay'); ?></h5>
		<?php
		$recent_comments = get_comments( array(
			'number'    => 5,
			'status'    => 'approve'
			) );

		if (!empty($recent_comments)){
			echo '<ul id="recentcomments">';
			foreach ($recent_comments as $c): ?>
			<li class="recentcomments"><?php 
			if (!empty($c->comment_author_url)):
				?><a href="<?php echo esc_url( $c->comment_author_url ); ?>" rel="external nofollow" class="url"><?php echo esc_html( $c->comment_author ); ?></a><?php 
			else:
				?><?php echo esc_html( $c->comment_author ); ?><?php
			endif;
			?> on <a href="<?php get_comment_link($c->comment_ID); ?>"><?php echo esc_html(get_the_title($c->comment_post_ID)); ?></a></li>
			<?php
			endforeach;
			echo '</ul>';
		}
		?>
	</div>
<?php endif; ?>
</div>