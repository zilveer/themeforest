require.config({
  paths: {
    jquery:              'assets/js/src/jquery',
    underscore:          'assets/js/src/underscore',
    bootstrapAffix:      'bower_components/sass-bootstrap/js/affix',
    bootstrapAlert:      'bower_components/sass-bootstrap/js/alert',
    bootstrapButton:     'bower_components/sass-bootstrap/js/button',
    bootstrapCarousel:   'bower_components/sass-bootstrap/js/carousel',
    bootstrapCollapse:   'bower_components/sass-bootstrap/js/collapse',
    bootstrapDropdown:   'bower_components/sass-bootstrap/js/dropdown',
    bootstrapModal:      'bower_components/sass-bootstrap/js/modal',
    bootstrapPopover:    'bower_components/sass-bootstrap/js/popover',
    bootstrapScrollspy:  'bower_components/sass-bootstrap/js/scrollspy',
    bootstrapTab:        'bower_components/sass-bootstrap/js/tab',
    bootstrapTooltip:    'bower_components/sass-bootstrap/js/tooltip',
    bootstrapTransition: 'bower_components/sass-bootstrap/js/transition',
    enquire:             'bower_components/enquire/dist/enquire',
    jqueryui:            'assets/js/src/jqueryui',
    async:               'bower_components/requirejs-plugins/src/async',
  },
  shim: {
    bootstrapAffix: {
      deps: [
        'jquery'
      ]
    },
    bootstrapAlert: {
      deps: [
        'jquery'
      ]
    },
    bootstrapButton: {
      deps: [
        'jquery'
      ]
    },
    bootstrapCarousel: {
      deps: [
        'jquery'
      ]
    },
    bootstrapCollapse: {
      deps: [
        'jquery',
        'bootstrapTransition'
      ]
    },
    bootstrapDropdown: {
      deps: [
        'jquery'
      ]
    },
    bootstrapPopover: {
      deps: [
        'jquery'
      ]
    },
    bootstrapScrollspy: {
      deps: [
        'jquery'
      ]
    },
    bootstrapTab: {
      deps: [
        'jquery'
      ]
    },
    bootstrapTooltip: {
      deps: [
        'jquery'
      ]
    },
    bootstrapModal: {
      deps: [
        'jquery'
      ]
    },
    bootstrapTransition: {
      deps: [
        'jquery'
      ]
    }
  }
});

require.config( {
  baseUrl: OrganiqueVars.pathToTheme
} );

require([
    'jquery',
    'assets/js/src/SimpleMap',
    'assets/js/src/TouchDropdown',
    'assets/js/src/utils',
    'assets/js/src/HeaderCarousel',
    'bootstrapTransition',
    'bootstrapCollapse',
    'bootstrapAlert',
    'bootstrapTab',
    'bootstrapDropdown',
    'bootstrapCarousel',
    'bootstrapModal',
    'assets/js/src/wooShopFilters',
    'assets/js/src/AttachedNavbar'
  ], function (
    $,
    SimpleMap
  ) {
  'use strict';

  /**
   * Maps
   */
  (function () {
    if ( $('.js--where-we-are').length < 1 ) {
      return;
    }
    var map = new SimpleMap( $('.js--where-we-are'), {
      latLng:  OrganiqueVars.latLng,
      type:    OrganiqueVars.mapType,
      markers: OrganiqueVars.gmapsLocations,
      zoom:    parseInt( OrganiqueVars.zoomLevel, 10 ),
      styles:  JSON.parse( OrganiqueVars.mapStyle ),
    }).renderMap();
  })();
});