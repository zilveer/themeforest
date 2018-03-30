<?php 
/**
 *	Template Name: HomePage 2
 *
 *	The template is homep
 */
get_header(); 

$homepage_blocks = (isset($smof_data['home2_homepage_blocks2'])) ? $smof_data['home2_homepage_blocks2']['enabled'] : array();
$i = 0;
$blockscount = count($homepage_blocks);


$paralax_body = '-webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;';
$paralax_header = 'no-repeat center center ';
?>
<div id="href_home"></div>
<?php
if ($blockscount > 0)
	foreach ($homepage_blocks as $key => $value) :
		$i++;
		switch ($key) :
			case 'intro_text':

			if ((isset($smof_data['home2_Introduction_bg'] )) && ($smof_data['home2_Introduction_bg']!=="") ) {
		 		$Introduction_bg = $smof_data['home2_Introduction_bg'];
		 	}else{
				$Introduction_bg = "";
			}
			if ((isset($smof_data['home2_Introduction_color'] )) && ($smof_data['home2_Introduction_color']!=="") ) {
		 		$Introduction_color = $smof_data['home2_Introduction_color'];
		 	}else{
				$Introduction_color = "#fafafa";
			}

			?>
			</section>
			<div id="href_intro"></div>
			<div class="flatintro" style="background:url(<?php echo $Introduction_bg ;?>) <?php echo $Introduction_color ;?>;overflow:auto;">
				<section class="container">
				<div class="grid12 col">
					<h1 class="page-title1 fadeitin"><?php echo $smof_data['home2_homepage_intro_header'] ?></h1>

					<p class="page-title2 fadeitin"><?php echo do_shortcode($smof_data['home2_homepage_intro_text']) ?></p>
					<p class="centerbut fadeitin">
  						<a href="<?php echo $smof_data['home2_homepage_intro_link'] ?>" class="new_intro_button color2"><?php echo $smof_data['home2_homepage_intro_link_text'] ?></a>

  						<a href="<?php echo $smof_data['home2_homepage_intro_link2'] ?>" class="new_intro_button color1"><?php echo $smof_data['home2_homepage_intro_link_text2'] ?></a>
  					</p>
				</div>
				</section>
			</div>
			<section class="container">
				<?php 
				break;

			case 'general':
			if ((isset($smof_data['home2_general_bg'] )) && ($smof_data['home2_general_bg']!=="") ) {
		 		$general_bg = $smof_data['home2_general_bg'];
		 	}else{
				$general_bg = "";
			}
			if ((isset($smof_data['home2_general_color'] )) && ($smof_data['home2_general_color']!=="") ) {
		 		$general_color = $smof_data['home2_general_color'];
		 	}else{
				$general_color = "#eee";
			}

			if ((isset($smof_data['home2_general_title_color'] )) && ($smof_data['home2_general_title_color']!=="") ) {
		 		$general_title_color = $smof_data['home2_general_title_color'];
		 	}else{
				$general_title_color = "#000";
			}
			if ((isset($smof_data['home2_general_text_color'] )) && ($smof_data['home2_general_text_color']!=="") ) {
		 		$general_text_color = $smof_data['home2_general_text_color'];
		 	}else{
				$general_text_color = "#444";
			}	 ?>
			</section>
			<div id="href_general"></div>
			<div class="flattext" style="background:url(<?php echo $general_bg ;?>) <?php echo $general_color ;?>;">

				<section class="container">
				<div class="grid12 col">

					<div class="grid6 col alpha">
						<p class="text_title fadeitin" style="color:<?php echo $general_title_color ;?>;">
							<?php if (isset($smof_data['home2_General_title'] )) echo do_shortcode($smof_data['home2_General_title']) ?>
						</p>
						<p class="text_text fadeitin" style="color:<?php echo $general_text_color ;?>;">
						<?php echo do_shortcode($smof_data['home2_homepage_general_text']) ?>

			
 						</p>
						 <?php if (!empty($smof_data['home2_General_link'])) : ?>
						<p class="under_button fadeitin">
							<a class="text_text new_button3 color2 under_button" href="<?php echo $smof_data['home2_General_link']; ?>">Click Here</a>
						</p>

						 
						<?php endif; ?>


					</div>
					<div class="grid6 col img_general omega">
						
						<?php if ((isset($smof_data['home2_General_image'] )) && ($smof_data['home2_General_image']!=="") ) {?>
								<img class="flattextimg" src="<?php echo do_shortcode($smof_data['home2_General_image']) ?>" alt="img02">
						<?php } ?>
						
					<div class="clearfix"></div>
					</div>

				</div>	<!-- end 12 cols -->
				<div class="clearfix"></div>

				</section>
			</div>
			<section class="container">
				<?php 
				break;


			case 'general2':

			if ((isset($smof_data['home2_general2_bg'] )) && ($smof_data['home2_general2_bg']!=="") ) {
		 		$general2_bg = $smof_data['home2_general2_bg'];
		 	}else{
				$general2_bg = "";
			}
			if ((isset($smof_data['home2_general2_color'] )) && ($smof_data['home2_general2_color']!=="") ) {
		 		$general2_color = $smof_data['home2_general2_color'];
		 	}else{
				$general2_color = "#fff";
			}

			if ((isset($smof_data['home2_general2_title_color'] )) && ($smof_data['home2_general2_title_color']!=="") ) {
		 		$general2_title_color = $smof_data['home2_general2_title_color'];
		 	}else{
				$general2_title_color = "#000";
			}
			if ((isset($smof_data['home2_general2_text_color'] )) && ($smof_data['home2_general2_text_color']!=="") ) {
		 		$general2_text_color = $smof_data['home2_general2_text_color'];
		 	}else{
				$general2_text_color = "#444";
			}


			 ?>

			</section>
			<div id="href_general2"></div>
			<div class="flattext" style="background:url(<?php echo $general2_bg ;?>) <?php echo $general2_color ;?>;">

				<section class="container">

				<!-- Version two -->
				<div class="grid12 col">

					<div class="grid6 col img_general alpha">
						
						<?php if ((isset($smof_data['home2_General2_image'] )) && ($smof_data['home2_General2_image']!=="") ) {?>
								<img class="flattextimg" src="<?php echo do_shortcode($smof_data['home2_General2_image']) ?>" alt="img02">
						<?php } ?>
						
					<div class="clearfix"></div>
					</div>

					<div class="grid6 col omega">
						<p class="text_title fadeitin" style="color:<?php echo $general2_title_color ;?>;">
							<?php if (isset($smof_data['home2_General2_title'] )) echo do_shortcode($smof_data['home2_General2_title']) ?>
						</p>
						<p class="text_text fadeitin" style="color:<?php echo $general2_text_color ;?>;">
						<?php echo do_shortcode($smof_data['home2_homepage_general2_text']) ?>
						</p>
						 <?php if (!empty($smof_data['home2_General2_link'])) : ?>
						<p class="under_button fadeitin">
							<a class="text_text new_button3 color2 under_button" href="<?php echo $smof_data['home2_General2_link']; ?>">Click Here</a>
						</p>

						<?php endif; ?>

					</div>

				</div>	<!-- end 12 cols v2 -->
				
				</section>
			</div>
			<section class="container">
				<?php 
				break;

			case 'revolution_slider':	 ?>
				</section>
				<div id="href_revolution_slider"></div>
					<div class="grid12 col">
							 
						<?php putRevSlider( $smof_data['home2_revolution_slider_id'] ) ?>

					</div>
					<section class="container">
				<?php 
				break;

			case 'layerslider':
				?>
					</section>
					<div id="href_layerslider"></div>
						<div class="grid12 col">
							<?php if( function_exists('layerslider') ) layerslider($smof_data['home2_layer_slider_id'] ); ?>
						</div>
						<section class="container">
				<?php 
				break;

			case 'roundabout':
				if (empty($smof_data['home2_homepage_slider'])) break;
								wp_enqueue_script('roundabout', get_template_directory_uri() . '/js/jquery.roundabout.min.js', array('jquery', 'common-js')); ?>

								</section>
			<div class="flatround">
				<section class="container">

						<div class="grid12 col">
							<div class="roundabout">
								<ul>
				<?php foreach ($smof_data['home2_homepage_slider'] as $key => $value) :
							$thumb_image_url = ($value['url']) ? aq_resize( $value['url'], 940, 480, true, true, true ) : get_template_directory_uri() . '/img/940x480.gif' ?>
									<li>
										<div class="info">
											<img src="<?php echo $thumb_image_url; ?>" alt="" class="scale" />
				<?php if(!empty($value['description'])) : ?>
											<div class="text boldround"><p><?php echo $value['description']; ?><?php if(!empty($value['link'])) : ?><a href="<?php echo $value['link']; ?>" class="link"><span></span></a><?php endif; ?></p></div>
				<?php endif; ?>
										</div>
									</li>
				<?php endforeach; ?>
								</ul>
							</div>
						</div>

						</section>
			</div>
			<section class="container">

				<?php 
				break;

			case 'panorama360':
				if (empty($smof_data['home2_panorama_image'])) break;
								wp_enqueue_script('panorama360', get_template_directory_uri() . '/js/jquery.panorama360.min.js', array('jquery', 'common-js'));
								list($panorama_width, $panorama_height) = getimagesize($smof_data['home2_panorama_image']); ?>
						</section>
						<div class="flatpano">
						<section class="container">
							<div class="panorama">
								<div class="preloader"></div>
								<div class="panorama-view">
									<div class="panorama-container">
										<img src="<?php echo $smof_data['home2_panorama_image']; ?>" data-width="<?php echo $panorama_width; ?>" data-height="<?php echo $panorama_height; ?>" alt="" />
									</div>
								</div>
							</div>
						<!-- </div> -->
						</section>
						</div>
						<section class="container">
				<?php 
				break;

			case 'video':
				if (empty($smof_data['home2_video_embed'])) break; 

				if ((isset($smof_data['home2_Video_bg'] )) && ($smof_data['home2_Video_bg']!=="") ) {
			 		$Video_bg = $smof_data['home2_Video_bg'];
			 	}else{
					$Video_bg = "";
				}
				if ((isset($smof_data['home2_Video_color'] )) && ($smof_data['home2_Video_color']!=="") ) {
			 		$Video_color = $smof_data['home2_Video_color'];
			 	}else{
					$Video_color = "#313a43";
				}
				if ((isset($smof_data['home2_video_title_color'] )) && ($smof_data['home2_video_title_color']!=="") ) {
			 		$video_title_color = $smof_data['home2_video_title_color'];
			 	}else{
					$video_title_color = "#333";
				}
				if ((isset($smof_data['home2_video_tagline_color'] )) && ($smof_data['home2_video_tagline_color']!=="") ) {
			 		$video_tagline_color = $smof_data['home2_video_tagline_color'];
			 	}else{
					$video_tagline_color = "#555";
				}

				$video_bg_paralax = ($smof_data['home2_video_bg_paralax'] == 1) ? $paralax_body : '' ;
				$video_bg_paralax2 = ($smof_data['home2_video_bg_paralax'] == 1) ? 'fixed' : '' ; 
  				$video_paralax_header = ($smof_data['home2_video_bg_paralax'] == 1) ? $paralax_header : '';
				?>
				</section>
				<div id="href_video"></div>
					<div class="flatvideo" style="background:url(<?php echo $Video_bg ;?>) <?php echo $video_paralax_header ;?> <?php echo $video_bg_paralax2 ?>  <?php echo $Video_color ;?>;overflow:auto;
						<?php echo $video_bg_paralax ;?>
						">
						<section class="container">

						<div class="grid12 col">

							<?php if ((isset($smof_data['home2_video_logo'] )) && ($smof_data['home2_video_logo']!=="") ) { ?>
								<div class="blog_img_div">
	 								<img src="<?php echo do_shortcode($smof_data['home2_video_logo']); ?>" class="new_blog_img fadeitin" alt="" />
	 							</div>
 							<?php } ?>
  							<h2 class="home_video_title fadeitin" style="color:<?php echo $video_title_color ;?>;"><?php if (isset($smof_data['home2_Video_title'] )) echo do_shortcode($smof_data['home2_Video_title']) ?>
							</h2>
							<div class="med_text_span">
								<p class="med_text_video fadeitin" style="color:<?php echo $video_tagline_color ;?>;"><?php echo do_shortcode($smof_data['home2_video_text']); ?></p>
							</div>

							<div class="video-container video-container2">
								<div class="video-wrapper fadeitin">
									<?php echo $smof_data['home2_video_embed']; ?>
								</div>
							</div>
						</div>

						</section>
					</div>
				<section class="container">
				<?php 
				break;

			case 'call_to_action': 

			if ((isset($smof_data['home2_call_bg'] )) && ($smof_data['home2_call_bg']!=="") ) {
		 		$call_bg = $smof_data['home2_call_bg'];
		 	}else{
				$call_bg = "";
			}
			if ((isset($smof_data['home2_call_color'] )) && ($smof_data['home2_call_color']!=="") ) {
		 		$call_color = $smof_data['home2_call_color'];
		 	}else{
				$call_color = "#f6653c";
			}

			$call_bg_paralax = ($smof_data['home2_call_bg_paralax'] == 1) ? $paralax_body : '' ; 
 		 	$call_paralax_header = ($smof_data['home2_call_bg_paralax'] == 1) ? $paralax_header : '';
			$call_bg_paralax2 = ($smof_data['home2_call_bg_paralax'] == 1) ? 'fixed' : '' ;

			?>
			</section>
			<div id="href_call"></div>
			<div class="flatcall" style="background:url(<?php echo $call_bg ;?>) <?php echo $call_paralax_header ;?> <?php echo $call_bg_paralax2 ;?>  <?php echo $call_color ;?>;overflow:auto;
				 <?php echo $call_bg_paralax ;?>
				">
				<section class="container">

				<div class="grid12 col">
					<div class="call-to-action clearfix">
						<div class="left fadeitin">
							<h3><?php echo $smof_data['home2_call_to_action_title']; ?></h3>
							<p><?php echo $smof_data['home2_call_to_action_text']; ?></p>
						</div>
						<p class="centerbut2 fadeitin"><a class="new_button" href="<?php echo $smof_data['home2_call_to_action_button_url']; ?>"><?php echo $smof_data['home2_call_to_action_button_text']; ?></a></p>
					</div>
				</div>

				</section>
			</div>
				<section class="container">
		<?php 
		break;

		case 'blog': 

		if ((isset($smof_data['home2_blog_bg'] )) && ($smof_data['home2_blog_bg']!=="") ) {
	 		$blog_bg = $smof_data['home2_blog_bg'];
	 	}else{
			$blog_bg = '';
			//get_template_directory_uri() ."/img/pattern-white.png"
		}
		if ((isset($smof_data['home2_blog_color'] )) && ($smof_data['home2_blog_color']!=="") ) {
	 		$blog_color = $smof_data['home2_blog_color'];
	 	}else{
			$blog_color = "#86c9ef";
		}

		if ((isset($smof_data['home2_blog_title_color'] )) && ($smof_data['home2_blog_title_color']!=="") ) {
	 		$blog_title_color = $smof_data['home2_blog_title_color'];
	 	}else{
			$blog_title_color = "#333";
		}
		if ((isset($smof_data['home2_blog_tagline_color'] )) && ($smof_data['home2_blog_tagline_color']!=="") ) {
	 		$blog_tagline_color = $smof_data['home2_blog_tagline_color'];
	 	}else{
			$blog_tagline_color = "#555";
		}	?>


		</section>
		<div id="href_blog"></div>
		<?php $blog_bg_paralax = ($smof_data['home2_blog_bg_paralax'] == 1) ? $paralax_body : '' ; ?>
		<?php $blog_bg_paralax2 = ($smof_data['home2_blog_bg_paralax'] == 1) ? 'fixed' : '' ; 
		  $blog_paralax_header = ($smof_data['home2_blog_bg_paralax'] == 1) ? $paralax_header : '';
		?>
			<div class="flatblog" style="background:url(<?php echo $blog_bg ;?>) <?php echo $blog_paralax_header ;?> <?php echo $blog_bg_paralax2 ?> <?php echo $blog_color ;?>;overflow:auto;
		<?php echo $blog_bg_paralax ;?>
				">
		<section class="container">

		 <div class="grid12 col">
		 	<?php if ((isset($smof_data['home2_blog_logo'] )) && ($smof_data['home2_blog_logo']!=="") ) { ?>
		 	<div class="blog_img_div">
		 	<img src="<?php echo do_shortcode($smof_data['home2_blog_logo']); ?>" class="new_blog_img fadeitin" alt="" />
		 	</div>
		 	<?php } ?>
		  <h2 class="home_blog_title fadeitin" style="color:<?php echo $blog_title_color ;?>;"><?php echo do_shortcode($smof_data['home2_blog_title']); ?>
		</h2>
		<div class="med_text_span">
		<p class="med_text fadeitin"  style="color:<?php echo $blog_tagline_color ;?>;"><?php echo do_shortcode($smof_data['home2_blog_text']); ?></p>
		</div>
		<p></p>
		</div>   	
		<?php
		$journal_grid_no = 4;
		$show_details_outside = 1;
		$sidebar_layout = (isset($smof_data['home2_sidebar_layout'])) ? $smof_data['home2_sidebar_layout'] : 'right';
		$enable_infinitescroll = $smof_data['home2_journal_infinitescroll'];
		$journal_category = rwmb_meta("base_category"); 
		$page_no = 1;
		$args = array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'paged' => $page_no
		);
		if (!empty($journal_category) && $journal_category != 0 ) {
			$args['cat'] = $journal_category;
		}
		query_posts($args);
		if (have_posts()) :
			$pnum = 0;
			$pnum_count = (isset($smof_data['home2_blog_post_count'])) ? $smof_data['home2_blog_post_count'] : 3;

		 ?>
				<div class="clear"></div>
				<div class="isotope <?php if ($enable_infinitescroll) echo 'infinitescroll '; ?>clearfix">
		<?php while(have_posts()) :
				the_post();
				if ($pnum == $pnum_count) break;
				$pnum = $pnum +1;
				$categories = get_the_category();
				$filter = '';
				foreach ($categories as $category_value) {
					$filter .= 'category-' . $category_value->slug . ' ';
				}
				$filter = trim($filter);
				if ( (function_exists('has_post_thumbnail')) && has_post_thumbnail() ) :
					$full_image_url = wp_get_attachment_url( get_post_thumbnail_id(), 'full' );
					$thumb_image_url = aq_resize( $full_image_url, 960, 420, true );
				else :
					$thumb_image_url = get_template_directory_uri().'/img/480x320.gif';
				endif; 
				$post_type = rwmb_meta("post_type2");
				?>


		<?php if ($show_details_outside) : ?>
				<div class="grid4 col isotope-item fadeitin" data-id="item<?php the_id(); ?>" data-type="<?php echo $filter; ?>">
							
		 <?php if ($post_type == 'value3') :
		 			$sfiles = rwmb_meta('sound_file',array('type' => 'file' ));
		 			?><div class="audio_cont">
		 			<audio preload="auto" class="blog-audio" controls><?php
		 				foreach ( $sfiles as $sfile ) :
		 					if (empty($sfile)) break;
							echo $sfile['url'];	?>
		                    	<source src="<?php echo $sfile['url'];	?>">
							<?php
						endforeach; ?>
						</audio> 
						</div>
		            <div class="audio_blog_post blog_item">
		<?php elseif ($post_type == 'value2') : 
		$videos = rwmb_meta('blog_video');
		 ?>            	
					<?php if ( $videos && count($videos)>0 ) :
						foreach ( $videos as $video ) :
					  	if (empty($video)) break; ?>
							<div class="video-container  video_post2">
								<div class="video-wrapper  video_post2">
									<?php echo $video; ?>
								</div>
							</div>
					<?php break; endforeach; ?>
					<?php endif; ?>
					<div class="audio_blog_post2 blog_item">

			<?php elseif ($post_type == 'value4') : 
		$notes = rwmb_meta('blog_note');
		$a_note = rwmb_meta('blog_note_author');
		 ?>            	
					
		<div class="quote-note">
		                        <blockquote>
		                        <?php foreach ( $notes as $note ) :
					  				if (empty($note)) break; ?>
											<p><?php echo $note ?></p>
								<?php  endforeach; ?>
		                        
		                        	<cite><?php echo $a_note ?></cite></blockquote>
		                        <div class="clear"></div>
		                    </div>

					<div class="note_blog_post blog_item"> 

		<?php elseif ($post_type == 'value5') : 
		 
		$b_link = rwmb_meta('blog_link_url');
		 ?>            	
		<div class="link_post">

		 					<h5 class="normal_title"><span class="link_post_img"></span><a class="link_post_title" href="<?php echo $b_link ; ?>"><?php the_title(); ?></a></h5>
		 					<p>
								<?php echo $b_link ; ?>
		 					</p>
		</div>
					<div class="blog_post blog_item"> 
		<?php else :  ?>    
			 	<div class="thumb blog_item">
							<a href="<?php the_permalink(); ?>"><img src="<?php echo $thumb_image_url; ?>" class="scale" alt="" /></a>
							<div class="info pattern">

								<a href="<?php the_permalink(); ?>" class="button-link"></a>

							</div>
						</div>
					<div class="blog_post blog_item"> 
		<?php endif; ?>
			<div class="blog_post_title">
				<?php if (!($post_type == 'value5')) :  ?>    
						<h5 class="normal_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
					<?php endif; ?>
					</div>
						<div class="metablog">
							<p class="btitledate"><span class="firasdate"><span class="icon-date"></span><?php the_time(get_option('date_format') . ' ' . get_option('time_format')); ?></span></p>
						<?php if( function_exists('zilla_likes') ) {?>
						<span class="firasdate zlike">
							<?php if( function_exists('zilla_likes') ) zilla_likes(); ?>
						</span>
						<?php }?>

						</div>
						<div class="clearfix"></div>

						<div class="small_text3"><?php the_excerpt(); ?></div>
				</div>

					</div>
		<?php else: ?>
			<div class="grid<?php echo $journal_grid_no; ?> col isotope-item" data-id="item<?php the_id(); ?>" data-type="<?php echo $filter; ?>">
						<ul class="grid ngrid<?php echo $journal_grid_no; ?> cs-style-3"  >
							<li>
								<figure>
									<a href="<?php echo $full_image_url; ?>">
									<img src="<?php echo $thumb_image_url; ?>" alt="img04">
									</a>
									<figcaption>
										<h3><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h3>
										<span><?php the_time(get_option('date_format') . ' ' . get_option('time_format')); ?></span>
										
										<a href="<?php echo $full_image_url; ?>" class="fullsize car_fullport"></a>
		<?php if( function_exists('zilla_likes') ) {?>
									<div class="car_like2"><?php if( function_exists('zilla_likes') ) zilla_likes(); ?></div>				
										<?php }?>
									</figcaption>
								</figure>
							</li>
							</ul>
					</div>

		<?php endif; ?>

		<?php endwhile; ?>
				</div>

				<div class="clear"></div>

		<?php
			else:
				get_template_part( 'noresult' );
			endif; ?>
				</section>
					</div>
					<section class="container">
		<?php 
		break;

		case 'progress1':

			if ((isset($smof_data['home2_progress1_bg'] )) && ($smof_data['home2_progress1_bg']!=="") ) {
		 		$progress1_bg = $smof_data['home2_progress1_bg'];
		 	}else{
				$progress1_bg = "";
			}
			if ((isset($smof_data['home2_progress1_color'] )) && ($smof_data['home2_progress1_color']!=="") ) {
		 		$progress1_color = $smof_data['home2_progress1_color'];
		 	}else{
				$progress1_color = "#fff";
			}

			if ((isset($smof_data['home2_progress_title_color'] )) && ($smof_data['home2_progress_title_color']!=="") ) {
		 		$progress_title_color = $smof_data['home2_progress_title_color'];
		 	}else{
				$progress_title_color = "#333";
			}
			if ((isset($smof_data['home2_progress_tagline_color'] )) && ($smof_data['home2_progress_tagline_color']!=="") ) {
		 		$progress_tagline_color = $smof_data['home2_progress_tagline_color'];
		 	}else{
				$progress_tagline_color = "#555";
			}	 ?>

		</section>
		<div id="href_progress1"></div>
		<?php $progress_bg_paralax = ($smof_data['home2_progress_bg_paralax'] == 1) ? 'flatblog_paralax' : '' ; ?>
		<?php $progress_bg_paralax2 = ($smof_data['home2_progress_bg_paralax'] == 1) ? 'fixed' : '' ; ?>
					<div class="flatblog <?php echo $progress_bg_paralax ;?>" style="background:url(<?php echo $progress1_bg ;?>) <?php echo $progress_bg_paralax2 ;?> <?php echo $progress1_color ;?>;overflow:auto;">
						<section class="container">
							 <div class="grid12 col">
							 	<?php if ((isset($smof_data['home2_progress_logo'] )) && ($smof_data['home2_progress_logo']!=="") ) { ?>
							 		<div class="blog_img_div">
		 								<img src="<?php echo do_shortcode($smof_data['home2_progress_logo']); ?>" class="new_blog_img fadeitin" alt="" />
		 							</div>
		 						<?php } ?>
		  <h2 class="home_blog_title fadeitin" style="color:<?php echo $progress_title_color ;?>;"><?php echo do_shortcode($smof_data['home2_progress_title']); ?>       
		</h2>
		<div class="med_text_span">
		<p class="med_text fadeitin" style="color:<?php echo $progress_tagline_color ;?>;"><?php echo do_shortcode($smof_data['home2_progress_text']); ?></p>
		</div>
		</div> 
		<div class="clearfix"></div>
		<?php
				if (!empty($smof_data['home2_homepage_progress']))
				foreach ($smof_data['home2_homepage_progress'] as $key => $value) :
					$percent = ($value['link']) ? $value['link'] : 0;
					$p_color = ($value['color']) ? $value['color'] : '#95a5a6';
				?>				
				 <div class="progress-bar" data-percent="<?php echo $percent; ?>" data-color="<?php echo $p_color; ?>">
		                	<div></div>
		                    <span class="progress-title"><?php echo $value['title']; ?></span>
		         </div>

		<?php endforeach; ?> 
				</section>
					</div>
						<section class="container">
		<?php 
		break;

		case 'progress2': 
			if ((isset($smof_data['home2_progress2_bg'] )) && ($smof_data['home2_progress2_bg']!=="") ) {
		 		$progress2_bg = $smof_data['home2_progress2_bg'];
		 	}else{
				$progress2_bg = "";
			}
			if ((isset($smof_data['home2_progress2_color'] )) && ($smof_data['home2_progress2_color']!=="") ) {
		 		$progress2_color = $smof_data['home2_progress2_color'];
		 	}else{
				$progress2_color = "#fff";
			}

			if ((isset($smof_data['home2_progress2_title_color'] )) && ($smof_data['home2_progress2_title_color']!=="") ) {
		 		$progress2_title_color = $smof_data['home2_progress2_title_color'];
		 	}else{
				$progress2_title_color = "#333";
			}
			if ((isset($smof_data['home2_progress2_tagline_color'] )) && ($smof_data['home2_progress2_tagline_color']!=="") ) {
		 		$progress2_tagline_color = $smof_data['home2_progress2_tagline_color'];
		 	}else{
				$progress2_tagline_color = "#555";
			}

			$progress2_bg_paralax = ($smof_data['home2_progress2_bg_paralax'] == 1) ? 'flatblog_paralax' : '' ; 
		 	$progress2_bg_paralax2 = ($smof_data['home2_progress2_bg_paralax'] == 1) ? 'fixed' : '' ; 
					?>
		</section>
		<div id="href_progress2"></div>
		<div class="flatblog <?php echo $progress2_bg_paralax ;?>" style="background:url(<?php echo $progress2_bg ;?>) <?php echo $progress2_bg_paralax2 ;?> <?php echo $progress2_color ;?>;overflow:auto;">
						<section class="container">
		         
		          <div class="grid12 col">
		          	<?php if ((isset($smof_data['home2_progress2_logo'] )) && ($smof_data['home2_progress2_logo']!=="") ) { ?>
							 		<div class="blog_img_div">
		 								<img src="<?php echo do_shortcode($smof_data['home2_progress2_logo']); ?>" class="new_blog_img fadeitin" alt="" />
		 							</div>
		 						<?php } ?>
		  <h2 class="home_blog_title fadeitin" style="color:<?php echo $progress2_title_color ;?>;"><?php echo do_shortcode($smof_data['home2_progress2_title']); ?>       
		</h2>
		<div class="med_text_span">
		<p class="med_text fadeitin" style="color:<?php echo $progress2_tagline_color ;?>;"><?php echo do_shortcode($smof_data['home2_progress2_text']); ?></p>
		</div>
		</div> 

		<?php
			$columns = round(12 / count($smof_data['home2_homepage_progress2']));
				if (!empty($smof_data['home2_homepage_progress2']))
				foreach ($smof_data['home2_homepage_progress2'] as $key => $value) :
					$percent = ($value['link']) ? $value['link'] : 0;
					$p_color = ($value['color']) ? $value['color'] : '#95a5a6';
					
				?>

				<div class="grid<?php echo $columns; ?> col" >
		         
		                <div class="circular-bar-green donutalign firaschart" style="color:<?php echo $progress2_tagline_color ;?>;" data-percent="<?php echo $percent; ?>" data-color="<?php echo $p_color; ?>"></div>
		                <p class="textcenter med_text bold_progress" style="color:<?php echo $progress2_tagline_color ;?>;"><?php echo $value['title']; ?></p>
		            </div>
		         
		<?php
				endforeach;
		?> 
		<div class="clearfix"></div>


						</section>
					</div>
						<section class="container">
		<?php 
						break;

					case 'showcase': 
			if ((isset($smof_data['home2_showcase_bg'] )) && ($smof_data['home2_showcase_bg']!=="") ) {
		 		$showcase_bg = $smof_data['home2_showcase_bg'];
		 	}else{
				$showcase_bg = "";
			}
			if ((isset($smof_data['home2_showcase_color'] )) && ($smof_data['home2_showcase_color']!=="") ) {
		 		$showcase_color = $smof_data['home2_showcase_color'];
		 	}else{
				$showcase_color = "#86c9ef";
			}

			if ((isset($smof_data['home2_showcase_text_color'] )) && ($smof_data['home2_showcase_text_color']!=="") ) {
		 		$showcase_text_color = $smof_data['home2_showcase_text_color'];
		 	}else{
				$showcase_text_color = "#eee";
			}
					?>

		</section>
		<div class="flatshowcase" style="background:url(<?php echo $showcase_bg ;?>)  <?php echo $showcase_color ;?>;overflow:auto;">
						<section class="container">
		         
		<div class="grid12 col">
			<?php if ((isset($smof_data['home2_showcase_logo'] )) && ($smof_data['home2_showcase_logo']!=="") ) { ?>
		 	<div class="blog_img_div">
		 	<img src="<?php echo do_shortcode($smof_data['home2_showcase_logo']); ?>" class="new_blog_img fadeitin" alt="" />
		 	</div>
		 	<?php } ?>
			
							<h1 class="page-title3 fadeitin" style="color:<?php echo $showcase_text_color ;?>;"><?php echo $smof_data['home2_showcase_text'] ?></h1>

							
							<?php if ((isset($smof_data['home2_showcase_image'] )) && ($smof_data['home2_showcase_image']!=="") ) {?>
									<img class="showcase_img fadeitin fadeitin" src="<?php echo do_shortcode($smof_data['home2_showcase_image']) ?>">
								<?php } ?>

							
						</div>

			</section>
					</div>
						<section class="container">

				<?php 
				break;

			case 'features':
				$columns = round(12 / count($smof_data['home2_features_slider']));
				if (!empty($smof_data['home2_features_slider']))
					?>
				</section>
				<div id="href_features"></div>
					<div class="flatfeat">
				<section class="container">

				<?php
				foreach ($smof_data['home2_features_slider'] as $key => $value) :
					if (!empty($value['url'])) $thumb_image_url = aq_resize( $value['url'], 999,999 , true ); ?>
						<div class="grid<?php echo $columns; ?> col" >
						
				 <div class="demo-tiles">
				        <div class="span3">
				          <div class="tile">
				          	<?php if (!empty($value['url'])) : ?>
												<img src="<?php echo $value['url']; ?>" alt="" class="tile-image big-illustration fadeitin">
								<?php endif; ?>
				            <?php if (!empty($value['title'])) : ?>
											<h3 class="tile-title fadeitin"><?php echo $value['title']; ?></h3>
								<?php endif; ?>
				            <p class="tiledesc fadeitin"><?php echo $value['description']; ?></p>
				            <?php if (!empty($value['link'])) : ?>
												<!-- <p class="centerbut3 tilebut fadeitin"><a class="black_button" href="<?php echo $value['link']; ?>">Click Here</a></p> -->

												<div class="tile-button-div fadeitin">
                                          		  <a href="<?php echo $value['link']; ?>" class="tile-button">Click Here</a>
                                          		</div>

								<?php endif; ?>
				          </div>
				        </div>
			        </div>
				</div>
				<?php endforeach; ?>
			</section>
		</div>
			<section class="container">

			<?php 
			break;

			case 'work':
				$args = array(
					'post_type'   => array('portfolio','portfolio-items'),
					'post_status' => 'publish',
					'orderby' => 'menu_order date',
					 'meta_query' => array(
					 	array( // check if meta is emty (meaning it is featured by default)
							'key'     => 'portfolio_featured',
							'value'   => array(''),
							'compare' => 'NOT IN'
						),
					 	array( // check if meta is set to true
							'key'     => 'portfolio_featured',
							'value'   => 1,
							'compare' => '==',
							'type'    => 'NUMERIC'
						)
					),
				);
				$r = new WP_Query($args);
				if ($r->have_posts()) :

				if ((isset($smof_data['home2_work_bg'] )) && ($smof_data['home2_work_bg']!=="") ) {
			 		$work_bg = $smof_data['home2_work_bg'];
			 	}else{
					$work_bg = "";
				}
				if ((isset($smof_data['home2_work_color'] )) && ($smof_data['home2_work_color']!=="") ) {
			 		$work_color = $smof_data['home2_work_color'];
			 	}else{
					$work_color = "#333";
				}

				if ((isset($smof_data['home2_work_title_color'] )) && ($smof_data['home2_work_title_color']!=="") ) {
			 		$work_title_color = $smof_data['home2_work_title_color'];
			 	}else{
					$work_title_color = "#333";
				}
				if ((isset($smof_data['home2_work_more_color'] )) && ($smof_data['home2_work_more_color']!=="") ) {
			 		$work_more_color = $smof_data['home2_work_more_color'];
			 	}else{
					$work_more_color = "#333";
				}
				if ((isset($smof_data['home2_work_tagline_color'] )) && ($smof_data['home2_work_tagline_color']!=="") ) {
			 		$work_tagline_color = $smof_data['home2_work_tagline_color'];
			 	}else{
					$work_tagline_color = "#555";
				}

				$work_bg_paralax = ($smof_data['home2_work_bg_paralax'] == 1) ? $paralax_body : '' ; 
			 	$work_bg_paralax2 = ($smof_data['home2_work_bg_paralax'] == 1) ? 'fixed' : '' ; 
			 	$work_paralax_header = ($smof_data['home2_work_bg_paralax'] == 1) ? $paralax_header : '';

				 ?>
