<?php
get_header();

get_template_part('template-parts/banner');
?>

<div class="page-top clearfix">
    <div class="container">
        <div class="row">
            <div class="<?php bc_all('12'); ?>">
                <?php $current_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); ?>
                <h1><?php echo $current_term->name; ?></h1>
                <nav class="bread-crumb">
                    <?php theme_breadcrumb(); ?>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="doctors-posts doctors-page clearfix">
    <div class="container">
        <div class="row">
            <?php
            if ( have_posts() ){

                /* decide appropriate bootstrap classes and appropriate thumbnail size */
                $bootstrap_classes = get_bc('4','4','6','');
                $thumbnail_size = 'gallery-post-single';
                $loop_counter = 0;
                while ( have_posts() ) {
                    the_post();
                    ?>
                    <div class="<?php echo $bootstrap_classes; ?>">
                        <article class="common-doctor clearfix hentry text-center">
                            <?php inspiry_standard_thumbnail($thumbnail_size); ?>
                            <div class="text-content">
                                <h5 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                                <div class="doctor-departments"><?php the_terms($post->ID, 'department', ' ', ', ', ' '); ?></div>
                                <div class="for-border"></div>
                                <p class="entry-summary"><?php inspiry_excerpt(12); ?></p>
                                <?php get_template_part('template-parts/doctor-social-icons'); ?>
                            </div>
                        </article>
                    </div>
                    <?php
                    $loop_counter++;
                    if( ($loop_counter % 3) == 0 ){
                        ?>
                        <div class="visible-md clearfix"></div>
                        <div class="visible-lg clearfix"></div>
                    <?php
                    } else if( ($loop_counter % 2) == 0 ){
                        ?>
                        <div class="visible-sm clearfix"></div>
                    <?php
                    }
                }
            } else {
                nothing_found(__('No doctor found!','framework'));
            }

            /* Restore original Post Data */
            wp_reset_query();
            ?>
        </div>
    </div>
</div>

<?php get_footer() ?>