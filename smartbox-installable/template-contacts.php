<?php
/**
 * Template Name: Contacts
 * @package WordPress
 * @subpackage Smartbox
 */

get_header(); ?>


	<?php
		wp_enqueue_script('google-maps', 'http://maps.google.com/maps/api/js?sensor=false', array(),'',$in_footer = true);
	    
		global $smartbox_custom;
		$bodyLayout = des_get_value(DESIGNARE_SHORTNAME."_body_layout_type");
		if ($bodyLayout == "boxed"){
			?>
			

						</div><!--  end of container -->
					</div> <!-- end of wrapper -->
				</div> <!-- end of white-content -->
			
			<?php
		}
		
	?>

<div class="fullwidth-container" style="
	    	
	    	<?php 
		    	global $smartbox_custom, $smartbox_styleColor;	    		
	    		$type = des_get_value(DESIGNARE_SHORTNAME."_header_type");
	    		if (empty($type)) $type = des_get_value(DESIGNARE_SHORTNAME."_header_type option:selected");
				$color = des_get_value(DESIGNARE_SHORTNAME."_header_color"); 
				$image = des_get_value(DESIGNARE_SHORTNAME."_header_image"); 
				$pattern = DESIGNARE_PATTERNS_URL.des_get_value(DESIGNARE_SHORTNAME."_header_pattern"); 
				$height = des_get_value(DESIGNARE_SHORTNAME."_header_height"); 
				$margintop = des_get_value(DESIGNARE_SHORTNAME."_header_text_margin_top");	
				$banner = des_get_value(DESIGNARE_SHORTNAME."_banner_slider");
				if (empty($banner)) $banner = des_get_value(DESIGNARE_SHORTNAME."_banner_slider option:selected");
		 		if ($height != "") echo "height: ". $height . ";";
				if($type == "none") echo "background: none;"; 
				if($type == "color") echo "background: #" . $color . ";";
				if($type == "image") echo "background: url(" . $image . ") no-repeat; background-size: 100% auto";  
	 			if($type == "pattern") echo "background: url('" . $pattern . "') 0 0 repeat;";
	 			if($type == "border") echo "background: white;";
	    	?>">
	    	
	    	<?php
		    	if ($type === "banner"){
			    	?>
			    	<div class="revBanner"> <?php putRevSlider(substr($banner, 10)); ?> </div>
			    	<?php
		    	} else {
	    	?>
				<div class="container">
					<?php
						if ($type == "border"){
							?>
							<div class="borderline"></div>
							<?php
						}
					?>
					<div class="pageTitle sixteen columns" <?php if ($margintop != "") echo " style='margin-bottom: ".$margintop.";margin-top: ".$margintop.";'"; ?>>
		    			<h1 class="page_title" style="<?php 
					    	$tcolor = des_get_value(DESIGNARE_SHORTNAME.'_header_text_color');
							$tsize = str_replace(" ", "", des_get_value(DESIGNARE_SHORTNAME.'_header_text_size'));			
							echo "color: #$tcolor; font-size: $tsize;";
			    	?>"><?php echo the_title(); ?></h1>
		    			<?php
				    		if (get_post_meta($post->ID, 'secondaryTitle_value', true) != ""){
					    		?>
					    <h2 class="secondaryTitle" style="<?php
					    	$stcolor = des_get_value(DESIGNARE_SHORTNAME.'_secondary_title_text_color');
							$stsize = str_replace(" ", "", des_get_value(DESIGNARE_SHORTNAME.'_secondary_title_text_size'));
							echo "color: #$stcolor; font-size: $stsize; line-height: $stsize;";				    		
			    		?>" ><?php echo get_post_meta($post->ID, 'secondaryTitle_value', true); ?></h2>
			    		<?php
			    		}	
		    		?>
			
			    	</div>
			    	<div class="breadcrumbs-container"> 
					<?php global $template;
						if (!strstr($template, "woocommerce.php")){
				  			wp_reset_query();
				  			$bc = "off";
				  			if (get_post_meta($post->ID, 'des_custom_breadcrumbs_value', true) == "on"){
					  			if (get_post_meta($post->ID, 'breadcrumbs_value', true) == "on"){
						  			$bc = "on";	
					  			}
				  			} else {
					  			$bc = des_get_value(DESIGNARE_SHORTNAME. '_breadcrumbs');
				  			}
				  			if ($bc == "on"){
					  			?>
					    			<div class="entry-breadcrumb no-flicker" style="border: none;"> 
										<p><?php echo __(get_option(DESIGNARE_SHORTNAME."_you_are_here"), "smartbox"); ?> <?php designare_the_breadcrumb(); ?></p>
									</div>
					    		<?php
				  			}		
						} else {
			  				$args = array(
								'delimiter'   => ' &raquo; ',
								'wrap_before' => '<div class="entry-breadcrumb no-flicker" style="border: none;"><p>'. __(get_option(DESIGNARE_SHORTNAME."_you_are_here"), "smartbox").' ',
								'wrap_after'  => '</p></div>',
								'before'      => '',
								'after'       => '',
								'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
							);
							woocommerce_breadcrumb($args);
						}
					?>  
					</div>
				</div>
			</div>
		<?php } ?>
<div id="map" <?php if($type==="without") echo "class='originalposition'"; ?>style="<?php if ($bodyLayout == "boxed") echo "top: -40px;"; ?> width: 100%; height: <?php echo get_post_meta(get_the_ID(), "mapHeight_value", true); ?> ;"> </div><input type="hidden" id="gm_lat" value="<?php echo get_post_meta(get_the_ID(), "googleLat_value", true); ?>" /><input type="hidden" id="gm_lng" value="<?php echo get_post_meta(get_the_ID(), "googleLong_value", true); ?>" />

<div id="white_content" class="w-googlemaps"> <!-- begin white-content -->
<div id="wrapper"> <!-- begin wrapper -->
	<div class="container"> <!-- begin container -->
		
		<?php the_post(); ?>				
			
		<div class="post"> <!-- begin post -->
			
			
			<div class="entry">
			
				

				<?php do_shortcode(the_content()); ?>

			</div>

		</div>


<?php get_footer(); ?>