<?php endif; ?>
	</section>
	<div id="href_work"></div>
			<div class="flatcar" style="background:url(<?php echo $work_bg ;?>) <?php echo $work_paralax_header ;?> <?php echo $work_bg_paralax2 ;?>  <?php echo $work_color ;?>;overflow:auto;
				<?php echo $work_bg_paralax ;?>
				">
 			<section class="container clearfix">
       <div class="grid12 col">
        
        <!-- begin latest posts -->  
            <h2><a class="car_title fadeitin" style="color:<?php echo $work_title_color ;?>;"><?php echo do_shortcode($smof_data['home2_work_title']); ?></a>
         <?php if (!empty($smof_data['home2_work_link'])) : ?>						
            	<span class="more car_more_new fadeitin">
            	<a href="<?php echo $smof_data['home2_work_link']; ?>" style="color:<?php echo $work_more_color ;?>;"><?php echo do_shortcode($smof_data['home2_work_more_text']); ?></a>
            </span>
            <?php endif; ?>
        </h2>
            <span class="car-info fadeitin" style="color:<?php echo $work_tagline_color ;?>;"><?php echo do_shortcode($smof_data['home2_our_work_info']); ?></span>
            <!-- begin post carousel -->
            <ul class="post-carousel fadeitin">
<?php
	$j=0;
	while ($r->have_posts()) :
		$r->the_post();
		if ( (function_exists('has_post_thumbnail')) && has_post_thumbnail() ) :
			$full_image_url = wp_get_attachment_url( get_post_thumbnail_id(), 'full' );
			$thumb_image_url = aq_resize( $full_image_url, 400, 300, true );
		else :
			$full_image_url = get_template_directory_uri().'/img/940x480.gif';
			$thumb_image_url = get_template_directory_uri().'/img/400x300.gif';
		endif; ?>
		
