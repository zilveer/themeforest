<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php
$today = getdate();
$today_minus_hour = getdate( time() - 60*60 );

$args_hour = array(
	'date_query' => array(
		array(
			'after'     => array(
				'year'  => $today_minus_hour["year"],
				'month' => $today_minus_hour["mon"],
				'day'   => $today_minus_hour["mday"],
				'hour'   => $today_minus_hour["hours"],
				'minute'   => $today_minus_hour["minutes"],
			),
			'before'    => array(
				'year'  => $today["year"],
				'month' => $today["mon"],
				'day'   => $today["mday"],
				'hour'   => $today["hours"],
				'minute'   => $today["minutes"],
			),
			'inclusive' => true,
		),
	),
	'post_type' => TMM_Ext_PostType_Car::$slug,
	'posts_per_page' => -1,
);

$query_per_hour = new WP_Query($args_hour);
$query_per_day = new WP_Query('year=' . $today["year"] . '&monthnum=' . $today["mon"] . '&day=' . $today["mday"] . '&post_type=' . TMM_Ext_PostType_Car::$slug);
$query_total = new WP_Query('post_type=' . TMM_Ext_PostType_Car::$slug);

$per_hour = $query_per_hour->found_posts;
$per_day = $query_per_day->found_posts;
$total = $query_total->found_posts;

wp_reset_postdata();
?>

<div class="widget widget_carcounter">
    <?php if ($instance['title'] != '') { ?>
        <h3 class="widget-title"><?php _e($instance['title'], 'cardealer'); ?></h3>
    <?php } ?>
    <ul class="list clearfix">
        <?php if ($instance['show_last_hour_cell']==true){
        ?>
            <li class="counter-cell-1"><span class="head"><?php _e('within hour', 'cardealer'); ?></span><span class="count"><?php echo $per_hour ?></span></li>
        <?php
        } ?>
        <?php 
        if ($instance['show_last_day_cell']){
        ?>
            <li class="counter-cell-2"><span class="head"><?php _e('within day', 'cardealer'); ?></span><span class="count"><?php echo $per_day ?></span></li>
        <?php
        }
        ?>
        <?php
        if ($instance['show_cars_total_cell']){
        ?>
            <li class="counter-cell-3"><span class="head"><?php _e('added cars total', 'cardealer'); ?></span><span class="count"><?php echo $total ?></span></li>
        <?php 
        }
        ?>       
    </ul>

</div>