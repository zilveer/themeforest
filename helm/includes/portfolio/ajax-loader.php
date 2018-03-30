<?php
// Our include   
require_once( '../../../../../wp-load.php' );

// Our variables
$thepostID = (isset($_GET['thepostID'])) ? $_GET['thepostID'] : 0;
$page = (isset($_GET['pageNumber'])) ? $_GET['pageNumber'] : 0;


$custom = get_post_custom($thepostID);
$portfolio_cats = get_the_terms( $thepostID, 'types' );
$video_url="";
$thumbnail="";
$link_url="";
if ( $custom["video"][0]<>"") { $video_url=$custom["video"][0]; }
if ( $custom["thumbnail"][0]<>"" ) { $thumbnail=$custom["thumbnail"][0]; }
if ( isset($custom["custom_link"][0]) ) { $link_url=$custom["custom_link"][0]; }
$portfoliotype="view";
if ( $custom["video"][0]<>"" ) 	{ $portfoliotype="video"; }
if ( $custom["portfolio_videoembed"][0]<>"" ) 	{ $portfoliotype="portfolio_videoembed"; }
if ( $custom["custom_link"][0]<>"" ) { $portfoliotype="link"; }

$portfolio_page_header=$custom["portfolio_page_header"][0];

$portfolio_client=$custom["portfolio_client"][0];
$portfolio_projectlink=$custom["portfolio_projectlink"][0];

$description=$custom["description"][0];
	
?>
<div id="ajax-portfolio-content" class="clearfix">
	
	<div class="ajax-portfolio-data">
	
			<ul class="portfolio-metainfo">
				<?php if ($portfolio_client<>"") { ?>
				<li class="ajax-client"><?php echo $portfolio_client; ?></li>
				<?php } ?>
				<?php if ($portfolio_projectlink<>"") { ?>
				<li class="ajax-link"><a target="_blank" href="<?php echo $portfolio_projectlink; ?>"><?php _e('Project Link','mthemelocal'); ?></a></li>
				<?php } ?>
				<li class="ajax-type">
					<?php echo get_the_term_list( $thepostID, 'types', '', ' , ', '' ); ?>
				</li>
			</ul>

			<h1>
			<a href="<?php echo get_permalink($thepostID); ?>">
			<?php echo get_the_title($thepostID); ?>
			</a>
			</h1>
			<div class="ajax-portfolio-description entry-content">
			<?php echo $description; ?>
			</div>
					<div class="readmore readmore-align">
						<a href="<?php echo of_get_option('service_2_link'); ?>">
						<?php echo of_get_option('service_2_button_text'); ?>
						</a>
					</div>
	</div>

	<div class="ajax-portfolio-image-wrap">
	
	<?php 
	switch ($portfolio_page_header) {
		
		case "Slideshow" :
			global $thepostID;
			$flexi_slideshow = do_shortcode('[ajaxflexislideshow]');
			echo $flexi_slideshow;
			
		break;
		
		case "Image" :		
		echo display_post_image (
			$thepostID,
			$have_image_url=false,
			$link=false,
			$type="fullwidth",
			$post->post_title,
			$class=""
		);
		break;
		
		case "Video Embed" :	
		echo '<div class="ajax-video-wrapper">';
		echo '<div class="ajax-video-container">';
			echo $custom["portfolio_videoembed"][0];
		echo '</div>';
		echo '</div>';		
		break;
			
	}
	?>	

	</div>
</div>