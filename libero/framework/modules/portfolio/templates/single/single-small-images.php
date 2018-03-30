<div class="mkd-two-columns-75-25 clearfix">
    <div class="mkd-column1">
        <div class="mkd-column-inner">
            <?php
            $media = libero_mikado_get_portfolio_single_media();

            if(is_array($media) && count($media)) : ?>
                <div class="mkd-portfolio-media">
                    <?php foreach($media as $single_media) : ?>
                        <div class="mkd-portfolio-single-media">
                            <?php libero_mikado_portfolio_get_media_html($single_media); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="mkd-column2">
        <div class="mkd-column-inner">
            <div class="mkd-portfolio-info-holder">

                <div class="mkd-toolbar-holder">
                    <?php libero_mikado_portfolio_get_info_part('social'); ?>
                    <?php libero_mikado_portfolio_get_info_part('print'); ?>
                    <?php libero_mikado_portfolio_get_info_part('like'); ?>
                </div>

                <?php
                //get portfolio content section
                libero_mikado_portfolio_get_info_part('content'); ?>

                <?php
                //get portfolio date section
                libero_mikado_portfolio_get_info_part('date');

                //get portfolio categories section
                libero_mikado_portfolio_get_info_part('categories');

                //get portfolio tags section
                libero_mikado_portfolio_get_info_part('tags');

                //get portfolio custom fields section
                libero_mikado_portfolio_get_info_part('custom-fields');

                ?>
            </div>
        </div>
    </div>
</div>