<div class="mkdf-tabs-content">
    <div class="tab-content">
        <div class="tab-pane fade<?php if ($page->slug == $tab) echo " in active"; ?>">
            <div class="mkdf-tab-content">
                <div class="mkdf-page-title-holder clearfix">
                    <h2 class="mkdf-page-title"><?php echo esc_html($page->title); ?></h2>

                    <?php
                    if($showAnchors) {
                        $this->getAnchors($page);
                    }
                    ?>
                </div>

                <form method="post" class="mkd_ajax_form">
                    <div class="mkdf-page-form">

                        <?php $page->render(); ?>
                    </div>
                </form>

            </div><!-- close mkdf-tab-content -->
        </div>
    </div>
</div> <!-- close div.mkdf-tabs-content -->