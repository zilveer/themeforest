<?php

/*-----------------------------------------------------------------------------------

	Here we have all the custom functions for the theme
	Please be extremely cautious editing this file,
	When things go wrong, they tend to go wrong in a big way.
	You have been warned!

-------------------------------------------------------------------------------------*/


/*-----------------------------------------------------------------------------------*/
/*  Set Max Content Width
/* ----------------------------------------------------------------------------------*/
if ( ! isset( $content_width ) )
	$content_width = 580;
	
function zilla_content_width() {
    if( is_page_template( 'template-full-width.php' ) || is_attachment() ) {
        global $content_width;
        $content_width = 900;
    }
}

add_action( 'template_redirect', 'zilla_content_width' );


/*-----------------------------------------------------------------------------------*/
/*	Our theme set up
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'zilla_theme_setup' ) ) {
    function zilla_theme_setup() {
        
        /* Load translation domain --------------------------------------------------*/
    	load_theme_textdomain( 'zilla', get_template_directory() . '/languages' );
        
        $locale = get_locale();
    	$locale_file = get_template_directory() . "/languages/$locale.php";
    	if ( is_readable( $locale_file ) )
    		require_once( $locale_file );
    		
    	/* Register WP 3.0+ Menus ---------------------------------------------------*/
 		register_nav_menu( 'primary-menu', __('Primary Menu', 'zilla') );
   	
    	/* Configure WP 2.9+ Thumbnails ---------------------------------------------*/
    	add_theme_support( 'post-thumbnails' );
    	set_post_thumbnail_size( 50, 50, true ); // Normal post thumbnails
    	add_image_size( 'blog-large', 580, '', true ); // Single post page; Index and archive pages: image format and featured image
    	add_image_size( 'blog-index-gallery', 580, 435, true ); // Index and archive pages gallery format
    	
    	/* Add support for post formats ---------------------------------------------*/
    	/* 
         * To add an admin UI to the post formats, use Alex King's plugin at
         * https://github.com/crowdfavorite/wp-post-formats 
         */
        add_theme_support( 
            'post-formats', 
            array(
                'aside',
                'gallery',
                'image',
                'link',
                'quote',
                'video',
                'audio'
            ) 
        );

    }
}
add_action( 'after_setup_theme', 'zilla_theme_setup' );


/*-----------------------------------------------------------------------------------*/
/*	Register Sidebars
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'zilla_sidebars_init' ) ) {

    function zilla_sidebars_init() {
    	register_sidebar(array(
    		'name' => __('Main Sidebar', 'zilla'),
    		'description' => __('Widget area for blog pages.', 'zilla'),
    		'id' => 'sidebar-main',
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget' => '</div>',
    		'before_title' => '<h3 class="widget-title">',
    		'after_title' => '</h3>',
    	));
    	
    	register_sidebar(array(
    		'name' => __('Page Sidebar', 'zilla'),
    		'description' => __('Widget area for pages.', 'zilla'),
    		'id' => 'sidebar-page',
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget' => '</div>',
    		'before_title' => '<h3 class="widget-title">',
    		'after_title' => '</h3>',
    	));
    	
    	register_sidebars(3, array(
     	   'name' => __('Footer Column %d', 'zilla'),
     	   'id' => "footer-column",
     	   'before_widget' => '<div id="%1$s" class="widget %2$s">',
     	   'after_widget' => '</div>',
     	   'before_title' => '<h3 class="widget-title">',
     	   'after_title' => '</h3>'
    	));
	}
	
}
add_action( 'widgets_init', 'zilla_sidebars_init' );


/*-----------------------------------------------------------------------------------*/
/*	Change Default Excerpt Length (uncomment if required)
/*-----------------------------------------------------------------------------------*/

/*if ( !function_exists( 'zilla_excerpt_length' ) ) {
	function zilla_excerpt_length($length) {
		return 55; 
	}
}
add_filter('excerpt_length', 'zilla_excerpt_length');
*/


