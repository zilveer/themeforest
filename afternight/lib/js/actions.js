var act = new Object();
act.sh = new Object();

act.preview_select = function (select) {
    var $preview = jQuery(select).parents('.generic-field-preview-select').find('.preview');
    jQuery(select).children('option').each(function (index, elem) {
        if (jQuery(elem).is(':selected')) {
            $preview.addClass(jQuery(elem).val());
        } else {
            $preview.removeClass(jQuery(elem).val());
        }

    });
};

act.sh.columns = function (selector_part) {
    var view = jQuery('.' + selector_part + '_view').val();
    jQuery('.' + selector_part + '-sidebar-columns').hide();
    jQuery('.' + selector_part + '-no-sidebar-columns').hide();
    if ('list_view' != view) {
        var sidebar = jQuery('.' + selector_part + '_layout').val();
        if ('full' == sidebar) {
            jQuery('.' + selector_part + '-no-sidebar-columns').show();
        } else {
            jQuery('.' + selector_part + '-sidebar-columns').show();
        }
    }
};

act.sh.multilevel = new Object();
act.sh.multilevel.check = function (args) {
    var show = true;
    for (var selector in args) {
        var classname = args[ selector ];
        if (show && !jQuery(selector).first().is(':checked')) {
            show = false;
        }
        if (show) {
            jQuery(classname).show();
        } else {
            jQuery(classname).hide();
        }
    }
};

act.sh.multilevel.mixed = function (args) {
    var show = true;
    for (var selector in args) {
        var classname = args[ selector ][ 'class' ];
        if (show) {
            if (jQuery(selector).is('input')) {
                if (show && !jQuery(selector).first().is(':checked')) {
                    show = false;
                }
            } else if (jQuery(selector).is('select')) {
                if (jQuery(selector).val() == args[ selector ][ 'value' ]) {
                    show = false;
                }
            }
        }

        if (show) {
            jQuery(classname).show();
        } else {
            jQuery(classname).hide();
        }
    }
};

jQuery(function(){
    jQuery('input.generic-record-search').each(function(){
        var self = this;
        jQuery( self ).autocomplete({ 
            serviceUrl: MyAjax.ajaxurl + '?action=search&params=' + jQuery( self ).parent().children('input.generic-params').val(), 
            minChars:2,
            delimiter: /(,|;)\s*/, 
            maxHeight:400, 
            width:300, 
            zIndex: 9999, 
            deferRequestBy: 0, 
            noCache: false, 
            onSelect: function( value , data){
                jQuery(function(){
                    jQuery( self ).parent().children('input.generic-value').val( data );
                });
            }
        });
    });
});
act.search = function (self, selector) {
    jQuery(function () {
        if (jQuery(self).val().length > 0) {
            if (selector != '-') {
                jQuery(selector).show();
            }
        } else {
            if (selector != '-') {
                jQuery(selector).hide();
            }
            jQuery(self).parent().children('input.generic-value').val('');
        }
    });
};


act.min_likes = function (nr, page) {
    jQuery(function () {
        if (page == 1) {
            jQuery('span.digit-btn.result').html('update ..');
        }
        jQuery.post(MyAjax.ajaxurl, {'action':'min_likes', 'page':page, 'new_limit':nr}, function (result) {
            if (result > 0) {
                var n = (( parseInt(result) - 1 ) * 150 );
                jQuery('span.digit-btn.result').html(n + ' posts updated .. ');
                act.min_likes(nr, result);
            } else {
                jQuery('span.digit-btn.result').html('');
                return 0;
            }
        });
    });
};
act.sim_likes = function (page) {
    jQuery(function () {
        if (page == 1) {
            jQuery('.generate_likes span.btn.result').html('update ..');
        }
        jQuery.post(MyAjax.ajaxurl, {'action':'sim_likes', 'page':page}, function (result) {
            if (result > 0) {
                var n = (( parseInt(result) - 1 ) * 150 );
                jQuery('.generate_likes span.btn.result').html(n + ' posts updated .. ');
                act.sim_likes(result);
            } else {
                jQuery('.generate_likes span.btn.result').html('');
                return 0;
            }
        });
    });
};

act.reset_likes = function (page) {
    jQuery(function () {
        if (page == 1) {
            jQuery('.reset_likes span.btn.result').html('update ..');
        }
        jQuery.post(MyAjax.ajaxurl, {'action':'reset_likes', 'page':page}, function (result) {
            if (result > 0) {
                var n = (( parseInt(result) - 1 ) * 150 );
                jQuery('.reset_likes span.btn.result').html(n + ' posts updated .. ');
                act.reset_likes(result);
            } else {
                jQuery('.reset_likes span.btn.result').html('');
                return 0;
            }
        });
    });
};

act.select = function (selector, args, type) {
    jQuery(document).ready(function () {
        jQuery('option', jQuery('select' + selector)).each(function (i) {
            if (type == 'hs') {
                if (jQuery(this).is(':selected')) {
                    for (var key in args) {
                        if (args.hasOwnProperty(key)) {

                            if (jQuery(this).val().trim() == key) {
                                jQuery(args[ key ]).hide();
                            } else {
                                jQuery(args[ key ]).show();
                            }
                        }
                    }
                }
            }

            if (type == 'sh') {
                if (jQuery(this).is(':selected')) {
                    for (var key in args) {
                        if (args.hasOwnProperty(key)) {
                            if (jQuery(this).val().trim() == key) {
                                jQuery(args[ key ]).show();
                            } else {
                                jQuery(args[ key ]).hide();
                            }
                        }
                    }
                }
            }

            if (type == 'sh_') {
                var show = '';
                var show_ = '';
                if (jQuery(this).is(':selected')) {
                    for (var key in args) {
                        if (args.hasOwnProperty(key)) {

                            if (jQuery(this).val().trim() == key) {
                                show = args[ key ];
                            } else {
                                if (key == 'else') {
                                    show_ = args[ key ];
                                }
                                jQuery(args[ key ]).hide();
                            }
                        }
                    }

                    if (show == '') {
                        jQuery(show_).show();
                    } else {
                        jQuery(show).show();
                    }
                }
            }

            if (type == 'hs_') {
                var hide = '';
                if (jQuery(this).is(':selected')) {
                    for (var key in args) {
                        if (args.hasOwnProperty(key)) {

                            if (jQuery(this).val().trim() == key) {
                                hide = args[ key ];
                            } else {
                                jQuery(args[ key ]).show();
                            }
                        }
                    }

                    jQuery(hide).hide();
                }
            }

            if (type == 's') {
                if (jQuery(this).is(':selected')) {
                    for (var key in args) {
                        if (args.hasOwnProperty(key)) {
                            if (jQuery(this).val().trim() == key) {
                                jQuery(args[ key ]).show();
                            }
                        }
                    }
                }
            }

            if (type == 'h') {
                if (jQuery(this).is(':selected')) {
                    for (var key in args) {
                        if (args.hasOwnProperty(key)) {
                            if (jQuery(this).val().trim() == key) {
                                jQuery(args[ key ]).hide();
                            }
                        }
                    }
                }
            }

            if (type == 'ns') {
                if (jQuery(this).is(':selected')) {
                    for (var key in args) {
                        if (args.hasOwnProperty(key)) {
                            if (jQuery(this).val().trim() == key) {
                            } else {
                                jQuery(args[ key ]).show();
                            }
                        }
                    }
                }
            }

            if (type == 'nh') {
                if (jQuery(this).is(':selected')) {
                    for (var key in args) {
                        if (args.hasOwnProperty(key)) {
                            if (jQuery(this).val().trim() == key) {
                            } else {
                                jQuery(args[ key ]).hide();
                            }
                        }
                    }
                }
            }
        });
    });
};
act.mcheck = function (selectors) {
    var result = true;
    jQuery(document).ready(function () {
        for (var i = 0; i < selectors.length; i++) {
            if (jQuery(selectors[ i ]).is(':checked')) {
                if (jQuery(selectors[ i ]).val().trim() == 'yes') {
                    result = result && true;
                } else {
                    result = result && false;
                }
            } else {
                result = result && false;
            }
        }
    });

    if (result) {
        jQuery('.g_l_register').show();
    } else {
        jQuery('.g_l_register').hide();
    }
};
act.check = function (selector, args, type) {
    jQuery(document).ready(function () {
        if (type == 'hs') {
            if (jQuery(selector).is(':checked')) {

                for (var key in args) {
                    if (args.hasOwnProperty(key)) {
                        if (jQuery(selector).val().trim() == key) {
                            jQuery(args[ key ]).hide();
                        } else {
                            jQuery(args[ key ]).show();
                        }
                    }
                }
            }
        }

        if (type == 'sh') {
            if (jQuery(selector).is(':checked')) {
                for (var key in args) {
                    if (args.hasOwnProperty(key)) {
                        if (jQuery(selector).val().trim() == key) {
                            jQuery(args[ key ]).show();
                        } else {
                            jQuery(args[ key ]).hide();
                        }
                    }
                }
            }
        }


        if (type == 'sh_') {
            var show = '';
            var show_ = '';
            if (jQuery(selector).is(':checked')) {

                for (var key in args) {
                    if (args.hasOwnProperty(key)) {

                        if (jQuery(this).val().trim() == key) {
                            show = args[ key ];
                        } else {
                            if (key == 'else') {
                                show_ = args[ key ];
                            }
                            jQuery(args[ key ]).hide();
                        }
                    }
                }
                if (show == '') {
                    jQuery(show_).show();
                } else {
                    jQuery(show).show();
                }
            }
        }

        if (type == 'hs_') {
            var hide = '';
            if (jQuery(selector).is(':checked')) {
                for (var key in args) {
                    if (args.hasOwnProperty(key)) {

                        if (jQuery(this).val().trim() == key) {
                            hide = args[ key ];
                        } else {
                            jQuery(args[ key ]).show();
                        }
                    }
                }

                jQuery(hide).hide();
            }
        }

        if (type == 's') {
            if (jQuery(selector).is(':checked')) {
                for (var key in args) {
                    if (args.hasOwnProperty(key)) {
                        if (jQuery(selector).val().trim() == key) {
                            jQuery(args[ key ]).show();
                        }
                    }
                }
            }
        }

        if (type == 'h') {
            if (jQuery(selector).is(':checked')) {
                for (var key in args) {
                    if (args.hasOwnProperty(key)) {
                        if (jQuery(selector).val().trim() == key) {
                            jQuery(args[ key ]).hide();
                        }
                    }
                }
            }
        }

        if (type == 'ns') {
            if (jQuery(selector).is(':checked')) {
                for (var key in args) {
                    if (args.hasOwnProperty(key)) {
                        if (jQuery(selector).val().trim() == key) {
                        } else {
                            jQuery(args[ key ]).show();
                        }
                    }
                }
            }
        }

        if (type == 'nh') {
            if (jQuery(selector).is(':checked')) {
                for (var key in args) {
                    if (args.hasOwnProperty(key)) {
                        if (jQuery(selector).val().trim() == key) {
                        } else {
                            jQuery(args[ key ]).hide();
                        }
                    }
                }
            }
        }
    });
};

