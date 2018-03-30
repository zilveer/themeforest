<?php

extract( shortcode_atts( array(
            'mp3_file' => '',
            'ogg_file' => '',
            'file_title' => '',
            'small_version' => 'false',
            'el_class' => '',
        ), $atts ) );
wp_enqueue_script( 'jquery-jplayer' );
$output = '';
$audio_id = Mk_Static_Files::shortcode_id();
$title_exists = !empty($file_title) ? 'add-baloon' : '';
$output .= '<div class="mk-audio small-version-'.$small_version.' '.$title_exists.' '.$el_class.'">';
if ( $file_title ) {
    $output .= '<span class="mk-audio-author">'.$file_title.'</span>';
}
$output .= '<script type="">

        jQuery(document).ready(function($) {

                jQuery("#jquery_jplayer_'.$audio_id.'").jPlayer({
                    ready: function () {
                        $(this).jPlayer("setMedia", {';
                if ( $mp3_file ) {
                    $output .= 'mp3: "'.$mp3_file.'",';
                }
                if ( $ogg_file ) {
                    $output .= 'ogg: "'.$ogg_file.'",';
                }

            $output .= ' });
                    },
                    play: function() { // To avoid both jPlayers playing together.
                        $(this).jPlayer("pauseOthers");
                    },
                    swfPath: "'.THEME_JS.'",
                    supplied: "mp3, ogg",
                    cssSelectorAncestor: "#jp_container_'.$audio_id.'",
                    wmode: "window"
                });
        })

        </script>
        <div id="jquery_jplayer_'.$audio_id.'" class="jp-jplayer"></div>
        <div id="jp_container_'.$audio_id.'" class="jp-audio">
            <div class="jp-type-single">
                    <div class="jp-gui jp-interface">
                        <ul class="jp-controls">
                            <li><a href="javascript:;" class="jp-play" tabindex="1"><i class="mk-theme-icon-next-big"></i></a></li>
                            <li><a href="javascript:;" class="jp-pause" tabindex="1"><i class="mk-icon-pause"></i></a></li>
                        </ul>
                        <div class="jp-progress">
                            <div class="jp-seek-bar">
                                <div class="jp-play-bar"></div>
                            </div>
                        </div>
                        <div class="js-volume-wrapper">
                        <div class="jp-volume-bar">
                            <div class="inner-value-adjust"><div class="jp-volume-bar-value"></div></div>
                        </div>
                        </div>
                       <div class="clearboth"></div>
                    </div>
                </div>
            </div></div>';
echo $output;
