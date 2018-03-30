var $ = jQuery;
// Topmenu <ul> replace to <select>
function responsive(mainNavigation) {
    var screenRes = jQuery('body').width();

    if (jQuery('#topmenu select').length == 0) {
        /* Replace unordered list with a "select" element to be populated with options, and create a variable to select our new empty option menu */
        jQuery('#topmenu').append('<select class="select_styled" id="topm-select" style="display:none;"></select>');
        var selectMenu = jQuery('#topm-select');

        /* Navigate our nav clone for information needed to populate options */
        jQuery(mainNavigation).children('ul').children('li').each(function() {

            /* Get top-level link and text */
            var href = jQuery(this).children('a').attr('href');
            var text = jQuery(this).children('a').text();

            /* Append this option to our "select" */
            if (jQuery(this).is(".current-menu-item") && href != '#') {
                jQuery(selectMenu).append('<option value="' + href + '" selected>' + text + '</option>');
            } else if (href == '#') {
                jQuery(selectMenu).append('<option value="' + href + '" disabled="disabled">' + text + '</option>');
            } else {
                jQuery(selectMenu).append('<option value="' + href + '">' + text + '</option>');
            }

            /* Check for "children" and navigate for more options if they exist */
            if (jQuery(this).children('ul').length > 0) {
                jQuery(this).children('ul').children('li').not(".mega-nav-widget").each(function() {

                    /* Get child-level link and text */
                    var href2 = jQuery(this).children('a').attr('href');
                    var text2 = jQuery(this).children('a').text();

                    /* Append this option to our "select" */
                    if (jQuery(this).is(".current-menu-item") && href2 != '#') {
                        jQuery(selectMenu).append('<option value="' + href2 + '" selected> - ' + text2 + '</option>');
                    } else if (href2 == '#') {
                        jQuery(selectMenu).append('<option value="' + href2 + '" disabled="disabled"># ' + text2 + '</option>');
                    } else {
                        jQuery(selectMenu).append('<option value="' + href2 + '"> - ' + text2 + '</option>');
                    }

                    /* Check for "children" and navigate for more options if they exist */
                    if (jQuery(this).children('ul').length > 0) {
                        jQuery(this).children('ul').children('li').each(function() {

                            /* Get child-level link and text */
                            var href3 = jQuery(this).children('a').attr('href');
                            var text3 = jQuery(this).children('a').text();

                            /* Append this option to our "select" */
                            if (jQuery(this).is(".current-menu-item")) {
                                jQuery(selectMenu).append('<option value="' + href3 + '" class="select-current" selected>' + text3 + '</option>');
                            } else {
                                jQuery(selectMenu).append('<option value="' + href3 + '"> -- ' + text3 + '</option>');
                            }

                        });
                    }
                });
            }
        });
    }
    if (screenRes >= 750) {
        jQuery('#topmenu select:first').hide();
        jQuery('#topmenu ul:first').show();
    } else {
        jQuery('#topmenu ul:first').hide();
        jQuery('#topmenu select:first').show();
    }

    /* When our select menu is changed, change the window location to match the value of the selected option. */
    jQuery(selectMenu).change(function() {
        location = this.options[this.selectedIndex].value;
    });
}

