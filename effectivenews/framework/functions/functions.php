<?php
//js Files
add_action( 'wp_enqueue_scripts', 'mom_scripts_styles');
function mom_scripts_styles() {
	global $wp_styles;
	wp_register_script( 'prettyPhoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js', array('jquery'), '1.0', true );



	wp_enqueue_script('jquery', false, array(), false, true);
	wp_enqueue_script( 'plugins', get_template_directory_uri() . '/js/plugins.min.js', array('jquery'), '1.0', true );
	wp_register_script( 'TSwipe', get_template_directory_uri() . '/js/jquery.touchSwipe.min.js', array('jquery'), '1.0', true );
	wp_register_script( 'Momizat-main-js', get_template_directory_uri() . '/js/main.js', array('plugins'), '1.0', true );
	wp_localize_script( 'Momizat-main-js', 'momAjaxL', array(
		'url' => admin_url( 'admin-ajax.php' ),
		'nonce' => wp_create_nonce( 'ajax-nonce' ),
		'success' => __('check your email to complete subscription','theme'),
		'error' => __('Already subscribed', 'framework'),
		'error2' => __('Email invalid', 'framework'),
		'werror' => __('Enter a valid city name.', 'theme'),
		'nomore' => __('No More Posts', 'theme'),
		'homeUrl' => home_url(),
		'viewAll' => __('View All', 'theme'),
		'noResults' => __('Sorry, no posts matched your criteria', 'theme'),
		'bodyad' => mom_option('body_bg_link'),
		)
	);
	wp_enqueue_script('Momizat-main-js');
	
// Our stylesheets
	wp_enqueue_style( 'plugins', get_template_directory_uri() . '/css/plugins.css' );
	wp_enqueue_style( 'main', get_template_directory_uri() . '/css/main.css' );

	if(mom_option('enable_responsive') != false) {
		wp_enqueue_style( 'responsive', get_template_directory_uri() . '/css/media.css' );
	}
	if( is_singular() ) {
	    wp_enqueue_script('prettyPhoto');
	}
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	
}
add_action('wp_head', 'mom_header_scripts');
function mom_header_scripts() {
	echo mom_option('header_script');	
}
/*----------------------------
    Tab
 ----------------------------*/
add_filter( 'no_texturize_shortcodes', 'momt_shortcodes_to_exempt_from_wptexturize' );
function momt_shortcodes_to_exempt_from_wptexturize($shortcodes){
$shortcodes[] = 'tabs';
$shortcodes[] = 'accordions';
$shortcodes[] = 'images';
$shortcodes[] = 'graphs';
return $shortcodes;
}

/*----------------------------
    predefined Colors
 ----------------------------*/
add_action( 'wp_enqueue_scripts', 'mom_predefined_colors', 20);
function mom_predefined_colors() {
	if (mom_option('mom_color_skin') != '') {
		wp_enqueue_style( 'black-style', get_template_directory_uri() . '/css/'.mom_option('mom_color_skin').'.css' );
	}
	
}
add_action( 'admin_enqueue_scripts', 'mom_admin_scripts' );
function mom_admin_scripts( $hook_suffix ) {
    // first check that $hook_suffix is appropriate for your admin page
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'wp-color-picker' );
	wp_enqueue_style('shortcodes', MOM_URI.'/framework/shortcodes/css/tinymce.css');
	wp_enqueue_style('simptip', MOM_URI.'/framework/helpers/css/simptip-mini.css');
}

// Momizat Get Images
function mom_post_image($size = 'thumbnail', $id = ''){
		global $post;
		if ($id == '') {
			$id = $post->ID;
		}
		$image = '';
		$tt = mom_option('using_timthumb');
    		global $mom_thumbs_sizes;
		$w = isset($mom_thumbs_sizes[$size][0]) ? $mom_thumbs_sizes[$size][0] : '';
		$h = isset($mom_thumbs_sizes[$size][1]) ? $mom_thumbs_sizes[$size][1] : '';

		//get the post thumbnail
		$image_id = get_post_thumbnail_id($id);
		$image = wp_get_attachment_image_src($image_id,  
		$size);
		$image = $image[0];
		if ($tt == 1) {
			if ($size == 'full') {
				if ($image) return $image;
			} else {
				if ($image) return MOM_URI.'/framework/timthumb/timthumb.php?src='.$image.'&h='.$h.'&w='.$w;
			}
		} else {
			if ($image) return $image;
		}
		//if the post is video post and haven't a feutre image
		$format = get_post_format($id);
		if($format == 'video') {
		global $posts_st;
		$extra = get_post_meta($id , $posts_st->get_the_id(), TRUE);
		$vtype = '';
		$vId = '';
		  if (isset($extra['video_type'])) { $vtype = $extra['video_type']; }
		  if (isset($extra['video_id'])) { $vId = $extra['video_id']; }
		if (isset($extra['html5_poster_img'])) { $html5_poster = ''.$extra['html5_poster_img']; } else {$html5_poster = '';}
		  
		  if ($vtype == '') {
			$old_vtype = get_post_meta($post->ID, 'mom_video_type', true);
			if ($old_vtype) {
				$vtype = $old_vtype;
			}
		  }
		
		  if ($vId == '') {
			$old_vId = get_post_meta($post->ID, 'mom_video_id', true);
			if ($old_vId) {
				$vId = $old_vId;
			}
		  }

			if($vtype == 'youtube') {
			  $image = 'http://img.youtube.com/vi/'.$vId.'/0.jpg';
			} elseif ($vtype == 'vimeo') {
			$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$vId.php"));
			  $image = $hash[0]['thumbnail_large'];
			} elseif ($vtype == 'html5') {
			  $image = $html5_poster;
			} elseif ($vtype == 'dailymotion') {
					$image = 'http://www.dailymotion.com/thumbnail/video/'.$vId;
			} elseif ($vtype == 'facebook') {
					$image = 'https://graph.facebook.com/'.$vId.'/picture';

			}

		}
		
		if($format == 'gallery') {
		global $posts_st;
		$extra = get_post_meta($id , $posts_st->get_the_id(), TRUE);
		$slides = isset($extra['slides']) ? $extra['slides'] : '';
		$image_id = isset($slides[0]['imgid']) ? $slides[0]['imgid'] : '';
		$image = wp_get_attachment_image_src($image_id, $size);
		$image = $image[0];
		}
				
		if ($tt == 1) {
			if ($size == 'full') {
				if ($image) return $image;
			} else {
			if ($image) return MOM_URI.'/framework/timthumb/timthumb.php?src='.$image.'&h='.$h.'&w='.$w;
			}
		} else {
			if ($image) return $image;
		}
		
		//If there is still no image, get the first image from the post
		if (mom_option('post_first_image') == 1) {
					if ($tt == 1) {
                            return MOM_URI.'/framework/timthumb/timthumb.php?src='.mom_get_first_image($id).'&h='.$h.'&w='.$w;
					} else {
						return mom_get_first_image($id);
					}
		} else {
		return;
		}
		}
		function mom_get_first_image($id) {
                    $post_id = $id;
                    $queried_post = get_post($post_id);
		  $first_img = '';
		  ob_start();
		  ob_end_clean();
		  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $queried_post->post_content, $matches);
		  $first_img = '';
		  if (isset($matches[1][0])) {$first_img = $matches[1][0];}
		  return $first_img;
		}
