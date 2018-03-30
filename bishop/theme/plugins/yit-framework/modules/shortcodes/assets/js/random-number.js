/**
 * This file belongs to the YIT Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

jQuery(document).ready(function ($) {
    if ( YIT_Browser.isMobile() ) return;

    $('.counter .number').waypoint(
        function(){
            var actual_number = $(this);
            var animate = actual_number.data('animate');

            if (animate) {
                var start_number = parseInt(actual_number.data('animationstart'));
                var end_number = parseInt(actual_number.html());
                var animation_step = actual_number.data('animationstep');
                var animation_duration = actual_number.data('animationduration');

                var number_to_replace = actual_number.html();
                actual_number.html(number_to_replace.replace(parseInt(number_to_replace), start_number));

                if (( start_number != '' || start_number == 0 ) && ( end_number != '' || end_number == 0 ) && ( start_number < end_number )) {
                    var time_to_increment = animation_duration / ( ( end_number - start_number ) / animation_step );
                    var number = start_number + animation_step;
                    var intId = setInterval(function () {
                        var number_to_replace = actual_number.html();
                        actual_number.html(number_to_replace.replace(parseInt(number_to_replace), number));
                        number += animation_step;
                        if (number > end_number) {
                            clearInterval(intId);
                            actual_number.html(number_to_replace.replace(parseInt(number_to_replace), end_number));
                            actual_number.find('.percent').addClass('yit_animate animated fadeInDown').css('visibility', 'visible');
                            actual_number.next('.text').addClass('yit_animate animated fadeInUp').css('visibility', 'visible');
                        }
                    }, time_to_increment);
                }
            }
        },
        {
            'continuous': true,
            'triggerOnce': true,
            'offset': '95%'
        }
    );
});