<?php
/*
 * Primary sidebar
 */
global $smof_data;
?>
<?php if ($smof_data['pkb_subpages_nav'] == '1') { ?>

    <div class="submenu_container">
        <!--Sub pages nav begin-->
        <?php if ($post->post_parent) {
            $children = wp_list_pages("title_li&child_of=" . $post->post_parent . "&echo=0&link_before=<i class='icon-right-open-2 fonticon'></i>");
        } else {
            $children = wp_list_pages("title_li&child_of=" . $post->ID . "&echo=0&link_before=<i class='icon-right-open-2 fonticon'></i>");
        }
        if ($children) {
            ?>
            <ul class="submenu replace">
                <?php echo $children; ?>
            </ul>
        <?php } ?>
    </div>

<?php } ?>
    <!--Sub pages nav end-->

<?php dynamic_sidebar("primary-widget-area"); ?>