act.show = function (selector) {
    jQuery(document).ready(function () {
        jQuery(selector).show();
    });
};

act.hide = function (selector) {
    jQuery(document).ready(function () {
        jQuery(selector).hide();
    });
};

act.link = function (selector, args, type) {
    jQuery(document).ready(function () {
        var id = jQuery(selector).attr('id');
        if (type == 'hs') {
            for (var key in args) {
                if (args.hasOwnProperty(key)) {
                    if (id.trim() == key) {
                        jQuery(args[ key ]).hide();
                    } else {
                        jQuery(args[ key ]).show();
                    }
                }
            }
        }

        if (type == 'sh') {
            for (var key in args) {
                if (args.hasOwnProperty(key)) {
                    if (id.trim() == key) {
                        jQuery(args[ key ]).show();
                    } else {
                        jQuery(args[ key ]).hide();
                    }
                }
            }
        }

        if (type == 's') {
            for (var key in args) {
                if (args.hasOwnProperty(key)) {
                    if (id.trim() == key) {
                        jQuery(args[ key ]).show();
                    }
                }
            }
        }

        if (type == 'h') {
            for (var key in args) {
                if (args.hasOwnProperty(key)) {
                    if (id.trim() == key) {
                        jQuery(args[ key ]).hide();
                    }
                }
            }
        }

        if (type == 'ns') {
            for (var key in args) {
                if (args.hasOwnProperty(key)) {
                    if (id.val().trim() == key) {
                    } else {
                        jQuery(args[ key ]).show();
                    }
                }
            }
        }

        if (type == 'nh') {
            for (var key in args) {
                if (args.hasOwnProperty(key)) {
                    if (id.val().trim() == key) {
                    } else {
                        jQuery(args[ key ]).hide();
                    }
                }
            }
        }
    });
};

act.extern_upload_id = function (group, name, id, upload_url) {
    if (upload_url == "") {
        tb_show_url = 'media-upload.php?post_id=0&amp;type=image&amp;TB_iframe=true';
    } else {
        tb_show_url = upload_url;
    }

    /*deleteUserSetting('uploader');
     setUserSetting('uploader', '1');*/

    jQuery(document).ready(function () {
        (function () {
            var tb_show_temp = window.tb_show;
            window.tb_show = function () {
                tb_show_temp.apply(null, arguments);
                jQuery('#TB_iframeContent').load(function () {

                    if (jQuery(this).contents().find('p.upload-html-bypass').length) {
                        jQuery(this).contents().find('p.upload-html-bypass').remove();
                    }

                    jQuery(this).contents().find('div#html-upload-ui').show();
                    jQuery(this).contents().find('ul#sidemenu li#tab-type_url , ul#sidemenu li#tab-library').hide();
                    jQuery(this).contents().find('thead tr td p input.button').hide();
                    jQuery(this).contents().find('tr.image_alt').hide();
                    jQuery(this).contents().find('tr.post_content').hide();
                    jQuery(this).contents().find('tr.url').hide();
                    jQuery(this).contents().find('tr.align').hide();
                    jQuery(this).contents().find('tr.image-size').hide();
                    jQuery(this).contents().find('p.savebutton.ml-submit').hide();


                    $container = jQuery(this).contents().find('tr.submit td.savesend');
                    var sid = '';
                    $container.find('div.del-attachment').each(function () {
                        var $div = jQuery(this);
                        sid = $div.attr('id').toString();
                        if (typeof sid != "undefined") {
                            sid = sid.replace(/del_attachment_/gi, "");
                            jQuery(this).parent('td.savesend').html('<input type="submit" name="send[' + sid + ']" id="send[' + sid + ']" class="button" value="Use this Attachment">');
                        } else {
                            var $submit = $container.find('input[type="submit"]');
                            sid = $submit.attr('name');
                            if (typeof sid != "undefined") {
                                sid = sid.replace(/send\[/gi, "");
                                sid = sid.replace(/\]/gi, "");
                                $container.html('<input type="submit" name="send[' + sid + ']" id="send[' + sid + ']" class="button" value="Use this Attachment">');
                            }
                        }
                    });

                    $container.find('input[type="submit"]').click(function () {
                        $my_submit = jQuery(this);
                        sid = $my_submit.attr('name');
                        if (typeof sid != "undefined") {
                            sid = sid.replace(/send\[/gi, "");
                            sid = sid.replace(/\]/gi, "");
                        } else {
                            sid = 0;
                        }
                        var html = $my_submit.parent('td').parent('tr').parent('tbody').parent('table').html();
                        window.send_to_editor = function () {
                            var attach_url = jQuery('input[name="attachments[' + sid + '][url]"]', html).val();
                            jQuery('input#' + group + '_' + name + id).val(attach_url);
                            jQuery('input#' + group + '_' + name + '_id' + id).val(sid);

                            if (id.length > 0) {
                                jQuery('img#attach_' + group + '_' + name + id).attr("src", attach_url);
                            }

                            tb_remove();
                        }
                    });
                });

            }
        })();

        formfield = jQuery('input#' + group + '_' + name + id).attr('name');
        tb_show('', tb_show_url);
        return false;
    });
};

