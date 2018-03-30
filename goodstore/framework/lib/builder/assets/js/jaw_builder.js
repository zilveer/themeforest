/**
 * JaW Builder
 * main script for Page Builder by JaW templates
 * @since GS
 */
var jawBuilder;
var debug = false;
var debug_log = new Array;

(function (angular, $) {

    var open_editor = false;

    var jaw_interval = new Number;

    var new_element = {
        id: '',
        name: '',
        size: '',
        sizes: new Array,
        metabox: null,
        title: '',
        icon: ''
    };
    var new_preset = {
        name: '',
        layout: '',
        layout_size: '',
        content: ''
    }

    var builder_ws_index = 0;
    var sidebars_width = {
        'left1': [3, 4],
        'left2': [3, 4],
        'right1': [3, 4],
        'right2': [3, 4]
    }



    jawBuilder = angular.module('jawBuilder', ['jawEditor', 'ui.bootstrap', 'ui.sortable', 'tg.dynamicDirective', 'colorpicker.module', 'jaw.gallerypicker', 'jaw.simplemediapicker']);


    jawBuilder.controller('builder', ['$scope', '$dialog', '$timeout', '$window', function ($scope, $dialog, $timeout, $window) {

        //Když pohnu s elementem, tak se prerendruje - nemusel by protože se nemeni obsah, ale musi protože se při pohnutí vygumuje.
        //chce to najit kde se to gumuje
        $scope.sortableOptions = {
            stop: function (e, ui) {
                $scope.enable_save();
                jQuery.each($scope.workspace, function (key, item) {
                    if (ui.item.attr('id').replace('item-', '') == item.id) {
                        $scope.live_preview(item);
                        return false;
                    }
                });

            },
            start: function (e, ui) {
                setTimeout(function () {
                    $scope.diable_save();
                    jQuery('.ui-sortable-placeholder').height(jQuery('.ui-sortable-helper').height());
                }, 100);
            },
            delay: 200
        };


        $timeout(function () {
            check_height();
            $scope.current.bookmark = 'bookmark-build_bookmark_home';
        });

        $scope.live_preview_switch = false;
        $scope.custom_presets = new Array;
        $scope.custom_element_presets = new Array;
        $scope.content_width = 12;
        $scope.current = new Object;
        $scope.current.layout = 'fullwidth';
        $scope.description = new Object;
        $scope.searchText = "";



        /****************************************************************
         * CONTROL ELEMENTS
         ****************************************************************/

        //ADD element to workspace
        $scope.add_element = function ($id, sizes, size, icon) {
            $scope.diable_save();
            if (angular.isUndefined($scope.workspace) || $scope.workspace.length == 0) {
                $scope.workspace = new Array;
            }
            if (debug) {
                debug_log.push('add_element: id ' + $id);
                console.log('add_element: id ' + $id);
            }
            $scope.workspace.push(jQuery.extend({}, new_element));
            $scope.workspace[$scope.workspace.length - 1].id = (builder_ws_index);
            $scope.workspace[$scope.workspace.length - 1].name = $id.replace('build_', '');
            $scope.workspace[$scope.workspace.length - 1].title = 'Title ' + $id.replace('build_', '').replace(/_/ig, " ");
            $scope.workspace[$scope.workspace.length - 1].sizes = sizes.split(',');
            $scope.workspace[$scope.workspace.length - 1].size = size;
            $scope.workspace[$scope.workspace.length - 1].icon = icon;
            builder_ws_index++;
            $scope.check_width(-2);
            //LIVE  PREVIEW !!!
            $scope.live_preview($scope.workspace[$scope.workspace.length - 1]);
            $scope.enable_save();
        }


        //DELETE element
        $scope.control_delete = function (item) {
            $scope.workspace.splice($scope.workspace.indexOf(item), 1);
        }

        //CLONE element
        $scope.control_clone = function (item) {
            var index = $scope.workspace.indexOf(item) + 1;
            $scope.workspace.splice(index, 0, jQuery.extend({}, item));
            $scope.workspace[index].id = (builder_ws_index);
            $scope.workspace[index].title = 'Title ' + item.name.replace(/_/ig, " ") + ' ' + builder_ws_index;
            builder_ws_index++;
            $scope.live_preview($scope.workspace[index]);
        }

        //RESIZE element
        $scope.change_size = function (item, scale_direction) {  //scale_direction    false - down ;  true - up
            var index_of_size = item.sizes.indexOf(item.size);
            var new_size = item.size;
            if (scale_direction == true && (index_of_size < (item.sizes.length - 1)) && ((Number(new_size) < Number($scope.content_width)))) {     //Upscale
                new_size = item.sizes[index_of_size + 1];
            } else if (scale_direction == false && (index_of_size > 0)) {              //Downscale
                new_size = item.sizes[index_of_size - 1];
            }
            item.size = new_size;
            $scope.check_width(-2);
            $scope.live_preview(item);
        }


        /****************************************************************
         * EDIT - RUN
         ****************************************************************/

        //EDIT element
        $scope.control_edit = function (item) {
            if (debug) {
                debug_log.push('Can edit: ' + !open_editor);
                debug_log.push('Want edit: ');
                debug_log.push(item);
                console.log('Can edit: ' + !open_editor);
                console.log('Want edit: ');
                console.log(item);
            }
            if (open_editor == false) {

                jQuery('html,body').css('cursor', 'progress');
                open_editor = true;
                actual_edit = item.metabox;
                item.metabox = item.metabox || {};
                $scope.opts = {
                    backdrop: true,
                    keyboard: true,
                    backdropClick: false,
                    metabox: angular.copy(item.metabox),
                    templateUrl: ajaxurl + '?action=jaw_builder_editor&jaw_code=' + item.name,
                    controller: 'editor_dialog'
                };
                var d = $dialog.dialog($scope.opts);
                $scope.diable_save();
                d.open().then(function (result) {
                    if (result) {
                        item.metabox = result;
                        //LIVE  PREVIEW !!!
                        $scope.live_preview(item);
                    }
                    open_editor = false;
                    $scope.enable_save();
                    if (debug) {
                        debug_log.push('Close - Can edit: ' + !open_editor);
                        console.log('Close - Can edit: ' + !open_editor);
                    }

                });
            }

        }




        /****************************************************************
         * LAYOUTS
         ****************************************************************/

        //Resize sidebar
        $scope.resize_sidebar = function (id, scale_direction) {

            var index_of_size = sidebars_width[id].indexOf($scope.layout[id]['size']);
            if (debug) {
                debug_log.push('resize_sidebar: id->' + id + '; scale_direction->' + scale_direction + '; index_of_size->' + index_of_size);
                console.log('resize_sidebar: id->' + id + '; scale_direction->' + scale_direction + '; index_of_size->' + index_of_size);
            }
            var new_size = $scope.layout[id]['size'];
            if (scale_direction == true && (index_of_size < (sidebars_width[id].length - 1))) {     //Upscale
                new_size = sidebars_width[id][index_of_size + 1];
            } else if (scale_direction == false && (index_of_size > 0)) {              //Downscale
                new_size = sidebars_width[id][index_of_size - 1];
            }

            $scope.layout[id].size = new_size;
            $scope.check_width(id);
        }


        $scope.change_layout = function (new_layout) {
            if (debug) {
                debug_log.push('change layout old: ');
                debug_log.push($scope.layout);
                console.log('change layout old: ');
                console.log($scope.layout);
            }
            var sidebars = new_layout.split('_');
            if ($scope.check_width(-1, new_layout)) {

                jQuery.each($scope.layout, function (key, value) {
                    value.visible = false;
                });
                if (sidebars != 'fullwidth') {
                    jQuery.each(sidebars, function (key, value) {
                        $scope.layout[value].visible = true;
                    });
                }
                $scope.current.layout = new_layout;
            }
            check_height();
        }

        //search
        $scope.isSearch = function (text) {
            return (text.toLowerCase().search($scope.searchText.toLowerCase()) > -1);
        };

        $scope.changeSearch = function () {
            $scope.current.bookmark = 'bookmark-build_all';
        };


        /****************************************************************
         * CHECK WIDTH
         ****************************************************************/
        //check width and resize big elements*******************************
        $scope.check_width = function (sidebar, layout_name) {
            if (debug) {
                debug_log.push('check_width: sidebar->' + sidebar + '; new layout_name->' + layout_name);
                console.log('check_width: sidebar->' + sidebar + '; new layout_name->' + layout_name);
            }
            $scope.warningMessage = '';
            $scope.cannot_change = false;
            $scope.content_width = 12;
            if (angular.isUndefined(layout_name)) {
                var val = $scope.current.layout;
            } else {
                var val = layout_name;
            }
            jQuery.each($scope.layout, function (key, value) {
                if (jQuery.inArray(key, val.split('_')) != -1) {
                    $scope.content_width -= parseInt(value.size);
                }
            });
            jQuery.each($scope.workspace, function (key, item) { //projdu vsechny elementy
                if (debug) {
                    debug_log.push('check_width -> $scope.content_width: ' + $scope.content_width);
                    console.log('check_width -> $scope.content_width: ' + $scope.content_width);
                    debug_log.push('check_width -> item.name: ' + item.name);
                    console.log('check_width -> item.name: ' + item.name);
                    debug_log.push('check_width -> item.size: ' + item.size);
                    console.log('check_width -> item.size: ' + item.size);
                    console.log(item.sizes);
                }
                if (Number(item.size) > Number($scope.content_width)) {  //pokud je nejakej element vetsi nez sirka kontentu
                    if (debug) {
                        debug_log.push('check_width: nevyhovuje');
                        console.log('check_width: nevyhovuje');
                        debug_log.push('check_width: sizes:');
                        debug_log.push(item.sizes);
                        console.log('check_width: sizes:');
                        console.log(item.sizes);
                    }
                    jQuery.each(item.sizes, function (key, size) { //projdu vsechny velikosti nevyhovujiciho elementu (od nejmensiho)
                        if (debug) {
                            debug_log.push('check_width: each -> size: ' + size + '; content_width: ' + $scope.content_width);
                            console.log('check_width: each -> size: ' + size + '; content_width: ' + $scope.content_width);
                        }
                        if (Number($scope.content_width) < Number(size)) { //najdu velikost ktera nevyhovuje
                            if (debug) {
                                debug_log.push('check_width: nasel jsem velikost');
                                console.log('check_width:  nasel jsem velikost');
                            }
                            if (key - 1 >= 0) { //a aplikuju velikost o jendo mensi
                                item.size = item.sizes[key - 1];
                                $scope.live_preview(item);
                                return false;
                            } else {

                                switch (sidebar) {
                                    case -2: //pri pridani elementu   
                                        $scope.openMessageBox('Warning', 'The element you want to add (' + item.title + ') doesn&acute;t fit with your layout but cannot be scaled down. Change your layout, please.', 'ok');
                                        $scope.control_delete(item);
                                        break;
                                    case -1: //pri zmene layoutu
                                        $scope.cannot_change = true;
                                        break
                                    default: //pri zmene velikosti sidebaru
                                        var index_of_size = sidebars_width[sidebar].indexOf($scope.layout[sidebar].size);
                                        if (!angular.isUndefined(sidebars_width[sidebar][index_of_size - 1])) {
                                            $scope.layout[sidebar].size = sidebars_width[sidebar][index_of_size - 1];
                                        }
                                        $scope.warningMessage += item.title + ', ';
                                }
                            }
                            if (debug) {
                                debug_log.push('check_width -> zmensoval sem - item.size - po zmenšení: ' + item.size);
                                console.log('check_width -> zmensoval sem - item.size - po zmenšení: ' + item.size);
                            }
                        }
                    });
                }
                if (item.sizes[0] == "false") {
                    item.size = $scope.content_width;
                }
                check_height();
            });
            if ($scope.warningMessage != '') {
                $scope.openMessageBox('Warning', 'Some elements, cannot be smaller: ' + $scope.warningMessage, 'ok');
            }
            if ($scope.cannot_change) {
                $scope.openMessageBox('Warning', 'Some elements, cannot be smaller, please choose another layout', 'ok');
                $scope.check_width(-1, $scope.current.layout);
                return false;
            } else {
                return true;
            }




        }






        /****************************************************************
         * DESCRIPTION
         ****************************************************************/

        //DESCRIPTION
        var description_delay;
        $scope.show_desc = function (id, name, desc, img) {
            $scope.description.name = name;
            $scope.description.desc = desc;
            $scope.description.img = img;
            description_delay = setInterval(function () {
                clearInterval(description_delay);
                var position = jQuery(id).position();
                jQuery('.jaw-builder-description').show(100);
                jQuery('.jaw-builder-description').css('left', position.left);
                jQuery('.jaw-builder-description').css('top', position.top + 50);
            }, 1000);
        }
        $scope.hide_desc = function () {
            clearInterval(description_delay);
            jQuery('.jaw-builder-description').hide();
        }


        $scope.openMessageBox = function (title, msg, btns, custom_btns) {
            switch (btns) {
                case 'ok':
                    var buttons = [{
                        result: 'ok',
                        label: 'OK',
                        cssClass: 'btn-primary'
                    }];
                    break;
                case 'yes/no':
                    var buttons = [{
                        result: 'cancel',
                        label: 'Cancel'
                    }, {
                            result: 'ok',
                            label: 'OK',
                            cssClass: 'btn-primary'
                        }];
                    break;
                case 'custom':
                default:
                    var buttons = custom_btns;
            }
            $dialog.messageBox(title, msg, buttons).open();
        };


        /****************************************************************
         * PRESSETS
         ****************************************************************/

        $scope.load_preset = function (opt, la, la_size) {
            $scope.diable_save();
            if (confirm('Load Preset\n\nAre you sure?All unsave actions will be lost.')) {
                $scope.workspace = new Array;
                if (!angular.isUndefined(opt)) {
                    $scope.workspace = JSON.parse(opt);
                }
                if (!angular.isUndefined(la_size)) {
                    $scope.layout = JSON.parse(la_size);
                }
                $scope.change_layout(la);
                $scope.show_live_preview();
            }
            $scope.enable_save();
        }

        $scope.add_preset = function () {
            if (debug) {
                debug_log.push('add_preset');
                console.log('add_preset');
                console.log($scope.custom_presets);
            }
            if (angular.isUndefined($scope.custom_presets) || $scope.custom_presets.length == 0) {
                $scope.custom_presets = new Array;
            }
            $scope.custom_presets = $scope.custom_presets || [];
            if($scope.custom_presets.length > 10){
                alert('You have saved maximal number of presets.');
                return;
            }
            new_element.metabox = new_element.metabox || {};
            $scope.opts = {
                backdrop: true,
                keyboard: true,
                backdropClick: true,
                metabox: new_element.metabox,
                templateUrl: ajaxurl + '?action=jaw_builder_editor&jaw_code=' + 'add_preset', 
                controller: 'editor_dialog'
            };
            var d_presets = $dialog.dialog($scope.opts);
            d_presets.open().then(function (result) {
                if (result) {
                    $scope.custom_presets.push(jQuery.extend({}, new_preset));
                    $scope.custom_presets[$scope.custom_presets.length - 1].name = result.preset_name;
                    $scope.custom_presets[$scope.custom_presets.length - 1].layout = $scope.current.layout;
                    $scope.custom_presets[$scope.custom_presets.length - 1].layout_size = JSON.stringify($scope.layout);
                    $scope.custom_presets[$scope.custom_presets.length - 1].content = JSON.stringify($scope.workspace);
                    console.log($scope.custom_presets);
                    var text = new String();
                    text = $scope.workspace;
                    $scope.store_presets();
                }
            });

        }

        $scope.delete_preset = function (id) {
            if (confirm('Delete Preset\n\nWarning: Really want to delete this preset: ' + $scope.custom_presets[id].name)) {
                $scope.custom_presets.splice(id, 1);
                $scope.store_presets();
            }
        }
        $scope.save_preset = function (id) {
            if (confirm('Save Preset\n\nWarning: Old data will be rewritten')) {
                $scope.custom_presets[id].layout = $scope.current.layout;
                $scope.custom_presets[id].layout_size = JSON.stringify($scope.layout);
                $scope.custom_presets[id].content = JSON.stringify($scope.workspace);
                $scope.store_presets();
            }
        }

        $scope.init_presets = function () {

            if (debug) {
                debug_log.push('init_presets opt:');
                debug_log.push($window.jaw_presets);
                console.log('init_presets opt:');
                console.log($window.jaw_presets);
            }

            $scope.custom_presets = new Array;
            if ($window.jaw_presets === false || $window.jaw_presets === null || $window.jaw_presets === 'undefined') {

                $scope.custom_presets = '';
                $scope.store_presets();
            } else {

                $scope.custom_presets = $window.jaw_presets;
                jQuery.each($scope.custom_presets, function (key, preset) {
                    $scope.custom_presets[key].layout_size = preset.layout_size.replace(/\\\"/ig, '"').replace(/\\"/ig, '\"').replace(/\\\'/ig, "'");
                    $scope.custom_presets[key].content = preset.content.replace(/\\\"/ig, '"').replace(/\\"/ig, '\"').replace(/\\\'/ig, "'");
                });
            }
        }

        $scope.store_presets = function () {
            jQuery.post(
                ajaxurl,
                {
                    'action': 'pb_save_presets',
                    'jaw_pb_presets': $scope.custom_presets
                },
                function (response) {
                    if (debug) {
                        debug_log.push('presets stored');
                        console.log('presets stored' + response);
                    }
                }
                );

        }



        /****************************************************************
         * PB ELEMENT PRESET
         ****************************************************************/

        $scope.add_element_preset = function (item) {
            if (debug) {
                debug_log.push('add_element_preset');
                console.log('add_element_preset');
                console.log($scope.custom_element_presets);
            }
            if (angular.isUndefined($scope.custom_element_presets) || $scope.custom_element_presets.length == 0) {
                $scope.custom_element_presets = new Array;
            }
             new_element.metabox = new_element.metabox || {};
            $scope.opts = {
                backdrop: true,
                keyboard: true,
                backdropClick: true,
                metabox: new_element.metabox,
                templateUrl: ajaxurl + '?action=jaw_builder_editor&jaw_code=' + 'add_preset',
                controller: 'editor_dialog'
            };
            var d = $dialog.dialog($scope.opts);
            d.open().then(function (result) {
                if (result) {
                    var addedPreset = angular.copy(new_preset);
                    addedPreset.name = result.preset_name;
                    addedPreset.content = JSON.stringify($scope.workspace[$scope.workspace.indexOf(item)]);
                    $scope.custom_element_presets.push(jQuery.extend({}, new_preset));
                    var id = $scope.custom_element_presets.length - 1;
                    $scope.custom_element_presets[id].name = "Saving...";
                    $scope.store_element_presets(addedPreset, 'add', function(){
                        $timeout(function(){
                            $scope.custom_element_presets[id] = addedPreset;
                        });
                    });
                }
            });
        }


        $scope.init_element_presets = function () {
            if (debug) {
                debug_log.push('init_element_presets opt:');
                debug_log.push($window.jaw_presets_elements);
                console.log('init_element_presets opt:');
                console.log($window.jaw_presets_elements);
            }
            $scope.custom_element_presets = new Array;
            if ($window.jaw_presets_elements === false || $window.jaw_presets_elements === null || $window.jaw_presets_elements === 'undefined') {

                $scope.store_element_presets({}, 'init');
                $scope.custom_element_presets = '';
            } else {

                $scope.custom_element_presets = $.map($window.jaw_presets_elements, function(value, index) {
                                                    return [value];
                                                });
                console.log($scope.custom_element_presets);
                jQuery.each($scope.custom_element_presets, function (key, preset) {
                    $scope.custom_element_presets[key].content = preset.content.replace(/\\\"/ig, '"');
                });


            }


        }


        $scope.load_element_preset = function (opt) {
            if (!angular.isUndefined(opt)) {
                $scope.workspace.push(JSON.parse(opt.replace(/\\\"/ig, '"')));
            }
            $scope.show_live_preview();

        }

        $scope.delete_element_preset = function (id) {
            if (confirm('Delete Element Preset\n\nWarning: Really want to delete this preset: ' + $scope.custom_element_presets[id].name)) {
                $scope.custom_element_presets[id].name = "Deleting...";
                $scope.store_element_presets(id, 'delete', function(){
                    $timeout(function(){
                        $scope.custom_element_presets.splice(id, 1);
                    });
                });
            }
        }

        $scope.store_element_presets = function (preset,operation, callback) {
            jQuery.post(
                ajaxurl,
                {
                    'action': 'pb_save_element_presets',
                    'data': preset,
                    'operation' : operation
                },
                function (response) {
                    if (debug) {
                        debug_log.push('elements presets stored');
                        console.log('elements presets stored' + response);
                    }
                    if(response !== ''){
                        alert('Error: '  + response);
                        return;
                    }
                    if(callback != undefined){
                        callback();
                    }
                }
                );

        }


        /****************************************************************
         * LIVE PREVIEW
         ****************************************************************/

        $scope.control_live = function (item) {
            item.type = 'element';
            if (jQuery('#item-' + item.id).hasClass('live')) {
                jQuery('#item-' + item.id).removeClass('live');
                jQuery('#item-' + item.id + ' .builder_element_content').html('');
            } else {
                $scope.load_live_preview(item);
            }
        }

        $scope.control_live_sidebar = function (name) {
            var item = $scope.layout[name] || new Object;
            item.id = name;
            item.name = 'sidebar';
            item.metabox = item.metabox || new Object;
            item.metabox.build_inline_sidebar = $scope.layout[name].metabox.build_sidebar;
            item.metabox.bar_type = 'off';
            item.title = '';
            item.type = 'sidebar';

            $scope.load_live_preview(item);
        }

        $scope.switch_live_preview = function () {
            if (debug) {
                debug_log.push('switch_live_preview: turn to ' + !$scope.live_preview_switch);
                console.log('switch_live_preview: turn to ' + !$scope.live_preview_switch);
            }

            if ($scope.live_preview_switch) {
                $scope.live_preview_switch = false;
                jQuery('.builder_live_switch .live_info').html('OFF');
                jQuery('#jaw_builder').removeClass('live-preview');
                jQuery('.builder-element').removeClass('live');
                jQuery.each($scope.workspace, function (key, item) {
                    jQuery('#item-' + item.id + ' .builder_element_content').html('');
                });
                jQuery.each($scope.layout, function (key, item) {
                    jQuery('#section-jaw-pb-sidebar_' + key + ' .builder_sidebar_content').html('');
                });
            } else {
                // if (confirm('Warning: Page builder with live preview is slowly.')) {
                jQuery('.builder_live_switch .live_info').html('ON ');
                jQuery('#jaw_builder').addClass('live-preview');
                $scope.live_preview_switch = true;
                $scope.show_live_preview();
                // }
            }
        }


        $scope.show_live_preview = function () {
            jQuery.each($scope.workspace, function (key, item) {
                $scope.live_preview(item);
            });
            jQuery.each($scope.layout, function (key, item) {
                if (item.visible) {
                    item.id = key;
                    item.name = 'sidebar';
                    item.metabox = item.metabox || new Object;
                    item.metabox.build_inline_sidebar = item.metabox.build_sidebar;
                    item.type = 'sidebar';
                    $scope.live_preview(item);
                }
            });
        };

        //LIVE  PREVIEW !!!  
        $scope.live_preview = function (live_item) {
            if (debug) {
                debug_log.push('live_preview(' + $scope.live_preview_switch + '): load ' + live_item.name);
                console.log('live_preview(' + $scope.live_preview_switch + '): load ' + live_item.name);
            }
            if ($scope.live_preview_switch) {
                $scope.load_live_preview(live_item);
            } else if (jQuery('#item-' + live_item.id).hasClass('live')) {
                $scope.load_live_preview(live_item);
            }
        }


        $scope.load_live_preview = function (live_item) {
            if (debug) {
                debug_log.push('load_live_preview(' + live_item.type + '): name ' + live_item.name);
                console.log('load_live_preview(' + live_item.type + '): load ' + live_item.name);
            }
            jQuery('.jaw-builder-background.loading').show();
            if (angular.isUndefined(live_item.type)) {
                live_item.type = 'element';
            }
            jQuery.post(
                ajaxurl,
                {
                    'action': 'jaw_live_preview',
                    'metabox': live_item.metabox,
                    'name': live_item.name,
                    'title': live_item.title,
                    'size': live_item.size
                },
                function (response) {
                    if (debug) {
                        debug_log.push('live_preview(' + $scope.live_preview_switch + '): loaded ' + live_item.name + '---' + live_item.id);
                        console.log('live_preview(' + $scope.live_preview_switch + '): loaded ' + live_item.name + '---' + live_item.id + '--------' + response + '------' + live_item.type);
                    }
                    if (live_item.type == 'element') {
                        jQuery('#item-' + live_item.id + ' .builder_element_content').html(response);
                        jQuery('#item-' + live_item.id).addClass('live');
                    } else {
                        jQuery('#section-jaw-pb-sidebar_' + live_item.id + ' .builder_sidebar_content').html(response);
                    }
                    jQuery('#item-' + live_item.id + ' .builder_element_content iframe').load(function () {
                        var on_load_to = setTimeout(function () {
                            jQuery('#item-' + live_item.id + ' .builder_element_content iframe').height(jQuery('#item-' + live_item.id + ' .builder_element_content iframe').contents().find('.iframe_content').height());
                            jQuery('#item-' + live_item.id + ' .zaves').height(jQuery('#item-' + live_item.id + ' .builder_element_content iframe').contents().find('.iframe_content').height() - 20);
                            jQuery('.jaw-builder-background.loading').hide();
                        }, 500);

                    });

                    jQuery('#section-jaw-pb-sidebar_' + live_item.id + ' .builder_sidebar_content iframe').load(function () {
                        var on_load_to = setTimeout(function () {
                            jQuery('#section-jaw-pb-sidebar_' + live_item.id + ' .builder_sidebar_content iframe').height(jQuery('#section-jaw-pb-sidebar_' + live_item.id + ' .builder_sidebar_content iframe').contents().find('.iframe_content').height());
                            jQuery('#section-jaw-pb-sidebar_' + live_item.id + ' .zaves').height(jQuery('#section-jaw-pb-sidebar_' + live_item.id + ' .builder_sidebar_content iframe').contents().find('.iframe_content').height() - 20);
                            jQuery('.jaw-builder-background.loading').hide();
                        }, 500);
                    });
                }
                );
        }

        //init workspace
        $scope.workspace = new Array;
        if (jaw_pb != null && jaw_pb != 'N!' && jaw_pb != false && !angular.isUndefined(jaw_pb)) {
            if (debug) {
                debug_log.push('load workspace (jaw_pb -> $scope.workspace)');
                console.log('load workspace (jaw_pb -> $scope.workspace)');
            }
            $scope.workspace = jaw_pb;
            jQuery.each($scope.workspace, function (key, item) {
                if (builder_ws_index < (item.id + 1)) {
                    builder_ws_index = item.id + 1;
                }
                $scope.live_preview(item);
            });
            if (debug) {
                debug_log.push('builder_ws_index: ' + builder_ws_index);
                console.log('builder_ws_index: ' + builder_ws_index);
            }
        }


        if (jaw_pb_layout != null && jaw_pb_layout != 'N!' && jaw_pb_layout != false) {
            if (debug) {
                debug_log.push('load layout (jaw_pb_layout -> $scope.layout)');
                console.log('load layout (jaw_pb_layout -> $scope.layout)');
            }
            $scope.layout = jaw_pb_layout;
            $scope.current.layout = '';
            jQuery.each($scope.layout, function (key, value) {
                if (value.visible) {
                    if ($scope.current.layout != '') {
                        $scope.current.layout += '_';
                    }
                    $scope.current.layout += key;
                }
            });
            if ($scope.current.layout == '') {
                $scope.current.layout = 'fullwidth';
            }
            if (!angular.isUndefined($scope.current.layout)) {
                $scope.change_layout($scope.current.layout);
            }

        } else {
            $scope.current.layout = 'fullwidth';
            $scope.layout = {
                'left1': {
                    name: 'page_sidebar',
                    size: 3
                },
                'left2': {
                    name: 'page_sidebar',
                    size: 3
                },
                'right1': {
                    name: 'page_sidebar',
                    size: 3
                },
                'right2': {
                    name: 'page_sidebar',
                    size: 3
                }
            };
        }


        /****************************************************************
         * UTILS
         ****************************************************************/
        $scope.enable_save = function () {
            clearInterval(jaw_interval);

            jaw_interval = setInterval(function () {
                if ($scope.workspace.length == JSON.parse(jQuery('input[name^=jaw_pb]').val()).length) {
                    clearInterval(jaw_interval);
                    jQuery('#publishing-action #publish.button').prop('disabled', false);
                } else {
                    $scope.$apply();
                }
            }, 500);

        }

        $scope.diable_save = function () {
            jQuery('#publishing-action #publish.button').prop('disabled', true);
            //jQuery('#publishing-action .spinner').show();
        }

        $scope.replace_special_char = function (name) {
            return name.replace(/\_/g, ' ');
        }

    }]);
        
    //JWPB COntroller END ===================================================================================
        
        
    jawBuilder.controller('editor_dialog', ['$scope', '$timeout', 'dialog', function ($scope, $timeout, dialog) {

        $scope.bookmarks = [];
        $scope.edit = dialog.options.metabox;

        $timeout(function () {
            jQuery('html,body').css('cursor', 'default');
            if (jQuery('.content > .section.sub_all').length > 0) {
                jQuery.each(jQuery('.content > .section.sub_all'), function ($entity) {
                    $scope.bookmarks.push(jQuery(this).find('h3').html());
                });
            }
            jQuery('.jaw-editor-area').each(function () {
                init_wp_editor(jQuery(this).attr("id"));
                var ed_id = jQuery(this).attr("id");
                var editor_visual = '.tinymce-tabs .visual.' + ed_id;
                var editor_html = '.tinymce-tabs .html.' + ed_id;
                jQuery(editor_visual).addClass('active');
                jQuery(editor_html).removeClass('active');
                jQuery(editor_visual).click(function () {
                    activateTinyMCETab('visual', editor_visual, editor_html, ed_id);
                });
                jQuery(editor_html).click(function () {
                    activateTinyMCETab('html', editor_visual, editor_html, ed_id);
                });
            });
            jQuery('#editor_container').height(jQuery('body').height() * 0.8 - 40);
            open_editor = false;
        });
        $scope.$watch('bookmarks', function () {
            setTimeout(function () {
                $scope.switch_mark(0);
            }, 100);
        });
        //Switch bookmarks
        $scope.switch_mark = function (i) {
            jQuery('.content > .section.sub_all').hide();
            jQuery('.editor_bookmarks li').removeClass('active');
            jQuery('.content > .section.sub_all').eq(i).show();
            jQuery('.editor_bookmarks li').eq(i).addClass('active');
        };

        //  SAVE
        $scope.save_editor = function () {
            jQuery('.jaw-editor-area').each(function () {
                if (jaw_editor_open && window.tinyMCE.get(jQuery(this).attr('id')) !== undefined) {
                    $scope.edit[jQuery(this).attr('id')] = window.tinyMCE.get(jQuery(this).attr('id')).getContent();
                    cancel_wp_editor(jQuery(this).attr('id'));
                }
            });

            dialog.close($scope.edit);
            open_editor = false;
        };

        //  CANCEL
        $scope.cancel_editor = function () {
            jQuery('.jaw-editor-area').each(function () {
                cancel_wp_editor(jQuery(this).attr('id'));
            });
            open_editor = false;
            dialog.close();
        };
    }]);



    jQuery(document).ready(function () {
        // conzole.open();
        jQuery('.builder_editor').hide();
        jQuery('.jaw-builder-background.loading').hide();
        angular.bootstrap(jQuery('#jaw_page_builder'), ['jawBuilder']);
        check_height();

        jQuery(".jaw-metabox-workspace").resize(function (e) {
            check_height();
        });






        var switch_pb = function (state, id) {
            if (debug) {
                debug_log.push('switch_pb to: ' + state);
                console.log('switch_pb to: ' + state);
            }
            if (state) {
                jQuery('#wp-content-wrap').removeClass('tmce-active html-active');

                jQuery('#wp-content-editor-container').hide();
                jQuery('#content-resize-handle').hide();
                jQuery('#post-status-info').hide();

                jQuery('#wp-content-wrap').append(jQuery('#jaw_builder'));

                jQuery('#jaw_builder').show();
                jQuery('#wp-content-wrap').addClass('composer-active');
                setUserSetting('editor', 'composer');
                // Triggers full refresh
                try {
                    jQuery(window).resize();
                } catch (err) {
                }
                jQuery('.jaw_pb_startup').val('true');
            } else {
                $('#wp-content-wrap').removeClass('composer-active');
                $('#jaw_builder').hide();
                $('#wp-content-editor-container').show();
                $('#content-resize-handle').show();
                $('#post-status-info').show();
                try {
                    $(window).resize();
                } catch (err) {
                }
                $('.jaw_pb_startup').val('false');
                if (id == 'content-tmce') {
                    $('#ed_toolbar').hide();
                    $('#content_parent').show(); 
                    $('#wp-content-wrap').addClass('tmce-active');
                } else {
                    $('#ed_toolbar').show();
                    $('#content_parent').hide();	 
                    $('#wp-content-wrap').addClass('html-active');
                }
            }
        }

        //ADD REVObuilder to editor
        if (jQuery('#jaw_page_builder').length > 0) {
            jQuery('#jaw_page_builder').hide();

            jQuery('#wp-content-editor-tools')
                .find('.wp-switch-editor')
                .click(function () {
                switch_pb(false, jQuery(this).attr('id'));
                //switchEditors.switchto(this); - 29/02/2016 - v novym WordPressu se to vola jinak - ale k cemu to tady vubec bylo?
                //return false; - 12/07/2016 - V novym WP to delalo problemy
            }).end()
                .prepend(
                jQuery('<a id="content-composer" class="wp-switch-editor switch-revo" ><span></span></a>')
                    .click(function () {
                        switch_pb(true);
                        return false;
                    })
                );
            if (jQuery('.jaw_pb_startup').val() == 'true') {
                switch_pb(true);
            }

            if (jQuery(document).width() < 1024) {
                postboxes._pb_edit(1);
            }

        }
    });
    function check_height() {
        if (debug) {
            debug_log.push('check_height');
            console.log('check_height');
        }
        jQuery('.jaw-pb-sidebar .builder_sidebar_content').css('min-height', jQuery(".jaw-metabox-workspace").height() - 9);
    }



    //PRO IE8
    if (!Array.prototype.indexOf) {
        Array.prototype.indexOf = function (elt /*, from*/) {
            var len = this.length >>> 0;

            var from = Number(arguments[1]) || 0;
            from = (from < 0)
                ? Math.ceil(from)
                : Math.floor(from);
            if (from < 0)
                from += len;

            for (; from < len; from++) {
                if (from in this &&
                    this[from] === elt)
                    return from;
            }
            return -1;
        };
    }

})(angular, jQuery);