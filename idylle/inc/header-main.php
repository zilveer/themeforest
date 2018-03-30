

<?php 
    $idy_flowers = "red";
    $idy_rounds = "";
    if( function_exists('fw_get_db_settings_option') ) {  
?>

<?php 
    if(fw_get_db_settings_option('flowers')=='fl1') {
        $idy_flowers = "red";
    }
    if(fw_get_db_settings_option('flowers')=='fl2') {
        $idy_flowers = "yellow";
    }
    if(fw_get_db_settings_option('flowers')=='fl3') {
        $idy_flowers = "blue";
    }

    if(fw_get_db_settings_option('rounds')=='r1') {
        $idy_rounds = "r1";
    }
    if(fw_get_db_settings_option('rounds')=='r2') {
        $idy_rounds = "r2";
    }
?>

<?php  if(!fw_get_db_settings_option('petals')=='1') { ?>

<?php  if(fw_get_db_settings_option('flowers')=='fl1' || fw_get_db_settings_option('flowers')=='fl2' || fw_get_db_settings_option('flowers')=='fl3') {  ?>
<div class="idy_flowers">
    <div class="idy_fl_1 idy_fl" data-0="top:250px" data-500="top:600px" data-1200="top:1200px" data-3000="top:3500px" data-4500="top:4500px" data-6500="top:6800px" data-8000="top:9800px">
        <img src="<?php echo esc_url(get_home_url('/')); ?>/wp-content/themes/idylle/images/flowers/<?php echo esc_html($idy_flowers); ?>/fl11.png" alt="">
    </div>
    <div class="idy_fl_2 idy_fl" data-0="top:200px" data-500="top:800px" data-1200="top:1200px" data-3000="top:2600px" data-4500="top:4900px" data-6500="top:6900px" data-8000="top:8900px">
        <img src="<?php echo esc_url(get_home_url('/')); ?>/wp-content/themes/idylle/images/flowers/<?php echo esc_html($idy_flowers); ?>/fl12.png" alt="">
    </div>
    <div class="idy_fl_3 idy_fl" data-0="top:200px" data-500="top:1300px" data-1200="top:1600px" data-3000="top:3800px" data-4500="top:4500px" data-6500="top:7000px" data-8000="top:6700px">
        <img src="<?php echo esc_url(get_home_url('/')); ?>/wp-content/themes/idylle/images/flowers/<?php echo esc_html($idy_flowers); ?>/fl3.png" alt="">
    </div>
    <div class="idy_fl_4 idy_fl" data-0="top:440px" data-500="top:600px" data-1200="top:600px" data-3000="top:3900px" data-4500="top:4900px" data-6500="top:6000px" data-8000="top:8200px">
        <img src="<?php echo esc_url(get_home_url('/')); ?>/wp-content/themes/idylle/images/flowers/<?php echo esc_html($idy_flowers); ?>/fl4.png" alt="">
    </div>
    <div class="idy_fl_5 idy_fl" data-0="top:40px" data-500="top:100px" data-1200="top:1200px" data-3000="top:3200px" data-4500="top:4100px" data-6500="top:6100px" data-8000="top:9100px">
        <img src="<?php echo esc_url(get_home_url('/')); ?>/wp-content/themes/idylle/images/flowers/<?php echo esc_html($idy_flowers); ?>/fl5.png" alt="">
    </div>
    <div class="idy_fl_6 idy_fl" data-0="top:350px" data-500="top:520px" data-1200="top:1220px" data-3000="top:3220px" data-4500="top:4130px" data-6500="top:6130px" data-8000="top:9150px">
        <img src="<?php echo esc_url(get_home_url('/')); ?>/wp-content/themes/idylle/images/flowers/<?php echo esc_html($idy_flowers); ?>/fl6.png" alt="">
    </div>
    <div class="idy_fl_7 idy_fl" data-0="top:250px" data-500="top:590px" data-1200="top:1300px" data-3000="top:3300px" data-4500="top:4200px" data-6500="top:6300px" data-8000="top:9600px">
        <img src="<?php echo esc_url(get_home_url('/')); ?>/wp-content/themes/idylle/images/flowers/<?php echo esc_html($idy_flowers); ?>/fl7.png" alt="">
    </div>

    <div class="idy_fl_8 idy_fl" data-0="top:150px" data-500="top:300px" data-1200="top:1200px" data-3000="top:3500px" data-4500="top:4100px" data-6500="top:6700px" data-8000="top:12700px">
        <img src="<?php echo esc_url(get_home_url('/')); ?>/wp-content/themes/idylle/images/flowers/<?php echo esc_html($idy_flowers); ?>/fl8.png" alt="">
    </div>
    <div class="idy_fl_9 idy_fl" data-0="top:100px" data-500="top:300px" data-1200="top:1200px" data-3000="top:3050px" data-4500="top:4100px" data-6500="top:6800px" data-8000="top:8700px">
        <img src="<?php echo esc_url(get_home_url('/')); ?>/wp-content/themes/idylle/images/flowers/<?php echo esc_html($idy_flowers); ?>/fl9.png" alt="">
    </div>
    <div class="idy_fl_10 idy_fl" data-0="top:100px" data-500="top:150px" data-1200="top:1200px" data-3000="top:3100px" data-4500="top:4900px" data-6500="top:6100px" data-8000="top:9800px">
        <img src="<?php echo esc_url(get_home_url('/')); ?>/wp-content/themes/idylle/images/flowers/<?php echo esc_html($idy_flowers); ?>/fl10.png" alt="">
    </div>

    <div class="idy_fl_13 idy_fl" data-0="top:0px" data-500="top:730px" data-1200="top:1200px" data-3000="top:2800px" data-4500="top:4500px" data-6500="top:6200px" data-8000="top:6500px">
        <img src="<?php echo esc_url(get_home_url('/')); ?>/wp-content/themes/idylle/images/flowers/<?php echo esc_html($idy_flowers); ?>/fl13.png" alt="">
    </div>
    <div class="idy_fl_14 idy_fl" data-0="top:120px" data-500="top:720px" data-1200="top:1200px" data-3000="top:3000px" data-4500="top:5000px" data-6500="top:6400px" data-8000="top:7000px">
        <img src="<?php echo esc_url(get_home_url('/')); ?>/wp-content/themes/idylle/images/flowers/<?php echo esc_html($idy_flowers); ?>/fl14.png" alt="">
    </div>
    <div class="idy_fl_15 idy_fl" data-0="top:120px" data-500="top:1000px" data-1200="top:1200px" data-3000="top:3800px" data-4500="top:4900px" data-6500="top:6100px" data-8000="top:7200px">
        <img src="<?php echo esc_url(get_home_url('/')); ?>/wp-content/themes/idylle/images/flowers/<?php echo esc_html($idy_flowers); ?>/fl15.png" alt="">
    </div>
    <div class="idy_fl_16 idy_fl" data-0="top:240px" data-500="top:400px" data-1200="top:1200px" data-3000="top:3100px" data-4500="top:4500px" data-6500="top:5900px" data-8000="top:6700px">
        <img src="<?php echo esc_url(get_home_url('/')); ?>/wp-content/themes/idylle/images/flowers/<?php echo esc_html($idy_flowers); ?>/fl8.png" alt="">
    </div>
    <div class="idy_fl_17 idy_fl" data-0="top:180px" data-500="top:200px" data-1200="top:1200px" data-3000="top:3500px" data-4500="top:4500px" data-6500="top:5600px" data-8000="top:9300px">
        <img src="<?php echo esc_url(get_home_url('/')); ?>/wp-content/themes/idylle/images/flowers/<?php echo esc_html($idy_flowers); ?>/fl11.png" alt="">
    </div>
    <div class="idy_fl_18 idy_fl" data-0="top:380px" data-500="top:1000px" data-1200="top:1200px" data-3000="top:3000px" data-4500="top:3800px" data-6500="top:6100px" data-8000="top:8500px">
        <img src="<?php echo esc_url(get_home_url('/')); ?>/wp-content/themes/idylle/images/flowers/<?php echo esc_html($idy_flowers); ?>/fl5.png" alt="">
    </div>
    <div class="idy_fl_19 idy_fl" data-0="top:370px" data-500="top:600px" data-1200="top:700px" data-3000="top:3000px" data-4500="top:5200px" data-6500="top:6700px" data-8000="top:7100px">
        <img src="<?php echo esc_url(get_home_url('/')); ?>/wp-content/themes/idylle/images/flowers/<?php echo esc_html($idy_flowers); ?>/fl9.png" alt="">
    </div>
    <div class="idy_fl_20 idy_fl" data-0="top:30px" data-500="top:740px" data-1200="top:1200px" data-3000="top:3700px" data-4500="top:4100px" data-6500="top:6800px" data-8000="top:5000px">
        <img src="<?php echo esc_url(get_home_url('/')); ?>/wp-content/themes/idylle/images/flowers/<?php echo esc_html($idy_flowers); ?>/fl15.png" alt="">
    </div>

    
    
    
</div>
<?php } ?>
<?php } ?>

<?php }else { ?>

<?php if( function_exists('fw_get_db_settings_option') ) {  ?>
<?php  if(!fw_get_db_settings_option('petals')=='1') { ?>
<div class="idy_flowers">
    <div class="idy_fl_1 idy_fl" data-0="top:250px" data-500="top:240px">
        <img src="<?php echo esc_url(get_home_url('/')); ?>/wp-content/themes/idylle/images/flowers/<?php echo esc_html($idy_flowers); ?>/fl11.png" alt="">
    </div>
   
    <div class="idy_fl_14 idy_fl" data-0="top:120px" data-500="top:140px" >
        <img src="<?php echo esc_url(get_home_url('/')); ?>/wp-content/themes/idylle/images/flowers/<?php echo esc_html($idy_flowers); ?>/fl14.png" alt="">
    </div>
    <div class="idy_fl_15 idy_fl" data-0="top:120px" data-500="top:140px">
        <img src="<?php echo esc_url(get_home_url('/')); ?>/wp-content/themes/idylle/images/flowers/<?php echo esc_html($idy_flowers); ?>/fl15.png" alt="">
    </div>
    <div class="idy_fl_20 idy_fl" data-0="top:30px" data-500="top:50px">
        <img src="<?php echo esc_url(get_home_url('/')); ?>/wp-content/themes/idylle/images/flowers/<?php echo esc_html($idy_flowers); ?>/fl15.png" alt="">
    </div>


    <div class="idy_fl_10 idy_fl" data-0="top:100px" data-500="top:140px">
        <img src="<?php echo esc_url(get_home_url('/')); ?>/wp-content/themes/idylle/images/flowers/<?php echo esc_html($idy_flowers); ?>/fl10.png" alt="">
    </div>
</div>
<?php } ?>

<?php } ?>
<?php } ?>

