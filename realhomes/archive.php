<?php
get_header();

    /* Page Head */
    $banner_image_path = get_default_banner();

    $banner_title = __('Archives', 'framework');
    $banner_details = "";

    $post = $posts[0]; // Hack. Set $post so that the_date() works.
    if (is_category())
    {
        $banner_title = __('All Posts in Category', 'framework');
        $banner_details = single_cat_title('',false);
    }
    elseif( is_tag() )
    {
        $banner_title = __('All Posts in Tag', 'framework');
        $banner_details = single_tag_title('',false);
    }
    elseif (is_day())
    {
        $banner_title = __('Archives', 'framework');
        $banner_details = get_the_date();
    }
    elseif (is_month())
    {
        $banner_title = __('Archives', 'framework');
        $banner_details = get_the_date('F Y');
    }
    elseif (is_year())
    {
        $banner_title = __('Archives', 'framework');
        $banner_details = get_the_date('Y');
    }
    elseif (is_author())
    {
        $curauth = $wp_query->get_queried_object();
        $banner_title = __('All Posts By', 'framework');
        $banner_details = $curauth->display_name;
    }
    elseif (isset($_GET['paged']) && !empty($_GET['paged']))
    {
        $banner_title = __('Archives', 'framework');
        $banner_details = "";
    }
    ?>

    <div class="page-head" style="background-repeat: no-repeat;background-position: center top;background-image: url('<?php echo $banner_image_path; ?>'); ">
        <div class="container">
            <div class="wrap clearfix">
                <h1 class="page-title"><span><?php echo $banner_title; ?></span></h1>
                <?php if(!empty($banner_details)){ ?>
                <p><?php echo $banner_details; ?></p>
                <?php } ?>
            </div>
        </div>
    </div><!-- End Page Head -->

    <!-- Content -->
    <div class="container contents blog-page">
        <div class="row">
            <div class="span9 main-wrap">
                <!-- Main Content -->
                <div class="main">

                    <div class="inner-wrapper">
                        <?php  get_template_part("loop");  ?>
                    </div>

                </div><!-- End Main Content -->

            </div> <!-- End span9 -->

            <?php get_sidebar(); ?>

        </div><!-- End contents row -->
    </div><!-- End Content -->

<?php get_footer(); ?>