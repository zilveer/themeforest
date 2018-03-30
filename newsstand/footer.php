<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package News Stand
 */
?>
<?php global $newsstand; ?>

<?php
	if (isset($newsstand['newsstand_footer_style'])) {
		$footer_style = $newsstand['newsstand_footer_style'];
	} else {
		$footer_style = 1;
	}

	$footer_nav_bg 			= $newsstand['newsstand_footer_nav_bg'];
	$footer_copyright_bg 	= $newsstand['newsstand_footer_copyright_bg'];
	$footer_bg 				= $newsstand['newsstand_footer_bg'];

	$copyright_text			= $newsstand['newsstand_footer_copyright'];

	if (isset($newsstand['footer_boxes_abouttext'])) {
		$f_abouttext = $newsstand['footer_boxes_abouttext'];
	} else {
		$f_abouttext = "";
	}

	if (isset($newsstand['newsstand_logo']['url'])) {
		$f_abouttext 			= str_replace("[logo]","<img src='".esc_url($newsstand['newsstand_logo']['url'])."' alt=''>",$f_abouttext);
	} else {
		$f_abouttext 			= str_replace("[logo]","*You must upload Logo in order to work*",$f_abouttext);
	}
	if (isset($newsstand['newsstand_footer_logo']['url'])) {
		$f_abouttext 			= str_replace("[logofooter]","<img src='".esc_url($newsstand['newsstand_footer_logo']['url'])."' alt=''>",$f_abouttext);
	} else {
		$f_abouttext 			= str_replace("[logofooter]","*You must upload Footer Logo in order to work*",$f_abouttext);
	}

	if (isset($newsstand['footer_boxes_links1'])) {
		$f_links1 = $newsstand['footer_boxes_links1'];
		$f_links1 				= wp_get_nav_menu_object($f_links1);
		if (isset($f_links1) && !empty($f_links1)) {
			$f_links1 				= $f_links1->name;
		}
	} else {
		$f_links1 = "";
	}

	if (isset($newsstand['footer_boxes_links2'])) {
		$f_links2				= $newsstand['footer_boxes_links2'];
		$f_links2 				= wp_get_nav_menu_object($f_links2);
		if (isset($f_links2) && !empty($f_links2)) {
			$f_links2 				= $f_links2->name;
		}
	} else {
		$f_links2 = "";
	}

	if (isset($newsstand['footer_boxes_contact'])) {
		$f_contact = $newsstand['footer_boxes_contact'];
	} else {
		$f_contact = "";
	}

	if (isset($newsstand['footer_instagram_id'])) {
		$f_instaid				= $newsstand['footer_instagram_id'];
	} else { $f_instaid = ""; }

	if (isset($newsstand['footer_twitter_username'])) {
		$f_twitteruser			= $newsstand['footer_twitter_username'];
	} else { $f_twitteruser = ""; }

	if (isset($newsstand['newsstand-social'])) {
		$social 				= $newsstand['newsstand-social'];
	} else {
		$social = "";
	}

	if (isset($newsstand['footer_newsletter_shortcode'])) {
		$f_newsletter 			= $newsstand['footer_newsletter_shortcode'];
	} else { $f_newsletter = ""; }

	if (isset($newsstand['footer_newsletter_text'])) {
		$f_newsletter_text		= $newsstand['footer_newsletter_text'];
	} else { $f_newsletter_text = ""; }

?>

