<?php



/*-----------------------------------------------------------------------------------*/
/*	Content Width
/*-----------------------------------------------------------------------------------*/
if ( ! isset( $content_width ) )
	$content_width = 960;



/*-----------------------------------------------------------------------------------*/
/*	Slightly Modified Options Framework
/*-----------------------------------------------------------------------------------*/
require_once ('admin/index.php');
include("functions/dreamer-postmeta.php");


require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'dreamer_register_required_plugins' );

function dreamer_register_required_plugins() {
    $plugins = array(
         array(
			'name'     => 'Revolution Slider',
			'slug'     => 'revslider',
			'source'   => get_stylesheet_directory() . '/plugins/revslider.zip',
			'required' => false
        )
    );

    $theme_text_domain = 'dreamer';


    $config = array(
        	'strings' => array()
    );

    tgmpa( $plugins, $config );

}


/**
 * Sets up theme defaults and registers the various WordPress features that
 * Dreamer supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add a Visual Editor stylesheet.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,
 * 	custom background, and post formats.
 * @uses register_nav_menu() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 */
function dreamer_setup() {
	/*
	 * Makes Dreamer available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Dreamer, use a find and replace
	 * to change 'dreamer' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'dreamer', get_template_directory() . '/languages' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// This theme supports a variety of post formats.
	add_theme_support( 'post-formats', array( 'gallery','image', 'video', 'audio' ) );
	add_post_type_support( 'post', 'post-formats' );

	/*
	 * This theme supports custom background color and image, and here
	 * we also set up the default background color.
	 */
	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff',
	) );

	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'team-thumbnail', 230, 266, true ); //(cropped)
	add_image_size( 'about-thumbnail', 105, 100, true ); //(cropped)
	add_image_size( 'services-thumbnail', 170, 50, true ); //(cropped)
	add_image_size( 'news-thumbnail', 790, 589, true ); //(cropped)
	add_image_size( 'portfolio-thumbnail', 790, 589, true ); //(cropped)
	add_image_size( 'portfolio-large', 1122, 438, true ); //(cropped)
	add_image_size( 'news-large', 721, 282, true ); //(cropped)
	add_image_size( 'format-large', 960, 350, true ); //(cropped)
}
add_action( 'after_setup_theme', 'dreamer_setup' );

/*-----------------------------------------------------------------------------------*/
/*	Add CSS Files To Header
/*-----------------------------------------------------------------------------------*/

function dreamer_register_css() {
	if (!is_admin()) {
		wp_register_style( 'dreamer_main_css', get_template_directory_uri() . '/style.css' );
		wp_register_style( 'dreamer_portfolio_css', get_template_directory_uri() . '/css/portfolio.css' );
		wp_register_style( 'dreamer_foundation_css', get_template_directory_uri() . '/css/foundation.css' );
		wp_register_style( 'dreamer_normalize_css', get_template_directory_uri() . '/css/normalize.css' );
		wp_register_style( 'dreamer_supersized_css', get_template_directory_uri() . '/css/supersized.css' );
		wp_register_style( 'dreamer_supersized_shutter_css', get_template_directory_uri() . '/css/supersized.shutter.css' );
		wp_register_style( 'dreamer_prettyphoto_css', get_template_directory_uri() . '/css/prettyPhoto.css');
		wp_register_style( 'dreamer_bigvideo_css', get_template_directory_uri() . '/css/bigvideo.css');

		wp_register_style( 'dreamer_fonts_ptsans','http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic');
		wp_register_style( 'dreamer_fonts_ubuntu','http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700,300italic,400italic,500italic,700italic&subset=latin,cyrillic-ext,greek-ext,greek,latin-ext');
		wp_register_style( 'dreamer_fonts_gentiumbookbasic','http://fonts.googleapis.com/css?family=Gentium+Book+Basic:400,400italic,700,700italic&subset=latin,latin-ext' );
		wp_register_style( 'dreamer_fonts_lato','http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' );
		wp_enqueue_style('draemer-icons', 'http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css', array(), '1.0', 'all' );
		wp_enqueue_style('dreamer_main_css');
		wp_enqueue_style('dreamer_portfolio_css');
		wp_enqueue_style('dreamer_foundation_css');
		wp_enqueue_style('dreamer_normalize_css');
		wp_enqueue_style('dreamer_supersized_css');
		wp_enqueue_style('dreamer_supersized_shutter_css');
		wp_enqueue_style('dreamer_prettyphoto_css');
		wp_enqueue_style('dreamer_fonts_ptsans');
		wp_enqueue_style('dreamer_fonts_ubuntu');
		wp_enqueue_style('dreamer_fonts_gentiumbookbasic');
		wp_enqueue_style('dreamer_fonts_lato');

		if (is_page_template('template-background-video.php')) {
			function add_big_video_css() { ?>
				<style>
                .parallax-one, .parallax-two, .parallax-three, .parallax-four, .parallax-five,.parallax-six,.parallax-seven,.parallax-eight,.parallax-nine {
                    background-attachment: scroll !important;
                }
                </style>
                <?php
            }
			add_action('wp_head','add_big_video_css',100);
		}

	}
}

