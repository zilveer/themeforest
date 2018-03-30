<?php
/**
 * The template for displaying a single project custom post type.
 *
 * @package WordPress
 * @subpackage Theme
 * @since 1.0
 */
?>
<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php get_header(); ?>

<?php while ($content->looping() ) : ?>
<?php $meta =& $t->content->meta(); ?>
<?php $t->get_template_part("common","layout-start"); ?>



<!--project content-->
<div class="row-fluid project pe-block pe-container pe-portfolio-scroller-item">
		
	<div class="row-fluid">	
		<div class="span12 media">
			<?php $h = $t->media->h(460); ?>
			<?php if ($content->media() === "image"): ?>
			<?php $content->img(940,460); ?>
			<?php endif; ?>
			<?php $h->restore(); ?>
		</div>
	</div>
	<div class="page-title row-fluid">
		<div class="pe-container">
			<h2><?php $content->title(); ?></h2>
		</div>
	</div>
	
	<div class="row-fluid">	
		<div class="span12 project-description pe-wp-default">
			<?php $content->content(); ?>
		</div>		
	</div>

</div>

<!-- single project page nav -->
<div class="row-fluid">
	<div class="project-nav">

		<?php $prev = $content->prevPostLink(); ?>
		<?php $next = $content->nextPostLink(); ?>

		<a href="<?php echo $prev ? $prev : "#"; ?>" class="prev-btn <?php echo $prev ? "" : "disabled"; ?>"><i class="icon-left-open"></i></a>
		<a href="<?php echo $next ? $next : "#"; ?>" class="next-btn <?php echo $next ? "" : "disabled"; ?>"><i class="icon-right-open"></i></a>
	</div>
</div>

<div class="row-fluid">
	<div class="span12">
		<?php $t->get_template_part("common","sharebuttons"); ?>
		
	</div>
</div>


<div class="row-fluid related">
	<div class="pe-block pe-container">
		<?php $content->related("project","prj-category",12); ?>
	</div>
</div>
<?php comments_template(); ?>

<?php $t->get_template_part("common","layout-end"); ?>
<?php endwhile; ?>

<?php get_footer(); ?>