<?php if ($footer_style==1 || $footer_style==3): ?>
	<footer class="site-footer style-1" style="background-color: <?php echo esc_attr($footer_bg); ?>">

	<?php if ($footer_style!=3): ?>
		    <div class="mini-nav" style="background-color: <?php echo esc_attr($footer_nav_bg); ?>;">
		        <div class="container">
		            <div class="actual-container">
		                <div class="logo">
		                    <a href="<?php echo site_url(); ?>" class="logo">
		                    	<?php if (!empty($newsstand['newsstand_footer_logo'])): ?>
		                    		<img src="<?php echo esc_url($newsstand['newsstand_footer_logo']['url']); ?>" alt="">
		                    	<?php endif ?>
		                    </a>
		                </div>
		                <nav>
		                    <ul>
		                        <?php
			                        if ( has_nav_menu( 'footer' ) ) {
			                            // User has assigned menu to this location;
			                            // output it
			                            wp_nav_menu( array(
			                                'theme_location' 	=> 'footer',
			                                'menu_class' 		=> 'nav',
			                                'container' 		=> '',
			                                'items_wrap'      	=> '%3$s',
			                                'depth'           	=> 1,
			                            ) );
			                        } else {
			                            echo '<li><a href="'.admin_url().'nav-menus.php"><span>'.__('Create your menu +', 'newsstand').'</span></a></li>';
			                        }
			                    ?>
		                    </ul>
		                </nav>
		            </div>
		        </div>
		    </div>
	<?php endif ?>

	    <div class="footer-info">
	        <div class="container">
	            <div class="row">

	            	<?php foreach ($newsstand['footer_boxes_1'] as $box => $value): ?>

	            		<?php if ($value!="hidden"): ?>
	            			<div class="col-sm-6 col-md-3">
	            			    <div class="box">
	            			        <div class="box-title"><?php echo esc_html($value); ?></div>
	            			        <div class="box-content">

	            			        	<?php if ($box=="About Text"): ?>

	            			        		<?php echo apply_filters('the_content',$f_abouttext); ?>

	            			        	<?php elseif($box=="Links 1"): ?>

	            			        		<ul>
	        			                        <?php
        				                            wp_nav_menu( array(
        				                                'menu' 	=> $f_links1,
        				                                'menu_class' 		=> 'nav',
        				                                'container' 		=> '',
        				                                'items_wrap'      	=> '%3$s',
        				                                'depth'           	=> 1,
        				                            ) );
	        				                    ?>
	            			        		</ul>

	            			        	<?php elseif($box=="Links 2"): ?>

	            			        		<ul>
	        			                        <?php
        				                            wp_nav_menu( array(
        				                                'menu' 	=> $f_links2,
        				                                'menu_class' 		=> 'nav',
        				                                'container' 		=> '',
        				                                'items_wrap'      	=> '%3$s',
        				                                'depth'           	=> 1,
        				                            ) );
	        				                    ?>
	            			        		</ul>

	            			        	<?php elseif($box=="Contact Info"): ?>

	            			        		<?php if (!empty($f_contact[0]['title'])): ?>

	            			        			<ul class="with-icons">
		            			        			<?php foreach ($f_contact as $info): ?>
		            			        				<?php if (!empty($info['url'])): ?>
		            			        					<li><a href="<?php echo esc_url($info['url']); ?>" target="_blank"><i class="fa <?php echo esc_attr($info['title']); ?>"></i><?php echo esc_html($info['description']); ?></a></li>
		            			        				<?php else: ?>
		            			        					<li><i class="fa <?php echo esc_attr($info['title']); ?>"></i><?php echo esc_html($info['description']); ?></li>
		            			        				<?php endif ?>
		            			        			<?php endforeach ?>
	            			        			</ul>

	            			        		<?php endif ?>

	            			        	<?php endif ?>

	            			        </div>
	            			    </div>
	            			</div><!-- end of col -->
	            		<?php endif ?>
	            	<?php endforeach ?>

	            </div>
	        </div>
	    </div>

	    <div class="copyright" style="background-color: <?php echo esc_attr($footer_copyright_bg); ?>;">
	        <div class="container">
	            <div class="actual-container">
	                <p><?php echo wp_kses($copyright_text, ''); ?></p>
	            </div>
	        </div>
	    </div>
	</footer>
<?php endif ?>

