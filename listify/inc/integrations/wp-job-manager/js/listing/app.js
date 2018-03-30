(function() {
  var ListifySingleMap,
    __bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; };

  wp.listify = wp.listify || {};

  wp.listify.listing = {};

  ListifySingleMap = (function() {
    function ListifySingleMap() {
      this.setMarker = __bind(this.setMarker, this);
      this.setupMap = __bind(this.setupMap, this);
      this.setOptions = __bind(this.setOptions, this);
      this.canvas = 'listing-contact-map';
      if (!document.getElementById(this.canvas)) {
        return;
      }
      this.setOptions();
      this.setupMap();
      this.setMarker();
    }

    ListifySingleMap.prototype.setOptions = function() {
      this.options = listifySingleMap;
      this.latlng = new google.maps.LatLng(this.options.lat, this.options.lng);
      this.zoom = parseInt(this.options.mapOptions.zoom);
      this.styles = this.options.mapOptions.styles;
      return this.mapOptions = {
        zoom: this.zoom,
        center: this.latlng,
        scrollwheel: false,
        styles: this.styles,
        streetViewControl: false
      };
    };

    ListifySingleMap.prototype.setupMap = function() {
      return this.map = new google.maps.Map(document.getElementById(this.canvas), this.mapOptions);
    };

    ListifySingleMap.prototype.setMarker = function() {
      this.marker = new RichMarker({
        position: this.latlng,
        flat: true,
        draggable: false,
        content: '<div class="map-marker marker-color-' + this.options.term + ' type-' + this.options.term + '"><i class="' + this.options.icon + '"></i></div>'
      });
      return this.marker.setMap(this.map);
    };

    return ListifySingleMap;

  })();

  wp.listify.listing.map = function() {
    return new ListifySingleMap();
  };

  google.maps.event.addDomListener(window, 'load', wp.listify.listing.map);

  jQuery(function($) {
    var ListifyListingComments;
    ListifyListingComments = (function() {
      function ListifyListingComments() {
        this.toggleStars = __bind(this.toggleStars, this);
        this.bindActions = __bind(this.bindActions, this);
        $('.form-submit').append($('<input />').attr({
          type: 'hidden',
          id: 'comment_rating',
          name: 'comment_rating',
          value: 3
        }));
        this.bindActions();
      }

      ListifyListingComments.prototype.bindActions = function() {
        $('.comment-sorting-filter').on('change', function(e) {
          return $(this).closest('form').submit();
        });
        return $('.comment-form-rating.comment-form-rating--listify .star').on('click', (function(_this) {
          return function(e) {
            e.preventDefault();
            return _this.toggleStars(e.target);
          };
        })(this));
      };

      ListifyListingComments.prototype.toggleStars = function(el) {
        var rating;
        $('.comment-form-rating.comment-form-rating--listify .star').removeClass('active');
        el = $(el);
        el.addClass('active');
        rating = el.data('rating');
        return $('#comment_rating').val(rating);
      };

      return ListifyListingComments;

    })();
    return new ListifyListingComments();
  });

  jQuery(function($) {
    var ListifyListingGallery;
    ListifyListingGallery = (function() {
      function ListifyListingGallery() {
        this.slick = __bind(this.slick, this);
        this.gallery = __bind(this.gallery, this);
        this.cover = __bind(this.cover, this);
        this.slick();
        this.gallery();
        this.cover();
      }

      ListifyListingGallery.prototype.cover = function() {
        var $container, $fixedHeight;
        $fixedHeight = $('.single-job_listing-cover-gallery').outerHeight();
        $container = $('.single-job_listing-cover-gallery-slick');
        if (!$container.length) {
          return;
        }
        return $container.slick({
          variableWidth: true,
          centerMode: true,
          slidestoShow: 1,
          infinite: true
        });
      };

      ListifyListingGallery.prototype.gallery = function() {
        var args, preview;
        preview = $('#job_preview').length || $('.no-gallery-comments').length;
        args = {
          tClose: listifySettings.l10n.magnific.tClose,
          tLoading: listifySettings.l10n.magnific.tLoading,
          gallery: {
            enabled: true,
            preload: [1, 1]
          }
        };
        if (preview) {
          args.type = 'image';
        } else {
          args.type = 'ajax';
          args.ajax = {
            tError: listifySettings.l10n.magnific.tError,
            settings: {
              type: 'GET',
              data: {
                'view': 'singular'
              }
            }
          };
          args.callbacks = {
            open: function() {
              return $('body').addClass('gallery-overlay');
            },
            close: function() {
              return $('body').removeClass('gallery-overlay');
            },
            lazyLoad: function(item) {
              var $thumb;
              return $thumb = $(item.el).data('src');
            },
            parseAjax: function(mfpResponse) {
              return mfpResponse.data = $(mfpResponse.data).find('#main');
            }
          };
        }
        return $('.listing-gallery__item-trigger').magnificPopup(args);
      };

      ListifyListingGallery.prototype.slick = function() {
        $('.listing-gallery').slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: false,
          fade: true,
          adaptiveHeight: true,
          asNavFor: '.listing-gallery-nav',
          rtl: listifySettings.is_rlt
        });
        return $('.listing-gallery-nav').slick({
          slidesToShow: 7,
          slidesToScroll: 1,
          asNavFor: '.listing-gallery',
          dots: true,
          arrows: false,
          focusOnSelect: true,
          infininte: true,
          rtl: listifySettings.is_rlt,
          responsive: [
            {
              breakpoint: 1200,
              settings: {
                slidesToShow: 5
              }
            }
          ]
        });
      };

      return ListifyListingGallery;

    })();
    wp.listify.listing.gallerySlider = function() {
      return new ListifyListingGallery();
    };
    return wp.listify.listing.gallerySlider();
  });

  jQuery(function($) {
    var listingLocateMe;
    listingLocateMe = (function() {
      function listingLocateMe() {
        this.find = __bind(this.find, this);
        this.bindActions = __bind(this.bindActions, this);
        this.$directionsLocate = $('#get-directions-locate-me');
        this.$directionsSAddr = $('#get-directions-start');
        this.bindActions();
      }

      listingLocateMe.prototype.bindActions = function() {
        var self;
        self = this;
        $('#get-directions').on('click', (function(_this) {
          return function(e) {
            e.preventDefault();
            return $('#get-directions-form').toggle();
          };
        })(this));
        return this.$directionsLocate.on('click', (function(_this) {
          return function(e) {
            e.preventDefault();
            self.$directionsLocate.addClass('loading');
            return self.find();
          };
        })(this));
      };

      listingLocateMe.prototype.find = function() {
        var error, self, success;
        self = this;
        if (!navigator.geolocation) {
          return;
        }
        success = function(position) {
          var geocoder, latlng;
          if (position.coords) {
            latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
            geocoder = new google.maps.Geocoder();
            geocoder.geocode({
              location: latlng
            }, function(result) {
              return self.$directionsSAddr.val(result[0].formatted_address);
            });
          }
          return self.$directionsLocate.removeClass('loading');
        };
        error = function() {
          return self.$directionsLocate.removeClass('loading');
        };
        return navigator.geolocation.getCurrentPosition(success, error);
      };

      return listingLocateMe;

    })();
    return new listingLocateMe();
  });

}).call(this);

//# sourceMappingURL=app.js.map
