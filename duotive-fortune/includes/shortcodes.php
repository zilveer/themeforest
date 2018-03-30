<?php
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	//ICON SHORTCODE
		function icon( $atts, $content = null ) {
			extract(shortcode_atts(array(
				  "number" => '1',										 
				  "size" => '48'
				), $atts));
			$number = str_replace('"','',$number);				
			$size = str_replace('"','',$size);
			$icon_url = get_template_directory_uri().'/images/icons/';
			$output = '';
			$output .= '<div class="dt-icon-wrapper">';			
				$output .= '<img src="'.$icon_url.'icon-'.$number.'-'.$size.'.png" />';
			$output .= '</div>';			
			return $output;
		}
		add_shortcode('icon', 'icon');
	//IMage SHORTCODE
		function dtImage( $atts, $content = null ) {
			extract(shortcode_atts(array(
				  "url" => '',										 
				  "width" => '100',
				  "height" => '100',
				  "align" => 'left'				  
				), $atts));
			$url = trim($url);
			$width = trim(str_replace('px','',$width));
			$height = trim(str_replace('px','',$height));
			$alignClass = '';
			switch($align)
			{
				case 'left': $alignClass = 'class="dt-image alignleft" '; break;
				case 'right': $alignClass = 'class="dt-image alignright" '; break;				
				case 'center': $alignClass = 'class="dt-image aligncenter" '; break;								
			}
			$output = '';	
			$output .= '<div '.$alignClass.'>';
				$output .= '<img '.$alignClass.'src="'.resizeimagenoecho($url,$width,$height).'" />';
			$output .= '</div>';			
			return $output;
		}
		add_shortcode('dt-image', 'dtImage');		
	//AUDIO SHORTCODE
		function audioplayer( $atts, $content = null )
		{
			extract(shortcode_atts(array(
				  "title" => '',
				  "mp3" => '',										 			  				  
				), $atts));
				$random = rand(0,999);
			$output = '<script>';
				$output .= '$(document).ready(function(){';
					$output .= '$("#jquery_jplayer_'.$random.'").jPlayer({';
					$output .= 'ready: function () {';
					$output .= '$(this).jPlayer("setMedia",';
					$output .= '{';
					$output .= 'mp3:"'.trim($mp3).'"';
					$output .= '});';
					$output .= '},';
					$output .= 'swfPath:"'.get_template_directory_uri().'/js/jquery.player.swf",';
					$output .= 'supplied: "mp3",';
					$output .= 'cssSelectorAncestor: "#jp_container_'.$random.'",';
					$output .= 'wmode: "window"});';
				$output .= '});';
			$output .= '</script>';
			$output .= '<div id="jquery_jplayer_'.$random.'" class="jp-jplayer"></div>';
				$output .= '<div id="jp_container_'.$random.'" class="jp-audio">';
				$output .= '<div class="jp-type-single">';
					$output .= '<div class="jp-gui jp-interface">';
						$output .= '<ul class="jp-controls">';
							$output .= '<li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>';
							$output .= '<li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>';
							$output .= '<li><a href="javascript:;" class="jp-stop" tabindex="1">stop</a></li>';
							$output .= '<li><a href="javascript:;" class="jp-mute" tabindex="1" title=mute>mute</a></li>';
							$output .= '<li><a href="javascript:;" class="jp-unmute" tabindex="1" title=unmute>unmute</a></li>';
							$output .= '<li><a href="javascript:;" class="jp-volume-max" tabindex="1" title="max volume">max volume</a></li>';
						$output .= '</ul>';
						$output .= '<div class="jp-progress">';
							$output .= '<div class="jp-seek-bar">';
								$output .= '<div class="jp-play-bar"></div>';
							$output .= '</div>';
						$output .= '</div>';
						$output .= '<div class="jp-volume-bar">';
							$output .= '<div class="jp-volume-bar-value"></div>';
						$output .= '</div>';
						$output .= '<div class="jp-time-holder">';
							$output .= '<div class="jp-current-time"></div>';
							$output .= '<div class="jp-duration"></div>';
							$output .= '<ul class="jp-toggles">';
								$output .= '<li><a href="javascript:;" class="jp-repeat" tabindex="1" title="repeat">repeat</a></li>';
								$output .= '<li><a href="javascript:;" class="jp-repeat-off tabindex="1" title="repeat off">repeat off</a></li>';
							$output .= '</ul>';
						$output .= '</div>';
					$output .= '</div>';
					if ( $title != '' ): 
					$output .= '<div class="jp-title">';
						$output .= '<ul>';
							$output .= '<li>'.$title.'</li>';
						$output .= '</ul>';
					$output .= '</div>';
					endif;
				$output .= '</div>';
			$output .= '</div>';
	
			return $output;
		}
		add_shortcode('dt-audio', 'audioplayer');	
	//SLIDESHOW SHORTCODE
		function videoplayer( $atts, $content = null )
		{
			extract(shortcode_atts(array(
				  "width" => '500',										 
				  "height" => '300',
				  "poster" => '',
				  "m4v" => '',
				  "ogv" => '',
				  "webmv" => '',
				  "title" => '',				  				  
				), $atts));
				$width = trim(str_replace('px','',$width));
				$height = trim(str_replace('px','',$height));	
				$m4v = trim($m4v);
				$ogv = trim($ogv);
				$webmv = trim($webmv);	
				$supplied = '';
				$random = rand(0,999);								
			$output = '<script type="text/javascript">';
				$output .= '$(document).ready(function(){';
					$output .= '$("#jplayer_'.$random.'").jPlayer({';
						$output .= 'ready:function(){';
							$output .= '$(this).jPlayer("setMedia",';
							$output .= '{';
								if ( $m4v != '' ) { $output .= 'm4v:"'.$m4v.'",'; $supplied = 'm4v'; }
								if ( $ogv != '' ) { $output .= 'ogv:"'.$ogv.'",'; if ( $supplied != '' ) $supplied .= ',ogv'; else $supplied = 'ogv'; }
								if ( $webmv != '' ) { $output .= 'webmv:"'.$webmv.'",'; if ( $supplied != '' ) $supplied .= ',webmv'; else $supplied = 'webmv'; }
								if ( $poster != '' ) $output .= 'poster:"'.resizeimagenoecho(trim($poster),$width,$height).'"';
							$output .= '}';
						$output .= ')},';
						$output .= 'swfPath:"'.get_template_directory_uri().'/js/jquery.player.swf",';
						$supplied = array_reverse(explode(",", $supplied));
						$supplied = implode(",", $supplied);											
						$output .= 'supplied:"'.$supplied.'",';
						$output .= 'size:{width:"'.$width.'px",height:"'.$height.'px",cssClass:"jp-video-fullsize"},';
						$output .= 'cssSelectorAncestor: "#jp_container_'.$random.'"';
					$output .= '});';
					$output .= '$("#jplayer_'.$random.'").bind($.jPlayer.event.resize , function(event){';
						$output .= '$("#website-header,#website-footer,#backtotop").toggleClass("fullscreen-video-hide")';
					$output .= ';})';
				$output .= ';});';
			$output .= '</script>';
			$output .= '<div id="jp_container_'.$random.'" class="jp-video jp-video-360p">';
				$output .= '<div class="jp-type-single">';
					$output .= '<div id="jplayer_'.$random.'" class="jp-jplayer"></div>';
					$output .= '<div class="jp-gui">';
						$output .= '<div class="jp-video-play"><a href="javascript:;" class="jp-video-play-icon" tabindex="1">play</a></div>';
						$output .= '<div class="jp-interface">';
							$output .= '<div class="jp-progress">';
								$output .= '<div class="jp-seek-bar">';
									$output .= '<div class="jp-play-bar"></div>';
								$output .= '</div>';
							$output .= '</div>';
							$output .= '<div class="jp-times-wrapper"><span></span>';
								$output .= '<div class="jp-current-time"></div>';
								$output .= '<div class="jp-duration"></div>';
							$output .= '</div>';
							$output .= '<div class="jp-controls-holder">';
								$output .= '<ul class=jp-controls>';
									$output .= '<li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>';
									$output .= '<li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>';
									$output .= '<li><a href="javascript:;" class="jp-stop" tabindex="1">stop</a></li>';
									$output .= '<li><a href="javascript:;" class="jp-mute" tabindex="1" title=mute>mute</a></li>';
									$output .= '<li><a href="javascript:;" class="jp-unmute" tabindex="1" title=unmute>unmute</a></li>';
									$output .= '<li><a href="javascript:;" class="jp-volume-max" tabindex="1" title="max volume">max volume</a></li>';
								$output .= '</ul>';
								$output .= '<div class="jp-volume-bar">';
									$output .= '<div class="jp-volume-bar-value"></div>';
								$output .= '</div>';
								$output .= '<ul class="jp-toggles">';
									$output .= '<li><a href="javascript:;" class="jp-full-screen" tabindex="1" title="full screen">full screen</a></li>';
									$output .= '<li><a href="javascript:;" class="jp-restore-screen" tabindex="1" title="restore screen">restore screen</a></li>';
									$output .= '<li><a href="javascript:;" class="jp-repeat" tabindex="1" title="repeat">repeat</a></li>';
									$output .= '<li><a href="javascript:;" class="jp-repeat-off" tabindex=1 title="repeat off">repeat off</a></li>';
								$output .= '</ul>';
							$output .= '</div>';
							if ( $title != '' ): 
							$output .= '<div class="jp-title">';
								$output .= '<ul>';
									$output .= '<li>'.$title.'</li>';
								$output .= '</ul>';
							$output .= '</div>';
							endif;
						$output .= '</div>';
					$output .= '</div>';
				$output .= '</div>';
			$output .= '</div>';		
			return $output;
		}
		add_shortcode('dt-video', 'videoplayer');			
			
	//SLIDESHOW SHORTCODE
		function slideshow( $atts, $content = null )
		{
			extract(shortcode_atts(array(
				  "width" => '300',										 
				  "height" => '300',
				  "effect" => 'random',
				  "urls" => ''
				), $atts));	
			$width = str_replace('px','',$width);
			$height = str_replace('px','',$height);		
			$timthumb_url = get_template_directory_uri().'/includes/timthumb.php';
			$random = rand(0,999999);
			$output = '<script type="text/javascript">
						jQuery(window).load(function() {
							jQuery("#slider-'.$random.'").nivoSlider({controlNav:false,manualAdvance:true, directionNavHide:false, effect:\''.$effect.'\'});
						});
					  </script>';
			$output .= '<div id="slider-'.$random.'" class="slideshow-in-content"  style="width:'.$width.'px;height:'.$height.'px;">';			
			if ( $urls != '' )
			{
				$images = explode('|',$urls);
				foreach($images as $image) 
				{
					$output .= '<img src="'.resizeimagenoecho(trim($image),$width,$height).'" />';
				}
			
			}
			else
			{
				global $post;
				$attached_images =& get_children('post_type=attachment&post_mime_type=image&orderby=menu_order&order=ASC&post_parent=' . $post->ID );                                       
                foreach ( $attached_images as $attached_image ):
					$thumbnail_src = wp_get_attachment_url($attached_image->ID);
					$output .= '<img src="'.resizeimagenoecho(trim($thumbnail_src),$width,$height).'" />';
				endforeach;	
			}
			$output .= '</div>';
			return $output;
		}
		add_shortcode('dt-slideshow', 'slideshow');			
	//GALLERIA SHORTCODE
		function galleria( $atts, $content = null )
		{
			extract(shortcode_atts(array(
				  "urls" => ''
			), $atts));	
			$random = rand(0,999999);
			$output = '<link rel="stylesheet" href="'.get_template_directory_uri().'/css/utilities/galleria.classic.css">';
			$output .= '<script src="'.get_template_directory_uri().'/js/jquery.galleria.js"></script>';
			$output .= '<script type="text/javascript">';
				$output .= '$(window).load(function() {';
					$output .= "Galleria.loadTheme('".get_template_directory_uri()."/js/jquery.galleria.template.js');";
					$output .= '$("#galleria").galleria({width:880,height:439,transition:\'fadeslide\'});';
				$output .= '});';
			$output .= '</script>';
			$output .= '<div id="galleria" class="galleria-wrapper">';
			if ( $urls != '' )
			{
				$images = explode('|',$urls);
				$random = rand(0,999999);			
					foreach($images as $image) 
					{
						$output .= '<a class="image-wrapper" href="'.$image.'">';
							$output .= '<img src="'.resizeimagenoecho(trim($image),81,55).'" />';
						$output .= '</a>';
					}
				}
			else
			{
				global $post;
				$attached_images =& get_children('post_type=attachment&post_mime_type=image&orderby=menu_order&order=ASC&post_parent=' . $post->ID );                                       
                foreach ( $attached_images as $attached_image ):
					$thumbnail_src = wp_get_attachment_url($attached_image->ID);
					$output .= '<a class="image-wrapper" href="'.$thumbnail_src.'">';
						$output .= '<img src="'.resizeimagenoecho(trim($thumbnail_src),81,55).'" title="'.$attached_image->post_title.'" alt="'.$attached_image->post_content.'" />';
                   	$output .= '</a>';
				endforeach;	
			}
			$output .= '</div>';	
			return $output;		
		}
		add_shortcode('dt-galleria', 'galleria');	
		
	//GALLERIFIC SHORTCODE
		function galleriffic( $atts, $content = null )
		{
			extract(shortcode_atts(array(
				  "urls" => ''
			), $atts));				
			$random = rand(0,999999);
			$output = '<link rel="stylesheet" href="'.get_template_directory_uri().'/css/utilities/galleriffic.css">';
			$output .= '<script src="'.get_template_directory_uri().'/js/jquery.galleriffic.js"></script>';
			$output .= '<script src="'.get_template_directory_uri().'/js/jquery.galleriffic.opacityrollover.js"></script>';			
			$output .= '<script type="text/javascript">';
				$output .= '$(window).load(function() {';
					$output .= "var onMouseOutOpacity = 0.67;
					$('#thumbs ul.thumbs li').opacityrollover({
						mouseOutOpacity:   onMouseOutOpacity,
						mouseOverOpacity:  1.0,
						fadeSpeed:         'fast',
						exemptionSelector: '.selected'
					});";
					$output .= "var gallery = $('#thumbs').galleriffic({
						delay:                     2500,
						numThumbs:                 16,
						preloadAhead:              10,
						enableTopPager:            true,
						enableBottomPager:         true,
						maxPagesToShow:            7,
						imageContainerSel:         '#slideshow',
						controlsContainerSel:      '#controls',
						captionContainerSel:       '#caption',
						loadingContainerSel:       '#loading',
						renderSSControls:          true,
						renderNavControls:         true,
						playLinkText:              'Play Slideshow',
						pauseLinkText:             'Pause Slideshow',
						prevLinkText:              '&#171; Previous Photo',
						nextLinkText:              'Next Photo &#187;',
						nextPageLinkText:          'Next &#187;',
						prevPageLinkText:          '&#171; Prev',
						enableHistory:             false,
						autoStart:                 false,
						syncTransitions:           true,
						defaultTransitionDuration: 0,
						onSlideChange:             function(prevIndex, nextIndex) {
							// 'this' refers to the gallery, which is an extension of $('#thumbs')
							this.find('ul.thumbs').children()
								.eq(prevIndex).fadeTo('fast', onMouseOutOpacity).end()
								.eq(nextIndex).fadeTo('fast', 1.0);
						},
						onPageTransitionOut:       function(callback) {
							this.fadeTo('fast', 0.0, callback);
						},
						onPageTransitionIn:        function() {
							this.fadeTo('fast', 1.0);
						}					
					});";
				$output .= '});';
			$output .= '</script>';
			$output .= '<div class="galleriffic-wrapper">';
				$output .= '<div id="thumbs" class="galleriffic-navigation">';
					$output .= '<ul class="thumbs noscript">';
						if ( $urls != '' )
						{
							$images = explode('|',$urls);
							$random = rand(0,999999);			
								foreach($images as $image) 
								{
									$output .= '<li>';
										$output .= '<a class="thumb" href="'.resizeimagenoecho(trim($image),527,'').'">';
											$output .= '<img src="'.resizeimagenoecho(trim($image),74,74).'" />';
										$output .= '</a>';
									$output .= '</li>';								
								}
							}
						else
						{
							global $post;
							$attached_images =& get_children('post_type=attachment&post_mime_type=image&orderby=menu_order&order=ASC&post_parent=' . $post->ID );                                       
							foreach ( $attached_images as $attached_image ):
								$thumbnail_src = wp_get_attachment_url($attached_image->ID);
								$output .= '<li>';
									$output .= '<a class="thumb" href="'.resizeimagenoecho(trim($thumbnail_src),527,'').'" title="title">';
										$output .= '<img src="'.resizeimagenoecho(trim($thumbnail_src),74,74).'" title="'.$attached_image->post_title.'" alt="'.$attached_image->post_content.'" />';
									$output .= '</a>';
									$output .= '<div class="caption">';
										$output .= '<h5>'.$attached_image->post_title.'</h5>';
										$output .= '<p>'.$attached_image->post_content.'</p>';
									$output .= '</div>';								
								$output .= '</li>';
							endforeach;	
						}
					$output .= '</ul>';					
				$output .= '</div>';
				$output .= '<div id="gallery" class="galleriffic-content">';
					$output .= '<div id="controls" class="galleriffic-controls"></div>';
					$output .= '<div class="slideshow-container">';
						$output .= '<div id="loading" class="loader"></div>';
						$output .= '<div id="slideshow" class="slideshow"></div>';
					$output .= '</div>';
					$output .= '<div id="caption" class="caption-container"></div>';					
				$output .= '</div>';				
			$output .= '</div>';
			
			return $output;							
		}
		add_shortcode('dt-galleriffic', 'galleriffic');	
	//DUOTIVE GALLERY
		function dtGallery( $atts, $content = null )
		{
			extract(shortcode_atts(array(
				  "urls" => '',
				  "width" => '900',
				  "thumbwidth" => 100,
				  "thumbheight" => 100,
				  "navigation" => 'true',
				  "autoadvance" => 'true',
				  "autoduration" => 500,
				  "autointerval" => 3000,
				  "pauseonhover" => true,
				  "rows" => 3
			), $atts));	
			$random = rand(0,999999);	
			$width = str_replace('px','',trim($width));
			if ( $width == 'auto' ) $width = "'auto'";
			$output = '<script type="text/javascript">';
				$output .= '$(document).ready(function($) {	';
					$output .= "$('.duotive-gallery-".$random."').duotiveGallery({";
						$output .= "'width': ".$width.",";
						$output .= "'rows': ".$rows.",";
						$output .= "'thumbWidth': ".$thumbwidth.",";
						$output .= "'thumbHeight': ".$thumbheight.",";
						$output .= "'navigation': ".$navigation.",";
						$output .= "'alignNavigation': true,";
						$output .= "'autoAdvance': ".$autoadvance.",";
						$output .= "'autoAdvDuration': ".$autoduration.",";
						$output .= "'autoAdvInterval': ".$autointerval.",";
						$output .= "'autoAdvPauseOnHover': ".$pauseonhover;
					$output .= "});";
				$output .= '});';
			$output .= '</script>';			
			$output .= '<div class="duotiveGallery duotive-gallery-'.$random.'">';
			if ( $urls != '' )
			{
				$images = explode('|',$urls);			
					foreach($images as $image) 
					{
						$output .= '<a rel="modal-window['.$random.']" href="'.$image.'">';
							$output .= '<img src="'.resizeimagenoecho(trim($image),$thumbwidth,$thumbheight).'" />';
						$output .= '</a>';
					}
				}
			else
			{
				global $post;
				$attached_images =& get_children('post_type=attachment&post_mime_type=image&orderby=menu_order&order=ASC&post_parent=' . $post->ID );                                       
                foreach ( $attached_images as $attached_image ):
					$thumbnail_src = wp_get_attachment_url($attached_image->ID);
					$output .= '<a rel="modal-window['.$random.']" href="'.$thumbnail_src.'">';
						$output .= '<img src="'.resizeimagenoecho(trim($thumbnail_src),$thumbwidth,$thumbheight).'" title="'.$attached_image->post_title.'" alt="'.$attached_image->post_content.'" />';
                   	$output .= '</a>';
				endforeach;	
			}
			$output .= '</div>';	
			return $output;		

		}
		add_shortcode('dt-gallery', 'dtGallery');													
?>