// Limit String Words
function string_limit_words($string, $word_limit)
{
  $words = explode(' ', $string, ($word_limit + 1));
  if(count($words) > $word_limit)
  array_pop($words);
  return implode(' ', $words);
}
//Descover Vimeo
function mom_discoverVimeo($url)
{
    if ((($url = parse_url($url)) !== false) && (preg_match('~vimeo[.]com$~', $url['host']) > 0))
    {
        $url = array_filter(explode('/', $url['path']), 'strlen');

        if (in_array(@$url[0], array('album', 'channels', 'groups')) !== true)
        {
            array_unshift($url, 'users');
        }

        return array('type' => rtrim(array_shift($url), 's'), 'id' => array_shift($url));
    }

    return false;
}
// date format
function get_mom_date_format() {
	if (mom_option('date_format') != false) {
		return get_the_time(mom_option('date_format'));
		
	} else {
		return get_the_time('F d, Y');
	}
}
function mom_date_format() {
	echo get_mom_date_format();
}
//next & prev post
function mom_post_nav () {
	$next_post = get_next_post();
	$prev_post = get_previous_post();
	
?>
            <div class="np-posts">
                <ul>
			<?php if ($prev_post) {
				$ppa = '<i class="fa-icon-double-angle-left"></i>';
				if (is_rtl()) {
				$ppa = '<i class="fa-icon-double-angle-right"></i>';
				}
			?>
                    <li class="np-post prev border-box">
			<?php
			$is_img = '';
			if (mom_post_image() != false) {
				$is_img = 'has-feature-image';
			?>
			<div class="post-img">
                            <a href="<?php echo get_permalink($prev_post->ID); ?>"><img src="<?php echo mom_post_image('small-wide', $prev_post->ID); ?>" data-hidpi="<?php echo mom_post_image('small-wide-hd', $prev_post->ID); ?>" alt=""></a>
                        </div>
			<?php } ?>
                        <div class="details <?php echo $is_img; ?>">
                            <a href="<?php echo get_permalink($prev_post->ID); ?>" class="link prev"><?php echo $ppa; ?><?php _e('Previous', 'theme'); ?></a>
                            <h3><a href="<?php echo get_permalink($prev_post->ID); ?>"><?php echo get_the_title($prev_post->ID); ?></a></h3>
                        </div>
                    </li>
		    <?php } ?>
		    <?php if ($next_post) {
			$npa = '<i class="fa-icon-double-angle-right alignright"></i>';
			if (is_rtl()) {
			$npa = '<i class="fa-icon-double-angle-left"></i>';
			}
		?>
                    <li class="np-post next border-box">
			<?php
			$is_img = '';
			if (mom_post_image() != false) {
				$is_img = 'has-feature-image';
			?>
			<div class="post-img">
                            <a href="<?php echo get_permalink($next_post->ID); ?>"><img src="<?php echo mom_post_image('small-wide', $next_post->ID); ?>" data-hidpi="<?php echo mom_post_image('small-wide-hd', $next_post->ID); ?>" alt=""></a>
                        </div>
			<?php } ?>
                        <div class="details <?php echo $is_img; ?>">
                            <a href="<?php echo get_permalink($next_post->ID); ?>" class="link next"><?php echo $npa; ?><?php _e('Next', 'theme'); ?></a>
                            <h3><a href="<?php echo get_permalink($next_post->ID); ?>"><?php echo get_the_title($next_post->ID); ?></a></h3>
                        </div>
                    </li>
		    <?php } ?>
                </ul>
            </div> <!-- np posts -->
<?php } 
// author box
function mom_author_box ($style = '', $id = '', $title = true) {
$uid = $id;
if ($uid == '') {
	$uid = get_the_author_meta( 'ID' );
}
?>
<?php if ($style != 'min') { ?>
<?php if ($title != false) { ?>
<h2 class="single-title"><?php _e('About admin', 'theme'); ?></h2>
<?php } ?>
<?php } ?>
            <div class="base-box single-box about-the-author box_bg">
                <div class="author_avatar"><?php echo get_avatar( get_the_author_meta( 'user_email', $id ), '80' ); ?></div>
                <div class="author_desc">
                    <h3 calss="vcard author"><span class="fn"><a href="<?php echo get_author_posts_url( $uid ); ?>"><?php the_author_meta( 'display_name', $id ); ?></a></span> <?php if ($style == 'min') { if (mom_option('author_np') == 1) { ?><span class="articles-count"><?php _e('Articles'); ?> <?php echo number_format_i18n( get_the_author_posts() ); ?><?php } } ?> </span></h3>
        <p>
		<?php
		 if(function_exists('icl_register_string')) {
                icl_register_string('author', 'description', the_author_meta('description'));
                echo icl_t('author', 'description', the_author_meta('description'));
                } else {
			echo the_author_meta('description');
                }
		?>
	</p>
	<?php if ($style != 'min') {  ?>
	<div class="author_topics">
                <a rel=author href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">View all posts by <?php the_author_meta( 'display_name' ); ?> &raquo;</a>    
        </div>
	<?php } ?>
                 <div class="mom-socials-icons author-social-icons">
        <ul>
                    <?php if (get_the_author_meta('url', $id) != '') { ?><li class="home"><a target="_blank" href="<?php the_author_meta('url', $id); ?>"><i class=" momizat-icon-home "></i></a></li><?php } ?>
                    <?php if (get_the_author_meta('facebook', $id) != '') { ?><li class="facebook"><a target="_blank" href="<?php the_author_meta('facebook', $id); ?>"><i class="fa-icon-facebook "></i></a></li><?php } ?>
                    <?php if (get_the_author_meta('twitter', $id) != '') { ?><li class="twitter"><a target="_blank" href="<?php the_author_meta('twitter', $id); ?>"><i class="fa-icon-twitter"></i></a></li><?php } ?>
                   <?php if (get_the_author_meta('googleplus', $id) != '') { ?><li class="googleplus"><a target="_blank" href="<?php the_author_meta('googleplus', $id); ?>" rel="author"><i class="fa-icon-google-plus"></i></a></li><?php } ?>
                    <li class="rss"><a target="_blank" href="<?php echo get_author_feed_link($uid); ?>"><i class="fa-icon-rss"></i></a></li>
                    <?php if (get_the_author_meta('youtube', $id) != '') { ?><li class="youtube"><a target="_blank" href="<?php the_author_meta('youtube', $id); ?>"><i class="fa-icon-youtube"></i></a></li><?php } ?>
                    <?php if (get_the_author_meta('dribbble', $id) != '') { ?><li class="dribbble"><a target="_blank" href="<?php the_author_meta('dribbble', $id); ?>"><i class="fa-icon-dribbble"></i></a></li><?php } ?>
                    <?php if (get_the_author_meta('vimeo', $id) != '') { ?><li class="vimeo"><a target="_blank" href="<?php the_author_meta('vimeo', $id); ?>"><i class="momizat-icon-vimeo"></i></a></li><?php } ?>
                    <?php if (get_the_author_meta('pinterest', $id) != '') { ?><li class="pinterest"><a target="_blank" href="<?php the_author_meta('pinterest', $id); ?>"><i class="fa-icon-pinterest"></i></a></li><?php } ?>
                    <?php if (get_the_author_meta('instagram', $id) != '') { ?><li class="instgram"><a target="_blank" href="<?php the_author_meta('instagram', $id); ?>"><i class="fa-icon-instagram"></i></a></li><?php } ?>
                    <?php if (get_the_author_meta('tumblr', $id) != '') { ?><li class="tumblr"><a target="_blank" href="<?php the_author_meta('tumblr', $id); ?>"><i class="fa-icon-tumblr"></i></a></li><?php } ?>
                    <?php if (get_the_author_meta('linkedin', $id) != '') { ?><li class="linkedin"><a target="_blank" href="<?php the_author_meta('linkedin', $id); ?>"><i class="fa-icon-linkedin"></i></a></li><?php } ?>
                    <?php if (get_the_author_meta('soundcloud', $id) != '') { ?><li class="soundcloud"><a target="_blank" href="<?php the_author_meta('soundcloud', $id); ?>"><i class="momizat-icon-soundcloud"></i></a></li><?php } ?>
        </u>

        <div class="clear"></div>
    </div>

                </div>
	            <div class="clear"></div>

            </div>
<?php
}

