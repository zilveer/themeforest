<div class="eltd-tabs-content">
    <div class="tab-content">

        <div class="tab-pane fade in active">
            <div class="eltd-tab-content">
                <h2 class="eltd-page-title"><?php echo esc_html($page->title); ?></h2>


                <form method="post" class="eltd_ajax_form">
                    <div class="eltd-page-form">

                        <?php $page->render(); ?>
                    </div>
                </form>

            </div><!-- close eltd-tab-content -->
        </div>

    </div>
</div> <!-- close div.eltd-tabs-content -->