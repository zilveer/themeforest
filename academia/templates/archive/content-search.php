<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 10/29/2015
 * Time: 5:06 PM
 */
global $post;
$class = array();
$class[]= "clearfix";
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>
	<?php
	$size = 'post-search';
	$thumbnail = g5plus_post_thumbnail($size);
	if (!empty($thumbnail)) : ?>
		<div class="entry-thumbnail-wrap">
			<?php echo wp_kses_post($thumbnail); ?>
		</div>
	<?php endif; if(empty($thumbnail)):?>
		<div class="no-image">
			<div class="no-image-inner">
				No Image                </div>
		</div>
	<?php endif;?>
	<div class="entry-content-wrap">
		<h3 class="entry-post-title p-font">
			<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
		</h3>
		<span class="entry-post-type s-font">

			<?php
				$post_type = '';
				switch ($post->post_type) {
					case 'post':
						$post_type = esc_html__('Blog post','g5plus-academia');
						break;
					case 'page':
						$post_type = esc_html__('Pages','g5plus-academia');
						break;
					case 'product':
						$post_type = esc_html__('Course','g5plus-academia');
						break;
					default:
						$post_type = $post->post_type;
						break;
				}
			echo esc_html($post_type);
			?>
		</span>
		<?php if (in_array($post->post_type, array('post','product'))) : ?>
			<div class="entry-excerpt">
				<?php the_excerpt(); ?>
			</div>
		<?php endif; ?>
	</div>
</article>