<?php while(have_posts()): the_post(); ?>
<article id="entry-<?php the_ID(); ?>" <?php post_class('entry fix'); ?>>	
	<?php if(get_post_format()) { get_template_part('_post-formats'); } ?>
	<div class="pad fix">	
	
		<header class="fix">
			<h1 class="entry-title">
				<?php the_title(); ?>
			</h1>
			<ul class="entry-meta fix">
				<?php if(!wpb_option('post-hide-date')): ?><li class="entry-date"><?php the_time('F jS, Y'); ?></li><?php endif; ?>
				<?php if(!wpb_option('post-hide-author')): ?><li class="entry-author"><?php the_author_posts_link(); ?></li><?php endif; ?>
				<?php if(!wpb_option('post-hide-comments')): ?><li class="entry-comments"><a href="<?php comments_link(); ?>"><?php comments_number( '0', '1', '%' ); ?></a></li><?php endif; ?>
			</ul>
		</header>
		<div class="clear"></div>
		
		<div class="text">
			<?php the_content(); ?>
			<?php wp_link_pages(array('before'=>'<div class="entry-page-links">'.__('Pages:','feather'),'after'=>'</div>')); ?>
			<div class="clear"></div>
		</div>
		
		<?php if(!wpb_option('post-hide-tags')): // Post Tags ?>
			<?php the_tags('<p class="entry-tags"><span>'.__('Tags:','feather').'</span> ','','</p>'); ?>
		<?php endif; ?>
		
		<?php if(!wpb_option('post-hide-categories')): // Post Categories ?>
			<p class="entry-category"><span><?php _e('Posted in:','feather'); ?></span> <?php the_category(' &middot; '); ?></p>
		<?php endif; ?>

		<?php if(wpb_option('post-enable-author-block')): // Post Author Block ?>
			<div class="entry-author-block fix">
				<div class="entry-author-avatar"><?php echo get_avatar(get_the_author_meta('user_email'),'80'); ?></div>
				<p class="entry-author-name"><?php the_author_meta('display_name'); ?></p>
				<p class="entry-author-description"><?php the_author_meta('description'); ?></p>
			</div>
		<?php endif; ?>
		
	</div><!--/entry content-->
</article>

<?php comments_template(); ?>

<?php endwhile;?>