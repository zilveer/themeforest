<?php
/**
 * @package berg-wp
 */
$categories = '';

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(array('post', 'load-post')); ?>>
	<a href="<?php echo esc_url(get_permalink());?>" class="img-post unveil">
		<figure>
			<?php 
				$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'blog_thumb');
				$image = $image[0];
			?>
			<img src="<?php echo THEME_DIR_URI;?>/img/placeholder2.png" data-src="<?php echo $image; ?>" alt=""/>
			
			<div class="actions">
				<i class="icon-magnifier-add"></i>
			</div>
		</figure>
	</a>
	<div class="post-content">
		<div class="post-wrapper">
			<div class="post-wrapper-inner"> 
				<?php if (YSettings::g('blog_show_date', 1) == 1) : ?>
				<span class="date">
					<?php berg_wp_posted_on(); ?>
				</span>
				<?php endif; ?>

				<?php the_title(sprintf('<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h3>'); ?>
				<ul class="post_details">
					<?php if (is_sticky()) : ?>
					<li><span class="highlight highlight-color"><i class="icon-pin"></i> <strong><?php echo __( 'Sticky', 'BERG') ;?></strong></span></li>
					<?php endif ;?>
					<li><span><?php echo __('by', 'BERG') ;?></span> <a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )) ;?>"><?php echo get_the_author() ;?></a> 
					<?php 	foreach (get_the_category() as $category) {
							$categories .= '<li><a href="'.esc_url(get_category_link($category->term_id)).'" title="'.$category->name.'">'.$category->name.'</a></li>';
						}	
					?>	
					<span><?php echo __('in', 'BERG') ;?></span> <ul><?php echo $categories ;?></ul></li>
				</ul>
				<div class="content">
					<?php the_excerpt(); ?>
				</div>
				<div class="blog-button hidden-md">
					<a href="<?php echo esc_url(get_permalink());?>" class="btn btn-dark-o btn-sm"><?php _e('Read more', 'BERG'); ?></a>
				</div> 
			</div>
		</div>
	</div>
</article>
