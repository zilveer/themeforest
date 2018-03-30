<div class="mkd-tabs-content">
    <div class="tab-content">
        <div class="tab-pane fade<?php if ($page->slug == $tab) echo " in active"; ?>">
            <div class="mkd-tab-content">
                <div class="mkd-page-title-holder clearfix">
                    <h2 class="mkd-page-title"><?php echo esc_html($page->title); ?></h2>

                    <?php
                    if($showAnchors) {
                        $this->getAnchors($page);
                    }
                    ?>
                </div>

                <form method="post" class="mkd_ajax_form">
                    <div class="mkd-page-form">

                        <?php $page->render(); ?>
                    </div>
                </form>

            </div><!-- close mkd-tab-content -->
        </div>
    </div>
</div> <!-- close div.mkd-tabs-content -->