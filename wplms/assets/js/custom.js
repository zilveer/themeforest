(function($) {
  $.expr[":"].onScreen = function(elem) {
    var $window = $(window);
    var viewport_top = $window.scrollTop();
    var viewport_height = $window.height();
    var viewport_bottom = viewport_top + viewport_height;
    var $elem = $(elem);
    var top = $elem.offset().top;
    var height = $elem.height();
    var bottom = top + height;

    return (top >= viewport_top && top < viewport_bottom) ||
           (bottom > viewport_top && bottom <= viewport_bottom) ||
           (height > viewport_height && top <= viewport_top && bottom >= viewport_bottom);
  };
})(jQuery);



(function($) {

jQuery(document).ready(function($) {
    SidebarMenuEffects();
    LoginTriggerEffects();

    $('.pagesidebar .sidemenu li.menu-item-has-children').each(function(){
        var $this = $(this);
          $this.on('click',function(event){
              if(!$this.hasClass('active')){
                $this.find('> ul.sub-menu').show(200);
                $this.addClass('active');
              }else{
                $this.removeClass('active');
                $this.find('> ul.sub-menu').hide(200);
              }
              event.stopPropagation();
          });
    });

    $('nav .menu-item').has('.sub-menu').each(function() {
        if($(this).find('.megadrop').length > 0 ){ 
            $(this).addClass('hasmegamenu');
            var attr = $(this).find('.megadrop').attr('data-width');
            if (typeof attr !== typeof undefined && attr !== false) {
              $(this).find('.sub-menu').first().css('width',attr);
            }
        }
    });
    $('section#content .vibe_editor').each(function(){
        if(!$(this).children().length){
          $(this).parent().parent().addClass('no-content');
        }
    });

    $(document).on('click','.vbplogin',function(event) {
      event.preventDefault();
      if($('#vibe_bp_login').hasClass('active')){
        $('#vibe_bp_login').hide();
        $('#vibe_bp_login').removeClass('active');
      }else{
        $('#vibe_bp_login').fadeIn(300);
        $('#vibe_bp_login').addClass('active');
      }
      event.stopPropagation();
    });

    $('#searchicon').click(function(event) {
        $(this).addClass('active');
        $('#searchdiv').addClass('active');
    });
    $('#close_full_popup').click(function(event) {
        $('#vibe_bp_login').fadeOut(300);
        $('#vibe_bp_login').removeClass('active');
    });

    $(document).mouseup(function (e) {
        var container = $("#searchdiv");
        if (!container.is(e.target) && container.has(e.target).length === 0){
            container.hide();
            container.removeClass('active');
            $('#searchicon').removeClass('active');
        }
        container = $("#vibe_bp_login");
        if (!container.is(e.target) && container.has(e.target).length === 0 && !$(e.target).hasClass('vbplogin') && !$(e.target).closest('.vbplogin').length){
            container.hide();
            $("#vibe_bp_login").removeClass('active');
        }
    });

   
    $('#headernotification').each(function() {
        var cookieValue = $.cookie("closed");
        if ((cookieValue !== null) && cookieValue == 'headernotification') {      
          $(this).hide();
        }
      });
    $('.commentratingbox').each(function(){
      $(this).rating(); 
    });
    
      $('#widget-tabs a').click(function (e) {
        e.preventDefault();
        if((typeof $().tab == 'function')){
          $(this).tab('show');
        }
      });

    $('#footernotification').each(function() {
      var cookieValue = $.cookie("closed");
      if ((cookieValue !== null) && cookieValue == 'footernotification') {      
        $(this).hide();
      }
      });
    $('.close').click(function(){
      var parent=$(this).parent().parent();
      var id=parent.attr('id');
      parent.hide(200);
       $.cookie('closed', id, { expires: 2 ,path: '/'});
    });

     jQuery('#scrolltop a').click(function(event) {
      event.preventDefault();
      $('body,html').animate({
              scrollTop: 0
            }, 1200);
            return false;
    });
    $('body').delegate('.woocommerce-error','click',function(event){
      event.preventDefault();
      $(this).fadeOut(200);
    })
    if((typeof $().tooltip == 'function')){
      $('.tip').tooltip();   
      $('.nav-tabs li:first a').tab('show');
    }
        
    $('.course_description').on('click','#more_desc',function(event) {
      event.preventDefault();
        $(this).fadeOut('fast');
        $('.full_desc').fadeIn('fast');
    });

    $('.course_description').on('click','#less_desc',function(event) {
      event.preventDefault();
        $('.full_desc').fadeOut('fast'); 
        $('#more_desc').fadeIn('fast');
    });

    $('#signup_password, #account_password').each(function(){
      var label;
      var $this = $(this);
      if($(this).hasClass('form_field')){
        label =  $('label[for="signup_password"]');
      }else{
        label =  $('label[for="account_password"]');
      }
      $(this).keyup(function() {
        
        if(label.find('span').length){ 
          label.find('span').html((checkStrength($this.val(),label)));
        }else{
          label.append('<span>'+(checkStrength($this.val(),label))+'</span>');
        }
      });
      function checkStrength(password,label) {
        var strength = 0
        if (password.length < 6) {
        label.removeClass();
        label.addClass('short');
        return BP_DTheme.too_short
        }
        if (password.length > 7) strength += 1
        // If password contains both lower and uppercase characters, increase strength value.
        if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) strength += 1
        // If it has numbers and characters, increase strength value.
        if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) strength += 1
        // If it has one special character, increase strength value.
        if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
        // If it has two special characters, increase strength value.
        if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
        // Calculated strength value, we can return messages
        // If value is less than 2
        if (strength < 2) {
          label.removeClass();
          label.addClass('weak');
          return BP_DTheme.weak
        } else if (strength == 2) {
          label.removeClass();
          label.addClass('good');
          return BP_DTheme.good
        } else {
          label.removeClass()
          label.addClass('strong')
          return BP_DTheme.strong
        }
      }
    });
}); // END ready


