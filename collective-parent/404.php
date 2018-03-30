<?php get_header(); ?>
<?php $sidebar_position = tfuse_sidebar_position(); ?>

<div id="middle" <?php tfuse_class('middle'); ?>>
    <div class="container">
        <div class="row">
            <?php tfuse_shortcode_content('before'); ?>
            <div <?php tfuse_class('content'); ?>>
                <div class="entry">
                    <div class="error_box clearfix">
                        <div class="box_inner">
                            <?php echo tfuse_options('text_404',''); ?>
                        </div>
                    </div><!-- /.error_box -->
                </div><!-- /.entry -->
            </div><!-- /.content -->

            <?php if (($sidebar_position == 'right') || ($sidebar_position == 'left')) : ?>
                <div class="sidebar span4 clearfix">
                    <?php get_sidebar(); ?>
                </div><!--/ .sidebar -->
            <?php endif; ?>
        </div><!--/ .row -->
    </div><!--/ .container -->
</div><!--/ .middle -->

<?php get_footer(); ?>