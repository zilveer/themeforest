<?php
/**
 * The default loop for displaying one or more posts single service custom post type.
 *
 * This is the loop that displays all posts by default, 
 * most custom post types have their dedicate loops: loop-$cpt.php
 *
 * @package WordPress
 * @subpackage Theme
 * @since 1.0
 */
?>
<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php list($conf) = $t->template->data(); ?>
<?php $settings = $conf->settings; ?>
<?php $w = $t->media->w; ?>
<?php $h = $t->media->h; ?>

<?php while ($content->looping() ) : ?>
<?php $link = $content->getLink(); ?>
<?php $is_single = $content->is_single();  ?>


<!--new post-->
<div class="row-fluid pe-portfolio-scroller-item pe-load-more-item">
	<div class="span12">
		<div <?php post_class($is_single ? "single post" : "post"); ?>>
			<!--post titles-->
			<div class="row-fluid">
				<div class="span12 post-title">
					<h2><a href="<?php echo $link; ?>"><?php $content->title(); ?></a></h2>
				</div>
			</div>
			<!--meta-->
			<div class="row-fluid">
				<div class="span12">
					<div class="comments">
						<a href="#" title="comments"><?php $content->comments(); ?></a>
						<i class="icon-comment"></i>
					</div>
					<div class="post-meta">
						<span class="user"><?php _e("By",'Pixelentity Theme/Plugin'); ?> <?php the_author_posts_link(); ?></span>
						<span class="date"><?php _e("Posted on",'Pixelentity Theme/Plugin'); ?> <a href="<?php echo $link; ?>"><?php $content->date(); ?></a></span>
						<span class="categories"><?php _e("in",'Pixelentity Theme/Plugin'); ?> <?php $content->category(); ?></span>
					</div>
				</div>
			</div>	
			
			<?php if ($settings->media && $content->hasMedia()): ?>
			<!--post image-->
			<div class="row-fluid">
				<div class="span12 post-image">
					<?php if ($content->media() === "image"): ?>
					<a href="<?php echo $link; ?>"><?php $content->img(940,460); ?></a>
					<?php endif; ?>
				</div>
			</div>
			<?php endif; ?>
			
			<div class="row-fluid">
				<div class="span12">
					<div class="pe-wp-default">
						<?php $content->content(); ?>
						<?php $content->linkPages(); ?>
						<?php if (has_tag()): ?>
						<div class="tags">
							<?php $content->tags(" "); ?>
						</div>
						<?php endif; ?>
					</div>

					<?php if ($is_single && !isset($_REQUEST["pe-no-sb"])): ?>
					<?php $t->get_template_part("common","sharebuttons"); ?>
					<?php endif; ?>
				</div>
			</div>
			
		</div>
		
	</div>
</div>
<!--end post-->
<?php endwhile; ?>

<?php if ($is_single): ?>
<?php $t->get_template_part("common","prevnext"); ?>
<?php comments_template(); ?>
<?php elseif ($settings->pager === "yes"): ?>
<?php $content->pager(); ?>
<?php endif; ?>