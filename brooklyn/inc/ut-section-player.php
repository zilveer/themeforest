<?php

class UT_Section_Video_player {
	
    static $add_script;
    static $youtube;
    static $selfhosted;

	static function init() {
		
        add_shortcode('ut_section_video', array(__CLASS__, 'handle_shortcode'));
        
        add_action('init', array(__CLASS__, 'register_script'));
		add_action('wp_footer', array(__CLASS__, 'print_script'));
        
	}

	static function handle_shortcode($atts) {
		        
        self::$add_script = true;
        
        extract(shortcode_atts(array(
               'id'         => '',
               'section'    => '',
               'source'     => 'youtube',
               'video'      => '',
               'volume'     => '5',
               'mutebutton' => 'off',
               'sound'      => 'off',
               'loop'       => 'on',
               'mp4'        => '',
               'ogg'        => '',
               'webm'       => '',
               'preload'    => ''
        ), $atts));
        
        /* id or section is empty, nothing to do here */
        if( empty($id) || empty($section) || unite_mobile_detection()->isMobile() ) {
            return;
        }
        
        $script = NULL;
        $player = NULL;
        
        if($source == 'youtube' && !empty($video)) {
            
            self::$youtube = true;
            
            /* get player options */
            $sound_attr   = ($sound == 'off') ? 'mute : true' : 'mute : false';            
            $volume_attr  = (empty($volume)) ? 'vol : 0' : 'vol: ' . $volume;            
            $loop_attr    = ($loop == 'on') ? 'loop : true' : 'loop : false';
            
            /* create player script */
            $script .= '
            <script type="text/javascript">
            /* <![CDATA[ */
            
            (function($){
    
                $(document).ready(function(){
                    
                    if( $("#ut-background-video-' . $id . '").length ) {
                        
                        $("#ut-background-video-' . $id . '").YTPlayer();
                        
                        /* player mute control */
                        $("#ut-video-control-' . $id . '").click(function(event){
                            
                            event.preventDefault();		
                            
                            if( $(this).hasClass("ut-unmute") ) {
                                
                                $(this).removeClass("ut-unmute").addClass("ut-mute").text("MUTE");														
                                $("#ut-background-video-' . $id . '").unmuteYTPVolume();
                                
                            } else {
                                
                                $(this).removeClass("ut-mute").addClass("ut-unmute").text("UNMUTE");
                                $("#ut-background-video-' . $id . '").YTPMute();							
                                
                            }

                        });
                        
                        
                    }
           
                });

            })(jQuery);
            
             /* ]]> */	
            </script>';
            
            $player .= '<a id="ut-background-video-' . $id . '" class="ut-video-section-player" data-property="{ videoURL : \'' . $video . '\' , containment : \''.$section.'\' , showControls: false, quality: \'hd720\', autoPlay : true, '.$loop_attr.', '.$sound_attr.', '.$volume_attr.', startAt : 0, opacity : 1}"></a>';
            
            $sound = ( $sound == "on" ) ? 'ut-mute' : 'ut-unmute';
            
            if($mutebutton == 'on') {
                $player .= '<a id="ut-video-control-' . $id . '" class="ut-video-control '.$sound.' youtube" data-source="youtube" data-for="ut-background-video-' . $id . '" href="#">Unmute</a>';
            }
            
        }
        
        if($source == 'selfhosted') {
            
            if( !empty($mp4) || !empty($ogg) || !empty($webm) ) {
                
                self::$selfhosted = true;
                    
                /* build config */
                $sound   = ($sound == 'off') ? 'muted' : '';            
                $volume  = (empty($volume)) ? '5' : $volume;            
                $loop    = ($loop == 'on') ? 'loop' : '';
                $preload = ($preload == 'on') ? 'preload="auto"' : '';
                
                /* build player */
                $player .= '<div class="ut-video-container"><video id="ut-selfvideo-player-' . $id . '" class="ut-selfvideo-player" autoplay '.$loop.' '.$sound.' '.$preload.' volume="'.$volume.'" autobuffer controls>';
                
                if( !empty( $mp4 ) ) :
                            
                    $player .= '<source src="' . $mp4 . '" type="video/mp4"> ';
                    
                endif;
                
                if( !empty( $webm ) ) :
                    
                    $player .= '<source src="' . $webm . '" type="video/webm"> ';
                    
                endif;    
                
                if( !empty( $ogg ) ) :
                    
                    $player .= ' <source src="' . $ogg . '" type="video/ogg ogv">';
                                    
                endif;
                
                $player .= '</video></div><div class="ut-video-spacer"></div>';
                
                $sound = ( $sound == "on" ) ? 'ut-mute' : 'ut-unmute';
                
                if($mutebutton == 'on') {
                    $player .= '<a id="ut-video-control-' . $id . '" class="ut-video-control '.$sound.'" data-for="ut-selfvideo-player-' . $id . '" href="#">Unmute</a>';
                }
            
            
            }
            
        
        }        
                
        return $script . $player;
        
		
	}