act.upload_id = function (group, name, id, upload_url) {
    if (typeof upload_url == 'undefined' || upload_url == "") {
        tb_show_url = 'media-upload.php?post_id=0&amp;type=image&amp;TB_iframe=true&amp;flash=0';
    } else {
        tb_show_url = upload_url;
    }

    deleteUserSetting('uploader');
    setUserSetting('uploader', '1');

    jQuery(document).ready(function () {
        (function () {
            var tb_show_temp = window.tb_show;
            window.tb_show = function () {
                tb_show_temp.apply(null, arguments);
                jQuery('#TB_iframeContent').load(function () {

                    if (jQuery(this).contents().find('p.upload-html-bypass').length) {
                        jQuery(this).contents().find('p.upload-html-bypass').remove();
                    }

                    jQuery(this).contents().find('div#html-upload-ui').show();

                    $container = jQuery(this).contents().find('tr.submit td.savesend');
                    var sid = '';
                    $container.find('div.del-attachment').each(function () {
                        var $div = jQuery(this);
                        sid = $div.attr('id').toString();
                        if (typeof sid != "undefined") {
                            sid = sid.replace(/del_attachment_/gi, "");
                            jQuery(this).parent('td.savesend').html('<input type="submit" name="send[' + sid + ']" id="send[' + sid + ']" class="button" value="Use this Attachment">');
                        } else {
                            var $submit = $container.find('input[type="submit"]');
                            sid = $submit.attr('name');
                            if (typeof sid != "undefined") {
                                sid = sid.replace(/send\[/gi, "");
                                sid = sid.replace(/\]/gi, "");
                                $container.html('<input type="submit" name="send[' + sid + ']" id="send[' + sid + ']" class="button" value="Use this Attachment">');
                            }
                        }
                    });

                    $container.find('input[type="submit"]').click(function () {
                        $my_submit = jQuery(this);
                        sid = $my_submit.attr('name');
                        if (typeof sid != "undefined") {
                            sid = sid.replace(/send\[/gi, "");
                            sid = sid.replace(/\]/gi, "");
                        } else {
                            sid = 0;
                        }
                        var html = $my_submit.parent('td').parent('tr').parent('tbody').parent('table').html();
                        window.send_to_editor = function () {
                            var attach_url = jQuery('input[name="attachments[' + sid + '][url]"]', html).val();
                            jQuery('input#' + group + '_' + name + id).val(attach_url);
                            jQuery('input#' + group + '_' + name + '_id' + id).val(sid);

                            if (id.length > 0) {
                                jQuery('img#attach_' + group + '_' + name + id).attr("src", attach_url);
                            }

                            tb_remove();
                        }
                    });
                });

            }
        })();

        formfield = jQuery('input#' + group + '_' + name + id).attr('name');
        tb_show('', tb_show_url);
        return false;
    });
};

act.upload = function (selector) {

    deleteUserSetting('uploader');
    setUserSetting('uploader', '1');

    jQuery(document).ready(function () {
        (function () {
            var tb_show_temp = window.tb_show;
            window.tb_show = function () {
                tb_show_temp.apply(null, arguments);
                jQuery('#TB_iframeContent').load(function () {
                    jQuery(this).contents().find('p.upload-html-bypass').remove();
                    jQuery(this).contents().find('div#html-upload-ui').show();
                    $container = jQuery(this).contents().find('tr.submit td.savesend');
                    var sid = '';
                    $container.find('div.del-attachment').each(function () {
                        var $div = jQuery(this);
                        sid = $div.attr('id').toString();
                        if (typeof sid != "undefined") {
                            sid = sid.replace(/del_attachment_/gi, "");
                            jQuery(this).parent('td.savesend').html('<input type="submit" name="send[' + sid + ']" id="send[' + sid + ']" class="button" value="Use this Attachment">');
                        } else {
                            var $submit = $container.find('input[type="submit"]');
                            sid = $submit.attr('name');
                            if (typeof sid != "undefined") {
                                sid = sid.replace(/send\[/gi, "");
                                sid = sid.replace(/\]/gi, "");
                                $container.html('<input type="submit" name="send[' + sid + ']" id="send[' + sid + ']" class="button" value="Use this Attachment">');
                            }
                        }
                    });

                    $container.find('input[type="submit"]').click(function () {
                        $my_submit = jQuery(this);
                        sid = $my_submit.attr('name');
                        if (typeof sid != "undefined") {
                            sid = sid.replace(/send\[/gi, "");
                            sid = sid.replace(/\]/gi, "");
                        } else {
                            sid = 0;
                        }
                        var html = $my_submit.parent('td').parent('tr').parent('tbody').parent('table').html();

                        window.send_to_editor = function () {
                            var attach_url = jQuery('input[name="attachments[' + sid + '][url]"]', html).val();
                            jQuery(selector).val(attach_url);
                            tb_remove();
                        }
                    });
                });

            }
        })();

        formfield = jQuery(selector).attr('name');
        tb_show('', 'media-upload.php?post_id=0&amp;type=image&amp;TB_iframe=true');
        return false;

    });
};

act.post_relation = function (post_id, meta_label, field_id) {
    jQuery(document).ready(function () {
        jQuery.post(MyAjax.ajaxurl, {"action":'post_relation', "post_id":post_id, "meta_label":meta_label, "field_id":field_id}, function (result) {
            jQuery('span#' + field_id).html(result);
            jQuery('div.' + field_id).show();
        });
    });
};

act.preview = function (family, size, weight, text, selector) {
    jQuery(document).ready(function () {
        jQuery.post(MyAjax.ajaxurl, {"action":"text_preview", "family":family, "size":size, "weight":weight, "text":text}, function (result) {
            jQuery(selector).html(result);
        });
    });
};

act.is_array = function (obj) {
    return obj.constructor.toString().indexOf("Array") != -1;
};

act.send_mail = function (action, form, container) {
    jQuery('#contact_name').removeClass('invalid'); 
    jQuery('#contact_email').removeClass('invalid'); 
    jQuery('#contact_message').removeClass('invalid');

    jQuery('#name').removeClass('invalid'); 
    jQuery('#email').removeClass('invalid'); 
    jQuery('#comment_widget').removeClass('invalid');
    

    jQuery('.container_msg').html('');

    jQuery(document).ready(function () {

        var name = jQuery(form).find("input[name=\"name\"]").val();
        var email = jQuery(form).find("input[name=\"email\"]").val();
        var contact_email = jQuery(form).find("input[name=\"contact_email\"]").val();
        var phone = jQuery(form).find("input[name=\"phone\"]").val();
        var mssg = jQuery(form).find("textarea[name=\"message\"]").val();


        jQuery.post(MyAjax.ajaxurl,
            {
                "action":action,
                "name":name,
                "email":email,
                "contact_email":contact_email,
                "phone":phone,
                "message":mssg,
                "btn_send":"btn_send"
            },
            function (data) {
                json = eval("(" + data + ")");
            
                if(json['message']){
                    jQuery('.container_msg').html(json['message']);

                    jQuery('#name').val('');
                    jQuery('#email').val('');
                    jQuery('#comment').val('');
                    jQuery('#contact_name').val('');
                    jQuery('#contact_email').val('');
                    jQuery('#contact_phone').val('');
                    jQuery('#contact_message').val('');
                }else{ /*if there are some invalid fields */
                    if(json['contact_name'] && json['contact_name'] != ''){ jQuery('#contact_name').addClass('invalid'); jQuery('#name').addClass('invalid'); }
                    if(json['contact_email'] && json['contact_email'] != ''){ jQuery('#contact_email').addClass('invalid'); jQuery('#email').addClass('invalid'); }
                    if(json['contact_message'] && json['contact_message'] != ''){ jQuery('#contact_message').addClass('invalid'); jQuery('#comment_widget').addClass('invalid'); }
                }
            });
    });
};

act.radio_icon = function (group, topic, index) {

    jQuery(function () {
        jQuery('.generic-field-' + group + ' .generic-input-radio-icon input.' + group + '-' + topic + '-' + index).removeAttr("checked");
        jQuery('.generic-field-' + group + ' img.pattern-texture.' + group + '-' + topic).removeClass('selected');

        jQuery('.generic-field-' + group + ' .generic-input-radio-icon.' + index + ' input.' + group + '-' + topic + '-' + index).attr('checked', 'checked');
        jQuery('.generic-field-' + group + ' img.pattern-texture.' + group + '-' + topic + '-' + index).addClass('selected');
    });
};

act.accept_digits = function (objtextbox) {
    var exp = /[^\d]/g;
    objtextbox.value = objtextbox.value.replace(exp, '');
};

act.like = function (post_id, selector, action) {
    var lk = 0;
    jQuery(function () {
        jQuery('.top_love_' + post_id).show();


        act.like_ajax(post_id, action, selector);

    });
};

act.go_random = function () {
    jQuery(function () {
        jQuery.post(MyAjax.ajaxurl, {"action":"go_random"}, function (result) {
            document.location.href = result;
        });
    });
};

act.like_ajax = function (post_id, action, selector) {
    jQuery(function () {
        jQuery.post(
            MyAjax.ajaxurl, {"action":'like',
                "post_id":post_id,
                "meta_type":action
            },
            function (result) {
                //json = eval("(" + result + ")");

                jQuery('i.like-' + post_id).html(result);

                //alert(jQuery(selector).parents('span.voteaction'));

                if (jQuery(selector).parents('span.voteaction').hasClass('voted')) {
                    jQuery(selector).parents('span.voteaction').removeClass('voted');
                } else {
                    jQuery(selector).parents('span.voteaction').addClass('voted');
                }


                //current_selector.parent( 'em' ).parent('span').parent('div').parent('div').find('div.percentage span').html(json['like_percentage']+'% <em>'+total_nr_votes+' '+ votes_label+'</em>');

            })
    });
};

