/*jshint browser:true, devel:true, unused:false */
/*global google */
;(function($) {

"use strict";


$(".blog-post-content").fitVids();
$(".video-post").fitVids();

var $body = $('body');

// Touch
// ---------------------------------------------------------
var dragging = false;

$body.on('touchmove', function() {
  dragging = true;
});

$body.on('touchstart', function() {
  dragging = false;
});



// Set Background Image
// ---------------------------------------------------------
$('.has-bg-image').each(function () {
  var $this = $(this),

      image = $this.data('bg-image'),
      color = $this.data('bg-color'),
      opacity = $this.data('bg-opacity'),

      $content = $('<div/>', { 'class': 'content' }),
      $background = $('<div/>', { 'class': 'background' });

  if (opacity) {
    $this.children().wrapAll($content);
    $this.append($background);

    $this.css({
      'background-image': 'url(' + image + ')'
    });

    $background.css({
      'background-color': '#' + color,
      'opacity': opacity
    });
  } else {
    $this.css({
      'background-image': 'url(' + image + ')',
      'background-color': '#' + color
    });
  }
});



// Superfish Menus
// ---------------------------------------------------------
if ($.fn.superfish) {
  $('.sf-menu').superfish();
} else {
  console.warn('not loaded -> superfish.min.js and hoverIntent.js');
}

//hover effect


// Mobile Sidebar
// ---------------------------------------------------------
$('.mobileMenu'+'.mobile-sidebar-toggle').on('click', function () {
  $body.toggleClass('mobile-sidebar-active');
  return false;
});
// $(".uou-block-11a").each( function() {
//     alert("mobile menu toggle bar");
// });

$('.mobile-sidebar-open').on('click', function () {
  $body.addClass('mobile-sidebar-active');
  return false;
});

$('.mobile-sidebar-close').on('click', function () {
  $body.removeClass('mobile-sidebar-active');
  return false;
});



// UOU Tabs
// ---------------------------------------------------------
if ($.fn.uouTabs) {
  $('.uou-tabs').uouTabs();
} else {
  console.warn('not loaded -> uou-tabs.js');
}



// UOU Accordions
// ---------------------------------------------------------
if ($.fn.uouAccordions) {
  $('.uou-accordions').uouAccordions();
} else {
  console.warn('not loaded -> uou-accordions.js');
}



// UOU Alers
// ---------------------------------------------------------
$('.alert').each(function () {
  var $this = $(this);

  if ($this.hasClass('alert-dismissible')) {
    $this.children('.close').on('click', function (event) {
      event.preventDefault();

      $this.remove();
    });
  }
});



// Default Slider
// ---------------------------------------------------------
if ($.fn.flexslider) {
  $('.default-slider').flexslider({
    slideshowSpeed: 10000,
    animationSpeed: 1000,
    prevText: '',
    nextText: ''
  });
} else {
  console.warn('not loaded -> jquery.flexslider-min.js');
}



// Range Slider (forms)
// ---------------------------------------------------------
if ($.fn.rangeslider) {
  $('input[type="range"]').rangeslider({
    polyfill: false,
    onInit: function () {
      this.$range.wrap('<div class="uou-rangeslider"></div>').parent().append('<div class="tooltip">' + this.$element.data('unit-before') + '<span></span>' + this.$element.data('unit-after') + '</div>');
    },
    onSlide: function(value, position) {
      var $span = this.$range.parent().find('.tooltip span');
      $span.html(position);
    }
  });
} else {
  console.warn('not loaded -> rangeslider.min.js');
}



// Placeholder functionality for selects (forms)
// ---------------------------------------------------------
function selectPlaceholder(el) {
  var $el = $(el);

  if ($el.val() === 'placeholder') {
    $el.addClass('placeholder');
  } else {
    $el.removeClass('placeholder');
  }
}

$('select').each(function () {
  selectPlaceholder(this);
}).change(function () {
  selectPlaceholder(this);
});





// ---------------------------------------------------------
// BLOCKS
// BLOCKS
// BLOCKS
// BLOCKS
// BLOCKS
// ---------------------------------------------------------





// .uou-block-1a
// ---------------------------------------------------------
// $('.uou-block-1a').each(function () {
  var $block = $(this);

  // search
  $block.find('.uou-block-1a' + '.search').each(function () {
    var $this = $(this);

    $this.find('.toggle').on('click', function (event) {
      event.preventDefault();
      $this.addClass('active');
      setTimeout(function () {
        $this.find('.search-input').focus();
      }, 100);
    });

    $this.find('input[type="text"]').on('blur', function () {
      $this.removeClass('active');
    });
  });

  // language
  $block.find('.uou-block-1a' + '.language').each(function () {
    var $this = $(this);

    $this.find('.toggle').on('click', function (event) {
      event.preventDefault();

      if (!$this.hasClass('active')) {
        $this.addClass('active');
      } else {
        $this.removeClass('active');
      }
    });
  });
// });



// .uou-block-1b
// ---------------------------------------------------------
// $('.uou-block-1b').each(function () {
  var $block = $(this);

  // language
  $block.find('.language').each(function () {
    var $this = $(this);

    $this.find('.toggle').on('click', function (event) {
      event.preventDefault();

      if (!$this.hasClass('active')) {
        $this.addClass('active');
      } else {
        $this.removeClass('active');
      }
    });
  });
// });



// .uou-block-1e
// ---------------------------------------------------------
// $('.uou-block-1e').each(function () {
  var $block = $(this);

  // language
  $block.find('.uou-block-1e'+'.language').each(function () {
    var $this = $(this);

    $this.find('.toggle').on('click', function (event) {
      event.preventDefault();

      if (!$this.hasClass('active')) {
        $this.addClass('active');
      } else {
        $this.removeClass('active');
      }
    });
  });
// });



// .uou-block-5b
// ---------------------------------------------------------
$('.uou-block-5b').each(function () {
  var $block = $(this),
      $tabs = $block.find('.tabs > li');

  $tabs.on('click', function () {
    var $this = $(this),
        target = $this.data('target');

    if (!$this.hasClass('active')) {
      $block.find('.' + target).addClass('active').siblings('blockquote').removeClass('active');

      $tabs.removeClass('active');
      $this.addClass('active');

      return false;
    }
  });
});



// .uou-block-5c
// ---------------------------------------------------------
$('.uou-block-5c').each(function () {
  var $block = $(this);

  if ($.fn.flexslider) {
    $block.find('.flexslider').flexslider({
      slideshowSpeed: 10000,
      animationSpeed: 1000,
      prevText: '',
      nextText: '',
      controlNav: false,
      smoothHeight: true
    });
  } else {
    console.warn('not loaded -> jquery.flexslider-min.js');
  }
});



// .uou-block-7g
// ---------------------------------------------------------
$('.uou-block-7g').each(function () {
  var $block = $(this),
      $badge = $block.find('.badge'),
      badgeColor = $block.data('badge-color');

  if (badgeColor) {
    $badge.css('background-color', '#' + badgeColor);
  }
});



// .uou-block-7h
// ---------------------------------------------------------
$('.uou-block-7h').each(function () {
  var $block = $(this);

  if ($.fn.flexslider) {
    $block.find('.flexslider').flexslider({
      slideshowSpeed: 10000,
      animationSpeed: 1000,
      prevText: '',
      nextText: '',
      directionNav: false,
      smoothHeight: true
    });
  } else {
    console.warn('not loaded -> jquery.flexslider-min.js');
  }
});



// .uou-block-11a
// ---------------------------------------------------------
$('.uou-block-11a').each(function () {
  var $block = $(this);

  // nav
  $block.find('.main-nav').each(function () {
    var $this = $(this).children('ul');

    $this.find('li').each(function () {
      var $this = $(this);

      if ($this.children('ul').length > 0) {
        $this.addClass('has-submenu');
        $this.append('<span class="arrow"></span>');
      }
    });

    var $submenus = $this.find('.has-submenu');

    $submenus.children('.arrow').on('click', function (event) {
      var $this = $(this),
          $li = $this.parent('li');

      if (!$li.hasClass('active')) {
        $li.addClass('active');
        $li.children('ul').slideDown();
      } else {
        $li.removeClass('active');
        $li.children('ul').slideUp();
      }
    });
  });
});

}(jQuery));



