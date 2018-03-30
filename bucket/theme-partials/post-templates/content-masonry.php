<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 */
?>
<article <?php post_class('article  article--grid'); ?>>
	<?php get_template_part('theme-partials/post-templates/header-blog', get_post_format()); ?>
    <div class="article--grid__body">
        <div class="article__content">
            <?php echo wpgrade_better_excerpt(); ?>
        </div>
    </div>
    <div class="article__meta  article--grid__meta">
        <div class="split">
            <div class="split__title  article__category">
                <?php
                    $categories = get_the_category();
                    if ($categories) {
                        $category = $categories[0];
                        echo '<a class="small-link" href="'. get_category_link($category->term_id) .'" title="'. esc_attr(sprintf(__("View all posts in %s", 'bucket'), $category->name)) .'">'. $category->cat_name.'</a>';
                    }
                ?>
            </div>
			<ul class="nav  article__meta-links">
				<li class="xpost_date"><i class="icon-time"></i> <?php the_time('j M') ?></li>
				<?php if ( comments_open() ): ?>
					<li class="xpost_comments"><i class="icon-comment"></i>  <?php comments_number('0', '1', '%'); ?></li>
				<?php endif; ?>
				<?php if ( function_exists('get_pixlikes')) : ?>
					<li class="xpost_likes"><i class="icon-heart"></i> <?php echo get_pixlikes(wpgrade::lang_original_post_id(get_the_ID())); ?></li>
				<?php endif; ?>
			</ul>
        </div>
    </div>

</article><!-- .article -->