function flip(obj) {
    obj.prev().find("em").animate({
        top: '-=42'
    }, 200);
    obj.toggleClass("voted",true);
}

function init_color_pickers( selector ){
    /* color piker */
    jQuery(selector).each(function() {
        jQuery(selector).wpColorPicker();
    });
}


jQuery(document).ready(function() {

	/* digit input */
	jQuery('input[type="text"].digit').bind('keyup', function(){
		act.accept_digits( this );
	});
  
    /* color piker */
    jQuery('.generic-field input.settings-color-field').each(function() {
        jQuery('.settings-color-field').wpColorPicker();
    });
    
    /*code for front end submittion form*/
    jQuery('.front_post_input').focus(function() {
    	  jQuery(this).removeClass('invalid');
    	  
    	  var obj_id = jQuery(this).attr('id');
    	  jQuery('#'+obj_id+'_info').show();
    });
    
});

function swithch_image_type(image_type,prefix){
	
	jQuery('#'+prefix+'image_type').val(image_type); /*Uploades image OR image URL*/
	jQuery('#'+prefix+'video_type').val(image_type); /*Uploades dive OR video URL*/
	if(image_type == 'upload_img'){ 
		jQuery('#'+prefix+'label_url_img').hide();
		jQuery('#'+prefix+'swithcher_upload_img').hide();
		
		jQuery('#'+prefix+'label_upload_img').show();
		jQuery('#'+prefix+'swithcher_url_img').show();
		
		jQuery('#'+prefix+'upload_btn').click();
	}else if(image_type == 'url_img'){ 
		jQuery('#'+prefix+'label_upload_img').hide();
		jQuery('#'+prefix+'swithcher_url_img').hide();
		
		jQuery('#'+prefix+'label_url_img').show();
		jQuery('#'+prefix+'swithcher_upload_img').show();
		
		jQuery('#'+prefix+'image_url').focus();
		
	}else if(image_type == 'upload_video'){ 
		jQuery('#'+prefix+'label_url_video').hide();
		jQuery('#'+prefix+'swithcher_upload_video').hide();
		
		jQuery('#'+prefix+'label_upload_video').show();
		jQuery('#'+prefix+'swithcher_url_video').show();
		

	}else if(image_type == 'url_video'){ 
	  
		jQuery('#'+prefix+'label_upload_video').hide();
		jQuery('#'+prefix+'swithcher_url_video').hide();
		
		jQuery('#'+prefix+'label_url_video').show();
		jQuery('#'+prefix+'swithcher_upload_video').show();
		
		jQuery('#'+prefix+'video_url').focus();
	} 
}

function use_url(){
	jQuery('#image_type').val('url_img'); /*URL image will be used*/	
	jQuery('#image_type_upload').hide();
	jQuery('#image_type_url').show();
}

function use_img_upload(){
	jQuery('#image_type').val('upload_img'); /*Uploaded image will be used*/
	jQuery('#image_type_url').hide();
	jQuery('#image_type_upload').show();
	
}

jQuery(document).ready(function(){

    if(jQuery('#form_post_image .image_gallery').val() == 'gallery') {
        jQuery('#label_gallery_upload').show();
        jQuery('#label_image_upload').hide();
    }
    else if(jQuery('#form_post_image .image_gallery').val() == 'image') {
        jQuery('#label_gallery_upload').hide();
        jQuery('#label_image_upload').show();
    }
    jQuery('li.image a').click(function(){
        jQuery('#form_post_image .image_gallery').val('image');
        jQuery('#label_gallery_upload').hide();
        jQuery('#label_image_upload').show();
    });

    jQuery('li.gallery a').click(function(){
        jQuery('#form_post_image .image_gallery').val('gallery');
        jQuery('#label_image_upload').hide();
        jQuery('#label_gallery_upload').show();
    });

    jQuery('.post_type_rd').change(function(){  /*used on posr item page*/
        //alert(jQuery(this).val());
        if(jQuery(this).val() == 'portfolio'){
            jQuery(this).parents('form').find('.portfoloiinfo').removeClass('hide');
            
            jQuery(this).parents('form').find('div.post_categ').addClass('hide');
            jQuery(this).parents('form').find('div.post_categ select').attr('disabled',true);
            
            jQuery(this).parents('form').find('div.portfolio_categ').removeClass('hide');
            jQuery(this).parents('form').find('div.portfolio_categ select').attr('disabled',false);

        }else{
            jQuery(this).parents('form').find('.portfoloiinfo').addClass('hide');

            jQuery(this).parents('form').find('div.post_categ').removeClass('hide');
            jQuery(this).parents('form').find('div.post_categ select').attr('disabled',false);

            jQuery(this).parents('form').find('div.portfolio_categ').addClass('hide');
            jQuery(this).parents('form').find('div.portfolio_categ select').attr('disabled',true);
        }

    });

});

function add_image_post(){
	//if(jQuery('#image_content-tmce').hasClass('active')){
		jQuery('#image_content-html').click();
		jQuery('#image_content-tmce').click();
	//}	
	/*disable the button to not submit the post twice*/
	
	jQuery("#submit_img_btn").attr("disabled", "disabled");
	
	jQuery('#loading_').show();
	jQuery('#not_logged_msg').hide();
	jQuery('#success_msg').hide();
	jQuery('#img_post_title_warning').hide();
	jQuery('#img_warning').hide();
	
	jQuery('#img_post_title').removeClass('invalid');
	jQuery('#image_url').removeClass('invalid');
	jQuery('#img_upload').removeClass('invalid');
	var data = jQuery('#form_post_image').serialize();

    /* initialize variable post_format for image or gallery post format*/
	var post_format = jQuery('#form_post_image [name = "post_format"]').val();
	jQuery.ajax({
		url: MyAjax.ajaxurl,
		data: data+'&action=add_image_post&category_id='+jQuery('#img_post_cat').val()+eval('window.'+post_format+'_uploader.serialize()'),
		type: 'POST',
		cache: false,
		success: function (data) {
			json = eval("(" + data + ")");
    		if(json['error_msg'] && json['error_msg'] != ''){
    			if(json['image_error'] != ''){ /*if image OR image link is invalid*/
    				
    				jQuery('#image_url').addClass('invalid');
    				jQuery('#img_upload').addClass('invalid');
    				eval('window.'+post_format+'_uploader.show_error(json["image_error"])');
    				//window.image_uploader.show_error(json['image_error']);
    			}
    			
    			if(json['title_error'] != ''){ /*If title is not set*/
    				jQuery('#img_post_title_warning').html(json['title_error']);
    				jQuery('#img_post_title_warning').show();
    				jQuery('#img_post_title').addClass('invalid');
    			}

				if(json['auth_error'] != ''){ /*is user is not logged in*/
					jQuery('#not_logged_msg').show();
				}
				
				
				var h3_position = jQuery('#pic_upload').offset().top ;
				jQuery.scrollTo( h3_position, 400); /* scroll to in .4 of a second */
				
    		}else{
    			jQuery('#success_msg').html(json['success_msg']);
    			jQuery('#success_msg').show();
    			
    			/*clear inputs*/
    			jQuery('.front_post_input').each(function(index) {
    			    jQuery(this).val('');
    			});
				//window.image_uploader.reset();
    			eval('window.'+post_format+'_uploader.reset()');
    			jQuery('#image_content').val('');
    			jQuery('#image_content_ifr').contents().find(".mceContentBody").html('');
    			
    			var button_position = jQuery('#submit_img_btn').offset().top ;
    			jQuery.scrollTo( button_position - 200, 400); /* scroll to in .4 of a second */
    		}
    		jQuery('#loading_').hide();
    		jQuery("#submit_img_btn").removeAttr("disabled");
		},
		error: function (xhr) {
			jQuery('#loading_').hide();
			alert(xhr);
		}
	});
	
}

