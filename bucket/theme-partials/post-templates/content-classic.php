<?php
/**
 * Template to display the article in archives in a clasic way
 */
?>
<article <?php post_class('article  article--thumb media flush--bottom grid'); ?>>
	<div class="media__img--rev grid__item five-twelfths palm-one-whole">
		<?php
		if (has_post_thumbnail()):
			$image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'post-medium');
			$image_ratio = bucket::get_image_aspect_ratio( $image );
			?>
			<a href="<?php the_permalink(); ?>" class="image-wrap" style="padding-top: <?php echo $image_ratio; ?>%">
				<img src="<?php echo $image[0] ?>" alt="<?php the_title(); ?>"/>
			</a>
		<?php endif; ?>
		<?php post_format_icon();
			if ( bucket::has_average_score() ) { ?>
			<div class="badge  badge--article"><?php echo bucket::get_average_score();?> <span class="badge__text"><?php __('score', 'bucket') ?></span></div>
		<?php } ?>
	</div>
	<div class="media__body grid__item seven-twelfths palm-one-whole">
		<?php
		$categories = get_the_category();
		if ($categories) {
			echo '<div class="article__category">';
			foreach ($categories as $category):
	                    echo '<a class="small-link" href="'. get_category_link($category->term_id) .'" title="'. esc_attr(sprintf(__("View all posts in %s", 'bucket'), $category->name)) .'">'. $category->cat_name.'</a>';
            endforeach;
	        echo '</div>';
		} ?>
		<div class="article__title  article--thumb__title">
			<a href="<?php the_permalink(); ?>"><h3 class="hN"><?php the_title(); ?></h3></a>
		</div>
		<div class="article--grid__body">
	        <div class="article__content">
	            <?php echo wpgrade_better_excerpt(); ?>
	        </div>
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
</article>
<hr class="separator  separator--subsection">
