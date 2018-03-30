<div class="qodef-big-image-holder">
    <?php
    $media = qode_startit_get_portfolio_single_media();

    if(is_array($media) && count($media)) : ?>
        <div class="qodef-portfolio-media">
            <?php foreach($media as $single_media) : ?>
                <div class="qodef-portfolio-single-media">
                    <?php qode_startit_portfolio_get_media_html($single_media); ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<div class="qodef-two-columns-75-25 clearfix">
    <div class="qodef-column1">
        <div class="qodef-column-inner">
            <h2><?php the_title(); ?></h2>
        </div>
    </div>
</div>
<div class="qodef-two-columns-75-25 clearfix">
    <div class="qodef-column1">
        <div class="qodef-column-inner">
            <div class="qodef-portfolio-content">
				<?php the_content(); ?>
			</div>
        </div>
    </div>
    <div class="qodef-column2">
        <div class="qodef-column-inner">
            <div class="qodef-portfolio-info-holder">
                <?php

                //get portfolio date section
                qode_startit_portfolio_get_info_part('date');

                //get portfolio categories section
                qode_startit_portfolio_get_info_part('categories');

                //get portfolio tags section
                qode_startit_portfolio_get_info_part('tags');

                //get portfolio custom fields section
                qode_startit_portfolio_get_info_part('custom-fields');

                //get portfolio share section
                qode_startit_portfolio_get_info_part('social');

                ?>
            </div>
        </div>
    </div>
</div>