jQuery(document).ready(function() {
  // add submenu class for li in menu
  jQuery('ul.submenu_list').parent('li').addClass('submenu');
  // remove class for megamenu sublist
  jQuery('.mega-menu ul.submenu_list').parent('li').removeClass('submenu');
  //add span classes for megamenu
  jQuery('.mega-menu-inner .widget_container,.mega-menu-inner .mega-nav-widget').each(function(){
      if(jQuery(this).hasClass('span3')) jQuery(this).parent('li').addClass('span3');
      if(jQuery(this).hasClass('span4')) jQuery(this).parent('li').addClass('span4');
      if(jQuery(this).hasClass('span5')) jQuery(this).parent('li').addClass('span5');
  });

  // add wrap container for megamenu
  jQuery('.mega-menu .mega-menu-inner').wrap('<div class="mega-menu-body clearfix"><div class="container"><div class="row"></div></div></div>');

  // for toggle
  jQuery('.accordion .accordion-group:first-child').find('.accordion-body').addClass('in');

  var screenRes = jQuery(window).width();
  // Remove links outline in IE 7
    jQuery("a").attr("hideFocus", "true").css("outline", "none");

    // for portfolio item add <div class="clear"></div> after 2 and 3 elements
    var c = 0;
    if(screenRes>768){
        jQuery('.portfolio_item_small.span4').each(function(){
            c++;
            if(c%3==0){
                jQuery(this).after('<div class="clear"></div>');
            }
        });
    }
    else if(screenRes<=768 && screenRes>480){
        jQuery('.span8 .portfolio_item_small.span4').each(function(){
            c++;
            if(c%2==0){
                jQuery(this).after('<div class="clear"></div>');
            }
        });
        jQuery('.span12 .portfolio_item_small.span4').each(function(){
            c++;
            if(c%3==0){
                jQuery(this).after('<div class="clear"></div>');
            }
        });
    }
    else if(screenRes<=480){
        jQuery('.portfolio_item_small.span4').each(function(){
            c++;
            if(c%2==0){
                jQuery(this).after('<div class="clear"></div>');
            }
        });
    }
    var k = 0;
    jQuery('.portfolio_item_small.span6').each(function(){
        k++;
        if(k%2==0){
            jQuery(this).after('<div class="clear"></div>');
        }
    });
  
  // odd/even
  jQuery("ul.recent_posts > li:odd, ul.popular_posts > li:odd, .styled_table table>tbody>tr:odd, .boxed_list > .boxed_item:odd, .grid_layout .post-item:odd").addClass("odd");
  jQuery(".widget_recent_comments ul > li:even, .widget_recent_entries li:even, .widget_twitter .tweet_item:even, .widget_archive ul > li:even, .widget_categories ul > li:even, .widget_nav_menu ul > li:even, .widget_links ul > li:even, .widget_meta ul > li:even, .widget_pages ul > li:even, .offer_specification li:even").addClass("even");
  
  // first/last
  jQuery("ul.dropdown li:first-child").addClass("first");
  jQuery("ul.dropdown li:last-child , .info_item p:last-child , .history_list .history_item:last-child , .filter_menu li:last-child").addClass("last");

  // buttons  
  jQuery(".button, .post-share a, .btn-submit,p.form-submit").hover(function(){
    jQuery(this).stop().animate({"opacity": 0.80});
  },function(){
    jQuery(this).stop().animate({"opacity": 1});
  });

    // prettyPhoto lightbox, check if <a> has atrr data-rel and hide for Mobiles
  if(jQuery('a').is('[data-rel]') && screenRes > 600) {
    jQuery('a[data-rel]').each(function() {
      jQuery(this).attr('rel', jQuery(this).data('rel'));
  });
    jQuery("a[rel^='prettyPhoto']").prettyPhoto({social_tools:false});
  }

  // style Select, Radio, Checkbox
  if (jQuery("select").hasClass("select_styled")) {
    var deviceAgent = navigator.userAgent.toLowerCase();
    var agentID = deviceAgent.match(/(iphone|ipod|ipad)/);
    if (agentID) {
      cuSel({changedEl: ".select_styled", visRows: 10, scrollArrows: true});   // Add arrows Up/Down for iPad/iPhone
    } else {
      cuSel({changedEl: ".select_styled", visRows: 10});
    }   
  }
  if (jQuery("div,p").hasClass("input_styled")) {
    jQuery(".input_styled input").customInput();
  }

    // for love_it
    var y = jQuery('.love_it').bind('click', function(){
        if (y.hasClass('tfuse_loved')) return false;
        y.removeClass('love_it');
        var id1 = jQuery(this).prev('.love_it_hidden').attr('id');
        var loves = jQuery(this).prev('.love_it_hidden').val();
        var id = parseInt(id1.replace('hidden_',''));
        datasend = 'action=tfuse_loveit_action&id=' + id;
        jQuery.ajax({
            type: "POST",
            url: tf_script.ajaxurl,
            data: datasend, // data to be send
            dataType: "html",
            success: function(response) {
                var obj = jQuery.parseJSON(response);
                if (obj['succes'] == true)
                {
                    loves = parseInt(loves)+1;
                    y.addClass('tfuse_loved');
                    y.html(loves);
                    jQuery.ajax({
                        type:"POST",
                        url: tf_script.ajaxurl,
                        data: 'action=tfuse_loveit_cookies_action&cookies=true&id='+id,
                        dataType: "html"
                    });
                }
            }
        });
        return false;
    });

    function calc() {
        var dropdown_li_width = 0;
        if (jQuery(".dropdown > li").length >= 5 ){
            jQuery(".dropdown > li").each(function(){
                dropdown_li_width += jQuery(this).width();
            });
            jQuery(".dropdown > li").css("margin-left" , (jQuery(".dropdown").width() - dropdown_li_width) / (jQuery(".dropdown > li").length-1) + "px")

            if (jQuery('body').hasClass('ie') || jQuery('body').hasClass('gecko')) {
                jQuery(".dropdown > li").css("margin-left" , (jQuery(".dropdown").width() - dropdown_li_width - 1) / (jQuery(".dropdown > li").length-1) + "px")
            }
        };
    };

    calc();

    // reload topmenu on Resize
    var mainNavigation = jQuery('#topmenu').clone();
    responsive(mainNavigation);

    jQuery(window).resize(function() {
        var screenRes = jQuery('body').width();
        responsive(mainNavigation);
        if (screenRes>=768) {calc()};
    });

});