var player, OKEvents, options;

(function ($) {
	"use strict";
	var BLANK_GIF = "data:image/gif;base64,R0lGODlhAQABAPABAP///wAAACH5BAEKAAAALAAAAAABAAEAAAICRAEAOw%3D%3D";
	$.okvideo = function (options) {
		if (typeof options !== 'object') options = { 'video' : options };
		var base = this;

		base.init = function () {
			base.options = $.extend({}, $.okvideo.options, options);

			if (base.options.video === null) base.options.video = base.options.source;

			base.setOptions();

			var target = base.options.target || $('.home_slider');
			var position = target[0] == $('.home_slider')[0] ? 'fixed' : 'absolute';

			target.css({position: 'relative'});

			var zIndex = base.options.controls === 3 ? -999 : "auto";
			var mask = '<div id="okplayer-mask" style="position:' + position + ';left:0;top:0;overflow:hidden;z-index:-998;height:100%;width:100%;"></div>';

			if (OKEvents.utils.isMobile()) {
				target.append('<div id="okplayer" style="position:' + position + ';left:0;top:0;overflow:hidden;height:100%;width:100%;"></div>');
			}
			else {
				if (base.options.controls === 3) {
					target.append(mask)
				}
				if (base.options.adproof === 1) {
					target.append('<div id="okplayer" style="position:relative;left:0px;top:0px;overflow:hidden;height:100%;width:100%;"></div>');
				} else {
					target.append('<div id="okplayer" style="position:relative;left:0;top:0;overflow:hidden;height:100%;width:100%;"></div>');
				}
			}

			$("#okplayer-mask").css("background-image", "url(" + BLANK_GIF + ")");
			if (base.options.playlist.list === null) {
				if (base.options.video.provider === 'youtube') {
					base.loadYouTubeAPI();
				} else if (base.options.video.provider === 'vimeo') {

					if (window.globalVideoAudio && window.globalVideoAudio=='play') {
						base.options.volume = 100;
					}else
					{
						base.options.volume = 0;
					}
					base.loadVimeoAPI();
				}
			}else{
				base.loadYouTubeAPI();
			}
		};

		base.setOptions = function () {
			for (var key in this.options){
				if (this.options[key] === true) this.options[key] = 1;
				if (this.options[key] === false) this.options[key] = 3;
			}
			if (base.options.playlist.list === null) {
				base.options.video = base.determineProvider();
			}
			$(window).data('okoptions', base.options);
		};
		base.loadYouTubeAPI = function (callback) {
			base.insertJS('//www.youtube.com/player_api');
		};
		base.loadYouTubePlaylist = function() {
			player.loadPlaylist(base.options.playlist.list, base.options.playlist.index, base.options.playlist.startSeconds, base.options.playlist.suggestedQuality);
		};
		base.loadVimeoAPI = function() {
			$('#okplayer').replaceWith(function() {
				return '<iframe src="//player.vimeo.com/video/' + base.options.video.id + '?api=1&title=0&byline=0&portrait=0&playbar=0&loop=' + base.options.loop + '&autoplay=' + (base.options.autoplay === 1 ? 1 : 0) + '&player_id=okplayer" frameborder="0" style="' + $(this).attr('style') + 'visibility:hidden;background-color:black;" id="' + $(this).attr('id') + '"></iframe>';
			});
			base.insertJS('//origin-assets.vimeo.com/js/froogaloop2.min.js', function(){
				vimeoPlayerReady();
			});
		};
		base.insertJS = function(src, callback){
			var tag = document.createElement('script');
			if (callback){
				if (tag.readyState){
					tag.onreadystatechange = function(){
						if (tag.readyState === "loaded" ||
						tag.readyState === "complete"){
							tag.onreadystatechange = null;
							callback();
						}
					};
				}else {
					tag.onload = function() {
					callback();
					};
				}
			}
			tag.src = src;
			var firstScriptTag = document.getElementsByTagName('script')[0];
			firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
		};

		base.determineProvider = function () {
			var a = document.createElement('a');
			a.href = base.options.video;
			if (/youtube.com/.test(base.options.video)){
				return { "provider" : "youtube", "id" : a.href.slice(a.href.indexOf('v=') + 2).toString() };
			}else if (/vimeo.com/.test(base.options.video)) {
				return { "provider" : "vimeo", "id" : a.href.split('/')[3].toString() };
			}else if (/[-A-Za-z0-9_]+/.test(base.options.video)) {
				var id = new String(base.options.video.match(/[-A-Za-z0-9_]+/));
				if (id.length == 11) {
					return { "provider" : "youtube", "id" : id.toString() };
				}else{
						for (var i = 0; i < base.options.video.length; i++) {
							if (typeof parseInt(base.options.video[i]) !== "number") {
								throw 'not vimeo but thought it was for a sec';
							}
						}
						  return { "provider" : "vimeo", "id" : base.options.video };
					}
		  }else {
				throw "OKVideo: Invalid video source";
			}
		};
		base.init();
	};

	$.okvideo.options = {
		source: null,
		video: null,
		playlist: {
			list: null,
			index: 0,
			startSeconds: 0,
			suggestedQuality: "default"
		},
		disableKeyControl: 0,
		captions: 0,
		loop: 1,
		hd: 1,
		volume: 1,
		adproof: false,
		unstarted: null,
		onFinished: null,
		onReady: null,
		onPlay: null,
		onPause: null,
		buffering: null,
		controls: false,
		autoplay: true,
		annotations: true,
		cued: null
	};

	$.fn.okvideo = function (options) {
		options.target = this;
		return this.each(function () {
			(new $.okvideo(options));
		});
	};

})(jQuery);

