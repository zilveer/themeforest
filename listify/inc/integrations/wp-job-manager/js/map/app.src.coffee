jQuery ($) ->

  class FiltersView extends Backbone.View
    initialize: =>
      @locationsCollection = new LocationsCollection()
      @locationsCollectionView = new LocationsCollectionView(collection: @locationsCollection)

    shutdown: =>
      console.log( 'shutdown' )

    startup: =>
      console.log( 'startup' )

  return

jQuery ($) ->
  class Plotter    
    @geocoder:  new google.maps.Geocoder()
    @map: null
    @filters: null

    constructor: ->
      @map = new MapView()
      @filters = new FiltersView()


  class FiltersView extends Backbone.View
    initialize: =>
      @locationsCollection = new LocationsCollection()
      @locationsCollectionView = new LocationsCollectionView(collection: @locationsCollection)

    shutdown: =>
      console.log( 'shutdown' )

    startup: =>
      console.log( 'startup' )


  class LocationsCollectionView extends Backbone.View
    el: $( '.job_filters' )

    initialize: (options = {}) =>
      @collection = options.collection;

      @address = $( '#search_location' )
      @autocomplete = new google.maps.places.Autocomplete document.getElementById( 'search_location' )
      
      @listenTo(@collection, 'add', @render)

      google.maps.event.addListener @autocomplete, 'place_changed', =>
        place = @autocomplete.getPlace()

        @set(
          address: place.formatted_address
          lat: place.geometry.location.lat()
          lng: place.geometry.location.lng()
        )

      if '' != @address.val()
        @set(address: @address.val())

    set: (atts) =>
      @collection.add(atts)

    render: (location) =>
      console.log(location)
      location = new LocationView(model: location)

  class LocationView extends Backbone.View
    model: Location
    
    initialize: =>
      @listenTo(@model, 'change:lat', @updateLat)
      @listenTo(@model, 'change:lng', @updateLng)

      @lat = $( '#search_lat' )
      @lng = $( '#search_lng' )

    updateLat: =>
      @lat.val( @model.get( 'lat' ) ) if @model.hasChanged( 'lat' )

    updateLng: =>
      @lng.val( @model.get( 'lng' ) ) if @model.hasChanged( 'lng' ) 


  class Location extends Backbone.Model
    defaults: {
      address: '',
      lat: '',
      lng: ''
    }

    initialize: =>
      @geocode().done (location) =>
        @set( 'lat': location.lat(), 'lng': location.lng() )

    geocode: =>
      @deferred = $.Deferred()

      Plotter.geocoder.geocode address: @get( 'address' ), (results, status) =>
        if status == google.maps.GeocoderStatus.OK
          @location = results[0].geometry.location
          @deferred.resolve(@location)
        else
          console.log( 'geocode error' )
      
      @deferred.promise()


  class LocationsCollection extends Backbone.Collection
    model: Location


  class MapView extends Backbone.View
    initialize: =>
      @markersCollection = new MarkersCollection()
      @markersView = new MarkersView(collection: @markersCollection)
      @markersCollection.load({
        data: [{ id: 'wat' }]
      })


  class MarkersView extends Backbone.View
    initialize: (options = {}) =>
      @collection = options.collection
      @collection.bind('add', @render, @)

    render: () =>
      @collection.each(@renderOne)

    renderOne: (marker) =>
      marker = new MarkerView({model: marker})
      marker.render()


  class MarkersCollection extends Backbone.Collection
    initialize: (options = {}) =>

    load: (options = {}) =>
      @.set(options.data);
      @


  class MarkerView extends Backbone.View
    initialize: =>
    render: =>


  class Marker extends Backbone.Model
    default: {
      id: ''
    }

  plotter = new Plotter();