/*-----------------------------------------------------------------------------------*/
/*	Configure Excerpt String
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'zilla_excerpt_more' ) ) {
	function zilla_excerpt_more($excerpt) {
		return str_replace('[...]', '...', $excerpt); 
	}
}
add_filter('wp_trim_excerpt', 'zilla_excerpt_more');


/*-----------------------------------------------------------------------------------*/
/*	Configure Default Title
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'zilla_wp_title' ) ) {
	function zilla_wp_title($title, $sep) {
		if( !zilla_is_third_party_seo() ){
		    $title .= get_bloginfo( 'name' );
		    
		    $site_desc = get_bloginfo( 'description', 'display' );
			if( $site_desc && ( is_home() || is_front_page() ) ) {
			    $title = "$title $sep $site_desc";
			} 
			
		}
		return $title;
	}
}
add_filter('wp_title', 'zilla_wp_title', 10, 2);


/*-----------------------------------------------------------------------------------*/
/*	Register and load JS
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'zilla_enqueue_scripts' ) ) {
	function zilla_enqueue_scripts() {
	    /* Register our scripts -----------------------------------------------------*/
		wp_register_script('validation', 'http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js', 'jquery', '1.9', true);
		wp_register_script('superfish', get_template_directory_uri() . '/js/superfish.js', array('jquery'), '1.7.4', true);
		wp_register_script('zilla-custom', get_template_directory_uri() . '/js/jquery.custom.js', array('jquery', 'flexslider', 'isotope', 'fitvids', 'imagesLoaded', 'superfish'), '', TRUE);
		wp_register_script('flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', 'jquery', '2.0');
		wp_register_script('jplayer', get_template_directory_uri() . '/js/jquery.jplayer.min.js', 'jquery', '2.1');
		wp_register_script('fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', 'jquery', '1.0');
		wp_register_script('isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array('jquery', 'imagesLoaded'), '1.5.25');
		wp_register_script('imagesLoaded', get_template_directory_uri() . '/js/jquery.imagesloaded.min.js', 'jquery', '2.0.1');
		
		/* Enqueue our scripts ------------------------------------------------------*/
		wp_enqueue_script('jquery');
        wp_enqueue_script('jquery-migrate');
		wp_enqueue_script('superfish');
		wp_enqueue_script('flexslider');
		wp_enqueue_script('jplayer');
		wp_enqueue_script('isotope');
		wp_enqueue_script('imagesLoaded');
		wp_enqueue_script('zilla-custom');
		
		if( is_singular() ) wp_enqueue_script( 'comment-reply' ); // loads the javascript required for threaded comments 
		if( is_page_template('template-contact.php') ) wp_enqueue_script('validation');
		
		wp_localize_script('zilla-custom', 'zilla', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('zilla-ajax'),
            'loading' => __('Loading...', 'zilla')
        ));
        
        
        /* Load main CSS file -------------------------------------------------------*/
        wp_enqueue_style( 'hoarder-style', get_stylesheet_uri(), '', zilla_get_theme_version() );
	}
}
add_action('wp_enqueue_scripts', 'zilla_enqueue_scripts');


/*-----------------------------------------------------------------------------------*/
/*	Register and load admin javascript
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'zilla_enqueue_admin_scripts' ) ) {
    function zilla_enqueue_admin_scripts() {
        wp_register_script( 'zilla-admin', get_template_directory_uri() . '/includes/js/jquery.custom.admin.js', 'jquery' );
        wp_enqueue_script( 'zilla-admin' );
    }
}
add_action( 'admin_enqueue_scripts', 'zilla_enqueue_admin_scripts' );


/*----------------------------------------------------------------------------------*/
/*  Get the theme version
/*----------------------------------------------------------------------------------*/

