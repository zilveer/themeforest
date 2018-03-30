
;(function( wp, $ ) {

	"use strict";

	var api = wp.customize, 
		WebFontView, 
		WebFontViews = {}, 
		WebFontFormView, 
		WebFontDropdownView, 
		WebFontCheckboxCollectionView, 
		WebFontModel, 
		Fonts = _youxiCustomizeWebFonts;

	if( api ) {

		api.Youxi = api.Youxi || {};
		api.Youxi.WebFontControl = api.Control.extend({

			ready: function() {

				var control   = this;
				var providers = control.container.find( '.youxi-webfont-control-providers' );
				var setting   = control.setting();
				var matches;

				control.activeProvider = '';
				control.providerViews  = {};

				if( ! _.isString( setting ) ) {
					setting = '';
				}
				if( matches = /^(typekit|google|websafe)\/(.+)$/.exec( setting ) ) {
					control.activeProvider = matches[1];
				}

				providers.children( '[data-provider-id]' ).each(function() {

					var providerEl = this;
					var providerId = $( providerEl ).data( 'provider-id' );
					var model;

					_.each( WebFontViews, function( viewClass, id ) {

						id = id.toLowerCase();
						if( providerId.toLowerCase() == id ) {

							model = new WebFontModel({ id: id });
							model.on( 'change', function( model ) {
								if( control.activeProvider == model.id ) {
									control.setting.set( model.getValue() );
								}
							});

							control.providerViews[ id ] = new viewClass({
								id: id, 
								el: providerEl, 
								model: model
							});
						}
					});
				});

				control.container.on( 'change', '.youxi-webfont-control-sources', function(e) {
					_.invoke( control.providerViews, 'deactivate' );
					if( _.has( control.providerViews, this.value ) ) {
						control.activeProvider = this.value;
						control.providerViews[ control.activeProvider ].activate();
					} else {
						control.activeProvider = null;
						control.setting.set( '' );
					}
				});
			}
		});

		WebFontModel = api.Youxi.WebFontModel = Backbone.Model.extend({
			defaults: {
				'family': '', 
				'variation': '', 
				'subsets': []
			}, 

			reset: function( options ) {
				this.set( WebFontModel.prototype.defaults , options );
			}, 

			getValue: function() {
				var value     = [], 
					family    = this.get( 'family' ), 
					variation = this.get( 'variation' ), 
					subsets   = this.get( 'subsets' );

				if( family ) {

					value.push( family );
					if( variation ) {
						value.push( variation );
					}

					subsets = subsets.length ? '&subset=' + subsets.join( ',' ) : '';

					return [ this.id, value.join( ':' ) + subsets ].join( '/' );
				}

				return '';
			}
		});

		WebFontFormView = Backbone.View.extend({
			show: function() {
				this.$el.show();
			}, 
			hide: function() {
				this.$el.hide();
			}
		});

		WebFontDropdownView = WebFontFormView.extend({
			val: function( val ) {
				if( _.isUndefined( val ) ) {
					return this.$( 'select' ).val();
				} else {
					this.$( 'select > option' ).each(function() {
						$( this ).prop( 'selected', this.value === val );
					});
				}
			}, 

			createOption: function( text, value ) {
				return $( '<option />' ).attr( 'value', value ).text( text );
			}, 

			reset: function() {
				this.$( 'select > option' ).not( '.placeholder' ).prop( 'selected', false );
			}, 

			empty: function() {
				this.$( 'select > option' ).not( '.placeholder' ).remove();
			}, 

			update: function( data, selectedValue ) {
				this.$( 'select' ).empty().append( _.map( data, this.createOption ) );
				this.val( selectedValue );
			}
		});

		WebFontCheckboxCollectionView = WebFontFormView.extend({
			val: function( val ) {
				if( _.isUndefined( val ) ) {
					return this.$( ':checkbox:checked' ).map(function() {
						return this.value;
					}).get();
				} else {
					this.$( ':checkbox' ).each(function() {
						$( this ).prop( 'checked', _.indexOf( val, this.value ) > 0 );
					});
				}
			}, 

			createCheckbox: function( text, value ) {
				return $( '<label />' ).html( '<input type="checkbox" value="' + value + '">' + text + '<br>' );
			}, 

			reset: function() {
				this.$( ':checkbox' ).prop( 'checked', false );
			}, 

			empty: function() {
				this.$( ':checkbox' ).remove();
			}, 

			update: function( data, checkedValues ) {
				this.$( '.checkboxes' ).empty().append( _.map( data, this.createCheckbox ) );
				this.val( checkedValues );
			}
		});

		WebFontView = api.Youxi.WebFontView = Backbone.View.extend({

			events: {
				'change .youxi-webfont-provider-family select': 'updateFamily', 
				'change .youxi-webfont-provider-variation select': 'updateVariation'
			}, 

			initialize: function() {
				Backbone.View.prototype.initialize.apply( this, arguments );

				this.fonts = Fonts[ this.id ] || {};

				this.familyDropdownView = new WebFontDropdownView({
					el: this.$( '.youxi-webfont-provider-family' ).get(0)
				});
				this.variationDropdownView = new WebFontDropdownView({
					el: this.$( '.youxi-webfont-provider-variation' ).get(0)
				});

				this.model.set( 'family', this.familyDropdownView.val(), { silent: true } );
				this.model.set( 'variation', this.variationDropdownView.val(), { silent: true } );

				this.listenTo( this.model, 'change:family', this.refresh );
			}, 

			refresh: function() {}, 

			activate: function() {
				this.model.trigger( 'change', this.model );
				this.$el.removeClass( 'youxi-webfont-provider-inactive' );
			}, 

			deactivate: function() {
				this.$el.addClass( 'youxi-webfont-provider-inactive' );
			}, 

			updateFamily: function() {
				this.model.set( 'family', this.familyDropdownView.val() );
			}, 

			updateVariation: function() {
				this.model.set( 'variation', this.variationDropdownView.val() );
			}
		});

		WebFontView.Websafe = WebFontViews.Websafe = api.Youxi.WebFontView.extend({
			refresh: function( model, family ) {
				if( !! family ) {
					this.variationDropdownView.val( 'n4' );
					this.variationDropdownView.show();
					this.updateVariation();
				} else {
					this.variationDropdownView.val( '' );
					this.variationDropdownView.hide();
					this.updateVariation();
				}
			}
		});

		WebFontView.Google = WebFontViews.Google = api.Youxi.WebFontView.extend({

			events: _.extend( {}, WebFontView.prototype.events, {
				'change .youxi-webfont-provider-subsets :checkbox': 'updateSubsets'
			}), 

			initialize: function() {
				WebFontView.prototype.initialize.apply( this, arguments );

				this.subsetCheckboxes = new WebFontCheckboxCollectionView({
					el: this.$( '.youxi-webfont-provider-subsets' ).get(0)
				});

				this.model.set( 'subsets', this.subsetCheckboxes.val(), { silent: true });
			}, 

			refresh: function( model, family ) {
				if( _.has( this.fonts, family ) ) {

					var variations = this.fonts[ family ].variants || [];
					var subsets    = this.fonts[ family ].subsets || [];

					this.variationDropdownView.update( _.object( variations, variations ), 'regular' );
					this.variationDropdownView.show();
					this.updateVariation();

					this.subsetCheckboxes.update( _.object( subsets, subsets ) );
					this.subsetCheckboxes.show();
					this.updateSubsets();

				} else {
					this.variationDropdownView.empty();
					this.variationDropdownView.hide();
					this.updateVariation();

					this.subsetCheckboxes.empty();
					this.subsetCheckboxes.hide();
					this.updateSubsets();
				}
			}, 

			updateSubsets: function() {
				this.model.set( 'subsets', this.subsetCheckboxes.val() );
			}
		});

		WebFontView.Typekit = WebFontViews.Typekit = api.Youxi.WebFontView.extend({
			refresh: function( model, family ) {
				var font = _.findWhere( this.fonts, { id: family } );
				if( ! _.isUndefined( font ) ) {
					this.variationDropdownView.update( font.variations || {}, 'n4' );
					this.variationDropdownView.show();
					this.updateVariation();
				} else {
					this.variationDropdownView.empty();
					this.variationDropdownView.hide();
					this.updateVariation();
				}
			}
		});

		$.extend( api.controlConstructor, { youxi_webfont: api.Youxi.WebFontControl });
	}

})( window.wp, jQuery );