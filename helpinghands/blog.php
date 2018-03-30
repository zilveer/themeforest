<?php 
/**
 * Template name: Page: Blog
 *
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */

get_header();

global $sd_data;

$blog_layout = $sd_data['sd_blog_layout'];
$sidebar     = $sd_data['sd_sidebar_location'];
$pagination  = $sd_data['sd_pagination_type'];
$blog_prev   = $sd_data['sd_blog_prev'];
$blog_next   = $sd_data['sd_blog_next'];
$cats_id     = rwmb_meta( 'sd_blog_category_ids' );
$blog_cats   = ! empty( $cats_id  ) ? $cats_id  : '';
?>

<?php the_content(); ?>

<div class="sd-blog-page">
	<div class="container">
		<div class="row"> 
			<!--left col-->
			<div class="col-md-<?php if ( $blog_layout == '2' ) { echo '12'; } else { echo '8'; } ?> <?php if ( $sidebar  == '2' ) echo 'pull-right'; ?>">
				<div class="sd-left-col">
					<?php 
						global $more;
						$more = 0;
						$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
						
						$args = array(
							'cat'         => $blog_cats,
							'paged'       => $paged,
							'post_status' => 'publish'
						);

						$wp_query = new WP_Query( $args );
					?>
					
					<?php if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
						<?php get_template_part( 'framework/inc/post-formats/content', get_post_format() ); ?>
					<?php endwhile; else: ?>
						<p><?php _e( 'Sorry, no posts matched your criteria', 'sd-framework' ) ?>.</p>
					<?php 
						  endif;
						  wp_reset_postdata();
					?>
					<!--pagination-->
					<?php if ( $pagination == '1' ) : ?>
						<?php if ( get_previous_posts_link() ) : ?>
						<div class="sd-nav-previous">
							<?php previous_posts_link( $blog_prev ); ?>
						</div>
						<?php endif; ?>
						<?php if ( get_next_posts_link() ) : ?>
						<div class="sd-nav-next">
							<?php next_posts_link( $blog_next ); ?>
						</div>
						<?php endif; ?>
					<?php else : sd_custom_pagination(); endif; ?>
					<!--pagination end--> 
					<div class="clearfix"></div>
				</div>
			</div>
			<!--left col end--> 
			<?php if ( $blog_layout !== '2' ) : ?>
			<!--sidebar-->
			<div class="col-md-4">
				<?php get_sidebar(); ?>
			</div>
			<!--sidebar end--> 
			<?php endif; ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>