add_action('wp_enqueue_scripts', 'dreamer_register_css');

register_sidebar(array(
  'name' => __( 'Right Hand Sidebar', 'dreamer' ),
  'id' => 'right-sidebar',
  'description' => __( 'Widgets in this area will be shown on the right-hand side.', 'dreamer' ),
  'before_title' => '<h1>',
  'after_title' => '</h1>'
));

/*-----------------------------------------------------------------------------------*/
/* Register and load admin javascript
/*-----------------------------------------------------------------------------------*/
function dreamer_admin_js($hook) {
	if ($hook == 'post.php' || $hook == 'post-new.php') {
		wp_register_script('dreamer-admin', get_template_directory_uri() . '/js/jquery.theme.admin.js', 'jquery');
		wp_enqueue_script('dreamer-admin');
	}
}

add_action('admin_enqueue_scripts','dreamer_admin_js',10,1);

/*-----------------------------------------------------------------------------------*/
/*	Add JS Files
/*-----------------------------------------------------------------------------------*/

function dreamer_register_js() {
	if (!is_admin()) {

		wp_register_script('dreamer_modernizr', get_template_directory_uri() . '/js/modernizr.foundation.js');

		wp_register_script('dreamer_jquery_ui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js');


		wp_register_script('dreamer_foundation', get_template_directory_uri() . '/js/foundation.min.js','' , '1.0', TRUE);
		wp_register_script('dreamer_foundation_app', get_template_directory_uri() . '/js/app.js','' , '1.0', TRUE);
		wp_register_script('dreamer_foundation_easing', get_template_directory_uri() . '/js/jquery.easing.min.js','' , '1.0', TRUE);

		wp_register_script('dreamer_foundation_accordion', get_template_directory_uri() . '/js/jquery.foundation.accordion.js', 'jquery', '1.0', TRUE);
		wp_register_script('dreamer_foundation_forms', get_template_directory_uri() . '/js/jquery.foundation.forms.js', 'jquery', '1.0', TRUE);
		wp_register_script('dreamer_foundation_mediaQueryToggle', get_template_directory_uri() . '/js/jquery.foundation.mediaQueryToggle.js', 'jquery', '1.0', TRUE);
		wp_register_script('dreamer_foundation_navigation', get_template_directory_uri() . '/js/jquery.foundation.navigation.js', 'jquery', '1.0', TRUE);
		wp_register_script('dreamer_foundation_orbit', get_template_directory_uri() . '/js/jquery.foundation.orbit.js', 'jquery', '1.0', TRUE);
		wp_register_script('dreamer_foundation_topbar', get_template_directory_uri() . '/js/jquery.foundation.topbar.js', 'jquery', '1.0', TRUE);
		wp_register_script('dreamer_foundation_reveal', get_template_directory_uri() . '/js/jquery.foundation.reveal.js', 'jquery', '1.0', TRUE);
		wp_register_script('dreamer_fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js','' , '1.0', TRUE);
		wp_register_script('dreamer_supersized', get_template_directory_uri() . '/js/supersized.3.2.7.min.js','' , '1.0', TRUE);
		wp_register_script('dreamer_supersized_shutter', get_template_directory_uri() . '/js/supersized.shutter.min.js','' , '1.0', TRUE);
    	wp_register_script('dreamer_parallax', get_template_directory_uri() . '/js/jquery.parallax-1.1.3.js','' , '1.0', TRUE);
    	wp_register_script('dreamer_prettyPhoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js','' , '1.0', TRUE);

		wp_register_script('dreamer_custom', get_template_directory_uri() . '/js/jquery.dreamer.custom.js','' , '1.0', TRUE);

		wp_register_script('dreamer_custom_video_script', get_template_directory_uri() . '/js/jquery.dreamer.custom-video.js','' , '1.0', TRUE);

		wp_register_script('dreamer_isotope', get_template_directory_uri() . '/js/jquery.isotope.js','' , '1.0', TRUE);

		wp_register_script('dreamer_custom_script', get_template_directory_uri() . '/js/custom.js','' , '1.0', TRUE);

		wp_register_script('dreamer_big_video', get_template_directory_uri() . '/js/bigvideo.js','' , '1.0', TRUE);

		wp_register_script('dreamer_ui_jquery', get_template_directory_uri() . '/js/jquery-ui-1.8.22.custom.min.js','' , '1.0', TRUE);

		wp_register_script('dreamer_images_loaded', get_template_directory_uri() . '/js/jquery.imagesloaded.min.js','' , '1.0', TRUE);

		wp_register_script('dreamer_video5', 'http://vjs.zencdn.net/4.0/video.js','' , '1.0', TRUE);
		wp_enqueue_script('dreamer_jquery_ui');
		wp_enqueue_script('dreamer_modernizr');
		wp_enqueue_script('jquery');
		wp_enqueue_script('dreamer_foundation');
		wp_enqueue_script('dreamer_foundation_mediaQueryToggle');
		wp_enqueue_script('dreamer_foundation_reveal');
		wp_enqueue_script('dreamer_fitvids');
		wp_enqueue_script('dreamer_prettyPhoto');

		if (is_front_page() || is_page_template('template-background-slideshow.php') || is_page_template('template-revolution-slider.php') || is_page_template('template-background-video.php')) {
			wp_enqueue_script('dreamer_parallax');
		}

		if (!is_page_template('template-blog.php') & !is_single()) {
			wp_enqueue_script('dreamer_isotope');

			function isotope_script() { ?>
			<script type="text/javascript">
				var $container = jQuery('#portfolio-list');
				$container.isotope({
				});
				jQuery('#portfolio-filter a').click(function(){
					var selector = jQuery(this).attr('data-filter');
					$container.isotope({ filter: selector });
					return false;
				});
            </script>
		<?php }
		add_action('wp_footer','isotope_script',100);
		}

		if (is_page_template('template-blog.php')) {
			wp_enqueue_script('dreamer_foundation_orbit');
		}

		if (is_home() || is_front_page() || is_page_template('template-background-slideshow.php')) {
			wp_enqueue_script('dreamer_custom');
		} else if(is_page_template('template-revolution-slider.php')) {

		} else {
			wp_enqueue_script('dreamer_custom_video_script');
		}

		if (is_page_template('template-background-video.php')) {
			wp_enqueue_style('dreamer_bigvideo_css');
			wp_enqueue_script('dreamer_ui_jquery');
			wp_enqueue_script('dreamer_images_loaded');
			wp_enqueue_script('dreamer_video5');
			wp_enqueue_script('dreamer_big_video');

			function add_big_video() { ?>
			<script>
				jQuery(document).ready(function(){
					var BV;
					var BV = new jQuery.BigVideo({
						useFlashForFirefox:false,
						forceAutoplay:true,
						controls:false,
						doLoop:true
					});
					BV.init();
					if (Modernizr.touch) {
						BV.show('<?php global $smof_data; $dreamer_homepage_big_video_image = $smof_data['homepage_big_video_image']; echo $dreamer_homepage_big_video_image ?>');
					} else {
						BV.show('<?php global $smof_data; $dreamer_homepage_big_video_src_mp4 = $smof_data['homepage_big_video_src_mp4']; echo $dreamer_homepage_big_video_src_mp4 ?>', {altSource:'<?php global $smof_data; $dreamer_homepage_big_video_src_ogv = $smof_data['homepage_big_video_src_ogv']; echo $dreamer_homepage_big_video_src_ogv ?>'});
					}
				});
            </script>
			<?php
            }
		add_action('wp_footer','add_big_video',100);
		}
		wp_enqueue_script('dreamer_foundation_easing');
		wp_enqueue_script('dreamer_custom_script');





		function twitter_script() { global $smof_data; ?>

		<script type="text/javascript">
			$(function() {

			JQTWEET = {

			    // Set twitter hash/user, number of tweets & id/class to append tweets
			    // You need to clear tweet-date.txt before toggle between hash and user
			    // for multiple hashtags, you can separate the hashtag with OR, eg:
			    // hash: '%23jquery OR %23css'
			    search: '', //leave this blank if you want to show user's tweet
			    user: '<?php echo $smof_data["google_analytics_snippet"]; ?>', //username
			    numTweets: 9, //number of tweets
			    appendTo: '#jstwitter',
			    useGridalicious: false,
			    template: '<div class="tweet-holder">{IMG}<div class="tweet-content"><span class="text">{TEXT}</span>\
			               <span class="time"><a href="{URL}" target="_blank">{AGO}</a></span>\
			               by <span class="user">{USER}</span></div></div>',

			    // core function of jqtweet
			    // https://dev.twitter.com/docs/using-search
			    loadTweets: function() {

			        var request;

			        // different JSON request {hash|user}
			        if (JQTWEET.search) {
			          request = {
			              q: JQTWEET.search,
			              count: JQTWEET.numTweets,
			              api: 'search_tweets'
			          }
			        } else {
			          request = {
			              q: JQTWEET.user,
			              count: JQTWEET.numTweets,
			              api: 'statuses_userTimeline'
			          }
			        }

			        $.ajax({
			            url: '<?php echo get_template_directory_uri(); ?>/grabtweets.php',
			            type: 'POST',
			            dataType: 'json',
			            data: request,
			            success: function(data, textStatus, xhr) {

				            if (data.httpstatus == 200) {
				            	if (JQTWEET.search) data = data.statuses;

			                var text, name, img;

			                try {
			                  // append tweets into page
			                  for (var i = 0; i < JQTWEET.numTweets; i++) {

			                    img = '';
			                    url = 'http://twitter.com/' + data[i].user.screen_name + '/status/' + data[i].id_str;
			                    try {
			                      if (data[i].entities['media']) {
			                        img = '<a href="' + url + '" target="_blank"><img src="' + data[i].entities['media'][0].media_url + '" /></a>';
			                      }
			                    } catch (e) {
			                      //no media
			                    }

			                    $(JQTWEET.appendTo).append( JQTWEET.template.replace('{TEXT}', JQTWEET.ify.clean(data[i].text) )
			                        .replace('{USER}', data[i].user.screen_name)
			                        .replace('{IMG}', img)
			                        .replace('{AGO}', JQTWEET.timeAgo(data[i].created_at) )
			                        .replace('{URL}', url )
			                        );
			                  }

			                } catch (e) {
			                  //item is less than item count
			                }

				             if (JQTWEET.useGridalicious) {
				                //run grid-a-licious
						$(JQTWEET.appendTo).gridalicious({
							gutter: 13,
							width: 200,
							animate: true
						});
					     }

			               } else alert('no data returned');

			            }

			        });

			    },


			    /**
			      * relative time calculator FROM TWITTER
			      * @param {string} twitter date string returned from Twitter API
			      * @return {string} relative time like "2 minutes ago"
			      */
			    timeAgo: function(dateString) {
			        var rightNow = new Date();
			        var then = new Date(dateString);

			        if ($.browser.msie) {
			            // IE can't parse these crazy Ruby dates
			            then = Date.parse(dateString.replace(/( \+)/, ' UTC$1'));
			        }

			        var diff = rightNow - then;

			        var second = 1000,
			        minute = second * 60,
			        hour = minute * 60,
			        day = hour * 24,
			        week = day * 7;

			        if (isNaN(diff) || diff < 0) {
			            return ""; // return blank string if unknown
			        }

			        if (diff < second * 2) {
			            // within 2 seconds
			            return "right now";
			        }

			        if (diff < minute) {
			            return Math.floor(diff / second) + " seconds ago";
			        }

			        if (diff < minute * 2) {
			            return "about 1 minute ago";
			        }

			        if (diff < hour) {
			            return Math.floor(diff / minute) + " minutes ago";
			        }

			        if (diff < hour * 2) {
			            return "about 1 hour ago";
			        }

			        if (diff < day) {
			            return  Math.floor(diff / hour) + " hours ago";
			        }

			        if (diff > day && diff < day * 2) {
			            return "yesterday";
			        }

			        if (diff < day * 365) {
			            return Math.floor(diff / day) + " days ago";
			        }

			        else {
			            return "over a year ago";
			        }
			    }, // timeAgo()


			    /**
			      * The Twitalinkahashifyer!
			      * http://www.dustindiaz.com/basement/ify.html
			      * Eg:
			      * ify.clean('your tweet text');
			      */
			    ify:  {
			      link: function(tweet) {
			        return tweet.replace(/\b(((https*\:\/\/)|www\.)[^\"\']+?)(([!?,.\)]+)?(\s|$))/g, function(link, m1, m2, m3, m4) {
			          var http = m2.match(/w/) ? 'http://' : '';
			          return '<a class="twtr-hyperlink" target="_blank" href="' + http + m1 + '">' + ((m1.length > 25) ? m1.substr(0, 24) + '...' : m1) + '</a>' + m4;
			        });
			      },

			      at: function(tweet) {
			        return tweet.replace(/\B[@＠]([a-zA-Z0-9_]{1,20})/g, function(m, username) {
			          return '<a target="_blank" class="twtr-atreply" href="http://twitter.com/intent/user?screen_name=' + username + '">@' + username + '</a>';
			        });
			      },

			      list: function(tweet) {
			        return tweet.replace(/\B[@＠]([a-zA-Z0-9_]{1,20}\/\w+)/g, function(m, userlist) {
			          return '<a target="_blank" class="twtr-atreply" href="http://twitter.com/' + userlist + '">@' + userlist + '</a>';
			        });
			      },

			      hash: function(tweet) {
			        return tweet.replace(/(^|\s+)#(\w+)/gi, function(m, before, hash) {
			          return before + '<a target="_blank" class="twtr-hashtag" href="http://twitter.com/search?q=%23' + hash + '">#' + hash + '</a>';
			        });
			      },

			      clean: function(tweet) {
			        return this.hash(this.at(this.list(this.link(tweet))));
			      }
			    } // ify


			};

			});





		$(function () {
		    // start jqtweet!
		    JQTWEET.loadTweets();




		    <!--//--><![CDATA[//><!--
		    jQuery(document).ready(function() {
		    	jQuery('form#contact-us').submit(function() {
		    		jQuery('form#contact-us .error').remove();
		    		var hasError = false;
		    		jQuery('.requiredField').each(function() {
		    			if(jQuery.trim(jQuery(this).val()) == '') {
		    				var labelText = jQuery(this).prev('label').text();
		    				jQuery(this).parent().append('<span class="error">Your forgot to enter your '+labelText+'.</span>');
		    				jQuery(this).addClass('inputError');
		    				hasError = true;
		    			} else if(jQuery(this).hasClass('email')) {
		    				var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		    				if(!emailReg.test(jQuery.trim(jQuery(this).val()))) {
		    					var labelText = jQuery(this).prev('label').text();
		    					jQuery(this).parent().append('<span class="error">Sorry! You\'ve entered an invalid '+labelText+'.</span>');
		    					jQuery(this).addClass('inputError');
		    					hasError = true;
		    				}
		    			}
		    		});
		    		if(!hasError) {
		    			var formInput = jQuery(this).serialize();
		    			jQuery.post(jQuery(this).attr('action'),formInput, function(data){
		    				jQuery('form#contact-us').slideUp("fast", function() {
		    					jQuery(this).before('<p class="tick"><strong>Thanks!</strong> Your email has been delivered!</p>');
		    				});
		    			});
		    		}

		    		return false;
		    	});
		    });
		    //-->!]]>
		});
		</script>

		<?php }
		add_action('wp_footer','twitter_script',100);











		/*-----------------------------------------------------------------------------------*/
		/*	Homepage Slideshow
		/*-----------------------------------------------------------------------------------*/

		if ( is_front_page() || is_page_template('template-background-slideshow.php') ) {
			wp_enqueue_script('dreamer_supersized');
			wp_enqueue_script('dreamer_supersized_shutter');

		function add_homepage_slideshow() {  global $smof_data; ?>
		<script>
			jQuery(function($){
				$.supersized({
					// Functionality
					slideshow : <?php $dreamer_slideshow_on_off = $smof_data['slideshow_on_off']; echo $dreamer_slideshow_on_off ?>,
					autoplay : <?php $dreamer_slideshow_autoplay = $smof_data['slideshow_autoplay']; echo $dreamer_slideshow_autoplay ?>,
					start_slide : <?php $dreamer_slideshow_start_slide = $smof_data['slideshow_start_slide']; echo $dreamer_slideshow_start_slide ?>,
					stop_loop : <?php $dreamer_slideshow_stop_loop = $smof_data['slideshow_stop_loop']; echo $dreamer_slideshow_stop_loop ?>,
					random : <?php $dreamer_slideshow_random = $smof_data['slideshow_random']; echo $dreamer_slideshow_random ?>,
					slide_interval : <?php $dreamer_slideshow_interval = $smof_data['slideshow_interval']; echo $dreamer_slideshow_interval ?>,
					transition : <?php $dreamer_slideshow_transition_effect = $smof_data['slideshow_transition_effect']; echo $dreamer_slideshow_transition_effect ?>,
					transition_speed : <?php $dreamer_slideshow_transition_speed = $smof_data['slideshow_transition_speed']; echo $dreamer_slideshow_transition_speed ?>,
					new_window : <?php $dreamer_slideshow_links_open = $smof_data['slideshow_links_open']; echo $dreamer_slideshow_links_open ?>,
					pause_hover : <?php $dreamer_slideshow_pause_on_hover = $smof_data['slideshow_pause_on_hover']; echo $dreamer_slideshow_pause_on_hover ?>,
					keyboard_nav : <?php $dreamer_slideshow_keyboard_navigation = $smof_data['slideshow_keyboard_navigation']; echo $dreamer_slideshow_keyboard_navigation ?>,
					performance : <?php $dreamer_slideshow_performance = $smof_data['slideshow_performance']; echo $dreamer_slideshow_performance ?>,
					image_protect :	<?php $dreamer_slideshow_image_protect = $smof_data['slideshow_image_protect']; echo $dreamer_slideshow_image_protect ?>,

					// Size & Position
					min_width		        :   0,			// Min width allowed (in pixels)
					min_height		        :   0,			// Min height allowed (in pixels)
					vertical_center         :   1,			// Vertically center background
					horizontal_center       :   1,			// Horizontally center background
					fit_always				:	0,			// Image will never exceed browser width or height (Ignores min. dimensions)
					fit_portrait         	:   1,			// Portrait images will not exceed browser height
					fit_landscape			:   0,			// Landscape images will not exceed browser width

					// Components
					slide_links				:	'blank',	// Individual links for each slide (Options: false, 'num', 'name', 'blank')
					thumb_links				:	1,			// Individual thumb links for each slide
					thumbnail_navigation    :   0,			// Thumbnail navigation
					slides 					:  	[			// Slideshow Images
													<?php $slides = $smof_data["homepage_supersized_slideshow"]; //get the slides array
													foreach ($slides as $slide) {
														if ($slide < end($slides))
														echo '{image : "'.$slide['url'].'", url : "'.$slide['link'].'"},';
														if ($slide == end($slides))
														echo '{image : "'.$slide['url'].'", url : "'.$slide['link'].'"}';
													}?>
												],
					// Theme Options
					progress_bar			:	1,			// Timer for each slide
					mouse_scrub				:	0
				});
			});
		</script>
		<?php
		}

		add_action('wp_footer','add_homepage_slideshow',100);

		}

		function add_portfolio_isotope() { ?>

			<script type="text/javascript">

			    $(window).load(function() {
			           $(".orbit-gallery").orbit();
			       });




			    $(".video-container").fitVids();



			    $(window).load(function() {
			    	$('#loading').fadeOut('slow').remove();
			    });


			</script>

			<?php
			}

			add_action('wp_footer','add_portfolio_isotope',100);

	}
	if ( is_singular() ) wp_enqueue_script( "comment-reply" );
}
add_action('wp_enqueue_scripts', 'dreamer_register_js');

