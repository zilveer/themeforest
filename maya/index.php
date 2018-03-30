<?php
/**
 * @package WordPress
 * @subpackage Sheeva
 * @since 1.0
 */

get_header() ?>

<div id="primary" class="layout-<?php echo yiw_layout_page() ?>">
    <div class="inner group">
        <!-- START CONTENT -->
        <div id="content" class="group">
            <?php get_template_part('loop', 'index') ?>
        </div>
        <!-- END CONTENT -->

        <!-- START SIDEBAR -->
        <?php get_sidebar( 'blog' ) ?>
        <!-- END SIDEBAR -->
    </div>
</div>

<?php get_footer() ?>
