<?php
/*
    Template Name: Page Full Width
*/
get_header();
the_post();
get_template_part( 'includes/title' );
?>
<section class="contact-page">
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="white-block">
                    <?php 
                    if( has_post_thumbnail() ){
                        the_post_thumbnail( 'post-thumbnail' );
                    }
                    ?>

                    <div class="white-block-content">
                        <div class="page-content clearfix">
                            <?php the_content() ?>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
<?php get_footer(); ?>