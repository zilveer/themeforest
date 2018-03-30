<?php
$showcase_autoplay = of_get_option ('featured_showcase_autoplay');
$showcase_thumbnail_position = of_get_option ('featured_showcase_thumbnail');
$showcase_height = of_get_option ('featured_showcase_height');
$showcase_arrows = of_get_option ('featured_showcase_arrows');
$showcase_title = of_get_option ('featured_showcase_title');
$showcase_desc = of_get_option ('featured_showcase_desc');
$showcase_transition = of_get_option ('featured_showcase_transition');
$showcase_transitionspeed = of_get_option ('featured_showcase_transitionspeed');
$showcase_transitiondelay = of_get_option ('featured_showcase_transitiondelay');

if (!$showcase_autoplay) { $autoplay="false"; } else { $autoplay="true"; }
if (!$showcase_arrows) { $arrows="false"; } else { $arrows="true"; }

$containerheight=$showcase_height+110;
?>
<style type="text/css" media="screen">
/* <![CDATA[ */
	#awfeatured { height: <?php echo $containerheight; ?>px; }
/* ]]> */
</style>
<?php 
$showthumbnails="outside-first";
if ($featured_slide_type=="awshowcase-top") { $showthumbnails="outside-first"; } 
if ($featured_slide_type=="awshowcase-bottom") { $showthumbnails="outside-last"; }
?>
<script type="text/javascript">
/*<![CDATA[*/
jQuery(window).bind("load", function() {
	jQuery('.awshowcase-preload:hidden').fadeIn(800);
	
	jQuery("#showcase").awShowcase(
	{
		content_width:			960,
		content_height:			<?php echo $showcase_height; ?>,
		hundred_percent:		false,
		auto:					<?php echo $autoplay; ?>,
		interval:				<?php echo $showcase_transitiondelay; ?>,
		continuous:				true,
		loading:				false,
		tooltip_width:			200,
		tooltip_icon_width:		32,
		tooltip_icon_height:	32,
		tooltip_offsetx:		18,
		tooltip_offsety:		0,
		arrows:					<?php echo $arrows; ?>,
		buttons:				false,
		btn_numbers:			false,
		keybord_keys:			true,
		mousetrace:				false,
		pauseonover:			true,
		transition:				'<?php echo $showcase_transition; ?>', /* hslide/vslide/fade */
		transition_delay:		300,
		transition_speed:		<?php echo $showcase_transitionspeed; ?>,
		show_caption:			'onload', /* onload/onhover/show */
		thumbnails:				true,
		thumbnails_position:	'<?php echo $showcase_thumbnail_position; ?>', /* outside-last/outside-first/inside-last/inside-first */
		thumbnails_direction:	'horizontal', /* vertical/horizontal */
		thumbnails_slidex:		1, /* 0 = auto / 1 = slide one thumbnail / 2 = slide two thumbnails / etc. */
		dynamic_height:			false,
		speed_change:			true,
		viewline:				false
	});
});
/*]]>*/
</script>
<div id="awfeatured">
	<div class="awshowcase-preload">
	<div id="showcase" class="showcase">
				<?php
				$captioncodes="";
				$count=0;
				query_posts( array( 'post_type' => 'mtheme_featured', 'showposts' => -1, 'orderby' => 'menu_order', 'order' => 'ASC') );
				?>
				<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
				<div class="showcase-slide">
					<?php
					$image_id = get_post_thumbnail_id(($post->ID), 'full'); 
					$image_url = wp_get_attachment_image_src($image_id,'full');  
					$image_url = $image_url[0];

					$thumbnail_image_id = get_post_thumbnail_id(($post->ID), 'featured-thumbnail'); 
					$thumbnail_image_url = wp_get_attachment_image_src($thumbnail_image_id,'featured-thumbnail');  
					$thumbnail_image_url = $thumbnail_image_url[0];
					
					$custom = get_post_custom(get_the_ID());
					$featured_description="";
					$featured_link="";
					if ( isset($custom["featured_description"][0]) ) { $featured_description=$custom["featured_description"][0]; }
					if ( isset($custom["featured_link"][0]) && $custom["featured_link"][0]<>"" ) { 
						$featured_link=$custom["featured_link"][0];
						} else {
						$featured_link = get_post_permalink();
					}


					$title=get_the_title(); 
					$text=$featured_description;
					$permalink = $featured_link;
					$count++;
					?>
					<a href="<?php echo $permalink; ?>">
					<img src="<?php echo $image_url; ?>" alt="<?php the_title(); ?>" />
					</a>
					<div class="showcase-thumbnail">
						<?php
							echo mtheme_display_post_image (
							$ID="",
							$thumbnail_image_url,
							$link=false,
							$type="",
							$post->post_title,
							$class="" 
							);
						?>						
					</div>

						<div class="showcase-caption">
							<?php if ($showcase_title) { ?>
							<h3>
							<a href="<?php echo $permalink; ?>">
							<?php the_title(); ?>
							</a>
							</h3>
							<?php } ?>
						
							<?php if ($showcase_desc) { ?>
							<h4>
								<?php echo $featured_description; ?>
							</h4>
							<?php } ?>
						</div>
						

				</div>
				<?php endwhile; endif; ?>
	</div>
	</div>
</div>