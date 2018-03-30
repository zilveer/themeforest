/** START BACKBONE APP */
var $ = require( 'jQuery' );
window.ZnFb = window.ZnFb || {};

	ZnFb = {
		"Models" : {},
		"Collections" : {},
		"Views" : {},
		"Utils" : {}, // Utility functions
		"Events" : _.extend({}, Backbone.Events),
	};

	// PB EDITOR ELEMENTS
	ZnFb.Models.EditorElement = Backbone.Model.extend({
		defaults : {
			category : {},
			name : "My element",
			class : "ElementClass",
			level : "3",
			icon : ""
		}
	});

	ZnFb.Collections.EditorElements = Backbone.Collection.extend({
		model : ZnFb.Models.EditorElement
	});

	ZnFb.Views.EditorElements = Backbone.View.extend({

		initialize : function(){

			var that = this;
			// Custom events outside view
			$('.zn_pb_search').on('change keyup input', function(e){
				that.makeSearch( e, that );
			});

			$(document).on( 'click', '.zn_pb_no_content', function(e){
				that.filterAddElements( e );
				// On add content, focus on search field too
				$('.zn_pb_search').focus();
			});

			ZnFb.Events.on( 'click:sidebarMenu', function(e){
				that.menuFilter( e, that );
			});

		},

		render : function(){
			var container = document.createDocumentFragment();
			this.collection.each( function(element){
				// Don't show legacy elements
				if( ! element.get('legacy') ){
					var elementView = new ZnFb.Views.EditorElement({ model : element });
					container.appendChild( elementView.render().el );
				}

			}, this);
			this.$el.append(container);
			this.launchIsotope();

			return this;
		},

		launchIsotope : function(){
			this.$el.isotope({
				resizesContainer: false,
				layoutMode: 'fitRows',
				getSortData: {
					znname: '[data-znname]'
				},
				sortBy : 'znname'
			});
		},

		menuFilter : function( e, that ){

			var clickedEl = $(e.currentTarget),
				selector = clickedEl.attr('data-filter');

			that.$el.isotope({ filter: selector} );

			$('.zn_pb_groups a').removeClass('zn_pb_selected');
			clickedEl.addClass('zn_pb_selected');

		},

		makeSearch : function( e ) {

			var kwd = $(e.currentTarget).val().toLowerCase();

			if ( ( kwd !== '' ) && ( kwd.length >= 2 ) ) { // min 2 chars to execute query:

				// Show the PB editor
				$.page_builder.show_editor();
				$('.zn_pb_add_el').trigger('click');

				// add appropriate classes and call isotope.filter
				this.$el.isotope({
					filter: function(){
						var keywords = $(this).find('.zn_pb_element').data('keywords').split(',');
						for( var i = 0; i < keywords.length; i++ ){
							if( keywords[i].toLowerCase().trim().indexOf(kwd) !== -1){
								return true;
							}
						}
					}
				});

			} else {
				// show all if keyword less than 2 chars
				this.$el.isotope({ filter: '*' });
			}

			$('.zn_pb_groups li a').removeClass('zn_pb_selected');
			$('.zn_pb_all').addClass('zn_pb_selected');
		},

		filterAddElements : function( e, that ){

			e.preventDefault();

			$.page_builder.show_editor();
			var level = parseInt( $(e.currentTarget).attr('data-droplevel') );

			this.$el.isotope({ filter: function() {

				var number = $(this).children().data('level');

				// If we need to place columns
				if ( level == 1  ) {
					return $(this).children().data('object') == 'ZnColumn';
				}
				// If we need to place elements except columns
				else {
					if ( $(this).children().data('object') == 'ZnColumn' ) {
						return false;
					}
					else{
						return parseInt( number ) > level;
					}
				}

			}});
		},
	});

	ZnFb.Views.EditorElement = Backbone.View.extend({

		tagName : "div",

		template: wp.template('znfb-pbelement-content'),

		attributes : function(){
			return {
				'class' : "zn_pb_element_container "+ this.model.get('category').replace( ",", " " ).toLowerCase() + " filter_level_" + ( this.model.get('level') - 1 ) ,
				'data-znname' : this.model.get('name')
			};
		},

		render : function(){
			this.$el.html( this.template( this.model.toJSON() ) );
			this.enableDraggable();
			return this;
		},
		enableDraggable: function(){
			var that = this,
				fw = $.page_builder;

			this.$('.zn_pb_element').draggable(fw.get_draggable_options( this.model.get('level') ));
		}
	});

	/* SIDEBAR MENU */
	ZnFb.Models.EditorSidebarMenuItem = Backbone.Model.extend({
		defaults : {
			name : "Menu name",
			filter : "*",
			css_class : ''
		}
	});

	ZnFb.Collections.EditorSidebarMenuItems = Backbone.Collection.extend({
		model : ZnFb.Models.EditorSidebarMenuItem
	});

	ZnFb.Views.EditorSidebarMenu = Backbone.View.extend({

		render : function(){
			var container = document.createDocumentFragment();
			this.collection.each( function(element){
				var elementView = new ZnFb.Views.EditorSidebarMenuItem({ model : element });
				container.appendChild( elementView.render().el );
			}, this);
			this.$el.append(container);

			return this;
		}
	});

	ZnFb.Views.EditorSidebarMenuItem = Backbone.View.extend({
		tagName : 'li',

		events: {
			'click a': 'onMenuSelect'
		},

		template : wp.template('znfb-pbsidebar-content'),

		render : function(){
			this.$el.html( this.template( this.model.toJSON() ) );
			return this;
		},

		onMenuSelect : function( e ){
			e.preventDefault();
			ZnFb.Events.trigger( 'click:sidebarMenu', e);
		}
	});


	// Main view
	ZnFb.Views.EditorPbTab = Backbone.View.extend({

		el : '#zn_pb_content',

		template : wp.template('znfb-editorpbtab-content'),

		render : function(){

			this.$el.append( this.template() );

			this.sidebar = new ZnFb.Views.EditorSidebarMenu({ collection : new ZnFb.Collections.EditorSidebarMenuItems( $.ZnPbFactory.pb_menu ) });
			this.content = new ZnFb.Views.EditorElements({ collection : new ZnFb.Collections.EditorElements( $.ZnPbFactory.elements_data ) });

			this.assign( this.sidebar,        '.zn_pb_groups');
			this.assign( this.content,        '.zn_pb_tab_content');

			return this;
		},

		assign : function (view, selector) {
			view.setElement(this.$(selector)).render();
		}
	});

	var EditorPbTab = new ZnFb.Views.EditorPbTab().render();

