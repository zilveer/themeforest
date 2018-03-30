<?php

foreach (jwLayout::sidebars('') as $sidebar) {

    if (is_active_sidebar($sidebar->sidebar)) {
        ?>
        <aside id="<?php echo $sidebar->layout; ?>" class="<?php echo implode(' ', $sidebar->width); ?> sidebar" role="complementary"> <!-- Start Sidebar -->
            
            <div class="sidebar-box">

                <?php
                jwSidebars::render($sidebar->sidebar);
                ?>	 

            </div>
        </aside><!-- End Sidebar -->
    <?php }
} ?>


