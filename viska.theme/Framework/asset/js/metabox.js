/**
 * Created by duongle on 4/26/14.
 */
(function($){
    $(window).load(function(){

        /* Upload Resusme */
        $(".upload-resume").on("click",function(){
            var self = $(this);
            var send_attachment_bkp = wp.media.editor.send.attachment;
            wp.media.editor.send.attachment = function(props, attachment) {
                self.parent().find("input:text").val(attachment.url);
                wp.media.editor.send.attachment = send_attachment_bkp;
            }
            wp.media.editor.open();
            return false;
        });
        /* Choose Photo */
        $("body").on("click",".photo",function(){
            var self = $(this);
            var send_attachment_bkp = wp.media.editor.send.attachment;
            wp.media.editor.send.attachment = function(props, attachment) {
                var image_size =  props.size;
                var image_url = attachment.sizes[image_size].url;
                self.parent().find("input[class=input-photo]").val(image_url);
                self.find("img").attr("src",image_url);
                wp.media.editor.send.attachment = send_attachment_bkp;
            }
            wp.media.editor.open();
            return false;
        });
        /* End Choose Photo */

        /* Choose Icon */
        $("a.md-popup-close").on("click",function(){
            $("div.choose-icon-font").fadeOut();
        });
        var current_choose_icon = null;
        var current_class = null;
        var choose_class = null;
        var is_icon_click = false;
        $("body").on("click","a.choose-icon",function(){
            current_choose_icon = $(this).find("i");
            is_icon_click = true;
            $("div.choose-icon-font").show();
            current_class = current_choose_icon.attr("class");
            if(current_class!=undefined)
            {
                $("i#current-icon").removeClass();
                $("i#current-icon").addClass(current_class);
            }
            choose_class = current_class;
            $("div.list-font-icon").find("i[class='"+current_class+"']").parent().addClass('choose');
            return false;

        });
        $("div.list-font-icon li").on("click", function(){
            if(is_icon_click==false)
                return;
            choose_class = $(this).find("i").attr("class");
            $("i#current-icon").removeClass();
            $("i#current-icon").addClass(choose_class);
            $("div.list-font-icon li").removeClass('choose');
            $(this).addClass('choose');
            return false;
        });

        $("a.md-popup-save").on("click",function(){
            if(is_icon_click==false)
                return;
            $("div.list-font-icon li").removeClass('choose');
            current_choose_icon.parent().parent().find("input.input-icon").val(choose_class);
            current_choose_icon.removeClass(current_class);
            current_choose_icon.attr('class',choose_class);
            $("div.choose-icon-font").fadeOut();
            return false;
        });
        /* End Choose Icon */

        /* Feature */
        var remove_feature = '<a href="#" class="remove-feature fa fa-times"></a>';
        $("body").on("click",".remove-feature",function(e){
            e.preventDefault();
            var remove=$(this).clone();
            $(this).parent().prev().append(remove);
            $(this).parent().remove();
            return true;
        });
        $(".awe-feature-all-items div.awe-feature-item:last-child").append(remove_feature);
        $("body").on("click",".awe-feature-logo-option input",function(){
            $(this).parent().parent().find(".awe-feature-logo-preview").children("div").hide();
            switch ($(this).val())
            {
                case 'none':
                    $(this).parent().parent().find(".awe-feature-logo-none").show();
                    break;
                case 'icon':
                    $(this).parent().parent().find(".awe-feature-logo-icon").show();
                    break;
                case 'image':
                    $(this).parent().parent().find(".awe-feature-logo-image").show();
                    break;
            }
            return true;
        });

        $("input.feature-add-more").on("click",function(){
            var last_child = $(".awe-feature-all-items div.awe-feature-item:last-child");
            if(last_child!=undefined && (last_child.find(".awe-feature-title input").val()=='' || last_child.find(".awe-feature-desc textarea").val()==''))
            {
                alert("Please fill required info before add more");
            }
            else
            {
                var num = $(".awe-feature-all-items div.awe-feature-item:last-child").attr("num");
                if(num==undefined) num =0;
                var clone = $(".feature-clone").clone();
                var feature_name = $(".feature-clone").attr("feature-name");
                $(".awe-feature-all-items div").find("a.remove-feature").remove();
                num++;
                clone.attr("num",num);
                clone.find(".awe-feature-logo-option").children("input").attr("name",feature_name+"[features]["+num+"][logo_type]");

                clone.find(".awe-feature-logo-preview").find(".input-photo").attr("name",feature_name+"[features]["+num+"][logo_img]");
                clone.find(".awe-feature-logo-preview").find(".input-icon").attr("name",feature_name+"[features]["+num+"][logo_icon]");
                clone.find(".awe-feature-title input").attr("name",feature_name+"[features]["+num+"][title]");
                clone.find(".awe-feature-desc textarea").attr("name",feature_name+"[features]["+num+"][desc]");

                clone.append(remove_feature);
                clone.removeAttr("feature-name").removeAttr("style").removeClass("feature-clone");
                $(".awe-feature-all-items").append(clone);
            }
            return true;
        });
        /* End Feature */

        /* Skills */
        var remove_skill = '<a title="Delete" href="#" class="media-modal-close remove-skill"><span class="media-modal-icon"></span></a>';
        $("div.all-skills div.skill-item").last().append(remove_skill);
        $("body").on("click",".remove-skill",function(e){
            e.preventDefault();
            var remove=$(this).clone();
            $(this).parent().prev().append(remove);
            $(this).parent().remove();
            return true;
        });

        $(".skill-add-more").on("click",function(){
            var last_child = $("div.all-skills div.skill-item").last();
            if(last_child!=undefined && (last_child.find("input.skill-name").val()=='' ))
            {
                alert("Please fill required info before add more");
            }
            else
            {
                var num = $("div.all-skills div.skill-item").last().attr("num");
                var skill_name = $(".skill-clone").attr("skill-name");
                if(num==undefined) num =0;
                var clone = $(".skill-clone").clone();
                $(".all-skills div").find("a.remove-skill").remove();
                num++;
                clone.attr("num",num);
                clone.find("input.input-icon").attr("name",skill_name+"[skills]["+num+"][icon]");
                clone.find("input.skill-name").attr("name",skill_name+"[skills]["+num+"][name]");
                clone.find("input.skill-desc").attr("name",skill_name+"[skills]["+num+"][desc]");
                clone.find("input.skill-pro").attr("name",skill_name+"[skills]["+num+"][pro]");

                clone.append(remove_skill);
                clone.removeAttr("skill-name").removeAttr("style").removeClass("skill-clone");
                clone.find(".chart").easyPieChart({
                    animate:1,
                    onStep: function(from, to, percent) {
                        $(this.el).find('.percent').text(Math.round(percent));
                    }
                });
                clone.find("input.skill-pro").val("0");

                clone.find(".skill-range" ).slider({
                    range: "min",
                    min: 0,
                    max: 100,
                    value:0,
                    slide: function( event, ui ) {
                        $(this).closest(".skill-item").find(".skill-pro" ).val( ui.value );
                        if($(this).parent().find('.chart').data('easyPieChart')) $(this).parent().find('.chart').data('easyPieChart').update(ui.value);
                    }
                });
                $(".all-skills .clear").before(clone);
            }
            return true;
        });



        $(document).ready(function(){
            $(".skill-range" ).slider({
                range: "min",
                min: 0,
                max: 100,
                value: 50,
                slide: function( event, ui ) {
                    $(this).closest(".skill-item").find(".skill-pro" ).val( ui.value );
                    if($(this).parent().find('.chart').data('easyPieChart')) $(this).parent().find('.chart').data('easyPieChart').update(ui.value);
                }
            });
            $(".skill-pro").each(function(){
                $(this).parent().find(".skill-range").slider("value",$(this).val());
            });
            $('.chart').easyPieChart({
                animate:1,
                onStep: function(from, to, percent) {
                    $(this.el).find('.percent').text(Math.round(percent));
                }
            });
        });

        /* End Skills*/

        /* Fun-Factss*/
        var remove_funfact = '<a title="Delete" href="#" class="fa fa-trash-o remove-funfact"></a>';
        $(".all-funfacts .funfact-item:last-child").append(remove_funfact);
        $("body").on("click",".remove-funfact",function(e){
            e.preventDefault();
            var remove=$(this).clone();
            $(this).parent().prev().append(remove);
            $(this).parent().remove();
            return true;
        });

        $(".funfact-add-more").on("click",function(){
            var last_child = $("body").find(".all-funfacts div.funfact-item:last-child");
            if(last_child!=undefined && (last_child.find("input.funfact-title").val()=='' || last_child.find("input.funfact-total").val()==''))
            {
                alert("Please fill required info before add more");
            }else
            {
                var num = $(".all-funfacts div.funfact-item:last-child").attr("num");
                var funfact_name = $(".funfact-clone").attr("funfact-name");
                if(num==undefined) num =0;
                var clone = $(".funfact-clone").clone();
                $(".all-funfacts div").find("a.remove-funfact").remove();
                num++;
                clone.attr("num",num);
                clone.find("input.input-icon").attr("name",funfact_name+"[funfacts]["+num+"][icon]");
                clone.find("input.funfact-title").attr("name",funfact_name+"[funfacts]["+num+"][name]");
                clone.find("input.funfact-total").attr("name",funfact_name+"[funfacts]["+num+"][total]");

                clone.append(remove_funfact);
                clone.removeAttr("funfact-name").removeAttr("style").removeClass("funfact-clone");
                $(".all-funfacts").append(clone);
            }
            return true;
        });
        /* End Fun-Facts*/

        /* Resume */
        var remove_resume = '<a title="Delete" href="#" class="media-modal-close remove-resume"><span class="media-modal-icon"></span></a>';
        $(".awe-resume-all-items div.awe-resume-item:last-child").append(remove_resume);
        $("body").on("click",".remove-resume",function(e){
            e.preventDefault();
            var remove=$(this).clone();
            $(this).parent().prev().append(remove);
            $(this).parent().remove();
            return true;
        });

        $(".resume-add-more").on("click",function(){
            var last_child = $(".awe-resume-all-items div.awe-resume-item:last-child");
            console.log(last_child.find(".awe-resume-item-time input"));
            if(last_child!=undefined && (last_child.find(".awe-resume-item-time input").val()=='' || last_child.find(".awe-resume-item-title input").val()=='' || last_child.find(".awe-resume-item-desc textarea").val()==''))
            {
                alert("Please fill required info before add more");
            }else
            {
                var num = $(".awe-resume-all-items div.awe-resume-item:last-child").attr("num");
                var resume_name = $(".resume-clone").attr("resume-name");
                if(num==undefined) num =0;
                var clone = $(".resume-clone").clone();
                $(".awe-resume-all-items div").find("a.remove-resume").remove();
                num++;
                clone.attr("num",num);
                clone.find("input.resume-time").attr("name",resume_name+"[resumes]["+num+"][time]");
                clone.find("select.resume-type").attr("name",resume_name+"[resumes]["+num+"][type]");
                clone.find("input.resume-title").attr("name",resume_name+"[resumes]["+num+"][title]");
                clone.find("input.resume-position").attr("name",resume_name+"[resumes]["+num+"][position]");
                clone.find("textarea.resume-desc").attr("name",resume_name+"[resumes]["+num+"][desc]");

                clone.append(remove_resume);
                clone.removeAttr("resume-name").removeAttr("style").removeClass("resume-clone");
                $(".awe-resume-all-items").append(clone);
            }
            return true;
        })

        /* End Resume */

        /* Media */
        $("select[name='awe_media[media_type]']").on("click change",function()
        {
            show_media_post_type($(this).val());
        });
        var array_types =['audio','gallery','link','quote','video','image'];
        for(var i=0;i<array_types.length;i++){
            $("#post-format-"+array_types[i]).on("click checked",function(){
                var type = $(this).attr("id");
                type = type.replace("post-format-","");
                if(type=='image')
                    type = 'gallery';
                $("select[name='awe_media[media_type]']").val(type);
                show_media_post_type(type);
            });
        }


        function show_media_post_type(type)
        {
            var array_types =['audio','gallery','link','quote','video'];
            for(var i=0;i<array_types.length;i++)
            {
                if(array_types[i]==type)
                    $(".awe-media-"+array_types[i]).fadeIn();
                else $(".awe-media-"+array_types[i]).fadeOut();
            }

        }
        var image_custom_uploader;
        /* Choose Intro Slider Images */
        $(".media-add-gallery").on("click",function(){
            var self = $(this);
            //If the uploader object has already been created, reopen the dialog
            if (image_custom_uploader) {
                image_custom_uploader.open();
                return;
            }
            //Extend the wp.media object
            image_custom_uploader = wp.media.frames.file_frame = wp.media({
                title: 'Choose Image',
                button: {
                    text: 'Choose Image'
                },
                multiple: true
            });
            //When a file is selected, grab the URL and set it as the text field's value
            image_custom_uploader.on('select', function() {
                selection = image_custom_uploader.state().get('selection');
                var ids = [], urls=[];
                selection.map(function(attachment)
                {
                    attachment 	= attachment.toJSON();
                    ids.push(attachment.id);
                    urls.push(attachment.url);

                });

                var img_prev = '', media_name = $(".awe-media").attr('media-name');

                for(var i=0;i<urls.length;i++)
                {
                    img_prev += '<div class="item"><img src="'+urls[i]+'"><input type="hidden" name="'+media_name+'[gallery][]" value="'+urls[i]+'"><span class="dashicons dashicons-no-alt del-image"></span></div>';
                }
                if(img_prev!=''){
                    $('.awe-media-gallery').find(".content .image-none").remove();
                    $('.awe-media-gallery').find(".content").append(img_prev);
                }

            });
            image_custom_uploader.open();
        });

        $.fn.extend( {
            get_video: function() {
                $(this).on('click',function(){
                    var url = $("input.awe-new-video-url").val(),media_name = $(".awe-media").attr('media-name');

                    if(is_youtube(url)){
                        var id = url.match("[\\?&]v=([^&#]*)"),ivalue={},img='';
                        ivalue={'type':'youtube','id':id[1],'image':'http://i.ytimg.com/vi/'+id[1]+'/hqdefault.jpg'};
                        console.log(JSON.stringify(ivalue));
                        img = '<div class="item"><img src="'+ivalue['image']+'">';
                        img += "<input type=\"hidden\" value='"+JSON.stringify(ivalue)+"' name=\""+media_name+"[videos][]\" >";
                        img += "<div class=\"dashicons dashicons-video-alt3 pattern\"></div>";
                        img +=  '<span class="dashicons dashicons-no-alt del-image"></span></div>';
                        $('.awe-media-video').find(".content .video-none").remove();
                        $('.awe-media-video').find(".content").append(img);

                        return;
                    }
                    if(is_vimeo(url)){
                        var id_vimeo,m = url.match(/^.+vimeo.com\/(.*\/)?([^#\?]*)/),ivalue={},img='';
                        id_vimeo = m ? m[2] || m[1] : null;;

                        if(id_vimeo!=undefined){
                            $.getJSON('http://www.vimeo.com/api/v2/video/' + id_vimeo + '.json?callback=?', {format: "json"}, function(data) {
                                ivalue={'type':'vimeo','id':id_vimeo,'image':data[0].thumbnail_large};
                                img = '<div class="item"><img src="'+data[0].thumbnail_large+'">' +
                                    '<input type="hidden" name="'+media_name+'[videos][]" value=\''+JSON.stringify(ivalue)+'\'>' +
                                    '<div class=\"dashicons dashicons-video-alt3 pattern\"></div>' +
                                    '<span class="dashicons dashicons-no-alt del-image"></span></div>';
                                $('.awe-media-video').find(".content .video-none").remove();
                                $('.awe-media-video').find(".content").append(img);
                            });
                        }else alert('Can not get Vimeo ID');

                        return;
                    }

                    alert("Video URL invalid");
                });

                function is_youtube(url){
                    var matches = url.match(/youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)/);
                    if (url.indexOf('youtube.com') > -1)
                        return true;
                    if (url.indexOf('youtu.be') > -1)
                        return true;
                    return false;
                };
                function is_vimeo(url){
                    if(url.indexOf('vimeo.com') > -1)
                        return true
                    return false;
                };
            }
        });
        $("body").on("click",".awe-media-gallery span.del-image",function(){
            var media_name = $(".awe-media").attr('media-name');
            if($(this).closest(".content").find(".item").length==1)
                $(this).closest(".content").append("<div class=\"image-none\"><input type=\"hidden\" name=\""+media_name+"[gallery]\" value=\"\"><img src=\""+AWEURL+"asset/images/image-none.png\"></div>");
            $(this).parent().remove();

        });
        $("body").on("click",".awe-media-video span.del-image",function(){
            var media_name = $(".awe-media").attr('media-name');
            if($(this).closest(".content").find(".item").length==1)
                $(this).closest(".content").append("<div class=\"item video-none\"><input type=\"hidden\" name=\""+media_name+"[gallery]\" value=\"\"><img src=\""+AWEURL+"asset/images/video-none.png\"></div>");
            $(this).parent().remove();

        });
        $("input.media-add-video").get_video();
        $(document).ready(function(){
            $(".awe-audio-link").on("change keyup",function(){
                $(".awe-audio-preview").html('<div id="soundcloud-preview"></div>');
                var link = $("input.awe-audio-link").val(),autoplay=$("input.awe-audio-auto-play:checked").val();
                var maxheight = (link.indexOf("/sets/")!=-1) ? "450px":"160px";
                if(link!=undefined && link!='')
                    SC.oEmbed(link, {color: "ff0066",auto_play: autoplay,maxheight:maxheight},  document.getElementById("soundcloud-preview"));
            })
            $(".awe-audio-auto-play").on("click",function(){
                $(".awe-audio-preview").html('<div id="soundcloud-preview"></div>');
                var link = $("input.awe-audio-link").val(),autoplay=$("input.awe-audio-auto-play:checked").val();
                var maxheight = (link.indexOf("/sets/")!=-1) ? "450px":"160px";
                if(link!=undefined && link!='')
                    SC.oEmbed(link, {color: "ff0066",auto_play: autoplay,maxheight:maxheight},  document.getElementById("soundcloud-preview"));
            })
        });

        /* End Media */
        /* Offer script */
        $("input.offer-add-more").on("click",function(){
            var last_child = $("div.awe-offer-fields").find(".offer-item").last().find("input");
            if(last_child.val()=='' ||last_child.val()==undefined)
            {
                alert('Please fill required info before add more');
            }else
                $("div.awe-offer-fields").append('<div class="offer-item"><input type="text" class="medium" name="awe_offer[offer][]" value=""><a href="#" class="remove-offer">Delete</a></div>');

            return false;
        });

        $("body").on("click",".remove-offer",function(){
            $(this).parent().remove();
            return false;
        })

        $("input[id=show-price]").on("click",function(){
            if($(this).is(':checked'))
                $(".awe-offer-price").show();
            else
                $(".awe-offer-price").hide();

        })
        /* End offer script */



        /* Pricing Script */
        $( "#pricing-sortable" ).sortable({
            update: function(event, ui) {
                pricing_update();
            }
        });
//        $( "#pricing-sortable" ).disableSelection();
        if($(".awe-pricing ul").find("li").length==0)
        {
            clone = $(".awe-pricing-addmore").find(".clone").clone();
            clone.removeAttr("style").removeClass("clone");
            $(".awe-pricing ul").append(clone);
        }
        $(".pricing-add-more").on("click",function(){
            var required = true;
            $(".awe-pricing ul").find("li").last().find("input:text").each(function(){
                if($(this).val()=='' || $(this).val()==undefined){
                    alert("Please fill required fields");
                    required = false;
                    console.log($(this).val());
                    return false;
                }

            })
            if(required){
                clone = $(this).parent().find(".clone").clone();
                clone.removeAttr("style").removeClass("clone");
                $(".awe-pricing ul").append(clone);
                //clone.
            }
            return false;
        });

        $("body").on("click",".pricing-offer-remove",function(){
            $(this).closest(".awe-pricing-offer-item").remove();
            pricing_update();
            return false;
        });

        $("body").on("click",".pricing-item-remove",function(){
            $(this).closest("li").remove();
            pricing_update();
            return false;
        });

        $("body").on("click",".pricing-item-clone",function(){
            var clone = $(this).closest("li").clone();
            $(this).closest("li").after(clone);
            pricing_update();
            return false;
        });

        $("body").on("click",".pricing-offer-add",function(){
            $(this).parent().find(".awe-pricing-offer-items").append("<div class=\"awe-pricing-offer-item\"><input type=\"text\" class=\"pricing-offer-item\"><a href=\"#\" class=\"pricing-offer-remove fa fa-trash-o\"></a></div>");

        });

        $("body").on("change keyup",".pricing-price,.pricing-title,.pricing-desc,.pricing-offer-item,.pricing-url,.pricing-currency,.pricing-time",function(){
            pricing_update();

        })

        function pricing_update()
        {
            var datas = [];
            $(".awe-pricing ul li").each(function(){
                var offers = []
                $(this).find(".awe-pricing-offer-items").find(".awe-pricing-offer-item").each(function(){
                    if($(this).find("input.pricing-offer-item").val()!='' && $(this).find("input.pricing-offer-item").val()!=undefined)
                        offers.push($(this).find("input.pricing-offer-item").val());
                });
                var item = {
                    price:$(this).find(".pricing-price").val(),
                    title:$(this).find(".pricing-title").val(),
                    desc:$(this).find(".pricing-desc").val(),
                    url:$(this).find(".pricing-url").val(),
                    currency: $(this).find(".pricing-currency").val(),
                    time: $(this).find(".pricing-time").val(),
                    offers:offers
                };
                datas.push(item);
            });
            $(".pricing-value").val(JSON.stringify(datas));
        }

    });

})(jQuery);