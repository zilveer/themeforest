(function() {
  var __hasProp = {}.hasOwnProperty,
    __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; },
    __bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; };

  jQuery(function($) {
    var Feature, FeatureList, FeatureView, WidgetView, init;
    $(document).on('widget-updated widget-added', function(e, widget_el) {
      var id_base, widget_id;
      id_base = widget_el.find('input[name="id_base"]').val();
      widget_id = widget_el.find('input[name="widget-id"]').val();
      if ('listify_widget_features' === id_base) {
        if ('widget-added' === e.type) {
          return init('#features-' + widget_id, false);
        }
      }
    });
    window.featuresWidget = function(el, data) {
      return init(el, data);
    };
    init = function(el, data) {
      var featureList, widget;
      featureList = new FeatureList();
      widget = new WidgetView({
        el: el,
        collection: featureList
      });
      if (data) {
        return widget.load(data);
      }
    };
    Feature = (function(_super) {
      __extends(Feature, _super);

      function Feature() {
        return Feature.__super__.constructor.apply(this, arguments);
      }

      Feature.prototype.defaults = {
        title: '',
        media: '',
        description: '',
        order: 0
      };

      return Feature;

    })(Backbone.Model);
    FeatureList = (function(_super) {
      __extends(FeatureList, _super);

      function FeatureList() {
        return FeatureList.__super__.constructor.apply(this, arguments);
      }

      FeatureList.prototype.count = 0;

      FeatureList.prototype.model = Feature;

      FeatureList.prototype.comparator = 'order';

      return FeatureList;

    })(Backbone.Collection);
    FeatureView = (function(_super) {
      __extends(FeatureView, _super);

      function FeatureView() {
        this.clear = __bind(this.clear, this);
        this.render = __bind(this.render, this);
        this.initialize = __bind(this.initialize, this);
        return FeatureView.__super__.constructor.apply(this, arguments);
      }

      FeatureView.prototype.model = Feature;

      FeatureView.prototype.className = 'feature';

      FeatureView.prototype.events = {
        'click .button-remove-feature': 'clear'
      };

      FeatureView.prototype.initialize = function(options) {
        var widget_el;
        this.widget = options.widget;
        this.model = options.model;
        widget_el = this.widget.el.parent().parent().parent().parent();
        this.widgetNumber = widget_el.find('input.multi_number').val();
        if ('' === this.widgetNumber) {
          this.widgetNumber = widget_el.find('input.widget_number').val();
        }
        this.template = $('#tmpl-feature').html();
        this.template = this.template.replace(/__i__/g, this.widgetNumber);
        this.template = _.template(this.template);
        return this.listenTo(this.model, 'destroy', this.remove);
      };

      FeatureView.prototype.render = function() {
        this.$el.html(this.template(this.model.toJSON()));
        return this;
      };

      FeatureView.prototype.clear = function(e) {
        e.preventDefault();
        return this.model.destroy();
      };

      return FeatureView;

    })(Backbone.View);
    return WidgetView = (function(_super) {
      __extends(WidgetView, _super);

      function WidgetView() {
        this.addOne = __bind(this.addOne, this);
        this.addFromButton = __bind(this.addFromButton, this);
        this.load = __bind(this.load, this);
        this.initialize = __bind(this.initialize, this);
        return WidgetView.__super__.constructor.apply(this, arguments);
      }

      WidgetView.prototype.events = {
        'click .button-add-feature': 'addFromButton'
      };

      WidgetView.prototype.initialize = function(options) {
        this.el = $(options.el);
        this.collection = options.collection;
        this.el.sortable();
        return this.listenTo(this.collection, 'add', this.addOne);
      };

      WidgetView.prototype.load = function(data) {
        this.collection.reset();
        return _.each(data, (function(_this) {
          return function(item) {
            return _this.collection.set(item);
          };
        })(this));
      };

      WidgetView.prototype.addFromButton = function(e) {
        e.preventDefault();
        return this.addOne(new Feature({
          'order': this.collection.count + 1
        }));
      };

      WidgetView.prototype.addOne = function(feature) {
        this.collection.count = this.collection.count + 1;
        feature.set('order', this.collection.count);
        feature = new FeatureView({
          model: feature,
          widget: this
        });
        return this.el.append(feature.render().el);
      };

      return WidgetView;

    })(Backbone.View);
  });

}).call(this);

//# sourceMappingURL=widget-features.js.map
