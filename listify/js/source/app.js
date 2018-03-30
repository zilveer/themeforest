(function($) {
	'use strict';

	var listify = {
		cache: {
			$document: $(document),
			$window: $(window),
			firefox: navigator.userAgent.toLowerCase().indexOf( 'firefox' ) > -1
		},

		init: function() {
			this.bindEvents();
		},

		bindEvents: function() {
			var self = this;

			this.cache.$document.on( 'ready', function() {
				self.initMenu();
				self.initPopups();
				self.initVideos();
				self.initTables();

				self.initSelects();

				self.cache.$document.on( 'facetwp-loaded facetwp-refresh update_results', function() {
					self.initSelects();
				});
			});
		},

		initMenu: function() {
			$( '.navigation-bar-toggle, .js-toggle-area-trigger' ).click(function(e) {
				e.preventDefault();

				$(this)
					.toggleClass( 'active' )
					.next()
					.toggleClass( 'active' );
			});

			$( '.current-account-avatar' ).click(function(e) {
				e.preventDefault();

				var url = $(this).data( 'href' );

				window.location = url;
			});
		},

		initPopups: function() {
			var self = this;

			self.cache.$document.on( 'click', '.popup-trigger-ajax', function(e) {
				e.preventDefault();

				var class = $(this).attr( 'class' );

				class = class.replace( 'popup-trigger-ajax', '' );
				class = class.replace( 'button', '' );

				self.triggerPopup({
					items: {
						src: $(this).attr( 'href' ),
						type: 'ajax'
					},
					tClose: listifySettings.l10n.magnific.tClose,
					tLoading: listifySettings.l10n.magnific.tLoading,
					ajax: {
						tError: listifySettings.l10n.magnific.tError
					},
					callbacks: {
						parseAjax: function(mfpResponse) {
							mfpResponse.data = '<div class="popup ' + class + '"><h2 class="popup-title">' + $(mfpResponse.data).find( '.page-title' ).text() + '</h2>' + $(mfpResponse.data).find('#main').html();
						},
						ajaxContentAdded: function() {
							$( 'body' ).trigger( 'popup-trigger-ajax' );
							self.initForms();
							self.initRecaptcha();
						}
					}
				});
			});

			self.cache.$document.on( 'click', '.popup-trigger', function(e) {
				e.preventDefault();

				var source = $(this).data( 'mfp-src' );

				if ( typeof source === 'undefined' ) {
					source = $(this).attr( 'href' );
				}

				self.triggerPopup({
					items: {
						src: source
					}
				});
			});
		},

		initRecaptcha: function() {
			$( '.g-recaptcha' ).each( function( index, element ) {
				if( $( this ).is( ':empty' ) ) {
					var site_key = $( this ).attr( 'data-sitekey' );
					var theme = $( this ).attr( 'data-theme' );
					var element  = $( this ).get( 0 );

					grecaptcha.render( element, { 'sitekey': site_key, 'theme': theme } );
				}
			});
		},

		triggerPopup: function(args) {
			$.magnificPopup.close();

			return $.magnificPopup.open( $.extend( args, {
				tClose: listifySettings.l10n.magnific.tClose,
				tLoading: listifySettings.l10n.magnific.tLoading,
				type: 'inline',
				fixedContentPos: false,
				fixedBgPos: true,
				overflowY: 'scroll'
			} ) );
		},

		initSelects: function() {
			var avoid = [
				'.feedFormField',
				'.job-manager-category-dropdown[multiple]',
				'.job-manager-multiselect',
				'.job-manager-chosen-select',
				'.intl-tel-mobile-select',
				'.state_select',
				'.country_select',
				'.fieldset-job_region #job_region',
				'.facetwp-type-fselect select',
				'#pm-recipient'
			];

			$( 'select' ).each(function() {
				if ( $(this).parent().hasClass( 'select' ) ) {
					return;
				}

				if ( $(this).is( avoid.join( ',' ) ) ) {
					return;
				}

				var existingClass = null;

				if ( $(this).attr( 'class' ) ) {
					var existingClass = $(this).attr( 'class' ).split(' ')[0];
				}

				$(this).wrap( '<span class="select ' + existingClass + '-wrapper"></span>' );
			});

			$( '#job_listing_tax_mobile select' ).change(function(e) {
				$( '#job_listing_tax_mobile' ).submit();
			});
		},

		initVideos: function() {
			$( '.site-content' ).fitVids();

			var video = $( '.homepage-cover .wp-video video' ).get(0);

			if ( typeof video === 'undefined' ) {
				return;
			}

			var vide = $( '.homepage-cover .wp-video' ).vide();

			video.play();
			vide.resize();

			function adjustHeight() {
				if ( $(window).width() < 768 ) {
					$( video ).hide();
				} else {
					$( video ).show();
				}
			}

			adjustHeight();


			$(window).resize(function() {
				adjustHeight();
			});

			return;
		},

		initTables: function() {
			// $( 'table' ).addClass( 'responsive' );
		},

		initForms: function() {
			this.cache.$document.on( 'submit', '.popup form.login, .popup form.register', function(e) {
				var form = $(this);
				var error = false;

				var base = $(this).serialize();
				var button = $(this).find( 'input[type=submit]' );

				var data = base + '&' + button.attr("name") + "=" + button.val();

				var request = $.ajax({
					url: listifySettings.homeurl, 
					data: data,
					type: 'POST',
					cache: false,
					async: false
				}).done(function(response) {
					form.find( $( '.woocommerce-error' ) ).remove();

					var $response = $( '#ajax-response' );
					var html = $.parseHTML(response);

					$response.append(html);
					error = $response.find( $( '.woocommerce-error' ) );

					if ( error.length > 0 ) {
						form.prepend( error.clone() );
						$response.html('');

						e.preventDefault();
					}
				});
			});
		}
	};

	listify.init();

})(jQuery);
