<?php get_header(); ?>
<?php
$category_ID                = get_query_var( 'cat' );
$category_blog_style        = get_tax_meta( $category_ID,'bd_blog_style') ;
?>

<?php if( $category_blog_style == 'blog-style-2' ){ ?>
    <?php $cols = "2cols" ?>

    <div class="bd-container blog-grid-layout loading" style="width: 89%; margin: auto">
        <div class="blog-v1">
            <?php if ( have_posts() ) { ?>
                <div class="page-title"><h2><?php single_cat_title(); ?></h2></div>
                <?php
                $term_description = term_description();
                if ( ! empty( $term_description ) ) {
                    printf( '<div class="taxonomy-description">%s</div>', $term_description );
                }
                ?>
            <?php } ?>
            <div class="posts-gird">
                <div id="container-grid" class="filterable-posts posts-gird-<?php echo $cols ?>" data-cols="<?php echo $cols ?>">
                    <?php

                    wp_enqueue_script( 'isotope' );
                    wp_enqueue_script( 'bd-isotope' );

                    $format = get_post_format();

                    if( false === $format ) { $format = 'standard'; }
                    get_template_part( 'loop-two', $format );
                    ?>
                </div>

                <?php
                echo '<div class="clear"></div>';
                bd_pagenavi($pages = '', $range = 2);
                ?>
            </div>
            <div id="loading" class="rotating-plane"></div>
        </div>
    </div>
<?php } elseif( $category_blog_style == 'blog-style-3' ){ ?>
    <?php $cols = "3cols" ?>

    <div class="bd-container blog-grid-layout loading" style="width: 89%; margin: auto">
        <div class="blog-v1">
            <?php if ( have_posts() ) { ?>
                <div class="page-title"><h2><?php single_cat_title(); ?></h2></div>
                <?php
                $term_description = term_description();
                if ( ! empty( $term_description ) ) {
                    printf( '<div class="taxonomy-description">%s</div>', $term_description );
                }
                ?>
            <?php } ?>
            <div class="posts-gird">
                <div id="container-grid" class="filterable-posts posts-gird-<?php echo $cols ?>" data-cols="<?php echo $cols ?>">
                    <?php

                    wp_enqueue_script( 'isotope' );
                    wp_enqueue_script( 'bd-isotope' );

                    $format = get_post_format();

                    if( false === $format ) { $format = 'standard'; }
                    get_template_part( 'loop-two', $format );
                    ?>
                </div>

                <?php
                echo '<div class="clear"></div>';
                bd_pagenavi($pages = '', $range = 2);
                ?>
            </div>
            <div id="loading" class="rotating-plane"></div>
        </div>
    </div>

<?php } elseif( $category_blog_style == 'blog-style-4' ){ ?>
    <?php $cols = "4cols" ?>

    <div class="bd-container blog-grid-layout loading" style="width: 89%; margin: auto">
        <div class="blog-v1">
            <?php if ( have_posts() ) { ?>
                <div class="page-title"><h2><?php single_cat_title(); ?></h2></div>
                <?php
                $term_description = term_description();
                if ( ! empty( $term_description ) ) {
                    printf( '<div class="taxonomy-description">%s</div>', $term_description );
                }
                ?>
            <?php } ?>
            <div class="posts-gird">
                <div id="container-grid" class="filterable-posts posts-gird-<?php echo $cols ?>" data-cols="<?php echo $cols ?>">
                    <?php

                    wp_enqueue_script( 'isotope' );
                    wp_enqueue_script( 'bd-isotope' );

                    $format = get_post_format();

                    if( false === $format ) { $format = 'standard'; }
                    get_template_part( 'loop-two', $format );
                    ?>
                </div>

                <?php
                echo '<div class="clear"></div>';
                bd_pagenavi($pages = '', $range = 2);
                ?>
            </div>
            <div id="loading" class="rotating-plane"></div>
        </div>
    </div>
<?php } else { ?>
    <div class="bd-container">
        <div class="bd-main">
            <?php if ( have_posts() ) { ?>
                <div>
                <div class="page-title"><h2><?php single_cat_title(); ?></h2></div>
                <?php
                $term_description = term_description();
                if ( ! empty( $term_description ) ) {
                    printf( '<div class="taxonomy-description">%s</div>', $term_description );
                }
                ?>
                </div>
            <?php } ?>
            <div class="blog-v1 blog-v">
                <div id="containn">
                    <?php
                    $format = get_post_format();
                    if( false === $format ) { $format = 'standard'; }
                    get_template_part( 'loop-two', $format );
                    ?>
                </div>
            </div><!-- .blog-v1-->
            <?php
            echo '<div class="clear"></div>';
            bd_pagenavi($pages = '', $range = 2);

            ?>
        </div><!-- .bd-main-->
        <?php get_sidebar(); ?>
    </div><!-- .bd-container -->
<?php } ?>

<?php get_footer(); ?>