<?php
/*
Template Name: Projects Template - Style 1
*/
?>

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
			    	<div class="revBanner"> <?php putRevSlider(substr($banner, 10)); ?> </div>
			    	<?php
		    	}
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
			</div>
    	
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
			
			
    		<div class="reset_960">
	    		
		    	<?php the_post(); ?>
	
					<article id="projects-1" <?php post_class(); ?> role="article">
						

						<div class="entry-content project_list_s2">
							<?php do_shortcode(the_content()); ?>
													
							<div class="moreinfo_text sixteen columns">
							
								<div class="filterby">
									<div class="filterby_btn <?php if (get_option(DESIGNARE_SHORTNAME."_enable_open_close_categories") === "on"){ if (get_option(DESIGNARE_SHORTNAME."_categories_initial_state") === "closed"){ echo "closed"; }} ?>" <?php if (get_option(DESIGNARE_SHORTNAME."_enable_open_close_categories") === "on") { ?> onclick="toggleFilter($(this));" <?php } ?>><?php echo __(get_option(DESIGNARE_SHORTNAME."_filter_by"), "smartbox"); ?><div class="arrow-right"></div></div>
									<ul class="projectCategories"></ul>
								</div>
							
							</div>			
	
								<?php
								
									$orderby = explode('_', get_post_meta(get_the_ID(), "orderby_value", true));
									$portfolio = get_post_meta(get_the_ID(), "postCategory_value", true);
									$n_columns = get_post_meta(get_the_ID(), "column_number_value", true);
									$effect = get_post_meta(get_the_ID(), "postEfect_value", true);
									
									switch($n_columns){
										
										case 'eight columns':
											$n_columns_ext = 2;
											$thumbHeight = "355px";
										break;
										case 'one-third column':
											$n_columns_ext = 3;
											$thumbHeight = "232px";
										break;
										case 'four columns':
											$n_columns_ext = 4;
											$thumbHeight = "170px";
										break;
										
										
									}
									
									$c_help = 0;
									
									if($portfolio == 'all')
										$portfolio = null;
									
									//set the query_posts args
									$args= array(
									     'posts_per_page' => -1, 
											 'post_type' => DESIGNARE_PORTFOLIO_POST_TYPE,
											 'orderby' => $orderby[0],
											 'order' => $orderby[1],
											 'portfolio_type' => $portfolio
									);
									
									$project_id = 1;
									$the_cat = array();
									
								?>
							
								<div class="thumbnails_list">
									<ul class="<?php if($effect == 'opacity') echo 'proj_list_overlay'; 
									else {
										echo 'proj_list';
									} ?>">
									<?php 
									
										query_posts($args);
											
											if(have_posts()) {
												 while (have_posts()) {
												 	the_post();
												 	
												 	$theID = get_the_ID();
												 	
												 	$cat_class = "";
												 	$cat_name = "";
												 	$cat_type = "";						 	
												 	$individual_project = "";
												 	$terms = get_the_terms(get_the_ID(), 'portfolio_category');
												 	
												 	$first = true;
												 	if ( $terms && ! is_wp_error( $terms ) ) { 
														foreach ( $terms as $t ) {
															array_push($the_cat, $t->slug);
															$cat_class .= $t->slug . " ";
															if ($first){
																$cat_name .= $t->name . " ";
																$first = false;
															} else
																$cat_name .= "/ ".$t->name; 
														}
													}
													$rel = "";
													$hoverType = get_post_meta($theID, "thumbnailHoverOption_value", true);
													if ($hoverType != "default"){
														$rel = " data-rel='".$hoverType."' ";
													}
	
												 	?>
												 	<li <?php if ($rel != "") echo $rel; ?>data-id="id-<?php echo $project_id; ?>" class="<?php echo $cat_class; ?> view slides_item <?php echo $n_columns; ?>">								 	
												 	
													<div class="post-thumb post-thumb-s2">
														<ul class="ch-grid">
															<li class="nc<?php echo $n_columns_ext; ?>">
																<div class="ch-item">
																<?php
																	$img = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
																	
																	$terms = get_the_terms(get_the_ID(), 'portfolio_category');

																	if ( $terms && ! is_wp_error( $terms ) ) {
																		$cat_name = "";
																		$xuts = 0;
																		foreach ( $terms as $x ) {
																			if ($xuts == 0){
																				$cat_name .= $x->name;
																			}
																			else $cat_name .= ", ".$x->name; 
																			$xuts++;
																		}
																	}
																	
																	$individual_project .= '<a href="'.get_permalink().'"><img class="img_thumb" alt="" src="'.$img.'" /></a><a class="flex_this_thumb" href="'.$img.'"></a><div class="mask" onclick="$(this).siblings(\'a\').trigger(\'click\');" style="height:100%;"><div class="more" onclick="$(this).parents(\'.ch-item\').find(\'.flex_this_thumb\').click();"></div><div class="link" onclick="window.location = $(this).parents(\'.ch-item\').children(\'a\').eq(0).attr(\'href\');"></div></div>'; 
												
																	$individual_project .= '</div></li></ul>';
																	
																	$individual_project .= '<div class="no-flicker"><div class="proj-title-tags"><div class="p_title no-flicker"><a href="'.get_permalink().'">'.get_the_title().'</a></div>';
																	
																																		
																	$individual_project .= '</div>';
																	
																	echo $individual_project;
																	
																?>
																</div>										
															</div>	

														

												</li>
												 	
												 	<?php
												 	
												 	$project_id++;
												 }
											}	
										
									?>
									</ul>
								</div>
							
						</div><!-- .entry-content -->
						
						<!-- CATEGORIES DIV (HELPER) -->
					  <div class="cat_helper">
					  	<ul class="splitter">
							<?php 
								//load the projects categeories
								$tot_cat = 0;
								$i=0;
								$proj_taxonomies=designare_get_taxonomies('portfolio_category');
								$the_cat_final = array_unique($the_cat);
								$proj_categories="";
								
												
								foreach($proj_taxonomies as $taxonomy){
									foreach($the_cat_final as $tcf){
										if($tcf == $taxonomy->slug){
											$proj_categories .= "<li onclick='$(this).addClass(\"active\").siblings().removeClass(\"active\");";
											if (get_option(DESIGNARE_SHORTNAME."_enable_open_close_categories") === "on"){
												$proj_categories .= "$(this).siblings().not(\"active\").slideHorzHide();";
											}
											$proj_categories .= "$(this).parents(\".filterby\").children(\".filterby_btn\").removeClass(\"open\").addClass(\"closed\");' id='term_id_" . $taxonomy->term_id . "' class='segment-0 termCat'><a href='javascript:;' class='no-flicker' data-value='" . $taxonomy->slug . "'>" . $taxonomy->name . "</a></li>";
											$tot_cat++;
										}
									}
								}
					
								if($tot_cat > 0)
									echo "<li onclick='$(this).addClass(\"active\").siblings().removeClass(\"active\");";
									if (get_option(DESIGNARE_SHORTNAME."_enable_open_close_categories") === "on"){
										echo "$(this).siblings().not(\"active\").slideHorzHide();";	
									} 
									echo "$(this).parents(\".filterby\").children(\".filterby_btn\").removeClass(\"open\").addClass(\"closed\");' id='term_id_-1' class='segment-1 selected-1 termCat active'><a class='no-flicker' href='javascript:;' data-value='all'>All</a></li>" . $proj_categories;
							?>
							
						</ul>
					  </div>
					  <!-- /HELPER -->
						
						<script>
						jQuery(document).ready(function($) {
							
							$("#projects-1 .projectCategories").html($("#projects-1 .cat_helper").html());
							$("#projects-1 .cat_helper").html("").remove();
							
							<?php if($effect == 'opacity') echo 'clickThumbsOverlay("projects-1");'; else echo 'quicksandstart("projects-1");'; ?>
							<?php
								
								if (get_option(DESIGNARE_SHORTNAME."_enable_open_close_categories") === "on"){
									if (get_option(DESIGNARE_SHORTNAME."_categories_initial_state") === "closed"){
										?>
											$('.projectCategories .splitter').children('li').not('.active').slideHorzHide();			
										<?php
									}
								}
								
							?>
							$('.breadcrumbs-container').appendTo($('.fullwidth-container > .container'));
						});
					
						function toggleFilter($el){
							if ($el.hasClass('closed')){
								/* OPEN */
								$el.siblings('.projectCategories').children('.splitter').children('li').slideHorzShow();
								$el.removeClass('closed').addClass('open');										
							} else {
								/* CLOSE */									
								$el.siblings('.projectCategories').children('.splitter').children('li').not('.active').slideHorzHide();
								$el.removeClass('open').addClass('closed');
							}
							
						}
						
						jQuery.fn.slideHorzShow = function( speed, easing, callback ) { this.animate( { marginLeft : 'show', marginRight : 'show', paddingLeft : 'show', paddingRight : 'show', width : 'show' }, speed, easing, callback ); };
						jQuery.fn.slideHorzHide = function( speed, easing, callback ) { this.animate( { marginLeft : 'hide', marginRight : 'hide', paddingLeft : 'hide', paddingRight : 'hide', width : 'hide' }, speed, easing, callback ); };
						
					</script>
		    		
					</article><!-- #post-<?php the_ID(); ?> -->
	    		
	    		
    		</div>
    		
    <div class="clear"></div>
		
	
<?php get_footer(); ?>