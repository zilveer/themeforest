{if $el->option('type') == 'youtube'}
<script id="{$htmlId}-youtube-api" src="//www.youtube.com/iframe_api"></script>
{/if}

{if $el->option('type') == 'vimeo'}
<script id="{$htmlId}-vimeo-api" src="//f.vimeocdn.com/js/froogaloop2.min.js"></script>
{/if}

<script id="{$htmlId}-script">
jQuery(window).load(function(){
	jQuery('#{!$htmlId}').find('iframe, video').css({'width': '100%'});
	resizePlayer( {$el->option('type')} );

	{if $el->option('type') == 'youtube'}
		youtubePlayer();
	{elseif $el->option('type') == 'vimeo'}
		vimeoPlayer();
	{else}
		// media player
	{/if}

	if(isUserAgent('mobile')){ // all mobile browsers
		jQuery('#{!$htmlId}').find('video, iframe').hide();
	}

	{if $options->theme->general->progressivePageLoading}
		if(!isResponsive(1024)){
			jQuery("#{!$htmlId}").waypoint(function(){
				jQuery("#{!$htmlId}").addClass('load-finished');
			}, { triggerOnce: true, offset: "95%" });
		} else {
			jQuery("#{!$htmlId}").addClass('load-finished');
		}
	{else}
		jQuery("#{!$htmlId}").addClass('load-finished');
	{/if}
});

jQuery(window).resize(function(){
	resizePlayer( {$el->option('type')} );

	if(isUserAgent('mobile')){ // all mobile browsers
		jQuery('#{!$htmlId}').find('video, iframe').hide();
	} else {
		jQuery('#{!$htmlId}').find('video, iframe').show();
	}
});


function resizePlayer(player){
	//var overflowHeight = parseInt({$el->option('height')});
	var overflowHeight = jQuery("#{!$htmlId}").parent().height();
	if(player == 'youtube'){
		{var $ratio = explode(':', $el->option('youtubeVideoFormat'))}
		var ratio = [parseInt({$ratio[0]}), parseInt({$ratio[1]})];
	} else if (player == 'vimeo') {
		{var $ratio = explode(':', $el->option('vimeoVideoFormat'))}
		var ratio = [parseInt({$ratio[0]}), parseInt({$ratio[1]})];
	} else {
		{var $ratio = explode(':', $el->option('mediaVideoFormat'))}
		var ratio = [parseInt({$ratio[0]}), parseInt({$ratio[1]})];
	}

	var parsedHeight = parseInt( ( jQuery('#{!$htmlId}').width() / ratio[0] ) * ratio[1] );

	if(parsedHeight < overflowHeight){
		// compute new width and height becomes static
		var parsedWidth = parseInt((overflowHeight / 9) * 16);
		jQuery('#{!$htmlId}').find('iframe, video').css({'height':  overflowHeight+"px", 'width': parsedWidth+'px'});
		// here a check if the container hasnt grown up
	} else {
		// use computed height
		jQuery('#{!$htmlId}').find('iframe, video').css({'height': parsedHeight+"px", 'width': '100%'});
	}


}

function youtubePlayer(){
	var player = new YT.Player('{!$htmlId}-youtube-player', {
		events: {
			'onReady': function(){
				if(parseInt(jQuery('#{!$htmlId}-youtube-player').attr('data-sound')) == 0){
					player.mute();
				}				
				player.playVideo();
			}
		}
	});
}

function vimeoPlayer(){
	var iframe = jQuery('#{!$htmlId}-vimeo-player')[0];
	var player = $f(iframe);
	/*player.addEvent('ready', function() {
		player.api('setVolume', 0);
	});*/
	if(parseInt(jQuery('#{!$htmlId}-vimeo-player').attr('data-sound')) == 0){
		player.api('setVolume', 0);
	}	
}
</script>
