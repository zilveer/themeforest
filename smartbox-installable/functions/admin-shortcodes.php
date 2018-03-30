<?php


// Enable shortcodes in widget areas
add_filter( 'widget_text', 'do_shortcode' );

// Add stylesheet for shortcodes to HEAD (added to HEAD in admin-setup.php)
if ( ! function_exists( 'des_shortcode_stylesheet' ) && get_option( 'framework_des_disable_shortcodes' ) != 'true' ) {
	function des_shortcode_stylesheet() {
		wp_enqueue_style('shortcodes', get_template_directory_uri().'/functions/css/shortcodes.css');
	}
}


/*-----------------------------------------------------------------------------------*/
/* 1.1 Output shortcode JS in footer */
/*-----------------------------------------------------------------------------------*/

add_action( 'wp_print_scripts', 'des_register_shortcode_js', 10 );

function des_register_shortcode_js () {
	wp_register_script( 'des-shortcodes', get_template_directory_uri() . '/functions/js/shortcodes.js', array() );
} // End des_register_shortcode_js()


function des_enqueue_shortcode_js () {
	if ( ! is_admin() && defined( 'DES_SHORTCODE_JS' ) ) {
		wp_enqueue_script( 'des-shortcodes' );
		
		global $wp_scripts;
		$wp_scripts->to_do = array( 'des-shortcodes' );
		
		wp_print_scripts();
	} // End IF Statement

} // End des_enqueue_shortcode_js()


/*-----------------------------------------------------------------------------------*/
/* 6. Twitter button - twitter
/*-----------------------------------------------------------------------------------*/

function des_shortcode_twitter($atts, $content = null) {
   	global $post;
   	extract(shortcode_atts(array(	'url' => '',
   									'style' => 'vertical',
   									'source' => '',
   									'text' => '',
   									'related' => '',
   									'lang' => '',
   									'float' => 'left', 
   									'use_post_url' => 'false' ), $atts));
	$output = '';

	if ( $url )
		$output .= ' data-url="'.$url.'"';

	if ( $source )
		$output .= ' data-via="'.$source.'"';

	if ( $text )
		$output .= ' data-text="'.$text.'"';

	if ( $related )
		$output .= ' data-related="'.$related.'"';

	if ( $lang )
		$output .= ' data-lang="'.$lang.'"';
		
	if ( $use_post_url == 'true' && $url == '' ) {
		$output .= ' data-url="' . get_permalink( $post->ID ) . '"';
	}

	$output = '<div class="des-sc-twitter '.$float.'"><a href="http://twitter.com/share" class="twitter-share-button"'.$output.' data-count="'.$style.'">Tweet</a>';
	wp_enqueue_script( 'twitterbutton', 'http://platform.twitter.com/widgets.js', array(),'1.0');
	return $output;

}
add_shortcode( 'twitter', 'des_shortcode_twitter' );

/*-----------------------------------------------------------------------------------*/
/* 7. Digg Button - digg
/*-----------------------------------------------------------------------------------*/

function des_shortcode_digg($atts, $content = null) {
   	extract(shortcode_atts(array(	'link' => '',
   									'title' => '',
   									'style' => 'medium',
   									'float' => 'left' ), $atts));
	$output = "
	<script type=\"text/javascript\">
	(function() {
	var s = document.createElement( 'SCRIPT'), s1 = document.getElementsByTagName( 'SCRIPT')[0];
	s.type = 'text/javascript';
	s.async = true;
	s.src = 'http://widgets.digg.com/buttons.js';
	s1.parentNode.insertBefore(s, s1);
	})();
	</script>
	";
	if ( $link ) {
		if ( $title )
			$title = '&amp;title='.urlencode( $title );

		$link = ' href="http://digg.com/submit?url='.urlencode( $link ).$title.'"';
	}

	if ( $link == '' ) {
		global $post;
		$link = get_permalink( $post->ID );
	}

	if ( $style == "large" )
		$style = "Large";
	elseif ( $style == "compact" )
		$style = "Compact";
	elseif ( $style == "icon" )
		$style = "Icon";
	else
		$style = "Medium";

	$output .= '<div class="des-digg '.$float.'"><a class="DiggThisButton Digg'.$style.'"'.$link.'></a></div>';
	return $output;

}
add_shortcode( 'digg', 'des_shortcode_digg' );


/*-----------------------------------------------------------------------------------*/
/* 8. Facebook Like Button - fblike
/*-----------------------------------------------------------------------------------*/
function des_shortcode_fblike($atts, $content = null) {
   	extract(shortcode_atts(array(	'float' => 'none',
   									'url' => '',
   									'style' => 'standard',
   									'showfaces' => 'false',
   									'width' => '450',
   									'verb' => 'like',
   									'colorscheme' => 'light',
   									'font' => 'arial'), $atts));

	global $post;

	if ( ! $post ) {

		$post = new stdClass();
		$post->ID = 0;

	} // End IF Statement

	$allowed_styles = array( 'standard', 'button_count', 'box_count' );

	if ( ! in_array( $style, $allowed_styles ) ) { $style = 'standard'; } // End IF Statement

	if ( !$url )
		$url = get_permalink($post->ID);

	$height = '65';
	if ( $showfaces == 'true')
		$height = '100';

	if ( ! $width || ! is_numeric( $width ) ) { $width = 450; } // End IF Statement

	$widthpx = $width . 'px';
	if ( $width == 450 && $showfaces == 'false' ) { $widthpx = '100%'; }
	
	if ( $showfaces == 'false' && ( $style != 'box_count' ) ) { $height = 50; }

	switch ( $float ) {

		case 'left':
			$float = 'fl';
		break;
		case 'right':
			$float = 'fr';
		break;
		default:
		break;

	} // End SWITCH Statement

	$output = '
<div class="des-fblike '.$float.'">
<iframe src="http://www.facebook.com/plugins/like.php?href=' . $url . '&amp;layout=' . $style . '&amp;show_faces=' . $showfaces . '&amp;width=' . $width . '&amp;action=' . $verb . '&amp;colorscheme=' . $colorscheme . '&amp;font=' . $font . '" scrolling="no" frameborder="0" allowTransparency="true" style="border:none; overflow:hidden; width:' . $widthpx . '; height:' . $height . 'px;"></iframe>
</div>
	';
	return $output;

}
add_shortcode( 'fblike', 'des_shortcode_fblike' );


/*-----------------------------------------------------------------------------------*/
/* 13. jQuery Toggle
/*-----------------------------------------------------------------------------------*/
function des_shortcode_toggle ( $atts, $content = null ) {

		// Instruct the shortcode JavaScript to load.
		if ( ! defined( 'DES_SHORTCODE_JS' ) ) { define( 'DES_SHORTCODE_JS', 'load' ); }
		
		$defaults = array(
							'title_open' => __( 'Hide the Content', 'smartbox' ),
							'title_closed' => __( 'Show the Content', 'smartbox' ),
							'hide' => 'yes',
							'display_main_trigger' => 'yes',
							'excerpt_length' => '0',
							'include_excerpt_html' => 'no',
							'read_more_text' => __( 'Read More', 'smartbox' ),
							'read_less_text' => __( 'Read Less', 'smartbox' )
						);

		extract( shortcode_atts( $defaults, $atts ) );
		
		$title = '';
		$class = '';

		$class_open = ' toggle-' . sanitize_title( $title_open );

		$class_closed = ' toggle-' . sanitize_title( $title_closed );

		if ( $hide == 'yes' ) {
			$class .= $class_closed . ' closed'; $title = $title_closed;
		} else {
			$class .= $class_open . ' open'; $title = $title_open;
		} // End IF Statement

		$main_trigger = '';

		if ( $display_main_trigger == 'yes' ) {
			$main_trigger = '<h4 class="toggle-trigger"><a href="javascript:;" onclick="toggleTrigger(this)	">' . $title . '</a></h4>' . "\n";
		} // End IF Statement
		
		if ( $include_excerpt_html == 'no' ) {
			$content = strip_tags( $content );
		}
		return '<div class="shortcode-toggle' . $class . '">' . $main_trigger . '<div class="toggle-content"><div class="toggle-c2"><p>' . do_shortcode( $content ) . '</p></div></div><input id="title_open" type="hidden" name="title_open" value="' . esc_attr( $title_open ) . '" /><input id="title_closed" type="hidden" name="title_closed" value="' . esc_attr( $title_closed ) . '" />' . '</div>';

} // End des_shortcode_toggle()

add_shortcode( 'toggle', 'des_shortcode_toggle', 99 );

/*-----------------------------------------------------------------------------------*/
/* 14. Facebook Share Button - fbshare
/*-----------------------------------------------------------------------------------*/
function des_shortcode_fbshare($atts, $content = null) {
   	extract( shortcode_atts( array( 'url' => '', 'type' => 'button', 'float' => 'left' ), $atts ) );

	global $post;

	if ( isset( $url ) && $url == '' && isset( $post ) ) { $url = get_permalink( $post->ID ); } // End IF Statement

	$output = '
<div class="des-fbshare ' . $float . '">
<a name="fb_share" type="' . $type . '" share_url="' . $url . '">'.$content.'</a>
<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share"
        type="text/javascript">
</script>
</div>
	';
	return $output;

}
add_shortcode( 'fbshare', 'des_shortcode_fbshare' );

/*-----------------------------------------------------------------------------------*/
/* 15. Advanced Contact Form - contact_form
/*-----------------------------------------------------------------------------------*/
function des_shortcode_contactform ( $atts, $content = null ) {

		$defaults = array(
						'email' => '',
						'subject' => '',
						'name_error' => '',
						'email_error' => '',
						'message_error' => '',
						'success_message' => '',
						'unsuccess_message' => ''
						);

		extract( shortcode_atts( $defaults, $atts ) );
		
		if(!empty($email))
			$e = $email;
		else
			$e = get_option("admin_email");
		
		return '<div class="contact-form">
				<div class="message_success form_success"></div>
				<form method="post" action="#" class="validateform">
					<ul class="forms">
						<li>
							<label for="name">' . __(get_option(DESIGNARE_SHORTNAME.'_cf_name'), "smartbox") . '</label><input type="text" name="name" class="yourname txt corner-input" onfocus="checkerror(this)" onblur="var v = $(this).val(); $(\'.yourname_val\').html(v);">
							<div class="yourname_val" style="display:none"></div>
						</li>
						<li>
							<label for="email">' . __(get_option(DESIGNARE_SHORTNAME.'_cf_email'), "smartbox") . '</label><input style="margin: 10px 0;" type="text" name="email" class="youremail txt corner-input" onfocus="checkerror(this)" onblur="var v = $(this).val(); $(\'.youremail_val\').html(v);">
							<div class="youremail_val" style="display:none"></div>
						</li>
						<li>
							<label for="message">' . __(get_option(DESIGNARE_SHORTNAME.'_cf_message'), "smartbox") . '</label><textarea name="message" class="yourmessage textarea message corner-input" rows=20 cols=30 onfocus="checkerror(this)" onblur="var v = $(this).val(); $(\'.yourmessage_val\').html(v);"></textarea>
							<div class="yourmessage_val" style="display:none"></div>
						</li>
						<li>
							<a id="send-comment" href="javascript:;" onclick="sendemail($(this),\'' . $e . '\', \'' . $subject . '\', \'' . $name_error . '\', \'' . $email_error . '\', \'' . $message_error . '\', \'' . $success_message . '\', \'' . $unsuccess_message . '\')" class="submit">' . __(get_option(DESIGNARE_SHORTNAME.'_cf_send'), "smartbox") . '</a>
						</li>
					</ul>
				</form>
			</div>';
}

add_shortcode( 'contact_form', 'des_shortcode_contactform' );

/*recent projects style 1*/
function des_shortcode_rp_style1 ( $atts, $content = null ) {

		// Instruct the shortcode JavaScript to load.
		if ( ! defined( 'DES_SHORTCODE_JS' ) ) { define( 'DES_SHORTCODE_JS', 'load' ); }
		
		$defaults = array( 'title' => '', 'portfolio' => 'all', 'total' => -1, 'scroller'=>'yes','proj_per_row' => '', 'orderby' => '', 'order' => '', 'link_to_projects' => '', 'title_to_projects_link' => '', 'categories'=>'all', 'autoplay'=>'no', 'autoplay_speed'=>'3000');

		extract( shortcode_atts( $defaults, $atts ) );
		
		$randID = rand();
		
		if(!empty($title))
			$t = "$title";
			
		if(!isset($total) || $total == 0)
  		$total = -1;
		
		$layout = "";
  		$thumbHeight = "";
  		switch($proj_per_row){
	  		case '4': $layout = " four columns"; $thumbHeight = "170px"; break;
	  		case '3': $layout = " one-third column"; $thumbHeight = "232px"; break;
	  		case '2': $layout = " eight columns"; $thumbHeight = "355px"; break;
	  		case '1': $layout = " sixteen columns"; break;
  		}
			
		$projects_ids = array();
						    
		if($portfolio == 'all')
  			$portfolio = null;
		
		if ($categories != "all"){
	    	$cats = explode("|*|",$categories);
	    	$thecats = array();
	    	foreach($cats as $c){
	    		if ($c != ""){
	    			array_push($thecats, $c);
	    		}
	    	}
	    }
		
		global $post;
		
		//set the query_posts args
		$args= array(
		     'posts_per_page' => $total, 
			 'post_type' => DESIGNARE_PORTFOLIO_POST_TYPE,
			 'orderby' => $orderby,
			 'order' => $order,
			 'portfolio_type' => $portfolio
		);
		$projs = get_posts($args);
		
		$filteredprojs = array();
		if ($categories != "all"){
			foreach ($projs as $p){
				$projscats = get_the_terms($p->ID, 'portfolio_category');
				$found = false;
				foreach ($projscats as $pcats){
					foreach ($thecats as $tc){
						if ($pcats->slug == $tc) $found = true;	
					}
				}
				if ($found) {
					array_push($filteredprojs, $p);
					$projs = $filteredprojs;
				}
			}
	
		}
				
		foreach($projs as $p){
			array_push($projects_ids, $p->ID);
		}	
		
		if ($scroller == "no"){
			$rows = ceil(count($projects_ids)/$proj_per_row);
			$el = 0;
		} else {
			wp_enqueue_script( 'carrossel', DESIGNARE_JS_PATH .'jquery.jcarousel.min.js', array(),'1.0',$in_footer = true);
		}
		
		//INDIVIDUAL PROJECTS
		$individual_project = "";
		
		for($i=0; $i < count($projects_ids); $i++){
		
			if ($scroller == "no" && $el == 0){
			 	$individual_project .= '<div class="projs_row">';
		 	}
		
			$this_project = get_post($projects_ids[$i]);
			
			$p_type = get_post_meta($this_project->ID, 'portfolioType_value', true);
			
			$rel = "";
			$hoverType = get_post_meta($this_project->ID, "thumbnailHoverOption_value", true);
			if ($hoverType != "default"){
				$rel = " data-rel='".$hoverType."' ";
			}
			
			if ($scroller == "no")
			 	$individual_project .= '<div '.$rel.' class="indproj1 '.$layout.'">';
		 	else
		 		$individual_project .= '<li '.$rel.'class="indproj1" >';

			$individual_project .= '<div class="slides_item post-thumb"><ul class="ch-grid"><li><div class="ch-item"> '; 
						
			if ($p_type != "image")
				$img = wp_get_attachment_url( get_post_thumbnail_id($this_project->ID));
			else{
				$img = wp_get_attachment_url( get_post_thumbnail_id($this_project->ID));
				if ($img == ""){
					$sliderData = get_post_meta($this_project->ID, "sliderImages_value", true);
					$slide = explode("|*|",$sliderData);
	
			    	if ($slide[0] != ""){
			    		$url = explode("|!|",$slide[0]);
			    		$img = $url[1];	
			    	}	
				}
			} 
				
			$cat_name = "";				 	
						
			$terms = get_the_terms($this_project->ID, 'portfolio_category');

			if ( $terms && ! is_wp_error( $terms ) ) {
				$xuts = 0;
				foreach ( $terms as $x ) {
					if ($xuts == 0){
						$cat_name .= $x->name;
					}
					else $cat_name .= ", ".$x->name; 
					$xuts++;
				}
			}						
						
			$individual_project .= '<a href="'.get_the_permalink($this_project->ID).'"><img class="img_thumb" alt="" src="'.$img.'" /></a><a class="flex_this_thumb" href="'.$img.'"></a><div class="mask" onclick="$(this).siblings(\'a\').trigger(\'click\');"><div class="more" onclick="$(this).parents(\'.ch-item\').find(\'.flex_this_thumb\').click();"></div><div class="link" onclick="window.location = $(this).parents(\'.ch-item\').children(\'a\').eq(0).attr(\'href\');"></div></div>'; 
			$individual_project .= '</div></li></ul>';
			$individual_project .= '<div class="no-flicker"><div class="proj-title-tags"><div class="p_title no-flicker"><a href="'.get_the_permalink($this_project->ID).'">'.$this_project->post_title.'</a></div>';
				
			$individual_project .= '</div></div></div>'; 
			
			
			if ($scroller == "yes")
				$individual_project .= '</li>';
			else 
				$individual_project .= '</div>';
				
			if ($scroller == "no"){
				$el++;
				if ($el == $proj_per_row){
					$individual_project .= "</div>";
					$el = 0;
				}
			}
			
		}
		$output = "";
		
		$autoplay_output = "";
		if ($autoplay === "yes"){
			$autoplay_output  = ", autoSlide: true, autoSlideInterval: ".intval($autoplay_speed, 10)."";	
		}
		
		if ($scroller == "yes"){
			if ($link_to_projects != ""){
				$output .= '<section id="lastprojects3-'.$randID.'" class="home_widget recentProjects3"><div class="projects_container_proj"><div class="smartboxtitle page_title_s3"><span class="page_info_title_s3">'. $title . '</span><div class="pag-proj2_s3"><div class="nextbutton carousel-control next carousel-next jcarousel-next jcarousel-next-horizontal"></div><div class="goto_projects"  onclick="window.location = \''.$link_to_projects.'\';" title="'.$title_to_projects_link.'"></div><div class="prevbutton carousel-control previous carousel-previous jcarousel-prev jcarousel-prev-horizontal"></div></div></div><hr><div class="project_list_s3" ><ul class="slides_container jcarousel-skin-tango">'.$individual_project.'</ul></div></div><script>jQuery(document).ready(function(){jQuery(\'#lastprojects3-'.$randID.' .slides_container\').parent().carousel({dispItems: 1'.$autoplay_output.'});});</script><div class="clear"></div></section>';	
			} else {
				$output .= '<section id="lastprojects3-'.$randID.'" class="home_widget recentProjects3"><div class="projects_container_proj"><div class="smartboxtitle page_title_s3"><span class="page_info_title_s3">'. $title . '</span><div class="pag-proj2_s3"><div class="nextbutton carousel-control next carousel-next jcarousel-next jcarousel-next-horizontal"></div><div class="prevbutton carousel-control previous carousel-previous jcarousel-prev jcarousel-prev-horizontal" ></div></div></div><hr><div class="project_list_s3"><ul class="slides_container jcarousel-skin-tango">'.$individual_project.'</ul></div></div><script>jQuery(document).ready(function(){jQuery(\'#lastprojects3-'.$randID.' .slides_container\').parent().carousel({dispItems: 1'.$autoplay_output.'});});</script><div class="clear"></div></section>';
			}	
		} else {
			if ($link_to_projects != ""){
				$output .= '<section id="lastprojects3-'.$randID.'" class="home_widget recentProjects3"><div class="projects_container_proj"><div class="smartboxtitle page_title_s3"><span class="page_info_title_s3">'. $title . '</span><div class="pag-proj2_s3"><div class="goto_projects"  onclick="window.location = \''.$link_to_projects.'\';" title="'.$title_to_projects_link.'"></div></div></div><hr><div class="project_list_s3"><div class="slides_container jcarousel-skin-tango">'.$individual_project.'</div></div></div><div class="clear"></div></section>';	
			} else {
				if ($title != ""){
					$output .= '<section id="lastprojects3-'.$randID.'" class="home_widget recentProjects3"><div class="projects_container_proj"><div class="smartboxtitle page_title_s3"><span class="page_info_title_s3">'. $title . '</span></div><hr><div class="project_list_s3"><div class="slides_container jcarousel-skin-tango">'.$individual_project.'</div></div></div><div class="clear"></div></section>';
				} else {
					$output .= '<section id="lastprojects3-'.$randID.'" class="home_widget recentProjects3"><div class="projects_container_proj sixteen columns"><div class="project_list_s3"><div class="slides_container jcarousel-skin-tango">'.$individual_project.'</div></div></div><div class="clear"></div></section>';
				}
			}	
		}

		return $output;

}


