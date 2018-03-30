jQuery.noConflict();


/* HELP
 * @since Flyingnews
 */
var launchHelp = function(URL) {
    var help = window.open(URL, "", "width=1200,height=800,modal=yes,alwaysRaised=yes");
    help.focus();
}

function multiselect() {
    /* Chosen elements @since jawtemplates */
    jQuery("select.jaw-chosen").each(function() {

        var $placeholder = jQuery(this).attr('data-placeholder');

        if (jQuery(this).parents('.postbox').is('.closed')) {
            var chosen = jQuery(this);

            chosen.parents('.postbox').children('.hndle,.handlediv').bind('clickoutside', function(e) {
                if ($placeholder != undefined) {
                    chosen.data("placeholder", $placeholder).jaw_chosen();
                } else {
                    chosen.jaw_chosen();
                }
            });
        } else {

            if ($placeholder != undefined) {
                jQuery(this).data("placeholder", $placeholder).jaw_chosen();
            } else {
                jQuery(this).jaw_chosen();
            }
        }
    });


}

function ajax_multidropdown(id, data) {
    var select = jQuery('#' + id);

    data.items_not_in = new Array();
    jQuery.each(select.find('option:selected'), function() {
        jQuery(this).attr('selected', 'selected');

        data.items_not_in.push(jQuery(this).val());
    });
    select.find('option:not([selected])').remove();
    jQuery.post(
            ajaxurl,
            {
                'action': 'load_multidropdown',
                'data': data
            },
    function(response) {

        var selected = jQuery.parseJSON(select.attr('default_value'));

        jQuery.each(jQuery.parseJSON(response), function(key, val) {
            if (jQuery.inArray(key, selected) >= 0) {
                select.append('<option value="' + key + '" selected="selected">' + val + '</option>');
            } else {
                select.append('<option value="' + key + '" >' + val + '</option>');
            }
        });

        select.trigger("liszt:updated");

    }
    );
}


