<?php
/**
 * Template Name: IDX Template
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 30/06/16
 * Time: 2:16 AM
 */
global $post;

$page_bg = $content_area = '';

$page_sidebar = get_post_meta( $post->ID, 'fave_page_sidebar', true );
$page_background = get_post_meta( $post->ID, 'fave_page_background', true );

if( $page_sidebar == 'none' ) {
    $content_area = 'col-lg-12 col-md-12 col-sm-12 col-xs-12';
} else if( $page_sidebar == 'left_sidebar' ) {

    $content_area = 'col-lg-8 col-md-8 col-sm-12 col-xs-12 list-grid-area container-contentbar';

} else if( $page_sidebar == 'right_sidebar' ) {
    $content_area = 'col-lg-8 col-md-8 col-sm-12 col-xs-12 container-contentbar';
} else {
    $content_area = 'col-lg-8 col-md-8 col-sm-12 col-xs-12 container-contentbar';
}

if( $page_background == 'none' && $page_sidebar == 'none' ) {
    $page_bg = 'no-padding-bg';
}
?>

<?php get_header(); ?>
<?php get_template_part( 'template-parts/page', 'title' ); ?>

    <section class="section-detail-content houzez-idx-template">

        <div class="row">
            <div class="<?php echo esc_attr( $content_area ); ?>">
                <div class="page-main">
                    <div class="white-block <?php echo esc_attr( $page_bg ); ?>">
                        <?php
                        // Start the loop.
                        while ( have_posts() ) : the_post();

                            the_content();

                            // End the loop.
                        endwhile;
                        ?>
                    </div>
                </div>
            </div>

            <?php if( $page_sidebar != 'none' ) { ?>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 container-sidebar">
                    <aside id="sidebar" class="sidebar-white">
                        <?php
                        if( is_active_sidebar( 'idx-sidebar' ) ) {
                            dynamic_sidebar( 'idx-sidebar' );
                        }
                        ?>
                    </aside>
                </div>
            <?php } ?>

        </div>

    </section>

<?php get_footer(); ?>