<?php if ($footer_style==2): ?>

	<footer class="site-footer style-3" style="background-color: <?php echo esc_attr($footer_bg); ?>">

	    <div class="container">
	        <div class="footer-boxes">

	            <div class="row">

	            	<?php foreach ($newsstand['footer_boxes_2'] as $box => $value): ?>

	            		<?php if ($value!="hidden"): ?>
	            			<div class="col-sm-6 col-md-3">
	            			    <div class="box">
	            			        <div class="box-title"><?php echo esc_html($value); ?></div>
	            			        <div class="box-content">

	            			        	<?php if ($box=="About Text"): ?>

	            			        		<?php echo apply_filters('the_content',$f_abouttext); ?>

	            			        		<?php if (isset($social)): ?>
	            			        			<div class="social">
	            			        			    <?php foreach ($social as $single): ?>
	            			        			    	<?php if (!empty($single['description']) || !empty($single['url'])): ?>
	            			        			    		<a href="<?php echo esc_url($single['url']); ?>" target="_blank"><i class="fa <?php echo esc_attr($single['description']); ?>"></i></a>
	            			        			    	<?php endif ?>
	            			        			    <?php endforeach ?>
	            			        			</div>
	            			        		<?php endif ?>

	            			        	<?php elseif($box=="Links 1"): ?>

	            			        		<ul class="list">
	        			                        <?php
        				                            wp_nav_menu( array(
        				                                'menu' 	=> $f_links1,
        				                                'menu_class' 		=> 'nav',
        				                                'container' 		=> '',
        				                                'items_wrap'      	=> '%3$s',
        				                                'depth'           	=> 1,
        				                            ) );
	        				                    ?>
	            			        		</ul>

	            			        	<?php elseif($box=="Twtiter Feed"): ?>

	            			        		<div id="twitterfeed"></div>

	            			        		<script>
	            			        		    (function($) {
	            			        		        "use strict";

	            			        		        $(document).ready(function() {
	            			        		            if ($("#twitterfeed").length) {
	            			        		                $('#twitterfeed').twittie({
	            			        		                    apiPath: "<?php echo get_template_directory_uri(); ?>/api/tweet.php",
	            			        		                    username: '<?php echo esc_js($f_twitteruser); ?>',
	            			        		                    count: 3,
	            			        		                    hideReplies: false,
	            			        		                    template: '<a href="{{url}}" target="_blank"><span class="text">{{tweet}}</span><span class="date">{{date}}</span></a>'
	            			        		                });
	            			        		            }
	            			        		        });
	            			        		    })(jQuery);
	            			        		</script>

	            			        	<?php elseif($box=="Instagram Feed"): ?>

	            			        		<div id="instafeed-footer"></div>

	            			        		<script>
	            			        		    (function($) {
	            			        		        "use strict";

	            			        		        $(document).ready(function() {
	            			        		            if ($("#instafeed-footer").length > 0) {
	            			        		                var feed = new Instafeed({
	            			        		                    target: "instafeed-footer",
	            			        		                    get: 'user',
	            			        		                    limit: 16,
	            			        		                    userId: <?php echo esc_js($f_instaid); ?>,
	            			        		                    accessToken: '1068835781.467ede5.bed6906b0d4f43279648a2d6bf6c7b0d',
	            			        		                    template: '<a class="sameHeight plus-hover"  target="_blank" href="{{link}}" style="background-image: url({{image}});"><span class="plus"></span></a>',
	            			        		                    sortBy: 'most-recent',
	            			        		                    useHttp: true,
	            			        		                });
	            			        		                feed.run();
	            			        		            }
	            			        		        });
	            			        		    })(jQuery);
	            			        		</script>

	            			        	<?php endif ?>

	            			        </div>
	            			    </div>
	            			</div><!-- end of col -->
	            		<?php endif ?>
	            	<?php endforeach ?>
	            </div>

	        </div><!-- end of footer-boxes-->
	    </div>

	<div class="copyright" style="background-color: <?php echo esc_attr($footer_copyright_bg); ?>;">
		<?php echo wp_kses($copyright_text, ''); ?>
	</div>

	</footer>
<?php endif ?>

<?php if ($footer_style==4): ?>

	<footer class="site-footer style-1" style="background-color: <?php echo esc_attr($footer_bg); ?>">

	    <div class="mini-nav">
	        <div class="container">
	            <div class="actual-container">
	                <div class="logo">
	                    <a href="<?php echo site_url(); ?>" class="logo">
	                    	<?php if (!empty($newsstand['newsstand_footer_logo'])): ?>
	                    		<img src="<?php echo esc_url($newsstand['newsstand_footer_logo']['url']); ?>" alt="">
	                    	<?php endif ?>
	                    </a>
	                </div>
	                <nav>
	                    <ul>
	                        <?php
		                        if ( has_nav_menu( 'footer' ) ) {
		                            // User has assigned menu to this location;
		                            // output it
		                            wp_nav_menu( array(
		                                'theme_location' 	=> 'footer',
		                                'menu_class' 		=> 'nav',
		                                'container' 		=> '',
		                                'items_wrap'      	=> '%3$s',
		                                'depth'           	=> 1,
		                            ) );
		                        } else {
		                            echo '<li><a href="'.admin_url().'nav-menus.php"><span>'.__('Create your menu +', 'newsstand').'</span></a></li>';
		                        }
		                    ?>
	                    </ul>
	                </nav>
	            </div>
	        </div>
	    </div>

	    <div class="copyright" style="background-color: <?php echo esc_attr($footer_copyright_bg); ?>;">
	        <div class="container">
	            <div class="actual-container">
	                <p><?php echo wp_kses($copyright_text, ''); ?></p>
	            </div>
	        </div>
	    </div>

	</footer>