add_shortcode( 'rp_style1', 'des_shortcode_rp_style1', 90 );

/*-----------------------------------------------------------------------------------*/
/* xx RP Style 3 - [rp_style3]
/*-----------------------------------------------------------------------------------*/

function des_shortcode_rp_style2 ( $atts, $content = null ) {

		// Instruct the shortcode JavaScript to load.
		if ( ! defined( 'DES_SHORTCODE_JS' ) ) { define( 'DES_SHORTCODE_JS', 'load' ); }

		$defaults = array( 'title' => '', 'portfolio' => 'all', 'total' => -1, 'scroller'=>'yes', 'proj_per_row' => '4', 'orderby' => '', 'order' => '', 'link_to_projects' => '', 'title_to_projects_link' => '', 'view_more_text' => '', 'categories'=>'all', 'autoplay'=>'no', 'autoplay_speed' => '3000' );

		extract( shortcode_atts( $defaults, $atts ) );
		
		$randID = rand();
		
		if(!empty($title))
			$t = "$title";
			
		if(!isset($total) || $total == 0)
  		$total = -1;
  		
  		$layout = "";
  		$thumbHeight = "";
  		switch($proj_per_row){
	  		case '4': $layout = " four columns"; $thumbHeight = "160px"; break;
	  		case '3': $layout = " one-third column"; $thumbHeight = "220px"; break;
	  		case '2': $layout = " eight columns"; $thumbHeight = "320px"; break;
	  		case '1': $layout = " sixteen columns"; break;
  		}
			
		$projects_ids = array();
						    
		if($portfolio == 'all')	$portfolio = null;
		
		if ($categories != "all"){
	    	$cats = explode("|*|",$categories);
	    	$thecats = array();
	    	foreach($cats as $c){
	    		if ($c != ""){
	    			array_push($thecats, $c);
	    		}
	    	}
	    }
		
		global $post;
		
		//set the query_posts args
		$args= array(
		     'posts_per_page' => $total, 
				 'post_type' => DESIGNARE_PORTFOLIO_POST_TYPE,
				 'orderby' => $orderby,
				 'order' => $order,
				 'portfolio_type' => $portfolio
		);
		$projs = get_posts($args);
		
		$filteredprojs = array();
		if ($categories != "all"){
			foreach ($projs as $p){
				$projscats = get_the_terms($p->ID, 'portfolio_category');
				$found = false;
				foreach ($projscats as $pcats){
					foreach ($thecats as $tc){
						if ($pcats->slug == $tc) $found = true;	
					}
				}
				if ($found) {
					array_push($filteredprojs, $p);
					$projs = $filteredprojs;
				}
			}	
		}
		
		foreach($projs as $p){
			array_push($projects_ids, $p->ID);
		}	
		
		if ($scroller == "no"){
			$rows = ceil(count($projects_ids)/$proj_per_row);
			$el = 0;
		} else {
			wp_enqueue_script( 'carrossel', DESIGNARE_JS_PATH .'jquery.jcarousel.min.js', array(),'1.0',$in_footer = true);
		}
		
		$individual_project = "";
		
		for($i=0; $i < count($projects_ids); $i++){
		
			if ($scroller == "no" && $el == 0){
			 	$individual_project .= '<div class="projs_row">';
		 	}
		 	
		 	if ($scroller == "no")
			 	$individual_project .= '<div class="indproj2 '.$layout.'">';
		 	else
		 		$individual_project .= '<li>';
		
			$individual_project .= '<ul class="da-thumbs da-recent-projs">';
					
			$this_project = get_post($projects_ids[$i]);
			
			if ($scroller == "no")
				$individual_project .= '<li><a class="noscroll" href="'.get_permalink($this_project->ID).'">';
			else
				$individual_project .= '<li><a href="'.get_permalink($this_project->ID).'">';

			
			$p_type = get_post_meta($this_project->ID, 'portfolioType_value', true);
			
			$individual_project .= '<div class="slides_item post-thumb">';
						
			$individual_project .= '<img class="img_thumb" alt="" src="';
						
			if ($p_type != "image")
				$img = wp_get_attachment_url( get_post_thumbnail_id($this_project->ID));
			else{
				$img = wp_get_attachment_url( get_post_thumbnail_id($this_project->ID));
				if ($img == ""){
					$sliderData = get_post_meta($this_project->ID, "sliderImages_value", true);
					$slide = explode("|*|",$sliderData);
	
			    	if ($slide[0] != ""){
			    		$url = explode("|!|",$slide[0]);
			    		$img = $url[1];	
			    	}	
				}
			} 
			$individual_project .= $img;
			
			$cat_name = "";				 	
			
			$terms = get_the_terms($this_project->ID, 'portfolio_category');

			$s_categories = "<span class='overlay_categories'>";

			if ( $terms && ! is_wp_error( $terms ) ) {
				$xuts = 0;
				foreach ( $terms as $x ) {
					if ($xuts == 0){
						$cat_name .= $x->name;
					}
					else $cat_name .= " / ".$x->name; 
					$xuts++;
				}
			}	
			$s_categories .= "<span>".$cat_name."</span>";
			$s_categories .= "</span>";					
	
			$individual_project .= '" />';
			
			$individual_project .= '<div class="dahover"><span class="da-title">'. $this_project->post_title. '</span>'.$s_categories .'</div>';
					
			$individual_project .= '</div></a><a class="pp-link" style="display:none;" href="'.$img.'"></a></li></ul>';
			
			if ($scroller == "yes")
				$individual_project .= '</li>';
			else 
				$individual_project .= '</div>';
				
			if ($scroller == "no"){
				$el++;
				if ($el == $proj_per_row){
					$individual_project .= "</div>";
					$el = 0;
				}
			}
		
		}
		
		$autoplay_output = "";
		if ($autoplay === "yes"){
			$autoplay_output  = ", autoSlide: true, autoSlideInterval: ".intval($autoplay_speed, 10)."";	
		}
		
		if ($scroller == "yes"){
			if ($link_to_projects != ""){
				$output = '<section id="lastprojects4-'.$randID.'" class="home_widget recentProjects4"><div class="projects_container_s4"><div class="smartboxtitle page_title_s4"><span class="page_info_title_s4">'.$title.'</span>';
				if ($title != "") $output .= '<hr>';
				$output .= '<div class="pag-proj2_s4"><div class="nextbutton carousel-control next carousel-next jcarousel-next jcarousel-next-horizontal"></div><div class="goto_projects" onclick="window.location = \''.$link_to_projects.'\';" title="'.$title_to_projects_link.'"></div><div class="prevbutton carousel-control previous carousel-previous jcarousel-prev jcarousel-prev-horizontal"></div></div></div><div class="project_list_s4"><ul class="slides_container jcarousel-skin-tango">'.$individual_project.'</ul></div></div><script type="text/javascript">jQuery(function($) {$(\'#lastprojects4-'.$randID.' .da-thumbs > li > a > .post-thumb\').hoverdir(); $(\'#lastprojects4-'.$randID.' .project_list_s4\').carousel({dispItems:1'.$autoplay_output.'}); });</script><div class="clear"></div></section>';
			} else {
				$output = '<section id="lastprojects4-'.$randID.'" class="home_widget recentProjects4"><div class="projects_container_s4"><div class="smartboxtitle page_title_s4"><span class="page_info_title_s4">'.$title.'</span>';
				if ($title != "") $output .= '<hr>';
				$output .= '<div class="pag-proj2_s4"><div class="nextbutton carousel-control next carousel-next jcarousel-next jcarousel-next-horizontal"></div><div class="prevbutton carousel-control previous carousel-previous jcarousel-prev jcarousel-prev-horizontal"></div></div></div><div class="project_list_s4"><ul class="slides_container jcarousel-skin-tango">'.$individual_project.'</ul></div></div><script type="text/javascript">jQuery(function($) {$(\'#lastprojects4-'.$randID.' .da-thumbs > li > a > .post-thumb\').hoverdir(); $(\'#lastprojects4-'.$randID.' .project_list_s4\').carousel({dispItems: 1'.$autoplay_output.'}); });</script><div class="clear"></div></section>';
			}	
		} else {
			if ($link_to_projects != ""){
				$output = '<section id="lastprojects4-'.$randID.'" class="home_widget recentProjects4"><div class="projects_container_s4"><div class="smartboxtitle page_title_s4"><span class="page_info_title_s4">'.$title.'</span>';
				if ($title != "") $output .= '<hr>';
				$output .= '<div class="pag-proj2_s4"><div class="goto_projects" onclick="window.location = \''.$link_to_projects.'\';" title="'.$title_to_projects_link.'"></div></div></div><div class="project_list_s4"><ul class="slides_container jcarousel-skin-tango">'.$individual_project.'</ul></div></div><script type="text/javascript">jQuery(function($) {$(\'#lastprojects4-'.$randID.' .da-thumbs > li > a > .post-thumb\').hoverdir(); });</script><div class="clear"></div></section>';
			} else {
				if ($title == ""){
					$output = '<section id="lastprojects4-'.$randID.'" class="home_widget recentProjects4"><div class="projects_container_s4"><div class="project_list_s4"><ul class="slides_container jcarousel-skin-tango">'.$individual_project.'</ul></div></div><script type="text/javascript">jQuery(function($) {$(\'#lastprojects4-'.$randID.' .da-thumbs > li > a > .post-thumb\').hoverdir(); });</script><div class="clear"></div></section>';
				} else {
					$output = '<section id="lastprojects4-'.$randID.'" class="home_widget recentProjects4"><div class="projects_container_s4"><div class="page_title_s4 a-left"><span class="page_info_title_s4">'.$t.'</span><hr></div><div class="project_list_s4"><ul class="slides_container jcarousel-skin-tango">'.$individual_project.'</ul></div></div><script type="text/javascript">jQuery(function($) {$(\'#lastprojects4-'.$randID.' .da-thumbs > li > a > .post-thumb\').hoverdir(); });</script><div class="clear"></div></section>';	
				}
			}
		}
		
		return $output;

} // End des_shortcode_rp_style4()

add_shortcode( 'rp_style2', 'des_shortcode_rp_style2', 90 );

/*-----------------------------------------------------------------------------------*/
/* xx RPosts - [rposts]
/*-----------------------------------------------------------------------------------*/

function des_shortcode_rposts ( $atts, $content = null ) {

		// Instruct the shortcode JavaScript to load.
		if ( ! defined( 'DES_SHORTCODE_JS' ) ) { define( 'DES_SHORTCODE_JS', 'load' ); }

		$defaults = array( 'title' => '', 'category' => 'all', 'total' => -1, 'orderby' => '', 'scroller' => 'yes', 'posts_per_row'=>'3', 'order' => '', 'link_to_blog' => '', 'title_to_blog_link' => '', 'max_chars'=>-1, 'categories'=>'all', 'autoplay'=>'no', 'autoplay_speed'=>'3000' );

		extract( shortcode_atts( $defaults, $atts ) );
		
		$randID = rand();
		$uagent_obj = new uagent_info();
		$postes = "";
		
		if(!empty($title))
			$t = "$title";
		else
			$t = __("Latests Posts", "smartbox");
			
		if(!isset($total) || $total == 0)
  		$total = -1;
		
		
		global $post;
		
		global $more;
			$more = 0;
			
		if ($categories != "all"){
	    	$cats = explode("|*|",$categories);
	    	$thecats = array();
	    	foreach($cats as $c){
	    		if ($c != ""){
	    			array_push($thecats, $c);
	    		}
	    	}
	    }
		
		$args = array(
			'showposts' => -1,
			'orderby' => $orderby,
			'order' => $order,
			'post_status' => 'publish'
		);
		
		$columnslayout = "";
		switch($posts_per_row){
			case "2": 
				$columnslayout = "eight columns";
				break;
			case "3": 
				$columnslayout = "one-third column";
				break;
			case "4": 
				$columnslayout = "four columns";
				break;
		}
		$losposts = get_posts($args);
		
		$filteredposts = array();
		if ($categories != "all"){
			foreach ($losposts as $p){
				$postscats = get_the_terms($p->ID, 'category');
				$found = false;
				if ($postscats != "" && is_array($postscats)){
					foreach ($postscats as $pcats){
						foreach ($thecats as $tc){ 
							if ($pcats->slug == $tc) $found = true;	
						}
					}
					if ($found) {
						array_push($filteredposts, $p);
						$losposts = $filteredposts;
					}	
				}
			}	
		}
		
	 	$rows = ceil(count($losposts)/$posts_per_row);
	 	$postscounter = $el = 0;
		//query_posts($args);
		foreach ($losposts as $post){
			
			if (($total > -1 && $postscounter < $total) || $total == -1){
				query_posts('p='.$post->ID);
				the_post();
			
				$audio = "";
					 	
			 	if ($scroller == "no" && $el == 0){
				 	$postes .= '<div class="posts_row">';
			 	}
			 	
			 	if ($scroller == "no")
				 	$postes .= '<div class="'.$columnslayout.'">';
			 	else
			 		$postes .= '<li>';
			 		 
			 	$postes .= '<div id="post-' . get_the_ID() . '" class="slides-item post no-flicker"><div class="the_content">';
			 	
			 	$posttype = get_post_meta(get_the_ID(), 'posttype_value', true);
			 	
			 	$postid = get_the_ID();
			 	
			 	$postes .= '<div class="data_type">'; 
			 	
			 	$postes .= '<div class="cutcorner_top"></div>';
			 	
			 	$postes .= '<div class="data"><div class="day">'.get_the_date("d").'</div><div class="">'.__(substr(get_the_date("F"), 0, 3), "smartbox").'</div></div>';
		
			 	if ($posttype != "none" && $posttype != "") $postes .= '<div class="post_type '.$posttype.'"><i class="icon-"></i></div>';
			 	
			 	$postes .= '<div class="cutcorner_bottom"></div>';
			 	
			 	$postes .= '</div><div class="title_content">';
			 						
				$postes .= '<div class="the_title"><a href="'. get_permalink() . '">'. get_the_title() .'</a></div>';
				
				$num_comments = get_comments_number(); // get_comments_number returns only a numeric value
		
				if ( comments_open() ) {
					$num_comments = get_comments_number(); // get_comments_number returns only a numeric value
					if ( $num_comments == 0 ) {
						$comments = __('0','smartbox');
					} elseif ( $num_comments > 1 ) {
						$comments = $num_comments . __('','smartbox');
					} else {
						$comments = __('1','smartbox');
					}
					$postes .= '<div class="comments_number"><i class="icon-comments-alt"></i>'.$comments.'</div>';
				}  
				
				$textcontent = "";
				$char = 0;
				$idx = 0;
				if ($max_chars > 0){
					$textcontent = get_the_content();
					$textcontent = strip_shortcodes($textcontent);
					$textcontent = strip_tags($textcontent);
					$the_str = substr($textcontent, 0, $max_chars);
		
					if (strlen($textcontent) > $max_chars){
						$textcontent = $the_str."...";
					} else {
						$textcontent = get_the_content();
					}
				} else {
					$textcontent = get_the_excerpt();
				}
				
				if ($audio != ""){
					$postes .= '<div class="the_content">'.$audio.'</div>';
				} else {
					$postes .= '<div class="the_content"><p>'.$textcontent.' <span class="rp_readmore"><a href="'.get_permalink().'">'.__(get_option(DESIGNARE_SHORTNAME."_read_more"),'smartbox').'</a></span>'.'</p>'.'</div>';
				}
				
				$postes .= '</div>';
		
				if ($scroller == "yes")
				    $postes .= '</div></div></li>';
				else 
					$postes .= '</div></div></div>';
					
				if ($scroller == "no"){
					$el++;
					if ($el == $posts_per_row){
						$postes .= "</div>";
						$el = 0;
					}
				}
				$postscounter++;
			}
		
		}
		
		$autoplay_output = "";
		if ($autoplay === "yes"){
			$autoplay_output  = ", autoSlide: true, autoSlideInterval: ".intval($autoplay_speed, 10)."";	
		}
			
		if ($scroller == "yes"){
			wp_enqueue_script( 'carrossel', DESIGNARE_JS_PATH .'jquery.jcarousel.min.js', array(),'1.0',$in_footer = true);
			if ($link_to_blog != ""){
				return '<section id="recentPosts-' . $randID . '" class="home_widget recentPosts"><div class="projects_container rposts2 sixteen columns"><div class="smartboxtitle page_title_s2"><hr><span class="page_info_title_s2">'. $title . '</span><div class="pag-proj2_s2"><div class="nextbutton carousel-control next carousel-next jcarousel-next jcarousel-next-horizontal"></div><div class="goto_blog"  onclick="window.location = \''.$link_to_blog.'\';" title="'.$title_to_blog_link.'"></div><div class="prevbutton carousel-control previous carousel-previous jcarousel-prev jcarousel-prev-horizontal"></div></div></div><div class="project_list_s2" ><ul class="slides_container post_listing jcarousel-skin-tango">'.$postes.'</ul></div></div><script type="text/javascript">jQuery(document).ready(function($){jQuery("#recentPosts-'.$randID.' .slides_container").parent().carousel({dispItems: 1'.$autoplay_output.'});});</script><div class="clear"></div></section>';		
			} else {
				return '<section id="recentPosts-' . $randID . '" class="home_widget recentPosts"><div class="projects_container rposts2 sixteen columns"><div class="smartboxtitle page_title_s2 "><hr><span class="page_info_title_s2">'. $title . '</span><div class="pag-proj2_s2"><div class="nextbutton carousel-control next carousel-next jcarousel-next jcarousel-next-horizontal"></div><div class="prevbutton carousel-control previous carousel-previous jcarousel-prev jcarousel-prev-horizontal"></div></div></div><div class="project_list_s2" style="width:100%;"><ul class="slides_container post_listing jcarousel-skin-tango">'.$postes.'</ul></div></div><script type="text/javascript">jQuery(document).ready(function($){jQuery("#recentPosts-'.$randID.' .slides_container").parent().carousel({dispItems: 1'.$autoplay_output.'});});</script><div class="clear"></div></section>';
			}	
		} else {
			if ($link_to_blog != ""){
				return '<section id="recentPosts-' . $randID . '" class="home_widget recentPosts"><div class="projects_container rposts2 sixteen columns"><div class="smartboxtitle page_title_s2"><hr><span class="page_info_title_s2">'. $title . '</span><div class="pag-proj2_s2"><div class="goto_blog"  onclick="window.location = \''.$link_to_blog.'\';" title="'.$title_to_blog_link.'"></div></div></div><div class="project_list_s2"><div class="slides_container post_listing jcarousel-skin-tango">'.$postes.'</div></div></div><div class="clear"></div></section>';		
			} else {
				return '<section id="recentPosts-' . $randID . '" class="home_widget recentPosts"><div class="projects_container rposts2 sixteen columns"><div class="smartboxtitle page_title_s2 "><hr><span class="page_info_title_s2">'. $title . '</span></div><div class="project_list_s2"><div class="slides_container post_listing jcarousel-skin-tango">'.$postes.'</div></div></div><div class="clear"></div></section>';
			}
		}

} // End des_shortcode_rposts()

add_shortcode( 'rposts', 'des_shortcode_rposts', 90 );





/*-----------------------------------------------------------------------------------*/
/* xx RPosts 2 - [rposts2]
/*-----------------------------------------------------------------------------------*/

