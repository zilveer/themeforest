// Easy Responsive Tabs Plugin
// Author: Samson.Onna <Email : samson3d@gmail.com>
(function ($) {
    $.fn.extend({
        easyResponsiveTabs: function (options) {
            //Set the default values, use comma to separate the settings, example:
            var defaults = {
                type: 'default', //default, vertical, accordion;
                width: 'auto',
                fit: true,
                closed: false,
                activate: function(){}
            }
            //Variables
            var options = $.extend(defaults, options);
            var opt = options, jtype = opt.type, jfit = opt.fit, jwidth = opt.width, vtabs = 'vertical', accord = 'accordion';
            var hash = window.location.hash;
            var historyApi = !!(window.history && history.replaceState);

            //Events
            $(this).bind('tabactivate', function(e, currentTab) {
                if(typeof options.activate === 'function') {
                    options.activate.call(currentTab, e)
                }
            });

            //Main function
            this.each(function () {
                var $respTabs = $(this);
                var $respTabsList = $respTabs.find('ul.resp-tabs-list');
                var respTabsId = $respTabs.attr('id');
                $respTabs.find('ul.resp-tabs-list li').addClass('resp-tab-item');
                $respTabs.css({
                    'display': 'block',
                    'width': jwidth
                });

                $respTabs.find('.resp-tabs-container > div').addClass('resp-tab-content');
                jtab_options();
                //Properties Function
                function jtab_options() {
                    if (jtype == vtabs) {
                        $respTabs.addClass('resp-vtabs');
                    }
                    if (jfit == true) {
                        $respTabs.css({ width: '100%' });
                    }
                    if (jtype == accord) {
                        $respTabs.addClass('resp-easy-accordion');
                        $respTabs.find('.resp-tabs-list').css('display', 'none');
                    }
                }

                //Assigning the h2 markup to accordion title
                var $tabItemh2;
                $respTabs.find('.resp-tab-content').before("<h2 class='resp-accordion' role='tab'><span class='resp-arrow'></span></h2>");

                var itemCount = 0;
                $respTabs.find('.resp-accordion').each(function () {
                    $tabItemh2 = $(this);
                    var $tabItem = $respTabs.find('.resp-tab-item:eq(' + itemCount + ')');
                    var $accItem = $respTabs.find('.resp-accordion:eq(' + itemCount + ')');
                    $accItem.append($tabItem.html());
                    $accItem.data($tabItem.data());
                    $tabItemh2.attr('aria-controls', 'tab_item-' + (itemCount));
                    itemCount++;
                });

                //Assigning the 'aria-controls' to Tab items
                var count = 0,
                    $tabContent;
                $respTabs.find('.resp-tab-item').each(function () {
                    $tabItem = $(this);
                    $tabItem.attr('aria-controls', 'tab_item-' + (count));
                    $tabItem.attr('role', 'tab');

                    //Assigning the 'aria-labelledby' attr to tab-content
                    var tabcount = 0;
                    $respTabs.find('.resp-tab-content').each(function () {
                        $tabContent = $(this);
                        $tabContent.attr('aria-labelledby', 'tab_item-' + (tabcount));
                        tabcount++;
                    });
                    count++;
                });

                // Show correct content area
                var tabNum = 0;
                if(hash!='') {
                    var matches = hash.match(new RegExp(respTabsId+"([0-9]+)"));
                    if (matches!==null && matches.length===2) {
                        tabNum = parseInt(matches[1],10)-1;
                        if (tabNum > count) {
                            tabNum = 0;
                        }
                    }
                }

                //Active correct tab
                $($respTabs.find('.resp-tab-item')[tabNum]).addClass('resp-tab-active');

                //keep closed if option = 'closed' or option is 'accordion' and the element is in accordion mode
                if(options.closed !== true && !(options.closed === 'accordion' && !$respTabsList.is(':visible')) && !(options.closed === 'tabs' && $respTabsList.is(':visible'))) {
                    $($respTabs.find('.resp-accordion')[tabNum]).addClass('resp-tab-active');
                    $($respTabs.find('.resp-tab-content')[tabNum]).addClass('resp-tab-content-active').attr('style', 'display:block');
                }
                //assign proper classes for when tabs mode is activated before making a selection in accordion mode
                else {
                    $($respTabs.find('.resp-tab-content')[tabNum]).addClass('resp-tab-content-active resp-accordion-closed')
                }

                //Tab Click action function
                $respTabs.find("[role=tab]").each(function () {

                    var $currentTab = $(this);
                    $currentTab.click(function () {

                        var $currentTab = $(this);
                        var $tabAria = $currentTab.attr('aria-controls');

                        if ($currentTab.hasClass('resp-accordion') && $currentTab.hasClass('resp-tab-active')) {
                            $respTabs.find('.resp-tab-content-active').slideUp('', function () { $(this).addClass('resp-accordion-closed'); });
                            $currentTab.removeClass('resp-tab-active');
                            return false;
                        }
                        if (!$currentTab.hasClass('resp-tab-active') && $currentTab.hasClass('resp-accordion')) {
                            $respTabs.find('.resp-tab-active').removeClass('resp-tab-active');
                            $respTabs.find('.resp-tab-content-active').slideUp().removeClass('resp-tab-content-active resp-accordion-closed');
                            $respTabs.find("[aria-controls=" + $tabAria + "]").addClass('resp-tab-active');

                            $respTabs.find('.resp-tab-content[aria-labelledby = ' + $tabAria + ']').slideDown().addClass('resp-tab-content-active');
                        } else {
                            $respTabs.find('.resp-tab-active').removeClass('resp-tab-active');
                            $respTabs.find('.resp-tab-content-active').removeAttr('style').removeClass('resp-tab-content-active').removeClass('resp-accordion-closed');
                            $respTabs.find("[aria-controls=" + $tabAria + "]").addClass('resp-tab-active');
                            $respTabs.find('.resp-tab-content[aria-labelledby = ' + $tabAria + ']').addClass('resp-tab-content-active').attr('style', 'display:block');
                        }
                        //Trigger tab activation event
                        $currentTab.trigger('tabactivate', $currentTab);
                    });

                });

                //Window resize function
                $(window).resize(function () {
                    $respTabs.find('.resp-accordion-closed').removeAttr('style');
                });
            });
        }
    });
})(jQuery);