function show_posts_nav() {
	global $wp_query;
	return ($wp_query->max_num_pages > 1);
}

/*-----------------------------------------------------------------------------------*/
/*	GET ID by Page Name
/*-----------------------------------------------------------------------------------*/

function smof_get_ID_by_page_name($page_name)
{
	global $wpdb;
	$page_name_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '".$page_name."'");
	return $page_name_id;
}

/*-----------------------------------------------------------------------------------*/
/* Disqus
/*-----------------------------------------------------------------------------------*/

function disqus_embed() {
    global $post;
    wp_enqueue_script('disqus_embed','http://yourshortcode.disqus.com/embed.js');
    echo '<div id="disqus_thread"></div>
    <script type="text/javascript">
        var disqus_shortname = "hexagonal";
        var disqus_title = "'.$post->post_title.'";
        var disqus_url = "'.get_permalink($post->ID).'";
        var disqus_identifier = "hexagonal-'.$post->ID.'";
    </script>';
}

/*-----------------------------------------------------------------------------------*/
/*	Register Navigation Menu
/*-----------------------------------------------------------------------------------*/
function register_my_menus() {
  register_nav_menus(
  	array(
      'primary' => __( 'Main Menu', 'dreamer' ),
      'blog-menu' => __( 'Blog Menu', 'dreamer' )
    )
  );
}
add_action( 'init', 'register_my_menus' );


