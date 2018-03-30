<?php
$nivo_title = of_get_option ('featured_nivo_title');
$nivo_desc = of_get_option ('featured_nivo_desc');
$nivo_transition_style = of_get_option ('featured_nivo_transition_style');
$nivo_transition_speed = of_get_option ('featured_nivo_transition_speed');
$nivo_autoplay = of_get_option ('featured_nivo_autoplay');
$nivo_pausetime = of_get_option ('featured_nivo_pausetime');
$nivo_slices = of_get_option ('featured_nivo_slices');
$nivo_box_cols = of_get_option ('featured_nivo_box_cols');
$nivo_box_rows = of_get_option ('featured_nivo_box_rows');
$nivo_height = of_get_option ('featured_nivo_height');
if ($nivo_autoplay=="0") { $manual="true"; } else { $manual="false"; }
if ($nivo_arrows=="0") { $arrows="false"; } else { $arrows="true"; }
$nivoID = "sliderID" . dechex(time()).dechex(mt_rand(1,65535));
?>
<style type="text/css">
/* <![CDATA[ */
	#<?php echo $nivoID;?> { position:relative; width:960px; height: <?php echo $nivo_height; ?>px !important; }
	#<?php echo $nivoID;?> img { position:absolute;	top:0px;	left:0px;	display:none;}
	#<?php echo $nivoID;?>  a { text-decoration:none; color:#fff; border:0; display:block;}
	#nivo-featured { height: <?php echo $nivo_height-2; ?>px !important; overflow:hidden; }
/* ]]> */
</style>
<script type="text/javascript">
/*<![CDATA[*/
    jQuery(window).load(function() {
        jQuery('#<?php echo $nivoID;?>').nivoSlider({
        effect:'<?php echo $nivo_transition_style; ?>', // Specify sets like: 'fold,fade,sliceDown'
        slices: <?php echo $nivo_slices; ?>, // For slice animations
        boxCols: <?php echo $nivo_box_cols; ?>, // For box animations
        boxRows: <?php echo $nivo_box_rows; ?>, // For box animations
        animSpeed:<?php echo $nivo_transition_speed; ?>, // Slide transition speed
        pauseTime:<?php echo $nivo_pausetime; ?>, // How long each slide will show
		keyboardNav:true, //Use left & right arrows
		pauseOnHover:true, //Stop animation while hovering
		manualAdvance:<?php echo $manual; ?>, //Force manual transitions
		captionOpacity:0.8, //Universal caption opacity
		beforeChange: function(){},
		afterChange: function(){},
		slideshowEnd: function(){} //Triggers after all slides have been shown
		});
    });

/*]]>*/
</script>
<div id="nivo-featured">
	<div id="slider-wrapper">
		<div class="slider-wrapper theme-default">
		<div id="<?php echo $nivoID;?>" class="nivoSlider">
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
				if ($nivo_title) {
					$captioncodes .='<span class="nivo-title"><a href="'. $permalink .'">'. $title . '</a></span>';
				}
				if ($nivo_desc) {
					$captioncodes .='<span class="nivo-desc"><a href="'. $permalink .'">'. $text . '</a></span>';
				}
				$captioncodes .='</div>';
				?>
				<?php endwhile; endif; ?>
		</div>
		</div>
		<?php if ( $nivo_title || $nivo_desc ) { echo $captioncodes; } ?>
	</div>
</div>