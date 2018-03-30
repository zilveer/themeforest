<?php
add_image_size('small-wide', 90, 60, true);
add_image_size('small-wide-hd', 180, 120, true);
add_image_size('related-posts', 190, 122, true);
add_image_size('cats_horz_menu', 120, 76, true);
add_image_size('ajax-search-small', 45, 35, true);
add_image_size('posts-slider-widget', 265, 168, true);
add_image_size('scrolling-box', 265, 168, true);
add_image_size('news_box3', 284, 180, true);
add_image_size('news_box_big', 274, 173, true);
add_image_size('news_in_pics', 95, 64, true);
add_image_size('news_in_pics_big', 308, 192, true);
add_image_size('blog_medium', 220, 140, true);
//portfolio
add_image_size('mom-portfolio-four', 278, 202, true);
add_image_size('mom-portfolio-three', 373, 270, true);
add_image_size('mom-portfolio-two', 567, 410, true);
add_image_size('mom-portfolio-one', 475, 342, true);


//hd
add_image_size('big-wide-img', 652, 406, true );
add_image_size('bigger-wide-img', 822, 512, true );

$mom_thumbs_sizes = array(
'thumbnail' => array(get_option( 'thumbnail_size_w' ), get_option( 'thumbnail_size_h' )),
'medium' => array(get_option( 'medium_size_w' ), get_option( 'medium_size_w' )),
'large' => array(get_option( 'large_size_w' ), get_option( 'large_size_w' )),
'full' => array('', ''),
'small-wide' => array(90, 60),
'small-wide-hd' => array(180, 120),
'related-posts' => array(190, 122),
'cats_horz_menu' => array(120, 76),
'ajax-search-small' => array(45, 35),
'posts-slider-widget' => array(265, 168),
'scrolling-box' => array(265, 168),
'news_box3' => array(284, 180),
'news_box_big' => array(274, 173),
'news_in_pics' => array(95, 64),
'news_in_pics_big' => array(308, 192),
'blog_medium' => array(220, 140),
'mom-portfolio-four' => array(278, 202),
'mom-portfolio-three' => array(373, 270),
'mom-portfolio-two' => array(567, 410),
'mom-portfolio-one' => array(475, 342),
'big-wide-img' => array(652, 406),
'bigger-wide-img' => array(822, 512),
);
/* ==========================================================================
 *                Body classes
   ========================================================================== */