// mom_post_meta
function mom_posts_meta ($class = '', $display = null) {
	$num_comments = get_comments_number(); // get_comments_number returns only a numeric value

if ( comments_open() ) {
	if ( $num_comments == 0 ) {
		$comments = __('No Comments', 'theme');
	} elseif ( $num_comments > 1 ) {
		$comments = $num_comments .' '. __(' Comments', 'theme');
	} else {
		$comments = __('1 Comment', 'theme');
	}
	$write_comments = '<a href="' . get_comments_link() .'">'. $comments.'</a>';
} else {
	//$write_comments =  __('Comments off', 'theme');
	$write_comments = '';
}
$author_link = get_author_posts_url(get_the_author_meta( 'ID' ));
if (class_exists('userpro_api')) {
	global $userpro;
$author_link = $userpro->permalink(get_the_author_meta( 'ID' ));
}

$categories = get_the_category();
$separator = ', ';
$cats = '';
if($categories){
	foreach($categories as $category) {
		$cats.= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s", 'theme' ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
	}
}
	$output = '<div class="mom-post-meta '.$class.'">';
	$author = mom_option('post_meta-author') == 1 ? '<span class="author vcard">'.__('Posted By:', 'theme').' <span class="fn"><a href="'.$author_link.'">'.get_the_author_meta( 'display_name' ).'</a></span></span>': '';
	$date = mom_option('post_meta-date') == 1 ? '<span class="date">'.__('Posted date:', 'theme').' <time datetime="'.get_the_time('c').'" itemprop="datePublished" class="updated">'.get_mom_date_format().'</time></span>': '';
	$cat = mom_option('post_meta-cat') == 1 ? '<span class="categ">'.__('In', 'theme').': '.trim($cats, $separator).'</span>': '';
	$comments = mom_option('post_meta-comments') == 1 ? '<span class="w_comment">'.$write_comments.'</span>': '';
	if ($display == 'date_comments') {
		$output .= $date.$comments;
	} else {
		$output .= $author.$date.$cat.$comments;
	}
	if(function_exists('the_views')) {
		$output .= '<span>'.__('Views:', 'theme').' '.the_views(false).'</span>';
	}
	$output .= get_mom_show_review_score();
	$output .= '</div>';
	echo $output;
}


// Related posts
function mom_related_posts () { ?>
                <h2 class="single-title"><?php _e('Related Posts', 'theme'); ?></h2>
            <div class="base-box single-box box_bg">
                <ul class="single-related-posts">
	<?php
		global $post;
		$relatedby = mom_option('post_rp_by');
		if ($relatedby == '') {
			$relatedby = 'category';
		}
		
		$count = mom_option('related_posts_count');
		if ($count == '') {
			$count = 4;
		}
		    $layout = get_post_meta($post->ID, 'mom_page_layout', true);
		    if ($layout == '') {
			$layout = mom_option('main_layout'); 
		    }

		if ($layout  == 'fullwidth' && strpos(mom_option('main_layout'),'both') !== false) {
			$count = 5;
		}

		if ($layout  == 'fullwidth' && strpos(mom_option('main_layout'),'both') === false) {
			$count = 4;
		}
		if (($layout  == 'right-sidebar' || $layout  == 'right-sidebar') && mom_option('site_width') == 'wide') {
			$count = 4;
		}
	?>
   <?php if ($relatedby == 'tags' ) { ?>
	    <?php
		$tags = wp_get_post_tags($post->ID);
		if ($tags) :
		$tag_ids = array();
		foreach($tags as $individual_tag){ $tag_ids[] = $individual_tag->term_id;}

		$args=array(
		'tag__in' => $tag_ids,
		'post__not_in' => array($post->ID),
		'posts_per_page'=> $count,
		'ignore_sticky_posts'=>1
		);
		query_posts($args);
	    ?>
               <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	       <li>
			<?php if (mom_post_image() != false) { ?>
                        <a href="<?php the_permalink(); ?>"><img src="<?php echo mom_post_image('related-posts'); ?>" data-hidpi="<?php echo mom_post_image('big-wide-img'); ?>" alt="<?php the_title(); ?>"></a>
			<?php } ?>
                        <h4><a itemprop="name" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                </li>
<?php endwhile; ?>
                <?php  else:  ?>
                <h5><?php echo __('There is no related posts.', 'theme'); ?></h5>
                <?php  endif; ?>
                <?php wp_reset_query(); ?>
                  <?php endif;?>
<?php } else { ?>
	    <?php
		global $post;
		$cats = get_the_category($post->ID);
		if ($cats) :
		    $cat_ids = array();
		    foreach($cats as $individual_cat){ $cat_ids[] = $individual_cat->cat_ID;}
		
		    $args=array(
			'category__in' => $cat_ids,
			'post__not_in' => array($post->ID),
			'posts_per_page'=>$count,
			'ignore_sticky_posts'=>1
		    );
		query_posts($args);
	    ?>
 <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	       <li>
			<?php if (mom_post_image() != false) { ?>
                        <a href="<?php the_permalink(); ?>"><img src="<?php echo mom_post_image('related-posts'); ?>" data-hidpi="<?php echo mom_post_image('big-wide-img'); ?>" alt="<?php the_title(); ?>"></a>
			<?php } ?>
                        <h4><a itemprop="name" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                </li>

<?php endwhile; ?>
<?php  else:  ?>
<h5><?php echo __('There is no related posts.', 'theme'); ?></h5>
<?php  endif; ?>
<?php wp_reset_query(); ?>
<?php endif;?>
<?php } ?>
</ul>
</div>
<?php
}

