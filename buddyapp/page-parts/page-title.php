<?php
/* Don't show the page title if is set to off */
if ( ! sq_option( 'page_title_enable', true, true ) ) {
    return false;
}

?>

<!-- Page Title
============================================= -->
<section id="page-title" <?php kleo_page_title_class(); ?>>

    <div class="<?php echo Kleo::get_config( 'container_class' );?> clearfix">

        <?php
        /**
         * Included Page title, tag-line and breadcrumb using actions
         * Added hooks:
         *
         * @hooked kleo_show_title - 12 (function found in lib/components/base.php )
         * @hooked kleo_show_title_tagline - 14 (function found in lib/components/base.php )
         * @hooked kleo_show_breadcrumb - 16 (function found in lib/components/base.php )
         */

        do_action( 'kleo_page_title_section' );
        ?>

    </div>

</section><!-- #page-title end -->