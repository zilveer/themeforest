<?php global $enable_excerpts, $show_post_date, $show_date; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('media-block'); ?>>	
	<a href="<?php the_permalink(); ?>" class="simple-post-img-wrap">
		<?php if(has_post_thumbnail()): ?>
			<div class="image"><?php the_post_thumbnail( 'medium' ); ?></div>
		<?php else :?>
			<div class="image empty"></div>
		<?php endif; ?>
	</a>
	
	<div class="simple-post-txt-wrap">
		<a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
		<?php if($enable_excerpts): ?>
		<div class="excerpt">
			<?php 
			$excerpt = get_the_excerpt();
			$excerpt = substr(strip_tags($excerpt),0,60);
			echo $excerpt.'...';
			?>
		</div>
		<?php endif; ?>
	</div>
	<div class="clear"></div>
	<div class="splitter"></div>
</article>