// Hex To RGB
function hex2rgb($hex) {
	$hex = str_replace("#", "", $hex);
	if(strlen($hex) == 3) {
	   $r = hexdec(substr($hex,0,1).substr($hex,0,1));
	   $g = hexdec(substr($hex,1,1).substr($hex,1,1));
	   $b = hexdec(substr($hex,2,1).substr($hex,2,1));
	} else {
	   $r = hexdec(substr($hex,0,2));
	   $g = hexdec(substr($hex,2,2));
	   $b = hexdec(substr($hex,4,2));
	}
	$rgb = array($r, $g, $b);
	//return implode(",", $rgb); // returns the rgb values separated by commas
	return $rgb; // returns an array with the rgb values
}
//breadcrumbs
function mom_breadcrumb () {
	if (mom_option('breadcrumb') != false) {
		breadcrumbs_plus();
	}
}

// using dashicons
add_action( 'wp_enqueue_scripts', 'mom_load_dashicons' );
function mom_load_dashicons() {
	wp_enqueue_style( 'dashicons' );
}
//author meta
add_filter( 'user_contactmethods', 'mom_user_contactmethods', 10, 1 );
function mom_user_contactmethods( $contactmethods ) {
		$contactmethods['googleplus'] = __( "Google+ URL", 'theme' );
		$contactmethods['twitter'] = __( 'Twitter URL', 'theme' );
		$contactmethods['facebook'] = __( 'Facebook profile URL', 'theme' );
		$contactmethods['youtube'] = __( 'Youtube URL', 'theme' );
		$contactmethods['dribbble'] = __( 'Dribbble URL', 'theme' );
		$contactmethods['vimeo'] = __( 'Vimeo URL', 'theme' );
		$contactmethods['pinterest'] = __( 'Pinterest URL', 'theme' );
		$contactmethods['instagram'] = __( 'Instagram URL', 'theme' );
		$contactmethods['tumblr'] = __( 'Tumblr URL', 'theme' );
		$contactmethods['linkedin'] = __( 'Linkedin URL', 'theme' );
		$contactmethods['soundcloud'] = __( 'Soundcloud URL', 'theme' );

		return $contactmethods;
	}
add_action( 'show_user_profile', 'mom_extra_profile_fields' );
add_action( 'edit_user_profile', 'mom_extra_profile_fields' );

function mom_extra_profile_fields( $user ) {
	wp_enqueue_media();
	wp_enqueue_script('media-upload');
?>
<div class="no-display-in-front">
	<h3>Profile Page Settings</h3>

	<table class="form-table">

		<tr>
			<th><label for="ab_bg"><?php _e('Author Box background', 'theme'); ?></label></th>

			<td>
				<input type="text" name="ab_bg" id="ab_bg" value="<?php echo esc_url( get_the_author_meta( 'ab_bg', $user->ID ) ); ?>" class="regular-text" />
					    <input id="upload_image_button" class="button" type="button" value="Upload Image" style="width: auto !important;"/>
<br />
				<span class="description"><?php _e('Upload author page background.', 'theme'); ?></span>
			</td>
		</tr>

		<tr>
			<th><label for="ab_bg"><?php _e('Posts layout'); ?></label></th>

			<td>
				<select name="ap_l" id="ap_l">
					<option value=""><?php _e('Select layout ...', 'theme'); ?></option>
					<option value="m1" <?php selected(get_the_author_meta( 'ap_l', $user->ID), 'm1'); ?>><?php _e('Medium thumbnails', 'theme'); ?></option>
					<option value="m2" <?php selected(get_the_author_meta( 'ap_l', $user->ID), 'm2'); ?>><?php _e('Medium thumbnails2', 'theme'); ?></option>
					<option value="l" <?php selected(get_the_author_meta( 'ap_l', $user->ID), 'l'); ?>><?php _e('Large thumbnails', 'theme'); ?></option>
					<option value="g" <?php selected(get_the_author_meta( 'ap_l', $user->ID), 'g'); ?>><?php _e('Grid', 'theme'); ?></option>
					<option value="t" <?php selected(get_the_author_meta( 'ap_l', $user->ID), 't'); ?>><?php _e('Timeline', 'theme'); ?></option>
				</select>
			</td>
		</tr>

	</table>
	</div> 
<?php }

