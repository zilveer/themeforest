<?php 

if( function_exists('fw_get_db_settings_option') ) {
/*Images*/
$background_parallax_image = fw_resize(fw_get_db_settings_option('idylle_slider_background_image/url'), '1900', '', true );
$background_inside_image = fw_resize(fw_get_db_settings_option('idylle_inside_header_image/url'), '1900', '', true );

/*Titles Parallax*/
$idylle_slider_parallax_title = fw_get_db_settings_option('idylle_slider_title');
$idylle_slider_parallax_date = fw_get_db_settings_option('idylle_slider_date');
$idylle_slider_parallax_names = fw_get_db_settings_option('idylle_slider_names');

/*Featured Image*/
if(fw_get_db_settings_option('idylle_inside_header_featured') == '1' && get_post_thumbnail_id($post->ID) > 0 ){
    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'idylle-slider-image' );
    $background_inside_image = $thumb['0']; 
}

}
    
?>
<?php if( function_exists('fw_get_db_settings_option') && is_front_page()) { ?>

<?php /*if slider*/ if( fw_get_db_settings_option('idy_switch')=="1" ) { ?>
<!--Intro-->
<section class="idy_intro" >

        <!-- 3d -->
        <div class="idy_intro_item">
                
                <!-- Background -->
                <div class="idy_intro_back">
                    <div class="idy_great_slider">
                    
                        <?php foreach (fw_get_db_settings_option('idylle_slider') as $slider)   :
                            $image = fw_resize( $slider['idylle_slider_background_image']['attachment_id'], '1400', '', true );
                        ?>
                            <div class="idy_intro_back_img idy_image_bck" data-image="<?php echo esc_attr($image); ?>"></div>
                        <?php endforeach; ?>
                    
                    </div>

                   
                </div>
                <!-- Background End -->
                

                <div class="idy_idy_rotated_all">
                    
                    <div class="idy_slider_round">
                        <div class="idy_slider_round_txt">
                            <?php echo esc_attr($idylle_slider_parallax_title); ?>
                            <b><?php echo esc_attr($idylle_slider_parallax_names); ?></b>
                            <?php echo esc_attr($idylle_slider_parallax_date); ?>
                        </div>
                        <div class="idy_slider_round_lines"></div>
                    </div>
                    
                    <!-- Scroll Down -->
                    <a href="#idy_main_section" class="idy_go idy_intro_scroll">
                        <span></span><br />
                        Scroll
                    </a>

                </div>
                
                


        </div>
        <!-- 3d End -->
        

    
</section>
<!-- Intro End -->

<?php /*if slider no*/}else{ ?>
<!--Intro-->
<section class="idy_intro" >

        <!-- 3d -->
        <div class="idy_intro_item">
                
                <!-- Background -->
                <div class="idy_intro_back">
                    
                    <?php if (fw_get_db_post_option(get_the_ID(), 'slider_switch_select/parallax/idylle_slider/over_display')=='1'): ?>
                    <!-- Over -->
                    <div class="idy_over" data-color="<?php echo fw_get_db_post_option(get_the_ID(), 'slider_switch_select/parallax/idylle_slider/over_color'); ?>" data-opacity="<?php echo fw_get_db_post_option(get_the_ID(), 'slider_switch_select/parallax/idylle_slider/over_opacity'); ?>"></div>
                    <?php endif ?>

                    <!-- Image -->
                    <div class="idy_intro_back_img idy_image_bck" data-stellar-background-ratio="0.4" data-image="<?php echo esc_attr($background_parallax_image); ?>"></div>
                </div>
                <!-- Background End -->
                

                <div class="idy_idy_rotated_all">
                    
                    <div class="idy_slider_round">
                        <div class="idy_slider_round_txt">
                            <?php echo esc_attr($idylle_slider_parallax_title); ?>
                            <b><?php echo esc_attr($idylle_slider_parallax_names); ?></b>
                            <?php echo esc_attr($idylle_slider_parallax_date); ?>
                        </div>
                        <div class="idy_slider_round_lines"></div>
                    </div>
                    
                    <!-- Scroll Down -->
                    <a href="#idy_main_section" class="idy_go idy_intro_scroll">
                        <span></span><br />
                        Scroll
                    </a>

                </div>
                
                


        </div>
        <!-- 3d End -->
        

    
</section>
<!-- Intro End -->
<?php } /*if slider*/?>

<?php } else { ?>

<!--Intro-->
<section class="idy_noslider idy_box idy_image_bck idy_white_txt idy_fixed" data-image="<?php echo esc_attr($background_inside_image); ?>">
<div class="container">
    <h1 data-0="opacity:1" data-top-bottom="opacity:0">
        <?php if(is_author()){
            printf( esc_html__( 'All posts by %s', 'idylle' ), get_the_author() );

        } else if(is_category()) {

            printf( esc_html__( 'Category: %s', 'idylle' ), single_cat_title( '', false ) );

        } else if(is_date()){

            if ( is_day() ) :
                printf( esc_html__( 'Daily Archives: %s', 'idylle' ), get_the_date() );

            elseif ( is_month() ) :
                printf( esc_html__( 'Monthly Archives: %s', 'idylle' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'idylle' ) ) );

            elseif ( is_year() ) :
                printf( esc_html__( 'Yearly Archives: %s', 'idylle' ), get_the_date( _x( 'Y', 'yearly archives date format', 'idylle' ) ) );

            else :
                _e( 'Archives', 'idylle' );

            endif;
        } else {
            wp_title("",true); 
        } ?>
    </h1>
    <div class="idy_breadcrumbs"><?php if( function_exists('fw_ext_breadcrumbs') ) { fw_ext_breadcrumbs('/'); } ?></div>
</div>        
</section>
<!-- Intro End -->
<?php } ?>
