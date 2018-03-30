<?php 
global $kowloonbay_redux_opts;
$blog_toolbar_items = $kowloonbay_redux_opts['blog_toolbar_items'];

$blog_toolbar_label_archive = $kowloonbay_redux_opts['blog_toolbar_label_archive'];
$blog_toolbar_label_cats = $kowloonbay_redux_opts['blog_toolbar_label_cats'];
$blog_toolbar_label_tags = $kowloonbay_redux_opts['blog_toolbar_label_tags'];
$blog_toolbar_label_search = $kowloonbay_redux_opts['blog_toolbar_label_search'];

?>

<?php if ($blog_toolbar_items['a'] === '1'): ?>
<div id="stackbox-archives" class="stackbox">
	<div class="stackbox-body">
		<h5 class="margin-t-none"><?php echo esc_html($blog_toolbar_label_archive); ?></h5>
		<ul class="list-reset">
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
				wp_get_archives( $archives_args );
			?>
		</ul>
	</div>
</div>
<?php endif; ?>

<?php if ($blog_toolbar_items['c'] === '1'): ?>
<div id="stackbox-categories" class="stackbox">
	<div class="stackbox-body">
		<h5 class="margin-t-none"><?php echo esc_html($blog_toolbar_label_cats); ?></h5>
		<ul class="list-reset">
			<?php
				$categories_args = array(
					'type'                     => 'post',
					'child_of'                 => 0,
					'parent'                   => '',
					'orderby'                  => 'name',
					'order'                    => 'ASC',
					'hide_empty'               => 1,
					'hierarchical'             => 1,
					'exclude'                  => '',
					'include'                  => '',
					'number'                   => '',
					'taxonomy'                 => 'category',
					'pad_counts'               => false

				); 
				$categories = get_categories($categories_args);
				foreach ($categories as $c) {
					echo '<li><a href="'. esc_url(get_category_link($c->cat_ID)) .'">'. esc_html($c->name) .'</a> ('. esc_html($c->count) .')</li>';
				}
			?>
		</ul>
	</div>
</div>
<?php endif; ?>

<?php if ($blog_toolbar_items['t'] === '1'): ?>
<div id="stackbox-tags" class="stackbox">
	<div class="stackbox-body">
		<h5 class="margin-t-none"><?php echo esc_html( $blog_toolbar_label_tags ); ?></h5>
		<?php
			wp_tag_cloud();
		?>
	</div>
</div>
<?php endif; ?>

<?php if ($blog_toolbar_items['s'] === '1'): ?>
<div id="stackbox-search" class="stackbox">
	<div class="stackbox-body">
		<h5 class="margin-t-none"><?php echo esc_html( $blog_toolbar_label_search ); ?></h5>
		<?php get_search_form(); ?>
	</div>
</div>
<?php endif; ?>