function des_shortcode_rposts2 ( $atts, $content = null ) {

		// Instruct the shortcode JavaScript to load.
		if ( ! defined( 'DES_SHORTCODE_JS' ) ) { define( 'DES_SHORTCODE_JS', 'load' ); }

		$defaults = array( 'title' => '', 'category' => 'all', 'total' => -1, 'orderby' => '', 'scroller' => 'yes', 'posts_per_row'=>'3', 'order' => '', 'link_to_blog' => '', 'title_to_blog_link' => '', 'max_chars'=>-1, 'categories'=>'all', 'autoplay'=>'no', 'autoplay_speed'=>'3000' );

		extract( shortcode_atts( $defaults, $atts ) );
		
		$randID = rand();
		$uagent_obj = new uagent_info();
		$postes = "";
		
		if(!empty($title))
			$t = "$title";
		else
			$t = __("Latests Posts", "smartbox");
			
		if(!isset($total) || $total == 0)
  		$total = -1;
				
		
		global $post;
		
		global $more;
			$more = 0;
			
		if ($categories != "all"){
	    	$cats = explode("|*|",$categories);
	    	$thecats = array();
	    	foreach($cats as $c){
	    		if ($c != ""){
	    			array_push($thecats, $c);
	    		}
	    	}
	    }
		
		$args = array(
			'showposts' => -1,
			'orderby' => $orderby,
			'order' => $order,
			'post_status' => 'publish',
			'ignore_sticky_posts' => 1
		);
		
		$columnslayout = "";
		switch($posts_per_row){
			case "2": 
				$columnslayout = "eight columns";
				break;
			case "3": 
				$columnslayout = "one-third column";
				break;
			case "4": 
				$columnslayout = "four columns";
				break;
		}
		$losposts = get_posts($args);
		
		$filteredposts = array();
		if ($categories != "all"){
			foreach ($losposts as $p){
				$postscats = get_the_terms($p->ID, 'category');
				$found = false;
				foreach ($postscats as $pcats){
					foreach ($thecats as $tc){ 
						if ($pcats->slug == $tc) $found = true;	
					}
				}
				if ($found) {
					array_push($filteredposts, $p);
					$losposts = $filteredposts;
				}
			}	
		}
		
	 	$rows = ceil(count($losposts)/$posts_per_row);
	 	$postscounter = $el = 0;
		//query_posts($args);
		foreach ($losposts as $post){
			
			if (($total > -1 && $postscounter < $total) || $total == -1){
				query_posts('p='.$post->ID);
				the_post();
			
				$audio = "";
					 	
			 	if ($scroller == "no" && $el == 0){
				 	$postes .= '<div class="posts_row">';
			 	}
			 	
			 	if ($scroller == "no"){
				 	$postes .= '<div class="'.$columnslayout.'">';
			 	} else {
				 	$postes .= '<li>';
			 	}
			 		 
			 	$postes .= '<div id="post-' . get_the_ID() . '" class="slides-item post no-flicker"><div class="the_content">';
			 	
			 	$posttype = (get_post_meta(get_the_ID(), 'posttype_value', true)) ? get_post_meta(get_the_ID(), 'posttype_value', true) : "none";
			 	
			 	$postid = get_the_ID();
			 	
			 	switch($posttype){
				 	case "image": case "text": case "audio":
				 		
				 		if (wp_get_attachment_url( get_post_thumbnail_id($postid))){
					 		$postes .= '<div class="posttype_preview eight columns alpha"><img src="'. wp_get_attachment_url( get_post_thumbnail_id($postid)) .'" title="'. get_the_title() .'" style="position: relative; float: left; height: 140px; width: auto;" /></div>';
					 		$postes .= '<div class="title_content eight columns omega">';
				 		} else {
					 		$postes .= '<div class="title_content">';
				 		}
				 		
				 	break;
				 	case "slider":
				 		$postes .= '<div class="posttype_preview eight columns alpha">'; 
				 		$randClass = rand(0,1000);
				 		
				 		$postes .= '<div class="flexslider '.$posttype.'" id="flex-'.$randClass.'" style="height: 140px;"><ul class="slides">';
				 		
				 		$sliderData = get_post_meta($postid, "sliderImages_value", true);
						$slide = explode("|*|",$sliderData);
					    foreach ($slide as $s){
					    	if ($s != ""){
					    		$url = explode("|!|",$s);
					    		$postes .= '<li>';
					    		if (get_option(DESIGNARE_SHORTNAME."_enlarge_images") == "on"){
						    		$postes .= '<a href="'.$url[1].'" rel="prettyPhoto[pp_gal-'.$randClass.']" >';
					    		}
					    		$postes .= '<img src="'.$url[1].'" alt="" class="rp_style1_img" style="height: 140px; width: auto;" />';
					    		if (get_option(DESIGNARE_SHORTNAME."_enlarge_images") == "on"){
						    		$postes .= '</a>';
					    		}
					    		$postes .= '</li>';
					    	}
					    }
					    $postes .= '</ul>';
					    if (get_option(DESIGNARE_SHORTNAME."_enlarge_images") == "on"){
							$postes .= '<div class="mask" onclick="$(this).siblings(\'.flex_this_thumb\').trigger(\'click\');"><div class="more" onclick="$(this).parents(\'.featured-image-thumb\').find(\'.flex_this_thumb\').click();"></div></div>';
						}
				 		$postes .= '</div></div>';
				 		$postes .= '<div class="title_content eight columns omega">';
				 	break;
				 	case "video":
				 		$postes .= '<div class="video-thumb eight columns alpha" style="height: 147px;">'; 
						$videosType = get_post_meta($postid, "videoSource_value", true);
						$videos = get_post_meta($postid, "videoCode_value", true);
						$videos = preg_replace( '/\s+/', '', $videos );
						$vid = explode(",",$videos);
						switch (get_post_meta($postid, "videoSource_value", true)){
							case "youtube":
								foreach ($vid as $v){
									$postes .= '<iframe style="height: 140px;" width="100%" src="http://www.youtube.com/embed/'.$v.'?autoplay=0&amp;wmode=transparent&amp;autohide=1&amp;showinfo=0&amp;rel=0" frameborder="0" allowfullscreen=""></iframe>';
								}
							break;
							case "vimeo":
								foreach ($vid as $v){
									$postes .= '<iframe style="height: 140px;" width="100%" src="http://player.vimeo.com/video/'.$v.'?autoplay=0&amp;title=0&amp;byline=0&amp;portrait=0" frameborder="0" allowfullscreen=""></iframe>';
								}
							break;
						}
				 		$postes .= '</div>';
				 		$postes .= '<div class="title_content eight columns omega">';
				 	break;
				 	case "none":
				 		$postes .= '<div class="title_content">';
				 	break;
			 	}
			 	
			 	if ($posttype != "none" && $posttype != "") $postes .= '<div class="post_type '.$posttype.'"><i class="icon-"></i></div>';
			 	
			 	
			 	$postes .= '<div class="title_date" style="position: relative; left: 10px;"><div class="date"'; 
			 	if ($posttype == "none" || $posttype == "") $postes .= ' style="border-radius: 3px; -webkit-border-radius: 3px; -moz-border-radius: 3px; -o-border-radius: 3px; -ms-border-radius: 3px;"';
			 	$postes .= '>' . get_the_date("d") . ' ' . get_the_date("F") . ', ' . get_the_date("Y") . '</div></div>';
			 						
				$postes .= '<div class="the_title"><a href="'. get_permalink() . '">'. get_the_title() .'</a></div>';
							
				$textcontent = "";
				$char = 0;
				$idx = 0;
				if ($max_chars > 0){
					$textcontent = get_the_content();
					$textcontent = strip_shortcodes($textcontent);
					$textcontent = strip_tags($textcontent);
					$the_str = substr($textcontent, 0, $max_chars);
		
					if (strlen($textcontent) > $max_chars){
						$textcontent = $the_str."...";
					} else {
						$textcontent = get_the_content();
					}
				} else {
					$textcontent = get_the_excerpt();
				}
				
				
				$postes .= '<div class="the_content"><p>'.$textcontent.' <span class="rp_readmore"><a href="'.get_permalink().'">'.__(get_option(DESIGNARE_SHORTNAME."_read_more"),'smartbox').'</a></span>'.'</p>'.'</div>';
				
				
				$postes .= '</div></div></div>';
		
				if ($scroller == "yes"){
					$postes .= '</li>';	
				} else {
					$postes .= '</div>';
				}
					
				if ($scroller == "no"){
					$el = $el + 1;
					if ($el == $posts_per_row){
						$postes .= "</div>";
						$el = 0;
					}
				}
				$postscounter++;
			}
		
		}
		
		$autoplay_output = "";
		if ($autoplay === "yes"){
			$autoplay_output  = ", autoSlide: true, autoSlideInterval: ".intval($autoplay_speed, 10)."";	
		}
			
		if ($scroller == "yes"){
			wp_enqueue_script( 'carrossel', DESIGNARE_JS_PATH .'jquery.jcarousel.min.js', array(),'1.0',$in_footer = true);
			if ($link_to_blog != ""){
				return '<section id="recentPosts-' . $randID . '" class="home_widget recentPosts_style2 recent_testimonials"><div class="projects_container rposts2 sixteen columns"><div class="smartboxtitle page_title_s2"><hr><span class="page_info_title_s2">'. $title . '</span><div class="pag-proj2_s2"><div class="nextbutton carousel-control next carousel-next jcarousel-next jcarousel-next-horizontal"></div><div class="goto_blog"  onclick="window.location = \''.$link_to_blog.'\';" title="'.$title_to_blog_link.'"></div><div class="prevbutton carousel-control previous carousel-previous jcarousel-prev jcarousel-prev-horizontal"></div></div></div><div class="project_list_s2_style2" ><ul class="slides_container post_listing jcarousel-skin-tango">'.$postes.'</ul></div></div><script type="text/javascript">jQuery(document).ready(function($){jQuery("#recentPosts-'.$randID.' .slides_container").parent().carousel({dispItems: 1'.$autoplay_output.'});});</script><div class="clear"></div></section>';		
			} else {
				return '<section id="recentPosts-' . $randID . '" class="home_widget recentPosts_style2 recent_testimonials"><div class="projects_container rposts2 sixteen columns"><div class="smartboxtitle page_title_s2 "><hr><span class="page_info_title_s2">'. $title . '</span><div class="pag-proj2_s2"><div class="nextbutton carousel-control next carousel-next jcarousel-next jcarousel-next-horizontal"></div><div class="prevbutton carousel-control previous carousel-previous jcarousel-prev jcarousel-prev-horizontal"></div></div></div><div class="project_list_s2_style2" style="width:100%;"><ul class="slides_container post_listing jcarousel-skin-tango">'.$postes.'</ul></div></div><script type="text/javascript">jQuery(document).ready(function($){jQuery("#recentPosts-'.$randID.' .slides_container").parent().carousel({dispItems: 1'.$autoplay_output.'});});</script><div class="clear"></div></section>';
			}	
		} else {
			if ($link_to_blog != ""){
				return '<section id="recentPosts-' . $randID . '" class="home_widget recentPosts_style2"><div class="projects_container rposts2 sixteen columns"><div class="smartboxtitle page_title_s2"><hr><span class="page_info_title_s2">'. $title . '</span><div class="pag-proj2_s2"><div class="goto_blog"  onclick="window.location = \''.$link_to_blog.'\';" title="'.$title_to_blog_link.'"></div></div></div><div class="project_list_s2_style2"><div class="slides_container post_listing jcarousel-skin-tango">'.$postes.'</div></div></div><div class="clear"></div></section>';		
			} else {
				return '<section id="recentPosts-' . $randID . '" class="home_widget recentPosts_style2"><div class="projects_container rposts2 sixteen columns"><div class="smartboxtitle page_title_s2 "><hr><span class="page_info_title_s2">'. $title . '</span></div><div class="project_list_s2_style2"><div class="slides_container post_listing jcarousel-skin-tango">'.$postes.'</div></div></div><div class="clear"></div></section>';
			}
		}

}

add_shortcode( 'rposts2', 'des_shortcode_rposts2', 90 );


/*-----------------------------------------------------------------------------------*/
/* xx Custom Sidebars - [custom_sidebar]
/*-----------------------------------------------------------------------------------*/

function des_shortcode_custom_sidebar ( $atts, $content = null ) {

		// Instruct the shortcode JavaScript to load.
		if ( ! defined( 'DES_SHORTCODE_JS' ) ) { define( 'DES_SHORTCODE_JS', 'load' ); }

		$defaults = array( 'id' => 'Sidebar Widgets' );

		extract( shortcode_atts( $defaults, $atts ) );
		
		return des_get_sidebar($id);

} // End des_shortcode_custom_sidebars()

add_shortcode( 'custom_sidebar', 'des_shortcode_custom_sidebar', 90 );

/*-----------------------------------------------------------------------------------*/
/* xx Custom Slider - [custom_slider]
/*-----------------------------------------------------------------------------------*/

function des_shortcode_custom_slider ( $atts, $content = null ) {

		// Instruct the shortcode JavaScript to load.
		if ( ! defined( 'DES_SHORTCODE_JS' ) ) { define( 'DES_SHORTCODE_JS', 'load' ); }

		$defaults = array( 'id' => '', 'height' => 300, 'effect' => 'fade', 'navigation' => 'false', 'control_navigation'=>'false', 'pause_on_hover'=>'false','speed' => 3000 );

		extract( shortcode_atts( $defaults, $atts ) );
		
		$plus1="";
		if($effect == 'slide') $plus1 = "+1";
		
		$coll = designare_get_slider_data($id);
		$li="";
		$randID = rand();
			
		if (empty($height) || !isset($height)) $height = "300px";
			
		foreach($coll['posts'] as $c){

				$p_url = get_post_meta($c->ID, 'custom_image_url');
				$p_title = get_post_meta($c->ID, 'custom_desctitle');
				$p_desc = get_post_meta($c->ID, 'custom_desctext');
				$p_link = get_post_meta($c->ID, 'custom_imagelink');

				
				if(empty($p_link[0]))
					$p_link[0] = "javascript:;";
					
				if(empty($p_title[0])){
					$li .= "<li><a href='".$p_link[0]."'><img src='".$p_url[0]."' alt='' "; 
					//if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') == false) $li .= "height='".$height."px'";
					$li .= "></a>"; 
					if ($p_title[0] != "" || $p_desc[0] != "")
						$li .= "<p class='flex-caption'>"; 
					if ($p_title[0] != "")
						$li .= "<span class='caption-title'>".$p_title[0] . "</span>"; 
					if ($p_desc[0] != "")
						$li .= "<span class='caption-content'>" . nl2br($p_desc[0])."</span>"; 
					if ($p_title[0] != "" || $p_desc[0] != "")
						$li .= "</p>";
					$li .= "</li>";
				} else {
					$li .= "<li><a href='".$p_link[0]."'><img src='".$p_url[0]."' alt='' ";
					//if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') == false) $li .= "height='".$height."px'";
					$li .= "></a>"; 
					if ($p_title[0] != "" || $p_desc[0] != "")
						$li .= "<p class='flex-caption'>"; 
					if ($p_title[0] != "")
						$li .= "<span class='caption-title'>".$p_title[0] . "</span>"; 
					if ($p_desc[0] != "")
						$li .= "<span class='caption-content'>" . nl2br($p_desc[0])."</span>"; 
					if ($p_title[0] != "" || $p_desc[0] != "")
						$li .= "</p>";
					$li .= "</li>";	
				}
		}
		wp_enqueue_script( 'flex', DESIGNARE_JS_PATH .'jquery.flexslider-min.js', array(), '1',$in_footer = true);
		return '<div id="myslider-'.$randID.'" class="flexslider clearfix" style="max-height:'.$height.';"><ul class="slides">'.$li.'</ul></div><script type="text/javascript">jQuery(document).ready(function($){ $(\'#myslider-'.$randID.'\').flexslider({animation: "'.$effect.'",slideDirection: "vertical",directionNav: '.$navigation.',slideshowSpeed: '.$speed.', controlsContainer: \'#myslider-'.$randID.' .flex-container\',pauseOnAction: false,pauseOnHover: '.$pause_on_hover.',keyboardNav: false,controlNav: '.$control_navigation.', start: function(slider) { $(slider).find(\'li\').each(function(){ if ($(this).children(\'a\').href != "javascript:;"){$(this).children(\'a\').children(\'img\').click(function(){window.location = $(this).parent(\'a\').attr(\'href\');$(this).parent(\'a\').attr(\'href\',\'javascript:;\');});}}); $("#myslider-'.$randID.' .slides li").eq(slider.currentSlide'.$plus1.').find(".flex-caption").animate({\'opacity\' : 1}, 500);} ,after: function(slider) { $("#myslider-'.$randID.'").find(".flex-direction-nav").click(function(){ window.location = $("#myslider-'.$randID.' .slides li").eq(slider.currentSlide'.$plus1.').children("a").attr("href"); });  $("#myslider-'.$randID.' .slides li").find(".flex-caption").each(function(){$(this).css(\'opacity\', 0); if($(this).parent().hasClass(\'clone\')){}else{$(this).animate({\'opacity\' : 0}, 500);}});$("#myslider-'.$randID.' .slides li").eq(slider.currentSlide'.$plus1.').find(".flex-caption").animate({\'opacity\' : 1}, 500);}}); });</script>';

} // End des_shortcode_custom_slider()

add_shortcode( 'custom_slider', 'des_shortcode_custom_slider', 90 );


/*-----------------------------------------------------------------------------------*/
/* 16. Tabs - [tabs][/tabs]
/*-----------------------------------------------------------------------------------*/

