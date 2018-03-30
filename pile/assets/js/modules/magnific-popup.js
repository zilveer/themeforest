/* --- Magnific Popup Initialization --- */

function magnificPopupInit() {
	if (globalDebug) {
		console.log("Magnific Popup - Init");
	}

	$('.js-post-gallery').each(function () { // the containers for all your galleries should have the class gallery
		$(this).magnificPopup({
			delegate: 'a[href$=".jpg"], a[href$=".jpeg"], a[href$=".png"], a[href$=".gif"]', // the container for each your gallery items
			type: 'image',
			closeOnContentClick: false,
			closeBtnInside: false,
			removalDelay: 500,
			mainClass: 'mfp-fade',
			image: {
				markup: '<div class="mfp-figure">' +
				'<div class="mfp-img"></div>' +
				'<div class="mfp-bottom-bar">' +
				'<div class="mfp-title"></div>' +
				'<div class="mfp-counter"></div>' +
				'</div>' +
				'</div>',
				titleSrc: function (item) {
					var output = '';
					if (typeof item.el.attr('data-alt') !== "undefined" && item.el.attr('data-alt') !== "") {
						output += '<small>' + item.el.attr('data-alt') + '</small>';
					}
					return output;
				}
			},
			gallery: {
				enabled: true,
				navigateByImgClick: true
				//arrowMarkup: '<a href="#" class="gallery-arrow gallery-arrow--%dir% control-item arrow-button arrow-button--%dir%">%dir%</a>'
			},
			callbacks: {
				elementParse: function (item) {

					if (this.currItem != undefined) {
						item = this.currItem;
					}

					var output = '';
					if (typeof item.el.attr('data-alt') !== "undefined" && item.el.attr('data-alt') !== "") {
						output += '<small>' + item.el.attr('data-alt') + '</small>';
					}

					$('.mfp-title').html(output);
				},
				change: function (item) {
					var output = '';
					if (typeof item.el.attr('data-alt') !== "undefined" && item.el.attr('data-alt') !== "") {
						output += '<small>' + item.el.attr('data-alt') + '</small>';
					}

					$('.mfp-title').html(output);
				}
			}
		});
	});

	$('.js-gallery').each(function() { // the containers for all your galleries should have the class gallery
		$(this).magnificPopup({
			delegate: '.mfp-image, .mfp-video', // the container for each your gallery items
			mainClass: 'mfp-fade',
			closeOnBgClick: true,
			closeBtnInside: false,
			image: {
				markup:
				'<div class="mfp-figure">' +
					'<div class="mfp-img"></div>' +
					'<div class="mfp-bottom-bar">' +
						'<div class="mfp-title"></div>' +
						'<div class="mfp-counter"></div>' +
					'</div>' +
				'</div>'
			},
			iframe: {
				markup:
				'<div class="mfp-figure">'+
					'<div class="mfp-iframe-scaler">'+
						'<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>'+
					'</div>'+
					'<div class="mfp-bottom-bar">' +
						'<div class="mfp-title mfp-title--video"></div>' +
						'<div class="mfp-counter"></div>' +
					'</div>' +
				'</div>',
				patterns: {
					youtube: {
						index: 'youtube.com/', // String that detects type of video (in this case YouTube). Simply via url.indexOf(index).
						id: function(url){
							var video_id = url.split('v=')[1];
							var ampersandPosition = video_id.indexOf('&');
							if(ampersandPosition != -1) {
								video_id = video_id.substring(0, ampersandPosition);
							}

							return video_id;
						}, // String that splits URL in a two parts, second part should be %id%
						// Or null - full URL will be returned
						// Or a function that should return %id%, for example:
						// id: function(url) { return 'parsed id'; }
						src: '//www.youtube.com/embed/%id%' // URL that will be set as a source for iframe.
					},
					youtu_be: {
						index: 'youtu.be/', // String that detects type of video (in this case YouTube). Simply via url.indexOf(index).
						id: '.be/', // String that splits URL in a two parts, second part should be %id%
						// Or null - full URL will be returned
						// Or a function that should return %id%, for example:
						// id: function(url) { return 'parsed id'; }
						src: '//www.youtube.com/embed/%id%' // URL that will be set as a source for iframe.
					},

					vimeo: {
						index: 'vimeo.com/',
						id: '/',
						src: '//player.vimeo.com/video/%id%'
					},
					gmaps: {
						index: '//maps.google.',
						src: '%id%&output=embed'
					}
					// you may add here more sources
				},
				srcAction: 'iframe_src' // Templating object key. First part defines CSS selector, second attribute. "iframe_src" means: find "iframe" and set attribute "src".
			},
			gallery:{
				enabled:true,
				navigateByImgClick: true
			},
			callbacks:{
				change: function(item){
					$(this.content).find('iframe').each(function(){
						var url = $(this).attr("src");
						$(this).attr("src", setQueryParameter(url, "wmode", "transparent"));
					});
				},
				elementParse: function(item) {
					if (globalDebug) {console.log("Magnific Popup - Parse Element");}

					$(item).find('iframe').each(function(){
						var url = $(this).attr("src");
						$(this).attr("src", url+"?wmode=transparent");
					});
				},
				markupParse: function(template, values, item) {
					values.title = '<span class="title">' + item.el.attr('data-title') + '</span>' + '<span class="description">' + item.el.attr('data-caption') + '</span>';
				}
			}
		});
	});

}
