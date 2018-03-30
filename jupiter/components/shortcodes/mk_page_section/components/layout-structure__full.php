<?php
if($view_params['layout_structure'] != 'full') return false;

$grid_layout = ($view_params['full_width'] == 'true') ? 'page-section-fullwidth' : 'mk-grid';

if ($view_params['section_layout'] == 'full') { ?>

        <div class="page-section-content vc_row-fluid <?php echo $grid_layout; ?>">
            <div class="mk-padding-wrapper"><?php echo wpb_js_remove_wpautop($view_params['content']); ?></div>
            <div class="clearboth"></div>
        </div>

<?php } else { ?>
    <div class="mk-main-wrapper-holder">
        <div class="theme-page-wrapper <?php echo $view_params['section_layout']; ?>-layout mk-grid vc_row-fluid page-section-content">
            
            <div class="theme-content">
                <?php echo wpb_js_remove_wpautop($view_params['content']); ?>
                <div class="clearboth"></div>
            </div>

            <aside id="mk-sidebar" class="mk-builtin">
                <div class="sidebar-wrapper" style="padding-top:0;padding-bottom:0;">
                    <?php dynamic_sidebar($view_params['sidebar']); ?>
                </div>
            </aside>

        </div>
    </div>

<?php }