jQuery(document).ready(function($){  

  $('.chosen,select[multiple]').each(function(){
    if(!$(this).hasClass('select2-hidden-accessible')){
      $(this).select2({allowClear:true});
    }
  });

  if($('header.sleek').hasClass('transparent')){
      var headerheight=$('header.transparent').height()+30;
      var header = $('header.transparent');

      var next;
      if($('body').hasClass('page-template-contact-php')){
          next = $('#map-canvas');
      }else if($('body').hasClass('bp-user') && ( $('body').hasClass('p2') || $('body').hasClass('p3') || $('body').hasClass('p4') || $('body').hasClass('modern-theme'))){
        next = $('#item-header');
      }else if($('body').hasClass('groups') && $('body').hasClass('single-item') && ( $('body').hasClass('g2') || $('body').hasClass('g3')) || ($('body').hasClass('single-item') && $('body').hasClass('modern-theme') && !$('body').hasClass('g4'))){
          next = $('#item-header');
      }else if(($('body').hasClass('single-course') && ( $('body').hasClass('c2') || $('body').hasClass('c3') || $('body').hasClass('c5') )) || ($('body').hasClass('single-course') && $('body').hasClass('modern-theme') && !$('body').hasClass('c4'))){
        next = $('#item-header');
      }else if($('body').hasClass('activity-permalink')){
        header.after('<div id="title"></div>');
        next = $('#title');
      }else{
          next = header.next();
          if(!next.is(":visible")){
            next = header.next().next();
          }  
      }
      next.css('padding-top',headerheight+'px');
      next.addClass('light');

  }

  if($('header').hasClass('mooc')){
      $('#mooc_searchform').click(function(event){
          var t = event.target;
          if( !$(t).is('input')){
              $(this).find('.search_form').toggleClass('active');
          }
      });
   }

  var windowheight = $(window).height();
  $('body #content').each(function(){
    var content = $(this);
    var checktop = 0;
    if($('#footerbottom').length){
      checktop = $('#footerbottom').offset().top;  
      checktop = checktop + $('#footerbottom').height();
    }
    if(checktop < windowheight)  {
      if ($(document).find('.main').length != 0) {
        $('.main').last().css('padding-bottom',(windowheight-checktop)+'px');  
      }else{
        content.css('padding-bottom',(windowheight-checktop)+'px');  
      }
      
    }
  });
  $(window).scroll(function(event){
    var st = $(this).scrollTop();
    
    if($('#headertop').hasClass('fix')){
      var headerheight=$('header').height();
      if(st > headerheight){
        $('#headertop').addClass('fixed');
      }else{
        $('#headertop').removeClass('fixed');
      }
    }


    if($('header.sleek').hasClass('fix')){

      var header = $('header.sleek.fix');
      var headerheight=parseInt($('header.fix').height());
      var next = '';
      //if(header.hasClass('transparent'))
        headerheight = headerheight + 30;
      
      if($('body').hasClass('page-template-contact-php')){
        next = $('#map-canvas');
      }else if($('body').hasClass('bp-user') && ( $('body').hasClass('p2') || $('body').hasClass('p3') || $('body').hasClass('p4'))){
        next = $('#item-header');
      }else if($('body').is('.groups, .single-item') && ( $('body').hasClass('g2') || $('body').hasClass('g3'))){
        next = $('#item-header');
      }else if(($('body').hasClass('single-course') && ( $('body').hasClass('c2') || $('body').hasClass('c3') || $('body').hasClass('c5')) ) || ($('body').hasClass('single-course') && $('body').hasClass('modern-theme') && !$('body').hasClass('c4'))){
        next = $('#item-header');
      }else{
        next = header.next();
        if(!next.is(":visible")){
          next = header.next().next();
        }  
      }

      if(st > headerheight){
        $('header.fix').addClass('fixed');
        if(header.hasClass('fixed')){
          next.css('padding-top',headerheight+'px');
        }
      }else{
        $('header.fix').removeClass('fixed');
        if(!header.hasClass('transparent')){  // case for sleek
          next.css('padding-top','');
        }
      }


    } // End sleek has class fix

    if($('header.standard,header.mooc').hasClass('fix')){
      var header = $(this);
      var headerheight=$('header.fix').height();
      if(st > headerheight){
        $('header.fix').addClass('fixed');
      }else{
        $('header.fix').removeClass('fixed');
      }
    }

    if(st > windowheight){
      $('#scrolltop').addClass('fix');
    }else{
      $('#scrolltop').removeClass('fix');
    }
  }); // End scroll event 

    $('.twitter_carousel').each(function(){
      var $this = $(this);
       $this.flexslider({
        animation: "slide",
        controlNav: false,
        directionNav: false,
        animationLoop: true,
        slideshow: true,
        prevText: "<i class='icon-arrow-1-left'></i>",
        nextText: "<i class='icon-arrow-1-right'></i>",
        start: function() {
                   $this.removeClass('loading');
               }
        });    
  });

  if(!$('body').hasClass('modern-theme')){ 
    $('.bp-user.p2 #object-nav,.bp-user.p3 #object-nav,.bp-user.p4 #object-nav,.single-items.groups #object-nav,.single-course.c2 #object-nav,.single-course.c3 #object-nav,.single-course.c4 #object-nav,.single-course.c5 #object-nav').each(function(){
      $(this).find('ul').flexMenu({
        'linkText' : wplms.more, 
        'linkTitle' : wplms.view_more,
        'linkTextAll' : wplms.menu,
        'linkTitleAll' : wplms.open_menu, 
      });
    });
  }

  $('.certifications').flexslider({
    animation: "slide",
    controlNav: false,
    directionNav: true,
    animationLoop: true,
    slideshow: false,
    itemWidth: 212,
    itemMargin:10,
    maxItems:4,
    minItems:1,
    prevText: "<i class='icon-arrow-1-left'></i>",
    nextText: "<i class='icon-arrow-1-right'></i>",
  });

  $('.vbpcart').on('click',function(event){
      event.preventDefault();
      $(this).toggleClass('active');
      $('.woocart').toggleClass('active');
  }); 

});// END ready