function zilla_get_theme_version() {
    if( function_exists( 'wp_get_theme' ) ) {
        if( is_child_theme() ) {
            $temp_obj = wp_get_theme();
            $theme_obj = wp_get_theme( $temp_obj->get('Template') );
        } else {
            $theme_obj = wp_get_theme();    
        }

        $theme_version = $theme_obj->get('Version');
    } else {
        $theme_data = get_theme_data(get_template_directory() .'/style.css');
        $theme_version = $theme_data['Version'];
    }
    
    return $theme_version;
}


/*-----------------------------------------------------------------------------------*/
/*	Comment Styling
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'zilla_comment' ) ) {
	function zilla_comment($comment, $args, $depth) {
	
        $isByAuthor = false;

        if($comment->comment_author_email == get_the_author_meta('email')) {
            $isByAuthor = true;
        }

        $GLOBALS['comment'] = $comment; ?>
        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

            <div id="comment-<?php comment_ID(); ?>">
                
                <span class="avatar-overlay"></span>
                <?php echo get_avatar($comment,$size='56'); ?>
                
                <div class="comment-body">
                    <div class="comment-author vcard">
                        <?php printf('<cite class="fn">%s</cite>', get_comment_author_link()) ?>
                    </div>

                    <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s', 'zilla'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)', 'zilla'),'  ','') ?> &middot; <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></div>

                    <?php if ($comment->comment_approved == '0') : ?>
                        <em class="moderation"><?php _e('Your comment is awaiting moderation.', 'zilla') ?></em><br />
                    <?php endif; ?>
                
                    <?php comment_text() ?>
                </div>

            </div>
	<?php
	}
}


/*-----------------------------------------------------------------------------------*/
/*	Seperated Pings Styling
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'zilla_list_pings' ) ) {
	function zilla_list_pings($comment, $args, $depth) {
	    $GLOBALS['comment'] = $comment; ?>
		<li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?>
		<?php 
	}
}


/*-----------------------------------------------------------------------------------*/
/*  Output image
/*
/*  @param int $postid the post id
/*  @param int/string $imagesize the image size
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'zilla_image' ) ) {
    function zilla_image($postid, $imagesize) {
        // get the featured image for the post
        $thumbid = 0;
        if( has_post_thumbnail($postid) ) {
            $thumbid = get_post_thumbnail_id($postid);
        }
    
        $image_ids_raw = get_post_meta($postid, '_zilla_image_ids', true);

        if( $image_ids_raw ) {
            // Using WP3.5; use post__in orderby option
            $image_ids = explode(',', $image_ids_raw);
            $postid = null;
            $orderby = 'post__in';
            $include = $image_ids;
        } else {
            $orderby = 'menu_order';
            $include = '';
        }
    
        // get first 2 attachments for the post
        $args = array(
            'include' => $include,
            'order' => 'ASC',
            'orderby' => $orderby,
            'post_type' => 'attachment',
            'post_parent' => $postid,
            'post_mime_type' => 'image',
            'post_status' => null,
            'numberposts' => 2
        );
        $attachments = get_posts($args);

        if( !empty($attachments) ) {
            foreach( $attachments as $attachment ) {
                // if current image is featured image reloop
                if( $attachment->ID == $thumbid ) continue;
                $src = wp_get_attachment_image_src( $attachment->ID, $imagesize );
                $alt = ( !empty($attachment->post_content) ) ? $attachment->post_content : $attachment->post_title;
                echo "<div class='image-frame'>";
                echo "<img height='$src[2]' width='$src[1]' src='$src[0]' alt='$alt' />";
                echo "</div>";
                // got image, time to exit foreach
                break;
            }
        }
    }
}

/*-----------------------------------------------------------------------------------*/
/*  Output gallery slideshow
/*
/*  @param int $postid the post id
/*  @param int/string $imagesize the image size 
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'zilla_gallery' ) ) {
    function zilla_gallery($postid, $imagesize) { ?>
        <script type="text/javascript">
    		jQuery(document).ready(function($){
                $('#slider-<?php echo $postid; ?>').imagesLoaded( function() {
        			$("#slider-<?php echo $postid; ?>").flexslider({
        			    slideshow: false,
                        controlNav: false,
                        prevText: '<?php echo '&larr; ' . __('Prev', 'zilla'); ?>',
                        nextText: '<?php echo __('Next', 'zilla') . ' &rarr;'; ?>',
                        namespace: 'zilla-',
                        smoothHeight: true,
                        start: function(slider) {
                            slider.container.click(function(e) {
                                if( !slider.animating ) {
                                    slider.flexAnimate( slider.getTarget('next') );
                                }
                            
                            });
                        }
        			});
    			
        			$("#slider-<?php echo $postid; ?>").click(function(e){
    			    
        			});
    			});
    		});
    	</script>
    <?php 
        $loader = 'ajax-loader.gif';
        $thumbid = 0;
    
        // get the featured image for the post
        if( has_post_thumbnail($postid) ) {
            $thumbid = get_post_thumbnail_id($postid);
        }
        echo "<!-- BEGIN #slider-$postid -->\n<div id='slider-$postid' class='flexslider' data-loader='" . get_template_directory_uri() . "/images/$loader'>";
    
        $image_ids_raw = get_post_meta($postid, '_zilla_image_ids', true);

        if( $image_ids_raw ) {
            // Using WP3.5; use post__in orderby option
            $image_ids = explode(',', $image_ids_raw);
            $temp_id = $postid;
            $postid = null;
            $orderby = 'post__in';
            $include = $image_ids;
        } else {
            $orderby = 'menu_order';
            $include = '';
        }
    
        // get first 2 attachments for the post
        $args = array(
            'include' => $include,
            'order' => 'ASC',
            'orderby' => $orderby,
            'post_type' => 'attachment',
            'post_parent' => $postid,
            'post_mime_type' => 'image',
            'post_status' => null,
            'numberposts' => -1
        );
        $attachments = get_posts($args);

        $postid = ( isset($temp_id) ) ? $temp_id : $postid;
        
        if( !empty($attachments) ) {
            echo '<ul class="slides">';
            $i = 0;
            foreach( $attachments as $attachment ) {
                $src = wp_get_attachment_image_src( $attachment->ID, $imagesize );
                $caption = $attachment->post_excerpt;
                $caption = ($caption) ? "<em class='image-caption'>$caption</em>" : '';
                $alt = ( !empty($attachment->post_content) ) ? $attachment->post_content : $attachment->post_title;
                echo "<li><img height='$src[2]' width='$src[1]' src='$src[0]' alt='$alt' />$caption</li>";
                $i++;
            }
            echo '</ul>';
        }
        echo "<!-- END #slider-$postid -->\n</div>";
    }
}

/*-----------------------------------------------------------------------------------*/
/*	Output Audio
/* 
/*  @param int $postid the post id
/*  @param int $width the width of the audio player
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'zilla_audio' ) ) {
    function zilla_audio($postid, $width = 580, $height = 300) {
	
    	$mp3 = get_post_meta($postid, '_zilla_audio_mp3', TRUE);
    	$ogg = get_post_meta($postid, '_zilla_audio_ogg', TRUE);
    	$poster = get_post_meta($postid, '_zilla_audio_poster_url', TRUE);
    	$height = get_post_meta($postid, '_zilla_audio_height', TRUE);
    	
    	// Calc $height for small images; large will return same value
    	$height = $height * $width / 580;
    ?>

    		<script type="text/javascript">
		
    			jQuery(document).ready(function($){
	
    				if( $().jPlayer ) {
    					$("#jquery_jplayer_<?php echo $postid; ?>").jPlayer({
    						ready: function () {
    							$(this).jPlayer("setMedia", {
    							    <?php if($poster != '') : ?>
    							    poster: "<?php echo $poster; ?>",
    							    <?php endif; ?>
    							    <?php if($mp3 != '') : ?>
    								mp3: "<?php echo $mp3; ?>",
    								<?php endif; ?>
    								<?php if($ogg != '') : ?>
    								oga: "<?php echo $ogg; ?>",
    								<?php endif; ?>
    								end: ""
    							});
    						},
    						<?php if( !empty($poster) ) { ?>
    						size: {
            				    width: "<?php echo $width; ?>px",
            				    height: "<?php echo $height . 'px'; ?>"
            				},
            				<?php } ?>
    						swfPath: "<?php echo get_template_directory_uri(); ?>/js",
    						cssSelectorAncestor: "#jp_interface_<?php echo $postid; ?>",
    						supplied: "<?php if($ogg != '') : ?>oga,<?php endif; ?><?php if($mp3 != '') : ?>mp3, <?php endif; ?> all"
    					});
					
    				}
    			});
    		</script>
		
    	    <div id="jquery_jplayer_<?php echo $postid; ?>" class="jp-jplayer jp-jplayer-audio" data-orig-width="<?php echo $width; ?>" data-orig-height="<?php echo $height; ?>"></div>

            <div class="jp-audio-container">
                <div class="jp-audio">
                    <div id="jp_interface_<?php echo $postid; ?>" class="jp-interface">
                        <ul class="jp-controls">
                        	<li><div class="seperator-first"></div></li>
                            <li><div class="seperator-second"></div></li>
                            <li><a href="#" class="jp-play" tabindex="1">play</a></li>
                            <li><a href="#" class="jp-pause" tabindex="1">pause</a></li>
                            <li><a href="#" class="jp-mute" tabindex="1">mute</a></li>
                            <li><a href="#" class="jp-unmute" tabindex="1">unmute</a></li>
                        </ul>
                        <div class="jp-progress">
                            <div class="jp-seek-bar">
                                <div class="jp-play-bar"></div>
                            </div>
                        </div>
                        <div class="jp-volume-bar-container">
                            <div class="jp-volume-bar">
                                <div class="jp-volume-bar-value"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    	<?php 
    }
}


/*-----------------------------------------------------------------------------------*/
/*  Output video
/*
/*  @param int $postid the post id
/*  @param int $width the width of the video player
/*  @param int $height the height of the video player
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'zilla_video' ) ) {
    function zilla_video($postid, $width = 580, $height = 300) {
	
    	$height = get_post_meta($postid, '_zilla_video_height', true);
    	$m4v = get_post_meta($postid, '_zilla_video_m4v', true);
    	$ogv = get_post_meta($postid, '_zilla_video_ogv', true);
    	$poster = get_post_meta($postid, '_zilla_video_poster_url', true);
    	
    	// Calc $height for small images; large will return same value
    	$height = $height * $width / 580;
	
    ?>
    <script type="text/javascript">
    	jQuery(document).ready(function($){
		
    		if( $().jPlayer ) {
    			$("#jquery_jplayer_<?php echo $postid; ?>").jPlayer({
    				ready: function () {
    					$(this).jPlayer("setMedia", {
    						<?php if($m4v != '') : ?>
    						m4v: "<?php echo $m4v; ?>",
    						<?php endif; ?>
    						<?php if($ogv != '') : ?>
    						ogv: "<?php echo $ogv; ?>",
    						<?php endif; ?>
    						<?php if ($poster != '') : ?>
    						poster: "<?php echo $poster; ?>"
    						<?php endif; ?>
    					});
    				},
    				size: {
    				    width: "<?php echo $width ?>px",
    				    height: "<?php echo $height . 'px'; ?>"
    				},
    				swfPath: "<?php echo get_template_directory_uri(); ?>/js",
    				cssSelectorAncestor: "#jp_interface_<?php echo $postid; ?>",
    				supplied: "<?php if($m4v != '') : ?>m4v, <?php endif; ?><?php if($ogv != '') : ?>ogv, <?php endif; ?> all"
    			});
    		}
    	});
    </script>

    <div id="jquery_jplayer_<?php echo $postid; ?>" class="jp-jplayer jp-jplayer-video" data-orig-width="<?php echo $width; ?>" data-orig-height="<?php echo $height; ?>"></div>

    <div class="jp-video-container">
        <div class="jp-video">
            <div id="jp_interface_<?php echo $postid; ?>" class="jp-interface">
                <ul class="jp-controls">
                	<li><div class="seperator-first"></div></li>
                    <li><div class="seperator-second"></div></li>
                    <li><a href="#" class="jp-play" tabindex="1">play</a></li>
                    <li><a href="#" class="jp-pause" tabindex="1">pause</a></li>
                    <li><a href="#" class="jp-mute" tabindex="1">mute</a></li>
                    <li><a href="#" class="jp-unmute" tabindex="1">unmute</a></li>
                </ul>
                <div class="jp-progress">
                    <div class="jp-seek-bar">
                        <div class="jp-play-bar"></div>
                    </div>
                </div>
                <div class="jp-volume-bar-container">
                    <div class="jp-volume-bar">
                        <div class="jp-volume-bar-value"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <?php }
}


/*-----------------------------------------------------------------------------------*/
/*  Load more AJAX call
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'zilla_load_more' ) ) {
    add_action('wp_ajax_zilla_load_more', 'zilla_load_more');
    add_action('wp_ajax_nopriv_zilla_load_more', 'zilla_load_more');
    function zilla_load_more() {
        if( !wp_verify_nonce($_POST['nonce'], 'zilla-ajax') ) die('Invalid nonce');
        if( !is_numeric($_POST['page']) || $_POST['page'] < 0 ) die('Invalid page');

        // Normal archives
        $query_args = '';
        if( isset($_POST['archive']) && $_POST['archive'] ) $query_args = $_POST['archive'] .'&';
        $query_args .= 'post_status=publish&posts_per_page='. get_option('posts_per_page') .'&paged='. $_POST['page'];

        // Post format archives
        if( isset($_POST['archive']) && $_POST['archive'] && strlen(strstr($_POST['archive'],'post-format'))>0 ){
            $query_args = array(
                'post_status' => 'publish',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'post_format',
                        'field' => 'slug',
                        'terms' => $_POST['archive']
                    )
                ),
                'posts_per_page' => get_option('posts_per_page'),
                'paged' => $_POST['page']
            );
        }

        // Proper video/audio width
        if( isset($_POST['width']) && $_POST['width'] ) {
            $width = $_POST['width'];
        }

        // Do loop
        ob_start();
        $query = new WP_Query($query_args);
        while ( $query->have_posts() ) : $query->the_post();

            zilla_post_before(); ?>
			<!-- BEGIN .hentry -->
			<div <?php post_class('post'); ?> id="post-<?php the_ID(); ?>">				
			<?php zilla_post_start(); ?>
			
			<?php
			    $format = get_post_format();
			    if( $format == 'video' && $width == 260 ) $format = 'video-small';
			    elseif( $format == 'audio' && $width == 260 ) $format = 'audio-small';
			    				    
			    get_template_part( 'content', $format);

			    if( $format == '' || $format == 'gallery' || $format == 'video' || $format == 'video-small' || $format == 'audio' || $format == 'audio-small' ) {
			        get_template_part( 'content', 'meta' ); 
			    }
			?>
				                
            <?php zilla_post_end(); ?>
			<!-- END .hentry-->  
			</div>
			<?php zilla_post_after();
            
        endwhile;
        wp_reset_postdata();
        $content = ob_get_contents();
        ob_end_clean();

        echo json_encode(array(
            'pages' => $query->max_num_pages,
            'content' => $content
        ));
        exit;
    }
}


/*-----------------------------------------------------------------------------------*/
/*	Include the framework
/*-----------------------------------------------------------------------------------*/

$tempdir = get_template_directory();
require_once($tempdir .'/framework/init.php');
require_once($tempdir .'/includes/init.php');

?>