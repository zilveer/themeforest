function initGridControls() {

	// create sortable rows
	jQuery('#GridWrapper').sortable({
		items: '.rowWrapper', 
		placeholder: 'layout-widget-placeholder',
		forcePlaceholderSize: true,
		revert: 300,
		delay: 100,
		opacity: 0.6,
		containment: '#GridWrapper',
		axis: "y",
		start: function (e,ui) {
			jQuery(ui.helper).addClass('dragging');
		},
		over: function (e,ui) {
			jQuery(window).trigger('resize');
		},
		stop: function (e,ui) {
			jQuery(ui.item).removeClass('dragging');
			jQuery(window).trigger('resize');
		}
	});

	// create sortable content elements
	jQuery('.column').sortable({
		items: '.content-element', 
		connectWith: '.column', 
		// handle: '.layout-container-head', 
		placeholder: 'layout-widget-placeholder',
		forcePlaceholderSize: true,
		revert: 300,
		delay: 100,
		opacity: 0.6,
		containment: '#GridWrapper',
		start: function (e,ui) {
			jQuery(ui.helper).addClass('dragging');
		},
		over: function (e,ui) {
			jQuery(window).trigger('resize');
		},
		stop: function (e,ui) {
			jQuery(ui.item).removeClass('dragging');
			jQuery(window).trigger('resize');
		}
	});

	} // End initGridControls()


