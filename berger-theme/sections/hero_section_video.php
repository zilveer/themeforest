<?php
/**
 * Created by Clapat.
 * Date: 01/02/15
 * Time: 1:54 PM
 */

global $cpbg_video_url, $cpbg_video_placeholder;

?>

				<!-- Video Container - Js will insert video in this div -->
                <div id="video-container">                
                
                    <!-- Stop movie Button -->
                    <a id="stopmovie" title="<?php _e('Click To Pause', THEME_LANGUAGE_DOMAIN); ?>"></a>
                    <!--/Stop movie Button -->
                    
                    
                    <!-- Play movie button and video cover image in style.css -->            
                    <a id="playmovie" style="background-image:url(<?php echo esc_url( $cpbg_video_placeholder['url'] ); ?>);">                
                        <div class="outer">                
                            <div class="inner">
                                <div class="play-icon"><i class="fa fa-play"></i></div>
                            </div>                
                        </div>                
                    </a>
                    <!--/Play movie Button -->
                    
                    
                    <!-- Video Background - Here you need to replace the videoURL with your youtube video URL -->
					<a id="bgndVideo" class="player" data-property="{videoURL:'<?php echo esc_url( $cpbg_video_url ); ?>',containment:'#video-container', autoPlay:true, vol:100, opacity:1, showControls:false}"></a>
					<!--/Video Background --> 
                                    
                
                </div>
                <!--/Video Container -->