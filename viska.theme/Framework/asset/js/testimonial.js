/**
 * Created by duongle on 4/29/14.
 */
(function($){
    $(window).load(function(){

        $(".photo").on("click",function(){
            var self = $(this);
            var send_attachment_bkp = wp.media.editor.send.attachment;
            wp.media.editor.send.attachment = function(props, attachment) {
                var image_size =  props.size;
                var image_url = attachment.sizes[image_size].url;
                self.parent().find("input[name='testimonial[photo]']").val(image_url);
                self.find("img").attr("src",image_url);
                wp.media.editor.send.attachment = send_attachment_bkp;
            }
            wp.media.editor.open();
            return false;
        });


    });
})(jQuery);