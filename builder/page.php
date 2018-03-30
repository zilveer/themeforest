<?php get_header(); global $oi_options; ?>
<div class="oi_vc_page_holder oi_default_page">
	<?php  if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    	<div class="container">
            <?php the_content();  ?>
            <div class="clearfix"></div>
			<?php if ($oi_options['oi_page_comments'] == 'yes') {?>
            <?php if ( comments_open() ) { ?>
                <div class="single_post_bottom_sidebar_holder">
                <?php comments_template(); ?>
                </div>
        <?php };};?>
        </div>
    <?php endwhile; endif; ?>
</div>
<?php  get_footer(); ?>