function goodnews_body_classes( $classes ) {
$site_width = mom_option('site_width');
if ( is_singular()) {
	
      global $post;
      $layout = get_post_meta(get_queried_object_id(), 'mom_page_layout', TRUE);
      if(function_exists('is_bbpress') && is_bbpress()) {
	if ($layout == '') { $layout = mom_option('bbpress_layout');}
      if(function_exists('is_buddypress') && is_buddypress()) {
	if (get_post_meta(get_queried_object_id(), 'mom_page_layout', true) == '') { $layout = mom_option('buddypress_layout');}
      }
	
      } elseif(function_exists('is_buddypress') && is_buddypress()) {
	    if ($layout == '') { $layout = mom_option('buddypress_layout');}
      } else {
	if ($layout == '') { $layout = mom_option('posts_layout');}
	if ($layout == '') { $layout = mom_option('main_layout');}
      }
	if ($layout == '') { $layout = mom_option('posts_layout');}
	if ($layout == '') { $layout = mom_option('main_layout');}

} elseif (function_exists('is_bbpress') && is_bbpress()) {
	$layout = mom_option('bbpress_layout');
	if ($layout == '') {
	    $layout = mom_option('main_layout');  
	}
	
} elseif (function_exists('is_buddypress') && is_buddypress()) {
	$layout = mom_option('buddypress_layout');
	if ($layout == '') {
	    $layout = mom_option('main_layout');  
	}
	
} else {
    $layout = mom_option('main_layout');
      if (is_archive()) {
	    $layout = mom_option('cats_layout');
	    if ($layout == '') {$layout = mom_option('main_layout');}
      }
}


      if(function_exists('is_woocommerce') && is_woocommerce()) {
        $woo_page_id = '';
	if (is_shop()) {
	    $woo_page_id = get_option('woocommerce_shop_page_id');
	} elseif (is_cart()) {
	    $woo_page_id = get_option('woocommerce_cart_page_id');
	} elseif (is_checkout()) {
	    $woo_page_id = get_option('woocommerce_checkout_page_id');
	} elseif (is_account_page()) {
	    $woo_page_id = get_option('woocommerce_myaccount_page_id');
	} else {
	    $woo_page_id = get_option('woocommerce_shop_page_id');
	}
	$layout = get_post_meta($woo_page_id, 'mom_page_layout', true);

	if ($layout == '') {
	  $layout = mom_option('main_layout'); 
	}
      }  

if ($layout != '') {
    $classes[] = $layout;
}
if (strpos($layout,'both') !== false) {
    $classes[] = 'both-sidebars';
}

if ($layout == 'fullwidth' && strpos(mom_option('main_layout'),'both') !== false) {
    $classes[] = 'both-sidebars';
}

	if ( is_singular() && ! is_front_page() ) {
		$classes[] = 'singular';
	}
if (mom_option('theme_style') == 'boxed' || mom_option('theme_style') == 'boxed2' || mom_option('theme_style') == 'boxed-content') {
		$classes[] = 'layout-boxed';
}	
if (mom_option('theme_style') == 'boxed2') {
		$classes[] = 'layout-boxed2';
}
if (mom_option('theme_style') == 'boxed-content') {
		$classes[] = 'layout-boxed-content';
}
if (mom_option('mom_color_skin') == 'black') {
		$classes[] = 'black-skin';
}
if ($layout == 'both-sidebars-all') { 
      if (mom_option('both_sidebars_same_width') == 1) {
	  $classes[] = 'both_sidebars_same_width';
      }
}
if (mom_option('fade_imgs') == 1) {
    $classes[] = 'fade-imgs-in-appear';
}
if (mom_option('sticky_navigation') == 1) {
    $classes[] = 'sticky_navigation_on';
}

if (mom_option('nav_highlight_ancestor') == 1) {
    $classes[] = 'navigation_highlight_ancestor';
}

if (mom_option('post_format_icons') == 0) {
    $classes[] = 'no-post-format-icons';
}

if (mom_option('body_bg_link') != '') {
    $classes[] = 'use_bg_as_ad';
}
if (mom_option('news_ticker_time_type') == 1) {
    $classes[] = 'ticker_has_live_time';
}
if (mom_option('news_ticker_time_format') == 0) {
    $classes[] = 'time_in_twelve_format';
}
if ($site_width == 'wide') {
      $classes[] = 'one-side-wide both-sidebars';
}
if ($layout != 'right-sidebar' && $layout != 'left-sidebar') {
      $classes[] = 'both-sides-true';
}

	return $classes;
}

add_filter( 'body_class', 'goodnews_body_classes' );

// show review score works only inside the loop 
function mom_show_review_score($id='') {
	global $post;
    if ($id == '') {
	$id = $post->ID;
    }
	$criterias = get_post_meta(get_the_ID(),'_mom_review-criterias',false);
$all_scores = 0;
$the_score = 0;
$score = 0;
if ($criterias != false) {
foreach($criterias[0] as $criteria) {
	$all_scores += 100;
	$score += $criteria['cr_score'];
}
$the_score = $score/$all_scores*100;
$score = round($the_score);
}
	if ($score != 0) {
    ?>
	<div class="star-rating mom_review_score"><span style="width:<?php echo $score; ?>%;"></span></div>
    <?php  } 
}
function get_mom_show_review_score($id='') {
	global $post;
    if ($id == '') {
	$id = $post->ID;
    }
	$criterias = get_post_meta(get_the_ID(),'_mom_review-criterias',false);
$all_scores = 0;
$the_score = 0;
$score = 0;
if ($criterias != false) {
foreach($criterias[0] as $criteria) {
	$all_scores += 100;
	$score += $criteria['cr_score'];
}
$the_score = $score/$all_scores*100;
$score = round($the_score);
}
	if ($score != 0) {
	return '<div class="star-rating mom_review_score"><span style="width:'.$score.'%;"></span></div>';
  } 
}

