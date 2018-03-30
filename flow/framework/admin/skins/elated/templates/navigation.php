<div class="eltd-tabs-navigation-wrapper">
    <ul class="nav nav-tabs">
        <?php
        foreach (flow_elated_options()->adminPages as $key => $page ) {
            $slug = "";
            if (!empty($page->slug)) $slug = "_tab".$page->slug;
            ?>
            <li<?php if ($page->slug == $tab) echo " class=\"active\""; ?>>
                <a href="<?php echo esc_url(get_admin_url().'admin.php?page=flow_elated_theme_menu'.$slug); ?>">
                    <?php if($page->icon !== '') { ?>
                        <i class="<?php echo esc_attr($page->icon); ?> eltd-tooltip eltd-inline-tooltip left" data-placement="top" data-toggle="tooltip" title="<?php echo esc_attr($page->title); ?>"></i>
                    <?php } ?>
                    <span><?php echo esc_html($page->title); ?></span>
                </a>
            </li>
        <?php
        }
        ?>
        <li <?php if($is_import_page) { echo "class='active'"; } ?>>
            <a href="<?php echo esc_url(get_admin_url().'admin.php?page=flow_elated_theme_menu_tabimport'); ?>">
                <i class="fa fa-download eltd-tooltip eltd-inline-tooltip left" data-placement="top" data-toggle="tooltip" title="Import"></i>
                <span>Import</span>
            </a>
        </li>
    </ul>
</div> <!-- close div.eltd-tabs-navigation-wrapper -->