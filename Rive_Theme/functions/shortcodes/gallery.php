<?php
/*
* Gallery shortcode filters
*/

function rt_image_attachment_fields_to_edit($form_fields, $post){
	$form_fields["rt-image-link"] = array(
    "label" => __("Custom Link", 'ch'),
    "input" => "text", // default
    "value" => get_post_meta($post->ID, "_rt-image-link", true),
    "helps" => __("http://", 'ch'),
  );
  return $form_fields;
}

function rt_image_attachment_fields_to_save($post, $attachment) {
  if( isset($attachment['rt-image-link']) ){
    update_post_meta($post['ID'], '_rt-image-link', $attachment['rt-image-link']);
  }
  return $post;
}
add_filter("attachment_fields_to_edit", 'rt_image_attachment_fields_to_edit', null, 2);
add_filter("attachment_fields_to_save", 'rt_image_attachment_fields_to_save', null , 2);

// Retrieve an attachment page link using an image or icon, if possible.
function ch_get_attachment_link( $markup, $id, $size, $permalink, $icon, $text ) {
	$id = intval( $id );
	$_post = & get_post( $id );

	if ( empty( $_post ) || ( 'attachment' != $_post->post_type ) || ! $url = wp_get_attachment_url( $_post->ID ) )
		return __( 'Missing Attachment', 'ch' );

	if ( $permalink )
		$url = get_attachment_link( $_post->ID );

	$post_title = esc_attr( $_post->post_title );

	if ( $text )
		$link_text = esc_attr( $text );
	elseif ( $size && 'none' != $size )
		$link_text = wp_get_attachment_image( $id, $size, $icon );
	else
		$link_text = '';

	if ( trim( $link_text ) == '' )
		$link_text = $_post->post_title;

	if ( $size && 'none' != $size) {
		$image_src = wp_get_attachment_image_src($id, $size, false);
		$overlay   = '<div class="border" style="width: ' . $image_src[1] . 'px; height: ' . $image_src[2] . 'px;"><div class="open"></div></div>';
	}

	return "<a href='$url' title='$post_title'>$link_text $overlay</a>";
}
add_filter( 'wp_get_attachment_link', 'ch_get_attachment_link', 10, 6 );