/* ==========================================================================
 *                Category Options
   ========================================================================== */
add_action ( 'edit_category_form_fields', 'mom_category_style');
    function mom_category_style( $tag ) {
	$t_id = $tag->term_id;
	$cat_meta = get_option( "category_$t_id");
    ?>
<!--	<tr class="form-field">
	<th scope="row" valign="top"><label><?php _e('Background Image'); ?></label></th>
	<td>	
	<label for="upload_image">
	    <input id="category_image" class="custom_img_bg" type="text" size="36" name="Cat_meta[bg]" value="<?php echo $cat_meta['bg'] ? $cat_meta['bg'] : ''; ?>" style="width: auto !important;"/> 
	    <input id="upload_cat_bg" class="button upload_image_button" data-x="bg" type="button" value="Upload Image" style="width: auto !important;"/>
	    <br /><span class="description"><?php _e('Enter a URL or upload an image', 'theme'); ?></span>
	</label>
	</td>
	</tr>-->
	<tr class="form-field">
	<th scope="row" valign="top"><label><?php _e('Category Slider', 'theme'); ?></label></th>
	<td>	
	<label for="cat_slider">
		<select name="Cat_meta[slider]" id="cat_slider">
		    <?php
			if (!isset($cat_meta['slider'])) { $cat_meta['slider'] = ''; }
		    ?>
			<option value=""><?php _e('None', 'theme'); ?></option>
			<option value="1" <?php selected($cat_meta['slider'], '1'); ?>><?php _e('Enable', 'theme'); ?></option>
			<option value="0" <?php selected($cat_meta['slider'], '0'); ?>><?php _e('Disable', 'theme'); ?></option>
		</select>
	    <br /><span class="description"><?php _e('enable or disable category slider, none mean this option will depend on theme options -> category settings', 'theme'); ?></span>
	</label>
	</td>
	</tr>

	<tr class="form-field">
	<th scope="row" valign="top"><label><?php _e('Posts Layout', 'theme'); ?></label></th>
	<td>	
	<label for="cat_layout">
		<select name="Cat_meta[layout]" id="cat_layout">
		    <?php
			if (!isset($cat_meta['layout'])) { $cat_meta['layout'] = ''; }
		    ?>
			<option value=""><?php _e('Posts Layout...', 'theme'); ?></option>
			<option value="m1" <?php selected($cat_meta['layout'], 'm1'); ?>><?php _e('Medium thumbnails', 'theme'); ?></option>
			<option value="m2" <?php selected($cat_meta['layout'], 'm2'); ?>><?php _e('Medium thumbnails2', 'theme'); ?></option>
			<option value="l" <?php selected($cat_meta['layout'], 'l'); ?>><?php _e('Large thumbnails', 'theme'); ?></option>
			<option value="g" <?php selected($cat_meta['layout'], 'g'); ?>><?php _e('Grid', 'theme'); ?></option>
			<option value="t" <?php selected($cat_meta['layout'], 't'); ?>><?php _e('Timeline', 'theme'); ?></option>
		</select>
	    <br /><span class="description"><?php _e('select category layout', 'theme'); ?></span>
	</label>
	</td>
	</tr>


	
	<tr class="form-field">
	<th scope="row" valign="top"><label><?php _e('Right Sidebar', 'theme'); ?></label></th>
	<td>	
	<label for="cat_sidebar">
		<?php
			$sidebars = $GLOBALS['wp_registered_sidebars'];
		?>
		<select name="Cat_meta[sidebar]" id="cat_sidebar">
			<option value=""><?php _e('Select Sidebar ...', 'theme'); ?></option>
			<?php foreach ($sidebars as $sidebar) { 
				echo '<option value="'.$sidebar['id'].'"'. selected($cat_meta['sidebar'], $sidebar['id']).'>'.$sidebar['name'].'</option>';
			} ?>
		</select>
	    <br /><span class="description"><?php _e('select category sidebar', 'theme'); ?></span>
	</label>
	</td>
	</tr>
	
		<tr class="form-field">
	<th scope="row" valign="top"><label><?php _e('Left Sidebar', 'theme'); ?></label></th>
	<td>	
	<label for="cat_sidebarl">
		<?php
			$sidebars = $GLOBALS['wp_registered_sidebars'];
		?>
		<select name="Cat_meta[sidebarl]" id="cat_sidebarl">
			<option value=""><?php _e('Select Sidebar ...', 'theme'); ?></option>
			<?php foreach ($sidebars as $sidebar) { 
				echo '<option value="'.$sidebar['id'].'"'. selected($cat_meta['sidebarl'], $sidebar['id']).'>'.$sidebar['name'].'</option>';
			} ?>
		</select>
	    <br /><span class="description"><?php _e('select category sidebar', 'theme'); ?></span>
	</label>
	</td>
	</tr>

	<tr class="form-field">
	<th scope="row" valign="top"><label><?php _e('Custom Logo'); ?></label></th>
	<td>	
	<label for="upload_image">
	    <input id="category_logo" class="custom_img_logo" type="text" size="36" name="Cat_meta[custom_logo]" value="<?php echo isset($cat_meta['custom_logo']) ? $cat_meta['custom_logo'] : ''; ?>" style="width: auto !important;"/> 
	    <input id="upload_cat_logo" class="button upload_image_button" type="button" value="Upload Image" data-x="logo" style="width: auto !important;"/>
	    <br /><span class="description"><?php _e('Enter a URL or upload an image', 'theme'); ?></span>
	</label>
	</td>
	</tr>
      
      <tr class="form-field">
	<th scope="row" valign="top"><label><?php _e('Custom Header banner', 'theme'); ?></label></th>
	<td>	
	<label for="custom_banner">
		<?php
			// Get ads
			$ads = get_posts('post_type=ads&posts_per_page=-1');
	  ?>
		<select name="Cat_meta[custom_banner]" id="custom_banner">
			<option value=""><?php _e('Select Banner ...', 'theme'); ?></option>
			<?php foreach ($ads as $ad) { 
				echo '<option value="'.$ad->ID.'"'. selected($cat_meta['custom_banner'],$ad->ID).'>'.esc_attr($ad->post_title).'</option>';
			} ?>
		</select>
	</label>
	</td>
	</tr>	
	
	
	
    <?php
    }