<?php endif ?>

<?php if ($footer_style==5): ?>

	<footer class="site-footer style-4" style="background-color: <?php echo esc_attr($footer_bg); ?>">

	    <div class="container">
	        <div class="footer-boxes">

	            <div class="row">

	            	<?php foreach ($newsstand['footer_boxes_3'] as $box => $value): ?>

	            		<?php if ($value!="hidden"): ?>
	            			<div class="col-md-4">
	            			    <div class="box">
	            			    	<?php if ($box!="Newsletter"): ?>
	            			    		<div class="box-title"><?php echo esc_html($value); ?></div>
	            			    	<?php endif ?>

	            			        <div class="box-content">

	            			        	<?php if ($box=="About Text"): ?>

	            			        		<?php echo apply_filters('the_content',$f_abouttext); ?>

	            			        		<?php if (isset($social)): ?>
	            			        			<div class="social">
	            			        			    <?php foreach ($social as $single): ?>
	            			        			    	<?php if (!empty($single['description']) || !empty($single['url'])): ?>
	            			        			    		<a href="<?php echo esc_url($single['url']); ?>" target="_blank"><i class="fa <?php echo esc_attr($single['description']); ?>"></i></a>
	            			        			    	<?php endif ?>
	            			        			    <?php endforeach ?>
	            			        			</div>
	            			        		<?php endif ?>

	            			        	<?php elseif($box=="Twtiter Feed"): ?>

	            			        		<div id="twitterfeed"></div>

	            			        		<script>
	            			        		    (function($) {
	            			        		        "use strict";

	            			        		        $(document).ready(function() {
	            			        		            if ($("#twitterfeed").length) {
	            			        		                $('#twitterfeed').twittie({
	            			        		                    apiPath: "<?php echo get_template_directory_uri(); ?>/api/tweet.php",
	            			        		                    username: '<?php echo esc_js($f_twitteruser); ?>',
	            			        		                    count: 3,
	            			        		                    hideReplies: false,
	            			        		                    template: '<a href="{{url}}" target="_blank"><span class="text">{{tweet}}</span><span class="date">{{date}}</span></a>'
	            			        		                });
	            			        		            }
	            			        		        });
	            			        		    })(jQuery);
	            			        		</script>

	            			        	<?php elseif($box=="Newsletter"): ?>

        		                           <?php if (isset($social)): ?>
        		                           	<div class="soc-networks">
        		                           			<span class="mini-title"><?php echo _e('Social Networks', 'newsstand'); ?></span>
        		                           			<span class="mini-content">
        		                           				<?php foreach ($social as $single): ?>
        		                           					<?php if (!empty($single['description']) || !empty($single['url'])): ?>
        		                           						<a href="<?php echo esc_url($single['url']); ?>" target="_blank"><i class="fa <?php echo esc_attr($single['description']); ?>"></i></a>
        		                           					<?php endif ?>
        		                           				<?php endforeach ?>
        		                           			</span>
        		                           	</div>
        		                           <?php endif ?>

        		                           <div class="newsletter-boxi">
        		                           		<span class="mini-title"><?php echo esc_html($value); ?></span>
        		                           		<?php if (!empty($f_newsletter_text)): ?>
        		                           			<p><?php echo esc_html($f_newsletter_text); ?></p>
        		                           		<?php endif ?>

        		                           		<?php if (!empty($f_newsletter)): ?>
        		                           			<?php echo do_shortcode($f_newsletter); ?>
        		                           		<?php endif ?>
        		                           </div>

	            			        	<?php endif ?>

	            			        </div>
	            			    </div>
	            			</div><!-- end of col -->
	            		<?php endif ?>
	            	<?php endforeach ?>

	            </div>

	        </div><!-- end of footer-boxes-->
	    </div>

	<div class="copyright" style="background-color: <?php echo esc_attr($footer_copyright_bg); ?>;">
		<?php echo wp_kses($copyright_text, ''); ?>
	</div>

	</footer>

<?php endif ?>

<?php wp_footer(); ?>

</body>
</html>
