<?php
/**
 * @package WordPress
 * @subpackage Smartbox
 */
?>
				</div>
    
			</div> 
		
		<div class="clear"></div>
	
	</div> 
  
 	
	<div id="back-to-top"><a href="javascript:;"></a></div>
	
	<div id="big_footer">	
		<?php
		wp_reset_query();
		$customnews = get_post_meta($post->ID, 'des_custom_newsletter_value', true);
		if (empty($customnews)) $customnews = des_get_value(DESIGNARE_SHORTNAME.'_newsletter_enabled');
		if ($customnews == "off") $nl = des_get_value(DESIGNARE_SHORTNAME. '_newsletter_enabled', true);
		else $nl = get_post_meta($post->ID, 'newsletterEnabled_value', true);
		if (empty($nl)) $nl = des_get_value(DESIGNARE_SHORTNAME.'_newsletter_enabled');
		$twitter = des_get_value(DESIGNARE_SHORTNAME."_show_twitter_scroller");
		$twitter_data_is_filled = true;
		if ( (get_option(DESIGNARE_SHORTNAME."_twitter_username") == "") || (get_option("twitter_consumer_key") == "") || (get_option("twitter_consumer_secret") == "") || (get_option("twitter_user_token") == "") || (get_option("twitter_user_secret") == "") || (get_option(DESIGNARE_SHORTNAME."_twitter_number_tweets") == "") ){
			$twitter_data_is_filled = false;
		}
		if (des_get_value(DESIGNARE_SHORTNAME."_show_twitter_newsletter_footer") == "on"){
			if (($twitter == "on") && ($twitter_data_is_filled == true)){
				wp_enqueue_script( 'destweet', DESIGNARE_JS_PATH .'twitter/jquery.tweet.js', array(),'1.0',$in_footer = false);
			}
			?>
			<div class="mail_chimp_form_container">
				<div class="container">
					<?php
						if ($twitter == "on" && $nl == "on"){
							?>
							<div class="eight columns">
								<div class="cutcorner_top"></div>
								<div class="bird-img"><?php _e(get_option(DESIGNARE_SHORTNAME."_latest_for_twitter"), "smartbox"); ?></div>
								<?php if (!$twitter_data_is_filled){
									echo "<p>Please fill the fields on the <strong>Appearance > Smartbox Options > Twitter and Social Icons > Twitter</strong> panel with your credentials.</p>";
								} ?> 
								<div id="tweet_scroll_place">
									<div class="tweet_bird">
										<div class="tweet_scroll_text <?php if (!$twitter_data_is_filled) echo "not_filled"; ?>"></div>
									</div>
									<div class="cutcorner_bottom"></div>
								</div>
							</div>
							<div class="mail-box eight columns">
								<div class="mail-news">
									<div class="news-l">
										<div class="banner">
											<h3><?php echo get_option(DESIGNARE_SHORTNAME."_newsletter_text"); ?></h3>
											<p><?php echo get_option(DESIGNARE_SHORTNAME."_newsletter_stext"); ?></p>
										</div>
										<div class="form">
											<?php
												$code = str_replace('&', '&amp;', get_option(DESIGNARE_SHORTNAME."_mailchimp_code"));
												echo stripslashes($code);
											?>
										</div>
									</div>
								</div>
							</div>
							<?php
						} else {
							if ($nl == "on"){
								?>
								<div class="mail-box sixteen columns">
									<div class="mail-news">
										<div class="news-l">
											<div class="banner">
												<h3><?php echo get_option(DESIGNARE_SHORTNAME."_newsletter_text"); ?></h3>
												
												<p><?php echo get_option(DESIGNARE_SHORTNAME."_newsletter_stext"); ?></p>
												
												
											</div>
											<div class="form">
												<?php
													$code = str_replace('&', '&amp;', get_option(DESIGNARE_SHORTNAME."_mailchimp_code"));
													echo stripslashes($code);
												?>
											</div>
										</div>
									</div>
								</div>
								<?php
							}
							if ($twitter == "on"){
								?>
								<div class="sixteen columns">
									<div class="cutcorner_top"></div>
									<div class="bird-img"><?php _e(get_option(DESIGNARE_SHORTNAME."_latest_for_twitter"), "smartbox"); ?></div>
									<?php if (!$twitter_data_is_filled){
										echo "<p>Please fill the fields on the <strong>Appearance > Smartbox Options > Twitter and Social Icons > Twitter</strong> panel with your credentials.</p>";
									} ?>
									<div id="tweet_scroll_place">
										<div class="tweet_bird">
											<div class="tweet_scroll_text <?php if (!$twitter_data_is_filled) echo "not_filled"; ?>"></div>
										</div>
										<div class="cutcorner_bottom"></div>
									</div>
								</div>
								<?php	
							}
						}
					?>
				</div>
			</div>
		<?php
		}
	?>
	<?php
		if (des_get_value(DESIGNARE_SHORTNAME."_show_primary_footer") == "on"){
			?>
			<div id="footer_content">
		    	<div class="container">
	    		<?php
	    		
					if(get_option(DESIGNARE_SHORTNAME . "_footer_number_cols") == "one"){ ?>
						<div class="sixteen columns"><?php print_sidebar('footer-one-column'); ?></div>
					<?php }
					if(get_option(DESIGNARE_SHORTNAME . "_footer_number_cols") == "two"){ ?>
						<div class="eight columns"><?php print_sidebar('footer-two-column-left'); ?></div>
						<div class="eight columns"><?php print_sidebar('footer-two-column-right'); ?></div>
					<?php }
					if(get_option(DESIGNARE_SHORTNAME . "_footer_number_cols") == "three"){
						if(get_option(DESIGNARE_SHORTNAME . "_footer_columns_order") == "one_three"){ ?>
							<div class="one-third column"><?php print_sidebar('footer-three-column-left'); ?></div>
							<div class="one-third column"><?php print_sidebar('footer-three-column-center'); ?></div>
							<div class="one-third column"><?php print_sidebar('footer-three-column-right'); ?></div>
						<?php }
						if(get_option(DESIGNARE_SHORTNAME . "_footer_columns_order") == "one_two_three"){ ?>
							<div class="one-third column"><?php print_sidebar('footer-three-column-left-1_3'); ?></div>
							<div class="two-thirds column"><?php print_sidebar('footer-three-column-right-2_3'); ?></div>
						<?php }
						if(get_option(DESIGNARE_SHORTNAME . "_footer_columns_order") == "two_one_three"){ ?>
							<div class="two-thirds column"><?php print_sidebar('footer-three-column-left-2_3'); ?></div>
							<div class="one-third column"><?php print_sidebar('footer-three-column-right-1_3'); ?></div>
						<?php }
					}
					if(get_option(DESIGNARE_SHORTNAME . "_footer_number_cols") == "four"){
						if(get_option(DESIGNARE_SHORTNAME . "_footer_columns_order_four") == "one_four"){ ?>
							<div class="four columns"><?php print_sidebar('footer-four-column-left'); ?></div>
							<div class="four columns"><?php print_sidebar('footer-four-column-center-left'); ?></div>
							<div class="four columns"><?php print_sidebar('footer-four-column-center-right'); ?></div>
							<div class="four columns"><?php print_sidebar('footer-four-column-right'); ?></div>
						<?php }
						if(get_option(DESIGNARE_SHORTNAME . "_footer_columns_order_four") == "two_one_two_four"){ ?>
							<div class="four columns"><?php print_sidebar('footer-four-column-left-1_2_4'); ?></div>
							<div class="eight columns"><?php print_sidebar('footer-four-column-center-2_2_4'); ?></div>
							<div class="four columns"><?php print_sidebar('footer-four-column-right-1_2_4'); ?></div>
						<?php }
						if(get_option(DESIGNARE_SHORTNAME . "_footer_columns_order_four") == "three_one_four"){ ?>
							<div class="twelve columns"><?php print_sidebar('footer-four-column-left-3_4'); ?></div>
							<div class="four columns"><?php print_sidebar('footer-four-column-right-1_4'); ?></div>
						<?php }
						if(get_option(DESIGNARE_SHORTNAME . "_footer_columns_order_four") == "one_three_four"){ ?>
							<div class="four columns"><?php print_sidebar('footer-four-column-left-1_4'); ?></div>
							<div class="twelve columns"><?php print_sidebar('footer-four-column-right-3_4'); ?></div>
						<?php }
					}
				?>
				</div>
		    </div>
			<?php
		}
	?>
    
    <?php
	    if (des_get_value(DESIGNARE_SHORTNAME."_show_sec_footer") == "on"){
		    ?>
		    <div class="copys">
				<div class="container">
					<?php if (get_option(DESIGNARE_SHORTNAME."_copyrights_left")){ ?><div class="copys_left eight columns"><?php _e(get_option(DESIGNARE_SHORTNAME."_copyrights_left"), "smartbox"); ?></div><?php } ?>
					<div class="copys_right eight columns">
						<div class="footer_right_content">
							<?php
								switch(get_option(DESIGNARE_SHORTNAME."_footer_right_content")){
									case "social":
										$darkstyle = (get_option(DESIGNARE_SHORTNAME."_footer_social_icons_style") === "dark") ? "-dark" : "";
										?>
										<div class="socialdiv<?php echo $darkstyle; ?>" style="float:right;">
											<ul>
												<?php
													$icons = array(array("facebook","Facebook"),array("twitter","Twitter"),array("tumblr","Tumblr"),array("forrst","Forrst"),array("stumble","Stumble"),array("flickr","Flickr"),array("linkedin","LinkedIn"),array("delicious","Delicious"),array("skype","Skype"),array("digg","Digg"),array("google","Google"),array("vimeo","Vimeo"),array("picasa","Picasa"),array("deviantart","DeviantArt"),array("behance","Behance"),array("instagram","Instagram"),array("myspace","MySpace"),array("blogger","Blogger"),array("wordpress","Wordpress"),array("grooveshark","GrooveShark"),array("youtube","Youtube"),array("reddit","Reddit"),array("rss","RSS"),array("soundcloud","SoundCloud"),array("pinterest","Pinterest"),array("dribbble","Dribbble"),array("yelp","Yelp"), array("foursquare","Foursquare"), array("xing","Xing"));
													foreach ($icons as $i){
														if (get_option(DESIGNARE_SHORTNAME."_icon-".$i[0]) != ""){
														?>
														<li>
															<a href="<?php echo get_option(DESIGNARE_SHORTNAME."_icon-".$i[0]); ?>" target="_blank" class="<?php echo $i[0]; ?>" title='<?php echo $i[1]; ?>'></a>
														</li>
														<?php
														}
													}
												?>
											</ul>
										</div>
										<?php
										break;
									case "menu":
										wp_nav_menu( array( 'theme_location' => 'footer-navigation', 'container' => false, 'menu_class' => 'footer_menu', 'menu_id' => 'footer_menu' ) ); 
										break;
									case "text":
										echo get_option(DESIGNARE_SHORTNAME."_footer_right_text");
										break;
								}
							?>
						</div>
					
					</div>
				</div>
			</div>
		    <?php
	    }
    ?>