	static function register_script() {
		
        wp_register_script('ut-bgvid', THEME_WEB_ROOT . '/js/jquery.mb.YTPlayer.min.js', array('jquery'), '1.0' , true );
        wp_register_script('ut-video', THEME_WEB_ROOT . '/js/ut-videoplayer.js', array('jquery'), '1.0' , true );
        
	}

	static function print_script() {
		
        if ( ! self::$add_script ) {
			return;
        }
        
        if ( self::$youtube ) {
		    wp_enqueue_script('ut-bgvid');
        }
        
        if ( self::$selfhosted ) {
            wp_enqueue_script('ut-video');
        }
        
	}
    
}

UT_Section_Video_player::init(); 


/*
|--------------------------------------------------------------------------
| Contact Section Video Player
|--------------------------------------------------------------------------
*/
if( !function_exists('ut_create_csection_bg_video') ) :
    
    function ut_create_csection_bg_video() {
        
        /* settings */        
        $playerconfig = array();
        $ut_csection_video_source = ot_get_option('ut_csection_video_source' , 'youtube');
        
        if( $ut_csection_video_source == 'youtube' ) {
            $ut_csection_video = ot_get_option('ut_csection_video');
            if(isset($ut_csection_video) && $ut_csection_video != '') { array_push($playerconfig, 'video="'.$ut_csection_video.'"'); }
        }
                    
        if( $ut_csection_video_source == 'selfhosted' ) {
            $ut_csection_video_mp4 = ot_get_option('ut_csection_video_mp4');
            if(isset($ut_csection_video_mp4) && $ut_csection_video_mp4 != '') { array_push($playerconfig, 'mp4="'.$ut_csection_video_mp4.'"'); }
            
            $ut_csection_video_ogg = ot_get_option('ut_csection_video_ogg');
            if(isset($ut_csection_video_ogg) && $ut_csection_video_ogg != '') { array_push($playerconfig, 'ogg="'.$ut_csection_video_ogg.'"'); }
            
            $ut_csection_video_webm = ot_get_option('ut_csection_video_webm');
            if(isset($ut_csection_video_webm) && $ut_csection_video_webm != '') { array_push($playerconfig, 'webm="'.$ut_csection_video_webm.'"'); }
            
            $ut_csection_video_preload = ot_get_option('ut_csection_video_preload');
            if(isset($ut_csection_video_preload) && $ut_csection_video_preload != '') { array_push($playerconfig, 'preload="'.$ut_csection_video_preload.'"'); }
        }
        
        $ut_csection_video_loop = ot_get_option('ut_csection_video_loop');
        if(isset($ut_csection_video_loop) && $ut_csection_video_loop != '') { array_push($playerconfig, 'loop="'.$ut_csection_video_loop.'"'); }
        
        $ut_csection_video_volume = ot_get_option('ut_csection_video_volume');
        if(isset($ut_csection_video_volume) && $ut_csection_video_volume != '') { array_push($playerconfig, 'volume="'.$ut_csection_video_volume.'"'); }
        
        $ut_csection_video_sound = ot_get_option('ut_csection_video_sound');
        if(isset($ut_csection_video_sound) && $ut_csection_video_sound != '') { array_push($playerconfig, 'sound="'.$ut_csection_video_sound.'"'); }
        
        $ut_csection_video_mute_button = ot_get_option('ut_csection_video_mute_button' , true );
        if(isset($ut_csection_video_mute_button) && $ut_csection_video_mute_button != '') { array_push($playerconfig, 'mutebutton="'.$ut_csection_video_mute_button.'"'); }
        
        echo do_shortcode('[ut_section_video id="contact-section-video" section="#contact-section" source="'.$ut_csection_video_source.'" '.implode(" ", $playerconfig).']');        
        
    }
    
