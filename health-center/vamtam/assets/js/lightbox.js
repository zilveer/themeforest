(function($, undefined) {
	"use strict";

	$(function() {
		$('.wpv-overlay-search-trigger').click(function(e) {
			e.preventDefault();

			$.magnificPopup.open({
				type: 'inline',
				items: {
					src: '#wpv-overlay-search',
				},
				closeOnBgClick: false,
				tClose: window.WPV_FRONT.magnific_close,
				tLoading: window.WPV_FRONT.magnific_loading,
				callbacks: {
					open: function() {
						var self = this;

						setTimeout( function() {
							self.content.find( 'form' ).removeAttr( 'novalidate' );
							self.content.find( '[name="s"]' ).focus();
						}, 100 );
					}
				}
			});
		});

		var lightboxTitle = function(item) {
			var share = '';

			if ($('body').hasClass('cbox-share-googleplus')) {
				share += '<div><div class="g-plusone" data-size="medium"></div> <script type="text/javascript">' +
					'(function() {' +
					'	var po = document.createElement("script"); po.type = "text/javascript"; po.async = true;' +
					'	po.src = "https://apis.google.com/js/plusone.js";' +
					'	var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(po, s);' +
					'})();' +
					'</script></div>';
			}

			if ($('body').hasClass('cbox-share-facebook')) {
				share += '<div><iframe src="//www.facebook.com/plugins/like.php?href=' + window.location.href + '&amp;send=false&amp;layout=button_count&amp;width=450&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:auto; height:21px;" allowTransparency="true"></iframe></div>';
			}

			if ($('body').hasClass('cbox-share-twitter')) {
				share += '<div><iframe allowtransparency="true" frameborder="0" scrolling="no" src="//platform.twitter.com/widgets/tweet_button.html" style="width:auto; height:20px;"></iframe></div>';
			}

			if ($('body').hasClass('cbox-share-pinterest')) {
				share += '<div><a href="http://pinterest.com/pin/create/button/" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a></div>';
			}

			var title = (item.el && item.el.attr('title')) || '';

			return '<div id="lightbox-share">' + share + '</div><div id="lightbox-text-title">' + title + '</div>';
		};

		var lightboxGetType = function(el) {
			if (el.attr('data-iframe') === 'true')
				return 'iframe';
			if (el.attr('href').match(/^#/))
				return 'inline';

			return 'image';
		};

		// lightbox
		$.rawContentHandler(function() {
			var wc_lightbox = $('body').hasClass('woocommerce-page') ? ', div.product div.images a.zoom' : '';

			$(".vamtam-lightbox"+wc_lightbox, this)
				.not('.no-lightbox, .size-thumbnail, .cboxElement')
				.each(function() {

				var link = this;
				var $link = $(this);

				var galleryItems = $('[rel="'+$link.attr('rel')+'"]').filter('.vamtam-lightbox, a.zoom'),
					hasGallery = galleryItems.length;

				var items = [];

				var this_item = $.inArray( $link, galleryItems );

				if ( hasGallery ) {
					$( galleryItems ).each( function( i ) {
						if ( this === link ) {
							this_item = i;
						}

						items.push({
							src: $(this).attr('href'),
							type: lightboxGetType($(this))
						});
					} );
				} else {
					items.push({
						src: $link.attr('href'),
						type: lightboxGetType( $link )
					});

					this_item = 0;
				}

				console.log(items);

				$link.magnificPopup({
					items: items,
					midClick: true,
					preload: [1, 2],
					index: this_item,
					tClose: window.WPV_FRONT.magnific_close,
					tLoading: window.WPV_FRONT.magnific_loading,
					iframe: {
						patterns: {
							youtube: {
								id: function(url) {
									var matches = url.match(/youtu(?:\.be|be\.com)\/(?:.*v(?:\/|=)|(?:.*\/)?)([a-zA-Z0-9-_]+)/);
									if (matches[1]) return matches[1];

									return url;
								}
							},

							vimeo: {
								id: function(url) {
									var matches = url.match(/vimeo\.com\/(?:.*#|.*videos?\/)?([0-9]+)/);
									if (matches[1]) return matches[1];

									return url;
								}
							},

							dailymotion: {
								index: 'dailymotion.com',
								id: function(url) {
									var m = url.match(/^.+dailymotion.com\/(video|hub)\/([^_]+)[^#]*(#video=([^_&]+))?/);

									if (m !== null) {
										if (m[4] !== undefined)
											return m[4];
										return m[2];
									}
									return null;
								}
							}
						}
					},
					image: {
						titleSrc: lightboxTitle
					},
					gallery: {
						enabled: hasGallery
					},
					callbacks: {
						open: function() {
							$(window).resize();
						}
					}
				});
			});
		});
	});
})(jQuery);