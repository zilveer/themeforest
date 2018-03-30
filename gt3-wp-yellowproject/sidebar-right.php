<?php

global $gt3_pagebuilder;

if (isset($gt3_pagebuilder['settings']['layout-sidebars']) && $gt3_pagebuilder['settings']['layout-sidebars'] == "right-sidebar") {
echo "    <div class='right-sidebar-block span3'>
            <aside class='sidebar'>";
              dynamic_sidebar( $gt3_pagebuilder['settings']['right-sidebar'] );
    echo "  </aside>
          </div>
    ";
}

?>