// Plugin for layout grid builder
(function($, undefined) {

    $.fn.layoutGrid = function(options) {

        var settings = $.extend({
            sections: 12, 			// number of grid sections
            column_max: 4, 			// max columns in a row
            sections_min: 2, 	// minimum number of grid sections
            divider_width: 4,		// width of dividers in PX
        }, options || {});

		var _this       = this, 
		    divider_w   = settings.divider_width, 		// Width of draggable column dividers
		    grid_sections   = settings.sections, 			// Number of columns in this grid system
		    w_adj       = divider_w / 2 				// offest to account for divider width
		    
        $rows = this.find('.rowContainer');


        var self = $.extend(this, {

        	init: function() {
				
				// Hover effects on Add Element buttons
				self.on({
					mouseenter: function(e) { // considered using mouseOVER instead of ENTER because of drag tracking, but had other issues
						$(this).find('.add-element, .add-column').stop(true).delay(400).css('visibility','visible').animate({opacity:'.65'}, 375);
					},
					mouseleave: function(e) { // considered using mouseOVER instead of ENTER because of drag tracking, but had other issues
						$(this).find('.add-element, .add-column').stop(true).delay(350).animate({opacity:'0'}, 125, function() { $(this).css('visibility','hidden') });
					}
				}, '.rowWrapper'); // use .column to fade individually 

				// Click behaviors on responsive visibility settings
				self.on('click touchstart', '.responsive-visibility', function(e) { 
					
					// Toggle visibility
					if ($(e.target).hasClass('show-on')) {
						$(e.target).addClass('hide-on').removeClass('show-on');
					} else {
						$(e.target).addClass('show-on').removeClass('hide-on');
					}

					// suppress href link
					e.preventDefault()

				});

				// Click behaviors on Row delete
				self.on('click touchstart', '.delete-row', function(e) { 
					
					// remove row
					$row = $(e.target).closest('.rowWrapper');
					$row.remove();

					// suppress href link
					e.preventDefault()
					
					// Initialize everything again...
					self.update();
				});

				// Click behaviors on Column delete
				self.on('click touchstart', '.delete-column', function(e) { 
					
					// remove column
					$column = $(e.target).closest('.column');
					$column.next('.column-divider').andSelf().remove();

					// suppress href link
					e.preventDefault()
					
					// Initialize everything again...
					self.update();
				});

				// Click behaviors on Element delete
				self.on('click touchstart', '.delete-element', function(e) { 
					
					// remove column
					$(e.target).closest('.content-element').remove();

					// suppress href link
					e.preventDefault()
					
					// Initialize everything again...
					self.update();
				});

				// Add new element button event
				self.on('click touchstart', '.add-element', function(e) { 

					// Insert new element
					$(e.target).before( $('#ColumnTemplate').find('.content-element').clone() );
					// $(e.target).before( $('#RowTemplate').find('.content-element').clone() );

					// suppress href link
					e.preventDefault()

					// Initialize everything again...
					self.update();
				});

        		// Set actions on new row button
				self.new_row_event();

				// Set actions on new column buttons
				self.new_column_event();

				// Initialize functions in self.update()
        		self.update();

        	},

        	update: function(callback) {

        		// Update/Initialize controls (can be run many times)
        
        		// Update $rows object
        		$rows = this.find('.rowContainer');
				
				// attach drag and drop behaviors
        		initGridControls(); 

				// Create buttons and attach actions
				self.new_column_buttons();
				self.new_element_buttons();
				
				// update the grid dividers
        		$(window).trigger('resize');         		

        		if(callback) {
        			callback();
        		}
        		
        	},

			row_height: function() {
				
				$rows = this.find('.rowContainer');

				$rows.each( function(i, obj) {
					
					// the minimum setting (should match style sheet)
					min_height = 100; 
					h = 100;

					$columns = $(obj).find('.column');
					$columns.each( function(index, column) {
					h = $(column).css('min-height','0px').height();
					if (h > min_height) {
						min_height = h;
					}
				});

					$columns
						// .add( $(obj).find('.columnInner') )
						.add( $(obj) )
						.css('min-height',min_height+'px'); 	// columns
				});

			},

			column_width: function(e, ui) {

				$rows = this.find('.rowContainer');

				rightPos = $rows.width() - ui.position.left + w_adj; 	// [container width] - [spliter position] + [spliter width / 2]
				leftPos  = ui.position.left + w_adj; 					// [spliter position] + [spliter width / 2]

				// Column before divider
				$(ui.helper).prev().css('right', rightPos + 'px');
				// Column after divider
				$(ui.helper).next().css('left', leftPos + 'px');

			},

			refresh_display: function(e, ui) {
				self.column_width( e, ui ); 	// Adjust row widths
				self.row_height(); 				// Adjust row heights
			},

			limit: function(obj) {

				// Prevent dividers crossing over and force minimum width

				$parent = $(obj).closest('.rowWrapper');
				$parent.css('position','relative');

				$limit = $('#DragLimit');
				if ($limit.length) {
					$limit.detach();
				}
				$limit = $('<div id="DragLimit"></div>').appendTo($parent);

				$rows = this.find('.rowContainer');
				grid_minimum  = Math.floor($rows.width() / grid_sections) * settings.sections_min;

				limitOne = $(obj).prev().position().left + grid_minimum;
				limitTwo = parseInt($(obj).next().css('right')) + grid_minimum - w_adj;
				
				$limit.css({'left':limitOne+'px','right':limitTwo+'px'});

				return $limit;
			},

			new_element_buttons: function( column ) {

				// Add buttons to all rows, unless a parent row is specified (useful for new rows)
				$column = ($(column).length) ? $(column) : this.find('.column');

				$column.each( function(i,e) {

					if ( ! $(e).find('.add-element').length ) {
						
						// console.log($(e).find('.add-column').length);
						
						// add element button
						return $(e).append('<button class="add-element button">+</button>');
					}

				});

			},

			new_column_buttons: function( row_container ) {

				// Add buttons to all rows, unless a parent row is specified (useful for new rows)
				$row = ($(row_container).length) ? $(row_container) : this.find('.rowWrapper');

				$row.each( function(i,e) {

					if ( ! $(e).find('.add-column').length ) {
						
						// add container buttons
						$button_addToStart = $(e).append('<button class="add-to-start add-column button">+</button>');
						$button_addToEnd   = $(e).append('<button class="add-to-end add-column button">+</button>');
					}

				});

			},

			new_column_event: function() {

				var $newColumn = '';
				self.on('click touchstart', '.add-column', function(e) { 
					
					// Copy the template
					$newColumn = $('#ColumnTemplate').contents().clone();

					// Get the target row
					$row = $(e.target).parent().children('.rowContainer');

					// Attach new column
					if ($(e.target).hasClass('add-to-start')) {
						$newColumn.prependTo( $row );
						index = 0; grid_position = settings.sections_min;
						//$newColumn.find('.column-divider').data('item', { index: 0, grid_position: settings.sections_min });
					} else {
						$newColumn.appendTo( $row );
						index = grid_sections; grid_position = grid_sections;
						//$newColumn.find('.column-divider').data('item', { index: count + 1, grid_position: grid_sections });
					}

					// Flag the new item, to be removed on next grid refresh (useful for error checking)
					$newColumn.filter( ".column-divider" ).data( 'status', 'new');

					$dividers = $row.children( ".column-divider" ); 
					count     = $dividers.length;
					section_width  = Math.floor($row.width() / grid_sections);
				    min_width   = settings.sections_min * section_width;

				    $dividers.each( function(i,e) {

						$(e).removeData('item');
						// console.log( i, $(e).data());
				    });

					// suppress href link
					e.preventDefault()

					// Initialize everything again...
					self.update();

				});

				return $newColumn;
			},

			new_row_event: function() {

				var $newRow = '';
				$('#AddNewRow').bind('click touchstart', function(e) {
				
					// Copy the template and add to end of grid
					$newRow = $('#RowTemplate .rowWrapper').clone().insertBefore( $('#GridEnd') );
					$newColumn = $('#ColumnTemplate').contents().clone();
					
					$newRow.find('.rowContainer').append($newColumn.clone());
					$newRow.find('.rowContainer').append($newColumn.clone());		

					// suppress href link
					e.preventDefault()

					// Initialize everything again...
					self.update();
					self.new_column_buttons($newRow);

				});

				return $newRow;
			}
        });

		self.init();

		$(window).resize(function() {

			$rows = _this.find('.rowContainer');

			// Creat the grid and apply drag actions to dividers
			$rows.each( function(index, object) {

				$_obj = $(object);
				$columns = $_obj.children('.column');  							// Find columns
				$dividers = $_obj.children( ".column-divider" ); 				// Find dividers
				section_width  = Math.floor($_obj.width() / grid_sections); 	// individual grid section width
				min_width  = settings.sections_min * section_width; 			// smallest column size allowed (default 2 grid sections)
		    	count     = $dividers.length;
				spacing   = Math.floor(grid_sections / count); 	// default divider spacing for equal sections (not column width)

				// -------------------------------------------------------
				// TODO: Disable new column buttons when max is reached.
				// -------------------------------------------------------

				// Check that we don't have too many columns
				if (spacing < settings.sections_min) {

					// Too many columns. 
					// 1. Look for a new element just added.
					// 2. Delete last element if none are new.
					
					$extra = $dividers.filter(function() { return $.data(this, 'status') == 'new'; }).first(); // 1
					if (!$extra.length) $extra = $dividers.last(); // 2
					
					// console.log( 'Removing status: ', $extra.data('status'));
					
					// Remove the extra and it's divider
					$extra.add( $extra.prev('.column') ).remove();

					// Nothing else to do in this row because it shouldn't have changed.
					return true; // like continue;
				}

				// A few styling and layout specific things
				// ----------------------------------------------------------------

				// Set some CSS styles on the row
				$_obj.css('position','relative');

				// Force last column and divider to right edge (and all others auto)
				$columns.css('right','initial').last().css('right', '0px');
				// Clear first left value (needed when deleting the first column)
				$columns.first().css('left', '0px');

				// Assign .is-empty class to columns without any elements
				$columns.each( function(i,e) {
					if ($(e).find('.content-element').length) {
						$(e).removeClass('is-empty');
					} else {
						$(e).addClass('is-empty');
					}

				});

				// Last divider positioned right and hidden (and all others normal)
				$dividers.css({
					'right' : 'initial',
					'display' : 'block'
				}).last().css({
					'right' : '0px',
					'display' : 'none'
				});

				// Position dividers and bind drag events
				// ----------------------------------------------------------------
				$dividers.each( function(i, obj) {

					// some variables
					$itemData = ($.hasData(obj)) ? $(obj).data('item') : false; 	// Check for saved data
					grid_position = ($itemData) ? $itemData.grid_position : spacing * (i + 1); 	// position by section count
					left_position = grid_position * section_width; 	// pixel position of divider
				
					// Stop here if thisis the last divider
					if (i == $dividers.length-1) {
						isLast = true;
						grid_position = 12;  // force to last position
					} else {
						isLast = false;
					}
					// console.log('Spacing: ' + spacing);

					// Update data
					$(obj).data({
						// Store data? Index is going to be dynamic so... must be updated each run
						item : {
							index: i, 		// divider count in order
							grid_position: grid_position 	// Position of divider
						},
						status : ''
					});

					// console.log( $(obj).data('item').grid_position, grid_position);
				
					// Stop here if thisis the last divider
					if (isLast) return true; // Go no further!


					// Attach common styling and drag events
					$(obj).css({
						'width' : divider_w + 'px',
						'margin-left' : - w_adj + 'px',
						'left' : left_position + 'px'
					}).bind('touchstart mousedown', function(e){
						self.limit(obj);
					})
					.draggable({ 
						axis: "x", 
						cursor: "w-resize",
						containment: '#DragLimit',
						grid: [ section_width, section_width ],
						drag: function( e, ui ) { 
							self.refresh_display( e, ui );
						},
						start: function( e, ui ) { 
							// starting offset px
							origin = ui.offset.left;
						},
						stop: function( e, ui ) { 
							self.refresh_display( e, ui );

							// ending offset px
							end = ui.offset.left;

							// Update grid position data
							$item = ui.helper.data('item');
							newPosition = parseInt($item.grid_position) + Math.round((parseInt(end) - parseInt(origin)) / parseInt(section_width));
							$item.grid_position = newPosition;
						}
					});

					// console.log( 'refresh: ', i, $(obj).data('item'), $(obj).data());
					
					ui = { helper: $(obj), position : $(obj).position() };
					self.refresh_display( null, ui );

				});
			});

		});


		$(window).trigger('resize');

        return self;
    };
})(jQuery);