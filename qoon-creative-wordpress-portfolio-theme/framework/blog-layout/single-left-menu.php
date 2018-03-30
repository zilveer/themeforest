<div class="oi_page_holder">
	<?php echo qoon_breadcrumbs()?>
    <div class="row">
        <div class="col-md-12">
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <?php $format = get_post_format(); get_template_part( 'framework/post-format/single', $format );   ?>
            <div class="clearfix"></div>
            <?php if ( comments_open() ) { ?>
            <div class="single_post_bottom_sidebar_holder">
                <?php comments_template(); ?>
            </div>
            <?php }?>
            <?php endwhile; endif; ?>
        </div>
    </div>
</div>