endif; 

/*
|--------------------------------------------------------------------------
| Create Background Video Player
|--------------------------------------------------------------------------
*/
if( !function_exists('ut_create_bg_videoplayer') ) :

    function ut_create_bg_videoplayer( $call = '' ) {
                        
        if( unite_mobile_detection()->isMobile() ) {
            return;
        }
        
        $player = NULL;
        $video_url = NULL;
        $youtube = false;
        $custom = false;
        $selfhosted = false;        
        $containment = ( ut_return_hero_config('ut_video_containment' , 'hero') == 'body' ) ? 'body' : '#ut-hero';
                          
        /* only create player for desktop devices */
        if( !unite_mobile_detection()->isMobile() ) : 
                                                  
            /* check if youtube is active */
            if( ut_return_hero_config('ut_video_source' , 'youtube') == 'youtube' ) {
                $youtube = true;
            }
            
            /* check if youtube is active */
            if( ut_return_hero_config('ut_video_source' , 'youtube') == 'custom' ) {
                $custom = true;
            } 
                        
            /* check if selfhosted is active */
            if( ut_return_hero_config('ut_video_source' , 'youtube') == 'selfhosted' ) {
                $selfhosted = true;
            }           

            /* conditional to prevent selfhosted video displaying inside hero if it has been set to background */
            if( $selfhosted && ut_return_hero_config('ut_video_containment', 'hero') == 'body' && $call == 'section' ) {
                return;
            }
            
            /* conditional to prevent selfhosted video displaying inside the background if it has been set to hero */
            if( $selfhosted && ut_return_hero_config('ut_video_containment', 'hero') == 'hero' && $call == 'body' ) {
                return;
            }            
                                        
            if( $youtube ) {
                                
                $video_url = ut_return_hero_config('ut_video_url');
                
                if( !empty($video_url) ) :
                    
                    $muted   = ut_return_hero_config('ut_video_mute_state' , "off");
					$muted   = ($muted == 'off') ? 'mute : true' : 'mute : false';
                    $volume  = ut_return_hero_config('ut_video_volume' , "5") ;
                    $volume  = ($muted == 'off') ? 'vol : 0' : 'vol: ' . $volume;
                    $loop    = ut_return_hero_config('ut_video_loop' , "on") ;
                    $loop    = ($loop == 'on') ? 'loop : true' : 'loop : false';
                    
                    /* build player */
                    $player .= '<a id="ut-background-video-hero" class="ut-video-player" data-property="{ videoURL : \'' . $video_url . '\' , containment : \'' . $containment . '\', showControls: false, autoPlay : true, '.$loop.', '.$muted.', '.$volume.', startAt : 0, opacity : 1}"></a>';                        
                        
                    return $player;
                
                endif;
            
            } 
            
            if( $selfhosted )  {
                
                $mp4 = $ogg = $webm = NULL;
                
                $mp4  = ut_return_hero_config('ut_video_mp4');
                $ogg  = ut_return_hero_config('ut_video_ogg');
                $webm = ut_return_hero_config('ut_video_webm');
                                                
                if( !empty($mp4) || !empty($ogg) || !empty($webm) ) :
                    
                    $volume  = ut_return_hero_config('ut_video_volume' , "5") ;
                    $muted   = ut_return_hero_config('ut_video_mute_state' , "off");
                    $muted   = ($muted == 'off') ? 'muted' : '';
                    $loop    = ut_return_hero_config('ut_video_loop' , "on") ;
                    $loop    = ($loop == 'on') ? 'loop' : '';
                    $preload = ut_return_hero_config('ut_video_preload' , "on") ;
                    $preload = ($loop == 'on') ? 'preload="auto"' : '';
                                                    
                    $player .= '<div class="ut-video-container"><video id="ut-video-hero" class="ut-selfvideo-player" autoplay '.$loop.' '.$muted.' '.$preload.' volume="'.$volume.'" autobuffer controls>';
                    
                        if( !empty( $mp4 ) ) :
                            
                            $player .= '<source src="' . $mp4 . '" type="video/mp4"> ';
                            
                        endif;
                        
                        if( !empty( $webm ) ) :
                            
                            $player .= '<source src="' . $webm . '" type="video/webm"> ';
                            
                        endif;    
                        
                        if( !empty( $ogg ) ) :
                            
                            $player .= ' <source src="' . $ogg . '" type="video/ogg ogv">';
                                            
                        endif;
                    
                    $player .= '</video></div><div class="ut-video-spacer"></div>';
                    
                    return $player;    
                
                endif; /* check for player files */
            
            }
            
            if( $custom && $call != 'body' )  {
                
                $video_embedded = ut_return_hero_config('ut_video_url_custom');
                $player .= do_shortcode($video_embedded);
                
            }
                    
        endif;
        
        return $player;
        
    }
    
