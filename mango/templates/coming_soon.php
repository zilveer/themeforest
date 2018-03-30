<?php
/**
 * Template Name: Coming Soon
*/

get_template_part('header/head');
global $mango_settings,$post,$wp_query;
$page_id = $wp_query->post->ID;
$coming_soon_version = (get_post_meta($page_id, "mango_coming_soon_page_version",true))?get_post_meta($page_id, "mango_coming_soon_page_version",true):"1";
$coming_soon_time = (get_post_meta($page_id, "mango_coming_soon_datetime",true))?get_post_meta($page_id, "mango_coming_soon_datetime",true):"";
$date_time = explode(" ",$coming_soon_time);
$coming_soon_content = (get_post_meta($page_id, "mango_coming_soon_after_timer",true))?get_post_meta($page_id, "mango_coming_soon_after_timer",true):"";

$full_date = explode("-",$date_time[0]);
$full_time = explode(":",$date_time[1]);
the_post();
$year   = $full_date[0];
$month  = $full_date[1]-1;
$day    = $full_date[2];
$hour   = $full_time[0];
$minute = $full_time[1];
?>

<!-- coming soon v1-->
<section id="coming-soon" role="main" class="<?php echo ($coming_soon_version==1)?"coming-soonbg":"simple"; ?>">
    <h1 class="logo text-center">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo get_bloginfo("description"); ?>">
            <img src="<?php echo esc_url(mango_get_logo_url()) ?>" alt="<?php bloginfo("title") ?>">
        </a>
    </h1>

    <div class="vcenter-container">
        <div class="vcenter">
            <?php if($coming_soon_version==2){?>
            <div id="coming-soon-wrapper">
            <?php } ?>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2><?php the_title() ?></h2>
                        <?php the_content(); ?>
                        <div id="countdown" class="clearfix"></div>
						<?php echo do_shortcode( $coming_soon_content ); ?>
                    </div><!-- End .col-md-12 -->
                </div><!-- End .row -->
            </div><!-- End ._cocontainer -->
        <?php if($coming_soon_version==2){?>
            </div>
        <?php } ?>
        </div><!-- End .vcenter --> 
    </div><!-- End .vcenter-container -->

    <footer class="<?php echo ($coming_soon_version==2)?"dark":"light"; ?>"><?php echo force_balance_tags($mango_settings['mango_copyright']) ?></footer>
</section>


<!-- coming soon v2-->
<?php wp_footer(); ?>
<script>
    /* <![CDATA[ */
    (function ($) {
        // All your code here
        countDownDate = new Date(<?php echo esc_js($year).','.esc_js($month).','.esc_js($day).','.esc_js($hour).','.esc_js($minute); ?>);
        $('#countdown').countdown({until: countDownDate});
    })(jQuery);
    /* ]]> */
</script>

<?php if ( isset( $mango_settings[ 'mango_jscode' ] ) && $mango_settings[ 'mango_jscode' ] ) : ?>
    <script type="text/javascript">
        /* <![CDATA[ */
        <?php echo $mango_settings['mango_jscode']; ?>
        /* ]]> */
    </script>
<?php endif ?> 
</body>
</html>