<li class="entry">
	            	<ul class="grid cs-style-3 firas" >
					<li>				
						<figure>
							<img src="<?php echo $thumb_image_url; ?>" href="<?php echo $full_image_url; ?>" alt="img04">

							<figcaption>
								<h3><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h3>
								<span><?php the_time(get_option('date_format') . ' ' . get_option('time_format')); ?></span>
								<a href="<?php the_permalink(); ?>" class="car_more">More</a>
								<a href="<?php echo $full_image_url; ?>" class="fullsize car_full"></a>
								<?php if( function_exists('zilla_likes') ) {?>
							<div href="<?php the_permalink(); ?>" class="car_like2"><?php if( function_exists('zilla_likes') ) zilla_likes(); ?></div>				
								<?php }?>
							</figcaption>
						</figure>
					</li>
					</ul>
				</li>
<?php $j++;
	endwhile; ?>
		
     </ul>
     <div class="clear"></div>
            <!-- end post carousel --> 
        <!-- end latest posts -->
    <!-- end content -->      
</div>
</section>
			</div>
				<section class="container">
<?php
	break;
	case 'quotes':	


	if ((isset($smof_data['home2_testimonials_text_color'] )) && ($smof_data['home2_testimonials_text_color']!=="") ) {
 		$testimonials_text_color = $smof_data['home2_testimonials_text_color'];
 	}else{
		$testimonials_text_color = "#333";
	}
	?>

	</section>
	<div id="href_quotes"></div>
			<div class="flatquote">
				<?php if (isset($smof_data['home2_testimonials_image'] ) && ($smof_data['home2_testimonials_image'] != "")) {?>
						<img class="back_quote_img" src="<?php echo do_shortcode($smof_data['home2_testimonials_image']) ?>" alt="quote_back">
						<?php } ?>
				<section class="container">

