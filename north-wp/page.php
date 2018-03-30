<?php get_header(); ?>
<?php 
 	if (is_page()) {
 		$id = $wp_query->get_queried_object_id();
		$page_padding = get_post_meta($id, 'page_padding', true);
 		$sidebar = get_post_meta($id, 'sidebar_set', true);
 		$sidebar_pos = get_post_meta($id, 'sidebar_position', true);
 		$snap_scroll = (get_post_meta($id, 'snap_scroll', true) !== 'on' ? false : 'snap_scroll');
 	}
?>

<?php if($snap_scroll || ( class_exists('woocommerce') && (is_account_page() || is_cart() || is_checkout()))) { ?>
	<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
		<?php the_content(); ?>
	<?php endwhile; else : endif; ?>
<?php } else if ($post->post_content != "") { ?>
	<?php if($page_padding !== 'off') { ?><div class="page-padding"><?php } ?>
		<?php if ($sidebar) { ?>
		<div class="row max_width">
			<div class="small-12 large-9 columns <?php if ($sidebar && ($sidebar_pos == 'left'))  { echo 'large-push-3'; } ?>">
		<?php } ?>
			  <?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
				  <article <?php post_class('post'); ?> id="post-<?php the_ID(); ?>">
				    <div class="post-content">
				    	<?php the_content('Read More'); ?>
				    </div>
				  </article>
			  <?php endwhile; else : endif; ?>
		<?php if ($sidebar) { ?>
			</div>
			<?php get_sidebar('page'); ?>
		</div>
		<?php } ?>
		
	<?php if($page_padding !== 'off') { ?></div><?php } ?>
<?php } ?>
<?php get_footer(); ?>