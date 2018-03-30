<?php
if (!isset($is_review)) {
	$is_review = bucket::has_average_score();
}
if (get_the_title()): ?>
	<h1 class="article__title  article__title--single" itemtype="name" <?php echo $is_review ? 'itemprop="itemreviewed"' : ''; ?>><?php the_title(); ?></h1>
<?php else: ?>
	<h1 class="article__title  article__title--single" itemtype="name" <?php echo $is_review ? 'itemprop="itemreviewed"' : ''; ?>><?php _e('Untitled', 'bucket'); ?></h1>
<?php endif; ?>

<div class="article__title__meta">
	<?php if (wpgrade::option('blog_single_show_title_meta_info')):?>
		<?php $author_display_name = get_the_author_meta( 'display_name' );
		printf('<div class="article__author-name">%s</div>', '<a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'" title="'.sprintf(__('Posts by %s', 'bucket'), $author_display_name).'" '.($is_review ? 'itemprop="reviewer author"' : 'itemprop="author"').'>'.$author_display_name.'</a>') ?>
		<time class="article__time" <?php echo $is_review ? 'itemprop="dtreviewed"' : ''; ?> datetime="<?php the_time('c'); ?>"> <?php printf(__('on %s at %s', 'bucket'),get_the_date(),get_the_time()); ?></time>
	<?php endif; ?>
</div>
<?php
$share_buttons_settings = wpgrade::option('share_buttons_settings');
if ( ! empty( $share_buttons_settings ) && (wpgrade::option('blog_single_share_links_position', 'bottom') == 'top' || wpgrade::option('blog_single_share_links_position', 'bottom') == 'both') ) {
	get_template_part('theme-partials/post-templates/share-box-top');
} ?>