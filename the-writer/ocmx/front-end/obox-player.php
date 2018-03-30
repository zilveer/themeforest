<?php function obox_player($post, $width = 590, $height = 300) {
	if(!is_array($post))
		$post = get_post($post);
	
	$hosted_m4v = get_post_meta($post->ID, "video_hosted", true);
	$hosted_ogv = get_post_meta($post->ID, "video_hosted_ogv", true);
	$hosted_webmv = get_post_meta($post->ID, "video_hosted_webmv", true);
	$image = get_post_meta($post->ID, "other_media", true);
	$html = '<div id="jp_container_'.$post->ID.'" class="jp-video">
		<div class="jp-type-single">
	  		<div id="jquery_jplayer_'.$post->ID.'" class="jp-jplayer" data-m4v="'.$hosted_m4v.'" data-ogv="'.$hosted_ogv.'" data-ogv="'.$hosted_webmv.'" data-id="'.$post->ID.'" data-image="'.$image.'" data-width="'.$width.'" data-height="'.$height.'"></div>
	      	<div class="jp-video-play">
	        	<a href="javascript:;" class="jp-video-play-icon" tabindex="1">play</a>
	        </div>
	      	<div class="jp-gui">
	        	<div class="jp-interface">
	          		<div class="jp-controls-holder">
			            <ul class="jp-controls">
			            	<li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>
			            	<li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
			            </ul>
	            		<div class="jp-progress">
	            			<div class="jp-seek-bar">
	              				<div class="jp-play-bar"></div>
	            			</div>
	          			</div>
			          	<div class="volume-holder">
			          		<a href="javascript:;" class="jp-mute" tabindex="1" title="mute"></a>
				            <div class="jp-volume-bar">
				            	<div class="jp-volume-bar-value"></div>
				            </div>
				    	</div>
			            <ul class="jp-toggles">
			            	<li><a href="javascript:;" class="jp-full-screen" tabindex="1" title="full screen">full screen</a></li>
			            	<li><a href="javascript:;" class="jp-restore-screen" tabindex="1" title="restore screen">restore screen</a></li>
			            </ul>
	       			</div>
	    		</div>
			</div>
		 	<div class="jp-no-solution">
		    	<span>Update Required</span>
		        To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
		 	</div>
		</div>
	</div>';
	return $html;
} ?>