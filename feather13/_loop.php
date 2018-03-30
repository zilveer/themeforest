<?php $content = wpb_content_format(); // Set content format ?>

<?php while(have_posts()): the_post(); ?>
<article id="entry-<?php the_ID(); ?>" <?php post_class('entry fix'); ?>>
	<?php if((wpb_option('blog-format') == '1') && get_post_format()) { get_template_part('_post-formats'); } ?>
	<div class="pad fix">	
	
		<?php if((wpb_option('blog-format') == '2') && has_post_thumbnail()): ?>
		<div class="entry-thumbnail">
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php the_post_thumbnail('post-thumbnail'); ?>
				<span class="glass"></span>
				<?php if(has_post_format('video') || has_post_format('audio')) : ?>
				<span class="play"></span>
				<?php endif; ?>
			</a>	
		</div><!--/entry-thumbnail-->
		
		<div class="entry-part">
		<?php endif; ?>
		
			<header class="fix">
				<h2 class="entry-title">
					<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
				</h2>
				<ul class="entry-meta fix">
					<?php if(!wpb_option('post-hide-date')): ?><li class="entry-date"><?php the_time('F jS, Y'); ?></li><?php endif; ?>
					<?php if(!wpb_option('post-hide-author')): ?><li class="entry-author"><?php the_author_posts_link(); ?></li><?php endif; ?>
					<?php if(!wpb_option('post-hide-comments')): ?><li class="entry-comments"><a href="<?php comments_link(); ?>"><?php comments_number( '0', '1', '%' ); ?></a></li><?php endif; ?>
				</ul>
			</header>
			
			<div class="text">
				<?php if('content'===$content) { the_content(); } ?>
				<?php if('excerpt'===$content) {the_excerpt(); } ?>

				<?php if(('excerpt'===$content) && wpb_option('excerpt-more-link-enable')): ?>
					<?php $read_more = wpb_option('read-more')?wpb_option('read-more'):__('(more...)','feather'); ?>
					<p><a class="more-link" href="<?php the_permalink(); ?>"><?php echo $read_more; ?></a></p>
				<?php endif; ?>
				<div class="clear"></div>
			</div>	
		
		<?php if((wpb_option('blog-format') == '2') && has_post_thumbnail()): ?>
		</div><!--/entry-part-->
		<?php endif; ?>
		
	</div><!--/entry content-->
</article>
<?php endwhile;?>

<?php get_template_part('_nav-posts'); ?>