//* To be Removed in next update

jQuery(document).ready(function($){  

  $('.v_parallax_block').each(function(){
      var $bgobj = $(this);
      var i = parseInt($bgobj.attr('data-scroll'));
      var rev = parseInt($bgobj.attr('data-rev'));
      var ptop = $bgobj.parent().position().top;
      var adjust = parseInt($bgobj.attr('data-adjust'));
      var height = $bgobj.height();

      var v_parallax_block_height = $bgobj.find('.parallax_content').height();
      if(height<v_parallax_block_height)
        height = v_parallax_block_height;


      if(rev == 2){
        
      }else{
        var $parent = $bgobj.parent().parent();
        if($parent.hasClass('stripe')){
            $parent.css('height',height+'px');
        }
      }
      
      $(window).scroll(function(e) {
          e.preventDefault();
          var $window = jQuery(window);
          var yPos = Math.round((($window.scrollTop())/i));
          var coords;
           if(rev != undefined){
               if(rev == 2){
                yPos = Math.round((($window.scrollTop()-ptop)/i));
                $bgobj.parent().css('-webkit-transform', 'translateY('+yPos+'px)');
                $bgobj.parent().css('transform', 'translateY('+yPos+'px)');
               }else if(rev == 1){
                  yPos = yPos  - adjust;
                  coords = '50% '+yPos+ 'px';
                  $bgobj.css('background-position', coords);
                }else{
                  yPos =  adjust - yPos;
                  coords = '50% '+yPos + 'px';//console.log(coords);
                  $bgobj.css('background-position', coords);
                }
            }
      }); 
    });   
});   
//* To be Removed in next update

