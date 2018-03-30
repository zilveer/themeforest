<?php
    global $post;
    get_header('handyman-inner');
?>
    <style type="text/css">
        html{ margin-top:0 !important; overflow-y: auto; }
        body{background: none !important;}
        .tl-loader-wrapper{background: #fff !important;}
        .tl-loader,.header-site,#back-to-top,#footer,#wpadminbar,#off-canvas-right{display: none !important;}
        #wrapper-content{padding: 0 !important; margin: 0 10px 0 0 !important;}
        .thumbnail{margin: 0 10px 5px 0; float: left;}
        .tl-color-switcher{display: none !important;}
        .phone .thumbnail, .phone .thumbnail img{ width: 100%; }
        .iphone .popup-story{ height: 1px; max-height: 380px; }
        .thumbnail a{ cursor: default;}
    </style>
    <div class="story container-y popup-story">

        <?php if( have_posts() ) : ?>
            <?php while( have_posts() ) : the_post(); ?>
                <?php $media =  tl_post_featured_media(array('size' => 'medium', 'use_pretty_photo'=>false));
                if($media != '' && $media != null){
                    echo $media;
                }
                echo apply_filters('the_content', get_the_content());
                ?>
            <?php endwhile; ?>
        <?php else:
            echo '<h3 style="color: #ccc; padding: 20px 0; text-align: center;">'. __('Content is not Available!', TL_DOMAIN).'</h3>';
         endif; // if has_post() ?>
    </div>
    <script type="text/javascript">
        (function($) {
            "use strict";

                $(document).ready(function(){

                    $("body").on("tl_page_loaded", function(){

                        $('.thumbnail a').on("click", function(e){
                            e.preventDefault();
                            e.stopPropagation();
                            return null;
                        });

                        var iframe = $('.popup-inner-content iframe', window.parent.document, '');
                        if(!$("html").hasClass("ie8") && !$("html").hasClass("ie9")){

                            // Container in iframe
                            var iframe_content_height = $(".popup-story.container-y").height();
                            // Available screen height
                            var screenH = $(window.parent).height();
                            var popup_footer_height = 140;
                            var popup_header_height = 137;
                            var padding = 12;

                            var frame_space = popup_footer_height + popup_header_height + padding;

                            if(!$("html").hasClass("phone")){

                                if(screenH - frame_space > iframe_content_height ){
                                    screenH = iframe_content_height;
                                }else{
                                    screenH =  Math.ceil(screenH*0.75);
                                    screenH = screenH - frame_space;
                                }
                                iframe.animate({height:screenH}, 500, "swing");
                            }else if($("html").hasClass("iphone")){

                                screenH = screenH - (77 + 147);
                                $(".popup-story").css("height", screenH+"px");
                                $(".popup-story").css("-webkit-overflow-scrolling","touch");

                                /*
                                 Prevent Scrolling down.
                                 Uses jQuery.
                                 */
                                $(document).on("scroll",function(){
                                    checkForScroll();
                                });

                                var checkForScroll = function(e)
                                {
                                    var iScroll = $(document).scrollTop();
                                    if (iScroll > 1){
                                        // Disable event binding during animation
                                        $(document).off("scroll");

                                        // Animate page back to top
                                        $("body,html").animate({"scrollTop":"0"},500,function(){
                                            $(document).on("scroll",checkForScroll);
                                        });
                                    }
                                }
                            }
                        }
                        iframe.addClass("loaded");
                        window.parent.TL_GLOBAL.tl_trigger_complete_iframe();
                    });
                });
        })(jQuery);
    </script>
<?php
get_footer();