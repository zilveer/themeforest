<?php get_header(); wp_enqueue_style('woo', DESIGNARE_CSS_PATH .'woocommerce.css', array(), '1', 'screen' ); ?>
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
			    	?>"> 
			    	 <?php 
		    		   	 //echo the_title(); /* resolver as cenas do titulo mais tarde. */ 
		    		   	 //woocommerce_page_title();
		    		   	 if ( is_product() || is_product_category() || is_product_tag() ){
			    		   	 echo get_option(DESIGNARE_SHORTNAME."_shop_primary_title");
		    		   	 } else {
			    		   	 woocommerce_page_title();
		    		   	 }
		    		?></h1>
			    		<?php
				    		if (get_option(DESIGNARE_SHORTNAME."_shop_secondary_title") != ""){
					    		?>
					    <h2 class="secondaryTitle" style="<?php
					    	$stcolor = des_get_value(DESIGNARE_SHORTNAME.'_secondary_title_text_color');
							$stsize = str_replace(" ", "", des_get_value(DESIGNARE_SHORTNAME.'_secondary_title_text_size'));
							echo "color: #$stcolor; font-size: $stsize; line-height: $stsize;";				    		
			    		?>"><?php echo get_option(DESIGNARE_SHORTNAME."_shop_secondary_title"); ?></h2>
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
				
				<?php woocommerce_content(); ?>
				<script type="text/javascript">
					jQuery(document).ready(function($){
						/*
if ($('#wrapper > .container h1.page-title').length){
							$('.fullwidth-container h3.page_title').html($('#wrapper > .container h1.page-title').html());
							$('.fullwidth-container h3.page_title').html($('h1.product_title.entry-title').html());
							$('.fullwidth-container h3.page_title').css('display','block');
						}
*/

						$(document).ready(function() {

							// Hide review form - it will be in a lightbox
							$('#review_form_wrapper').hide();
						
							// Lightbox
							$("a.zoom").prettyPhoto({
								social_tools: false,
								opacity: 0.9,
								deeplinking: false
							});
							$("a.show_review_form").prettyPhoto({
								social_tools: false,
								opacity: 0.9,
								deeplinking: false,
								changepicturecallback:function(slider){
									$('.pp_content_container .pp_content').css('height','auto');
									$(window).trigger('resize');
								}
							});
							$("a[rel^='prettyPhoto']").prettyPhoto({
								social_tools: false,
								opacity: 0.9,
								deeplinking: false
							});
						
							// Open review form lightbox if accessed via anchor
							if( window.location.hash == '#review_form' ) {
								$('a.show_review_form').trigger('click');
							}
						
						});
					});
				</script>
				
		
<?php get_footer(); ?>