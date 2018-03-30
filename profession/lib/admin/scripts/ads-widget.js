(function ($) {

    $(document).ready(function () {

        $('.advertisement_count').each(function () {
            var $cnt = $(this),
                $widget = $cnt.parent().parent();

            $cnt.change(function () {
                var cnt = parseInt($cnt.val(), 10);

                if (isNaN(cnt)) return;

                cnt = Math.abs(cnt);

                if (cnt < 1)
                    cnt = 1;

                if (cnt > 10)
                    cnt = 10;

                $cnt.val(cnt);

                var $ads = $widget.find('.advertisement_wrap .ad');
                $ads.hide();


                for (i = 0; i < cnt; i++) {
                    $ads.eq(i).show();
                }
            });

        });


    });

})(jQuery);