/*global tb_show, tb_remove, alert, plupload, AdminParams, ajaxurl, wp, console */
(function($){
    "use strict";

    //swaping elemnts in array
    var a13_array_swap = function (x,y) {
            var b = this[x];
            this[x] = this[y];
            this[y] = b;
            return this;
        },

        //moving element in Array from one place to another
        a13_array_move = function (old_index, new_index) {
            if (new_index >= this.length) {
                var k = new_index - this.length;
                while ((k--) + 1) {
                    this.push(undefined);
                }
            }
            this.splice(new_index, 0, this.splice(old_index, 1)[0]);
            return this; // for testing purposes
        };

    //listing all properties of object
    Object.keys = Object.keys || (function () {
        var hasOwnProperty = Object.prototype.hasOwnProperty,
            hasDontEnumBug = !{toString:null}.propertyIsEnumerable("toString"),
            DontEnums = [
                'toString', 'toLocaleString', 'valueOf', 'hasOwnProperty',
                'isPrototypeOf', 'propertyIsEnumerable', 'constructor'
            ],
            DontEnumsLength = DontEnums.length;

        return function (o) {
            if (typeof o != "object" && typeof o != "function" || o === null)
                throw new TypeError("Object.keys called on a non-object");

            var result = [];
            for (var name in o) {
                if (hasOwnProperty.call(o, name))
                    result.push(name);
            }

            if (hasDontEnumBug) {
                for (var i = 0; i < DontEnumsLength; i++) {
                    if (hasOwnProperty.call(o, DontEnums[i]))
                        result.push(DontEnums[i]);
                }
            }

            return result;
        };
    })();

    window.A13_ADMIN = { //A13 = APOLLO 13
        settings : {},

        //run after DOM is loaded
        onReady : function(){
            A13_ADMIN.upload();
            A13_ADMIN.utils.init();
            A13_ADMIN.metaActions.init();
            A13_ADMIN.settingsAction();
        	A13_ADMIN.demo_data_importer();
		},

		demo_data_importer : function(){
			var starter = $('#a13_import_demo_data');

			if(starter.length){
				var parent = starter.parent().parent(),
					status = $('#demo_data_import_progress'),
					log_div = $('#demo_data_import_log'),
					log_link = $('#a13_import_demo_data_log_link'),
					start_import = function(e){
						e.preventDefault();

						if (window.confirm($(this).data('confirm'))){
							parent.addClass('importing');
							//clear log
							log_div.html('');

							next_level('','');
						}
					},

					next_level = function(level, sublevel){
						$.post(ajaxurl, {
								action : 'a13_import_demo_data', //called in backend
								level : level,
								sublevel : sublevel
							},
							function(r) { //r = response
								if(r !== false){
									setup_status(r);

									if(r.is_it_end === false){//end of importing
//                                        setTimeout(function(){next_level(r.level, r.sublevel);}, 900);
										next_level(r.level, r.sublevel);
									}
									else{
										parent.removeClass('importing');
									}
								}
							},
							'json'
						);
					},

					setup_status = function(r){
						var content = r.level_name;
						if(r.sublevel_name.length){
							content += ' - '+r.sublevel_name;
						}

//                        status.append('<p>'+content+'</p>');
						status.html('<p>'+content+'</p>');
						log_div.html(log_div.html()+ r.log);
					},

					switch_log_div = function(e){
						e.preventDefault();
						log_div.toggle();
					};

				starter.click(start_import);
				log_link.click(switch_log_div);
			}
		},

        upload : function(){
            //uploading files variable
            var custom_file_frame,
                field_for_uploaded_file,
                $upload_input,
                upload_buttons_selector = 'input.upload-image-button',

                //on start of selecting/uploading file
                a13_upload_file = function(event){
                    event.preventDefault();

                    var upload_button = $(this);

                    //makes 'Upload Files' tab default one
                    wp.media.controller.Library.prototype.defaults.contentUserSetting=false;

                    //find text input to write in
                    $upload_input = $('input[type=text]', $(this).parent());

                    //remember in which input we want to write
                    field_for_uploaded_file = $upload_input.attr('name');

                    //If the frame already exists, reopen it
                    if (typeof(custom_file_frame)!=="undefined") {
                        custom_file_frame.close();
                    }

                    //Create WP media frame.
                    custom_file_frame = wp.media.frames.customHeader = wp.media({
                        //Title of media manager frame
                        title: "WP Media Uploader",
//                        frame: 'post',
                        frame: 'select',
                        state: 'library',
//                        editing:    true,
                        multiple:   false,
                        library: {
                            type: upload_button.data('media-type') || 'image' //others: audio, video, document(?)
                        },
                        button: {
                            text: upload_button.data('media-button-name') || "Insert image"
                        },
                        states : [
                            new wp.media.controller.Library({
                                filterable : 'all'
                            })
                        ]
                    });

                    //callback for selected image
                    custom_file_frame.on('insert select change', a13_select_file);

                    //Open modal
                    custom_file_frame.open();
                },

                //after of selecting/uploading file
                a13_select_file = function(){
                    var whole_state     = custom_file_frame.state(),
                        attachment      = whole_state.get('selection').first().toJSON();

//                    console.log(whole_state._defaultDisplaySettings.size);
                    //do something with attachment variable, for example attachment.filename
                    //Object:
                    //attachment.alt - image alt
                    //attachment.author - author id
                    //attachment.caption
                    //attachment.dateFormatted - date of image uploaded
                    //attachment.description
                    //attachment.editLink - edit link of media
                    //attachment.filename
                    //attachment.height
                    //attachment.icon - don't know WTF?))
                    //attachment.id - id of attachment
                    //attachment.link - public link of attachment, for example ""http://site.com/?attachment_id=115""
                    //attachment.menuOrder
                    //attachment.mime - mime type, for example image/jpeg"
                    //attachment.name - name of attachment file, for example "my-image"
                    //attachment.status - usual is "inherit"
                    //attachment.subtype - "jpeg" if is "jpg"
                    //attachment.title
                    //attachment.type - "image"
                    //attachment.uploadedTo
                    //attachment.url - http url of image, for example "http://site.com/wp-content/uploads/2012/12/my-image.jpg"
                    //attachment.width

//                    console.log(attachment);

                    //if there is some field waiting for input
                    if (field_for_uploaded_file !== undefined) {

                        //if selected media is image
                        if(attachment.type === 'image'){
                            var file_url    = attachment.url,
                                temp_size;

                            //insert its src to waiting field
                            $upload_input.val(file_url);

                            //search & fill other inputs(META)
                            //title of photo
                            $('#a13_item_title').val(attachment.title);

                            //description
                            $('#a13_item_desc').val(attachment.description);
                            $('#a13_attachment_id').val(attachment.id);

                            temp_size = attachment.sizes.thumbnail;
                            //be prepared if there is no thumbnail size
                            if(typeof temp_size === 'undefined'){
                                temp_size = attachment.sizes.full;
                            }
                            $('#a13_item_image_thumb').val(temp_size.url);

                            //fill sizes for retina logo
                            if($upload_input.is('#a13_logo_image_high_dpi')){
                                $('#a13_logo_image_high_dpi_sizes').val(attachment.width+'|'+attachment.height);
                            }

                        }
                        //search for link and its href
                        else{
                            //insert its src to waiting field
                            $upload_input.val(attachment.url);
                        }

                        //send event to update fieldset
                        $upload_input.parents('div.fieldset').trigger('fill_fieldset');

                        //clean waiting variable
                        field_for_uploaded_file = undefined;
                    }
                };

            $(document).on('click', upload_buttons_selector, a13_upload_file);
        },

        utils: {
            init : function(){
                var AU = A13_ADMIN.utils;

                AU.contact_drop_area();
                AU.color_picker();
                AU.slider_option();
                AU.sortable_socials();
                AU.fonts.init(AU);
                AU.admin_menu();
                AU.custom_sidebars();
                AU.font_icons_selector();
                AU.reset_message_cookie();
                AU.select_export();
            },

            contact_drop_area: function(){
                var da = $('#a13_contact_drop_area');
                if(da.length){
                    var ll          = $('#a13_contact_ll'),
                        zoom        = $('#a13_contact_zoom'),
                        type        = $('#a13_contact_map_type'),
                        llRegEx     = /ll=([0-9\.,\-]+)&?/ig,
                        zoomRegEx   = /&z=([0-9]+)&?/ig,
                        typeRegEx   = /&t=([a-z]+)&?/ig,
                        newMapRegEx = /\/@(\-?[0-9]+\.[0-9]+),(\-?[0-9]+\.[0-9]+),([0-9]+[a-z])+\/?/ig,
                        matches,

                        processField = function(){
                            var val     = da.val();

                            //if any value then please proceed
                            if(val.length){
//                            console.log(llRegEx.exec(val),zoomRegEx.exec(val), typeRegEx.exec(val));
//                            console.log(newMapRegEx.exec(val));

                                //new map?
                                matches = newMapRegEx.exec(val);
                                if(matches !== null && matches.length === 4){
                                    ll.val(matches[1]+','+matches[2]);
                                    realType = 'SATELLITE';

                                    var zoomLvl  = /([0-9]+)z/ig.exec(matches[3]);
                                    if(zoomLvl !== null && zoomLvl.length === 2){
                                        zoom.val(zoomLvl[1]).blur();
                                        realType = 'HYBRID';
                                    }
                                    type.val(realType);
                                }

                                //old map
                                else{
                                    //Latitude, Longitude
                                    matches = llRegEx.exec(val);
                                    if(matches !== null && matches.length === 2){
                                        ll.val(matches[1]);
                                    }

                                    //Zoom
                                    matches = zoomRegEx.exec(val);
                                    if(matches !== null && matches.length === 2){
                                        zoom.val(matches[1]).blur();
                                    }

                                    //Map type
                                    matches = typeRegEx.exec(val);
                                    if(matches !== null && matches.length === 2){
                                        var realType;
                                        if(matches[1] === 'k'){
                                            realType = 'SATELLITE';
                                        }
                                        else if(matches[1] === 'm'){
                                            realType = 'ROADMAP';
                                        }
                                        else if(matches[1] === 'h'){
                                            realType = 'HYBRID';
                                        }
                                        else if(matches[1] === 'p'){
                                            realType = 'TERRAIN';
                                        }

                                        type.val(realType);
                                    }
                                }
                            }
                        };

                    //bind drop area
                    da.on('input blur', processField);

                }
            },

            /*** color picker ***/
            color_picker : function(){
                var input_color = $('input.with-color');
                if(input_color.length){
                    input_color.wheelColorPicker({
                        format: 'css',
                        preview: false, /* buggy */
                        validate: true,
                        autoConvert: true,
                        preserveWheel: true
                    });

                    //transparent value
                    $('body').on('click', 'button.transparent-value', function(){
                        $(this).prev('input.with-color').attr('style','').val('transparent');
                        return false;
                    });
                }
            },

            /**** SLIDER FOR SETTING NUMBER OPTIONS ****/
            slider_option : function(){
                var sliders = $('div.slider-place');
                if(sliders.length){
                    //setup sliders
                    sliders.each(function(index){
                        var min,max,unit,$s;
                        //collect settings
                        $s = sliders.eq(index);
                        min = $s.data('min');
                        min = (min === '')? 10 : min; //0 is allowed now
                        max = $s.data('max');
                        max = (max === '')? 30 : max; //0 is allowed now
                        unit = $s.data('unit');

                        $s.slider({
                            range: "min",
                            animate: true,
                            min: min,
                            max: max,
                            slide: function( event, ui ) {
                                $( this ).prev('input.slider-dump').val( ui.value + unit );
                            }
                        });
                    });

                    //set values of sliders
                    $( "input.slider-dump" ).bind('blur', function(){
                        var _this = $(this),
                            value = parseInt(_this.val(), 10),
                            slider = _this.next('div.slider-place'),
                            unit = slider.data('unit');

                        if( !isNaN(value) && (value + '').length){ //don't work on empty && compare as string
                            slider.slider( "option", "value", value );
                            _this.val(value + unit);
                        }
                    }).trigger('blur');
                }
            },

            /**** SORTABLE SOCIALS ****/
            sortable_socials : function(){
                var pos_selector = 'input.vhidden',

                    create_sort = function(event/*, ui*/){
                        var items = $(event.target).find(pos_selector);

                        items.sort(function(a,b){
                            var _a = parseInt( $(a).val(), 10 ),
                                _b = parseInt( $(b).val(), 10 );
                            return _a - _b;
                        });

                        for(var i = 0, len = items.length; i < len; i++){
                            items.eq(i).val(i).parent().parent().appendTo('#a13_sortable-socials > .inside');
                        }
                    },

                    update_sort = function(event, ui){
                        var index_1 = parseInt($(ui.item).find(pos_selector).val(), 10),
                            index_2 = parseInt($(ui.item).prev().find(pos_selector).val(), 10),
                            temp;

                        if(!index_2){
                            index_2 = 0;
                        }

                        //switch indexes if needed
                        if(index_1 > index_2){
                            temp    = index_1;
                            index_1 = index_2;
                            index_2 = temp;
                        }

                        var items = $('#a13_sortable-socials').find(pos_selector);
                        for(var i = index_1; i <= index_2; i++){
                            items.eq(i).val(i);
                        }
                    };

                $('#a13_sortable-socials').sortable({
                    axis: 'y',
                    distance: 10,
                    placeholder: "ui-state-highlight",
                    items: 'div.text-input',
                    cursor: 'move',
                    revert: true,
                    forcePlaceholderSize: true,
                    create: create_sort,
                    update: update_sort
                });
            },

            /**** SELECTING GOOGLE FONTS ****/
            fonts : {
                init: function(AU){
                    var s = $('select.fonts-choose'),
                        F = AU.fonts;
                    if(s.length){
                        //bind font change
                        s.change(F.change);

                        //bind sample text update
                        $('input.sample-text')
                            .on('blur input keyup', F.updateSampleText )
                            .on('dblclick', F.editSampleText);
                        $('span.sample-view').on('dblclick', F.editSampleText);

                        //bind selecting font parameters
                        $('div.font-info').on('change', 'input[type="checkbox"]',{}, F.makeFontWithParams);

                        //run to load selected font after page is loaded
                        s.change();
                    }
                },

                change: function(){
                    var _s = $(this),
                        parent = _s.parent(),
                        first_load = false,
                        F = A13_ADMIN.utils.fonts;

                    if(_s.hasClass('first-load')){
                        _s.removeClass('first-load');
                        first_load = true;
                    }

                    //if font is classic font don't make request
                    if(_s.find('option').filter(':selected').hasClass('classic-font')){
                        //set family for sample view
                        parent.find('span.sample-view').css('font-family', _s.val());
                        //clear font info
                        parent.find('div.font-info').find('div.variants, div.subsets').empty();
                        //fill hidden input
                        F.makeFontWithParams(_s, true);
                        return;
                    }

                    //google font details request
                    $.post(ajaxurl, {
                            action : 'a13_font_details', //called in backend
                            font : _s.val()    //value of select
                        },
                        function(r) { //r = response
                            //check if font was found
                            if(r !== false){
                                F.createHeadLink(r);
                                //don't overwrite saved option in first 'change' event
                                if(!first_load){
                                    parent.find('span.sample-view').css('font-family', r.family);
                                    F.fillInfo(r, _s);
                                    F.makeFontWithParams(_s);
                                }
                            }
                        },
                        'json'
                    );
                },

                createHeadLink: function(r){
                    var apiUrl = [],
                        url;

                    apiUrl.push('//fonts.googleapis.com/css?family=');
                    apiUrl.push(r.family.replace(/ /g, '+')); //font name -> font+name

                    if ($.inArray('regular', r.variants) !== -1) {
                        apiUrl.push(':');
                        apiUrl.push('regular,bold');
                    }
                    else{
                        apiUrl.push(':');
                        apiUrl.push(r.variants[0]);
                        apiUrl.push(',bold');
                    }
                    apiUrl.push('&subset=');
                    $.each(r.subsets, function(index, val){
                        //add comma if more subsets
                        if(index > 0){
                            apiUrl.push(',');
                        }
                        apiUrl.push(val);

                    });

                    url = apiUrl.join('');
                    // url: '//fonts.googleapis.com/css?family=Anonymous+Pro:bold&subset=greek'

                    $('head').append('<link href="'+url+'" rel="stylesheet" type="text/css" />');
                },

                updateSampleText: function(){
                    var inp = $(this);
                    inp.parent().find('span.sample-view').html(inp.val());
                },

                editSampleText: function(){
                    var elem = $(this);

                    if(elem.is('span')){//enable edit
                        elem.hide().prev().show().focus();
                    }
                    else{//disable edit
                        elem.hide().next().show();
                    }
                },

                fillInfo: function(r, select){
                    var info = select.parent().find('div.font-info'),
                        v = info.find('div.variants'),
                        s = info.find('div.subsets'),
                        html = '';

                    $.each(r.subsets, function(){
                        html += '<label><input type="checkbox" name="subset" value="'+this+'" />'+this+'</label>'+"\n";
                    });
                    s.empty().append(html);

                    html = '';
                    $.each(r.variants, function(){
                        html += '<label><input type="checkbox" name="variant" value="'+this+'" />'+this+'</label>'+"\n";
                    });
                    v.empty().append(html);
                },

                makeFontWithParams: function(s, classic_font){
                    //if called as event callback
                    if(!(s instanceof jQuery)){
                        s = $(this).parents('div.input-desc').eq(0).find('select');
                    }
                    if(typeof classic_font === 'undefined'){
                        classic_font = false;
                    }

                    var name = s.val(),
                        parent = s.parent(),
                        font_input = parent.find('input.font-request'),
                        variants = parent.find('.variants input').filter(':checked'),
                        subsets = parent.find('.subsets input').filter(':checked');

                    //it is not needed to strip colon and other stuff form classic fonts
                    //but missing colon will be used to easily distinguish classic from google
                    if(!classic_font){
                        //variants
                        //colon even if no variant
                        name +=':';
                        $.each(variants, function(index, val){
                            //add comma if more subsets
                            if(index !== 0){
                                name +=',';
                            }
                            name += $(val).val();
                        });

                        //subsets
                        $.each(subsets, function(index, val){
                            //add comma if more subsets
                            if(index === 0){
                                name +=':';
                            }
                            else{
                                name +=',';
                            }
                            name += $(val).val();
                        });
                    }

                    //fill input
                    font_input.val(name);
                }
            },

            admin_menu : function(){
                var root = $('#menu-to-edit'),
                    enabled_class = 'mega-menu-enabled';

                if(root.length){
                    var switchMegaMenuOptions = function(){
                        var menu_items = root.children(),
                            number = menu_items.length,
                            i = 0,
                            current, check,
                            mm_enabled = false,
                            class_change = function(current){
                                if(mm_enabled){
                                    current.addClass(enabled_class);
                                }
                                else{
                                    current.removeClass(enabled_class);
                                }
                            };

                        for(;i<number;i++){
                            current = menu_items.eq(i);

                            //level 0
                            if(current.is('.menu-item-depth-0')){
                                check = current.find('input.enable-mega-menu');
                                mm_enabled = check.is(':checked');//true || false
                                class_change(current);
                                continue;
                            }

                            //level 1
                            if(current.is('.menu-item-depth-1')){
                                class_change(current);
                            }
                        }
                    };

                    //bind events
                    root.on( 'change', 'input.enable-mega-menu', switchMegaMenuOptions);
                    root.on( 'sortstop', function(){ setTimeout( switchMegaMenuOptions, 100);} ); //delay so all DOM can be updated
                    root.on( 'click','p.field-move a', switchMegaMenuOptions ); //for manual moving
                }
            },

            custom_sidebars : function(){
                var sidebars = $('#a13-custom-sidebars-list');
                if(sidebars.length){
                    var remove_links = sidebars.find('a'),
                        remove_sidebar = function(e){
                            //no going to hash
                            e.preventDefault();

                            var link = $(this);

                            $.post(ajaxurl, {
                                    action : 'a13_remove_custom_sidebar', //called in backend
                                    sidebar : link.attr('id')    //sidebar to remove
                                },
                                function(r) { //r = response
                                    //check if sidebar was deleted
                                    if(r === true){
                                        link.parent().fadeOut(300, function(){ $(this).remove(); })
                                    }
                                },
                                'json'
                            );
                        };
                    //bind event
                    remove_links.click(remove_sidebar);
                }
            },

            font_icons_selector :  function(){
                var selector = $('#a13-fa-icons');

                if(selector.length){
                    var inputs_selector = 'input.a13-fa-icon, input.a13_fa_icon',
                        $body = $(document.body),
                        icons = selector.children(),
                        current_input,

                        show_selector = function(){
                            current_input = $(this);
                            // Reposition the popup window
                            selector.css({
                                top: (current_input.offset().top /*+ current_input.outerHeight()*/) + 'px',
                                left: current_input.offset().left + 'px'
                            }).show();

                            $body.off('click.iconSelector');
//                            $body.on('click.iconSelector', function(){console.log('click')});
                            $body.on('click.iconSelector', hide_check);
                        },

                        hide_selector = function(){
                            current_input = null;
                            selector.hide();
                            $body.off('click.iconSelector');
                        },

                        hide_check = function(e){
                            if(typeof e.target !== 'undefined'){
                                var check = $(e.target);
                                if(check.is(current_input) || check.is(selector) || check.parents('#a13-fa-icons').length){
//                                    current_input.focus();
                                }
                                else{
                                    hide_selector();
                                }
                            }
                        },

                        fill_input = function(e){
                            current_input.val($(this).attr('title'));
                        };

                    selector.prependTo('#wpcontent');

                    $body
                        .on('focus', inputs_selector, {}, show_selector);

                    $('span.a13-font-icon').on('click', fill_input);
                }
            },

            reset_message_cookie : function(){
                var button = $('#a13_top_bar_new_message_button'),
                    input  = button.next('input');
                if(button.length){
                    button.click(function(e){
                        e.preventDefault();
                        input.val(Math.random().toString(36).slice(2));
                    })
                }
            },

            //auto select text in export textarea
            select_export : function(){
                var ex = $('#a13_export_options_field');

                if(ex.length){
                    ex.focus(function(){ this.select(); });
                }
            }
        },

        metaActions : {
            init : function(){
                //if there are meta fields check for special elements
                var apollo_meta = $('div.apollo13-metas'),
                    AM = A13_ADMIN.metaActions;

                if (apollo_meta.length) {
                    //bind multi upload and some other things
                    AM.mu_menage(apollo_meta);

                    //bind switcher(hides unused options like image vs video)
//                    apollo_meta.find('div.switch').children('div.input-parent').find('input[type="radio"], select').change(AM.change_switch);
                    apollo_meta
                        .on('change','div.switch > div.input-parent input[type="radio"], div.switch > div.input-parent select',{}, AM.change_switch);
                }
            },

            mu_menage : function(apollo_meta){
                var _prototype = apollo_meta.find('div.fieldset.prototype');

                //there is prototype so we have work to do
                if(_prototype.length){
                    var textarea                = $('#a13_images_n_videos'),
                        items_JSON              = $.parseJSON( textarea.val() ),
                        fields_part             = _prototype.find('div.thumb-fields').slideUp(0).detach(),
                        new_item_prototype      = _prototype.clone().removeClass('prototype'),
                        item_selector           = 'div.thumb-info',
                        mu_button               = $('#a13-multi-upload'),
                        custom_file_frame,      //for multi upload window
                        default_values,
                        sort_start_position,
                        all_items,

                        //refreshes all_items variable
                        update_all_items = function(){
                            all_items = apollo_meta.find(item_selector).not(':first');
                        },

                        //collects values from fields of currently edited item
                        collect_values = function(){
                            var values = {},
                                inputs = fields_part.find('input,textarea,select').not(':button'),
                                size = inputs.length,
                                temp, is_radio, i;

                            //collect fields
                            for(i = 0; temp = inputs.eq(i), i < size; i++){
                                is_radio = temp.is('[type="radio"]');
                                if( !is_radio || ( is_radio && temp.is(':checked') ) ){
                                    values[temp.attr('name').slice(4)] = temp.val(); //slice(4) to avoid a13_ prefix
                                }
                            }

                            return values;
                        },

                        //returns index of item in list
                        index_of_item = function(item){
                            //check if we have proper element to get index
                            if(!item.is(item_selector)){
                                //maybe we are passing field-set
                                item = item.find(item_selector);
                                if(!item.length){
                                    //what we are doing here?
                                    return -1;
                                }
                            }

                            return all_items.index(item);
                        },

                        //updates JSON string in textarea
                        update_textarea = function(){
                            textarea.val(JSON.stringify(items_JSON));
                        },

                        //returns HTML(title bar) for new item
                        new_item_HTML = function(){
                            return new_item_prototype.clone();
                        },

                        //fill title bar of each item with data from JSON
                        fill_item_info = function(index, $html){
//                            var elem = this;
                            //if not yet a jQuery object then make it so
                            if(!($html instanceof jQuery)){
                                $html = $($html);
                            }

                            var info_thumb      = $html.find('img.info-thumb'),
                                thumb_title     = $html.find('span.thumb-title'),
                                fields          = items_JSON[index],
                                type            = fields.item_type,
                                image           = fields.item_image,
                                thumb           = fields.item_image_thumb,
                                video           = fields.item_video,
                                video_thumb     = fields.item_video_thumb,
                                title           = fields.item_title;

                            if(type === 'image'){
                                //insert title
                                thumb_title.text(title.length ? title : image );

                                //insert thumb
                                if(thumb.length){
                                    info_thumb.attr('src', thumb).show();
                                }
                                else{
                                    info_thumb.attr('src', '').hide();
                                }
                            }
                            else if(type === 'video'){
                                //insert title
                                thumb_title.text(title.length ? title : video );

                                //hide thumb
                                info_thumb.attr('src', '').hide();
                            }

                            return $html;
                        },

                        //fills inputs of currently edited item with data from JSON
                        fill_item_details = function(index){
                            var fields  = items_JSON[index],
                                keys    = Object.keys(fields),
                                size    = keys.length,
                                i, field;

                            //fill inputs
                            for(i = 0; field = keys[i],  i < size; i++){
                                if(field === 'item_type'){ continue; } //this field need to be processed alone
                                fields_part.find('[name="a13_'+field+'"]').val(fields[field]);
                            }

                            //change type of item
                            fields_part
                                .find('input[name="a13_item_type"]')
                                .filter('[value="'+fields.item_type+'"]')
                                .prop('checked', true).change();
                        },

                        //show/hide action
                        show_item_fields = function(event, fast){
                            event.preventDefault();

                            var link            = $(this),
                                open_class      = 'open',
                                info            = link.parents(item_selector),
                                index           = index_of_item(info),
                                speed           = typeof fast === 'undefined'? 200 : 0,

                                swap_text = function(link){
                                    var current_text    = link.text();
                                    link.text(link.data('swaptext')).data('swaptext', current_text);
                                };

                            //change link to other text
                            swap_text(link);

                            //hide form
                            if(link.hasClass(open_class)){
                                fields_part.slideUp(speed);
                                link.removeClass(open_class);
                                //hide any open color picker
                                hide_color_picker();
                            }
                            else{
                                //revert to hide state of other item
                                swap_text(apollo_meta.find('span.thumb-show-fields.'+open_class).removeClass(open_class));
                                fields_part.slideUp(0);
                                //hide any open color picker
                                hide_color_picker();

                                //show form in new place
                                info.after(fields_part);
                                fill_item_details(index);
                                fields_part.slideDown(speed);
                                link.addClass(open_class);
                            }
                        },

                        //hides open color pickers
                        hide_color_picker = function(){
                            fields_part.find('input.with-color').wheelColorPicker('hide');
                        },

                        //action on sort start
                        items_sort_start = function(event, ui){
                            sort_start_position = index_of_item(ui.item.find(item_selector));
                        },

                        //action after drop of sorted item
                        items_sort_update = function(event, ui){
                            update_all_items(); //for good indexes
                            var sort_end_position = index_of_item(ui.item);
                            //no change, do nothing
                            if(sort_start_position === sort_end_position){ return; }
                            //only swap
                            else if(Math.abs( sort_start_position - sort_end_position ) === 1){
                                //swap in object
                                a13_array_swap.call(items_JSON, index_of_item(ui.item), sort_start_position );
                            }
                            //move element
                            else{
                                a13_array_move.call(items_JSON, sort_start_position, index_of_item(ui.item));
                            }

                            update_textarea();
                        },

                        //on start of selecting/uploading images
                        mu_upload_file = function(event){
                            event.preventDefault();

                            //makes 'Upload Files' tab default one
                            wp.media.controller.Library.prototype.defaults.contentUserSetting=false;

                            //If the frame already exists, reopen it
                            if (typeof(custom_file_frame)!=="undefined") {
                                custom_file_frame.close();
                            }

                            //Create WP media frame.
                            custom_file_frame = wp.media.frames.customHeader = wp.media({
                                //Title of media manager frame
                                title: "WP Media Uploader",
                                frame: 'select',
                                state: 'library',
                                multiple: true,
                                library: {
                                    type: 'image'
                                },
                                button: {
                                    text: "Insert image(s)"
                                },
                                states : [
                                    new wp.media.controller.Library({
                                        filterable : 'all',
                                        multiple : true
                                    })
                                ]
                            });

                            //callback for selected images
                            custom_file_frame.on('select', mu_select_file);

                            //Open modal
                            custom_file_frame.open();
                        },

                        //after of selecting/uploading file
                        mu_select_file = function(){

                            var whole_state     = custom_file_frame.state(),
                                images          = whole_state.get('selection').models,
                                items_num       = images.length,
                                marked_place    = $('div.apollo13-metas').find('span.add-more-fields').parent(),
                                html            = $([]), //empty jQuery object that we will add to
                                insert, new_index, elem, current_item,
                                attachment, temp_size;

                            if (items_num) {
                                for(elem = 0; elem < items_num; elem++){
                                    new_index       = items_JSON.push($.extend({},default_values))-1;
                                    attachment      = images[elem].toJSON();
                                    current_item    = items_JSON[new_index];
                                    temp_size       = attachment.sizes.thumbnail;
                                    //be prepared if there is no thumbnail size
                                    if(typeof temp_size === 'undefined'){
                                        temp_size = attachment.sizes.full;
                                    }

                                    //update of item JSON
                                    current_item.item_type          = attachment.type;
                                    current_item.item_image         = attachment.url;
                                    current_item.item_title         = attachment.title;
                                    current_item.item_desc          = attachment.description;
                                    current_item.attachment_id      = attachment.id;
                                    current_item.item_image_thumb   = temp_size.url;

                                    //HTML for new item
                                    html = html.add(fill_item_info(new_index, new_item_HTML()));
                                }

                                //insert HTML
                                html.insertBefore(marked_place);

                                //add to all_items list
                                all_items = all_items.add(html.find(item_selector));

                                update_textarea();

                            }
                        },

                        add_item = function(event){
                            var marked_place    = $(this).parent(),
                                insert          = new_item_HTML(),
                                new_index       = items_JSON.push($.extend({},default_values))-1,
                                opener          = insert.find('span.thumb-show-fields');

                            insert.insertBefore(marked_place);

                            //add to all_items list
                            all_items = all_items.add(insert.find(item_selector));

                            update_textarea();

                            //open field-set
                            opener.click();

                            return insert;
                        },

                        remove_item = function(){
                            var main = $(this).parents('.fieldset.additive'),
                                index = index_of_item(main),
                                fields;

                            if(index === -1){//this was deleted
                                return;
                            }

                            //update all_items list
                            all_items = all_items.not(all_items.eq(index));

                            //hide any open color picker
                            hide_color_picker();

                            //update JSON
                            items_JSON.splice( index ,1 );

                            update_textarea();


                            //remove HTML
                            main.fadeOut(250,function(){
                                //save our fields area
                                fields = main.find('div.thumb-fields');
                                if(fields.length){
                                    fields_part = fields.slideUp(0).detach();
                                }

                                //remove rest
                                main.remove();
                            });
                        },

                        update_item = function(event){
                            var item = this;
                            //if not yet a jQuery object then make it so
                            if(!(item instanceof jQuery)){
                                item = $(item);
                            }


                            var info = fields_part.prev('.thumb-info'),
                                index = index_of_item(info);

                            items_JSON[index] = collect_values();

                            update_textarea();

                            fill_item_info(index, info);
                        },

                        //on load making HTML from JSON
                        prepare_HTML = function(){
                            var items_num = items_JSON.length,
                                html = $([]), //empty jQuery object that we will add to
                                elem;
                            for(elem = 0; elem < items_num;  elem++ ){
                                html = html.add(fill_item_info(elem, new_item_HTML()));
                            }

                            //insert HTML
                            _prototype.after(html);

                            //update all items(for caching)
                            update_all_items();
                        };

                    //collect default values()
                    default_values = collect_values();

                    prepare_HTML();

                    //bind actions
                    apollo_meta
                        .on('click', 'span.thumb-show-fields', {}, show_item_fields)
                        .on('click', 'span.add-more-fields', {single: true}, add_item)
                        .on('click', 'span.remove-fieldset', {}, remove_item)
                        .on('change',   'div.thumb-fields select,' +
                                        'div.thumb-fields input[type="radio"],' +
                                        'div.thumb-fields input[type="checkbox"]',
                                            {}, update_item)
                        .on('blur',     'div.thumb-fields input[type="text"],' +
                                        'div.thumb-fields textarea',
                                            {}, update_item)
                        .on('fill_fieldset', 'div.fieldset', {}, update_item);

                    apollo_meta.sortable({
                        axis: 'y',
                        distance: 10,
                        placeholder: "ui-state-highlight",
                        handle: item_selector,
                        items: 'div.additive',
                        revert: true,
                        forcePlaceholderSize: true,
                        cursor: 'move',
                        start: items_sort_start,
                        update: items_sort_update
                    });

                    mu_button.click(mu_upload_file);

                }
            },

            change_switch : function(){
//                console.log('switch');
                var input   = $(this),
                    parent  = input.parents('div.switch').eq(0), /* first switch parent */
                    to_show = input.val();

                parent
                    .children('div.switch-group').hide()
                    .filter('[data-switch="'+to_show+'"]').show();
            }
        },

        settingsAction : function(){
            //sliding options fields sets
            var hide_fieldset = function(){
                var bar = $(this),
                    block = bar.parent(),
                    input = bar.find('input[type="hidden"]');

                if(block.hasClass('closed')){
                    block.removeClass('closed');
                    bar.next('div.inside').slideDown(300);
                    input.val('1');
                }
                else{
                    input.val('0');
                    bar.next('div.inside').slideUp(300, function(){
                        block.addClass('closed');
                    });
                }
            };

            $('div.fieldset-name').click(hide_fieldset);

            //bind switcher(hides unused options like image vs text in logo options)
            $('#apollo13-settings').find('div.switch').children('div.input-parent').find('input[type="radio"], select').change(A13_ADMIN.metaActions.change_switch);

            //iframe with help
            var show_help = function(e){
                e.preventDefault();
                var W = $(window),
                    w = parseInt(W.width(), 10) * 0.9,
                    h = parseInt(W.height() , 10) * 0.85;

                tb_show('Apollo13 inline documentation', $(this).attr('href') + '?TB_iframe=true&amp;width='+w+'&amp;height='+h );
            };

            $('.help-info a').click(show_help);

            //save options button - back to current fieldset after reload
            $('input[name="theme_updated"]').click(function(){
                var I = $(this),
                    fieldset = I.parents('div.postbox').eq(0).attr('id'),
                    form = I.parents('form').eq(0);

                form.attr('action', '#'+fieldset); //insert anchor

            });
        }
    };

    var A13_ADMIN = window.A13_ADMIN;

    //start ADMIN
    $(document).ready(A13_ADMIN.onReady);

})(jQuery);