<div class="grid12 col">

			<?php if ($smof_data['home2_testimonials_light']) {?>
				<div class="quotesign"><img src="<?php echo get_template_directory_uri(); ?>/images/quote-w.png" alt=""></div>
			<?php }else{ ?>
				<div class="quotesign"><img src="<?php echo get_template_directory_uri(); ?>/images/quote.png" alt=""></div>
			<?php } ?>
	<ul class="fade">

<?php
$page_no = (get_query_var('paged')) ? get_query_var('paged') : 1;
query_posts(array(
	'post_type' => array('testimonials'),
	'post_status' => 'publish',
	'paged' => $page_no
));
if (have_posts()) :
	while(have_posts()) :
		the_post();
		$author_name = rwmb_meta("testimonial_author_name");
		$author_url = rwmb_meta("testimonial_author_url"); ?>

		<li>
			<style type="text/css">
			.quote,.quote *{color:<?php echo $testimonials_text_color ;?> !important;}
			</style>
			<div class="quote"><?php the_content(); ?></div>
			<div class="avatarname">

			<?php if ( (function_exists('has_post_thumbnail')) && has_post_thumbnail() ) :
			$full_image_url = wp_get_attachment_url( get_post_thumbnail_id(), 'full' );
			$thumb_image_url = aq_resize( $full_image_url, 100, 100, true ); ?>
				<img src="<?php echo $thumb_image_url; ?>" alt="" />