add_action ( 'edited_category', 'save_mom_category_style');
function save_mom_category_style( $term_id ) {
	if ( isset( $_POST['Cat_meta'] ) ) {
	    $t_id = $term_id;
	    $cat_meta = get_option( "category_$t_id");
	    $cat_keys = array_keys($_POST['Cat_meta']);
	    foreach ($cat_keys as $key){
	    if (isset($_POST['Cat_meta'][$key])){
	    $cat_meta[$key] = $_POST['Cat_meta'][$key];
	    }
	    }
	    update_option( "category_$t_id", $cat_meta );
	}
}

add_action ( 'edit_category_form_fields', 'add_styles_scripts_color');
function add_styles_scripts_color(){
    wp_enqueue_style ('wp-color-picker');
    wp_enqueue_script('wp-color-picker');
    wp_enqueue_script('mom-cats-settings', get_template_directory_uri() . '/framework/helpers/js/cats.js');
    wp_enqueue_media();
}

/* ==========================================================================
 *                bbpress
   ========================================================================== */

   //end basebox

add_action('bbp_template_after_pagination_loop', 'mom_bbp_basebox');
function mom_bbp_basebox() {
    echo '';
}
/* ==========================================================================
 *                GeT Years
   ========================================================================== */
function mom_get_years($name, $args = '') {
	global $wpdb, $wp_locale;

	$defaults = array(
		'type' => 'monthly',
                'limit' => '',
		'format' => 'html',
		'echo' => 0,
                'order' => 'DESC',
	);

	$r = wp_parse_args( $args, $defaults );
	extract( $r, EXTR_SKIP );

	if ( '' == $type )
		$type = 'monthly';

	if ( '' != $limit ) {
		$limit = absint($limit);
		$limit = ' LIMIT '.$limit;
	}

	$order = strtoupper( $order );
	if ( $order !== 'ASC' )
		$order = 'DESC';

	$where = apply_filters( 'getarchives_where', "WHERE post_type = 'post' AND post_status = 'publish'", $r );
	$join = apply_filters( 'getarchives_join', '', $r );

	$output = '';

	$last_changed = wp_cache_get( 'last_changed', 'posts' );
	if ( ! $last_changed ) {
		$last_changed = microtime();
		wp_cache_set( 'last_changed', $last_changed, 'posts' );
	}

		$query = "SELECT YEAR(post_date) AS `year`, count(ID) as posts FROM $wpdb->posts $join $where GROUP BY YEAR(post_date) ORDER BY post_date $order $limit";
		$key = md5( $query );
		$key = "wp_get_archives:$key:$last_changed";
		if ( ! $results = wp_cache_get( $key, 'posts' ) ) {
			$results = $wpdb->get_results( $query );
			wp_cache_set( $key, $results, 'posts' );
		}
		if ( $results ) {
			foreach ( (array) $results as $result) {
				$text = sprintf('%d', $result->year);
				$output .= mom_get_years_text( $text, $name);
                                
			}
		}

	if ( $echo )
		echo $output;
	else
		return $output;
}