;(function($) {

"use strict";

var $body = $('body');

// Touch
// ---------------------------------------------------------
var dragging = false;

$body.on('touchmove', function() {
  dragging = true;
});

$body.on('touchstart', function() {
  dragging = false;
});



// Set Background Image
// ---------------------------------------------------------
$('.has-bg-image').each(function () {
  var $this = $(this),

      image = $this.data('bg-image'),
      color = $this.data('bg-color'),
      opacity = $this.data('bg-opacity'),

      $content = $('<div/>', { 'class': 'content' }),
      $background = $('<div/>', { 'class': 'background' });

  if (opacity) {
    $this.children().wrapAll($content);
    $this.append($background);

    $this.css({
      'background-image': 'url(' + image + ')'
    });

    $background.css({
      'background-color': '#' + color,
      'opacity': opacity
    });
  } else {
    $this.css({
      'background-image': 'url(' + image + ')',
      'background-color': '#' + color
    });
  }
});



// Superfish Menus
// ---------------------------------------------------------
if ($.fn.superfish) {
  $('.sf-menu').superfish();
} else {
  console.warn('not loaded -> superfish.min.js and hoverIntent.js');
}



// Mobile Sidebar
// ---------------------------------------------------------
$('.mobile-sidebar-toggle').on('click', function () {
  $body.toggleClass('mobile-sidebar-active');
  return false;
});
// $(".uou-block-11a").each( function() {
//     alert("mobile menu toggle bar");
// });

$('.mobile-sidebar-open').on('click', function () {
  $body.addClass('mobile-sidebar-active');
  return false;
});

$('.mobile-sidebar-close').on('click', function () {
  $body.removeClass('mobile-sidebar-active');
  return false;
});


// UOU Tabs
// ---------------------------------------------------------
if ($.fn.uouTabs) {
  $('.uou-tabs').uouTabs();
} else {
  console.warn('not loaded -> uou-tabs.js');
}



// UOU Accordions
// ---------------------------------------------------------
if ($.fn.uouAccordions) {
  $('.uou-accordions').uouAccordions();
} else {
  console.warn('not loaded -> uou-accordions.js');
}



// UOU Alers
// ---------------------------------------------------------
$('.alert').each(function () {
  var $this = $(this);

  if ($this.hasClass('alert-dismissible')) {
    $this.children('.close').on('click', function (event) {
      event.preventDefault();

      $this.remove();
    });
  }
});



// Default Slider
// ---------------------------------------------------------
if ($.fn.flexslider) {
  $('.default-slider').flexslider({
    slideshowSpeed: 10000,
    animationSpeed: 1000,
    prevText: '',
    nextText: ''
  });
} else {
  console.warn('not loaded -> jquery.flexslider-min.js');
}



// Range Slider (forms)
// ---------------------------------------------------------
if ($.fn.rangeslider) {
  $('input[type="range"]').rangeslider({
    polyfill: false,
    onInit: function () {
      this.$range.wrap('<div class="uou-rangeslider"></div>').parent().append('<div class="tooltip">' + this.$element.data('unit-before') + '<span></span>' + this.$element.data('unit-after') + '</div>');
    },
    onSlide: function(value, position) {
      var $span = this.$range.parent().find('.tooltip span');
      $span.html(position);
    }
  });
} else {
  console.warn('not loaded -> rangeslider.min.js');
}



// Placeholder functionality for selects (forms)
// ---------------------------------------------------------
function selectPlaceholder(el) {
  var $el = $(el);

  if ($el.val() === 'placeholder') {
    $el.addClass('placeholder');
  } else {
    $el.removeClass('placeholder');
  }
}

$('select').each(function () {
  selectPlaceholder(this);
}).change(function () {
  selectPlaceholder(this);
});





// ---------------------------------------------------------
// BLOCKS
// BLOCKS
// BLOCKS
// BLOCKS
// BLOCKS
// ---------------------------------------------------------





// .uou-block-1a
// ---------------------------------------------------------
$('.uou-block-1a').each(function () {
  var $block = $(this);

  // search
  $block.find('.search').each(function () {
    var $this = $(this);

    $this.find('.toggle').on('click', function (event) {
      event.preventDefault();
      $this.addClass('active');
      setTimeout(function () {
        $this.find('.search-input').focus();
      }, 100);
    });

    $this.find('input[type="text"]').on('blur', function () {
      $this.removeClass('active');
    });
  });

  // language
  $block.find('.language').each(function () {
    var $this = $(this);

    $this.find('.toggle').on('click', function (event) {
      event.preventDefault();

      if (!$this.hasClass('active')) {
        $this.addClass('active');
      } else {
        $this.removeClass('active');
      }
    });
  });
});



// .uou-block-1b
// ---------------------------------------------------------
$('.uou-block-1b').each(function () {
  var $block = $(this);

  // language
  $block.find('.language').each(function () {
    var $this = $(this);

    $this.find('.toggle').on('click', function (event) {
      event.preventDefault();

      if (!$this.hasClass('active')) {
        $this.addClass('active');
      } else {
        $this.removeClass('active');
      }
    });
  });
});



// .uou-block-1e
// ---------------------------------------------------------
$('.uou-block-1e').each(function () {
  var $block = $(this);

  // language
  $block.find('.language').each(function () {
    var $this = $(this);

    $this.find('.toggle').on('click', function (event) {
      event.preventDefault();

      if (!$this.hasClass('active')) {
        $this.addClass('active');
      } else {
        $this.removeClass('active');
      }
    });
  });
});

// .uou-block-1f
// ---------------------------------------------------------
$('.uou-block-1f').each(function () {
  var $block = $(this);

  // language
  $block.find('.language').each(function () {
    var $this = $(this);

    $this.find('.toggle').on('click', function (event) {
      event.preventDefault();

      if (!$this.hasClass('active')) {
        $this.addClass('active');
      } else {
        $this.removeClass('active');
      }
    });
  });
});



// .uou-block-5b
// ---------------------------------------------------------
$('.uou-block-5b').each(function () {
  var $block = $(this),
      $tabs = $block.find('.tabs > li');

  $tabs.on('click', function () {
    var $this = $(this),
        target = $this.data('target');

    if (!$this.hasClass('active')) {
      $block.find('.' + target).addClass('active').siblings('blockquote').removeClass('active');

      $tabs.removeClass('active');
      $this.addClass('active');

      return false;
    }
  });
});



// .uou-block-5c
// ---------------------------------------------------------
$('.uou-block-5c').each(function () {
  var $block = $(this);

  if ($.fn.flexslider) {
    $block.find('.flexslider').flexslider({
      slideshowSpeed: 10000,
      animationSpeed: 1000,
      prevText: '',
      nextText: '',
      controlNav: false,
      smoothHeight: true
    });
  } else {
    console.warn('not loaded -> jquery.flexslider-min.js');
  }
});



// .uou-block-7g
// ---------------------------------------------------------
$('.uou-block-7g').each(function () {
  var $block = $(this),
      $badge = $block.find('.badge'),
      badgeColor = $block.data('badge-color');

  if (badgeColor) {
    $badge.css('background-color', '#' + badgeColor);
  }
});



// .uou-block-7h
// ---------------------------------------------------------
$('.uou-block-7h').each(function () {
  var $block = $(this);

  if ($.fn.flexslider) {
    $block.find('.flexslider').flexslider({
      slideshowSpeed: 10000,
      animationSpeed: 1000,
      prevText: '',
      nextText: '',
      directionNav: false,
      smoothHeight: true
    });
  } else {
    console.warn('not loaded -> jquery.flexslider-min.js');
  }
});



// .uou-block-11a
// ---------------------------------------------------------
$('.uou-block-11a').each(function () {
  var $block = $(this);

  // nav
  $block.find('.main-nav').each(function () {
    var $this = $(this).children('ul');

    $this.find('li').each(function () {
      var $this = $(this);

      if ($this.children('ul').length > 0) {
        $this.addClass('has-submenu');
        $this.append('<span class="arrow"></span>');
      }
    });

    var $submenus = $this.find('.has-submenu');

    $submenus.children('.arrow').on('click', function (event) {
      var $this = $(this),
          $li = $this.parent('li');

      if (!$li.hasClass('active')) {
        $li.addClass('active');
        $li.children('ul').slideDown();
      } else {
        $li.removeClass('active');
        $li.children('ul').slideUp();
      }
    });
  });
});


// owl carousel
$(".clients-slider").owlCarousel({
  items : 5,
  navigation: true,
  navigationText: [
    "<div class='button prevSlide'><i class='fa fa-angle-left'></i></div>",
    "<div class='button nextSlide'><i class='fa fa-angle-right'></i></div>"
  ]
});



}(jQuery));











