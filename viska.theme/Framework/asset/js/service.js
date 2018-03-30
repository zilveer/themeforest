/**
 * Created by duongle on 4/26/14.
 */
(function($){
    $(window).load(function(){

        $("input[name='service[logo][type]']").on("click", function(){
           if($(this).val()=='icon'){
               $("div.icon-logo").show();
               $("div.image-logo").hide();
           };
           if($(this).val()=='image'){
                $("div.icon-logo").hide();
                $("div.image-logo").show();
           };

        });


        $("a.md-popup-close").on("click",function(){
            $("div.choose-icon-font").fadeOut();
        })
        var current_choose_icon2 = null;
        var current_class2 = null;
        var choose_class2 = null;

        $(".icon-logo a").on("click", function(){
            $("div.choose-icon-font").show();
            current_choose_icon2 = $(this).find('i');
            current_class2 = $(this).parent().find("input[name='service[logo][icon]']").val();
            if(current_class2!=undefined)
            {
                $("i#current-icon").removeClass();
                $("i#current-icon").addClass(current_class2);
            }
            choose_class2 = current_class2;
            console.log(current_class2);
            $("div.list-font-icon").find("i[class='"+current_class2+"']").parent().addClass('choose');
            return false;
        });
        $("div.list-font-icon li").live("click", function(){
            choose_class2 = $(this).find("i").attr("class");
            $("i#current-icon").removeClass();
            $("i#current-icon").addClass(choose_class2);
            $("div.list-font-icon li").removeClass('choose');
            $(this).addClass('choose');
            return false;
        });

        $("a.md-popup-save").on("click",function(){
            current_choose_icon2.parent().parent().find("input[name='service[logo][icon]']").val(choose_class2);
            current_choose_icon2.removeClass(current_class2);
            current_choose_icon2.attr('class',choose_class2);
            $("div.choose-icon-font").fadeOut();
            return false;
        });

        $(".image-logo").on("click",function(){
            var self = $(this);
            var send_attachment_bkp = wp.media.editor.send.attachment;
            wp.media.editor.send.attachment = function(props, attachment) {
                var image_size =  props.size;
                var image_url = attachment.sizes[image_size].url;
                self.find("input[name='service[logo][image]']").val(image_url);
                self.find("img").attr("src",image_url);
                wp.media.editor.send.attachment = send_attachment_bkp;
            }
            wp.media.editor.open();
            return false;
        });

    });
})(jQuery);