

ait.admin.options.elements = ait.admin.options.elements || {};

(function($, $window, $document, undefined)
{

	"use strict";

	var $context = $('.ait-options-page');
    var $usedElementsContentsArea = $('#ait-used-elements-contents');
    var $unsortableArea = $('#ait-used-elements-unsortable');
	var $sortableArea = $('#ait-used-elements-sortable');
	var $availableElements = $('#ait-available-elements').find('.ait-available-element:not(.ait-element-disabled)');
	var $elementsWithSidebarsContainer = $('#ait-elements-with-sidebars-background');
	var $elementsWithSidebarsStartBoundary = $sortableArea.find('.ait-sidebars-boundary-start');
	var $elementsWithSidebarsEndBoundary = $sortableArea.find('.ait-sidebars-boundary-end');
	var $elementsWithDetachedOptions = [];

    var changesMade = false;

	/**
	 * ait.admin.options.elements.Data
	 *
	 * Handle data manipulation for Elements and other on "Pages Options" page
	 */
	var data = ait.admin.options.elements.Data = {



        changesMade: function()
        {
            changesMade = true;
        },



		save: function()
		{
			ait.admin.publish('ait.options.save', ['working']);

            data.saveEditors();

            var serializedData;
            serializedData = data.serializePageOptions();
            serializedData += '&' + data.serializeUsedUnsortableElements();
            serializedData += '&' + data.serializeUsedSortableElements();
            serializedData = data.postprocessFormData(serializedData);

            ait.admin.ajax.post("savePagesOptions", serializedData, function(response)
            {
                if (response.success)
                    ait.admin.publish('ait.options.save', ['done']);
                else
                    ait.admin.publish('ait.options.save', ['error']);
            });

            changesMade = false;
		},



        saveEditors: function()
        {
            try {
                $.each(tinyMCE.editors, function(i, ed)
                {
                    if (!ed.isHidden())
                        ed.save();
                });
            } catch (ex) {
            }
        },



        serializePageOptions: function()
        {
            return $('#ait-options-form').serialize();
        },




        serializeUsedUnsortableElements: function()
        {
            var serializedUsedUnsortableElements = '';

            $unsortableArea.find('> .ait-element').each(function(i, e)
            {
                var $element = $(this);

                if (i > 0) {
                    serializedUsedUnsortableElements += '&';
                }

                serializedUsedUnsortableElements += data.serializeElementContent($element);
            });

            return serializedUsedUnsortableElements;
        },




        serializeUsedSortableElements: function()
        {
            var serializedUsedSortableElements = '';

            $sortableArea.find('> .ait-element').each(function(i, e)
            {
                var $element = $(this);

                if (i > 0) {
                    serializedUsedSortableElements += '&';
                }

                serializedUsedSortableElements += data.serializeElementContent($element);

                if (ui.isColumnsElement($element)) {
                    ui.getElementContent($element).find('.ait-element').each(function(j, el)
                    {
                        serializedUsedSortableElements += '&';
                        serializedUsedSortableElements += data.serializeElementContent($(this));
                    });
                }
            });

            return serializedUsedSortableElements;
        },



        serializeElementContent: function($element)
        {
            var $elementContent = ui.getElementContent($element);

            var $formInputs = $elementContent.find('input, textarea, select');

            if (ui.isColumnsElement($element)) {
                // do not serialize form inputs of element opened in columns editor
                $formInputs = $formInputs.not('.ait-columns-editor input, .ait-columns-editor textarea, .ait-columns-editor select ')
            }

            return $formInputs.serialize();
        },



        postprocessFormData: function(formData)
        {
            return formData.replace(/__[a-zA-Z0-9]+__/g, function(x)
            {
                return x.replace(/_/g, '');
            });
        },




		removeElement: function()
		{
            data.changesMade();
		},



		updateSortableElementPositionInfo: function($element)
		{
            var $elementContent = ui.getElementContent($element);

            if (ui.isElementInColumn($element)) {
                var $columnsElement = ui.getColumnsElementContainingElement($element);
                var $column = $element.parents('.ait-column');
            }

            var $columnsElementIndexInput = $elementContent.find('[name*="@columns-element-index"]');
            if ($columnsElement !== undefined) {
                $columnsElementIndexInput.attr('value', ui.getElementIndex($columnsElement));
            } else {
                $columnsElementIndexInput.attr('value', ''); // not in columns element
            }

            var $columnsElementColumnIndexInput = $elementContent.find('[name*="@columns-element-column-index"]');
            if ($columnsElement !== undefined) {
                $columnsElementColumnIndexInput.attr('value', $column.index());
            } else {
                $columnsElementColumnIndexInput.attr('value', ''); // not in column
            }
		},



        createElementContent: function($element)
        {
            var $elementContent = ui.getElementContentPrototype($element).clone();
            $elementContent.attr('id', $elementContent.attr('id').replace('-prototype', ''));
            $usedElementsContentsArea.append($elementContent);
        },



        updateElementIndexes: function($element)
        {
            var index = data.getNextElementIndex();


            var $elementContent = ui.getElementContent($element);

            var eid = ait.admin.utils.getDataAttr($element, 'element-id').replace(/__\d+__/, "__" + index + "__");

            $element.attr('id', eid);
            $element.data('ait-element-id', eid);
            $element.data('ait-element-content-id', eid + '-content');

            $elementContent.attr('id', eid + '-content');
            $elementContent.data('ait-element-id', eid);

            var $attributesSelector = '[name*="__"], [id*="__"], [idtemplate*="__"], [nametemplate*="__"],  [class*="__"], [for*="__"], [href*="__"], [data-editor*="__"]';
            $elementContent.find($attributesSelector)
                .add($.each($element.find('iframe'), function() { return $(this).contents().find($attributesSelector); } ))
                .each(function(j, e)
                {
                    var $e = $(e);
                    var name = $e.attr('name');
                    var id = (!$e.hasClass('ait-element')) ? $e.attr('id') : undefined;
                    var forAttr = $e.attr('for');
                    var href = $e.attr('href');
                    var idtemplate = $e.attr('idtemplate');
                    var nametemplate = $e.attr('nametemplate');
                    var dataEditor = $e.attr('data-editor');
                    var columnsElementIndex = ($e.attr('name') && $e.attr('name').indexOf("@columns-element-index") > 0) ? $e.attr('value') : undefined;
                    var columnsElementColumnIndex = ($e.attr('name') && $e.attr('name').indexOf("@columns-element-column-index") > 0) ? $e.attr('value') : undefined;

                    if (name !== undefined)
                        $e.attr('name', name.replace(/__\d+__/, "__" + index + "__"));

                    if (id !== undefined) {
                        $e.attr('id', id.replace(/__\d+__/, "__" + index + "__"));
                    }

                    if (forAttr !== undefined)
                        $e.attr('for', forAttr.replace(/__\d+__/, "__" + index + "__"));

                    if (href !== undefined)
                        $e.attr('href', href.replace(/__\d+__/, "__" + index + "__"));

                    if (idtemplate !== undefined)
                        $e.attr('idtemplate', idtemplate.replace(/__\d+__/, "__" + index + "__"));

                    if (nametemplate !== undefined)
                        $e.attr('nametemplate', nametemplate.replace(/__\d+__/, "__" + index + "__"));

                    if (dataEditor !== undefined)
                        $e.attr('data-editor', dataEditor.replace(/__\d+__/, "__" + index + "__"));

                    if (columnsElementIndex !== undefined) {
                        // $e refers to hidden input of element appended in column
                        var $columnsElement = $($e.parents('.ait-element').get(1)); // get columns element if exists

                        if ($columnsElement.length) {
                            $e.attr('value', ui.getElementIndex($columnsElement));
                        } else {
                            $e.attr('value', ''); // not in column
                        }
                    }

                    if (columnsElementColumnIndex !== undefined) {
                        // $e refers to hidden input of element appended in column
                        var $columnElement = $($e.closest('.ait-column')); // get column if exists
                        if ($columnElement.length) {
                            $e.attr('value', $columnElement.index());
                        } else {
                            $e.attr('value', ''); // not in column
                        }
                    }
                });

        },



		updateColumnsElementLayout: function($columnsElement, layout)
		{
            var $elementContent = ui.getElementContent($columnsElement);

			if (layout.gridCssClass) {
                $elementContent.find('input[id*="grid-css-class"]').attr('value', layout.gridCssClass);
			}

			if (layout.columnsCssClasses.length) {
                $elementContent.find('input[id*="columns-css-classes"]').attr('value', layout.columnsCssClasses);
			}

            $.each($columnsElement.find('.ait-row-content .ait-element'), function() {
                data.updateSortableElementPositionInfo($(this));
            });
            ui.updateElementsWithSidebarsBackground();
            data.changesMade();
		},



        getNextElementIndex: function()
        {
			return '_e' + Math.random().toString(16).slice(2);
        }

	};



	/**
	 * ait.admin.options.elements.Ui
	 *
	 * Binds events and manipulate with UI of the elements
	 */
	var ui = ait.admin.options.elements.Ui = {



		$draggedElement: null,
		draggableSize: { width: 0, height: 0 },



		init: function()
		{
			ui.bindEvents();
			ui.basicAdvancedTabs();
			ui.initColumnsElements();
			ui.sortables();
			ui.droppables();
			ui.draggables();
			ui.resetCursorPositionOfDraggables();
			ui.initSidebarsBoundaryElements();
		},



		bindEvents: function()
		{
			$('.ait-save-pages-options').on('click', ui.save);
			$context.on('click', '#ait-used-elements .ait-element-handler, #ait-used-elements .ait-element-close ', ui.onToggleElement);
			$context.on('click', '#ait-used-elements .ait-element-remove', ui.onRemoveElement);
			$context.on('click', '#ait-used-elements span.ait-element-user-description', ui.onElementUserDescriptionClick);
			$context.on('blur', '#ait-used-elements input.ait-element-user-description', ui.onElementUserDescriptionBlur);
			$context.on('keydown', '#ait-used-elements input.ait-element-user-description', ui.onElementUserDescriptionKeydown);
			$context.on('change', 'select[name*="sidebar"]', ui.initSidebarsBoundaryElements);
			$window.on('resize', ui.resetCursorPositionOfDraggables);
            $window.on('beforeunload', function() {
                if (changesMade) {
                    return $('.ait-options-page').data('unsaved-changes-message');
                }
            });
		},



		sortables: function()
		{
			$sortableArea.sortable({
				connectWith: '.ait-column-content',
				placeholder: 'ait-used-elements-droppable-placeholder',
				handle: '.ait-element-handler',
                appendTo: "#ait-available-elements",
				forcePlaceholderSize: true,
				distance: 15,
				scrollSensitivity: 50,
				cursorAt: {
					left: Math.floor(ui.draggableSize.width / 2),
					top: Math.floor(ui.draggableSize.height / 2)
				},
				start: ui.onSortingStart,
				stop: ui.onSortingStop
			});


		},



		droppables: function()
		{
			$sortableArea.droppable({
				accept: '.ait-element',
				activate: function(e, jUi)
				{
					if (!$(this).children().length)
						$(this).addClass('ait-droppable-placeholder-active');
				},
				deactivate: function(e, jUi)
				{
					$(this).removeClass('ait-droppable-placeholder-active');
				},
				drop: function(e, jUi)
				{
                    var $droppedElement = $(jUi.draggable);

					$droppedElement.removeClass('in-column');
					$droppedElement.css({'width': 'auto', 'height': 'auto'});
                    var d = ait.admin.utils.getDataAttr($droppedElement, 'element');
                    if (!d.clone) {
                        var $original = $("#" + ait.admin.utils.getDataAttr($droppedElement, 'elementId'));
                        if (!$original.hasClass('ait-used-element')) {
                            $original.addClass('hidden');
                        }

                    }
				}
			});
		},



		draggables: function()
		{


			$availableElements.draggable({
                connectToSortable: $sortableArea,
				handle: '.ait-element-handler',
				helper: 'clone',
                appendTo: '#ait-available-elements',
				revert: "invalid",
				cursorAt: {
					left: Math.floor(ui.draggableSize.width / 2),
					top: Math.floor(ui.draggableSize.height / 2)
				},
				start: function(e, jUi)
				{
					$(jUi.helper).css('width', Math.floor($('#ait-available-elements').width() * 0.48));
					$availableElements.find('.mceEditor').remove();
					$availableElements.find('.ait-opt-editor textarea').show();
					ui.$draggedElement = $(this);
					ui.$draggedElement.find('.mceEditor').remove();
				}
			});

		},



		basicAdvancedTabs: function()
		{

			// tabs

			$context.on('click', '.ait-controls-tabs a', function(e)
			{
				e.preventDefault();
				var $this = $(this);
				var $li = $this.parent();
                if ($li.hasClass('ait-ba-tab-active'))
                    return false;

				var $panels = $this.closest('.ait-element-controls').children('.ait-controls-tabs-panel');

				var target = $this.attr('href');

				$li.siblings().removeClass('ait-ba-tab-active');
				$li.addClass('ait-ba-tab-active').blur();


				$panels.hide();

				$(target).fadeIn('fast');

                ui.setWindowScroll();
				ui.updateElementsWithSidebarsBackground();
			});



			// enabling / disabling advanced options

			$context.find('.ait-element-content').each(function()
			{
				var $this = $(this);
			    var $tabs = $this.find('ul.ait-controls-tabs li');
			    var $panels = $this.find('.ait-controls-tabs-panel');
				$panels.hide();
				$panels.eq(0).show();
				$tabs.eq(0).addClass('ait-ba-tab-active');

                ui.updateElementAdvancedTab($this.find('.ait-toggle-advanced'));

			});

			$context.on('change', '.ait-toggle-advanced', function(e){
                ui.updateElementAdvancedTab($(this));
			});
		},



        updateElementAdvancedTab: function($advToggle)
        {
            var $adv = $advToggle.parents('.ait-options-advanced');
            if ($advToggle.val() == 1) {
                $adv.removeClass('advanced-options-disabled');
                var $inputs = $adv.find('[readonly], [disabled]').not('.ait-toggle-advanced');
                $inputs.removeAttr('readonly');
                $inputs.removeAttr('disabled');
                $adv.find('.disabled').removeClass('disabled');
            }

            else if ($advToggle.val() == 0) {
                $adv.addClass('advanced-options-disabled');
                var $inputs = $adv.find('input, select, textarea, button').not('.ait-toggle-advanced');
                $inputs.attr({
                    'disabled': 'disabled',
                    'readonly': 'readonly'
                });
            }
        },


		initElement: function($element)
		{
            data.createElementContent($element);
            data.updateElementIndexes($element);

            var $elementContent = ui.getElementContent($element);
			ait.admin.options.Ui.bindEvents($elementContent);
			ait.admin.options.Ui.inputsOnSteroids($elementContent);
			ait.admin.options.Ui.switchableSections($elementContent);

			if (ui.isColumnsElement($element)) {
				ui.initColumnsElement($element);
			}

			$element.addClass('ait-used-element');
		},


		/**
		 * Init extra functionality of Columns elements
		 */
		initColumnsElements: function()
		{
			$.each($('[class*="ait-used-element"]'), function()
			{
				if (ui.isColumnsElement($(this))) {
					ui.initColumnsElement($(this));
				}
			});
		},



		/**
		 * Init extra functionality of Columns element
		 *
		 * @param $columnsElement
		 */
		initColumnsElement: function($columnsElement)
		{
			ui.initColumnsElementRow($columnsElement);
			ui.initColumnsElementColumns($columnsElement);
			ui.initColumnsElementTopPanel($columnsElement);
			ui.initColumnsElementEditor($columnsElement);
		},



		initColumnsElementRow: function($columnsElement)
		{
			var $row = ui.getElementContent($columnsElement).find('.ait-row-content');

			$row.sortable({
				axis: 'x',
				handle: '.ait-column-handle',
				forceHelperSize: true,
				forcePlaceholderSize: true,
                start: function()
                {
                    ui.toggleColumnsEditor($columnsElement);
                },
				stop: function()
				{
					data.updateColumnsElementLayout($columnsElement, {
						columnsCssClasses: $row.children().map(function()
						{
							return $(this).data('ait-column-css-class');
						}).get()
					});
				}
			});

			$row.disableSelection();
		},



		initColumnsElementColumns: function($columnsElement)
		{
			var $columnsElementElements = $('.in-column').filter(function() {
				return $(this).data('ait-columns-element-index') == ui.getElementIndex($columnsElement);
			});

			$.each(ui.getElementContent($columnsElement).find('.ait-column'), function(i) {
				ui.initColumn($(this), $columnsElementElements.filter(function() {
					return $(this).data('ait-columns-element-column-index') == i;
				}));
			});
		},



		initColumnsElementTopPanel: function($columnsElement)
		{
			$(ui.getElementContent($columnsElement).find('.change-columns')).click(function(e)
			{
				e.preventDefault();

				var gridCssClass = $(this).data('ait-grid-css-class').trim();

				var columnsCssClasses = $($(this).data('ait-columns-css-classes').split(",")).map(function() {
					return this.trim();
				}).get();

                var columnsNames = $($(this).data('ait-columns-names').split(",")).map(function() {
                    return this.trim();
                }).get();

				var $row = $columnsElement.find('.ait-row-content');
				var columns = $row.children();

				$.each(columnsCssClasses, function(i, columnCssClass)
				{
					if (columns.length > i) {
						$(columns[i]).removeClass();
					} else {
						// append new column
						var $column = $('<div>');
						$row.append($column);
						$column.html('<div class="ait-column-handle"><h4></h4></div><div class="ait-column-content"></div>');
					}

					$column = $($row.children().get(i));
					$column.addClass('ait-column');
					$column.addClass(columnCssClass);
					$column.find('.ait-column-handle h4').html(columnsNames[i]);
					$column.data('ait-column-css-class', columnCssClass);

					ui.initColumn($column);
				});

                ui.triggerAllEditors(false);


				// remove extra columns and move elements from removed columns to last column
				var index = $row.children().size();
                var lastRow = columnsCssClasses.length - 1;
				while (index-- > columnsCssClasses.length) {
					var columnElements = $(columns[index]).find('.ait-column-content').children();
					$(columns[lastRow]).find('.ait-column-content').append(columnElements);
					$(columns[index]).remove();
				}

				$row = $(ui.getElementContent($columnsElement).find('.ait-row-content'));
				$row.removeClass().addClass('ait-row-content').addClass(gridCssClass);
				$row.data('ait-grid-css-class', gridCssClass);

				data.updateColumnsElementLayout($columnsElement, {
					gridCssClass: gridCssClass, columnsCssClasses: columnsCssClasses
				});

                ui.triggerAllEditors(true);
			});
		},



		initColumnsElementEditor: function($columnsElement)
		{
			$('.ait-columns-editor-remove').click(function(e) {
				e.preventDefault();
				ui.toggleColumnsEditor($columnsElement);
			})
		},



		initColumn: function($column, $columnElements)
		{


			var $columnContent = $column.find('.ait-column-content');

			$columnContent.sortable({
				connectWith: '.ait-column-content, #ait-used-elements-sortable',
				placeholder: 'ait-used-elements-droppable-placeholder',
				// containment: "document",
				forcePlaceholderSize: true,
				distance: 15,
				scrollSensitivity: 50,
				start: ui.onSortingStart,
				stop: ui.onSortingStop
			});

			if ($columnElements !== undefined) {
				$.each($columnElements, function()
				{
					$(this).removeClass('hidden');
					$(this).find('.ait-element-user-description').removeAttr('title');
					$columnContent.append($(this));
				});
			}

		},


		onRemoveElement: function(e)
		{
			e.preventDefault();
			e.stopPropagation();
			var $this = $(this);

			if (!confirm(ait.admin.l10n.confirm.removeElement))
				return false;

			var $elementToRemove = $this.closest('.ait-element');

			$elementToRemove.slideToggle('fast', function()
			{
                ui.removeElement($elementToRemove);
                data.removeElement(); // call only if element is completely removed
                ui.setWindowScroll();
                ui.updateElementsWithSidebarsBackground();
			});

		},



        onElementUserDescriptionClick: function(e)
        {
            var $this = $(this);

            if ($this.parents('.ait-element.in-column').length) {
                return; // do not allow editing in element handler when element is in columns element
            }

            e.preventDefault();
            e.stopPropagation();

            var value = '';
            if ($this.html() != ait.admin.l10n.elementUserDescriptionPlaceholder) {
                value = $this.html();
            }

            var $input = $('<input />', {'type': 'text', 'class': $this.attr('class'), 'title': ait.admin.l10n.elementUserDescriptionPlaceholder,  'value': value});
            $input.click(function(e) { e.stopPropagation(); });
            ait.admin.options.Ui.inputsOnSteroids($input);
            $(this).parent().append($input);
            $(this).remove();
            $input.focus();
        },




        onElementUserDescriptionBlur: function(e)
        {
            var $this = $(this);

            var value = $this.val().trim();

            var $element;

            if ($this.parents('.ait-columns-editor').length) {
                $element = $this.closest('.ait-columns-editor').data('element');
            } else {
                $element = $this.closest('.ait-element');
            }

            var $elementContent = ui.getElementContent($element);
            $elementContent.find("input[name*='[@element-user-description]']").val(value);

			var cssClasses = 'ait-element-user-description';
			if (value != '') {
				cssClasses += ' element-has-user-description';
			}

            var $span = $('<span />', { 'class': cssClasses, 'title': ait.admin.l10n.elementUserDescriptionPlaceholder}).text(value);
            $this.parent().append($span);

            if ($this.parents('.ait-columns-editor').length) {
                var $anotherSpan = $element.find('span.ait-element-user-description');
                $anotherSpan.attr('css', cssClasses);
                $anotherSpan.text(value);
            }

            $this.remove();
        },



        onElementUserDescriptionKeydown: function(e)
        {
            if (e.keyCode == 13) {
                e.stopPropagation();
                $(this).blur();
            }
        },



        removeElement: function($element)
        {
            if (ui.isColumnsElement($element)) {
                var $columnsElementContent = ui.getElementContent($element);
                var $elementsInColumnsElement = $columnsElementContent.find('.ait-element');
                $.each($elementsInColumnsElement, function() {
                    ui.removeElement($(this));
                });
            } else if (ui.isElementInColumn($element)) {
                ui.toggleColumnsEditor(ui.getColumnsElementContainingElement($element));
            }


            var elData = ait.admin.utils.getDataAttr($element, 'element');

            if (!elData.clone) {
                $availableElements.filter(':not(.clone)').each(function(i, el)
                {
                    var $e = $(el);
                    var type = ait.admin.utils.getDataAttr($e, 'element').type;
                    if (elData.type == type) {
                        $e.removeClass('hidden');
                    }
                });
            }

            var $elementContent = ui.getElementContent($element);
            $elementContent.remove();
            $element.remove();
        },



		closeAllElements: function(closeColumnsElements)
		{
			var $open = $('.ait-element.open');

			if ($open.length) {

                $.each($open, function() {
                    var $element = $(this);
                    if (ui.isColumnsElement($element)) {
                        ui.toggleColumnsEditor($element);
                    }
                });

                if (!closeColumnsElements) {
                    $open = $open.filter(function() {
                        return !ui.isColumnsElement($(this));
                    });
                }

                ui.triggerAllEditors(false);
                $open.removeClass('open');


				$usedElementsContentsArea.append($open.find('> .ait-element-content'));

                ui.updateElementsWithSidebarsBackground();

                if (ui.$draggedElement.hasClass('ait-used-element')) {
                    var elementPosition = parseInt(ui.$draggedElement.offset().top) - $window.height() / 2;
                    ui.setWindowScroll(elementPosition);
                } else {
                    ui.setWindowScroll();
                }

                $sortableArea.sortable('refreshPositions');
                $sortableArea.sortable('refresh');
            }
		},



		onToggleElement: function(e)
		{
            e.preventDefault();
            e.stopPropagation();

			var $element = $(this).closest('.ait-element');

            if ($element.hasClass('open')) {
                ui.closeElement($element);
            } else {
                ui.openElement($element);
            }

			$('.ait-element-user-description').blur();
		},



        openElement: function($element)
        {

            ui.triggerAllEditors(false, ui.getElementContent($element));

            if (ui.isElementInColumn($element)) {
                ui.toggleColumnsEditor(ui.getColumnsElementContainingElement($element), $element);
                $element.addClass('open');
            } else {
                var $elementContent = ui.getElementContent($element);
                $element.append($elementContent);
                ui.triggerAllEditors(true, ui.getElementContent($element));


                $elementContent.slideDown('fast', function() {
                    $element.addClass('open');
                    ui.setWindowScroll();
                    ui.updateElementsWithSidebarsBackground();


                    var $mapInput = $elementContent.find('.ait-opt-maps-preview');
                    $mapInput.width($mapInput.parent().width()).height(($mapInput.parent().width()/2));
                    $elementContent.find('.ait-opt-maps-tools').trigger('mapinit');
                    $elementContent.find('.ait-opt-maps-address input[type="button"]').trigger("click");
                });
            }

        },



        closeElement: function($element)
        {
            ui.triggerAllEditors(false, ui.getElementContent($element));

            if (ui.isColumnsElement($element)) {
                ui.toggleColumnsEditor($element);
            }

            if (ui.isElementInColumn($element)) {
                var $columnsElement = ui.getColumnsElementContainingElement($element);
                ui.toggleColumnsEditor($columnsElement);
            } else {
                var $elementContent = ui.getElementContent($element);
                $elementContent.slideUp('fast', function() {
                    $usedElementsContentsArea.append($elementContent);
                    $element.removeClass('open');
                    ui.setWindowScroll();
                    ui.updateElementsWithSidebarsBackground();
                });
            }
        },



		toggleColumnsEditor: function($columnsElement, $elementToOpenInEditor)
		{
            var $columnsEditor = $columnsElement.find('.ait-columns-editor');
			var $elementContent;

			if ($columnsEditor.hasClass('open')) {
                $elementContent = $columnsEditor.find('.ait-columns-editor-element-options').find('.ait-element-content');
                ui.triggerAllEditors(false, $elementContent);
                $elementContent = $elementContent.detach();
				$columnsEditor.hide();
				$elementContent.hide();
                var $el = $($columnsEditor.data('element'));
                $elementsWithDetachedOptions.splice($.inArray($el.attr('id'), $elementsWithDetachedOptions), 1); // delete element
                $usedElementsContentsArea.append($elementContent);
                $el.removeClass('open');
				$columnsEditor.removeData('element');
                ui.triggerAllEditors(true, $elementContent);
                $columnsEditor.removeClass('open');
			}

			if ($elementToOpenInEditor) {
                $elementsWithDetachedOptions.push($elementToOpenInEditor.attr('id'));
                $elementContent = ui.getElementContent($elementToOpenInEditor);
                ui.triggerAllEditors(false, $elementContent);
                $columnsEditor.find('.ait-columns-editor-element-title > h4').html($elementToOpenInEditor.find('.ait-element-title > h4').html());
                var elementUserDescription = $elementContent.find("input[name*='[@element-user-description]']").val();
                var $elementUserDescription = $columnsEditor.find('.ait-columns-editor-element-title > .ait-element-user-description');
				$elementUserDescription.text(elementUserDescription);
                if (elementUserDescription != '') {
					$elementUserDescription.addClass('element-has-user-description');
				} else {
					$elementUserDescription.removeClass('element-has-user-description');
                }
                $columnsEditor.find('.ait-columns-editor-element-options').append($elementContent);
                $elementContent.show();
                $columnsEditor.show();
                $columnsEditor.data('element', $elementToOpenInEditor);
                ui.triggerAllEditors(true, $elementContent);
                $columnsEditor.addClass('open');

                // init map if columnable element is opened
                var $map = $columnsElement.find('.ait-opt-maps-tools');
                $map.trigger('mapinit');
            }

			ui.updateElementsWithSidebarsBackground();
            ui.setWindowScroll();
        },



		triggerAllEditors: function(creatingEditor, $context)
		{
            var $textareas = [];
            if ($context !== undefined) {
                $textareas = $context.find('.ait-opt-editor textarea');//.not('[name*="1000"]');
            } else {
                $textareas = $('.ait-opt-editor textarea');//.not('[name*="1000"]');
            }

			$textareas.each(function(index, textarea)
			{
				var editor;
				try{
					editor = tinyMCE.EditorManager.get(textarea.id);
				}catch(e){
					editor = false;
				}

				if (creatingEditor && !editor) {
                    try {
						ait.admin.ajax.post("tinyMceEditor", {'content': $(textarea).val(), 'id': textarea.id, 'textarea_name': $(textarea).attr('name')},  function(response) {
							var $wrapper = $(textarea).parent();
							$(textarea).replaceWith(response);
							var editor = tinyMCEPreInit.mceInit[textarea.id];
							if(editor && tinyMCE){
								editor.init_instance_callback = function() {
									quicktags( tinyMCEPreInit.qtInit[textarea.id] );
									QTags._buttonsInit();
									var $container = $(response);
									$wrapper.show();
									// hotfix: visual/html tabs of text element didn't work in columns
									// we have to find editor buttons within whole document because $container object is added by ajax and has no click event binded
									if ($container.hasClass('html-active')) {
										$('#'+$container.get(0).id).find('.switch-html').trigger('click');
									} else {
										$('#'+$container.get(0).id).find('.switch-tmce').trigger('click');
									}
									ui.updateElementsWithSidebarsBackground();
								};
								tinyMCE.init(editor);
							}else{
								quicktags( tinyMCEPreInit.qtInit[textarea.id] );
								QTags._buttonsInit();
								var $container = $(response);
								$wrapper.show();
								// hotfix: visual/html tabs of text element didn't work in columns
								// we have to find editor buttons within whole document because $container object is added by ajax and has no click event binded
								console.log('edge case of editor initialization');
								if ($container.hasClass('html-active')) {
									$('#'+$container.get(0).id).find('.switch-html').trigger('click');
								} else {
									$('#'+$container.get(0).id).find('.switch-tmce').trigger('click');
								}
								ui.updateElementsWithSidebarsBackground();
							}
						});
                    } catch(e) {
                        if (typeof console == "object") {
                            console.log(e);
                        }
                    }


				} else if (editor) {
					try {
                        if (textarea.id in QTags.instances) {
                            delete QTags.instances[textarea.id];
                        }

						var htmlModeValue = null;
						if ($(textarea).closest('.wp-editor-wrap').hasClass('html-active')) {
							htmlModeValue = $(textarea).val();
							editor.remove();
							// do not overwrite text entered in html mode with text from visual mode
							$(textarea).val(htmlModeValue);
						} else {
							editor.remove();
						}

						$(textarea).closest('.ait-opt-wrapper').append(textarea).find('.wp-editor-wrap, script').remove();
						$(textarea).closest('.ait-opt-wrapper').hide();
                    } catch (e) {
                        if (typeof console == "object") {
                            console.log(e);
                        }
                    }

				}
			});
		},



		initSidebarsBoundaryElements: function()
		{
			var atLeastOneSidebarSet = false;
			$.each($('select[name*="sidebar"]'), function()
			{
				if ($(this).val() != 'none') {
					atLeastOneSidebarSet = true;
					return false;
				}
				return true;
			});

			if (atLeastOneSidebarSet) {
				$elementsWithSidebarsStartBoundary.show();
				$elementsWithSidebarsEndBoundary.show();
				$elementsWithSidebarsContainer.show();
				ui.updateElementsWithSidebarsBackground();
			} else {
				$elementsWithSidebarsStartBoundary.hide();
				$elementsWithSidebarsEndBoundary.hide();
				$elementsWithSidebarsContainer.hide();
			}

		},



        save: function(e)
        {
            e.preventDefault();
            data.save();
        },



		onSortingStart: function(e, jUi)
		{
            ui.$draggedElement = jUi.item;

			var $draggedElementHelper = jUi.helper;

		    $draggedElementHelper.css('width', Math.floor($('#ait-available-elements').width() * 0.48));
			$sortableArea.find('.ait-used-elements-droppable-placeholder').outerHeight($draggedElementHelper.find('.ait-element-handler').height());

            ui.closeAllElements(!$(jUi.helper).hasClass('ait-element-columnable'));

		},



		onSortingStop: function(e, jUi)
		{
            var $droppedElement = $(jUi.item);

            if ($('.ait-sidebars-boundary-start').index() > $('.ait-sidebars-boundary-end').index()) {
                $(this).sortable('cancel');
                return;
            }

            var open = false;

            if (!$droppedElement.hasClass('ait-used-element')) {
                ui.initElement($droppedElement);
                open = true;
            }

            if (ui.isElementInColumn($droppedElement)) {
                $droppedElement.addClass('in-column');
                $droppedElement.removeClass('open');
				$droppedElement.find('.ait-element-user-description').removeAttr('title');
            } else {
                $droppedElement.removeClass('in-column');
				$droppedElement.find('.ait-element-user-description').attr('title', ait.admin.l10n.elementUserDescriptionPlaceholder);
            }

            data.updateSortableElementPositionInfo($droppedElement);

            ui.updateElementsWithSidebarsBackground();
            data.changesMade();

            if (open) {
                ui.openElement($droppedElement);
            }

		},



		updateElementsWithSidebarsBackground: function()
		{
            if ($elementsWithSidebarsContainer.length && $elementsWithSidebarsStartBoundary.length && $elementsWithSidebarsEndBoundary.length) {
                $elementsWithSidebarsContainer.css('top', $elementsWithSidebarsStartBoundary.position().top + $elementsWithSidebarsStartBoundary.height() / 2);
                $elementsWithSidebarsContainer.css('height', $elementsWithSidebarsEndBoundary.position().top - $elementsWithSidebarsStartBoundary.position().top);
            }
        },



	    resetCursorPositionOfDraggables: function()
		{
			var cursorX = Math.floor($('#ait-available-elements').width() * 0.48 / 2);

			// root sortable cursor position reset
			$sortableArea.sortable('option', 'cursorAt', {
				left: cursorX
			});

			// every column sortable cursor position reset
			$.each($('.ait-options-content .ait-column-content'), function()
			{
				$(this).sortable('option', 'cursorAt', {
					left: cursorX
				})
			});

			// available elements cursor position reset
			$availableElements.draggable('option', 'cursorAt', {
				left: cursorX
			});

		},



        setWindowScroll: function(y)
        {
            var currentY = $window.scrollTop();

            var maxY = $sortableArea.offset().top + $sortableArea.height() - $window.height() + ait.admin.options.Ui.pageBottomOffset;

            if (y == undefined) {
                y = currentY;
            }

            if (y > maxY) {
                y = maxY;
            }

            $window.scrollTop(y);
        },



		isColumnsElement: function($element)
		{
			return $element.data('aitElementId') && $element.data('aitElementId').indexOf('columns') != -1
		},



        isElementInColumn: function($element)
        {
            return ($element.parents('.ait-element-content').get(0) !== undefined);
        },



        getColumnsElementContainingElement: function($element)
        {
            var $columnsElementContent = $($element.parents('.ait-element-content').get(0));
            var columnsElementId = $columnsElementContent.data('ait-element-id');
            return $('#' + columnsElementId);
        },


        getElementContentPrototype: function($element)
        {
            return $('#' + $element.data('ait-element-content-id') + '-prototype');
        },


        getElementContent: function($element)
        {
            return $('#' + $element.data('ait-element-content-id'));
        },


        getElementIndex: function($element)
        {
        	var index;
        	var elId = $element.attr('id') ? $element.attr('id') : $element.data('ait-element-id');
        	var rawIndex = elId.match(/__[_a-zA-Z0-9]+__/)[0];
        	var startsWith = function(haystack, needle) { return haystack.indexOf(needle, 0) == 0; }

        	index = rawIndex.match(/[a-zA-Z0-9]+/)[0];

        	if(startsWith(rawIndex, '___e')){
            	index = '_' + index;
        	}

            return index;
        }

	};



	// ===============================================
	// Init
	// -----------------------------------------------

	$(function()
	{
		ait.admin.options.elements.Ui.init();
	});



})(jQuery, jQuery(window), jQuery(document));
