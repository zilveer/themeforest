<?php if( !empty($work_featured_image) ) : ?>
	<a href="<?php the_permalink(); ?>" class="item-thumb" title="<?php echo get_the_title(); ?>">
		<span class="thb-overlay"></span>
		<img src="<?php echo $work_featured_image; ?>" alt="">
	</a>
<?php endif; ?>

<article class="data">
	<header>
		<h1>
			<a href="<?php the_permalink(); ?>" rel="permalink">
				<?php the_title(); ?>
			</a>
		</h1>
	</header>
</article>