<!-- Don't forget analytics -->
<?php if(get_option(DESIGNARE_SHORTNAME."_seo_analytics")) echo stripslashes(get_option(DESIGNARE_SHORTNAME."_seo_analytics")); ?>

<?php

/* sets the type of pagination [scroll, autoscroll, paged, default] */
wp_reset_query();
global $smartbox_reading_option; $smartbox_reading_option = get_option('smartbox_blog_reading_type');
if (is_archive() || is_single() || is_search() || is_page_template('blog-template.php') || is_page_template('blog-template-fullwidth.php') || is_page_template('blog-template-leftsidebar.php') ) {
	
	$nposts = get_option('posts_per_page');
	
	
	global $smartbox_more;
	global $smartbox_pag;
		$smartbox_more = 0;
		$smartbox_pag = 0;

	$orderby="";
	$category="";
	$nposts = "";
	
	if (isset($_GET['paged'])) $smartbox_pag = $_GET['paged'];
	else {
		$pageURL = 'http';
		if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		$smartbox_pagina = explode('/page/', $pageURL);
		if(isset($smartbox_pagina[1])) $smartbox_pagina = explode ('/', $smartbox_pagina[1]);
		if ($smartbox_pagina[0]) $smartbox_pag = $smartbox_pagina[0];	
	}
	if (!is_numeric($smartbox_pag)) $smartbox_pag = 1;
	$max = 0;
	
	switch ($smartbox_reading_option){
		case "scrollauto": 
				
				global $wp_query;
				
				// Add code to index pages.
				if( !is_singular() ) {	
					
					if (is_search()){
					
						wp_reset_query();
						
						$smartbox_reading_option = get_option('smartbox_blog_reading_type');
						$se = get_option(DESIGNARE_SHORTNAME."_search_everything");
	
						$nposts = get_option('posts_per_page');
						
						if (isset($_GET['paged'])) $smartbox_pag = $_GET['paged'];
						else {
							$pageURL = 'http';
							if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
							$pageURL .= "://";
							if ($_SERVER["SERVER_PORT"] != "80") {
								$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
							} else {
								$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
							}
							$smartbox_pagina = explode('/page/', $pageURL);
							if(isset($smartbox_pagina[1])) $smartbox_pagina = explode ('/', $smartbox_pagina[1]);
							if ($smartbox_pagina[0]) $smartbox_pag = $smartbox_pagina[0];	
						}
						if (!is_numeric($smartbox_pag)) $smartbox_pag = 1;
									
						if ($se == "on"){
							$args = array(
								'showposts' => get_option('posts_per_page'),
								'post_status' => 'publish',
								'paged' => $smartbox_pag,
								's' => esc_html($_GET['s'])
							);
						    
						    $the_query = new WP_Query( $args );
						    
						    $args2 = array(
								'showposts' => -1,
								'post_status' => 'publish',
								'paged' => $smartbox_pag,
								's' => esc_html($_GET['s'])
							);
							
							$counter = new WP_Query($args2);
							
						} else {
							$args = array(
								'showposts' => get_option('posts_per_page'),
								'post_status' => 'publish',
								'paged' => $smartbox_pag,
								'post_type' => 'post',
								's' => esc_html($_GET['s'])
							);
						    
						    $the_query = new WP_Query( $args );
						    
						    $args2 = array(
								'showposts' => -1,
								'post_status' => 'publish',
								'paged' => $smartbox_pag,
								'post_type' => 'post',
								's' => esc_html($_GET['s'])
							);
							
							$counter = new WP_Query($args2);
						}

						$max = ceil($counter->post_count / $nposts);
						$smartbox_paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;
											
					} else {
	
						// What page are we on? And what is the pages limit?
						$max = $wp_query->max_num_pages;
						$smartbox_paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;
						
					}
					
					?> 
							
					<script type="text/javascript">
					
						jQuery(document).ready(function($){
					
							if ($('#reading_option').html() === "scrollauto"){ 
								window.loadingPoint = 0;
								//monitor page scroll to fire up more posts loader
								window.clearInterval(window.interval);
								window.interval = setInterval('monitorScrollTop()', 1000 );
							}	
						
						});
					
					</script>
					
					<?php
					
					
				} else {
					
				    $args = array(
	    				'showposts' => $nposts,
	    				'orderby' => $orderby,
	    				'order' => $order,
	    				'cat' => $category,
	    				'paged' => $smartbox_pag,
	    				'post_status' => 'publish'
	    			);
	    				
	    			//global $post, $wp_query;
	    		    
	    		    $the_query = new WP_Query( $args );
	
		    		$max = $the_query->max_num_pages;
		    		$smartbox_paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;
		    		
		    		?> 
		    		
		    			<script type="text/javascript">
					
							jQuery(document).ready(function($){
						
								if ($('#reading_option').html() === "scrollauto"){ 
									window.loadingPoint = 0;
									//monitor page scroll to fire up more posts loader
									window.clearInterval(window.interval);
									window.interval = setInterval('monitorScrollTop()', 1000 );
								}	
							
							});
						
						</script>
		    		<?php
	    				
	    		}
			break;
		case "scroll": 

				global $wp_query;
				
				// Add code to index pages.
				if( !is_singular() ) {	
				
					if (is_search()){
						wp_reset_query();
						
						$nposts = get_option('posts_per_page');
					
						$se = get_option(DESIGNARE_SHORTNAME."_search_everything");

						if ($se == "on"){
							$args = array(
								'showposts' => get_option('posts_per_page'),
								'post_status' => 'publish',
								'paged' => $smartbox_pag,
								's' => esc_html($_GET['s'])
							);
						    
						    $the_query = new WP_Query( $args );
						    
						    $args2 = array(
								'showposts' => -1,
								'post_status' => 'publish',
								'paged' => $smartbox_pag,
								's' => esc_html($_GET['s'])
							);
							
							$counter = new WP_Query($args2);
							
						} else {
							$args = array(
								'showposts' => get_option('posts_per_page'),
								'post_status' => 'publish',
								'paged' => $smartbox_pag,
								'post_type' => 'post',
								's' => esc_html($_GET['s'])
							);
						    
						    $the_query = new WP_Query( $args );
						    
						    $args2 = array(
								'showposts' => -1,
								'post_status' => 'publish',
								'paged' => $smartbox_pag,
								'post_type' => 'post',
								's' => esc_html($_GET['s'])
							);
							
							$counter = new WP_Query($args2);
						}
					    
						$max = ceil($counter->post_count / $nposts);
						$smartbox_pag = 1;

						if (isset($_GET['paged'])) $smartbox_pag = $_GET['paged'];
						else {
							$pageURL = 'http';
							if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
							$pageURL .= "://";
							if ($_SERVER["SERVER_PORT"] != "80") {
								$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
							} else {
								$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
							}
							$smartbox_pagina = explode('/page/', $pageURL);
							if(isset($smartbox_pagina[1])) $smartbox_pagina = explode ('/', $smartbox_pagina[1]);
							if ($smartbox_pagina[0]) $smartbox_pag = $smartbox_pagina[0];	
						}
						if (!is_numeric($smartbox_pag)) $smartbox_pag = 1;
					
					} else {
						// What page are we on? And what is the pages limit?
						$max = $wp_query->max_num_pages;
						$smartbox_paged = $smartbox_pag;
											
					}
					
					
				} else {
				 			
					$orderby = "";
					$category = "";

				    $args = array(
	    				'showposts' => $nposts,
	    				'orderby' => $orderby,
	    				'order' => $order,
	    				'cat' => $category,
	    				'post_status' => 'publish'
	    			);
	    		    
	    		    $the_query = new WP_Query( $args );
	    		    	    		
	
		    		$max = $the_query->max_num_pages;
		    		$smartbox_pag = 1;

					if (isset($_GET['paged'])) $smartbox_pag = $_GET['paged'];
					else {
						$pageURL = 'http';
						if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
						$pageURL .= "://";
						if ($_SERVER["SERVER_PORT"] != "80") {
							$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
						} else {
							$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
						}
						$smartbox_pagina = explode('/page/', $pageURL);
						if(isset($smartbox_pagina[1])) $smartbox_pagina = explode ('/', $smartbox_pagina[1]);
						if ($smartbox_pagina[0]) $smartbox_pag = $smartbox_pagina[0];	
					}
					if (!is_numeric($smartbox_pag)) $smartbox_pag = 1;		    			    				
	    		}
										
			break;
	}
	?>
	<div class="smartbox_helper_div" id="loader-startPage"><?php echo $smartbox_pag; ?></div>
	<div class="smartbox_helper_div" id="loader-maxPages"><?php echo $max; ?></div>
	<div class="smartbox_helper_div" id="loader-nextLink"><?php echo next_posts($max, false); ?></div>
	<?php
}

