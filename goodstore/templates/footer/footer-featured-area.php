<div id="footer-featured-area" class="<?php echo implode(' ', jwLayout::content_width()); ?> " role="main">
    <div class="row">
        <div class="builder-section col-lg-12 ">
            <?php
            $pageid = jwOpt::get_option('blog_featured_type_pageid', 0);
            if ($pageid > 0  ) {
                echo do_shortcode('[jaw_page id="' . $pageid . '"]');
            }
            ?>
        </div>
    </div>
</div>     