jQuery(document).ready(function($) {
    // content type meta tab
    $('.porto-meta-tab').easyResponsiveTabs({
        type: 'vertical'//, //default, vertical, accordion;
    });

    // taxonomy meta tab
    $('.porto-tab-row').hide();
    $('.porto-tax-meta-tab').on('click', function(e) {
        e.preventDefault();
        var tab = $(this).attr('data-tab');
        $('.porto-tab-row[data-tab="' + tab + '"]').toggle();
        return false;
    });

    // color field
    $('.porto-meta-color').each(function() {
        var $el = $(this),
            $c = $el.find('.porto-color-field'),
            $t = $el.find('.porto-color-transparency');

        $c.wpColorPicker({
            change: function( e, ui ) {
                $( this ).val( ui.color.toString() );
                $t.removeAttr( 'checked' );
            },
            clear: function( e, ui ) {
                $t.removeAttr( 'checked' );
            }
        });
        $t.on('click', function() {
            if ( $( this ).is( ":checked" ) ) {
                $c.attr('data-old-color', $c.val());
                $c.val( 'transparent' );
                $el.find( '.wp-color-result' ).css('background-color', 'transparent');
            } else {
                if ( $c.val() === 'transparent' ) {
                    var oc = $c.attr('data-old-color');
                    $el.find( '.wp-color-result' ).css('background-color', oc);
                    $c.val(oc);
                }
            }
        });
    });

    // meta required filter
    var filters = ['.postoptions .metabox', '.form-table .form-field'];
    $.each(filters, function(index, filter) {
        $(filter + '[data-required]').each(function() {
            var $el = $(this),
                id = $el.data('required'),
                value = $el.data('value'),
                $required = $(filter + ' [name="' + id + '"]'),
                type = $required.attr('type');

            if ($required.prop('type') == 'select-one') {
                $required.change(function() {
                    if ($required.val() == value) {
                        $el.show();
                    } else {
                        $el.hide();
                    }
                });
                $required.change();
            } else {
                if (type == 'checkbox') {
                    $required.change(function() {
                        if ($(this).is(':checked')) {
                            if (value) {
                                $el.show();
                            } else {
                                $el.hide();
                            }
                        } else {
                            if (!value) {
                                $el.show();
                            } else {
                                $el.hide();
                            }
                        }
                    });
                    $required.change();
                } else if (type == 'radio') {
                    $required.click(function() {
                        if ($(this).is(':checked')) {
                            if (value == $(this).val()) {
                                $el.show();
                            } else {
                                $el.hide();
                            }
                        }
                    });
                    $(filter + ' [name="' + id + '"]:checked').click();
                }
            }
        });
    });

    // codemirror
    if (typeof CodeMirror != 'undefined') {
        if (document.getElementById("custom_css")) CodeMirror.fromTextArea(document.getElementById("custom_css"), { lineNumbers: true, mode: 'css' });
        if (document.getElementById("custom_js_head")) CodeMirror.fromTextArea(document.getElementById("custom_js_head"), { lineNumbers: true, mode: 'javascript' });
        if (document.getElementById("custom_js_body")) CodeMirror.fromTextArea(document.getElementById("custom_js_body"), { lineNumbers: true, mode: 'javascript' });
    }
});

