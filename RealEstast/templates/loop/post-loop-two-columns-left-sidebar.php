<div class="col-md-8 col-sm-8 col-md-push-4 col-sm-push-4">
	<div class="blog_list row">
	<?php $i=1; while( have_posts() ) { the_post(); ?>
		<div class="col-md-6 col-sm-6 a-post">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<a href="<?php the_permalink(); ?>">
						<?php PGL_Template_Tag::the_post_thumbnail(get_the_ID(), 'blog-list-fullwidth-2col');?>
					</a>
					<h3 class="title entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
					<div class="description">
						<div class="date">
							<a href="<?php the_permalink(); ?>"><?php the_date(); ?></a>
							<?php _e( 'by', PGL ); ?>
							<?php the_author_posts_link(); ?>
							<?php _e( 'with', PGL ); ?>
							<a href="<?php comments_link() ?>" title="">
								<?php comments_number( __( 'no comment', PGL ), __( '1 comment', PGL ) ); ?>
							</a>
						</div>
						<div class="excerpt">
							<?php the_excerpt() ?>
						</div>
					</div>
				</header>
			</article>
		</div>
		<?php if(($i%2==0)&&$i>1):?>
			<div class="clearfix hidden-xs"></div>
		<?php endif; $i++;?>
	<?php
	}
	?>
	</div>
	<?php get_template_part( 'templates/loop/paginations' ) ?>
</div>
<div class="col-md-4 col-sm-4 col-md-pull-8 col-sm-pull-8">
<?php get_sidebar(); ?>
</div>