add_action( 'personal_options_update', 'mom_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'mom_save_extra_profile_fields' );

function mom_save_extra_profile_fields( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;

	/* Copy and paste this line for additional fields. Make sure to change 'twitter' to the field ID. */
	update_user_meta( $user_id, 'ab_bg', $_POST['ab_bg'] );
	update_user_meta( $user_id, 'ap_l', $_POST['ap_l'] );
}

// posts format
function mom_single_post_format ($format = '', $id = '') {
	global $post;
	if ($id == '') {
		$id = $post->ID;
	}
	
	$HFI = get_post_meta($id, 'mom_hide_feature', true);
	if (mom_option('post_feature') != 1) {
		$HFI = 1;
	}
$article_type = get_post_meta($post->ID, 'mom_article_type', true);		

?>
<?php if ($HFI != 1) { ?>

<?php if ($format == 'video' || $article_type == 'video' ) { ?>
                                     <?php
                                      global $posts_st;
                                      $extra = get_post_meta($id , $posts_st->get_the_id(), TRUE);
                                        $vi_width = '610';
                                        $vi_height = '381';
		    $layout = get_post_meta($post->ID, 'mom_page_layout', true);
		    if ($layout == '') {
			$layout = mom_option('main_layout'); 
		    }
					
		if (($layout  == 'right-sidebar' || $layout  == 'right-sidebar') && mom_option('site_width') == 'wide') {
                                       $vi_width = '822';
                                        $vi_height = '512';
		}					
                                        $video_type = isset($extra['video_type']) ? $extra['video_type'] : '';
                                        if (isset($extra['video_id'])) { $video_id = $extra['video_id']; } else { $video_id = ''; }
                                        if (isset($extra['html5_poster_img'])) { $html5_poster = ' poster="'.$extra['html5_poster_img'].'"'; } else {$html5_poster = '';}
					if ($html5_poster == '' && has_post_thumbnail($id)) {
					    $html5_poster = ' poster="'.mom_post_image('post_large_image').'"';
					}
                                        if (isset($extra['html5_mp4']) && $extra['html5_mp4'] != '') { $mp4 = ' mp4="'.$extra['html5_mp4'].'"'; } else{$mp4='';}
                                        if (isset($extra['html5_m4v']) && $extra['html5_m4v'] != '') { $m4v = ' m4v="'.$extra['html5_m4v'].'"'; } else{$m4v='';}
                                        if (isset($extra['html5_webm']) && $extra['html5_webm'] != '') { $webm = ' webm="'.$extra['html5_webm'].'"'; } else{$webm='';}
                                        if (isset($extra['html5_ogv']) && $extra['html5_ogv'] != '') { $ogv = ' ogv="'.$extra['html5_ogv'].'"'; } else{$ogv='';}
                                        if (isset($extra['html5_wmv']) && $extra['html5_wmv'] != '') { $wmv = ' wmv="'.$extra['html5_wmv'].'"'; } else{$wmv='';}
                                        if (isset($extra['html5_flv']) && $extra['html5_flv'] != '') { $flv = ' flv="'.$extra['html5_flv'].'"'; } else{$flv='';}
					if ($video_type == '') {
						$video_type = get_post_meta($post->ID, 'mom_video_type', true);
					}
					if ($video_id == '') {
						$video_id = get_post_meta($post->ID, 'mom_video_id', true);
					}
					
					if ($m4v == '') {
						$m4v = ' m4v="'.get_post_meta($post->ID, 'mom_video_html_m4v', true).'"';
					}
					if ($ogv == '') {
						$ogv = ' ogv="'.get_post_meta($post->ID, 'mom_video_html_ogv', true).'"';
					}
					if ($webm == '') {
						$webm = ' webm="'.get_post_meta($post->ID, 'mom_video_html_webm', true).'"';
					}
					if ($html5_poster == '') {
						$html5_poster = ' poster="'.get_post_meta($post->ID, 'mom_video_html_poster', true).'" ';
					}
                                      ?>
                                      <?php if ($video_type == 'youtube') { ?>
                                    <div class="video_frame">
                                      <iframe width="<?php echo $vi_width; ?>" height="<?php echo $vi_height; ?>" src="http://www.youtube.com/embed/<?php echo $video_id; ?>" frameborder="0" allowfullscreen></iframe>
                                    </div><!--End Vido_frame-->
                                    <?php } elseif ($video_type == 'vimeo') { ?>
                                    <div class="video_frame">
                                        <iframe src="http://player.vimeo.com/video/<?php echo $video_id; ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="<?php echo $vi_width; ?>" height="<?php echo $vi_height; ?>" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                                    </div><!--End Vido_frame-->
                                    <?php } elseif ($video_type == 'dailymotion') { ?>
                                    <div class="video_frame">
					<iframe frameborder="0" width="<?php echo $vi_width; ?>" height="<?php echo $vi_height; ?>" src="//www.dailymotion.com/embed/video/<?php echo $video_id; ?>" allowfullscreen></iframe>
                                    </div><!--End Vido_frame-->
                                    <?php } elseif ($video_type == 'facebook') { ?>
                                    <div class="video_frame">
                                        <iframe src="http://www.facebook.com/video/embed?video_id=<?php echo $video_id; ?>" width="<?php echo $vi_width; ?>" height="<?php echo $vi_height; ?>" frameborder="0"></iframe>
                                    </div><!--End Vido_frame-->
                                    <?php } elseif ($video_type == 'html5') { ?>
                                    <div class="video_frame">
                                        <?php echo do_shortcode('[video '.$mp4 .$m4v.$webm.$ogv.$wmv.$flv.$html5_poster.']'); ?>
                                    </div>
                                    <?php } ?>
<?php } elseif ($format == 'audio') { ?>
	                                     <?php
                                      global $posts_st;
                                      $extra = get_post_meta(get_the_ID(), $posts_st->get_the_id(), TRUE);
                                        if (isset($extra['audio_type'])) { $audio_type = $extra['audio_type']; } else {$audio_type = '';}
                                        if (isset($extra['audio_sc'])) { $soundcloud = $extra['audio_sc']; } else {$soundcloud = '';}

                                        
                                        if (isset($extra['audio_poster_img'])) { $audio_poster = ' poster="'.$extra['audio_poster_img'].'"'; } else {$audio_poster = '';}
                                        
                                        if (isset($extra['audio_mp3']) && $extra['audio_mp3'] != '') { $mp3 = ' mp3="'.$extra['audio_mp3'].'"'; } else{$mp3='';}
                                        if (isset($extra['audio_ogg']) && $extra['audio_ogg'] != '') { $ogg = ' ogg="'.$extra['audio_ogg'].'"'; } else{$ogg='';}
                                        if (isset($extra['audio_m4a']) && $extra['audio_m4a'] != '') { $m4a = ' m4a="'.$extra['audio_m4a'].'"'; } else{$m4a='';}
                                        if (isset($extra['audio_wav']) && $extra['audio_wav'] != '') { $wav = ' wav="'.$extra['audio_wav'].'"'; } else{$wav='';}
                                        if (isset($extra['audio_wma']) && $extra['audio_wma'] != '') { $wma = ' wma="'.$extra['audio_wma'].'"'; } else{$wma='';}
					if ($audio_poster == '' && has_post_thumbnail($id)) {
					    $audio_poster = ' poster="'.mom_post_image('post_large_image').'"';
					}


                                        
                                    ?>
                                   <div class="audio_frame">
                                        <?php if ( $audio_type == 'soundcloud' ) { ?>
                                            <?php echo $soundcloud; ?>
                                        <?php } else { ?>
                                   <?php if(mom_post_image() != false) {?>
						<?php if ($HFI != 1) { ?>
						<img src="<?php echo mom_post_image('full'); ?>" alt="<?php the_title(); ?>">
						<?php } ?>
                                   <?php } ?>
                                            <?php echo do_shortcode('[audio '.$mp3.$ogg.$m4a.$wav.$wma.$audio_poster.']'); ?>
                                        <?php } ?>
                                        
                                    </div>
<?php } elseif ($format == 'gallery' || $article_type == 'slideshow') { ?>
                        <?php
				wp_enqueue_script('crf');
				wp_enqueue_script('easing');
				wp_enqueue_script('prettyPhoto');

				global $posts_st;
				$extra = get_post_meta($id , $posts_st->get_the_id(), TRUE);
				$slides = isset($extra['slides']) ? $extra['slides'] : '';
				$slides_meta = '';
				if ($slides == '') {
					$slides_meta = get_post_meta($post->ID, 'mom_slideshow_imgs', false);
					$slides_meta = implode(',', $slides_meta);
					global $wpdb;
					$slides = $wpdb->get_col("
					SELECT ID FROM $wpdb->posts
					WHERE post_type = 'attachment'
					AND ID in ($slides_meta)
					ORDER BY menu_order ASC
					");
				}
				$arrows = get_post_meta($id, 'mom_gallery_post_arrows', true);
				$bullets = get_post_meta($id, 'mom_gallery_post_bullets', true);
				$animation = get_post_meta($id, 'mom_gallery_post_animation', true);
				$easing = get_post_meta($id, 'mom_gallery_post_easing', true);
				$speed = get_post_meta($id, 'mom_gallery_post_speed', true);
				$timeout = get_post_meta($id, 'mom_gallery_post_timeout', true);
				if ($speed == '') {
					$speed = 600;
				}
				if ($timeout == '') {
					$timeout = 4000;
				}
$img_size = 'big-wide-img';
$wide_class = '';
if (mom_option('site_width') == 'wide') {
	$img_size = 'bigger-wide-img';
	$wide_class = 'fs-wide';
}
				
			?>
  <script>
	jQuery(document).ready(function($) { 
				$(".gallery-post-slider .fslides").carouFredSel({
					circular: true,
                                        responsive: false,
					swipe: {
						onTouch: true
					},
					items: 1,
					auto: {
                                             play: true,
                                             duration: <?php echo $speed; ?>,
                                             timeoutDuration: <?php echo $timeout; ?>,
                                             },
					prev: '.gallery-post-slider .fsd-prev',
					next: '.gallery-post-slider .fsd-next',
					pagination: '.gallery-post-slider .fs-nav',
					scroll: {
						fx: '<?php echo $animation; ?>',
                                                  duration : <?php echo $speed; ?>,
                                                easing  : '<?php echo $easing; ?>',
						pauseOnHover : true,
                                        	onBefore: function() {
						},
						onAfter: function() {
						}

					}
			});
			$(".gallery-post-slider a[rel^='prettyphoto']").prettyPhoto({deeplinking: false});				
	});
  </script>
  	<div class="feature-slider gallery-post-slider <?php echo $wide_class; ?>">
		<?php if ($arrows != false) { ?>
		<div class="fs-drection-nav">
			<span class="fsd-prev"><i class="fa-icon-angle-left"></i></span>
			<span class="fsd-next"><i class="fa-icon-angle-right"></i></span>
		</div>
		<?php } ?>
	<ul class="fslides">
		<?php foreach($slides as $slide) {
			$imgid = isset($slide['imgid']) ? $slide['imgid'] : '';
			if ($imgid == '') { $imgid = $slide; }
			$img = wp_get_attachment_image_src($imgid, $img_size);
			$img = $img[0];
			$imgFull = wp_get_attachment_image_src($imgid, 'full');
			$imgFull = $imgFull[0];
			$caption = isset($slide['caption']) ? $slide['caption'] : '';
			$link = isset($slide['link']) ? $slide['link'] : $imgFull;
			if (!isset($slide['link']) || $slide['link'] == '') { $lightbox = 'rel= "prettyphoto[post_gallery]"';} else {$lightbox = '';} 
			$target = isset($slide['target']) ? 'target="'.$slide['target'].'"' : '';			
		?>
                        <li>
                            <a href="<?php echo $link; ?>" <?php echo $lightbox.$target; ?>><img src="<?php echo $img; ?>" alt=""></a>
                            <div class="slide-caption fs-caption-alt border-box">
                                <P><?php echo $caption; ?></P>
                            </div>
                        </li>
		<?php } ?>
                    </ul>

                    <?php if ($bullets != false) { ?><div class="fs-nav"></div><?php } elseif ($slides_meta != '') { echo '<div class="fs-nav"></div>'; } ?>
		
                </div> <!--fearure slider-->
  
<?php } else { ?>
                                   <?php if(mom_post_image() != false) {?>
							<?php if (mom_get_post_thumbnail_caption() != '') { ?>
							<div class="feature-img wp-caption">
								<img src="<?php echo mom_post_image('full'); ?>" alt="<?php the_title(); ?>">
								<p class="wp-caption-text"><?php echo mom_get_post_thumbnail_caption(); ?></p>
							</div>
							<?php } else { ?>
							<div class="feature-img">
								<img src="<?php echo mom_post_image('full'); ?>" alt="<?php the_title(); ?>">
							</div>
							<?php } ?>
                                   <?php } ?>
<?php }
} //end hide feature
}

/* Filter the content of chat posts. */
add_filter( 'the_content', 'my_format_chat_content' );

/* Auto-add paragraphs to the chat text. */
add_filter( 'my_post_format_chat_text', 'wpautop' );

/**
 * This function filters the post content when viewing a post with the "chat" post format.  It formats the 
 * content with structured HTML markup to make it easy for theme developers to style chat posts.  The 
 * advantage of this solution is that it allows for more than two speakers (like most solutions).  You can 
 * have 100s of speakers in your chat post, each with their own, unique classes for styling.
 *
 * @author David Chandra
 * @link http://www.turtlepod.org
 * @author Justin Tadlock
 * @link http://justintadlock.com
 * @copyright Copyright (c) 2012
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @link http://justintadlock.com/archives/2012/08/21/post-formats-chat
 *
 * @global array $_post_format_chat_ids An array of IDs for the chat rows based on the author.
 * @param string $content The content of the post.
 * @return string $chat_output The formatted content of the post.
 */
function my_format_chat_content( $content ) {
	global $_post_format_chat_ids;

	/* If this is not a 'chat' post, return the content. */
	if ( !has_post_format( 'chat' ) )
		return $content;

	/* Set the global variable of speaker IDs to a new, empty array for this chat. */
	$_post_format_chat_ids = array();

	/* Allow the separator (separator for speaker/text) to be filtered. */
	$separator = apply_filters( 'my_post_format_chat_separator', ':' );

	/* Open the chat transcript div and give it a unique ID based on the post ID. */
	$chat_output = "\n\t\t\t" . '<div id="chat-transcript-' . esc_attr( get_the_ID() ) . '" class="chat-transcript">';

	/* Split the content to get individual chat rows. */
	$chat_rows = preg_split( "/(\r?\n)+|(<br\s*\/?>\s*)+/", $content );

	/* Loop through each row and format the output. */
	foreach ( $chat_rows as $chat_row ) {
	global $posts_st;
$extra = get_post_meta(get_the_ID(), $posts_st->get_the_id(), TRUE);
$avatar1 = '';
$avatar2 = '';
$avatar = '';
if (isset($extra['chat_avatar1_id'])) { $avatar1 = wp_get_attachment_image_src($extra['chat_avatar1_id'], 'square-widgets'); }
if (isset($extra['chat_avatar2_id'])) { $avatar2 = wp_get_attachment_image_src($extra['chat_avatar2_id'], 'square-widgets'); }


		/* If a speaker is found, create a new chat row with speaker and text. */
		if ( strpos( $chat_row, $separator ) ) {

			/* Split the chat row into author/text. */
			$chat_row_split = explode( $separator, trim( $chat_row ), 2 );

			/* Get the chat author and strip tags. */
			$chat_author = strip_tags( trim( $chat_row_split[0] ) );

			/* Get the chat text. */
			$chat_text = trim( $chat_row_split[1] );

			/* Get the chat row ID (based on chat author) to give a specific class to each row for styling. */
			$speaker_id = my_format_chat_row_id( $chat_author );
if ($speaker_id == '1') {
	if ($avatar1) $avatar = '<img src="'.$avatar1[0].'" alt="'. sanitize_html_class( strtolower( "chat-author-{$chat_author}" ) ) .'" width="50" height="50">';
} else {
	if ($avatar2) $avatar = '<img src="'.$avatar2[0].'" alt="'. sanitize_html_class( strtolower( "chat-author-{$chat_author}" ) ) .'" width="50" height="50">';
}
			/* Open the chat row. */
			$chat_output .= "\n\t\t\t\t" . '<div class="chat-row ' . sanitize_html_class( "chat-speaker-{$speaker_id}" ) . '">';

			/* Add the chat row author. */
			$chat_output .= "\n\t\t\t\t\t" . '<div class="chat-author ' . sanitize_html_class( strtolower( "chat-author-{$chat_author}" ) ) . ' vcard">'.$avatar.'<cite class="fn">' . apply_filters( 'my_post_format_chat_author', $chat_author, $speaker_id ) . '</cite></div>';

			/* Add the chat row text. */
			$chat_output .= "\n\t\t\t\t\t" . '<div class="chat-text">' . str_replace( array( "\r", "\n", "\t" ), '', apply_filters( 'my_post_format_chat_text', $chat_text, $chat_author, $speaker_id ) ) . '</div>';

			/* Close the chat row. */
			$chat_output .= "\n\t\t\t\t" . '</div><!-- .chat-row -->';
		}

		/**
		 * If no author is found, assume this is a separate paragraph of text that belongs to the
		 * previous speaker and label it as such, but let's still create a new row.
		 */
		else {

			/* Make sure we have text. */
			if ( !empty( $chat_row ) ) {

				/* Open the chat row. */
				$chat_output .= "\n\t\t\t\t" . '<div class="chat-row ' . sanitize_html_class( "chat-speaker-{$speaker_id}" ) . '">';

				/* Don't add a chat row author.  The label for the previous row should suffice. */

				/* Add the chat row text. */
				$chat_output .= "\n\t\t\t\t\t" . '<div class="chat-text">' . str_replace( array( "\r", "\n", "\t" ), '', apply_filters( 'my_post_format_chat_text', $chat_row, $chat_author, $speaker_id ) ) . '</div>';

				/* Close the chat row. */
				$chat_output .= "\n\t\t\t</div><!-- .chat-row -->";
			}
		}
	}

	/* Close the chat transcript div. */
	$chat_output .= "\n\t\t\t</div><!-- .chat-transcript -->\n";

	/* Return the chat content and apply filters for developers. */
	return apply_filters( 'my_post_format_chat_content', $chat_output );
}

/**
 * This function returns an ID based on the provided chat author name.  It keeps these IDs in a global 
 * array and makes sure we have a unique set of IDs.  The purpose of this function is to provide an "ID"
 * that will be used in an HTML class for individual chat rows so they can be styled.  So, speaker "John" 
 * will always have the same class each time he speaks.  And, speaker "Mary" will have a different class 
 * from "John" but will have the same class each time she speaks.
 *
 * @author David Chandra
 * @link http://www.turtlepod.org
 * @author Justin Tadlock
 * @link http://justintadlock.com
 * @copyright Copyright (c) 2012
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @link http://justintadlock.com/archives/2012/08/21/post-formats-chat
 *
 * @global array $_post_format_chat_ids An array of IDs for the chat rows based on the author.
 * @param string $chat_author Author of the current chat row.
 * @return int The ID for the chat row based on the author.
 */
function my_format_chat_row_id( $chat_author ) {
	global $_post_format_chat_ids;

	/* Let's sanitize the chat author to avoid craziness and differences like "John" and "john". */
	$chat_author = strtolower( strip_tags( $chat_author ) );

	/* Add the chat author to the array. */
	$_post_format_chat_ids[] = $chat_author;

	/* Make sure the array only holds unique values. */
	$_post_format_chat_ids = array_unique( $_post_format_chat_ids );

	/* Return the array key for the chat author and add "1" to avoid an ID of "0". */
	return absint( array_search( $chat_author, $_post_format_chat_ids ) ) + 1;
}

// Default gravatar
if (mom_option('default_avatar', 'url') != '') {
	add_filter( 'avatar_defaults', 'mom_default_avatar' );
	function mom_default_avatar ($avatar_defaults) {
	    $myavatar = mom_option('default_avatar', 'url');
	    $avatar_defaults[$myavatar] = __('Custom Avatar', 'theme');
	    return $avatar_defaults;
	}
}

/* ==========================================================================
 *                Login Widget
   ========================================================================== */
function mom_login_widget($register = '', $reset = '') {
$redirect = ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
?>
                        <div class="mom-login-widget">
                            <?php if ( !is_user_logged_in() ) { ?>
                            <form class="mom-login-form" action="<?php echo esc_url( site_url( 'wp-login.php', 'login_post') ) ?>" method="post">
					<div class="mom-username">
						<input type="text" name="log" value="" placeholder="<?php _e('username', 'theme'); ?>">
					</div>

					<div class="mom-password">
						<input type="password" name="pwd" value="" placeholder="<?php _e('password', 'theme'); ?>">
					</div>

					<div class="mom-submit-wrapper">
						<button class="button submit user-submit" name="user-submit" type="submit"><?php _e('Log In', 'theme'); ?></button>
						<input type="checkbox" id="rememberme" name="rememberme" value="forever" <?php checked( 'rememberme', 1 ); ?>>
						<label for="rememberme"><i class="dashicons dashicons-yes"></i><?php _e('Remember Me', 'theme'); ?></label>
                                                <input type="hidden" name="redirect_to" value="<?php echo esc_url( $redirect ); ?>" />
					</div>
					<?php if ($register != '' || $reset != '') { ?>
					<span class="mlw-extra">
						<?php if ($register != '') { ?>
						<a href="<?php echo $register; ?>" class="mlw-register"><?php _e('Register', 'theme'); ?></a>
						<?php } ?>
						<?php if ($reset != '') { ?>
						<a href="<?php echo $reset; ?>" class="mlw-reset"><?php _e('Lost your Password', 'theme'); ?></a>
						<?php } ?>
					</span>
					<?php } ?>
                            </form>
                            <?php
                            
                            } else { ?>
				<?php
					$current_user = wp_get_current_user();
					$id = get_current_user_id();
					$name = $current_user->display_name;
				?>
                                <?php echo get_avatar( $id, 60 ); ?>
				<div class="lw-user-info">
					<a href="<?php echo get_author_posts_url( get_current_user_id() ); ?>"><?php _e('Howdy', 'theme'); ?>, <strong><?php echo $name; ?></strong></a>
					<a href=" <?php echo get_edit_profile_url($id); ?> " class="button"><?php _e('Edit My profile', 'theme'); ?></a>
					<a href="<?php echo wp_logout_url(); ?>" class="button"><?php _e('Log Out', 'theme'); ?></a>
				</div>
				
                            
                            <?php } ?>
			    <div class="clear"></div>
                        </div>
<?php }

function mom_login_form($register = '', $reset = '') {
$redirect = ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
?>
                            <?php if ( !is_user_logged_in() ) { ?>
                            <form class="" action="<?php echo esc_url( site_url( 'wp-login.php', 'login_post') ) ?>" method="post">
					<p class="form-row form-login">
					<label for="mom-login-input"><?php _e('username', 'theme'); ?> <span class="required">*</span></label>
					<input type="text" name="log" id="mom-login-input" value="" placeholder="">
					</p>
					<p class="form-row form-password">
					<label for="mom-pwd-input"><?php _e('password', 'theme'); ?> <span class="required">*</span></label>
					<input type="password" name="pwd" id="mom-pwd-input" value="" placeholder="">
					</p>

					<div class="mom-submit-wrapper">
						<button class="button submit user-submit" name="user-submit" type="submit"><?php _e('Log In', 'theme'); ?></button>
						<input type="checkbox" id="rememberme" name="rememberme" value="forever" <?php checked( 'rememberme', 1 ); ?>>
						<label for="rememberme"> <?php _e('Remember Me', 'theme'); ?></label>
                                                <input type="hidden" name="redirect_to" value="<?php echo esc_url( $redirect ); ?>" />
					</div>
					<?php if ($register != '' || $reset != '') { ?>
					<p class="mlw-extra">
						<?php if ($register != '') { ?>
						<a href="<?php echo $register; ?>" class="mlw-register"><?php _e('Register', 'theme'); ?></a>
						<?php } ?>
						<?php if ($reset != '') { ?>
						<a href="<?php echo $reset; ?>" class="mlw-reset"><?php _e('Lost your Password', 'theme'); ?></a>
						<?php } ?>
					</p>
					<?php } ?>
                            </form>
                            <?php
                            
                            } else {
				global $post;
					if( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'login_form') ) {
					} else {
				?>
				<div class="mom-login-user">
					<?php
						$current_user = wp_get_current_user();
						$id = get_current_user_id();
						$name = $current_user->display_name;
					?>
					<?php echo get_avatar( $id, 70 ); ?>
					<div class="lw-user-info">
						<h4><a href="<?php echo get_author_posts_url( get_current_user_id() ); ?>"><?php _e('Howdy', 'theme'); ?>, <strong><?php echo $name; ?></strong></a></h4>
						
						<p>
							<a href=" <?php echo get_edit_profile_url($id); ?> " class="button"><?php _e('Edit My profile', 'theme'); ?></a>
							<a href="<?php echo wp_logout_url(); ?>" class="button"><?php _e('Log Out', 'theme'); ?></a>
						</p>
					</div>
				</div>	
                            
                            <?php }
			    
			    } ?>
			    <div class="clear"></div>
<?php }

function mom_register_form () {
?>
		
<?php if ( !is_user_logged_in() ) { ?>
<?php do_action ('mom_process_customer_registration_form'); ?><!-- the hook to use to process the form -->
<form method="POST" id="adduser" class="user-forms" action="">
	<p class="form-username">
		<label for="user_name"><?php _e('Username', 'theme'); ?> <span class="required">*</span></label>
		<input class="text-input" name="user_name" type="text" id="user_name" value="" />
	</p>
	
	<p class="form-email">
		<label for="email"><?php _e('Email address', 'theme'); ?> <span class="required">*</span></label>
		<input class="text-input" name="email" type="text" id="email" value="" />
	</p>
	
	<p class="form-email">
		<label for="email"><?php _e('password', 'theme'); ?> <span class="required">*</span></label>
		<input class="text-input" name="password" type="text" id="email" value="" />
	</p>
	
	<p class="form-submit">
		<input name="adduser" type="submit" id="addusersub" class="submit button" value="Register" />
		<?php wp_nonce_field( 'add-user', 'add-nonce' ) ?><!-- a little security to process on submission -->
		<input name="action" type="hidden" id="action" value="adduser" />
	</p>
</form>
<?php } else { ?>
	<div class="mom-login-user">
		<?php
			$current_user = wp_get_current_user();
			$id = get_current_user_id();
			$name = $current_user->display_name;
		?>
		<?php echo get_avatar( $id, 70 ); ?>
		<div class="lw-user-info">
			<h4><a href="<?php echo get_author_posts_url( get_current_user_id() ); ?>"><?php _e('Howdy', 'theme'); ?>, <strong><?php echo $name; ?></strong></a></h4>
			
			<p>
				<a href=" <?php echo get_edit_profile_url($id); ?> " class="button"><?php _e('Edit My profile', 'theme'); ?></a>
				<a href="<?php echo wp_logout_url(); ?>" class="button"><?php _e('Log Out', 'theme'); ?></a>
			</p>
		</div>
	</div>	
<?php } ?>

<?php }
function mom_registration_process_hook() {
	if (isset($_POST['adduser']) && isset($_POST['add-nonce']) && wp_verify_nonce($_POST['add-nonce'], 'add-user')) {
	
		// die if the nonce fails
		if ( !wp_verify_nonce($_POST['add-nonce'],'add-user') ) {
			wp_die('Sorry! That was secure, guess you\'re cheatin huh!');
		} else {
			// auto generate a password
			$user_pass = $_POST['password'];
			// setup new user
			$userdata = array(
				'user_pass' => $user_pass,
				'user_login' => esc_attr( $_POST['user_name'] ),
				'user_email' => esc_attr( $_POST['email'] ),
				'role' => get_option( 'default_role' ),
			);
			// setup some error checks
			if ( !$userdata['user_login'] )
				$error = 'A username is required for registration.';
			elseif ( username_exists($userdata['user_login']) )
				$error = 'Sorry, that username already exists!';
			elseif ( !is_email($userdata['user_email']) )
				$error = 'You must enter a valid email address.';
			elseif ( email_exists($userdata['user_email']) )
				$error = 'Sorry, that email address is already used!';
			// setup new users and send notification
			else{
				$new_user = wp_insert_user( $userdata );
				wp_new_user_notification($new_user, $user_pass);
			}
		}
	}
	if ( isset($new_user) && $new_user ) : ?>

	<p class="alert"><!-- create and alert message to show successful registration -->
	<?php
		$user = get_user_by('id',$new_user);
		echo 'Thank you for registering ' . $user->user_login;
		echo '<br/>Please check your email address. That\'s where you\'ll recieve your login password.<br/> (Be sure to check your spam folder)';
	?>
	</p>
	
	<?php else : ?>
	
		<?php if ( isset($error) && $error ) : ?>
			<p class="error"><!-- echo errors if users fails -->
				<?php echo $error; ?>
			</p>
		<?php endif; ?>
	
	<?php endif;

}
add_action('mom_process_customer_registration_form', 'mom_registration_process_hook');

function mom_remove_x_pingback($headers) {
    unset($headers['X-Pingback']);
    return $headers;
}
add_filter('wp_headers', 'mom_remove_x_pingback');