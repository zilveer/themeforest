<?php
/**
 * @package WordPress
 * @subpackage Smartbox
 */

get_header();

		global $smartbox_reading_option; $smartbox_reading_option = get_option(DESIGNARE_SHORTNAME.'_blog_reading_type');
		
		global $smartbox_more;
			$smartbox_more = 0;

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
					
					<div class="pageTitle sixteen columns" <?php if ($margintop != "") echo " style='margin-bottom: ".$margintop.";margin-top: ".$margintop.";'"; ?>>
		    			<h1 class="page_title" style="<?php 
					    	$tcolor = des_get_value(DESIGNARE_SHORTNAME.'_header_text_color');
							$tsize = str_replace(" ", "", des_get_value(DESIGNARE_SHORTNAME.'_header_text_size'));			
							echo "color: #$tcolor; font-size: $tsize;";
			    	?>"><?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>

				<?php /* If this is a category archive */ if (is_category()) { ?>
					Archive for the &#8216;<?php single_cat_title(); ?>&#8217; Category
					
	
				<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
					Posts Tagged &#8216;<?php single_tag_title(); ?>
					
						
				<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
					Archive for <?php the_time('F jS, Y'); ?>
					
	
				<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
					Archive for <?php the_time('F, Y'); ?>
					
	
				<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
					Archive for <?php the_time('Y'); ?>
					
	
				<?php /* If this is an author archive */ } elseif (is_author()) { ?>
					Author Archive
					
				<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
					Blog Archives
				
				<?php } ?></h1>
					<?php
				    	if (!is_array(get_option(DESIGNARE_SHORTNAME."_archive_secondary_title"))){	?>
					    <h2 class="secondaryTitle" style="<?php
					    	$stcolor = des_get_value(DESIGNARE_SHORTNAME.'_secondary_title_text_color');
							$stsize = str_replace(" ", "", des_get_value(DESIGNARE_SHORTNAME.'_secondary_title_text_size'));
							echo "color: #$stcolor; font-size: $stsize; line-height: $stsize;";				    		
			    		?>" ><?php echo get_option(DESIGNARE_SHORTNAME."_archive_secondary_title"); ?></h2>
			    		<?php
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
				$sidebar = get_option(DESIGNARE_SHORTNAME."_blog_archive_sidebar");
				$postconfig = " sixteen columns";
		    	$postlistingstyle = "";
		    	
		    	if ($sidebar == "left" || $sidebar == "right") {
		    		$postconfig = " twelve columns";
		    		$postlistingstyle = 'style="border-right: 1px solid #ededed; "';
		    	}
		    	if ($sidebar == "left") {
			    	//get_sidebar();	
			    	$postlistingstyle = 'style="border-left: 1px solid #ededed; width: 100% !important;"';
			    	
		    	}
				if ($sidebar == "left"){
					?> 
					<div class="four columns">
						<?php get_sidebar(); ?>
					</div>
					<?php
				}
			?>
		
		<div id="primary" class="blogarchive <?php echo $postconfig; if ($sidebar == "none") echo " fullwidth"; ?>">
			<div id="content">
			
			
	    	
	   	<?php
		
		if (have_posts()){
		
		?> 
		
		<div style="width: 98%;" class="post-listing" <?php echo $postlistingstyle; ?>>
		
			<?php

				$columns = "twelve columns";
		    	if ($postconfig === " sixteen columns") $columns = "sixteen columns";					

			    while ( have_posts() ) : 
						
			    	the_post();	 ?>
			    	
			    		<?php
				    		global $smartbox_more;
				    		$smartbox_more = 0;
			    		?>
				    	
				    	<article id="post-<?php the_ID(); ?>" class="post<?php if ($sidebar == "left") echo " fifteen columns"; ?>" <?php if ($sidebar == "left") echo "style='float:right;'"; ?>>
								    	
					    	<?php
					    	
					    	$posttype = get_post_meta(get_the_ID(), 'posttype_value', true);
					    	
					    	if ($sidebar != "none"){
						    	$columns = "eleven columns";
					    	} else {
						    	$columns = "sixteen columns";
					    	}
					    	
					    	$postid = get_the_ID(); ?>
					    	
					    	<div class="postcontent" style="<?php if ($sidebar == "left") echo "margin-right:0px;"; else echo "margin-left: -5px;"; ?>">
								    									    	
					    	<?php
					    	
					    		switch($posttype){
						    		case "image":
						    		
						    			if (wp_get_attachment_url( get_post_thumbnail_id($postid))){
										?>
										
											<div class="featured-image-thumb" onmouseover="$(this).find('.hover_the_thumbs').css('background-color','rgba(0, 0, 0, 0.6)'); $(this).find('.magnify_this_thumb').css('left', '51%').css('opacity',1); $(this).find('.hyperlink_this_thumb').css('left', '39%').css('opacity',1);" onmouseout="$(this).find('.hover_the_thumbs').css('background-color','rgba(0, 0, 0, 0)'); $(this).find('.magnify_this_thumb').css('left', '-15%').css('opacity',0); $(this).find('.hyperlink_this_thumb').css('left', '105%').css('opacity',0);">
												<h2><a href="<?php the_permalink(); ?>" title="<?php  the_title(); ?>">
													<img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id($postid)); ?>" title="<?php the_title(); ?>"/>
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
														    		echo "<a href='".$url[1]."' rel='prettyPhoto[pp_gal]' >";
													    		}
													    		echo "<img src='".$url[1]."' alt='' width='100%' class='rp_style1_img'>";
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
									    			<?php 
									    				$mth = get_the_date("F");
									    				$mth = substr($mth,0,3);
										    			$data = '<div class="day">'. get_the_date("d") . '</div>';
										    			$data .= '<div>'. $mth . '</div>';
										    			echo $data;
									    			?>
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
									    	
									    	<div class="metas" style="margin-bottom:40px;">
													    	
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
						    
						    </div> <!-- end of .postcontent -->
					    	
					    	<div class="des-sc-dots-divider"></div>
					    						    		    
					    </article> <!-- end of post -->
				    				    	
			    	<?php endwhile; ?>
			    		
	    	</div> <!-- end of post-listing -->
					
			<div class="navigation">
				<?php
					
					global $smartbox_reading_option;
					if ($smartbox_reading_option != "paged" && $smartbox_reading_option != "dropdown"){ 
						$the_query = new WP_Query();
					?>
						<div class="next-posts"><?php  next_posts_link('&laquo; ' . __(get_option(DESIGNARE_SHORTNAME."_previous_text"), "smartbox"), $the_query->max_num_pages);  ?></div>
							<div class="prev-posts"><?php  previous_posts_link(__(get_option(DESIGNARE_SHORTNAME."_next_text"), "smartbox") . ' &raquo;', $the_query->max_num_pages); ?></div>		
					<?php
					} else { 
						wp_pagenavi();
					}
				?>
				
			</div>

									
		<?php  }
		
		?>
			<?php if ($sidebar != "left") {
				?>
					</div>
				<?php
			} ?>
	    
			
		</div><!-- #content -->		
		
	</section><!-- #primary -->


<?php if ($sidebar == "right") {
	?>
		<div class="four columns sidebar-right">	
	<?php
	get_sidebar(); 
	?>
		</div>
	<?php
} if ($sidebar == "left") {
	?>
		</div>
	<?php
} ?>

	<div class="clear"></div>
		
<?php get_footer(); ?>