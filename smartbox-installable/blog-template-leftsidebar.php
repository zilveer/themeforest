<?php
/**
 * Template Name: Blog Template Left Sidebar
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
				if($type == "image") echo "background: url(" . $image . ") no-repeat; background-size: 100% auto;";  
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

<?php 

	global $smartbox_reading_option; $smartbox_reading_option = get_option('smartbox_blog_reading_type');
	global $smartbox_more;
		$smartbox_more = 0;

	$orderby="";
	$category="";
	$nposts = "";

	$pag = 1;
	
	if (isset($_GET['paged'])) $pag = $_GET['paged'];
	else {
		$pageURL = 'http';
		if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		$pagina = explode('/page/', $pageURL);
		if(isset($pagina[1])) $pagina = explode ('/', $pagina[1]);
		if ($pagina[0]) $pag = $pagina[0];	
	}
	
?>

		

		<div class="four columns alpha" style="margin-left: 0 !important;">
			<?php get_sidebar(); ?>
		</div>
		

						
		<section id="primary" role="region" class="blogarchive blog-ls twelve columns">
			<div id="content">
				
				<?php
				    $args = array(
				    	'showposts' => $nposts,
				    	'orderby' => $orderby,
				    	'order' => $order,
				    	'cat' => $category,
				    	'post_status' => 'publish',
				    	'paged' => $pag
				    );
				    	
				    global $post, $wp_query;
				    
				    $the_query = new WP_Query( $args );
				    
				    if ($the_query->have_posts()){ ?>
				    
				    	<div class="post-listing">
					    	
				    	<?php
					    
						    while ( $the_query->have_posts() ) : 
									
						    	$the_query->the_post();	 ?>
						    	
						    		<?php
							    		global $smartbox_more;
							    		$smartbox_more = 0;
						    		?>
							    	
							    	<article id="post-<?php the_ID(); ?>" class="post">
								    	
								    	<?php
								    	
								    	$posttype = get_post_meta(get_the_ID(), 'posttype_value', true);
								    	$postid = get_the_ID(); ?>
								    	
								    	<div class="postcontent">
								    									    	
								    	<?php
								    	
								    		switch($posttype){
									    		case "image":
									    		
									    			if (wp_get_attachment_url( get_post_thumbnail_id($postid))){
													?>
													
														<div class="featured-image-thumb" onmouseover="$(this).find('.hover_the_thumbs').css('background-color','rgba(0, 0, 0, 0.6)'); $(this).find('.magnify_this_thumb').css('left', '51%').css('opacity',1); $(this).find('.hyperlink_this_thumb').css('left', '39%').css('opacity',1);" onmouseout="$(this).find('.hover_the_thumbs').css('background-color','rgba(0, 0, 0, 0)'); $(this).find('.magnify_this_thumb').css('left', '-15%').css('opacity',0); $(this).find('.hyperlink_this_thumb').css('left', '105%').css('opacity',0);">
															<h2><a href="<?php the_permalink(); ?>" title="<?php  the_title(); ?>">
																<img alt="" src="<?php echo wp_get_attachment_url( get_post_thumbnail_id($postid)); ?>" title="<?php the_title(); ?>"/>
															</a></h2>
															<?php
																if (get_option(DESIGNARE_SHORTNAME."_enlarge_images") == "on"){
																	?>
																	<a class="flex_this_thumb" rel="prettyPhoto" href="<?php echo wp_get_attachment_url( get_post_thumbnail_id($postid)); ?>"></a>
																	<div class="mask" onclick="$(this).siblings('.flex_this_thumb').trigger('click');">
																		<div class="more" onclick="$(this).parents('.featured-image-thumb').find('.flex_this_thumb').click();"></div>
																	</div>
																	<?php
																}
															?>
														</div>
														<?php 
													}
									    			
									    			break;
									    		case "slider": 
									    			$randClass = rand(0,1000);
													?>
														<div class="flexslider <?php echo $posttype; ?>" id="<?php echo $randClass; ?>">
															<ul class="slides">
																<?php
																	$sliderData = get_post_meta($postid, "sliderImages_value", true);
																	$slide = explode("|*|",$sliderData);
																    foreach ($slide as $s){
																    	if ($s != ""){
																    		$url = explode("|!|",$s);
																    		echo "<li>";
																    		if (get_option(DESIGNARE_SHORTNAME."_enlarge_images") == "on"){
																	    		echo "<a href='".$url[1]."' rel='prettyPhoto[pp_gal-".$randClass."]' >";
																    		}
																    		echo "<img src='".$url[1]."' alt='' class='rp_style1_img'>";
																    		if (get_option(DESIGNARE_SHORTNAME."_enlarge_images") == "on"){
																	    		echo "</a>";
																    		}
																    		echo "</li>";	
																    	}
																    }
																?>
															</ul>
															<?php
																if (get_option(DESIGNARE_SHORTNAME."_enlarge_images") == "on"){
																	?>
																		<div class="mask" onclick="$(this).siblings('.flex_this_thumb').trigger('click');">
																			<div class="more" onclick="$(this).parents('.featured-image-thumb').find('.flex_this_thumb').click();"></div>
																		</div>
																	<?php
																}
															?>
														</div>
													<?php
									    			break;
									    		case "audio":
									    			$randClass = rand(0,1000);
													?>
													<div class="audioContainer">
														<?php echo get_post_meta($postid, 'audioCode_value', true); ?>
													</div>
													<?php
									    			break;
									    		case "video":
									    			?>
									    			<div class="video-thumb">
														<?php
															$datamovie = rand();
															echo "<div data-movie='$datamovie' id='the_movies' class='the_movies'></div>";
															$videosType = get_post_meta($postid, "videoSource_value", true);
															$videos = get_post_meta($postid, "videoCode_value", true);
															$videos = preg_replace( '/\s+/', '', $videos );
															$vid = explode(",",$videos);
															switch (get_post_meta($postid, "videoSource_value", true)){
																case "youtube":
																	foreach ($vid as $v){
																		echo "<div data-movie='$datamovie' class='v_links'>http://www.youtube.com/embed/".$v."?autoplay=0&amp;wmode=transparent&amp;autohide=1&amp;showinfo=0&amp;rel=0</div>";	
																	}
																	break;
																case "vimeo":
																	foreach ($vid as $v){
																		echo "<div data-movie='$datamovie' class='v_links'>http://player.vimeo.com/video/".$v."?autoplay=0&amp;title=0&amp;byline=0&amp;portrait=0</div>";	
																	}
																	break;
															}
														?>
													</div>
													<?php
									    			break;
								    		}								    	
									    ?>
										    
											<div class="post-cc">
												<div class="tr-blogfw">
													<div class="td-blogfw">
														<div class="data_type">
									    		
												    		<div class="cutcorner_top"></div>
												    		
												    		<div class="data">
												    			<div class="day"><?php echo get_the_date("d"); ?></div>
												    			<div><?php echo __(substr(get_the_date("F"), 0, 3), "smartbox"); ?></div>
												    		</div>
												    	
												    		<?php if ($posttype != "none" && $posttype != "") echo '<div class="post_type '.$posttype.'"><i class="icon-"></i></div>'; ?>
												    		
												    		<div class="cutcorner_bottom"></div>
				
												    	</div>
													</div>
													<div class="thepostcont">

												    	<div class="metas_container">
													
										    				<div class="the_title"><h2><a href="<?php the_permalink() ?>"><?php  the_title(); ?></a></h2></div>
										    				
												    	</div>
												    	
												    	<div class="blog_excerpt">
													    	<?php the_excerpt(); ?>

													    </div>
													    
													    <div class="metas">
													    	
												    		<div class="metas-div">
												    			<?php
													    			if (comments_open()){
														    			?>
														    			<div class="divider-tags">
														    				<span class="blog-i comments"><?php 
														    					$nocomment = get_option(DESIGNARE_SHORTNAME."_no_comments_text");
														    					if ($nocomment == "") $nocomment = "comments";
														    					$onecomment = get_option(DESIGNARE_SHORTNAME."_comment_text");
														    					if ($onecomment == "") $onecomment = "comment";
														    					$severalcomments = get_option(DESIGNARE_SHORTNAME."_comments_text");
														    					if ($severalcomments == "") $severalcomments = "comments";
														    					comments_number(__("0 ".$nocomment, "smartbox"), __("1 ".$onecomment,"smartbox"), __("% ".$severalcomments, "smartbox")); 
														    				?></span>
														    			</div>		
														    			<?php
													    			}
												    			?>
																
																<div class="divider-tags">
																	<a class="the_author" href="?author=<?php  the_author_meta('ID'); ?>"><?php  the_author_meta('nickname'); ?></a>
																</div>
																<div class="divider-tags">
																	<span class="tags"><?php the_tags( ''. '', ', ', ''); ?></span>
																</div>
																<div class="divider-tags">
																	<span class="categories"><?php the_category(', '); ?></span>
																</div>
															</div>
															<span class="readmore"><a href="<?php echo get_permalink(); ?>"><?php $res = get_option(DESIGNARE_SHORTNAME."_read_more"); if ($res != "")  _e( $res, 'smartbox' ) ; else _e('Read More &rArr;','smartbox'); ?></a></span>
												    	</div>
														    
													</div>
												</div>
											</div>

								    	</div>
								    	
								    	<div class="des-sc-dots-divider"></div>
							    									    
									</article> <!-- end of post -->
							    	
						    	<?php endwhile; ?>
						    		
				    	</div> <!-- end of post-listing -->
					
						<div class="navigation">
							<?php
								
								global $smartbox_reading_option;
								if ($smartbox_reading_option != "paged" && $smartbox_reading_option != "dropdown"){ ?>
									<div class="next-posts"><?php next_posts_link('&laquo; ' . __(get_option(DESIGNARE_SHORTNAME."_previous_text"), "smartbox"), $the_query->max_num_pages);  ?></div>
							<div class="prev-posts"><?php previous_posts_link(__(get_option(DESIGNARE_SHORTNAME."_next_text"), "smartbox") . ' &raquo;', $the_query->max_num_pages); ?></div>		
								<?php
								} else { 
									wp_pagenavi();
								}
							?>
							
						</div>			
												
					<?php  }
					
				?>
				    
						
			</div><!-- #content -->
			
		</section><!-- #primary -->

<?php get_footer(); ?>