$(function () {
   $(".dd_current").click(function () {
      var e = $(this).parent().find(".dd_dropdown");
      var p = $(this);

      var top_pos = p.offset().top;
      top_pos -= 32;
      top_pos -= p.height();
      top_pos -= $(document).scrollTop();
      top_pos += "px";

      e.css({
         position: 'absolute',
         top: top_pos,
         left: $("#show").width()
      });
      if (e.is(":visible"))
      {
         //e.slideUp(600);
         e.hide();
      }
      else
      {
         e.show().css('width', 'auto');
         var ch = e.find(".dd_item").length;
         var w = ch*50+(ch)*10;
         e.css('width', 0).animate({
            width: w+"px"
         }, {
            duration: 500
         });
      }
      return false;
   });

   $(".dd_dropdown .dd_item").click(function () {
      var c = $(this).parent().parent().find(".dd_current");
      $(this).parents(".dd_dropdown").find(".dd_item").removeClass('act');
      $(this).addClass('act');
      c.html('').append( $(this).clone() );
      c_all();
      var t = ( $(this).parents(".dd_container").hasClass('dd_art') ? 'art' : 'pattern');
      $("#demo_form input[name="+t+"]").val( $(this).attr("tt") );
   });

   $(".demo_save").click(function () {
      $("#demo_form").submit();
      return false;
   });

   $(".demo_reset").click(function () {
     var hex = "ffffff";
     $('#colorSelector_demo div').css('backgroundColor', '#' + hex);
     $(".dd_item").css('background-color', '#'+hex);
     $("#demo_form input[name=bgcolor]").val( '#'+hex );
     $("#show .act").removeClass('act');
     $(".empty").trigger("click");
     return false;
   });

   $("#op_c").click(function () {
      if (0)
      $(".customize").show();
      else
      $(".customize").hide().fadeIn(1000, function () {
         if ($.browser.msie) this.style.removeAttribute('filter');
      });
      $("input[name=cust_shown]").val("1");
      $.post(window.location.href, { set_cust_shown: 1 });
      return false;
   });

   $(".skin_close").click(function () {
      $(".customize").fadeOut();
      $("input[name=cust_shown]").val("0");
      $.post(window.location.href, { set_cust_shown: 0 });
      return false;
   });

   $('#colorSelector_demo').ColorPicker({
            color: $("#colorSelector_demo").css('background-color'),
            onShow: function (colpkr) {
                    if ($(colpkr).is(":visible")) return;
                    $(colpkr).fadeIn(500);
                    return false;
            },
            onHide: function (colpkr) {
                    $(colpkr).fadeOut(500);
                    return false;
            },
            onChange: function (hsb, hex, rgb) {
                    $('#colorSelector_demo div').css('backgroundColor', '#' + hex);
                    $(".dd_item").css('background-color', '#'+hex);
                    $("#demo_form input[name=bgcolor]").val( '#'+hex );
            }
   });
});

function c_all()
{
   //$(".dd_dropdown").hide();
}
