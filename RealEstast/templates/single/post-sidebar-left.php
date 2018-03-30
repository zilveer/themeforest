<div class="col-md-8 col-sm-8 col-md-push-4 col-sm-push-4 single-post">
	<?php while( have_posts() ) : the_post();?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<?php if ( ! post_password_required() ) : ?>
					<div class="entry-thumbnail">
						<?php PGL_Template_Tag::the_post_thumbnail(get_the_ID()); ?>
					</div>
				<?php endif; ?>
				<?php //the_post_thumbnail(PGL_Image::size('post-thumbnail')); ?>
				<h1 class="entry-title"><?php the_title(); ?></h1>
				<div class="description">
					<div class="date">
						<a href="<?php the_permalink();?>"><?php the_date();?></a>
						<?php _e('by', PGL);?>
						<?php the_author_posts_link();?>
						<?php _e('with', PGL);?>
						<a href="<?php comments_link() ?>" title="">
							<?php comments_number(__('no comment', PGL), __('1 comment', PGL)); ?>
						</a>
					</div>
				</div>
			</header>
			<div class="entry-content">
				<?php the_content(); ?>
				<?php wp_link_pages(); ?>
			</div>
		</article>
		<?php comments_template(); ?>
	<?php endwhile;?>
</div>
<div class="col-md-4 col-sm-4 col-md-pull-8 col-sm-pull-8">
	<?php get_sidebar() ?>
</div>