// This implements the functionality of the Gallery Shortcode for displaying WordPress images
function ch_gallery_shortcode($output, $attr) {
	global $post;

	static $instance = 0;
	$instance++;

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
	}

	extract(shortcode_atts(array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post->ID,
		'itemtag'    => 'div',
		'icontag'    => 'div',
		'captiontag' => 'div',
		'columns'    => 3,
		'size'       => 'thumbnail',
		'include'    => '',
		'exclude'	 => '',
		'type'		 => false
	), $attr));

	$id = intval($id);
	if ( 'RAND' == $order )
		$orderby = 'none';

	if ( !empty($include) ) {
		$include      = preg_replace( '/[^0-9,]+/', '', $include );
		$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $_attachments[$key];
		}
	} elseif ( !empty($exclude) ) {
		$exclude     = preg_replace( '/[^0-9,]+/', '', $exclude );
		$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	} else {
		$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	}

	if ( empty($attachments) )
		return '';

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment )
			$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
		return $output;
	}

	$itemtag    = tag_escape($itemtag);
	$captiontag = tag_escape($captiontag);
	$columns    = intval($columns);
	$itemwidth  = $columns > 0 ? floor(100/$columns) : 100;
	$float      = is_rtl() ? 'right' : 'left';

	$selector = "gallery-{$instance}";

	$gallery_style = $gallery_div = '';
	$image_size    = wp_get_attachment_image_src($attachments[key($attachments)]->ID, $size, false);

	$size_class = sanitize_html_class( $size );
	if ($type != 'standard-gallery') {
		$random      = rand(0, 100000);
		$gallery_div = '
        <script type="text/javascript">
            jQuery(function() {
				//check if the user made the
				//mistake to open it with IE
				var ie 			= false;
				if (jQuery.browser.msie)
					ie = true;
				//flag to control the click event
				var flg_click	= true;
				//the wrapper
                var $im_wrapper	= jQuery(\'#merge-gallery-' . $random . '\');
				//the thumbs
				var $thumbs		= $im_wrapper.children(\'div:not(.gallery_image_width)\');
				//all the images
				var $thumb_imgs = $thumbs.find(\'img\');
				//number of images
				var nmb_thumbs	= $thumbs.length;
				//image loading status
				var $im_loading	= jQuery(\'#merge-gallery-' . $random . '-nav #im_loading\');
				//the next and previous buttons
				var $im_next	= jQuery(\'#merge-gallery-' . $random . '-nav #im_next\');
				var $im_prev	= jQuery(\'#merge-gallery-' . $random . '-nav #im_prev\');
				//number of thumbs per line
				var per_line	= ' . $columns . ';
				//number of thumbs per column
				var per_col		= Math.ceil(nmb_thumbs/per_line)
				//index of the current thumb
				var current		= -1;
				//mode = grid | single
				var mode		= \'grid\';
				var $wrapper_width = $im_wrapper.width();
				//an array with the positions of the thumbs
				//we will use it for the navigation in single mode
				var positionsArray = [];
				for(var i = 0; i < nmb_thumbs; ++i)
					positionsArray[i]=i;

				// Set container height
				$im_wrapper.height((($im_wrapper.find(\'.gallery_image_width\').width()+20) * per_col) + \'px\');

				//preload all the images
				$im_loading.css(\'visibility\',\'visible\');
				var loaded		= 0;
				$thumb_imgs.each(function(){
					var $this = jQuery(this);
					jQuery(\'<img/>\').load(function(){
						++loaded;
						if(loaded == nmb_thumbs*2)
							start();
					}).attr(\'src\',$this.attr(\'src\'));
					jQuery(\'<img/>\').load(function(){
						++loaded;
						if(loaded == nmb_thumbs*2)
							start();
					}).attr(\'src\', $this.parent().attr(\'href\'));
				});

				//starts the animation
				function start(){
					$im_loading.css(\'visibility\',\'hidden\');

					$thumbs.css({
						\'height\' : $im_wrapper.find(\'.gallery_image_width\').width()
					});
					//disperse the thumbs in a grid
					disperse();
				}

				//disperses the thumbs in a grid based on windows dimentions
				function disperse(resizing) {
					if(!flg_click) return;
					setflag();
					removeNavigation();

					// Set container height
					$im_wrapper.height((($im_wrapper.find(\'.gallery_image_width\').width()+20) * per_col) + \'px\');

					var $img_width  = $im_wrapper.find(\'.gallery_image_width\').width();
					$im_wrapper.find(\'.gallery_image_width\').height($img_width);
					var $img_height = $im_wrapper.find(\'.gallery_image_width\').height();
					$im_wrapper.css(\'visibility\',\'visible\');

					mode = \'grid\';

					//center point for first thumb
					var spaces_h = 20;

					//lets disperse the thumbs equally on the page
					$thumbs.each(function(i){
						var $thumb = jQuery(this);
						var $image = $thumb.find(\'img\');
						var spaces_w = ($im_wrapper.width() - (per_line * $thumb.outerWidth())) / (per_line-1);

						/*
						calculate left and top for each thumb,
						considering how many we want per line */
						var left = ((spaces_w * (i%per_line)) + ($thumb.outerWidth() * (i%per_line)));
						var top  = ((($img_height+20) * Math.ceil((i+1)/per_line)) - ($img_height+20));

						//lets give a random degree to each thumb
						var r = Math.floor(Math.random()*41)-20;
						/*
						now we animate the thumb to its final positions;
						we also fade in its image, animate it to 115x115,
						and remove any background image	of the thumb - this
						is not relevant for the first time we call disperse,
						but when changing from single to grid mode
						 */

						if(ie) {
							var param = {
								\'padding\': \'3px\',
								\'width\'  : $im_wrapper.find(\'.gallery_image_width\').width(),
								\'height\' : $im_wrapper.find(\'.gallery_image_width\').height(),
								\'left\'   : left + \'px\',
								\'top\'    : top + \'px\'
							};
						} else {
							var param = {
								\'padding\': \'3px\',
								\'width\'  : $im_wrapper.find(\'.gallery_image_width\').width(),
								\'height\' : $im_wrapper.find(\'.gallery_image_width\').height(),
								\'left\'   : left + \'px\',
								\'top\'    : top + \'px\'
							};
						}
						if ( resizing == true ) {
							var speed = 0;
						} else {
							var speed = 750;
						}
						$thumb.stop()
						.animate(param, speed, function() {
							if(i==nmb_thumbs-1)
								setflag();
						}).find(\'img\').fadeIn(750, function() {
							$thumb.css({
								\'background-image\' : \'none\'
							});
							jQuery(this).animate({
								/*\'width\' : $image.width(),
								\'height\'  : $image.height(),*/
							},150);
						});
					});
					$im_wrapper.find(".gallery-caption").show();
				}

				// On windows resize call the disperse function
				on_resize(function() {
					if ($wrapper_width != $im_wrapper.width()) {
						$thumbs.css({\'width\' : $im_wrapper.find(\'.gallery_image_width\').width(), \'height\' : $im_wrapper.find(\'.gallery_image_width\').height()});
						disperse(true);
						$wrapper_width = $im_wrapper.width();
					}


				});

				//controls if we can click on the thumbs or not
				//if theres an animation in progress
				//we don\'t want the user to be able to click
				function setflag() {
					flg_click = !flg_click
				}

				/*
				when we click on a thumb, we want to merge them
				and show the full image that was clicked.
				we need to animate the thumbs positions in order
				to center the final image in the screen. The
				image itself is the background image that each thumb
				will have (different background positions)
				If we are currently seeing the single image,
				then we want to disperse the thumbs again,
				and with this, showing the thumbs images.
				 */
				$thumbs.bind(\'click\',function(){
					if(!flg_click) return;
					setflag();

					var $this = jQuery(this);
					current   = $this.index();
					$thumbs.css(\'position\', \'absolute\');
					$im_wrapper.find(".gallery-caption").hide();

					if(mode	== \'grid\') {
						mode = \'single\';
						//the source of the full image
						var image_src	= $this.find(\'img\').parent().attr(\'href\');

						$thumbs.each(function(i){
							var $thumb = jQuery(this);
							var $image = $thumb.find(\'img\');

							//first we animate the thumb image
							//to fill the thumbs dimentions
							$image.stop().animate({
								/*\'width\'		: \'' . $image_size[1] . 'px\',
								\'height\'	: \'' . $image_size[2] . 'px\',*/
								\'marginTop\'	: \'0px\',
								\'marginLeft\': \'0px\'
							},150,function() {
								//calculate the dimentions of the full image
								var f_w	= per_line * (' . ($image_size[1]) . ');
								var f_h	= per_col * (' . ($image_size[2]) . ');
								';

								if ( LAYOUT == 'sidebar-left' ) {
									$gallery_div .= '
								var f_l = (jQuery(\'.merge-gallery\').width() - f_w)/2';
								} elseif ( LAYOUT == 'sidebar-right' ) {
									$gallery_div .= '
								var f_l = (jQuery(\'.merge-gallery\').width() - f_w)/2';
								} else {
									$gallery_div .= '
								var f_l = jQuery(\'.white-bg\').width()/2 - f_w/2';
								}

								$gallery_div .= '
								var f_t = $im_wrapper.find(\'.gallery_image_width\').height()/2 /*- f_h/2*/
								/*
								set the background image for the thumb
								and animate the thumbs postions and rotation
								 */
								if(ie) {
									var param = {
										\'width\'  : \'' . $image_size[1] . 'px\',
										\'height\' : \'' . $image_size[2] . 'px\',
										\'padding\': \'0\',
										\'left\'   : f_l + (i%per_line)*' . ($image_size[1]) . ' + \'px\',
										\'top\'	   : f_t + Math.floor(i/per_line)*' . ($image_size[2]) . ' + \'px\'
									};
								} else {
									var param = {
										\'width\'  : \'' . $image_size[1] . 'px\',
										\'height\' : \'' . $image_size[2] . 'px\',
										\'padding\': \'0\',
										\'left\'   : f_l + (i%per_line)*' . ($image_size[1]) . ' + \'px\',
										\'top\'	   : (f_t + Math.floor(i/per_line)*' . ($image_size[2]) . ') - (f_t / 1.5) + \'px\'
									};
								}
								$thumb.css({
									\'background-image\' : \'url(\'+image_src+\')\',
									\'background-size\'  : ((' . ($image_size[2]) . '*per_line)) + \'px \' + ((' . ($image_size[1]) . '*per_col)) + \'px\'
								}).stop()
								.animate(param, 1200, function() {
									//insert navigation for the single mode
									if(i==nmb_thumbs-1) {
										addNavigation();
										setflag();
									}
								});
								//fade out the thumb\'s image
								$image.fadeOut(700);
							});
						});
					} else {
						setflag();
						//remove navigation
						removeNavigation();
						$thumbs.css({\'width\' : ($im_wrapper.find(\'.gallery_image_width\').width() + 10), \'height\' : ($im_wrapper.find(\'.gallery_image_width\').height() + 10)});

						//if we are on single mode then disperse the thumbs
						disperse();
					}
				});

				//removes the navigation buttons
				function removeNavigation() {
					$im_next.stop().animate({\'right\':\'-60px\'},300);
					$im_prev.stop().animate({\'left\':\'-60px\'},300);
				}

				//add the navigation buttons
				function addNavigation() {
					$im_next.stop().animate({\'right\':\'-2px\'},300);
					$im_prev.stop().animate({\'left\':\'-2px\'},300);
				}

				//User clicks next button (single mode)
				$im_next.bind(\'click\', function() {
					if(!flg_click) return;
					setflag();

					++current;
					var $next_thumb	= $im_wrapper.children(\'div:nth-child(\'+(current+1)+\')\');
					if($next_thumb.length>0) {
						$im_wrapper.find(".gallery-caption").hide();
						var image_src	= $next_thumb.find(\'img\').parent().attr(\'href\');
						var arr 		= Array.shuffle(positionsArray.slice(0));
						$thumbs.each(function(i) {
							//we want to change each divs background image
							//on a different point of time
							var t = jQuery(this);
							setTimeout(function() {
								t.css({
									\'background-image\' : \'url(\'+image_src+\')\'
								});
								if(i == nmb_thumbs-1)
									setflag();
							},arr.shift()*20);
						});
					} else {
						setflag();
						--current;
						return;
					}
				});

				//User clicks prev button (single mode)
				$im_prev.bind(\'click\',function() {
					if(!flg_click) return;
					setflag();
					--current;
					var $prev_thumb	= $im_wrapper.children(\'div:nth-child(\'+(current+1)+\'):not(.gallery_image_width)\');
					if($prev_thumb.length>0){
						$im_wrapper.find(".gallery-caption").hide();
						var image_src	= $prev_thumb.find(\'img\').parent().attr(\'href\');
						var arr 		= Array.shuffle(positionsArray.slice(0));
						$thumbs.each(function(i){
							var t = jQuery(this);
							setTimeout(function(){
								t.css({
									\'background-image\' : \'url(\'+image_src+\')\'
								});
								if(i == nmb_thumbs-1)
									setflag();
							},arr.shift()*20);
						});
					} else {
						setflag();
						++current;
						return;
					}
				});

				//function to shuffle an array
				Array.shuffle = function( array ) {
					for(
					var j, x, i = array.length; i;
					j = parseInt(Math.random() * i),
					x = array[--i], array[i] = array[j], array[j] = x
				);
					return array;
				};
            });

			jQuery(document).ready(function() {
				jQuery(".merge-gallery").click(function(event) {
					event.preventDefault();
				});
			});
        </script>
        <div id="merge-gallery-' . $random . '" class="merge-gallery galleryid-' . $id . ' gallery-columns-' . $columns . ' gallery-size-' . $size_class . '">';
	} else {
			if ( apply_filters( 'use_default_gallery_style', true ) )
				$gallery_style = "";
		$gallery_div = '<div id="' . $selector . '" class="gallery galleryid-' . $id . ' gallery-columns-' . $columns . ' gallery-size-' . $size_class . '">';
	}

	$output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );

	$i = 0;
	$c = 0;
	$m = 0;

	// Cool gallery html
	if ($type != 'standard-gallery') {
		if ($size == 'gallery-large') {
			$span_size = 'span7';
		} elseif ($size == 'gallery-medium') {
			$span_size = 'span3';
		} elseif ($size == 'gallery-small') {
			$span_size = 'span2';
		} else {
			$span_size = 'span3';
		}

		$output .= '<div class="' . $span_size . ' gallery_image_width"></div>';
		foreach ( $attachments as $id => $attachment ) {
			$class = '';
			if ( $columns > 0 && ++$i % $columns == 0 ) {
				$class = ' last';
			}

			$image           = wp_get_attachment_image($id, $size, false, array('class' => $span_size));
			$image_src_full  = wp_get_attachment_image_src($id, 'large', false);
			$link            = '<a href="' . $image_src_full[0] . '" class="no_thickbox">' . $image . '</a>';
			$attachment_meta = get_post_meta($id, '_rt-image-link', true);
			if($attachment_meta) {
				if($attr['link'] == 'custom_url') {
					$link = '<a href="' . $attachment_meta . '" class="no_thickbox">' . $image . '</a>';
				}
			}

			$image_src = wp_get_attachment_image_src($id, $size, false);

			$output .= "<{$itemtag} style=\"background-position: -" . ($m * $image_src[1]) . "px -" . ($c * $image_src[1]) . "px;\" class='" . $span_size . " " . $class . "'>";
			$output .= "
					$link";
			if ( $captiontag && trim($attachment->post_excerpt) ) {
				$output .= "
					<span class='wp-caption-text gallery-caption' style='bottom: " . ($image_src[2]+150) . "px'>
						<span>" . wptexturize($attachment->post_excerpt) . "</span>
					</span>";
			}
			$m++;
			$output .= "
			</{$itemtag}>";
			if ( $columns > 0 && $i % $columns == 0 ) {
				$c++;
				$m=0;
			}
		}

	// Normal gallery style html
	} else {
		foreach ( $attachments as $id => $attachment ) {
			$class = '';
			if ( $columns > 0 && ++$i % $columns == 0 )
				$class = ' last';

			$link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false, '') : wp_get_attachment_link($id, $size, true, false, '');
			$image = wp_get_attachment_image($id, $size, false, array('class' => 'img-polaroid'));
			$attachment_meta = get_post_meta($id, '_rt-image-link', true);
			if($attachment_meta){
				if($attr['link'] == 'custom_url') {
					$link = '<a href="' . $attachment_meta . '" class="no_thickbox">' . $image . '</a>';
				}
			}

			$output .= "<{$itemtag} class='gallery-item" . $class . "'>";
			$output .= "
				<{$icontag} class='gallery-icon'>
					$link
				</{$icontag}>";
			if ( $captiontag && trim($attachment->post_excerpt) ) {
				$output .= "
					<{$captiontag} class='wp-caption-text gallery-caption'>
					" . wptexturize($attachment->post_excerpt) . "
					</{$captiontag}>";
			}
			$output .= "</{$itemtag}>";
			if ( $columns > 0 && $i % $columns == 0 )
				$output .= '<br style="clear: both" />';
		}
	}
	$output .= "
			<br style='clear: both;' />
		</div>\n";

	// Cool gallery html
	if ($type != 'standard-gallery') {
		$output .= '
		<div id="merge-gallery-' . $random . '-nav" style="position: relative;">
			<div id="im_loading" class="im_loading"></div>
			<div id="im_next" class="im_next"></div>
			<div id="im_prev" class="im_prev"></div>
		</div>';
	}

	return $output;
}
add_filter( 'post_gallery', 'ch_gallery_shortcode', 10, 2 );