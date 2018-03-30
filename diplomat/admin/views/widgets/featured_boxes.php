<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<div class="widget widget_metro_style">
    <ul class="metro_container">
        <li>
	        <a
		        <?php if (isset( $instance['first_box_icon'] ) && $instance['first_box_icon']){ ?>
		        class="<?php echo esc_attr($instance['first_box_icon']) ?>"
	            <?php } ?>
		        style="color: <?php echo $instance['first_box_title_color'] ?>; background-color: <?php echo $instance['first_box_color'] ?>"
	            href="<?php echo esc_url($instance['first_box_link']) ?>"><span><?php echo esc_html($instance['first_box_title']) ?></span><i><?php echo esc_html($instance['first_box_title']) ?></i>
	        </a>
        </li>
        <li>
	        <a
		        <?php if (isset($instance['second_box_icon'] ) && $instance['second_box_icon']){ ?>
                class="<?php echo esc_attr($instance['second_box_icon']) ?>"
                <?php } ?>
                style="color: <?php echo $instance['second_box_title_color'] ?>; background-color: <?php echo $instance['second_box_color'] ?>"
                href="<?php echo esc_url($instance['second_box_link']) ?>"><span><?php echo esc_html($instance['second_box_title']) ?></span><i><?php echo esc_html($instance['second_box_title']) ?></i>
	        </a>
        </li>
        <li>
	        <a
		        <?php if (isset($instance['third_box_icon'] ) && $instance['third_box_icon']){ ?>
                class="<?php echo esc_attr($instance['third_box_icon']) ?>"
                <?php } ?>
                style="color: <?php echo $instance['third_box_title_color'] ?>; background-color: <?php echo $instance['third_box_color'] ?>"
                href="<?php echo esc_url($instance['third_box_link']) ?>"><span><?php echo esc_html($instance['third_box_title']) ?></span><i><?php echo esc_html($instance['third_box_title']) ?></i>
	        </a>
        </li>
        <li>
	        <a
		        <?php if (isset($instance['fourth_box_icon'] ) && $instance['fourth_box_icon']){ ?>
                class="<?php echo esc_attr($instance['fourth_box_icon']) ?>"
                <?php } ?>
                style="color: <?php echo $instance['fourth_box_title_color'] ?>; background-color: <?php echo $instance['fourth_box_color'] ?>"
                href="<?php echo esc_url($instance['fourth_box_link']) ?>"><span><?php echo esc_html($instance['fourth_box_title']) ?></span><i><?php echo esc_html($instance['fourth_box_title']) ?></i>
	        </a>
        </li>
    </ul>
</div><!--/ .widget-container-->