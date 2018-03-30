<!--start before navigation-->
<div class="nicdark_section nicdark_bg_<?php echo $redux_demo['topheader_bgcolor']; ?> nicdark_displaynone_responsive">
    <div class="nicdark_container nicdark_clearfix">
        
        <div class="grid grid_6">
            <div class="nicdark_focus">
                <?php $topheader_left_content = $redux_demo['topheader_left_content']; ?>
                <?php echo $topheader_left_content; ?>
            </div>
        </div>
        <div class="grid grid_6 right">
            <div class="nicdark_focus right">
                <?php $topheader_right_content = $redux_demo['topheader_right_content']; ?>
                <?php echo $topheader_right_content; ?>  
            </div>
        </div>

    </div>
</div>
<!--end before navigation-->


<!--start pop up window-->
<?php if ($redux_demo['window_popup_display'] == 1) { ?>
<div id="nicdark_window_pop_up" class="nicdark_bg_greydark nicdark_window_popup zoom-anim-dialog mfp-hide">
     <?php $window_popup_content = $redux_demo['window_popup_content']; echo $window_popup_content; ?>  
</div>
<?php } else {}; ?>
<!--end pop up window-->