<?php		else:
				$thumb_image_url = get_template_directory_uri().'/img/staff-member.png'; ?>
				<img src="<?php echo $thumb_image_url; ?>" alt="" />
<?php 	endif; ?>

			</div>

			<?php if ($author_name) : ?>
						<?php if ($author_url) : ?>
							<div class="name">
								<a style="color:<?php echo $testimonials_text_color ;?>;" href="<?php echo $author_url; ?>" target="_blank">
									<?php echo $author_name; ?>
								</a>
							</div>
						<?php else: ?>
							<div style="color:<?php echo $testimonials_text_color ;?>;" class="name">
									<?php echo $author_name; ?>
							</div>
						<?php endif; ?>
			<?php endif; ?>	
		</li>
<?php endwhile; ?>

</ul>
<div class="clearfix"></div>
<?php
	else:
		get_template_part( 'noresult' );
	endif; ?>

</div>
</section>
			</div>
				<section class="container">
				<?php 
				break;

case 'html1': ?>
         <?php 
              if ((isset($smof_data['home2_html1_bg'] )) && ($smof_data['home2_html1_bg']!=="") ) {
                  $html1_bg = $smof_data['home2_html1_bg'];
                }else{
                  $html1_bg = "";
                }
                if ((isset($smof_data['home2_html1_color'] )) && ($smof_data['home2_html1_color']!=="") ) {
                  $html1_color = $smof_data['home2_html1_color'];
                }else{
                  $html1_color = "#fff";
                }

            ?>
            	</section>
            	<div id="href_html1"></div>
			<div class="flatintro" style="background:url(<?php echo $html1_bg ;?>) <?php echo $html1_color ;?>;overflow:auto;">

				<section class="container">
				<div class="grid12 col">
					 <?php echo do_shortcode($smof_data['home2_html1_text']) ?>
				</div>
				</section>
			</div>
			<section class="container">

             

        <?php 
        break;
        case 'html2': ?>
         <?php 
              if ((isset($smof_data['home2_html2_bg'] )) && ($smof_data['home2_html2_bg']!=="") ) {
                  $html2_bg = $smof_data['home2_html2_bg'];
                }else{
                  $html2_bg = "";
                }
                if ((isset($smof_data['home2_html2_color'] )) && ($smof_data['home2_html2_color']!=="") ) {
                  $html2_color = $smof_data['home2_html2_color'];
                }else{
                  $html2_color = "#fff";
                }

            ?>
            	</section>
            	<div id="href_html2"></div>
			<div class="flatintro" style="background:url(<?php echo $html2_bg ;?>) <?php echo $html2_color ;?>;overflow:auto;">

				<section class="container">
				<div class="grid12 col">
					 <?php echo do_shortcode($smof_data['home2_html2_text']) ?>
				</div>
				</section>
			</div>
			<section class="container">


        <?php 
        break;
        case 'html3': ?>
         <?php 
              if ((isset($smof_data['home2_html3_bg'] )) && ($smof_data['home2_html3_bg']!=="") ) {
                  $html3_bg = $smof_data['home2_html3_bg'];
                }else{
                  $html3_bg = "";
                }
                if ((isset($smof_data['home2_html3_color'] )) && ($smof_data['home2_html3_color']!=="") ) {
                  $html3_color = $smof_data['home2_html3_color'];
                }else{
                  $html3_color = "#fff";
                }

            ?>
                        	</section>
            	<div id="href_html3"></div>
			<div class="flatintro" style="background:url(<?php echo $html3_bg ;?>) <?php echo $html3_color ;?>;overflow:auto;">

				<section class="container">
				<div class="grid12 col">
					 <?php echo do_shortcode($smof_data['home2_html3_text']) ?>
				</div>
				</section>
			</div>
			<section class="container">

        <?php 
        break;
        case 'html4': ?>
         <?php 
              if ((isset($smof_data['home2_html4_bg'] )) && ($smof_data['home2_html4_bg']!=="") ) {
                  $html4_bg = $smof_data['home2_html4_bg'];
                }else{
                  $html4_bg = "";
                }
                if ((isset($smof_data['home2_html4_color'] )) && ($smof_data['home2_html4_color']!=="") ) {
                  $html4_color = $smof_data['home2_html4_color'];
                }else{
                  $html4_color = "#fff";
                }

            ?>
                                   	</section>
            	<div id="href_html4"></div>
			<div class="flatintro" style="background:url(<?php echo $html4_bg ;?>) <?php echo $html4_color ;?>;overflow:auto;">

				<section class="container">
				<div class="grid12 col">
					 <?php echo do_shortcode($smof_data['home2_html4_text']) ?>
				</div>
				</section>
			</div>
			<section class="container">

        <?php 
        break;



	case 'twitters':	?>

	</section>
	<div id="href_twitter"></div>
			<div class="flattwitter">
				<input type="hidden" id="max" value="500" />
				<img class="hval" id="firast" twitterids="<?php echo $smof_data['home2_twitter_id']; ?>" alt="tval" />
				<section class="container">
					<div class="twittersign"><img src="<?php echo get_template_directory_uri(); ?>/images/twitters2.png" alt=""></div>
					<div id="ftwitter"></div>
			 		<div class="clearfix"></div>
				</section>
			</div>
			<section class="container">
			<?php 
			break;