function add_text_post(){
	
	//if(jQuery('#text_content-tmce').hasClass('active')){
		jQuery('#text_content-html').click();
		jQuery('#text_content-tmce').click();
	//}	
	/*disable the button to not submit the post twice*/
	
	jQuery("#submit_text_btn").attr("disabled", "disabled");
	
	jQuery('#loading_').show();
	jQuery('#not_logged_msg').hide();
	jQuery('#success_msg').hide();
	jQuery('#text_post_title_warning').hide();
	jQuery('#text_warning').hide();
	
	jQuery('#text_post_title').removeClass('invalid');
	
	var data = jQuery('#form_post_text').serialize();
	
	jQuery.ajax({
		url: MyAjax.ajaxurl,
		data: data+'&action=add_text_post&category_id='+jQuery('#text_post_cat').val(),
		type: 'POST',
		cache: false,
		success: function (data) {
			json = eval("(" + data + ")");
    		if(json['error_msg'] && json['error_msg'] != ''){
    			
    			if(json['title_error'] != ''){ /*If title is not set*/
    				jQuery('#text_post_title_warning').html(json['title_error']);
    				jQuery('#text_post_title_warning').show();
    				jQuery('#text_post_title').addClass('invalid');
    			}

				if(json['auth_error'] != ''){ /*is user is not logged in*/
					jQuery('#not_logged_msg').show();
				}
				
				var h3_position = jQuery('#form_post_text').offset().top ;
				jQuery.scrollTo( h3_position, 400); /* scroll to in .4 of a second */
    		}else{
    			jQuery('#success_msg').html(json['success_msg']);
    			jQuery('#success_msg').show();
    			
    			/*clear inputs*/
    			jQuery('.front_post_input').each(function(index) {
    			    jQuery(this).val('');
    			});
    			
    			jQuery('#text_content').val('');
    			jQuery('#text_content_ifr').contents().find(".mceContentBody").html('');
    			
    			
    			var button_position = jQuery('#submit_text_btn').offset().top ;
    			jQuery.scrollTo( button_position - 200, 400); /* scroll to in .4 of a second */
    		}
    		jQuery('#loading_').hide();
    		jQuery("#submit_text_btn").removeAttr("disabled");
    		
    		
		},
		error: function (xhr) {
			jQuery('#loading_').hide();
			alert(xhr);
		}
	});
	
}

function add_video_post(){
	//if(jQuery('#video_content-tmce').hasClass('active')){
		jQuery('#video_content-html').click();  
		jQuery('#video_content-tmce').click();
	//}	
	/*disable the button to not submit the post twice*/
	
	jQuery("#submit_video_btn").attr("disabled", "disabled");
	
	jQuery('#loading_').show();
	jQuery('#not_logged_msg').hide();
	
	jQuery('#video_url_warning').hide();
	jQuery('#video_post_title_warning').hide();
	
	jQuery('#success_msg').hide();
	jQuery('#video_post_title').removeClass('invalid');
	jQuery('#video_url').removeClass('invalid');
	
	var data = jQuery('#form_post_video').serialize();
	
	jQuery.ajax({
		url: MyAjax.ajaxurl,
		data: data+'&action=add_video_post&category_id='+jQuery('#video_post_cat').val()+window.video_uploader.serialize(),
		type: 'POST',
		cache: false,
		success: function (data) {
			json = eval("(" + data + ")");
    		if(json['error_msg'] && json['error_msg'] != ''){
    			if(json['video_error'] != ''){ /*if image OR image link is invalid*/
    				
    				jQuery('#video_url').addClass('invalid');
    				window.video_uploader.show_error(json['video_error']);
    			}
    			
    			if(json['title_error'] != ''){ /*If title is not set*/
    				jQuery('#video_post_title').addClass('invalid');
    				jQuery('#video_post_title_warning').html(json['title_error']);
    				jQuery('#video_post_title_warning').show();
    				
    			}

				if(json['auth_error'] != ''){ /*is user is not logged in*/
					jQuery('#not_logged_msg').show();
				}
				
				var h3_position = jQuery('#video_upload').offset().top ;
				jQuery.scrollTo( h3_position, 400); /* scroll to in .4 of a second */
    		}else{
    			jQuery('#success_msg').html(json['success_msg']);
    			jQuery('#success_msg').show();
    			
    			/*clear inputs*/
    			jQuery('.front_post_input').each(function(index) {
    			    jQuery(this).val('');
    			});
				window.video_uploader.reset();
    			
    			jQuery('#video_content').val('');
    			jQuery('#video_content_ifr').contents().find(".mceContentBody").html('');
    			
    			var button_position = jQuery('#submit_video_btn').offset().top ;
    			jQuery.scrollTo( button_position - 200, 400); /* scroll to in .4 of a second */
    			
    		}
    		
    		jQuery('#loading_').hide();
    		jQuery("#submit_video_btn").removeAttr("disabled");
			
		},
		error: function (xhr) {
			jQuery('#loading_').hide();
			alert(xhr);
			
		}
	});
}

function add_file_post(){
	
	//if(jQuery('#file_content-tmce').hasClass('active')){
		jQuery('#file_content-html').click();
		jQuery('#file_content-tmce').click();
	//}	
	/*disable the button to not submit the post twice*/
	
	jQuery("#submit_file_btn").attr("disabled", "disabled");
	
	jQuery('#loading_').show();
	jQuery('#not_logged_msg').hide();
	jQuery('#success_msg').hide();
	jQuery('#file_img_post_title_warning').hide();
	jQuery('#file_img_warning').hide();
	jQuery('#file_warning').hide();
	
	jQuery('#file_post_title').removeClass('invalid');
	jQuery('#file_image_url').removeClass('invalid');
	jQuery('#file_img_upload').removeClass('invalid');
	jQuery('#file_upload').removeClass('invalid');
	var data = jQuery('#form_post_file').serialize();

	jQuery.ajax({
		url: MyAjax.ajaxurl,
		data: data+'&action=add_file_post&category_id='+jQuery('#file_post_cat').val()+window.link_uploader.serialize()+window.link_feat_img_uploader.serialize(),
		type: 'POST',
		cache: false,
		success: function (data) {
			json = eval("(" + data + ")");
    		if(json['error_msg'] && json['error_msg'] != ''){
    			if(json['image_error'] != ''){ /*if image OR image link is invalid*/
    				
    				jQuery('#file_image_url').addClass('invalid');
    				jQuery('#file_img_upload').addClass('invalid');
    				
				  window.link_feat_img_uploader.show_error(json['image_error']);
    			}
    			
    			if(json['title_error'] != ''){ /*If title is not set*/
    				jQuery('#file_img_post_title_warning').html(json['title_error']);
    				jQuery('#file_img_post_title_warning').show();
    				jQuery('#file_post_title').addClass('invalid');
    			}

				if( json['file_error'] != ''){
					window.link_uploader.show_error(json['file_error']);
					jQuery('#file_upload').addClass('invalid');
					
				}
				
				if(json['auth_error'] != ''){ /*is user is not logged in*/
					jQuery('#not_logged_msg').show();
				}
				
				
				var h3_position = jQuery('#file_post').offset().top ;
				jQuery.scrollTo( h3_position, 400); /* scroll to in .4 of a second */
				
    		}else{
    			jQuery('#success_msg').html(json['success_msg']);
    			jQuery('#success_msg').show();
    			
    			/*clear inputs*/
    			jQuery('.front_post_input').each(function(index) {
    			    jQuery(this).val('');
    			});
				window.link_uploader.reset();
				window.link_feat_img_uploader.reset();
    			
    			jQuery('#file_content').val('');
    			jQuery('#file_content_ifr').contents().find(".mceContentBody").html('');
    			
    			var button_position = jQuery('#submit_file_btn').offset().top ;
    			jQuery.scrollTo( button_position - 200, 400); /* scroll to in .4 of a second */
    		}
    		jQuery('#loading_').hide();
    		jQuery("#submit_file_btn").removeAttr("disabled");
    		
    		
		},
		error: function (xhr) {
			jQuery('#loading_').hide();
			alert(xhr);
		}
	});
}

