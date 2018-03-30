/**
 * moutheme: default javascript
 * @license MIT
 */
 
/*******************
 * Hide Search Click Outside
********************/
 
 jQuery(document).mouseup(function (e)
{
    var container = jQuery(".search-result");

    if (!container.is(e.target) // if the target of the click isn't the container...
        && container.has(e.target).length === 0) // ... nor a descendant of the container
    {
        container.hide();
    }
});


 jQuery(document).ready(function() { 'use strict';

     jQuery('ul.navigation-list').children('li').addClass('dropdown');

     jQuery('ul.navigation-list').children('li').children('a').each(function(){
         var $parent_li = jQuery(this).parent('li');

         var href = jQuery(this).attr('href');
         var name = jQuery(this).text();
         var a_class = jQuery(this).attr('class');

         //hide menu link
         jQuery(this).remove();
         var active_li_menu = ($parent_li.hasClass('current-menu-item')) ? 'active' : '';

         //if parent li has children menus
        if($parent_li.hasClass('menu-item-has-children'))
        {
            $parent_li.prepend(
                '<div class="link-click">' +
                    '<a href="'+href+'" class=" nav-link '+active_li_menu+'"><i class="'+a_class+'"></i>'+name+'<div class="w-icon-dropdown-toggle drop-arrow '+active_li_menu+'"></div></a> '+
                '</div>');

            //if megamenu li
            if($parent_li.hasClass('menu-item-has-mega-menu'))
            {
                var mega_menu = $parent_li.children('.mega-menu');
                //add megamenu class
                mega_menu.attr('class','').addClass('w-dropdown-list drop-down-list mega-menu');
                mega_menu.children('ul').addClass('w-row');

                //add li classes to megamenu columns
                var total_mega_li = mega_menu.children('.mega-menu-row').children('li').length;
                mega_menu.find('.mega-menu-row').children('li').each(function(index){
                    var a_mega = jQuery(this).children('a');
                    var a_mega_name = a_mega.text();
                    var a_mega_icon = a_mega.attr('class');
                    //remove a after getting all data
                    a_mega.remove();

                    //add column title
                    jQuery(this).prepend('' +
                        '<div class="element-tittle">' +
                            '<h6><i class="'+a_mega_icon+'"></i>'+a_mega_name+'</h6> ' +
                        '</div>');

                    //add submenu li classes
                    jQuery(this).children('.sub-menu').addClass('w-list-unstyled space margin-bottom');
                    jQuery(this).children('.sub-menu').children('li').each(function(){
                        var a_mega_submenu = jQuery(this).children('a');
                        //get icon if exist
                        var a_mega_submenu_icon = a_mega_submenu.attr('class');
                        var a_mega_submenu_text = a_mega_submenu.text();

                        //current class for submenu links
                        var a_mega_submenu_current = (jQuery(this).hasClass('current-menu-item')) ? 'w--current' : '';

                        //add megamenu submenu a specific classes
                        a_mega_submenu.attr('class','').text('').addClass('w-clearfix w-inline-block mega-item-list ' + a_mega_submenu_current ).prepend('' +
                        '<div class="li-ico-mega">' +
                        '<i class="'+a_mega_submenu_icon+'"></i>' +
                        ' </div> ' +
                        '<div>'+a_mega_submenu_text+'</div>');
                    });

                    if (index === total_mega_li - 1) {
                        // this is the last one
                        jQuery(this).addClass('w-col w-col-stack');
                    }
                    else
                        jQuery(this).addClass('w-col w-col-stack mega-tittle');
                });

                //set megamenu dropdown width
                if(total_mega_li > 0)
                {
                    var mega_menu_width = 0
                    mega_menu.find('.mega-menu-row').children('li').each(function(){
                        mega_menu_width += jQuery(this).outerWidth();
                    });
                    mega_menu.css('width',mega_menu_width+22);
                }

            }
            else
            {
                //submenu changes
                var $sub_menu = $parent_li.find('.sub-menu');
                $sub_menu.addClass('drop-down-list');

                var is_active_submenu = false;
                $sub_menu.children('li').each(function(){
                    if(jQuery(this).hasClass('current-menu-item')) {
                        jQuery(this).children('a').addClass('w-dropdown-link dropdown-link w--current');
                        is_active_submenu = true;
                    }
                    else
                        jQuery(this).children('a').addClass('w-dropdown-link dropdown-link');
                });

                // add active class to parent li if has submenu active
                if(active_li_menu.length === 0 && is_active_submenu)
                {
                    $parent_li.children('.link-click').children().addClass('active');
                }
            }

        }
         else
        {
            $parent_li.prepend(
                '<div class="link-click">' +
                    '<a href="'+href+'" class="'+a_class+' nav-link '+active_li_menu+'"><i class="'+a_class+'"></i>'+name+'</a> ' +
                '</div>');
        }

         jQuery('.navigation-list').show();

     });


     jQuery('.w-nav-button').on('click', function(){
         if (jQuery('.navigation-list').hasClass('slid-menu')){
             jQuery('.navigation-list').removeClass('slid-menu');
         }else{
             jQuery('.navigation-list').addClass('slid-menu');
         }
         return false;
     });


     var screenRes = jQuery(window).width();
     if(screenRes < 1024)
     {
         jQuery('.navigation-list .w-icon-dropdown-toggle').on('click',function(){
             var $dropdown = jQuery(this).parents('.link-click').siblings('.drop-down-list');
             if ($dropdown.hasClass('slide')){
                 $dropdown.removeClass('slide');
                 jQuery(this).removeClass('act');
             }else{
                 jQuery('.drop-down-list').removeClass('slide');
                 jQuery('.drop-arrow').removeClass('act');
                 jQuery(this).addClass('act');
                 jQuery(this).parents('.link-click').siblings('.drop-down-list').addClass('slide');
             }

             return false;
         });
     }
     else{
         jQuery('.drop-down-list').removeClass('slide');
         jQuery('.drop-arrow').removeClass('act');
     }
  });
  