function des_shortcode_tabs ( $atts, $content = null ) {

		// Instruct the shortcode JavaScript to load.
		if ( ! defined( 'DES_SHORTCODE_JS' ) ) { define( 'DES_SHORTCODE_JS', 'load' ); }

		$defaults = array( 'style' => 'default', 'title' => '', 'css' => '' );

		extract( shortcode_atts( $defaults, $atts ) );

		if ( $css != '' ) { $css = ' ' . $css; }

		preg_match_all( '/tab title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );
		preg_match_all( '/icon="([^\"]+)"/i', $content, $icons, PREG_OFFSET_CAPTURE );

		$tab_titles = array();
		$tabs_class = 'tabs';
		

		if ( isset( $matches[1] ) ) { $tab_titles = $matches[1]; }
		if ( isset( $icons[1] ) ) { $tab_icons = $icons[1]; }

		$titles_html = '';

		if ( count( $tab_titles ) ) {
			
			$thetitle = "";
			if ( $title ) {
				$thetitle = "<div class='smartboxtitle'><hr/><span>".$title."</span></div>";
			}

			$titles_html .= '<ul class="' . $tabs_class . '" id="tabslist">' . "\n";

				$counter = 1;

				foreach ( $tab_titles as $t ) {

					$titles_html .= '<li onclick="changeTab(this);"><a href="javascript:;" ';
						
					if ($tab_icons[$counter-1][0] === "icon-icon1") $output = "";
					else {
						$output = "<i "; 
						if (strlen($t[0])==1) $output .= "style='padding-right:0px;'";
						$output .= "class='".$tab_icons[$counter-1][0]."'></i>";
					}
					
					$titles_html .= '>' . $output . $t[0] . '</a></li>' . "\n";

					$counter++;

				}

			$titles_html .= '</ul>' . "\n";

		}		
		return $thetitle.'<div id="tabs" class="shortcode-tabs ' . $style . $css . '">' . $titles_html . '<div class="panes">' . do_shortcode( $content ) . '</div></div>';

} // End des_shortcode_tabs()

add_shortcode( 'tabs', 'des_shortcode_tabs', 90 );

/*-----------------------------------------------------------------------------------*/
/* 16.1 A Single Tab - [tab title="The title goes here"][/tab]
/*-----------------------------------------------------------------------------------*/

function des_shortcode_tab_single ( $atts, $content = null ) {

		$defaults = array( 'title' => 'Tab', 'id' => '' );

		extract( shortcode_atts( $defaults, $atts ) );

		$class = '';

		if ( $title != 'Tab' ) {

			$class = ' tab-' . sanitize_title( $title );

		} // End IF Statement

		return '<div><p>' . do_shortcode( $content ) . '</p></div>';

} // End des_shortcode_tab_single()

add_shortcode( 'tab', 'des_shortcode_tab_single', 99 );


/*-----------------------------------------------------------------------------------*/
/* 16.2 Tabs maravilha - [special_tabs title="The title goes here"][/special_tabs]
/*-----------------------------------------------------------------------------------*/

function des_shortcode_special_tabs($atts, $content = null){

	// Instruct the shortcode JavaScript to load.
	if ( ! defined( 'DES_SHORTCODE_JS' ) ) { define( 'DES_SHORTCODE_JS', 'load' ); }

	$defaults = array('title' => '');

	extract( shortcode_atts( $defaults, $atts ) );
	
	$output = "";
	
	if ($title!= ""){
		$output = "<div class='smartboxtitle title'>".$title."</div>";
	} 
	
	$randomID = rand(0,10000);
	
	$accordion = '<div class="shortcode-accs acc-substitute default">';
	
	$accordion .= specialtabs_to_tabs($content);
	
	$accordion .= '</div>';
	
	return $output."<section class='container special_tabs'>".do_shortcode($content)."<div class='clear'></div></section>\n".$accordion."\n";
}

add_shortcode('special_tabs', 'des_shortcode_special_tabs', 90);	

/*-----------------------------------------------------------------------------------*/
/* 16.2.x Tabs maravilha items - [special_tab title="" icon="" icon_url=""]  [/special_tab]
/*-----------------------------------------------------------------------------------*/

function des_shortcode_special_tab($atts, $content = null){
	
	// Instruct the shortcode JavaScript to load.
	if ( ! defined( 'DES_SHORTCODE_JS' ) ) { define( 'DES_SHORTCODE_JS', 'load' ); }

	$defaults = array('title' => '', 'icon' => 'glass');
	
	extract(shortcode_atts( $defaults, $atts));
	
	$rand = rand(0,10000);
	
	if ($icon == "icon1") $icon = "";
	else $icon = "<div class='designare_icon_special_tabs'><i class='icon-".$icon."' ></i></div>";
	
	//$ua = get_browser();
	$output = "<div class='label ".$rand."'>".$icon."<span class='tab_title'>".$title."</span></div><div class='content ".$rand."'><p>".do_shortcode($content)."</p></div>";
	
	return $output;
	
}

add_shortcode('special_tab','des_shortcode_special_tab',99);

/*-----------------------------------------------------------------------------------*/
/* xx Accordion - [acc][/acc]
/*-----------------------------------------------------------------------------------*/

function des_shortcode_accordion ( $atts, $content = null ) {

		// Instruct the shortcode JavaScript to load.
		if ( ! defined( 'DES_SHORTCODE_JS' ) ) { define( 'DES_SHORTCODE_JS', 'load' ); }

		$defaults = array( 'style' => 'default', 'title' => '', 'css' => '' );

		extract( shortcode_atts( $defaults, $atts ) );

		if ( $css != '' ) { $css = ' ' . $css; }

		// Extract the tab titles for use in the tabber widget.
		preg_match_all( '/section title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );

		$acc_titles = array();
		$accs_class = 'acc_titles';

		if ( isset( $matches[1] ) ) { $acc_titles = $matches[1]; } // End IF Statement

		$titles_html = '';

		if ($title != ""){
			$titles_html = "<div class='smartboxtitle'><span>".$title."</span><hr/></div>";
		}

		if ( count( $acc_titles ) ) {
			$counter = 1;
			foreach ( $acc_titles as $t ) {
				$counter++;
			} // End FOREACH Loop
		} // End IF Statement

		return $titles_html .'<div id="accordion" class="shortcode-accs ' . $style . $css . '">' . do_shortcode( $content ) . '</div>';

} // End des_shortcode_tabs()

add_shortcode( 'acc', 'des_shortcode_accordion', 90 );

/*-----------------------------------------------------------------------------------*/
/* xx.x A Single Section - [section title="The title goes here"][/section]
/*-----------------------------------------------------------------------------------*/

function des_shortcode_acc_single ( $atts, $content = null ) {

		$defaults = array( 'title' => '', 'id' => '', 'icon'=>'' );

		extract( shortcode_atts( $defaults, $atts ) );

		$class = '';

		if ( $title != 'Accordion' ) {

			$class = ' acc-' . sanitize_title( $title );

		} // End IF Statement
		
		if($id == 'sec-1'){
			$style = 'style="display:block"';
			//$curr = 'class="current"';
		}
		else{
			$style = '';
			$curr = '';
		}
		
		if ($icon != "icon-icon1"){
			$icon = "<i class='".$icon."'></i>";
		} else $icon="";

		return '<div class="acc-title"><h2 class="">'.$icon.$title.'</h2></div><div class="pane acc-sec' . $class . '" ' . $style . '><p>' . do_shortcode( $content ) . '</p></div>';

} // End des_shortcode_tab_single()

add_shortcode( 'section', 'des_shortcode_acc_single', 99 );

/*-----------------------------------------------------------------------------------*/
/* xx Team - [team][/team]
/*-----------------------------------------------------------------------------------*/

function des_shortcode_team ( $atts, $content = null ) {

	// Instruct the shortcode JavaScript to load.
	if ( ! defined( 'DES_SHORTCODE_JS' ) ) { define( 'DES_SHORTCODE_JS', 'load' ); }

	$defaults = array( 'title' => ' ', 'members_per_row'=>'', 'scroller'=>'yes', 'css' => '', 'nshow'=>'', 'categories'=>'all', 'autoplay'=>'no', 'autoplay_speed' => '3000' );

	extract( shortcode_atts( $defaults, $atts ) );

	if(empty($nshow) || $nshow == 0 )
    	$nshow = -1;

	if ( $css != '' ) { $css = ' ' . $css; }

	$team_class = 'team_titles';
	
	$randID = rand();

	$titles_html = '';

	$output = '<section id="team-' . $randID . '" class="shortcode-team' . $css . '">';

	if ($scroller == "yes"){
		wp_enqueue_script( 'carrossel', DESIGNARE_JS_PATH .'jquery.jcarousel.min.js', array(),'1.0',$in_footer = true);
		$output .= '<div class="team_header smartboxtitle"><hr><span>' . esc_html( $title ) . '</span><div class="pag-proj_team">
			<div class="nextbutton carousel-control next carousel-next jcarousel-next jcarousel-next-horizontal"></div>
			<div class="prevbutton carousel-control previous carousel-previous jcarousel-prev jcarousel-prev-horizontal"></div>
		</div></div>';
	} else {
		if ($title != "")
			$output .= '<h2 class="team_header smartboxtitle sixteen columns" style="min-height:20px;"><hr><span>' . esc_html( $title ) . '</span></h2>';
	}
	
	if ($scroller == "yes")
		$output .= "<div class='team-carousel'><ul class='team-items'>";
	
	switch($members_per_row){
		case "2": 
			$columnslayout = "eight columns";
			break;
		case "3": 
			$columnslayout = "one-third column";
			break;
		case "4": 
			$columnslayout = "four columns";
			break;
	}
	
	if (!function_exists('icl_object_id')){
	
		if ($categories != "all"){
	    	$cats = explode("|*|",$categories);
	    	$thecats = array();
	    	foreach($cats as $c){
	    		if ($c != ""){
	    			array_push($thecats, $c);
	    		}
	    	}
	    }
	
		$args = array(
			'numberposts' => $nshow,
			'orderby' => 'post_date',
			'order' => 'DESC',
			'post_type' => 'team',
			'post_status' => 'publish' 
		);
			
		$team = get_posts( $args );
		$filteredteam = array();
		
		if ($categories != "all"){
			foreach ($team as $t){
				$teamcats = get_the_terms($t->ID, 'team_category');
				$found = false;
				if ($teamcats != "" && is_array($teamcats)){
					foreach ($teamcats as $ttcats){
						foreach ($thecats as $tc){
							if ($ttcats->slug == $tc) $found = true;	
						}
					}
					if ($found) {
						array_push($filteredteam, $t);
						$team = $filteredteam;
					}					
				}
			}			
		}

	} else {
		if ($categories != "all"){
	    	$cats = explode("|*|",$categories);
	    	$thecats = array();
	    	foreach($cats as $c){
	    		if ($c != ""){
	    			array_push($thecats, $c);
	    		}
	    	}
	    }
		global $wpdb, $table_prefix;
		if ($nshow != -1)
			$query = "SELECT element_id FROM ".$table_prefix."icl_translations WHERE language_code = '".ICL_LANGUAGE_CODE."' AND element_type='post_team' LIMIT 0,".$nshow;
		else
			$query = "SELECT element_id FROM ".$table_prefix."icl_translations WHERE language_code = '".ICL_LANGUAGE_CODE."' AND element_type='post_team'"; 
		$results = $wpdb->get_results($query, ARRAY_A);
		$team = array();
		foreach($results as $res){
			array_push($team, get_post( $res['element_id'] ));
		}
		$filteredteam = array();
		if ($categories != "all"){
			foreach ($team as $t){
				$teamcats = get_the_terms($t->ID, 'team_category');
				$found = false;
				if ($teamcats != "" && is_array($teamcats)){
					foreach ($teamcats as $ttcats){
						foreach ($thecats as $tc){
							if ($ttcats->slug == $tc) $found = true;	
						}
					}
					if ($found) {
						array_push($filteredteam, $t);
						$team = $filteredteam;
					}	
				}
			}	
		}
	}

	
	if ($scroller == "no") {
		$rows = ceil(count($team)/$members_per_row);
		$el = 0;
		foreach ($team as $t){
			if ($el == 0) {
				$output .= "<div class='team-row ".$members_per_row."'>";
			}
			$html = wpautop(do_shortcode($t->post_content), true);
			$output .= "<div class='team-member ".$columnslayout."'><div class='teamimg'><img class='scale-with-grid' alt='".$t->post_title."' title='".$t->post_title."' src='".wp_get_attachment_url( get_post_thumbnail_id($t->ID))."'></div><div class='team_content'><h4 class='member_name'>".$t->post_title."</h4>".$html."</div></div>";
			$el++;
			if ($el == $members_per_row){
				$output .= "</div>";
				$el = 0;
			}
		}
	}
	
	foreach($team as $t){
		if ($scroller == "yes"){
			$html = wpautop(do_shortcode($t->post_content), true);
			$output .= "<li class='team-member' style='margin:0 17px 0 0;'><div class='teamimg'><img class='scale-with-grid' alt='".$t->post_title."' title='".$t->post_title."' src='".wp_get_attachment_url( get_post_thumbnail_id($t->ID))."'></div><div class='team_content'><h4 class='member_name'>".$t->post_title."</h4><p>".$html."</p></div></li>";
		}
	}
	
	$autoplay_output = "";
	if ($autoplay === "yes"){
		$autoplay_output  = ", autoSlide: true, autoSlideInterval: ".intval($autoplay_speed, 10)."";	
	}
	
	if ($scroller == "yes") {
		$output .= "</ul></div>";
		$output .= "
			<script type='text/javascript'>
				jQuery(window).load(function(){
					jQuery('#team-".$randID."').find('.team-carousel').carousel({dispItems:1".$autoplay_output."});
				});
			</script>
		";
	}
	
	$output .= "<div class='clear'></div></section>";
	
	return $output;

} // End des_shortcode_tabs()

add_shortcode( 'team', 'des_shortcode_team', 90 );

/*-----------------------------------------------------------------------------------*/
/* xx.x A Single Person - [person][/person]
/*-----------------------------------------------------------------------------------*/

function des_shortcode_team_single ( $atts, $content = null ) {

		$defaults = array( 'name' => '', 'role' => '', 'image_url' => '', 'facebook_user' => '', 'twitter_user' => '' );

		extract( shortcode_atts( $defaults, $atts ) );

		$class = '';
		
		if(!empty($facebook_user)) $facebook_user = '<p onclick="window.open(\'http://www.facebook.com/' . $facebook_user . '\')" class="person-facebook">face</p>';
		if(!empty($twitter_user)) $twitter_user = '<p onclick="window.open(\'http://www.twitter.com/' . $twitter_user . '\')" class="person-twitter">twitter</p>';

return '<li class="team-box"><a href="javascript:;"><img src="' . $image_url . '" class="scale-with-grid" height="300"><div><span><h4 class="person_name">' . $name . '</h4><h5 class="person_role">' . $role . '</h5><p class="person-desc">' .  $content . '</p>'. $facebook_user . '' . $twitter_user . '</span></div></a></li>';
} // End des_shortcode_tab_single()

add_shortcode( 'person', 'des_shortcode_team_single', 99 );

/*-----------------------------------------------------------------------------------*/
/* xx Services - [service][/service]
/*-----------------------------------------------------------------------------------*/

function des_shortcode_services ( $atts, $content = null ) {

		// Instruct the shortcode JavaScript to load.
		if ( ! defined( 'DES_SHORTCODE_JS' ) ) { define( 'DES_SHORTCODE_JS', 'load' ); }

		$defaults = array( 'style' => 'default', 'items_per_row' => '', 'icons_size'=>'','css' => '' );

		extract( shortcode_atts( $defaults, $atts ) );

		if ( $css != '' ) { $css = ' ' . $css; }

		$output = "<div id='service-" . rand(1, 100) . "' class='shortcode-services " . $style . $css . "'><ul class='service-items"; 
		if ($icons_size === "big") $output .= " bigicons"; 
		$output .= " itemsPerRow-".$items_per_row."'>".do_shortcode($content)."</ul><div class='fix'></div></div>";

		return $output;

} // End des_shortcode_tabs()

add_shortcode( 'service', 'des_shortcode_services', 90 );

/*-----------------------------------------------------------------------------------*/
/* xx.x A Single Item - [item][/item]
/*-----------------------------------------------------------------------------------*/

function des_shortcode_service_single ( $atts, $content = null ) {

		$defaults = array( 'title' => '', 'icon' => '');

		extract( shortcode_atts( $defaults, $atts ) );
		
		$i="";
		
		if(preg_match('/(?i)msie [1-9]/',$_SERVER['HTTP_USER_AGENT'])) {
		   	$i .= "<div class='designare_icon'><img alt='' src='" . get_template_directory_uri() . "/img/designare_icons/" . $icon . ".png' title='" . $title . " photo' class='designare_icon ie'></div>";
		} else {
		   	$i .= "<div class='designare_icon'><img alt='' src='" . get_template_directory_uri() . "/img/designare_icons/" . $icon . ".svg' title='" . $title . "' class='designare_icon'></div>";	
		}
		
   	
		$class = '';

		return "<li class='service-item no-flicker'>" . $i . "<p class='item-title'>" . $title . "</p><p class='item-desc'>" . do_shortcode( $content ) . "</p></li>";

} // End des_shortcode_tab_single()

add_shortcode( 'item', 'des_shortcode_service_single', 99 );


/*-----------------------------------------------------------------------------------*/
/* xx Services - [servicefa][/servicefa]
/*-----------------------------------------------------------------------------------*/

function des_shortcode_servicesfa ( $atts, $content = null ) {

		// Instruct the shortcode JavaScript to load.
		if ( ! defined( 'DES_SHORTCODE_JS' ) ) { define( 'DES_SHORTCODE_JS', 'load' ); }

		$defaults = array( 'style' => 'default', 'items_per_row' => '', 'css' => '');
		
		global $des_sfa;
		if (empty($des_sfa)) $des_sfa = 0;

		global $des_delay;
		if (empty($des_delay)) $des_delay = 0;

		extract( shortcode_atts( $defaults, $atts ) );

		if ( $css != '' ) { $css = ' ' . $css; }

		$output = "<div id='service-" . rand(1, 100) . "' class='shortcode-services " . $style . $css . "'><ul class='service-items"; 

		$output .= " itemsPerRow-".$items_per_row."'>" . do_shortcode( $content ) . "</ul>" . "<div class='fix'></div></div>";

		$des_sfa++;
		$des_delay = 0;
		
		return $output;

} // End des_shortcode_tabs()

add_shortcode( 'servicefa', 'des_shortcode_servicesfa', 90 );

/*-----------------------------------------------------------------------------------*/
/* xx.x A Single Item - [itemfa][/itemfa]
/*-----------------------------------------------------------------------------------*/

function des_shortcode_service_singlefa ( $atts, $content = null ) {

		$defaults = array( 'title' => '', 'icon' => '', 'color'=>'#00000', 'seq'=>'', 'a_fffect'=>'', 'style_bg'=>'none', 'background'=>'','border'=>'' );
		extract( shortcode_atts( $defaults, $atts ) );
		
		global $des_delay, $des_sfa;
	
		$i="";
		if ($style_bg != "none"){
			$style_bg = strtolower($style_bg);
			$style = "";
			$font_size = "30px";
			$anim_delay_style = "";
			$anim_delay = "";
			if (strtolower($seq) == "yes"){
				if ($des_delay != 0){
					$anim_delay_style = " style=\"-webkit-animation-delay: $des_delay"."s;-moz-animation-delay: $des_delay"."s;-ms-animation-delay: $des_delay"."s;-o-animation-delay: $des_delay"."s;\"";
					$anim_delay = "-webkit-animation-delay: $des_delay"."s;-moz-animation-delay: $des_delay"."s;-ms-animation-delay: $des_delay"."s;-o-animation-delay: $des_delay"."s;";
				}
				$des_delay = $des_delay + .3;
			}
			if ($style_bg === "none" || $style_bg === ""){
				$i .= "<p class='designare_icon $a_fffect' $anim_delay><i style='color:$color;background-color:none !important;' class='icon-" . $icon . "' title='" . $title . "'></i>";				
				return "<li class='service-item no-flicker'>" . $i . "<p class='item-title'>" . $title . "</p><p class='item-desc'>" . do_shortcode( $content ) . "</p></li>";
			} else {
				if ($style_bg === "rounded") $style .= "font-size:13px;border-radius:.5em !important;-moz-border-radius:.5em !important;-webkit-border-radius:.5em !important;-ms-border-radius:.5em !important;-o-border-radius:.5em !important;";
				if ($style_bg === "circle") $style .= "border-radius:$font_size;-moz-border-radius:$font_size;-webkit-border-radius:$font_size;-ms-border-radius:$font_size;-o-border-radius:$font_size;";	
				$i .= "<p class='designare_icon $a_fffect' style='$anim_delay width:45px;height:45px;background-color:$background !important;border:$border;$style'><i style='font-size: 1.5em;top: 11px;color:$color;padding-right:0px !important;' class='icon-" . $icon . "' title='" . $title . "'></i>";
				return "<li class='service-item no-flicker'>" . $i . "<div class='text_container'><p class='item-title'>" . $title . "</p><p class='item-desc'>" . do_shortcode( $content ) . "</p></div></li>";
			}
		}

} // End des_shortcode_tab_single()

add_shortcode( 'itemfa', 'des_shortcode_service_singlefa', 99 );

/*-----------------------------------------------------------------------------------*/
/* Google Maps - [googlemaps][/googlemaps]
/*-----------------------------------------------------------------------------------*/

function des_shortcode_googlemaps ( $atts, $content = null ) {

	$defaults = array( 'lat' => '', 'long' => '', 'border' => '', 'width' => '100%', 'height' => '');

	extract( shortcode_atts( $defaults, $atts ) );
	wp_enqueue_script('google-maps', 'http://maps.google.com/maps/api/js?sensor=false', array(),'',$in_footer = true);
	if($height == '')
		$h = "300";
	else
		$h = $height;
	
	if($border == 'yes'){
		$css = "border: 3px solid #eee";
	}
	else
		$css = "";
		
	$pos = strpos($width, "%");
 
    if($pos === false) $w2 = $width. "px"; else $w2 = $width;
    
    $w = "100%";
		
	$map = "http://maps.googleapis.com/maps/api/staticmap?center=". $lat . ",".$long."&zoom=12&size=" . $w . "x" . $h . "&sensor=false";

	$randomID = rand();

	return '<div class="mapelas" id="map-'.$randomID.'" style="width: '.$w2.'; height: ' . $h . 'px; ' . $css . '"></div><input type="hidden" id="gm_lat" value="' . $lat . '" /><input type="hidden" id="gm_lng" value="' . $long . '" />';

} // End des_shortcode_googlemaps()

add_shortcode( 'googlemaps', 'des_shortcode_googlemaps' );

/*-----------------------------------------------------------------------------------*/
/* Youtube Video - [yvideo][/yvideo]
/*-----------------------------------------------------------------------------------*/

function des_shortcode_yvideo ( $atts, $content = null ) {

	$defaults = array( 'id' => '', 'width' => '', 'height' => '', 'resize' => '' , 'related' => 'yes');

	extract( shortcode_atts( $defaults, $atts ) );
	
	if($resize == 'no'){
		$style = "width='" . $width . "px' height='" . $height . "px'";
	} else {
		$style = "width='100%' height='70%'";
	}
	
	if($related == 'no'){
		$rel = "&amp;rel=0&amp;showinfo=0";
	} else {
		$rel = "";
	}
		
	
	return '<div class="video-wrapper"><iframe src="http://www.youtube.com/embed/' . $id . '?&amp;wmode=transparent'.$rel.'" frameborder="0" ' . $style . '></iframe></div>';

} // End des_shortcode_yvideo()

add_shortcode( 'yvideo', 'des_shortcode_yvideo' );

/*-----------------------------------------------------------------------------------*/
/* Vimeo Video - [vvideo][/vvideo]
/*-----------------------------------------------------------------------------------*/

function des_shortcode_vvideo ( $atts, $content = null ) {

	$defaults = array( 'id' => '', 'width' => '', 'height' => '', 'resize' => '');

	extract( shortcode_atts( $defaults, $atts ) );
	
	if($resize == 'no'){
		$style = "width='" . $width . "px' height='" . $height . "px'";
	} else {
		$style = "width='100%' height='70%'";
	}
	
	return '<div class="video-wrapper"><iframe src="http://player.vimeo.com/video/' . $id . '?autoplay=0&amp;title=0&amp;byline=0&amp;portrait=0" frameborder="0" ' . $style . '></iframe></div>';

} // End des_shortcode_yvideo()

add_shortcode( 'vvideo', 'des_shortcode_vvideo' );

/*-----------------------------------------------------------------------------------*/
/* Testimonials - [testimonials]
/*-----------------------------------------------------------------------------------*/

function des_shortcode_testimonials ( $atts, $content = null ) {

	$defaults = array( 'title' => '', 'nshow' => '', 'a_fffect' => '', 'seq'=> '', 'hideauthor' => '', 'hidecompany' => '', 'scroller'=>'', 'tests_per_row'=>'', 'categories'=>'all', 'autoplay'=>'no', 'autoplay_speed'=>'3000');

	extract( shortcode_atts( $defaults, $atts ) );
	
	static $testimonial_section_id = 1;
	
	if(empty($nshow) || $nshow == 0 ) $nshow = -1;
	//else $nshow++;

    if ($categories != "all"){
    	$cats = explode("|*|",$categories);
    	$thecats = array();
    	foreach($cats as $c){
    		if ($c != ""){
    			array_push($thecats, $c);
    		}
    	}
    }
    
    $args = array(
			'numberposts' => $nshow,
			'orderby' => 'post_date',
			'order' => 'DESC',
			'post_type' => 'testimonials',
			'post_status' => 'publish'
	);
		
	$testi = get_posts( $args );
	$filteredtestis = array();
	if ($categories != "all"){
		foreach ($testi as $t){
			$testcats = get_the_terms($t->ID, 'testimonials_category');
			$found = false;
			foreach ($testcats as $ttcats){
				foreach ($thecats as $tc){
					if ($ttcats->slug == $tc) $found = true;	
				}
			}
			if ($found) {
				array_push($filteredtestis, $t);
				$testi = $filteredtestis;
			}
		}	
	}
		 
	$randid = rand();
	$delay_style = "";
	if (strtolower($seq) == "yes"){
		$testimonials_delay = 0;
	}
	
	if ($scroller == "yes"){
		wp_enqueue_script( 'carrossel', DESIGNARE_JS_PATH .'jquery.jcarousel.min.js', array(),'1.0',$in_footer = true);
		$aux = 1;
    
		if ($title != ""){
			 $r = '
		 	<section class="recent_projects recent_testimonials" id="testimonials-'. $testimonial_section_id .'">
		 		<div class="smartboxtitle page_title_testimonials">
			 		<span class="page_info_title_testimonials">'.$title.'</span>
			 		<hr>
			 		<div class="pag-testimonials">
			 			<div class="nextbutton carousel-control next carousel-next jcarousel-next jcarousel-next-horizontal"></div>
			 			<div class="prevbutton carousel-control previous carousel-previous jcarousel-prev jcarousel-prev-horizontal"></div>
			 		</div>
			 	</div>';
		} else {
			 $r = '
		 	<section class="recent_projects recent_testimonials" id="testimonials-'. $testimonial_section_id .'">
		 		<div class="pag-testimonials">
		 			<div class="nextbutton carousel-control next carousel-next jcarousel-next jcarousel-next-horizontal"></div>
		 			<div class="prevbutton carousel-control previous carousel-previous jcarousel-prev jcarousel-prev-horizontal"></div>
		 		</div>';
		}
	   
	   	$r .= '
		  	<div id="testimonials2" class="home_proj slideContent testimonis-'.$randid.'"><ul class="carousel">';
		  	
		  if (!function_exists('icl_object_id')){
			  foreach($testi as $t){
			  	if ($testimonials_delay != 0){
				  	$delay_style = ' style="-webkit-animation-delay: '.$testimonials_delay.'s;-moz-animation-delay: '.$testimonials_delay.'s;-ms-animation-delay: '.$testimonials_delay.'s;-o-animation-delay: '.$testimonials_delay.'s;"';
			  	}
			  	if (strtolower($seq) == "yes"){ $testimonials_delay = $testimonials_delay + .3; }
		  		$r .= '<li>
		      <div class="slide s' . $aux . '">';
		      	if (wp_get_attachment_url(get_post_thumbnail_id($t->ID)) != "")
			      	$r .= '<div class="featured_image '.$a_fffect.'" '.$delay_style.'><div class="rotate-bg"></div><img title="'.get_post_meta($t->ID, "author_value", true).'" alt="'.get_post_meta($t->ID, "author_value", true).'" src="'.wp_get_attachment_url(get_post_thumbnail_id($t->ID)).'" /></div>';
		      	$r .= '<div class="testi-text">
		      		<p> ' . $t->post_content . '</p>
		      	</div>
		      	<div class="testi-info">';
		      		
		      			if($hideauthor != "yes"){
		      				if (get_post_meta($t->ID, "author_link_value", true) != ""){
			      				$r .= "<span class='author'><a href='".get_post_meta($t->ID, "author_link_value", true)."'>".get_post_meta($t->ID, "author_value", true)."</a></span>";	
		      				}
		      				else {
			      				$r .= "<span class='author'>".get_post_meta($t->ID, "author_value", true)."</span>";		
		      				}
		      			}
		      			if($hideauthor != "yes" && $hidecompany != "yes") $r .= ", ";
		      			if($hidecompany != "yes"){
			      			if (get_post_meta($t->ID, "company_link_value", true) != ""){
				      			$r .= "<span class='company'><a href='".get_post_meta($t->ID, "company_link_value", true)."'>".get_post_meta($t->ID, "company_value", true)."</a></span>";
			      			} else {
				      			$r .= "<span class='company'>".get_post_meta($t->ID, "company_value", true)."</span>";
			      			}
		      			}
		      		
		      	$r .= '</div>
		      </div>
		      </li>';
		      
		      	$aux++;
		      }
		  } else {
			  global $wpdb, $table_prefix;
			  if ($nshow == -1)
				  $query = "SELECT element_id FROM ".$table_prefix."icl_translations WHERE language_code = '".ICL_LANGUAGE_CODE."' AND element_type='post_testimonials'";
			  else $query = "SELECT element_id FROM ".$table_prefix."icl_translations WHERE language_code = '".ICL_LANGUAGE_CODE."' AND element_type='post_testimonials' LIMIT 0,".$nshow; 
			  $results = $wpdb->get_results($query, ARRAY_A);
			  $testemunhos = array();
			  foreach($results as $res){
				  array_push($testemunhos, get_post( $res['element_id'] ));
			  }
			  
			  
		  	$filteredtestis = array();
			if ($categories != "all"){
				foreach ($testemunhos as $t){
					$testcats = get_the_terms($t->ID, 'testimonials_category');
					$found = false;
					foreach ($testcats as $ttcats){
						foreach ($thecats as $tc){
							if ($ttcats->slug == $tc) $found = true;	
						}
					}
					if ($found) {
						array_push($filteredtestis, $t);
						$testi = $filteredtestis;
					}
				}	
				$testemunhos = $filteredtestis;
			}
			  
			  foreach($testemunhos as $t){
			  	if ($testimonials_delay != 0){
				  	$delay_style = ' style="-webkit-animation-delay: '.$testimonials_delay.'s;-moz-animation-delay: '.$testimonials_delay.'s;-ms-animation-delay: '.$testimonials_delay.'s;-o-animation-delay: '.$testimonials_delay.'s;"';
			  	}
			  	if (strtolower($seq) == "yes"){ $testimonials_delay = $testimonials_delay + .3; }
		  		$r .= '<li>
		  		<div class="slide s' . $aux . '">';
		      	if (isset($t)){
			      	if (wp_get_attachment_url(get_post_thumbnail_id($t->ID)) != "")
			      		$r .= '<div class="featured_image '.$a_fffect.'"'.$delay_style.'><div class="rotate-bg"></div><img title="'.get_post_meta($t->ID, "author_value", true).'" alt="'.get_post_meta($t->ID, "author_value", true).'" src="'.wp_get_attachment_url(get_post_thumbnail_id($t->ID)).'" /></div>';
			      		$r .= '<div class="testi-text">
			   			   			<p>'.$t->post_content.'</p>
			      				</div>
			      				<div class="testi-info">';
		      		
		      			if($hideauthor != "yes"){
		      				if (get_post_meta($t->ID, "author_link_value", true) != ""){
			      				$r .= "<span class='author'><a href='".get_post_meta($t->ID, "author_link_value", true)."'>".get_post_meta($t->ID, "author_value", true)."</a></span>";	
		      				}
		      				else {
			      				$r .= "<span class='author'>".get_post_meta($t->ID, "author_value", true)."</span>";		
		      				}
		      			}
		      			if($hideauthor != "yes" && $hidecompany != "yes") $r .= ", ";
		      			if($hidecompany != "yes"){
			      			if (get_post_meta($t->ID, "company_link_value", true) != ""){
				      			$r .= "<span class='company'><a href='".get_post_meta($t->ID, "company_link_value", true)."'>".get_post_meta($t->ID, "company_value", true)."</a></span>";
			      			} else {
				      			$r .= "<span class='company'>".get_post_meta($t->ID, "company_value", true)."</span>";
			      			}
		      			}	      		
		      			$r .= '</div>
		      			</div>
			      </li>';
			      
			      	$aux++;
			      }
		      	}  
		}
		
		$autoplay_output = "";
		if ($autoplay === "yes"){
			$autoplay_output  = ", autoSlide: true, autoSlideInterval: ".intval($autoplay_speed, 10)."";	
		}
			
		$r .= '</ul></div></section>';
		$r .= "<script type=\"text/javascript\"> jQuery(document).ready(function(){ jQuery(\".testimonis-".$randid."\").carousel({dispItems: 1".$autoplay_output."}); }); </script>";
		  

	} else {
		
		$columns = "";
		if (isset($tests_per_row)){
			switch($tests_per_row){
				case "1": $columns = "sixteen columns"; break;
				case "2": $columns = "eight columns"; break;
				case "3": $columns = "one-third column"; break;
				case "4": $columns = "four columns"; break;
			}	
		}
		
		$aux = 1;
    
		if ($title != ""){
			$r = '
		 	<section class="recent_projects recent_testimonials" id="testimonials-'. $testimonial_section_id .'"><div class="smartboxtitle page_title_testimonials"><hr><span class="page_info_title_testimonials">'.$title.'</span></div>';	
		} else {
			$r = '
		 	<section class="recent_projects recent_testimonials" id="testimonials-'. $testimonial_section_id .'">';
		}
		  		 
	   	$r .= '
		  	<div id="testimonials2" class="home_proj slideContent">';
		  		  	
		$el = 0;
		if (!function_exists('icl_object_id')){
			foreach($testi as $t){
		  		if ($el == 0) {
					$r .= "<div class='tests_row'>";
				}
				if ($testimonials_delay != 0){
				  	$delay_style = ' style="-webkit-animation-delay: '.$testimonials_delay.'s;-moz-animation-delay: '.$testimonials_delay.'s;-ms-animation-delay: '.$testimonials_delay.'s;-o-animation-delay: '.$testimonials_delay.'s;"';
			  	}
			  	if (strtolower($seq) == "yes"){ $testimonials_delay = $testimonials_delay + .3; }
				$r .= '<div class="'.$columns.'">
			      <div class="slide s' . $aux . '">';
			      	if (wp_get_attachment_url(get_post_thumbnail_id($t->ID)) != "")
				      	$r .= '<div class="featured_image '.$a_fffect.'"'.$delay_style.'><div class="rotate-bg"></div><img title="'.get_post_meta($t->ID, "author_value", true).'" alt="'.get_post_meta($t->ID, "author_value", true).'" src="'.wp_get_attachment_url(get_post_thumbnail_id($t->ID)).'" /></div>';
			      	$r .= '<div class="testi-text">
			      		<p> ' . $t->post_content . '</p>
			      	</div>
			      	<div class="testi-info">';
			      		
			      			if($hideauthor != "yes"){
			      				if (get_post_meta($t->ID, "author_link_value", true) != ""){
				      				$r .= "<span class='author'><a href='".get_post_meta($t->ID, "author_link_value", true)."'>".get_post_meta($t->ID, "author_value", true)."</a></span>";	
			      				}
			      				else {
				      				$r .= "<span class='author'>".get_post_meta($t->ID, "author_value", true)."</span>";		
			      				}
			      			}
			      			if($hideauthor != "yes" && $hidecompany != "yes") $r .= ", ";
			      			if($hidecompany != "yes"){
				      			if (get_post_meta($t->ID, "company_link_value", true) != ""){
					      			$r .= "<span class='company'><a href='".get_post_meta($t->ID, "company_link_value", true)."'>".get_post_meta($t->ID, "company_value", true)."</a></span>";
				      			} else {
					      			$r .= "<span class='company'>".get_post_meta($t->ID, "company_value", true)."</span>";
				      			}
			      			}
			      		
			      	$r .= '</div>
			      </div>
			    </div>';
			      
			    $aux++;
			    $el++;
				if ($el == $tests_per_row){
					$r .= "</div>";
					$el = 0;
				}
			
			}
					  		
		} else {
			  global $wpdb, $table_prefix;
			  if ($nshow == -1)
				  $query = "SELECT element_id FROM ".$table_prefix."icl_translations WHERE language_code = '".ICL_LANGUAGE_CODE."' AND element_type='post_testimonials'";
			  else $query = "SELECT element_id FROM ".$table_prefix."icl_translations WHERE language_code = '".ICL_LANGUAGE_CODE."' AND element_type='post_testimonials' LIMIT 0,".$nshow;
			  $results = $wpdb->get_results($query, ARRAY_A);
			  $testemunhos = array();
			  foreach($results as $res){
				  array_push($testemunhos, get_post( $res['element_id'] ));
			  }
			  
			  $filteredtestis = array();
			if ($categories != "all"){
				foreach ($testemunhos as $t){
					$testcats = get_the_terms($t->ID, 'testimonials_category');
					$found = false;
					foreach ($testcats as $ttcats){
						foreach ($thecats as $tc){
							if ($ttcats->slug == $tc) $found = true;	
						}
					}
					if ($found) {
						array_push($filteredtestis, $t);
						$testi = $filteredtestis;
					}
				}
				$testemunhos = $filteredtestis;	
			}
			  
			  $aux = 0;
			  $el = 0;
			  foreach($testemunhos as $t){
			  			  
			  		if ($el == 0) {
						$r .= "<div class='tests_row'>";
					}
					if (isset($testimonials_delay) && $testimonials_delay != 0){
					  	$delay_style = ' style="-webkit-animation-delay: '.$testimonials_delay.'s;-moz-animation-delay: '.$testimonials_delay.'s;-ms-animation-delay: '.$testimonials_delay.'s;-o-animation-delay: '.$testimonials_delay.'s;"';
				  	}
				  	if (strtolower($seq) == "yes"){ $testimonials_delay = $testimonials_delay + .3; }
					if (isset($t)){
						$r .= '<div class="'.$columns.'">
				      <div class="slide s' . $aux . '">';
				      	if (wp_get_attachment_url(get_post_thumbnail_id($t->ID)) != "")
					      	$r .= '<div class="featured_image '.$a_fffect.'"'.$delay_style.'><div class="rotate-bg"></div><img title="'.get_post_meta($t->ID, "author_value", true).'" alt="'.get_post_meta($t->ID, "author_value", true).'" src="'.wp_get_attachment_url(get_post_thumbnail_id($t->ID)).'" /></div>';
				      	$r .= '<div class="testi-text">
				      		<p> ' . $t->post_content . '</p>
				      	</div>
				      	<div class="testi-info">';
				      		
			      			if($hideauthor != "yes"){
			      				if (get_post_meta($t->ID, "author_link_value", true) != ""){
				      				$r .= "<span class='author'><a href='".get_post_meta($t->ID, "author_link_value", true)."'>".get_post_meta($t->ID, "author_value", true)."</a></span>";	
			      				}
			      				else {
				      				$r .= "<span class='author'>".get_post_meta($t->ID, "author_value", true)."</span>";		
			      				}
			      			}
			      			if($hideauthor != "yes" && $hidecompany != "yes") $r .= ", ";
			      			if($hidecompany != "yes"){
				      			if (get_post_meta($t->ID, "company_link_value", true) != ""){
					      			$r .= "<span class='company'><a href='".get_post_meta($t->ID, "company_link_value", true)."'>".get_post_meta($t->ID, "company_value", true)."</a></span>";
				      			} else {
					      			$r .= "<span class='company'>".get_post_meta($t->ID, "company_value", true)."</span>";
				      			}
			      			}	      		
				      	$r .= '</div>
				      </div>
				      </div>';
				      
				      	$aux++;
				      	$el++;
				      	
				      	if (isset($tests_per_row) && $el == $tests_per_row){
							$r .= "</div>";
							$el = 0;
						}	
					}
		      }
		  
		}
			
		$r .= '</div>
		</section>
		';
	}

	$testimonial_section_id++;
	return $r;


} // End des_shortcode_testimonials()

add_shortcode( 'testimonials', 'des_shortcode_testimonials' );

/*-----------------------------------------------------------------------------------*/
/* 17. Dropcap - [dropcap][/dropcap]
/*-----------------------------------------------------------------------------------*/

function des_shortcode_dropcap ( $atts, $content = null ) {

	$defaults = array();

	extract( shortcode_atts( $defaults, $atts ) );

	return '<span class="dropcap">' . $content . '</span>';

} // End des_shortcode_dropcap()

add_shortcode( 'dropcap', 'des_shortcode_dropcap' );

/*-----------------------------------------------------------------------------------*/
/* 18. Highlight - [highlight][/highlight]
/*-----------------------------------------------------------------------------------*/

function des_shortcode_highlight ( $atts, $content = null ) {

	$defaults = array();

	extract( shortcode_atts( $defaults, $atts ) );

	return '<span class="shortcode-highlight">' . $content . '</span>';

} // End des_shortcode_highlight()

add_shortcode( 'highlight', 'des_shortcode_highlight' );

/*-----------------------------------------------------------------------------------*/
/* 19. Abbreviation - [abbr][/abbr]
/*-----------------------------------------------------------------------------------*/

function des_shortcode_abbreviation ( $atts, $content = null ) {

	$defaults = array( 'title' => '' );

	extract( shortcode_atts( $defaults, $atts ) );

	return '<abbr title="' . $title . '">' . $content . '</abbr>';

} // End des_shortcode_abbreviation()

add_shortcode( 'abbr', 'des_shortcode_abbreviation' );

/*-----------------------------------------------------------------------------------*/
/* 20. Typography - [typography font="" size="" color=""][/typography]
/*-----------------------------------------------------------------------------------*/

function des_shortcode_typography ( $atts, $content = null ) {

	global $smartbox_google_fonts;

	// Get just the names of the Google fonts.
	$google_font_names = array();

	if ( count( $smartbox_google_fonts ) ) {

		foreach ( $smartbox_google_fonts as $g ) {

			$google_font_names[] = $g['name'];

		} // End FOREACH Loop

	} // End IF Statement

	// Build array of usable typefaces.
	$fonts_whitelist = array(
						'Arial, Helvetica, sans-serif',
						'Verdana, Geneva, sans-serif',
						'|Trebuchet MS|, Tahoma, sans-serif',
						'Georgia, |Times New Roman|, serif',
						'Tahoma, Geneva, Verdana, sans-serif',
						'Palatino, |Palatino Linotype|, serif',
						'|Helvetica Neue|, Helvetica, sans-serif',
						'Calibri, Candara, Segoe, Optima, sans-serif',
						'|Myriad Pro|, Myriad, sans-serif',
						'|Lucida Grande|, |Lucida Sans Unicode|, |Lucida Sans|, sans-serif',
						'|Arial Black|, sans-serif',
						'|Gill Sans|, |Gill Sans MT|, Calibri, sans-serif',
						'Geneva, Tahoma, Verdana, sans-serif',
						'Impact, Charcoal, sans-serif'
						);

	$fonts_whitelist = array(); // Temporarily remove the default fonts.

	$defaults = array( 'family' => 'Arial, Helvetica, sans-serif', 'size' => '12', 'format' => 'px', 'color' => '#000000' );

	extract( shortcode_atts( $defaults, $atts ) );

	des_shortcode_typography_loadgooglefonts($family);
	
	return '<span class="shortcodes-typography" style="font-family: ' . $family . '; font-size: ' . $size . $format . '; color: ' . $color . ';">' . do_shortcode( $content ) . '</span>';


} // End des_shortcode_typography()

add_shortcode( 'typography', 'des_shortcode_typography' );

add_action( 'wp_head', 'des_shortcode_typography_loadgooglefonts', 0 );

function des_shortcode_typography_loadgooglefonts ( $font = '' ) {

	// If a specific font is requested, just enqueue that font.
	$variations = array(
						'Raleway' => ':100',
						'Coda' => ':800',
						'UnifrakturCook' => ':bold',
						'Allan' => ':bold',
						'Sniglet' => ':800',
						'Cabin' => ':bold',
						'Corben' => ':bold',
						'Buda' => ':light'
						);

	if ( $font ) {

		$f = $font;

		$f = str_replace( ' ', '+', $f );

		$f_include = $f;

		if ( in_array( $f, array_keys( $variations ) ) ) {

			$f_include = $f . $variations[$f];

		} // End IF Statement

		wp_enqueue_style( 'des-googlefont-' . sanitize_title( $f ), 'http'. ( is_ssl() ? 's' : '' ) .'://fonts.googleapis.com/css?family=' . $f_include . '', array(), '3.6', 'screen' );


	} else {

		global $smartbox_google_fonts, $post;

		// Add variations for specific fonts that need variation on inclusion.

		// Get just the names of the Google fonts.
		$google_font_names = array();

		if ( count( $smartbox_google_fonts ) ) {

			foreach ( $smartbox_google_fonts as $g ) {

				$google_font_names[] = $g['name'];

			} // End FOREACH Loop

		} // End IF Statement

		$_pattern = '/\[typography font="(.*?)" size="(.*?)" size_format="(.*?)"(.*?)\](.*?)\[\/typography\]/i'; // 1. font, 2, size, 3, color.
		$_string = '';
		if ( $post ) { $_string = $post->post_content; } // End IF Statement

		preg_match_all($_pattern, $_string, $_matches );

		$used_google_fonts = array();

		foreach ( $_matches[1] as $f ) {

			if ( in_array( $f, $google_font_names ) && ! in_array( $f, $used_google_fonts ) ) {

				$used_google_fonts[] = $f;

			} // End IF Statement

		} // End FOREACH Loop

		if ( count( $used_google_fonts ) ) {

			foreach ( $used_google_fonts as $f ) {

				$f = str_replace( ' ', '+', $f );

				$f_include = $f;

				if ( in_array( $f, array_keys( $variations ) ) ) {

					$f_include = $f . $variations[$f];

				} // End IF Statement

				wp_enqueue_style( 'des-googlefont-' . sanitize_title( $f ), 'http'. ( is_ssl() ? 's' : '' ) .'://fonts.googleapis.com/css?family=' . $f_include . '', array(), '3.6', 'screen' );

			} // End FOREACH Loop

		} // End IF Statement

	} // End IF Statement

} // End des_shortcode_typography_loadgooglefonts()


/*-----------------------------------------------------------------------------------*/
/* 23. Social Icon - [social_icon url="" float="" icon_url="" title="" profile_type="" window=""]
/*-----------------------------------------------------------------------------------*/

function des_shortcode_socialicon ( $atts, $content = null ) {

	$defaults = array( 'url' => '', 'float' => 'none', 'icon_url' => '', 'title' => '', 'profile_type' => '', 'window' => 'no', 'rel' => '' );

	extract( shortcode_atts( $defaults, $atts ) );

	if ( ! $url ) { return; } // End IF Statement - Don't run the shortcode if no URL has been supplied.

	// Attempt to determine the location of the social profile.
	// If no location is found, a default icon will be used.

	$_default_icon = '';

	$_supported_profiles = array(
									'facebook' => 'facebook.com',
									'twitter' => 'twitter.com',
									'youtube' => 'youtube.com',
									'delicious' => 'delicious.com',
									'flickr' => 'flickr.com',
									'linkedin' => 'linkedin.com', 
									'googleplus' => 'plus.google.com'
								);

	$_profile_to_display = '';
	$_alt_text = '';
	$_classes = 'social-icon';

	$_profile_match = false;

	// If they've specified an icon, skip the automation.

	if ( $profile_type != '' ) {

		$_profile_match = true;
		$_profile_to_display = $profile_type;
		if ( $title ) { $_alt_text = $title; } else { $_alt_text = ucwords( $_profile_to_display ); $_alt_text = sprintf( __( 'My %s Profile', 'smartbox' ), $_alt_text ); } // End IF Statement
		$_profile_class = ' social-icon-' . $_profile_to_display;

		if ( $icon_url ) {

			$_img_url = $icon_url;

		} else {

			$_img_url = trailingslashit( get_template_directory_uri() ) . 'functions/images/ico-social-' . $_profile_to_display . '.png';

		} // End IF Statement

	} // End IF Statement

	// Create a special scenario for use with the RSS feed for this website.

	if ( $url == 'feed' ) {

		$_profile_match = true;
		$_profile_to_display = 'rss';
		if ( $title ) { $_alt_text = $title; } else { $_alt_text = __( 'Subscribe to our RSS feed', 'smartbox' ); } // End IF Statement
		$_classes .= ' social-icon-subscribe';
		$url = get_bloginfo( 'rss2_url' );

		if ( $icon_url ) {

			$_img_url = $icon_url;

		} else {

			$_img_url = trailingslashit( get_template_directory_uri() ) . 'functions/images/ico-social-' . $_profile_to_display . '.png';

		} // End IF Statement

	} else {

		foreach ( $_supported_profiles as $k => $v ) {

			if ( $_profile_match == true ) { break; } // End IF Statement - Break out of the loop if we already have a match.

			// Get host name from URL

			preg_match( '@^(?:http://)?([^/]+)@i', $url, $matches );
			$host = $matches[1];

			if ( $host == $v ) {

				$_profile_match = true;
				$_profile_to_display = $k;
				if ( $title ) { $_alt_text = $title; } else { $_alt_text = ucwords( $_profile_to_display ); $_alt_text = sprintf( __( 'My %s Profile', 'smartbox' ), $_alt_text ); } // End IF Statement
				$_profile_class = ' social-icon-' . $_profile_to_display;

				if ( $icon_url ) {

					$_img_url = $icon_url;

				} else {

				$_img_url = trailingslashit( get_template_directory_uri() ) . 'functions/images/ico-social-' . $_profile_to_display . '.png';

				} // End IF Statement

			} else {

				$_profile_to_display = 'default';
				if ( $title ) { $_alt_text = $title; } else { $_alt_text = ucwords( $matches[1] ); $_alt_text = sprintf( __( 'My %s Profile', 'smartbox' ), $_alt_text ); } // End IF Statement

				$_host_bits = explode( '.', $matches[1] );
				$_profile_class = ' social-icon-' . $_host_bits[0];

				if ( $icon_url ) {

					$_img_url = $icon_url;

				} else {

					$_img_url = trailingslashit( get_template_directory_uri() ) . 'functions/images/ico-social-' . $_profile_to_display . '.png';

					// Check if an image has been added for this social icon.

					if ( file_exists( trailingslashit( get_stylesheet_directory() ) . 'images/ico-social-' . $_host_bits[0] . '.png' ) ) {

						$_img_url = trailingslashit( get_stylesheet_directory_uri() ) . 'images/ico-social-' . $_host_bits[0] . '.png';

					} // End IF Statement

				} // End IF Statement

			} // End IF Statement

		} // End FOREACH Loop

		$_classes .= $_profile_class;

		// Determine the floating CSS class to be used.

		switch ( $float ) {

			case 'left':

				$_classes .= ' fl';

			break;

			case 'right':

				$_classes .= ' fr';

			break;

			default:

			break;

		} // End SWITCH Statement

	} // End IF Statement

	$target = '';
	if ( $window == 'yes' ) { $target = ' target="_blank"'; } // End IF Statement

	if ( $rel != '' ) { $rel = ' rel="' . $rel . '"'; }

	return '<a href="' . $url . '" title="' . $_alt_text . '"' . $target . $rel . '><img src="' . $_img_url . '" alt="' . $_alt_text . '" class="' . $_classes . '" /></a>' . "\n";

} // End des_shortcode_socialicon()

add_shortcode( 'social_icon', 'des_shortcode_socialicon' );

/*-----------------------------------------------------------------------------------*/
/* 24. LinkedIn Button - [linkedin_share url="" style=""]
/*-----------------------------------------------------------------------------------*/

function des_shortcode_linkedin_share ( $atts, $content = null ) {

	$defaults = array( 'url' => '', 'style' => 'none', 'float' => 'none' );

	extract( shortcode_atts( $defaults, $atts ) );

	$allowed_floats = array( 'left' => 'fl', 'right' => 'fr', 'none' => '' );
	$allowed_styles = array( 'top' => ' data-counter="top"', 'right' => ' data-counter="right"', 'none' => '' );

	if ( ! in_array( $float, array_keys( $allowed_floats ) ) ) { $float = 'none'; }
	if ( ! in_array( $style, array_keys( $allowed_styles ) ) ) { $style = 'none'; }

	if ( $url ) { $url = ' data-url="' . esc_url( $url ) . '"'; }

	$output = '';

	if ( $float == 'none' ) {} else { $output .= '<div class="shortcode-linkedin_share ' . $allowed_floats[$float] . '">' . "\n"; }

	$output .= '<script type="IN/Share" ' . $url . $allowed_styles[$style] . '></script>' . "\n";

	if ( $float == 'none' ) {} else { $output .= '</div>' . "\n"; }

	// Enqueue the LinkedIn button JavaScript from their API.
	add_action( 'wp_footer', 'des_shortcode_linkedin_js' );
	add_action( 'des_shortcode_generator_preview_footer', 'des_shortcode_linkedin_js' );

	return $output . "\n";

} // End des_shortcode_linkedin_share()

add_shortcode( 'linkedin_share', 'des_shortcode_linkedin_share' );

/*-----------------------------------------------------------------------------------*/
/* 24.1 Load Javascript for LinkedIn Button
/*-----------------------------------------------------------------------------------*/

function des_shortcode_linkedin_js () {
	wp_enqueue_script( 'platlinkedin', 'http://platform.linkedin.com/in.js', array(),'1.0',$in_footer = false);
} // End des_shortcode_linkedin_js()

/*-----------------------------------------------------------------------------------*/
/* 25. Google +1 Button - [google_plusone]
/*-----------------------------------------------------------------------------------*/

function des_shortcode_google_plusone ( $atts, $content = null ) {

	global $post;

	$defaults = array(
						'size' => '',
						'language' => '',
						'count' => '',
						'href' => '',
						'callback' => '',
						'float' => 'none', 
						'annotation' => 'none'
					);

	$atts = shortcode_atts( $defaults, $atts );

	extract( $atts );

	$params = array();

	$allowed_floats = array( 'left' => ' fl', 'right' => ' fr', 'none' => '' );
	if ( ! in_array( $float, array_keys( $allowed_floats ) ) ) { $float = 'none'; }
	
	if ( ! in_array( $annotation, array( 'bubble', 'inline', 'none' ) ) ) { $annotation = 'none'; } 

	// A friendly-looking array of supported languages, along with their codes.
	$supported_languages = array(
		'ar' => 'Arabic', 
		'bg' => 'Bulgarian', 
		'ca' => 'Catalan', 
		'zh-CN' => 'Chinese (Simplified)', 
		'zh-TW' => 'Chinese (Traditional)', 
		'hr' => 'Croatian', 
		'cs' => 'Czech', 
		'da' => 'Danish', 
		'nl' => 'Dutch', 
		'en-US' => 'English (US)', 
		'en-GB' => 'English (UK)', 
		'et' => 'Estonian', 
		'fil' => 'Filipino', 
		'fi' => 'Finnish', 
		'fr' => 'French', 
		'de' => 'German', 
		'el' => 'Greek', 
		'iw' => 'Hebrew', 
		'hi' => 'Hindi', 
		'hu' => 'Hungarian', 
		'id' => 'Indonesian', 
		'it' => 'Italian', 
		'ja' => 'Japanese', 
		'ko' => 'Korean', 
		'lv' => 'Latvian', 
		'lt' => 'Lithuanian', 
		'ms' => 'Malay', 
		'no' => 'Norwegian', 
		'fa' => 'Persian', 
		'pl' => 'Polish', 
		'pt-BR' => 'Portuguese (Brazil)', 
		'pt-PT' => 'Portuguese (Portugal)', 
		'ro' => 'Romanian', 
		'ru' => 'Russian', 
		'sr' => 'Serbian', 
		'sv' => 'Swedish', 
		'sk' => 'Slovak', 
		'sl' => 'Slovenian', 
		'es' => 'Spanish', 
		'es-419' => 'Spanish (Latin America)', 
		'th' => 'Thai', 
		'tr' => 'Turkish', 
		'uk' => 'Ukrainian', 
		'vi' => 'Vietnamese'
	);

	$output = '';
	$tag_atts = '';

	// Make sure we only have Google +1 attributes in our array, after parsing the "float" parameter.
	unset( $atts['float'] );

	if ( $atts['href'] == '' & isset( $post->ID ) ) {
		$atts['href'] = get_permalink( $post->ID );
	}

	foreach ( $atts as $k => $v ) {
		if ( ${$k} != '' ) {
			$tag_atts .= ' data-' . $k . '="' . ${$k} . '"';
		}
	}

	$output = '<div class="shortcode-google-plusone' . $allowed_floats[$float] . '"><div class="g-plusone" ' . $tag_atts . '></div></div>' . "\n";
	
	// Parameters to pass to Google PlusOne JavaScript.
	if ( in_array( $atts['language'] , array_values( $supported_languages ) ) ) {
		$language = '';
		
		foreach ( $supported_languages as $k => $v ) {
			if ( $v == $atts['language'] ) {
				$language = $k;
				break;
			}
		}
		
		$params = array( 'language' => $language );
	}

	des_shortcode_google_plusone_js( $params );

	return $output . "\n";

} // End des_shortcode_google_plusone()

add_shortcode( 'google_plusone', 'des_shortcode_google_plusone' );

/*-----------------------------------------------------------------------------------*/
/* 25.1 Load Javascript for Google +1 Button
/*-----------------------------------------------------------------------------------*/

function des_shortcode_google_plusone_js ( $params ) {
	echo '<script src="https://apis.google.com/js/plusone.js" type="text/javascript">' . "\n";
	if ( isset( $params['language'] ) && ( $params['language'] != '' ) ) {
		echo ' {lang: \'' . $params['language'] . '\'}' . "\n";
	}
	echo '</script>' . "\n";
	echo '<script type="text/javascript">gapi.plusone.go();</script>' . "\n";
} // End des_shortcode_google_plusone_js()

/*-----------------------------------------------------------------------------------*/
/* 26. Twitter Follow Button - [twitter_follow]
/*-----------------------------------------------------------------------------------*/

function des_shortcode_twitter_follow ( $atts, $content = null ) {

	global $post;

	if ( ! isset( $atts['username'] ) || ( $atts['username'] == '' ) ) { return; } // We can't continue without the username.

	$defaults = array(
						'username' => '', 
						'button_color' => 'blue',
						'text_color' => '',
						'link_color' => '',
						'width' => '',
						'align' => '',
						'language' => '',
						'count' => '',
						'float' => 'none'
					);

	$atts = shortcode_atts( $defaults, $atts );

	extract( $atts );

	$allowed_floats = array( 'left' => ' fl', 'right' => ' fr', 'none' => '' );
	if ( ! in_array( $float, array_keys( $allowed_floats ) ) ) { $float = 'none'; }
	
	$allowed_langs = array( 'en', 'fr', 'de', 'it', 'es', 'ko', 'ja' );
	if ( ! in_array( $language, array_keys( $allowed_langs ) ) ) { $language = ''; }

	$output = '';
	$tag_atts = '';

	// Make sure we only have Google +1 attributes in our array, after parsing the "float" parameter.
	unset( $atts['float'] );
	unset( $atts['username'] );

	// Setup array of attributes and the value keys containing the data for each.
	$att_keys = array(
						'button_color' => 'data-button', 
						'text_color' => 'data-text-color', 
						'link_color' => 'data-link-color', 
						'width' => 'data-width', 
						'align' => 'data-align', 
						'language' => 'data-lang', 
						'count' => 'data-show-count'
					);

	foreach ( $atts as $k => $v ) {
		if ( ${$k} != '' ) {
			$tag_atts .= ' ' . $att_keys[$k] . '="' . ${$k} . '"';
		}
	}

	$output = '<div class="shortcode-twitter-follow' . $allowed_floats[$float] . '"><a href="http://twitter.com/' . $username . '/"' . $tag_atts . ' class="twitter-follow-button">' . __( 'Follow', 'smartbox' ) . ' ' . $username . '</a></div>' . "\n";

	// Enqueue the Twitter Follow button JavaScript from their API.
	add_action( 'wp_footer', 'des_shortcode_twitter_follow_js' );
	add_action( 'des_shortcode_generator_preview_footer', 'des_shortcode_twitter_follow_js' );

	return $output . "\n";

} // End des_shortcode_twitter_follow()

add_shortcode( 'twitter_follow', 'des_shortcode_twitter_follow' );

/*-----------------------------------------------------------------------------------*/
/* 26.1 Load Javascript for Google +1 Button
/*-----------------------------------------------------------------------------------*/

function des_shortcode_twitter_follow_js () {
	echo '<script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>' . "\n";
} // End des_shortcode_twitter_follow_js()



/* SERVICES' BALLS */

function des_shortcode_services_balls ( $atts, $content = null ) {

	$defaults = array( 'title' => 'Your Services Title Here' );

	extract( shortcode_atts( $defaults, $atts ) );
	
	$randomID = rand();

	$output = '<div class="serviceballs '.$randomID.'"><div id="banner"><ul>'; 
	
	$output .= do_shortcode($content);
	
	$output .= '</ul></div></div>';
		
	$accordion = '<div class="shortcode-accs acc-substitute default '.$randomID.'">';
	
	$accordion .= transform_into_tabs($content);
	
	$accordion .= '</div>';
		
	return  $output . "\n". $accordion . "\n";	
} 

add_shortcode( 'serviceballs', 'des_shortcode_services_balls' );


/* Balls of the SERVICES' BALLS */
function des_shortcode_individual_ball($atts, $content = null){
	
	$defaults = array( 'title' => 'The title of the subject Here', 'color' => '#026A7D', 'icon' => 'glass' );
	
	extract (shortcode_atts($defaults, $atts));
	
	$borderradius = get_template_directory_uri(). "/css/border-radius.htc";
	
	if(preg_match('/(?i)msie [1-8]/',$_SERVER['HTTP_USER_AGENT'])) {
		$output = '<li id="'.rand().'" class="individual_ball"><h2><span class="outer" style="behavior: url('.$borderradius.'); background: '.$atts['color'].';"></span><span class="centre" style="behavior: url('.$borderradius.'); background: '.$atts['color'].';"></span><span class="inner" style="behavior: url('.$borderradius.'); background: '.$atts['color'].'; background-position-x: center; background-position-y: 35px;"><span class="middlecontent"><i class="icon-'.$icon.'"></i><br/><span>'.$atts['title'].'</span></span></span></h2><ul class="servicesScroller"><div class="viewport"><div class="overview"><p class="ie">';
	} else {
		$output = '<li id="'.rand().'" class="individual_ball"><h2><span class="outer" style="background: '.$atts['color'].';"></span><span class="centre" style="background: '.$atts['color'].';"></span><span class="inner" style="background: '.$atts['color'].';"><span class="middlecontent"><i class="icon-'.$icon.'"></i><br/><span>'.$atts['title'].'</span></h2><ul class="servicesScroller"><div class="viewport"><div class="overview"><p>';
	}
	
	$output .= do_shortcode($content);
	
	$output .= '</p></div></div><div class="scrollbar"><div class="track"><div class="thumb"></div></div></div></ul><div class="circles"></div></li>';
				                        	
	return $output. "\n";
	
}

add_shortcode('ball', 'des_shortcode_individual_ball');


function specialtabs_to_tabs($content){
	
	$output = '';
	
	$eachBall = explode("[/special_tab]", $content);
	
	$num = 0;
	
	unset($eachBall[count($eachBall)-1]);
	
	foreach ($eachBall as $b){
		
		//list($title) = array_pad(explode("[special_tab title=\"", $b, 2), 2, null);
		$title = explode("[special_tab title=\"", $b);
		if (isset($title[1])) $title = explode("\"", $title[1]);
		
		$icon = explode("icon=\"", $b);
		if (isset($icon[1])) $icon = explode("\"", $icon[1]);
		//list($content) = array_pad(explode("endoftab]", $b, 2), 2, null);
		$content = explode("endoftab]", $b);

		if (isset($content[1])) $content = explode("[/special_tab]", $content[1]);
		if ($title[0] != ""){
			$output .= '<div class="acc-title"><h2 style="cursor:pointer;" class=" "><i class="icon-'.$icon[0].'"></i>'.$title[0].'</h2></div>';
			$output .= '<div class="pane acc-sec">';
			$output .= '<p>'.do_shortcode($content[0]).'</p>';	
			$output .= '</div>';
		}
	}
	
	unset($b);
	
	return $output . "\n";	
}

function transform_into_tabs($content){
	
	$output = '';
	
	$eachBall = explode("[/ball]", $content);
	
	foreach ($eachBall as $b){
	
		$title = substr($b, 13);
		$titleP = explode("\"", $title);
		$content = explode("]", $b);
		
		$icon = explode("icon=\"", $b);
		if (isset($icon[1])) $icon = explode("\"", $icon[1]);
		
		if ($title[0] != ""){
			$output .= '<div class="acc-title"><h2><i class="icon-'.$icon[0].'"></i>'.$titleP[0].'</h2></div>';
			$output .= '<div class="pane acc-sec">';
			$output .= '<p>'.$content[1].'</p>';	
			$output .= '</div>';
		}
	}
	
	unset($b);
	
	return $output . "\n";
	
}

function Des_graph_container($atts, $content = null) {
/*******************************************************************************************************************
* GRAPH BARS CONTAINER                                                                                             *
*                                                                                                                  *
*******************************************************************************************************************/
    $rand = rand(0,10000);
    $html = '<ul id="services-graph-' . $rand . '" class="services-graph notinview"> ' . do_shortcode($content) .'</ul>'; 
    $html .= '<script type="text/javascript">
    	jQuery(document).ready(function($){
    		graph_init("services-graph-' . $rand . '", 1000);
    	});
    </script> ';      
    return $html;
}
add_shortcode('bars_container', 'Des_graph_container');

function Des_graph($atts, $content = null) {
/*******************************************************************************************************************
* GRAPH BAR SHORTCODE (MUST BE INSIDE THE GRAPH CONTAINER)                                                         *
*                                                                                                                  *
*******************************************************************************************************************/
    extract(shortcode_atts(array("percent" => 50, "units" => "%"), $atts));   
    $html = '<li><span title="' . $percent . '"></span><p><strong>' . $percent . $units .'</strong>' . '<div class="text-graphs">' . do_shortcode($content) . '</div></p></li>';
    return $html;
}
add_shortcode('bars', 'Des_graph');


function des_donuts_container($atts, $content = null) {
/*******************************************************************************************************************
* DONUTS CONTAINER                                                                                    			   *
*                                                                                                                  *
*******************************************************************************************************************/
    $html = "";
    $rand = rand(0,10000);
    $html .= '<div id="donuts-' . $rand . '" class="donuts"> ' . do_shortcode($content) .'</div>';      
    return $html;
}
add_shortcode('donuts', 'des_donuts_container');

function des_donut($atts, $content = null) {
/*******************************************************************************************************************
* DONUT CONTAINER SHORTCODE (MUST BE INSIDE THE CONTAINER)											   		   	   *
*                                                                                                                  *
*******************************************************************************************************************/
    extract(shortcode_atts(array("percent" => 50), $atts));

    static $circle = 1;
    
    $html = "";
    
    $html .= '<script type="text/javascript"> 
	    jQuery(document).ready(function($){
	    	var color = jQuery(\'#styleColor\').html(); var opts = {lines: 12, angle: 0.5, lineWidth: 0.08, colorStart: color, colorStop: color,strokeColor: "#f5f5f5",generateGradient: false}; 
		    window.gauge_'.$circle.' = new Donut(document.getElementById("donut-'.$circle.'")).setOptions(opts);gauge_'.$circle.'.maxValue = 100;gauge_'.$circle.'.animationSpeed = 25;
	    });
	    jQuery(window).load(function(){
	    	if (isScrolledIntoView("donut-'.$circle.'")){
	    		window.gauge_'.$circle.'.set('.$percent.');
	    		jQuery(\'#donut-'.$circle.'\').removeClass(\'notinview\')
        	}
	    });
	    jQuery(window).scroll(function(){    	
	    	if (jQuery(\'#donut-'.$circle.'.notinview\').length){
	    		if (isScrolledIntoView("donut-'.$circle.'")){
		    		window.gauge_'.$circle.'.set('.$percent.');
		    		jQuery(\'#donut-'.$circle.'\').removeClass(\'notinview\')
	        	}
	        }
	    });
        </script> ';
    
    $html .= '<div class="donut-container"><canvas width="190" height="190" id="donut-'.$circle.'" class="notinview"></canvas><div class="donut-content"><div class="middle"><div class="inner">'.do_shortcode($content).'</div></div></div></div>';
    
    $circle++;

    return $html;
}
add_shortcode('donut', 'des_donut');

function des_num_container($atts, $content = null) {
/*******************************************************************************************************************
* NUMERICAL CONTAINER                                                                                    			   *
*                                                                                                                  *
*******************************************************************************************************************/
    
    $rand = rand(0,10000);
    $html = "";
    $html .= '<div id="numerical-' . $rand . '" class="numericals"> ' . do_shortcode($content) .'</div>';      
    return $html;
}
add_shortcode('numerical_container', 'des_num_container');

function des_numerical_item($atts, $content = null) {
/*******************************************************************************************************************
* NUMERICAL CONTAINER SHORTCODE (MUST BE INSIDE THE CONTAINER)											   		   	   *
*                                                                                                                  *
*******************************************************************************************************************/
    extract(shortcode_atts(array("percent" => 50, "unit"=>"%", "value_font_size"=>"20px", "unit_font_size" =>"14px", "align"=>"Left","jump"=>"1"), $atts));
    
    static $num_incr = 1;
    
    $html = "";
    $style = "";
    
    $html .= '<script type="text/javascript"> 
    jQuery(window).load(function(){
    	if (isScrolledIntoView("numerical-'.$num_incr.'")){
    		jQuery(\'#numerical-'.$num_incr.'\').removeClass(\'notinview\');
    		incrementNumerical(\'#numerical-'.$num_incr.'\', '.$percent.', '.$jump.');
    	}
    });
    jQuery(window).scroll(function(){    	
    	if (jQuery(\'#numerical-'.$num_incr.'.notinview\').length){
    		if (isScrolledIntoView("numerical-'.$num_incr.'")){
	    		jQuery(\'#numerical-'.$num_incr.'\').removeClass(\'notinview\');
	    		incrementNumerical(\'#numerical-'.$num_incr.'\', '.$percent.', '.$jump.');
        	}
        }
    });
        </script> ';
    
    $html .= '<div class="numerical-container"><div id="numerical-'.$num_incr.'" class="notinview '.strtolower($align).'"><div style="font-size:'.$value_font_size.';" class="value">0</div><div style="font-size:'.$unit_font_size.';" class="unit">'.$unit.'</div></div><div class="numerical-content" style="text-align:'.strtolower($align).';';

    if ($align === "Left") $style .= "padding-left:8px;";

    $html .= $style.'">'.do_shortcode($content).'</div></div>';
    
    $num_incr++;

    return $html;
}
add_shortcode('numerical_item', 'des_numerical_item');

function des_diagram_container($atts, $content = null) {
/*******************************************************************************************************************
* DIAGRAM CONTAINER                                                                                    			   *
*                                                                                                                  *
*******************************************************************************************************************/
    extract(shortcode_atts(array("title" => ""), $atts));
    $rand = rand(0,10000);
    $html = "";
    $html .= '<section class="diagrams-container"><div class="textcontainer"></div><div id="diagram-' . $rand . '" class="diagrams" title="'.$title.'"><div class="diagram-jquery"><div class="get">'. do_shortcode($content) .'</div></div></div></section>';     
    
    wp_enqueue_script( 'diagram', DESIGNARE_JS_PATH .'diagram.init.js', array(),'1.0');
    
    return $html;
}
add_shortcode('diagram_container', 'des_diagram_container');

function des_diagram_item($atts, $content = null) {
/*******************************************************************************************************************
* DIAGRAM CONTAINER SHORTCODE (MUST BE INSIDE THE CONTAINER)											   		   	   *
*                                                                                                                  *
*******************************************************************************************************************/
    extract(shortcode_atts(array("percent" => 50, "color" => "#333"), $atts));
    
    static $num = 1;
    
    $html = "";
    
    $html .= '<div class="arc"><span class="text">'.do_shortcode($content).'</span><input type="hidden" class="percent" value="'.$percent.'" /><input type="hidden" class="color" value="'.$color.'"/></div>';
        
    $num++;

    return $html;
}
add_shortcode('diagram', 'des_diagram_item');

/*-----------------------------------------------------------------------------------*/
/* 27. Featured Box [featured_box style=""][/featured_box]
/*-----------------------------------------------------------------------------------*/

function des_shortcode_featuredbox( $atts, $content = null ) {

	$defaults = array( 'style' => 'Simple Border' );

	extract( shortcode_atts( $defaults, $atts ) );
	
	switch($style){
		case "Simple Border": $style = "simpleborder"; break;
		case "Fancy Border": $style = "fancyborder"; break;
		case "Background Pattern": $style = "backgroundpattern"; break;
	}

	return '<div class="featured-box ' . $style . '"><div class="fancyb">' . do_shortcode( $content ) . '</div></div>' . "\n";

}

add_shortcode( 'featured_box', 'des_shortcode_featuredbox' );


/*-----------------------------------------------------------------------------------*/
/* 27. Featured Box [featured_box style=""][/featured_box]
/*-----------------------------------------------------------------------------------*/

function des_shortcode_social_icons ( $atts, $content = null ) {

	$defaults = array( 'social_style' => '', 'p_facebook' => '', 'p_twitter' => '', 'p_tumblr'=>'', 'p_forrst'=>'', 'p_stumble'=>'','p_flickr'=>'','p_linkedin'=>'', 'p_delicious'=>'', 'p_skype'=>'', 'p_digg'=>'', 'p_google'=>'', 'p_vimeo'=>'', 'p_picasa'=>'', 'p_deviantart'=>'', 'p_behance'=>'', 'p_viddler'=>'', 'p_instagram'=>'', 'p_myspace'=>'', 'p_blogger'=>'', 'p_zerply'=>'', 'p_wordpress'=>'', 'p_grooveshark'=>'', 'p_youtube'=>'', 'p_reddit'=>'', 'p_rss'=>'', 'p_soundcloud'=>'', 'p_pinterest'=>'', 'p_dribbble' => '', 'p_yelp' => '', 'p_foursquare' => '' );

	extract( shortcode_atts( $defaults, $atts ) );
	
	
	if ($social_style == "Light"){
	
	if (isset($atts) && count($atts)>0){
		
		$output = "<div class='socialdiv socialiconsshortcode'><ul>";
			
		if (isset($atts['p_facebook'])) $output .= "<li><a href=". $atts['p_facebook'] ." target='_blank' class='facebook' title='Facebook'></a></li>";
		if (isset($atts['p_twitter'])) $output .= "<li><a href=". $atts['p_twitter'] ." target='_blank' class='twitter' title='Twitter'></a></li>";
		if (isset($atts['p_tumblr'])) $output .= "<li><a href=". $atts['p_tumblr'] ." target='_blank' class='tumblr' title='Tumblr'></a></li>";
		if (isset($atts['p_forrst'])) $output .= "<li><a href=". $atts['p_forrst'] ." target='_blank' class='forrst' title='Forrst'></a></li>";
		if (isset($atts['p_stumble'])) $output .= "<li><a href=". $atts['p_stumble'] ." target='_blank' class='stumble' title='Stumble'></a></li>";
		if (isset($atts['p_flickr'])) $output .= "<li><a href=". $atts['p_flickr'] ." target='_blank' class='flickr' title='Flickr'></a></li>";
		if (isset($atts['p_linkedin'])) $output .= "<li><a href=". $atts['p_linkedin'] ." target='_blank' class='linkedin' title='LinkedIn'></a></li>";
		if (isset($atts['p_delicious'])) $output .= "<li><a href=". $atts['p_delicious'] ." target='_blank' class='delicious' title='Delicious'></a></li>";
		if (isset($atts['p_skype'])) $output .= "<li><a href=". $atts['p_skype'] ." target='_blank' class='skype' title='Skype'></a></li>";
		if (isset($atts['p_digg'])) $output .= "<li><a href=". $atts['p_digg'] ." target='_blank' class='digg' title='Digg'></a></li>";
		if (isset($atts['p_google'])) $output .= "<li><a href=". $atts['p_google'] ." target='_blank' class='google' title='Google'></a></li>";
		if (isset($atts['p_vimeo'])) $output .= "<li><a href=". $atts['p_vimeo'] ." target='_blank' class='vimeo' title='Vimeo'></a></li>";
		if (isset($atts['p_picasa'])) $output .= "<li><a href=". $atts['p_picasa'] ." target='_blank' class='picasa' title='Picasa'></a></li>";
		if (isset($atts['p_deviantart'])) $output .= "<li><a href=". $atts['p_deviantart'] ." target='_blank' class='deviantart' title='DeviantArt'></a></li>";
		if (isset($atts['p_behance'])) $output .= "<li><a href=". $atts['p_behance'] ." target='_blank' class='behance' title='Behance'></a></li>";
		
		if (isset($atts['p_viddler'])) $output .= "<li><a href=". $atts['p_viddler'] ." target='_blank' class='viddler' title='Viddler'></a></li>";
		if (isset($atts['p_instagram'])) $output .= "<li><a href=". $atts['p_instagram'] ." target='_blank' class='instagram' title='Instagram'></a></li>";
		if (isset($atts['p_myspace'])) $output .= "<li><a href=". $atts['p_myspace'] ." target='_blank' class='myspace' title='MySpace'></a></li>";
		if (isset($atts['p_blogger'])) $output .= "<li><a href=". $atts['p_blogger'] ." target='_blank' class='blogger' title='Blogger'></a></li>";
		if (isset($atts['p_zerply'])) $output .= "<li><a href=". $atts['p_zerply'] ." target='_blank' class='zerply' title='Zerply'></a></li>";
		if (isset($atts['p_wordpress'])) $output .= "<li><a href=". $atts['p_wordpress'] ." target='_blank' class='wordpress' title='Wordpress'></a></li>";
		if (isset($atts['p_grooveshark'])) $output .= "<li><a href=". $atts['p_grooveshark'] ." target='_blank' class='grooveshark' title='GrooveShark'></a></li>";
		if (isset($atts['p_youtube'])) $output .= "<li><a href=". $atts['p_youtube'] ." target='_blank' class='youtube' title='Youtube'></a></li>";
		if (isset($atts['p_reddit'])) $output .= "<li><a href=". $atts['p_reddit'] ." target='_blank' class='reddit' title='Reddit'></a></li>";
		if (isset($atts['p_rss'])) $output .= "<li><a href=". $atts['p_rss'] ." target='_blank' class='rss' title='RSS'></a></li>";
		if (isset($atts['p_soundcloud'])) $output .= "<li><a href=". $atts['p_soundcloud'] ." target='_blank' class='soundcloud' title='Soundcloud'></a></li>";
		if (isset($atts['p_pinterest'])) $output .= "<li><a href=". $atts['p_pinterest'] ." target='_blank' class='pinterest' title='Pinterest'></a></li>";
		if (isset($atts['p_dribbble'])) $output .= "<li><a href=". $atts['p_dribbble'] ." target='_blank' class='dribbble' title='Dribbble'></a></li>";

if (isset($atts['p_yelp'])) $output .= "<li><a href=". $atts['p_yelp'] ." target='_blank' class='yelp' title='Yelp'></a></li>";
if (isset($atts['p_foursquare'])) $output .= "<li><a href=". $atts['p_foursquare'] ." target='_blank' class='foursquare' title='Foursquare'></a></li>";
		
	}
	
	$output .= "</ul></div>";

	return $output;
	}
	
	if ($social_style == "Dark"){
	
	if (isset($atts) && count($atts)>0){
		
		$output = "<div class='socialdiv-dark socialiconsshortcode'><ul>";
			
		if (isset($atts['p_facebook'])) $output .= "<li><a href=". $atts['p_facebook'] ." target='_blank' class='facebook' title='Facebook'></a></li>";
		if (isset($atts['p_twitter'])) $output .= "<li><a href=". $atts['p_twitter'] ." target='_blank' class='twitter' title='Twitter'></a></li>";
		if (isset($atts['p_tumblr'])) $output .= "<li><a href=". $atts['p_tumblr'] ." target='_blank' class='tumblr' title='Tumblr'></a></li>";
		if (isset($atts['p_forrst'])) $output .= "<li><a href=". $atts['p_forrst'] ." target='_blank' class='forrst' title='Forrst'></a></li>";
		if (isset($atts['p_stumble'])) $output .= "<li><a href=". $atts['p_stumble'] ." target='_blank' class='stumble' title='Stumble'></a></li>";
		if (isset($atts['p_flickr'])) $output .= "<li><a href=". $atts['p_flickr'] ." target='_blank' class='flickr' title='Flickr'></a></li>";
		if (isset($atts['p_linkedin'])) $output .= "<li><a href=". $atts['p_linkedin'] ." target='_blank' class='linkedin' title='LinkedIn'></a></li>";
		if (isset($atts['p_delicious'])) $output .= "<li><a href=". $atts['p_delicious'] ." target='_blank' class='delicious' title='Delicious'></a></li>";
		if (isset($atts['p_skype'])) $output .= "<li><a href=". $atts['p_skype'] ." target='_blank' class='skype' title='Skype'></a></li>";
		if (isset($atts['p_digg'])) $output .= "<li><a href=". $atts['p_digg'] ." target='_blank' class='digg' title='Digg'></a></li>";
		if (isset($atts['p_google'])) $output .= "<li><a href=". $atts['p_google'] ." target='_blank' class='google' title='Google'></a></li>";
		if (isset($atts['p_vimeo'])) $output .= "<li><a href=". $atts['p_vimeo'] ." target='_blank' class='vimeo' title='Vimeo'></a></li>";
		if (isset($atts['p_picasa'])) $output .= "<li><a href=". $atts['p_picasa'] ." target='_blank' class='picasa' title='Picasa'></a></li>";
		if (isset($atts['p_deviantart'])) $output .= "<li><a href=". $atts['p_deviantart'] ." target='_blank' class='deviantart' title='DeviantArt'></a></li>";
		if (isset($atts['p_behance'])) $output .= "<li><a href=". $atts['p_behance'] ." target='_blank' class='behance' title='Behance'></a></li>";
		if (isset($atts['p_viddler'])) $output .= "<li><a href=". $atts['p_viddler'] ." target='_blank' class='viddler' title='Viddler'></a></li>";
		if (isset($atts['p_instagram'])) $output .= "<li><a href=". $atts['p_instagram'] ." target='_blank' class='instagram' title='Instagram'></a></li>";
		if (isset($atts['p_myspace'])) $output .= "<li><a href=". $atts['p_myspace'] ." target='_blank' class='myspace' title='MySpace'></a></li>";
		if (isset($atts['p_blogger'])) $output .= "<li><a href=". $atts['p_blogger'] ." target='_blank' class='blogger' title='Blogger'></a></li>";
		if (isset($atts['p_zerply'])) $output .= "<li><a href=". $atts['p_zerply'] ." target='_blank' class='zerply' title='Zerply'></a></li>";
		if (isset($atts['p_wordpress'])) $output .= "<li><a href=". $atts['p_wordpress'] ." target='_blank' class='wordpress' title='Wordpress'></a></li>";
		if (isset($atts['p_grooveshark'])) $output .= "<li><a href=". $atts['p_grooveshark'] ." target='_blank' class='grooveshark' title='GrooveShark'></a></li>";
		if (isset($atts['p_youtube'])) $output .= "<li><a href=". $atts['p_youtube'] ." target='_blank' class='youtube' title='Youtube'></a></li>";
		if (isset($atts['p_reddit'])) $output .= "<li><a href=". $atts['p_reddit'] ." target='_blank' class='reddit' title='Reddit'></a></li>";
		if (isset($atts['p_rss'])) $output .= "<li><a href=". $atts['p_rss'] ." target='_blank' class='rss' title='RSS'></a></li>";
		if (isset($atts['p_soundcloud'])) $output .= "<li><a href=". $atts['p_soundcloud'] ." target='_blank' class='soundcloud' title='Soundcloud'></a></li>";
		if (isset($atts['p_pinterest'])) $output .= "<li><a href=". $atts['p_pinterest'] ." target='_blank' class='pinterest' title='Pinterest'></a></li>";
		if (isset($atts['p_dribbble'])) $output .= "<li><a href=". $atts['p_dribbble'] ." target='_blank' class='dribbble' title='Dribbble'></a></li>";
		
		if (isset($atts['p_yelp'])) $output .= "<li><a href=". $atts['p_yelp'] ." target='_blank' class='yelp' title='Yelp'></a></li>";
		if (isset($atts['p_foursquare'])) $output .= "<li><a href=". $atts['p_foursquare'] ." target='_blank' class='foursquare' title='Foursquare'></a></li>";
		
	}
	
	$output .= "</ul></div>";

	return $output;
	}
	
	

} // End des_shortcode_orderedlist()

add_shortcode( 'social_icons', 'des_shortcode_social_icons' );

/*-----------------------------------------------------------------------------------*/
/* xx Partners - [partners][/partners]
/*-----------------------------------------------------------------------------------*/

function des_shortcode_partners ( $atts, $content = null ) {

	// Instruct the shortcode JavaScript to load.
	if ( ! defined( 'DES_SHORTCODE_JS' ) ) { define( 'DES_SHORTCODE_JS', 'load' ); }

	$defaults = array( 'title' => ' ', 'css' => '', 'scroller'=>'yes', 'partners_per_row' => '2', 'effect'=>'opacity', 'nshow'=> -1, 'categories' => 'all', 'autoplay'=>'no', 'autoplay_speed'=>'3000' );

	extract( shortcode_atts( $defaults, $atts ) );
	
	$nshow = intval($nshow, 10);
	
	if($nshow == 0 )
    	$nshow = -1;

	

	if ( $css != '' ) { $css = ' ' . $css; }

	$titles_html = '';
	
	$rid = rand(1, 100);

	$pag = "";
	if ($scroller == "yes"){
		wp_enqueue_script( 'carrossel', DESIGNARE_JS_PATH .'jquery.jcarousel.min.js', array(),'1.0',$in_footer = true);
		$pag = "<div class='pag-proj_partners'>
			<div class='nextbutton carousel-control next carousel-next jcarousel-next jcarousel-next-horizontal'></div>
			<div class='prevbutton carousel-control previous carousel-previous jcarousel-prev jcarousel-prev-horizontal'></div>
		</div>";
	}

	if (esc_html($title) != "" && esc_html($title) != " "){ $titles_html .= '<div class="smartboxtitle"><hr><span>'.esc_html($title).'</span>'.$pag.'</div>'; }
	else { $titles_html .= '<div class="smartboxtitle">'.$pag.'</div>'; }

	$output = "<section id='partners-".$rid."' class='shortcode-partners sixteen columns". $css . "'>" . $titles_html . "<div class='partners-carousel'><ul class='partners-items'>";
	
	$columnslayout = "";
	$height = "300px";
	switch($partners_per_row){
		case "1":
			$columnslayout = "sixteen columns";
			$height = "270px";		
			break;
		case "2": 
			$columnslayout = "eight columns";
			$height = "250px";		
			break;
		case "3": 
			$columnslayout = "one-third column";
			$height = "200px";
			break;
		case "4": 
			$columnslayout = "four columns";
			$height = "180px";
			break;
	}
	
   	$thecats = array();
	if ($categories != "all"){
    	$cats = explode("|*|",$categories);
    	foreach($cats as $c){
    		if ($c != ""){
    			array_push($thecats, $c);
    		}
    	}
    }

	if ($scroller == "yes"){
	
		$args = array(
			'numberposts' => -1,
			'orderby' => 'post_date',
			'order' => 'DESC',
			'post_type' => 'partners',
			'post_status' => 'publish' 
		);
			
		$partners = get_posts( $args );	
		$filteredpartners = array();
		if ($categories != "all"){
			foreach ($partners as $p){
				$partnerscats = get_the_terms($p->ID, 'partners_category');
				$found = false;
				if ($partnerscats != "" && is_array($partnerscats)){
					foreach ($partnerscats as $pcats){
						foreach ($thecats as $pc){
							if ($pcats->slug == $pc) $found = true;	
						}
					}
					if ($found) {
						array_push($filteredpartners, $p);
						$partners = $filteredpartners;
					}					
				}
			}			
		}
		
		
		foreach ($partners as $p){
			if ($scroller == "no")
				$output .= "<li class='".$columnslayout." partner-item no-flicker'>";
			else
				$output .= "<li class='withscroller partner-item no-flicker'>";
			$output .= "<a target='_blank' href='";
			if (get_post_meta($p->ID, 'link_value', true) != ""){
				$output .= get_post_meta($p->ID, 'link_value', true);
			} else $output .= "javascript:;";
			$output .= "' title='".$p->post_title."'><img class='logopartner' src='".wp_get_attachment_url( get_post_thumbnail_id($p->ID))."' alt='".$p->post_title."' title='".$p->post_title."'/></a>";
			$output .= "</li>";
		}
		
		$output .= "</ul></div><div class='clear'></div></section>";
		
		$autoplay_output = "";
		if ($autoplay === "yes"){
			$autoplay_output  = ", autoSlide: true, autoSlideInterval: ".intval($autoplay_speed, 10)."";	
		}
	
		if ($effect == "grayscale"){
			$output .= "
				<script type='text/javascript'>
					jQuery(document).ready(function($){
						jQuery('#partners-".$rid." .partners-items li').css({'margin':'0px 10px 0px 0px', 'float':'left', 'max-height':'130px'});
						jQuery('#partners-".$rid."').find('.partners-carousel').carousel({dispItems:1".$autoplay_output."});
						jQuery('#partners-".$rid."').find('.logopartner').hide().fadeIn(1000);
					});
					jQuery(window).load(function(){
						jQuery('#partners-".$rid." .partners-items li').each(function(e){
							jQuery(this).css('min-height','').css('max-height',jQuery(this).children('a').height());
						});
						jQuery('#partners-".$rid."').find('.logopartner').each(function(){
							jQuery(this).greyScale({
					          fadeTime: 500,
					          reverse: false
					        });
						});
					});
					jQuery(window).resize(function(){
						jQuery('#partners-".$rid." .partners-items li').each(function(e){
							jQuery(this).css('min-height','').css('max-height',jQuery(this).children('a').height());
						});
					});
				</script>
			";
		} else {
			$output .= "
				<script type='text/javascript'>
					jQuery(document).ready(function($){
						jQuery('#partners-".$rid." .partners-items br').remove();
						jQuery('#partners-".$rid." .partners-items li').css({'margin':'0px 10px 0px 0px', 'max-height': '130px', 'float':'left'});
						jQuery('#partners-".$rid."').find('.partners-carousel').carousel({dispItems:1".$autoplay_output."});
						jQuery('#partners-".$rid."').find('.partners-carousel').find('li').each(function(){
							jQuery(this).hover(function(){ jQuery(this).siblings().addClass('highlight'); }, function(){ jQuery(this).siblings().removeClass('highlight'); });
						});
					});
					jQuery(window).load(function(){
						jQuery('#partners-".$rid." .partners-items li').each(function(e){
							jQuery(this).css('min-height','').css('max-height',jQuery(this).children('a').height());
						});
					});
					jQuery(window).resize(function(){
						jQuery('#partners-".$rid." .partners-items li').each(function(e){
							jQuery(this).css('min-height','').css('max-height',jQuery(this).children('a').height());
						});
					});
				</script>
			";
		}
	} else {

		$args = array(
			'posts_per_page' => $nshow,
			'orderby' => 'post_date',
			'order' => 'DESC',
			'post_type' => 'partners',
			'post_status' => 'publish' 
		);
			
		$partners = get_posts( $args );	
		$filteredpartners = array();
		if ($categories != "all"){
			foreach ($partners as $p){
				$partnerscats = get_the_terms($p->ID, 'partners_category');
				$found = false;
				if ($partnerscats != "" && is_array($partnerscats)){
					foreach ($partnerscats as $pcats){
						foreach ($thecats as $pc){
							if ($pcats->slug == $pc) $found = true;	
						}
					}
					if ($found) {
						array_push($filteredpartners, $p);
						$partners = $filteredpartners;
					}	
				}
			}			
		}
		
				
		foreach ($partners as $p){
			if ($scroller == "no")
				$output .= "<li class='".$columnslayout." partner-item no-flicker' style='margin-right: 1% !important; margin-left: 1% !important;'>";
			else
				$output .= "<li class='partner-item no-flicker'  >";
			$output .= "<a target='_blank' href='";
			if (get_post_meta($p->ID, 'link_value', true) != ""){
				$output .= get_post_meta($p->ID, 'link_value', true);
			} else $output .= "javascript:;";
			$output .= "' title='".$p->post_title."'><img class='logopartner' src='".wp_get_attachment_url( get_post_thumbnail_id($p->ID))."' alt='".$p->post_title."' title='".$p->post_title."' /></a>";
			$output .= "</li>";
		}
	
		$output .= "</ul></div><div class='clear'></div></section>";
		
		if ($effect == "grayscale"){
			$output .= "
				<script type='text/javascript'>
					jQuery(document).ready(function($){
						jQuery('#partners-".$rid." .partners-items li').css({'max-height':'130px', 'float':'left'});
						jQuery('#partners-".$rid."').find('.logopartner').hide().fadeIn(1000);
					});
					jQuery(window).load(function(){
						jQuery('#partners-".$rid."').find('.logopartner').each(function(){
							jQuery(this).greyScale({
					          fadeTime: 500,
					          reverse: false
					        });
						});
					});
				</script>
			";
		} else {
			$output .= "
				<script type='text/javascript'>
					jQuery(document).ready(function($){
						jQuery('#partners-".$rid." .partners-items br').remove();
						jQuery('#partners-".$rid." .partners-items li').css({'max-height':'130px', 'float':'left'});
						jQuery('#partners-".$rid."').find('.partners-carousel').find('li').each(function(){
							jQuery(this).hover(function(){ jQuery(this).siblings().addClass('highlight'); }, function(){ jQuery(this).siblings().removeClass('highlight'); });
						});
					});
				</script>
			";
		}
	}
	
	return $output;
} // End des_shortcode_partners()

add_shortcode( 'partners', 'des_shortcode_partners', 90 );

function des_i ( $atts, $content = null ) {
	$defaults = array( 'class' => '', 'color' => '', 'font_size' => '', 'background' => '', 'border' => '', 'style_bg'=>'none', 'a_fffect'=>'', 'align'=>'Left');
	extract( shortcode_atts( $defaults, $atts ) );
	$style = "";
	if ($color!= "") $style .= "color: ".$color.";";
	if ($font_size!="") $style .= "font-size: ".$font_size.";";
	if ($background!="" && $style_bg!="none") $style .= "background: ".$background.";";
	if ($border!="") $style .= "border: ".$border.";";
	if ($style_bg != "none"){
		$style_bg = strtolower($style_bg);
		$style .= "padding:.2em .3em;";
		if ($style_bg === "rounded") $style .= "border-radius:.1em;-moz-border-radius:.1em;-webkit-border-radius:.1em;-ms-border-radius:.1em;-o-border-radius:.1em;";
		if ($style_bg === "circle") $style .= "border-radius:$font_size;-moz-border-radius:$font_size;-webkit-border-radius:$font_size;-ms-border-radius:$font_size;-o-border-radius:$font_size;";
		$output = "<div class='iconfa $a_fffect' style='text-align:".strtolower($align).";'><i class='$class $style_bg'";
	} else {
		$output = "<div class='iconfa $a_fffect' style='text-align:".strtolower($align).";'><i class='$class'";
	}
	if ($style!="") $output .= "style='".$style."'";
	$output .= "></i></div>";
	return $output;
}
add_shortcode('i', 'des_i', 90);

function des_tooltip ( $atts, $content = null ) {
	$defaults = array( 'style' => '', 'tooltip_content' => '');
	extract( shortcode_atts( $defaults, $atts ) );
	$output = "<span class='tooltiper tooltip-".$style."' title='".$tooltip_content."'><span>".$content."</span></span>";
	return $output;
}
add_shortcode('tooltip', 'des_tooltip', 90);

function des_smartboxtitle ( $atts, $content = null ) {
	$defaults = array( 'title' => '', 'font_size' => '', 'color' => '', 'background' => '', 'text_align' => '');
	extract( shortcode_atts( $defaults, $atts ) );
	
	$style = "";
	if ($font_size!="") $style .= "font-size: ".$font_size." !important;";	
	if ($color!= "") $style .= "color: ".$color." !important;";
	if ($background!= "") $style .= "background: ".$background." !important;";
	if ($text_align!="") $style .= "text-align: ".$text_align." !important;";
	$classe = "";
	if ($text_align=="center"){
		$classe = "inside-title";
	}
	
	
	
	$output = "<h2 class='smartboxtitle $text_align'><span><span class='$classe' ";
	if ($style!="") $output .= " style='".$style."'";
	$output .= ">$title</span></span><hr/></h2>";
	return $output;
	

}
add_shortcode('smartboxtitle', 'des_smartboxtitle', 90);

function des_addthis ( $atts, $content = null ) {
	$defaults = array( );
	extract( shortcode_atts( $defaults, $atts ) );
	return urldecode($content);
}
add_shortcode('addthis', 'des_addthis', 90);


function des_fullwidth_section ( $atts, $content = null ) {
	$defaults = array( 'type'=>'Color', 'color' => '', 'pattern'=>'', 'image'=>'', 'border_color'=>'', 'video' => '', 'parallax' => 'No');
	extract( shortcode_atts( $defaults, $atts ) );
	$randClass = rand();
	$output = "";
	if ($parallax !== "No" && $parallax !== "no"){
		$output .= "<div class='parallax shortcode fullwidth-section fullwidth-section-".$randClass."' style='";
	} else {
		$output .= "<div class='shortcode fullwidth-section fullwidth-section-".$randClass."' style='";
	}
	
	if ($border_color != ""){
		$output .= "-webkit-box-shadow: inset 0px 0px 6px 0px $border_color !important;box-shadow: inset 0px 0px 6px 0px $border_color !important;";
	}
	if ($type == "Color"){
		$output .= "background: $color;";
	} 
	if ($type == "Pattern") {
		$output .= "background: url($pattern);";
	}
	if ($type == "Image") {
		$output .= "background-image: url($image);";
		if ($parallax !== "No" && $parallax !== "no"){
			$output .= "background-repeat: no-repeat; background-size: 100%;";	
		} else {
			$output .= "background-repeat: no-repeat; background-size: 100% 100%;";
		}
	}
	if ($type == "Video") {	
		$output .= "'><div class=\"video-container $randClass\" style=\"position:absolute;top:0px;left:0px;z-index:1;\"><div class=\"video\">";
		$video_atts = array(
			'src'      => $video,
			'poster'   => '',
			'loop'     => 'true',
			'autoplay' => 'autoplay',
			'preload'  => 'auto',
			'controls' => 'false',
			'width' => 2000
		); 
		$output .= wp_video_shortcode($video_atts);
		$output .= "</div></div>". do_shortcode($content) ."</div>";
	} else {
		if ($parallax !== "No" && $parallax !== "no"){
			$output .= "' data-bottom-top='background-position: 0% 0%;' data-top-bottom='background-position: 0% 100%;'";
		}
		$output .= " ><div class='tcontent'>".do_shortcode($content)."</div></div>";	
	}
	return $output;
}
add_shortcode('fullwidth_section', 'des_fullwidth_section', 90);

function des_icon ( $atts, $content = null ) {
	$defaults = array( 'icon'=>'icon1', 'size' => 'small', 'css'=>'');
	extract( shortcode_atts( $defaults, $atts ) );
	
	if(preg_match('/(?i)msie [1-9]/',$_SERVER['HTTP_USER_AGENT'])) {
		if ($size == "big")
			$output = "<span class='designare_icon bigicons'><img class='designare_icon' src='".get_template_directory_uri()."/img/designare_icons/".$icon."_big.png' />"; 
		else $output = "<span class='designare_icon'><img class='designare_icon' src='".get_template_directory_uri()."/img/designare_icons/".$icon.".png' />";
	} else {
		if ($size == "big")
			$output = "<span class='designare_icon bigicons'><img class='designare_icon' src='".get_template_directory_uri()."/img/designare_icons/".$icon."_big.svg' />"; 
		else $output = "<span class='designare_icon'><img class='designare_icon' src='".get_template_directory_uri()."/img/designare_icons/".$icon.".svg' />";
	}

	$output .= "</span>";
	
	return $output;
}
add_shortcode('desicon', 'des_icon', 90);

/* smartbox non-visual shortcodes */

function des_button($atts,$content=null){

	$defaults = array('target'=>'_self', 'link'=>'#', 'color'=>'blue', 'size'=>'medium', 'background'=>'','border'=>'','icon'=>'','align_button'=>'','a_fffect'=>'', 'delay'=>'','hover_bg_color'=>'', 'hover_border'=>'', 'hover_text_icon_color'=>'' );
	extract(shortcode_atts($defaults,$atts));
	
	$delay_style = "";
	if ($delay != ""){
		if (strpos($delay,"s") == false) $delay .= "s";
		$delay_style = "-webkit-animation-delay: $delay;-moz-animation-delay: $delay;-ms-animation-delay: $delay;-o-animation-delay: $delay;";
	}
	$output = "<a target='$target' href='$link' class='des-sc-button button $size $a_fffect  ";
	if (!strstr($color, "#")){
		 $output .= "$color' style='$delay_style'";
	} else {
		$output .= "' style='$delay_style color:$color;border:1px solid $border;background:$background; float:$align_button' onmouseover='jQuery(this).css({\"background-color\":\"$hover_bg_color\", \"border-color\":\"$hover_border\", \"color\":\"$hover_text_icon_color\"});'  onmouseout='jQuery(this).css({\"background-color\":\"$background\", \"border-color\":\"$border\", \"color\":\"$color\"});'";
	}
	$output .= "><span>";
	if ($icon != ""){
		$output .= "<i class='icon-$icon'></i>";
	}
	$output .= $content."</span></a>";
	return $output;
}
add_shortcode('button','des_button', 90);

function des_columns_container($atts,$content=null){
	return "<div class='main_cols container'>".do_shortcode($content)."</div>";
} add_shortcode('columns_container','des_columns_container',90);

function des_columns_one_oneth($atts,$content=null){
	return "<div class='sixteen columns'>".do_shortcode($content)."</div>";
} add_shortcode('one-oneth','des_columns_one_oneth',90);

function des_columns_one_half($atts,$content=null){
	return "<div class='eight columns'>".do_shortcode($content)."</div>";
} add_shortcode('one-half','des_columns_one_half',90);

function des_columns_one_third($atts,$content=null){
	return "<div class='one-third column'>".do_shortcode($content)."</div>";
} add_shortcode('one-third','des_columns_one_third',90);

function des_columns_one_fourth($atts,$content=null){
	return "<div class='four columns'>".do_shortcode($content)."</div>";
} add_shortcode('one-fourth','des_columns_one_fourth',90);

function des_columns_two_thirds($atts,$content=null){
	return "<div class='two-thirds column'>".do_shortcode($content)."</div>";
} add_shortcode('two-thirds','des_columns_two_thirds',90);

function des_columns_three_fourths($atts,$content=null){
	return "<div class='twelve columns'>".do_shortcode($content)."</div>";
} add_shortcode('three-fourths','des_columns_three_fourths',90);

function des_dropcap($atts,$content=null){
	return "<span class='dropcap'>$content</span>";
} add_shortcode('dropcap','des_dropcap',90);

function des_quote($atts,$content=null){
	return "<div class='des-sc-quote'><p>".do_shortcode($content)."</p></div>";
} add_shortcode('quote','des_quote',90);

function des_highlight($atts,$content=null){
	return "<span class='shortcode-highlight'>$content</span>";
} add_shortcode('highlight','des_highlight',90);

function des_abbr($atts,$content=null){
	$defaults = array('abbreviation'=>'', 'fulltext'=>'');
	extract(shortcode_atts($defaults,$atts));
	return "<abbr title='$fulltext'>".do_shortcode($abbreviation)."</abbr>";
} add_shortcode('abbr','des_abbr',90);

function des_box($atts,$content=null){
	$defaults = array('type'=>'normal', 'size'=>'', 'style'=>'', 'border'=>'', 'icon'=>'');
	extract(shortcode_atts($defaults,$atts));
	$output = "<div class='des-sc-box $type $size $style $border'";
	if ($icon === "none"){
		$output .= "style='padding-left:15px;background-image:none;'";
	} else if ($icon != ""){
		$output .= "style='padding-left:50px;background-image:url($icon); background-repeat:no-repeat; background-position:20px 45%;'";
	}
	$output .= ">".do_shortcode($content)."</div>";
	return $output;
} add_shortcode('box','des_box',90);

function des_single_line_divider($atts,$content=null){
	return "<div class='simple-line'></div>";
} add_shortcode('single_line_divider','des_single_line_divider',90);

function des_double_line_divider($atts,$content=null){
	return "<div class='des-sc-dots-divider'></div>";
} add_shortcode('double_line_divider','des_double_line_divider',90);

?>