function mom_get_years_text( $text,$name = '', $format = 'option', $before = '', $after = '') {
	$text = wptexturize($text);
    if (isset($_GET[$name])) {
        $name = $_GET[$name];
    }
	if ('link' == $format)
		$link_html = "\t<link rel='archives' title='" . esc_attr( $text ) . "' href='$text' />\n";
	elseif ('option' == $format)
		$link_html = "\t<option value='$text'".selected($name , $text).">$before $text $after</option>\n";
	elseif ('html' == $format)
		$link_html = "\t<li>$before<a href='$text'>$text</a>$after</li>\n";
	else // custom
		$link_html = "\t$before<a href='$text'>$text</a>$after\n";

	//$link_html = apply_filters( 'get_archives_link', $link_html );

	return $link_html;
}

/* ==========================================================================
 *                SINGLE POST CONTENT 	
   ========================================================================== */
function mom_single_post_content () {
    while ( have_posts() ) : the_post(); 
       $item_type = 'itemscope itemtype="http://schema.org/Article';
    ?>
<div <?php post_class('base-box blog-post p-single bp-horizontal-share'); echo $item_type; ?>">
<?php
    //post settings
        $DPS = get_post_meta(get_the_ID(), 'mom_blog_ps', true);
        if (mom_option('post_share') != 1) {
                $DPS = 1;
        }
        $DPN = get_post_meta(get_the_ID(), 'mom_blog_np', true);
        if (mom_option('post_np') != 1) {
                $DPN = 1;
        }
        $DAB = get_post_meta(get_the_ID(), 'mom_blog_ab', true);
        if (mom_option('post_ab') != 1) {
                $DAB = 1;
        }
        $DRP = get_post_meta(get_the_ID(), 'mom_blog_rp', true);
        if (mom_option('post_rp') != 1) {
                $DRP = 1;
        }
        $DPC = get_post_meta(get_the_ID(), 'mom_blog_pc', true);
        if (mom_option('post_dc') == 1) {
                $DPC = 1;
        }

        $format = get_post_format();
?>
<?php mom_single_post_format($format); ?>
<h1 class="post-tile entry-title" itemprop="name"><?php the_title(); ?></h1>
<?php mom_posts_meta('single-post-meta'); ?>
<div class="entry-content">
        <?php
        $chat_top_content = '';
        $chat_bottom_content = '';
                if ($format == 'chat') { 
                        global $posts_st;
                        $extra = get_post_meta(get_the_ID(), $posts_st->get_the_id(), TRUE);
                        $chat_top_content = isset($extra['chat_post_top_content']) ? $extra['chat_post_top_content'] : '';
                        $chat_bottom_content = isset($extra['chat_post_bottom_content']) ? $extra['chat_post_bottom_content'] : '';
                }
        ?>
<?php echo $chat_top_content; ?>
    <?php the_content(); ?>
<?php echo $chat_bottom_content; ?>
      <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'theme' ), 'after' => '</div>' ) ); ?>
    <?php
      if (mom_option('post_tags') == 1) {
	if (has_tag()) { ?>
        <div class="post-tags">
            <span class="pt-title"><?php _e('Tags:','theme'); ?> </span> <?php the_tags('', ''); ?>
        </div> <!-- post tags -->
    <?php } } ?>
    
