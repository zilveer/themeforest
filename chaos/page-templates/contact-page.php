<?php
/**
 * Template Name: Contact Template
 *
 * Description: A page template that provides a key component of WordPress as a CMS
 * by meeting the need for a carefully crafted introductory page. The front page template
 * in Road Themes consists of a page content area for adding text, images, video --
 * anything you'd like -- followed by front-page-only widgets in one or two columns.
 *
 * @package WordPress
 * @subpackage Road_Themes
 * @since Road Themes 1.0
 */

global $road_opt;

get_header();
?>
<?php

if($road_opt['enable_map']) :
	//Add google map API
	wp_enqueue_script( 'gmap-api-js', 'http://maps.google.com/maps/api/js?sensor=false' , array(), '3', false );
	// Add jquery.gmap.js file
	wp_enqueue_script( 'jquery.gmap-js', get_template_directory_uri() . '/js/jquery.gmap.js', array(), '2.1.5', false );

	$map_desc = str_replace(array("\r\n", "\r", "\n"), "<br />", $road_opt['map_desc']);
	$map_desc = addslashes($map_desc);
?>
	<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery('#map').gMap({
				scrollwheel: false,
				zoom: <?php echo esc_js($road_opt['map_zoom']);?>,
				<?php if($road_opt['address_by']=='address') : ?>
				address: "<?php echo  esc_js($road_opt['map_address']);?>",
				<?php endif; ?>
				markers:[
					<?php if($road_opt['address_by']=='coordinate') : ?>
					{
						latitude: <?php echo  esc_js($road_opt['map_lat']);?>,
						longitude: <?php echo  esc_js($road_opt['map_long']);?>,
						html: '<?php echo wp_kses($map_desc, array(
										'a' => array(
											'href' => array(),
											'title' => array()
										),
										'i' => array(
											'class' => array()
										),
										'img' => array(
											'src' => array(),
											'alt' => array()
										),
										'br' => array(),
										'em' => array(),
										'strong' => array(),
										'p' => array(),
									)); ?>',
						icon: {
							<?php if($road_opt['map_marker']['url']!='') : ?>
							image: "<?php echo esc_js($road_opt['map_marker']['url']); ?>",
							<?php else : ?>
							image: "<?php echo get_template_directory_uri() . '/images/marker.png'; ?>",
							<?php endif; ?>
							iconsize: [32, 47],
							iconanchor: [32,47]
						},
						popup: true
					}
					<?php else : ?>
					{
						address: "<?php echo  esc_js($road_opt['map_address']);?>",
						html: '<?php echo wp_kses($map_desc, array(
										'a' => array(
											'href' => array(),
											'title' => array()
										),
										'i' => array(
											'class' => array()
										),
										'img' => array(
											'src' => array(),
											'alt' => array()
										),
										'br' => array(),
										'em' => array(),
										'strong' => array(),
										'p' => array(),
									)); ?>',
						icon: {
							<?php if($road_opt['map_marker']['url']!='') : ?>
							image: "<?php echo esc_js($road_opt['map_marker']['url']); ?>",
							<?php else : ?>
							image: "<?php echo get_template_directory_uri() . '/images/marker.png'; ?>",
							<?php endif; ?>
							iconsize: [32, 47],
							iconanchor: [32,47]
						},
						popup: true
					}
					<?php endif; ?>
				]
			});
		});
	</script>	
<?php endif; ?>
<div class="main-container contact-wrapper with-sidebar">
	<header class="entry-header">
		<div class="container">
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</div>
	</header>
	<?php if($road_opt['enable_map']) : ?>
		<div class="map-wrapper">
			<div class="container">
				<div id="map"></div>
			</div>
		</div>
	<?php endif; ?>
	<div class="contact-fom-info">
		<div class="container">
			<div class="row">
				
				<div class="col-xs-12">
					<div class="page-content contact-page">

						<?php while ( have_posts() ) : the_post(); ?>
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								
								<div class="entry-content">
									<?php the_content(); ?>
									<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'roadthemes' ), 'after' => '</div>' ) ); ?>
								</div><!-- .entry-content -->
								<footer class="entry-meta">
									<?php edit_post_link( __( 'Edit', 'roadthemes' ), '<span class="edit-link">', '</span>' ); ?>
								</footer><!-- .entry-meta -->
							</article><!-- #post -->
						<?php endwhile; // end of the loop. ?>
					</div>
				</div>
				
			</div>
			
		</div>
	</div>
</div>
<?php get_footer(); ?>