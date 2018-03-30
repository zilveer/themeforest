

(function($, $window, $document, undefined){

	"use strict";

	var menu = ait.admin.menu = {


		overrideMenuSortable: function()
		{
			var api = wpNavMenu;
			$.extend(wpNavMenu, {
				initSortables: function() {
					var currentDepth = 0, originalDepth, minDepth, maxDepth,
						prev, next, prevBottom, nextThreshold, helperHeight, transport,
						menuEdge = api.menuList.offset().left,
						body = $('body'), maxChildDepth,
						menuMaxDepth = initialMenuMaxDepth();

					if( 0 !== $( '#menu-to-edit li' ).length )
						$( '.drag-instructions' ).show();

					// Use the right edge if RTL.
					menuEdge += api.isRTL ? api.menuList.width() : 0;

					api.menuList.sortable({
						handle: '.menu-item-handle',
						placeholder: 'sortable-placeholder',
						start: function(e, ui) {
							var height, width, parent, children, tempHolder;

							// handle placement for rtl orientation
							if ( api.isRTL )
								ui.item[0].style.right = 'auto';

							transport = ui.item.children('.menu-item-transport');

							// Set depths. currentDepth must be set before children are located.
							originalDepth = ui.item.menuItemDepth();
							updateCurrentDepth(ui, originalDepth);

							// Attach child elements to parent
							// Skip the placeholder
							parent = ( ui.item.next()[0] == ui.placeholder[0] ) ? ui.item.next() : ui.item;
							children = parent.childMenuItems();
							transport.append( children );

							// Update the height of the placeholder to match the moving item.
							height = transport.outerHeight();
							// If there are children, account for distance between top of children and parent
							height += ( height > 0 ) ? (ui.placeholder.css('margin-top').slice(0, -2) * 1) : 0;
							height += ui.helper.outerHeight();
							helperHeight = height;
							height -= 2; // Subtract 2 for borders
							ui.placeholder.height(height);

							// Update the width of the placeholder to match the moving item.
							maxChildDepth = originalDepth;
							children.each(function(){
								var depth = $(this).menuItemDepth();
								maxChildDepth = (depth > maxChildDepth) ? depth : maxChildDepth;
							});
							width = ui.helper.find('.menu-item-handle').outerWidth(); // Get original width
							width += api.depthToPx(maxChildDepth - originalDepth); // Account for children
							width -= 2; // Subtract 2 for borders
							ui.placeholder.width(width);

							// Update the list of menu items.
							tempHolder = ui.placeholder.next();
							tempHolder.css( 'margin-top', helperHeight + 'px' ); // Set the margin to absorb the placeholder
							ui.placeholder.detach(); // detach or jQuery UI will think the placeholder is a menu item
							$(this).sortable( 'refresh' ); // The children aren't sortable. We should let jQ UI know.
							ui.item.after( ui.placeholder ); // reattach the placeholder.
							tempHolder.css('margin-top', 0); // reset the margin

							// Now that the element is complete, we can update...
							updateSharedVars(ui);
						},
						stop: function(e, ui) {

							/* AIT BLOCK START */
							// some restrictions where can be items (and columns) placed in megamenu (i.e. columns only in 1-st level)

							if (ui.item.hasClass('menu-item-column') && !ui.placeholder.hasClass('menu-item-depth-1')) {
								$(this).sortable('cancel');
								return;
							} else if (transport.children().hasClass('menu-item-column') && !ui.placeholder.hasClass('menu-item-depth-0')) {
								$(this).sortable('cancel');
								return;
							} else if (!ui.item.hasClass('menu-item-column') && ui.placeholder.hasClass('menu-item-depth-1') && (ui.item.nextUntil('.menu-item-depth-0').hasClass('menu-item-column') || ui.item.prevUntil('.menu-item-depth-0').hasClass('menu-item-column'))) {
								$(this).sortable('cancel');
								return;
							} else if (ui.item.hasClass('menu-item-column') && ui.placeholder.hasClass('menu-item-depth-1')) {
								if (ui.item.nextUntil('.menu-item-depth-0').length && !ui.item.nextUntil('.menu-item-depth-0').hasClass('menu-item-column')) {
									$(this).sortable('cancel');
									return;
								} else if (ui.item.prevUntil('.menu-item-depth-0').length && !ui.item.prevUntil('.menu-item-depth-0').hasClass('menu-item-column')) {
									$(this).sortable('cancel');
									return;
								}
							}

							/* AIT BLOCK END */

							var children, subMenuTitle,
								depthChange = currentDepth - originalDepth;

							// Return child elements to the list
							children = transport.children().insertAfter(ui.item);

							// Add "sub menu" description
							subMenuTitle = ui.item.find( '.item-title .is-submenu' );
							if ( 0 < currentDepth )
								subMenuTitle.show();
							else
								subMenuTitle.hide();

							// Update depth classes
							if ( 0 !== depthChange ) {
								ui.item.updateDepthClass( currentDepth );
								children.shiftDepthClass( depthChange );
								updateMenuMaxDepth( depthChange );
							}
							// Register a change
							api.registerChange();
							// Update the item data.
							ui.item.updateParentMenuItemDBId();

							/* AIT BLOCK START */
							menu.updateRootMenuItemsControls();
							/* AIT BLOCK END */

							// address sortable's incorrectly-calculated top in opera
							ui.item[0].style.top = 0;

							// handle drop placement for rtl orientation
							if ( api.isRTL ) {
								ui.item[0].style.left = 'auto';
								ui.item[0].style.right = 0;
							}

							api.refreshKeyboardAccessibility();
							api.refreshAdvancedAccessibility();

						},
						change: function(e, ui) {
							// Make sure the placeholder is inside the menu.
							// Otherwise fix it, or we're in trouble.
							if( ! ui.placeholder.parent().hasClass('menu') )
								(prev.length) ? prev.after( ui.placeholder ) : api.menuList.prepend( ui.placeholder );

							updateSharedVars(ui);
						},
						sort: function(e, ui) {
							var offset = ui.helper.offset(),
								edge = api.isRTL ? offset.left + ui.helper.width() : offset.left,
								depth = api.negateIfRTL * api.pxToDepth( edge - menuEdge );
							// Check and correct if depth is not within range.
							// Also, if the dragged element is dragged upwards over
							// an item, shift the placeholder to a child position.
							if ( depth > maxDepth || offset.top < prevBottom ) depth = maxDepth;
							else if ( depth < minDepth ) depth = minDepth;

							if( depth != currentDepth )
								updateCurrentDepth(ui, depth);

							// If we overlap the next element, manually shift downwards
							if( nextThreshold && offset.top + helperHeight > nextThreshold ) {
								next.after( ui.placeholder );
								updateSharedVars( ui );
								$( this ).sortable( 'refreshPositions' );
							}
						}
					});

					function updateSharedVars(ui) {
						var depth;

						prev = ui.placeholder.prev();
						next = ui.placeholder.next();

						// Make sure we don't select the moving item.
						if( prev[0] == ui.item[0] ) prev = prev.prev();
						if( next[0] == ui.item[0] ) next = next.next();

						prevBottom = (prev.length) ? prev.offset().top + prev.height() : 0;
						nextThreshold = (next.length) ? next.offset().top + next.height() / 3 : 0;
						minDepth = (next.length) ? next.menuItemDepth() : 0;

						if( prev.length )
							maxDepth = ( (depth = prev.menuItemDepth() + 1) > api.options.globalMaxDepth ) ? api.options.globalMaxDepth : depth;
						else
							maxDepth = 0;
					}

					function updateCurrentDepth(ui, depth) {
						ui.placeholder.updateDepthClass( depth, currentDepth );
						currentDepth = depth;
					}

					function initialMenuMaxDepth() {
						if( ! body[0].className ) return 0;
						var match = body[0].className.match(/menu-max-depth-(\d+)/);
						return match && match[1] ? parseInt( match[1], 10 ) : 0;
					}

					function updateMenuMaxDepth( depthChange ) {
						var depth, newDepth = menuMaxDepth;
						if ( depthChange === 0 ) {
							return;
						} else if ( depthChange > 0 ) {
							depth = maxChildDepth + depthChange;
							if( depth > menuMaxDepth )
								newDepth = depth;
						} else if ( depthChange < 0 && maxChildDepth == menuMaxDepth ) {
							while( ! $('.menu-item-depth-' + newDepth, api.menuList).length && newDepth > 0 )
								newDepth--;
						}
						// Update the depth class.
						body.removeClass( 'menu-max-depth-' + menuMaxDepth ).addClass( 'menu-max-depth-' + newDepth );
						menuMaxDepth = newDepth;
					}
				},


				removeMenuItem : function(el) {
					var children = el.childMenuItems();

					/* AIT BLOCK START */
					el.addClass('deleting').animate({
						opacity : 0,
						height: 0
					}, 350, function() {
						var ins = $('#menu-instructions');

						if (el.hasClass('menu-item-column')) {
							var $parentMenuItem = el.prevAll('.menu-item-depth-0').first();
							el.remove();
							var $siblings = $parentMenuItem.childMenuItems();
							if ($siblings.length) {
								if ($siblings.hasClass('menu-item-column')) {
									children.detach();
									var $lastColumn = $siblings.filter('.menu-item-column').last();
									var $lastColumnMenuItems = $lastColumn.childMenuItems();
									if ($lastColumnMenuItems.length) {
										$lastColumnMenuItems.last().after(children)
									} else {
										$lastColumn.after(children);
									}
								} else {
									children.shiftDepthClass(-1);
								}
							}
							menu.updateMenuItemControls($parentMenuItem);
						} else if (children.hasClass('menu-item-column')) {
							$.each(children, function(i, child) {
								if ($(child).hasClass('menu-item-column')) {
									var $column = $(child);
									var $columnMenuItems = $column.childMenuItems();
									$columnMenuItems.shiftDepthClass(-2);
									$.each($columnMenuItems, function() {
										menu.updateMenuItemControls($(this));
									});
									$column.remove();
								}
							});
							el.remove();
						} else {
							children.shiftDepthClass(-1);
							$.each(children, function() {
								menu.updateMenuItemControls($(this));
							});
							el.remove();
						}

						children.updateParentMenuItemDBId();
						if ( 0 === $( '#menu-to-edit li' ).length ) {
							$( '.drag-instructions' ).hide();
							ins.removeClass( 'menu-instructions-inactive' );
						}
					});
					/* AIT BLOCK END */
				}
			});
		},



		init: function()
		{
			menu.updateRootMenuItemsControls();
			menu.handleAddColumnActions();
		},







		handleAddColumnActions: function()
		{
			$('.menu').on('click', '.add-column', function(e) {
				var $parentMenuItem = $('#' + $(this).data('menu-item'));
				menu.addColumnToItem($parentMenuItem);
			});
		},



		addColumnToItem: function($parentMenuItem)
		{
			var columnItemData = menu.getColumnItemData($('#' + $parentMenuItem.attr('id')  + '-column'));
			menu.addItemToMenu(columnItemData, function(menuItemMarkup) {
				var $menuItemMarkup = $(menuItemMarkup).hideAdvancedMenuItemFields();
				var $childMenuItems = $parentMenuItem.childMenuItems();
				if (!$childMenuItems.length) {
					$parentMenuItem = $parentMenuItem.after($menuItemMarkup);
				} else {
					if ($childMenuItems.hasClass('menu-item-column')) {
						$childMenuItems.last().after($menuItemMarkup);
					} else {
						// child menu items are not in columns (there are no columns yet), move them to newly created column
						$parentMenuItem = $parentMenuItem.after($menuItemMarkup);
						$childMenuItems.shiftDepthClass(1);
						$childMenuItems.updateParentMenuItemDBId();
					}
				}
				menu.updateMenuItemControls($parentMenuItem);
			});
		},



		updateRootMenuItemsControls: function()
		{
			$.each($('.menu-item-depth-0'), function() {
				menu.updateMenuItemControls($(this));
			});
		},



		updateMenuItemControls: function($menuItem)
		{
			var $subMenuPositionField = $menuItem.find('.field-submenu-position').first();
			var $addColumnActionLink = $menuItem.find('.item-add-column-action').first();

			if ($menuItem.hasClass('menu-item-depth-0')) {
				$subMenuPositionField.removeClass('hidden');
				$addColumnActionLink.removeClass('hidden');
				if ($menuItem.childMenuItems().hasClass('menu-item-column')) {
					$subMenuPositionField.find('option.only-if-has-columns').removeAttr('disabled');
				} else {
					menu.disableContentPositionsOptionsFromSubMenuPositionSelect($subMenuPositionField.find('select'));
				}
			} else {
				$subMenuPositionField.addClass('hidden');
				$addColumnActionLink.addClass('hidden');
				menu.disableContentPositionsOptionsFromSubMenuPositionSelect($subMenuPositionField.find('select'));
			}
		},



		disableContentPositionsOptionsFromSubMenuPositionSelect: function($subMenuPositionSelect)
		{
			$subMenuPositionSelect.find('option.only-if-has-columns').attr('disabled', 'disabled');
			if (!$subMenuPositionSelect.val()) {
				$subMenuPositionSelect.find('option:first').prop('selected', 'selected');
			}
		},



		addItemToMenu : function(menuItem, callback) {
			var menu = $('#menu').val(),
				nonce = $('#menu-settings-column-nonce').val(),
				params;


			params = {
				'action': 'add-menu-item',
				'menu': menu,
				'menu-settings-column-nonce': nonce,
				'menu-item': [menuItem]
			};

			$.post( ajaxurl, params, function(menuItemMarkup) {
				menuItemMarkup = $.trim( menuItemMarkup ); // Trim leading whitespaces
				callback(menuItemMarkup);
			});
		},


		getColumnItemData : function($columnItem) {
			var itemData = {}, i,
				fields = [
					'menu-item-db-id',
					'menu-item-object-id',
					'menu-item-object',
					'menu-item-parent-id',
					'menu-item-position',
					'menu-item-type',
					'menu-item-title',
					'menu-item-url',
					'menu-item-description',
					'menu-item-attr-title',
					'menu-item-target',
					'menu-item-classes',
					'menu-item-xfn'
				];

			var	id = $columnItem.find('.menu-item-data-db-id').val();

			if( !id ) return itemData;

			$columnItem.find('input').each(function() {
				var field;
				i = fields.length;
				while ( i-- ) {
					field = 'menu-item[' + id + '][' + fields[i] + ']';
					if (
						this.name &&
						field == this.name
					) {
						itemData[fields[i]] = this.value;
					}
				}
			});

			return itemData;
		}


	};

	if (typeof wpNavMenu !== 'undefined') {
		// do not wait until page is loaded, we need to override 'initSortable' function of wpNavMenu before it is called
		ait.admin.menu.overrideMenuSortable();

		$(function(){
			ait.admin.menu.init();
		});

	}


})(jQuery, jQuery(window), jQuery(document));


