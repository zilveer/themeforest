<?php

get_header();

?>

<section id="main_content">

    <div class="container">

        <?php learn_breadcrumbs(); ?>

        <div class="row">

            <aside class="col-md-4">
                <?php get_sidebar();?>
            </aside>

            <div class="col-md-8">

                <?php 
                
                    if(have_posts()) : 
                        
                    while (have_posts()): the_post();                        

                    get_template_part( 'content', get_post_format() ) ;

                    endwhile;?>

                    <?php else: ?>

                    <h1><?php esc_html_e('Nothing Found Here!', 'learn'); ?></h1>

                <?php endif ?>
                <div class="text-center">
                    <ul class="pagination">
                        <?php echo learn_pagination(); ?>
                    </ul>
                </div>

            </div>

        </div>

    </div>

</section>

<?php get_footer(); ?>