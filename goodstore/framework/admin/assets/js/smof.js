/**
 * SMOF js
 *
 * contains the core functionalities to be used
 * inside SMOF
 */

jQuery.noConflict();

/** Fire up jQuery - let's dance! 
 */
jQuery(document).ready(function($) {

    angular.bootstrap(jQuery('#of_container'), ['jawEditor']);


    //delays until AjaxUpload is finished loading
    //fixes bug in Safari and Mac Chrome
    if (typeof AjaxUpload != 'function') {
        return ++counter < 6 && window.setTimeout(init, counter * 500);
    }




//AJAX Upload
    function of_image_upload() {
        $('.image_upload_button').each(function() {

            var clickedObject = $(this);
            var clickedID = $(this).attr('id');

            var nonce = $('#security').val();

            new AjaxUpload(clickedID, {
                action: ajaxurl,
                name: clickedID, // File upload name
                data: {// Additional data to send
                    action: 'jw_ajax_action',
                    type: 'upload',
                    security: nonce,
                    data: clickedID
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

    of_image_upload();



    /** Aquagraphite Slider MOD */

    //Hide (Collapse) the toggle containers on load
    $(".slide_body").hide();

    //Switch the "Open" and "Close" state per click then slide up/down (depending on open/close state)
    $(".slide_edit_button").live('click', function() {
        $(this).parent().toggleClass("active").next().slideToggle("fast");
        return false; //Prevent the browser jump to the link anchor
    });

    // Update slide title upon typing		
    function update_slider_title(e) {
        var element = e;
        if (this.timer) {
            clearTimeout(element.timer);
        }
        this.timer = setTimeout(function() {
            $(element).parent().prev().find('strong').text(element.value);
        }, 100);
        return true;
    }

    $('.of-slider-title').live('keyup', function() {
        update_slider_title(this);
    });

    var _TBwindow = $('#TB_window');
    _TBwindow.css('margin-left', 'auto');


    //Add new slide
    $(".slide_add_button").live('click', function() {
        var slidesContainer = $(this).prev();
        var sliderId = slidesContainer.attr('id');
        var sliderInt = $('#' + sliderId).attr('rel');

        var numArr = $('#' + sliderId + ' li').find('.order').map(function() {
            var str = this.id;
            str = str.replace(/\D/g, '');
            str = parseFloat(str);
            return str;
        }).get();

        var maxNum = Math.max.apply(Math, numArr);
        if (maxNum < 1) {
            maxNum = 0;
        }
        var newNum = maxNum + 1;

        var newSlide = '<li class="temphide"><div class="slide_header"><strong>Slide ' + newNum + '</strong><input type="hidden" class="slide of-input order" name="' + sliderId + '[' + newNum + '][order]" id="' + sliderId + '_slide_order-' + newNum + '" value="' + newNum + '"><a class="slide_edit_button" href="#">Edit</a></div><div class="slide_body" style="display: none; "><label>Title</label><input class="slide of-input of-slider-title" name="' + sliderId + '[' + newNum + '][title]" id="' + sliderId + '_' + newNum + '_slide_title" value=""><label>Image URL</label><input class="slide of-input" name="' + sliderId + '[' + newNum + '][url]" id="' + sliderId + '_' + newNum + '_slide_url" value=""><div class="upload_button_div"><span class="button media_upload_button" id="' + sliderId + '_' + newNum + '" rel="' + sliderInt + '">Upload</span><span class="button mlu_remove_button hide" id="reset_' + sliderId + '_' + newNum + '" title="' + sliderId + '_' + newNum + '">Remove</span></div><div class="screenshot"></div><label>Link URL (optional)</label><input class="slide of-input" name="' + sliderId + '[' + newNum + '][link]" id="' + sliderId + '_' + newNum + '_slide_link" value=""><label>Description (optional)</label><textarea class="slide of-input" name="' + sliderId + '[' + newNum + '][description]" id="' + sliderId + '_' + newNum + '_slide_description" cols="8" rows="8"></textarea><a class="slide_delete_button" href="#">Delete</a><div class="clear"></div></div></li>';

        slidesContainer.append(newSlide);
        $('.temphide').fadeIn('fast', function() {
            $(this).removeClass('temphide');
        });

        of_image_upload(); // re-initialise upload image..

        return false; //prevent jumps, as always..
    });

    //add sidebar
    $(".sidebar_add_button").live('click', function() {
        var name = $('#sidebar_name').val();

        if (name.length > 0) {
            // todo funkce na unikatni id
            var slugName = rewrite(name);
            var sidebarsContainer = $(this).next(); //ul id=
            var optionId = sidebarsContainer.attr('id');

            var newSidebar = '<li class="temphide"><div class="sidebar_header">';
            newSidebar += '<input type="hidden" name="' + optionId + '[' + slugName + '][name]" value="' + name + '">';
            newSidebar += '<input type="hidden" name="' + optionId + '[' + slugName + '][id]" value="' + slugName + '">';
            newSidebar += '<input type="hidden" name="' + optionId + '[' + slugName + '][desc]" value="">';
            newSidebar += '<strong>' + name + '</strong><a class="sidebar_delete_button" href="#">Delete</a></div></li>';

            sidebarsContainer.append(newSidebar);
            $('.temphide').fadeIn('fast', function() {
                $(this).removeClass('temphide');
            });



            $.post(ajaxurl,
                    {
                        action: 'jaw_add_sidebar',
                        name: name,
                        id: slugName
                    });

            $('#sidebar_name').val('');

        }

        return false; //prevent jumps, as always..
    });

    //hides warning if js is enabled			
    $('#js-warning').hide();





    // LISTING THEMEOPTIONS MENU ===============================================

    // //Tabify Options			
    $('.group').hide();


    //change menu

    function changepanel(item) {

        // if ($(item).attr('class') != 'current') {
        var clicked_group = $(item).attr('href');

        var sev = $(item).parent().attr('rel');

        if ($(item).parent().hasClass('parent')) { // je polozka parent ?
            $('#of-nav li ul').not($(item).next()).slideUp(); // skryjeme otevrene panely
            $(item).next().stop().slideToggle();

        } else {
            if ($(item).parent().hasClass('child')) { // je polozka child?

                $(item).parent().parent().show();
                $('.group').hide();
                $(clicked_group).fadeIn('fast');
                $('#of-nav li a').removeClass('current');
                $(item).addClass('current');
                $.cookie('of_current_opt', sev, {expires: 7, path: '/'});
            } else { // obyc polozka
                $('.group').hide();
                $(clicked_group).fadeIn('fast');
                $.cookie('of_current_opt', sev, {expires: 7, path: '/'});
                $(item).next().stop().slideToggle();
                $('#of-nav li ul').slideUp(); // skryjeme otevrene panely
                $('#of-nav li a').removeClass('current');
                $(item).addClass('current');
            }
            //   }
        }

    }

    // Display last current tab	
    if ($.cookie("of_current_opt") === null) {
        $('.group:first').fadeIn('fast');
        $('#of-nav li:first a').addClass('current');
    } else {
        changepanel($('li.' + $.cookie("of_current_opt") + ' a'));
    }



    // events for menu 
    $('#of-nav li a').click(function() {
        changepanel(this);
        return false;
    });


    //Expand Options 
    var flip = 0;



    $('#expand_options').click(function() {
        if (flip == 0) {
            flip = 1;
            $('#of_container #of-nav').hide();
            $('#of_container #content').width(755);
            $('#of_container .group').add('#of_container .group h2').show();

            $(this).removeClass('expand');
            $(this).addClass('close');
            $(this).text('Close');

        } else {
            flip = 0;
            $('#of_container #of-nav').show();
            $('#of_container #content').width(574);
            $('#of_container .group').add('#of_container .group h2').hide();
            $('#of_container .group:first').show();
            $('#of_container #of-nav li').removeClass('current');
            $('#of_container #of-nav li:first').addClass('current');

            $(this).removeClass('close');
            $(this).addClass('expand');
            $(this).text('Expand');

        }

    });

    //Update Message popup
    $.fn.center = function() {
        this.animate({
            "top": ($(window).height() - this.height() - 200) / 2 + $(window).scrollTop() + "px"
        }, 100);
        this.css("left", 250);
        return this;
    }


    $('#of-popup-save').center();
    $('#of-popup-reset').center();
    $('#of-popup-fail').center();




    //Masked Inputs (images as radio buttons)


    //Masked Inputs (background images as radio buttons)
    $('.of-radio-tile-img').click(function() {
        $(this).parent().parent().find('.of-radio-tile-img').removeClass('of-radio-tile-selected');
        $(this).addClass('of-radio-tile-selected');
    });
    $('.of-radio-tile-label').hide();
    $('.of-radio-tile-img').show();
    $('.of-radio-tile-radio').hide();






    var _TBwindow = $('#TB_window');
    _TBwindow.css('margin-left', 'auto');


    //add sidebar
    $(".sidebar_add_button").live('click', function() {
        var name = $('#sidebar_name').val();

        if (name.length > 0) {
            // todo funkce na unikatni id
            var slugName = rewrite(name);
            var sidebarsContainer = $(this).next(); //ul id=
            var optionId = sidebarsContainer.attr('id');

            var newSidebar = '<li class="temphide"><div class="sidebar_header">';
            newSidebar += '<input type="hidden" name="' + optionId + '[' + slugName + '][name]" value="' + name + '">';
            newSidebar += '<input type="hidden" name="' + optionId + '[' + slugName + '][id]" value="' + slugName + '">';
            newSidebar += '<input type="hidden" name="' + optionId + '[' + slugName + '][desc]" value="">';
            newSidebar += '<strong>' + name + '</strong><a class="sidebar_delete_button" href="#">Delete</a></div></li>';

            sidebarsContainer.append(newSidebar);
            $('.temphide').fadeIn('fast', function() {
                $(this).removeClass('temphide');
            });



            $.post(ajaxurl,
                    {
                        action: 'add_sidebar',
                        name: name,
                        id: slugName
                    });

            $('#sidebar_name').val('');

        }

        return false; //prevent jumps, as always..
    });


    function rewrite(obj) {

        var url = obj
                .toLowerCase() // change everything to lowercase
                .replace(/^\s+|\s+$/g, "") // trim leading and trailing spaces		
                .replace(/[_|\s]+/g, "-") // change all spaces and underscores to a hyphen
                .replace(/[^a-z0-9-]+/g, "") // remove all non-alphanumeric characters except the hyphen
                .replace(/[-]+/g, "-") // replace multiple instances of the hyphen with a single instance
                .replace(/^-+|-+$/g, ""); // trim leading and trailing hyphens				
        return url;
    }

    //Sort slides
    jQuery('.slider').find('ul').each(function() {
        var id = jQuery(this).attr('id');
        $('#' + id).sortable({
            placeholder: "placeholder",
            opacity: 0.6
        });
    });


    /**	Sorter (Layout Manager) */
    jQuery('.sorter').each(function() {
        var id = jQuery(this).attr('id');
        $('#' + id).find('ul').sortable({
            items: 'li',
            placeholder: "placeholder",
            connectWith: '.sortlist_' + id,
            opacity: 0.6,
            update: function() {
                $(this).find('.position').each(function() {

                    var listID = $(this).parent().attr('id');
                    var parentID = $(this).parent().parent().attr('id');
                    parentID = parentID.replace(id + '_', '')
                    var optionID = $(this).parent().parent().parent().attr('id');
                    $(this).prop("name", optionID + '[' + parentID + '][' + listID + ']');

                });
            }
        });
    });


    /**	Ajax Backup & Restore MOD */
    //backup button
    $('#of_backup_button').live('click', function() {

        var answer = confirm("Click OK to backup your current saved options.")

        if (answer) {

            var clickedObject = $(this);
            var clickedID = $(this).attr('id');

            var nonce = $('#security').val();

            var data = {
                action: 'jw_ajax_action',
                type: 'backup_options',
                security: nonce
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

                    var success_popup = $('#of-popup-save');
                    success_popup.fadeIn();
                    window.setTimeout(function() {
                        location.reload();
                    }, 1000);
                }

            });

        }

        return false;

    });

    //import demo data button
    $('#of_importdemodata_button').live('click', function() {

        $('html, body').animate({
            scrollTop: 0
        }, 350);

        var answer = confirm("Click OK to import demo data.")


        if (answer) {

            $('body').prepend('<div id="cover_load"><div id="cover_load_text"><p>Importing</br>Please wait...</br>(It might takes up to 5 minutes)</p></div></div>');

            $("#cover_load").width('100%');
            $("#cover_load").height($('#wpwrap').height() + 50);




            var loading = $('.ajax-loading-img');
            loading.fadeIn();
            var clickedObject = $(this);
            var clickedID = $(this).attr('id');
            var clickedFILE = $(this).attr('file');

            var nonce = $('#security').val();

            var data = {
                action: 'jw_ajax_action',
                type: 'import_demo',
                security: nonce,
                clickedFILE: clickedFILE
            };
            //location.replace('themes.php?page=optionsframework&import_data=true&file=' + $(this).attr('file') + '&_wpnonce=' + nonce);
            import_demo(data);


            return false;
        }

        return false;

    });
    function import_demo(data) {
        $.ajax({
            type: "POST",
            url: ajaxurl,
            data: data,
            success: function(response) {
                if (response == 'donedoneend') {
                    alert("Import data and options done");
                } else if (response == 'doneend') {
                    alert("Import options done \nPlease save Theme Options");
                } else {
                    jQuery('#cover_load').css('background', '#ff0000');
                    alert("Something happend - please contact support at jaw@jawtemplates.com \n\nDETAILS:\n" + response.replace(/\\n/gi, '\n').replace(/\<br\\\>/gi, '\n'));
                }
                location.replace('themes.php?page=optionsframework');
            },
            error: function(error) {
                jQuery('#cover_load').css('background', '#ff0000');
                alert("Something happend - please contact support at jaw@jawtemplates.com \n\nError:\n" + error.responseText);
                location.replace('themes.php?page=optionsframework');
            }
        });
    }




    //restore button
    $('#of_restore_button').live('click', function() {

        var answer = confirm("'Warning: All of your current options will be replaced with the data from your last backup! Proceed?")

        if (answer) {
            var clickedObject = $(this);
            var clickedID = $(this).attr('id');

            var nonce = $('#security').val();

            var data = {
                action: 'jw_ajax_action',
                type: 'restore_options',
                security: nonce
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

                    var success_popup = $('#of-popup-save');
                    success_popup.fadeIn();
                    window.setTimeout(function() {
                        location.reload();
                    }, 1000);
                }

            });

        }

        return false;

    });

    /**	Ajax Transfer (Import/Export) Option */
    $('#of_import_button').live('click', function() {

        var answer = confirm("Import data rewrite actual setings. Are you really import data?")

        if (answer) {

            var clickedObject = $(this);
            var clickedID = $(this).attr('id');

            var nonce = $('#security').val();
            var target = jQuery(this).attr('target');

            var import_data = $('#export_data_' + target).val();



            var data = {
                action: 'jw_ajax_action',
                type: 'import_options',
                security: nonce,
                data: import_data,
                target: target
            };

            $.post(ajaxurl, data, function(response) {
                var fail_popup = $('#of-popup-fail');
                var success_popup = $('#of-popup-save');

                //check nonce
                if (response == -1) { //failed
                    fail_popup.fadeIn();
                    window.setTimeout(function() {
                        fail_popup.fadeOut();
                    }, 2000);
                }
                else
                {
                    success_popup.fadeIn();
                    window.setTimeout(function() {
                        location.reload();
                    }, 1000);
                }

            });

        }

        return false;

    });

    /** AJAX Save Options */
    $('.of_save').live('click', function() {

        var nonce = $('#security').val();

        $('.ajax-loading-img-inverse').hide();
        $('.ajax-loading-img').show();

        //get serialized data from all our option fields			
        var serializedReturn = $('#of_form :input[name][name!="security"][name!="of_reset"]').serialize();

        var data = {
            type: 'save',
            action: 'jw_ajax_action',
            security: nonce,
            cache: false,
            data: serializedReturn

        };

        $.post(ajaxurl, data, function(response) {
            var success = $('#of-popup-save');
            var fail = $('#of-popup-fail');
            
            $('.ajax-loading-img').hide();
            $('.ajax-loading-img-inverse').show();

            var loading = $('.ajax-loading-img');
            loading.hide();

            if (response == 1) {
                success.fadeIn();
            } else {
                fail.fadeIn();
                $('#of-popup-fail .save_message').html($(response).text());
            }

            window.setTimeout(function() {
                success.fadeOut();
                fail.fadeOut();

            }, 2500);
        });

        return false;

    });


    /* AJAX Options Reset */
    $('#of_reset').click(function() {

        //confirm reset
        var answer = confirm("Click OK to reset. All settings will be lost and replaced with default settings!");

        //ajax reset
        if (answer) {

            var nonce = $('#security').val();

            $('.ajax-reset-loading-img').fadeIn();

            var data = {
                type: 'reset',
                action: 'jw_ajax_action',
                security: nonce
            };

            $.post(ajaxurl, data, function(response) {
                var success = $('#of-popup-reset');
                var fail = $('#of-popup-fail');
                var loading = $('.ajax-reset-loading-img');
                loading.fadeOut();

                if (response == 1)
                {
                    success.fadeIn();
                    window.setTimeout(function() {
                        location.reload();
                    }, 1000);
                }
                else
                {
                    fail.fadeIn();
                    window.setTimeout(function() {
                        fail.fadeOut();
                    }, 2000);
                }


            });

        }


    });
    
    
    
    if(jQuery('#of_form').length){
        jQuery('.jw-fixed-save').css({
            left: jQuery('#of_form').offset().left + jQuery('#of_form').width(),
        });
        
		setTimeout(function(){
	        jQuery('.jw-fixed-save').css({
	            top: jQuery('#of_form').offset().top - jQuery(window).scrollTop() +70
	        });
		},1000);
        
        jQuery(window).on('scroll',function(){
            if(jQuery(window).scrollTop() < jQuery('#of_form').offset().top){
                jQuery('.jw-fixed-save').css({
                    top: jQuery('#of_form').offset().top - jQuery(window).scrollTop() +70
                });
            }else{
                 jQuery('.jw-fixed-save').css({
                    top: 70
                });
            }
        });
    }


}); //end doc ready


