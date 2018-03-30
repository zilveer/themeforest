<?php 
get_header();
?>
<div class="properties">
    <div class="container">
        <div class="grid_full_width">
            <div class="row">
                <div class="col-md-8">
                    <?php get_template_part('templates/loop/' . $pgl_options->option('home_layout')) ?>
                </div>
                <?php get_sidebar() ?>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
?>