function vimeoPlayerReady() {
	options = jQuery(window).data('okoptions');

	var iframe = jQuery('#okplayer')[0];
	player = $f(iframe);

	window.setTimeout(function(){
		jQuery('#okplayer').css('visibility', 'visible');
	}, 2000);

	player.addEvent('ready', function () {
		OKEvents.v.onReady();

		if (OKEvents.utils.isMobile()) {
			OKEvents.v.onPlay();
		}else {
			player.addEvent('play', OKEvents.v.onPlay);
			player.addEvent('pause', OKEvents.v.onPause);
			player.addEvent('finish', OKEvents.v.onFinish);
		}
		player.api('play');
	});
}

function onYouTubePlayerAPIReady() {
	options = jQuery(window).data('okoptions');
	player = new YT.Player('okplayer', {
		videoId: options.video ? options.video.id : null,
		playerVars: {
			'autohide': 1,
			'autoplay': 0, 
			'disablekb': options.keyControls,
			'cc_load_policy': options.captions,
			'controls': options.controls,
			'enablejsapi': 1,
			'fs': 0,
			'modestbranding': 1,
			'origin': window.location.origin || (window.location.protocol + '//' + window.location.hostname),
			'iv_load_policy': options.annotations,
			'loop': options.loop,
			'showinfo': 0,
			'rel': 0,
			'wmode': 'opaque',
			'hd': options.hd
		},
		events: {
			'onReady': OKEvents.yt.ready,
			'onStateChange': OKEvents.yt.onStateChange,
			'onError': OKEvents.yt.error
		}
	});
}

OKEvents = {
	yt: {
		ready: function(event){
			event.target.setVolume(options.volume);
			if (options.autoplay === 1) {
				if (options.playlist.list) {
					player.loadPlaylist(options.playlist.list, options.playlist.index, options.playlist.startSeconds, options.playlist.suggestedQuality);
				}else {
					event.target.playVideo();
				}
			}
			OKEvents.utils.isFunction(options.onReady) && options.onReady();
		},
		onStateChange: function(event){
			switch(event.data){
				case -1:
					OKEvents.utils.isFunction(options.unstarted) && options.unstarted();
				break;
				case 0:
					OKEvents.utils.isFunction(options.onFinished) && options.onFinished();
					options.loop && event.target.playVideo();
				break;
				case 1:
					OKEvents.utils.isFunction(options.onPlay) && options.onPlay();
				break;
				case 2:
					OKEvents.utils.isFunction(options.onPause) && options.onPause();
				break;
				case 3:
					OKEvents.utils.isFunction(options.buffering) && options.buffering();
				break;
				case 5:
					OKEvents.utils.isFunction(options.cued) && options.cued();
				break;
				default:
				throw "OKVideo: received invalid data from YT player.";
			}
		},
		error: function(event){
		throw event;
		}
	},
	v: {
		onReady: function(){
			OKEvents.utils.isFunction(options.onReady) && options.onReady();
		},
		onPlay: function(){
			if (!OKEvents.utils.isMobile()) player.api('setVolume', options.volume);
			OKEvents.utils.isFunction(options.onPlay) && options.onPlay();
		},
		onPause: function(){
			OKEvents.utils.isFunction(options.onPause) && options.onPause();
		},
		onFinish: function(){
			OKEvents.utils.isFunction(options.onFinish) && options.onFinish();
		}
	},
	utils: {
		isFunction: function(func){
			if (typeof func === 'function'){
				return true;
			}else {
				return false;
			}
		},
		isMobile: function() {
			if (navigator.userAgent.match(/(iPhone|iPod|iPad|Android|BlackBerry)/)) {
				return true;
			}else {
				return false;
			}
		}
	}
};