//vibe_carousel flexslider direction horizontal  columns1
jQuery(document).ready(function($){    
 

//* To be Removed in next update
$('section.stripe').each(function(){
        var style = $(this).find('.v_column.stripe_container .v_module').attr('data-class');
        if(style){style='stripe '+style;
            $(this).find('.v_column.stripe .v_module').removeAttr('data-class');
            $(this).attr('class',style);
        }
        var style = $(this).find('.v_column.stripe .v_module').attr('data-class');
        if(style){style='stripe '+style;
            $(this).find('.v_column.stripe .v_module').removeAttr('data-class');
            $(this).attr('class',style);
        }
    });
//* To be Removed in next update

//WooCommerce payment expand fix
 $('.payment_methods.methods >li').click(function(){
    var $this = $(this);
    $('.payment_methods.methods >li').find('div').hide(0,function(){$this.find('div').show(0);});
 });


  $('#prev_results a').on('click',function(event){
      event.preventDefault();
      $(this).toggleClass('show');
      $('.prev_quiz_results').toggleClass('show');
  });
});


jQuery(document).ready(function($){    
           
    $('#filtercontainer').each(function(){

      var $container = $('#filtercontainer'),
          filters = {};
     
      $container.isotope({
        itemSelector : '.filteritem',
      });
    

      // filter buttons
      $('.filters a').click(function(){
        var $this = $(this);
        // don't proceed if already selected
        if ( $this.hasClass('active') ) {
          return;
        }
        
        var $optionSet = $this.parents('.option-set');
        // change selected class
        $optionSet.find('.active').removeClass('active');
        $this.addClass('active');
        
        // store filter value in object
        // i.e. filters.color = 'red'
        var group = $optionSet.attr('data-filter-group');
        filters[ group ] = $this.attr('data-filter-value');
        // convert object into array
        var isoFilters = [];
        for ( var prop in filters ) {
          isoFilters.push( filters[ prop ] );
        }
        var selector = isoFilters.join('');
        $container.isotope({ filter: selector });

        return false;
      });   
    }); 
});// END ready


