<?php
    // Banner Image
    $banner_image_path = get_default_banner();

    // Banner Title
    $current_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
    $banner_title = $current_term->name;

    // Banner Sub Title
    $banner_sub_title = $current_term->description;
    ?>

    <div class="page-head" style="background-repeat: no-repeat;background-position: center top;background-image: url('<?php echo $banner_image_path; ?>'); background-size: cover; ">
        <?php if(!('true' == get_option('theme_banner_titles'))): ?>
        <div class="container">
            <div class="wrap clearfix">
                <h1 class="page-title"><span><?php echo $banner_title; ?></span></h1>
                <?php
                if($banner_sub_title){
                  ?><p><?php echo $banner_sub_title; ?></p><?php
                }
                ?>
            </div>
        </div>
        <?php endif; ?>
    </div><!-- End Page Head -->