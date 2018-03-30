/*-----------------------------------------------------------------------------------*/
/*  Vimeo Player Controls
/*-----------------------------------------------------------------------------------*/

/* Stretch the video fullscreen */
jQuery(document).ready(function(){
	jQuery('#vimeoplayer').css("width", "100%");
	jQuery('#vimeoplayer').css("height", "100%");
		
		jQuery('#play-video').bind('click', function() {
				 
				if(jQuery(this).hasClass('play')) {
					 playVimeoVideo();
					 jQuery(this).removeClass('play'); // Change play button
				} else {
					pauseVimeoVideo();
					jQuery(this).addClass('play'); // Change play button
				}
				
		});
		});
		
		function playVimeoVideo()
		{
			//alert("Play " + document.getElementById("vimeoplayer"));
			var vimeoAPI = document.getElementById("vimeoplayer");
			vimeoAPI.api_play();
			
			addEvents();
		}
		
		function pauseVimeoVideo()
		{
			//alert("Pause " + document.getElementById("vimeoplayer"));
			var vimeoAPI = document.getElementById("vimeoplayer");
			vimeoAPI.api_pause();
		}
		
		function seekToVimeoVideo(value)
		{
			//alert("Play " + document.getElementById("vimeoplayer"));
			var vimeoAPI = document.getElementById("vimeoplayer");
			vimeoAPI.api_seekTo(value);
		}
		
		function stopVimeoVideo()
		{
			//alert("Play " + document.getElementById("vimeoplayer"));
			var vimeoAPI = document.getElementById("vimeoplayer");
			vimeoAPI.api_seekTo(0);
			vimeoAPI.api_pause();
		}
		
		function unloadVimeoVideo()
		{
			//alert("Play " + document.getElementById("vimeoplayer"));
			var vimeoAPI = document.getElementById("vimeoplayer");
			vimeoAPI.api_unload();
		}
		
		
		/////////////////////////////////////////////////////////////////////////////////
		///////////////////////////// Eventhandling /////////////////////////////////////
		
		function handleCompletEmbedd(e)
		{
			myFlashObject = e.ref;
			vimeoplayertext = e.id;
		}
		
		function addEvents()
		{
			//alert("addEvents");
			var vimeoAPI = document.getElementById("vimeoplayer");
			
			vimeoAPI.api_addEventListener("onProgress","handleVimeoProgess");
			vimeoAPI.api_addEventListener("onLoading","handleVimeoVideoLoading");
			vimeoAPI.api_addEventListener("onFinish","handleVimeoVideoFinished");
			
		}
		
		function handleVimeoProgess(data)
		{
			var vimeoAPI = document.getElementById("vimeoplayer");
			var tim = vimeoAPI.api_getCurrentTime();
			document.getElementById("currentTime").innerHTML = tim;
			document.getElementById("duration").innerHTML = vimeoAPI.api_getDuration();
			//alert('vimeo Progress')
		}
		
		function handleVimeoVideoLoading(data)
		{
			document.getElementById("loadedBytes").innerHTML = data.bytesLoaded;
			document.getElementById("totalBytes").innerHTML = data.bytesTotal;
			document.getElementById("percentageLoaded").innerHTML = data.percent + '%';
			// Additional Parameter: data.decimal;
		}