// Uploading files
var file_frame;
var clickedID;

jQuery(document).off( 'click', '.button_upload_image').on( 'click', '.button_upload_image', function( event ){

    event.preventDefault();

    // If the media frame already exists, reopen it.
    if ( !file_frame ) {
        // Create the media frame.
        file_frame = wp.media.frames.downloadable_file = wp.media({
            title: 'Choose an image',
            button: {
                text: 'Use image'
            },
            multiple: false
        });
    }

    file_frame.open();
    
    clickedID = jQuery(this).attr('id');
    
    // When an image is selected, run a callback.
    file_frame.on( 'select', function() {
        attachment = file_frame.state().get('selection').first().toJSON();

        jQuery('#' + clickedID).val( attachment.url );
        if (jQuery('#' + clickedID).attr('data-name'))
            jQuery('#' + clickedID).attr('name', jQuery('#' + clickedID).attr('data-name'));

        file_frame.close();
    });
});

jQuery(document).off( 'click', '.button_attach_image').on( 'click', '.button_attach_image', function( event ){

    event.preventDefault();

    // If the media frame already exists, reopen it.
    if ( !file_frame ) {
        // Create the media frame.
        file_frame = wp.media.frames.downloadable_file = wp.media({
            title: 'Choose an image',
            button: {
                text: 'Use image'
            },
            multiple: false
        });
    }

    file_frame.open();

    clickedID = jQuery(this).attr('id');

    // When an image is selected, run a callback.
    file_frame.on( 'select', function() {
        attachment = file_frame.state().get('selection').first().toJSON();

        jQuery('#' + clickedID).val( attachment.id );
        jQuery('#' + clickedID + '_thumb').html('<img src="' + attachment.url + '"/>');
        if (jQuery('#' + clickedID).attr('data-name'))
            jQuery('#' + clickedID).attr('name', jQuery('#' + clickedID).attr('data-name'));

        file_frame.close();
    });
});

jQuery(document).on( 'click', '.button_remove_image', function( event ){
    
    var clickedID = jQuery(this).attr('id');
    jQuery('#' + clickedID).val( '' );
    jQuery('#' + clickedID + '_thumb').html('');

    return false;
});

