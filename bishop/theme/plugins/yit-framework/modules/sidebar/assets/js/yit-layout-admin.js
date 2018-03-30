/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

(function ($) {

    function YitLayoutPanel() {
        this._currentIndex = 0;
        this._stack = [];
        this.ajaxurl = yit_layout_loc.admin_ajax_url;

    }

    var page_list = {

        groups: new YitLayoutPanel(),


        init: function () {


            $('#layout-panel-frame').on('click', '.accordion-section-content .page-numbers', function (e) {
                e.preventDefault();

                var link = $(this);
                var action = link.closest('.accordion-section-content');

                $.ajax({
                    url     : ajaxurl,
                    data    : link.attr('href').split('?')[1] + '&action=yit-layout-module-' + action.attr('data-module'),
                    dataType: 'JSON',
                    type    : 'POST',
                    success : function (data) {
                        link.closest('ul').html(data);
                    },
                    error   : function (xhr, desc, e) {
                        console.log(xhr.responseText);
                    }
                });

            });
            this.addTabListener();

            this.addSearchListener();

            this.addPageLinkListener();

            this.addPanelListener();

        },

        addPanelListener: function () {

            //onoff
            $('#layout-managment-liquid').on('click', ' .onoff_container span', function () {
                var input = $(this).prev('input');
                var checked = input.prop('checked');
                if (checked) {
                    input.prop('checked', false).attr('value', 'no').removeClass('onoffchecked');
                } else {
                    input.prop('checked', true).attr('value', 'yes').addClass('onoffchecked');
                }
                input.change();
            });

            //form submit
            $('#layout-managment-liquid').on('click', '#panel-form-submit', function (e) {
                e.preventDefault();
                var link = $(this);

                $.ajax({
                    url     : ajaxurl,
                    data    : $('#panel-form').serialize(),
                    dataType: 'JSON',
                    type    : 'POST',
                    beforeSend: function(xhr, settings){
                        link.addClass('button-primary-disabled');
                        link.siblings('.spinner').show();
                    },
                    complete: function(xhr, status){
                        link.removeClass('button-primary-disabled');
                        link.siblings('.spinner').hide();
                    },
                    success : function (data) {
                        $('#message').html(data);
                    },
                    error   : function (xhr, desc, e) {

                        console.log(xhr.responseText);
                    }
                });
            });

            //uploads
            $('#layout-panel-frame').on('click', '.yit_options .upload_button', function(e) {
                e.preventDefault();

                var send_attachment_bkp = wp.media.editor.send.attachment;
                var button = $(this);
                var id = button.attr('id').replace('-button', '');
                _custom_media = true;
                wp.media.editor.send.attachment = function(props, attachment){
                    if ( _custom_media ) {
                        console.log(id);
                        if( $("#"+id).is('input[type=text]') ) {
                            $("#"+id).val(attachment.url);
                        } else {
                            $("#"+id + '_custom').val(attachment.url);
                        }

                    } else {
                        return _orig_send_attachment.apply( this, [props, attachment] );
                    };
                }

                wp.media.editor.open(button);
                return false;
            });

            $('#layout-managment-liquid').on('click', '.yit-sidebar-layout img' , function(e) {

                $( this ).parent().children( ':radio' ).attr( 'checked', false );
                $( this ).prev( ':radio' ).attr( 'checked', true );
            });

            $('#layout-managment-liquid').on('click', 'img.yit_lp_options_layout_sidebars-no' , function(e) {
                $( '#yit_lp_options_layout_sidebars-sidebar-left-container, #yit_lp_options_layout_sidebars-sidebar-right-container' ).hide();
            });

            $('#layout-managment-liquid').on('click', 'img.yit_lp_options_layout_sidebars-left' , function(e) {
                $('#yit_lp_options_layout_sidebars-sidebar-right-container' ).hide();
                $('#yit_lp_options_layout_sidebars-sidebar-left-container' ).show();
            });

            $('#layout-managment-liquid').on('click', 'img.yit_lp_options_layout_sidebars-right' , function(e) {
                $('#yit_lp_options_layout_sidebars-sidebar-right-container' ).show();
                $('#yit_lp_options_layout_sidebars-sidebar-left-container' ).hide();
            });

            $('#layout-managment-liquid').on('click', 'img.yit_lp_options_layout_sidebars-double' , function(e) {
                $( '#yit_lp_options_layout_sidebars-sidebar-right-container, #yit_lp_options_layout_sidebars-sidebar-left-container' ).show();
            });


        },

        addPageLinkListener: function () {

            //dependencies
            var dependencies = function(){
                var t = $(this);

                var field = '#' + t.data('field'),
                    dep = '#' + t.data('dep'),
                    value = t.data('value');

                $(dep).on('change', function(){
                    dependencies_handler( field, dep, value.toString() );
                }).change();
            };

            //Handle dependencies.
            function dependencies_handler ( id, deps, values ) {
                var result = true;

                //Single dependency

                if( typeof( deps ) == 'string' ) {
                    if( deps.substr( 0, 6 ) == ':radio' )
                    { deps = deps + ':checked'; }

                    var values = values.split( ',' );

                    var val = $( deps ).val();

                    if( $(deps).attr('type') == 'checkbox'){
                        var thisCheck = $(deps);
                        if ( thisCheck.is ( ':checked' ) ) {
                            val = 'yes';
                        }
                        else {
                            val = 'no';
                        }
                    }

                    for( var i = 0; i < values.length; i++ ) {

                        if( $( deps ).val() != values[i] )
                        { result = false; }
                        else
                        { result = true; break; }
                    }
                }

                if( !result ) {
                    $( id + '-container' ).parent().hide();
                } else {
                    $( id + '-container' ).parent().show();
                }
            };

            var select_value = function () {
                var value = $(this).children("option:selected").text();
                if (value == '')
                    value = $(this).children().children("option:selected").text();

                if ($(this).parent().find('span').length <= 0) {
                    $(this).before('<span></span>');
                }

                $(this).parent().children('span').replaceWith('<span>' + value + '</span>');
            };

            $('.accordion-container').on('click', '[data-id]', function (e) {

                e.preventDefault();
                var link = $(this);
                var nonce = $('#panel_wpnonce').val();
                $.ajax({
                    url     : ajaxurl,
                    data    : 'wpnonce=' + nonce + '&id=' + link.data('id') + '&model=' + link.data('model') + '&type=' + link.data('type') + '&action=yit-layout-panel',
                    dataType: 'JSON',
                    type    : 'POST',
                    beforeSend: function(){
                        var control_section = link.parents('.control-section.accordion-section');
                        control_section.find('h3.accordion-section-title .spinner').show();
                    },
                    complete: function(){
                        var control_section = link.parents('.control-section.accordion-section');
                        control_section.find('h3.accordion-section-title .spinner').hide();
                    },
                    success : function (data) {
                        $('#layout-managment-liquid').html(data);
                        $('#layout-managment-liquid .select_wrapper select').each(select_value).change(select_value);

                        $('#layout-managment-liquid [data-field]').each(dependencies);

                        //slider
                        $('#layout-panel-frame .slider_container .ui-slider-horizontal').each(function(){

                            var val      = $(this).data('val');
                            var minValue = $(this).data('min');
                            var maxValue = $(this).data('max');
                            var step     = $(this).data('step');
                            var labels   = $(this).data('labels');

                            $(this).slider({
                                value: val,
                                min: minValue,
                                max: maxValue,
                                range: 'min',
                                step: step,

                                slide: function( event, ui ) {
                                    $(this).find('input').val( ui.value );
                                    $(this).siblings('.feedback').find('strong' ).text( ui.value + labels );
                                }
                            });
                        });

                        //colorpicker
                        $('#layout-panel-frame .panel-colorpicker').wpColorPicker({
                            onInit: function(){ console.log('test');},
                            change: function(event, ui){
                            },
                            clear: function(){
                                var input = $(this);
                                input.val(input.data('default-color'));
                                input.change();
                            }
                        });

                        $('#layuot-panel-frame .panel-colorpicker').each( function() {
                            var select_label = $(this).data('variations-label');
                            $(this).parent().parent().find('a.wp-color-result').attr('title', select_label);
                        });


                    },
                    error   : function (xhr, desc, e) {
                        console.log('error');
                        console.log(xhr.responseText);
                    }
                });
            });
        },

        addTabListener: function () {
            var class_active = 'tabs-panel-active',
                class_inactive = 'tabs-panel-inactive';

            $('.nav-tab-link').on('click', function (e) {
                e.preventDefault();

                panelId = $(this).data('type');

                wrapper = $(this).closest('.accordion-section-content');

                // upon changing tabs, we want to uncheck all checkboxes
                $('input', wrapper).removeAttr('checked');

                //Change active tab panel
                $('.' + class_active, wrapper).removeClass(class_active).addClass(class_inactive);
                $('#' + panelId, wrapper).removeClass(class_inactive).addClass(class_active);

                $('.tabs', wrapper).removeClass('tabs');
                $(this).parent().addClass('tabs');

                // select the search bar
                $('.quick-search', wrapper).focus();

            });
        },


        /**
         * Use AJAX to search for content from a specific module
         */
        addSearchListener  : function () {
            var searchTimer;


            $('.quick-search').keypress(function (e) {
                var t = $(this);

                if (13 == e.which) {
                    page_list.updateSearchResults(t);
                    return false;
                }

                if (searchTimer) clearTimeout(searchTimer);

                searchTimer = setTimeout(function () {
                    page_list.updateSearchResults(t);
                }, 400);
            }).attr('autocomplete', 'off');

        },
        updateSearchResults: function (input) {
            var panel,
                minSearchLength = 2,
                q = input.val();

            if (q.length < minSearchLength) return;

            panel = input.parents('.tabs-panel');
            var spinner = $('.spinner', panel);

            spinner.show();

            $.ajax({
                url     : ajaxurl,
                data    : {
                    'action'         : input.attr('class').split(' ')[0],
                    'response-format': 'JSON',
                    'nonce'          : page_list.nonce,
                    'sidebar_id'     : page_list.sidebarID,
                    'type'           : input.attr('id'),
                    'q'              : q
                },
                dataType: 'JSON',
                type    : 'POST',
                success : function (response) {
                    var elements = "";
                    if (response.length > 0) {
                        $.each(response, function (i, item) {
                            elements += '<li><a href="#" data-model="' + item.model + '" data-type="' + item.module + '" data-id="' + item.value + '">' + item.label + '</a></li>';
                        });
                    } else {
                        elements = '<li><p>' + yit_layout_loc.no_item + '</p></li>';
                    }

                    $('.categorychecklist', panel).html(elements);
                    spinner.hide();
                },
                error   : function (xhr, desc, e) {
                    console.log(xhr.responseText);
                }
            });

        }
    };

    var sidebar = {

        groups: new YitLayoutPanel(),
        init  : function () {
            this.addSidebarListener();
            this.deleteSidebarListener();
        },

        addSidebarListener: function () {
            $('#sidebar-form').on('click', '.button-primary', function (e) {
                e.preventDefault();
                var link = $(this);

                $.ajax({
                    url     : ajaxurl,
                    data    : 'action=yit-add-sidebar&' + $('#sidebar-form').serialize(),
                    dataType: 'JSON',
                    type    : 'POST',
                    beforeSend: function(){
                        link.siblings('.spinner').show();
                        link.addClass('button-primary-disabled');
                    },
                    complete: function(){
                        link.siblings('.spinner').hide();
                        link.removeClass('button-primary-disabled');
                    },
                    success : function (data) {
                        $('#message').html(data.message);
                        var elements = '';
                        $.each(data.sidebars, function (i, item) {
                            elements += '<li><span class="delete"><a href="#" data-id="' + i + '" data-nonce="' + data.nonce + '"  title="Delete"></a></span>' + item + '<span class="spinner"></span></span></li>';
                        });

                        $('ul.sidebar-list').html(elements);
                        $('#add-sidebar-name').val('');
                    },
                    error   : function (xhr, desc, e) {
                        console.log(xhr.responseText);
                    }
                });
            });
        },

        deleteSidebarListener: function () {
            $('.sidebar-list').on('click', '.delete a', function (e) {
                e.preventDefault();
                var link = $(this);
                $.ajax({
                    url     : ajaxurl,
                    data    : 'action=yit-delete-sidebar&id=' + link.data('id') + '&wpnonce=' + link.data('nonce'),
                    dataType: 'JSON',
                    type    : 'POST',
                    beforeSend: function(){
                        var li = link.parents('li');
                        li.find('.spinner').show();
                    },
                    complete: function(){
                        var li = link.parents('li');
                        li.find('.spinner').hide();
                    },
                    success : function (data) {

                        $('#message').html(data.message);
                        var elements = '';
                        $.each(data.sidebars, function (i, item) {
                            elements += '<li><span class="delete"><a href="#" data-id="' + i + '" data-nonce="' + data.nonce + '" title="Delete"></a></span>' + item + '<span class="spinner"></span></li>';
                        });

                        $('ul.sidebar-list').html(elements);

                    },
                    error   : function (xhr, desc, e) {
                        console.log(xhr.responseText);
                    }
                });
            })
        }

    }


    $(document).ready(function () {
        page_list.init();
        sidebar.init();


    });


})(jQuery);