/*-----------------------------------------------------------------------------------*/
/*	main Menu Modification
/*-----------------------------------------------------------------------------------*/
//	Reduce nav classes, leaving only 'current-menu-item'
function nav_class_filter( $var ) {
	return is_array($var) ? array_intersect($var, array('current-menu-item')) : '';
}
add_filter('nav_menu_css_class', 'nav_class_filter', 100, 1);
//	Add page slug as nav IDs
function nav_id_filter( $id, $item ) {
	return '#' .get_post_meta( $item->ID, '_menu_item_object_id', true );
}
add_filter( 'nav_menu_item_id', 'nav_id_filter', 10, 2 );



/*-----------------------------------------------------------------------------------*/
/* Responsive Menu
/*-----------------------------------------------------------------------------------*/
class Walker_Nav_Menu_Dropdown extends Walker_Nav_Menu{
    function start_lvl(&$output, $depth = 0, $args = array()){
  $indent = str_repeat("\t", $depth); // don't output children opening tag (`<ul>`)
 }

 function end_lvl(&$output, $depth = 0, $args = array()){
  $indent = str_repeat("\t", $depth); // don't output children closing tag
 }

 /**
 * Start the element output.
 *
 * @param  string $output Passed by reference. Used to append additional content.
 * @param  object $item   Menu item data object.
 * @param  int $depth     Depth of menu item. May be used for padding.
 * @param  array $args    Additional strings.
 * @return void
 */
 function start_el(&$output, $object, $depth = 0, $args = array(), $current_object_id = 0) {
   $url = '#' !== $object->url ? $object->url : '';
   $output .= '<option value="' . $url . '">' . $object->title;
 }

