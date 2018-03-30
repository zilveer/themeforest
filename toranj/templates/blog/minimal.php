<?php
/**
 *  minimal layout for the blog
 * 
 * @package toranj
 * @author owwwlab
 */
?>

<!-- Page main wrapper -->
<div id="main-content" class="dark-template blog-minimal">
	<div class="page-wrapper">

		<div class="container">

			<div class="page-title">
				<h1 class="title">
					<?php
					if( get_option('page_for_posts') ) {
						$blog_page_id = get_option('page_for_posts');
						echo get_the_title($blog_page_id);
					}else{
						_e('Journal <span>Our News & Ideas about Love</span>', 'toranj');
					}
					?>
				</h1>
			</div>
			<!-- /Page title -->

			<?php if ( is_category() ):?>
			<div class="filtered-list">
				<i class="fa fa-folder"></i>&nbsp;
				<?php printf( __( 'Category Archives for %s', 'toranj' ), single_cat_title( '', false ) );?>
			</div>
			<?php elseif ( is_tag() ): ?>
			<div class="filtered-list">
				<i class="fa fa-tag"></i>&nbsp;
				<?php printf( __( 'Tag Archives for %s', 'toranj' ), single_tag_title( '', false ) );?>
			</div>
			<?php elseif ( is_author() ): ?>
			<div class="filtered-list">
				<i class="fa fa-user"></i>&nbsp;
				<?php printf( __( 'All posts by %s', 'toranj' ), get_the_author() ); ?>
			</div>
			<?php elseif ( is_archive() ): ?>
			<div class="filtered-list">
				<i class="fa fa-clock-o"></i>&nbsp;
				<?php if ( is_day() ) {
					printf( __( 'Daily Archives for %s', 'toranj' ), get_the_date() );
				} elseif ( is_month() ) {
					printf( __( 'Monthly Archives for %s', 'toranj' ), get_the_date( _x( 'F Y', 'Monthly archives date format', 'toranj' ) ) );
				} elseif ( is_year() ) {
					printf( __( 'Yearly Archives for %s', 'toranj' ), get_the_date( _x( 'Y', 'Yearly archives date format', 'toranj' ) ) );
				} else {
					_e( 'Archives', 'toranj' );
				}?>
			</div>
			<?php endif; ?>
			
			<!-- Blog List -->
			<div id="blog-list">
				<?php if ( have_posts() ) : while( have_posts() ) : the_post(); ?>
						<!-- Post item -->
						<div class="post-item">
							<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
							<a href="<?php the_permalink(); ?>" class="post-thumb">
								<?php the_post_thumbnail('blog-minimal'); ?>	
							</a>
							<?php endif; ?>
							
							<div class="post-body">
								<span class="post-meta"><?php the_date(); ?></span>
								<h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<div class="post-content">
									<?php owl_shorten_excerpt(get_the_excerpt()); ?>
								</div>
							    <div class="post-sign">
							    	<?php _e('By','toranj') ?>
							    	<span class="author"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>"><?php the_author(); ?></a></span>
							    	<?php $category_list = get_the_category_list( ', ' );
							    	if ($category_list):
							    	?>
								    	<?php _e('in','toranj'); ?>
								    	<span class="category"><?php echo $category_list; ?></span>
							    	<?php endif; ?>
								</div>
							</div>

						</div>
						<!-- /Post item -->
					<?php endwhile; ?>
				<?php else : ?>
					<?php get_template_part( 'content', 'none' ); ?>
				<?php endif; ?>
			</div>
			<!-- /Blog List -->

			
			<?php owlab_blog_grid_paging_nav(); ?>

		</div>


	</div>
</div>
<!-- /Page main wrapper -->