jQuery(document).ready(function($) {


    multiselect();


    //delays until AjaxUpload is finished loading
    //fixes bug in Safari and Mac Chrome
    if (typeof AjaxUpload != 'function') {
        return ++counter < 6 && window.setTimeout(init, counter * 500);
    }



    /* LAYOUT ******************************************************************
     * @since FlyingNews
     */
    extendChange();
    //Masked Inputs (images as radio buttons)
    $('.radio-layout').click(function(event) {
        //event.preventDefault();
        $(this).parent().find('.radio-layout').removeClass('of-radio-img-selected');
        $(this).addClass('of-radio-img-selected');
        extendChange('200');
        $('html, body').scrollTop($(this).offset().top - 200);
    });

    // Template Check List
    function extendChange(time, att_val) {
        jQuery('.section-layout div.of-radio-img-selected').each(function() {
            if (att_val === undefined) {
                var val = jQuery(this).children().attr('val');
            } else {
                var val = att_val;
                jQuery(this).parent().find('.radio-layout').removeClass('of-radio-img-selected');
            }
            var rel = jQuery(this).children().attr('rel');

            //jQuery('#section-' + rel + '_right1_width').hide(0);
            jQuery('#section-' + rel + '_right1').hide(0);
            //jQuery('#section-' + rel + '_left1_width').hide(0);
            jQuery('#section-' + rel + '_left1').hide(0);
            //jQuery('#section-' + rel + '_right2_width').hide(0);
            jQuery('#section-' + rel + '_right2').hide(0);
            //jQuery('#section-' + rel + '_left2_width').hide(0);
            jQuery('#section-' + rel + '_left2').hide(0);

            var sidebars = val.split('_');
            if (val != "fullwidth") {
                jQuery.each(sidebars, function(key, value) {
                    jQuery('#section-' + rel + '_' + value).show(0);
                    //jQuery('#section-' + rel + '_' + value+'_width').show(0);
                });
            }

            var scope = angular.element(jQuery("#jaw_page_builder")).scope();
            if (scope !== undefined) {
                scope.$$childHead.check_width(-1);
            }
        });
    }
    /* LAYOUT END **************************************************************/




    /* AJAX Upload ******************************************************************
     * @since FlyingNews
     */
    $(".image_upload_button").live('click', function() {
        of_image_upload();
    });
    function of_image_upload() {
        $('.image_upload_button').each(function() {
            var clickedObject = $(this);
            var clickedID = $(this).attr('id');
            var save = $('#security').attr('attr');
            var nonce = $('#security').val();

            new AjaxUpload(clickedID, {
                action: ajaxurl,
                name: clickedID, // File upload name
                data: {// Additional data to send
                    action: 'jw_ajax_post_action',
                    type: 'upload',
                    security: nonce,
                    data: clickedID,
                    nosave: save
                },
                autoSubmit: true, // Submit file after selection
                responseType: false,
                onChange: function(file, extension) {
                },
                onSubmit: function(file, extension) {
                    clickedObject.text('Uploading'); // change button text, when user selects file	
                    this.disable(); // If you want to allow uploading only 1 file at time, you can disable upload button
                    interval = window.setInterval(function() {
                        var text = clickedObject.text();
                        if (text.length < 13) {
                            clickedObject.text(text + '.');
                        }
                        else {
                            clickedObject.text('Uploading');
                        }
                    }, 200);
                },
                onComplete: function(file, response) {
                    window.clearInterval(interval);
                    clickedObject.text('Upload Image');
                    this.enable(); // enable upload button


                    // If nonce fails
                    if (response == -1) {
                        var fail_popup = $('#of-popup-fail');
                        fail_popup.fadeIn();
                        window.setTimeout(function() {
                            fail_popup.fadeOut();
                        }, 2000);
                    }

                    // If there was an error
                    else if (response.search('Upload Error') > -1) {
                        var buildReturn = '<span class="upload-error">' + response + '</span>';
                        $(".upload-error").remove();
                        clickedObject.parent().after(buildReturn);

                    }
                    else {

                        var buildReturn = '<img class="hide of-option-image" id="image_' + clickedID + '" src="' + response + '" alt="" />';

                        $(".upload-error").remove();
                        $("#image_" + clickedID).remove();
                        clickedObject.parent().after(buildReturn);
                        $('img#image_' + clickedID).fadeIn();
                        clickedObject.next('span').fadeIn();
                        clickedObject.parent().prev('input').val(response);
                    }
                }
            });

        });

    }
    //AJAX Remove Image (clear option value)
    $('.image_reset_button').live('click', function() {

        var clickedObject = $(this);
        var clickedID = $(this).attr('id');
        var theID = $(this).attr('title');

        var nonce = $('#security').val();

        var data = {
            action: 'of_ajax_post_action',
            type: 'image_reset',
            security: nonce,
            data: theID
        };

        $.post(ajaxurl, data, function(response) {

            //check nonce
            if (response == -1) { //failed

                var fail_popup = $('#of-popup-fail');
                fail_popup.fadeIn();
                window.setTimeout(function() {
                    fail_popup.fadeOut();
                }, 2000);
            }

            else {

                var image_to_remove = $('#image_' + theID);
                var button_to_hide = $('#reset_' + theID);
                image_to_remove.fadeOut(500, function() {
                    $(this).remove();
                });
                button_to_hide.fadeOut();
                clickedObject.parent().prev('input').val('');
            }


        });

    });

    /* AJAX upload END **************************************************************/



    // Style Select
    (function($) {
        styleSelect = {
            init: function() {
                $('.select_wrapper').each(function() {
                    $(this).prepend('<span>' + $(this).find('.select option:selected').text() + '</span>');
                });
                $('.select').live('change', function() {
                    $(this).prev('span').replaceWith('<span>' + $(this).find('option:selected').text() + '</span>');
                });
                $('.select').bind($.browser.msie ? 'click' : 'change', function(event) {
                    $(this).prev('span').replaceWith('<span>' + $(this).find('option:selected').text() + '</span>');
                });
            }
        };
        $(document).ready(function() {
            styleSelect.init();
        })
    })(jQuery);





    /* Remove individual sidebr
     * @since FlyingNews
     */
    $('.sidebar_delete_button').live('click', function() {
        // event.preventDefault();
        var agree = confirm("Are you sure you wish to delete this sidebar?");
        if (agree) {
            var $trash = $(this).parents('li');
            
            $trash.animate({
                opacity: 0.25,
                height: 0
            }, 300, function() {
                $(this).remove();
            });
            return false; //Prevent the browser jump to the link anchor
        } else {
            return false;
        }
    });


    /* typography
     * @since FlyingNews
     */
    if (jQuery().tipsy) {
        $('.typography-size, .typography-height, .typography-face, .typography-style, .of-typography-color').tipsy({
            fade: true,
            gravity: 's',
            opacity: 0.7
        });
    }





    /* Ajax dropdown ****************************************************
     * @since Goodstore
     */
    //Zobrazen� nejnovejsich p��zp�vk�
    jQuery.each(jQuery('.ajax_multidropdown'), function() {
        var $element = jQuery(this);
        $element.find('li.search-field').live('click', function() {
            var id = $element.parent().parent().parent().attr('id').split('-');
            var data = new Object;
            data.items_per_page = '-1';
            ajax_multidropdown(id[1], data);
        });
    });


    //on load - na�ten� ulo�en�ch polo�ek
    jQuery.each(jQuery('.ajax_multidropdown'), function() {
        var id = jQuery(this).attr('id');
        var data = new Object;
        data.items_in = jQuery.parseJSON(jQuery(this).attr('default_value'));
        if (data.items_in != '') {
            data.items_per_page = '-1';
        } else {
            data.items_per_page = '0';
        }
        ajax_multidropdown(id, data);
    });
    //END call ajax dropdown ****************************************************  END



    /* Set predefined colors in theme options -> Styling options
     * @since Goodstore
     */
    jQuery('#section-template_body_main_color').find('.of-radio-tile-img').on('click', function() {
        if (confirm('Really want to load colors? Old setting will be lost!')) {
            jQuery.each(jQuery(this).data(), function(key, val) {
                var input = jQuery('#section-' + key).find('.input-append > input');
                input.val(val);
                input.trigger('input');
            });
        }
    });


    /* Convert address to GPS
     * @since Goodstore
     */
    jQuery('.convert_to_gps').live('click', function() {
        var adr_id = jQuery(this).attr('data-id');
        var address = jQuery('#address-' + adr_id).val().replace(' ', '+');
        jQuery.getJSON("http://maps.googleapis.com/maps/api/geocode/json?address=" + address + '&sensor=true', function(data) {
            jQuery('#latitude').val(data.results[0].geometry.location.lat);
            jQuery('#longitude').val(data.results[0].geometry.location.lng);
            jQuery('#latitude').trigger('input');
            jQuery('#longitude').trigger('input');
        });

    });





}); //end doc ready




