<?php
	if ($prk_astro_options['archives_ptype']=="grid" || $prk_astro_options['archives_ptype']=="")
	{
		get_header();
		global $retina_device;
		$retina_flag = $retina_device === "prk_retina" ? true : false;
		$default_margin=0;
		$astro_show_filter=false;
		$ajax_single_layout="";
		$cols_number="3";
		$default_margin=get_field('thumbs_margin');
		$astro_show_skills=false;
		$mini_sliders="no";
		$make_lbox="no";
		$thumbs_rollover_color="";
		//OVERRIDE OPTIONS - ONLY FOR PREVIEW MODE
		if (INJECT_STYLE)
		{
			include_once(ABSPATH . 'wp-content/plugins/color-manager-astro/style_header.php');	
		}
	?>
	<div id="centered_block"> 
	<div id="main_block" class="row fff_folio page-<?php echo get_the_ID(); ?> prk_taxonomy">
		<div id="headings_wrap" class="bd_headings_text_shadow zero_color folio_skills">
			<div class="prk_inner_block centered twelve columns">
	            <div class="single_page_title twelve columns">
	                <h1 class="header_font">
	                	<?php single_cat_title(); ?>			                	
	                </h1>
	    		</div>
				<div class="clearfix"></div>
	        </div>
		</div>
	    <div id="content">
	      	<div id="main" class="main_no_sections">
	      			<div class="row prk_row">
	      		<div id="folio_father" class="columns twelve">
			<?php
			$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
			$my_query = new WP_Query();
			$args = array( 	'post_type' => 'pirenko_portfolios', 
							'portfolio_tag'=>$term->slug,
							'posts_per_page'=>999
						);
			$my_query->query($args);
	        if ($my_query->have_posts()) :
							$ins=0;
							echo '<div id="magner"><div id="d_magner"><div id="folio_masonry" class="iso_folio columnize-'.$cols_number.'" data-columns="'.$cols_number.'" data-margin="'.$default_margin.'">';
								while ($my_query->have_posts()) : $my_query->the_post();
									if (get_field('featured_color')!="" && $thumbs_rollover_color=="")
									{
										$featured_color=get_field('featured_color');
										$featured_class="featured_color ";
									}
									else
									{
										if ($thumbs_rollover_color!="")
										{
											$featured_color=$thumbs_rollover_color;
											$featured_class="featured_color ";
										}
										else
										{
											$featured_color="default";
											$featured_class="";
										}
									}
									$skills_links="";
									$skills_names="";
									$skills_yo="";
									$skills_output="";
									$terms = get_the_terms ($post->ID, 'pirenko_skills');
									if (!empty($terms))
									{
										foreach ($terms as $term) {
											$skills_links[] = $term->slug;
											$skills_names[] = $term->name;
											}
									
										$skills_yo = join(" ", $skills_links);
										$skills_output = join(", ", $skills_names);
									}
								?>
							<div id="post-<?php the_ID(); ?>" class="<?php echo $featured_class; ?>boxed_shadow portfolio_entry_li <?php echo $skills_yo; ?> p_all" data-id="id-<?php echo $ins; ?>" data-color="<?php echo $featured_color; ?>">
									<?php 
								if (has_post_thumbnail( $post->ID ) ):
									//GET THE FEATURED IMAGE
									$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
									$magnific_image[0]=$image[0] = get_image_path($image[0]);
								else :
									//THERE'S NO FEATURED IMAGE
								endif;
								$hide_second=false;
								$vid_cl="";
								if (get_field('skip_featured')=="1")
								{
									//CHECK IF THERE'S A SECOND IMAGE
									if (get_field('image_2')!="")
									{
										$hide_second=true;
										$in_image=wp_get_attachment_image_src(get_field('image_2'),'full');
										$magnific_image[0]=$in_image[0];
									}
									else if (get_field('video_2')!="")
									{
										$hide_second=true;
										$magnific_image[0]=get_iframe_src(get_field('video_2'));
										$vid_cl=" mfp-iframe";
									}
								}

								if (get_field('skip_to_external')=="1")
								{
									$href_val=get_field('ext_url');
									//CHECK IF PROJECT URL IS SET
									if ($href_val=="")
										$href_val=get_permalink();
									//ADD HTTP PREFIX IF NEEDED
									if (substr($href_val,0,7)!="http://" && substr($href_val,0,8)!="https://")
										$href_val="http://".$href_val;
								}
								else
								{
									if ($make_lbox=="no" || $mini_sliders=="yes")
									{
										$href_val=get_permalink();
									}
									else
									{
										$href_val=$magnific_image[0];
									}
								}
								?>
								
							
	                            <div class="grid_image_wrapper boxed_shadow">
									<?php 
										$jumper=2;
										if ($make_lbox=="no" && $mini_sliders=="no")
										{
											?>
											<div class="prk_magnificent body_bk_color<?php echo $vid_cl;?>" data-mfp-src="<?php echo "$magnific_image[0]"; ?>">
												<div class="navicon-expand-2"></div>
											</div>
											<?php
										}
										if ($make_lbox=="no" && $mini_sliders=="yes" && get_field('skip_featured')!=1)
										{
											?>
											<div class="prk_magnificent_li prk_magnificent_li_outer  body_bk_color" data-mfp-src="<?php echo $magnific_image[0]; ?>">
												<div class="navicon-expand-2"></div>
											</div>
											<?php
										}
										if ($make_lbox=="no" && $mini_sliders=="yes" && get_field('skip_featured')==1)
										{
											$jumper=3;
											if (get_field('image_2')!="")
	                                        {
	                                        	$in_image=wp_get_attachment_image_src(get_field('image_2'),'full');
	                                       		?>
												<div class="prk_magnificent_li prk_magnificent_li_outer body_bk_color" data-mfp-src="<?php echo $in_image[0]; ?>">
													<div class="navicon-expand-2"></div>
												</div>
												<?php
	                                        }
	                                        //VIDEO
	                                        if (0)
	                                        {
	                                        	echo '<div class="prk_magnificent_li prk_magnificent_li_outer body_bk_color mfp-iframe" data-mfp-src="'.get_iframe_src(get_field('image_2')).'">';
	                                            echo '<div class="navicon-expand-2"></div>';
	                                            echo '</div>';
	                                        }
										}
									?>
	                            	<a href="<?php echo $href_val; ?>" class="<?php if ($make_lbox=="yes" && $mini_sliders=="no"){echo "magna_a";} else {  if (get_field('skip_to_external')==0) {echo "fade_anchor";}} ?>" data-color="<?php echo $featured_color; ?>">
	                                <div id="grid_title-<?php the_ID(); ?>" class="grid_single_title">
	                                    <div class="prk_ttl">
	                                    	<h3 class="header_font body_bk_color body_bk_text_shadow small">

	                                    		<?php the_title(); ?>

	                                    	</h3>
	                                    </div>
										<?php
											if ($prk_astro_options['show_heart_folio']=="1")
			                                {
			                                    echo '<div class="prk_heart_masonry">';
			                                    	echo get_folio_like(get_the_ID(),true);
			                                    echo '</div>';
			                                }
											if ($skills_output!="" && $astro_show_skills==true)
											{
												?>
												<div class="inner_skills body_bk_color site_background_colored">
													<?php echo $skills_output; ?>
												</div>
												<?php
											}

	                                    ?>
	                                </div>
	                                	<div class="grid_colored_block">
										</div>
										<?php 
		                                    if (has_post_thumbnail( $post->ID ) )
		                                    {
												if ($cols_number=="3")
												{
													$forced_w=480;
												}
												else
												{
													$forced_w=round(1820/$cols_number);
												}
												//SET A MINIMUM VALUE FOR RESPONSIVENESS
												if ($forced_w<420)
		                                			$forced_w=420;
												$forced_h=round($forced_w/1.6);
												$vt_image = vt_resize( '', $image[0] ,$forced_w ,$forced_h , true , $retina_flag );
												?>
												<div id="tiny_slider-<?php echo $post->ID;?>" <?php if ($mini_sliders=="yes"){echo 'class="tiny_slider per_init"';} ?>>
													<ul class="slides">
														<li>
															<img src="<?php echo $vt_image['url']; ?>" width="<?php echo $vt_image['width']; ?>" height="<?php echo $vt_image['height']; ?>" id="home_fader-<?php the_ID(); ?>" class="custom-img grid_image" data-featured="no" alt="" />
															<?php
																if ($mini_sliders=="yes") 
																{
																	//PLACE THE OTHER NINETEEN IMAGES
							                                        for ($count=$jumper;$count<21;$count++)
							                                        {
						                                                if (get_field('image_'.$count)!="")
						                                                {
						                                                	echo "</li>";
						                                                	echo "<li>";
						                                                	$in_image=wp_get_attachment_image_src(get_field('image_'.$count),'full');
						                                               		$vt_image = vt_resize( '', $in_image[0] , $forced_w, $forced_h, true , $retina_flag );
						                                                	echo '<img src="'.$vt_image['url'].'" width="'. $vt_image['width'] .'" height="'. $vt_image['height'] .'" class="grid_image" alt="" />';
						                                                    if ($count==2 && $hide_second==true) 
						                                                    {

						                                                    }
						                                                	else
						                                                	{
						                                                    	echo '<div class="prk_magnificent_li" data-mfp-src="'.$in_image[0].'"></div>';
						                                                    }
						                                                }
						                                                //VIDEO SUPPORT
						                                            	if (0)
						                                                {
						                                                	echo '<div class="prk_magnificent_li body_bk_color mfp-iframe" data-mfp-src="'.get_iframe_src(get_field('video_'.$count)).'">';
						                                                    echo '<div class="navicon-expand-2"></div>';
						                                                    echo '</div>';
						                                                }
							                                        }
							                                    }
															?>
														</li>
				                                	</ul>
				                                </div>
												<?php
		                                    }
	                                    ?>
	                                <!-- FOR IE 10 NO DISPLAY BUG -->
	                                <img src="<?php echo $vt_image['url']; ?>" class="hide_now" alt="" />
	                                </a>
	                            </div>
								</div>
							<?php $ins++; ?>
						<?php 
							endwhile; 
							echo "</div></div></div>";
							//SHOW BUTTON TO SHOW MORE POSTS ONLY IF NEEDED
							if ($paged!=$my_query->max_num_pages) {
								?>
								<div class="clearfix"></div>
								<div id="prk_pusher"></div>
								<div id="next_portfolio_masonry" class="row">
									<div class="navigation twelve">	
										<div class="next-posts">
											<div id="nbr_helper" data-pir_curr="<?php echo $paged; ?>" data-pir_max="<?php echo $my_query->max_num_pages; ?>">
												<div id="pages_static_nav">
					                                <a href="#" class="prk_feedback header_font">
					                                   	<span class="prk_blink">
					                                   		<?php echo($prk_translations['load_more']); ?>
					                                   	</span>
					                                </a>
					                            </div>
					                            
					                            <div class="nx_lnk_wp">
					                                <?php next_posts_link('',$my_query->max_num_pages); ?>
					                            </div>
											</div>
										</div>
									</div><!-- navigation -->
								</div>
								<div class="clearfix"></div>
								<div id="no_more" class="header_font">
				                    <div id="in_no_more" class="header_font"><?php echo($prk_translations['no_more_text']); ?></div>
				                    <div class="clearfix"></div>
				                </div>
								<?php
							}
						endif; 
	        ?>
	    </div>
	</div>
	</div>
	</div>
	</div>
	</div>
	<?php
}//CLASSIC
if ($prk_astro_options['archives_ptype']=="masonry")
{
	get_header();
	global $retina_device;
	$retina_flag = $retina_device === "prk_retina" ? true : false;
	$show_title=false;
	$default_margin=0;
	$astro_show_filter=false;
	$ajax_single_layout="";
	$cols_number="3";
	$default_margin=get_field('thumbs_margin');
	$astro_show_skills=false;
	$mini_sliders="no";
	$make_lbox="no";
	$thumbs_rollover_color="";
	//OVERRIDE OPTIONS - ONLY FOR PREVIEW MODE
	if (INJECT_STYLE)
	{
		include_once(ABSPATH . 'wp-content/plugins/color-manager-astro/style_header.php');	
	}
?>
<div id="centered_block"> 
<div id="main_block" class="row fff_folio page-<?php echo get_the_ID(); ?> prk_taxonomy">
	<div id="headings_wrap" class="bd_headings_text_shadow zero_color folio_skills">
		<div class="prk_inner_block centered twelve columns">
            <div class="single_page_title twelve columns">
                <h1 class="header_font">
                	<?php single_cat_title(); ?>			                	
                </h1>
    		</div>
			<div class="clearfix"></div>
        </div>
	</div>
    <div id="content">
      	<div id="main" class="main_no_sections">
      			<div class="row prk_row">
      		<div id="folio_father" class="columns twelve">
		<?php
		$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
		$my_query = new WP_Query();
		$args = array( 	'post_type' => 'pirenko_portfolios', 
						'portfolio_tag'=>$term->slug,
						'posts_per_page'=>999
					);
		$my_query->query($args);
        if ($my_query->have_posts()) :
						$ins=0;
						echo '<div id="magner"><div id="d_magner"><div id="folio_masonry" class="iso_folio columnize-'.$cols_number.'" data-columns="'.$cols_number.'" data-margin="'.$default_margin.'">';
							while ($my_query->have_posts()) : $my_query->the_post();
								if (get_field('featured_color')!="" && $thumbs_rollover_color=="")
								{
									$featured_color=get_field('featured_color');
									$featured_class="featured_color ";
								}
								else
								{
									if ($thumbs_rollover_color!="")
									{
										$featured_color=$thumbs_rollover_color;
										$featured_class="featured_color ";
									}
									else
									{
										$featured_color="default";
										$featured_class="";
									}
								}
								$skills_links="";
								$skills_names="";
								$skills_yo="";
								$skills_output="";
								$terms = get_the_terms ($post->ID, 'pirenko_skills');
								if (!empty($terms))
								{
									foreach ($terms as $term) {
										$skills_links[] = $term->slug;
										$skills_names[] = $term->name;
										}
								
									$skills_yo = join(" ", $skills_links);
									$skills_output = join(", ", $skills_names);
								}
							?>
						<div id="post-<?php the_ID(); ?>" class="<?php echo $featured_class; ?>boxed_shadow portfolio_entry_li <?php echo $skills_yo; ?> p_all" data-id="id-<?php echo $ins; ?>" data-color="<?php echo $featured_color; ?>">
								<?php 
							if (has_post_thumbnail( $post->ID ) ):
								//GET THE FEATURED IMAGE
								$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
								$magnific_image[0]=$image[0] = get_image_path($image[0]);
							else :
								//THERE'S NO FEATURED IMAGE
							endif;
							$hide_second=false;
							$vid_cl="";
							if (get_field('skip_featured')=="1")
							{
								//CHECK IF THERE'S A SECOND IMAGE
								if (get_field('image_2')!="")
								{
									$hide_second=true;
									$in_image=wp_get_attachment_image_src(get_field('image_2'),'full');
									$magnific_image[0]=$in_image[0];
								}
								else if (get_field('video_2')!="")
								{
									$hide_second=true;
									$magnific_image[0]=get_iframe_src(get_field('video_2'));
									$vid_cl=" mfp-iframe";
								}
							}

							if (get_field('skip_to_external')=="1")
							{
								$href_val=get_field('ext_url');
								//CHECK IF PROJECT URL IS SET
								if ($href_val=="")
									$href_val=get_permalink();
								//ADD HTTP PREFIX IF NEEDED
								if (substr($href_val,0,7)!="http://" && substr($href_val,0,8)!="https://")
									$href_val="http://".$href_val;
							}
							else
							{
								if ($make_lbox=="no" || $mini_sliders=="yes")
								{
									$href_val=get_permalink();
								}
								else
								{
									$href_val=$magnific_image[0];
								}
							}
							?>
							
						
                            <div class="grid_image_wrapper boxed_shadow">
								<?php 
									$jumper=2;
									if ($make_lbox=="no" && $mini_sliders=="no")
									{
										?>
										<div class="prk_magnificent body_bk_color<?php echo $vid_cl;?>" data-mfp-src="<?php echo "$magnific_image[0]"; ?>">
											<div class="navicon-expand-2"></div>
										</div>
										<?php
									}
									if ($make_lbox=="no" && $mini_sliders=="yes" && get_field('skip_featured')!=1)
									{
										?>
										<div class="prk_magnificent_li prk_magnificent_li_outer  body_bk_color" data-mfp-src="<?php echo $magnific_image[0]; ?>">
											<div class="navicon-expand-2"></div>
										</div>
										<?php
									}
									if ($make_lbox=="no" && $mini_sliders=="yes" && get_field('skip_featured')==1)
									{
										$jumper=3;
										if (get_field('image_2')!="")
                                        {
                                        	$in_image=wp_get_attachment_image_src(get_field('image_2'),'full');
                                       		?>
											<div class="prk_magnificent_li prk_magnificent_li_outer body_bk_color" data-mfp-src="<?php echo $in_image[0]; ?>">
												<div class="navicon-expand-2"></div>
											</div>
											<?php
                                        }
                                        //VIDEO
                                        if (0)
                                        {
                                        	echo '<div class="prk_magnificent_li prk_magnificent_li_outer body_bk_color mfp-iframe" data-mfp-src="'.get_iframe_src(get_field('image_2')).'">';
                                            echo '<div class="navicon-expand-2"></div>';
                                            echo '</div>';
                                        }
									}
								?>
                            	<a href="<?php echo $href_val; ?>" class="<?php if ($make_lbox=="yes" && $mini_sliders=="no"){echo "magna_a";} else {  if (get_field('skip_to_external')==0) {echo "fade_anchor";}} ?>" data-color="<?php echo $featured_color; ?>">
                                <div id="grid_title-<?php the_ID(); ?>" class="grid_single_title">
                                    <div class="prk_ttl">
                                    	<h3 class="header_font body_bk_color body_bk_text_shadow small">

                                    		<?php the_title(); ?>

                                    	</h3>
                                    </div>
									<?php
										if ($prk_astro_options['show_heart_folio']=="1")
		                                {
		                                    echo '<div class="prk_heart_masonry">';
		                                    	echo get_folio_like(get_the_ID(),true);
		                                    echo '</div>';
		                                }
										if ($skills_output!="" && $astro_show_skills==true)
										{
											?>
											<div class="inner_skills body_bk_color site_background_colored">
												<?php echo $skills_output; ?>
											</div>
											<?php
										}

                                    ?>
                                </div>
                                	<div class="grid_colored_block">
									</div>
									<?php 
	                                    if (has_post_thumbnail( $post->ID ) )
	                                    {
											if ($cols_number=="3")
											{
												$forced_w=480;
											}
											else
											{
												$forced_w=round(1820/$cols_number);
											}
											//SET A MINIMUM VALUE FOR RESPONSIVENESS
											if ($forced_w<420)
	                                			$forced_w=420;
											$vt_image = vt_resize( '', $image[0] ,$forced_w ,'' , false , $retina_flag );
											?>
											<div id="tiny_slider-<?php echo $post->ID;?>" <?php if ($mini_sliders=="yes"){echo 'class="tiny_slider per_init"';} ?>>
												<ul class="slides">
													<li>
														<img src="<?php echo $vt_image['url']; ?>" width="<?php echo $vt_image['width']; ?>" height="<?php echo $vt_image['height']; ?>" id="home_fader-<?php the_ID(); ?>" class="custom-img grid_image" data-featured="no" alt="" />
														<?php
															if ($mini_sliders=="yes") 
															{
																//PLACE THE OTHER NINETEEN IMAGES
						                                        for ($count=$jumper;$count<21;$count++)
						                                        {
					                                                if (get_field('image_'.$count)!="")
					                                                {
					                                                	echo "</li>";
					                                                	echo "<li>";
					                                                	$in_image=wp_get_attachment_image_src(get_field('image_'.$count),'full');
					                                               		$vt_image = vt_resize( '', $in_image[0] , $forced_w, '', false , $retina_flag );
					                                                	echo '<img src="'.$vt_image['url'].'" width="'. $vt_image['width'] .'" height="'. $vt_image['height'] .'" class="grid_image" alt="" />';
					                                                    if ($count==2 && $hide_second==true) 
					                                                    {

					                                                    }
					                                                	else
					                                                	{
					                                                    	echo '<div class="prk_magnificent_li" data-mfp-src="'.$in_image[0].'"></div>';
					                                                    }
					                                                }
					                                                //VIDEO SUPPORT
					                                            	if (0)
					                                                {
					                                                	echo '<div class="prk_magnificent_li body_bk_color mfp-iframe" data-mfp-src="'.get_iframe_src(get_field('video_'.$count)).'">';
					                                                    echo '<div class="navicon-expand-2"></div>';
					                                                    echo '</div>';
					                                                }
						                                        }
						                                    }
														?>
													</li>
			                                	</ul>
			                                </div>
											<?php
	                                    }
                                    ?>
                                <!-- FOR IE 10 NO DISPLAY BUG -->
                                <img src="<?php echo $vt_image['url']; ?>" class="hide_now" alt="" />
                                </a>
                            </div>
							</div>
						<?php $ins++; ?>
					<?php 
						endwhile; 
						echo "</div></div></div>";
						//SHOW BUTTON TO SHOW MORE POSTS ONLY IF NEEDED
						if ($paged!=$my_query->max_num_pages) {
							?>
							<div class="clearfix"></div>
							<div id="prk_pusher"></div>
							<div id="next_portfolio_masonry" class="row">
								<div class="navigation twelve">	
									<div class="next-posts">
										<div id="nbr_helper" data-pir_curr="<?php echo $paged; ?>" data-pir_max="<?php echo $my_query->max_num_pages; ?>">
											<div id="pages_static_nav">
				                                <a href="#" class="prk_feedback header_font">
				                                   	<span class="prk_blink">
				                                   		<?php echo($prk_translations['load_more']); ?>
				                                   	</span>
				                                </a>
				                            </div>
				                            
				                            <div class="nx_lnk_wp">
				                                <?php next_posts_link('',$my_query->max_num_pages); ?>
				                            </div>
										</div>
									</div>
								</div><!-- navigation -->
							</div>
							<div class="clearfix"></div>
							<div id="no_more" class="header_font">
			                    <div id="in_no_more" class="header_font"><?php echo($prk_translations['no_more_text']); ?></div>
			                    <div class="clearfix"></div>
			                </div>
							<?php
						}
					endif;
        ?>
    </div>
</div>
</div>
</div>
</div>
</div>
<?php
}//MASONRY
if ($prk_astro_options['archives_ptype']=="carousel")
{
	get_header();
	global $retina_device;
	$retina_flag = $retina_device === "prk_retina" ? true : false;
	$astro_show_skills=false;
	//OVERRIDE OPTIONS - ONLY FOR PREVIEW MODE
	if (INJECT_STYLE) {
		include_once(ABSPATH . 'wp-content/plugins/color-manager-astro/style_header.php');	
	}
?>
<div id="centered_block"> 
<div id="main_block" class="row fff_folio page-<?php echo get_the_ID(); ?>">
    <div id="content">
      	<div id="main" class="main_no_sections">
      			<div class="row prk_row">
      		<div id="folio_father" class="columns twelve has_carousel">
				<?php
				$inside_filter="";
				$make_lbox="no";
				if (get_field('portfolio_filter')!="")
				{
					$filter=get_field('portfolio_filter');
					foreach ($filter as $child)
					{
						//ADD THE CATEGORIES TO THE FILTER
						$inside_filter.=$child->slug.", ";
					}
				}
				if (get_field('use_lightbox')=="1")
				{
					$make_lbox="yes";
				}
			?>
		<?php
		$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
		$my_query = new WP_Query();
		$args = array( 	'post_type' => 'pirenko_portfolios', 
						'portfolio_tag'=>$term->slug,
						'posts_per_page'=>999
					);
		$my_query->query($args);
        if ($my_query->have_posts()) : 
			$ins=0;
			echo "<div id='folio_carousel' class='accordion-slider' data-columns='3'>";
			echo "<div class='as-panels'>";
				while ($my_query->have_posts()) : $my_query->the_post();
					if (get_field('featured_color')!="")
				    {
				        $featured_color=get_field('featured_color');
				        $featured_class='featured_color';
				    }
				    else
				    {
				        $featured_color="default";
				        $featured_class="";
				    }
					$skills_links="";
					$skills_names="";
					$skills_yo="";
					$skills_output="";
					$terms = get_the_terms ($post->ID, 'pirenko_skills');
					if (!empty($terms))
					{
						foreach ($terms as $term) {
							$skills_links[] = $term->slug;
							$skills_names[] = $term->name;
							}
					
						$skills_yo = join(" ", $skills_links);
						$skills_output = join(", ", $skills_names);
					}
					if (has_post_thumbnail( $post->ID))
					{
					?>
						<div id="prk_panel-<?php echo $ins; ?>" class="as-panel" data-id="id-<?php echo $ins; ?>" data-color="<?php echo $featured_color; ?>">
							<div class="prk-panel">
							<?php 
								//GET THE FEATURED IMAGE
								$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
								$magnific_image[0]=$image[0] = get_image_path($image[0]);
								if (get_field('skip_to_external')=="1")
								{
									//CHECK IF PROJECT URL IS SET
									if (get_field('ext_url')!="")
										$href_val=get_field('ext_url');
									//ADD HTTP PREFIX IF NEEDED
									if (substr($href_val,0,7)!="http://" && substr($href_val,0,8)!="https://")
										$href_val="http://".$href_val;
									$go_out="prk_ext_link";
								}
								else
								{
									if ($make_lbox=="no")
									{
										$href_val=get_permalink();
									}
									else
									{
										$href_val="#";
									}
									$go_out="fade_anchor";
								}
								$hide_second=false;
								$vid_cl="";
								if (get_field('skip_featured')=="1")
								{
									//CHECK IF THERE'S A SECOND IMAGE
									if (get_field('image_2')!="")
									{
										$hide_second=true;
										$magnific_image[0]=get_field('image_2');
									}
									else if (get_field('video_2')!="")
									{
										$magnific_image[0]=get_iframe_src(get_field('video_2'));
										$vid_cl=" mfp-iframe";
									}
								}
								$vt_image = vt_resize( '', $image[0] , 1820, 1200, false , $retina_flag);
							?>
							<a href="<?php echo $href_val; ?>" class="prk_panel_lnk <?php echo $go_out; if ($make_lbox=="yes"){echo ' magna_a';} ?>" data-mfp-src="<?php echo $image[0]; ?>">
								<img class="as-background" src="<?php echo $vt_image['url']; ?>" alt="" />
							</a>
							<div class="header_font as-layer as-closed as-prk-rotated" data-position="bottomLeft" data-horizontal="20px" data-vertical="20px" data-show-transition="left" data-show-delay="300" data-hide-transition="right">
						        <h2 class="as-layer as-padding as-black small"><?php the_title(); ?></h2>
						    </div>
						    <div class="as-layer as-opened as-prk-bottom" data-width="96%" data-horizontal="2%" data-show-delay="700" data-vertical="100%">
						    	<div class="titled_block">
                                    <div class="grid_single_title" id="grid_title-<?php the_ID(); ?>">
                                        <a href="<?php echo $href_val; ?>" class="<?php echo $go_out; if ($make_lbox=="yes"){echo ' magna_b';} ?>" data-ajax_id="<?php the_ID(); ?>" data-ajax_order="<?php echo $ins; ?>" data-color="<?php echo $featured_color; ?>" data-mfp-src="<?php echo $image[0]; ?>">
                                        	<h1 class="header_font"><?php the_title(); ?></h1>
                                       	</a>
                                        <?php 
											if ($skills_output!="" && $astro_show_skills==true)
											{
												?>
												<div class="clearfix"></div>
												<div class="inner_skills fade_anchor">
													<h5 class="small">
													<?php echo " ".get_the_term_list(get_the_ID(),'pirenko_skills',"",", "); ?>
													</h5>
												</div>
												<?php
											}
											if ($prk_astro_options['show_heart_folio']=="1")
			                                {
			                                    echo '<div class="prk_heart_carousel site_background_colored">';
			                                    	echo get_folio_like(get_the_ID(),true);
			                                    echo '</div>';
			                                }
			                                //PLACE THE OTHER NINETEEN IMAGES
	                                        for ($count=2;$count<21;$count++)
	                                        {
	                                            if (get_field('image_'.$count)!="")
	                                            {
	                                            	$in_image=wp_get_attachment_image_src(get_field('image_'.$count),'full');
                                               		$vt_image = vt_resize( '', $in_image[0] , 1920, 1200, false , $retina_flag);
                                                    if ($count==2 && $hide_second==true) 
                                                    {

                                                    }
                                                	else
                                                	{
                                                    	echo '<a href="#" data-mfp-src="'.$vt_image['url'].'" class="magna_b magna_a"></a>';
                                                    }
                                                }
	                                               
	                                        }
                                        ?>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
						    </div>
							</div>
						</div>
						<?php $ins++; ?>
					<?php 
					}
						endwhile;
						echo "</div>";
						echo "</div>";
					 endif; 
        ?>
</div>
      	</div>
	</div>
</div>
</div>
</div>
<?php
}//CAROUSEL
?>
<?php get_footer(); ?>