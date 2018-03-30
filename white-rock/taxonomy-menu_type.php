<?php
/**
 * @package progression
 * @since progression 1.0
 */

get_header(); ?>


		<div id="page-title">
			<div class="width-container paged-title">
				<?php $page_for_posts = get_option('page_for_posts'); ?>
				<h1 class="page-title"><?php
							printf( __( '%s', 'progression' ), '<span>' . single_cat_title( '', false ) . '</span>' );
						?></h1>
			</div>
		<div id="page-title-divider"></div>
		</div><!-- #page-title -->
		<div class="clearfix"></div>
		<?php if(has_post_thumbnail($page_for_posts)): ?>
			<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($page_for_posts), 'progression-page-title'); ?>
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
	
	
<?php if ( have_posts() ) : ?>
	
	<div class="menu-description"><?php echo category_description( ); ?></div>
	
	
	
	<?php
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	query_posts($query_string .'&posts_per_page=-1&paged=' . $paged);
	
	$count = 1;
	$count_2 = 1;
	
	?>


	<?php while ( have_posts() ) : the_post();
	if($count >= 4) { $count = 1; }
	 ?>
	
	
	
	<div class="grid3column <?php if($count == 3): echo ' lastcolumn'; endif; ?>">
		<div class="menu-item-container">
			<a href="<?php the_permalink(); ?>"> 
				<div class="grid3column noborder menu-wine-spacing">
						<?php if(has_post_thumbnail()): ?><?php the_post_thumbnail('progression-menu-tall'); ?><?php endif; ?>
				</div>
				<div class="grid3columnbig lastcolumn">
					<div class="content-padding-menu">
					<h5 class="menu-item-header-wine"><?php the_title(); ?></h5>
					<p><?php echo get_the_excerpt(); ?></p>
					</div>
				</div>
			<div class="clearfix"></div>
			</a>
		</div><!-- .menu-item-container -->
	</div>	
	<?php if($count == 3): ?><div class="wine-feature-box"></div><div class="clearfix"></div><?php endif; ?>
	<?php $count ++; $count_2++; endwhile; ?>
	
	
	
	
	<div class="clearfix"></div>
	<?php kriesi_pagination($pages = '', $range = 2); ?>
	<!--div><?php posts_nav_link(); // default tag ?></div-->

<?php elseif ( current_user_can( 'edit_posts' ) ) : ?>

	<?php get_template_part( 'no-results', 'index' ); ?>

<?php endif; ?>


<div class="clearfix"></div>

<?php get_footer(); ?>