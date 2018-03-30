<?php 
global $widget;

$hide_album = (bool)get_field('hide_album');
if(!$hide_album || !empty($widget)): ?>
<div id="post-<?php the_ID(); ?>" <?php post_class('media-block'); ?>>
	<?php if(get_field('alb_link_external')): ?>
	<a target="_blank" href="<?php echo esc_url(get_field('alb_link_external')); ?>">
	<?php else: ?>
	<a href="<?php the_permalink(); ?>">
	<?php endif; ?>
		<div class="holder">
			<div class="album-hover-wrap">
			<div class="image">
				<?php the_post_thumbnail('medium'); ?>
				<div class="album-hover">
					<div class="album-listen">
						<i class="fa fa-headphones"></i>
					</div>
					<div class="album-overlay"></div>
				</div>
			</div>
			<div class="text-box">
				<h2><?php the_title(); ?></h2>
			</div>
			</div>
		</div>
	</a>
</div>
<?php endif;?>
