<?php
/**
 * Product loop course info
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

global $g5plus_show_archive_product_start_date,
       $g5plus_show_archive_product_duration, $g5plus_show_archive_product_teacher,$g5plus_show_archive_product_level ;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
$post_id = get_the_ID();
$start_date = $teacher = $duration = $level = '';
$start_date = $g5plus_show_archive_product_start_date =='1' ? get_post_meta($post_id, 'start', true ) : '';
$duration = $g5plus_show_archive_product_duration =='1' ? get_post_meta($post_id, 'duration', true ) : '';
$level = $g5plus_show_archive_product_level =='1' ? get_post_meta($post_id, 'level', true ) : '';

if($g5plus_show_archive_product_teacher=='1'){
    $teacher_meta = get_post_meta($post_id, 'teacher', true );
    if(isset($teacher_meta) && $teacher_meta!=''){
        $teacher_meta = explode(",",$teacher_meta);
        if(count($teacher_meta)>0){
            $teacher = get_post( $teacher_meta[0] ); //get_the_title($teacher_meta[0]);
        }
    }
}
?>
<div class="course-meta">
    <?php if($start_date != ''){ ?>
        <span class="pd-right-20">
            <i class="fa fa-clock-o p-color pd-right-5"></i><?php echo esc_html(date(get_option('date_format'), strtotime($start_date))) ?>
        </span>
    <?php } ?>
    <?php if($duration != ''){ ?>
        <span class="pd-right-20">
            <i class="fa fa-calendar s-color pd-right-5"></i><?php echo esc_html($duration) ?>
        </span>
    <?php } ?>
    <?php if($teacher !='' ){ ?>
        <span  class="pd-right-20">
            <i class="fa fa-user s-color pd-right-5"> </i> <a href="<?php echo get_permalink($teacher->ID) ?>"><?php echo esc_html($teacher->post_title) ?></a>
        </span>
    <?php } ?>
    <?php if($level != ''){ ?>
        <span  class="pd-right-20">
            <i class="fa fa-graduation-cap s-color pd-right-5"></i> <?php echo esc_html($level) ?>
        </span>
    <?php } ?>
</div>

<div class="excerpt">
    <?php the_excerpt() ?>
</div>
<div class="button-view-more">
    <a href="<?php the_permalink(); ?>" class="bt bt-md bt-bg bt-tertiary"><?php esc_html_e('Apply Now','g5plus-academia') ?></a>
</div>