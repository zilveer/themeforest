<?php
//The Query
global $wp_query;
$arrgs = $wp_query->query_vars;
$arrgs['posts_per_page'] = ct_get_option("posts_index_per_page", 3);
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$arrgs['paged'] = $paged;
$wp_query->query($arrgs);
?>

<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
		<?php $format = get_post_format();
			$format = $format ? $format : 'standard';
			$class = $format == 'standard' ? 'blogItem post format-type-image' : 'blogItem post format-type-' . $format;
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>
		    <?php get_template_part('templates/post/content-' . $format);?>
		</article>
	<?php endwhile; ?>

	<?php if (isset($wp_query) && $wp_query->max_num_pages > 1) : ?>
		<nav class="pager">
			<?php if ($paged != 1): ?>
	            <a href="<?php echo get_previous_posts_page_link();?>" class="prev"><?php echo __("Prev", "ct_theme") ?></a>
			<?php endif;?>
            <ul>
            </ul>
			<?php if ($paged != $wp_query->max_num_pages): ?>
                <a href="<?php echo get_next_posts_page_link() ?>" class="next"><?php echo __("Next", "ct_theme") ?></a>
            <?php endif; ?>
        </nav>
		<?php if (false): ?><?php posts_nav_link(); ?><?php endif; ?>
	<?php endif; ?>


<?php else: ?>
<div class="inner">
		<h2>
			<?php _e('No search results found', 'ct_theme'); ?>
        </h2>
</div>
<?php endif; ?>