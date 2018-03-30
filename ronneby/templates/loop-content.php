<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $dfd_ronneby;
?>
<article <?php post_class(); ?>>

	<div class="clearfix">
		<div class="entry-meta-wrap">
			<?php if (isset($dfd_ronneby['post_header']) && $dfd_ronneby['post_header']) : ?>
				<?php if(!has_post_format('quote')) : ?>
					<div class="dfd-blog-title">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</div>
					<?php get_template_part('templates/entry-meta', 'post-bottom'); ?>
				<?php endif; ?>
			<?php endif; ?>
		</div>
	</div>
    <div class="entry-media">
	<?php
		switch(true) {
			case has_post_format('video'):
				get_template_part('templates/post', 'video');
				break;
			case has_post_format('audio'):
				get_template_part('templates/post', 'audio');
				break;
			case has_post_format('gallery'):
				get_template_part('templates/post', 'gallery');
				break;
			case has_post_format('quote'):
				get_template_part('templates/post', 'quote');
				break;
			default:
				get_template_part('templates/thumbnail/post');
		}
	?>
    </div>
    <?php if(!has_post_format('quote')) : ?>
		<div class="clearfix">
			<div class="entry-content">
				<?php $dfd_post_content = get_the_excerpt(); ?>
				<?php echo !empty($dfd_post_content) ? '<p>'.$dfd_post_content.'</p>' : ''; ?>
				<?php $read_more_style = (isset($dfd_ronneby['style_hover_read_more']) && !empty($dfd_ronneby['style_hover_read_more'])) ? $dfd_ronneby['style_hover_read_more'] : 'chaffle'; ?>
				<a href="<?php echo the_permalink(); ?>" title="<?php the_title(); ?>" class="more-button <?php echo esc_attr($read_more_style); ?> left" data-lang="en"><?php _e('Continue', 'dfd'); ?></a>
				<div class="entry-meta right">
					<?php get_template_part('templates/entry-meta/mini', 'comments'); ?>
				</div>
			</div>
		</div>
	<?php endif; ?>

</article>