<?php
if (mom_option('post_bottom_content_ad') != '') {
    echo do_shortcode('[ad id="'.mom_option('post_bottom_content_ad').'"]');
                //echo do_shortcode('[gap height="20"]');

}
if ($DPS != 1) {mom_posts_share(get_the_ID(), get_permalink());}
?>
</div> <!-- entry content -->
</div> <!-- base box -->
            
<?php
if ($DPN != 1) {mom_post_nav();}
if (mom_option('post_bottom_ad') != '') {
    echo do_shortcode('[ad id="'.mom_option('post_bottom_ad').'"]');
                //echo do_shortcode('[gap height="20"]');
}
if ($DAB != 1) {mom_author_box();}
if ($DRP != 1) {mom_related_posts();}
comments_template();
endwhile;
wp_reset_query(); 
}
add_action('mom_before_content', 'mom_content_ads');
function mom_content_ads() {
  $posh = mom_option('content_ads_position');
  $rs = mom_option('content_right_banner_id');
  $ls = mom_option('content_left_banner_id');
  $pos = '';
  if (is_singular()) {
	global $post;
    $poshs = get_post_meta($post->ID, 'mom_content_ads_fixed', true);
    if ($poshs != '') {
      $posh = $poshs;
    }

	$prs = get_post_meta($post->ID, 'mom_content_right_banner', true);
	$pls = get_post_meta($post->ID, 'mom_content_left_banner', true);
	
	if ($prs != '') {
	  $rs = $prs;
	}
	if ($pls != '') {
	  $ls = $pls;
	}
  }  


  if ($posh == 1) {
    $pos = 'mca-fixed';
  }    
?>

<?php if ($rs != '') { ?>
  <div class="mom_contet_ads mc-ad-right <?php echo $pos; ?>">
      <?php echo do_shortcode('[ad id="'.$rs.'"]'); ?>
  </div>
<?php } ?>
<?php if ($ls != '') { ?>
  <div class="mom_contet_ads mc-ad-left <?php echo $pos; ?>">
      <?php echo do_shortcode('[ad id="'.$ls.'"]'); ?>
  </div>
<?php } ?>
<?php }

function mom_gn_upgrade() {
       // get all posts
$nonce = $_POST['nonce'];
if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
die ( 'Nope!' );

$posts = get_posts( array (  'numberposts' => -1 ) );

    foreach ( $posts as $post )
    {
	$pt = get_post_meta($post->ID, 'mom_article_type', true);
	
	if ($pt == 'slideshow') {
	    set_post_format( $post->ID , 'gallery');
	} elseif ($pt == 'video') {
	    set_post_format( $post->ID , 'video');
	}
    }
    update_option('mom_gn_upgrade', 1);
exit();
}
add_action( 'wp_ajax_mom_gnUpgrade', 'mom_gn_upgrade' );

function mom_get_post_thumbnail_caption() {
	if ( $thumb = get_post_thumbnail_id() )
		return get_post( $thumb )->post_excerpt;
}
/* ==========================================================================
 *                Allow SVG in media uploader 
   ========================================================================== */
function mom_custom_mime_types( $mimes ){
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter( 'upload_mimes', 'mom_custom_mime_types' );