?>

</div> <!-- end of everything -->


<?php 
	global $smartbox_pag;
	if ($smartbox_pag > 1) {
	?>
	<div class="smartbox_helper_div" id="loader-prevLink"><?php
		if (isset($_GET['paged'])) {
			$pageURL = 'http';
			if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
			$pageURL .= "://";
			if ($_SERVER["SERVER_PORT"] != "80") {
				$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
			} else {
				$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
			}
			$aux = explode("paged=",$pageURL);
			$output = $aux[0]."paged=";
			$output .= (int)$smartbox_pag-1;
			echo $output;
		}
		else {
			$pageURL = 'http';
			if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
			$pageURL .= "://";
			if ($_SERVER["SERVER_PORT"] != "80") {
				$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
			} else {
				$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
			}
			$aux = explode('/page/', $pageURL);
			$output = $aux[0]."/page/";
			$output .= (int)$smartbox_pag-1;
			$output .= "/";
			echo $output;	
		}
	?></div>
	<?php
}?>
<div class="smartbox_helper_div" id="reading_option"><?php 
	if ($smartbox_reading_option == "scrollauto"){
		$detect = new Mobile_Detect();
		if ($detect->isMobile())
			$smartbox_reading_option = "scroll";
	}
	echo $smartbox_reading_option; 
