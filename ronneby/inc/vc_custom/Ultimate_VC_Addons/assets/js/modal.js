(function() {
	var triggerBttn = document.getElementsByClassName( 'overlay-show' ),
	overlay = document.querySelector( 'div.ult-overlay' ),
	closeBttn = overlay.querySelector( 'div.ult-overlay-close' );
	transEndEventNames = {
		'WebkitTransition': 'webkitTransitionEnd',
		'MozTransition': 'transitionend',
		'OTransition': 'oTransitionEnd',
		'msTransition': 'MSTransitionEnd',
		'transition': 'transitionend'
	},
	transEndEventName = transEndEventNames[ bsfmodernizr.prefixed( 'transition' ) ],
	support = { transitions : bsfmodernizr.csstransitions };
	function toggleOverlay(id) {
		var ovv = 'div.ult-overlay.'+id;
		joverlay = document.querySelector( ovv );
		overlay = jQuery(ovv);
		/* firefox transition issue fix of overflow hidden */
		var modal_height = overlay.find('.ult_modal').outerHeight(); //modal height
		var window_height = jQuery(window).outerHeight(); //window height
		if(window_height < modal_height) //if window height is less than modal height
			jQuery('html').css({'overflow':'hidden'}); //add overflow hidden to html
		if( overlay.hasClass('ult-open') ) {
			overlay.removeClass('ult-open');
			overlay.addClass('ult-close');
			//classie.remove( overlay, 'ult-open' );
			//classie.add( overlay, 'ult-close' );
			var onEndTransitionFn = function( ev ) {
				if( support.transitions ) {
					if( ev.propertyName !== 'visibility' ) return;
					this.removeEventListener( transEndEventName, onEndTransitionFn );
				}
				overlay.removeClass('ult-close');
				//classie.remove( overlay, 'ult-close' );
			};
			if( support.transitions ) {
				joverlay.addEventListener( transEndEventName, onEndTransitionFn );
				overlay.removeClass('ult-close');
				if(window_height < modal_height) //remove overflow hidden
					jQuery('html').css({'overflow':'auto'});
			}
			else {
				onEndTransitionFn();
			}
		}
		else if( ! overlay.hasClass('ult-close') ) {
			overlay.addClass('ult-open');
			//classie.add( overlay, 'ult-open' );
		}
	}
	var corner_to = jQuery('.overlay-show-cornershape').find('path').attr('d');
	function overlay_cornershape_f(id){
		var ovv = 'div.overlay-cornershape.'+id;
		var joverlay_cornershape = document.querySelector( ovv );
		var overlay_cornershape = jQuery(ovv);
		var s = Snap( joverlay_cornershape.querySelector( 'svg' ) ),
			path = s.select( 'path' ),
			pathConfig = {
				from : 'm 0,0 1439.999975,0 0,805.99999 0,-805.99999 z ',
				to : ' m 0,0 1439.999975,0 0,805.99999 -1439.999975,0 z  '
			};
		//var overlay_cornershape = document.querySelector( 'div.overlay-cornershape' );
		if( overlay_cornershape.hasClass('ult-open') ) {
			overlay_cornershape.removeClass('ult-open');
			overlay_cornershape.addClass('ult-close');
			//classie.remove( overlay_cornershape, 'ult-open' );
			//classie.add( overlay_cornershape, 'ult-close' );
			var onEndTransitionFn = function( ev ) {
				overlay_cornershape.removeClass('ult-close');
				//classie.remove( overlay_cornershape, 'ult-close' );
			};
			path.animate( { 'path' : pathConfig.from }, 400, mina.linear, onEndTransitionFn );
		}
		else if( ! overlay_cornershape.hasClass('ult-close') ) {
			overlay_cornershape.addClass('ult-open');
			//classie.add( overlay_cornershape, 'ult-open' );
			path.animate( { 'path' : pathConfig.to }, 400, mina.linear );
		}
	}
	function overlay_genie_f(id) {
		var ovv = 'div.overlay-genie.'+id;
		var joverlay_genie = document.querySelector( ovv );
		var overlay_genie = jQuery(ovv);
		var gs = Snap( joverlay_genie.querySelector( 'svg' ) ),
			geniepath = gs.select( 'path' ),
			steps = joverlay_genie.getAttribute( 'data-steps' ).split(';'),
			stepsTotal = steps.length;
		if( overlay_genie.hasClass('ult-open') ) {
			var pos = stepsTotal-1;
			overlay_genie.removeClass('ult-open');
			overlay_genie.addClass('ult-close');
			//classie.remove( joverlay_genie, 'ult-open' );
			//classie.add( joverlay_genie, 'ult-close' );
			var onEndTransitionFn = function( ev ) {
					overlay_genie.removeClass('ult-close');
				},
				nextStep = function( pos ) {
					pos--;
					if( pos < 0 ) return;
					geniepath.animate( { 'path' : steps[pos] }, 60, mina.linear, function() {
						if( pos === 0 ) {
							onEndTransitionFn();
						}
						nextStep(pos);
					} );
				};
			nextStep(pos);
		}
		else if( !overlay_genie.hasClass('ult-close') ) {
			var pos = 0;
			overlay_genie.addClass('ult-open');
			//classie.add( joverlay_genie, 'ult-open' );
			var nextStep = function( pos ) {
				pos++;
				if( pos > stepsTotal - 1 ) return;
				geniepath.animate( { 'path' : steps[pos] }, 60, mina.linear, function() { nextStep(pos); } );
			};
			nextStep(pos);
		}
	}
	function shuffle_overlay_box(array) {
		var currentIndex = array.length
		, temporaryValue
		, randomIndex
		;
		// While there remain elements to shuffle...
		while (0 !== currentIndex) {
			// Pick a remaining element...
			randomIndex = Math.floor(Math.random() * currentIndex);
			currentIndex -= 1;
			// And swap it with the current element.
			temporaryValue = array[currentIndex];
			array[currentIndex] = array[randomIndex];
			array[randomIndex] = temporaryValue;
		}
		return array;
	}
	function overlay_boxes_f(id) {
		var ovv = 'div.overlay-boxes.'+id;
		var joverlay_boxes = document.querySelector( ovv );
		var overlay_boxes = jQuery(ovv);
		var boxes_path = [].slice.call( joverlay_boxes.querySelectorAll( 'svg > path' ) ),
		pathsTotal = boxes_path.length;
		var cnt = 0;
		shuffle_overlay_box( boxes_path );
		if( overlay_boxes.hasClass('ult-open') ) {
			overlay_boxes.removeClass('ult-open');
			overlay_boxes.addClass('ult-close');
			//classie.remove( joverlay_boxes, 'ult-open' );
			//classie.add( joverlay_boxes, 'ult-close' );
			boxes_path.forEach( function( p, i ) {
				setTimeout( function() {
					++cnt;
					p.style.display = 'none';
					if( cnt === pathsTotal ) {
						overlay_boxes.removeClass('ult-close');
						//classie.remove( joverlay_boxes, 'ult-close' );
					}
				}, i * 30 );
			});
		}
		else if( !overlay_boxes.hasClass('ult-close') ) {
			overlay_boxes.addClass('ult-open');
			//classie.add( joverlay_boxes, 'ult-open' );
			boxes_path.forEach( function( p, i ) {
				setTimeout( function() {
					p.style.display = 'block';
				}, i * 30 );
			});
		}
	}
	jQuery(window).load(function(){
		var onload_modal_array = new Array();
		jQuery('.ult-onload').each(function(index){
			onload_modal_array.push(jQuery(this));
			setTimeout(function() {
				onload_modal_array[index].trigger('click');
			}, parseInt(jQuery(this).data('onload-delay'))*1000);
		});
		jQuery('.ult-vimeo iframe').each(function(index, element) {
			var player_id = jQuery(this).attr('id');
			var iframe = jQuery(this)[0],
				player = $f(iframe);
			player.addEvent('ready', function() {
				player.addEvent('pause');
				player.addEvent('finish');
			});
        });
	});
	jQuery(document).ready(function(){
		jQuery('.ult-overlay').each(function(){
			jQuery(this).appendTo(document.body);
		});
		jQuery('.ult-overlay').show();
		jQuery('.overlay-show').each(function(index, element) {
            var class_id = jQuery(this).data('class-id');
			jQuery('.'+class_id).find('.ult-vimeo iframe').attr('id','video_'+class_id);
			jQuery('.'+class_id).find('.ult-youtube iframe').attr('id','video_'+class_id);
        });
		var modal_count=0;
		jQuery('.overlay-show').click(function(event){
		event.stopPropagation();
			var class_id = jQuery(this).data('class-id');
			//jQuery('.'+class_id).find('.ult-vimeo iframe').attr('id','video_'+class_id);
			jQuery('.'+class_id).find('.ult-vimeo iframe').html(jQuery('.ult-vimeo iframe').html());
			jQuery('.'+class_id).addClass(jQuery(this).data('overlay-class'));
			setTimeout(function() {
				jQuery('body, html').addClass('ult_modal-body-open');
				toggleOverlay(class_id);
				if(jQuery('.'+class_id).hasClass('overlay-doorhorizontal')){
					setTimeout(function() {
						content_check(class_id);
					}, 500);
				}else{
					content_check(class_id);
				}
			}, 500);
		})
		jQuery('.overlay-show-cornershape').click(function(event){
			event.stopPropagation();
			var class_id = jQuery(this).data('class-id')
			//jQuery('.overlay-cornershape').removeClass('overlay-cornershape');
			jQuery('.'+class_id).addClass('overlay-cornershape');
			overlay_cornershape_f(class_id);
			jQuery('body, html').addClass('ult_modal-body-open');
			content_check(class_id);
		})
		jQuery('div.overlay-cornershape div.ult-overlay-close').click(function(event){
			event.stopPropagation();
			var class_id = jQuery(this).parents('div.overlay-cornershape').data('class');
			overlay_cornershape_f(class_id);
			jQuery('body, html').removeClass('ult_modal-body-open');
			jQuery('html').css({'overflow':'auto'});
		})
		jQuery('.overlay-show-boxes').click(function(event){
			event.stopPropagation();
			var class_id = jQuery(this).data('class-id')
			//jQuery('.overlay-boxes').removeClass('overlay-boxes');
			jQuery('.'+class_id).addClass('overlay-boxes');
			overlay_boxes_f(class_id);
			jQuery('body, html').addClass('ult_modal-body-open');
			content_check(class_id);
		});
		jQuery('div.overlay-boxes div.ult-overlay-close').click(function(event){
			event.stopPropagation();
			var class_id = jQuery(this).parents('div.overlay-boxes').data('class');
			overlay_boxes_f(class_id);
			jQuery('body, html').removeClass('ult_modal-body-open');
			jQuery('html').css({'overflow':'auto'});
		});
		jQuery('.overlay-show-genie').click(function(event){
			var class_id = jQuery(this).data('class-id')
			//jQuery('.overlay-genie').removeClass('overlay-genie');
			jQuery('.'+class_id).addClass('overlay-genie');
			overlay_genie_f(class_id);
			jQuery('body, html').addClass('ult_modal-body-open');
			content_check(class_id);
			jQuery('html').css({'overflow':'auto'});
		});
		jQuery('div.overlay-genie div.ult-overlay-close').click(function(event){
			event.stopPropagation();
			var class_id = jQuery(this).parents('div.overlay-genie').data('class');
			overlay_genie_f(class_id);
			jQuery('body, html').removeClass('ult_modal-body-open');
			jQuery('html').css({'overflow':'auto'});
		})
		jQuery('.ult-overlay .ult-overlay-close').click(function(event){
			event.stopPropagation();
			var id = jQuery(this).parents('.ult-overlay').data('class');
			toggleOverlay(id);
			jQuery('body, html').removeClass('ult_modal-body-open');
			if(jQuery(this).parent().find(".ult-vimeo").length){
				var player_id = jQuery(this).parent().find(".ult-vimeo iframe");
				var src = player_id.attr("src");
				jQuery(this).parent().find(".ult-vimeo iframe").attr("src",'');
				jQuery(this).parent().find(".ult-vimeo iframe").attr("src",src);
				var iframe = player_id[0],
				player = $f(iframe);
				player.api('pause');
			} else {
				var src = jQuery(this).parent().find(".ult-youtube iframe").attr("src");
				jQuery(this).parent().find(".ult-youtube iframe").attr("src",'');
				jQuery(this).parent().find(".ult-youtube iframe").attr("src",src);
			}
			jQuery('html').css({'overflow':'auto'});
		});
		jQuery('.ult-overlay .ult_modal').click(function(event){
			event.stopPropagation();
		})
		jQuery('.ult-overlay').click(function(event){
			event.stopPropagation();
			jQuery(this).find('.ult-overlay-close').trigger('click');
			jQuery('html').css({'overflow':'auto'});
		})
	})
	function content_check(id){
		var ch = jQuery('.'+id).find('.ult_modal-content').height();
		var wh = jQuery(window).height();
		if(ch>wh){
			jQuery('.'+id).addClass('ult_modal-auto-top');
		}
		else{
			jQuery('.'+id).removeClass('ult_modal-auto-top');
		}
	}
})();