case 'toggles': 

	if ((isset($smof_data['home2_toggles_bg'] )) && ($smof_data['home2_toggles_bg']!=="") ) {
 		$toggles_bg = $smof_data['home2_toggles_bg'];
 	}else{
		$toggles_bg = "";
	}
	if ((isset($smof_data['home2_toggles_color'] )) && ($smof_data['home2_toggles_color']!=="") ) {
 		$toggles_color = $smof_data['home2_toggles_color'];
 	}else{
		$toggles_color = "#cdcdcd";
	}

	if ((isset($smof_data['home2_toggles_title_color'] )) && ($smof_data['home2_toggles_title_color']!=="") ) {
		$toggles_title_color = $smof_data['home2_toggles_title_color'];
	}else{
		$toggles_title_color = "#aaa";
	}

	if ((isset($smof_data['home2_point_list_title_color'] )) && ($smof_data['home2_point_list_title_color']!=="") ) {
		$point_list_title_color = $smof_data['home2_point_list_title_color'];
	}else{
		$point_list_title_color = "#333";
	}

	if ((isset($smof_data['home2_point_list_text_color'] )) && ($smof_data['home2_point_list_text_color']!=="") ) {
		$point_list_text_color = $smof_data['home2_point_list_text_color'];
	}else{
		$point_list_text_color = "#444";
	}
