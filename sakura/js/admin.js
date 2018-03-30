jQuery(document).ready(function () {
       jQuery("input[name=day_from], input[name=day_to]").bind('click change keyup mouseout blur focus', function () {
          jQuery("#"+(jQuery(this).attr("id") == "day_to" ? "night_from" : "night_to")).val( jQuery(this).val() );
       });
       
       jQuery("input[name=skin]").click(function () {

          jQuery("#switch_table").hide();
          jQuery("#" + jQuery(this).val() + "_table").show();

          if ( (jQuery(this).val() == "day") || (jQuery(this).val() == "switch") )
          {
             jQuery("#logo_day").show();
          }
          else
          {
             jQuery("#logo_day").hide();
          }
          if ( (jQuery(this).val() == "night") || (jQuery(this).val() == "switch") )
          {
             jQuery("#logo_night").show();
          }
          else
          {
             jQuery("#logo_night").hide();
          }
       });

       jQuery(".pattern, .art").click(function () {
          var cl = (jQuery(this).hasClass('pattern') ? 'pattern' : 'art');
          jQuery("."+cl).removeClass('selected');
          jQuery(this).addClass('selected');
          jQuery(this).parent().find("input[type=hidden]").val( jQuery(this).attr("s") );
       });
});
