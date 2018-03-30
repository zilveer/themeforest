(function ($) {

    /***** Flickr Widget ******/

    function Flickr_Widget() {
       
        $('.widget_pr_flickr_widget .flickr_container').each(function () {
            var $this = $(this);

            //Detect loading of images
            var intID = setInterval(function () {
                var $links = $this.find('.flickr_badge_image a');

                if (!$links.length)
                    return;

                var $flickrHover = $('<img class="hover_image" height="75" width="75" src="' + theme_uri.img + '/flickr_hover.png" />');
                $flickrHover.css('opacity', 0);

                //Add hover image to each anchor tag
                $links.append($flickrHover)
                .hover(
                    function () {
                        $(this).find('img').eq(1).stop().animate({ opacity: 1 }, { speed: 300 });
                    },
                    function () {
                        $(this).find('img').eq(1).stop().animate({ opacity: 0 }, { speed: 300 });
                    }
                );


                //Clear the timer event
                clearInterval(intID);
            }, 1000);
        });

 
    }

    /***** Search widget validation ******/

    function Search_Widget() {
        
        $('.widget .search form').each(function () {
            var $form = $(this),
                $btn = $form.find('input[type="submit"]'),
                $input = $form.find('input[type="text"]');

            $input.blur(function () {
                if ($.trim($input.val()).length > 0) {
                    $form.removeClass('error');
                }
            });

            $btn.click(function (e) {
                $input.focus();

                if ($.trim($input.val()).length < 1) {
                    $form.addClass('error');
                    e.preventDefault();
                }
            });

        });
    }

    $(document).ready(function () {

        Flickr_Widget();
        Search_Widget();

    });

})(jQuery);