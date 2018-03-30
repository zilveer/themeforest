(function($){
// start template

$(document).ready(function($) {

// jQuery iCheck
$('input').iCheck();

// HC-Sticky Sidebars
$('.user-panel').hcSticky({
      noContainer: true,
      responsive: true,
      wrapperClassName: "wrapper-sticky-user-panel"
  });
// $('.sidebars').hcSticky();
// $('.sidebar').hcSticky();

// jQuery CSS Customizable Scrollbar
$('.scrollbar-inner').scrollbar({"scrollx": "false"});

// Header Mobile Button
$('.header-panel-toggle').click(function(){
    $('.header-panel-scroll').toggleClass('open');
});

// BuddyPress Cover Description
$('.groupdescr').click(function(){
    $('#popover-groupdescr').toggleClass('show');
});

//Scroll Up Button
$(window).scroll(function(){
    if ($(this).scrollTop() > 900) {
        $('.scrollup').fadeIn();
    } else {
        $('.scrollup').fadeOut();
    }
});

$('.scrollup').click(function(){
    $("html, body").animate({ scrollTop: 0 }, 900);
    return false;
});

// Widget Categories Num Class
$('.widget_categories li').each(function() {
    var $contents = $(this).contents();
    if ($contents.length > 1) {
        $contents.eq(1).wrap('<span class="cat_num"></span>');

        $contents.eq(1).each(function() {});
    }
}).contents();
$('.widget_categories li .cat_num').each(function() {
    $(this).html($(this).text().substring(2));
    $(this).html($(this).text().replace(/\)/gi, ""));
});
if ($('li.cat-item').length) {
    $('li.cat-item .cat_num .line').each(function() {
        if ($(this).is(':empty')) {
            $(this).parent().hide();
        }
    });
};

// Widget Archive Num Class
$('.widget_archive li').each(function() {
    var $contents = $(this).contents();
    if ($contents.length > 1) {
        $contents.eq(1).wrap('<span class="cat_num"></span>');
        $contents.eq(1).each(function() {});
    }
}).contents();
$('.widget_archive li .cat_num').each(function() {
    $(this).html($(this).text().substring(2));
    $(this).html($(this).text().replace(/\)/gi, ""));
});
if ($('li.cat-item').length) {
    $('li.cat-item .cat_num .line').each(function() {
        if ($(this).is(':empty')) {
            $(this).parent().hide();
        }
    });
}

// Modal Center
function centerModals($element) {
  var $modals;
  if ($element.length) {
    $modals = $element;
  } else {
    $modals = $('.modal-vcenter:visible');
  }
  $modals.each( function(i) {
    var $clone = $(this).clone().css('display', 'block').appendTo('body');
    var top = Math.round(($clone.height() - $clone.find('.modal-content').height()) / 2);
    top = top > 0 ? top : 0;
    $clone.remove();
    $(this).find('.modal-content').css("margin-top", top);
  });
}
$('.modal-vcenter').on('show.bs.modal', function(e) {
  centerModals($(this));
});
$(window).on('resize', centerModals);

// Bootstrap Tooltips
$('[data-toggle="tooltip"]').tooltip();

// Nanobar
var nanobar = new Nanobar({ bg: '#cd0000', id: 'nanobar' });
nanobar.go(0);
nanobar.go(100);

// Header Panel Menu Padding Bottom
function setFooterHeight() {
  $('#menu-categories-menu').css({
    paddingBottom: $('#footer').height() + 210 + 'px'
  });
};
setFooterHeight();

// Show On Scroll Animation
var ShowOnScrollInit = {
  init: function(){
    var $window           = $(window),
        win_height_padded = $window.height() * 1.1,
        isTouch           = Modernizr.touch;
    if (isTouch) { $('.ShowOnScroll').addClass('animated'); }
    $window.on('scroll', ShowOnScroll);
    function ShowOnScroll() {
      var scrolled = $window.scrollTop(),
          win_height_padded = $window.height() * 1.1;
      $(".ShowOnScroll:not(.animated)").each(function () {
        var $this     = $(this),
            offsetTop = $this.offset().top;
        if (scrolled + win_height_padded > offsetTop) {
            $this.addClass('animated');
        }
      });
    }
    ShowOnScroll();
  } // end init
};
ShowOnScrollInit.init();

$('.comment').each(function() { $(this).addClass('ShowOnScroll'); });
$('.bbp-body .bp_members.type-bp_members.hentry').addClass('ShowOnScroll');
$('.post-navigation .nav-previous').addClass('ShowOnScroll');
$('.post-navigation .nav-next').addClass('ShowOnScroll');
$('.activity-list .activity-item').addClass('ShowOnScroll');
$('.rtmedia-popup').addClass('ShowOnScroll');

// Masonry Members $ Groups
var msnryInit = {
    init: function(){
        imagesLoaded( document.querySelector('.wrapper'), function() {
          $('.masonry').masonry({
            itemSelector: '.elem',
                singleMode: true,
            isResizable: true,
            isAnimated: true,
                animationOptions: {
                queue: true, 
                duration: 500 
            }
          });
          // BuddyPress rtMedia Masonry
          $('.masonry').masonry({
            itemSelector: '.masonry-brick',
                singleMode: true,
            isResizable: true,
            isAnimated: true,
                animationOptions: {
                queue: true, 
                duration: 500 
            }
          });
          ShowOnScrollInit.init();
          // Jetpack Infinite Scroll
          $(document.body).on('post-load', function() {
              setInterval( function() {
                // Masonry Reload
                jQuery('.masonry').masonry( 'reloadItems' );
                jQuery('.masonry').masonry( 'layout' );
                // Video & Audio Posts
                $(".format-video iframe").each(function(){
                  $(this).first().addClass("iframe");
                });
                $(".format-audio iframe").each(function(){
                  $(this).first().addClass("iframe");
                });
              }, 300 );
          });
        });
  }
};
msnryInit.init();
$("body").on('masonry-trigger', function() {
  msnryInit.init();
});
$('.page-numbers').click(function() {
  msnryInit.init();
});
$('#pag-bottom .page-numbers').click(function() {
  $("html, body").animate({ scrollTop: 0 }, 900);
});

// Animation after load - Jetpack Infinite Scroll items
$(document.body).on('post-load', function() {
    setTimeout( function () {
      ShowOnScrollInit.init();
  }, 1000 );
});

// jQuery flexMenu
$('#item-nav .nav.nav-pills').flexMenu();

// Video & Audio Posts
$(".format-video iframe").each(function(){
  $(this).first().addClass("iframe");
});

$(".format-audio iframe").each(function(){
  $(this).first().addClass("iframe");
});

// Modal Login Placeholder
jQuery('#loginform #user_pass').attr( 'placeholder', localizeJsText.password );
jQuery('#loginform #user_login').attr( 'placeholder', localizeJsText.username );

//  iCheck for WP-Polls plugin. Poll Process Successfully
poll_process_success = function poll_process_success(data) {
  jQuery(document).ready(function($) {
    $('#polls-' + poll_id).replaceWith(data);
    jQuery('input').iCheck();
    if(pollsL10n.show_loading) {
      $('#polls-' + poll_id + '-loading').hide();
    }
    if(pollsL10n.show_fading) {
      $('#polls-' + poll_id).fadeTo('def', 1);
      set_is_being_voted(false);
    } else {
      set_is_being_voted(false);
    }
  });
}

/* Override: BuddyPress Filter the current content list (groups/members/blogs/topics) */
bp_filter_request = function bp_filter_request( object, filter, scope, target, search_terms, page, extras, caller, template ) {
  if ( 'activity' === object ) {
    return false;
  }

  if ( null === scope ) {
    scope = 'all';
  }

  /* Save the settings we want to remain persistent to a cookie */
  jq.cookie( 'bp-' + object + '-scope', scope, {
    path: '/'
  } );
  jq.cookie( 'bp-' + object + '-filter', filter, {
    path: '/'
  } );
  jq.cookie( 'bp-' + object + '-extras', extras, {
    path: '/'
  } );

  /* Set the correct selected nav and filter */
  jq('.item-list-tabs li').each( function() {
    jq(this).removeClass('selected');
  });
  jq('#' + object + '-' + scope + ', #object-nav li.current').addClass('selected');
  jq('.item-list-tabs li.selected').addClass('loading');
  jq('.item-list-tabs select option[value="' + filter + '"]').prop( 'selected', true );

  if ( 'friends' === object || 'group_members' === object ) {
    object = 'members';
  }

  if ( bp_ajax_request ) {
    bp_ajax_request.abort();
  }

  bp_ajax_request = jq.post( ajaxurl, {
    action: object + '_filter',
    'cookie': bp_get_cookies(),
    'object': object,
    'filter': filter,
    'search_terms': search_terms,
    'scope': scope,
    'page': page,
    'extras': extras,
    'template': template
  },
  function(response)
  {
    /* animate to top if called from bottom pagination */
    if ( caller === 'pag-bottom' && jq('#subnav').length ) {
      var top = jq('#subnav').parent();
      jq('html,body').animate({scrollTop: top.offset().top}, 'slow', function() {
        jq(target).fadeOut( 100, function() {
          jq(this).html(response);
          jq(this).fadeIn(100, function(){
            jq("body").trigger('masonry-trigger');
          });
        });
      });

    } else {
      jq(target).fadeOut( 100, function() {
        jq(this).html(response);
        jq(this).fadeIn(100, function(){
            jq("body").trigger('masonry-trigger');
          });
      });
    }

    jq('.item-list-tabs li.selected').removeClass('loading');
  });
}
// end bp_filter_request

// Delete Group - Fix: iCheck + BuddyPress
$('#group-settings-form .iCheck-helper').click(function(){
  if ( document.getElementById('delete-group-button').disabled==true ) {
    document.getElementById('delete-group-button').disabled=false;
  } else {
    document.getElementById('delete-group-button').disabled=true;
  }
});


});

// end template
})(jQuery);