jQuery(function($) {

    function updatePortoMenuOptions(elem, shift) {
        var current_elem = elem;
        var depth_shift = shift;
        var classNames = current_elem.attr('class').split(' ');

        for (var i = 0; i < classNames.length; i+=1) {
            if (classNames[i].indexOf('menu-item-depth-') >= 0) {
                var depth = classNames[i].split('menu-item-depth-');
                var id = current_elem.attr('id');

                depth = parseInt(depth[1]) + depth_shift;
                id = id.replace('menu-item-', '');

                if (depth == 0) {
                    current_elem.find('.edit-menu-item-level1-' + id).hide().find('select, input, textarea').each(function() {
                        $(this).removeAttr('name');
                    });
                    current_elem.find('.edit-menu-item-level0-'+id).show().find('select, input[type="text"], textarea').each(function() {
                        if ($(this).val()) {
                            $(this).attr('name', $(this).attr('data-name'));
                        } else {
                            $(this).removeAttr('name');
                        }
                    });
                    current_elem.find('.edit-menu-item-level0-'+id).find('input[type="checkbox"]').each(function() {
                        if ($(this).is(':checked')) {
                            $(this).attr('name', $(this).attr('data-name'));
                        } else {
                            $(this).removeAttr('name');
                        }
                    });
                    current_elem.find('.edit-menu-item-level01-'+id).show().find('select, input[type="text"], textarea').each(function() {
                        if ($(this).val()) {
                            $(this).attr('name', $(this).attr('data-name'));
                        } else {
                            $(this).removeAttr('name');
                        }
                    });
                    current_elem.find('.edit-menu-item-level01-'+id).find('input[type="checkbox"]').each(function() {
                        if ($(this).is(':checked')) {
                            $(this).attr('name', $(this).attr('data-name'));
                        } else {
                            $(this).removeAttr('name');
                        }
                    });
                } else if (depth == 1) {
                    current_elem.find('.edit-menu-item-level0-' + id).hide().find('select, input, textarea').each(function() {
                        $(this).removeAttr('name');
                    });
                    current_elem.find('.edit-menu-item-level1-'+id).show().find('select, input[type="text"], textarea').each(function() {
                        if ($(this).val()) {
                            $(this).attr('name', $(this).attr('data-name'));
                        } else {
                            $(this).removeAttr('name');
                        }
                    });
                    current_elem.find('.edit-menu-item-level1-'+id).find('input[type="checkbox"]').each(function() {
                        if ($(this).is(':checked')) {
                            $(this).attr('name', $(this).attr('data-name'));
                        } else {
                            $(this).removeAttr('name');
                        }
                    });
                    current_elem.find('.edit-menu-item-level01-'+id).show().find('select, input[type="text"], textarea').each(function() {
                        if ($(this).val()) {
                            $(this).attr('name', $(this).attr('data-name'));
                        } else {
                            $(this).removeAttr('name');
                        }
                    });
                    current_elem.find('.edit-menu-item-level01-'+id).find('input[type="checkbox"]').each(function() {
                        if ($(this).is(':checked')) {
                            $(this).attr('name', $(this).attr('data-name'));
                        } else {
                            $(this).removeAttr('name');
                        }
                    });
                } else {
                    current_elem.find('.edit-menu-item-level0-'+id).hide().find('select, input, textarea').each(function() {
                        $(this).removeAttr('name');
                    });
                    current_elem.find('.edit-menu-item-level1-'+id).hide().find('select, input, textarea').each(function() {
                        $(this).removeAttr('name');
                    });
                    current_elem.find('.edit-menu-item-level01-'+id).hide().find('select, input, textarea').each(function() {
                        $(this).removeAttr('name');
                    });
                }
            }
        }
    }

    $(document).on('change', '.menu-item select, .menu-item textarea, .menu-item input[type="text"]', function() {
        var that = $('body #' + $(this).attr('id'));
        var value = $(this).val();
        var name = $(this).attr('data-name');
        if (value) {
            that.attr('name', name);
        } else {
            that.removeAttr('name');
        }
    });

    $(document).on('change', '.menu-item input[type="checkbox"]', function() {
        var that = $('body #' + $(this).attr('id'));
        var value = $(this).is(':checked');
        var name = $(this).attr('data-name');
        if (value) {
            that.attr('name', name);
        } else {
            that.removeAttr('name');
        }
    });

    $('#update-nav-menu').bind('click', function(e) {
        if ( e.target && e.target.className ) {
            if ( -1 != e.target.className.indexOf('item-delete') ) {
                var clickedEl = e.target;
                var itemID = parseInt(clickedEl.id.replace('delete-', ''), 10);
                var menu_item = $('#menu-item-' + itemID);
                var children = menu_item.childMenuItems();
                children.each(function() {
                    updatePortoMenuOptions($(this), -1);
                });
            }
        }
    });

    $( "#menu-to-edit" ).on( "sortstop", function( event, ui ) {
        var menu_item = ui.item;
        setTimeout(function() {
            updatePortoMenuOptions(menu_item, 0);
            var children = menu_item.childMenuItems();
            children.each(function() {
                updatePortoMenuOptions($(this), 0);
            })
        }, 200);
    } );

    // Remove import success values
    if ($('#redux-form-wrapper').length) {
        var $referer = $('#redux-form-wrapper input[name="_wp_http_referer"]');
        var value = $referer.val();
        value = value.replace('&import_success=true', '');
        value = value.replace('&import_masterslider_success=true', '');
        value = value.replace('&import_widget_success=true', '');
        value = value.replace('&import_options_success=true', '');
        value = value.replace('&compile_theme_success=true', '');
        value = value.replace('&compile_theme_rtl_success=true', '');
        value = value.replace('&compile_plugins_success=true', '');
        value = value.replace('&compile_plugins_rtl_success=true', '');
        $referer.val(value);
    }

    function alertLeavePage(e) {
        var dialogText = "Are you sure you want to leave?";
        e.returnValue = dialogText;
        return dialogText;
    }

    function addAlertLeavePage() {
        $('.porto-install-demos .button-install-demo').attr('disabled', 'disabled');
        $(window).bind('beforeunload', alertLeavePage);
    }

    function removeAlertLeavePage() {
        $('.porto-install-demos .button-install-demo').removeAttr('disabled');
        $(window).unbind('beforeunload', alertLeavePage);
        setTimeout(function() {
            $('.porto-install-demos #import-status').slideUp().html('');
        }, 3000);
    }

    function showImportMessage(selected_demo, message, count, index) {
        html = '';
        if (selected_demo) {
            html += '<h3>Installing ' + $('#' + selected_demo).html() + '</h3>';
        }
        if (message) {
            html += '<strong>' + message + '</strong>';
        }
        if (count && index) {
            percent = index / count * 100;
            if (percent > 100)
                percent = 100;
            html += '<div class="import-progress-bar"><div style="width:' + percent + '%;"></div></div>';
        }
        $('.porto-install-demos #import-status').stop().show().html(html);
    }

    // filter demos
    if ($('#theme-install-demos').length) {
        var $install_demos = $('#theme-install-demos').isotope(),
            $demos_filter = $('.demo-sort-filters');

        $demos_filter.find('.sort-source li').click(function(e) {
            e.preventDefault();
            var $this = $(this),
                filter = $this.data('filter-by');
            $install_demos.isotope({
                filter: (filter == '*' ? filter : ('.' + filter))
            });
            $demos_filter.find('.sort-source li').removeClass('active');
            $this.addClass('active');
            return false;
        });
        $demos_filter.find('.sort-source li[data-active="true"]').click();
    }

    // install demo
    $( '.button-install-demo' ).live( 'click', function(e) {
        e.preventDefault();
        var $this = $(this),
            selected_demo = $this.data( 'demo-id' ),
            disabled = $this.attr('disabled');

        if (disabled)
            return;

        addAlertLeavePage();

        $('#porto-install-demo-type').val(selected_demo);
        $('#porto-install-options .theme-name').html($this.closest('.theme-wrapper').find('.theme-name').html());
        $('#porto-install-options').slideDown();

        $('html, body').stop().animate({
            scrollTop: $('#porto-install-options').offset().top - 50
        }, 600);

    });

    // cancel import button
    $('#porto-import-no').click(function() {
        $('#porto-install-options').slideUp();
        removeAlertLeavePage();
    });

    // import
    $('#porto-import-yes').click(function() {
        var demo = $('#porto-install-demo-type').val(),
            options = {
                demo: demo,
                reset_menus: $('#porto-reset-menus').is(':checked'),
                reset_widgets: $('#porto-reset-widgets').is(':checked'),
                import_dummy: $('#porto-import-dummy').is(':checked'),
                import_shortcodes: $('#porto-import-shortcodes').is(':checked'),
                import_widgets: $('#porto-import-widgets').is(':checked'),
                //import_sliders: $('#porto-import-sliders').is(':checked'),
                import_options: $('#porto-import-options').is(':checked'),
                import_icons: $('#porto-import-icons').is(':checked')
            };

        if (options.demo) {
            showImportMessage(demo, '');
            porto_import_options(options);
        }
        $('#porto-install-options').slideUp();
    });

    // import options
    function porto_import_options(options) {
        if (!options.demo) {
            removeAlertLeavePage();
            return;
        }
        if (options.import_options) {
            var demo = options.demo,
                data = {'action': 'porto_import_options', 'demo': demo};

            showImportMessage(demo, 'Importing theme options');

            $.post(ajaxurl, data, function(response) {
                if (response) showImportMessage(demo, response);
                porto_reset_menus(options);
            }).fail(function(response) {
                    porto_reset_menus(options);
                });
        } else {
            porto_reset_menus(options);
        }
    }

    // reset_menus
    function porto_reset_menus(options) {
        if (!options.demo) {
            removeAlertLeavePage();
            return;
        }
        if (options.reset_menus) {
            var demo = options.demo,
                data = {'action': 'porto_reset_menus', 'import_shortcodes': options.import_shortcodes};

            $.post(ajaxurl, data, function(response) {
                if (response) showImportMessage(demo, response);
                porto_reset_widgets(options);
            }).fail(function(response) {
                porto_reset_widgets(options);
            });
        } else {
            porto_reset_widgets(options);
        }
    }

    // reset widgets
    function porto_reset_widgets(options) {
        if (!options.demo) {
            removeAlertLeavePage();
            return;
        }
        if (options.reset_widgets) {
            var demo = options.demo,
                data = {'action': 'porto_reset_widgets'};

            $.post(ajaxurl, data, function(response) {
                if (response) showImportMessage(demo, response);
                porto_import_dummy(options);
            }).fail(function(response) {
                porto_import_dummy(options);
            });
        } else {
            porto_import_dummy(options);
        }
    }

    // import dummy content
    var dummy_index = 0, dummy_count = 0, dummy_process = 'import_start';
    function porto_import_dummy(options) {
        if (!options.demo) {
            removeAlertLeavePage();
            return;
        }
        if (options.import_dummy) {
            var demo = options.demo,
                data = {'action': 'porto_import_dummy', 'process':'import_start', 'demo': demo};

            dummy_index = 0;
            dummy_count = 0;
            dummy_process = 'import_start';
            porto_import_dummy_process(options, data);
        } else {
            porto_import_widgets(options);
        }
    }

    // import dummy content process
    function porto_import_dummy_process(options, args) {
        var demo = options.demo;
        $.post(ajaxurl, args, function(response) {
            if (response && /^[\],:{}\s]*$/.test(response.replace(/\\["\\\/bfnrtu]/g, '@').
                replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, ']').
                replace(/(?:^|:|,)(?:\s*\[)+/g, ''))) {
                response = $.parseJSON(response);
                if (response.process != 'complete') {
                    var requests = {'action': 'porto_import_dummy'};
                    if (response.process) requests.process = response.process;
                    if (response.index) requests.index = response.index;

                    requests.demo = demo;
                    porto_import_dummy_process(options, requests);

                    dummy_index = response.index;
                    dummy_count = response.count;
                    dummy_process = response.process;

                    showImportMessage(demo, response.message, dummy_count, dummy_index);
                } else {
                    showImportMessage(demo, response.message);
                    porto_import_widgets(options);
                }
            } else {
                showImportMessage(demo, 'Failed importing! Please check the "System Status" tab to ensure your server meets all requirements for a successful import. Settings that need attention will be listed in red.');
                porto_import_widgets(options);
            }
        }).fail(function(response) {
            if (dummy_index < dummy_count) {
                var requests = {'action': 'porto_import_dummy'};
                requests.process = dummy_process;
                requests.index = ++dummy_index;
                requests.demo = demo;

                porto_import_dummy_process(options, requests);
            } else {
                var requests = {'action': 'porto_import_dummy'};
                requests.process = dummy_process;
                requests.demo = demo;

                porto_import_dummy_process(options, requests);
            }
        });
    }

    // import widgets
    function porto_import_widgets(options) {
        if (!options.demo) {
            removeAlertLeavePage();
            return;
        }
        if (options.import_widgets) {
            var demo = options.demo,
                data = {'action': 'porto_import_widgets', 'demo': demo};

            showImportMessage(demo, 'Importing widgets');

            $.post(ajaxurl, data, function(response) {
                if (response) showImportMessage(demo, response);
                porto_import_icons(options);
            }).fail(function(response) {
                porto_import_icons(options);
            });
        } else {
            porto_import_icons(options);
        }
    }

    // import icons
    function porto_import_icons(options) {
        if (!options.demo) {
            removeAlertLeavePage();
            return;
        }
        if (options.import_icons) {
            var demo = options.demo,
                data = {'action': 'porto_import_icons'};

            showImportMessage(demo, 'Importing icons');

            $.post(ajaxurl, data, function(response) {
                if (response) showImportMessage(demo, response);
                porto_import_shortcodes(options);
            }).fail(function(response) {
                porto_import_shortcodes(options);
            });
        } else {
            porto_import_shortcodes(options);
        }
    }

    // import shortcode pages
    function porto_import_shortcodes(options) {
        if (!options.demo) {
            removeAlertLeavePage();
            return;
        }
        if (options.import_shortcodes) {
            var demo = options.demo,
                data = {'action': 'porto_import_dummy', 'process':'import_start', 'demo': 'shortcodes'};

            dummy_index = 0;
            dummy_count = 0;
            dummy_process = 'import_start';
            porto_import_shortcodes_process(options, data);
        } else {
            porto_import_finished(options)
        }
    }

    function porto_import_shortcodes_process(options, args) {
        var demo = options.demo;
        $.post(ajaxurl, args, function(response) {
            if (response && /^[\],:{}\s]*$/.test(response.replace(/\\["\\\/bfnrtu]/g, '@').
                replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, ']').
                replace(/(?:^|:|,)(?:\s*\[)+/g, ''))) {
                response = $.parseJSON(response);
                if (response.process != 'complete') {
                    var requests = {'action': 'porto_import_dummy'};
                    if (response.process) requests.process = response.process;
                    if (response.index) requests.index = response.index;

                    requests.demo = 'shortcodes';
                    porto_import_shortcodes_process(options, requests);

                    dummy_index = response.index;
                    dummy_count = response.count;
                    dummy_process = response.process;

                    showImportMessage(demo, "Importing shortcode pages");
                } else {
                    porto_import_finished(options);
                }
            } else {
                showImportMessage(demo, 'Failed importing! Please check the "System Status" tab to ensure your server meets all requirements for a successful import. Settings that need attention will be listed in red.');
                porto_import_finished(options);
            }
        }).fail(function(response) {
            if (dummy_index < dummy_count) {
                var requests = {'action': 'porto_import_dummy'};
                requests.process = dummy_process;
                requests.index = ++dummy_index;
                requests.demo = 'shortcodes';

                porto_import_shortcodes_process(options, requests);
            } else {
                var requests = {'action': 'porto_import_dummy'};
                requests.process = dummy_process;
                requests.demo = 'shortcodes';

                porto_import_shortcodes_process(options, requests);
            }
        });
    }

    // import finished
    function porto_import_finished(options) {
        if (!options.demo) {
            removeAlertLeavePage();
            return;
        }
        var demo = options.demo;
        setTimeout(function() {
            showImportMessage(demo, 'Finished! Please visit your site.');
            setTimeout(removeAlertLeavePage, 3000);
        }, 3000);
    }
});

