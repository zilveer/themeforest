<?php
/**
 * Theme Name: proStore
 * Theme URI: http://themeforest.net/user/gnrocks/portfolio
 * Theme demo : http://rchour.net/prostore
 * Description: A WordPress premium theme exclusively for sale on ThemeForest
 *
 * Author: gnrocks
 * Author URI: http://themeforest.net/user/gnrocks
 * License : http://codex.wordpress.org/GPL & http://wiki.envato.com/support/legal-terms/licensing-terms/
 *
 *
 * @package 	proStore/library/shortcodes/core.php
 * @file	 	1.2
 *
 *  1. Alert boxes
 *	2. Buttons
 * 	3. Columns
 * 	4. Gallery
 *  5. Icons
 *  6. Lists
 *	7. Pricing tables
 *  8. Quotes
 * 	9. Tooltips
 * 	10.Dividers
 *  11.Tabs
 * 	12.Accordion
 *	13.Toggle
 * 	14.Flex Slider
 *	15.Videos
 *	16.Audio
 *	17.Post by ID
 *	18.Posts by ID
 * 	19.Posts by category
 *	20.Random posts
 *	21.Posts (global)
 *	22.Portfolio posts
 *
 *
 */
?>
<?php

	/**
	 * ------------------------------------------------------------------------
	 * 1. Alert boxes
	 *
	 * [alert type="" close=""]
	 *
	 * @atts
	 *	type 	[primary, secondary, tertiary, alert, success, warning, info, inverse]
	 *  close	[on, off]
	 *
	 * ------------------------------------------------------------------------
	 */
		if ( ! function_exists( 'sc_alert' ) ) :

			function sc_alert( $atts, $content = null ) {

				if ( empty( $atts ) ) return;

				extract( shortcode_atts( array(
				  'type' => 'primary',
				  'close' => 'off',
				  ), $atts ) );

				$alert .='<div class="alert-box '.$type;
				$alert .= '">';
				if($close == 'on') {
					$alert .= '<a href="" class="close">&times;</a>';
				}
				$alert .= $content;
				$alert .= '</div>';
				return $alert;
			}

			add_shortcode('alert', 'sc_alert');

		endif;

	/**
	 * ------------------------------------------------------------------------
	 * 2. Buttons
	 *
	 * [button color="" to="" target="" size="" style="" icon=""]...[/button]
	 *
	 * @atts
	 *	close 	[primary, secondary, tertiary, alert, success, warning, info, inverse]
	 *  to		(optional - link)
	 *  target	(optional - link target)
	 *  size	[tiny, small, medium, large]
	 *  style	[normal, radius]
	 *	icon	(optional - list of icons : icon-…)
	 *
	 * ------------------------------------------------------------------------
	 */
		if ( ! function_exists( 'sc_button' ) ) :

			function sc_button($atts, $content = null) {

				if ( empty( $atts ) ) return;

				extract(shortcode_atts(array(
					"color" => 'primary',
					"to"	=> '',
					"target"=> '',
					"size"  => 'medium',
					"style" => '',
					"icon"  => '',
				), $atts));

				$button = '<a ';
				if($target=="_blank") {
					$button .= ' target="'.$target.'"';
				}
				$button .= ' href="'.$to.'"';
				$button .=' class="button '.$color.' '.$size.' '.$style.'">';

				if($icon!="") {
					$button .= '<em class="'.$icon.'"></em> ';
				}
				$button .= $content;
				$button .='</a>';
				return $button;
			}

			add_shortcode("button", "sc_button");

		endif;

	/**
	 * ------------------------------------------------------------------------
	 * 3. Columns
	 *
	 * [row]..[/row]
	 * [colX]..[/colX]
	 *
	 * @atts
	 *	colX	[col1, col2, col3, col4, col6, col32, col43, col65]
	 *
	 * ------------------------------------------------------------------------
	 */
		// Row
		if ( ! function_exists( 'sc_row' ) ) :

			function sc_row( $atts, $content = null ) {

			   return '<div class="row-fluid clearfix">' . wpautop(do_shortcode(trim($content))) . '</div>';

			}

			add_shortcode('row', 'sc_row');

		endif;

		// 1 col
		if ( ! function_exists( 'sc_col1' ) ) :

			function sc_col1( $atts, $content = null ) {

			   return '<div class="twelve columns">' . wpautop(do_shortcode(trim($content))) . '</div>';

			}

			add_shortcode('col1', 'sc_col1');

		endif;

		// 2 cols
		if ( ! function_exists( 'sc_col2' ) ) :

			function sc_col2( $atts, $content = null ) {

			   return '<div class="six columns">' . wpautop(do_shortcode(trim($content))) . '</div>';

			}

			add_shortcode('col2', 'sc_col2');

		endif;

		// 3 cols
		if ( ! function_exists( 'sc_col3' ) ) :

			function sc_col3( $atts, $content = null ) {

		   		return '<div class="four columns">' . wpautop(do_shortcode(trim($content))) . '</div>';

			}

			add_shortcode('col3', 'sc_col3');

		endif;

		// 4 cols
		if ( ! function_exists( 'sc_col4' ) ) :

			function sc_col4( $atts, $content = null ) {

			   return '<div class="three columns">' . wpautop(do_shortcode(trim($content))) . '</div>';

			}

			add_shortcode('col4', 'sc_col4');

		endif;

		// 6 cols
		if ( ! function_exists( 'sc_col6' ) ) :

			function sc_col6( $atts, $content = null ) {

			   return '<div class="two columns">' . wpautop(do_shortcode(trim($content))) . '</div>';

			}

			add_shortcode('col6', 'sc_col6');

		endif;

		// 2/3 cols
		if ( ! function_exists( 'sc_col32' ) ) :

			function sc_col32( $atts, $content = null ) {

			   return '<div class="eight columns">' . wpautop(do_shortcode(trim($content))) . '</div>';

			}

			add_shortcode('col32', 'sc_col32');

		endif;

		// 3/4 cols
		if ( ! function_exists( 'sc_col43' ) ) :

			function sc_col43( $atts, $content = null ) {

			   return '<div class="nine columns">' . wpautop(do_shortcode(trim($content))) . '</div>';

			}

			add_shortcode('col43', 'sc_col43');

		endif;

		// 5/6 cols
		if ( ! function_exists( 'sc_col65' ) ) :

			function sc_col65( $atts, $content = null ) {

			   return '<div class="ten columns">' . wpautop(do_shortcode(trim($content))) . '</div>';

			}

			add_shortcode('col65', 'sc_col65');

		endif;

	/**
	 * ------------------------------------------------------------------------
	 * 4. Gallery
	 *
	 * @wp-includes/media.php (line 665)
	 *
	 * ------------------------------------------------------------------------
	 */
		remove_shortcode('gallery', 'gallery_shortcode');

		if ( ! function_exists( 'sc_gallery_custom' ) ) :

			function sc_gallery_custom($attr) {

				global $post, $wp_locale;

				$args = array( 'post_type' => 'attachment', 'number posts' => -1, 'post_status' => null, 'post_parent' => $post->ID );
				$attachments = get_posts($args);
				if ($attachments) {
					$output = '<div class="row-fluid"><ul class="thumbnails">';
					foreach ( $attachments as $attachment ) {
						$output .= '<li>';
						$att_title = apply_filters( 'the_title' , $attachment->post_title );
						$att_src = wp_get_attachment_image_src( $attachment->ID , 'thumbnail', false);
						$att_full = wp_get_attachment_image_src( $attachment->ID , 'full', false);
						$output .= "<a href='".$att_full[0]."' class='thumbnail fancybox' rel='gallery-".$post->ID."'><img src='".$att_src[0]."'></a>";
						$output .= '</li>';
					}
					$output .= '</ul></div>';
				}

				return $output;

			}

			add_shortcode('gallery', 'sc_gallery_custom');

		endif;

	/**
	 * ------------------------------------------------------------------------
	 * 5. Icons
	 *
	 * [icon type=""]
	 *
	 * @atts
	 *	type	(list of icons : icon-…)
	 *
	 * ------------------------------------------------------------------------
	 */
		if ( ! function_exists( 'sc_icon' ) ) :

			function sc_icon($atts, $content = null) {

				if ( empty( $atts ) ) return;

				extract(shortcode_atts(array(
					"type" => ''
				), $atts));

				if ( !$type ) return;

				$icon = '<em class="'.$type.'"></em>';

				return $icon;
			}

			add_shortcode("icon", "sc_icon");

		endif;

	/**
	 * ------------------------------------------------------------------------
	 * 6. Lists
	 *
	 * <ul class="icons">
	 *	<li><em class="@atts(icon)"></em> …</li>
	 *  ...
	 * </ul>
	 *
	 * @atts
	 *	icon	(list of icons : icon-…)
	 *
	 * ------------------------------------------------------------------------
	 */

	/**
	 * ------------------------------------------------------------------------
	 * 7. Pricing tables
	 *
	 * <ul class="pricing-table @atts(selected)">
	 *	<li class="title">…</li>
	 *	<li class="price @atts(color)">…</li>
	 *	<li class="description">…</li>
	 *	<li class="bullet-item">…</li>
	 *		…
	 *	<li class="bullet-item">…</li>
	 *	<li class="cta-button"><a class="button large @atts(color)" href=""><em class=""></em> …</a></li>
	 * </ul>
	 *
	 * @atts
	 *	selected	(optional)
	 *	color		(optional) [primary, secondary, tertiary, alert, success, warning, info, inverse]
	 *
	 * ------------------------------------------------------------------------
	 */

	/**
	 * ------------------------------------------------------------------------
	 * 8. Quotes
	 *
	 * [pullquote cite""]...[/pullquote]
	 *
	 * @atts
	 *	cite	(optional)
	 *
	 * ------------------------------------------------------------------------
	 */
		if ( ! function_exists( 'sc_pullquote' ) ) :

			function sc_pullquote( $atts, $content = null ) {

			   extract( shortcode_atts( array(
				  'cite' => ''
				  ), $atts ) );
				$pullquote = '<blockquote>';

				$pullquote .= '<p>' . $content . '</p>';

				if($cite){
					$pullquote .= '<cite>' . $cite . '</cite>';
				}

				$pullquote .= '</blockquote>';

			   return $pullquote;

			}

			add_shortcode('pullquote', 'sc_pullquote');

		endif;

	/**
	 * ------------------------------------------------------------------------
	 * 9. Tooltips
	 *
	 * [tooltip link="" title="" orientation="" width=""]…[/tooltip]
	 *
	 * @atts
	 *	link		(optional - text)
	 *	title		(optional - text)
	 *	orientation [top, bottom, left, right]
	 *	width		(optional)
	 *
	 * ------------------------------------------------------------------------
	 */
		if ( ! function_exists( 'sc_tooltip' ) ) :

			function sc_tooltip ($atts, $content = null) {

				if ( empty( $atts ) ) return;

				extract(shortcode_atts(array(
					"title"	=> '',
					"link"=> '',
					"orientation"=> '',
					"width"=> ''
				), $atts));

				if ( !$title ) return;

				$tooltip .= '<a class="has-tip ';
				if($orientation!="") { $tooltip .= 'tip-'.$orientation; }
				$tooltip .= '" title="'.$title.'" ';
				if($width!="") { $tooltip .= 'data-width="'.$width.'"'; }
				$tooltip .= 'href="'.$link.'">';
				$tooltip .= $content;
				$tooltip .='</a>';

				return $tooltip;

			}

			add_shortcode("tooltip", "sc_tooltip");

		endif;

	/**
	 * ------------------------------------------------------------------------
	 * 10.Dividers
	 *
	 * [hr]
	 * [spacer]
	 * [clear]
	 *
	 * ------------------------------------------------------------------------
	 */
		// Horizontal rule
		if ( ! function_exists( 'sc_hrule' ) ) :

			function sc_hrule() {

			   return '<hr>';

			}

			add_shortcode('hr', 'sc_hrule');

		endif;

		// spacer
		if ( ! function_exists( 'sc_spacer' ) ) :

			function sc_spacer() {

			   return '<div class="spacer"></div>';

			}

			add_shortcode('spacer', 'sc_spacer');

		endif;

		// clear line
		if ( ! function_exists( 'sc_clear_float' ) ) :

			function sc_clear_float() {

			   return '<div class="clear"></div>';

			}

			add_shortcode('clear', 'sc_clear_float');

		endif;

	/**
	 * ------------------------------------------------------------------------
	 * 11.Tabs
	 *
	 * [tabs type=""]
	 *	[tab title="…"]
	 *		…
	 *	[/tab]
	 * [/tabs]
	 *
	 * @atts
	 *	type	[normal, pills, vertical]
	 *	title	(required - text)
	 *
	 * ------------------------------------------------------------------------
	 */
		if ( ! function_exists( 'sc_atabs' ) ) :

			function sc_atabs( $atts, $content ){

				if ( empty( $atts ) ) return;

				extract( shortcode_atts( array(
				  'type' => 'normal'
				  ), $atts ) );

				$GLOBALS['tabs']="";
				$GLOBALS['tab_count'] = 0;

				wpautop(do_shortcode( $content ));

				if( is_array( $GLOBALS['tabs'] ) ){
					$counter=1;
					foreach( $GLOBALS['tabs'] as $tab ){
						$i=ceil(rand(1,100));
						if($counter==1) { $class="active"; } else { $class=""; }
						if($type=='nav-tabs' || $type=='nav-tabs nav-stacked') { $data_toggle="tab"; } else { $data_toggle="pill"; }
						$tabs[] = '<dd class="'.$class.'"><a href="#tab'.$i.'" data-toggle="'.$data_toggle.'">'.$tab['title'].'</a></dd>';
						$panes[] = '<li id="tab'.$i.'" class="'.$class.'">'.wpautop($tab['content']).'</li>';
						$counter++;
					}

				if($orientation=="tabs-top") { $orientation=""; }

				//$tabscode  = '<div class="tabbable '.$orientation.'">';

				$tabscode .= '<dl class="tabs '.$type.'">'.implode( "\n", $tabs ).'</dl>';
				$tabscode .= '<ul class="tabs-content">'.implode( "\n", $panes ).'</ul>';

				//$tabscode .= '</div>';
				}
				return wpautop(do_shortcode($tabscode));
			}

			add_shortcode( 'tabs', 'sc_atabs' );

		endif;

		if ( ! function_exists( 'sc_mtab' ) ) :

			function sc_mtab( $atts, $content ){

				if ( empty( $atts ) ) return;

				extract(shortcode_atts(array(
				'title' => 'Tab %d',
				), $atts));

				$x = $GLOBALS['tab_count'];
				$GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'content' =>  $content );


				$GLOBALS['tab_count']++;
			}

			add_shortcode( 'tab', 'sc_mtab' );

		endif;

	/**
	 * ------------------------------------------------------------------------
	 * 12.Accordion
	 *
	 * [accordiontab]
	 *	[accordion title="…"]
	 *		…
	 *	[/accordion]
	 * [/accordiontab]
	 *
	 * @atts
	 *	title	(required - text)
	 *
	 * ------------------------------------------------------------------------
	 */
		if ( ! function_exists( 'sc_acctabs' ) ) :

			function sc_acctabs( $atts, $content ){

				$GLOBALS['tabs']="";
				$GLOBALS['tab_count'] = 0;

				do_shortcode( $content );

				if( is_array( $GLOBALS['tabs'] ) ){
					$counter=1;
					$tabscode ='<ul class="accordion">';
					$i=1;
					foreach( $GLOBALS['tabs'] as $tab ){
						if($counter==1) { $class="active"; } else { $class=""; }
						$tabscode .= '<li class="'.$class.'">';
						$tabscode .= '<div class="title">';
						$tabscode .= '<h5>'.$tab['title'].'</h5>';
						$tabscode .= '</div>';
						$tabscode .= '<div class="content">';
						$tabscode .= ''.wpautop($tab['content']).'';
						$tabscode .= '</div>';
						$tabscode .= '</li>';
						$i++;
						$counter++;
					}
				}
				$tabscode .= '</ul>';
				return do_shortcode($tabscode);

			}

			add_shortcode( 'accordion', 'sc_acctabs' );

		endif;

		if ( ! function_exists( 'sc_maccordiontab' ) ) :

			function sc_maccordiontab( $atts, $content ){

				if ( empty( $atts ) ) return;

				extract(shortcode_atts(array(
				'title' => 'Tab %d',
				), $atts));

				$x = $GLOBALS['tab_count'];
				$GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'content' =>  $content );

				$GLOBALS['tab_count']++;

			}

			add_shortcode( 'accordiontab', 'sc_maccordiontab' );

		endif;

	/**
	 * ------------------------------------------------------------------------
	 * 13.Toggle
	 *
	 * [toggle title="" default=""]…[/toggle]
	 *
	 * @atts
	 *	title	(required - text)
	 *	default	[open,closed]
	 *
	 * ------------------------------------------------------------------------
	 */
		if ( ! function_exists( 'sc_toggle' ) ) :

			function sc_toggle( $atts, $content = null ) {

				if ( empty( $atts ) ) return;

			   extract( shortcode_atts( array(
				  'title' => 'Toggle',
				  'default' => 'open'
				  ), $atts ) );

				if ( !$title ) return;

				$toggle .= '<ul class="accordion toggle">';
				if($default=="open") {$class="active";}
				$toggle .= '<li class="'.$class.'">';

				$toggle .= '<div class="title">';
				$toggle .= '<h5>'.$title.'</h5>';
				$toggle .= '</div>';

				$toggle .= '<div class="content">'.$content.'</div>';

				$toggle .= '</li>';
				$toggle .= '</ul>';

				$toggle = do_shortcode($toggle);

				return $toggle;

			}

			add_shortcode('toggle', 'sc_toggle');

		endif;

	/**
	 * ------------------------------------------------------------------------
	 * 14.FlexSlider
	 *
	 * [slider type="" zoom="" expand="" nav="" nav_c="" bullets="" link_i=""]
	 *
	 * @atts
	 *	type	[slider, carousel, slider_carousel]
	 *	zoom	[0,1]	(activate zoom feature)
	 *  expand	[0,1]	(activate expand feature)
	 *	nav		[0,1]	(arrow navigation on slider)
	 *	nav_c	[0,1]	(arrow navigation on carousel)
	 *	bullets	[0,1]	(bullets navigation)
	 *	link_i	[0,1]	(link images to image post)
	 *
	 * ------------------------------------------------------------------------
	 */
		if ( !function_exists( 'efs_get_slider' ) ) {
			function efs_get_slider($id,$slideshow,$thumbnail,$zoom,$expand,$slider_args,$gallery,$gallery_ids) {

				if($gallery=="true" && $gallery_ids != '') {
					// Using WP3.5; use post__in orderby option
					$image_ids = explode(',', $gallery_ids);
					$temp_id = $id;
					$id = null;
					$orderby = 'post__in';
					$include = $image_ids;
				} else {
					$orderby = 'menu_order';
					$include = '';
				}

		        $args = array(
		        	'include' => $include,
		        	'order' => 'ASC',
		        	'orderby' => $orderby,
		        	'post_type' => 'attachment',
		        	'post_parent' => $id,
		        	'post_mime_type' => 'image',
		        	'post_status' => null,
		        	'numberposts' => -1
		        );
		        $images = get_posts($args);

		        $id = ( isset($temp_id) ) ? $temp_id : $id;

				$number = count($images);

				$image_src = array();
				$i=1;
				$slider = "";

				if(!$slider_args) {
					$slider_args = array(
								'minItems'=>3,
								'maxItems'=>5,
								'smoothHeight'=>'true',
								'controlNav'=>'false',
								'directionNav'=>'true',
								'directionNavC'=>'true',
								'linked'=>'false',
								'link'=>'image'
							);
				} else {
					if (!isset($slider_args['minItems'])) {
						$slider_args['minItems'] = "3";
					}
					if (!isset($slider_args['maxItems'])) {
						$slider_args['maxItems'] = "5";
					}
					if (!isset($slider_args['smoothHeight'])) {
						$slider_args['smoothHeight'] = "true";
					}
					if (!isset($slider_args['controlNav'])) {
						$slider_args['controlNav'] = "false";
					}
					if (!isset($slider_args['directionNav'])) {
						$slider_args['directionNav'] = "true";
					}
					if (!isset($slider_args['directionNavC'])) {
						$slider_args['directionNavC'] = "true";
					}
					if (!isset($slider_args['linked'])) {
						$slider_args['linked'] = "false";
					}
					if (!isset($slider_args['link'])) {
						$slider_args['link'] = "image";
					}
				}

				global $sArgs;
				$sArgs = $slider_args;

				$image_src = array();
				$i = 0;
				if($images) {
					foreach ($images as $id=>$image) {
						$image_id = $image->ID;
						$image_att = wp_get_attachment_image_src($image_id,'full');
						if($thumbnail == "true") {
							$thumb_att = wp_get_attachment_image_src($image_id,'edit-screen-thumbnail');
						} else {
							$thumb_att = array('','','');
						}
						$image_src[$i] = array($image_att[0],$thumb_att[0],$image_id);
						$i++;
					}
				}

				/*
if($vimeo) {
					$array_vimeo_1 = array_map('trim',explode(';',$vimeo));
					$array_vimeo=array();
					foreach($array_vimeo_1 as $index=>$array_vimeo_x) {
						if (strlen(strstr($array_vimeo_x,','))>0) {
							$array_vimeo[]=$array_vimeo_x;
						}
					}
				}
				if($youtube) {
					$array_youtube_1 = array_map('trim',explode(';',$youtube));
					$array_youtube=array();
					foreach($array_youtube_1 as $index=>$array_youtube_x) {
						if (strlen(strstr($array_youtube_x,','))>0) {
							$array_youtube[]=$array_youtube_x;
						}
					}
				}

				$arr = array();
				foreach($array_vimeo as $key => $value) {
					$values = explode(",",$value);
					$values[]="vimeo";
					$arr[]=$values;
				}
				foreach($array_youtube as $key => $value) {
					$values = explode(",",$value);
					$values[]="youtube";
					$arr[]=$values;
				}
				//print_r($arr);
				foreach($arr as $key=>$value) {
					$total=count($image_src);
					$pos = $value[0];
					if($pos > $total) {
						$image_src[]=$value;
					} else {
						array_splice($image_src, $pos, 0, array($value));
					}
				print_r($image_src);
				}
*/


				//echo get_vid_sc(get_post_meta($post->ID,'format_video_provider',true),get_post_meta($post->ID,'format_video_id',true));

				//print_r($image_src);

				global $sID, $cID, $carousel,$main_slider,$zoom_active, $data, $prefix;

				if($slideshow == "true") {
					$sID = "slider" . dechex(time()).dechex(mt_rand(1,65535));
					$main_slider = "true";
				}
				if($thumbnail == "true") {
					$cID = "carousel" . dechex(time()).dechex(mt_rand(1,65535));
					$carousel = "true";
				}
				if($zoom == "true" && $data[$prefix.'optimize_zoom']!="1") {
					$zoom_active = "true";
				} else {
					$zoom_active = "false";
				}


				if($i>0 && $slideshow == "true") {

					$slider = '<div id="'.$sID.'" class="flexslider';
					if($zoom_active=="true") {
						$slider .= ' image-zoomed';
					}
					$slider .= '">';
						if($zoom_active == "true") {
							$slider .= '<span class="helper-zoom"><em class="icon-search"></em> Hover to zoom</span>';
						}
						if($expand == "true") {
								$slider .= '<span class="helper-expand"><em class="icon-resize-full-2"></em>Click to expand</span>';
						}
						$slider .= '<ul class="slides clearfix" ';
						if($expand == "true") $slider .= 'data-clearing';
						$slider .= '>';
							foreach ($image_src as $id=>$image) {
								$slider .= '<li>';
								if($slider_args['linked']=="true" && $expand=="false") {
									if($slider_args['link']=="image") {
										$slider .= '<a href="'.get_permalink($image[2]).'">';
									}
								}
								$title = wp_get_attachment($image[2]);
								$title = $title['caption']!="" ? $title['caption'] : $title['title'];
								$slider .= '<img data-caption="'.$title.'" src="'.$image[0].'" data-url-full="'.$image[0].'" title="'.$title.'">';
								if($slider_args['linked']=="true") {
									$slider .= '</a>';
								}
								$slider .= '</li>';
							}
						$slider .= '</ul><div class="clear"></div>';
					$slider .= '</div><div class="clear"></div>';
				}

				if($i>1 && $thumbnail == "true") {
					$slider .= '<div id="'.$cID.'" class="flexslider thumbnail-carousel';
					if($slideshow=="false") {
						$slider .= ' standalone';
					}
					$slider .= '">';
						$slider .= '<ul class="slides">';
							foreach ($image_src as $id=>$image) {
								$slider .= '<li>';
								if($slider_args['linked']=="true") {
									if($slider_args['link']=="image") {
										$slider .= '<a href="'.get_permalink($image[2]).'">';
									}
								}
								$slider .= '<img src="'.$image[1].'" data-url-full="'.$image[1].'">';
								if($slider_args['linked']=="true" && $slider_args['link']=="image") {
									$slider .= '</a>';
								}
								$slider .= '</li>';
							}
						$slider .='</ul>';
					$slider .='</div>';
				}

				//function print_my_inline_script() {
					global $sID, $cID, $carousel,$main_slider,$sArgs,$zoom_active;
					?>
					<script type="text/javascript">
						/* <![CDATA[ */
						jQuery(window).load(function() {
							<?php if($carousel=="true") { ?>
								jQuery("#<?php echo $cID; ?>").flexslider({
									animation: "slide",
									controlNav: <?php echo $sArgs['controlNav']; ?>,
									directionNav : <?php echo $sArgs['directionNavC']; ?>,
									smoothHeight : <?php echo $sArgs['smoothHeight']; ?>,
									animationLoop: false,
									slideshow: false,
									itemWidth: 100,
									itemMargin: 0,
									minItems : <?php echo $sArgs['minItems']; ?>,
									maxItems : <?php echo $sArgs['maxItems']; ?>
									<?php if($main_slider=="true") { ?>
									,asNavFor: '#<?php echo $sID; ?>'
									<?php } ?>
								});
							<?php } ?>
							<?php if($main_slider=="true") { ?>
								jQuery("#<?php echo $sID; ?>").imagesLoaded(function(){
									jQuery("#<?php echo $sID; ?>").flexslider({
										animation: "fade",
										controlNav: <?php echo $sArgs['controlNav']; ?>,
										directionNav: <?php echo $sArgs['directionNav']; ?>,
										animationLoop: false,
										slideshow: false,
										smoothHeight : <?php echo $sArgs['smoothHeight']; ?>,
										pauseOnHover : true,
										mousewheel : false
										<?php if($carousel=="true") { ?>
										,sync: "#<?php echo $cID; ?>"
										<?php } ?>
										,start: function(slider){
										  jQuery('body').removeClass('loading');
										}
									});
								});
							<?php } ?>
							<?php if($zoom_active == "true") { ?>
								var $images = jQuery(".flexslider.image-zoomed .slides img").each(function() {
									jQuery(this).parent().zoom({
										url: jQuery(this).attr("data-url-full"),
										on : "mouseover",
										icon : false,
										callback: function() {
											var data_caption = jQuery(this).prev().attr('data-caption');
											jQuery(this).attr('data-caption',data_caption);
										}
									});
								});
							<?php } ?>
						});
						/* ]] */
					</script>
					<?php
				//}
				//add_action( 'wp_footer', 'print_my_inline_script' );

				return $slider;
			}
		}
		if ( !function_exists( 'efs_insert_slider' ) ) {
			function efs_insert_slider($atts, $content=null){

				if ( empty( $atts ) ) return;

				extract( shortcode_atts( array(
					'type' 		=> 'slider',
				  	'zoom'   	=> '0',
				  	'expand'    => '0',
				  	'nav'		=> '0',
				  	'nav_c'     => '0',
				  	'bullets'   => '0',
				  	'link_i' 	=> '0'
					), $atts ) );

				if ( !$type ) return;

				global $post;
				$id = $post->ID;

				$slideshow = "false"; $thumbnail = "false";

				switch($type) {
					case "slider" :
						$slideshow = "true";
						break;
					case "carousel" :
						$thumbnail = "true";
						break;
					case "slider_carousel" :
						$slideshow = "true"; $thumbnail="true";
				}

				$zoom = ($zoom == "1") ? "true" : "false";

				$expand = ($expand == "1") ? "true" : "false";

				$slider_args['directionNav'] = ($nav == "1") ? "true" : "false";

				$slider_args['directionNavC'] = ($nav_c == "1") ? "true" : "false";

				$slider_args['controlNav'] = ($bullets == "1") ? "true" : "false";

				if($link_i=="1") {
					$slider_args['linked']="true";
					$slider_args['link']="image";
				}

				$flex_slider = efs_get_slider($id,$slideshow,$thumbnail,$zoom,$expand,$slider_args,$gallery,$gallery_ids);

				return $flex_slider;

			}
			add_shortcode('slider', 'efs_insert_slider');
		}

		if ( !function_exists( 'efs_slider' ) ) {
			function efs_slider(){
				print efs_get_slider();
			}
		}

	/**
	 * ------------------------------------------------------------------------
	 * 15.Videos
	 *
	 * [video_embed site="" id=""]
	 *
	 * @atts
	 *	site	[youtube, vimeo, dailymotion, yahoo, bliptv, veoh, viddler]
	 *	id		(id of video)
	 *
	 * ------------------------------------------------------------------------
	 */
		if ( !function_exists( 'get_vid_sc' ) ) {

			function get_vid_sc($site, $id){

				if(!$site || !$id) return;

				if ( $site == "youtube" ) { $src = 'http://www.youtube-nocookie.com/embed/'.$id; }
			    else if ( $site == "vimeo" ) { $src = 'http://player.vimeo.com/video/'.$id.'?title=0&byline=0&portrait=0&player_id=vimeoplayer'; }
			    else if ( $site == "dailymotion" ) { $src = 'http://www.dailymotion.com/embed/video/'.$id; }
			    else if ( $site == "yahoo" ) { $src = 'http://d.yimg.com/nl/vyc/site/player.html#vid='.$id; }
			    else if ( $site == "bliptv" ) { $src = 'http://a.blip.tv/scripts/shoggplayer.html#file=http://blip.tv/rss/flash/'.$id; }
			    else if ( $site == "veoh" ) { $src = 'http://www.veoh.com/static/swf/veoh/SPL.swf?videoAutoPlay=0&permalinkId='.$id; }
			    else if ( $site == "viddler" ) { $src = 'http://www.viddler.com/simple/'.$id; }
			    if ( $id != '' ) {
			        return '<div class="video-container flex-video '.$site.'"><iframe src="'.$src.'" class="vid iframe-'.$site.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>';
			    }
			}
		}

		if ( !function_exists( 'insert_vid_sc' ) ) {

			function insert_vid_sc($atts, $content=null){

				if ( empty( $atts ) ) return;

			    extract(
			        shortcode_atts(array(
			            'site' => 'youtube',
			            'id' => '',
			        ), $atts)
			    );

				if ( !$site || !$id ) return;

				$video = get_vid_sc($site, $id);

				return $video;

			}

			add_shortcode('video_embed', 'insert_vid_sc');
		}

		if ( !function_exists( 'vid_sc' ) ) {

			function vid_sc(){

				print get_vid_sc($site, $id);

			}
		}

	/**
	 * ------------------------------------------------------------------------
	 * 16.Audio
	 *
	 * [audio_embed type="" link=""]
	 *
	 * @atts
	 *	type	[mp3, ogg]
	 *	link	(link to audio)
	 *
	 * ------------------------------------------------------------------------
	 */
		if ( !function_exists( 'get_aud_sc' ) ) {

			function get_aud_sc($type, $link) {
				if(!$type || !$link) return;
				$meta=array('audio_'.$type.'_url'=>$link);
				$formats=array();
				foreach(explode('|','mp3|ogg') as $format) {
					if(isset($meta['audio_'.$format.'_url'])) {
						$format=(($format=='ogg')?'oga':$format);
						$formats[]=$format;
					}
				}
				$aID = dechex(time()).dechex(mt_rand(1,65535));
				?>
				<script type="text/javascript">
					/* <![CDATA[ */
					jQuery(document).ready(function(){
						if(jQuery().jPlayer) {
							jQuery("#jquery_jplayer_<?php echo $aID; ?>").jPlayer({
								ready: function () {
									jQuery(this).jPlayer("setMedia", {
										<?php if(in_array('mp3',$formats)) { echo 'mp3: "'.$meta['audio_mp3_url'].'",'."\n"; } ?>
										<?php if(in_array('oga',$formats)) { echo 'oga: "'.$meta['audio_ogg_url'].'",'."\n"; } ?>
									});
								},
								swfPath: "<?php echo get_template_directory_uri() ?>/js/",
								cssSelectorAncestor: "#jp_interface_<?php echo $aID; ?>",
								supplied: "<?php echo implode(',',$formats); ?>"
							});
						}
					});
					/* ]] */
				</script>
				<?php

				return '<div class="entry-format audio fix"><div id="jquery_jplayer_'.$aID.'" class="jp-jplayer"></div><div class="jp-audio"><div id="jp_interface_'.$aID.'" class="jp-interface"><ul class="jp-controls"><li><a href="#" class="jp-play" tabindex="1">play</a></li><li><a href="#" class="jp-pause" tabindex="1">pause</a></li><li><a href="#" class="jp-mute" tabindex="1">mute</a></li><li><a href="#" class="jp-unmute" tabindex="1">unmute</a></li></ul><div class="jp-progress-container"><div class="jp-progress"><div class="jp-seek-bar"><div class="jp-play-bar"></div></div></div></div><div class="jp-volume-bar-container"><div class="jp-volume-bar"><div class="jp-volume-bar-value"></div></div></div></div></div></div>';

			}
		}

		if ( !function_exists( 'insert_aud_sc' ) ) {

			function insert_aud_sc($atts, $content=null){

				if ( empty( $atts ) ) return;

			    extract(
			        shortcode_atts(array(
			            'type' => 'mp3',
			            'link' => '',
			        ), $atts)
			    );

				if ( !$type || !$link ) return;

				$audio = get_aud_sc($type, $link);

				return $audio;

			}

			add_shortcode('audio_embed', 'insert_aud_sc');
		}

	/**
	 * ------------------------------------------------------------------------
	 * 17.Post by ID
	 *
	 * [post_by_id id="" link=""]
	 *
	 * @atts
	 *	id				(integer)
	 *	layout			[mini, masonry, fitrows]
	 *
	 * ------------------------------------------------------------------------
	 */

		if ( ! function_exists( 'sc_post_by_id' ) ) :

			function sc_post_by_id ( $atts ){

				global $data, $prefix;

			  	if ( empty( $atts ) ) return;

				extract( shortcode_atts( array(
				  	'id'		=> '',
				  	'layout'        => $data[$prefix."default_masonry"],
					), $atts ) );

				if ( !$id ) return;

			  	$args = array(
					'post_type'	=> array('post'),
					'post_status' => 'publish',
					'p' => esc_attr($id),
				);

			  	ob_start();

				custom_posts_query($args,$layout,$pagination);

				return ob_get_clean();

			}

			add_shortcode('post_by_id', 'sc_post_by_id');

		endif;

	/**
	 * ------------------------------------------------------------------------
	 * 18.Posts by ID
	 *
	 * [posts_by_id id="" layout="" order="" orderby="" pagination="" per_page="" ignore_sticky=""]
	 *
	 * @atts
	 *	id				(integer separated by coma)
	 *	layout			[mini, masonry, fitrows]
	 *	order			http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters
	 *	orderby			http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters
	 *	pagination		[0, 1]
	 *	per_page		(optional - integer)
	 *	ignore_sticky	[0, 1]
	 *
	 * ------------------------------------------------------------------------
	 */

		if ( ! function_exists( 'sc_posts_by_id' ) ) :

			function sc_posts_by_ids ( $atts ){

				global $data, $prefix;

			  	if ( empty( $atts ) ) return;

				extract( shortcode_atts( array(
					'per_page' 		=> get_option('posts_per_page'),
				  	'orderby'   	=> 'date',
				  	'order'     	=> 'dsc',
				  	'id'		=> '',
				  	'pagination'    => '0',
				  	'layout'        => $data[$prefix."default_masonry"],
				  	'ignore_sticky' => '1'
					), $atts ) );

				if ( !$id ) return;

				$sticky = "";
				if($ignore_sticky=='1') $sticky = get_option( 'sticky_posts' );
				$paged = get_query_var('paged') ? get_query_var('paged') : 1;

			  	$args = array(
					'post_type'	=> array('post'),
					'post_status' => 'publish',
					'ignore_sticky_posts'	=> $ignore_sticky,
					'post__in' => explode(',', esc_attr($id)),
					'post__not_in' => $sticky,
					'orderby' => $orderby,
					'order' => $order,
					'posts_per_page' => $per_page,
					'paged' => $paged
				);

			  	ob_start();

				custom_posts_query($args,$layout,$pagination);

				return ob_get_clean();

			}

			add_shortcode('posts_by_id', 'sc_posts_by_ids');

		endif;

	/**
	 * ------------------------------------------------------------------------
	 * 19.Posts by categories
	 *
	 * [posts_by_categories id="" layout="" order="" orderby="" pagination="" per_page="" ignore_sticky="" only_sticky=""]
	 *
	 * @atts
	 *	id				(integer separated by coma)
	 *	layout			[mini, masonry, fitrows]
	 *	order			http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters
	 *	orderby			http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters
	 *	pagination		[0, 1]
	 *	per_page		(optional - integer)
	 *	ignore_sticky	[0, 1]
	 *	only_sticky		[0, 1]
	 *
	 * ------------------------------------------------------------------------
	 */

		if ( ! function_exists( 'sc_posts_by_categories' ) ) :

			function sc_posts_by_categories ( $atts ){

				global $data, $prefix;

			  	if ( empty( $atts ) ) return;

				extract( shortcode_atts( array(
					'per_page' 		=> get_option('posts_per_page'),
				  	'orderby'   	=> 'date',
				  	'order'     	=> 'dsc',
				  	'id'			=> '',
				  	'pagination'    => '0',
				  	'layout'        => $data[$prefix."default_masonry"],
				  	'ignore_sticky' => '1',
				  	'only_sticky' => '0'
					), $atts ) );

				if ( !$id ) return;

				$sticky_not = "";
				$sticky_in = "";
				if($ignore_sticky=='1') $sticky_not = get_option( 'sticky_posts' );
				if($only_sticky=='1') $sticky_in = get_option( 'sticky_posts' );
				$paged = get_query_var('paged') ? get_query_var('paged') : 1;

			  	$args = array(
					'post_type'	=> array('post'),
					'post_status' => 'publish',
					'ignore_sticky_posts'	=> $ignore_sticky,
					'category__in' => explode(',', esc_attr($id)),
					'post__not_in' => $sticky_not,
					'post__in' => $sticky_in,
					'orderby' => $orderby,
					'order' => $order,
					'posts_per_page' => $per_page,
					'paged' => $paged
				);

			  	ob_start();

				custom_posts_query($args,$layout,$pagination);

				return ob_get_clean();

			}

			add_shortcode('posts_by_categories', 'sc_posts_by_categories');

		endif;

	/**
	 * ------------------------------------------------------------------------
	 * 20.Random posts
	 *
	 * [radom_posts number="" layout="" order="" orderby="" ignore_sticky=""]
	 *
	 * @atts
	 *	number			(integer)
	 *	layout			[mini, masonry, fitrows]
	 *	order			http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters
	 *	orderby			http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters
	 *	ignore_sticky	[0, 1]
	 *
	 * ------------------------------------------------------------------------
	 */
		if ( ! function_exists( 'sc_random_posts' ) ) :

			function sc_random_posts ( $atts ) {

				global $data, $prefix;

				if ( empty( $atts ) ) return;

				extract( shortcode_atts( array(
					'number'		=> '',
					//'per_page' 		=> get_option('posts_per_page'),
				  	'orderby'   	=> 'date',
				  	'order'     	=> 'dsc',
				  	//'pagination'    => '0',
				  	'layout'        => $data[$prefix."default_masonry"],
				  	'ignore_sticky' => '1'
					), $atts ) );

				if ( !$number ) return;

				$sticky = "";
				if($ignore_sticky=='1') $sticky = get_option( 'sticky_posts' );
				$paged = get_query_var('paged') ? get_query_var('paged') : 1;

			  	$args = array(
					'post_type'	=> array('post'),
					'post_status' => 'publish',
					'ignore_sticky_posts'	=> $ignore_sticky,
					'post__not_in' => $sticky,
					'orderby' => $orderby,
					'order' => $order,
					//'posts_per_page' => $per_page,
					//'paged' => $paged,
					'showposts' => $number
				);

			  	ob_start();

				custom_posts_query($args,$layout,$pagination);

				return ob_get_clean();

			}

			add_shortcode('random_posts', 'sc_random_posts');

		endif;

	/**
	 * ------------------------------------------------------------------------
	 * 21.Posts (global)
	 *
	 * [posts layout="" order="" orderby="" pagination="" per_page="" ignore_sticky="" only_sticky=""]
	 *
	 * @atts
	 *	layout			[mini, masonry, fitrows]
	 *	order			http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters
	 *	orderby			http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters
	 *	pagination		[0, 1]
	 *	per_page		(optional - integer)
	 *	ignore_sticky	[0, 1]
	 *	only_sticky		[0, 1]
	 *
	 * ------------------------------------------------------------------------
	 */
		if ( ! function_exists( 'sc_posts' ) ) :

		 	function sc_posts ( $atts ){

		 		global $data, $prefix;

			  	if ( empty( $atts ) ) return;

				extract( shortcode_atts( array(
					'per_page' 		=> get_option('posts_per_page'),
				  	'orderby'   	=> 'date',
				  	'order'     	=> 'dsc',
				  	'pagination'    => '0',
				  	'layout'        => $data[$prefix."default_masonry"],
				  	'ignore_sticky' => '1',
				  	'only_sticky'   => '0'
					), $atts ) );

				$sticky_not = "";
				$sticky_in = "";
				if($ignore_sticky=='1') $sticky_not = get_option( 'sticky_posts' );
				if($only_sticky=='1') $sticky_in = get_option( 'sticky_posts' );
				$paged = get_query_var('paged') ? get_query_var('paged') : 1;

			  	$args = array(
					'post_type'	=> array('post'),
					'post_status' => 'publish',
					'ignore_sticky_posts'	=> $ignore_sticky,
					'post__not_in' => $sticky_not,
					'post__in' => $sticky_in,
					'orderby' => $orderby,
					'order' => $order,
					'posts_per_page' => $per_page,
					'paged' => $paged
				);

			  	ob_start();

				custom_posts_query($args,$layout,$pagination);

				return ob_get_clean();

			}

			add_shortcode('posts', 'sc_posts');

		endif;

	/**
	 * ------------------------------------------------------------------------
	 * 22.Portfolio posts
	 *
	 * [portfolio_posts number="" post_id="" field_id="" layout="" order="" orderby=""]
	 *
	 * @atts
	 *	number			(integer)
	 *	post_id			(optional - integer separated by coma)
	 *	field_id		(optional - integer separated by coma)
	 *	layout			[masonry, fitrows]
	 *	order			http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters
	 *	orderby			http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters
	 *
	 * ------------------------------------------------------------------------
	 */

		if ( ! function_exists( 'sc_portfolio_posts' ) ) :

			function sc_portfolio_posts ( $atts ){

				global $data, $prefix;

			  	if ( empty( $atts ) ) return;

				extract( shortcode_atts( array(
					'number'		=> '',
				  	'orderby'   	=> 'menu_order',
				  	'order'     	=> 'asc',
				  	'post_id'			=> '',
				  	'field_id'		=> '',
				  	'layout'        => $data[$prefix."default_portf_masonry"]
					), $atts ) );


				$number = ($number=="" || $number==0) ? "-1" : $number;	

			  	$args = array(
					'post_type'	=> array('portfolio'),
					'post_status' => 'publish',
					'orderby' => $orderby,
					'order' => $order,
					'posts_per_page' => $number,
				);
				if($post_id) {
					$args['post__in'] = explode(',', esc_attr($post_id));
				}


				if($field_id) {
					$args['tax_query'] = array(array(
							'taxonomy' => 'field',
							'field' => 'id',
							'terms' => explode(',', esc_attr($field_id) ),
		 				));
				}

			  	ob_start();

				custom_portfolio_query($args,$layout);

				return ob_get_clean();

			}

			add_shortcode('portfolio_posts', 'sc_portfolio_posts');

		endif;