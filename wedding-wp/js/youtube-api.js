	// This code loads the IFrame Player API code asynchronously.
	var tag = document.createElement("script");
	tag.src = "https://www.youtube.com/iframe_api";
	var firstScriptTag = document.getElementsByTagName("script")[0];
	firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

	var pure_yt_iframes = document.querySelectorAll('.yt-player');
	var yt_iframes = new Array();
	for( var i = 0; i < pure_yt_iframes.length; i++ ) {
		yt_iframes[i] = pure_yt_iframes[i].id;
	}
	// This function creates an <iframe> (and YouTube player) after the API code downloads.
	function onYouTubeIframeAPIReady() {	
		for( var j=0; j<yt_iframes.length; j++ ) {
			new YT.Player(pure_yt_iframes[j], {
				videoId: yt_iframes[j],
				playerVars: {
					autoplay: 1,
					controls: 0,
					modestbranding: 1,
					showinfo: 0,
					rel: 0,
			    },
				events: {
					"onReady": onPlayerReady,
					"onStateChange": onPlayerStateChange
				}
			});
		}
	}

	// Call this function when the video player is ready.
	function onPlayerReady(event) {
		// event.target.playVideo();
		event.target.mute();
	}

	// Call this function when the player\'s state changes. The function indicates that
	// when playing a video ended, the player should play again (loop).
	function onPlayerStateChange(event) {
		if (event.data == YT.PlayerState.ENDED) {
			event.target.playVideo();
		}
	}