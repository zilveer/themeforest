<?php get_header(); ?>

<!-- Start of page wrap -->
<div class="page_wrap">

    <?php if ( get_theme_mod( 'cr3ativ_conference_defaultimg' ) ) : ?>

    <?php $blogbgrnd = ( get_theme_mod( 'cr3ativ_conference_defaultimg' ) ); ?>

    <?php else : $blogbgrnd =  esc_url_raw( get_stylesheet_directory_uri() . '/img/default_image.jpg' ); ?>
            
    <?php endif; ?>

    <!-- Start of main image -->
    <div class="main_image" style="background: url('<?php echo $blogbgrnd; ?>') no-repeat scroll center center transparent; background-size:cover; height:684px; position:relative; z-index:1;">
        
        <!-- Start of button holder -->
        <div class="button_holder">
        <?php $topurl = ( get_theme_mod( 'cr3ativ_conference_url' ) ); ?>
            <?php $topurltext = ( get_theme_mod( 'cr3ativ_conference_url_text' ) ); ?>

            <?php if ($topurl != ('')){ ?>           

            <!-- Start of top of page button -->
            <div class="top_of_page_button">

                <a href="<?php echo ($topurl); ?>"><?php echo ($topurltext); ?></a>

            </div>
            <!-- End of top of page button -->

            <?php } ?>
        </div>
        <!-- End of button holder -->

        <!-- Start of main content title -->
        <div class="main_content_title">

            <?php global $wp_query;
            $term = $wp_query->get_queried_object();
            $title = $term->name; ?><h1 class="title"><?php echo $title; ?></h1>

        </div>
        <!-- End of main content title -->

    </div>
    <!-- End of main image -->

    <!-- Start of main content session -->
    <div class="main_content session">

    <?php
    add_filter('posts_orderby','cr3ativoderby2');
    $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
    $wp_query = new WP_Query(array(
    'post_type' => 'cr3ativconference',
    'cr3ativconfcategory'=>$term->slug,
    'posts_per_page' => 99999999,
    'order' => 'ASC',
    'meta_key' => 'cr3ativconfmeetingdate',

    'meta_query' => array(
    array(
    'key' => 'cr3ativconfmeetingdate',
    ),
    array(
    'key' => 'cr3ativ_confstarttime',
    ),
    ),
    )); 
    remove_filter('posts_orderby','cr3ativoderby2');

    $sessiondate = '';
    while (have_posts()) : the_post();

    ?>

    <?php 
    $cr3ativconfmeetingdate = get_post_meta($post->ID, 'cr3ativconfmeetingdate', $single = true); 
    $confstarttime = get_post_meta($post->ID, 'cr3ativ_confstarttime', $single = true);
    $confendtime = get_post_meta($post->ID, 'cr3ativ_confendtime', $single = true); 
    $conflocation = get_post_meta($post->ID, 'cr3ativ_conflocation', $single = true); 
    $cr3ativ_highlight = get_post_meta($post->ID, 'cr3ativ_highlight', $single = true); 
    $confdisplaystarttime = get_post_meta($post->ID, 'cr3ativ_confdisplaystarttime', $single = true);
    $confdisplayendtime = get_post_meta($post->ID, 'cr3ativ_confdisplayendtime', $single = true);
    ?>

    <?php $dateformat = get_option('date_format'); ?>

    <?php if ($sessiondate != (date_i18n($dateformat, $cr3ativconfmeetingdate))){ ?>

        <!-- Start of session index date -->
        <div class="session_index_date">

            <h1 class="conference_date"><?php echo date_i18n($dateformat, $cr3ativconfmeetingdate); ?></h1>

        </div>
        <!-- End of session index date -->

        <div class="clear"></div>

        <?php } ?>
        
        <?php if ($cr3ativ_highlight != ('')){ ?>

        <!-- Start of single session wrapper -->
        <div class="conference_wrapper highlight">

        <?php } else { ?>

        <!-- Start of single session wrapper -->
        <div class="conference_wrapper">

        <?php } ?>

            <!-- Start of conference meta -->
            <div class="conference_meta">

            <?php $sessiondate = date_i18n($dateformat, $cr3ativconfmeetingdate); ?>

                <h2 class="meeting_date"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e( 'Permanent Link to', 'cr3_attend_theme' ); ?>&nbsp; <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

                <div class="clearfix"></div>

                <!-- Start of conference location -->
                <div class="conference-location">

                    <?php if ($conflocation != ('')){ ?>
                    <?php echo stripslashes($conflocation); ?> 
                    <?php } ?>

                </div>
                <!-- End of conference location -->

            </div>
            <!-- End of conference meta -->

        <!-- Start of conference content -->
        <div class="conference_content">

            <hr />

            <div class="clear"></div>

            <!-- Start of conference time -->
            <div class="conference-time">

                <?php if ($confdisplaystarttime != ('')) { ?>

                <?php if ($confdisplaystarttime != ('')) { echo ($confdisplaystarttime); }
                if ($confdisplayendtime != ('')){ ?> &nbsp;-&nbsp; <?php echo ($confdisplayendtime); } ?>

                <?php } else { ?> 

                <?php if ($confstarttime != ('')){  echo ($confstarttime); }
                if ($confendtime != ('')){ ?> &nbsp;-&nbsp; <?php echo ($confendtime); } ?>

                <?php } ?>

            </div>
            <!-- End of conference time -->

            <!-- Start of session content -->
            <div class="session_content">

                <?php 
                global $more;    // Declare global $more (before the loop).
                $more = 0;       // Set (inside the loop) to display content above the more tag.
                the_content(__('More', 'cr3_attend_theme'));
                ?> 

            </div>
            <!-- End of session content -->

            <div class="clearfix"></div>

        </div>
        <!-- End of conference content -->

        <div class="clearfix"></div>

        </div>
        <!--End of conference wrapper -->

    <?php endwhile; ?>       

    </div>
    <!-- End of main content session -->

    <div class="clearfix"></div>

</div>
<!-- End of page wrap -->

<?php get_footer(); ?>