?></div>
<div class="smartbox_helper_div" id="smartbox_no_more_posts_text"><?php echo __(get_option('smartbox_no_more_posts_text'), "smartbox"); ?></div>
<div class="smartbox_helper_div" id="smartbox_load_more_posts_text"><?php echo __(get_option('smartbox_load_more_posts_text'), "smartbox");  ?></div>
<div class="smartbox_helper_div" id="smartbox_loading_posts_text"><?php echo __(get_option('smartbox_loading_posts_text'), "smartbox");  ?></div>
<div class="smartbox_helper_div" id="smartbox_links_color_hover"><?php echo des_get_value('smartbox_links_color_hover'); ?></div>
<div class="smartbox_helper_div" id="smartbox_enable_images_magnifier"><?php echo get_option('smartbox_enable_images_magnifier'); ?></div>
<div class="smartbox_helper_div" id="smartbox_thumbnails_hover_option"><?php echo get_option('smartbox_thumbnails_hover_option'); ?></div>
<div class="smartbox_helper_div" id="smartbox_menu_color">#<?php echo des_get_value(DESIGNARE_SHORTNAME."_menu_color"); ?></div>
<div class="smartbox_helper_div" id="smartbox_fixed_menu"><?php echo get_option(DESIGNARE_SHORTNAME."_fixed_menu"); ?></div>
<div class="smartbox_helper_div" id="smartbox_thumbnails_effect"><?php if (get_option(DESIGNARE_SHORTNAME."_animate_thumbnails") == "on") echo get_option(DESIGNARE_SHORTNAME."_thumbnails_effect"); else echo "none"; ?></div>
<div class="smartbox_helper_div loadinger">
	<img alt="loading" src="<?php echo get_template_directory_uri(). '/img/ajx_loading.gif' ?>">
</div>
<div class="smartbox_helper_div" id="permalink_structure"><?php echo get_option('permalink_structure'); ?></div>
<div class="smartbox_helper_div" id="headerstyle3_menucolor">#<?php echo des_get_value(DESIGNARE_SHORTNAME."_menu_color"); ?></div>
<div class="smartbox_helper_div" id="disable_responsive_layout"><?php echo get_option('smartbox_disable_responsive'); ?></div>
<div class="smartbox_helper_div" id="mobile_menu_back_text"><?php echo __(get_option('smartbox_mobile_menu_back_text'), 'smartbox'); ?></div>

<?php if (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0') !== false){ ?> <div class="ua_ie11"></div> <?php } ?>
<?php
	if (!is_page_template('blog-template-fullwidth.php')){
		?>
			</div>		
		<?php
	}
?>


<?php wp_footer(); ?>

</body>
</html>