 function end_el(&$output, $object, $depth = 0, $args = array(), $current_object_id = 0){
  $output .= "</option>\n"; // replace closing </li> with the option tag
 }
}

/*-----------------------------------------------------------------------------------*/
/*	Add Team members post type
/*-----------------------------------------------------------------------------------*/

// Add the post meta
include("functions/team-members-meta.php");

function dreamer_create_post_type_team_members()
{
	$labels = array(
		'name' => __( 'Team Members','dreamer'),
		'singular_name' => __( 'Team Member','dreamer' ),
		'add_new' => __('Add New','dreamer'),
		'add_new_item' => __('Add New Team Member','dreamer'),
		'edit_item' => __('Edit Team Members','dreamer'),
		'new_item' => __('New Team Member','dreamer'),
		'view_item' => __('View Team Member','dreamer'),
		'search_items' => __('Search Team Members','dreamer'),
		'not_found' =>  __('No team members found','dreamer'),
		'not_found_in_trash' => __('No team members found in Trash','dreamer'),
		'parent_item_colon' => ''
	  );

	  $args = array(
		'labels' => $labels,
		'public' => true,
		'exclude_from_search' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'taxonomies' => array('post_tag'),
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'menu_icon' => 'dashicons-groups',
		'supports' => array('title','editor','thumbnail', 'tags')
	  );

	  register_post_type(__( 'team', 'dreamer' ),$args);
}

