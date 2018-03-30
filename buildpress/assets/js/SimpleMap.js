/* global google, define */
define( ['jquery', 'underscore'], function ( $, _ ) {
	'use strict';
	/**
	 * Google Maps
	 *
	 * @link http://snazzymaps.com/style/27/shift-worker
	 */

	var mapOptions = {
		latLng:      '0,0',
		zoom:        5,
		type:        'ROADMAP',
		styles:      '',
		scrollwheel: false,
		draggable:   true,
		markers:     [
			{
				locationlatlng: '0,0',
				title:          'demo marker',
				custompinimage: '',
			}
		],
	};

	if ( Modernizr.touch ) {
		mapOptions['draggable'] = false;
	}


	/**
	 * Constructor
	 * @param {jQuery selector} element where to create a map to
	 * @param {Object} options
	 */
	var SimpleMap = function( elm, options ) {
		this.mapOptions = $.extend( {}, mapOptions, options );
		this.elm = elm;
		this.setOptions();

		return this;
	};

	SimpleMap.prototype.setOptions = function() {
		this.mapOptions.latLng    = this.getLatLngFromString( this.mapOptions.latLng );
		this.mapOptions.center    = new google.maps.LatLng( this.mapOptions.latLng[0], this.mapOptions.latLng[1]);
		this.mapOptions.mapTypeId = this.getMapConstant();

		return this;
	};

	/**
	 * Returns the constant for the google maps
	 * @return MapTypeId
	 * @link https://developers.google.com/maps/documentation/javascript/maptypes#MapTypes
	 */
	SimpleMap.prototype.getMapConstant = function() {
		switch ( this.mapOptions.type.toLowerCase() ) {
			case 'roadmap':
				return google.maps.MapTypeId.ROADMAP;
			case 'satellite':
				return google.maps.MapTypeId.SATELLITE;
			case 'hybrid':
				return google.maps.MapTypeId.HYBRID;
			case 'terrain':
				return google.maps.MapTypeId.TERRAIN;
			default:
				return google.maps.MapTypeId.ROADMAP;
		}
	};

	/**
	 * Helper function to create lagLng array if the context is string
	 * Editing in-place.
	 * @return void
	 */
	SimpleMap.prototype.getLatLngFromString = function( str ) {
		if ( _.isString( str ) ) {
			return _.map( str.split( ',' ), function (val) {
				return parseFloat( val, 10 );
			} );
		} else {
			return str;
		}
	};


	SimpleMap.prototype.renderMap = function() {
		if( ! _.isUndefined( this.elm ) ) {
			this.map = new google.maps.Map( this.elm.get(0), this.mapOptions );
		} else {
			return false;
		}

		this.addMarkers();

		return this;
	};

	SimpleMap.prototype.addMarkers = function () {
		// add all markers
		$.each( this.mapOptions.markers, $.proxy( function ( i, val ) {
			var latLng = this.getLatLngFromString( val.locationlatlng );

			var marker = new google.maps.Marker( {
				position: new google.maps.LatLng( latLng[0], latLng[1] ),
				title:    val.title,
			} );

			if ( ! _( val.custompinimage).isEmpty() ) {
				marker.setIcon( val.custompinimage );
			}

			marker.setMap( this.map );
		}, this ) );
	};

	return SimpleMap;
} );