?>

</section>
<div id="href_points"></div>
	<div class="flattab" style="background:url(<?php echo $toggles_bg ;?>)  <?php echo $toggles_color ;?>;overflow:auto;">
		<section class="container">

<div class="grid12 col">
	<?php if (!empty($smof_data['home2_toggles_title'])) : ?>
	<h2 class="home_tog_title fadeitin" style="color:<?php echo $toggles_title_color ;?>;"><?php if (isset($smof_data['home2_toggles_title'] )) echo do_shortcode($smof_data['home2_toggles_title']) ?>
							</h2>
	<?php endif; ?>

	<div class="grid8 col alpha allheight">
		<?php if (!empty($smof_data['home2_points_main'])) : ?>
		<img class="tog_img3" src="<?php echo  $smof_data['home2_points_main']; ?>" alt="img02">
		<?php endif; ?>
	</div>
	<div class="grid4 col omega">
		<?php
		if (!empty($smof_data['home2_the_toggles']))
		foreach ($smof_data['home2_the_toggles'] as $key => $value) :
			$link = ($value['link']) ? ' href="' . $value['link'] . '" target="_blank"' : ' href=""';
			
				$thumb_image_url = ($value['url']) ? aq_resize( $value['url'], 80, 80, true ) : get_template_directory_uri() . '/images/69x69.gif';
			?>
		<div class="clearfix"></div>
		<div class="newicon alpha">
			<img src="<?php echo $thumb_image_url; ?>" class="theicon_img" alt="" />
		</div>
		<div class="newicon_text omega">
			<h4 class="tog_title" style="color:<?php echo $point_list_title_color ;?>;" ><?php echo $value['title'] ?></h4>
			<p style="color:<?php echo $point_list_text_color ;?>;">
				<?php echo $value['description'] ?>
			</p>
		</div>

