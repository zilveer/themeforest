<?php

global $gt3_pagebuilder;

if (isset($gt3_pagebuilder['settings']['layout-sidebars']) && $gt3_pagebuilder['settings']['layout-sidebars'] == "left-sidebar") {
    echo "<div class='left-sidebar-block span3'>
            <aside class='sidebar'>";
                dynamic_sidebar( $gt3_pagebuilder['settings']['left-sidebar'] );
    echo "  </aside>
          </div>";
}

?>