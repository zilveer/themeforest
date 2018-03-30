<?php
/**
 * @package berg-wp
 */

global $pageId;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(array('post', 'load-post')); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<?php
			$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'blog_thumb');
			$image = $image[0];
			if($image != '') :
		?>
		<a href="<?php echo esc_url(get_permalink());?>" class="img-post unveil">
			<figure>
				<img src="#" data-src="<?php echo $image; ?>" alt=""/>
				<div class="actions">
					<i class="icon-magnifier-add"></i>
				</div>
			</figure>
		</a>
		<?php endif ; ?>
	<?php endif;?>	
	<div class="post-content">
		<?php if (YSettings::g('blog_show_date', $pageId) == 1): ?>
		<span class="date">
			<?php berg_wp_posted_on(); ?>
		</span>
		<?php endif; ?>
		<?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
		<?php echo get_post_details('', 'blog', $pageId); ?>
		<?php if (YSettings::g('blog_show_excerpt', $pageId) == 1 && (YSettings::g('blog_excerpt_length', $pageId) != '' && YSettings::g('blog_excerpt_length', $pageId) != '0')) {
			echo '<div class="content">';
			the_excerpt(); 
			echo '</div>';
		}; ?>
		<?php if(YSettings::g('blog_show_btn', $pageId) == 1) :?>
		<div class="blog-button text-right">
			<a href="<?php echo esc_url(get_permalink());?>" class="btn btn-dark-o btn-sm"><?php echo __('Read more', 'BERG');?></a>
		</div> 
		<?php endif ;?>
	</div>
</article>