/*******************
 * Video Background Resize
********************/

    jQuery(function () { 'use strict';
  
  var outerDiv = jQuery('.video-wrapper');
  var videoTag = outerDiv.find('video');
  
  jQuery(window).resize(resize);
  resize();
  
  function resize() {
    var width = outerDiv.width();
    var height = outerDiv.height();
    var aspectW = 16;
    var aspectH = 9;
    var scaleX = width / aspectW;
    var scaleY = height / aspectH;
    var scale = Math.max(scaleX, scaleY);
    var w = Math.ceil(aspectW * scale);
    var h = Math.ceil(aspectH * scale);
    var x = 0;
    var y = 0;
    if (w > width) x = -(w - width) * 0.5;
    if (h > height) y = -(h - height) * 0.5;
     
    videoTag.css({
      width: w,
      height: h,
      top: y,
      left: x
    });
  }
  
});

/*******************
 * mixItUp Start
********************/

jQuery(function(){ 'use strict';
	jQuery('#Grid').mixItUp({
	animation: {
		duration: 500
	}
});
});

/*******************
 * Stellar Start
********************/

 jQuery(function(){ 'use strict';
		jQuery(window).stellar({
		        verticalScrolling: true,
				horizontalScrolling: false,
				verticalOffset: 40
			});
        });

/*******************
 * Toggle
 ********************/
jQuery(document).ready(function() {
    //toggle map
    jQuery('a.map-block').on('click',function(){
        if(jQuery(this).attr('data-toggle') === 'open')
        {
            jQuery(this).attr('data-toggle','close');
            jQuery(this).parents('.call-to-action').siblings('.map-shortcode').css('max-height',1000);
            jQuery(this).find('.map-arrow').addClass('map-arrow-open');
        }
        else
        {
            jQuery(this).attr('data-toggle','open');

            jQuery(this).parents('.call-to-action').siblings('.map-shortcode').css('max-height',0);
            jQuery(this).find('.map-arrow').removeClass('map-arrow-open');
        }
    });

    //toggle shortcode
    jQuery('.toggle-wrapper').on('click',function(){
        var _this = jQuery(this);
        if(_this.attr('data-toggle') === 'open')
        {
            _this.attr('data-toggle','close');
            _this.children('.toggle-content').css('max-height',1000);
            _this.find('.toggle-line-2').addClass('toggle-line-2-opened');
        }
        else
        {
            _this.children('.toggle-content').css('max-height',0);
            setTimeout(function(){_this.find('.toggle-line-2').removeClass('toggle-line-2-opened');},500)
            _this.attr('data-toggle','open');
        }
    });


    jQuery("a[href='#top']").click(function() {
        jQuery("html, body").animate({ scrollTop: 0 }, "slow");
        return false;
    });


});

/*******************
 * WOW Start
********************/

new WOW().init();