function add_audio_post(){
	
	//if(jQuery('#audio_content-tmce').hasClass('active')){
		jQuery('#audio_content-html').click();
		jQuery('#audio_content-tmce').click();
	//}	
	/*disable the button to not submit the post twice*/
	
	jQuery("#submit_audio_btn").attr("disabled", "disabled");
	
	jQuery('#loading_').show();
	jQuery('#not_logged_msg').hide();
	jQuery('#success_msg').hide();
	jQuery('#audio_img_post_title_warning').hide();
	jQuery('#audio_img_warning').hide();
	jQuery('#audio_warning').hide();
	
	jQuery('#audio_post_title').removeClass('invalid');
	jQuery('#audio_image_url').removeClass('invalid');
	jQuery('#audio_img_upload').removeClass('invalid');
	jQuery('#audio_upload').removeClass('invalid');
	var data = jQuery('#form_post_audio').serialize();
	
	jQuery.ajax({
		url: MyAjax.ajaxurl,
		data: data+'&action=add_audio_post&category_id='+jQuery('#audio_post_cat').val()+window.audio_uploader.serialize()+window.audio_feat_img_uploader.serialize(),
		type: 'POST',
		cache: false,
		success: function (data) {
			json = eval("(" + data + ")");
    		if(json['error_msg'] && json['error_msg'] != ''){
    			if(json['image_error'] != ''){ /*if image OR image link is invalid*/
    				
    				jQuery('#audio_image_url').addClass('invalid');
    				jQuery('#audio_img_upload').addClass('invalid');
    				
					window.audio_feat_img_uploader.show_error(json['image_error']);
    			}
    			
    			if(json['title_error'] != ''){ /*If title is not set*/
    				jQuery('#audio_img_post_title_warning').html(json['title_error']);
    				jQuery('#audio_img_post_title_warning').show();
    				jQuery('#audio_post_title').addClass('invalid');
    			}

				if( json['audio_error'] != ''){ 
					window.audio_uploader.show_error(json['audio_error']);
					jQuery('#audio_upload').addClass('invalid');
					
				}
				
				if(json['auth_error'] != ''){ /*is user is not logged in*/
					jQuery('#not_logged_msg').show();
				}
				
				
				var h3_position = jQuery('#audio_post').offset().top ;
				jQuery.scrollTo( h3_position, 400); /* scroll to in .4 of a second */
				
    		}else{
    			jQuery('#success_msg').html(json['success_msg']);
    			jQuery('#success_msg').show();
    			
    			/*clear inputs*/
    			jQuery('.front_post_input').each(function(index) {
    			    jQuery(this).val('');
    			});
				window.audio_uploader.reset();
				window.audio_feat_img_uploader.reset();
				
    			
    			jQuery('#audio_content').val('');
    			jQuery('#audio_content_ifr').contents().find(".mceContentBody").html('');
    			
    			var button_position = jQuery('#submit_audio_btn').offset().top ;
    			jQuery.scrollTo( button_position - 200, 400); /* scroll to in .4 of a second */
    		}
    		jQuery('#loading_').hide();
    		jQuery("#submit_audio_btn").removeAttr("disabled");
    		
    		
		},
		error: function (xhr) {
			jQuery('#loading_').hide();
			alert(xhr);
		}
	});
}

function playVideo(video_id,video_type,obj,width, height){  
		
	jQuery.ajax({
		url: MyAjax.ajaxurl,
		data: '&action=play_video&video_id='+video_id+'&video_type='+video_type+'&width='+width+'&height='+height,
		type: 'POST',
		cache: false,
		success: function (data) { 
			//json = eval("(" + data + ")");
    		if(data != ''){
    			obj.html(data);
				obj.removeAttr('onclick');
    		}
			
		},
		error: function (xhr) {
			//jQuery('#loading_').hide();
			alert(xhr);
			
		}
	});
}

function closeCosmoMsg(msg_id){
	
	jQuery.ajax({
		url: MyAjax.ajaxurl,
		data: '&action=set_cosmo_news&msg_id='+msg_id,
		type: 'POST',
		cache: false,
		success: function (data) { 
			//json = eval("(" + data + ")");
    		jQuery('#cosmo_news').hide();
			
		},
		error: function (xhr) {
			
			
		}
	});
  
}

function removePost(post_id, home_url){
	
	jQuery.ajax({
		url: MyAjax.ajaxurl,
		data: '&action=remove_post&post_id='+post_id,
		type: 'POST',
		cache: false,
		success: function (data) { 
			//json = eval("(" + data + ")");
    		//jQuery('#cosmo_news').hide();
    		
			document.location = home_url; 
			
		},
		error: function (xhr) {
			
			
		}
	});
  
}


