<?php function admin_script(){ ?>
<script type="text/javascript">


(function($) {

    var upload_dir = '<?php echo UPLOAD_SUBDIR; ?>';
	var our_dir = '<?php echo get_template_directory_uri(); ?>';
    //console.log(upload_dir);
 
 $(document).ready(function($) {
 
        var item;
        var saved_status = $('#save_status');
		
		$( "#save_window" ).dialog({ autoOpen: false, show: { effect: "blind", duration: 400 } });
		
// -------------Add functions -------------
        $('#add_item').click(function(){
             var new_str = $('<span class="drag">New String</span>');
            new_str.data('speed', 1);
            new_str.appendTo('#home_text');
            $( ".drag" ).click(function(){
                var _this = $(this);
                $('#str_value').val(_this.html());
                $('#font_size').val(_this.css('font-size').match(/\d+/));
                $('#font_family').val(_this.css('font-family'));
                $('#speed').val(_this.data('speed'));
                if(_this.hasClass('accent_color')){
                    $('#accent_color').attr('checked', 'checked');
                }else{
                    $('#accent_color').removeAttr('checked');
                }
                $( ".drag" ).css('border-color', 'transparent');
                _this.css('border-color', '#000000');
                item = _this;
            });
            $( ".drag" ).draggable({
                containment: "#home_text",
                scroll: false
            });        
            return false;
        });
		
        $('#add_soc2').click(function(){
            var str = '';
            var name = $('#soc_name2').val();
            if(name||(name!=='')){
                var _this = $(this);
                str+='<div class="soc_item"><span class="soc_name">'+name+'</span>' +
                    '<div class="sense_upload_block">'+
                    '<input class="sense_upload_url" type="hidden" value="" />'+
                    '<a class="button sense_upload_image_button add-field">Upload Image</a> '+
                    '<a class="hiden button sense_delete_image_button remove-field">Delete Image</a>'+
                    '<div class="image_preview"></div>'+
                    '</div>'+
                    '<span class="delete_icon button remove-field">Delete title</span>'+
                    '</div>';
                item = $(str);
                item.appendTo('#soc_items');
                var btn_upl = item.find('.sense_upload_block').find('.sense_upload_image_button');
                var btn_del = item.find('.sense_upload_block').find('.sense_delete_image_button');
                btn_upl.click(function() {
                    upload_block = $(this).parent();
                    tb_show('Upload Image', 'media-upload.php?referer=siteoptions&amp;type=image&amp;TB_iframe=true&amp;post_id=0', false);
                    return false;
                });
                btn_del.click(function() {
                    var delete_block = $(this).parent();
                    delete_block.find('.sense_upload_url').val('');
                    delete_block.find('.image_preview').html('');
                    $(this).fadeOut();    
                    return false;
                });
                $('.delete_icon').click(function(){
                    $(this).parent().remove();
                });
            }else{
                alert('Please, enter the field name');
            }
            return false;
        });
		
		$('#add_contact_icon').click(function(){
            var str = '';
            var name = $('#contact_icon_name').val();
            if(name||(name!=='')){
                var _this = $(this);
                str+='<div class="contact_icon_item"><span class="icon_name">'+name+'</span> link: '+
                    '<input class="soc_url" value=""/>'+
                    '<div class="sense_upload_block">'+
                    '<input class="sense_upload_url" type="hidden" value="" />'+
                    '<a class="button sense_upload_image_button add-field">Upload Image</a> '+
                    '<a class="hiden button sense_delete_image_button remove-field">Delete Image</a>'+
                    '<div class="image_preview"></div>'+
                    '</div>'+
                    '<span class="delete_icon button remove-field">Delete title</span>'+
                    '</div>';
                item = $(str);
                item.appendTo('#contact_icon_items');
                var btn_upl = item.find('.sense_upload_block').find('.sense_upload_image_button');
                var btn_del = item.find('.sense_upload_block').find('.sense_delete_image_button');
                btn_upl.click(function() {
                    upload_block = $(this).parent();
                    tb_show('Upload Image', 'media-upload.php?referer=siteoptions&amp;type=image&amp;TB_iframe=true&amp;post_id=0', false);
                    return false;
                });
                btn_del.click(function() {
                    var delete_block = $(this).parent();
                    delete_block.find('.sense_upload_url').val('');
                    delete_block.find('.image_preview').html('');
                    $(this).fadeOut();    
                    return false;
                });
                $('.delete_icon').click(function(){
                    $(this).parent().remove();
                });
            }else{
                alert('Please, enter the field name');
            }
            return false;
        });
		
		
        $('#add_new_field').click(function(){
            var field_name = $('#field_name').val();
            if(field_name===''){
                alert('Please, enter the field name');
                return false;
            };
            var field_label = $('#field_label').val();
            var new_str = $('<span class="contact_item"><input class="data" name="'
                +field_name+
                '" value="'+
                field_label+
                '"/><input type="checkbox" class="is_required"/> Required <a class="delete_item remove-field">delete</a>'+
                '<select class="check_type" name="check_type">'+
                    '<option value="text" selected="selected">Text</option>'+
                    '<option value="name">Name</option>'+
                    '<option value="email">Email</option>'+
                    '<option value="phone">Phone</option>'+
                    '<option value="message">Message</option>'+
                '</select>');
            new_str.appendTo('#new_contact_form');
            $('.contact_item .delete_item').click(function(){
                $(this).parent().remove();
            });
            $('#new_contact_form').sortable();
            return false;
        });
    
// -------------Bind Clicks--------------
        $('#edit_str #delete_item').click(function(){
            item.remove();
            $('#home_text').find('.drag').eq(0).click();
        });
        $('.font_size_edit .big').click(function(){
            var val = parseInt($('#font_size').val().match(/\d+/))+1;
            $('#font_size').val(val);
            item.css('font-size', val+'px');
        });
        $('.font_size_edit .litle').click(function(){
            var val = parseInt($('#font_size').val().match(/\d+/))-1;
            $('#font_size').val(val);
            item.css('font-size', val+'px');
        });
        $('.speed .big').click(function(){
            var val = (parseFloat($('#speed').val())+0.1).toFixed(1);
            $('#speed').val(val);
            item.data('speed', val);
        });
        $('.speed .litle').click(function(){
            var val = (parseFloat($('#speed').val())-0.1).toFixed(1);
            $('#speed').val(val);
            item.data('speed', val);
        });
        $('.contact_item .delete_item').click(function(){
            $(this).parent().remove();
        });
        $('#new_contact_form').sortable();
        $('#str_value').keyup(function(e){
            item.html($('#str_value').val());
        });
        $('#font_size').keyup(function(e){
            item.css('font-size', $('#font_size').val()+'px');
        });
        $('#font_family').change(function(){
            $('head').append('<link href="http://fonts.googleapis.com/css?family='+$('#font_family').val()+'" rel="stylesheet" />');
            item.css('font-family', $('#font_family option:selected').text());
        });
        $('#speed').keyup(function(e){
            item.data('speed', $('#speed').val());
        });
        $('.delete_icon').click(function(){
            $(this).parent().remove();
        });
        var r = new RegExp("\x27+","g");
        var r1 = new RegExp("\x22+","g");
        $( ".drag" ).click(function(){
            var _this = $(this);
            $('#str_value').val(_this.html());
            $('#font_size').val(_this.css('font-size').match(/\d+/));
            console.log(_this.css('font-family').replace(r, ""));
            $('#font_family').val(_this.css('font-family').replace(r, "").replace(r1, ""));
            $('#speed').val(_this.data('speed'));
            if(_this.hasClass('accent_color')){
                $('#accent_color').attr('checked', 'checked');
            }else{
                $('#accent_color').removeAttr('checked');
            }
            $( ".drag" ).css('border-color', 'transparent');
            _this.css('border-color', '#000000');
            item = _this;
        });
        $( ".drag" ).eq(0).click();
        $( ".drag" ).draggable({
                containment: "#home_text",
                scroll: false
            });        

        $('.delete_services').click(function(){
            var id = $(this).parent().attr('id');
            $('#show_services1 option[value="'+id+'"]').remove();
            $(this).parent().remove();
            $('.services_item').eq(0).fadeIn();            
            return false;
        });
        $('.delete_team').click(function(){
            var id = $(this).parent().attr('id');
            $('#show_teams option[value="'+id+'"]').remove();
            $(this).parent().remove();
            $('.team_item').eq(0).fadeIn();
            return false;
        });
        
        $('#accent_color').change(function(){
            if($(this).attr('checked')){
                item.addClass('accent_color');
            }else{
                item.removeClass('accent_color');
            }
        });
        $('#show_home_flag').change(function(){
            if($(this).attr('checked')){
                $('#show_home').val('true');
            }else{
                $('#show_home').val('false');
            }
        });
        $('#show_about_flag').change(function(){
            if($(this).attr('checked')){
                $('#show_about').val('true');
            }else{
                $('#show_about').val('false');
            }
        });
        $('#show_portfolio_flag').change(function(){
            if($(this).attr('checked')){
                $('#show_portfolio').val('true');
            }else{
                $('#show_portfolio').val('false');
            }
        });
        $('#show_services_flag').change(function(){
            if($(this).attr('checked')){
                $('#show_services').val('true');
            }else{
                $('#show_services').val('false');
            }
        });
		$('#show_blog_flag').change(function(){
            if($(this).attr('checked')){
                $('#show_blog').val('true');
            }else{
                $('#show_blog').val('false');
            }
        });
        $('#show_contacts_flag').change(function(){
            if($(this).attr('checked')){
                $('#show_contacts').val('true');
            }else{
                $('#show_contacts').val('false');
            }
        });
    // ------------Portfolio------------ 
       
        
        function get_contact_form(){
            var items = [];
            var i = 0;
            $('#new_contact_form .contact_item').each(function(){
                var _this = $(this);
                var _this_input = _this.find('.data');
                var _this_check_type = _this.find('.check_type');
                var _name = _this_input.attr('name');
                var _this_required = _this.find('.is_required');
                var _this_type = _this.find('.type_textarea');
                var item_data = {'label': _this_input.val(), 
                                'name': _this_input.attr('name'), 
                    'check_type': _this_check_type.val(),
                    'is_checked': '',
                    'input_type': 'text'
                };
                (_this_required.prop("checked")===true)?(item_data.is_checked = 'checked'):(item_data.is_checked = '');
                (_this_type.prop("checked")===true)?(item_data.input_type = 'textarea'):(item_data.input_type = 'text');
                items.push(item_data);
                i++;
            });
            return items;
        }
        function save_contact_form(){
            var items = get_contact_form();
            var ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';
            var data = {
                type: 'save_contact_form',
                action: 'of_ajax_post_action',
                data: items
            };
            jQuery.post(ajax_url, data, function() {
                var success = $('#of-popup-save');
                var loading = $('.ajax-loading-img');
                loading.fadeOut();  
                success.fadeIn();
                window.setTimeout(function(){
                    success.fadeOut(); 
                }, 2000);
            });
            return false;
        }

        function get_home(){
            var items = [];
            var i = 0;
            var r = new RegExp("\x27+","g");
            var r1 = new RegExp("\x22+","g");
            $('#home_text .drag').each(function(){
                var _this = $(this);
            var item_data = {'text': _this.html(), 
                'margin-top': _this.css('top'),
                'margin-left': _this.css('left'),
                'font-size': _this.css('font-size'),
                'font-family': _this.css('font-family').replace(r, "").replace(r1, ""),
                'speed': _this.data('speed'),
                'accent_color': ''
            };
                (_this.hasClass('accent_color'))?(item_data.accent_color = 'accent'):(item_data.accent_color = '');
                items.push(item_data);
                i++;
            });
            return items;
        }

        function save_home(){
            var items = get_home();
            var ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';
            var data = {
                type: 'save_home',
                action: 'of_ajax_post_action',
                data: items
            };
            console.log(data);
            jQuery.post(ajax_url, data, function() {
                var success = $('#of-popup-save');
                var loading = $('.ajax-loading-img');
                loading.fadeOut();  
                success.fadeIn();
                window.setTimeout(function(){
                    success.fadeOut(); 
                }, 2000);
                
            });
            return false;
        };

        function get_soc(){
            var items = [];
            var i = 0;
            $('#soc_items .soc_item').each(function(){
                var _this = $(this);
                var item_data = {'name': _this.find('.soc_name').html(),
                'url': _this.find('.soc_url').val(), 
                'icon': _this.find('.sense_upload_block').find('.sense_upload_url').val()
                };
                items.push(item_data);
            });
            return items;
        }

        function save_soc(){
            
            var items = get_soc();
            var ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';
            var data = {
                type: 'save_soc',
                action: 'of_ajax_post_action',
                data: items
            };
            jQuery.post(ajax_url, data, function() {
                var success = $('#of-popup-save');
                var loading = $('.ajax-loading-img');
                loading.fadeOut();  
                success.fadeIn();
                window.setTimeout(function(){
                    success.fadeOut(); 
                }, 2000);
            });
            return false;
        }
		function get_contact_icon(){
            var items = [];
            var i = 0;
            $('#contact_icon_items .contact_icon_item').each(function(){
                var _this = $(this);
                var item_data = {'name': _this.find('.icon_name').html(),
                'url': _this.find('.soc_url').val(), 
                'icon': _this.find('.sense_upload_block').find('.sense_upload_url').val()
                };
                items.push(item_data);
            });
            return items;
        }

        function save_contact_icon(){
            
            var items = get_contact_icon();
            var ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';
            var data = {
                type: 'save_contact_icon',
                action: 'of_ajax_post_action',
                data: items
            };
            jQuery.post(ajax_url, data, function() {
                var success = $('#of-popup-save');
                var loading = $('.ajax-loading-img');
                loading.fadeOut();  
                success.fadeIn();
                window.setTimeout(function(){
                    success.fadeOut(); 
                }, 2000);
            });
            return false;
        }

        function get_services(){
            var items = [];
            $('#services .services_item').each(function(){
                var _this = $(this);
                var item_data = {'title': _this.find('.services_title').val(),
                'text': _this.find('.services_text').val(),
                'link': _this.find('.services_link').val(), 
                'img': _this.find('.sense_upload_block').find('.sense_upload_url').val()
                };
                items.push(item_data);
            });
            return items;
        }

        function save_services(){
            var items = get_services();
            var ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';
            var data = {
                type: 'save_services',
                action: 'of_ajax_post_action',
                data: items
            };
            jQuery.post(ajax_url, data, function(){});
            return false;
        }

        function get_team(){
            var items = [];
            $('#teams .team_item').each(function(){
                var _this = $(this);
                var item_data = {'name': _this.find('.team_name').val(),
                'position': _this.find('.team_position').val(), 
                'text': _this.find('.team_text').val(),
                'link': _this.find('.team_link').val(),
                'img': _this.find('.sense_upload_block').find('.sense_upload_url').val()
                };
                items.push(item_data);
            });
            return items;
        }

        function save_teams(){
            var items = get_team();
            var ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';
            var data = {
                type: 'save_teams',
                action: 'of_ajax_post_action',
                data: items
            };
            jQuery.post(ajax_url, data, function(){});
            return false;
        }

        $('.team_item').eq(0).fadeIn();
        $('#show_teams').change(function(){
            $('.team_item').fadeOut();
            $('#'+$('#show_teams').val()).fadeIn();    
        });

        $('.services_item').eq(0).fadeIn();
        $('#show_services1').change(function(){
            $('.services_item').fadeOut();
            $('#'+$('#show_services1').val()).fadeIn();    
        });


// -----------Import/Export-------------
        $('#import_btn').click(function(){
            var ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';            
            var data = {
                type: 'import',
                action: 'of_ajax_post_action',
                data: $('#import').val()
            };
        
            jQuery.post(ajax_url, data, function() {
                window.location = window.location.href;
            });
            return false;
        });

        $('#export_btn').click(function(){
            $('#home_hiden').val(JSON.stringify(get_home()));
            $('#soc_hiden').val(JSON.stringify(get_soc()));
            $('#form_hiden').val(JSON.stringify(get_contact_form()));
            $('#teams_hiden').val(JSON.stringify(get_team()));
            $('#services_hiden').val(JSON.stringify(get_services()));
            $('#theme_url_hiden').val('<?php echo UPLOAD_URL ?>');
            var data = $('#ofform :not(#export, #import, #edit_str input, #edit_str select, #soc_items input, #soc_name, #option-contactForm input, #option-contactForm select)').serialize();
            $('#export').val(data);
            return false;
        });


// --------------Color----------
      
		


        $('#ofform input, #ofform textarea, #ofform select').change(function(){
            saved_status.fadeIn();
        });
        $('#ofform nav li').click(function(){
            $('#ofform nav li').removeClass('current');
            $(this).addClass('current');
            link = $(this).find('a').attr('href');
            $('#ofform .group').fadeOut();
            $(link).fadeIn();
            return false;
        });

        var shorcode = '';
		var shorcode2 = '';
		
        $( "#dialog-form1" ).dialog({
            autoOpen: false,
            height: 400,
            width: 500,
            // modal: true,
            buttons: {
                "Add shortcode": function() {
                    var team_name = $( "#team_name" ).val(),
                        team_pos = $( "#team_pos" ).val(),
                        team_text = $( "#team_text" ).val(),
                        team_link = $( "#team_link" ).val();
                        team_img = '<?php echo UPLOAD_URL ?>'+$( "#team_img" ).val();
                    var str = '<div id="select'+team_name+'" class="team_item"><h4>Name</h4>'+
                    '<input type="text" class="team_name" name="team_name" value="'+team_name+'" />'+
                    '<h4>Position</h4>'+
                    '<input type="text" class="team_position" name="team_position" value="'+team_pos+'" />'+
                    '<h4>Description</h4>'+
                    '<textarea class="team_text" name="team_text">'+team_text+'</textarea>'+
                    '<h4>Link</h4>'+
                    '<input type="text" class="team_link" name="team_link" value="'+team_link+'" />'+
                    '<div class="sense_upload_block">'+
                    '<input class="sense_upload_url" type="hidden" value="" />'+
                    '<a class="button sense_upload_image_button add-field">Upload Image</a>'+
                    '<a class="hiden button sense_delete_image_button remove-field">Delete Image</a>'+
                    '<div class="image_preview"></div>'+
                    '</div></div>';
                    var item = $(str);
                    $('#teams .team_item').fadeOut();
                    item.appendTo($('#teams'));
                    var btn_upl = item.find('.sense_upload_block').find('.sense_upload_image_button');
                    var btn_del = item.find('.sense_upload_block').find('.sense_delete_image_button');
                    btn_upl.click(function() {
                        upload_block = $(this).parent();
                        tb_show('Upload Image', 'media-upload.php?referer=siteoptions&amp;type=image&amp;TB_iframe=true&amp;post_id=0', false);
                        return false;
                    });
                    btn_del.click(function() {
                        var delete_block = $(this).parent();
                        delete_block.find('.sense_upload_url').val('');
                        delete_block.find('.image_preview').html('');
                        $(this).fadeOut();    
                        return false;
                    });
                    $(this).dialog( "close" );
                    $( "#team_name" ).val(''),
                    $( "#team_pos" ).val(''),
                    $( "#team_text" ).val(''),
                    $( "#team_link" ).val('');
                    var sel = '<option value="select'+team_name+'">'+team_name+'</option>';
                    $(sel).appendTo($('#show_teams'));
                    $('#show_teams option:last').attr('selected', 'selected');
                },
                Cancel: function() {
                    $(this).dialog( "close" );
                }
            },
        });


        $( "#dialog-form2" ).dialog({
            autoOpen: false,
            height: 400,
            width: 500,
            // modal: true,
            buttons: {
                "Add shortcode": function() {
                    var services_title = $( "#services_title" ).val(),
                        services_text = $( "#services_text" ).val(),
                        services_link = $( "#services_link" ).val();
                        services_img = '<?php echo UPLOAD_URL ?>'+$( "#services_img" ).val();
                    var str = '<div id="select'+services_title+'" class="services_item"><h4>Title</h4>'+
                    '<input type="text" class="services_title" name="services_title" value="'+services_title+'" />'+
                    '<h4>Description</h4>'+
                    '<textarea class="services_text" name="services_text">'+services_text+'</textarea>'+
                    '<h4>Link</h4>'+
                    '<input type="text" class="services_link" name="services_link" value="'+services_link+'" />'+
                    '<div class="sense_upload_block">'+
                    '<input class="sense_upload_url" type="hidden" value="" />'+
                    '<a class="button sense_upload_image_button add-field">Upload Image</a>'+
                    '<a class="hiden button sense_delete_image_button remove-field">Delete Image</a>'+
                    '<div class="image_preview"></div>'+
                    '</div></div>';
                    var item = $(str);
                    $('#services .services_item').fadeOut();
                    item.appendTo($('#services'));
                    var btn_upl = item.find('.sense_upload_block').find('.sense_upload_image_button');
                    var btn_del = item.find('.sense_upload_block').find('.sense_delete_image_button');
                    btn_upl.click(function() {
                        upload_block = $(this).parent();
                        tb_show('Upload Image', 'media-upload.php?referer=siteoptions&amp;type=image&amp;TB_iframe=true&amp;post_id=0', false);
                        return false;
                    });
                    btn_del.click(function() {
                        var delete_block = $(this).parent();
                        delete_block.find('.sense_upload_url').val('');
                        delete_block.find('.image_preview').html('');
                        $(this).fadeOut();    
                        return false;
                    });

                    $(this).dialog( "close" );
                    $( "#services_title" ).val(''),
                    $( "#services_text" ).val(''),
                    $( "#services_link" ).val('');
                    var sel = '<option value="select'+services_title+'">'+services_title+'</option>';
                    $(sel).appendTo($('#show_services1'));
                    $('#show_services1 option:last').attr('selected', 'selected');
                },
                Cancel: function() {
                    $(this).dialog( "close" );
                }
            },
        });

        $('#add_new_team').click(function(){
            $( "#dialog-form1" ).dialog( "open" );    
            return false;
        });
        $('#add_new_services').click(function(){
            $( "#dialog-form2" ).dialog( "open" );    
            return false;
        });

        
		
		
    

		
		$( "#dialog-form4" ).dialog({
            autoOpen: false,
            height: 400,
            width: 500,
            modal: true,
            buttons: {
                "Add shortcode": function() {
                    var item_author = $( "#item_author2" ).val(),
						item_company = $( "#item_company" ).val(),
                        item_date = $( "#item_date" ).val(),
                        item_text = $( "#item_text2" ).val();
                        shorcode = shortcode_ed.getContent()+'[item author="'+item_author+'" company= "'+item_company+'" date= "'+item_date+'"]'+item_text+'[/item]';
                    shortcode_ed.setContent(shorcode);
                    $(this).dialog( "close" );
                },
                Cancel: function() {
                    $(this).dialog( "close" );
                }
            },
        });
		
		$( "#dialog-form5" ).dialog({
            autoOpen: false,
            height: 400,
            width: 500,
            modal: true,
            buttons: {
                "Add shortcode": function() {
                    var item_author = $( "#item_author3" ).val(),
                        item_text = $( "#item_text3" ).val();
                        shorcode = shortcode_ed.getContent()+'[item2 author="'+item_author+'"]'+item_text+'[/item2]';
                    shortcode_ed.setContent(shorcode);
                    $(this).dialog( "close" );
                },
                Cancel: function() {
                    $(this).dialog( "close" );
                }
            },
        });
		
		
		//services block1
		$( "#dialog-form7" ).dialog({
            autoOpen: false,
            height: 400,
            width: 500,
            modal: true,
            buttons: {
                "Add shortcode": function() {
                    var item_label = $( "#item_label" ).val(),
                        item_num = $( "#item_num" ).val(),
                        item_set = $( "#item_set" ).val();
                        shorcode = shortcode_ed.getContent()+'[item_services1 label="'+item_label+'" num = "'+item_num+'"]'+item_set+'[/item_services1]';
                    shortcode_ed.setContent(shorcode);
                    $(this).dialog( "close" );
                },
                Cancel: function() {
                    $(this).dialog( "close" );
                }
            },
        });
		
		//services block2
		$( "#dialog-form6" ).dialog({
            autoOpen: false,
            height: 400,
            width: 500,
            modal: true,
            buttons: {
                "Add shortcode": function() {
                    var item_author = $( "#item_author4" ).val(),
                        item_text = $( "#item_text4" ).val();
                        shorcode = shortcode_ed.getContent()+'[item_services2 author="'+item_author+'"]'+item_text+'[/item_services2]';
                    shortcode_ed.setContent(shorcode);
                    $(this).dialog( "close" );
                },
                Cancel: function() {
                    $(this).dialog( "close" );
                }
            },
        });
		
		//services block3
		$( "#dialog-form3" ).dialog({
            autoOpen: false,
            height: 400,
            width: 500,
            modal: true,
            buttons: {
                "Add shortcode": function() {
                    var item_author = $( "#item_author" ).val(),
                        item_text = $( "#item_text" ).val();
                        shorcode = shortcode_ed.getContent()+'[item_services3 author="'+item_author+'"]'+item_text+'[/item_services3]';
                    shortcode_ed.setContent(shorcode);
                    $(this).dialog( "close" );
                },
                Cancel: function() {
                    $(this).dialog( "close" );
                }
            },
        });
		
		
		
		 $('.checkbox_custom').click(function(){
			 //var self = $(this);
			// var id = self.attr('id');
		 alert('test');
		  // update_post_meta(id, 'mm_posts_is_slider', 'false'); 
		 });
		
		
        $('.publish-to a').click(function(){
            $('.wp-switch-editor.switch-html').click();
            function newValues() {
                var serializedValues = $("#ofform").serialize();
                    return serializedValues;
            }
            $(":checkbox, :radio").click(newValues);
            $("select").change(newValues);
			$("select_color").change(newValues);
		
			
			
            $('.ajax-loading-img').fadeIn();
            var serializedReturn = newValues();
            var ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';
            var data = {
                <?php if(isset($_REQUEST['page']) && $_REQUEST['page'] === 'siteoptions'){ ?>
                type: 'options',
                <?php } ?>
                action: 'of_ajax_post_action',
                data: serializedReturn
            };
            save_home();
            save_soc();
            save_contact_form();
            save_teams();
			save_contact_icon()
            save_services();
            jQuery.post(ajax_url, data, function() {
                $('#save_status').fadeOut();
				$('#save_window').dialog("open");
            });
            // window.location = window.location;
            return false;
        });
		
		
		$('.color1').click(function(){
			$( ".form_select_color" ).css('background', '#16994a');
		});
		$('.color2').click(function(){
			$( ".form_select_color" ).css('background', '#e95d5d');
		});
		$('.color3').click(function(){
			$( ".form_select_color" ).css('background', '#008eb4');
		});
		$('.color4').click(function(){
			$( ".form_select_color" ).css('background', '#77479b');
		});
		$('.color5').click(function(){
			$( ".form_select_color" ).css('background', '#1352a2');
		});
		$('.color6').click(function(){
			$( ".form_select_color" ).css('background', '#45a38d');
		});
		$('.color7').click(function(){
			$( ".form_select_color" ).css('background', '#f16c47');
		});
		$('.color8').click(function(){
			$( ".form_select_color" ).css('background', '#999999');
		});
		
		
		
		$('.pattern1').click(function(){
			$( ".pattern" ).css('background-image', 'url('+our_dir+'/images/pattern1.png)');
		});
		$('.pattern2').click(function(){
			$( ".pattern" ).css('background-image', 'url('+our_dir+'/images/pattern2.png)');
		});
		$('.pattern3').click(function(){
			$( ".pattern" ).css('background-image', 'url('+our_dir+'/images/pattern3.png)');
		});
		$('.pattern4').click(function(){
			$( ".pattern" ).css('background-image', 'url('+our_dir+'/images/pattern4.png)');
		});
		$('.pattern5').click(function(){
			$( ".pattern" ).css('background-image', 'url('+our_dir+'/images/pattern5.png)');
		});
		$('.pattern6').click(function(){
			$( ".pattern" ).css('background-image', 'url('+our_dir+'/images/pattern6.png)');
		});
		$('.pattern7').click(function(){
			$( ".pattern" ).css('background-image', 'url('+our_dir+'/images/pattern7.png)');
		});
		$('.pattern8').click(function(){
			$( ".pattern" ).css('background-image', 'url('+our_dir+'/images/pattern8.png)');
		});

    
	});
	
	})(jQuery);	
</script>
<?php } ?>