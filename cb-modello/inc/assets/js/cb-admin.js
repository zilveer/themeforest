jQuery(document).ready(function($) {
	jQuery('#wpbody').append('<div class="clear"></div>');
    var t,t2;
    jQuery('form.cb-admin-form').submit(function() {
        var data = jQuery(this).serialize();
        jQuery('#saved').html('<div id="message" class="updated loader_admin fade"><div class="cir"><img src="'+settings.WP_THEME_URL+'/inc/assets/images/loader.gif" align="absmiddle"><div class="wait_text">'+settings.wait+'</div></div></div>').show();
        var tab = jQuery(this).find('.cb-tab').val();

        jQuery.post(ajaxurl, data, function(response) {

            if(response==1) {
                show_message(1);
                 t=setTimeout(fade_message, 2000);
            } if(response==3) {
                show_message(1);
                t=setTimeout(fade_message, 2000);
                t2=setTimeout(window.location.href='admin.php?page=cb-admin&tab='+tab, 2000);
            } if(response==0) {
                show_message(2);
                 t=setTimeout(fade_message, 2000);
            }
        });
        return false;
    });
    function show_message(n) {
        if(n == 1) {
            jQuery('#saved').html('<div id="message" class="updated loader_admin fade"><div class="cir"><i class="fa fa-thumbs-up"></i><div class="wait_text">'+settings.saved+'</div></div></div>').show();
        } else {
            jQuery('#saved').html('<div id="message" class="updated loader_admin fade"><div class="cir"><i class="fa fa-thumbs-down"></i><div class="wait_text">'+settings.notsaved+'</div></div></div>').show();
        }
    }
    function fade_message() {
        jQuery('#saved').fadeOut(1000);
        clearTimeout(t);
    }

    jQuery('.mn a').click(function() {
        if (jQuery('#'+jQuery(this).attr('id')+'_content').is(':hidden') && !(jQuery(this).attr('href'))){
            jQuery('.mn a').removeClass('sel');
            jQuery(this).addClass('sel');
            jQuery('.tab-inside').fadeOut('500');
            jQuery('#'+jQuery(this).attr('id')+'_content').fadeIn('500');

        }
    });

    jQuery('.message .title').click(function(){
    var message = jQuery(this).parent();
    message.find('.description').slideToggle();
            if(!message.hasClass('read'))
        {

            var data = {
                action: 'read_message',
                id: message.attr('data-id')
            };
            $.post(ajaxurl, data, function(response) {
                message.addClass('read');
                if(response=='0') response ='';
                jQuery('.cb-message-count').html(response);
            });
        }

    });
    jQuery(".sortable").sortable();
    function set_top_icon_size(){
        var size = jQuery('#top-icon-font-size').val();
        jQuery('#sortable i').css("font-size",size+"px");

    }
    jQuery("#top-icon-font-size" ).spinner({
        min: 1,
        numberFormat: "C",
        change: set_top_icon_size,
        stop: set_top_icon_size
    });
    jQuery("#top-icon-color" ).wpColorPicker();
    jQuery(".color" ).wpColorPicker();

    jQuery('#stripes_bg_schema').ddslick({
        onSelected: function(data){
            if(data.selectedIndex > 0)
                jQuery('#stripes_bg_schema_val').val(data.selectedData.value);
        }
    });
    
    $("[data-slider]")
        .each(function () {
            var input = $(this);

            $("<span>")
                .addClass("output")
                .insertAfter($(this));
        })
        .bind("slider:ready slider:changed", function (event, data) {
            $(this)
                .nextAll(".output:first")
                .html(data.value.toFixed(0));
        });
    jQuery('.extend_button').click(function() {
        // jQuery(this).next('.extend').slideToggle();

        jQuery(this).parent().parent().find('.extend').slideToggle('fast');
        jQuery('html, body').animate({
            scrollTop: jQuery(this).parent().parent().find('.extend').offset().top + jQuery('window').height() -50
          }, 400);
        if (jQuery(this).find('i').hasClass('fa-angle-down'))jQuery(this).find('i').removeClass('fa-angle-down').addClass('fa-angle-up');
        else
            jQuery(this).find('i').removeClass('fa-angle-up').addClass('fa-angle-down');
    });
    

    jQuery('.cb_hint').hover(
    function(){
    	jQuery('.hint',this).stop().fadeIn('fast');
    },function(){
    	jQuery('.hint',this).stop().fadeOut('fast');
    });

    jQuery('.demo').click(
        function(){
            jQuery(this).parent().find('.demo').removeClass('demo-active');
            jQuery(this).addClass('demo-active');
            jQuery('#demol').val(jQuery(this).attr('data-demo'));
        });
    jQuery(".tab-inside select").select2();
    jQuery('#cb5_under_start').datetimepicker();
});
function remove_last() {
    jQuery("#sortable_icons li:last").remove();
}
function add_item() {
    var size = jQuery("#sortable_icons li").size();
    html='<li class="ui-state-default"><div class="icons-content">' +
        '<a href="javascript:CBFontAwesome.showEditor(\'cb-sor-top-icon-'+(size+1)+'\');CBFontAwesome.setSize(18,true);CBFontAwesome.hideLast();CBFontAwesome.hideAni();">' +
        '<span id="cb-sor-top-icon-'+(size+1)+'"><span style="color:#999;font-size:10px;font-style:italic;cursor:pointer;">set icon</span></span></a> ' +
        '<input type="text" name="icons_name[]" placeholder="set title" >' +
        '<input type="text" name="icons_link[]" placeholder="set url">' +
        '<textarea style="display: none" name="icons_val[]" id="cb-sor-top-icon-'+(size+1)+'-val" ></textarea>' +
        '<div class="clear"></div></li>';
    jQuery("#sortable_icons").append(html);
}
function remove_last2() {
    jQuery("#sortable_bar li:last").remove();
}
function add_item2() {

    html='<li class="ui-state-default"><input type="text" name="bar_messages[]" value="" placeholder="write here the message..."><div class="clear"></div></li>';
    jQuery("#sortable_bar").append(html);
}




