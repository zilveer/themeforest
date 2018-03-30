<?php
// Template Name: Portfolio 3 Column w/Sidebar
/**
 *
 * @package progression
 * @since progression 1.0
 */

get_header(); ?>

		<?php
		global $wp_query;
		$thePostID = $wp_query->post->ID;
		?>
		<div id="page-title">
			<div class="width-container paged-title">
				<h1><?php the_title(); ?></h1>	
			</div>
		<div id="page-title-divider"></div>
		</div><!-- #page-title -->
		<div class="clearfix"></div>
		<?php if(has_post_thumbnail()): ?>
			<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'progression-page-title'); ?>
			<script type='text/javascript'>
			jQuery(document).ready(function($) {  
			    $("#page-title").backstretch([
					"<?php echo $image[0]; ?>"
					<?php if( class_exists( 'kdMultipleFeaturedImages' ) ) {
						if( kd_mfi_get_featured_image_url( 'featured-image-2', 'page', 'progression-page-title', $thePostID ) != "" ) {
						    echo ',"', kd_mfi_get_featured_image_url( 'featured-image-2', 'page', 'progression-page-title', $thePostID ) , '"';
						}

						if( kd_mfi_get_featured_image_url( 'featured-image-3', 'page', 'progression-page-title', $thePostID ) != "" ) {
						    echo ',"', kd_mfi_get_featured_image_url( 'featured-image-3', 'page', 'progression-page-title', $thePostID ) , '"';
						}
					}
			 		?>
				],{
			            fade: 750,
			            duration: <?php echo of_get_option('slider_autoplay', 8000); ?>
			     });
			});
			</script>
		<?php endif; ?>

<div id="main" class="site-main">
	<div class="width-container">

<div id="container-sidebar"><!-- sidebar content container -->

<?php get_template_part( 'child-page', 'navigation' ); ?>

<?php while(have_posts()): the_post(); ?>
	<?php the_content(); ?>
	<div class="clearfix"></div>
<?php endwhile; ?>


<div id="portfolio-post-container">
<?php
$port_number_posts = of_get_option('portfolio_page_posts',6);
$portfolio_type = get_the_term_list( $post->ID, 'portfolio_type' );
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$portfolioloop = new WP_Query(array(
	'posts_per_page' => $port_number_posts,
    'paged'          => $paged,
    'post_type'      => 'portfolio',
    'tax_query'      => array(
        // Note: tax_query expects an array of arrays!
        array(
            'taxonomy' => 'portfolio_type', // my guess
            'field'    => 'name',
            'terms'    => $portfolio_type
        )
    ),
));

$count = 1;
$count_2 = 1;

?>

<?php if ( have_posts() ) : while ( $portfolioloop->have_posts() ) : $portfolioloop->the_post();
if($count >= 4) { $count = 1; }
 ?>
	
	<div class="grid3column <?php if($count == 3): echo ' lastcolumn'; endif; ?>">
		<?php get_template_part( 'content', 'portfolio' ); ?>
	</div>

<?php if($count == 3): ?><div class="clearfix"></div><?php endif; ?>

<?php $count ++; $count_2++; endwhile; ?>
<div class="clearfix"></div>
</div><!-- close #portfolio-post-container -->

<div class="clearfix"></div>
<?php kriesi_pagination($portfolioloop->max_num_pages, $range = 2); ?>

<?php endif; ?>

<?php if(of_get_option('page_comments_default', '0')): ?><?php comments_template( '', true ); ?><?php endif; ?>

<div class="clearfix"></div>
</div><!-- close #container-sidebar -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>