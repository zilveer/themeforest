jQuery ($) ->

  $(document).on 'widget-updated widget-added', (e, widget_el) ->
    id_base = widget_el.find( 'input[name="id_base"]' ).val()
    widget_id = widget_el.find( 'input[name="widget-id"]' ).val()

    if 'listify_widget_features' == id_base
      if 'widget-added' == e.type then init '#features-' + widget_id, false

  window.featuresWidget = (el, data) ->
    init el, data

  init = (el, data) ->
    featureList = new FeatureList()

    widget = new WidgetView(
      el: el,
      collection: featureList
    )

    if data then widget.load data

  class Feature extends Backbone.Model
    defaults: {
      title: ''
      media: ''
      description: ''
      order: 0
    }

  class FeatureList extends Backbone.Collection
    count: 0
    model: Feature
    comparator: 'order'

  class FeatureView extends Backbone.View
    model: Feature
    className: 'feature'

    events: {
      'click .button-remove-feature': 'clear'
    }

    initialize: (options) =>
      @widget = options.widget
      @model = options.model

      widget_el = @widget.el.parent().parent().parent().parent()
      @widgetNumber = widget_el.find( 'input.multi_number' ).val()

      if '' == @widgetNumber
        @widgetNumber = widget_el.find( 'input.widget_number' ).val()

      @template = $( '#tmpl-feature' ).html()
      @template = @template.replace( /__i__/g, @widgetNumber );

      @template = _.template @template

      @listenTo @model, 'destroy', @remove

    render: =>
      @$el.html @template(@model.toJSON())

      @

    clear: (e) =>
      e.preventDefault()
      @model.destroy()


  class WidgetView extends Backbone.View
    events: {
      'click .button-add-feature': 'addFromButton'
    }

    initialize: (options) =>
      @el = $(options.el)
      @collection = options.collection

      @el.sortable()

      @listenTo @collection, 'add', @addOne

    load: (data) =>
      @collection.reset()

      _.each data, (item) =>
        @collection.set item

    addFromButton: (e) =>
      e.preventDefault()

      @addOne new Feature( 'order': @collection.count + 1 )

    addOne: (feature) =>
      @collection.count = @collection.count + 1;
      feature.set( 'order', @collection.count )

      feature = new FeatureView(
        model: feature
        widget: @
      )

      @el.append feature.render().el 
