<?php
$slidecount=0;
// Get the number of accordion slides from options
$kwick_slices= of_get_option('featured_accordion_qty');
$kwick_title= of_get_option('featured_accordion_title');
$kwick_desc= of_get_option('featured_accordion_desc');
$kwick_height= of_get_option('featured_accordion_height');
// Adjust the shadow amount
$shadowcast= $kwick_height;
$containerwidth="960px";
// Adjust slide width based on the kwicks number selected
if ($kwick_slices==2) { $slicewidth="480px"; $miniwidth=460; $minicaption_left=0;}
if ($kwick_slices==3) { $slicewidth="320px"; $miniwidth=310; $minicaption_left=0;}
if ($kwick_slices==4) { $slicewidth="240px"; $miniwidth=220; $minicaption_left=0;}
if ($kwick_slices==5) { $slicewidth="192px"; $miniwidth=172; $minicaption_left=0;}
if ($kwick_slices==6) { $slicewidth="160px"; $miniwidth=140; $minicaption_left=0;}
?>
<style type="text/css">
/* <![CDATA[ */
	.kiwcks-container { height: <?php echo $kwick_height; ?>px; }
	.kiwcks-container { width: <?php echo $containerwidth; ?> }
	.kwicks li { width: <?php echo $slicewidth; ?>; }
	.kwicks li { height: <?php echo $kwick_height; ?>px; }
	.kwickshadow { height: <?php echo $kwick_height; ?>px; }
	.slideshowgallery { height: <?php echo $shadowcast; ?>px; }
	.slide-minicaption { width: <?php echo $miniwidth; ?>px; }
/* ]]> */
</style>

<script type="text/javascript">
/* <![CDATA[ */
jQuery(window).bind("load", function() {
	//Preload the kwicks
		jQuery('.slideimage:hidden').fadeIn(800);

		jQuery(".kwicks.horizontal li").css('background', '#000');
		
		jQuery('.slide-minicaption').show();
		jQuery('.slide-minicaptiontitle').show();
		jQuery('.slidecaption').show();
		jQuery('.slidecaptiontitle').show();
		
		jQuery('.kwickshadow:hidden').fadeIn(1000);

		jQuery('.kwicks').kwicks({
			max : 930,
			spacing : 0
		});
		

	jQuery(function(){
		//Hide all Captions and show Mini Captions
		jQuery(".slidecaption").fadeTo(1, 0);
		jQuery(".slide-minicaption").fadeTo(1, 0.8);

		//On hover of a Kwick Panel
		jQuery(".kwicks").each(function () {
			jQuery(".kwicks").hover(function() {
			jQuery('.slidecaption').stop().animate({opacity: 0.8, left: '40'}, 800 );
			jQuery(".slide-minicaption").stop().animate({opacity: 0, left: '480'}, 250 );
			},function(){
			jQuery('.slidecaption').stop().animate({opacity: 0, left: '540'}, 500 );
			jQuery(".slide-minicaption").stop().animate({opacity: 0.8, left: '<?php echo $minicaption_left; ?>'},1800 );
			});
		});
	});

});
/* ]]> */
</script>

<!-- Kwicks Featured Block -->
<div class="kwicks-featured">
	<div class="slideshowgallery">
		<div class="kiwcks-container">
			<ul class="kwicks horizontal" >
				<?php
				// Get the featured slides and limit to the number of slides selected as showposts
				query_posts( array( 'post_type' => 'mtheme_featured', 'showposts' => $kwick_slices, 'orderby' => 'menu_order', 'order' => 'ASC') );
				?>
				<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
				<?php
					// Get the featured image
					$image_id = get_post_thumbnail_id(($post->ID), 'full'); 
					$image_url = wp_get_attachment_image_src($image_id,'full');  
					$image_url = $image_url[0];
					
					$custom = get_post_custom(get_the_ID());
					$featured_description="";
					$featured_link="";
					if ( isset($custom["featured_description"][0]) ) { $featured_description=$custom["featured_description"][0]; }
					if ( isset($custom["featured_link"][0]) && $custom["featured_link"][0]<>"" ) { 
						$featured_link=$custom["featured_link"][0];
						} else {
						$featured_link = get_post_permalink();
					}
				?>
				<?php $slidecount++; ?>
				<li id="<?php echo "kwickblock" . $slidecount .""; ?>">
					<div>
						<!-- Dropshadow PNG thorugh CSS -->
						<div class="kwickshadow"> </div>
						<!-- Featured Image one -->
							<a href="<?php echo $featured_link; ?>" title="<?php the_title(); ?>">
								<img class="slideimage" src="<?php echo $image_url; ?>" alt="<?php the_title(); ?>" />

							</a>
						<!-- Mini Caption when slide closed -->
						<p class="slide-minicaption">
							<span class="slide-minicaptiontitle">
								<?php the_title(); ?>
							</span>
						</p>
						
						<?php if ( $kwick_title|| $kwick_desc ) { ?>
						<!-- Big Caption on Hover -->
						<p class="slidecaption">
							<?php if ($kwick_title ) { ?>
							<span class="slidecaptiontitle">
								<a href="<?php echo $featured_link; ?>"><?php the_title(); ?></a>
							</span>
							<?php } ?>
							<?php if ($kwick_desc) { ?>
							<a href="<?php echo $featured_link; ?>" title="<?php the_title(); ?>">
								<?php echo $featured_description;?>
							</a>
							<?php } ?>
						</p>
						<?php } ?>
						
					</div>
				</li>
				<?php endwhile; endif; ?>
			</ul>
		</div>
	</div>
</div>
<!-- End of Featured Block -->
<div class="clear"></div>
<!-- End of Featured Block -->