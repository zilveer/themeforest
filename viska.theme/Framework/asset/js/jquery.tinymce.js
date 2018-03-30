/**
 * Created by wiloke on 4/27/14.
 */
(function($)
{
    "user strict";

    tinymce.create('tinymce.plugins.woShortcodesBuilding',
    {
        init: function(e, url)
        {

            e.addButton('wo_shortcodes',
            {

              title: 'AWE Shortcodes',
              image:   MAURL.url +  'Framework/asset/images/shortcodes_icon.png',
               onclick: function()
               {
                   $.ajax(
                   {
                      type: 'POST',
                      url: AWE.ajaxurl,
                      data: {action: 'awe-load-shortcode'},
                      success: function(res){
                        $("body").append(res);
                      },
                      error: function()
                      {
                          alert("Adu");
                      }
                   });
               }
            });

        },



    });

    tinymce.PluginManager.add('woShortcodesBuilding', tinymce.plugins.woShortcodesBuilding);

    $(".md-get-shortcode-detail a").live("click", function(event)
    {
        event.preventDefault();


        var fileName = $(this).parent().attr("data-filename"), changeClass = $(this).parent().attr("data-popupClass"), title=$(this).parent().attr("data-title"), getHtml=null;
        changeClass = "wo-popup-shortcodes " + changeClass;
        // Have some change, don't use ajax, we will use xml cdata
//        $.ajax({
//            type: 'POST',
//            url: AWE.ajaxurl,
//            data: {action: 'include-file', fileName: fileName},
//            success: function(res)
//            {
//                $(".md-popup-title").text(title);
//                $(".md-popup").attr("class", changeClass);
//                $(".md-popup-inner-content").html(res);
//            }
//        })
        $(".wo-shortcode-title").text(title);
        $(".wo-popup-shortcodes").attr("class", changeClass);

        console.log(AWE_SC_DETAILS.wp_shortcode_details.fileName);

        getHtml = '<div class="'+fileName+'">' +  AWE_SC_DETAILS.wp_shortcode_details[fileName] + '</div>';

        $(".md-wrap-shortcodes").html(getHtml);

    })

    $(".md-popup-backdrop").live("click", function(event)
    {
        event.preventDefault();
        closeRemove();
    })

    $(".md-shortcode-save").live("click", function(event)
    {
        var getClass, hasClose=false, parseClass = [], mainShortcode="", open="", close="", onlyTag="", insertShortcode="";

        if ($(".md-flag").length < 1)
        {
            alert("Not Flag");
        }else{
            getClass = $(".md-flag").val();

            if ( typeof getClass == 'undefined' )
            {
                alert("Not class");
                return;
            }

            if ( $(".hasClose").length > 1 )
            {
                hasClose = true;
            }



            open    = $(".open").val();
            close   = $(".close").val();

            if (hasClose == false)
            {
                parseClass = getClass.split(",");
                for (var i=0; i < parseClass.length; i++)
                {
                    mainShortcode += parseClass[i] + '=' + '"' + $("."+parseClass[i]).val() + '" ';
                }

                insertShortcode = open +  mainShortcode + close;

            }else{

                mainShortcode = $("."+getClass).val();

                insertShortcode = open +  mainShortcode + close;
            }

            tinymce.execCommand("mceInsertContent", 0, insertShortcode);

            closeRemove();

        }
    })

    function closeRemove()
    {
        $(".md-popup-backdrop").fadeOut('slow', function()
        {
            $(this).prev().remove();
            $(this).remove();
        })
    }

})(jQuery)