wp.listify = wp.listify || {}
wp.listify.archive = {}

jQuery ($) ->

  class Plotter
    @geocoder:  new google.maps.Geocoder()
    @settings: listifyMapSettings
    @loadedOnce: false

    constructor: ->
      @filters = new FiltersView()

      if Plotter.settings.displayMap
        @map = new MapView(filters: @filters)

      @meta = new MetaView(filters: @filters)


  class MetaView extends Backbone.View
    initialize: (options = {}) =>
      @filters = options.filters

      @setFound()
      @viewToggle()

      if ( $(window).outerWidth() < 993 && ! $( 'body' ).hasClass( 'home' ) )
        $( '.archive-job_listing-toggle[data-toggle=".' + Plotter.settings.defaultMobileView + '"]' ).click()

    setFound: =>
      $( 'div.job_listings' ).on 'updated_results', (event, results) =>
        $( '.results-found' ).text results.found
        @filters.startup()

    viewToggle: =>
      $toggle = $ '.archive-job_listing-toggle'
      $sections = $ '.content-area, .job_listings-map-wrapper'

      $toggle.on 'click', (e) ->
        e.preventDefault()

        $( 'body' ).removeClass 'map-toggled'

        if ( '.job_listings-map-wrapper' == $(@).data( 'toggle' ) )
          $( 'body' ).addClass 'map-toggled'

        $toggle.removeClass 'active'
        $(@).addClass 'active'

        target = $(@).data 'toggle'

        $sections.hide().filter( $( target ) ).show()

        $( 'html, body' ).animate({
          scrollTop: $( '.archive-job_listing-toggle-wrapper' ).offset().top
        }, 1)

        $( '.job_listings-map-wrapper' ).trigger( 'map-toggled' );


  class FiltersView extends Backbone.View
    target: $( 'div.job_listings' )
    form: $( '.job_filters' )
    address: $( '#search_location' )
    lat: $( '#search_lat' )
    lng: $( '#search_lng' )
    use: $( '#use_search_radius' )
    submit: $( '.job_filters' ).find( '.update_results' )

    initialize: =>
      @shutdown()

      @locationsCollection = new LocationsCollection()
      @locationsCollectionView = new LocationsCollectionView({
        collection: @locationsCollection
        filters: @
      })

      if ( @address.length && Plotter.settings.displayMap )
        @autoLocateView = new AutoLocateView({
          filters: @
          collectionView: @locationsCollectionView
        })
        @autoLocateView.render()

      @radiusView = new RadiusView({
        filters: @
      })
      @radiusView.render()

      @haltform()
      @check()
      @update()
      @monitor()
      @watchReset()

    monitor: =>
      @target.on 'update_results', (e, page, append) =>
        @shutdown()

    update: =>
      @target.triggerHandler 'update_results', [ 1, false ]

    # stop enter from doing anything
    haltform: =>
      @form.on 'submit', (e) =>
        @shutdown()
        e.preventDefault()

    # never let the results be submitted when searching with radius and
    # no lat has been found.
    check: =>
      @target.on 'update_results', (e, page, append) =>
        if 0 == @lat.val() && '' != @address.val()
          e.stopImmediatePropagation()

          @locationsCollectionView.generate()

    shutdown: =>
      @submit.text( @submit.data( 'refresh' ) ).addClass( 'refreshing' ).attr( 'disabled', true )
      $( '.job_listings-map-wrapper' ).addClass( 'loading' )

    startup: =>
      @submit.text( @submit.data( 'label' ) ).removeClass( 'refreshing' ).attr( 'disabled', false )
      $( 'ul.job_listings, .job_listings-map-wrapper' ).removeClass( 'loading' )

    watchReset: =>
      @target.on 'reset', (e) =>
        @lat.val ''
        @lng.val ''


  class AutoLocateView extends Backbone.View
    input: $( '#search_location' )

    initialize: (options) =>
      @filters = options.filters
      @collectionView = options.collectionView

      if '' == Plotter.settings.api then return

      @bindActions()

    bindActions: =>
      $( '.search_location' ).on 'click', '.locate-me', (e) =>
        e.preventDefault()

        $( '.locate-me' ).addClass 'loading'
        @filters.shutdown()

        @find()

    render: =>
      @input.before '<i class="locate-me"></i>' 

    find: =>
      cv = @collectionView
      filters = @filters

      if ! navigator.geolocation then return;

      success = (position) ->
        lat = position.coords.latitude
        lng = position.coords.longitude

        cv.set(
          'lat': lat
          'lng': lng
        )

        $( '.locate-me' ).removeClass 'loading'

      error = () ->
        $( '.locate-me' ).removeClass 'loading'
        filters.startup()

      navigator.geolocation.getCurrentPosition success, error

      @

  class RadiusView extends Backbone.View
    wrapper  : $( '.search-radius-wrapper' )

    defaults: {
      min: parseInt Plotter.settings.searchRadius.min 
      max: parseInt Plotter.settings.searchRadius.max
      avg: parseInt Plotter.settings.searchRadius.default 
    } 

    initialize: (options = {}) =>
      @filters = options.filters

    render: =>
      # lame
      val = @defaults.avg
      min = @defaults.min
      max = @defaults.max
      filters = @filters

      @wrapper.each () ->
        ui     = $(@).find '.search-radius-slider > div'
        input  = $(@).find '#search_radius'
        label  = $(@).find '.search-radius-label .radi'

        ui.slider
          value: val
          min: min
          max: max
          step: 1,
          slide: (event, ui) =>
            input.val ui.value
            label.text ui.value
          stop: (event, ui) =>
            filters.update()


  class LocationsCollectionView extends Backbone.View
    initialize: (options = {}) =>
      @collection = options.collection
      @filters = options.filters
      fat = @

      if '' == Plotter.settings.api then return

      if ! Plotter.settings.useAutoComplete then return

      fields = $( '.search_location > input')

      if ! fields.length then return

      @filters.form.find( 'input, select' ).unbind 'change'

      # because i dont know what im doing 
      filters = @filters
      set     = @set

      fields.on 'change', (e) ->
        val = $(@).val()

        if ( '' == val )
          fat.clear()

      fields.each (i) ->
        autocomplete = new google.maps.places.Autocomplete fields[i]

        # when a place is selected, add to the collection
        google.maps.event.addListener autocomplete, 'place_changed', ->
          filters.shutdown()

          place = autocomplete.getPlace()

          if place.geometry? 
            set(
              address: place.formatted_address
              lat: place.geometry.location.lat()
              lng: place.geometry.location.lng()
            )
          else
            set(address: place.name)

        $( fields[i] ).keypress (e) ->
          if e.which == 13
            google.maps.event.trigger autocomplete, 'place_changed'
            false

      # when a location is added to the collection, create a new model
      @listenTo(@collection, 'add', @render)

      @check()

    # if we load the page with something, add to the collection
    check: =>
      if '' != @filters.address.val()
        @generate()

    # before we let things update, lets make sure we have a lat found
    generate: =>
      @set address: @filters.address.val()

    set: (atts) =>
      @collection.add atts

    render: (location) =>
      location = new LocationView
        model: location
        filters: @filters


  class LocationView extends Backbone.View
    model: Location

    initialize: (options = {} ) =>
      @filters = options.filters

      @listenTo( @model, 'change', @render )

      if _.isNull( @model.get( 'address' ) )
        @model.set( 'address', '' )
        @model.set( 'lat', 0 )
        @model.set( 'lng', 0 )
        @render
        @filters.update()
      else if @model.get( 'address' ) && @model.get( 'lat' )
        @render()
        @filters.update()
      else
        @geocode().done (location) =>
          @model.set( 
            'address': location.formatted_address
            'lat': location.geometry.location.lat()
            'lng': location.geometry.location.lng()
          )
        .always () =>
          @filters.update()

    render: =>
      model = @model
      $( '.search_jobs').each ->
        filters = $(@)
        filters.find( '#search_lat' ).val model.get( 'lat' )
        filters.find( '#search_lng' ).val model.get( 'lng' )
        filters.find( '.search_location > input' ).val model.get( 'address' )

    geocode: =>
      @deferred = $.Deferred()

      if @model.get 'address'
        args = 'address': @model.get 'address'
      else
        args = 'latLng': new google.maps.LatLng @model.get( 'lat' ), @model.get( 'lng' )

      Plotter.geocoder.geocode args, (results, status) =>
        if status == google.maps.GeocoderStatus.OK
          @deferred.resolve results[0]
        else
          @deferred.reject()

      @deferred.promise()

  class Location extends Backbone.Model


  class LocationsCollection extends Backbone.Collection
    model: Location


  class MapView extends Backbone.View
    bounds: new google.maps.LatLngBounds()
    infobubble: new InfoBubble(
      backgroundClassName: 'map-marker-info',
      borderRadius: 4,
      padding: 15,
      borderColor: '#ffffff',
      shadowStyle: 0,
      minHeight: 115,
      maxHeight: 115,
      minWidth: 225,
      maxWidth: 275,
      hideCloseButton: true,
      flat: true,
      anchor: RichMarkerPosition.BOTTOM
      disableAutoPan: parseInt( Plotter.settings.autoPan ) == 0 ? true : false
    )	
    clusterer: new MarkerClusterer null, [], {
      ignoreHidden: true,
    }
    loaded: false

    initialize: (options = {}) =>
      @filters = options.filters

      @canvas = new MapCanvasView
        map: @
        filters: @filters

      @markersCollection = new MarkersCollection()
      @markersCollectionView = new MarkersCollectionView
        collection: @markersCollection
        map: @

      # because i dont know what else is referencing these globals....
      canvas = @canvas
      markersCollectionView = @markersCollectionView

      # these should both call one event
      $( '.job_listings' ).on 'updated_results', (event, results) =>
        canvas.canvas().done (obj) ->
          markersCollectionView.load()
          Plotter.loadedOnce = true

      # facetwp
      if ! Plotter.settings.facetwp then return

      _filters = @filters

      canvas.canvas().done (obj) ->
        FWP.refresh()

        $(document).on 'facetwp-loaded', (event) =>
          markersCollectionView.load()
          Plotter.loadedOnce = true
          _filters.startup()

  class MapCanvasView extends Backbone.View
    initialize: (options = {}) =>
      @map = options.map
      @filters = options.filters

      google.maps.event.addDomListener window, 'load', @canvas

      $( '.job_listings-map-wrapper' ).on 'map-toggled', @resize

    canvas: =>
      def = $.Deferred()
      @el = document.getElementById( 'job_listings-map-canvas' );

      if ! @el then return def.reject()

      @settings = Plotter.settings.mapOptions

      @opts =
        zoom: parseInt @settings.zoom
        maxZoom: parseInt @settings.maxZoom
        minZoom: parseInt @settings.maxZoomOut
        scrollwheel: @settings.scrollwheel
        styles: @settings.styles
        zoomControlOptions:
          position: google.maps.ControlPosition.RIGHT_TOP
        streetViewControl: true
        streetViewControlOptions:
          position: google.maps.ControlPosition.RIGHT_TOP

      if @settings.center
        @defaultCenter = new google.maps.LatLng @settings.center[0], @settings.center[1]
      else
        @defaultCenter = new google.maps.LatLng 41.850033, -87.6500523

      @opts.center = @defaultCenter

      @obj = wp.listify.archive.map = new google.maps.Map( @el, @opts )

      @createClusterer()

      google.maps.event.addListener @obj, 'click', @hideBubble 
      google.maps.event.addListener @obj, 'zoom_changed', @hideBubble
      google.maps.event.addListenerOnce @obj, 'idle', ->
        @loaded = true
        def.resolve(@obj) 

			# adjust scrollwheel on click when mobile
      if ( $(window).outerWidth() < 993 )
        google.maps.event.addListener @obj, 'click', () ->
          @.setOptions
            scrollwheel: true

        google.maps.event.addListener @obj, 'mouseout', () ->
          @.setOptions
            scrollwheel: false

      $(window).on 'resize', @resize

      @mapHeight()

      def.promise()

    mapHeight: =>
      if ! $( 'body' ).hasClass 'fixed-map' then return

      if $(window).outerWidth() > 993 && $( 'body' ).hasClass 'fixed-map'
        height = $(window).outerHeight() - ( $( '.site-header' ).outerHeight() )
      else if $(window).outerWidth() < 993
        height = $(window).outerHeight() - $( '.archive-job_listing-toggle-wrapper' ).outerHeight()

      if( $( 'body' ).hasClass( 'fixed-header' ) )
        height = height - $( '.primary-header' ).outerHeight()

      if $( 'body' ).hasClass( 'admin-bar' ) && $( 'body' ).hasClass 'fixed-map'
        height = height - $( '#wpadminbar' ).outerHeight()

      $( '.job_listings-map-wrapper, .job_listings-map' ).css( 'height', height )

    resize: =>
      @mapHeight()

      if _.isUndefined @obj then return

      google.maps.event.trigger @obj, 'resize'
      @fitbounds()

      if $(window).outerWidth() > 993
        $( '.job_listings-map-wrapper' ).css( 'top', 'auto' )

    createClusterer: =>
      @map.clusterer.setMap @obj
      @map.clusterer.setMaxZoom @opts.maxZoom
      @map.clusterer.setGridSize parseInt @settings.gridSize

      google.maps.event.addListener @map.clusterer, 'click', @clusterOverlay

    clusterOverlay: (c) =>
      markers = c.getMarkers()
      zoom = @obj.getZoom()

      if zoom < @opts.maxZoom then return

      content = _.map markers, (marker) ->
        template = wp.template 'infoBubbleTemplate'
        template marker.meta

      $.magnificPopup.open(
        items:
          src: '<div class="cluster-overlay popup">' + content.join( '' ) + '</div>'
          type: 'inline'
      )

    fitbounds: =>
      @obj.fitBounds @map.bounds

    hideBubble: =>
      @map.infobubble.close()

    showDefault: =>
      if _.isUndefined @obj then return true

      if Plotter.settings.facetwp
        if 0 < $( '.facetwp-type-proximity' ).length
          facet_name = $( '.facetwp-type-proximity' ).attr( 'data-name' );

          if 0 < FWP.facets[facet_name].length
            lat = FWP.facets[facet_name][0]
            lng = FWP.facets[facet_name][1]

            @obj.setCenter( new google.maps.LatLng( lat, lng ) )
      else
        if '' == @filters.address.val()
          @obj.setCenter @opts.center
        else
          last = @filters.locationsCollection.last()

          if ! _.isUndefined last
            @obj.setCenter new google.maps.LatLng( last.get( 'lat' ), last.get( 'lng' ) )
          else
            @obj.setCenter @opts.center

      @obj.setZoom @opts.zoom


  class MarkersCollectionView extends Backbone.View
    initialize: (options = {}) =>
      @collection = options.collection
      @map = options.map

      @listen()

    listen: =>
      @listenTo(@collection, 'add', @render)
      @listenTo(@collection, 'reset', @removeOld)

      if Plotter.settings.useClusters == '1'
        @listenTo(@collection, 'markers-reset', @clearClusterer)
        @listenTo(@collection, 'markers-added', @setClusterer)

      @listenTo(@collection, 'markers-reset', @clearBounds)
      @listenTo(@collection, 'markers-added', @fitBounds)
      @listenTo(@collection, 'markers-added', @resize)

    load: (event) =>
      data = @parseResults event;
      @collection.reset()

      if _.isEmpty data
        @map.canvas.showDefault()
      else 
        @collection.add data
        @collection.trigger 'markers-added'

    parseResults: (event) =>
      if ! _.isUndefined event && ! _.isUndefined event.target
        html = $( event.target ).find( 'ul.job_listings' ).first().find( '.type-job_listing' )
      else
        html = $( 'ul.job_listings' ).first().find( '.type-job_listing' )

      data = _.map html, (i) ->
        $(i).data()

      data = _.filter data, (i) ->
        _.has i, 'latitude'

    render: (marker) =>
      markerview = new MarkerView
        model: marker
        map: @map

      @map.bounds.extend marker.position()

      markerview.add()

    removeOld: (collection, opts) =>
      _.each opts.previousModels, (model) ->
        model.trigger( 'hide', model )

      @collection.trigger 'markers-reset'

    fitBounds: =>
      autofit = parseInt Plotter.settings.autoFit

      if autofit == 1 || Plotter.loadedOnce == true 
        @map.canvas.fitbounds()

    clearBounds: =>
      @map.bounds = new google.maps.LatLngBounds()

    clearClusterer: =>
      @map.clusterer.clearMarkers()

    setClusterer: =>
      markers = @collection.map (model) ->
        model.get 'obj'
      
      @map.clusterer.addMarkers markers
      @map.canvas.obj.setZoom( @map.canvas.obj.getZoom() + 1 );

    resize: =>
      google.maps.event.trigger @map.canvas.obj, 'resize'

  class MarkerView extends Backbone.View
    template: wp.template 'pinTemplate'
    templateInfoBubble: wp.template 'infoBubbleTemplate'

    initialize: (options = {}) =>
      @map = options.map

      @defaults = {
        flat: true
        draggable: false
        position: @model.position()
        content: @template @model.toJSON()
        meta: @model.toJSON()
      }

      @marker = new RichMarker @defaults;
      @model.set 'obj', @marker 

      @listenTo( @model, 'hide', @remove )

      trigger = Plotter.settings.trigger

      if $(window).outerWidth() <= 992 then trigger = 'click'

      google.maps.event.addListener(@model.get( 'obj' ), trigger, @renderInfoBubble)

    renderInfoBubble: =>
      if @map.infobubble.isOpen_ && @map.infobubble.anchor == @model.get( 'obj' )
        return

      @map.infobubble.setContent( @templateInfoBubble( @model.toJSON() ) )
      @map.infobubble.open( @map.canvas.obj, @model.get( 'obj' ) )

    add: =>
      @model.get( 'obj' ).setMap @map.canvas.obj

    remove: =>
      @model.get( 'obj' ).setMap null


  class Marker extends Backbone.Model
    default: {
      id: '',
      obj: '',
      lat: '',
      lng: '',
      title: ''
    }

    position: =>
      new google.maps.LatLng(
        @get( 'latitude' ),
        @get( 'longitude' ) 
      )


  class MarkersCollection extends Backbone.Collection
    model: Marker


  InfoBubble.prototype.getAnchorHeight_ = ->
    55


  plotter = new Plotter();
