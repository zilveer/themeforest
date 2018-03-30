
<?php
/**
 * @package WordPress
 * @subpackage Smartbox
 */

get_header(); ?>
    	
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
					
					<div class="pageTitle sixteen columns" <?php if ($margintop != "") echo " style='margin-bottom: ".$margintop.";margin-top: ".$margintop.";'"; ?>>
		    			<h1 class="page_title" style="<?php 
					    	$tcolor = des_get_value(DESIGNARE_SHORTNAME.'_header_text_color');
							$tsize = str_replace(" ", "", des_get_value(DESIGNARE_SHORTNAME.'_header_text_size'));			
							echo "color: #$tcolor; font-size: $tsize;";
			    	?>"><?php 
	    	
	    			global $wpdb;
		           	$bc = get_body_class();
		           	$aidee = substr($bc[3], 5);
		            $q = "
		            	SELECT * FROM ".$wpdb->prefix."terms
		            	WHERE term_id=".$aidee;
		            $res = $wpdb->get_results($q, OBJECT);
		            echo $res[0]->name ." ". __("category", "smartbox");
	    	?></h1>
		    		<?php
				    	if (get_option(DESIGNARE_SHORTNAME."_projects_secondary_title") != ""){	?>
					    <h2 class="secondaryTitle" style="<?php
					    	$stcolor = des_get_value(DESIGNARE_SHORTNAME.'_secondary_title_text_color');
							$stsize = str_replace(" ", "", des_get_value(DESIGNARE_SHORTNAME.'_secondary_title_text_size'));
							echo "color: #$stcolor; font-size: $stsize; line-height: $stsize;";				    		
			    		?>" ><?php echo get_option(DESIGNARE_SHORTNAME."_projects_secondary_title"); ?></h2>
			    		<?php
			    		}	
		    		?>
				</div>
			
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

    		<div class="reset_960"> 
						
					<?php the_post(); ?>
					<?php $cat = get_term_by('name', single_cat_title('',false), 'portfolio_type'); ?>
					<article id="projects-1" <?php post_class(); ?> role="article">
						

						<div class="entry-content project_list_s2">		
	
								<?php
								
									$n_columns = get_option(DESIGNARE_SHORTNAME."_projects_archive_ncolumns", true);
									$effect = get_option(DESIGNARE_SHORTNAME."_projects_archive_effect", true);
									$thumbHeight = "";
									switch($n_columns){
										
										case '2col':
											$n_columns_ext = " eight columns";
											$thumbHeight = "355px";
											$n_number = 2;
										break;
										case '3col':
											$n_columns_ext = " one-third column";
											$thumbHeight = "232px";
											$n_number = 3;
										break;
										case '4col':
											$n_columns_ext = " four columns";
											$thumbHeight = "170px";
											$n_number = 4;
										break;
										
									}
									
									$c_help = 0;
									$args = array(
							            'posts_per_page' => -1,
							            'post_type' => DESIGNARE_PORTFOLIO_POST_TYPE
									);
						            $posts_array = get_posts( $args );
						            $the_posts = array();
						            foreach ($posts_array as $p){
										$terms = get_the_terms($p->ID, 'portfolio_category');
										foreach ($terms as $t){
											if ($t->slug === $res[0]->slug){
												array_push($the_posts, $p);
											}
										}
						            }
									$project_id = 1;
									$the_cat = array();
									
								?>
							
								<div class="thumbnails_list">
									<ul class="<?php if ($effect == 'opacity') echo 'proj_list_overlay'; 
									else {
										echo 'proj_list';
									} ?>">
									<?php 
											
											if(!empty($the_posts)) {
												 foreach ($the_posts as $post) {
												 	
												 	$theID = $post->ID;
												 	
												 	$cat_class = "";
												 	$cat_name = "";
												 	$cat_type = "";						 	
												 	$individual_project = "";
												 	$terms = get_the_terms($theID, 'portfolio_category');

												 	$first = true;
												 	if ( $terms && ! is_wp_error( $terms ) ) { 
														foreach ( $terms as $t ) {
															array_push($the_cat, $t->slug);
															$cat_class .= $t->slug . "";
															if ($first){
																$cat_name .= $t->name . "";
																$first = false;
															} else
																$cat_name .= ", ".$t->name;
														}
													}
													
													
													$rel = "";
													$hoverType = get_post_meta($theID, "thumbnailHoverOption_value", true);
													if ($hoverType != "default"){
														$rel = " data-rel='".$hoverType."' ";
													}
	
												 	?>
												 	<li <?php echo $rel; ?> data-id="id-<?php echo $project_id; ?>" class="<?php echo $cat_class; ?> view slides_item <?php echo $n_columns_ext; ?>">								 	
												 	
													<div class="post-thumb post-thumb-s2">
														<ul class="ch-grid">
															<li class="nc">
																<div class="ch-item">
																<?php
																
																	$img = wp_get_attachment_url( get_post_thumbnail_id($theID));
																	
																	$individual_project .= '<a href="'.get_permalink().'"><img class="img_thumb" alt="" src="'.$img.'" /></a><a class="flex_this_thumb" href="'.$img.'"></a><div class="mask" onclick="$(this).siblings(\'a\').trigger(\'click\');" style="height:100%;"><div class="more" onclick="$(this).parents(\'.ch-item\').find(\'.flex_this_thumb\').click();"></div><div class="link" onclick="window.location = $(this).parents(\'.ch-item\').children(\'a\').eq(0).attr(\'href\');"></div></div>'; 
												
																	$individual_project .= '</div></li></ul>';
																	
																	$individual_project .= '<div class="no-flicker"><div class="proj-title-tags"><div class="p_title no-flicker"><a href="'.get_permalink().'">'.get_the_title().'</a></div></div>';
																	
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
		    		
					</article>	    		
	    		
    		</div>
    
    <div class="clear"></div>

<?php get_footer(); ?>