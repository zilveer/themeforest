(function(a) {
  a.fn.oneCarousel = function(c) {
    var f = this;
    var e = a.extend({
      easeIn: "fadeInLeft",
      pause: "hover",
      interval: 1000
    }, c);
    f.carousel({
      pause: e.pause,
      interval: e.interval
    });
    var b;
    var d;
    f.find(".item_inner").find('*').each(function(g) {
      //a(this).css("opacity", 1); //eugen
      a(this).css("opacity", 0);
      if(a(this).parent().parent('.item').hasClass('active')){
        a(this).css("opacity", 1);
      }
      if(a(this).parent().parent().parent('.item').hasClass('active')){
        a(this).css("opacity", 1);
      }
      if(a(this).parent().parent().parent().parent('.item').hasClass('active')){
        a(this).css("opacity", 1);
      }
    });
    a(".item_inner", f.find(".active")).find('*').each(function(g) {
      if (a(this).data("animate")) {
        d = a(this).data("animate");
      } 
      if (a.browser.msie && a.browser.version <= 9) {
        a(this).css("opacity", 0);
        a(this).show().animate({
          opacity: 1
        }, 100 + 100 * g);
      } else {
        a(this).removeClass(d).addClass(d);
      }
      b = a(this);
    });
    f.on("slid", function(g) {
      if (b) {
        b.find(".item_inner").find('*').each(function(h) {
          if (a(this).data("animate")) {
            d = a(this).data("animate");
          } 
          a(this).removeClass(d).css("opacity", 0);
        });
      }
      a(".item_inner", f.find(".active")).find('*').each(function(h) {
        if (a(this).data("animate")) {
          d = a(this).data("animate");
        }
        if (a.browser.msie && a.browser.version <= 9) {
          a(this).css("opacity", 0);
          a(this).show().animate({
            opacity: 1
          }, 100 + 100 * h);
        } else {
          a(this).css("opacity", 1).removeClass(d).addClass(d);
        }
      });
      b = a(this);
    });
    return this;
  };
})(jQuery);