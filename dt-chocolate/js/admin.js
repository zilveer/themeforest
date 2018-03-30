jQuery(document).ready(function ($) {

    $('#colorSelector1').ColorPicker({
            color: $("#colorSelector1").css('background-color'),
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
                    $('#colorSelector1 div').css('backgroundColor', '#' + hex);
                    $('#options\\[bgcolor1\\]').val('#' + hex);
            }
    });

   $(".bg1, .bg2").click(function () {
      var cl = ($(this).hasClass('bg1') ? 'bg1' : 'bg2');
      $("."+cl).removeClass('selected');
      $(this).addClass('selected');
      $(this).parent().find("input[type=hidden]").val( $(this).attr("s") );
   });

   $(".upload").each(function () {
      var id=$(this).attr("id").replace('_upl', '');
      id=id.replace('[', '\\[');
      id=id.replace(']', '\\]');
      $("#"+id+"_new").click(function () {
         $("#"+id+"_ok").hide();
         $("#"+id+"_upl").show();
         return false;
      });
      $("#"+id+"_cancel").click(function () {
         $("#"+id+"_upl").hide();
         $("#"+id+"_ok").show();
         return false;
      });
      $("#"+id+"_del").click(function () {
         $("#"+id+"_del").val("1");
         $("#"+id+"_new").click();
         $("#"+id+"_cancel").hide();
         return false;
      });
   });

});