add_action( 'init', 'dreamer_create_post_type_team_members' );

/*-----------------------------------------------------------------------------------*/
/*	Add About Us Post Type
/*-----------------------------------------------------------------------------------*/

function dreamer_create_post_type_about_us()
{
	$labels = array(
		'name' => __( 'About Us Posts','dreamer'),
		'singular_name' => __( 'About Us Post','dreamer' ),
		'add_new' => __('Add New','dreamer'),
		'add_new_item' => __('Add New About Us Post','dreamer'),
		'edit_item' => __('Edit About Us Posts','dreamer'),
		'new_item' => __('New About Us Post','dreamer'),
		'view_item' => __('View About Us Post','dreamer'),
		'search_items' => __('Search About Us Posts','dreamer'),
		'not_found' =>  __('No posts found','dreamer'),
		'not_found_in_trash' => __('No posts found in Trash','dreamer'),
		'parent_item_colon' => ''
	  );

	  $args = array(
		'labels' => $labels,
		'public' => true,
		'exclude_from_search' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_icon' => 'dashicons-nametag',
		'taxonomies' => array('post_tag'),
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail', 'tags')
	  );

	  register_post_type(__( 'about-us', 'dreamer' ),$args);
}

add_action( 'init', 'dreamer_create_post_type_about_us' );

