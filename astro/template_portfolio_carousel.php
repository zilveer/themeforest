<?php 
/*
Template Name: Portfolio - Carousel
*/
?>
<?php 
	get_header();
	global $retina_device;
	$retina_flag = $retina_device === "prk_retina" ? true : false;
	if (get_field('show_skills')=="1")
		$astro_show_skills=true;
	else 
		$astro_show_skills=false;
	//OVERRIDE OPTIONS - ONLY FOR PREVIEW MODE
	if (INJECT_STYLE) {
		include_once(ABSPATH . 'wp-content/plugins/color-manager-astro/style_header.php');	
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
		$my_query = new WP_Query();
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		if (get_query_var('page')!="")
			$paged=get_query_var('page');
		$args = array( 
			'post_type' => 'pirenko_portfolios', 
			'paged' => $paged,
			'posts_per_page' => 999,
			'pirenko_skills'=>$inside_filter
			);
		$my_query->query($args);
        if ($my_query->have_posts()) : 
			$ins=0;
			if (get_field('show_titles')=='0')
			{
				$extra_class=" prk_no_titles";
			}
			else
			{
				$extra_class="";
			}
			echo "<div id='folio_carousel' class='accordion-slider".$extra_class."' data-columns=".get_field('columns_number').">";
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
							<a href="<?php echo $href_val; ?>" class="prk_panel_lnk <?php echo $go_out; if ($make_lbox=="yes"){echo ' magna_a';} echo $vid_cl; ?>" data-mfp-src="<?php echo $magnific_image[0]; ?>">
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