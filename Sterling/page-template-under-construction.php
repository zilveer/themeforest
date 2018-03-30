<?php
/**
 * Template Name: Under Construction
 */

get_header(); ?>

<body id="construction-body" <?php body_class(); ?>>
    <?php
        global $ttso;
        $construction_main  = stripslashes( $ttso->st_construction_main );
        $construction_year  = $ttso->st_construction_year;
        $construction_month = $ttso->st_construction_month;
        $construction_day   = $ttso->st_construction_day;
    ?>

    <script type="text/javascript">
        year = <?php echo esc_js( $construction_year ); ?>; month = <?php echo esc_js( $construction_month ); ?>; day = <?php echo esc_js( $construction_day ); ?>; hour= 18; min= 0; sec= 0;
    </script>

    <div class="construction-top-wrap clearfix">
        <div class="center-wrap">
            <h1 class="construction-heading"><?php echo esc_html( $construction_main ); ?></h1>
            <div id="countbox"></div>

            <div class="time-info-wrap">
                <div id="days_text"><?php _e( 'Days', 'tt_theme_framework' ); ?></div>
                <div id="hours_text"><?php _e( 'Hours', 'tt_theme_framework' ); ?></div>
                <div id="mins_text"><?php _e( 'Minutes', 'tt_theme_framework' ); ?></div>
                <div id="secs_text"><?php _e( 'Seconds', 'tt_theme_framework' ); ?></div>
            </div><!-- end .time-info-wrap -->
        </div><!-- end .center-wrap -->
    </div><!-- end .construction-top-wrap -->

    <div class="construction-socialize">
        <?php dynamic_sidebar( 'Under Construction Socialize' ); ?>
    </div><!-- end .construction-socialize -->

<?php get_footer(); ?>