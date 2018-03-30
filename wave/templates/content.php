<?php 
	
	global $dd_sn;
	global $dd_post_class;
	global $dd_thumb_size;

	if ( ! isset( $dd_post_class ) )
		$dd_post_class = 'one-third column ';

	if ( ! isset( $dd_thumb_size ) )
		$dd_thumb_size = 'dd-one-third';	

	if ( has_post_thumbnail() )
		$dd_post_class_append = 'has-thumb ';
	else
		$dd_post_class_append = '';

?>

<?php if ( is_single() ) : ?>
		
	<div class="blog-post-single <?php echo $dd_post_class_append; ?>">
		
		<?php if ( has_post_thumbnail() ) : ?>

			<div class="blog-post-single-thumb">

				<?php the_post_thumbnail( 'dd-full' ); ?>

			</div><!-- .blog-post-thumb -->

		<?php endif; ?>

		<div class="blog-post-single-main">

			<h1 class="blog-post-single-title"><?php the_title(); ?></h1>

			<div class="blog-post-meta clearfix">

				<ul>
					<li class="blog-post-author">
						<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
							<span class="blog-post-author-avatar"><?php echo get_avatar( get_the_author_meta( 'user_email' ), 33 ); ?></span>
							<?php echo get_the_author(); ?>
						</a>
					</li>
					<li class="blog-post-date"><span class="icon-calendar"></span><a href="<?php echo get_day_link( get_the_time( 'Y' ), get_the_time( 'm' ), get_the_time( 'd' ) ); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a></li>
					<?php if ( has_tag() ) : ?>
						<li class="blog-post-tags"><span class="icon-tag"></span><?php the_tags(''); ?></li>
					<?php endif; ?>
				</ul>

			</div><!-- .blog-post-meta -->

			<div class="blog-post-content">

				<?php the_content(); ?>

			</div><!-- .blog-post-content -->

		</div><!-- .blog-post-single-main -->

	</div><!-- .blog-post-single -->

<?php else : ?>

	<div class="blog-post <?php echo $dd_post_class.$dd_post_class_append; ?>">

		<div class="blog-post-inner">

			<?php if ( has_post_thumbnail() ) : ?>

				<div class="blog-post-thumb">
					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( $dd_thumb_size ); ?></a>
				</div><!-- .blog-post-thumb -->

			<?php endif; ?>

			<div class="blog-post-main">

				<h2 class="blog-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

				<div class="blog-post-meta clearfix">

					<ul>
						<li class="blog-post-author">
							<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
								<span class="blog-post-author-avatar"><?php echo get_avatar( get_the_author_meta( 'user_email' ), 33 ); ?></span>
								<?php echo get_the_author(); ?>
							</a>
						</li>
						<li class="blog-post-date"><span class="icon-calendar"></span><a href="<?php echo get_day_link( get_the_time( 'Y' ), get_the_time( 'm' ), get_the_time( 'd' ) ); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a></li>
					</ul>

				</div><!-- .blog-post-meta -->

				<div class="blog-post-excerpt">

					<?php the_excerpt(); ?>

				</div><!-- .blog-post-excerpt -->

				<div class="blog-post-permalink">
					<a href="<?php the_permalink(); ?>" class="button"><?php _e( 'CONTINUE READING', 'dd_string' ); ?></a>
				</div>

			</div><!-- .blog-post-main -->

		</div><!-- .blog-post-inner -->

	</div><!-- .blog-post -->

<?php endif; ?>