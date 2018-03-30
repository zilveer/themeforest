<?php get_header(); ?>
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
				if($type == "image") echo "background: url(" . $image . ") no-repeat; background-size: 100% auto;";  
	 			if($type == "pattern") echo "background: url('" . $pattern . "') 0 0 repeat;";
	 			if($type == "border") echo "background: white;";
	    	?>">
	    	
	    	<?php
		    	if ($type === "banner"){
			    	?>
			    	<div class="revBanner"> 
			    		<?php if (function_exists('putRevSlider')) putRevSlider(substr($banner, 10)); ?> 
			    	</div>
			    	<?php
		    	} else {
	    	?>
	    	
	    	
				<div class="container">
					
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
		
		<?php
		    if ($type === "banner"){
			    ?></div><?php
		    }
		?>
	<div id="white_content">
	
		<div id="wrapper">
		
			<div class="container">
				<?php
					if ($type == "border"){
						?>
				<div class="borderline"></div>
						<?php
					}
				?>
				<?php the_post(); ?>
			
				<div class="post" id="post-<?php the_ID(); ?>">
				    	
					<div class="entry sidebar-<?php echo get_post_meta($post->ID, 'sidebar_for_default_value', true); ?>">
						<?php
							$sidebar = get_post_meta($post->ID, 'sidebars_available_value', true);
							switch (get_post_meta($post->ID, 'sidebar_for_default_value', true)){
								case "none":
									do_shortcode(the_content());
								break;
								case "left":
									?>
									<div class="four columns">
										<?php 
											if ( function_exists('dynamic_sidebar')) { 
												ob_start();
											    do_shortcode(dynamic_sidebar($sidebar));
											    $cont = ob_get_contents();
											    ob_end_clean();
											    echo $cont; 
											    wp_reset_query(); 
											} 
										?>
									</div>
									<div class="twelve columns">
										<div class="sidebars-contents-left">
											<?php do_shortcode(the_content()); ?>
										</div>
									</div>
									<?php
								break;
								case "right":
									?>
									<div class="twelve columns">
										<div class="sidebars-contents">
											<?php do_shortcode(the_content()); ?>
										</div>
									</div>
									<div class="four columns">
										<?php 
											if ( function_exists('dynamic_sidebar')) { 
												ob_start();
											    do_shortcode(dynamic_sidebar($sidebar));
											    $html = ob_get_contents();
											    ob_end_clean();
											    echo $html;
											    wp_reset_query();
											}
										?>
									</div>
									<?php
								break;
								default:
									do_shortcode(the_content());
								break;
							}
						?>
		
					</div>
		
				</div>
		
				<div class="clear"></div>
		
<?php get_footer(); ?>