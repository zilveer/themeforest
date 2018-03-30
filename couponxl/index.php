<?php
/*
	DEFAULT BLOG LSITING WITH THE MASONRY
*/	
get_header();
global $wp_query;
$cur_page = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; //get curent page

$page_links_total =  $wp_query->max_num_pages;
$page_links = paginate_links( 
	array(
		'prev_next' => true,
		'end_size' => 2,
		'mid_size' => 2,
		'total' => $page_links_total,
		'current' => $cur_page,	
		'prev_next' => false,
		'type' => 'array'
	)
);

$pagination = couponxl_format_pagination( $page_links );
get_template_part( 'includes/title' );

?>
<section>
	<div class="container">
		<div class="row">
			<div class="col-md-<?php echo is_active_sidebar( 'sidebar-blog' ) ? '9' : '12' ?>">

				<?php
				if( have_posts() ){
					while( have_posts() ){
						the_post();
						$has_media = couponxl_has_media();
						?>
						<div <?php post_class( 'white-block'.( $has_media ? ' has-media' : '' ).''  ) ?>>							
							<?php if( $has_media ): ?>
								<div class="white-block-media">
								<?php
								if( is_sticky() ){
									?>
									<div class="sticky">
										<i class="fa fa-paperclip"></i>
									</div>
									<?php
								}									
								get_template_part( 'media/media', get_post_format() );
								?>
								</div>
							<?php endif; ?>
							<div class="white-block-content blog-item-content">
								<ul class="list-unstyled list-inline top-meta">
									<li><i class="fa fa-comment"></i><?php comments_number( '0', '1', '%' ); ?></li>
									<li><i class="fa fa-calendar-o"></i><?php the_time( get_option( 'date_format' ) ) ?></li>
								</ul>
								<a href="<?php the_permalink() ?>">
									<h2 class="blog-title"><?php the_title() ?></h2>
								</a>
								<?php the_excerpt() ?>
							</div>
							<div class="white-block-footer">
								<?php get_template_part( 'includes/share' )?>
								<a href="<?php the_permalink() ?>" class="btn"><?php _e( 'READ MORE', 'couponxl' ) ?></a>
							</div>
						</div>
						<?php
					}
				}
				?>

				<?php
				if( !empty( $pagination ) )	{
					?>
					<ul class="white-block pagination">
						<?php echo $pagination; ?>
					</ul>
					<?php
				}
				?>

			</div>

			<?php get_sidebar(); ?>

		</div>
	</div>
</section>

<?php get_footer(); ?>