<?php
$radioopened = of_get_option('radio_opened');
$radiotitle = of_get_option('radio_title');
$radioinfo = of_get_option('radio_info');
echo '
<div id="radio-wz">
    <div id="radio-wz-hide">';	
	switch ($radioopened) {
    case "radio_opened_visible":
        echo '<div class="radio-wz-open-hidden"></div>';
	break; 	
	case "radio_opened_hidden":
        echo '<div class="radio-wz-open"></div>';
	break; 	
	}	
    echo '</div>
    <div id="radio-wz-col">
        <div id="radio-wz-source">
            <div id="jquery_jplayer_1" class="jp-jplayer"></div>
            <div id="jp_container_1" class="jp-audio">
                <div class="jp-type-single">
                    <div class="jp-gui jp-interface">
                        <ul class="jp-controls">
                            <li><a href="javascript:;" class="jp-repeat" tabindex="1" title="repeat">repeat</a></li>
                            <li><a href="javascript:;" class="jp-repeat-off" tabindex="1" title="repeat off">repeatoff</a></li>
                            <li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>
                            <li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
                            <li><a href="javascript:;" class="jp-stop" tabindex="1">stop</a></li>
                            <li class="radio-title">'.$radiotitle.'
							</li>
                            <li class="radio-info">'.$radioinfo.'</li>
                        </ul>
						<div class="jp-current-time"></div>
                        <div class="jp-volume">
                            <div class="jp-volume-sign"></div>
                            <div class="jp-volume-bar">
                                <div class="jp-volume-bar-loading">
                                    <div class="jp-volume-bar-value"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>';
?>