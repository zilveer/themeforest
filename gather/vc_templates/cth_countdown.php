<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $year
 * @var $month
 * @var $date
 * @var $time
 * Shortcode class
 * @var $this WPBakeryShortCode_Cth_CountDown
 */
$el_class = $year = $month = $date = $time = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$countdown_data = trim($date).' '.trim($month) .' '.trim($year).' '. trim($time);
?>
<div class="countdown_wrap <?php echo esc_attr($el_class );?>">
    <?php echo wpb_js_remove_wpautop($content,true); ?>
    <!-- Countdown JS for the Event Date Starts here.
TIP: You can change your event time below in the Same Format.  -->
    <ul class="countdown" data-event-date="<?php echo esc_attr($countdown_data );?>">
        <li class="wow zoomIn" data-wow-delay="0s"> <span class="days">00</span>
            <p class="timeRefDays"><?php _e('days','gather');?></p>
        </li>
        <li class="wow zoomIn" data-wow-delay="0.2s"> <span class="hours">00</span>
            <p class="timeRefHours"><?php _e('hours','gather');?></p>
        </li>
        <li class="wow zoomIn" data-wow-delay="0.4s"> <span class="minutes">00</span>
            <p class="timeRefMinutes"><?php _e('minutes','gather');?></p>
        </li>
        <li class="wow zoomIn" data-wow-delay="0.6s"> <span class="seconds">00</span>
            <p class="timeRefSeconds"><?php _e('seconds','gather');?></p>
        </li>
    </ul>
</div>