/*-----------------------------------------------------------------------------------*/
/*	Add Testimonial Post Type
/*-----------------------------------------------------------------------------------*/

function dreamer_create_post_type_testimonials()
{
	$labels = array(
		'name' => __( 'Testimonials','dreamer'),
		'singular_name' => __( 'Testimonial','dreamer' ),
		'add_new' => __('Add New','dreamer'),
		'add_new_item' => __('Add New Testimonial','dreamer'),
		'edit_item' => __('Edit Testimonials','dreamer'),
		'new_item' => __('New Testimonial','dreamer'),
		'view_item' => __('View Testimonial','dreamer'),
		'search_items' => __('Search Testimonials','dreamer'),
		'not_found' =>  __('No posts found','dreamer'),
		'not_found_in_trash' => __('No posts found in Trash','dreamer'),
		'parent_item_colon' => ''
	  );

	  $args = array(
		'labels' => $labels,
		'public' => true,
		'exclude_from_search' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_icon' => 'dashicons-format-quote',
		'taxonomies' => array('post_tag'),
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail', 'tags')
	  );

	  register_post_type(__( 'testimonials', 'dreamer' ),$args);
}

add_action( 'init', 'dreamer_create_post_type_testimonials' );



/*-----------------------------------------------------------------------------------*/
/*	Add Testimonial Post Type
/*-----------------------------------------------------------------------------------*/