<?php if( function_exists('fw_get_db_settings_option') ) {  ?>

    <?php if (fw_get_db_settings_option('music')=='1'): ?>
    <div class="idy_music_ico">
        <i class="ti ti-music"></i>
        <div class="idy_music_container">
            <?php echo (fw_get_db_settings_option('music_share')); ?>
        </div>
    </div>
    <?php endif ?>

<?php } ?>

<!-- Page -->
<div id="idy_page" class="<?php echo esc_html("idy_page_fl_".$idy_flowers); ?> <?php echo esc_html("idy_page_rounds_".$idy_rounds); ?>">
<div class="idy_page">

<!-- Preloader -->
<?php if( function_exists('fw_get_db_settings_option') ) {  ?>


    <?php if(fw_get_db_settings_option('preloader')=='pr1') { ?>
    <div class="idy_preloader">
         <div class="idy_heart">
           <i class="ti ti-heart"></i>
        </div>
    </div>
    <?php } ?>

    <?php if(fw_get_db_settings_option('preloader')=='pr2') { ?>
    <div class="idy_preloader">
        <div class="idy_heart idy_heart_l">
           <span><b><?php echo fw_get_db_settings_option('preloader_groom'); ?></b></span>
        </div>
        <div class="idy_heart idy_heart_r">
           <span><b><?php echo fw_get_db_settings_option('preloader_bride'); ?></b></span>
        </div>
    </div>
    <?php } ?>

<?php } ?>
<!-- Preloader End -->

<div class="idy_header_menu">

<div class="idy_mobile_menu">
    <span class="idy_line idy_line1"></span>
    <span class="idy_line idy_line2"></span>
    <span class="idy_line idy_line3"></span>
</div>
<div class="idy_mobile_menu_bg1"></div>
<div class="idy_mobile_menu_bg2"></div>
<div class="idy_mobile_menu_bg3"></div>
<div class="idy_mobile_menu_bg4"></div>

<div class="idy_mobile_menu_content">

    <div class="mobile_menu_header">
        <h2><a href="<?php echo esc_url( get_home_url('/')); ?>"><?php bloginfo('name'); ?></a></h2>
        <div class="idy_subtitle"><?php bloginfo('description'); ?></div> 
    </div>
    <?php wp_nav_menu( array( 'theme_location' => 'primary') ); ?>
</div>


</div>