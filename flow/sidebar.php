<?php
$sidebar = flow_elated_get_sidebar();
?>
<div class="eltd-column-inner">
    <aside class="eltd-sidebar">
        <?php
            if (is_active_sidebar($sidebar)) {
                dynamic_sidebar($sidebar);
            }
        ?>
    </aside>
</div>
