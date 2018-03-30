<?php get_header(); ?>

<div class="nicdark_space160"></div>

<section class="nicdark_section">
    <div class="nicdark_container nicdark_clearfix">
        <div class="grid grid_12">

            <?php $nicdark_404_message = __('Oops 404, That page can not be found','weddingindustry'); ?>
            
            <div class="nicdark_alerts nicdark_bg_green ">
                <p class="white nicdark_size_big"><i class="icon-cancel-circled-outline iconclose"></i>&nbsp;&nbsp;&nbsp;<strong>404:</strong>&nbsp;&nbsp;&nbsp;<?php echo esc_attr($nicdark_404_message); ?></p>
            </div>
                 
        </div>    
    </div>
</section>

<div class="nicdark_space50"></div>

<?php get_footer(); ?>