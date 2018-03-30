<?php /*** Portfolio Single Posts template. */ ?>

<?php
get_header(); 
$pageId = isset ($_SESSION['Evolution_page_id']) ? $_SESSION['Evolution_page_id'] : get_page_ID_by_page_template('portfolio-template.php');
$custom =  get_post_custom($pageId);
$layout = isset ($custom['_page_layout']) ? $custom['_page_layout'][0] : '1';
$alc_options = get_option('alc_general_settings');
$breadcrumbs = $alc_options['alc_show_breadcrumbs'];
$titles = $alc_options['alc_show_page_titles'];
$headline = get_post_meta($post->ID, "_headline", $single = false);?>
<div class="row">
    <div class="large-12 columns main-content-top">
        <div class="row">
            <div class="large-6 columns">
                <h2><?php the_title(); ?></h2>
            </div>        
            <div class="large-6 columns">
                <?php if(class_exists('the_breadcrumb')){ $albc = new the_breadcrumb; } ?>
            </div>
        </div>
    </div>
</div>
<div class="shadow"></div>
<div class="row ">
    <div class="large-12 columns">
        <div class="row">
            <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>	
                    <?php the_content();  ?>
            <div class="clear"></div>				
            <?php endwhile; ?>
	</div>
    </div>
</div>
<?php get_footer(); ?>
