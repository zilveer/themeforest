<?php
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>
<?php 
$options_ibuki = get_option('ibuki'); 
$header_type = $options_ibuki['header-type'];
$header_layout = $options_ibuki['header-container'];
$header_container = null;

if($header_type == 'header-normal' || $header_type == 'header-fixed' || $header_type == 'header-sticky' ) {
    $header_container = 'container';
} else {
    $header_container = 'container-fluid';
}
?>

<div id="content">
    <?php az_page_header($post->ID); ?>

    <section class="wrap_content">
        <div class="content-sidebar <?php echo $header_container; ?>">
            <div class="row default-padding">
                <div class="col-md-9 page-content entry-content-archives">
                    <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
                    <?php the_content(); ?>

                    <section class="widget widget_archives">
                        <div class="widget_title">
                            <h4><?php _e('Latest 30 Posts', AZ_THEME_NAME); ?></h4>
                        </div>
                       <ul><?php wp_get_archives('type=postbypost&limit=30&show_post_count=1'); ?></ul> 
                    </section>
                    
                    <section class="widget widget_archives">
                        <div class="widget_title">
                            <h4><?php _e('Archives by Month', AZ_THEME_NAME); ?></h4>
                        </div>
                       <ul><?php wp_get_archives('type=monthly&limit=12'); ?></ul> 
                    </section>
                    
                    <section class="widget widget_archives last">
                        <div class="widget_title">
                            <h4><?php _e('Archives by Subject', AZ_THEME_NAME); ?></h4>
                        </div>
                       <ul><?php wp_list_categories('title_li='); ?></ul> 
                    </section>
                    <?php endwhile; endif; ?>
                </div>
                <aside class="col-md-3 page-sidebar">
                    <?php get_sidebar(); ?>
                </aside>
            </div>
        </div>
    </section>
</div>
    
<?php get_footer(); ?>