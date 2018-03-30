<?php
/**
 * @package berg-wp
 */
global $pageId;
if (YSettings::g('blog_show_date', $pageId) == 1 || YSettings::g('blog_show_comments', $pageId) == 1 || YSettings::g('blog_show_share', $pageId) == 1) {
	$marginLeft = '';
} else {
	$marginLeft = 'margin-left: 30px';
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(array('post', 'load-post')); ?>>
	
	<?php if ( has_post_thumbnail() ) : ?>
			<?php
			$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'blog_thumb2');
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
		<?php endif;?>
	<?php endif;?>
	<?php if (YSettings::g('blog_show_date', $pageId) == 1 || YSettings::g('blog_show_comments', $pageId) == 1 || YSettings::g('blog_show_share', $pageId) == 1) : ?>
	<div class="post-details">
		<?php if (YSettings::g('blog_show_date', $pageId) == 1): ?>
		<div class="post-date">
			<div class="date">
				<div class="month"><?php echo get_the_date('M'); ;?></div>
				<div class="day header-font-family"><?php echo get_the_date('d'); ;?></div>
			</div>
		</div>
		<?php endif; ?>
		<?php if (YSettings::g('blog_show_share', $pageId) == 1): ?>
		<div class="post-share">
			<a href="#"><i class="icon-share"></i></a>
			
		</div>
		<?php endif; ?>
		<?php if (YSettings::g('blog_show_comments', $pageId) == 1): ?>
		<div class="post-comment">
			<a href="<?php echo esc_url(get_comments_link()) ;?>" title=""><i class="icon-bubble"></i><span class="comments-number"><?php echo get_comments_number() ;?></span></a>
		</div>
		<?php endif; ?>
	</div>
	<?php if (YSettings::g('blog_show_share', $pageId) == 1): ?>
		<?php 
			get_template_part('social', 'share'); 
		; ?>
	<?php endif; ?>
	<?php endif; ?>
	<div class="post-content" style="<?php echo $marginLeft ;?>">
		<div class="blog-header">
			<?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
			
		</div>
		<div class="blog-details">
			<?php echo get_post_details('', 'blog', $pageId); ?>
		</div>	
		<?php if (YSettings::g('blog_show_excerpt', $pageId) == 1 && (YSettings::g('blog_excerpt_length', $pageId) != '' && YSettings::g('blog_excerpt_length', $pageId) != '0')) {
			echo '<div class="content">';
			the_excerpt(); 
			echo '</div>';
		}; ?>
		<?php if(YSettings::g('blog_show_btn', $pageId) == 1) :?>
		<div class="blog-button">
			<a href="<?php echo esc_url(get_permalink());?>" class="btn btn-dark-o btn-sm"><?php echo __('Read more', 'BERG');?></a>
		</div> 
		<?php endif ;?>
	</div>
</article>