var Cosmo_Uploader =
{
    senders:new Array(),
    process_error:function (receiver, error) {
        this.senders[receiver].show_error(error);
    },
    upload_finished:function (receiver, params) {
        this.senders[receiver].upload_finished_with_success(params);
    },
    init:function () {
        window.Cosmo_Uploader = this;
    },
    Basic_Functionality:function (interface_id) {
        var object = new Object();
        object.interface_id = interface_id;
        object.attachments = new Array();
        object.thumbnail_ids = new Array();
        object.next_thumbnail_id = 0;
        object.files_input_element = document.getElementById(object.interface_id).getElementsByTagName("input")[0];
        Cosmo_Uploader.senders[object.interface_id] = object;

        jQuery("#" + object.interface_id).ready(function () {
            jQuery("#" + object.interface_id + " .cui_spinner_container").hide();
        });

        jQuery(object.files_input_element).change(function () {
            object.show_spinner();
            object.start_upload();
        });

        var multiple_files_upload = function () {
            var l = this.files_input_element.files.length;
            this.files_processed = 0;
            this.files_total = l;
            jQuery("#" + this.interface_id + " .cui_spinner_container p").html("Uploading " + l + " file" + (l == 1 ? '' : 's') + ". This may take a while.");
            jQuery("#" + this.interface_id + " input[name*=\"method\"]").val("form");
            jQuery("#" + this.interface_id + " input[name*=\"action\"]").val("upload");
            jQuery("#" + this.interface_id + " input[name*=\"sender\"]").val(this.interface_id);
            jQuery("#" + this.interface_id + " form").submit();
            document.getElementById(this.interface_id).getElementsByTagName("form")[0].reset();
        };
        var single_file_upload = function () {
            jQuery("#" + this.interface_id + " .cui_spinner_container p").html("Uploading... Please wait.");
            jQuery("#" + this.interface_id + " input[name*=\"action\"]").val("upload");
            jQuery("#" + this.interface_id + " input[name*=\"sender\"]").val(this.interface_id);
            jQuery("#" + this.interface_id + " form").submit();
            document.getElementById(this.interface_id).getElementsByTagName("form")[0].reset();
        };
        if (object.files_input_element.files)
            object.start_upload = multiple_files_upload;
        else object.start_upload = single_file_upload;

        object.show_spinner = function () {
            jQuery("#" + object.interface_id + " .cui_error_container").html("");
            jQuery("#" + object.interface_id + " .cui_add_button").hide();
            jQuery("#" + object.interface_id + " .cui_spinner_container").slideDown();
        };
        object.hide_spinner = function () {
            jQuery("#" + object.interface_id + " .cui_add_button").show();
            jQuery("#" + object.interface_id + " .cui_spinner_container").slideUp();
        };
        object.show_error = function (error) {
            object.hide_spinner();
            jQuery("#" + object.interface_id + " .cui_error_container").append(error + "<br>");
        };
        object.remove = function (id) {
            if (!confirm("Are you sure?")) return;
            var attach_id = this.thumbnail_ids[id];
            var thumbnail_id = "thumbnail_" + id;
            var idx = jQuery.inArray(attach_id, this.attachments);
            if (idx != -1) {
                this.attachments.splice(idx, 1);
            }
            idx = jQuery.inArray(id, this.thumbnail_ids);
            if (idx != -1) {
                this.thumbnail_ids.splice(idx, 1);
            }
            var uri = Cosmo_Uploader.template_directory_uri;
            jQuery.ajax({
                url:uri + "/upload-server.php",
                type:"post",
                data:"action=delete&attach_id=" + attach_id
            });
            jQuery("#" + this.interface_id + " #" + thumbnail_id).remove();
        };
        object.upload_finished_with_success = function (params) {
            this.hide_spinner();
            this.attachments.push(params["attach_id"]);
            var thumbnail_id_to_return = this.next_thumbnail_id;
            var thumbnail_id = "thumbnail_" + this.next_thumbnail_id;
            this.thumbnail_ids[this.next_thumbnail_id] = params["attach_id"];
            this.next_thumbnail_id++;
            var diff = 50 - params["h"];
            var append = "<div class=\"cui_thumbnail\" id=\"" + thumbnail_id + "\">";
            append += params["fn_excerpt"];
            append += "<a href=\"javascript:void(0)\" class=\"feat_ref\" title=\"" + params["filename"] + " Click to set as featured.\">";
            append += "<img src=\"" + params["url"] + "\" witdh=\"" + params['w'] + "\" height=\"" + params['h'] + "\" alt=\"" + params["filename"] + ". Click to set as featured\" style=\"margin-top:-20px\">";
            append += "</a>";
            append += "<br/>";
            append += "<a href=\"javascript:void(0)\" class=\"remove_ref\">Remove</a>";
            append += "</div>";
            jQuery("#" + this.interface_id + " .cui_thumbnail_container").append(append);
            var jthis = this;

            jQuery("#" + this.interface_id + " #" + thumbnail_id + " .remove_ref").click(function () {
                jthis.remove(thumbnail_id_to_return);
            });
            return thumbnail_id_to_return;
        };
        object.serialize = function () {
            var querydata = "";
            var id;
            for (id = 0; id < this.attachments.length; id++) {
                querydata += "&attachments[]=" + encodeURIComponent(this.attachments[id]);
            }
            return querydata;
        };

        object.reset = function () {
            jQuery("#" + this.interface_id + " .cui_thumbnail").remove();
            object.attachments = new Array();
            object.thumbnail_ids = new Array();
            object.next_thumbnail_id = 0;
        };
        return object;
    },

    URL_Functionality:function (object, url_id) {
        object.url_id = url_id;
        jQuery("#" + object.interface_id + " .cui_add_url_button_container").click(function () {
            jQuery("#" + object.url_id).slideDown();
            jQuery.scrollTo(jQuery("#" + object.url_id).offset().top - 300, 400);
        });
        jQuery("#" + object.url_id).ready(function () {
            jQuery("#" + object.url_id).hide();
        });
        jQuery("#" + object.interface_id + " .cui_upload_button_container").click(function () {
            jQuery("#" + object.url_id).hide();
        });
        jQuery("#" + object.url_id + " .add_url_link").click(function () {
            jQuery("#" + object.url_id).slideUp();
            object.add_url(jQuery("#" + object.url_id + " .add_url").val());
            jQuery("#" + object.url_id + " .add_url").val("");
        });
        object.add_url = function (url) {
            var uri = Cosmo_Uploader.template_directory_uri;
            this.show_spinner();
            jQuery("#" + this.interface_id + " .cui_spinner_container p").html("Downloading. Please wait.");
            var jthis = this;
            jQuery.ajax({
                url:uri + "/upload-server.php",
                type:"post",
                data:"action=add_url&type=" + jQuery("#" + this.interface_id + " input[name*=\"type\"]").val() + "&url=" + encodeURIComponent(url) + "&sender=" + encodeURIComponent(this.interface_id),
                success:function (msg) {
                    jthis.hide_spinner();
                    eval(msg);
                }
            });
        };
        return object;
    },
    Featured_Functionality:function (object) {
        object.inherited_upload_finished_with_success = object.upload_finished_with_success;
        object.upload_finished_with_success = function (params) {
            var tid = this.inherited_upload_finished_with_success(params);
            var thumbnail_id = "thumbnail_" + tid;
            var jthis = this;
            if (jQuery("#" + this.interface_id + " .cui_thumbnail").length == 1) {
                jthis.set_featured(tid);
            }
            jQuery("#" + this.interface_id + " #" + thumbnail_id + " .feat_ref").click(function () {
                jthis.set_featured(tid);
            });
        };
        object.set_featured = function (id) {
            this.featured = this.thumbnail_ids[id];
            var thumbnail_id = "thumbnail_" + id;
            jQuery("#" + this.interface_id + " .cui_thumbnail").css("border-color", "white");
            jQuery("#" + this.interface_id + " #" + thumbnail_id).css("border-color", "gray");

        };
        object.inherited_remove = object.remove;
        object.remove = function (id) {
            this.inherited_remove(id);
            if (this.featured == this.thumbnail_ids[id]) {
                var i;
                for (i = 0; i < this.attachments.length; i++) {
                    if (this.attachments[i]) {
                        var thumbnail_id = jQuery.inArray(this.attachments[i], this.thumbnail_ids);
                        this.set_featured(thumbnail_id);
                        break;
                    }
                }
            }
        };
        object.inherited_serialize = object.serialize;
        object.serialize = function () {
            return this.inherited_serialize() + "&featured=" + (this.featured ? this.featured : '');
        };

        object.inherited_reset = object.reset;
        object.reset = function () {
            this.inherited_reset();
            this.featured = false;
        };
        return object;
    },
    Video_Functionality:function (object) {
        object.video_urls = new Array();
        object.inherited_serialize = function () {
            var querydata = "";
            var id;
            for (id = 0; id < this.attachments.length; id++) {
                querydata += "&attachments[]=" + encodeURIComponent(this.attachments[id]);
                if (this.video_urls[this.attachments[id]])
                    querydata += "&video_urls[" + object.attachments[id] + "]=" + encodeURIComponent(this.video_urls[this.attachments[id]]);
            }
            return querydata;
        };
        object.inherited_inherited_upload_finished_with_success = object.upload_finished_with_success;
        object.upload_finished_with_success = function (params) {
            this.inherited_inherited_upload_finished_with_success(params);
            if (params["video_url"])
                object.video_urls[params["attach_id"]] = params["video_url"];
        };
        object.inherited_inherited_remove = object.remove;
        object.remove = function (id) {
            this.inherited_inherited_remove(id);
            var attach_id = this.thumbnail_ids[id];
            var idx = jQuery.inArray(attach_id, this.video_urls);
            if (idx != -1) {
                this.video_urls.splice(idx, 1);
            }
        }
    },
    Degenerate_Into_Featured_Image_Uploader:function (object) {
        object.inherited_inherited_upload_finished_with_success = object.upload_finished_with_success;
        object.upload_finished_with_success = function (params) {
            var i;
            for (i = 0; i < this.thumbnail_ids.length; i++) {
                this.remove(i);
            }
            object.inherited_inherited_upload_finished_with_success(params);
        };
        object.remove = function (id) {
            var attach_id = this.featured;
            var uri = Cosmo_Uploader.template_directory_uri;
            this.attachments = new Array();
            this.thumbnail_ids = new Array();

            jQuery.ajax({
                url:uri + "/upload-server.php",
                type:"post",
                data:"action=delete&attach_id=" + attach_id
            });
            jQuery("#" + this.interface_id + " .cui_thumbnail").remove();
        }
    },
    Get_Floating_Uploader:function (image_selector, hidden_input) {
        var j_image_selector = image_selector;
        var j_hidden_input_selector = hidden_input;
        jQuery(image_selector).mouseenter(function () {
                jQuery("#floating_uploader").css("top", jQuery(j_image_selector).offset().top + "px");
                jQuery("#floating_uploader").css("left", jQuery(j_image_selector).offset().left + "px");
                jQuery(j_image_selector).css('opacity', 0.1);
                jQuery("#floating_uploader").removeClass("hidden");
                window.floating_uploader.upload_finished_with_success = function (params) {
                    jQuery(j_image_selector).attr("src", params["url"]);
                    jQuery(j_hidden_input_selector).val(params["attach_id"]);
                    this.hide_spinner();
                }
            }
        );
        jQuery("#floating_uploader").mouseleave(function () {
                jQuery("#floating_uploader").addClass("hidden");
                jQuery(j_image_selector).css('opacity', 1);
            }
        );
    }
};

