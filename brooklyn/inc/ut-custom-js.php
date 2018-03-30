<?php

/*
 * Custom Javascript from Option Panel
 * by www.unitedthemes.com
 */


/*
|--------------------------------------------------------------------------
| Custom JS Minifier
|--------------------------------------------------------------------------
*/
add_filter( 'ut-custom-js' , 'ut_compress_java' );
if ( !function_exists( 'ut_compress_java' ) ) {

	function ut_compress_java($buffer) {
		
		/* remove comments */
		$buffer = preg_replace("/((?:\/\*(?:[^*]|(?:\*+[^*\/]))*\*+\/)|(?:\/\/.*))/", "", $buffer);
		/* remove tabs, spaces, newlines, etc. */
		$buffer = str_replace(array("\r\n","\r","\t","\n",'  ','    ','     '), '', $buffer);
		/* remove other spaces before/after ) */
		$buffer = preg_replace(array('(( )+\))','(\)( )+)'), ')', $buffer);
	
		return $buffer;
		
	}

}


if ( !function_exists( 'ut_needed_js' ) ) {
    
    function ut_needed_js() { 
        		
        /* check for js cache */
        if( ot_get_option('ut_use_cache' , 'off') == 'on' && is_front_page() ) {
            
            $transient_prefix = unite_mobile_detection()->isMobile() ? '_mobile' : '_desktop';
            $language_prefix =  defined('ICL_LANGUAGE_CODE') ? '_' . ICL_LANGUAGE_CODE : '';
             
            $js = get_transient( 'ut_js_cache'. $transient_prefix . $language_prefix );
            
            if( !empty($js) ) {
                echo apply_filters( 'ut-custom-js', $js );
                return;
            }
        
        }        
        
		$accentcolor = get_option('ut_accentcolor' , '#CC5E53');
		$ut_hero_type = ut_return_hero_config('ut_hero_type');
        
        $js = '(function($){
        	
				"use strict";
		
				$(document).ready(function(){ ';
			    
                $js .= 'var brooklyn_scroll_offset = $("#header-section").outerHeight();';
                
                /*
				|--------------------------------------------------------------------------
				| Retina Logo
				|--------------------------------------------------------------------------
				*/
                
                /* check if current page has an option tp show a hero */
                $ut_activate_page_hero = get_post_meta( get_the_ID() , 'ut_activate_page_hero' , true );  
                
                $sitelogo_retina = !is_front_page() && !is_home() && ( $ut_activate_page_hero == 'off' || empty( $ut_activate_page_hero ) ) ? get_theme_mod( 'ut_site_logo_alt_retina' ) ? get_theme_mod( 'ut_site_logo_alt_retina' ) : get_theme_mod( 'ut_site_logo_retina' ) : get_theme_mod( 'ut_site_logo_retina' );                        
                $alternate_logo_retina = get_theme_mod( 'ut_site_logo_alt_retina' ) ? get_theme_mod( 'ut_site_logo_alt_retina' ) : get_theme_mod( 'ut_site_logo_retina' );
                                
                $js .= 'window.matchMedia||(window.matchMedia=function(){var c=window.styleMedia||window.media;if(!c){var a=document.createElement("style"),d=document.getElementsByTagName("script")[0],e=null;a.type="text/css";a.id="matchmediajs-test";d.parentNode.insertBefore(a,d);e="getComputedStyle"in window&&window.getComputedStyle(a,null)||a.currentStyle;c={matchMedium:function(b){b="@media "+b+"{ #matchmediajs-test { width: 1px; } }";a.styleSheet?a.styleSheet.cssText=b:a.textContent=b;return"1px"===e.width}}}return function(a){return{matches:c.matchMedium(a|| "all"),media:a||"all"}}}());';                
                $js .= 'var ut_modern_media_query = window.matchMedia( "screen and (-webkit-min-device-pixel-ratio:2)");';
                                
                if( !empty( $sitelogo_retina ) ) {
                
                    $js .= 'if( ut_modern_media_query.matches ) {
                        
                        var $logo = $(".site-logo img");
                        $logo.attr("src" , retina_logos.sitelogo_retina );
                                        
                    
                    }';
                
                }
                
                if( !empty( $alternate_logo_retina ) ) {
                        
                      $js .= 'if( ut_modern_media_query.matches ) {
                        
                        var $logo = $(".site-logo img");
                        $logo.data("altlogo" , retina_logos.alternate_logo_retina );        
                            
                      
                      }';                        
                
                }
                
				/*
				|--------------------------------------------------------------------------
				| Pre Loader
				|--------------------------------------------------------------------------
				*/
                
                if( ot_get_option('ut_use_image_loader') == 'on' ) :
					
					if( ut_dynamic_conditional('ut_use_image_loader_on') ) : 
					
						/* settings for pre loader */
						$loadercolor = ot_get_option( 'ut_image_loader_color' );
						$barcolor = ot_get_option( 'ut_image_loader_bar_color' , $accentcolor );
						$loader_bg_color = ot_get_option('ut_image_loader_background' , '#FFF');
						$bar_height = ot_get_option('ut_image_loader_barheight', 3 );
						$ut_show_loader_bar = ot_get_option('ut_show_loader_bar' , 'on');
																
						if( unite_mobile_detection()->isMobile() ) :
							
							$js .= 'window.addEventListener("DOMContentLoaded", function() {
															
								$("body").queryLoader2({
									showbar: "'.$ut_show_loader_bar.'",					
									barColor: "'.$barcolor.'",
									textColor: "'.$loadercolor.'",
									backgroundColor: "'.$loader_bg_color.'",
									barHeight: '.$bar_height.',
									percentage: true,						
									completeAnimation: "fade",
									minimumTime: 500,
                                    onComplete : function() {
									
										$(".ut-loader-overlay").fadeOut( 1200 , "easeInOutExpo" , function() {
											$(this).remove();
										});
										
									}
									
								});
							});';
							
						else :
						
							$js .= '$("body").queryLoader2({						
								showbar: "'.$ut_show_loader_bar.'",			
								barColor: "'.$barcolor.'",
								textColor: "'.$loadercolor.'",
								backgroundColor: "'.$loader_bg_color.'",
								barHeight: '.$bar_height.',
								percentage: true,						
								completeAnimation: "fade",
								minimumTime: 500,
                                onComplete : function() {
								
									$(".ut-loader-overlay").fadeOut( 1200 , "easeInOutExpo" , function() {
										$(this).remove();
									});
									
								}
								
							});';
							
						endif;

                	endif;

                endif;
				  
				/*
				|--------------------------------------------------------------------------
				| Slogan / Welcome Message Animation
				|--------------------------------------------------------------------------
				*/
                 
				if( $ut_hero_type != 'slider' ) :
				
				$js .= '
				$(window).load(function() {
					
					function show_slogan() {
						$(".hero-holder").animate({ opacity : 1 });
					}
								
					var execute_slogan = setTimeout ( show_slogan , 800 );
					
				});'; 
				
				endif;  
				
				/*
				|--------------------------------------------------------------------------
				| Fittext for Hero Style 11
				|--------------------------------------------------------------------------
				*/
                if( ut_return_hero_config('ut_hero_style' , 'ut-hero-style-1') == 'ut-hero-style-11' ) :
                    
                    $js .= '
                    
                        $(".ut-hero-style-11 .hero-title").fitText(1.1, { minFontSize: "30px", maxFontSize: "130px" });
	                    $(".ut-hero-style-11 .hero-description").fitText(1.6, { minFontSize: "20px", maxFontSize: "72px" });
                        $(".ut-hero-style-11 .hero-description-bottom").fitText(2.0, { minFontSize: "14px", maxFontSize: "20px" });
                    
                    ';
                
                endif;
                
				/*
				|--------------------------------------------------------------------------
				| Call to Action Button Scoll Animation
				| only available if shortcode plugin has been installed
				|--------------------------------------------------------------------------
				*/
				
				if( ut_is_plugin_active('ut-shortcodes/ut-shortcodes.php') ) {
				
                    $js .= '
                        $(".cta-btn a").click( function(event) { 
                    
                            if(this.hash) {
                                $.scrollTo( this.hash , 650, { easing: "easeInOutExpo" , offset: -brooklyn_scroll_offset-1 , "axis":"y" } );			
                                event.preventDefault();				
                            }
                            
                        });				
                    ';
				
				}
				 
				 
				                
				/*
				|--------------------------------------------------------------------------
				| Main Navigation Animation
				|--------------------------------------------------------------------------
				*/
                if( ( ( is_home() || is_front_page() || is_singular('portfolio') || get_post_meta( get_the_ID() , 'ut_activate_page_hero' , true ) == 'on' ) ) && ut_return_header_config( 'ut_navigation_skin' , 'ut-header-light' ) == 'ut-header-custom' ) :
                
                    if( ut_return_header_config('ut_navigation_customskin_state' , 'off') == 'off' ) {
                        
                        $classes = array();
                        
                        $classes[] = 'ut-primary-custom-skin';
                        $classes[] = ut_return_header_config( 'ut_navigation_width', 'centered' );
                        $classes[] = ot_get_option( 'ut_site_border', 'hide' ) == 'show' ? 'bordered-navigation' : '';
                        $classes[] = ot_get_option( 'ut_site_border', 'hide' ) == 'show' && ot_get_option( 'ut_site_navigation_flush', 'no' && ut_return_header_config( 'ut_navigation_width', 'centered' ) == 'fullwidth' ) == 'yes' ? 'ut-flush' : '';
                            
                        ob_start();
                    
                        ?>
                                           
                        /* Header Animation
                        ================================================== */		
                        var $header     = $("#header-section"),
                            $logo	    = $(".site-logo img"),
                            logo	    = $logo.attr("src"),
                            logoalt     = $logo.data("altlogo"),
                            is_open     = false,
                            has_passed  = false;
                        
                        var ut_nav_skin_changer = function( direction , animClassDown, animClassUp ) {
                            
                            if( direction === "down" && animClassDown ) {
                                
                                $header.attr("class", "ha-header <?php echo implode(' ', $classes ); ?>").addClass(animClassDown);
                                $logo.attr("src" , logoalt );
                                
                            } else if( direction === "up" && animClassUp ){
                                
                                $header.attr("class", "ha-header <?php echo implode(' ', $classes ); ?>").addClass(animClassUp);
                                $logo.attr("src" , logo );
                                
                            }
                            
                        };
                                            
                        $( ".ha-waypoint" ).each( function(i) {
                            
                            /* needed vars */
                            var $this = $( this ),
                                animClassDown = $this.data( "animateDown" ),
                                animClassUp   = $this.data( "animateUp" );
                            
                            $this.waypoint(function(direction) {
                                
                                ut_nav_skin_changer( direction , animClassDown , animClassUp );
                                
                            }, { offset: brooklyn_scroll_offset+1 } );
                            
                        });
                        
                        <?php
                        
                        $js .= ob_get_clean();
                    
                    }
                    
                    if( ut_return_header_config('ut_navigation_customskin_state' , 'off') == 'on_switch' ) {
                        
                        $flush_nav = ( ot_get_option( 'ut_site_border', 'hide' ) == 'show' && ot_get_option( 'ut_site_navigation_flush', 'no' ) == 'yes' && ut_return_header_config( 'ut_navigation_width', 'centered' ) == 'fullwidth' ) ? 'ut-flush' : '';
                        
                        $navigation_width    = esc_attr( ut_return_header_config( 'ut_navigation_width', 'centered' ) );
                        $border_header_class = ot_get_option('ut_site_border', 'hide' ) == 'show' ? 'bordered-navigation' : '';
                        
                        $primary_skin   = 'ut-primary-custom-skin';
                        $secondary_skin = 'ut-secondary-custom-skin';
                        
                        ob_start();
                        
                        ?>   
                        
                        /* Header Animation
					    ================================================== */		
                        var $header      = $("#header-section"),
                            $logo	     = $(".site-logo img"),
                            logo	     = $logo.attr("src"),
                            logoalt      = $logo.data("altlogo"),
                            is_open      = false,
                            has_passed   = false;
                        
                        var ut_update_header_skin = function() {
                            
                            if ( ( $(window).width() > 979 ) && is_open ) {
                                
                                $(".ut-mm-trigger").trigger("click");
                                
                                if( has_passed ) {
                                    
                                    $header.attr("class", "ha-header").addClass("<?php echo $flush_nav; ?>").addClass("<?php echo $primary_skin; ?>").addClass("<?php echo $navigation_width; ?>").addClass("<?php echo $border_header_class; ?>");
                                    
                                } else {
                                    
                                    $header.attr("class", "ha-header").addClass("<?php echo $flush_nav; ?>").addClass("<?php echo $secondary_skin; ?>").addClass("<?php echo $navigation_width; ?>").addClass("<?php echo $border_header_class; ?>");
                                    
                                }
                                
                            }
                               
                        };
                        
                        var ut_nav_skin_changer = function( direction ) {
                            
                            if( direction === "down" && !is_open ) {
                                
                                $header.attr("class", "ha-header").addClass("<?php echo $flush_nav; ?>").addClass("<?php echo $secondary_skin; ?>").addClass("<?php echo $navigation_width; ?>").addClass("<?php echo $border_header_class; ?>");
                                $logo.attr("src" , logoalt );
                                
                                has_passed = true;                            
                                
                            } else if( direction === "up" && !is_open ) {
                                
                                $header.attr("class", "ha-header").addClass("<?php echo $flush_nav; ?>").addClass("<?php echo $primary_skin; ?>").addClass("<?php echo $navigation_width; ?>").addClass("<?php echo $border_header_class; ?>");
                                $logo.attr("src" , logo );
                                
                                has_passed = false;
                                
                            }	
                        
                        };
                        
                        $(".ut-mm-trigger").click(function(event){ 
                                                    
                            if( $header.hasClass("<?php echo $primary_skin; ?>") && !has_passed ) {
                                
                                $header.attr("class", "ha-header").addClass("<?php echo $flush_nav; ?>").addClass("<?php echo $navigation_width; ?>").addClass("<?php echo $secondary_skin; ?>").addClass("<?php echo $border_header_class; ?>");
                                $logo.attr("src" , logoalt );                            
                                                            
                            } else if ( $header.hasClass("<?php echo $secondary_skin; ?>") && !has_passed ) {
                                
                                $header.attr("class", "ha-header").addClass("<?php echo $flush_nav; ?>").addClass("<?php echo $primary_skin; ?>").addClass("<?php echo $navigation_width; ?>").addClass("<?php echo $border_header_class; ?>");
                                $logo.attr("src" , logo );                            
                                
                            }
                                                                            
                            event.preventDefault();
                            
                        }).toggle(function(){ is_open = true; }, function() { is_open = false; });   
                                            
                        $(window).utresize(function(){
                            
                            ut_update_header_skin();
                            
                        });
                                        
                        $( "#main-content" ).waypoint( function( direction ) {
                                
                            ut_nav_skin_changer(direction);			
                            
                            if( direction === "down" ) {
                                
                                has_passed = true;                           
                                
                            } else if( direction === "up" ) {
                                                            
                                has_passed = false;                           
                                
                            }	
                            
                        }, { offset: brooklyn_scroll_offset+1 });                        
                    
                        <?php
                        
                        $js .= ob_get_clean();                        
                    
                    }                    
                
                endif;
                                
                if( ( ( is_home() || is_front_page() || is_singular('portfolio') || get_post_meta( get_the_ID() , 'ut_activate_page_hero' , true ) == 'on' ) ) && ut_return_header_config('ut_navigation_state' , 'off') == 'off' && ut_return_header_config( 'ut_navigation_skin' , 'ut-header-light' ) != 'ut-header-custom' ) :
               	    
                    $classes = array();
                    
				    $classes[] = ut_return_header_config( 'ut_navigation_skin' , 'ut-header-light' );
                    $classes[] = ut_return_header_config( 'ut_navigation_width', 'centered' );
                    $classes[] = ot_get_option( 'ut_site_border', 'hide' ) == 'show' ? 'bordered-navigation' : '';
                    $classes[] = ot_get_option( 'ut_site_border', 'hide' ) == 'show' && ot_get_option( 'ut_site_navigation_flush', 'no' ) == 'yes' && ut_return_header_config( 'ut_navigation_width', 'centered' ) == 'fullwidth' ? 'ut-flush' : '';
                    
                    ob_start();
                    
                    ?>
                                       
					/* Header Animation
					================================================== */		
					var $header     = $("#header-section"),
						$logo	    = $(".site-logo img"),
						logo	    = $logo.attr("src"),
						logoalt     = $logo.data("altlogo"),
                        is_open     = false,
                        has_passed  = false;
					
                    var ut_nav_skin_changer = function( direction , animClassDown, animClassUp ) {
                        
                        if( direction === "down" && animClassDown ) {
                            
                            $header.attr("class", "ha-header <?php echo implode(' ', $classes ); ?>").addClass(animClassDown);
                            $logo.attr("src" , logoalt );
                            
                        } else if( direction === "up" && animClassUp ){
                            
                            $header.attr("class", "ha-header <?php echo implode(' ', $classes ); ?> " + animClassUp + "");
                            $logo.attr("src" , logo );
                            
                        }
                        
                    };
                    					
					$( ".ha-waypoint" ).each( function(i) {
						
						/* needed vars */
						var $this = $( this ),
							animClassDown = $this.data( "animateDown" ),
							animClassUp   = $this.data( "animateUp" );
                        
						$this.waypoint(function(direction) {
							
                            ut_nav_skin_changer( direction , animClassDown , animClassUp );
                            
						}, { offset: brooklyn_scroll_offset+1 } );
						
					});
                    
                    <?php
                    
                    $js .= ob_get_clean();
                
                endif;
				
			    if( ( is_home() || is_front_page() || is_singular('portfolio') || get_post_meta( get_the_ID() , 'ut_activate_page_hero' , true ) == 'on' ) && ut_return_header_config('ut_navigation_state' , 'off') == 'on_transparent' && ut_return_header_config( 'ut_navigation_skin' , 'ut-header-light' ) != 'ut-header-custom' ) :
               	                        
                    $ut_navigation_skin = ut_return_header_config('ut_navigation_skin' , 'ut-header-light');
                    $ut_navigation_transparent_border = ut_return_header_config('ut_navigation_state') == 'on_transparent' && ut_return_header_config('ut_navigation_transparent_border') == 'on' ?  'ut-header-has-border' : '';
                    $navigation_width = ut_return_header_config('ut_navigation_width' , 'centered');
                    $ut_site_border_header_class = ot_get_option('ut_site_border', 'hide' ) == 'show' ? 'bordered-navigation' : '';
                    $flush_nav = ( ot_get_option( 'ut_site_border', 'hide' ) == 'show' && ot_get_option( 'ut_site_navigation_flush', 'no' ) == 'yes' && ut_return_header_config( 'ut_navigation_width', 'centered' ) == 'fullwidth' ) ? 'ut-flush' : '';
                    
                     
					$js .= '				
					/* Header Animation
					================================================== */		
					var $header     = $("#header-section"),
						$logo	    = $(".site-logo img"),
						logo	    = $logo.attr("src"),
						logoalt     = $logo.data("altlogo"),
                        is_open     = false,
                        has_passed  = false;
					
                    var ut_update_header_skin = function() {
                        
                        if ( ( $(window).width() > 979 ) && is_open ) {
                            
                            $(".ut-mm-trigger").trigger("click");
                            
                            if( has_passed ) {
                                
                                $header.attr("class", "ha-header").addClass("' . $flush_nav . '").addClass("' . $ut_navigation_skin . '").addClass("' . $navigation_width . '").addClass("' . $ut_site_border_header_class . '");
                                
                            } else {
                                
                                $header.attr("class", "ha-header").addClass("' . $flush_nav . '").addClass("ha-transparent").addClass("' . $ut_navigation_transparent_border . '").addClass("' . $navigation_width . '").addClass("' . $ut_site_border_header_class . '");
                                
                            }
                            
                        }
                           
                    };
                    
                    var ut_nav_skin_changer = function( direction ) {
                        
                        if( direction === "down" && !is_open ) {
                            
                            $header.attr("class", "ha-header").addClass("' . $flush_nav . '").addClass("' . $ut_navigation_skin . '").addClass("' . $navigation_width . '").addClass("' . $ut_site_border_header_class . '");
                            $logo.attr("src" , logoalt );
                            
                            has_passed = true;                            
                            
                        } else if( direction === "up" && !is_open ) {
                            
                            $header.attr("class", "ha-header").addClass("' . $flush_nav . '").addClass("ha-transparent").addClass("' . $ut_navigation_transparent_border . '").addClass("' . $navigation_width . '").addClass("' . $ut_site_border_header_class . '");
                            $logo.attr("src" , logo );
                            
                            has_passed = false;
                            
                        }	
                    
                   };
                    
                   $(".ut-mm-trigger").click(function(event){ 
                                                
                        if( $header.hasClass("ha-transparent") && !has_passed ) {
                            
                            $header.attr("class", "ha-header").addClass("' . $flush_nav . '").addClass("' . $navigation_width . '").addClass("' . $ut_navigation_skin . '").addClass("' . $ut_site_border_header_class . '");
                            $logo.attr("src" , logoalt );                            
                                                        
                        } else if ( $header.hasClass("'.$ut_navigation_skin.'") && !has_passed ) {
                            
                            $header.attr("class", "ha-header").addClass("' . $flush_nav . '").addClass("ha-transparent").addClass("' . $navigation_width . '").addClass("' . $ut_site_border_header_class . '");
                            $logo.attr("src" , logo );                            
                            
                        }
                                                                        
                        event.preventDefault();
                        
                    }).toggle(function(){ is_open = true; }, function() { is_open = false; });   
                                        
                    $(window).utresize(function(){
                        ut_update_header_skin();
                    });
                                    
					$( "#main-content" ).waypoint( function( direction ) {
							
						ut_nav_skin_changer(direction);			
						
                        if( direction === "down" ) {
                            
                            has_passed = true;                           
                            
                        } else if( direction === "up" ) {
                                                        
                            has_passed = false;                           
                            
                        }	
                        
					}, { offset: brooklyn_scroll_offset+1 });';
                
                endif;
				
				/*
				|--------------------------------------------------------------------------
				| Rain Effect for images
				|--------------------------------------------------------------------------
				*/
				if( ut_return_hero_config('ut_hero_rain_effect' , 'off') == 'on' && ($ut_hero_type == 'image' || $ut_hero_type == 'tabs' || $ut_hero_type == 'splithero')) :
					
					$js .= '
					
					$.fn.utFullSize = function( callback ) {
						
						var fullsize = $(this);		
					
						function utResizeObject() {
						  
						  	var imgwidth = fullsize.width(),
						   		imgheight = fullsize.height(),
								winwidth = $(window).width(),
						  		winheight = $(window).height(),
								widthratio = winwidth / imgwidth,
						  		heightratio = winheight / imgheight,
								widthdiff = heightratio * imgwidth,
						  		heightdiff = widthratio * imgheight;
							
							if( heightdiff > winheight ) {
							
								fullsize.css({
									width: winwidth+"px",
									height: heightdiff+"px"
								});
							
							} else {
							
								fullsize.css({
									width: widthdiff+"px",
									height: winheight+"px"
								});		
								
							}
							
						} 
						
						utResizeObject();
						
						$(window).utresize(function(){
							utResizeObject();
						});
						
						if (callback && typeof(callback) === "function") {   
							callback();  
						}

					};
					
					
					function ut_init_RainyDay( callback ) {
												
						var $image = document.getElementById("ut-rain-background"),
							$hero  = document.getElementById("ut-hero");						
							
							var engine = new RainyDay({
								image: $image,
								parentElement : $hero,
								blur: 20,
								opacity: 1,
								fps: 24
							});
							
							engine.gravity = engine.GRAVITY_NON_LINEAR;
							engine.trail = engine.TRAIL_SMUDGE;
							engine.rain([ [6, 6, 0.1], [2, 2, 0.1] ], 50 );
						
						$image.crossOrigin = "anonymous";
						
						if (callback && typeof(callback) === "function") {   
							callback();  
						}
						
					}
										
					
					$(window).load(function(){
						
						$("#ut-rain-background").utFullSize( function() {
							
							/* play rainday sound and remove section image and adjust canvas */
							ut_init_RainyDay( function() {
								
								$("#ut-hero").css("background-image" , "none");
								$("#ut-hero canvas").utFullSize();
								
								if( $("#ut-hero-audio").length != 0 ) {
									$("#ut-hero-audio").find(".mejs-play button").click();
								}
								
							});
						
						});
						
					});';
					
					if( ut_return_hero_config('ut_hero_rain_sound' , 'off') == 'on' ) :					
					
					$js .= '
					
					$(".ut-audio-control").click(function(event){
                                            
						var $audioPlayer = $("#ut-hero-audio");
						                                                
						if( $(".ut-audio-control").hasClass("ut-unmute") ) {
							
							$audioPlayer.find(".mejs-mute button").click();							
							$(this).removeClass("ut-unmute").addClass("ut-mute").text("MUTE");	
						
						} else {
							
							$audioPlayer.find(".mejs-unmute button").click();							
							$(this).removeClass("ut-mute").addClass("ut-unmute").text("UNMUTE");
							
						}
						
						event.preventDefault();
						
					});
					
					';
					
					endif;
					
				
				endif;
				
				/*
				|--------------------------------------------------------------------------
				| Video Player Call
				|--------------------------------------------------------------------------
				*/
				
				if( !unite_mobile_detection()->isMobile() && $ut_hero_type == 'video' || !unite_mobile_detection()->isMobile() && $ut_hero_type == 'tabs' && ut_return_hero_config('ut_video_containment', 'hero') == 'body' ) :
				    
                    $volume = ut_return_hero_config('ut_video_volume' , "5") ;
					
						$js .= '
						if( $("#ut-background-video-hero").length ) {						
							
							var $hero_player = $("#ut-background-video-hero").YTPlayer();
							
							/* player mute control */
							$("#ut-video-hero-control.youtube").click(function(event){
								
								if( $(this).hasClass("ut-unmute") ) {									
                                    
									$(this).removeClass("ut-unmute").addClass("ut-mute").text("MUTE");														
									$hero_player.YTPUnmute();
									
								} else {
                                    
									$(this).removeClass("ut-mute").addClass("ut-unmute").text("UNMUTE");
									$hero_player.YTPMute();							
									
								}
	                            
                                event.preventDefault();
                                
							});
                            
                            $hero_player.on("YTPReady",function(e){
                                
                                $("#ut-hero").css("background", "none");

                            });
							
						}';					
					
					
               	endif;
				
				/*
				|--------------------------------------------------------------------------
				| Slider Settings Hook
				|--------------------------------------------------------------------------
				*/ 
				if( $ut_hero_type == 'slider' || is_singular("portfolio") && get_post_format() == 'gallery' ) : 
           			
                    $animation		= ut_return_hero_config('ut_background_slider_animation' , 'fade');
					$slideshowSpeed = ut_return_hero_config('ut_background_slider_slideshow_speed' , 7000);
					$animationSpeed = ut_return_hero_config('ut_background_slider_animation_speed' , 600);					
                    
                    if( is_singular("portfolio") ) {
                        
                        $animation		= 'fade';
						$slideshowSpeed = '7000';
						$animationSpeed = '600';
                    
                    }
                     
                
                 $js .= '
				 $(window).load(function(){
					 
					 var $hero_captions = $("#ut-hero-captions"),
					 	 animatingTo = 0;
					 
					 $hero_captions.find(".hero-holder").each(function() {						
						
						var pos = $(this).data("animation"),
							add = "-50%";
						
						if( pos==="left" || pos==="right" ) { add = "-25%" };						
						
						$(this).css( pos , add );	
												
					 });
					 
					 
                     $hero_captions.flexslider({
                        animation: "fade",
						animationSpeed: '.$animationSpeed.',
						slideshowSpeed: '.$slideshowSpeed.',
                        controlNav: false,
						directionNav: false,
                        animationLoop: true,
                        slideshow: true,
                        before: function(slider){                        	
							
							/* hide hero holder */
							$(".flex-active-slide").find(".hero-holder").fadeOut("fast", function() {
								
								var pos = $(this).data("animation"),
									anim = { opacity: 0 , display : "table" },
									add = "-50%";
								
								if( pos==="left" || pos==="right" ) { add = "-25%" };
								
								anim[pos] = add;
								
								$(this).css(anim);
								
							});
														
							/* animate background slider */
                            $("#ut-hero-slider").flexslider(slider.animatingTo);
						    
                        },
						after: function(slider) {
							
							/* change position of caption slider */
							slider.animate( { top : ( $(window).height() - $hero_captions.find(".flex-active-slide").height() ) / 2 } , 100 , function() {
							
								/* show hero holder */
								var pos = $(".flex-active-slide").find(".hero-holder").data("animation"),
									anim = { opacity: 1 };
								
								anim[pos] = 0;
								
								$(".flex-active-slide").find(".hero-holder").animate( anim );
							
							});
														
						},
						start: function(slider) {
							 
							/* create external navigation */
							$(".ut-flex-control").click(function(event){
								
								if ($(this).hasClass("next")) {
								
								  slider.flexAnimate(slider.getTarget("next"), true);
								
								} else {
								
								  slider.flexAnimate(slider.getTarget("prev"), true);
								
								}
								
								event.preventDefault();	
								
							});
							
							$(".hero.slider .parallax-overlay").fadeIn("fast");
														
							/* change position of caption slider */
							slider.animate( { top : ( $(window).height() - $hero_captions.find(".flex-active-slide").height() ) / 2 } , 100 , function() { 
								
								/* show hero holder */
								var pos = $(".flex-active-slide").find(".hero-holder").data("animation"),
									anim = { opacity: 1 };
					
								anim[pos] = 0;
									
								$(".flex-active-slide").find(".hero-holder").animate( anim );
							
							
							});
														
						}
					});
                    
                    var ut_trigger = 0;
                    
					$(window).utresize(function(){
                        
                        /* do not fire on window load resize event */    
                        if( ut_trigger > 0 ) {
                        
                            /* adjust first slide browser bug */
                            $hero_captions.find(".hero-holder").each(function() {
                                
                                $(this).find(".hero-title").width("");
                                
                                if( $(this).width() > $(this).parent().width() ) {
                                    
                                    $(this).find(".hero-title").width( $(this).parent().width()-20 );
                                
                                }
                            
                            });
                            
                            /* change slide */
                            $hero_captions.flexslider("next");
                            $hero_captions.flexslider("play");
                        
                        }
                        
                        ut_trigger++;
                            
					});
										
                    $("#ut-hero-slider").flexslider({
						animation: "fade",
						animationSpeed: '.$animationSpeed.',
						slideshowSpeed: '.$slideshowSpeed.', 
                        directionNav: false,
						controlNav: false,
    					animationLoop: true,
                        slideshow: true
					});
                                        
				});';
                
                endif;
				
				
				/*
				|--------------------------------------------------------------------------
				| Parallax Effect for Hero on Front Page
				|--------------------------------------------------------------------------
				*/ 								
				if( ut_return_hero_config('ut_hero_image_parallax') == 'on' ) :
                	
					if( !unite_mobile_detection()->isMobile() ) :
					
                		$js .= '$(".hero .parallax-scroll-container").parallax("50%", 0.6);';
                
					endif;
					
                endif;
				
				/*
				|--------------------------------------------------------------------------
				| Parallax Effect - disabled for mobile devices to much repaint cost
				|--------------------------------------------------------------------------
				*/ 
				if( !unite_mobile_detection()->isMobile() ) {			
								
					$js .= '$(".parallax-banner .parallax-scroll-container").each(function() {                
                            $(this).css({
                                "height" : $(window).height() * 1.1 + "px",
                                "width"  : $(window).width()  * 1.1 + "px",
                                "left"   : "-5%"                            
                            }).parallax( "50%", 0.6 ); 
                        });';
							
				}                
                
                /*
				|--------------------------------------------------------------------------
				| Parallax Effect for Footer
				|--------------------------------------------------------------------------
				*/ 
                               
                $ut_csection_parallax = ot_get_option('ut_csection_parallax' , 'on'); 
				
				if( $ut_csection_parallax == 'on' ) : 
                	
					if( !unite_mobile_detection()->isMobile() ) :
					
                		$js .= '$(".contact-section .parallax-scroll-container").css({
                            "height" : $(window).height() * 1.1 + "px",
                            "width"  : $(window).width()  * 1.1 + "px",
                            "left"   : "-5%"                            
                        }).parallax("50%", 0.6,true);';
                	
					endif;
					
                endif;
				
                
                /*
				|--------------------------------------------------------------------------
				| Lightbox
				|--------------------------------------------------------------------------
				*/
                
                $ut_lightbox_script = ot_get_option('ut_lightbox_script' , 'prettyphoto'); 
                
                if( $ut_lightbox_script == 'prettyphoto' ) : 
                	
                    $js .= '$(".ut-lightbox").prettyPhoto({
                        social_tools : false,
                        markup: \'<div class="pp_pic_holder"> \
                                    <div class="pp_top"> \
                                        <div class="pp_left"></div> \
                                        <div class="pp_middle"></div> \
                                        <div class="pp_right"></div> \
                                    </div> \
                                    <div class="pp_content_container"> \
                                        <div class="pp_left"> \
                                        <div class="pp_right"> \
                                            <div class="pp_content"> \
                                                <div class="pp_loaderIcon"></div> \
                                                <div class="pp_fade"> \
                                                    <a href="#" class="pp_expand" title="Expand the image">Expand</a> \
                                                    <div class="pp_hoverContainer"> \
                                                        <a class="pp_next" href="#">next</a> \
                                                        <a class="pp_previous" href="#">previous</a> \
                                                    </div> \
                                                    <div id="pp_full_res"></div> \
                                                    <div class="pp_details"> \
                                                        <div class="pp_nav"> \
                                                            <a href="#" class="pp_arrow_previous">Previous</a> \
                                                            <p class="currentTextHolder">0/0</p> \
                                                            <a href="#" class="pp_arrow_next">Next</a> \
                                                        </div> \
                                                        <p class="pp_description"></p> \
                                                        <div class="ppt">&nbsp;</div> \
                                                        {pp_social} \
                                                        <a class="pp_close" href="#">Close</a> \
                                                    </div> \
                                                </div> \
                                            </div> \
                                        </div> \
                                        </div> \
                                    </div> \
                                    <div class="pp_bottom"> \
                                        <div class="pp_left"></div> \
                                        <div class="pp_middle"></div> \
                                        <div class="pp_right"></div> \
                                    </div> \
                                </div> \
                                <div class="pp_overlay"></div>\',
            
                    });';
                
                else :                    
                    
                   $js .= '$(".ut-lightbox").lightGallery({
                        selector: "this",
                        hash: false
                   });';
                    
				endif;
                
				/*
				|--------------------------------------------------------------------------
				| Section Animation
				|--------------------------------------------------------------------------
				*/
								
				if( !unite_mobile_detection()->isMobile() && ot_get_option('ut_animate_sections' , 'on') == 'on' ) : 
						
						$csection_timer = ot_get_option('ut_animate_sections_timer' , '1600');
						
						$js .= '$("section").each(function() {
															
							var outerHeight = $(this).outerHeight(),
								offset		= "90%",
								effect		= $(this).data("effect");
							
							if( outerHeight > $(window).height() / 2 ) {
								offset = "70%";
							}
							
                            $(this).waypoint("destroy");
							$(this).waypoint( function( direction ) {
								
								var $this = $(this);
												
								if( direction === "down" && !$(this).hasClass( "animated-" + effect ) ) {
									
									$this.find(".section-content").animate( { opacity: 1 } , ' . $csection_timer . ' );
									$this.find(".section-header-holder").animate( { opacity: 1 } , ' . $csection_timer . ' );
								    
                                    $this.addClass( "animated-" + effect );
                                    		
								}
								
							} , { offset: offset } );			
								
						});
                        
                        $(window).load(function(){
                            $(window).trigger("resize");
                        });';             
            	
				endif;
					                
            $js .= '});
			
        })(jQuery);';
		
        /* check for css cache */
        if( ot_get_option('ut_use_cache' , 'off') == 'on' && is_front_page() ) {
            
            $transient_prefix = unite_mobile_detection()->isMobile() ? '_mobile' : '_desktop';
            $language_prefix =  defined('ICL_LANGUAGE_CODE') ? '_' . ICL_LANGUAGE_CODE : '';
             
            $cacheTime = ot_get_option('ut_cache_ltime' , '10');            
            set_transient('ut_js_cache' . $transient_prefix . $language_prefix, $js, 60*$cacheTime);
        
        }
        
        //echo $js;
		echo apply_filters( 'ut-custom-js' , $js );
                
    }
    
    add_action( 'ut_java_footer_hook', 'ut_needed_js', 100 );

}