<?php
		endforeach;
?> 

	</div>

	
</div>

</section>

</div>
<section class="container">

<?php 
break;


case 'toggles2': 

	if ((isset($smof_data['home2_toggles2_bg'] )) && ($smof_data['home2_toggles2_bg']!=="") ) {
 		$toggles2_bg = $smof_data['home2_toggles2_bg'];
 	}else{
		$toggles2_bg = "";
	}
	if ((isset($smof_data['home2_toggles2_color'] )) && ($smof_data['home2_toggles2_color']!=="") ) {
 		$toggles2_color = $smof_data['home2_toggles2_color'];
 	}else{
		$toggles2_color = "#fff";
	}

	if ((isset($smof_data['home2_toggles2_title_color'] )) && ($smof_data['home2_toggles2_title_color']!=="") ) {
			 		$toggles2_title_color = $smof_data['home2_toggles2_title_color'];
			 	}else{
					$toggles2_title_color = "#aaa";
				}
	if ((isset($smof_data['home2_point2_list_title_color'] )) && ($smof_data['home2_point2_list_title_color']!=="") ) {
		$point2_list_title_color = $smof_data['home2_point2_list_title_color'];
	}else{
		$point2_list_title_color = "#333";
	}

	if ((isset($smof_data['home2_point2_list_text_color'] )) && ($smof_data['home2_point2_list_text_color']!=="") ) {
		$point2_list_text_color = $smof_data['home2_point2_list_text_color'];
	}else{
		$point2_list_text_color = "#444";
	}
?>

</section>
	<div id="href_points2"></div>
	<div class="flattab" style="background:url(<?php echo $toggles2_bg ;?>)  <?php echo $toggles2_color ;?>;overflow:auto;">
		<section class="container">

<div class="grid12 col">

	<?php if (!empty($smof_data['home2_toggles2_title'])) : ?>
	<h2 class="home_tog_title fadeitin" style="color:<?php echo $toggles2_title_color ;?>;"><?php if (isset($smof_data['home2_toggles2_title'] )) echo do_shortcode($smof_data['home2_toggles2_title']) ?>
							</h2>
	<?php endif; ?>

	<div class="grid4 col alpha">
		<?php
		if (!empty($smof_data['home2_the_toggles2']))
		foreach ($smof_data['home2_the_toggles2'] as $key => $value) :
			$link = ($value['link']) ? ' href="' . $value['link'] . '" target="_blank"' : ' href=""';
			
				$thumb_image_url = ($value['url']) ? aq_resize( $value['url'], 80, 80, true ) : get_template_directory_uri() . '/images/69x69.gif';
			?>
		<div class="clearfix"></div>
		<div class="newicon alpha">
			<img src="<?php echo $thumb_image_url; ?>" class="theicon_img" alt="" />
		</div>
		<div class="newicon_text omega">
			<h4 class="tog_title" style="color:<?php echo $point2_list_title_color ;?>;" ><?php echo $value['title'] ?></h4>
			<p style="color:<?php echo $point2_list_text_color ;?>;">
				<?php echo $value['description'] ?>
			</p>
		</div>

<?php
		endforeach;
?> 

	</div>

	<div class="grid8 col omega allheight">
		<?php if (!empty($smof_data['home2_points2_main'])) : ?>
		<img class="tog_img3" src="<?php echo  $smof_data['home2_points2_main']; ?>" alt="img02">
		<?php endif; ?>
	</div>

	
</div>

</section>

</div>
<section class="container">

<?php 
break;
			case 'clients': 

			if ((isset($smof_data['home2_clients_bg'] )) && ($smof_data['home2_clients_bg']!=="") ) {
		 		$clients_bg = $smof_data['home2_clients_bg'];
		 	}else{
				$clients_bg = "";
			}
			if ((isset($smof_data['home2_clients_color'] )) && ($smof_data['home2_clients_color']!=="") ) {
		 		$clients_color = $smof_data['home2_clients_color'];
		 	}else{
				$clients_color = "#efefef";
			}


			if ((isset($smof_data['home2_clients_text_color'] )) && ($smof_data['home2_clients_text_color']!=="") ) {
		 		$clients_text_color = $smof_data['home2_clients_text_color'];
		 	}else{
				$clients_text_color = "#333";
			}
	

			$clients_bg_paralax = ($smof_data['home2_clients_bg_paralax'] == 1) ? $paralax_body : '' ; 
 		 $clients_paralax_header = ($smof_data['home2_clients_bg_paralax'] == 1) ? $paralax_header : '';
			$clients_bg_paralax2 = ($smof_data['home2_clients_bg_paralax'] == 1) ? 'fixed' : '' ; ?>

			</section>
			<div id="href_clients"></div>
			<div class="flatclients" style="background:url(<?php echo $clients_bg ;?>) <?php echo $clients_paralax_header ;?> <?php echo $clients_bg_paralax2 ;?>  <?php echo $clients_color ;?>;overflow:auto;
  <?php echo $clients_bg_paralax ;?>
				">
				<section class="container">

		<div class="grid3 col">
			<h2 class="client_title" style="color:<?php echo $clients_text_color ;?>;"><?php echo do_shortcode($smof_data['home2_clients_title']); ?></h2>
			<p class="client_text" style="color:<?php echo $clients_text_color ;?>;"><?php echo do_shortcode($smof_data['home2_clients_info']); ?></p>
		</div>
		<div class="grid9 col add-bottom">
<?php
		$j=0;
		if (!empty($smof_data['home2_clients_slider']))
		foreach ($smof_data['home2_clients_slider'] as $key => $value) :
			$link = ($value['link']) ? ' href="' . $value['link'] . '" target="_blank"' : ' href=""';
			$value['url'] = ($value['url']) ? $value['url'] : get_template_directory_uri(). '/img/100x50.png'; ?>
			<div class="grid3 col<?php if ( $j%3==0 ) echo ' alpha'; else if ( $j%3==2 ) echo ' omega'; ?>">
				<a<?php echo $link; ?> class="client-logo" title="<?php echo $value['description'] ?>" style="background-image: url(<?php echo $value['url']; ?>)"></a>
			</div>
<?php
		$j++;
		endforeach; ?>
		</div>
		
		<div class="clear"></div>

</section>
			</div>
				<section class="container">


<?php
				break;

		endswitch;
	endforeach;
?>

<?php get_footer(); ?>