jQuery( function(){
    var menu_color = jQuery( '#pick_menu_color' ).val();
    var header_text_color = jQuery( '#pick_header_text_color' ).val();
    jQuery( '.generic-header_type' ).change( function(){
        var val = jQuery( this ).val();
        if( val == 'centered' ){
            jQuery( '.header-preview .header-slider' ).animate( { left: 0 } );
            jQuery( '#menu_type_centered, #menu_type_description, #menu_type_buttons,  #menu_type_text' ).parent().show();
            jQuery( '#menu_type_colored, #menu_type_vertical' ).parent().hide();
        }else if( val == 'searchbar' ){
            jQuery( '.header-preview .header-slider' ).animate( { left: -700 } );
            jQuery( '#menu_type_colored, #menu_type_centered, #menu_type_description, #menu_type_buttons,  #menu_type_text' ).parent().show();
            jQuery( '#menu_type_vertical' ).parent().hide();
        }else if( val == 'menu' ){
            jQuery( '#menu_type_description, #menu_type_text' ).parent().show();
            jQuery( '#menu_type_colored, #menu_type_vertical, #menu_type_centered, #menu_type_buttons' ).parent().hide();
            jQuery( '.header-preview .header-slider' ).animate( {left: -1400});
        }else if( val == 'social' ){
            jQuery( '.header-preview .header-slider' ).animate( { left: -2100 } );
            jQuery( '#menu_type_vertical' ).parent().show();
            jQuery( '#menu_type_centered, #menu_type_description, #menu_type_buttons, #menu_type_colored_full, #menu_type_centered, #menu_type_tabs, #menu_type_text, #menu_type_colored, #menu_type_dashed' ).parent().hide();
        }

        jQuery( '.generic-field-image-select label' ).removeClass( 'selected' );
        jQuery( '.generic-field-image-select label input:checked' ).parent().addClass( 'selected' );
        jQuery( '.header-preview nav.colored, .nav-container .container, .cosmo-icons.colored' ).css( 'background-color' , menu_color );
        jQuery( '.header-preview nav.colored, .nav-container .container, .cosmo-icons.colored' ).find( 'a' ).css( 'color' , header_text_color );

        if( !jQuery( '.menu-thumbs label.selected:visible').length ){
            jQuery( '.menu-thumbs label:visible input').first().click().trigger( 'change');
        }
    });

    jQuery( '.generic-menu_type' ).change( function(){
        var val = jQuery( this ).val();
        var old = jQuery( '.header-preview header nav' );
        var _new = false;
        if( val.indexOf( 'colored' ) > -1 || ( jQuery( 'input.generic-enb_top_bar:checked' ).val() == 'yes' ) ){
            jQuery( '#pick_menu_color' ).parent().parent().slideDown();
            jQuery( '#pick_header_text_color' ).parent().parent().slideDown();

        }else{
            jQuery( '#pick_menu_color' ).parent().parent().slideUp();
            jQuery( '#pick_header_text_color' ).parent().parent().slideUp();
        }

        if( val == 'colored' && !old.find( 'div.cosmo-icons' ).hasClass( 'colored' ) ){
            _new = jQuery( '.header-preview .menus-container div.cosmo-icons.colored' ).parent( 'nav' );
        }else if( val == 'buttons' && !old.hasClass( 'buttons-menu' ) ){
            _new = jQuery( '.header-preview .menus-container nav.buttons-menu' );
        }else if( val =='dashed' && !old.hasClass( 'dashed-menu' ) ){
            _new = jQuery( '.header-preview .menus-container nav.dashed-menu' );
        }else if( val =='tabs' && !old.hasClass( 'tabs-menu' ) ){
            _new = jQuery( '.header-preview .menus-container nav.tabs-menu' );
        }else if( val == 'centered' && !old.hasClass( 'centered-menu' ) ){
            _new = jQuery( '.header-preview .menus-container nav.centered-menu' );
        }else if( val == 'text' && !old.hasClass( 'text-menu' ) ){
            _new = jQuery( '.header-preview .menus-container nav.text-menu' );
        }else if( val == 'description' &&!old.hasClass( 'description-menu' ) ){
            _new = jQuery( '.header-preview .menus-container nav.description-menu' );
        }else if( val == 'colored_full' ){
            _new = jQuery( '.header-preview .menus-container div.nav-container' );
        }else if( val == 'vertical' ){
            _new = jQuery( '.header-preview .menus-container nav.list-menu' );
        }
        if( _new !== false ){
            if( jQuery( '.header-preview header div.nav-container' ).length ){
                jQuery( '.header-preview header nav' ).unwrap().unwrap();
                jQuery( '.header-preview header div.mobile-menu' ).remove();
            }
            old.fadeOut( 'fast' , function(){
                old.each( function(index, elem){
                    var clone = _new.clone();
                    jQuery( elem ).replaceWith( clone );
                    clone.css( 'opacity' , 0 ).animate({ opacity:1 }, 'fast' );
                });
            });
        }

        jQuery( '.generic-field-image-select label' ).removeClass( 'selected' );
        jQuery( '.generic-field-image-select input:checked' ).parent().addClass( 'selected' );
        jQuery( '.header-preview nav.colored, .nav-container .container, .cosmo-icons.colored' ).css( 'background-color' , menu_color );
        jQuery( '.header-preview nav.colored, .nav-container .container, .cosmo-icons.colored' ).find( 'a' ).css( 'color' , header_text_color );
    });

    jQuery( 'input.generic-enb_top_bar' ).change( function(){
        var val = jQuery( '.generic-menu_type:checked').val();
        if( val.indexOf( 'colored' ) > -1 || ( jQuery( 'input.generic-enb_top_bar:checked' ).val() == 'yes' ) ){
            jQuery( '#pick_menu_color' ).parent().parent().slideDown();
            jQuery( '#pick_header_text_color' ).parent().parent().slideDown();

        }else{
            jQuery( '#pick_menu_color' ).parent().parent().slideUp();
            jQuery( '#pick_header_text_color' ).parent().parent().slideUp();
        }
    });

    jQuery( '#link_pick_menu_color' ).click( function(){
        jQuery( '#colorPickerDiv_menu_color div.farbtastic' ).unbind( 'mouseout mousemove' ).on( 'mouseout mousemove', function(){
            menu_color = jQuery( '#link_pick_menu_color' ).css( 'background-color' );
            jQuery( '.header-preview nav.colored, .nav-container .container, .cosmo-icons.colored' ).css( 'background-color' , menu_color );
        });
    });

    jQuery( '#link_pick_header_text_color' ).click( function(){
        jQuery( '#colorPickerDiv_header_text_color div.farbtastic' ).unbind( 'mouseout mousemove' ).on( 'mouseout mousemove', function(){
            header_text_color = jQuery( '#link_pick_header_text_color' ).css( 'background-color' );
            jQuery( '.header-preview nav.colored, .nav-container .container, .cosmo-icons.colored' ).find( 'a' ).css( 'color' , header_text_color );
        });
    });
    jQuery( '.generic-field-image-select input:checked' ).trigger( 'change' );
});

function load_more(obj, view, type, id, row_id, template_id){

   
    var current_page = jQuery(obj).attr('current_page');
    var container_id = jQuery(obj).attr('container_id');
    var postID = jQuery( '#postID').val();

    jQuery('.ajax-'+container_id).show();
    jQuery(obj).hide();

    if(jQuery('#'+container_id).find('div.row.timeline-elem').last().data('elemclass')){
        /* need for timeline view */
        /* figure out if the last timeline element is on the left or on the right side of the time 'line' */
        var timeline_elem_class = jQuery('#'+container_id).find('div.row.timeline-elem').last().data('elemclass');
    }else{
        var timeline_elem_class = '';
    }

    
    jQuery.ajax({
        url: MyAjax.ajaxurl,
        data: '&action=load_more&current_page='+current_page+'&getMoreNonce='+MyAjax.getMoreNonce+'&timeline_class='+timeline_elem_class+'&view='+view+'&type='+type+'&id='+id+'&row_id='+row_id+'&template_id='+template_id+'&postID=' + postID + '&' + jQuery.param( MyAjax.wpargs ),
        type: 'POST',
        cache: false,
        success: function (data) { 
            json = eval("(" + data + ")");
            if(json['content'] && json['content'] != ''){
                jQuery(obj).attr('current_page',json['current_page']);

                if( jQuery('#'+container_id).hasClass('masonry') ){
                    var the_content_obj = jQuery(json['content']);
                        
                    if( jQuery(window).width() > 767 ){
                        setTimeout(function(){
                            jQuery('#'+container_id).isotope( 'insert', the_content_obj );
                            jQuery('.ajax-'+container_id).hide(); 
                            jQuery(obj).show();
                        },3000);
                        //jQuery('#'+container_id).isotope( 'insert', the_content_obj );
                    }else{
                        jQuery('#'+container_id).append( the_content_obj );
                        jQuery('.ajax-'+container_id).hide(); 
                        jQuery(obj).show();
                    }
                }else{
                    jQuery('#'+container_id).append(json['content']).find( '.hidden').waitForImages( {
                        finished: function(){
                             

                            jQuery('#'+container_id).find( '.hidden').each( function( index, element ){
                                jQuery( element).delay( 200 * ( index ) ).fadeIn( 'slow', function(){
                                    jQuery( this).removeClass( 'hidden' );
                                });
                            });
                            
                        },
                        waitForAll: true
                    });    
                    jQuery('.ajax-'+container_id).hide();
                    jQuery(obj).show();
                }
                

                hoverThumbImg();
                elastislide_carousel();
                if (prettyPhoto_enb.enb_lightbox) { 
                    jQuery(document).ready(function(){
                        jQuery("a[rel^='prettyPhoto']").prettyPhoto({
                            autoplay_slideshow: false,
                            theme: 'light_square'                        
                        });
                    });
                };
            }

            if( !json[ 'need_load_more' ] ){
                //hide load more
                if( jQuery( obj ).parent().next().length ){
                    var $delimiter = jQuery( '<div></div>' ).addClass( 'delimiter' );
                    jQuery(obj).replaceWith( $delimiter );
                }else{
                    jQuery(obj).remove();
                }
            }
            
            //jQuery('.ajax-'+container_id).hide();
            //jQuery(obj).show();
        },
        error: function (xhr) {
            alert(xhr);
            
        }
    });

}