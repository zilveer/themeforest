<?php
    /**
     * The file contains the footer section including end tag of body and head. This will be applied all the templates.
     *
     */
     
    global $unik_data; 
      
    ?>
		</div> 
	</div> <!-- end top content -->
</div> <!-- end #ajax-content -->

<div id='ajax-loader'>
<?php
	if(isset($unik_data['loading_gif']) and !empty($unik_data['loading_gif']) ){
		echo '<img src="'.$unik_data['loading_gif'].'" alt="Loading .. ">';
	}
	else{
		echo '<div class="windows8">
<div class="wBall" id="wBall_1">
<div class="wInnerBall">
</div>
</div>
<div class="wBall" id="wBall_2">
<div class="wInnerBall">
</div>
</div>
<div class="wBall" id="wBall_3">
<div class="wInnerBall">
</div>
</div>
<div class="wBall" id="wBall_4">
<div class="wInnerBall">
</div>
</div>
<div class="wBall" id="wBall_5">
<div class="wInnerBall">
</div>
</div>
</div>';
	}
?></div><!-- Ajax loader-->

<?php 
    $songs = $unik_data['song_list'];
    ?> 
<footer id="colophon" class="main-footer clearfix" role="contentinfo">
    <section class="site-footer clearfix <?php if( is_array($songs) && $unik_data['player-switch']==1){ echo 'has-player';} ?>">
         <!-- footer left column -->
    <div class="footer-col social-container">
        <div class="footer-toggle-box">
            <span id="back-to-top"><i class="icon-angle-up"></i></span>
             <?php if(is_active_sidebar('reservation-sidebar')): ?>
                <button id="reservation-toggle" class="btn btn-primary h4"><?php echo $unik_data['reservation_toggle_text'] ; ?></button>
             <?php endif; ?>
        </div>

        <!--reservation widget-->
        <?php if(is_active_sidebar('reservation-sidebar')): ?>
        <div id="reservation" class="right">
            <div id="reservation-widget">
                <?php dynamic_sidebar('reservation-sidebar'); ?>
            </div>
        </div>
        <?php endif; ?>

        <div class="social">
            <?php
                // function that show social icons
                unik_social('facebook','Facebook');
                unik_social('twitter','Twitter');
                unik_social('linkedin','Linkedin');
                unik_social('flickr','Flickr');
                unik_social('rss', 'RSS');
                unik_social('vimeo','Vimeo');
                unik_social('youtube','YouTube');
                unik_social('tumblr','Tumblr');
                unik_social('gplus','Google plus');
                unik_social('dribbble','Dribbble');
                unik_social('blogger','Blogger');
                unik_social('myspace','Myspace');
                unik_social('reddit','Reddit');
                unik_social('soundcloud','SoundCloud');
                unik_social('instagram','Instagram');
                unik_social('pinterest','Pinterest');
                unik_social('itunes','Itunes');
                unik_social_custom('custom_icon_1_link','custom_icon_1_image','custom_icon_1_class');
                unik_social_custom('custom_icon_2_link','custom_icon_2_image','custom_icon_2_class');
                unik_social_custom('custom_icon_3_link','custom_icon_3_image','custom_icon_3_class');
            ?>
        </div>
    </div>

    <!-- footer right column -->
    <div class="footer-col text-center">
        <div class="copyright">
            <?php echo $unik_data['copyright_text']; ?>
        </div>
    </div>

    </section>
   
            
     <section class="footer-player <?php if( !is_array($songs) || $unik_data['player-switch']!=1){ echo 'inactive';} ?>">
        <!--jplayer-->

        <div class="jplayer">
            <div id="footer_jplayer" class="jp-jplayer"></div>
            <div id="jp_footer_container" class="jp-audio clearfix">
                <div class="jp-type-playlist">
					<span class="sound_control left">
							<span class="over"></span>  
						</span>

                    <div class="player_wrapper">
                        <div class="jp-gui jp-interface clearfix">
                            
                            <ul class="jp-controls left">
                                <li><span class="jp-previous" tabindex="1"><span class="glyphicon glyphicon-backward"></span></span></li>
                                <li><span class="jp-play" tabindex="1"><span class="glyphicon glyphicon-play"></span></span></li>
                                <li><span class="jp-pause" tabindex="1"><span class="glyphicon glyphicon-pause"></span></span></li>
                                <li><span class="jp-next" tabindex="1"><span class="glyphicon glyphicon glyphicon-forward"></span></span></li>
                                <li><span class="jp-stop" tabindex="1"><span class="glyphicon glyphicon-stop"></span></span></li>
								<li>
									<div class="jp-volume-bar">
										<div class="jp-volume-bar-value"></div>
									</div>
								</li>
                            </ul>
                            <ul class="jp-toggles left"><li><span class="jp-shuffle" tabindex="1" title="shuffle"><span class="glyphicon glyphicon-random"></span></span></li><li><span class="jp-shuffle-off" tabindex="1" title="shuffle off"><span class="glyphicon glyphicon-random"></span></span></li><li><span class="jp-repeat" tabindex="1" title="repeat"><span class="glyphicon glyphicon-refresh"></span></span></li><li><span class="jp-repeat-off" tabindex="1" title="repeat off"><span class="glyphicon glyphicon-refresh"></span></span></li></ul><div class="jp-time-holder left"><div class="jp-current-time"></div></div>
                            
                        </div>
                        <div class="jp-playlist <?php if($unik_data['audio-playlist-toggle']==1){echo "active";} ?>">
                            <div class="playlist-holder">
                                <div class="playlist ">
                                    <ul>
                                        <li></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="jp-no-solution">
                            <?php _e('Update your browser please',THEMENAME); ?>
                        </div>
                    </div>
                    <div class="jp-progress">
                        <div class="jp-seek-bar">
                            <div class="jp-play-bar"></div>
                        </div>
                    </div>
                    <!-- player progress bar -->
                </div>

                <div class="footerplayer-right clearfix">
                    <div class="footerplayer-thumb"></div>
                    <div class="footerplayer-desc">
                        <p class="track-title"></p>
                        <p class="track-artist"></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- jplayer end -->
         </section>
   
    <!-- footer middle column -->
    <!--Background slider-->
    <div class="background-slider" style="display: none">
        <ul id="slide-list"></ul>
        <div id="progress-back" class="load-item">
            <div id="progress-bar"></div>
        </div>
    </div>
</footer>
</div><!-- wrap -->
<script> <!--Tracking code -->
	<?php echo $unik_data['footer_script']; ?>
</script>
<?php wp_footer(); ?>
</body>
</html>