jQuery(document).ready(function($){
  //inscroll menu
  $('.inmenu').each(function(){
      var inmenu_top = $('.inmenu').offset().top - 40;
      var footer_top = $('footer').offset().top - Math.round($(window).height()/2) - 90;
      $(window).scroll(function(){
          var top=$(window).scrollTop();
          if(top > inmenu_top && top < footer_top){
            $('.inmenu').addClass('affix');
          }else{
            $('.inmenu').removeClass('affix');
          }
      });
  });
});// END ready


jQuery(document).ready(function($) { 

  $('.scrollmenu').each(function(){
 // Cache selectors
 var lastId;
 var topMenu = $(".scrollmenu"); 
 var topMenuHeight = 0;//topMenu.outerHeight()+15
     // All list items
 var menuItems = topMenu.find("a"),
     // Anchors corresponding to menu items
     scrollItems = menuItems.map(function(){
       var item = $($(this).attr("href"));
       
       if (item.length) { return item; }
     });
  

   // Bind click handler to menu items
   // so we can get a fancy scroll animation
  menuItems.click(function(e){
    e.preventDefault();
     var href = $(this).attr("href"),
         offsetTop = href === "#" ? 0 : $(href).offset().top-topMenuHeight+1;

     $('html, body').stop().animate({ 
         scrollTop: offsetTop
     }, 800);
    //return false;
   });


        $(window).scroll( function ()
        {
            var fromTop = $(this).scrollTop()+25;
            var cur = scrollItems.map(function(){
              if ($(this).offset().top < fromTop)
                return this;
            });
            cur = cur[cur.length-1];
            var id = cur && cur.length ? cur[0].id : "";
            if (lastId !== id) {
                lastId = id;
                menuItems
                  .parent().removeClass("active");
                  menuItems.filter("[href=#"+id+"]").parent().addClass("active");              
                   }
                   
                 // Animation function  
                   $('.animate').filter(":onScreen").not('.load').each(function(i){ 
                      var $this=$(this);
                           var ind = i * 100;
                           var docViewTop = $(window).scrollTop();
                           var docViewBottom = docViewTop + $(window).height();
                           var elemTop = $this.offset().top;      
                               if (docViewBottom >= elemTop) { 
                                   setTimeout(function(){ 
                                        $this.addClass('load');
                                    }, ind);
                                   }      
                       });
                      //End function 
                   
        });
  });      
});// END ready



  
//CHECKOUT FORM
jQuery(document).ready(function ($) {
       
    $('.minmax').click(function(event){
        event.preventDefault();
        $(this).parent().toggleClass('show');
        $(this).find('i').toggleClass('icon-minus');
    });
});// END ready


// ADD Question Form
jQuery(document).ready(function($){ 
  $( ".repeatablelist" ).each(function(){
    $(this).sortable({ handle: '.sort_handle' }); 
  });
  $('.add_repeatable').click(function(){
    var repeatablelist=$(this).parent().find('.repeatablelist');
    var lastitem=$(this).parent().find('.repeatablelist li:last-child');
    var cloneditem=lastitem.clone();
    var name= cloneditem.find('.option_text').attr('rel-name');

    cloneditem.find('.option_text').attr('name',name);
    repeatablelist.append(cloneditem);
  });
  $('.print_results').click(function(event){
      event.preventDefault();
      $('.quiz_result').print();
  });


});// END ready

jQuery(document).ready(function($){
   $('#login_modern_trigger').click(function(){
    $('#login-modal-overlay').addClass('show');
    $('#login-modal').addClass('show');
  });
  $('#close-modal').click(function(){
    $('#vibe_bp_login').removeClass('active');
    $('#vibe_bp_login').hide();
  });
});



})(jQuery);
