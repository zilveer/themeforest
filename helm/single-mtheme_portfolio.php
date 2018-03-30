<?php
/*
 Single Portfolio Page
*/
?>
<?php
wp_enqueue_script( 'flexislider', MTHEME_JS . '/flexislider/jquery.flexslider-min.js', array('jquery') , '',true );
wp_enqueue_style( 'flexislider_css', MTHEME_ROOT . '/css/flexislider/flexslider-page.css', false, 'screen' );
function flexislideshow_init() {
	?>
<!-- Flexi Slider init -->
<script type="text/javascript">
	jQuery(window).load(function() {
		jQuery('.flexslider').flexslider({
			animation: "slide",
			slideshow: true,
			pauseOnAction: true,
			pauseOnHover: false,
			controlsContainer: "flexslider-container-page"
		});
	});
</script>
	<?php
}
add_action('wp_footer', 'flexislideshow_init',20);
?>
<?php get_header(); ?>
<?php
/**
*  Portfolio Loop
 */
?>
<h1 class="entry-title"><?php the_title(); ?></h1>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

					
						
					
						<?php
						$width=FULLPAGE_WIDTH;
						$single_height='';
						
						$custom = get_post_custom($post->ID);
						
						$portfolio_page_header=$custom["portfolio_page_header"][0];
						$height=$custom["portfolio_slide_height"][0];
						$portfolio_videoembed=$custom["portfolio_videoembed"][0];
						$custom_link=$custom["custom_link"][0];
						$portfolio_style=$custom["portfolio_slide_style"][0];
						
						$portfolio_client=$custom["portfolio_client"][0];
						$portfolio_projectlink=$custom["portfolio_projectlink"][0];
						
						switch ($portfolio_page_header) {
						
							case "Slideshow" :

								$flexi_slideshow = do_shortcode('[flexislideshow imagesize="fullwidth"]');
								echo $flexi_slideshow;
								
							break;
							case "Image" :
								// Show Image									
								echo display_post_image (
									$post->ID,
									$have_image_url=false,
									$link=false,
									$type="fullwidth",
									$post->post_title,
									$class="portfolio-single-image" 
								);

							break;
							case "Video Embed" :
							echo '<div class="ajax-video-wrapper">';
							echo '<div class="ajax-video-container">';
								echo $portfolio_videoembed;
							echo '</div>';
							echo '</div>';
							break;
							
						}
								
								
						?>
						
		<div class="fullpage-contents-wrap">
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<h2 class="page-entry-title">
						<?php the_title(); ?>
						</h2>	
						<ul class="portfolio-metainfo">
							<?php if ($portfolio_client<>"") { ?>
							<li class="ajax-client"><?php echo $portfolio_client; ?></li>
							<?php } ?>
							<?php if ($portfolio_projectlink<>"") { ?>
							<li class="ajax-link"><a target="_blank" href="<?php echo $portfolio_projectlink; ?>">Project Link</a></li>
							<?php } ?>
							<li class="ajax-type">
								<?php echo get_the_term_list( $thepostID, 'types', '', ' , ', '' ); ?>
							</li>
						</ul>
						
						<div class="entry-content clearfix">
						<?php the_content(); ?>
					
						</div>
						
						
					</div>
							
<?php endwhile; // end of the loop. ?>



<?php
//for in the loop, display all "content", regardless of post_type,
//that have the same custom taxonomy (e.g. genre) terms as the current post
$portfolio_post_ID=$post->ID;
//$backup = $post;  // backup the current object
$found_none = '';
$portfolio_column_count=1;
$columns=4;
$taxonomy = 'types';//  e.g. post_tag, category, custom taxonomy
$param_type = 'types'; //  e.g. tag__in, category__in, but genre__in will NOT work
$post_types = get_post_types( array('public' => true), 'names' );
$tax_args=array('orderby' => 'none');

$tags = wp_get_post_terms( $post->ID , $taxonomy, $tax_args);

$first_tag 	= $tags[0]->term_id;
$second_tag = $tags[1]->term_id;
$third_tag 	= $tags[2]->term_id;

?>

<?php
if ($tags) {
  foreach ($tags as $tag) {
	//echo $tag->slug;


$args = array(
	'post_type' => get_post_type($post->ID),
	'posts_per_page' => 4,
	'tax_query' => array(
		'relation' => 'OR',
		array(
			'taxonomy' => $taxonomy,
			'terms' => $second_tag,
			'field' => 'id',
			'operator' => 'IN',
		),
		array(
			'taxonomy' => $taxonomy,
			'terms' => $first_tag,
			'field' => 'id',
			'operator' => 'IN',
		),
		array(
			'taxonomy' => $taxonomy,
			'terms' => $third_tag,
			'field' => 'id',
			'operator' => 'IN',
		)
	)
);
    $my_query = null;
    $my_query = new WP_Query($args);

    if( $my_query->have_posts() ) {
		?>
		<h3 class="related_posts_title">Related Projects</h3>

		<div class="portfolio-related-wrap clearfix">
			<ul class="portfolio-four">
		
		<?php
		while ($my_query->have_posts()) : $my_query->the_post();

		if ($portfolio_column_count>$columns) $portfolio_column_count=1;
		$custom = get_post_custom($thepostID);
		?>
		<li class="portfolio-col-<?php echo $portfolio_column_count++; ?>">
				<a class="portfolio-image-link portfolio-columns" href="<?php the_permalink(); ?>">
			<?php
			echo '<span class="column-portfolio-icon portfolio-image-icon"></span>';
				echo display_post_image (
					$post->ID,
					$have_image_url=false,
					$link=false,
					$type="portfolio-small",
					$post->post_title,
					$class="portfolio-related-image" 
				);
				
			?>
			</a>
			<div class="work-details">
				<h4><a href="<?php if ($link_url<>"") { echo $link_url; } else { the_permalink(); } ?>" rel="bookmark" title="<?php echo get_the_title(); ?>"><?php the_title(); ?></a></h4>
				<p class="entry-content work-description"><?php echo $custom["description"][0];?></p>
			</div>
			</li>

			<?php $found_none = '';
		endwhile;
    }
?>
	</ul>
</div>
<?php	
	break;

  }
}
wp_reset_query();
?>
</div>
<?php get_footer(); ?>