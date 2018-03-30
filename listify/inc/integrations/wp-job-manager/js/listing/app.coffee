wp.listify = wp.listify || {}
wp.listify.listing = {}

class ListifySingleMap
  constructor: () ->
    @canvas = 'listing-contact-map'

    if ! document.getElementById( @canvas ) then return;

    @setOptions()
    @setupMap()
    @setMarker()

  setOptions: =>
    @options = listifySingleMap;
    @latlng = new google.maps.LatLng @options.lat, @options.lng
    @zoom = parseInt @options.mapOptions.zoom
    @styles = @options.mapOptions.styles

    @mapOptions =
      zoom: @zoom
      center: @latlng
      scrollwheel: false
      styles: @styles
      streetViewControl: false

  setupMap: =>
    @map = new google.maps.Map document.getElementById( @canvas ), @mapOptions

  setMarker: =>
    @marker = new RichMarker(
      position: @latlng
      flat: true
      draggable: false
      content: '<div class="map-marker marker-color-' + @options.term + ' type-' + @options.term + '"><i class="' + @options.icon + '"></i></div>'
    ) 

    @marker.setMap @map

wp.listify.listing.map = () ->
  new ListifySingleMap()

google.maps.event.addDomListener window, 'load', wp.listify.listing.map

jQuery ($) ->
  class ListifyListingComments
    constructor: ->
      $( '.form-submit' ).append $( '<input />' ).attr({ 
        type: 'hidden', 
        id: 'comment_rating', 
        name: 'comment_rating', 
        value: 3
      })

      @bindActions()

    bindActions: =>
      $( '.comment-sorting-filter' ).on 'change', (e) ->
        $(@).closest( 'form' ).submit()

      $( '.comment-form-rating.comment-form-rating--listify .star' ).on 'click', (e) =>
        e.preventDefault()

        @toggleStars(e.target)

    toggleStars: (el) =>
      $( '.comment-form-rating.comment-form-rating--listify .star' ).removeClass 'active'

      el = $(el);
      el.addClass 'active'

      rating = el.data 'rating'

      $( '#comment_rating' ).val rating

  new ListifyListingComments()

jQuery ($) ->
  class ListifyListingGallery
    constructor: ->
      @slick()
      @gallery()
      @cover();

    cover: =>
      $fixedHeight = $( '.single-job_listing-cover-gallery' ).outerHeight();
      $container = $( '.single-job_listing-cover-gallery-slick' );

      if ! $container.length then return

      # $container.css( 'height', 1000 )
      #
      # $container.find( 'img' ).each () ->
      #   console.log @

      $container.slick
        variableWidth: true
        centerMode: true
        slidestoShow: 1
        infinite: true

    gallery: =>
      preview = $( '#job_preview' ).length || $( '.no-gallery-comments' ).length

      args =
        tClose: listifySettings.l10n.magnific.tClose
        tLoading: listifySettings.l10n.magnific.tLoading
        gallery:
          enabled: true
          preload: [1,1]

      if preview
        args.type = 'image'
      else
        args.type = 'ajax'
        args.ajax =
          tError: listifySettings.l10n.magnific.tError
          settings:
            type: 'GET'
            data: { 'view': 'singular' }
        args.callbacks =
          open: ->
            $( 'body' ).addClass( 'gallery-overlay' );
          close: ->
            $( 'body' ).removeClass( 'gallery-overlay' );
          lazyLoad: (item) ->
            $thumb = $( item.el ).data( 'src' );
          parseAjax: (mfpResponse) ->
            mfpResponse.data = $(mfpResponse.data).find( '#main' );

      $( '.listing-gallery__item-trigger' ).magnificPopup args

    slick: =>
      $( '.listing-gallery' ).slick
        slidesToShow: 1
        slidesToScroll: 1
        arrows: false
        fade: true
        adaptiveHeight: true
        asNavFor: '.listing-gallery-nav'
        rtl: listifySettings.is_rlt

      $('.listing-gallery-nav').slick
        slidesToShow: 7
        slidesToScroll: 1
        asNavFor: '.listing-gallery'
        dots: true
        arrows: false
        focusOnSelect: true
        infininte: true
        rtl: listifySettings.is_rlt
        responsive: [
          {
            breakpoint: 1200,
            settings: {
              slidesToShow: 5,
            }
          }
        ]

  wp.listify.listing.gallerySlider = () ->
    new ListifyListingGallery()

  wp.listify.listing.gallerySlider()

# Locate Me on Directions
jQuery ($) ->

  class listingLocateMe
    constructor: () ->
      @$directionsLocate = $( '#get-directions-locate-me' )
      @$directionsSAddr = $( '#get-directions-start' )

      @bindActions()

    bindActions: =>
      self = @

      $( '#get-directions' ).on 'click', (e) =>
        e.preventDefault()
        $( '#get-directions-form' ).toggle()

      @$directionsLocate.on 'click', (e) =>
        e.preventDefault()

        self.$directionsLocate.addClass 'loading'

        self.find()

    find: =>
      self = @
      if ! navigator.geolocation then return;

      success = (position) ->
        if position.coords
          latlng = new google.maps.LatLng( position.coords.latitude, position.coords.longitude )
          geocoder = new google.maps.Geocoder()

          geocoder.geocode { location: latlng }, (result) ->
            self.$directionsSAddr.val result[0].formatted_address

        self.$directionsLocate.removeClass 'loading'

      error = () ->
        self.$directionsLocate.removeClass 'loading'

      navigator.geolocation.getCurrentPosition success, error

  new listingLocateMe()
