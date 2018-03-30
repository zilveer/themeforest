<?php 
/*
Template Name: Portfolio - Masonry
*/
?>
<?php 
	get_header();
	global $retina_device;
	$retina_flag = $retina_device === "prk_retina" ? true : false;
	$show_title=false;
	$default_margin=0;
	$astro_show_filter=false;
	$ajax_single_layout="";
	$cols_number="3";
	$default_margin=get_field('thumbs_margin');
	if (get_field('show_skills')=="1")
		$astro_show_skills=true;
	else 
		$astro_show_skills=false;
	if (get_field('show_filter')=="1")
		$astro_show_filter=true;
	if (get_field('cols_number')!="")
		$cols_number=get_field('cols_number');
	$individual_lightbox="no";
	if (get_field('individual_lightbox')=="1")
		$individual_lightbox="yes";
	$make_lbox="no";
	if (get_field('use_lightbox')=="1")
		$make_lbox="yes";
	$posts_nr=get_field('astro_posts_nr');
	$thumbs_rollover_color=get_field('thumbs_rollover');
	$inside_filter="";
	//OVERRIDE OPTIONS - ONLY FOR PREVIEW MODE
	if (INJECT_STYLE)
	{
		include_once(ABSPATH . 'wp-content/plugins/color-manager-astro/style_header.php');	
	}
	$cats_counter=0;
	if (get_field('portfolio_filter')!="")
	{
		$filter=get_field('portfolio_filter');
		foreach ($filter as $child)
		{
			//ADD THE CATEGORIES TO THE FILTER
			$inside_filter.=$child->slug.", ";
			$cats_counter++;
		}
	}
	//ADD PROTECTED GALLERIES FEATURE
	if ( !post_password_required() ) 
	{
?>
<div id="centered_block"> 
<div id="main_block" class="row fff_folio page-<?php echo get_the_ID(); ?>">
    <div id="content">
      	<div id="main" class="main_no_sections">
      			<div class="row prk_row">
      		<div id="folio_father" class="columns twelve">
			<?php
	            if ($astro_show_filter==true)
				{
					?>
		            <div id="filter_top">
		                <?php
						if ($cats_counter>=1)
						{
							?>
                            <div id="pir_categories" class="cf">
                                <ul class="filter">
                                    <li class="active">
                                        <a class="all" data-filter="p_all" href="javascript:void(0)"><?php echo $prk_translations['all_text']; ?></a>
                                    </li>
									<?php
										$helper=0;
										foreach ($filter as $child)
										{
											echo '<li><a class="'.$child->slug.'" data-filter="'.$child->slug.'" href="javascript:void(0)">'.$child->name.'</a></li>';
										}
                                    ?>
                           		</ul>
                            </div>
                            <?php
						}
						else
						{
							?>
							<div id="pir_categories" class="cf">
								<?php 
									$terms = get_terms("pirenko_skills");
									$count = count($terms);
									if ( $count > 0 )
									{
										?>
										<ul class="filter">
											<li class="active">
												<a class="all" data-filter="p_all" href="javascript:void(0)"><?php echo $prk_translations['all_text']; ?></a>
											</li>
										<?php
										foreach ( $terms as $term ) 
										{
											echo '<li><a class="'.$term->slug.'" data-filter="'.$term->slug.'" href="javascript:void(0)">'.$term->name.'</a></li>';
										}
										echo "</ul>";
									}
								?>
							</div>
							<?php
						}
					?>
	                </div>
	            	<?php
	            }
			?>
		<?php
		$my_query = new WP_Query();
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		if (get_query_var('page')!="")
			$paged=get_query_var('page');
		$args = array( 
			'post_type' => 'pirenko_portfolios', 
			'paged' => $paged,
			'posts_per_page' => $posts_nr,
			'pirenko_skills'=>$inside_filter
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
						<div id="post-<?php the_ID(); ?>" class="<?php echo $featured_class; ?> portfolio_entry_li <?php echo $skills_yo; ?> p_all" data-id="id-<?php echo $ins; ?>" data-color="<?php echo $featured_color; ?>" style="<?php echo 'padding-right:'.$default_margin.'px;padding-bottom:'.$default_margin.'px'; ?>">
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
								if ($make_lbox=="no")
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
									if ($make_lbox=="no" && $individual_lightbox=="no")
									{
										?>
										<div class="prk_magnificent body_bk_color<?php echo $vid_cl;?>" data-mfp-src="<?php echo "$magnific_image[0]"; ?>">
											<div class="navicon-expand-2"></div>
										</div>
										<?php
									}
									if ($make_lbox=="no" && $individual_lightbox=="yes" && get_field('skip_featured')!=1)
									{
										?>
										<div class="prk_magnificent_li prk_magnificent_li_outer  body_bk_color" data-mfp-src="<?php echo $magnific_image[0]; ?>">
											<div class="navicon-expand-2"></div>
										</div>
										<?php
									}
									if ($make_lbox=="no" && $individual_lightbox=="yes" && get_field('skip_featured')==1)
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
									//ASSIGN CORRECT CLASS
									$special_class="";
									$special_class_low="";
									if ($make_lbox=="yes" && $individual_lightbox=="no"){
										$special_class="magna_a";
									} 
									else 
									{
										if ($make_lbox=="yes" && $individual_lightbox=="yes")
										{
											$special_class="magna_conf";
											$special_class_low=" conf";
										}
										else
										{
											if (get_field('skip_to_external')==0) 
											{
												$special_class="fade_anchor";
											}
										}
									}
								?>
                            	<a href="<?php echo $href_val; ?>" class="<?php echo $special_class;echo $vid_cl; ?>" data-color="<?php echo $featured_color; ?>">
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
											if ($cols_number==0)
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
											<div id="individual_lightbox-<?php echo $post->ID;?>" <?php if ($individual_lightbox=="yes"){echo 'class="individual_lightbox per_init'.$special_class_low.'"';} ?>>
												<ul class="slides">
													<li>
														<img src="<?php echo $vt_image['url']; ?>" width="<?php echo $vt_image['width']; ?>" height="<?php echo $vt_image['height']; ?>" id="home_fader-<?php the_ID(); ?>" class="custom-img grid_image" data-featured="no" alt="" />
														<?php
															if ($individual_lightbox=="yes") 
															{
																if (get_field('use_gallery')!="images_only")
                                                				{
																	//PLACE THE OTHER NINETEEN IMAGES
							                                        for ($count=$jumper;$count<21;$count++)
							                                        {
						                                                if (get_field('image_'.$count)!="")
						                                                {
						                                                	echo "</li>";
						                                                	$in_image=wp_get_attachment_image_src(get_field('image_'.$count),'full');
						                                               		$vt_image = vt_resize( '', $in_image[0] , 1820, 1200, false , $retina_flag );
						                                                	//echo '<li class="hide_now magna_conf" data-mfp-src="'.$in_image[0].'">';
						                                                    if ($count==2 && $hide_second==true) 
						                                                    {

						                                                    }
						                                                	else
						                                                	{
						                                                    	echo '<li class="hide_now prk_magnificent_li magna_conf" data-mfp-src="'.$in_image[0].'"></li>';
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
							                                    else
							                                    {
							                                    	$regex = '/(\w+)\s*=\s*"(.*?)"/';
				                                                    $pattern = '/\[gallery(.*?)\]/';
				                                                    preg_match_all($regex, get_post_meta($post->ID,'image_gallery',true), $matches);
				                                                    $stripped_gallery = array();
				                                                    for ($i = 0; $i < count($matches[1]); $i++) {
				                                                        $stripped_gallery[$matches[1][$i]] = $matches[2][$i];
				                                                    }
				                                                    if (!empty($stripped_gallery) && $stripped_gallery['ids']!="")
				                                                    {
				                                                        $array = explode(',', $stripped_gallery['ids']);
				                                                        foreach($array as $value)
				                                                        {
				                                                            echo "</li>";
				                                                            $in_image=wp_get_attachment_image_src($value,'full');
				                                                            $vt_image = vt_resize( '', $in_image[0] , 1820, 1200, false , $retina_flag );
						                                                	echo '<li class="hide_now magna_conf" data-mfp-src="'.$in_image[0].'">';
				                                                        }
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
}//PROTECTED GALLERY
else
{
	echo '<div id="centered_block"><div id="main_block"><div id="prk_protected" class="columns twelve centered">';
	while (have_posts()) : the_post();
    	the_content();   
    endwhile;
	if (INJECT_STYLE) 
	{
		echo '</div>For testing use this password: pass</div></div>';
	}
	else 
	{
    	echo '</div></div></div>';
    }
}
get_footer(); ?>