endif;


/*
|--------------------------------------------------------------------------
| Front Page Video Background Player
|--------------------------------------------------------------------------
*/
if( !function_exists('ut_create_front_bg_video') ) :
    
    function ut_create_front_bg_video() {
        
        /* settings */        
        $playerconfig = array();
        
        /* video has been turn off or we are not on the front page */
        if( ot_get_option('ut_front_bg_video_state' , 'off' ) == 'off' || !is_front_page() ) {
            return;
        }            
        
        if( ot_get_option('ut_front_bg_video_source' , 'youtube') == 'youtube' ) {
            
            $ut_front_bg_video_youtube = ot_get_option('ut_front_bg_video_youtube');
            if( isset($ut_front_bg_video_youtube) && $ut_front_bg_video_youtube != '' ) { 
                array_push($playerconfig, 'video="' . $ut_front_bg_video_youtube . '"'); 
            }
            
        }
        
        if( ot_get_option('ut_front_bg_video_source' , 'youtube') == 'selfhosted' ) {
            
            $ut_front_bg_video_mp4 = ot_get_option('ut_front_bg_video_mp4');
            if( isset($ut_front_bg_video_mp4) && $ut_front_bg_video_mp4 != '' ) { 
                array_push($playerconfig, 'mp4="' . $ut_front_bg_video_mp4 . '"'); 
            }
            
            $ut_front_bg_video_ogg = ot_get_option('ut_front_bg_video_ogg');
            if( isset($ut_front_bg_video_ogg) && $ut_front_bg_video_ogg != '' ) { 
                array_push($playerconfig, 'ogg="' . $ut_front_bg_video_ogg . '"'); 
            }
            
            $ut_front_bg_video_webm = ot_get_option('ut_front_bg_video_webm');
            if( isset($ut_front_bg_video_webm) && $ut_front_bg_video_webm != '' ) { 
                array_push($playerconfig, 'webm="' . $ut_front_bg_video_webm . '"'); 
            }
            
            $ut_csection_video_preload = ot_get_option('ut_csection_video_preload');
            if( isset($ut_csection_video_preload) && $ut_csection_video_preload != '' ) { 
                array_push($playerconfig, 'preload="' . $ut_csection_video_preload . '"'); 
            }
            
        }
        
        $ut_front_bg_video_volume = ot_get_option('ut_front_bg_video_volume');
        if( isset($ut_front_bg_video_volume) && $ut_front_bg_video_volume != '' ) { 
            array_push($playerconfig, 'volume="' . $ut_front_bg_video_volume . '"'); 
        }
        
        $ut_front_bg_video_mute_button = ot_get_option('ut_front_bg_video_mute_button' , true );
        if(isset($ut_front_bg_video_mute_button) && $ut_front_bg_video_mute_button != '') { 
            array_push($playerconfig, 'mutebutton="' . $ut_front_bg_video_mute_button . '"'); 
        }        
        
        echo do_shortcode('[ut_section_video id="front-bg-vid" section="body" source="' . ot_get_option('ut_front_bg_video_source' , 'youtube') . '" ' . implode(" ", $playerconfig) . ']');
        
    }

endif;


?>