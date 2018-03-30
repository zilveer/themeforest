/*
Easy video background jQuery plugin
 */
(function(){

	// Check for jquery
	if(jQuery == undefined){
		console.log("Jquery not included!");
		return;
	}

	var $ = jQuery;

	//IS IE
	function isIE_fun () {
		var myNav = navigator.userAgent.toLowerCase();
		return (myNav.indexOf('msie') != -1) ? parseInt(myNav.split('msie')[1]) : false;
	}
	var isIE = isIE_fun();

	var players = 0;
	var youtube_api_state = 0;
	var vimeo_api_state = 0;

	//Jquery extend ensure load for images (caching issue)
	jQuery.fn.extend({
	    ensureLoad: function(handler) {
	        return this.each(function() {
	            if(this.complete || this.readyState === 4) {
	                handler.call(this);
	            }
	            // Check if data URI images is supported, fire 'error' event if not
	            else if ( this.readyState === 'uninitialized' && this.src.indexOf('data:') === 0 ) {
	                $(this).trigger('error');
	                handler.call(this);
	            }
	            else {
	                $(this).one("load", handler);

	                if(isIE && this.src != undefined && this.src.indexOf("?") == -1){
	                    this.src = this.src+ "?" + new Date().getTime();
                	}

	            }
	        });
	    }
	});


	// Video Background call
	video_background = function($holder, in_parameters){
		this.hidden = false;
		this.$holder = $holder;

		this.isVimeoPlaying = true;
		this.isVimeoMute = 1;

		this.id = "video_background_video_"+players;
		players++;

		// Parameters
		this.parameters = {
			"position": "absolute",
			"z-index": "-1",
			"video_ratio": false,
			"loop": true,
			"autoplay": true,
			"muted": false,
			"mp4": false,
			"webm": false,
			"ogg": false,
			"youtube": false,
			"vimeo": false,
			"controls": 1,
			"controls_position": "bottom-right",
			"priority": "html5",
			"fallback_image": false,
			"sizing": "fill", // fill || adjust
			"start": 0,
			"video_overlay": 0,
			"mobile_play": 'no',
			"tranitionIn": true
		};

		//Override parameters from user options
		$.each(in_parameters, $.proxy(function(index, obj){
			this.parameters[index] = obj;
		}, this));


		//video holder
		this.$video_holder = $('<div id="'+this.id+'" class="kl-video-holder"></div>').appendTo($holder).css({
			"z-index": this.parameters["z-index"],
			"position": this.parameters.position,
			"top":0, "left": 0, "right": 0, "bottom": 0,
			"overflow": "hidden"
		});

  		// Transition In
        if (this.parameters.tranitionIn) {
            this.$video_holder.addClass('video-transition-in');
        }

		if(this.parameters.video_overlay != 0){
			this.$video_holder.addClass('video-grid-overlay video-grid-overlay-' + this.parameters.video_overlay );
		}

		this.ismobile=navigator.userAgent.match(/(iPad)|(iPhone)|(iPod)|(android)|(webOS)/i);

		this.decision = "image";

		//Decide what to use
		if(!this.ismobile){
			this.decision = this.parameters.priority;

			if(this.parameters.youtube !== false){
				this.decision = "youtube";
			}
			else if(this.parameters.vimeo !== false){
				this.decision = "vimeo";
			}
			else {
				this.decision = "html5";
			}
		}

		//Image Fallback
		if(this.decision == "image"){
			this.make_image();
		}

		//Youtube
		else if(this.decision == "youtube"){
			this.make_youtube();
		}

		//Vimeo
		else if(this.decision == "vimeo"){
			this.make_vimeo();
		}

		//Video
		else{
			//Html5 video
			this.make_video();
		}


		return this;
	};

	video_background.prototype = {

		// Make html5 video
		make_video: function(){
			var parameters = (this.parameters.autoplay ? "autoplay " : "") + (this.parameters.loop ? 'loop onended="this.play()" ' : "");

			var str = '<video width="100%" height="100%" '+parameters+'>';

			//mp4
			if(this.parameters.mp4 !== false){
				str += '<source src="'+this.parameters.mp4+'" type="video/mp4"></source>';
			}

			//webm
			if(this.parameters.webm !== false){
				str += '<source src="'+this.parameters.webm+'" type="video/webm"></source>';
			}

			//mp4
			if(this.parameters.ogg !== false){
				str += '<source src="'+this.parameters.ogg+'" type="video/ogg"></source>';
			}
			str += "</video>";

			//html5 video tag
			this.$video = $(str).addClass('cover-fit-img').css({
				"position": "absolute"
			});

			this.$video_holder.append(this.$video);

			this.video = this.$video.get(0);

			// Fill resize if objectfit not supported
			if (typeof Modernizr == 'object' && ! Modernizr.objectfit) {
				//Fill resize
				if(this.parameters.video_ratio !== false){
					this.resize_timeout = false;

					//On window resize
					$(window).resize( $.proxy(function(){
						clearTimeout(this.resize_timeout);
						this.resize_timeout = setTimeout($.proxy(this.video_resize, this) , 10);
					}, this) ) ;

					this.video_resize();
				}
			}
			else {
				this.$video.css({ "width":"100%", "height": "100%"});
			}

			this.$video_holder.addClass('video-is-loaded');

			if(this.parameters.muted){
				this.mute();
			}

			if(this.parameters.controls){
				this.make_controls();
			}
		},

		video_resize: function(self){

			this.$video = typeof self !== 'undefined' && self === true ? this.$video.children('iframe') : this.$video;

			var w = this.$video_holder.width();
			var h = this.$video_holder.height();

			var new_width = w;
			var new_height = w / this.parameters.video_ratio;

			if( new_height < h ){
				new_height = h;
				new_width = h * this.parameters.video_ratio;
			}

			//Round
			new_height = Math.ceil(new_height);
			new_width = Math.ceil(new_width);

			//adjust
			var top = Math.round( h/2 - new_height/2 );
			var left = Math.round( w/2 - new_width/2 );

			this.$video.attr("width", new_width);
			this.$video.attr("height", new_height);

			this.$video.css({
				"position": "absolute",
				"top": top+"px",
				"left": left+"px"
			});
		},



		//Make youtube
		make_youtube: function(){
			var $html = $("html");
			this.$video = $('<div id="'+this.id+'_yt"></div>').appendTo(this.$video_holder).css({
				"position": "absolute"
			});

      		this.youtube_ready = false;

      		if(youtube_api_state == 0){
      			//Load it
      			var tag = document.createElement('script');

				tag.src = "https://www.youtube.com/iframe_api";
				var firstScriptTag = document.getElementsByTagName('script')[0];
				firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

      			youtube_api_state = 1;

      			window.onYouTubeIframeAPIReady = $.proxy(function() {
      				$html.trigger("yt_loaded");
					this.build_youtube();

					youtube_api_state = 2;
				}, this);
      		}
      		else if(youtube_api_state == 1){
      			$html.bind("yt_loaded", $.proxy(this.build_youtube, this));
      		}
      		else if(youtube_api_state == 2){
      			this.build_youtube();
      		}

		},

		build_youtube: function(){
			var pars = { 'loop': this.parameters.loop ? 1 : 0, 'start': this.parameters.start, 'autoplay': this.parameters.autoplay ? 1 : 0, 'controls': 0, 'showinfo': 0, 'wmode': 'transparent', 'iv_load_policy': 3, 'modestbranding':1, 'rel':0};

			if(this.parameters.loop){
				pars['playlist'] = this.parameters.youtube;
			}

			this.player = new YT.Player(this.id+"_yt", {
				height: '100%',
				width: '100%',
				playerVars: pars,
				videoId: this.parameters.youtube,
				events: {
					'onReady': $.proxy(this.youtube_ready_fun, this)
				}
			});
		},

      	youtube_ready_fun: function(event) {
      		this.youtube_ready = true;

      		this.$video = $("#"+this.id+"_yt");

      		this.$video_holder.addClass('video-is-loaded');

			//Fill resize
			if(this.parameters.video_ratio !== false){
				this.resize_timeout = false;

				//On window resize
				$(window).resize( $.proxy(function(){
					clearTimeout(this.resize_timeout);
					this.resize_timeout = setTimeout($.proxy(this.video_resize, this) , 10);
				}, this) ) ;

				this.video_resize();
			}

			if(this.parameters.muted){
				this.mute();
			}

			if(this.parameters.controls){
				this.make_controls();
			}
      	},


      	//Make vimeo
		make_vimeo: function(){
			var $html = $("html");
			this.$video = $('<div id="'+this.id+'_vm"></div>').appendTo(this.$video_holder).css({
				"position": "absolute", "top":0, "left": 0, "right": 0, "bottom": 0,
			});

      		this.vimeo_ready = false;

      		if(vimeo_api_state === 0){

      			$.getScript( "//player.vimeo.com/api/player.js", $.proxy(function () {
						this.build_vimeo();
						vimeo_api_state = 1;
					}, this)
      			);
      		}
      		else if(vimeo_api_state == 1){
      			this.build_vimeo();
      		}
		},

		build_vimeo: function(){
			var pars = {
				'id': this.parameters.vimeo,
				'loop': this.parameters.loop ? 1 : 0,
				'autoplay': this.parameters.autoplay ? 1 : 0,
			};

			this.player = new Vimeo.Player(this.id+"_vm", pars);

			var self = this;

			this.player.on('loaded', function () {
				self.vimeo_ready_fun();
			});

			this.player.on('play', function () {
				self.isVimeoPlaying = true;
			});

			this.player.on('pause', function () {
				self.isVimeoPlaying = false;
			});

			this.player.getPaused().then(function(paused) {
			    self.isVimeoPlaying = !paused;
			});

			this.player.on('volumechange', function (e) {
				self.isVimeoMute = e.volume === 0 ? true : false;
			});

		},

      	vimeo_ready_fun: function(event) {

      		var self = this;

      		this.vimeo_ready = true;

      		this.$video = $("#"+this.id+"_vm");

      		this.$video_holder.addClass('video-is-loaded');

			//Fill resize
			if(this.parameters.video_ratio !== false){
				this.resize_timeout = false;

				//On window resize
				$(window).resize( $.proxy(function(){
					clearTimeout(this.resize_timeout);
					this.resize_timeout = setTimeout($.proxy(this.video_resize, this) , 10);
				}, this) ) ;

				this.video_resize(true);
			}

			if(this.parameters.start){
				this.player.setCurrentTime(this.parameters.start);
			}

			if(this.parameters.muted){
				this.isVimeoMute = true;
				this.mute();
			}

			if(this.parameters.controls){
				this.make_controls();
			}

      	},

      	make_controls: function(){

      		var self = this,
      			$controls;

			$controls = '<ul class="kl-video--controls" data-position="'+ this.parameters.controls_position +'">';
			$controls += '<li><a href="#" class="btn-toggleplay kl-video--controls-toggleplay">';
			$controls += '<i class="kl-icon glyphicon glyphicon-play circled-icon '+ (!this.isPlaying() ? 'paused' : '') +'"></i>';
			$controls += '</a></li>';
			$controls += '<li><a href="#" class="btn-audio kl-video--controls-togglemute">';
			$controls += '<i class="kl-icon glyphicon glyphicon-volume-up circled-icon ci-xsmall ' + (this.parameters.muted ? 'mute' : '') + '"></i>';
			$controls += '</a></li>';
			$controls += '</ul>';

			$($controls).appendTo( this.$video_holder );

			// Toggle Play
			this.$video_holder.find('.btn-toggleplay').on('click',function(e){
				e.preventDefault();
				self.toggle_play();
				$(this).children('i').toggleClass('paused');
			});

			//Toggle mute
			this.$video_holder.find('.btn-audio').on('click',function(e){
				e.preventDefault();
				self.toggle_mute();
				$(this).children('i').toggleClass('mute');
			});

		},


		// Make image
		make_image: function(){
			console.log(this.parameters.fallback_image);
			if(this.parameters.fallback_image === false || this.parameters.fallback_image == ''){
				return;
			}

			//Make image
			this.$img = $('<img src="'+this.parameters.fallback_image+'" class="cover-fit-img" alt=""/>').appendTo(this.$video_holder).css({
				"position":"absolute"
			});

			if (typeof Modernizr == 'object' && ! Modernizr.objectfit) {
				// On Image load fallback
				this.$img.ensureLoad( $.proxy(this.image_loaded, this) );
			}
			else {
				this.$img.css({ "width":"100%", "height": "100%"});
			}

		},

		image_loaded: function(){
			this.original_width = this.$img.width();
			this.original_height = this.$img.height();

			this.resize_timeout = false;

			//On window resize
			$(window).resize( $.proxy(function(){
				clearTimeout(this.resize_timeout);
				this.resize_timeout = setTimeout($.proxy(this.image_resize, this) , 10);
			}, this) ) ;

			this.image_resize();
		},

		image_resize: function(){
			var w = this.$video_holder.width();
			var h = this.$video_holder.height();

			var new_width = w;
			var new_height = this.original_height / ( this.original_width / w );

			if( (this.parameters.sizing == "adjust" && new_height > h) || (this.parameters.sizing == "fill" && new_height < h) ){
				new_height = h;
				new_width = this.original_width / ( this.original_height / h );
			}

			//Round
			new_height = Math.ceil(new_height);
			new_width = Math.ceil(new_width);

			//adjust
			var top = Math.round( h/2 - new_height/2 );
			var left = Math.round( w/2 - new_width/2 );

			this.$img.css({
				"width": new_width+"px",
				"height": new_height+"px",
				"top": top+"px",
				"left": left+"px"
			});
		},

		// User Callable Functions
		funcIsVimeoPlaying: function( value ){
			this.isVimeoPlaying = value;
		},

		isPlaying: function(){

			if(this.decision == "html5")
				return !this.video.paused;
			else if(this.decision =="youtube" && this.youtube_ready)
				return this.player.getPlayerState() === 1;
			else if(this.decision =="vimeo" && this.vimeo_ready) {
				var self = this;
				this.player.getPaused().then(function(paused) {
				    self.funcIsVimeoPlaying(!paused);
				});
				return this.isVimeoPlaying;
			}

			return false;
		},

		// Play
		play: function(){
			if(this.decision == "html5")
				this.video.play();
			else if(this.decision =="youtube" && this.youtube_ready)
				this.player.playVideo();
			else if(this.decision =="vimeo" && this.vimeo_ready)
				this.player.play();
		},

		// Pause
		pause: function(){
			if(this.decision == "html5")
				this.video.pause();
			else if(this.decision =="youtube" && this.youtube_ready)
				this.player.pauseVideo();
			else if(this.decision =="vimeo" && this.vimeo_ready)
				this.player.pause();
		},

		// Toogle play
		toggle_play: function(){
			if(this.isPlaying()){
				this.pause();
			}
			else
				this.play();
		},

		funcIsVimeoMute: function( value ){
			this.isVimeoMute = value;
		},

		// Is mute
		isMuted: function(){

			if(this.decision == "html5")
				return !(this.video.volume);
			else if(this.decision =="youtube" && this.youtube_ready)
				return this.player.isMuted();
			else if(this.decision =="vimeo" && this.vimeo_ready) {
				var self = this;
				this.player.getVolume().then(function(volume) {
				    self.funcIsVimeoMute( volume === 0 ? true : false );
				});
				return this.isVimeoMute;
			}

			return false;
		},

		// Mute
		mute: function(){
			if(this.decision == "html5")
				this.video.volume = 0;
			else if(this.decision =="youtube" && this.youtube_ready)
				this.player.mute();
			else if(this.decision =="vimeo" && this.vimeo_ready){
				this.player.setVolume(0);
			}
		},

		//Unmute
		unmute: function(){
			if(this.decision == "html5")
				this.video.volume = 1;
			else if(this.decision =="youtube" && this.youtube_ready)
				this.player.unMute();
			else if(this.decision =="vimeo" && this.vimeo_ready)
				this.player.setVolume(1);
		},

		//Toogle mute
		toggle_mute: function(){
			if(this.isMuted())
				this.unmute();
			else
				this.mute();
		},

		//Hide
		hide: function(){
			//Pause
			this.pause();

			this.$video_holder.stop().fadeTo(700, 0);
			this.hidden = true;
		},

		//Show
		show: function(){
			this.play();

			this.$video_holder.stop().fadeTo(700, 1);
			this.hidden = false;
		},

		//Toogle Hidden
		toogle_hidden: function(){
			if(this.hidden)
				this.show();
			else
				this.hide();
		},

		//Rewind
		rewind: function(){
			if(this.decision == "html5")
				this.video.currentTime = 0;
			else if(this.decision =="youtube" && this.youtube_ready)
				this.player.seekTo(0);
			else if(this.decision =="vimeo" && this.vimeo_ready)
				this.player.setCurrentTime(0);
		}
	};


})(undefined);