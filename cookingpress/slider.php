<?php if(ot_get_option('pp_slider_on') == 'on') { ?>
    <div class="container">
        <?php
        $slider = new CP_Slider;
        $slider->getCPslider(ot_get_option('pp_slider_select'));
        ?>
    </div>
    <div class="container"><div class="row"><div id="slider-shadow"></div></div></div>
<?php } ?>