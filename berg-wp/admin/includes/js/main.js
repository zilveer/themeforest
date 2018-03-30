// Closure to keep vars out of global scope
(function() {
    "use strict";
    var index = new Date().getTime();
    var currentIndex = '';
    var gridWidth = 4;
    var gridHeight = 3;

    if (!('forEach' in Array.prototype)) {
        Array.prototype.forEach = function(action, that /*opt*/ ) {
            for (var i = 0, n = this.length; i < n; i++)
                if (i in this)
                    action.call(that, this[i], i, this);
        };
    }

    function generateGrid(gridWidth, gridHeight) {
        window.placeholderGrid = new Models.Grid(gridWidth, gridHeight, jQuery('#placeholderGrid'));

        _.times(gridWidth * gridHeight, function() {
            placeholderGrid.add(new Models.Block(1, 1));
        });

        window.grid = new Models.Grid(gridWidth, gridHeight, jQuery('#workingGrid'));
    }

    function fillGridWithContents() {
        clearGrid();

        var gridArray = [];
        var gridIndexes;
        var gridArrayTemp;

        if (jQuery('#restaurant_grid_indexes_id').val().indexOf(',')) {
            gridIndexes = jQuery('#restaurant_grid_indexes_id').val().split(',');
        }

        if (jQuery('#restaurant_grid_array_id').val().indexOf('|')) {
            gridArrayTemp = jQuery('#restaurant_grid_array_id').val().split('|');
        }

        var len = gridArrayTemp.length;
        for (var i = 0; i < len; i++) {
            if (gridArrayTemp[i]) {
                var rowTemp = gridArrayTemp[i].split(',');
                rowTemp.pop();
                gridArray[i] = rowTemp;
            }
        }

        index = new Date().getTime();

        var k = 0;

        gridArray.forEach(function(row, i) {
            row.forEach(function(block, j) {
                if ((block != 0) || (block != '0')) {
                    var split = block.split('');
                    var w = split[1];
                    var h = split[3];

                    var size = {
                        'width': w,
                        'height': h
                    };
                    var position = {
                        'x': j,
                        'y': i
                    };
                    var index = gridIndexes[k];

                    grid.place(generateBlockFromArray(size, position, index));
                }
                k++;
            });
        });

        if (grid.isComplete()) {
            enableShowCode();
        } else {
            disableShowCode();
        }
    }

    function fillGrid(gridArray, gridIndexes) {
        gridWidth = 4;
        gridHeight = gridArray.length;
        clearGrid();

        var k = 0;

        gridArray.forEach(function(row, i) {
            row.forEach(function(block, j) {
                if ((block != 0) || (block != '0')) {
                    var split = block.split('');
                    var w = split[1];
                    var h = split[3];

                    var size = {
                        'width': w,
                        'height': h
                    };
                    var position = {
                        'x': j,
                        'y': i
                    };
                    var index = gridIndexes[k];

                    grid.place(generateBlockFromArray(size, position, index));
                }
                k++;
            });
        });
    }

    function clearGrid() {
        grid.clear();

        window.placeholderGrid = '';
        window.grid = '';

        if (jQuery('#placeholderGrid .block').data('uiDroppable')) {
            jQuery('#placeholderGrid .block').droppable('destroy');
        }

        if (jQuery('#workingGrid').data('uiDroppable')) {
            jQuery('#workingGrid').droppable('destroy');
        }

        jQuery('#placeholderGrid').html('');

        generateGrid(gridWidth, gridHeight);

        jQuery('#placeholderGrid .block').droppable({
            over: overGridHandler,
            drop: dropGridHandler,
            live: true
        });

        jQuery('#workingGrid').droppable({
            out: outGridHandler,
            live: true
        });

        jQuery(".key").live("touchend", keyTouchHandler);
    }

    jQuery.noConflict();

    jQuery(document).ready(function() {
        if (jQuery('#restaurant_grid_indexes_id').length) {
            generateGrid(gridWidth, gridHeight);
            var gridArray = [];
            var gridIndexes;
            var gridArrayTemp;

            if (jQuery('#restaurant_grid_indexes_id').val().indexOf(',')) {
                gridIndexes = jQuery('#restaurant_grid_indexes_id').val().split(',');
            }

            if (jQuery('#restaurant_grid_array_id').val().indexOf('|')) {
                gridArrayTemp = jQuery('#restaurant_grid_array_id').val().split('|');
            }

            var len = gridArrayTemp.length;
            for (var i = 0; i < len; i++) {
                if (gridArrayTemp[i]) {
                    var rowTemp = gridArrayTemp[i].split(',');
                    rowTemp.pop();
                    gridArray[i] = rowTemp;
                }
            }

            //index = gridIndexes.length;
            index = new Date().getTime();

            fillGrid(gridArray, gridIndexes);

            if (gridArray.length == 3) {
                jQuery('#TwelveButton').attr('disabled', true);
            } else if (gridArray.length == 4) {
                jQuery('#SixTeenButton').attr('disabled', true);
            } else if (gridArray.length == 5) {
                jQuery('#TwentyButton').attr('disabled', true);
            }

            jQuery('.key').draggable({
                helper: renderDragHelper,
                live: true
            });

            jQuery('#placeholderGrid .block').droppable({
                over: overGridHandler,
                drop: dropGridHandler,
                live: true
            });

            jQuery('#workingGrid').droppable({
                out: outGridHandler,
                live: true
            });

            jQuery(".key").live("touchend", keyTouchHandler);

            jQuery("#resetButton").live("click", function() {
                grid.clear();
                disableShowCode();
            });

            jQuery("a.editBlock").live("click", function(e) {
                e.preventDefault();

                currentIndex = jQuery(this).data('index');

                if (jQuery('#theme_grid_name_' + currentIndex + '_id').length) {
                    jQuery('#theme_grid_name').val(jQuery('#theme_grid_name_' + currentIndex + '_id').val());
                } else {
                    jQuery('#theme_grid_name').val('');
                }

                if (jQuery('#theme_grid_background_image_' + currentIndex + '_id').length) {
                    jQuery('#theme_grid_background_image').val(jQuery('#theme_grid_background_image_' + currentIndex + '_id').val());
                } else {
                    jQuery('#theme_grid_background_image').val('');
                }

                var functionType = jQuery('#theme_grid_function_' + currentIndex + '_id').val();
                var functionValue = jQuery('#theme_grid_function_value_' + currentIndex + '_id').val();
                var functionValueNumber = jQuery('#theme_grid_function_value_number_' + currentIndex + '_id').val();

                jQuery('#theme_grid_function option[value=' + functionType + ']').attr('selected', 'selected');

                jQuery('.function').addClass('hidden');
                if ((functionType != 'opening_hours') || (functionType != 'events')) {
                    jQuery('#function').toggleClass('hidden');
                    jQuery('#theme_grid_option_' + functionType).toggleClass('hidden');

                    // if opening times hide titles
                    jQuery('.titles').removeClass('hidden');
                } else {
                    jQuery('.titles').addClass('hidden');
                }

                if (functionType == 'custom_code') {
                    jQuery('#theme_grid_custom_code').removeClass('hidden');
                    jQuery('#theme_grid_custom_code').val(functionValue);
                    jQuery('#theme_grid_custom_code_center').prop('checked', (functionValueNumber == 'yes') ? true : false);
                } else if (functionType == 'opening_hours') {
                    jQuery('#theme_grid_title_hover').prop('disabled', true);
                    jQuery('#theme_grid_subtitle_hover').prop('disabled', true);
                    jQuery('#theme_grid_opening_hours').removeClass('hidden');
                    jQuery('#theme_grid_opening_hours').prop('checked', (functionValue == 'yes') ? true : false);
                } else if (functionType == 'twitter') {
                    jQuery('#theme_grid_twitter').removeClass('hidden');
                    jQuery('#theme_grid_twitter').val(functionValue);
                    jQuery('#theme_grid_twitter_number').val(jQuery('#theme_grid_function_value_number_' + currentIndex + '_id').val());
                } else if (functionType == 'facebook') {
                    jQuery('#theme_grid_facebook').removeClass('hidden');
                    jQuery('#theme_grid_facebook').val(functionValue);
                    jQuery('#theme_grid_facebook_number').val(jQuery('#theme_grid_function_value_number_' + currentIndex + '_id').val());
                } else if (functionType == 'events') {
                    jQuery('#theme_grid_events').removeClass('hidden');
                    jQuery('#theme_grid_events option[value=' + functionValue + ']').attr('selected', 'selected');
                    jQuery('#theme_grid_events_number').val(jQuery('#theme_grid_function_value_number_' + currentIndex + '_id').val());
                } else if (functionType == 'link') {
                    jQuery('#theme_grid_link').removeClass('hidden');
                    if (typeof wpml_languages != 'undefined') {
                        wpml_languages.forEach(function(item) {
                            functionValue = jQuery('#theme_grid_function_value_' + item + '_' + currentIndex + '_id').val();
                            jQuery('#theme_grid_link_' + item).val(functionValue);
                        });
                    }
                    jQuery('#theme_grid_link').val(functionValue);
                    jQuery('#theme_grid_link_blank').prop('checked', (functionValueNumber == 'yes') ? true : false);

                } else if (functionType == 'category') {
                    jQuery('#theme_grid_title_hover').prop('disabled', true);
                    jQuery('#theme_grid_subtitle_hover').prop('disabled', true);
                    jQuery('#theme_grid_category option[value=' + functionValue + ']').attr('selected', 'selected');
                } else if (functionType == 'page') {
                    if (typeof wpml_languages != 'undefined') {
                        wpml_languages.forEach(function(item) {
                            functionValue = jQuery('#theme_grid_function_value_' + item + '_' + currentIndex + '_id').val();
                            jQuery('#theme_grid_page_' + item + ' option[value=' + functionValue + ']').attr('selected', 'selected');
                        });
                    }
                    jQuery('#theme_grid_page option[value=' + functionValue + ']').attr('selected', 'selected');
                } else if (functionType == 'slider_category') {
                    jQuery('#theme_grid_title_hover').prop('disabled', true);
                    jQuery('#theme_grid_subtitle_hover').prop('disabled', true);
                    jQuery('#theme_grid_slider_category option[value=' + functionValue + ']').attr('selected', 'selected');
                    jQuery('#theme_grid_slider_category_number').val(jQuery('#theme_grid_function_value_number_' + currentIndex + '_id').val());
                }

                if (jQuery('#theme_grid_title_' + currentIndex + '_id').length) {
                    jQuery('#theme_grid_title').val(jQuery('#theme_grid_title_' + currentIndex + '_id').val());
                } else {
                    jQuery('#theme_grid_title').val('');
                }

                if (jQuery('#theme_grid_title_hover_' + currentIndex + '_id').length) {
                    jQuery('#theme_grid_title_hover').val(jQuery('#theme_grid_title_hover_' + currentIndex + '_id').val());
                } else {
                    jQuery('#theme_grid_title_hover').val('');
                }

                if (jQuery('#theme_grid_subtitle_' + currentIndex + '_id').length) {
                    jQuery('#theme_grid_subtitle').val(jQuery('#theme_grid_subtitle_' + currentIndex + '_id').val());
                } else {
                    jQuery('#theme_grid_subtitle').val('');
                }

                if (jQuery('#theme_grid_subtitle_hover_' + currentIndex + '_id').length) {
                    jQuery('#theme_grid_subtitle_hover').val(jQuery('#theme_grid_subtitle_hover_' + currentIndex + '_id').val());
                } else {
                    jQuery('#theme_grid_subtitle_hover').val('');
                }

                if (jQuery('#theme_grid_icon_' + currentIndex + '_id').length) {
                    jQuery('#theme_grid_icon').val(jQuery('#theme_grid_icon_' + currentIndex + '_id').val());
                    jQuery('#restaurant-block-icon').attr('class', jQuery('#theme_grid_icon_' + currentIndex + '_id').val());
                    if (jQuery('#theme_grid_icon_' + currentIndex + '_id').val() == 'no-icon') {
                        jQuery('#restaurant-block-icon').html('no-icon');
                    } else {
                        jQuery('#restaurant-block-icon').html('');
                    }

                } else {
                    jQuery('#theme_grid_icon').val('');
                    jQuery('#restaurant-block-icon').attr('class', 'fa fa-leaf');
                }

                if (jQuery('#theme_grid_icon_image_' + currentIndex + '_id').length) {
                    jQuery('#theme_grid_icon_image').val(jQuery('#theme_grid_icon_image_' + currentIndex + '_id').val());
                } else {
                    jQuery('#theme_grid_icon_image').val('');
                }

                if (jQuery('#editBox').hasClass('hidden')) {
                    jQuery('#editBox').removeClass('hidden');
                }
            });

            jQuery("a.removeBlock").live("click", function(e) {
                e.preventDefault();
                var id = jQuery(this).data('index');
                grid.removeBlockWithIndex(id);
                jQuery(this).parent().remove();
                index = new Date().getTime();
                disableShowCode();
            });

            jQuery("#save-edit-item").live("click", function(e) {
                e.preventDefault();

                var editedName = jQuery('#theme_grid_name').val();
                var editedBackgroundImage = jQuery('#theme_grid_background_image').val();
                var editedFunction = jQuery('#theme_grid_function').val();
                var editedFunctionValue = '';
                var editedFunctionValueNumber = '';

                if (editedFunction == 'opening_hours') {
                    editedFunctionValue = jQuery("#theme_grid_opening_hours").prop('checked') ? 'yes' : 'no';
                } else {
                    editedFunctionValue = jQuery('#theme_grid_' + editedFunction).val();
                }

                if (editedFunction == 'custom_code') {
                    editedFunctionValue = editedFunctionValue.replace(/\"/g, '\'');
                    editedFunctionValueNumber = jQuery("#theme_grid_custom_code_center").prop('checked') ? 'yes' : 'no';
                }

                if (editedFunction == 'link') {
                    editedFunctionValueNumber = jQuery("#theme_grid_link_blank").prop('checked') ? 'yes' : 'no';
                }

                if (editedFunction == 'slider_category') {
                    editedFunctionValueNumber = jQuery('#theme_grid_slider_category_number').val();
                }

                if (editedFunction == 'twitter') {
                    editedFunctionValueNumber = jQuery('#theme_grid_twitter_number').val();
                }

                if (editedFunction == 'facebook') {
                    editedFunctionValueNumber = jQuery('#theme_grid_facebook_number').val();
                }

                if (editedFunction == 'events') {
                    editedFunctionValueNumber = jQuery('#theme_grid_events_number').val();
                }

                var editedTitle = jQuery('#theme_grid_title').val();
                var editedSubTitle = jQuery('#theme_grid_subtitle').val();
                var editedTitleHover = jQuery('#theme_grid_title_hover').val();
                var editedSubTitleHover = jQuery('#theme_grid_subtitle_hover').val();
                var editedIcon = jQuery('#theme_grid_icon').val();
                var editedIconImage = jQuery('#theme_grid_icon_image').val();

                if (jQuery('#theme_grid_name_' + currentIndex + '_id').length) {

                    jQuery('#theme_grid_name_' + currentIndex + '_id').val(editedName);

                    jQuery('#theme_grid_background_image_' + currentIndex + '_id').val(editedBackgroundImage);
                    jQuery('#theme_grid_function_' + currentIndex + '_id').val(editedFunction);

                    if ((editedFunction == 'page') || (editedFunction == 'link')) {
                        if (typeof wpml_languages != 'undefined') {
                            wpml_languages.forEach(function(item) {
                                editedFunctionValue = jQuery('#theme_grid_' + editedFunction + '_' + item).val();
                                jQuery('#theme_grid_function_value_' + item + '_' + currentIndex + '_id').val(editedFunctionValue);
                            });
                        }
                    }

                    jQuery('#theme_grid_function_value_' + currentIndex + '_id').val(editedFunctionValue);
                    jQuery('#theme_grid_function_value_number_' + currentIndex + '_id').val(editedFunctionValueNumber);
                    jQuery('#theme_grid_title_' + currentIndex + '_id').val(editedTitle);
                    jQuery('#theme_grid_subtitle_' + currentIndex + '_id').val(editedSubTitle);
                    jQuery('#theme_grid_title_hover_' + currentIndex + '_id').val(editedTitleHover);
                    jQuery('#theme_grid_subtitle_hover_' + currentIndex + '_id').val(editedSubTitleHover);
                    jQuery('#theme_grid_icon_' + currentIndex + '_id').val(editedIcon);
                    jQuery('#theme_grid_icon_image_' + currentIndex + '_id').val(editedIconImage);
                } else {
                    var newElement = jQuery('<div id="element-' + currentIndex + '">' +
                        '<input id="theme_grid_name_' + currentIndex + '_id" type="hidden" name="yopress[grid_name_' + currentIndex + ']" value=""/>' +
                        '<input id="theme_grid_background_image_' + currentIndex + '_id" type="hidden" name="yopress[grid_background_image_' + currentIndex + ']" value=""/>' +
                        '<input id="theme_grid_function_' + currentIndex + '_id" type="hidden" name="yopress[grid_function_' + currentIndex + ']" value=""/>' +
                        '<input id="theme_grid_function_value_' + currentIndex + '_id" type="hidden" name="yopress[grid_function_value_' + currentIndex + ']" value=""/>' +
                        '<input id="theme_grid_function_value_number_' + currentIndex + '_id" type="hidden" name="yopress[grid_function_value_number_' + currentIndex + ']" value=""/>' +
                        '<input id="theme_grid_title_' + currentIndex + '_id" type="hidden" name="yopress[grid_title_' + currentIndex + ']" value=""/>' +
                        '<input id="theme_grid_subtitle_' + currentIndex + '_id" type="hidden" name="yopress[grid_subtitle_' + currentIndex + ']" value=""/>' +
                        '<input id="theme_grid_title_hover_' + currentIndex + '_id" type="hidden" name="yopress[grid_title_hover_' + currentIndex + ']" value=""/>' +
                        '<input id="theme_grid_subtitle_hover_' + currentIndex + '_id" type="hidden" name="yopress[grid_subtitle_hover_' + currentIndex + ']" value=""/>' +
                        '<input id="theme_grid_icon_' + currentIndex + '_id" type="hidden" name="yopress[grid_icon_' + currentIndex + ']" value=""/>' +
                        '<input id="theme_grid_icon_image_' + currentIndex + '_id" type="hidden" name="yopress[grid_icon_image_' + currentIndex + ']" value=""/>' +
                        '</div>');
                    jQuery('form').append(newElement);
                }

                jQuery('#editBox').addClass('hidden');
                jQuery('#theme_grid_name').val('');
                jQuery('#theme_grid_background_image').val('');
                jQuery('#theme_grid_function').val('');
                jQuery('#theme_grid_function_value_number').val('');
                jQuery('#theme_grid_title').val('');
                jQuery('#theme_grid_subtitle').val('');
                jQuery('#theme_grid_title_hover').val('');
                jQuery('#theme_grid_subtitle_hover').val('');
                jQuery('#theme_grid_icon').val('');
                jQuery('#theme_grid_icon_image').val('');
                jQuery('#theme_grid_custom_code').val('').text('');

                jQuery('form').submit();
            });

            jQuery("#saveCode").live("click", saveCode);

            jQuery("#TwelveButton").live("click", function(e) {
                if (confirm('This action will remove bottom rows. Are You sure ?')) {
                    gridWidth = 4;
                    gridHeight = 3;

                    fillGridWithContents();

                    jQuery('#TwentyButton').attr('disabled', false);
                    jQuery('#SixTeenButton').attr('disabled', false);
                    jQuery('#TwelveButton').attr('disabled', true);
                }
            });

            jQuery("#SixTeenButton").live("click", function(e) {
                if (confirm('This action will remove bottom rows. Are You sure ?')) {
                    gridWidth = 4;
                    gridHeight = 4;

                    fillGridWithContents();

                    jQuery('#TwentyButton').attr('disabled', false);
                    jQuery('#SixTeenButton').attr('disabled', true);
                    jQuery('#TwelveButton').attr('disabled', false);
                }
            });

            jQuery("#TwentyButton").live("click", function(e) {
                gridWidth = 4;
                gridHeight = 5;

                fillGridWithContents();

                jQuery('#TwentyButton').attr('disabled', true);
                jQuery('#SixTeenButton').attr('disabled', false);
                jQuery('#TwelveButton').attr('disabled', false);
            });

            if (jQuery('.editBlock').length) {
                jQuery('.editBlock').removeClass('hidden');
            }
        }
    });

    var hideInstructions = function() {
        jQuery('.instructionOverlay').addClass('fade');
        jQuery('.instructionArrow').addClass('fade');
    };

    var renderDragHelper = function() {
        var sizeHash = new Models.Block().sizeFromElement(jQuery(this).attr('class'));
        var sizeClass = 's' + sizeHash.width + 'x' + sizeHash.height;
        var helper = jQuery('<li class="key dragging ' + sizeClass + '"></li>');

        return helper;
    };

    var overGridHandler = function(event, ui) {
        if (ui.helper.hasClass('key')) {
            ui.helper.removeClass('key').addClass('block');
        }

        jQuery('#placeholderGrid').removeClass('canFit');
        jQuery('#placeholderGrid').removeClass('cantFit');

        if (grid.canFit(generateBlock(ui.helper, jQuery(this), index))) {
            jQuery('#placeholderGrid').addClass('canFit');
        } else {
            jQuery('#placeholderGrid').addClass('cantFit');
        }

        showFitWhileDragging(ui.helper, jQuery(this));
    };

    var outGridHandler = function() {
        clearFit();
    };

    var showFitWhileDragging = function(helper, unit) {
        var overlapped = placeholderGrid.blocksOverlappedByBlock(generateBlock(helper, unit, index));

        jQuery('#placeholderGrid .block').removeClass('draggingOver');

        _(overlapped).each(function(block) {
            block.element.addClass('draggingOver');
        });
    };

    var clearFit = function() {
        jQuery('.dragging.block').removeClass('block').addClass('key');
        jQuery('.draggingOver').removeClass('draggingOver');
    };

    var dropGridHandler = function(event, ui) {
        grid.place(generateBlock(ui.helper, jQuery(this), index));
        clearFit();

        if (grid.isComplete()) {
            enableShowCode();
        }

        index++;
    };

    var keyTouchHandler = function(event) {
        var block = new Models.Block();
        var size = block.sizeFromElement(jQuery(this).attr('class'));

        block.width = size.width;
        block.height = size.height;

        grid.add(block);

        if (grid.isComplete()) {
            enableShowCode();
        }
    };

    var generateBlockFromArray = function(size, position, index) {
        var block = new Models.Block();
        block.width = size.width;
        block.height = size.height;
        block.x = position.x;
        block.y = position.y;
        var title = '';

        if (jQuery('#theme_grid_name_' + index + '_id').length) {
            title = jQuery('#theme_grid_name_' + index + '_id').val();
        }

        if ((title != '') && (title != 'undefined')) {
            block.html = '<p class="edit-info">' + title + '<br/><a href="#" data-index="' + index + '" class="editBlock hidden"><i class="fa fa-pencil"></i></a> <a href="#" data-index="' + index + '" class="removeBlock"><i class="fa fa-times"></i></a></p>';
        } else {
            block.html = '<a href="#" data-index="' + index + '" class="editBlock hidden"><i class="fa fa-pencil"></i></a> <a href="#" data-index="' + index + '" class="removeBlock"><i class="fa fa-times"></i></a></p>';
        }

        block.creationIndex = index;

        return block;
    };

    var generateBlock = function(draggedBlock, unit, index) {

        var block = new Models.Block();
        var size = block.sizeFromElement(draggedBlock.attr('class'));
        var position = block.positionFromElement(unit.attr('class'));
        block.width = size.width;
        block.height = size.height;
        block.x = position.x;
        block.y = position.y;
        var title = '';

        if (jQuery('#theme_grid_name_' + index + '_id').length) {
            title = jQuery('#theme_grid_name_' + index + '_id').val();
        }

        if ((title != '') && (title != 'undefined')) {
            block.html = '<p class="edit-info">' + title + '<br/><a href="#" data-index="' + index + '" class="editBlock hidden"><i class="fa fa-pencil"></i></a> <a href="#" data-index="' + index + '" class="removeBlock"><i class="fa fa-times"></i></a></p>';
        } else {
            block.html = '<a href="#" data-index="' + index + '" class="editBlock hidden"><i class="fa fa-pencil"></i></a> <a href="#" data-index="' + index + '" class="removeBlock"><i class="fa fa-times"></i></a></p>';
        }

        block.creationIndex = index;

        return block;
    };

    var enableShowCode = function() {
        jQuery('#saveCode').attr('disabled', false);
    };

    var disableShowCode = function() {
        jQuery('#saveCode').attr('disabled', true);
    };

    var enableReset = function() {

    };

    var disableReset = function() {

    };

    var saveCode = function() {

        var gridArray = new Array(gridHeight - 1);
        for (var i = 0; i <= gridHeight - 1; i++) {
            gridArray[i] = [0, 0, 0, 0];
        }

        var indexesArray = new Array(gridHeight - 1);
        for (i = 0; i <= gridHeight - 1; i++) {
            indexesArray[i] = [0, 0, 0, 0];
        }

        var indexesToSave = '';

        jQuery('#workingGrid div').each(function() {
            var classes = jQuery(this).attr('class');
            var ind = jQuery(this).find('a').data('index');

            var blockArr = classes.split(' ');

            var blockSize = blockArr[1];
            var blockLocation = blockArr[2];

            var sp = blockLocation.split('');
            var x = sp[1];
            var y = sp[3];

            gridArray[y][x] = blockSize;
            indexesArray[y][x] = ind;
        });

        var arrayToSave = '';

        gridArray.forEach(function(el) {
            el.forEach(function(item) {
                arrayToSave += item + ',';
            });
            arrayToSave += '|';
        });

        indexesArray.forEach(function(el) {
            el.forEach(function(item) {
                indexesToSave += item + ',';
            });
        });

        jQuery('#restaurant_grid_array_id').val(arrayToSave);
        jQuery('#restaurant_grid_indexes_id').val(indexesToSave);
    };
}).call(this);