function dreamer_create_post_type_services()
{
	$labels = array(
		'name' => __( 'Services','dreamer'),
		'singular_name' => __( 'Service','dreamer' ),
		'add_new' => __('Add New','dreamer'),
		'add_new_item' => __('Add New Service','dreamer'),
		'edit_item' => __('Edit Services','dreamer'),
		'new_item' => __('New Service','dreamer'),
		'view_item' => __('View Service','dreamer'),
		'search_items' => __('Search Services','dreamer'),
		'not_found' =>  __('No posts found','dreamer'),
		'not_found_in_trash' => __('No posts found in Trash','dreamer'),
		'parent_item_colon' => ''
	  );

	  $args = array(
		'labels' => $labels,
		'public' => true,
		'exclude_from_search' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'capability_type' => 'post',
		'taxonomies' => array('post_tag'),
		'hierarchical' => false,
		'menu_icon' => 'dashicons-list-view',
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail', 'tags')
	  );

	  register_post_type(__( 'services', 'dreamer' ),$args);
}

add_action( 'init', 'dreamer_create_post_type_services' );







/*-----------------------------------------------------------------------------------*/
/*	Add Portfolio Post Type
/*-----------------------------------------------------------------------------------*/

function dreamer_create_post_type_portfolio()
{
	$labels = array(
		'name' => __( 'Portfolio','dreamer'),
		'singular_name' => __( 'Project','dreamer' ),
		'add_new' => __('Add New','dreamer'),
		'add_new_item' => __('Add New Project','dreamer'),
		'edit_item' => __('Edit Project','dreamer'),
		'new_item' => __('New Project','dreamer'),
		'view_item' => __('View Project','dreamer'),
		'search_items' => __('Search Projects','dreamer'),
		'not_found' =>  __('No posts found','dreamer'),
		'not_found_in_trash' => __('No posts found in Trash','dreamer'),
		'parent_item_colon' => ''
	  );

	  $args = array(
		'labels' => $labels,
		'public' => true,
		'exclude_from_search' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'taxonomies' => array('post_tag'),
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_icon' => 'dashicons-category',
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail', 'tags')
	  );

	  register_post_type(__( 'portfolios', 'dreamer' ),$args);
}

add_action( 'init', 'dreamer_create_post_type_portfolio' );



#-----------------------------------------------------------------#
# Add taxonomys attached to portfolio
#-----------------------------------------------------------------#

$category_labels = array(
 'name' => __( 'Portfolio Categories', 'hex'),
 'singular_name' => __( 'Portfolio Category', 'hex'),
 'search_items' =>  __( 'Search Portfolio Categories', 'hex'),
 'all_items' => __( 'All Portfolio Categories', 'hex'),
 'parent_item' => __( 'Parent Portfolio Category', 'hex'),
 'edit_item' => __( 'Edit Portfolio Category', 'hex'),
 'update_item' => __( 'Update Portfolio Category', 'hex'),
 'add_new_item' => __( 'Add New Portfolio Category', 'hex'),
    'menu_name' => __( 'Portfolio Categories', 'hex')
);

register_taxonomy("project-type",
  array("portfolios"),
  array("hierarchical" => true,
    'labels' => $category_labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'project-type' )
));




















