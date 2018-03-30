<?php
$featured_nivo_transition = of_get_option ('featured_nivo_transition');
$featured_slideshow_pausetime = of_get_option ('featured_slideshow_pausetime');
$manualAdvance="true";
if (DEMOSTATUS) {
	// Set Manual advance if autoplay is off
	$manualAdvance="false";
}
?>
<script type="text/javascript">
/*<![CDATA[*/
    jQuery(window).load(function() {
        jQuery('#slider').nivoSlider({
        effect:'boxRainGrow', // Specify sets like: 'fold,fade,sliceDown'
        slices:15, // For slice animations
        boxCols: 10, // For box animations
        boxRows: 8, // For box animations
        animSpeed:500, // Slide transition speed
        pauseTime:6000 // How long each slide will show
		});
    });

/*]]>*/
</script>
<div id="nivo-featured">
	<div id="slider-wrapper">
		<div id="slider" class="nivoSlider">
				<?php
				$captioncodes="";
				$count=0;
				query_posts( array( 'post_type' => 'mtheme_featured', 'showposts' => -1, 'orderby' => 'menu_order', 'order' => 'ASC') );
				?>
				<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
				<?php
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

				//$textblock=$featured_description;
				$title=get_the_title(); 
				$text=$featured_description;
				$permalink = $featured_link;
				$count++;
				?>
				<a href="<?php echo $permalink; ?>">
				<img src="<?php echo $image_url; ?>" alt="<?php the_title(); ?>" title="#htmlcaption<?php echo $count; ?>" />
				</a>
				<?php 
				$captioncodes .='<div id="htmlcaption' . $count . '" class="nivo-html-caption">';
				$captioncodes .='<span class="nivo-title"><a href="'. $permalink .'">'. $title . '</a></span>';
				$captioncodes .='<span class="nivo-desc"><a href="'. $permalink .'">'. $text . '</a></span>';
				$captioncodes .='</div>';
				?>
				<?php endwhile; endif; ?>
		</div>
		<?php echo $captioncodes; ?>
	</div>
</div>