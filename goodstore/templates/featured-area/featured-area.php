<?php if (jwOpt::get_option('blog_featured_source', 'jaw-slider') == "jaw-slider") { ?>
    <?php
        $builder_section_class = '';
        $row_class = '';
        if (jwOpt::get_option('jawslider_full_type', 'off') == "on") {
            $builder_section_class = 'row-fullwidth';
            $row_class = 'fullwidth-block';
        } else if (jwOpt::get_option('jawslider_full_type', 'off') == "full") {
            $builder_section_class = 'row-fullwidth-item';
        } else {
            $row_class = 'featured-area-slider';
        }
    ?>
    <div id="featured-area" class="builder-section <?php echo $builder_section_class; ?> <?php echo implode(' ', jwLayout::content_width()); ?> el-slider" role="">
        <div class="<?php echo $row_class; ?> row">
            <div class="builder-section col-lg-12 ">
                <?php
                echo jaw_get_template_part('slider-area', array('featured-area', 'slider-area'));
                ?>
            </div>
        </div>
    </div>
<?php } else if (jwOpt::get_option('blog_featured_source', 'revo-slider') == "revo-slider") { ?>
    <div id="featured-area" class="<?php echo implode(' ', jwLayout::content_width()); ?> " role="main">
        <div class="row">
            <div class="builder-section col-lg-12 ">
                <?php
                echo jaw_get_template_part('slider-area', array('featured-area', 'slider-area'));
                ?>
            </div>
        </div>
    </div> 
<?php } else { ?>
    <div id="featured-area" class="<?php echo implode(' ', jwLayout::content_width()); ?> " role="main">
        <div class="row">
            <div class="builder-section col-lg-12 ">
                <?php
                echo jaw_get_template_part('slider-area', array('featured-area', 'slider-area'));
                ?>
            </div>
        </div>
    </div>     
<?php
} 

