<?php
/**
 * Shows related projects
 *
 * @package WordPress
 * @subpackage Theme
 * @since 1.0
 */
?>
<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>

<div class="row-fluid">
	<div class="span12">
		<h3><?php _e("RELATED WORK",'Pixelentity Theme/Plugin'); ?></h3>
	</div>
	<div class="carousel-nav">
		<a href="#" class="prev-btn"><i class="icon-left-open"></i></a>
		<a href="#" class="next-btn"><i class="icon-right-open"></i></a>
	</div>
</div>


<div class="row-fluid carouselBox" data-slidewidth="240">
	<?php while ($content->looping()): ?>
	<?php $link = get_permalink(); ?>
	<div>                    
		<div>
			<div class="project-item">
				<a class="over-effect" href="<?php echo $link ?>">
					<?php $content->img(420,372); ?>
				</a>
				<h6><a href="<?php echo $link ?>"><?php $content->title(); ?></a></h6>
				<p><?php echo $t->utils->truncateString(get_the_excerpt(),20); ?></p>
			</div>
		</div>  
	</div>
	<?php endwhile; ?>
</div>



